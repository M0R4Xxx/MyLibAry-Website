<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Book;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReturnController extends Controller
{

    public function index()
    {
        $userId = Auth::id();

        $activeLoans = Loan::with('book')
            ->where('user_id', $userId) 
            ->where('status', 'borrowed')
            ->latest() 
            ->get();


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

        return view('Siswa.ReturnBook', compact('activeLoans', 'books', 'wishlistBookIds'));
    }
}