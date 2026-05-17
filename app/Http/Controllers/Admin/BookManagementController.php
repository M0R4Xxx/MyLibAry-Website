<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class BookManagementController extends Controller
{

    public function index(Request $request)
    {
    $category = $request->query('category');
    $search = $request->query('search'); 
    $sort = $request->query('sort'); 
    
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

        
        if ($sort) {
            switch ($sort) {
                case 'az': 
                    $query->orderByRaw("title REGEXP '^[a-zA-Z]' DESC") 
                          ->orderBy('title', 'asc');                   
                    break;

                case 'za': 
                    $query->orderByRaw("title REGEXP '^[a-zA-Z]' DESC") 
                          ->orderBy('title', 'desc'); 
                    break;

                case 'oldest_id': 
                    $query->orderBy('books.id', 'asc'); 
                    break;

                case 'latest_id': 
                    $query->orderBy('books.id', 'desc'); 
                    break;
                    
                case 'most_borrowed': 
                    $query->withCount('loans')
                        ->orderByDesc('loans_count'); 
                    break;
            }
        }
        
        
      if (!$search && !$sort) {
            $query->orderByDesc('books.id');
        }


    $books = $query->paginate(30)->withQueryString();

       $categories = Book::whereNotNull('category_name')
        ->where('category_name', '!=', '')
        ->pluck('category_name')
        ->map(function ($item) {
            $clean = preg_replace('/[^a-zA-Z0-9 &\-]/', '', $item);
            
            return trim($clean);
        })
        ->filter()
        ->unique(function ($item) {
            return strtolower($item);
        })
        ->sort()
        ->values();


        $authors = Book::whereNotNull('author_name')
            ->where('author_name', '!=', '')
            ->pluck('author_name')
            ->flatMap(function ($item) {
                return explode(',', $item);
            })
            ->map(function ($name) {
                return trim($name); 
            })
            ->filter() 
            ->unique() 
            ->sort()
            ->values();

        $tags = Book::whereNotNull('tags')
            ->where('tags', '!=', '')
            ->pluck('tags')
            ->flatMap(function ($item) {
                return explode(',', $item);
            })
            ->map(function ($tag) {
                return trim($tag); 
            })
            ->filter() 
            ->unique(function ($item) {
                return strtolower($item); 
            })
            ->sort()
            ->values();

            

            return view('Admin.ManageBooks', compact('books', 'categories', 'authors', 'tags'));
        }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:100', // max 100
            'author_name' => 'required|string|max:50', // max 50
            'category_name' => 'required|string|max:40', // max 40
            'summary' => 'required|string|max:1500', // max 1500
            'total_pages' => 'required|integer|min:1|max:1000', // min 1 max 1000
            'published_date' => 'required|date',
            'tags' => 'required|string|max:225',
            'cover_image' => 'required|url|max:225',
            'publisher' => 'required|string|max:50', // max 50
        ]);

        try {
            $formattedDate = Carbon::parse($validated['published_date'])->format('d F Y');

            Book::create([
                'title'          => $validated['title'],
                'author_name'    => $validated['author_name'],
                'category_name'  => $validated['category_name'],
                'summary'        => $validated['summary'],
                'total_pages'    => $validated['total_pages'] . ' pages',
                'published_date' => $formattedDate,
                'tags'           => $validated['tags'],
                'cover_image'    => $validated['cover_image'],
                'publisher'      => $validated['publisher'], 
                'api_id'         => 'MANUAL_' . time(),
            ]);

            return redirect()->back()->with('success', 'New book asset registered successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to register asset: ' . $e->getMessage());
        }
    }

    public function checkTitle(Request $request)
    {
        $exists = \App\Models\Book::where('title', $request->title)->exists();
        return response()->json(['exists' => $exists]);
    }



    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:100',
            'author_name' => 'required|string|max:50',
            'category_name' => 'required|string|max:40',
            'summary' => 'required|string|max:1500',
            'total_pages' => 'required|integer|min:1|max:1000',
            'published_date' => 'required|date',
            'tags' => 'required|string|max:225',
            'cover_image' => 'required|url|max:225',
            'publisher' => 'required|string|max:50',
        ]);

        try {
            $formattedDate = \Carbon\Carbon::parse($validated['published_date'])->format('d F Y');

            $book->update([
                'title'          => $validated['title'],
                'author_name'    => $validated['author_name'],
                'category_name'  => $validated['category_name'],
                'summary'        => $validated['summary'],
                'total_pages'    => $validated['total_pages'] . ' pages', 
                'published_date' => $formattedDate,
                'tags'           => $validated['tags'],
                'cover_image'    => $validated['cover_image'],
                'publisher'      => $validated['publisher'],
            ]);

            return redirect()->back()->with('success', 'Book asset updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Update failed: ' . $e->getMessage());
        }
    }


    public function destroy(Book $book)
    {
        try {
            $book->delete();

            return redirect()->back()->with('success', 'Book asset deleted permanently!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete asset: ' . $e->getMessage());
        }
    }
}