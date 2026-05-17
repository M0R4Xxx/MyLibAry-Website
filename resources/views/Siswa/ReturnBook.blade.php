<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Return Books - MyLibAry</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Plus+Jakarta+Sans:wght@700;800&family=Montserrat:wght@500;700;900&family=Space+Grotesk:wght@300;500;700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Plus+Jakarta+Sans:wght@700;800&family=Montserrat:wght@500;700;900&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    
    <style type="text/tailwindcss">
        :root {
            --bg-silver: #F8F9FC;
            --primary-blue: #2b6cee;
            --accent-purple: #6366f1;
            --accent-teal: #0ea5e9;
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
            font-family: 'Space Grotesk', sans-serif;
        }

        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
       .glass-nav {
            backdrop-filter: blur(20px);
            background-color: rgba(255, 255, 255, 0.75);
        }
        .book-card-vertical {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            background: #ffffff;
        }
        .book-card-vertical:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.05), 0 10px 10px -5px rgba(0, 0, 0, 0.02);
        }
        .btn-hover {
            transition: all 0.2s ease;
        }
        .btn-hover:active {
            transform: scale(0.96);
        }

        .loan-card {
            transition: all 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
            background: linear-gradient(145deg, #ffffff, #f8fafc);
        }

        .loan-card:hover {
            transform: translateY(-12px) scale(1.01);
            border-color: #10b981; 
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.1), 0 0 25px rgba(16, 185, 129, 0.2);
            background: linear-gradient(145deg, #ffffff, #f1f5f9);
        }
    </style>
</head>

<body class="text-slate-900 min-h-screen flex flex-col">
    <nav class="sticky top-0 z-50 glass-nav border-b border-slate-200">
        <div class="max-w-full mx-auto px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <div class="flex items-center gap-2 flex-shrink-0 cursor-pointer" onclick="window.location.href='{{ route('siswa.dashboard') }}'">
                    <span class="material-symbols-outlined text-blue-600 text-3xl font-bold">auto_stories</span>
                    <span class="text-2xl font-black tracking-tighter text-slate-900 font-heading">My<span class="text-blue-600 italic">LibAry.</span></span>
                </div>

                <div class="hidden md:flex items-center space-x-8 flex-shrink-0 font-accent uppercase tracking-wider text-[11px]">
                    <a class="font-bold text-slate-500 hover:text-blue-600 transition-all hover:-translate-y-1" href="{{ route('siswa.dashboard') }}">Dashboard</a>
                    <a class="font-bold text-slate-500 hover:text-blue-600 transition-all hover:-translate-y-1" href="{{ route('siswa.library') }}">Library</a>
                    <a class="font-black text-blue-600 border-b-2 border-blue-600 py-2 transition-all" href="{{ route('siswa.return') }}">Return</a>
                    <a class="font-bold text-slate-500 hover:text-blue-600 transition-all hover:-translate-y-1" href="{{ route('siswa.history') }}">History</a>
                    <a class="font-bold text-slate-500 hover:text-blue-600 transition-all hover:-translate-y-1" href="{{ route('siswa.wishlist') }}">Wishlist</a>
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

    <main class="flex-grow max-w-[1380px] mx-auto px-6 lg:px-12 pt-10 pb-10 relative w-full">
        <header class="mb-14 relative flex flex-col md:flex-row md:items-start justify-between gap-10">
            <div class="relative pl-0 flex-grow"> 
                <div class="absolute -left-6 top-0 w-1 h-28 bg-emerald-600 rounded-full"></div>
                
                <div class="flex items-center gap-3 mb-1 group cursor-default w-fit">
                        <div class="flex items-center justify-center w-10 h-10 rounded-xl bg-emerald-500 text-white shadow-lg shadow-emerald-500/20 shrink-0 transition-all duration-300 group-hover:rotate-12 group-hover:scale-110">
                            <span class="material-symbols-outlined text-xl">
                                book_4
                            </span>
                        </div>

                    <div class="flex flex-col justify-center">
                        <span class="font-accent text-[9px] font-black uppercase tracking-[0.2em] text-emerald-600/60 leading-none mb-1">
                            Active Loans
                        </span>
                        <div class="flex items-center gap-2">
                            <span class="font-heading font-black text-3xl leading-none text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 to-teal-500 drop-shadow-sm">
                                {{ $activeLoans->count() }}
                            </span>
                            <span class="font-modern text-[12px] font-bold text-slate-500 leading-none whitespace-nowrap">
                                Books Borrowed
                            </span>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col lg:flex-row lg:items-center gap-5 mb-4">
                    <h1 class="text-5xl md:text-6xl font-extrabold tracking-tighter font-heading leading-tight">
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-slate-900 via-emerald-600 to-teal-500 font-black">
                            Return Your <i class="italic">Active Books.</i>
                        </span>
                    </h1>

                
                </div>
                
                <p class="text-slate-500 mt-4 text-lg font-medium max-w-xl font-modern leading-relaxed">
                    Clear your digital backpack. Return your finished adventures and make room for your next great read.
                </p>
            </div>

            <a class="mt-8 md:mt-16 group relative overflow-hidden bg-white border border-slate-200 px-8 py-4 rounded-2xl text-emerald-600 font-bold text-[11px] hover:text-white hover:border-transparent hover:-translate-y-2 hover:shadow-2xl hover:shadow-emerald-500/40 transition-all duration-500 ease-in-out flex items-center gap-3 uppercase tracking-widest font-accent shadow-sm shadow-emerald-100/50 shrink-0" 
                href="{{ route('siswa.library') }}">
                                
                    <span class="relative z-10 flex items-center gap-2 transition-colors duration-500">
                        @if($activeLoans->count() > 0)
                            Borrow More Books
                        @else
                            Let's Borrow a Book
                        @endif
                        <span class="material-symbols-outlined text-lg group-hover:translate-x-2 transition-transform duration-500">arrow_right_alt</span>
                    </span>

                    <div class="absolute inset-0 bg-gradient-to-r from-emerald-600 to-teal-600 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                </a>
        </header>

            <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-x-6 gap-y-[38px]">
                @forelse($activeLoans as $loan)
                @php
                    $start = \Carbon\Carbon::parse($loan->loan_date);
                    $end = \Carbon\Carbon::parse($loan->due_date);
                    $startIso = $start->toIso8601String();
                    $endIso = $end->toIso8601String();

                    // Ketebalan disesuaikan: BG 100 dan Border 200
                        $colorSchemes = [
                            ['bg' => 'bg-blue-100',    'text' => 'text-blue-700',    'border' => 'border-blue-200',    'hover' => 'hover:bg-blue-600'],
                            ['bg' => 'bg-rose-100',    'text' => 'text-rose-700',    'border' => 'border-rose-200',    'hover' => 'hover:bg-rose-600'],
                            ['bg' => 'bg-amber-100',   'text' => 'text-amber-700',   'border' => 'border-amber-200',   'hover' => 'hover:bg-amber-600'],
                            ['bg' => 'bg-emerald-100', 'text' => 'text-emerald-700', 'border' => 'border-emerald-200', 'hover' => 'hover:bg-emerald-600'],
                            ['bg' => 'bg-indigo-100',  'text' => 'text-indigo-700',  'border' => 'border-indigo-200',  'hover' => 'hover:bg-indigo-600'],
                            ['bg' => 'bg-violet-100',  'text' => 'text-violet-700',  'border' => 'border-violet-200',  'hover' => 'hover:bg-violet-600'],
                            ['bg' => 'bg-cyan-100',    'text' => 'text-cyan-700',    'border' => 'border-cyan-200',    'hover' => 'hover:bg-cyan-600'],
                        ];

                        $categoryColor = $colorSchemes[array_rand($colorSchemes)];
                    @endphp

                <div class="loan-card book-card-vertical scroll-mt-28 mb-0 flex flex-col p-4 pt-5 rounded-[2.5rem] border border-slate-200 h-fit shadow-xl shadow-slate-200/60 transition-all duration-500 group relative cursor-pointer"
                    data-start="{{ $startIso }}"
                    data-end="{{ $endIso }}"
                    onclick="window.location='{{ route('siswa.book.detail', $loan->book->id) }}'">      
                    
                    <div class="relative mb-6">
                        <div class="absolute -top-3 left-1/2 -translate-x-1/2 z-10 whitespace-nowrap transition-all duration-500 transform group-hover:scale-105 group-hover:-rotate-1">
                            <div class="js-status-badge-mini flex items-center gap-1.5 px-3 py-1.5 rounded-full border border-black/5 bg-white shadow-[0_2px_10px_rgba(0,0,0,0.1)] transition-all duration-500">
                                <span class="material-symbols-outlined text-[14px] js-icon-mini transition-all duration-500 group-hover:translate-x-[3px]">
                                    sync
                                </span>
                                <span class="font-accent js-time-text-mini text-[10px] font-black uppercase tracking-wider">
                                    Calculating...
                                </span>
                            </div>
                        </div>

                        <div class="w-full aspect-[2/3] rounded-[2rem] overflow-hidden transition-all duration-500 transform 
                                    /* 1. BORDER ABU SERAGAM (Sebelum Hover) */
                                    border-2 border-slate-100 shadow-lg 
                                    
                                    /* Efek miring dan membesar bawaan - TETAP SAMA */
                                    group-hover:scale-105 group-hover:-rotate-1 
                                    
                                    /* 2. BORDER GLOW EDGE EMERALD (Saat Hover) */
                                    /* Mengubah blue-400 menjadi emerald-400 dengan opacity yang sama */
                                    group-hover:border-emerald-400/80 

                                    /* SHADOW TETAP ORIGINAL - Hanya ubah warna biru ke emerald */
                                    group-hover:shadow-[0_0_25px_rgba(0,0,0,0.15),0_0_4px_rgba(16,185,129,0.8)]">
                            
                            <img alt="{{ $loan->book->title }}" 
                                class="w-full h-full object-cover block" 
                                src="{{ asset($loan->book->cover_image) }}" 
                                onerror="this.src='https://via.placeholder.com/300x400?text=No+Cover'"/>
                        </div>
                    </div>

                    <div class="flex flex-col flex-grow px-2">
                        <div class="flex justify-center mb-3">
                            <span class="font-accent px-4 py-1.5 rounded-xl text-[9px] font-black uppercase tracking-[0.2em] border transition-all duration-300 cursor-default shadow-sm transform inline-block max-w-[180px] truncate whitespace-nowrap
                                {{ $categoryColor['bg'] }} 
                                {{ $categoryColor['text'] }} 
                                {{ $categoryColor['border'] }} 
                                {{ $categoryColor['hover'] }} 
                                /* Custom scale 4% (1.04) agar sangat halus */
                                hover:text-white hover:scale-[1.04]">
                                {{ $loan->book->category_name ?? 'General' }}
                            </span>
                        </div>

                        <h3 class="font-heading font-black text-lg leading-tight mb-1 text-center line-clamp-1 transform-gpu"
                            style="background-image: linear-gradient(to right, #2563eb, #7c3aed, #db2777); -webkit-background-clip: text; -webkit-text-fill-color: transparent; backface-visibility: hidden;">
                            {{ $loan->book->title }}
                        </h3>

                        <p class="font-accent text-[10px] text-blue-600/60 font-black uppercase tracking-widest italic line-clamp-1 text-center mb-4">
                            {{ $loan->book->author_name }}
                        </p>
                        
                        <div class="mt-auto space-y-5">
                            <div class="space-y-2">
                                <div class="flex justify-between items-center px-1 font-accent">
                                    <span class="text-[9px] font-black text-emerald-500 uppercase tracking-tighter transition-transform duration-300 transform hover:-translate-y-1 cursor-default inline-block">
                                        Borrowed
                                    </span>

                                    <span class="text-[9px] font-black text-rose-500 uppercase tracking-tight transition-transform duration-300 transform hover:-translate-y-1 cursor-default inline-block">
                                        Returned
                                    </span>
                                </div>
                                <div class="relative w-full h-3 bg-slate-100 rounded-full overflow-hidden shadow-inner p-0.5 border border-slate-200/50">
                                    <div class="js-progress-bar h-full rounded-full bg-gradient-to-r from-emerald-400 to-emerald-600 transition-all duration-1000" style="width: 0%"></div>
                                </div>
                            </div>

                            <button type="button" 
                                    onclick="event.stopPropagation(); openReturnModal('{{ $loan->id }}', '{{ asset($loan->book->cover_image) }}', '{{ addslashes($loan->book->title) }}', '{{ addslashes($loan->book->author_name) }}', '{{ $loan->book->category_name ?? 'General' }}', '{{ $loan->book->pages ?? '0' }}', '{{ $startIso }}', '{{ $endIso }}')"
                                    class="transform-gpu will-change-transform [backface-visibility:hidden] antialiased group/btn font-accent w-full py-3.5 rounded-2xl text-[11px] font-black uppercase tracking-widest text-white transition-all duration-500 ease-in-out transform hover:-translate-y-1 active:scale-95 flex items-center justify-center gap-2 leading-none
                                        /* Gradient diubah ke Emerald-Teal dengan titik pemberhentian (stops) yang sama persis */
                                        bg-gradient-to-r from-slate-900 from-0% via-emerald-600 via-15% via-emerald-500 via-45% to-teal-500 
                                        bg-[length:250%_150%] bg-left hover:bg-right 
                                        /* Shadow diubah ke emerald dengan tingkat opasitas dan ketebalan yang sama persis */
                                        shadow-lg shadow-slate-200 hover:shadow-emerald-500/30 border-t border-white/5 group">
                                    
                                    <span>Return Book</span>
                                    <span class="material-symbols-outlined text-[16px] transition-all duration-500 inline-block
                                        /* 1. Tambahkan ini agar sinkron dan tidak flicker */
                                        transform-gpu antialiased will-change-transform
                                        
                                        /* 2. Pertahankan zoom bertahap dengan logika ini */
                                        group-hover:scale-110 
                                        group-hover/btn:!scale-[1.15] 
                                        
                                        /* 3. Satukan perintah transform agar dieksekusi bersamaan */
                                        group-hover/btn:-translate-y-[1px] group-hover/btn:-translate-x-1">
                                        keyboard_return
                                    </span>
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-28 text-center flex flex-col items-center justify-center">
                    <span class="material-symbols-outlined text-slate-200 text-7xl mb-6">
                        library_books
                    </span>
                    
                    <p class="text-slate-400 font-accent uppercase tracking-widest text-xs font-bold mb-[22px]">
                        No active loans found. 
                        <a href="{{ route('siswa.library') }}" 
                        class="relative inline-block text-[#2b6cee] hover:text-[#1a56cc] transition-colors duration-300 group">
                            Borrow your first book!
                            <span class="absolute left-0 bottom-[-2px] w-0 h-[2px] bg-current transition-all duration-300 group-hover:w-full"></span>
                        </a>
                    </p>
                </div>
            @endforelse
        </section>



        <style type="text/tailwindcss">
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
        </style>



        <div class="w-full py-16 flex items-center justify-center">
            <div class="w-full h-px bg-slate-400"></div>
        </div>

        <section class="mb-8">
                <div class="flex flex-col items-center mb-[50px] w-full"> 
                    <div class="relative text-center w-full px-4">
                        <h2 class="text-4xl md:text-6xl font-extrabold tracking-tighter font-heading mb-4 
                                text-transparent bg-clip-text 
                                bg-gradient-to-r from-slate-900 from-20% via-blue-600 via-50% to-cyan-400 pb-2 -mb-2">
                            Unfold <span class="italic">Infinite Pages.</span>
                        </h2>

                        <div class="flex items-center justify-center gap-4 md:gap-8 w-full">
                            <div class="flex-grow h-[6px] bg-[#2b6cee] rounded-full shadow-sm"></div>
                            
                            <div class="group relative overflow-hidden inline-block text-slate-400 font-bold text-[10px] md:text-[11px] uppercase tracking-[0.3em] whitespace-nowrap bg-white/50 px-6 py-2.5 rounded-full border border-slate-200 shadow-sm cursor-default transition-all duration-500
                                    hover:text-white hover:border-transparent"
                            style="mask-image:radial-gradient(white,black); transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);">
                            
                            <span class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-700 cubic-bezier(0.4, 0, 0.2, 1) bg-gradient-to-r from-blue-600 to-cyan-500"></span>

                            <span class="relative z-10 transition-colors duration-500 group-hover:drop-shadow-[0_0_8px_rgba(255,255,255,0.5)]">
                                START A NEW READING ADVENTURE
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



        
    <div id="returnModal" class="fixed inset-0 z-[100] hidden">
        <div class="absolute inset-0 bg-slate-950/40 backdrop-blur-[6px] transition-opacity" onclick="closeReturnModal()"></div>
        
        <div class="flex min-h-full items-center justify-center p-6">
            <div class="relative w-full max-w-xl transform overflow-hidden rounded-[3.5rem] bg-[#F8F9FC] p-10 shadow-xl shadow-slate-950/5 transition-all border border-slate-100 group/header group/modal">
                
                <div class="flex justify-between items-start mb-10">
                    <div>
                        <h3 class="text-3xl font-black font-heading tracking-tighter bg-clip-text text-transparent transform-gpu"
                            style="background-image: linear-gradient(to right, #000000 0%, #065f46 20%, #10b981 50%, #0d9488 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
                            Return Book Confirmation
                        </h3>
                        <p class="text-xs text-slate-400 font-bold uppercase tracking-[0.2em] mt-2 flex items-center gap-2 group-hover/header:text-[#10b981] transition-colors duration-500">
                            <span class="w-8 h-[2px] bg-[#10b981] rounded-full transition-[width] duration-500 ease-out group-hover/header:w-12"></span>
                            <span class="transition-transform duration-500 group-hover/header:translate-x-1">Return System</span>
                        </p>
                    </div>

                    <button type="button" onclick="closeReturnModal()" class="group/close relative">
                        <div class="relative flex items-center justify-center w-11 h-11 bg-white border-2 border-slate-100 rounded-xl transition-all duration-500 group-hover/close:bg-rose-500 group-hover/close:border-rose-500 group-hover/close:rotate-90 group-hover/close:shadow-[0_0_20px_rgba(244,63,94,0.5)]">
                            <span class="material-symbols-outlined text-slate-400 group-hover/close:text-white text-xl font-bold transition-colors">close</span>
                        </div>
                    </button>
                </div>

                <div class="flex gap-8 mb-8 bg-white/50 backdrop-blur-xl p-7 rounded-[3rem] 
                            /* 1. KETEBALAN BORDER 1 (Atas, Bawah, Kiri) */
                            border border-slate-200
                            
                            relative group/card-book overflow-hidden 
                            
                            /* 2. KETEBALAN BORDER 2 (Kanan) */
                            border-r-4 border-r-slate-200
                            
                            /* PERUBAHAN: Menambahkan durasi sedikit lebih lama (700) dan ease-in-out agar lebih smooth */
                            transition-all duration-700 ease-in-out

                            /* STATE DEFAULT */
                            shadow-[0_15px_40px_-15px_rgba(0,0,0,0.12)]
                            translate-y-0

                            /* STATE AKTIF (Otomatis saat kursor masuk area Modal) */
                            group-hover/header:-translate-y-1.5
                            
                            /* Border emerald transparan pada border utama */
                            group-hover/header:border-emerald-400/40
                            /* Border kanan juga ikut berubah warna emerald saat aktif */
                            group-hover/header:border-r-emerald-400/60
                            
                            group-hover/header:shadow-[0_20px_40px_-12px_rgba(16,185,129,0.12),0_0_20px_rgba(16,185,129,0.12)]">
                    
                    {{-- Overlay Background --}}
                    <div class="absolute inset-0 bg-white/10 transition-colors duration-700 ease-in-out group-hover/header:bg-white/20 -z-10"></div>

                    <div class="w-36 shrink-0 aspect-[2/3] rounded-[1.5rem] overflow-hidden transition-all duration-700 transform 
                                border-2 border-slate-100 shadow-lg 
                                group-hover/header:scale-105 group-hover/header:-rotate-2 
                                group-hover/header:border-emerald-400/80 
                                group-hover/header:!shadow-[0_15px_30px_-12px_rgba(0,0,0,0.1),0_0_20px_2px_rgba(16,185,129,0.3),0_0_35px_rgba(16,185,129,0.15)]">
                            
                            <img id="modal_return_cover" 
                                src="" 
                                class="w-full h-full object-cover">
                    </div>

                    <div class="flex flex-col justify-center min-w-0 flex-grow">
                        <div class="mb-3">
                        <span id="modal_return_category" 
                            class="font-accent px-4 py-1.5 rounded-xl text-[9px] font-black uppercase tracking-[0.2em] border inline-block max-w-full truncate whitespace-nowrap transform-gpu transition-all 
                            duration-700 ease-[cubic-bezier(0.25,0.1,0.25,1)] hover:text-white hover:scale-[1.04] hover:-translate-y-0.5 active:scale-95 cursor-default"
                            style="">
                        </span>
                    </div>

                        <h4 id="modal_return_title" class="font-heading font-black text-xl leading-tight mb-1 truncate transform-gpu"
                            style="background-image: linear-gradient(to right, #2563eb, #7c3aed, #db2777); -webkit-background-clip: text; -webkit-text-fill-color: transparent; backface-visibility: hidden;">
                        </h4>

                        <div class="flex items-center gap-3 mb-6 transform-gpu" style="backface-visibility: hidden;">
                            <span class="w-8 h-[2px] bg-blue-600/60 flex-shrink-0 rounded-full 
                                        transition-transform duration-700 ease-out origin-left
                                        group-hover/card-book:scale-x-150"></span>
                            
                            <p id="modal_return_author" 
                            class="font-accent text-[11px] text-blue-600/60 font-black uppercase tracking-[0.2em] italic truncate leading-none transition-transform duration-700 ease-out group-hover/card-book:translate-x-3">
                            </p>
                        </div>

                        <div class="flex justify-between items-end mb-4"> 
                            <div class="text-center cursor-default transition-transform duration-300 hover:-translate-y-1">
                                <p class="text-[8px] font-black text-emerald-500 uppercase tracking-widest mb-1 font-accent">
                                    Borrow On
                                </p>
                                <p id="modal_text_start_formatted" 
                                class="text-[10px] font-bold text-white bg-emerald-500 px-2 py-0.5 rounded-md shadow-sm">
                                </p>
                            </div>

                            <div class="text-center cursor-default transition-transform duration-300 hover:-translate-y-1">
                                <p class="text-[8px] font-black text-rose-400 uppercase tracking-widest mb-1 font-accent">
                                    Return On
                                </p>
                                <p id="modal_text_end_formatted" 
                                class="text-[10px] font-black text-white bg-rose-600 px-2 py-0.5 rounded-md shadow-sm">
                                </p>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <div class="relative w-full h-3 bg-slate-100 rounded-full overflow-hidden shadow-inner p-0.5 border border-slate-200/50">
                                <div id="modal_return_progress_bar" 
                                    style="width: 0%" 
                                    class="h-full rounded-full transition-all duration-1000 ease-out shadow-sm">
                                </div>
                            </div>
                            
                            <div class="flex justify-center">
                               <div id="modal_badge_container" 
                                    class="group/badge flex items-center gap-2 px-4 py-2 rounded-full border shadow-[0_2px_8px_rgba(0,0,0,0.12)] transition-all duration-700 ease-[cubic-bezier(0.25,0.1,0.25,1)] bg-white/80 backdrop-blur-sm scale-100 cursor-default 
                                            group-hover/modal:scale-105 group-hover/modal:border-transparent
                                            group-hover/modal:shadow-[0_4px_12px_rgba(0,0,0,0.08),0_2px_14px_var(--shadow-color)]
                                            hover:!scale-110 hover:!shadow-[0_5px_12px_var(--shadow-deep)] active:scale-95" 
                                    style="">
                                    
                                    <span id="modal_badge_icon" class="inline-block material-symbols-outlined text-[16px] animate-spin">
                                        sync
                                    </span>

                                    <span id="modal_countdown_text" class="font-accent text-[11px] font-black uppercase tracking-wider transition-colors duration-500">
                                        Calculating...
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <form id="returnForm" action="" method="POST" class="space-y-6 group/modal">
                    @csrf
                    @method('POST')
                    
                    <div id="modal_status_wrapper" class="mt-4 flex flex-col items-center justify-center gap-2 px-1 transition-all duration-500 opacity-40 group-hover/modal:opacity-100 text-center">
                        <span id="modal_status_icon_big" class="material-symbols-outlined text-xl animate-spin"> 
                            sync
                        </span>
                        
                        <p id="modal_return_caption" class="text-[12.5px] text-slate-500 leading-relaxed font-medium transition-all duration-500 group-hover/modal:text-slate-600 group-hover/modal:-translate-y-0.5">
                            Loading status...
                        </p>
                    </div>

                    <div class="pt-2">
                        <button type="submit" 
                                class="w-full flex items-center justify-center gap-4 px-10 py-4 rounded-[2rem] font-black font-accent uppercase tracking-widest text-[10px] text-white transition-all duration-500 ease-in-out transform hover:-translate-y-1 hover:bg-right hover:shadow-[0_15px_30px_-5px_rgba(16,185,129,0.4)] shadow-2xl shadow-slate-900/20 group/btn border-t border-white/10 bg-gradient-to-r from-slate-900 from-0% via-emerald-600 via-15% via-emerald-500 via-45% to-teal-500 bg-[length:250%_150%] bg-left">
                            <span class="inline-block transition-transform duration-500 group-hover/btn:scale-110 group-hover/btn:translate-x-1">
                                <span class="material-symbols-outlined text-lg block transform -scale-x-100">
                                    assignment_return
                                </span>
                            </span>
                            <span>Confirm Returning</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function formatBladeDate(isoString) {
            if (!isoString) return "-";
            const date = new Date(isoString.replace(/-/g, "/").replace(/T/g, " "));
            const months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
            
            const M = months[date.getMonth()];
            const d = String(date.getDate()).padStart(2, '0');
            const H = String(date.getHours()).padStart(2, '0');
            const i = String(date.getMinutes()).padStart(2, '0');

            return `${M} ${d}, ${H}:${i}`;
        }

        function openReturnModal(loanId, cover, title, author, category, pages, startIso, endIso) {
            const modal = document.getElementById('returnModal');
            const categoryBadge = document.getElementById('modal_return_category');
            const form = document.getElementById('returnForm');

            const colorSchemes = [
                { bg: 'bg-blue-100',    text: 'text-blue-700',    border: 'border-blue-200',    hover: 'hover:bg-blue-600',    s: 'rgba(37, 99, 235, 0.18)', sd: 'rgba(37, 99, 235, 0.30)' },
                { bg: 'bg-rose-100',    text: 'text-rose-700',    border: 'border-rose-200',    hover: 'hover:bg-rose-600',    s: 'rgba(225, 29, 72, 0.18)', sd: 'rgba(225, 29, 72, 0.30)' },
                { bg: 'bg-amber-100',   text: 'text-amber-700',   border: 'border-amber-200',   hover: 'hover:bg-amber-600',   s: 'rgba(245, 158, 11, 0.18)', sd: 'rgba(245, 158, 11, 0.30)' },
                { bg: 'bg-emerald-100', text: 'text-emerald-700', border: 'border-emerald-200', hover: 'hover:bg-emerald-600', s: 'rgba(16, 185, 129, 0.18)', sd: 'rgba(16, 185, 129, 0.30)' },
                { bg: 'bg-indigo-100',  text: 'text-indigo-700',  border: 'border-indigo-200',  hover: 'hover:bg-indigo-600',  s: 'rgba(79, 70, 229, 0.18)', sd: 'rgba(79, 70, 229, 0.30)' },
                { bg: 'bg-violet-100',  text: 'text-violet-700',  border: 'border-violet-200',  hover: 'hover:bg-violet-600',  s: 'rgba(124, 58, 237, 0.18)', sd: 'rgba(124, 58, 237, 0.30)' },
                { bg: 'bg-cyan-100',    text: 'text-cyan-700',    border: 'border-cyan-200',    hover: 'hover:bg-cyan-600',    s: 'rgba(8, 145, 178, 0.18)',  sd: 'rgba(8, 145, 178, 0.30)' }
            ];

            const scheme = colorSchemes[Math.floor(Math.random() * colorSchemes.length)];

            categoryBadge.style.setProperty('--shadow-color', scheme.s);
            categoryBadge.style.setProperty('--shadow-deep', scheme.sd);


            categoryBadge.className = `font-accent px-4 py-1.5 rounded-xl text-[9px] font-black uppercase tracking-[0.2em] border inline-block max-w-full truncate whitespace-nowrap transform-gpu transition-all duration-700 ease-[cubic-bezier(0.25,0.1,0.25,1)] hover:text-white hover:scale-[1.04] hover:-translate-y-0.5 active:scale-95 cursor-default ${scheme.bg} ${scheme.text} ${scheme.border} ${scheme.hover} shadow-[0_2px_8px_rgba(0,0,0,0.02),0_2px_14px_var(--shadow-color)] hover:!shadow-[0_5px_12px_var(--shadow-deep)]`;
            



            categoryBadge.innerText = category || 'General';
            document.getElementById('modal_return_cover').src = cover;
            document.getElementById('modal_return_title').innerText = title;
            document.getElementById('modal_return_author').innerText = author;
            
            document.getElementById('modal_text_start_formatted').innerText = formatBladeDate(startIso);
            document.getElementById('modal_text_end_formatted').innerText = formatBladeDate(endIso);
            
            modal.dataset.start = startIso;
            modal.dataset.end = endIso;

            form.action = `/dashboard/return-process/${loanId}`; 

            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            
            if (typeof updateReturnCountdown === "function") {
                updateReturnCountdown();
            }
        }

        let isSubmitting = false;

        document.addEventListener('DOMContentLoaded', function() {
            const returnForm = document.getElementById('returnForm');
            
            if (returnForm) {
                returnForm.addEventListener('submit', function(e) {
                    if (isSubmitting) {
                        e.preventDefault();
                        return false;
                    }

                    isSubmitting = true;
                    
                });
            }
        });

        function closeReturnModal() {
            const modal = document.getElementById('returnModal');
            modal.classList.add('hidden');
            delete modal.dataset.start;
            delete modal.dataset.end;
            document.body.style.overflow = 'auto';
        }

        document.addEventListener('DOMContentLoaded', function() {
        function updateAllTimers() {
            const now = new Date().getTime();
            const elements = document.querySelectorAll('.loan-card, #returnModal[data-start]');
            
            elements.forEach(el => {
                const rawStart = el.dataset.start ? el.dataset.start.replace(/-/g, "/").replace(/T/g, " ") : "";
                const rawEnd = el.dataset.end ? el.dataset.end.replace(/-/g, "/").replace(/T/g, " ") : "";
                
                const start = new Date(rawStart).getTime();
                const end = new Date(rawEnd).getTime();
                
                const total = end - start;
                const elapsed = now - start;
                const remaining = end - now;

                let percentage = Math.max(1, Math.min(100, (elapsed / total) * 100)); 
                
                const bar = el.id === 'returnModal' 
                            ? document.getElementById('modal_return_progress_bar') 
                            : el.querySelector('.js-progress-bar');

                let statusColor = "";
                let statusIcon = "";
                let isPulse = false;

                if (remaining <= 0) {
                    statusColor = "rose";
                    statusIcon = "history_toggle_off";
                } else if (percentage >= 85) {
                    statusColor = "rose";
                    statusIcon = "warning";
                    isPulse = true;
                } else if (percentage >= 50) {
                    statusColor = "orange";
                    statusIcon = "hourglass_top";
                } else {
                    statusColor = "emerald";
                    statusIcon = "chrome_reader_mode";
                }

                if (bar) {
                    bar.style.width = percentage + '%';
                    const barColors = {
                        slate: "bg-slate-400",
                        rose: "bg-gradient-to-r from-rose-500 to-red-600",
                        orange: "bg-gradient-to-r from-orange-400 to-orange-600",
                        emerald: "bg-gradient-to-r from-emerald-400 to-teal-500"
                    };
                    bar.className = `h-full rounded-full transition-all duration-1000 ease-out ${barColors[statusColor]}`;
                }

                const days = Math.floor(remaining / (1000 * 60 * 60 * 24));
                const hours = Math.floor((remaining % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const mins = Math.floor((remaining % (1000 * 60 * 60)) / (1000 * 60));
                const secs = Math.floor((remaining % (1000 * 60)) / 1000);

                if (el.id === 'returnModal') {
                    const countdownEl = document.getElementById('modal_countdown_text');
                    const badgeContainer = document.getElementById('modal_badge_container');
                    const badgeIcon = document.getElementById('modal_badge_icon');
                    const captionEl = document.getElementById('modal_return_caption');
                    const iconBigEl = document.getElementById('modal_status_icon_big');

                    const isCalculating = !el.dataset.start || !el.dataset.end || isNaN(start);
                    const activeColor = isCalculating ? 'emerald' : statusColor;

                    if (countdownEl) {
                        countdownEl.innerText = isCalculating ? "Calculating..." : (remaining <= 0 ? "OVERDUE" : (days > 0 ? `${days}d ${hours}h left` : `${hours}h ${mins}m ${secs}s`));
                    }

                    if (badgeContainer) {
                        const modalStyles = {
                            slate: { cls: ["bg-slate-100", "border-slate-200", "text-slate-700", "group-hover/modal:bg-slate-500", "group-hover/modal:text-white"], shadow: "rgba(30, 41, 59, 0.35)", deep: "rgba(30, 41, 59, 0.45)" },
                            rose: { cls: ["bg-rose-100", "border-rose-200", "text-rose-700", "group-hover/modal:bg-rose-500", "group-hover/modal:text-white"], shadow: "rgba(225, 29, 72, 0.35)", deep: "rgba(225, 29, 72, 0.45)" },
                            orange: { cls: ["bg-orange-100", "border-orange-200", "text-orange-700", "group-hover/modal:bg-orange-500", "group-hover/modal:text-white"], shadow: "rgba(245, 158, 11, 0.35)", deep: "rgba(245, 158, 11, 0.45)" },
                            emerald: { cls: ["bg-emerald-100", "border-emerald-200", "text-emerald-700", "group-hover/modal:bg-emerald-500", "group-hover/modal:text-white"], shadow: "rgba(16, 185, 129, 0.35)", deep: "rgba(16, 185, 129, 0.45)" }
                        };

                        const allCls = Object.values(modalStyles).flatMap(s => s.cls);
                        badgeContainer.classList.remove(...allCls, "bg-white/80");

                        const currentStyle = modalStyles[activeColor];
                        
                        badgeContainer.classList.add(...currentStyle.cls, "group/badge"); 
                        
                        badgeContainer.style.setProperty('--shadow-color', currentStyle.shadow);
                        badgeContainer.style.setProperty('--shadow-deep', currentStyle.deep);
                    }

                    if (badgeIcon) {
                        const currentIcon = isCalculating ? "sync" : statusIcon;
                        if (badgeIcon.innerText !== currentIcon) badgeIcon.innerText = currentIcon;
                        
                        if (currentIcon === 'sync') {
                            badgeIcon.classList.add('animate-spin');
                        } else {
                            badgeIcon.classList.remove('animate-spin');
                            badgeIcon.classList.toggle('animate-pulse', !isCalculating && isPulse);
                        }
                    }

                    if (captionEl) {
                        const statusWrapper = document.getElementById('modal_status_wrapper');
                        let captionText = "";
                        let iconName = "verified_user";
                        let iconColorClass = "text-blue-500";
                        
                        captionEl.className = "text-[12.5px] text-slate-500 leading-relaxed transition-all duration-500 font-medium group-hover/modal:text-slate-600 group-hover/modal:-translate-y-1"; 

                        if (isCalculating) {
                            if (statusWrapper) {
                                statusWrapper.className = "mt-4 flex flex-col items-center justify-center gap-2 px-1 transition-all duration-500 opacity-40 group-hover/modal:opacity-100 text-center animate-spin";
                            }
                            captionEl.classList.add("text-center");
                            
                            captionText = "Please wait while the system calculates your remaining loan time...";
                            iconName = "sync"; 
                            iconColorClass = "text-blue-500";
                        } else {
                            if (statusWrapper) {
                                statusWrapper.className = "mt-4 flex flex-row items-center justify-start gap-2 px-1 transition-all duration-500 opacity-40 group-hover/modal:opacity-100 text-left";
                            }
                            captionEl.classList.add("text-left");

                            if (remaining <= 0) {
                                captionText = `<span class="text-rose-600 font-bold text-[13.5px]">Note : </span><span class="text-rose-600 font-black italic underline">URGENT!</span> Your loan period has <span class="text-rose-700 font-bold">expired</span>. Please return this digital book <span class="text-rose-700 font-bold">immediately</span> to avoid potential <span class="underline decoration-rose-600 font-bold">account suspension</span> by the administrator.`;
                                iconName = "event_busy"; 
                                iconColorClass = "text-rose-600";
                            } else if (percentage >= 85) {
                                captionText = `<span class="text-slate-900 font-bold text-[13.5px]">Note : </span>Your <span class="text-rose-500 font-bold">time is almost up!</span> Please <span class="text-rose-500 font-bold italic">return the book soon</span> to maintain your <span class="text-blue-600 font-bold">reading privileges</span> and avoid <span class="text-rose-500 font-bold">late penalties</span>.`;
                                iconName = "release_alert"; 
                                iconColorClass = "text-rose-500";
                            } else if (percentage >= 50) {
                                captionText = `<span class="text-slate-900 font-bold text-[13.5px]">Note : </span>You are <span class="text-orange-600 font-bold">halfway through</span> your loan period. We hope you are <span class="text-emerald-600 font-bold">enjoying your reading!</span> Remember to <span class="text-orange-600 font-bold italic">return it on time</span>.`;
                                iconName = "update"; 
                                iconColorClass = "text-orange-500";
                            } else {
                                captionText = `<span class="text-slate-900 font-bold text-[13.5px]">Note : </span>You still have <span class="text-emerald-600 font-bold">plenty of time</span> to enjoy this book. Are you sure you want to <span class="text-blue-600 font-bold">return it now</span> and <span class="text-emerald-600 font-bold italic">finish your session?</span>`;
                                iconName = "import_contacts"; 
                                iconColorClass = "text-emerald-500";
                            }
                        }

                        captionEl.innerHTML = captionText;

                        if (iconBigEl) {
                            iconBigEl.innerText = iconName;
                            
                            iconBigEl.classList.remove('text-blue-500', 'text-rose-600', 'text-rose-500', 'text-orange-500', 'text-emerald-500');
                            iconBigEl.classList.add(iconColorClass);
                            iconBigEl.className = `material-symbols-outlined text-2xl transition-all duration-500 transform-gpu group-hover/modal:-translate-y-1 group-hover/modal:scale-110 ${iconColorClass}`;


                            badgeIcon.classList.add('transition-transform', 'duration-500', 'group-hover/badge:translate-x-1');
                            if (iconName === 'sync') {
                                iconBigEl.classList.add('animate-spin');
                            } else {
                                
                                iconBigEl.classList.remove('animate-spin');
                            }
                        }
                    }
                }

                if (el.classList.contains('loan-card')) {
                    const miniText = el.querySelector('.js-time-text-mini');
                    const miniIcon = el.querySelector('.js-icon-mini');
                    const miniBadge = el.querySelector('.js-status-badge-mini');

                    if (miniText) miniText.innerText = remaining <= 0 ? "OVERDUE" : (days > 0 ? `${days} Days Left` : `${hours}h ${mins}m ${secs}s`);
                    if (miniIcon) {
                        miniIcon.innerText = statusIcon;
                        isPulse ? miniIcon.classList.add('animate-pulse') : miniIcon.classList.remove('animate-pulse');
                    }
                    if (miniBadge) {
                        const hoverStyles = {
                            slate: "bg-slate-100 border-slate-200 text-slate-700 group-hover:bg-slate-500",
                            rose: "bg-rose-100 border-rose-200 text-rose-700 group-hover:bg-rose-500",
                            orange: "bg-orange-100 border-orange-200 text-orange-700 group-hover:bg-orange-500",
                            emerald: "bg-emerald-100 border-emerald-200 text-emerald-700 group-hover:bg-emerald-500"
                        };
                        miniBadge.className = `js-status-badge-mini flex items-center gap-1.5 px-3 py-1.5 rounded-full border shadow-sm transition-all duration-500 group-hover:text-white group-hover:border-transparent group-hover:shadow-md ${hoverStyles[statusColor]}`;
                    }
                }
            });
        }
        
        window.updateAllTimers = updateAllTimers;
        setInterval(updateAllTimers, 1000);
        updateAllTimers();
    });
    </script>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const urlParams = new URLSearchParams(window.location.search);
        const loanIdToOpen = urlParams.get('open_modal');

        if (loanIdToOpen) {
            const targetButton = document.querySelector(`button[onclick*="openReturnModal('${loanIdToOpen}'"]`);
            
            if (targetButton) {
                const bookCard = targetButton.closest('.loan-card');
                
                setTimeout(() => {
                    if (bookCard) {
                        
                        bookCard.scrollIntoView({ 
                            behavior: 'smooth', 
                            block: 'start' 
                        });
                    }

                    setTimeout(() => {
                        targetButton.click();
                    }, 600); 

                    const cleanUrl = window.location.protocol + "//" + window.location.host + window.location.pathname;
                    window.history.replaceState({path: cleanUrl}, '', cleanUrl);
                }, 500); 
            }
        }
    });
    </script>
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
                        <li><a class="hover:text-white transition-all flex items-center gap-2 group justify-center md:justify-start" href="{{ route('siswa.history') }}"><span class="w-1 h-1 bg-blue-600 rounded-full group-hover:w-3 transition-all"></span> History</a></li>
                        <li><a class="hover:text-white transition-all flex items-center gap-2 group justify-center md:justify-start" href="{{ route('siswa.wishlist') }}"><span class="w-1 h-1 bg-blue-600 rounded-full group-hover:w-3 transition-all"></span> Wishlist</a></li>
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

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        function updateTimers() {
            const now = new Date().getTime();
            
            document.querySelectorAll('.loan-card').forEach(card => {
                const startVal = card.dataset.start;
                const endVal = card.dataset.end;
                const start = new Date(startVal).getTime();
                const end = new Date(endVal).getTime();
                
                const isCalculating = !startVal || !endVal || isNaN(start);
                
                const total = end - start;
                const elapsed = now - start;
                const remaining = end - now;

                let percentage = Math.max(1, Math.min(100, (elapsed / total) * 100)); 
                const bar = card.querySelector('.js-progress-bar');
                const miniBadge = card.querySelector('.js-status-badge-mini');
                const miniText = card.querySelector('.js-time-text-mini');
                const miniIcon = card.querySelector('.js-icon-mini');

                if (bar) bar.style.width = percentage + '%';

                function setBadge(color) {
                    if (!miniBadge) return;
                    
                    
                    const base = `js-status-badge-mini flex items-center gap-1.5 px-3 py-1.5 rounded-full border 
                                shadow-[0_2px_8px_rgba(0,0,0,0.1)] 
                                group-hover:shadow-[0_4px_12px_rgba(0,0,0,0.15)] 
                                transition-all duration-500`;
                    
                    const cardStyles = {
                        slate: "bg-slate-100 border-slate-200 text-slate-700 group-hover:bg-slate-500 group-hover:text-white group-hover:border-transparent",
                        rose: "bg-rose-100 border-rose-200 text-rose-700 group-hover:bg-rose-500 group-hover:text-white group-hover:border-transparent",
                        orange: "bg-orange-100 border-orange-200 text-orange-700 group-hover:bg-orange-500 group-hover:text-white group-hover:border-transparent",
                        emerald: "bg-emerald-100 border-emerald-200 text-emerald-700 group-hover:bg-emerald-500 group-hover:text-white group-hover:border-transparent"
                    };

                    const allColorClasses = Object.values(cardStyles).join(' ').split(' ');
                    miniBadge.classList.remove(...allColorClasses);
                    
                    miniBadge.className = `${base} ${cardStyles[color]}`;
                }

                if (isCalculating) {
                    if (miniText) miniText.innerText = "Calculating...";
                    if (miniIcon) {
                        miniIcon.innerText = "sync";
                        miniIcon.classList.add('animate-spin');
                    }
                    setBadge('emerald');
                } else if (remaining <= 0) {
                    if (miniText) miniText.innerText = "OVERDUE";
                    setBadge('rose');
                    if (bar) bar.className = "js-progress-bar h-full rounded-full bg-gradient-to-r from-rose-500 to-red-600 transition-all duration-1000";
                    if (miniIcon) {
                        miniIcon.innerText = "history_toggle_off";
                        miniIcon.classList.remove('animate-spin', 'animate-pulse');
                    }
                } else {
                    const days = Math.floor(remaining / (1000 * 60 * 60 * 24));
                    const hours = Math.floor((remaining % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    const mins = Math.floor((remaining % (1000 * 60 * 60)) / (1000 * 60));
                    const secs = Math.floor((remaining % (1000 * 60)) / 1000);

                    if (miniText) miniText.innerText = days > 0 ? `${days} Days Left` : `${hours}h ${mins}m ${secs}s`;
                    if (miniIcon) miniIcon.classList.remove('animate-spin');

                    if (percentage >= 85) {
                        if (bar) bar.className = "js-progress-bar h-full rounded-full bg-gradient-to-r from-rose-500 to-red-600 transition-all duration-1000";
                        setBadge('rose');
                        if (miniIcon) {
                            miniIcon.innerText = "warning";
                            miniIcon.classList.add('animate-pulse');
                        }
                    } else if (percentage >= 50) {
                        if (bar) bar.className = "js-progress-bar h-full rounded-full bg-gradient-to-r from-orange-400 to-orange-600 transition-all duration-1000";
                        setBadge('orange');
                        if (miniIcon) {
                            miniIcon.innerText = "hourglass_top";
                            miniIcon.classList.remove('animate-pulse');
                        }
                    } else {
                        if (bar) bar.className = "js-progress-bar h-full rounded-full bg-gradient-to-r from-emerald-400 to-teal-500 transition-all duration-1000";
                        setBadge('emerald');
                        if (miniIcon) {
                            miniIcon.innerText = "chrome_reader_mode";
                            miniIcon.classList.remove('animate-pulse');
                        }
                    }
                }
            });
        }
        
        setInterval(updateTimers, 1000);
        updateTimers();
    });
</script>
</body>
</html>