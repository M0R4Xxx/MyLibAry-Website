<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Wishlist;
use App\Models\Loan;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class BorrowController extends Controller
{
    public function store(Request $request, $book_id)
    {
        $request->validate([
            'due_date' => 'required|date|after:today',
        ]);

        $user = Auth::user();
        $user_id = $user->user_id; 

        $cekPinjam = Loan::where('user_id', $user_id)
                        ->where('book_id', $book_id)
                        ->whereIn('status', ['borrowed', 'pending']) 
                        ->first();

        if ($cekPinjam) {
            $msg = $cekPinjam->status == 'pending' ? 'Permintaan sedang menunggu persetujuan admin!' : 'Buku ini sedang Anda pinjam!';
            return redirect()->back()->with('error', $msg);
        }

        $now = Carbon::now('Asia/Jakarta');
        $dueDatePrecise = Carbon::parse($request->due_date, 'Asia/Jakarta')->setTime($now->hour, $now->minute, $now->second);

        Loan::create([
            'user_id'   => $user_id,
            'book_id'   => $book_id,
            'loan_date' => $now, 
            'due_date'  => $dueDatePrecise,
            'status'    => 'pending', 
        ]);

        return redirect()->route('siswa.borrowed')->with('success', 'Permintaan pinjam berhasil dikirim! Silahkan tunggu konfirmasi Admin.');
    }

    public function index()
    {
        $user = Auth::user();
        
        $borrowedBooks = Loan::with('book')
            ->where('user_id', $user->user_id)
            ->whereIn('status', ['borrowed', 'pending', 'rejected'])
            ->latest()
            ->get();

        $wishlists = $user->wishlists()
            ->inRandomOrder() 
            ->take(5)         
            ->get();

        return view('Siswa.BorrowedBooks', compact('borrowedBooks', 'wishlists'));
    }
}