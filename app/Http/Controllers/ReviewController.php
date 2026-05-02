<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request, $id)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
        ]);

        $user = Auth::guard('siswa')->user() ?? Auth::guard('web')->user();

        if (!$user) {
            return redirect()->route('login'); 
        }

        $firstReview = Review::where('book_id', $id)
                         ->where('user_id', $user->user_id)
                         ->first();

    $finalRating = $firstReview ? $firstReview->rating : $request->rating;

    Review::create([
        'book_id' => $id,
        'user_id' => $user->user_id,
        'rating'  => $finalRating, 
        'comment' => $request->comment,
    ]);

    return back();
}
}