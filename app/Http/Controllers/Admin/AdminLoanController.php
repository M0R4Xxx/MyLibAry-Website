<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Loan;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class AdminLoanController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        return [
            new Middleware(function ($request, $next) {
                if (Auth::user()->role !== 'admin' || session('login_via') !== 'admin') {
                    return redirect()->route('siswa.dashboard')->with('error', 'Akses Admin ditolak.');
                }
                return $next($request);
            }),
        ];
    }

    public function index()
    {
        $pendingLoans = Loan::with(['user', 'book'])
            ->where('status', 'pending')
            ->latest()
            ->get();

        return view('Admin.PendingLoans', compact('pendingLoans'));
    }

    public function approve($id)
    {
        try {
            DB::beginTransaction();

            $loan = Loan::findOrFail($id);
            $now = Carbon::now('Asia/Jakarta');
            
            $requestTime = Carbon::parse($loan->created_at);
            $targetReturnTime = Carbon::parse($loan->due_date);
            $durationInSeconds = $requestTime->diffInSeconds($targetReturnTime);
            if ($durationInSeconds <= 0) {
                $durationInSeconds = 86400; 
            }
            $newDueDate = $now->copy()->addSeconds($durationInSeconds);

            $loan->update([
                'status' => 'borrowed',
                'loan_date' => $now, 
                'due_date' => $newDueDate,
            ]);

            DB::commit();
            return redirect()->back()->with('success', 'Peminjaman disetujui. Durasi peminjaman disesuaikan secara adil.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function reject($id)
    {
        try {
            $loan = Loan::findOrFail($id);
            
            $loan->update([
                'status' => 'rejected'
            ]);

            return redirect()->back()->with('info', 'Permintaan peminjaman telah ditolak.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}