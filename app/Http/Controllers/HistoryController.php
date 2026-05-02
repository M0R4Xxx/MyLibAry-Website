<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Book;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    public function index()
    {
        $userId = Auth::user()->user_id;

        $histories = Loan::with('book')
            ->where('user_id', $userId)
            ->where('status', 'returned')
            ->orderBy('return_date', 'desc')
            ->paginate(10); 

           $totalRecords = $histories->total();


                $currentlyBorrowedIds = Loan::where('user_id', $userId)
                    ->where('status', 'borrowed')
                    ->pluck('book_id')
                    ->toArray();

                $wishlistBookIds = Wishlist::where('user_id', $userId)
                    ->pluck('book_id')
                    ->toArray();

                
                $books = Book::whereNotIn('id', $currentlyBorrowedIds)
                    ->inRandomOrder()
                    ->take(5)
                    ->get();

                return view('Siswa.History', compact('histories', 'totalRecords', 'books', 'wishlistBookIds'));
            }

    public function destroy($id)
    {
        $userId = Auth::user()->user_id;

        $loan = Loan::where('id', $id)->where('user_id', $userId)->firstOrFail();

        $loan->delete();

        return redirect()->back()->with('success', 'Riwayat telah disembunyikan dari daftar Anda.');
    }
}