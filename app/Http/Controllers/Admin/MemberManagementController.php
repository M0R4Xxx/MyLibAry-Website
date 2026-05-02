<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Loan;
use App\Models\UserFineBalance;
use App\Models\FineLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Validation\Rule; 
use Illuminate\Support\Facades\DB;

class MemberManagementController extends Controller
{
public function index(Request $request)
{
    if (Auth::user()->role !== 'admin' || session('login_via') !== 'admin') {
        return redirect()->route('siswa.dashboard')->with('error', 'Akses Admin ditolak.');
    }

    $now = Carbon::now('Asia/Jakarta');

    $searchAll = $request->query('search_all'); 
    $sort = $request->query('sort', 'admin_first');
    $query = User::where('user_id', '!=', Auth::id());

    if ($searchAll) {
        $keyword = strtolower(trim($searchAll));
        $superCleanKeyword = preg_replace('/[^a-z0-9]/', '', $keyword);
        $cleanWithSpace = preg_replace('/[^a-z0-9 ]/', '', $keyword);
        $words = array_filter(explode(' ', $cleanWithSpace));

        $query->where(function($q) use ($words, $superCleanKeyword, $searchAll) {
            $columns = ['username', 'email', 'role'];

            foreach ($columns as $col) {
                $q->orWhere($col, 'LIKE', "%$searchAll%");
            }

            foreach ($columns as $col) {
                $q->orWhere(\Illuminate\Support\Facades\DB::raw("LOWER(REGEXP_REPLACE($col, '[^a-zA-Z0-9]', ''))"), 'LIKE', "%$superCleanKeyword%");
            }

            foreach ($words as $word) {
                if (strlen($word) < 2) continue;
                foreach ($columns as $col) {
                    $q->orWhereRaw("SOUNDEX($col) = SOUNDEX(?)", [$word]);
                    $q->orWhere(\Illuminate\Support\Facades\DB::raw("LOWER(REGEXP_REPLACE($col, '[^a-zA-Z0-9]', ''))"), 'LIKE', "%$word%");
                }
            }
        });

        $fuzzyPattern = strlen($superCleanKeyword) > 3 ? '%' . implode('%', str_split($superCleanKeyword)) . '%' : "%$superCleanKeyword%";

        $query->orderByRaw("
            CASE 
                WHEN LOWER(REGEXP_REPLACE(username, '[^a-zA-Z0-9]', '')) = ? THEN 1
                WHEN LOWER(REGEXP_REPLACE(email, '[^a-zA-Z0-9]', '')) = ? THEN 2
                WHEN role = ? THEN 3
                WHEN username LIKE ? THEN 4
                WHEN SOUNDEX(username) = SOUNDEX(?) THEN 5
                ELSE 6 
            END ASC", 
            [$superCleanKeyword, $superCleanKeyword, $searchAll, $fuzzyPattern, $searchAll]
        );
    } 

    switch ($sort) {
        case 'latest_id':
            $query->orderBy('user_id', 'desc'); 
            break;
        case 'oldest_id':
            $query->orderBy('user_id', 'asc');
            break;
        case 'az':
            $query->orderBy('username', 'asc');
            break;
        case 'za':
            $query->orderBy('username', 'desc');
            break;
        case 'admin_first':
            $query->orderByRaw("CASE WHEN role = 'admin' THEN 1 ELSE 2 END ASC")
                  ->orderBy('username', 'asc');
            break;
        case 'siswa_first':
            $query->orderByRaw("CASE WHEN role = 'siswa' THEN 1 ELSE 2 END ASC")
                  ->orderBy('username', 'asc');
            break;
        default:
            $query->orderBy('username', 'asc');
            break;
    }

    $allMembers = $query->get();

    $searchFine = $request->query('search_fine');

    $sortFine = $request->query('sort_fine', 'newest_id');

    $membersWithFines = UserFineBalance::with('user')
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
                $due = Carbon::parse($loan->due_date);
                $diffInSeconds = $due->diffInSeconds($now);
                
                $days = ceil($diffInSeconds / 86400); 

                $fineAmount = 0;
                if ($days >= 1) $fineAmount += 10000;
                if ($days > 1) $fineAmount += ($days - 1) * 5000;

                $totalFine += $fineAmount;
                $totalSeconds += $diffInSeconds;
                $totalBooks += 1;
            }

            $balance->realtime_fine = max(0, $totalFine); 

            $balance->realtime_books = $totalBooks;
            $balance->realtime_seconds = $totalSeconds;
            $balance->realtime_days = ceil($totalSeconds / 86400);
            
            return $balance;
        })
        
        ->filter(function ($item) use ($sortFine, $searchFine) {
            if ($item->realtime_fine <= 0) return false;

            if (str_contains($sortFine, 'books_')) {
                $range = explode('_', $sortFine);
                if ($range[1] == 'gt100') {
                    if ($item->realtime_books <= 100) return false;
                } else {
                    if ($item->realtime_books < $range[1] || $item->realtime_books > $range[2]) return false;
                }
            }

            if (str_contains($sortFine, 'days_')) {
                $range = explode('_', $sortFine);
                if ($range[1] == 'gt100') {
                    if ($item->realtime_days <= 100) return false;
                } else {
                    if ($item->realtime_days < $range[1] || $item->realtime_days > $range[2]) return false;
                }
            }

            if (str_contains($sortFine, 'money_')) {
                $range = explode('_', $sortFine);
                if ($range[1] == 'gt500') {
                    if ($item->realtime_fine <= 500000) return false;
                } else {
                    if ($item->realtime_fine < ($range[1] * 1000) || $item->realtime_fine > ($range[2] * 1000)) return false;
                }
            }


            if (!$searchFine) return true;

                $keyword = strtolower(trim($searchFine));
                $superClean = preg_replace('/[^a-z0-9]/', '', $keyword);
                
                if (preg_match('/\d+/', $keyword, $matches)) {
                    $num = (int)$matches[0];
                    if (str_contains($keyword, 'book') || str_contains($keyword, 'buku')) {
                        if (abs($item->realtime_books - $num) <= 5) return true;
                    }
                    if (str_contains($keyword, 'day') || str_contains($keyword, 'hari')) {
                        if (abs($item->realtime_days - $num) <= 10) return true;
                    }
                    $cleanMoneyInput = (int)preg_replace('/[^0-9]/', '', $keyword);
                    if ($cleanMoneyInput >= 1000) {
                        if (abs($item->realtime_fine - $cleanMoneyInput) <= 50000) return true;
                    }
                }
                if (!$item->user) return false;

                $originalName = strtolower($item->user->username);
                $originalEmail = strtolower($item->user->email);

                return (str_contains($originalName, $keyword) || 
                    str_contains($originalEmail, $keyword) || 
                    str_contains(preg_replace('/[^a-z0-9]/', '', $originalName), $superClean) ||
                    soundex($item->user->username) == soundex($keyword));
            });
            switch ($sortFine) {
                case 'oldest_id':
                    $membersWithFines = $membersWithFines->sortBy('user_id');
                    break;
                case 'az':
                    $membersWithFines = $membersWithFines->sortBy(fn($m) => strtolower($m->user->username));
                    break;
                case 'za':
                    $membersWithFines = $membersWithFines->sortByDesc(fn($m) => strtolower($m->user->username));
                    break;
                case 'newest_id':
                default:
                    $membersWithFines = $membersWithFines->sortByDesc('user_id');
                    break;
            }

            $membersWithFines = $membersWithFines->values();

        return view('Admin.ManageMembers', compact('allMembers', 'membersWithFines'));
    }



    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|min:4|alpha_dash|unique:all_library_users,username',
            'email' => 'required|email|unique:all_library_users,email|regex:/^[a-zA-Z0-9._%+-]+@gmail\.com$/i',
            'password' => 'required|min:6|regex:/^\S*$/',
            'role' => 'required|in:admin,siswa'
        ], [
            'username.required' => 'Username tidak boleh dikosongkan.',
            'username.min' => 'Username terlalu pendek (Minimal 4 karakter).',
            'username.alpha_dash' => 'Username tidak boleh mengandung spasi.',
            'username.unique' => 'Username sudah digunakan oleh orang lain.',
            
            'email.required' => 'Email tidak boleh kosong.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'email.regex' => 'Email harus menggunakan domain @gmail.com dan tidak mengandung spasi.',

            'password.required' => 'Password tidak boleh dikosongkan.',
            'password.min' => 'Password minimal 6 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'password.regex' => 'Password tidak boleh mengandung spasi.',
            
            'role.required' => 'Pilih role terlebih dahulu (Admin/Siswa).'
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput(); 
                
        }

        try {
            DB::beginTransaction();

            $user = User::create([
                'username'     => $request->username,
                'email'        => $request->email,
                'password'     => $request->password, 
                'role'         => $request->role,     
                'foto_profile' => null,               
            ]);

            UserFineBalance::create([
                'user_id'               => $user->user_id,
                'total_fine'            => 0,
                'total_overdue_seconds' => 0,
                'total_overdue_books'   => 0,
            ]);

            DB::commit();

            return back()->with('success', 'User ' . $request->username . ' berhasil ditambahkan.');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Gagal menambah user: ' . $e->getMessage());
        }
    }


    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'username' => [
                'required', 
                'min:4', 
                'alpha_dash', 
                Rule::unique('all_library_users', 'username')->ignore($id, 'user_id')
            ],
            'role' => 'required|in:admin,siswa'
        ], [
            'username.required' => 'Username tidak boleh dikosongkan.',
            'username.min' => 'Username minimal 4 karakter.',
            'username.alpha_dash' => 'Username tidak boleh mengandung spasi.',
            'username.unique' => 'Username sudah digunakan oleh orang lain.',
            'role.required' => 'Pilih role terlebih dahulu.'
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput()
                ->with('openEditModal', $id); 
        }

        try {
            DB::beginTransaction();

            $user = User::findOrFail($id);

            $user->update([
                'username' => $request->username,
                'role'     => $request->role,
            ]);

            DB::commit();

            return back()->with('success', 'Data user ' . $request->username . ' berhasil diperbarui.');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Gagal memperbarui user: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $user = User::findOrFail($id);

            \App\Models\FineLog::where('user_id', $id)->delete();
            \App\Models\UserFineBalance::where('user_id', $id)->delete();

            \App\Models\Wishlist::where('user_id', $id)->delete();
            \App\Models\Review::where('user_id', $id)->delete();

            \App\Models\Loan::where('user_id', $id)->delete();

            $user->delete();

            DB::commit();

            return back()->with('success', 'User ' . $user->username . ' beserta seluruh riwayat, denda, ulasan, dan wishlist telah dihapus secara permanen.');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Gagal menghapus member: ' . $e->getMessage());
        }
    }

    public function payFine(Request $request, $id)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0',
        ]);

        try {
            DB::beginTransaction();

            $balance = UserFineBalance::where('user_id', $id)->lockForUpdate()->firstOrFail();
            $paymentAmount = $request->amount;
            $now = Carbon::now('Asia/Jakarta');

            $overdueLoans = Loan::where('user_id', $id)
                ->where('status', 'borrowed')
                ->where('due_date', '<', $now->toDateTimeString())
                ->get();

            $runningFine = 0;
            foreach ($overdueLoans as $loan) {
                $due = Carbon::parse($loan->due_date);
                $diffInSeconds = $due->diffInSeconds($now);
                $days = ceil($diffInSeconds / 86400); 
                
                $fine = 0;
                if ($days >= 1) $fine += 10000;
                if ($days > 1) $fine += ($days - 1) * 5000;
                $runningFine += $fine;
            }

            $totalRealtimeFine = $balance->total_fine + $runningFine;
            
            $balance->total_fine -= $paymentAmount;


            if ($paymentAmount >= $totalRealtimeFine) {
                $loansToReturn = Loan::where('user_id', $id)
                    ->where('status', 'borrowed')
                    ->where('due_date', '<', $now->toDateTimeString())
                    ->get();

                foreach ($loansToReturn as $loan) {
                    $due = Carbon::parse($loan->due_date);
                    $diff = $due->diffInSeconds($now);
                    $days = ceil($diff / 86400);

                    $fineAmount = 0;
                    if ($days >= 1) $fineAmount += 10000;
                    if ($days > 1) $fineAmount += ($days - 1) * 5000;

                    FineLog::create([
                        'user_id' => $id,
                        'loan_id' => $loan->id,
                        'book_title' => $loan->book->title ?? 'Buku',
                        'final_fine_amount' => $fineAmount,
                        'calculated_at' => $now,
                    ]);

                    $loan->update([
                        'status' => 'returned',
                        'return_date' => $now->toDateTimeString(),
                    ]);
                }

                $balance->total_fine = 0; 
                $balance->total_overdue_seconds = 0;
                $balance->total_overdue_books = 0;
            }


            $balance->save();
            DB::commit();

            return back()->with('success', 'Pembayaran Rp' . number_format($paymentAmount, 0, ',', '.') . ' berhasil.');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Gagal: ' . $e->getMessage());
        }
    }

    private function calculateCurrentTotalFine($balance) {
        $now = Carbon::now('Asia/Jakarta');
        $runningFine = 0;
        $runningLoans = Loan::where('user_id', $balance->user_id)
            ->where('status', 'borrowed')
            ->where('due_date', '<', $now->toDateTimeString())
            ->get();

        foreach ($runningLoans as $loan) {
            $due = Carbon::parse($loan->due_date);
            $days = ceil($due->diffInSeconds($now) / 86400); 
            if ($days >= 1) $runningFine += 10000;
            if ($days > 1) $runningFine += ($days - 1) * 5000;
        }
        return $balance->total_fine + $runningFine;
    }


    public function payOffFine($id)
    {
        try {
            DB::beginTransaction();

            $balance = UserFineBalance::where('user_id', $id)->lockForUpdate()->firstOrFail();
            $now = Carbon::now('Asia/Jakarta');

            $loansToClear = Loan::where('user_id', $id)
                ->where('status', 'borrowed')
                ->where('due_date', '<', $now->toDateTimeString())
                ->get();

            foreach ($loansToClear as $loan) {
                $due = Carbon::parse($loan->due_date);
                $days = ceil($due->diffInSeconds($now) / 86400);
                $fineAmount = 0;
                if ($days >= 1) $fineAmount += 10000;
                if ($days > 1) $fineAmount += ($days - 1) * 5000;

                FineLog::create([
                    'user_id' => $id,
                    'loan_id' => $loan->id,
                    'book_title' => $loan->book->title ?? 'Buku',
                    'final_fine_amount' => $fineAmount,
                    'calculated_at' => $now,
                ]);

                $loan->update([
                    'status' => 'returned',
                    'return_date' => $now->toDateTimeString(),
                ]);
            }

            $balance->update([
                'total_fine' => 0,
                'total_overdue_seconds' => 0,
                'total_overdue_books' => 0
            ]);

            DB::commit();
            return back()->with('success', 'Seluruh denda berhasil dilunasi/diputihkan.');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Gagal: ' . $e->getMessage());
        }
    }
}