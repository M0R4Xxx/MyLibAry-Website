<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Loan;
use App\Models\UserFineBalance;
use App\Models\FineLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::user()->role !== 'admin' || session('login_via') !== 'admin') {
            return redirect()->route('siswa.dashboard')->with('error', 'Akses Admin ditolak.');
        }

        $searchPending = $request->query('search_pending');

        $pendingQuery = Loan::with(['user', 'book'])->where('status', 'pending');


        $sortPending = $request->query('sort_pending', 'newest');
        $sortPendingOptions = [
            'newest'      => 'Newest ID',
            'oldest'      => 'Oldest ID',
            'title_az'    => 'Book Title A-Z',
            'title_za'    => 'Book Title Z-A',
            'user_az'     => 'Username A-Z',
            'user_za'     => 'Username Z-A',
            'admin_first' => 'Admin > Siswa',
            'siswa_first' => 'Siswa > Admin',
        ];

        if ($searchPending) {
            $keyword = strtolower(trim($searchPending));    
            $superCleanKeyword = preg_replace('/[^a-z0-9]/', '', $keyword);
            $cleanWithSpace = preg_replace('/[^a-z0-9 ]/', '', $keyword);
            $words = array_filter(explode(' ', $cleanWithSpace));

            $pendingQuery->where(function($q) use ($words, $superCleanKeyword, $searchPending) {
                $q->whereHas('user', function($u) use ($words, $superCleanKeyword, $searchPending) {
                    $u->where('username', 'LIKE', "%$searchPending%")
                    ->orWhere('role', 'LIKE', "%$searchPending%")
                    ->orWhere(DB::raw("LOWER(REGEXP_REPLACE(username, '[^a-zA-Z0-9]', ''))"), 'LIKE', "%$superCleanKeyword%");
                })
                ->orWhereHas('book', function($b) use ($words, $superCleanKeyword, $searchPending) {
                    $b->where('title', 'LIKE', "%$searchPending%")
                    ->orWhere('author_name', 'LIKE', "%$searchPending%")
                    ->orWhere(DB::raw("LOWER(REGEXP_REPLACE(title, '[^a-zA-Z0-9]', ''))"), 'LIKE', "%$superCleanKeyword%");
                });


                $dateKeyword = date('Y-m-d', strtotime($searchPending));
                $isDate = (bool)strtotime($searchPending);

                if ($isDate) {
                    $q->orWhereMonth('loan_date', Carbon::parse($searchPending)->month)
                    ->orWhereDay('loan_date', Carbon::parse($searchPending)->day)
                    ->orWhereMonth('due_date', Carbon::parse($searchPending)->month)
                    ->orWhereDay('due_date', Carbon::parse($searchPending)->day);
                }

                foreach ($words as $word) {
                    if (strlen($word) < 2) continue;
                    $q->orWhereHas('user', fn($u) => $u->whereRaw("SOUNDEX(username) = SOUNDEX(?)", [$word]))
                    ->orWhereHas('book', fn($b) => $b->whereRaw("SOUNDEX(title) = SOUNDEX(?)", [$word]));
                }
            });
        }

        switch ($sortPending) {
            case 'oldest': 
                $pendingQuery->orderBy('loans.id', 'asc'); 
                break;

            case 'title_az': 
                $pendingQuery->join('books', 'loans.book_id', '=', 'books.id')
                    ->orderBy('books.title', 'asc')
                    ->select('loans.*'); 
                break;

            case 'title_za': 
                $pendingQuery->join('books', 'loans.book_id', '=', 'books.id')
                    ->orderBy('books.title', 'desc')
                    ->select('loans.*'); 
                break;

            case 'user_az':  
                $pendingQuery->join('all_library_users', 'loans.user_id', '=', 'all_library_users.user_id')
                    ->orderBy('all_library_users.username', 'asc')
                    ->select('loans.*'); 
                break;

            case 'user_za':  
                $pendingQuery->join('all_library_users', 'loans.user_id', '=', 'all_library_users.user_id')
                    ->orderBy('all_library_users.username', 'desc')
                    ->select('loans.*'); 
                break;

            case 'admin_first': 
                $pendingQuery->join('all_library_users', 'loans.user_id', '=', 'all_library_users.user_id')
                    ->orderByRaw("CASE WHEN all_library_users.role = 'admin' THEN 1 ELSE 2 END ASC")
                    ->orderBy('loans.id', 'desc')
                    ->select('loans.*'); 
                break;

            case 'siswa_first': 
                $pendingQuery->join('all_library_users', 'loans.user_id', '=', 'all_library_users.user_id')
                    ->orderByRaw("CASE WHEN all_library_users.role = 'siswa' THEN 1 ELSE 2 END ASC")
                    ->orderBy('loans.id', 'desc')
                    ->select('loans.*'); 
                break;

            default: 
                $pendingQuery->orderBy('loans.id', 'desc'); 
                break;
        }

        $pendingTransactions = $pendingQuery->get();




        $returnQuery = Loan::with(['user', 'book'])->where('status', 'borrowed');

        if ($request->filled('search')) {
            $search = $request->query('search');
            $keyword = strtolower(trim($search));
            
            $superCleanKeyword = preg_replace('/[^a-z0-9]/', '', $keyword);
            $cleanWithSpace = preg_replace('/[^a-z0-9 ]/', '', $keyword);
            $words = array_filter(explode(' ', $cleanWithSpace));

            $returnQuery->where(function($q) use ($words, $superCleanKeyword, $search) {
                $q->whereHas('user', function($u) use ($superCleanKeyword, $search) {
                    $u->where('username', 'LIKE', "%$search%")
                    ->orWhere('role', 'LIKE', "%$search%")
                    ->orWhere(DB::raw("LOWER(REGEXP_REPLACE(username, '[^a-zA-Z0-9]', ''))"), 'LIKE', "%$superCleanKeyword%");
                })
                ->orWhereHas('book', function($b) use ($superCleanKeyword, $search) {
                    $b->where('title', 'LIKE', "%$search%")
                    ->orWhere('author_name', 'LIKE', "%$search%")
                    ->orWhere(DB::raw("LOWER(REGEXP_REPLACE(title, '[^a-zA-Z0-9]', ''))"), 'LIKE', "%$superCleanKeyword%");
                });

                $isDate = (bool)strtotime($search);
                if ($isDate) {
                    try {
                        $carbonDate = Carbon::parse($search);
                        $q->orWhere(function($dq) use ($carbonDate, $search) {
                            if (count(explode(' ', trim($search))) === 1 && !preg_match('~[0-9]~', $search)) {
                                $dq->whereMonth('loan_date', $carbonDate->month)
                                ->orWhereMonth('due_date', $carbonDate->month);
                            } else {
                                $dq->whereDate('loan_date', $carbonDate->toDateString())
                                ->orWhereDate('due_date', $carbonDate->toDateString());
                            }
                        });
                    } catch (\Exception $e) { /* Abaikan jika parsing gagal */ }
                }

                if (preg_match('/(\d+)\s*(d|day|hari|h|hour|jam)/i', $search, $matches)) {
                    $value = (int)$matches[1];
                    $unit = strtolower($matches[2]);
                    $now = Carbon::now('Asia/Jakarta');

                    if (in_array($unit, ['d', 'day', 'hari'])) {
                        $targetDate = $now->copy()->addDays($value)->toDateString();
                        $q->orWhereDate('due_date', $targetDate);
                    } else {
                        $q->orWhereRaw("ABS(TIMESTAMPDIFF(HOUR, NOW(), due_date)) <= ?", [$value]);
                    }
                }

                foreach ($words as $word) {
                    if (strlen($word) < 3) continue;
                    $q->orWhereHas('user', fn($u) => $u->whereRaw("SOUNDEX(username) = SOUNDEX(?)", [$word]))
                    ->orWhereHas('book', fn($b) => $b->whereRaw("SOUNDEX(title) = SOUNDEX(?)", [$word]));
                }
            });

            $returnQuery->orderByRaw("
                CASE 
                    WHEN EXISTS(SELECT 1 FROM all_library_users WHERE all_library_users.user_id = loans.user_id AND all_library_users.username = ?) THEN 1
                    WHEN EXISTS(SELECT 1 FROM books WHERE books.id = loans.book_id AND books.title LIKE ?) THEN 2
                    ELSE 3 
                END ASC", [$search, "%$search%"]);
        }

        $sortBorrowed = $request->query('sort_borrowed', 'latest');
        $sortBorrowedOptions = [
            'latest'      => 'Latest Borrowed',
            'oldest'      => 'Oldest Borrowed',
            'title_az'    => 'Book Title A-Z',
            'title_za'    => 'Book Title Z-A',
            'user_az'     => 'Username A-Z',
            'user_za'     => 'Username Z-A',
            'admin_first' => 'Admin > Siswa',
            'siswa_first' => 'Siswa > Admin',
            'due_1'       => '< 1 Days Left',
            'due_1_2'     => '1-2 Days Left',
            'due_2_3'     => '2-3 Days Left',
            'due_3_4'     => '3-4 Days Left',
            'due_4_5'     => '4-5 Days Left',
            'due_6_7'     => '6-7 Days Left',
            'due_over_7'  => '> 7 Days Left',
        ];

        switch ($sortBorrowed) {
            case 'oldest': $returnQuery->orderBy('id', 'asc'); break;
            case 'title_az': 
                $returnQuery->join('books', 'loans.book_id', '=', 'books.id')
                    ->orderByRaw("CASE WHEN books.title REGEXP '^[0-9]' THEN 2 ELSE 1 END ASC")
                    ->orderBy('books.title', 'asc')
                    ->select('loans.*'); 
                break;

            case 'title_za': 
                $returnQuery->join('books', 'loans.book_id', '=', 'books.id')
                    ->orderByRaw("CASE WHEN books.title REGEXP '^[0-9]' THEN 2 ELSE 1 END ASC")
                    ->orderBy('books.title', 'desc')
                    ->select('loans.*'); 
                break;
            case 'user_az': 
                $returnQuery->join('all_library_users', 'loans.user_id', '=', 'all_library_users.user_id')->orderBy('all_library_users.username', 'asc')->select('loans.*'); 
                break;
            case 'user_za': 
                $returnQuery->join('all_library_users', 'loans.user_id', '=', 'all_library_users.user_id')->orderBy('all_library_users.username', 'desc')->select('loans.*'); 
                break;
            case 'admin_first': 
                $returnQuery->join('all_library_users', 'loans.user_id', '=', 'all_library_users.user_id')->orderByRaw("CASE WHEN all_library_users.role = 'admin' THEN 1 ELSE 2 END ASC")->select('loans.*'); 
                break;
            case 'siswa_first': 
                $returnQuery->join('all_library_users', 'loans.user_id', '=', 'all_library_users.user_id')->orderByRaw("CASE WHEN all_library_users.role = 'siswa' THEN 1 ELSE 2 END ASC")->select('loans.*'); 
                break;
            
            case 'due_1': 
                $returnQuery->whereRaw('TIMESTAMPDIFF(HOUR, NOW(), due_date) < 24'); 
                break;

            case 'due_1_2': 
                $returnQuery->whereRaw('TIMESTAMPDIFF(HOUR, NOW(), due_date) BETWEEN 24 AND 47'); 
                break;

            case 'due_2_3': 
                $returnQuery->whereRaw('TIMESTAMPDIFF(HOUR, NOW(), due_date) BETWEEN 48 AND 71'); 
                break;

            case 'due_3_4': 
                $returnQuery->whereRaw('TIMESTAMPDIFF(HOUR, NOW(), due_date) BETWEEN 72 AND 95'); 
                break;

            case 'due_4_5': 
                $returnQuery->whereRaw('TIMESTAMPDIFF(HOUR, NOW(), due_date) BETWEEN 96 AND 119'); 
                break;

            case 'due_6_7': 
                $returnQuery->whereRaw('TIMESTAMPDIFF(HOUR, NOW(), due_date) BETWEEN 120 AND 167'); 
                break;

            case 'due_over_7': 
                $returnQuery->whereRaw('TIMESTAMPDIFF(HOUR, NOW(), due_date) >= 168'); 
                break;
            
            default: $returnQuery->orderBy('id', 'desc'); break;
        }

                
        $returnTracking = $returnQuery->latest()->paginate(10)->withQueryString();


        return view('Admin.Transaction', compact('pendingTransactions', 'returnTracking', 'sortPendingOptions', 'sortPending', 'sortBorrowedOptions', 'sortBorrowed'));
    }

    public function returnBook($id)
    {
        $loan = Loan::with(['book', 'user'])->where('id', $id)
            ->where('status', 'borrowed')
            ->firstOrFail();

        $userId = $loan->user_id; 
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

        return redirect()->back()->with('success', 'Buku "' . $loan->book->title . '" milik ' . $loan->user->name . ' berhasil dikembalikan!');
    }
}