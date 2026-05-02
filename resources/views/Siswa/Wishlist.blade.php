<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>MyLibAry. | My Wishlist</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Plus+Jakarta+Sans:wght@700;800&family=Montserrat:wght@500;700;900&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Plus+Jakarta+Sans:wght@700;800&family=Montserrat:wght@500;700;900&family=Space+Grotesk:wght@300;500;700&display=swap" rel="stylesheet" />
    <style type="text/tailwindcss">
        :root {
            --bg-silver: #F8F9FC;
            --primary-blue: #e11d48;
        }
        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-silver);
            background-image: 
                radial-gradient(at 0% 0%, rgba(43, 108, 238, 0.05) 0px, transparent 50%),
                radial-gradient(at 100% 0%, rgba(43, 108, 238, 0.03) 0px, transparent 50%);
        }
        h1, h2, h3, .font-heading {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .font-accent {
            font-family: 'Montserrat', sans-serif;
        }

        .font-modern {
            font-family: 'Space Grotesk', sans-serif !important;
        }

        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .hover-up {
            @apply transition-all duration-300 ease-out;
        }
        .hover-up:hover {
            transform: translateY(-8px);
            @apply shadow-xl shadow-rose-900/10;
        }
        .book-card-3d {
            transition: transform 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
        }
        .book-card-3d:hover {
            transform: translateY(-8px);
        }
        .glass-nav {
            backdrop-filter: blur(16px);
            background-color: rgba(255, 255, 255, 0.85);
        }
        .text-gradient {
            background: linear-gradient(to right, #1a1a1a, #e11d48);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .category-chip {
            transition: all 0.2s ease;
            white-space: nowrap;
        }
        .category-chip.active {
            @apply bg-rose-600 text-white border-rose-600 shadow-none !important;
        }
        .category-chip:not(.active):hover {
            @apply border-rose-600 -translate-y-1 text-rose-600 bg-white;
        }

        .hover-up {
            @apply transition-all duration-300 ease-out;
        }
        .hover-up:hover {
            transform: translateY(-8px);
            @apply shadow-xl shadow-blue-900/10;
        }
        .book-card-3d {
            transition: transform 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
        }
        .book-card-3d:hover {
            transform: translateY(-8px);
        }


        input:-webkit-autofill,
        input:-webkit-autofill:hover, 
        input:-webkit-autofill:focus {
            transition: background-color 5000s ease-in-out 0s, box-shadow 5000s ease-in-out 0s;
            
            -webkit-text-fill-color: #334155 !important;
        }

        input:-internal-autofill-selected {
            background-color: white !important;
        }
    </style>
</head>
<body class="text-slate-800 min-h-screen flex flex-col relative overflow-x-hidden">
    <div class="absolute top-0 right-0 -z-10 w-[500px] h-[500px] bg-blue-100/30 rounded-full blur-[120px] -translate-y-1/2 translate-x-1/2"></div>

    <nav class="sticky top-0 z-[100] glass-nav border-b border-slate-200">
        <div class="max-w-full mx-auto px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <div class="flex items-center gap-2 flex-shrink-0 cursor-pointer" onclick="window.location.href='{{ route('siswa.dashboard') }}'">
                    <span class="material-symbols-outlined text-blue-600 text-3xl font-bold">auto_stories</span>
                    <span class="text-2xl font-black tracking-tighter text-slate-900 font-heading">My<span class="text-blue-600 italic">LibAry.</span></span>
                </div>

                <div class="hidden md:flex items-center space-x-8 flex-shrink-0 font-accent uppercase tracking-wider text-[11px]">
                    <a class="font-bold text-slate-500 hover:text-blue-600 transition-all hover:-translate-y-1" href="{{ route('siswa.dashboard') }}">Dashboard</a>
                    <a class="font-bold text-slate-500 hover:text-blue-600 transition-all hover:-translate-y-1" href="{{ route('siswa.library') }}">Library</a>
                    <a class="font-bold text-slate-500 hover:text-blue-600 transition-all hover:-translate-y-1" href="{{ route('siswa.return') }}">Return</a>
                    <a class="font-bold text-slate-500 hover:text-blue-600 transition-all hover:-translate-y-1" href="{{ route('siswa.history') }}">History</a>
                    <a class="font-black text-blue-600 border-b-2 border-blue-600 py-2 transition-all" href="{{ route('siswa.wishlist') }}">Wishlist</a>
                    <a class="font-bold text-slate-500 hover:text-blue-600 transition-all hover:-translate-y-1" href="{{ route('siswa.borrowed') }}">Your Books</a>
                    <a class="font-bold text-slate-500 hover:text-blue-600 transition-all hover:-translate-y-1" href="{{ route('siswa.fines') }}">Arrears</a>
                    @if(auth()->user()->role === 'admin' && session('login_via') === 'admin')
                        <a class="font-bold text-slate-500 hover:text-blue-600 transition-all hover:-translate-y-1 flex items-center gap-1" href="{{ route('admin.dashboard') }}">
                            <span class="material-symbols-outlined text-[16px]">admin_panel_settings</span>
                            Admin Panel
                        </a>
                    @endif
                    
                    <div class="flex items-center gap-3 pl-6 border-l border-slate-300 ml-4">
                        <div class="flex items-center gap-3 cursor-pointer group/profile" onclick="window.location.href='{{ route('siswa.profile') }}'">
                            <div class="h-9 w-9 rounded-full bg-blue-600 flex items-center justify-center text-white text-[10px] font-black shadow-lg ring-4 ring-white overflow-hidden">
                                @if(auth()->user()->foto_profile)
                                    <img src="{{ asset('storage/' . auth()->user()->foto_profile) }}?t={{ time() }}" class="w-full h-full object-cover">
                                @else
                                    {{ strtoupper(substr(auth()->user()->username, 0, 2)) }}
                                @endif
                            </div>
                            <div class="flex flex-col transition-all duration-300 group-hover/profile:-translate-y-1">
                                <span class="text-[13px] font-bold text-slate-800 normal-case leading-none group-hover/profile:text-blue-600 transition-colors">
                                    {{ auth()->user()->username }}
                                </span>
                                <span class="text-[9px] text-blue-600 font-black mt-1 uppercase">
                                    @if(auth()->user()->isAdmin())
                                        Administrator
                                    @else
                                        Student
                                    @endif
                                </span>
                            </div>
                        </div>
                        <div onclick="window.location.href='{{ route('chat.index') }}'" 
                            class="ml-2 h-9 w-9 flex items-center justify-center rounded-lg border border-slate-200 bg-white shadow-sm cursor-pointer transition-all duration-300 
                            hover:border-blue-600 hover:-translate-y-1 hover:shadow-md hover:shadow-blue-600/20 active:scale-90 group/chat">
                            
                            <span class="material-symbols-outlined text-slate-400 transition-colors duration-300 group-hover/chat:text-blue-600 text-[18px]">
                                chat_bubble
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <main class="flex-grow max-w-7xl mx-auto px-6 lg:px-12 py-10 relative">
        <header class="mb-14 relative flex flex-col lg:flex-row justify-between lg:items-center gap-8">
            <div class="relative">
                <div class="absolute -left-6 top-0 w-1 h-20 bg-rose-600 rounded-full"></div>
                
                <div class="flex items-center gap-5 mb-3">
                    <h1 class="text-6xl font-extrabold tracking-tighter text-slate-900 font-heading leading-none">
                        My<span class="text-transparent bg-clip-text bg-gradient-to-r from-slate-900 via-rose-600 to-pink-500 italic font-heading"> Wishlist.</span>
                    </h1>

                    <div class="flex items-center gap-3 group cursor-default pt-2">
                        <div class="flex items-center justify-center w-10 h-10 rounded-xl bg-rose-500 text-white shadow-lg shadow-rose-500/20 shrink-0 transition-all duration-300 group-hover:rotate-12 group-hover:scale-110">
                            <span class="material-symbols-outlined text-xl">
                                favorite
                            </span>
                        </div>

                        <div class="flex flex-col justify-center">
                            <span class="font-accent text-[9px] font-black uppercase tracking-[0.2em] text-rose-600/60 leading-none mb-1">
                                Total
                            </span>

                            <div class="flex flex-col">
                                <span class="font-heading font-black text-2xl leading-none text-transparent bg-clip-text bg-gradient-to-r from-rose-600 to-pink-500 drop-shadow-sm">
                                    {{ $totalKeseluruhan }}
                                </span>
                                
                                <span class="font-modern text-[11px] font-bold text-slate-500 uppercase tracking-[0.1em] mt-1 leading-none">
                                    Books
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
        
            <p class="text-slate-500 font-medium text-lg leading-relaxed max-w-2xl border-l-0 font-modern">
                Your personal collection of books to read next.
            </p>
        </div>
            
           <div class="w-full lg:max-w-2xl relative group">
                {{-- 1. Menambahkan class 'group' pada form agar bisa dideteksi saat elemen di dalamnya (input/button) aktif --}}
                <form action="{{ route('siswa.wishlist') }}" method="GET" class="relative group">
                    @if(request('category'))
                        <input type="hidden" name="category" value="{{ request('category') }}">
                    @endif

                    <button type="submit" class="absolute left-6 top-1/2 -translate-y-[42%] outline-none group">
                        <span class="material-symbols-outlined 
                                    text-slate-400 text-2xl 
                                    transition-all duration-300 ease-in-out
                                    {{-- Efek Warna --}}
                                    hover:text-rose-600 group-focus-within:text-rose-600 
                                    {{-- Efek Geser --}}
                                    hover:translate-x-1 
                                    {{-- Efek Pembesaran --}}
                                    hover:scale-110
                                    {{-- Tambahan: Memastikan tidak ada line-height yang mengganggu --}}
                                    leading-none">
                            search
                        </span>
                    </button>
                    
                    <input 
                        type="text" 
                        name="search" 
                        value="{{ request('search') }}"
                        class="w-full bg-white border border-slate-200 rounded-[2rem] py-6 pl-16 pr-8 text-sm shadow-xl shadow-rose-900/5 transition-all outline-none text-slate-700 font-medium placeholder:text-slate-300
                            group-focus-within:ring-4 group-focus-within:ring-rose-600/10 group-focus-within:border-rose-400" 
                        placeholder="Search Titles, Authors Or Category..." 
                    />
                </form>
            </div>
        </header>

        <div class="relative w-screen left-1/2 -translate-x-1/2 px-4 md:px-10"> 
            <div class="max-w-[1500px] mx-auto">
                <div class="flex flex-wrap justify-center gap-3 mb-16 font-accent uppercase tracking-widest text-[10px]">
                    @foreach(['All Books', 'Self-Improvement', 'Social Sciences', 'Poetry', 'Romance', 'Activity Books', 'Philosophy', 'Culinary', 'Mysteries & Thrillers', 'Novel', 'Business Management & Leadership', 'Picture Books', 'Literary', 'Diet & Health', 'Young Adult'] as $cat)
                        @php
                            $currentCategory = request('category');
                            $isActive = ($cat === 'All Books' && !$currentCategory) || (strtolower($currentCategory) === strtolower($cat));
                            $url = $cat === 'All Books' ? route('siswa.wishlist') : route('siswa.wishlist', ['category' => $cat]);
                        @endphp
                        {{-- Cukup ubah shadow-blue-600/20 menjadi shadow-rose-600/20 --}}
                        <a href="{{ $url }}" class="category-chip px-8 py-3 rounded-full font-bold border transition-all {{ $isActive ? 'active font-black shadow-lg shadow-rose-600/20' : 'bg-white text-slate-500 border-slate-100 shadow-sm' }}">
                            {{ $cat }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-x-10 gap-y-16 mb-20">
            @forelse($wishlists as $book)

            @php
            // Skema warna pekat dengan border berwarna yang serasi untuk Pages
                $pageColors = [
                    ['bg' => 'bg-blue-600/65',    'border' => 'border-blue-400/50'],
                    ['bg' => 'bg-rose-600/65',    'border' => 'border-rose-400/50'],
                    ['bg' => 'bg-violet-600/65',  'border' => 'border-violet-400/50'],
                    ['bg' => 'bg-emerald-600/65', 'border' => 'border-emerald-400/50'],
                    ['bg' => 'bg-amber-500/65',   'border' => 'border-amber-300/50'],
                    ['bg' => 'bg-indigo-600/65',  'border' => 'border-indigo-400/50'],
                    ['bg' => 'bg-cyan-600/65',    'border' => 'border-cyan-400/50'],
                ];
                $randomColor = $pageColors[array_rand($pageColors)];
            @endphp

            <div class="book-card-3d group cursor-pointer" onclick="window.location.href='{{ route('siswa.book.detail', $book->id) }}'">
                <div class="relative aspect-[2/3] mb-6 transition-all duration-500 isolate">
                    
                    <div class="absolute -top-3 -right-3 z-50 flex flex-col gap-3.5">
                        <button class="h-10 w-10 bg-white rounded-full flex items-center justify-center text-rose-500 transition-all duration-300 border-2 border-white 
                            /* Level 1: Default Shadow Merah */
                            shadow-[0_8px_20px_-5px_rgba(244,63,94,0.35)] 
                            /* Level 2: Group Hover */
                            group-hover:scale-110 
                            group-hover:shadow-[0_12px_30px_-2px_rgba(244,63,94,0.5)] 
                            /* Level 3: Direct Hover */
                            hover:!scale-125 
                            hover:!shadow-[0_15px_40px_rgba(244,63,94,0.7)]">
                            <span class="material-symbols-outlined font-bold" style="font-variation-settings: 'FILL' 1;">favorite</span>
                        </button>


                        <button onclick="event.stopPropagation(); handleUnwishlist(this, {{ $book->id }})"
                                class="h-10 w-10 bg-white rounded-full flex items-center justify-center text-rose-500 transition-all duration-300 border-2 border-white 
                            /* Level 1: Default Shadow Merah */
                            shadow-[0_8px_20px_-5px_rgba(244,63,94,0.35)] 
                            /* Level 2: Group Hover */
                            group-hover:scale-110 
                            group-hover:shadow-[0_12px_30px_-2px_rgba(244,63,94,0.5)] 
                            /* Level 3: Direct Hover */
                            hover:!scale-125 
                            hover:!shadow-[0_15px_40px_rgba(244,63,94,0.7)]">
                            <span class="material-symbols-outlined font-bold" style="font-variation-settings: 'FILL' 1;">delete_forever</span>
                        </button>
                    </div>

                    

                    <div class="absolute inset-0 rounded-[2rem] overflow-hidden border border-slate-200 bg-white z-10 transform-gpu transition-all duration-500
                        /* Shadow Default Slate - Tetap Sama */
                        shadow-2xl shadow-slate-200/60 
                        /* Border & Glow saat Hover - Angka Shadow Sama Persis, Hanya Warna Berubah */
                        group-hover:border-rose-400/80
                        group-hover:shadow-[0_10px_30px_rgba(0,0,0,0.07),0_0_20px_rgba(225,29,72,0.3),0_0_35px_rgba(225,29,72,0.15)]">
                        
                        <img alt="{{ $book->title }}" 
                            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" 
                            src="{{ asset($book->cover_image) }}" 
                            onerror="this.src='https://via.placeholder.com/150x225?text=No+Cover'"/>
                        
                        <div class="absolute inset-0 flex flex-col items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-500 bg-slate-900/40 backdrop-blur-[2px]">
                            <div class="transform translate-y-8 group-hover:translate-y-0 transition-transform duration-500 mb-5">
                                {{-- Warna #e11d48 adalah Rose yang setara dengan ketebalan #2b6cee --}}
                                <span class="material-symbols-outlined text-white text-4xl bg-[#e11d48]/90 rounded-full p-3 shadow-2xl shadow-rose-500/50">add</span>
                            </div>

                            <div class="flex flex-col items-center gap-2 transform translate-y-8 group-hover:translate-y-0 transition-transform duration-500 delay-75 w-full px-4 text-center">
                                <div class="bg-rose-600/65 px-5 py-2 rounded-xl flex items-center justify-center max-w-full shadow-lg border border-rose-400/50">
                                    <span class="text-white font-black text-[9px] uppercase tracking-widest font-accent truncate block">
                                        {{ $book->category_name }}
                                    </span>
                                </div>

                                {{-- 2. PAGES (Random Color, Struktur Persis Model Awal dengan Backdrop Blur) --}}
                                <div class="flex items-center justify-center {{ $randomColor['bg'] }} backdrop-blur-md px-4 py-1.5 rounded-xl border {{ $randomColor['border'] }} shadow-lg">
                                    <span class="text-white font-bold text-[9px] uppercase tracking-tighter font-accent">
                                        {{ $book->total_pages }} 
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="px-2">
                    <h5 class="font-bold text-slate-900 text-base line-clamp-1 mb-1.5 tracking-tight font-heading group-hover:text-[#e11d48] transition-colors">
                        {{ $book->title }}
                    </h5>
                    <p class="text-[10px] font-black text-rose-600/60 uppercase tracking-widest font-accent italic truncate">
                        {{ $book->author_name }}
                    </p>
                </div>
            </div>
            
            @empty
            <div class="col-span-full py-20 text-center">
                <span class="material-symbols-outlined text-slate-200 text-6xl mb-4">
                    heart_plus
                </span>

                <p class="text-slate-400 font-accent uppercase tracking-widest text-xs font-bold mb-[22px]">
                    No <span class="text-[#e11d48]">Books Found</span> in Wishlist. 
                    <a href="{{ route('siswa.library') }}" 
                    class="relative inline-block text-[#e11d48] hover:text-[#e11d48] transition-colors duration-300 group ">
                        Go Find your wishlist!
                        <span class="absolute left-0 bottom-[-4px] w-0 h-[2px] bg-current transition-all duration-300 group-hover:w-full"></span>
                    </a>
                </p>
            </div>
            @endforelse
        </div>

        <script>
            async function handleUnwishlist(element, bookId) {
                const card = element.closest('.book-card-3d');
                
                if (!confirm('Hapus Buku ini dari wishlist?')) return;

                try {
                
                    const response = await fetch("{{ url('dashboard/wishlist/toggle') }}/" + bookId, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        }
                    });

                    const data = await response.json();

                    if (response.ok && data.status === 'removed') {
                        card.style.transition = 'all 0.5s ease';
                        card.style.opacity = '0';
                        card.style.transform = 'scale(0.8)';
                        
                        setTimeout(() => {
                            card.remove();
                            
                            const remainingCards = document.querySelectorAll('.book-card-3d');
                            if (remainingCards.length === 0) {
                                location.reload();
                            }
                        }, 500);
                    } else {
                        console.error('Gagal menghapus:', data.message);
                    }
                } catch (error) {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan koneksi.');
                }
            }
        </script>

        <div class="flex justify-center items-center gap-2 -mt-10 font-accent">
            @if ($wishlists->hasPages())
                @if (!$wishlists->onFirstPage())
                    <a href="{{ $wishlists->previousPageUrl() }}" class="w-10 h-10 md:w-12 md:h-12 flex items-center justify-center rounded-xl border-2 border-slate-200 bg-white text-slate-400 hover:text-rose-600 hover:border-rose-600 hover:-translate-y-1.5 transition-all duration-300 shadow-sm mr-2 group">
                        <span class="material-symbols-outlined text-sm transition-transform group-hover:scale-110">arrow_back_ios_new</span>
                    </a>
                @endif

                @php
                    $currentPage = $wishlists->currentPage();
                    $lastPage = $wishlists->lastPage();
                    $start = max(1, $currentPage - ($currentPage == $lastPage ? 2 : 1));
                    $end = min($lastPage, $currentPage + ($currentPage == 1 ? 2 : 1));
                    if($currentPage == 1) $end = min($lastPage, 3);
                    if($currentPage == $lastPage) $start = max(1, $lastPage - 2);
                @endphp

                @if($start > 1)
                    <a href="{{ $wishlists->url(1) }}" class="w-9 h-9 flex items-center justify-center rounded-lg border-2 border-slate-200 bg-white text-slate-400 font-medium text-[11px] hover:text-rose-600 hover:border-rose-600 hover:-translate-y-1.5 transition-all duration-300 shadow-sm">1</a>
                    @if($start > 2)
                        <div class="flex items-center justify-center h-12">
                            <span class="text-slate-400 px-1 text-[12px] font-extrabold tracking-widest leading-none">...</span>
                        </div>
                    @endif
                @endif

                @foreach (range($start, $end) as $page)
                    @if ($page == $currentPage)
                        <div class="relative group transition-all duration-300">
                            <span class="w-12 h-12 md:w-14 md:h-14 flex items-center justify-center rounded-2xl bg-slate-900 text-white font-black text-base shadow-2xl shadow-slate-900/30 z-10 relative">{{ $page }}</span>
                            {{-- Glow active diubah dari blue-500/20 ke rose-500/20 --}}
                            <div class="absolute inset-0 bg-rose-500/20 blur-xl rounded-full scale-75 group-hover:scale-110 transition-all duration-300"></div>
                        </div>
                    @else
                        <a href="{{ $wishlists->url($page) }}" class="w-10 h-10 md:w-11 md:h-11 flex items-center justify-center rounded-xl border-2 border-slate-200 bg-white text-slate-500 font-bold text-sm hover:text-rose-600 hover:border-rose-600 hover:-translate-y-1.5 transition-all duration-300 shadow-sm">{{ $page }}</a>
                    @endif
                @endforeach

                @if($end < $lastPage)
                    @if($end < $lastPage - 1)
                        <div class="flex items-center justify-center h-12">
                            <span class="text-slate-400 px-1 text-[12px] font-extrabold tracking-widest leading-none">...</span>
                        </div>
                    @endif
                    <a href="{{ $wishlists->url($lastPage) }}" class="w-9 h-9 flex items-center justify-center rounded-lg border-2 border-slate-200 bg-white text-slate-400 font-medium text-[11px] hover:text-rose-600 hover:border-rose-600 hover:-translate-y-1.5 transition-all duration-300 shadow-sm">{{ $lastPage }}</a>
                @endif

                @if ($wishlists->hasMorePages())
                    <a href="{{ $wishlists->nextPageUrl() }}" class="w-10 h-10 md:w-12 md:h-12 flex items-center justify-center rounded-xl border-2 border-slate-200 bg-white text-slate-400 hover:text-rose-600 hover:border-rose-600 hover:-translate-y-1.5 transition-all duration-300 shadow-sm ml-2 group">
                        <span class="material-symbols-outlined text-sm transition-transform group-hover:scale-110">arrow_forward_ios</span>
                    </a>
                @endif
            @endif
        </div>



        <div class="w-full py-16 flex items-center justify-center">
            <div class="w-full h-px bg-slate-400"></div>
        </div>

        <section class="mb-8">
                <div class="flex flex-col items-center mb-[50px] w-full"> 
                    <div class="relative text-center w-full px-4">
                        <h2 class="text-4xl md:text-6xl font-extrabold tracking-tighter font-heading mb-4 
                                text-transparent bg-clip-text 
                                bg-gradient-to-r from-slate-900 from-20% via-blue-600 via-50% to-cyan-400 pb-2 -mb-2">
                            Explore <span class="italic">New Perspectives.</span>
                        </h2>

                        <div class="flex items-center justify-center gap-4 md:gap-8 w-full">
                            <div class="flex-grow h-[6px] bg-[#2b6cee] rounded-full shadow-sm"></div>
                            
                            <div class="group relative overflow-hidden inline-block text-slate-400 font-bold text-[10px] md:text-[11px] uppercase tracking-[0.3em] whitespace-nowrap bg-white/50 px-6 py-2.5 rounded-full border border-slate-200 shadow-sm cursor-default transition-all duration-500
                                    hover:text-white hover:border-transparent"
                            style="mask-image:radial-gradient(white,black); transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);">
                            
                            <span class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-700 cubic-bezier(0.4, 0, 0.2, 1) bg-gradient-to-r from-blue-600 to-cyan-500"></span>

                            <span class="relative z-10 transition-colors duration-500 group-hover:drop-shadow-[0_0_8px_rgba(255,255,255,0.5)]">
                                DISCOVER YOUR NEXT GREAT STORY
                            </span>
                        </div>
                            
                            <div class="flex-grow h-[6px] bg-[#2b6cee] rounded-full shadow-sm"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-x-10 gap-y-16">
                @foreach($books->shuffle()->take(15) as $book)
                    @php
                        // Skema warna pekat dengan border berwarna yang serasi untuk Pages (Sama Persis Referensi)
                        $pageColors = [
                            ['bg' => 'bg-blue-600/65',    'border' => 'border-blue-400/50'],
                            ['bg' => 'bg-rose-600/65',    'border' => 'border-rose-400/50'],
                            ['bg' => 'bg-violet-600/65',  'border' => 'border-violet-400/50'],
                            ['bg' => 'bg-emerald-600/65', 'border' => 'border-emerald-400/50'],
                            ['bg' => 'bg-amber-500/65',   'border' => 'border-amber-300/50'],
                            ['bg' => 'bg-indigo-600/65',  'border' => 'border-indigo-400/50'],
                            ['bg' => 'bg-cyan-600/65',    'border' => 'border-cyan-400/50'],
                        ];
                        $randomColor = $pageColors[array_rand($pageColors)];
                    @endphp

                    <div class="book-card-3d group cursor-pointer" onclick="window.location.href='{{ route('siswa.book.detail', $book->id) }}'">
                        <div class="relative aspect-[2/3] mb-6 transition-all duration-500 isolate">
                            
                            {{-- ICON LOVE DENGAN DOUBLE/TRIPLE HOVER & SHADOW TEBAL --}}
                            @if(isset($wishlistBookIds) && in_array($book->id, $wishlistBookIds))
                            <div class="absolute -top-3 -right-3 z-50">
                                <button class="h-10 w-10 bg-white rounded-full flex items-center justify-center text-rose-500 transition-all duration-300 border-2 border-white 
                                    shadow-[0_8px_20px_-5px_rgba(244,63,94,0.35)] 
                                    group-hover:scale-110 
                                    group-hover:shadow-[0_12px_30px_-2px_rgba(244,63,94,0.5)] 
                                    hover:!scale-125 
                                    hover:!shadow-[0_15px_40px_rgba(244,63,94,0.7)]">
                                    <span class="material-symbols-outlined font-bold" style="font-variation-settings: 'FILL' 1;">favorite</span>
                                </button>
                            </div>
                            @endif

                            {{-- CARD MAIN DENGAN GLOW EDGE BIRU & SHADOW TEBAL --}}
                            <div class="absolute inset-0 rounded-[2rem] overflow-hidden border border-slate-200 bg-white z-10 transform-gpu transition-all duration-500
                                shadow-2xl shadow-slate-200/60 
                                group-hover:border-blue-400/80
                                group-hover:shadow-[0_10px_30px_rgba(0,0,0,0.07),0_0_20px_rgba(37,99,235,0.3),0_0_35px_rgba(37,99,235,0.15)]">
                                
                                <img alt="{{ $book->title }}" 
                                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" 
                                    src="{{ asset($book->cover_image) }}" 
                                    onerror="this.src='https://via.placeholder.com/150x225?text=No+Cover'"/>
                                
                                {{-- OVERLAY DENGAN BLUR --}}
                                <div class="absolute inset-0 flex flex-col items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-500 bg-slate-900/40 backdrop-blur-[2px]">
                                    <div class="transform translate-y-8 group-hover:translate-y-0 transition-transform duration-500 mb-5">
                                        <span class="material-symbols-outlined text-white text-4xl bg-[#2b6cee]/90 rounded-full p-3 shadow-2xl shadow-blue-500/50">add</span>
                                    </div>
                                    
                                    <div class="flex flex-col items-center gap-2 transform translate-y-8 group-hover:translate-y-0 transition-transform duration-500 delay-75 w-full px-4 text-center">
                                        
                                        {{-- CATEGORY CHIP - BORDER DIPERTEBAL --}}
                                        <div class="bg-blue-600/65 px-5 py-2 rounded-xl flex items-center justify-center max-w-full shadow-lg border border-blue-400/50">
                                            <span class="text-white font-black text-[9px] uppercase tracking-widest font-accent truncate block">
                                                {{ $book->category_name }}
                                            </span>
                                        </div>

                                        {{-- PAGES CHIP - RANDOM COLOR & BORDER GLOW --}}
                                        <div class="flex items-center justify-center {{ $randomColor['bg'] }} backdrop-blur-md px-4 py-1.5 rounded-xl border {{ $randomColor['border'] }} shadow-lg">
                                            <span class="text-white font-bold text-[9px] uppercase tracking-tighter font-accent">
                                                {{ $book->total_pages }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="px-2 text-left">
                            <h5 class="font-bold text-slate-900 text-base line-clamp-1 mb-1.5 tracking-tight font-heading group-hover:text-[#2b6cee] transition-colors">
                                {{ $book->title }}
                            </h5>
                            <p class="text-[10px] font-black text-blue-600/60 uppercase tracking-widest font-accent italic text-left truncate">
                                {{ $book->author_name }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    </main>

    <footer class="bg-slate-950 text-white pt-16 pb-12 rounded-t-[5rem] relative overflow-hidden shadow-[0_-20px_50px_rgba(0,0,0,0.1)]">
        <div class="absolute top-0 right-0 w-[400px] h-[400px] bg-blue-600/10 rounded-full blur-[100px] translate-x-1/2 -translate-y-1/2"></div>
        <div class="max-w-7xl mx-auto px-6 lg:px-12 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-16 mb-12 text-center md:text-left">
                <div class="lg:col-span-2">
                    <div class="flex items-center gap-4 mb-8 justify-center md:justify-start">
                        <div class="w-14 h-14 bg-white/5 rounded-2xl flex items-center justify-center border border-white/10">
                            <span class="material-symbols-outlined text-[#2b6cee] text-4xl font-bold">auto_stories</span>
                        </div>
                        <span class="text-4xl font-black tracking-tighter font-heading uppercase">My<span class="text-[#2b6cee] italic">LibAry.</span></span>
                    </div>

                    <p class="text-slate-400 font-medium leading-relaxed max-w-sm mb-10 mx-auto md:mx-0 italic text-[14px]">
                        Empowering students through seamless digital access to a world of literature and boundless knowledge.
                    </p>
                    <div class="flex items-center gap-5 pt-2 justify-center md:justify-start">
                        <a class="w-11 h-11 bg-white/5 rounded-xl flex items-center justify-center text-slate-400 hover:text-[#2b6cee] hover:bg-white/10 hover:-translate-y-1 transition-all duration-300 border border-white/10 shadow-xl" href="#"><i class="fab fa-youtube"></i></a>
                        <a class="w-11 h-11 bg-white/5 rounded-xl flex items-center justify-center text-slate-400 hover:text-[#2b6cee] hover:bg-white/10 hover:-translate-y-1 transition-all duration-300 border border-white/10 shadow-xl" href="#"><i class="fab fa-instagram"></i></a>
                        <a class="w-11 h-11 bg-white/5 rounded-xl flex items-center justify-center text-slate-400 hover:text-[#2b6cee] hover:bg-white/10 hover:-translate-y-1 transition-all duration-300 border border-white/10 shadow-xl" href="#"><i class="fab fa-github"></i></a>
                        <a class="w-11 h-11 bg-white/5 rounded-xl flex items-center justify-center text-slate-400 hover:text-[#2b6cee] hover:bg-white/10 hover:-translate-y-1 transition-all duration-300 border border-white/10 shadow-xl" href="#"><i class="fab fa-facebook-f"></i></a>
                    </div>
                </div>
                <div class="font-accent">
                    <h6 class="font-black text-[11px] uppercase tracking-[0.4em] mb-10 text-[#2b6cee]">Quick Links</h6>
                    <ul class="space-y-4 text-slate-500 text-[13px] font-bold">
                        <li><a class="hover:text-white transition-all flex items-center gap-2 group justify-center md:justify-start" href="{{ route('siswa.dashboard') }}"><span class="w-1 h-1 bg-blue-600 rounded-full group-hover:w-3 transition-all"></span> Dashboard</a></li>
                        <li><a class="hover:text-white transition-all flex items-center gap-2 group justify-center md:justify-start" href="{{ route('siswa.library') }}"><span class="w-1 h-1 bg-blue-600 rounded-full group-hover:w-3 transition-all"></span> Library</a></li>
                        <li><a class="hover:text-white transition-all flex items-center gap-2 group justify-center md:justify-start" href="{{ route('siswa.return') }}"><span class="w-1 h-1 bg-blue-600 rounded-full group-hover:w-3 transition-all"></span> Return</a></li>
                        <li><a class="hover:text-white transition-all flex items-center gap-2 group justify-center md:justify-start" href="{{ route('siswa.history') }}"><span class="w-1 h-1 bg-blue-600 rounded-full group-hover:w-3 transition-all"></span> History</a></li>
                        <li><a class="hover:text-white transition-all flex items-center gap-2 group justify-center md:justify-start" href="{{ route('siswa.borrowed') }}"><span class="w-1 h-1 bg-blue-600 rounded-full group-hover:w-3 transition-all"></span> Your Books</a></li>
                        <li><a class="hover:text-white transition-all flex items-center gap-2 group justify-center md:justify-start" href="{{ route('siswa.fines') }}"><span class="w-1 h-1 bg-blue-600 rounded-full group-hover:w-3 transition-all"></span> Arrears</a></li>
                        <li><a class="hover:text-white transition-all flex items-center gap-2 group justify-center md:justify-start" href="{{ route('siswa.profile') }}"><span class="w-1 h-1 bg-blue-600 rounded-full group-hover:w-3 transition-all"></span> Profile Settings</a></li>
                        <li><a class="hover:text-white transition-all flex items-center gap-2 group justify-center md:justify-start" href="{{ route('chat.index') }}"><span class="w-1 h-1 bg-blue-600 rounded-full group-hover:w-3 transition-all"></span> Chatts</a></li>
                    </ul>
                </div>
                <div class="font-accent text-center md:text-left">
                    <h6 class="font-black text-[11px] uppercase tracking-[0.4em] mb-10 text-emerald-500">Privacy & Terms</h6>
                    <ul class="space-y-4 text-slate-500 text-[13px] font-bold">
                        <li><span class="hover:text-white hover:-translate-y-1 transition-all duration-300 cursor-pointer inline-block">Privacy Policy</span></li>
                        <li><span class="hover:text-white hover:-translate-y-1 transition-all duration-300 cursor-pointer inline-block">Terms of Service</span></li>
                        <li><span class="hover:text-white hover:-translate-y-1 transition-all duration-300 cursor-pointer inline-block">Cookie Policy</span></li>
                    </ul>
                </div>
            </div>
            <div class="pt-8 border-t border-white/5 flex flex-col md:row justify-between items-center gap-6 text-[10px] text-slate-600 font-black uppercase tracking-[0.4em] font-accent text-center">
                <p>© 2026 <span class="text-slate-400">MyLibAry. Management System.</span> All rights reserved.</p>
                <div class="flex gap-10">
                    <span class="text-slate-500 border-x border-white/10 px-6">Designed for Excellence</span>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>