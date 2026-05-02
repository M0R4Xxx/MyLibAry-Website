<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WishlistController extends Controller
{
    public function toggle(Book $book)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['message' => 'Silakan login terlebih dahulu'], 401);
        }

        $wishlist = \App\Models\Wishlist::where('user_id', $user->user_id)
                            ->where('book_id', $book->id)
                            ->first();

        if ($wishlist) {
            $wishlist->delete();
            $status = 'removed';
        } else {
            \App\Models\Wishlist::create([
                'user_id' => $user->user_id,
                'book_id' => $book->id
            ]);
            $status = 'added';
        }

        return response()->json([
            'status' => $status,
            'message' => $status === 'added' ? 'Berhasil disimpan' : 'Dihapus dari wishlist'
        ]);
    }

    public function index(Request $request)
    {
        $user = Auth::user();
        
        if (!$user) {
            return redirect()->route('login');
        }

        $wishlistBookIds = Wishlist::where('user_id', $user->user_id)
            ->pluck('book_id')
            ->toArray();


        $currentlyBorrowedIds = \App\Models\Loan::where('user_id', $user->user_id)
            ->where('status', 'borrowed')
            ->pluck('book_id')
            ->toArray();

        $books = Book::whereNotIn('id', $wishlistBookIds)
            ->whereNotIn('id', $currentlyBorrowedIds)
            ->inRandomOrder()
            ->take(5)
            ->get();


        if ($books->count() < 5) {
            $books = Book::whereNotIn('id', $currentlyBorrowedIds)
                ->inRandomOrder()
                ->take(5)
                ->get();
        }

        $totalKeseluruhan = \App\Models\Wishlist::where('user_id', $user->user_id)->count();

        $category = $request->query('category');
        $search = $request->query('search');

        $query = \App\Models\Wishlist::where('wishlists.user_id', $user->user_id)
        ->join('books', 'wishlists.book_id', '=', 'books.id')
        ->select(
            'books.id', 
            'books.title', 
            'books.author_name', 
            'books.category_name', 
            'books.cover_image',
            'books.total_pages', 
            'wishlists.created_at as added_at'
        );

        if ($category && $category !== 'All Books') {
            $query->where('books.category_name', 'LIKE', '%' . $category . '%');
        }

        if ($search) {
            $keyword = strtolower(trim($search));
            
            $superCleanKeyword = preg_replace('/[^a-z0-9]/', '', $keyword); 
            $cleanWithSpace = preg_replace('/[^a-z0-9 ]/', '', $keyword);
            $words = array_filter(explode(' ', $cleanWithSpace));

            $query->where(function($q) use ($words, $superCleanKeyword, $search) {
                $columns = ['books.title', 'books.author_name', 'books.category_name'];

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
                    -- Prioritas 1: Kecocokan PERSIS (Abaikan simbol)
                    WHEN LOWER(REGEXP_REPLACE(books.title, '[^a-zA-Z0-9]', '')) = ? THEN 1
                    WHEN LOWER(REGEXP_REPLACE(books.author_name, '[^a-zA-Z0-9]', '')) = ? THEN 2
                    WHEN LOWER(REGEXP_REPLACE(books.category_name, '[^a-zA-Z0-9]', '')) = ? THEN 3
                    
                    -- Prioritas 2: Fuzzy Match (Typo urutan huruf)
                    WHEN LOWER(REGEXP_REPLACE(books.author_name, '[^a-zA-Z0-9]', '')) LIKE ? THEN 4
                    WHEN LOWER(REGEXP_REPLACE(books.title, '[^a-zA-Z0-9]', '')) LIKE ? THEN 5
                    
                    -- Prioritas 3: Kata kunci utuh di judul
                    WHEN books.title LIKE ? THEN 6
                    
                    -- Prioritas 4: Kemiripan Bunyi (Soundex)
                    WHEN SOUNDEX(books.author_name) = SOUNDEX(?) THEN 7
                    WHEN SOUNDEX(books.title) = SOUNDEX(?) THEN 8
                    
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
        } else {
            $query->orderBy('wishlists.created_at', 'desc');
        }

        $query->orderByRaw("LENGTH(books.title) ASC");

        $wishlists = $query->paginate(20)->withQueryString();

       return view('Siswa.Wishlist', compact('wishlists', 'totalKeseluruhan', 'books', 'wishlistBookIds'));
    }
    
}