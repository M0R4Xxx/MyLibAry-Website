<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use App\Models\Loan;
use App\Models\FineLog;
use App\Models\UserFineBalance;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; 
use Barryvdh\DomPDF\Facade\Pdf;
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

        $allTransactions = $query->paginate(20, ['*'], 'page_transaction')->withQueryString();

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

        
        $searchReport = $request->query('search_report');
        $now = Carbon::now('Asia/Jakarta');

        $currentFineSort = $request->query('fine_sort', 'latest_fine');
        $currentFineFilter = $request->query('fine_filter', 'all');
        $currentFineMonth = $request->query('fine_month', 'all');

        $startMonth = null;
        if ($currentFineMonth !== 'all') {
            $monthName = ucfirst(explode('_', $currentFineMonth)[0]);
            $startMonth = array_search($monthName, $months);
        }

        $totalOutstanding = 0;

        $fineLogQuery = FineLog::query();
        if ($startMonth) {
            $fineLogQuery->whereHas('loan', function($q) use ($startMonth) {
                $q->whereMonth('created_at', $startMonth);
            });
        }
        $totalOutstanding += $fineLogQuery->sum('final_fine_amount');

        $overdueBorrowedQuery = Loan::where('status', 'borrowed')
            ->where('due_date', '<', $now);

        if ($startMonth) {
            $overdueBorrowedQuery->whereMonth('created_at', $startMonth);
        }

        $overdueLoans = $overdueBorrowedQuery->get();
        foreach ($overdueLoans as $loan) {
            $due = Carbon::parse($loan->due_date);
            $days = ceil($due->diffInSeconds($now) / 86400);
            $currentFine = 0;
            if ($days >= 1) $currentFine += 10000;
            if ($days > 1) $currentFine += ($days - 1) * 5000;
            
            $totalOutstanding += $currentFine;
        }

        $cleanMoneyInput = null;
        if ($searchReport && preg_match('/\d+/', $searchReport)) {
            $cleanMoneyInput = (int)preg_replace('/[^0-9]/', '', $searchReport);
        }

        $fineQuery = Loan::withTrashed()
            ->with(['user.fineBalance', 'book', 'fineLogs'])
            ->select('loans.*')
            ->distinct()
            ->leftJoin('fine_logs', 'loans.id', '=', 'fine_logs.loan_id');

        $fineQuery->where(function($mandatory) use ($now) {
            $mandatory->where(function($q) use ($now) {
                $q->where('loans.status', 'borrowed')
                ->where('loans.due_date', '<', $now->toDateTimeString());
            })->orWhereHas('fineLogs');
        });

        if ($searchReport) {
            $keyword = strtolower(trim($searchReport));
            $superCleanKeyword = preg_replace('/[^a-z0-9]/', '', $keyword);
            $cleanWithSpace = preg_replace('/[^a-z0-9 ]/', '', $keyword);
            $words = array_filter(explode(' ', $cleanWithSpace));

            $fineQuery->where(function($q) use ($words, $superCleanKeyword, $searchReport, $keyword, $now, $cleanMoneyInput) {
                $q->whereHas('user', function($u) use ($superCleanKeyword, $searchReport) {
                    $u->where('username', 'LIKE', "%$searchReport%")
                    ->orWhere('role', 'LIKE', "%$searchReport%")
                    ->orWhere(DB::raw("LOWER(REGEXP_REPLACE(username, '[^a-zA-Z0-9]', ''))"), 'LIKE', "%$superCleanKeyword%");
                })
                ->orWhereHas('book', function($b) use ($superCleanKeyword, $searchReport) {
                    $b->where('title', 'LIKE', "%$searchReport%")
                    ->orWhere('author_name', 'LIKE', "%$searchReport%")
                    ->orWhere(DB::raw("LOWER(REGEXP_REPLACE(title, '[^a-zA-Z0-9]', ''))"), 'LIKE', "%$superCleanKeyword%");
                })
                ->orWhere('loans.status', 'LIKE', "%$searchReport%");

                $isDate = (bool)strtotime($searchReport);
                if ($isDate) {
                    try {
                        $carbonDate = Carbon::parse($searchReport);
                        $q->orWhere(function($dq) use ($carbonDate, $searchReport) {
                            if (count(explode(' ', trim($searchReport))) === 1 && !preg_match('~[0-9]~', $searchReport)) {
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
                    $q->orWhereNull('return_date');
                }

                $isPayOffKeyword = false;
                $payOffSynonyms = ['payoff', 'payof', 'payo', 'paid', 'lunas', 'luna'];
                foreach ($payOffSynonyms as $syn) {
                    if (str_contains($superCleanKeyword, $syn)) {
                        $isPayOffKeyword = true;
                        break;
                    }
                }

                if ($isPayOffKeyword) {
                    $q->orWhereHas('fineLogs', fn($fl) => $fl->where('payment_status', 'Pay Off'));
                }

                $isUnpaidKeyword = false;
                $unpaidSynonyms = ['unpaid', 'unpad', 'unpai', 'belum', 'telat', 'hutang'];
                foreach ($unpaidSynonyms as $syn) {
                    if (str_contains($superCleanKeyword, $syn)) {
                        $isUnpaidKeyword = true;
                        break;
                    }
                }

                if ($isUnpaidKeyword) {
                    $q->orWhere(function($sq) use ($now) {
                        $sq->where('loans.status', 'borrowed')
                        ->where('loans.due_date', '<', $now->toDateTimeString());
                    })->orWhereHas('fineLogs', function($fl) {
                        $fl->where('payment_status', 'Unpaid');
                    });
                }

                if ($cleanMoneyInput) {
                    $q->orWhereHas('fineLogs', function($fl) use ($cleanMoneyInput) {
                        $minRange = $cleanMoneyInput - 5000;
                        $maxRange = $cleanMoneyInput + 5000;
                        
                        $fl->where(function($sub) use ($cleanMoneyInput, $minRange, $maxRange) {
                            $sub->where('final_fine_amount', $cleanMoneyInput)
                                ->orWhereBetween('final_fine_amount', [$minRange, $maxRange]);
                        });
                    });
                }

                if (str_contains($superCleanKeyword, 'cicil') || str_contains($superCleanKeyword, 'instal') || str_contains($superCleanKeyword, 'ins')) {
                    $q->orWhereHas('fineLogs', fn($fl) => $fl->where('payment_status', 'Installments'));
                }
                
                foreach ($words as $word) {
                    if (strlen($word) < 3) continue;

                    if ($isPayOffKeyword || $isUnpaidKeyword || str_contains($superCleanKeyword, 'cicil') || str_contains($superCleanKeyword, 'instal')) {
                        continue;
                    }

                    $q->orWhereHas('user', fn($u) => $u->whereRaw("SOUNDEX(username) = SOUNDEX(?)", [$word]))
                    ->orWhereHas('book', fn($b) => $b->whereRaw("SOUNDEX(title) = SOUNDEX(?)", [$word]));
                }
            });
        }

        if ($currentFineFilter !== 'all') {
            if ($currentFineFilter === 'payoff') {
                $fineQuery->where(function($q) use ($now) {
                    $q->whereNot(function($sub) use ($now) {
                        $sub->where('loans.status', 'borrowed')
                            ->where('loans.due_date', '<', $now->toDateTimeString());
                    })
                    ->where(function($sub) {
                        $sub->whereDoesntHave('fineLogs')
                            ->orWhereHas('fineLogs', function($fl) {
                                $fl->where('payment_status', 'Pay Off');
                            });
                    });
                });
            } elseif ($currentFineFilter === 'unpaid') {
                $fineQuery->where(function($q) use ($now) {
                    $q->where(function($sub) use ($now) {
                        $sub->where('loans.status', 'borrowed')
                            ->where('loans.due_date', '<', $now->toDateTimeString());
                    })
                    ->orWhereHas('fineLogs', function($fl) {
                        $fl->where('payment_status', 'Unpaid');
                    });
                });
            }
        }

        if ($currentFineMonth !== 'all') {
            $monthParts = explode('_', $currentFineMonth);
            $monthName = ucfirst($monthParts[0]);
            
            $startMonth = array_search($monthName, $months);
            
            if ($startMonth) {
                $fineQuery->whereMonth('loans.created_at', $startMonth);
            }
        }

        switch ($currentFineSort) {
            case 'oldest_fine':
                $fineQuery->orderByRaw("
                    CASE 
                        WHEN loans.status = 'borrowed' AND loans.due_date < ? THEN 2 
                        ELSE 1 
                    END ASC", [$now->toDateTimeString()])
                ->orderBy(DB::raw("(SELECT MIN(id) FROM fine_logs WHERE fine_logs.loan_id = loans.id)"), 'ASC');
                break;

            case 'title_az':
                $fineQuery->join('books as b_fine', 'loans.book_id', '=', 'b_fine.id')
                    ->orderByRaw("CASE WHEN b_fine.title REGEXP '^[0-9]' THEN 2 ELSE 1 END ASC")
                    ->orderBy('b_fine.title', 'asc');
                break;

            case 'title_za':
                $fineQuery->join('books as b_fine', 'loans.book_id', '=', 'b_fine.id')
                    ->orderByRaw("CASE WHEN b_fine.title REGEXP '^[0-9]' THEN 2 ELSE 1 END ASC")
                    ->orderBy('b_fine.title', 'desc');
                break;

            case 'user_az':
                $fineQuery->join('all_library_users as u_fine', 'loans.user_id', '=', 'u_fine.user_id')
                    ->orderByRaw("CASE WHEN u_fine.username REGEXP '^[0-9]' THEN 2 ELSE 1 END ASC")
                    ->orderBy('u_fine.username', 'asc');
                break;

            case 'user_za':
                $fineQuery->join('all_library_users as u_fine', 'loans.user_id', '=', 'u_fine.user_id')
                    ->orderByRaw("CASE WHEN u_fine.username REGEXP '^[0-9]' THEN 2 ELSE 1 END ASC")
                    ->orderBy('u_fine.username', 'desc');
                break;

            case 'admin_first':
                $fineQuery->join('all_library_users as u_role', 'loans.user_id', '=', 'u_role.user_id')
                    ->orderByRaw("CASE WHEN u_role.role = 'admin' THEN 1 ELSE 2 END ASC");
                break;

            case 'siswa_first':
                $fineQuery->join('all_library_users as u_role', 'loans.user_id', '=', 'u_role.user_id')
                    ->orderByRaw("CASE WHEN u_role.role = 'siswa' THEN 1 ELSE 2 END ASC");
                break;

            default: 
                $fineQuery->orderByRaw("
                    CASE 
                        -- 1. Prioritas Exact Match Nominal (Jika ada input angka)
                        WHEN ? IS NOT NULL AND EXISTS (
                            SELECT 1 FROM fine_logs 
                            WHERE fine_logs.loan_id = loans.id 
                            AND fine_logs.final_fine_amount = ?
                        ) THEN 1
                        
                        -- 2. Urutan Default: Prioritaskan yang statusnya 'borrowed' dan telat
                        WHEN loans.status = 'borrowed' AND loans.due_date < ? THEN 2 
                        
                        -- 3. Sisanya
                        ELSE 3 
                    END ASC", [$cleanMoneyInput, $cleanMoneyInput, $now->toDateTimeString()]);
                break;
        }

        $fineReports = $fineQuery->when($cleanMoneyInput, function($q) use ($cleanMoneyInput) {
        return $q->orderByRaw("ABS((SELECT COALESCE(MAX(final_fine_amount), 0) FROM fine_logs WHERE fine_logs.loan_id = loans.id) - ?)", [$cleanMoneyInput]);
            })
            ->orderBy(DB::raw("(SELECT MAX(id) FROM fine_logs WHERE fine_logs.loan_id = loans.id)"), 'DESC')
            ->orderBy('loans.id', 'desc')
            ->paginate(20, ['*'], 'page_report')
            ->withQueryString();


        $fineReports->getCollection()->transform(function($loan) use ($now) {
            $fineAmount = 0;
            $isOverdueBorrowed = ($loan->status === 'borrowed' && $loan->due_date < $now);
            
            $latestLog = $loan->fineLogs->sortByDesc('id')->first();

            if ($isOverdueBorrowed) {
                $due = Carbon::parse($loan->due_date);
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


        $fineSortOptions = [
            'latest_fine' => 'Newest Fine Transaction',
            'oldest_fine' => 'Oldest Fine Transaction',
            'title_az'    => 'Title: A-Z',
            'title_za'    => 'Title: Z-A',
            'user_az'     => 'Username: A-Z',
            'user_za'     => 'Username: Z-A',
            'admin_first' => 'Role: Admin > Siswa',
            'siswa_first' => 'Role: Siswa > Admin',
        ];

        $fineStatusOptions = [
            'all'     => 'All Fine Transactions',
            'payoff'  => 'Pay Off Transaction',
            'unpaid'  => 'Unpaid Transaction',
        ];

        return view('Admin.Reports', compact(
            'allTransactions', 'fineReports', 'counts', 'sortOptions', 'statusOptions', 'months',
            'monthRangeOptions', 'currentFilter', 'currentMonthFilter',
            'fineSortOptions', 'fineStatusOptions', 'currentFineSort', 'currentFineFilter', 'currentFineMonth', 'totalOutstanding'
        ));
    
    }

    public function destroy($id)
    {
        if (Auth::user()->role !== 'admin' || session('login_via') !== 'admin') {
            return redirect()->back()->with('error', 'Akses ditolak.');
        }

        DB::beginTransaction();
        try {
            $loan = Loan::withTrashed()->with(['fineLogs', 'user.fineBalance'])->findOrFail($id);
            $now = Carbon::now('Asia/Jakarta');

            foreach ($loan->fineLogs as $log) {
                $balance = UserFineBalance::where('user_id', $loan->user_id)->first();
                
                if ($balance) {
                    $balance->total_fine = max(0, $balance->total_fine - $log->final_fine_amount);
                    
                    $due = Carbon::parse($loan->due_date);
                    $ret = Carbon::parse($loan->return_date ?? $log->calculated_at);
                    $seconds = $due->diffInSeconds($ret);
                    
                    $balance->total_overdue_seconds = max(0, $balance->total_overdue_seconds - $seconds);
                    $balance->total_overdue_books = max(0, $balance->total_overdue_books - 1);
                    $balance->save();
                }
                $log->delete(); 
            }

            $loan->forceDelete();

            DB::commit();
            return redirect()->back()->with('success', 'Transaksi dan data denda terkait berhasil dihapus secara permanen.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menghapus transaksi: ' . $e->getMessage());
        }
    }


    public function destroyFineReport($id)
    {
        if (Auth::user()->role !== 'admin' || session('login_via') !== 'admin') {
            return redirect()->back()->with('error', 'Akses ditolak.');
        }

        DB::beginTransaction();
        try {
            $loan = Loan::withTrashed()->with(['fineLogs', 'user.fineBalance'])->findOrFail($id);
            $now = Carbon::now('Asia/Jakarta');

            if ($loan->status === 'borrowed' && $loan->due_date < $now) {

                $loan->forceDelete();
            } 
            else {
                foreach ($loan->fineLogs as $log) {
                    $balance = UserFineBalance::where('user_id', $loan->user_id)->first();
                    
                    if ($balance) {
                        $balance->total_fine = max(0, $balance->total_fine - $log->final_fine_amount);
                        
                        $due = Carbon::parse($loan->due_date);
                        $ret = Carbon::parse($loan->return_date ?? $log->calculated_at);
                        $seconds = $due->diffInSeconds($ret);
                        
                        $balance->total_overdue_seconds = max(0, $balance->total_overdue_seconds - $seconds);
                        $balance->total_overdue_books = max(0, $balance->total_overdue_books - 1);
                        $balance->save();
                    }
                    $log->delete(); 
                }
                
                $loan->forceDelete();
            }

            DB::commit();
            return redirect()->back()->with('success', 'Data denda dan transaksi berhasil dibersihkan secara permanen.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menghapus data denda: ' . $e->getMessage());
        }
    }


    public function exportPdf(Request $request) 
    {
        $query = Loan::withTrashed()->with(['user', 'book']);

        $currentMonthFilter = $request->query('month_range', 'all');

        if ($currentMonthFilter !== 'all') {
            $monthsMap = [
                'january' => 1, 'february' => 2, 'march' => 3, 'april' => 4, 
                'may' => 5, 'june' => 6, 'july' => 7, 'august' => 8, 
                'september' => 9, 'october' => 10, 'november' => 11, 'december' => 12
            ];

            $monthName = explode('_', $currentMonthFilter)[0];
            $startMonth = $monthsMap[strtolower($monthName)] ?? null;

            if ($startMonth) {
                $query->whereMonth('loans.created_at', $startMonth);
            }
        }

        $transactions = $query->latest('loans.id')->get();

        $summary = [
            'total'    => $transactions->count(),
            'pending'  => $transactions->where('status', 'pending')->count(),
            'borrowed' => $transactions->where('status', 'borrowed')->count(),
            'returned' => $transactions->where('status', 'returned')->count(),
            'rejected' => $transactions->where('status', 'rejected')->count(),
        ];

        $filterLabel = $currentMonthFilter === 'all' ? 'Semua Bulan' : ucfirst(str_replace('_', ' - ', $currentMonthFilter));

        $pdf = Pdf::loadView('Export_PDF.AllTransactionPDF', [
            'transactions' => $transactions,
            'summary'      => $summary,
            'filterLabel'  => $filterLabel,
            'dateExport'   => now()->format('d F Y')
        ])->setPaper('a4', 'landscape');

        return $pdf->download('Laporan-Peminjaman-'.now()->format('YmdHis').'.pdf');
    }


    public function exportFinePdf(Request $request)
    {
        $now = Carbon::now('Asia/Jakarta');
        $currentFineMonth = $request->query('fine_month', 'all');
        
        $months = [
            'January' => 1, 'February' => 2, 'March' => 3, 'April' => 4, 
            'May' => 5, 'June' => 6, 'July' => 7, 'August' => 8, 
            'September' => 9, 'October' => 10, 'November' => 11, 'December' => 12
        ];

        $startMonth = null;
        if ($currentFineMonth !== 'all') {
            $monthName = ucfirst(explode('_', $currentFineMonth)[0]);
            $startMonth = $months[$monthName] ?? null;
        }

        $totalOutstanding = 0;

        $fineLogQuery = FineLog::query();
        if ($startMonth) {
            $fineLogQuery->whereHas('loan', function($q) use ($startMonth) {
                $q->whereMonth('created_at', $startMonth);
            });
        }
        $totalOutstanding += $fineLogQuery->sum('final_fine_amount');

        $overdueBorrowedQuery = Loan::where('status', 'borrowed')
            ->where('due_date', '<', $now);

        if ($startMonth) {
            $overdueBorrowedQuery->whereMonth('created_at', $startMonth);
        }

        $overdueLoans = $overdueBorrowedQuery->get();
        foreach ($overdueLoans as $loan) {
            $due = Carbon::parse($loan->due_date);
            $days = ceil($due->diffInSeconds($now) / 86400);
            $currentFine = 0;
            if ($days >= 1) $currentFine += 10000;
            if ($days > 1) $currentFine += ($days - 1) * 5000;
            
            $totalOutstanding += $currentFine;
        }

        $fineQuery = Loan::withTrashed()
            ->with(['user.fineBalance', 'book', 'fineLogs'])
            ->select('loans.*')
            ->distinct()
            ->leftJoin('fine_logs', 'loans.id', '=', 'fine_logs.loan_id');

        $fineQuery->where(function($mandatory) use ($now) {
            $mandatory->where(function($q) use ($now) {
                $q->where('loans.status', 'borrowed')
                ->where('loans.due_date', '<', $now->toDateTimeString());
            })->orWhereHas('fineLogs');
        });

        if ($startMonth) {
            $fineQuery->whereMonth('loans.created_at', $startMonth);
        }

        $fineReports = $fineQuery->orderByRaw("
            CASE 
                WHEN loans.status = 'borrowed' AND loans.due_date < ? THEN 2 
                ELSE 3 
            END ASC", [$now->toDateTimeString()])
        ->orderBy(DB::raw("(SELECT MAX(id) FROM fine_logs WHERE fine_logs.loan_id = loans.id)"), 'DESC')
        ->orderBy('loans.id', 'desc')
        ->get();

        $fineReports->transform(function($loan) use ($now) {
            $fineAmount = 0;
            $isOverdueBorrowed = ($loan->status === 'borrowed' && $loan->due_date < $now);
            $latestLog = $loan->fineLogs->sortByDesc('id')->first();

            if ($isOverdueBorrowed) {
                $due = Carbon::parse($loan->due_date);
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
                        if ($userBalance <= 0) $loan->payment_status = 'Pay Off';
                        elseif ($userBalance < $fineAmount) $loan->payment_status = 'Installments';
                        else $loan->payment_status = 'Unpaid';
                    }
                }
            }
            $loan->calculated_fine = $fineAmount;
            return $loan;
        });

        $summary = [
            'total' => $fineReports->count(),
            'payoff' => $fineReports->where('payment_status', 'Pay Off')->count(),
            'unpaid' => $fineReports->where('payment_status', 'Unpaid')->count(),
            'installments' => $fineReports->where('payment_status', 'Installments')->count(),
        ];

        $filterLabel = $currentFineMonth === 'all' ? 'Semua Bulan' :  ucfirst(str_replace('_', ' - ', $currentFineMonth));

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('Export_PDF.FineTransactionPDF', [
            'fineReports' => $fineReports,
            'summary' => $summary,
            'totalOutstanding' => $totalOutstanding,
            'filterLabel' => $filterLabel,
            'dateExport' => now()->format('d F Y')
        ])->setPaper('a4', 'landscape');

        return $pdf->download('Laporan-Denda-'.now()->format('YmdHis').'.pdf');
    }
}