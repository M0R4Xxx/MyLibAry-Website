<?php

namespace App\Http\Controllers;

use App\Models\Book; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->query('category');
        $search = $request->query('search'); 
        
        $query = Book::query();

        if ($category && $category !== 'All Books') {
            $query->where('category_name', 'LIKE', '%' . $category . '%');
        }


            if ($search) {
                $keyword = strtolower(trim($search));
                $superCleanKeyword = preg_replace('/[^a-z0-9]/', '', $keyword);
                $cleanWithSpace = preg_replace('/[^a-z0-9 ]/', '', $keyword);
                $words = array_filter(explode(' ', $cleanWithSpace));

                $query->where(function($q) use ($words, $superCleanKeyword, $search) {
                    $columns = ['title', 'author_name', 'category_name'];

                    foreach ($columns as $col) {
                        $q->orWhere($col, 'LIKE', "%$search%");
                    }

                    foreach ($columns as $col) {
                        $q->orWhere(DB::raw("LOWER(REGEXP_REPLACE($col, '[^a-zA-Z0-9]', ''))"), 'LIKE', "%$superCleanKeyword%");
                    }

                    foreach ($words as $word) {
                        if (strlen($word) < 2) continue;
                        foreach ($columns as $col) {
                            $q->orWhereRaw("SOUNDEX($col) = SOUNDEX(?)", [$word]);
                            $q->orWhere(DB::raw("LOWER(REGEXP_REPLACE($col, '[^a-zA-Z0-9]', ''))"), 'LIKE', "%$word%");
                        }
                    }
                });

                $fuzzyPattern = strlen($superCleanKeyword) > 3 ? '%' . implode('%', str_split($superCleanKeyword)) . '%' : "%$superCleanKeyword%";

                $query->orderByRaw("
                    CASE 
                        -- Prioritas 1: Kecocokan PERSIS (Sangat Tinggi)
                        WHEN LOWER(REGEXP_REPLACE(title, '[^a-zA-Z0-9]', '')) = ? THEN 1
                        WHEN LOWER(REGEXP_REPLACE(author_name, '[^a-zA-Z0-9]', '')) = ? THEN 2
                        WHEN LOWER(REGEXP_REPLACE(category_name, '[^a-zA-Z0-9]', '')) = ? THEN 3
                        
                        -- Prioritas 2: Fuzzy Match (Menangani typo parah seperti 'Natasa')
                        WHEN LOWER(REGEXP_REPLACE(author_name, '[^a-zA-Z0-9]', '')) LIKE ? THEN 4
                        WHEN LOWER(REGEXP_REPLACE(title, '[^a-zA-Z0-9]', '')) LIKE ? THEN 5
                        
                        -- Prioritas 3: Kata kunci utuh di Judul
                        WHEN title LIKE ? THEN 6
                        
                        -- Prioritas 4: Kemiripan Bunyi (Typo fonetik)
                        WHEN SOUNDEX(author_name) = SOUNDEX(?) THEN 7
                        WHEN SOUNDEX(title) = SOUNDEX(?) THEN 8
                        
                        ELSE 9 
                    END ASC", 
                    [
                        $superCleanKeyword, // 1
                        $superCleanKeyword, // 2
                        $superCleanKeyword, // 3
                        $fuzzyPattern,      // 4
                        $fuzzyPattern,      // 5
                        "%$search%",        // 6
                        $search,            // 7
                        $search             // 8
                    ]
                );

                $query->orderByRaw("LENGTH(title) ASC");
            }

        
        $books = $query->paginate(30)->withQueryString();

        $wishlistBookIds = [];


        $wishlistBookIds = [];
        if (Auth::check()) {
            $wishlistBookIds = DB::table('wishlists')
                ->where('user_id', Auth::id()) 
                ->pluck('book_id')
                ->toArray();
        }

        return view('Siswa.Libary', compact('books', 'wishlistBookIds'));
    }
}