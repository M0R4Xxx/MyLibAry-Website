<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\UserFineBalance;
use App\Models\FineLog; 
use Illuminate\Http\Request;
use App\Models\Book;      
use App\Models\User;
use App\Models\Wishlist;  
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class FineController extends Controller
{
    public function index()
{
    $userId = Auth::user()->user_id;
    $now = Carbon::now('Asia/Jakarta');
    $users = User::all();
    
    $balance = UserFineBalance::firstOrCreate(
        ['user_id' => $userId],
        ['total_fine' => 0, 'total_overdue_seconds' => 0, 'total_overdue_books' => 0]
    );

    $oldPendingLoans = Loan::where('user_id', $userId)
        ->where('status', 'returned')
        ->whereDoesntHave('fineLogs') 
        ->get();

    if ($oldPendingLoans->count() > 0) {
        DB::transaction(function () use ($oldPendingLoans, $balance, $userId) {
            foreach ($oldPendingLoans as $oldLoan) {
                $due = Carbon::parse($oldLoan->due_date);
                $ret = Carbon::parse($oldLoan->return_date);

                if ($ret->greaterThan($due)) {
                    $diff = $due->diffInSeconds($ret);
                    $days = ceil($diff / 86400);

                    $fineAmount = 0;
                    if ($days >= 1) $fineAmount += 10000;
                    if ($days > 1) $fineAmount += ($days - 1) * 5000;

                    $balance->increment('total_overdue_seconds', $diff);
                    $balance->increment('total_overdue_books', 1);
                    $balance->increment('total_fine', $fineAmount);

                    FineLog::create([
                        'user_id' => $userId,
                        'loan_id' => $oldLoan->id,
                        'book_title' => $oldLoan->book->title ?? 'Buku Lama',
                        'final_fine_amount' => $fineAmount,
                        'calculated_at' => $oldLoan->return_date,
                    ]);
                } else {
                    FineLog::create([
                        'user_id' => $userId,
                        'loan_id' => $oldLoan->id,
                        'book_title' => $oldLoan->book->title ?? 'Buku Lama',
                        'final_fine_amount' => 0,
                        'calculated_at' => $oldLoan->return_date,
                    ]);
                }
            }
        });
        $balance->refresh();
    }


    $fixedFine = $balance ? $balance->total_fine : 0;
    $accumulatedSeconds = $balance ? $balance->total_overdue_seconds : 0;
    $accumulatedBooks = $balance ? $balance->total_overdue_books : 0;

    $overdueLoans = Loan::with('book')
        ->where('user_id', $userId)
        ->where('status', 'borrowed')
        ->where('due_date', '<', $now->toDateTimeString()) 
        ->get();

        $runningFine = 0;
        $runningSeconds = 0;

        foreach ($overdueLoans as $loan) {
            $due = Carbon::parse($loan->due_date);

            $diffInSeconds = $due->diffInSeconds($now);
            $runningSeconds += $diffInSeconds;

            $days = ceil($diffInSeconds / 86400);
            
            $fineAmount = 0;
            if ($days >= 1) $fineAmount += 10000;
            if ($days > 1) $fineAmount += ($days - 1) * 5000;

            $loan->current_fine = $fineAmount;
            $loan->days_late = $days;
            $runningFine += $fineAmount;
        }

        $totalSeconds = $accumulatedSeconds + $runningSeconds;
        $displayDays = floor($totalSeconds / 86400);
        $displayHours = floor(($totalSeconds % 86400) / 3600);


        $currentlyBorrowedIds = Loan::where('user_id', $userId)
            ->where('status', 'borrowed')
            ->distinct()
            ->pluck('book_id')
            ->toArray();

        $wishlistBookIds = Wishlist::where('user_id', $userId)
            ->pluck('book_id')
            ->toArray();

        $books = Book::whereNotIn('id', $currentlyBorrowedIds)
            ->inRandomOrder()
            ->take(5)
            ->get();

        return view('Siswa.Fines', [
            'users' => $users,
            'totalFine' => max(0, $fixedFine + $runningFine),
            'overdueCount' => (int)$accumulatedBooks + $overdueLoans->count(),
            'days' => $displayDays,            
            'hours' => $displayHours,
            'activeLoans' => $overdueLoans,
            'fixedFine' => $fixedFine,
            'books' => $books, 
            'wishlistBookIds' => $wishlistBookIds
        ]);
    }

    public function returnBook($id)
    {
        $userId = Auth::user()->user_id;
        
        $loan = Loan::with('book')->where('id', $id)
            ->where('user_id', $userId)
            ->where('status', 'borrowed')
            ->firstOrFail();

        $due = Carbon::parse($loan->due_date);
        $now = Carbon::now('Asia/Jakarta');
        $finalFine = 0;

        $secondsDiff = $due->diffInSeconds($now, false); 
        if ($secondsDiff > 0) {
            $days = ceil($secondsDiff / 86400);
            if ($days >= 1) $finalFine += 10000;
            if ($days > 1) $finalFine += ($days - 1) * 5000;
        }

        DB::transaction(function () use ($userId, $loan, $finalFine, $now, $secondsDiff) {
        $balance = UserFineBalance::firstOrCreate(
            ['user_id' => $userId],
            ['total_fine' => 0, 'total_overdue_seconds' => 0, 'total_overdue_books' => 0]
        );

        if ($secondsDiff > 0) {
            $balance->increment('total_fine', $finalFine);
            $balance->increment('total_overdue_seconds', $secondsDiff); 
            $balance->increment('total_overdue_books', 1); 
            
            FineLog::create([
                'user_id' => $userId,
                'loan_id' => $loan->id,
                'book_title' => $loan->book->title,
                'final_fine_amount' => $finalFine,
                'calculated_at' => $now,
            ]);
        }

        $loan->update([
            'status' => 'returned',
            'return_date' => $now
        ]);
    });

        return redirect()->route('siswa.history')->with('success', 'Buku "' . $loan->book->title . '" berhasil dikembalikan!');
}
}