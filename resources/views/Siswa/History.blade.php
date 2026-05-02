<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Borrowing History - MyLibAry</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Plus+Jakarta+Sans:wght@700;800&family=Montserrat:wght@500;700;900&family=Space+Grotesk:wght@300;500;700&display=swap" rel="stylesheet" />
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
            backdrop-filter: blur(16px);
            background-color: rgba(255, 255, 255, 0.85);
        }

        .text-gradient {
            background: linear-gradient(to right, #1a1a1a, #2b6cee);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .history-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .history-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.05);
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
    </style>
</head>
<body class="text-slate-800 min-h-screen flex flex-col relative overflow-x-hidden">
    <div class="absolute top-0 right-0 -z-10 w-[500px] h-[500px] bg-blue-100/30 rounded-full blur-[120px] -translate-y-1/2 translate-x-1/2"></div>

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
                    <a class="font-bold text-slate-500 hover:text-blue-600 transition-all hover:-translate-y-1" href="{{ route('siswa.return') }}">Return</a>
                    <a class="font-black text-blue-600 border-b-2 border-blue-600 py-2 transition-all" href="{{ route('siswa.history') }}">History</a>
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

    <main class="flex-grow max-w-7xl mx-auto px-6 lg:px-12 py-10 w-full relative">
        <header class="mb-14 relative group/header">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-10 relative">
                <div class="relative pl-0">
                    <div class="absolute -left-6 top-0 w-1 h-20 bg-indigo-500 rounded-full"></div>
                    
                    <h1 class="text-6xl font-extrabold tracking-tighter mb-3 font-heading leading-tight">
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-slate-900 via-indigo-600 to-purple-500">
                            Your Reading <i class="italic">Archive.</i>
                        </span>
                    </h1>
                    
                    <p class="text-slate-500 mt-4 text-lg font-medium max-w-xl font-modern">
                        A comprehensive record of your reading journey and successfully completed returns.
                    </p>
                </div>

                <div class="flex flex-col items-start md:items-end justify-center min-w-[140px] w-fit md:ml-auto group">
                    <div class="flex items-center gap-2 mb-2">
                        <div class="flex items-center justify-center w-6 h-6 rounded-md bg-indigo-600 text-white shadow-md shadow-indigo-500/20 shrink-0 transition-all duration-500 ease-in-out group-hover:rotate-12 group-hover:scale-110">
                            <span class="material-symbols-outlined text-[14px] font-bold">receipt_long</span>
                        </div>
                        
                        <span class="font-accent text-[10px] font-black uppercase tracking-[0.3em] text-indigo-600/60 leading-none">
                            Total Archive
                        </span>
                    </div>
                    
                    <div class="flex items-baseline gap-2">
                        <span class="font-heading font-black text-6xl leading-none text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-purple-500 drop-shadow-sm">
                            {{ $histories->total() }}
                        </span>
                        
                        <span class="font-modern text-[22px] font-bold text-slate-500 leading-none whitespace-nowrap">
                            Records
                        </span>
                    </div>

                    <div class="w-full h-1.5 bg-gradient-to-r from-transparent via-indigo-500/20 to-transparent mt-2 rounded-full hidden md:block"></div>
                </div>
            </div>
        </header>

        <div class="space-y-4 mb-12">
            @forelse($histories as $history)

                    @php
                    // 1. PINDAHKAN LOGIKA WARNA KE PALING ATAS
                    $durationColors = [
                        ['bg' => 'bg-blue-100',    'border' => 'border-blue-200',    'border_l' => 'border-l-blue-400',    'text' => 'text-blue-700',    'hover_bg' => 'group-hover/returned-card:bg-blue-500',    'shadow' => 'rgba(37, 99, 235, 0.35)', 'shadow_deep' => 'rgba(37, 99, 235, 0.45)'],
                        ['bg' => 'bg-rose-100',    'border' => 'border-rose-200',    'border_l' => 'border-l-rose-400',    'text' => 'text-rose-700',    'hover_bg' => 'group-hover/returned-card:bg-rose-500',    'shadow' => 'rgba(225, 29, 72, 0.35)', 'shadow_deep' => 'rgba(225, 29, 72, 0.45)'],
                        ['bg' => 'bg-violet-100',  'border' => 'border-violet-200',  'border_l' => 'border-l-violet-400',  'text' => 'text-violet-700',  'hover_bg' => 'group-hover/returned-card:bg-violet-500',  'shadow' => 'rgba(124, 58, 237, 0.35)', 'shadow_deep' => 'rgba(124, 58, 237, 0.45)'],
                        ['bg' => 'bg-emerald-100', 'border' => 'border-emerald-200', 'border_l' => 'border-l-emerald-400', 'text' => 'text-emerald-700', 'hover_bg' => 'group-hover/returned-card:bg-emerald-500', 'shadow' => 'rgba(16, 185, 129, 0.35)', 'shadow_deep' => 'rgba(16, 185, 129, 0.45)'],
                        ['bg' => 'bg-amber-100',   'border' => 'border-amber-200',   'border_l' => 'border-l-amber-400',   'text' => 'text-amber-700',   'hover_bg' => 'group-hover/returned-card:bg-amber-500',   'shadow' => 'rgba(245, 158, 11, 0.35)', 'shadow_deep' => 'rgba(245, 158, 11, 0.45)'],
                        ['bg' => 'bg-slate-100',   'border' => 'border-slate-200',   'border_l' => 'border-l-slate-400',   'text' => 'text-slate-700',   'hover_bg' => 'group-hover/returned-card:bg-slate-500',   'shadow' => 'rgba(30, 41, 59, 0.35)',  'shadow_deep' => 'rgba(30, 41, 59, 0.45)'],
                        ['bg' => 'bg-indigo-100',  'border' => 'border-indigo-200',  'border_l' => 'border-l-indigo-400',  'text' => 'text-indigo-700',  'hover_bg' => 'group-hover/returned-card:bg-indigo-500',  'shadow' => 'rgba(79, 70, 229, 0.35)', 'shadow_deep' => 'rgba(79, 70, 229, 0.45)'],
                    ];

                    $clr = $durationColors[$loop->index % count($durationColors)];
                    $style = "--shadow-color: {$clr['shadow']}; --shadow-deep: {$clr['shadow_deep']};";
                @endphp

                   <div class="history-card bg-white rounded-[2.5rem] border-l-4 {{ $clr['border_l'] }} border border-slate-200 py-4 px-4 md:px-5 flex flex-col md:flex-row items-center gap-6 loan-item group/returned-card shadow-sm transition-all duration-500 transform-gpu 
                        hover:-translate-y-[0.375rem]
                        hover:shadow-[0_0_20px_rgba(79,70,229,0.2),0_15px_30px_-15px_rgba(0,0,0,0.1)]"
                        data-loan="{{ $history->loan_date->format('Y-m-d H:i:s') }}" 
                        data-due="{{ $history->due_date->format('Y-m-d H:i:s') }}" 
                        data-return="{{ $history->return_date->format('Y-m-d H:i:s') }}"
                        style="{{ $style }}">

                        <div class="flex items-center gap-5 w-full md:w-1/4 flex-shrink-0">
                            <div class="w-[5.75rem] h-[7.75rem] flex-shrink-0 rounded-[1.7rem] overflow-hidden shadow-lg transition-all duration-500 transform transform-gpu
                                    md:-translate-x-1 md:-rotate-3 border border-slate-200 bg-white
                                    
                                    /* Efek Hover untuk Buku (Tahap 1 - Tetap Sama Persis) */
                                    group-hover/returned-card:rotate-0 group-hover/returned-card:translate-x-0 group-hover/returned-card:scale-105
                                    group-hover/returned-card:border-indigo-400/80
                                    group-hover/returned-card:shadow-[0_0_15px_rgba(79,70,229,0.25),0_8px_15px_-5px_rgba(0,0,0,0.15)]
                                    
                                    /* Efek Hover Tahap 2 (Kursor tepat di area buku) */
                                    /* Radius menyebar tetap, Ketebalan (Opacity) Indigo sedikit dikurangi sesuai logika asli */
                                    hover:!rotate-[1.5deg]
                                    hover:!scale-110
                                    hover:!shadow-[0_4px_10px_rgba(79,70,229,0.35),0_2px_5px_rgba(0,0,0,0.1)]
                                    cursor-pointer">
                                    
                                    <img alt="{{ $history->book->title }}" 
                                        class="w-full h-full object-cover" 
                                        src="{{ asset($history->book->cover_image) }}"
                                        onerror="this.src='https://via.placeholder.com/150x225?text=No+Cover'"/>
                            </div>
                        
                        <div class="min-w-0"> 
                            <div class="overflow-hidden">
                                <h3 class="font-black text-2xl tracking-tighter font-heading leading-[1.2] pb-2 -mb-2 line-clamp-2 transform-gpu" 
                                    style="
                                        backface-visibility: hidden;
                                        background-image: linear-gradient(to right, #2563eb 5%, #7c3aed 50%, #db2777 95%);
                                        -webkit-background-clip: text;
                                        -webkit-text-fill-color: transparent;
                                    "
                                    title="{{ $history->book->title }}">
                                    {{ $history->book->title }}
                                </h3>   
                            </div>
                            
                            <div class="flex items-center gap-2 mt-3 transform-gpu" style="backface-visibility: hidden;"> 
                                <span class="author-line w-5 h-[2px] bg-blue-600/60 rounded-full flex-shrink-0 transition-all duration-500 ease-in-out group-hover/returned-card:w-8"></span>

                                <p class="text-[11px] text-blue-600/60 font-black font-accent uppercase tracking-[0.15em] italic truncate leading-none">
                                    {{ $history->book->author_name ?? $history->book->author }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="flex-grow w-full px-0 md:px-6 transform-gpu -translate-x-1">
                        <div class="flex justify-between items-end mb-3 -ml-3 w-[calc(100%+0.75rem)]"> 
                            <div class="text-center transition-transform duration-500 hover:-translate-y-1.5 cursor-default">
                                <p class="text-[10px] font-black text-emerald-500 uppercase tracking-widest mb-1 font-modern">Borrow Date</p>
                                <p class="text-[12px] font-bold text-white bg-emerald-500 px-3 py-1 rounded-lg shadow-sm">
                                    {{ $history->loan_date->format('M d, H:i') }}
                                </p>
                            </div>

                            <div class="pb-2 mb-6 relative z-10">
                                @php
                                    $start = $history->loan_date->copy()->second(0);
                                    $end = $history->return_date->copy()->second(0);
                                    $totalMinutes = (int) $start->diffInMinutes($end, true);
                                    $days = (int) ($totalMinutes / 1440);
                                    $remainingMinutes = $totalMinutes % 1440;
                                    $hours = (int) ($remainingMinutes / 60);
                                    $minutes = $remainingMinutes % 60;
                                @endphp

                           

                                    <div class="group/badge mx-auto flex items-center gap-1.5 px-3 py-1.5 rounded-full border {{ $clr['bg'] }} {{ $clr['border'] }} {{ $clr['text'] }} w-fit cursor-pointer transform-gpu
                                        /* TAHAP 1: Dasar (Shadow Hitam) */
                                        shadow-[0_2px_8px_rgba(0,0,0,0.12)] 
                                        
                                        /* TRANSISI */
                                        transition-all duration-700 ease-[cubic-bezier(0.25,0.1,0.25,1)]

                                        /* TAHAP 2: Hover Card */
                                        {{ $clr['hover_bg'] }}
                                        group-hover/returned-card:text-white 
                                        group-hover/returned-card:border-transparent 
                                        group-hover/returned-card:scale-105 
                                        group-hover/returned-card:shadow-[0_4px_12px_rgba(0,0,0,0.08),0_2px_14px_var(--shadow-color)]

                                        /* TAHAP 3: Hover Badge */
                                        hover:!scale-110 
                                        hover:-translate-y-1 
                                        hover:!shadow-[0_5px_12px_var(--shadow-deep)] 
                                        
                                        active:scale-95"
                                        style="{{ $style }}">
                                        
                                        <span class="material-symbols-outlined text-[14px] transition-all duration-700 ease-[cubic-bezier(0.25,0.1,0.25,1)] group-hover/badge:rotate-12 group-hover/badge:translate-x-1">
                                            schedule
                                        </span>

                                        <span class="text-[10px] font-black font-accent uppercase tracking-wider tabular-nums leading-none">
                                            @if($days >= 1)
                                                {{ $days }} {{ $days > 1 ? 'Days' : 'Day' }}
                                            @elseif($hours >= 1)
                                                {{ $hours }}h {{ $minutes > 0 ? $minutes . 'm' : '' }}
                                            @else
                                                {{ $minutes == 0 ? '1' : $minutes }} Min
                                            @endif
                                        </span>
                                    </div>
                            </div>

                            <div class="text-center transition-transform duration-500 hover:-translate-y-1.5 cursor-default">
                                <p class="text-[10px] font-black text-rose-400 uppercase tracking-widest mb-1 font-modern">Due Date</p>
                                <p class="text-[12px] font-black text-white bg-rose-600 px-3 py-1 rounded-lg shadow-sm">
                                    {{ $history->due_date->format('M d, H:i') }}
                                </p>
                            </div>
                        </div>

                        <div class="relative w-[calc(100%+0.75rem)] -ml-3 h-4 bg-slate-100 rounded-full overflow-hidden shadow-inner p-1 border border-slate-200/50">
                            <div class="js-progress-bar h-full rounded-full bg-slate-300 transition-all duration-1000 ease-out" 
                                style="width: 100%"></div>
                        </div>
                    </div>

                    <div class="flex flex-row md:flex-row items-center gap-6 w-full md:w-auto flex-shrink-0">
                        <div class="text-center w-[165px] flex flex-col items-center group/returned transition-all duration-700 ease-[cubic-bezier(0.4,0,0.2,1)] transform-gpu hover:-translate-y-2 -translate-x-3">
                            <p class="js-sub-text text-[10px] font-black mb-1.5 uppercase tracking-[0.2em] text-center w-full block transition-all duration-700 font-accent text-emerald-600/70 group-hover/returned:text-emerald-500">
                                Returned On
                            </p>
                            
                            <div class="w-full">
                                <div class="flex items-center px-4 h-9 rounded-full bg-emerald-500 text-white transition-all duration-700 ease-[cubic-bezier(0.4,0,0.2,1)] w-full justify-center border-none cursor-default transform-gpu 
                                    /* TAHAP 1: Tetap di 0.4 (Sudah Bagus) */
                                    shadow-[0_4px_12px_rgba(16,185,129,0.4)] 
                                    
                                    /* TAHAP 2: Radius melebar dikurangi dari 20px menjadi 16px agar lebih rapat */
                                    group-hover/returned:scale-105 
                                    group-hover/returned:shadow-[0_6px_16px_rgba(16,185,129,0.45)]">
                                    
                                    <p class="text-[12px] font-black font-modern uppercase tracking-tighter tabular-nums leading-none whitespace-nowrap">
                                        {{ $history->return_date->format('d M Y, H:i') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="w-[145px] flex-shrink-0">
                            <div class="js-status-badge flex items-center justify-center gap-2 px-3 py-1.5 rounded-xl border transition-all duration-500">
                                <span class="material-symbols-outlined text-base js-status-icon transition-all duration-500"></span>
                                
                                <span class="js-status-text text-[11px] font-black font-modern uppercase tracking-tighter tabular-nums leading-none whitespace-nowrap"></span>
                            </div>
                        </div>

                        <div class="flex flex-col gap-3">
                            <a href="{{ route('siswa.book.detail', $history->book_id) }}" 
                            class="group/view-btn w-10 h-10 flex items-center justify-center bg-blue-600 text-white rounded-xl transition-all duration-300 transform-gpu cursor-pointer
                                /* TAHAP 1: Tetap fokus (8px) */
                                shadow-[0_4px_8px_rgba(37,99,235,0.35)] 
                                
                                /* TAHAP 2: Radius HOVER disesuaikan ke 13px (Lebih rapat & solid) */
                                hover:-translate-y-1 hover:bg-blue-500 
                                hover:shadow-[0_6px_12px_rgba(37,99,235,0.45)] 
                                active:scale-95">
                                <span class="material-symbols-outlined text-[20px] transition-transform duration-300 group-hover/view-btn:-rotate-12">
                                    visibility
                                </span>
                            </a>

                            <form action="{{ route('siswa.history.destroy', $history->id) }}" method="POST" onsubmit="return confirm('Hapus riwayat ini?')" class="m-0">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="group/del-btn w-10 h-10 flex items-center justify-center bg-rose-600 text-white rounded-xl transition-all duration-300 transform-gpu
                                    /* TAHAP 1: Tetap fokus (8px) */
                                    shadow-[0_4px_8px_rgba(225,29,72,0.35)] 
                                    
                                    /* TAHAP 2: Radius HOVER disesuaikan ke 13px (Lebih rapat & solid) */
                                    hover:-translate-y-1 hover:bg-rose-500 
                                    hover:shadow-[0_6px_12px_rgba(225,29,72,0.45)] 
                                    active:scale-95">
                                    <span class="material-symbols-outlined text-[20px] transition-transform duration-300 group-hover/del-btn:rotate-12">
                                        delete
                                    </span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-20 text-center">
                    <span class="material-symbols-outlined text-slate-200 text-7xl mb-6">
                        history_edu
                    </span>
                    <p class="text-slate-400 font-accent uppercase tracking-widest text-xs font-bold mb-[22px]">
                        No reading history yet. 
                        <a href="{{ route('siswa.library') }}" 
                        class="relative inline-block text-[#2b6cee] hover:text-[#1a56cc] transition-colors duration-300 group">
                            Write your first chapter today!
                            <span class="absolute left-0 bottom-[-2px] w-0 h-[2px] bg-current transition-all duration-300 group-hover:w-full"></span>
                        </a>
                    </p>
                </div>
            @endforelse
        </div>


        <div class="flex justify-center items-center gap-2 font-accent mb-05">
            @if ($histories->hasPages())
                @if (!$histories->onFirstPage())
                    <a href="{{ $histories->previousPageUrl() }}" class="w-10 h-10 md:w-12 md:h-12 flex items-center justify-center rounded-xl border-2 border-slate-200 bg-white text-slate-400 hover:text-indigo-600 hover:border-indigo-600 hover:-translate-y-1.5 transition-all duration-300 shadow-sm mr-2 group">
                        <span class="material-symbols-outlined text-sm transition-transform group-hover:scale-110">arrow_back_ios_new</span>
                    </a>
                @endif

                @php
                    $currentPage = $histories->currentPage();
                    $lastPage = $histories->lastPage();
                    $start = max(1, $currentPage - ($currentPage == $lastPage ? 2 : 1));
                    $end = min($lastPage, $currentPage + ($currentPage == 1 ? 2 : 1));
                @endphp

                @foreach (range($start, $end) as $page)
                    @if ($page == $currentPage)
                        <div class="relative group transition-all duration-300">
                            <span class="w-12 h-12 md:w-14 md:h-14 flex items-center justify-center rounded-2xl bg-slate-900 text-white font-black text-base shadow-2xl shadow-slate-900/30 z-10 relative">
                                {{ $page }}
                            </span>
                            <div class="absolute inset-0 bg-indigo-500/20 blur-xl rounded-full scale-75 group-hover:scale-110 transition-all duration-300"></div>
                        </div>
                    @else
                        <a href="{{ $histories->url($page) }}" class="w-10 h-10 md:w-11 md:h-11 flex items-center justify-center rounded-xl border-2 border-slate-200 bg-white text-slate-500 font-bold text-sm hover:text-indigo-600 hover:border-indigo-600 hover:-translate-y-1.5 transition-all duration-300 shadow-sm">
                            {{ $page }}
                        </a>
                    @endif
                @endforeach

                @if ($histories->hasMorePages())
                    <a href="{{ $histories->nextPageUrl() }}" class="w-10 h-10 md:w-12 md:h-12 flex items-center justify-center rounded-xl border-2 border-slate-200 bg-white text-slate-400 hover:text-indigo-600 hover:border-indigo-600 hover:-translate-y-1.5 transition-all duration-300 shadow-sm ml-2 group">
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
                            Trace <span class="italic">Your Journey.</span>
                        </h2>

                        <div class="flex items-center justify-center gap-4 md:gap-8 w-full">
                            <div class="flex-grow h-[6px] bg-[#2b6cee] rounded-full shadow-sm"></div>
                            
                            <div class="group relative overflow-hidden inline-block text-slate-400 font-bold text-[10px] md:text-[11px] uppercase tracking-[0.3em] whitespace-nowrap bg-white/50 px-6 py-2.5 rounded-full border border-slate-200 shadow-sm cursor-default transition-all duration-500
                                    hover:text-white hover:border-transparent"
                            style="mask-image:radial-gradient(white,black); transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);">
                            
                            <span class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-700 cubic-bezier(0.4, 0, 0.2, 1) bg-gradient-to-r from-blue-600 to-cyan-500"></span>

                            <span class="relative z-10 transition-colors duration-500 group-hover:drop-shadow-[0_0_8px_rgba(255,255,255,0.5)]">
                                REDISCOVER YOUR READING HISTORY NOW
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
        const loans = document.querySelectorAll('.loan-item');
        
        function updateStatus(el, colorData) {
            const baseClasses = "js-status-badge flex items-center justify-center gap-2 w-[145px] px-3 py-1.5 rounded-xl border transition-all duration-700 ease-[cubic-bezier(0.4,0,0.2,1)] transform-gpu cursor-pointer group/status-badge";
            
            el.className = `${baseClasses} ${colorData.initial} ${colorData.cardHover} ${colorData.selfHover} active:scale-95`;
            
            const defaultShadow = "0 3px 10px rgba(0, 0, 0, 0.12)";
            el.style.boxShadow = defaultShadow;
            
            const cardElement = el.closest('.group\\/returned-card');

            if (cardElement) {
                cardElement.onmouseenter = () => {
                    el.style.boxShadow = `0 4px 12px rgba(0,0,0,0.05), 0 2px 14px ${colorData.shadowInitial}`;
                };
                cardElement.onmouseleave = () => {
                    el.style.boxShadow = defaultShadow;
                };
            }

            el.onmouseenter = (e) => {
                e.stopPropagation(); 
                
                el.style.boxShadow = `0 6px 14px ${colorData.shadowHover}`;
            };
            el.onmouseleave = () => {
                if (cardElement && cardElement.matches(':hover')) {
                    el.style.boxShadow = `0 4px 12px rgba(0,0,0,0.05), 0 2px 14px ${colorData.shadowInitial}`;
                } else {
                    el.style.boxShadow = defaultShadow;
                }
            };
        }

        loans.forEach(loan => {
            const dueTime = new Date(loan.dataset.due).getTime();
            const returnTime = new Date(loan.dataset.return).getTime();
            const loanTime = new Date(loan.dataset.loan).getTime();
            const totalDuration = dueTime - loanTime;
            const returnPosition = returnTime - loanTime;
            const diffInMinutes = (returnTime - dueTime) / (1000 * 60);
            let percentage = (returnPosition / totalDuration) * 100;
            if (isNaN(percentage)) percentage = 0;

            const progressBar = loan.querySelector('.js-progress-bar');
            const badge = loan.querySelector('.js-status-badge');
            const statusText = loan.querySelector('.js-status-text');
            const statusIcon = loan.querySelector('.js-status-icon');

            setTimeout(() => {
                if (!badge || !statusText || !statusIcon) return; 

                if (progressBar) {
                    const validPercentage = isNaN(percentage) ? 0 : Math.min(100, Math.max(1, percentage));
                    progressBar.style.width = validPercentage + '%';
                }

                const baseProgressClasses = "js-progress-bar h-full rounded-full transition-all duration-1000 ease-out ";

                let config = {};

                if (diffInMinutes > 10) { // ROSE
                    config = {
                        initial: "bg-rose-100 border-rose-200 text-rose-700",
                        cardHover: "group-hover/returned-card:bg-rose-500 group-hover/returned-card:text-white group-hover/returned-card:border-transparent group-hover/returned-card:scale-105",
                        selfHover: "hover:!scale-110 hover:-translate-y-1 hover:!bg-rose-600",
                        shadowInitial: "rgba(225, 29, 72, 0.40)", 
                        shadowHover: "rgba(225, 29, 72, 0.45)",    
                        iconColor: "text-rose-600"
                    };
                    if (statusText) statusText.innerText = "LATE RETURN";
                    if (statusIcon) statusIcon.innerText = "running_with_errors";
                    progressBar.className = baseProgressClasses + "bg-rose-500";

                } else if (diffInMinutes <= 10 && diffInMinutes >= -30) { // EMERALD
                    config = {
                        initial: "bg-emerald-100 border-emerald-200 text-emerald-700",
                        cardHover: "group-hover/returned-card:bg-emerald-500 group-hover/returned-card:text-white group-hover/returned-card:border-transparent group-hover/returned-card:scale-105",
                        selfHover: "hover:!scale-110 hover:-translate-y-1 hover:!bg-emerald-600",
                        shadowInitial: "rgba(16, 185, 129, 0.40)",
                        shadowHover: "rgba(16, 185, 129, 0.45)",
                        iconColor: "text-emerald-600"
                    };
                    if (statusText) statusText.innerText = "ON TIME";
                    if (statusIcon) statusIcon.innerText = "task_alt";
                    progressBar.className = baseProgressClasses + "bg-emerald-500";

                } else if (percentage >= 85) { // AMBER
                    config = {
                        initial: "bg-amber-100 border-amber-200 text-amber-700",
                        cardHover: "group-hover/returned-card:bg-amber-500 group-hover/returned-card:text-white group-hover/returned-card:border-transparent group-hover/returned-card:scale-105",
                        selfHover: "hover:!scale-110 hover:-translate-y-1 hover:!bg-amber-600",
                        shadowInitial: "rgba(245, 158, 11, 0.40)",
                        shadowHover: "rgba(245, 158, 11, 0.45)",
                        iconColor: "text-amber-600"
                    };
                    if (statusText) statusText.innerText = "LAST MOMENT";
                    if (statusIcon) statusIcon.innerText = "alarm_on";
                    progressBar.className = baseProgressClasses + "bg-amber-500";

                } else if (percentage >= 50) { // VIOLET
                    config = {
                        initial: "bg-violet-100 border-violet-200 text-violet-700",
                        cardHover: "group-hover/returned-card:bg-violet-500 group-hover/returned-card:text-white group-hover/returned-card:border-transparent group-hover/returned-card:scale-105",
                        selfHover: "hover:!scale-110 hover:-translate-y-1 hover:!bg-violet-600",
                        shadowInitial: "rgba(124, 58, 237, 0.40)",
                        shadowHover: "rgba(124, 58, 237, 0.45)",
                        iconColor: "text-violet-600"
                    };
                    if (statusText) statusText.innerText = "EARLY RETURN";
                    if (statusIcon) statusIcon.innerText = "model_training";
                    progressBar.className = baseProgressClasses + "bg-violet-500";

                } else { // BLUE
                    config = {
                        initial: "bg-blue-100 border-blue-200 text-blue-700",
                        cardHover: "group-hover/returned-card:bg-blue-500 group-hover/returned-card:text-white group-hover/returned-card:border-transparent group-hover/returned-card:scale-105",
                        selfHover: "hover:!scale-110 hover:-translate-y-1 hover:!bg-blue-600",
                        shadowInitial: "rgba(37, 99, 235, 0.40)",
                        shadowHover: "rgba(37, 99, 235, 0.45)",
                        iconColor: "text-blue-600"
                    };
                    if (statusText) statusText.innerText = "QUICK RETURN";
                    if (statusIcon) statusIcon.innerText = "speed";
                    progressBar.className = baseProgressClasses + "bg-blue-500";
                }

                updateStatus(badge, config);

                if (statusIcon) {
                    statusIcon.className = `material-symbols-outlined text-base js-status-icon transition-all duration-500 ${config.iconColor || ''} group-hover/returned-card:text-white group-hover/status-badge:rotate-12 group-hover/status-badge:translate-x-1`;
                }
            }, 150);
        });
    });
</script>
</body>
</html>