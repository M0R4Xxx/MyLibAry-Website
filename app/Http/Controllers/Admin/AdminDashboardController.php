<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\User;
use App\Models\Loan;
use App\Models\UserFineBalance;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
    public function index()
    {   
        if (Auth::user()->role !== 'admin' || session('login_via') !== 'admin') {
        return redirect()->route('siswa.dashboard')->with('error', 'Akses Admin ditolak.');
    }
        $now = \Carbon\Carbon::now('Asia/Jakarta');

        $totalBooks = Book::count();
        $activeMembers = User::where('role', 'siswa')->count();
        $activeLoans = Loan::where('status', 'borrowed')->count();
        $overdueReturns = Loan::where('status', 'borrowed')
            ->where('due_date', '<', now())
            ->count();

        $booksCollection = Book::latest()->take(5)->get();

        $allUsers = User::where('user_id', '!=', Auth::id()) 
            ->orderByRaw("CASE WHEN role = 'admin' THEN 1 ELSE 2 END")
            ->orderBy('username', 'asc')
            ->take(10)
            ->get();

        
        $totalPendingCount = Loan::where('status', 'pending')->count();
        $pendingTransactions = Loan::with(['user', 'book'])
            ->where('status', 'pending')
            ->latest()
            ->take(10) 
            ->get();

        $returnTracking = Loan::with(['user', 'book'])
            ->where('status', 'borrowed')
            ->latest() 
            ->take(10)
            ->get();


        $fineReports = Loan::withTrashed()
            ->with(['user.fineBalance', 'book', 'fineLogs'])
            ->select('loans.*')
            ->distinct()
            ->leftJoin('fine_logs', 'loans.id', '=', 'fine_logs.loan_id')
            ->where(function($mandatory) use ($now) {
                $mandatory->where(function($q) use ($now) {
                    $q->where('loans.status', 'borrowed')
                    ->where('loans.due_date', '<', $now->toDateTimeString());
                })->orWhereHas('fineLogs');
            })
            ->orderByRaw("
                CASE 
                    WHEN loans.status = 'borrowed' AND loans.due_date < ? THEN 1 
                    ELSE 2 
                END ASC", [$now->toDateTimeString()])
            ->orderBy(DB::raw("(SELECT MAX(id) FROM fine_logs WHERE fine_logs.loan_id = loans.id)"), 'DESC')
            ->orderBy('loans.id', 'desc')
            ->take(10)
            ->get();

        $fineReports->transform(function($loan) use ($now) {
            $fineAmount = 0;
            $isOverdueBorrowed = ($loan->status === 'borrowed' && $loan->due_date < $now);
            
            $latestLog = $loan->fineLogs->sortByDesc('id')->first();

            if ($isOverdueBorrowed) {
                $due = \Carbon\Carbon::parse($loan->due_date);
                $days = ceil($due->diffInSeconds($now) / 86400);
                
                if ($days >= 1) $fineAmount += 10000;
                if ($days > 1) $fineAmount += ($days - 1) * 5000;
                
                $loan->payment_status = 'Unpaid';
            } else {
                $fineAmount = $latestLog ? $latestLog->final_fine_amount : 0;

                if (!$latestLog || $fineAmount <= 0) {
                    $loan->payment_status = 'Pay Off';
                } else {
                    if ($latestLog->payment_status === 'Pay Off') {
                        $loan->payment_status = 'Pay Off';
                    } else {
                        $userBalance = $loan->user->fineBalance->total_fine ?? 0;
                        
                        if ($userBalance <= 0) {
                            $loan->payment_status = 'Pay Off';
                        } elseif ($userBalance < $fineAmount) {
                            $loan->payment_status = 'Installments';
                        } else {
                            $loan->payment_status = 'Unpaid';
                        }
                    }
                }
            }

            $loan->calculated_fine = $fineAmount;
            return $loan;
        });


        $now = \Carbon\Carbon::now('Asia/Jakarta');
        $outstandingFines = UserFineBalance::with('user')
        ->get() 
        ->map(function ($balance) use ($now) {
            $totalFine = $balance->total_fine;
            $totalSeconds = $balance->total_overdue_seconds;
            $totalBooks = $balance->total_overdue_books;

            $runningLoans = Loan::where('user_id', $balance->user_id)
                ->where('status', 'borrowed')
                ->where('due_date', '<', $now->toDateTimeString())
                ->get();

            foreach ($runningLoans as $loan) {
                $due = \Carbon\Carbon::parse($loan->due_date);
                $diffInSeconds = $due->diffInSeconds($now);
                $days = ceil($diffInSeconds / 86400);
                
                $fineAmount = 0;
                if ($days >= 1) $fineAmount += 10000;
                if ($days > 1) $fineAmount += ($days - 1) * 5000;

                $totalFine += $fineAmount;
                $totalSeconds += $diffInSeconds;
                $totalBooks += 1;
            }

            $balance->realtime_fine = $totalFine;
            $balance->realtime_seconds = $totalSeconds;
            $balance->realtime_books = $totalBooks;

            return $balance;
        })
        ->filter(function ($item) {
            return $item->realtime_fine > 0;
        })
        ->sortByDesc('realtime_fine') 
        ->values()
        ->take(10); 

        $totalOutstandingFines = UserFineBalance::getTotalGlobalFine();

        $allTransactions = Loan::with(['user', 'book'])
        ->latest() 
        ->take(10) 
        ->get();

        return view('Admin.DashboardAdmin', compact(
            'totalBooks',
            'activeMembers',
            'activeLoans',
            'overdueReturns',
            'booksCollection',
            'allUsers',
            'pendingTransactions',
            'totalPendingCount',
            'returnTracking',
            'outstandingFines',
            'allTransactions',
            'totalOutstandingFines',
            'fineReports'
        ));
    }
}