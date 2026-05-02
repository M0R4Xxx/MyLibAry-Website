<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index()
    {
        
        $books = Book::inRandomOrder()->take(4)->get();

        return view('welcome', compact('books'));
    }
}