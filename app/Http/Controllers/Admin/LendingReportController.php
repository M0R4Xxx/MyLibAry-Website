<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use App\Models\Loan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; 
use Carbon\Carbon;

class LendingReportController extends Controller
{
    public function index(Request $request) 
    {
        if (Auth::user()->role !== 'admin' || session('login_via') !== 'admin') {
            return redirect()->route('siswa.dashboard')->with('error', 'Akses Admin ditolak.');
        }

        $search = $request->query('search');
        $query = Loan::withTrashed()->with(['user', 'book']);

        if ($search) {
            $keyword = strtolower(trim($search));
            $superCleanKeyword = preg_replace('/[^a-z0-9]/', '', $keyword);
            $cleanWithSpace = preg_replace('/[^a-z0-9 ]/', '', $keyword);
            $words = array_filter(explode(' ', $cleanWithSpace));

            $query->where(function($q) use ($words, $superCleanKeyword, $search, $keyword) {
                $q->whereHas('user', function($u) use ($superCleanKeyword, $search) {
                    $u->where('username', 'LIKE', "%$search%")
                    ->orWhere('role', 'LIKE', "%$search%")
                    ->orWhere(DB::raw("LOWER(REGEXP_REPLACE(username, '[^a-zA-Z0-9]', ''))"), 'LIKE', "%$superCleanKeyword%");
                })
                ->orWhereHas('book', function($b) use ($superCleanKeyword, $search) {
                    $b->where('title', 'LIKE', "%$search%")
                    ->orWhere('author_name', 'LIKE', "%$search%")
                    ->orWhere(DB::raw("LOWER(REGEXP_REPLACE(title, '[^a-zA-Z0-9]', ''))"), 'LIKE', "%$superCleanKeyword%");
                })
                ->orWhere('status', 'LIKE', "%$search%");

                $isDate = (bool)strtotime($search);
                if ($isDate) {
                    try {
                        $carbonDate = Carbon::parse($search);
                        $q->orWhere(function($dq) use ($carbonDate, $search) {
                            if (count(explode(' ', trim($search))) === 1 && !preg_match('~[0-9]~', $search)) {
                                $dq->whereMonth('loan_date', $carbonDate->month)
                                ->orWhereMonth('due_date', $carbonDate->month)
                                ->orWhereMonth('return_date', $carbonDate->month);
                            } else {
                                $dq->whereDate('loan_date', $carbonDate->toDateString())
                                ->orWhereDate('due_date', $carbonDate->toDateString())
                                ->orWhereDate('return_date', $carbonDate->toDateString());
                            }
                        });
                    } catch (\Exception $e) {}
                }

                if (in_array($keyword, ['none', 'null', 'kosong', 'belum'])) {
                    $q->orWhereNull('return_date')
                    ->where('status', '!=', 'returned');
                }

                foreach ($words as $word) {
                    if (strlen($word) < 3) continue;
                    $q->orWhereHas('user', fn($u) => $u->whereRaw("SOUNDEX(username) = SOUNDEX(?)", [$word]))
                    ->orWhereHas('book', fn($b) => $b->whereRaw("SOUNDEX(title) = SOUNDEX(?)", [$word]));
                }
            });

            $query->orderByRaw("
                CASE 
                    WHEN status LIKE ? THEN 1
                    WHEN EXISTS(SELECT 1 FROM books WHERE books.id = loans.book_id AND books.title LIKE ?) THEN 2
                    ELSE 3 
                END ASC", ["%$search%", "%$search%"]);
        }

        $statusOptions = [
            'all'      => 'All Transactions',
            'pending'  => 'Pending Transaction',
            'borrowed' => 'Borrowed Transaction',
            'rejected' => 'Rejected Transaction',
            'returned' => 'Returned Transaction',
        ];

        $months = [
            'all' => 'All Months',  
            1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April', 
            5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August', 
            9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December'
        ];

        $monthRangeOptions = ['all' => 'All Months'];
        for ($i = 1; $i <= 12; $i++) {
            $nextMonth = ($i % 12) + 1;
            $key = strtolower($months[$i]) . '_' . strtolower($months[$nextMonth]);
            $monthRangeOptions[$key] = $months[$i] . ' - ' . $months[$nextMonth];
        }
        $currentMonthNum = (int)date('n'); 
        $nextMonthNum = ($currentMonthNum % 12) + 1;
        $defaultMonthKey = strtolower($months[$currentMonthNum]) . '_' . strtolower($months[$nextMonthNum]);

        $currentFilter = $request->query('filter', 'all');
        $currentMonthFilter = $request->query('month_range', 'all');

        if ($currentFilter !== 'all') {
            $query->where('loans.status', $currentFilter);
        }

        if ($currentMonthFilter !== 'all') {
            $monthName = ucfirst(explode('_', $currentMonthFilter)[0]);
            $startMonth = array_search($monthName, $months);

            if ($startMonth) {
                $query->whereMonth('loans.created_at', $startMonth);
            }
        }

        
        
        $sort = $request->query('sort', 'latest'); 

        switch ($sort) {
            case 'oldest':
                $query->orderBy('id', 'asc');
                break;
            case 'title_az':
                $query->join('books', 'loans.book_id', '=', 'books.id')
                    ->orderByRaw("CASE WHEN books.title REGEXP '^[0-9]' THEN 2 ELSE 1 END ASC")
                    ->orderBy('books.title', 'asc')
                    ->select('loans.*');
                break;
            case 'title_za':
                $query->join('books', 'loans.book_id', '=', 'books.id')
                    ->orderByRaw("CASE WHEN books.title REGEXP '^[0-9]' THEN 2 ELSE 1 END ASC")
                    ->orderBy('books.title', 'desc')
                    ->select('loans.*');
                break;
            case 'user_az':
                $query->join('all_library_users', 'loans.user_id', '=', 'all_library_users.user_id')
                    ->orderByRaw("CASE WHEN all_library_users.username REGEXP '^[0-9]' THEN 2 ELSE 1 END ASC")
                    ->orderBy('all_library_users.username', 'asc')
                    ->select('loans.*');
                break;
            case 'user_za':
                $query->join('all_library_users', 'loans.user_id', '=', 'all_library_users.user_id')
                    ->orderByRaw("CASE WHEN all_library_users.username REGEXP '^[0-9]' THEN 2 ELSE 1 END ASC")
                    ->orderBy('all_library_users.username', 'desc')
                    ->select('loans.*');
                break;
            case 'admin_first':
                $query->join('all_library_users', 'loans.user_id', '=', 'all_library_users.user_id')
                    ->orderByRaw("CASE WHEN all_library_users.role = 'admin' THEN 1 ELSE 2 END ASC")
                    ->select('loans.*');
                break;
            case 'siswa_first':
                $query->join('all_library_users', 'loans.user_id', '=', 'all_library_users.user_id')
                    ->orderByRaw("CASE WHEN all_library_users.role = 'siswa' THEN 1 ELSE 2 END ASC")
                    ->select('loans.*');
                break;
            default:
                $query->latest('loans.id');
                break;
        }

        $allTransactions = $query->paginate(20)->withQueryString();

        $sortOptions = [
            'latest'      => 'Newest Transaction',
            'oldest'      => 'Oldest Transaction',
            'title_az'    => 'Title: A-Z',
            'title_za'    => 'Title: Z-A',
            'user_az'     => 'Username: A-Z',
            'user_za'     => 'Username: Z-A',
            'admin_first' => 'Role: Admin > Siswa',
            'siswa_first' => 'Role: Siswa > Admin',
        ];

        $monthlyData = Loan::withTrashed() 
            ->select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('count(*) as count')
            )
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->pluck('count', 'month')
            ->toArray();

        $counts = [];
        for ($i = 1; $i <= 12; $i++) {
            $counts[] = $monthlyData[$i] ?? 0;
        }    

        return view('Admin.Reports', compact('allTransactions', 'counts', 'sortOptions', 'statusOptions', 'monthRangeOptions', 'currentFilter', 'currentMonthFilter'));
    
    }

    public function destroy($id)
    {
        if (Auth::user()->role !== 'admin' || session('login_via') !== 'admin') {
            return redirect()->back()->with('error', 'Akses ditolak.');
        }

        try {
            $loan = Loan::withTrashed()->findOrFail($id);
            $loan->forceDelete(); 

            return redirect()->back()->with('success', 'Transaksi berhasil dihapus secara permanen dari database.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus transaksi secara permanen.');
        }
    }
}