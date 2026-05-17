<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>{{ $book->title }} - MyLibAry</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Plus+Jakarta+Sans:wght@700;800&family=Montserrat:wght@500;700;900&family=Playfair+Display:wght@700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <style type="text/tailwindcss">
        :root {
            --bg-silver: #F8F9FC;
            --primary-blue: #2b6cee;
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
        .serif-title {
            font-family: 'Playfair Display', serif;
        }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .glass-nav {
            backdrop-filter: blur(16px);
            background-color: rgba(255, 255, 255, 0.85);
        }
        .book-mockup-shadow {
            box-shadow: 
                -10px 10px 20px rgba(0,0,0,0.1),
                -30px 30px 60px rgba(0,0,0,0.05),
                inset 1px 1px 0 rgba(255,255,255,0.2);
        }
        .text-gradient {
            background: linear-gradient(to right, #000000 0%, #1e3a8a 20%, #3b82f6 50%, #1d4ed8 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text; 
            color: transparent; 
        }      
    </style>
</head>
<body class="text-slate-800 min-h-screen flex flex-col relative overflow-x-hidden">
    {{-- Decorative Background Circle --}}
    <div class="absolute top-0 right-0 -z-10 w-[500px] h-[500px] bg-blue-100/30 rounded-full blur-[120px] -translate-y-1/2 translate-x-1/2"></div>

    {{-- NAVBAR --}}
    <nav class="sticky top-0 z-50 glass-nav border-b border-slate-200">
        <div class="max-w-full mx-auto px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <div class="flex items-center gap-2 flex-shrink-0 cursor-pointer" onclick="window.location.href='{{ route('siswa.dashboard') }}'">
                    <span class="material-symbols-outlined text-blue-600 text-3xl font-bold">auto_stories</span>
                    <span class="text-2xl font-black tracking-tighter text-slate-900 font-heading">My<span class="text-blue-600 italic">LibAry.</span></span>
                </div>

                <div class="hidden md:flex items-center space-x-8 flex-shrink-0 font-accent uppercase tracking-wider text-[11px]">
                    <a class="font-bold text-slate-500 hover:text-blue-600 transition-all hover:-translate-y-1" href="{{ route('siswa.dashboard') }}">Dashboard</a>
                    
                    {{-- Library & Book Breadcrumb dengan Separator Lebih Tebal --}}
                    <div class="flex items-center gap-2">
                        <a class="font-bold text-slate-500 hover:text-blue-600 transition-all hover:-translate-y-1" href="{{ route('siswa.library') }}">Library</a>
                        <span class="text-slate-300 font-bold">/</span>
                        <div class="max-w-[100px] truncate">
                            <span class="font-black text-blue-600 border-b-2 border-blue-600 py-2 truncate block" title="{{ $book->title }}">
                                {{ $book->title }}
                            </span>
                        </div>
                    </div>

                    <a class="font-bold text-slate-500 hover:text-blue-600 transition-all hover:-translate-y-1" href="{{ route('siswa.return') }}">Return</a>
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

    {{-- MAIN CONTENT --}}
    <main class="flex-grow max-w-[1400px] mx-auto px-6 lg:px-16 pt-12 pb-8 w-full relative">
        {{-- Breadcrumb - Elegan & Interaktif --}}
        <nav class="flex items-center mb-12 text-[11px] font-extrabold font-accent uppercase tracking-[0.2em]">
            {{-- Menggunakan font-extrabold untuk ketegasan yang pas --}}
            <a class="text-slate-400 hover:text-blue-600 hover:-translate-y-0.5 flex items-center gap-2 transition-all duration-300" href="{{ route('siswa.dashboard') }}">
                <span class="material-symbols-outlined text-[21px]">house</span> Dashboard
            </a>
            
            <span class="mx-3 text-slate-300 font-bold">/</span>
            
            <a class="text-slate-400 hover:text-blue-600 hover:-translate-y-0.5 transition-all duration-300" href="{{ route('siswa.library') }}">
                Library
            </a>
            
            <span class="mx-3 text-slate-300 font-bold">/</span>
            
            <div class="max-w-[400px] truncate">
                {{-- Bagian judul buku juga disesuaikan ke font-extrabold --}}
                <span class="text-blue-600 tracking-normal normal-case text-[13px] font-extrabold block truncate underline decoration-blue-600 underline-offset-4 decoration-2" title="{{ $book->title }}">
                    {{ $book->title }}
                </span>
            </div>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 items-start">
            {{-- Book Cover Mockup --}}
            <div class="lg:col-span-5 flex justify-center sticky top-32">
                <div class="relative group max-w-sm w-full">
                    {{-- Shadow hitam (book-mockup-shadow) dan model lainnya dipertahankan sama persis --}}
                    <div class="book-mockup-shadow aspect-[3/4.5] rounded-2xl bg-white overflow-hidden transform -rotate-2 hover:rotate-0 transition-transform duration-700 border border-slate-200">
                        <img alt="{{ $book->title }}" class="w-full h-full object-cover" src="{{ asset($book->cover_image) }}" onerror="this.src='https://via.placeholder.com/600x900?text=No+Cover'"/>
                    </div>
                    
                    {{-- SHADOW BIRU: Ditebalkan sedikit (10->15 sebelum hover, 20->30 sesudah hover) --}}
                    <div class="absolute -inset-8 bg-blue-500/15 blur-3xl rounded-full -z-10 group-hover:bg-blue-500/30 transition-colors duration-700"></div>
                </div>
            </div>

            @php
                $colorSchemes = [
                    // Hanya mengubah 'shadow' (sebelum hover) menjadi sedikit lebih tipis (0.18)
                    ['bg' => 'bg-blue-100',    'text' => 'text-blue-700',    'border' => 'border-blue-200',    'hover' => 'hover:bg-blue-600',    'shadow' => 'rgba(37, 99, 235, 0.18)', 'shadow_deep' => 'rgba(37, 99, 235, 0.30)'],
                    ['bg' => 'bg-rose-100',    'text' => 'text-rose-700',    'border' => 'border-rose-200',    'hover' => 'hover:bg-rose-600',    'shadow' => 'rgba(225, 29, 72, 0.18)', 'shadow_deep' => 'rgba(225, 29, 72, 0.30)'],
                    ['bg' => 'bg-amber-100',   'text' => 'text-amber-700',   'border' => 'border-amber-200',   'hover' => 'hover:bg-amber-600',   'shadow' => 'rgba(245, 158, 11, 0.18)', 'shadow_deep' => 'rgba(245, 158, 11, 0.30)'],
                    ['bg' => 'bg-emerald-100', 'text' => 'text-emerald-700', 'border' => 'border-emerald-200', 'hover' => 'hover:bg-emerald-600', 'shadow' => 'rgba(16, 185, 129, 0.18)', 'shadow_deep' => 'rgba(16, 185, 129, 0.30)'],
                    ['bg' => 'bg-indigo-100',  'text' => 'text-indigo-700',  'border' => 'border-indigo-200',  'hover' => 'hover:bg-indigo-600',  'shadow' => 'rgba(79, 70, 229, 0.18)', 'shadow_deep' => 'rgba(79, 70, 229, 0.30)'],
                    ['bg' => 'bg-violet-100',  'text' => 'text-violet-700',  'border' => 'border-violet-200',  'hover' => 'hover:bg-violet-600',  'shadow' => 'rgba(124, 58, 237, 0.18)', 'shadow_deep' => 'rgba(124, 58, 237, 0.30)'],
                    ['bg' => 'bg-cyan-100',    'text' => 'text-cyan-700',    'border' => 'border-cyan-200',    'hover' => 'hover:bg-cyan-600',    'shadow' => 'rgba(8, 145, 178, 0.18)',  'shadow_deep' => 'rgba(8, 145, 178, 0.30)'],
                ];

                $categoryColor = $colorSchemes[array_rand($colorSchemes)];
                $style = "--shadow-color: {$categoryColor['shadow']}; --shadow-deep: {$categoryColor['shadow_deep']};";
            @endphp

            {{-- Book Info --}}
            {{-- Book Info --}}
            <div class="lg:col-span-7 flex flex-col space-y-10">
                <div class="flex flex-col items-start justify-start text-left w-full">
                    <span class="inline-flex items-center px-5 py-2 rounded-xl text-[10px] font-black tracking-[0.2em] uppercase font-accent border cursor-default mb-6 transform-gpu
                        {{ $categoryColor['bg'] }} 
                        {{ $categoryColor['text'] }} 
                        {{ $categoryColor['border'] }}
                        
                        /* SHADOW SEBELUM HOVER: Hitam tetap 0.02, Berwarna ditipiskan sangat sedikit ke 0.18 */
                        shadow-[0_2px_8px_rgba(0,0,0,0.02),0_2px_14px_var(--shadow-color)]

                        /* TRANSISI: Tetap sama (Smooth) */
                        transition-all duration-700 ease-[cubic-bezier(0.25,0.1,0.25,1)]

                        /* KONDISI HOVER: Tetap (Sama Persis Sebelumnya) */
                        {{ $categoryColor['hover'] }}
                        hover:text-white 
                        hover:-translate-y-1 
                        hover:scale-105 
                        hover:!shadow-[0_5px_12px_var(--shadow-deep)] 

                        active:scale-95"
                        style="{{ $style }}">
                        {{ $book->category_name ?? 'General Collection' }}
                    </span>
                    
                    <h1 class="font-heading text-5xl md:text-6xl font-black leading-[1.25] pb-2 mb-4 tracking-tighter text-gradient text-left w-full transform-gpu">
                        {{ $book->title }}
                    </h1>
                    
                    {{-- Author Section - Rata kiri dengan efek hover ke atas --}}
                    <div class="text-2xl text-blue-600/60 font-medium font-accent uppercase tracking-[0.3em] mb-6 flex items-center w-fit justify-start group transition-transform duration-300 hover:-translate-y-1">
                        <span class="group-hover:text-blue-600 transition-colors duration-300 cursor-default text-left">
                            {{ $book->author_name }}
                        </span>
                    </div>

                    {{-- Rating Component --}}
                    <div class="inline-flex items-center gap-3 bg-white px-4 py-2 rounded-2xl border border-slate-200 
                        /* Kondisi Awal: Shadow Hitam Sangat Tipis (0.02) & Shadow Amber Dominan (0.2) */
                        shadow-[0_4px_10px_0_rgba(0,0,0,0.02),0_4px_12px_0_rgba(37,99,235,0.15)] 
    
                        /* Kondisi Hover: Menyebar tapi tetap Ringan (Soft Glow) */
                        hover:-translate-y-1 
                        hover:shadow-[0_12px_20px_-8px_rgba(37,99,235,0.25)] 
                        
                        /* Animasi Smooth: Durasi 500ms agar transisinya tidak kaget */
                        transition-all duration-500 ease-out cursor-default group transform-gpu"
                        style="backface-visibility: hidden; isolation: isolate; perspective: 1000px; -webkit-perspective: 1000px;">

                        <div class="flex text-amber-400">
                            @php $avg = $book->reviews->avg('rating') ?? 0; @endphp
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= floor($avg))
                                    <span class="material-symbols-outlined text-[18px] fill-icon group-hover:scale-110 transition-transform duration-300">star</span>
                                @elseif($i == ceil($avg) && ($avg - floor($avg) >= 0.3))
                                    <span class="material-symbols-outlined text-[18px] fill-icon group-hover:scale-110 transition-transform duration-300">star_half</span>
                                @else
                                    <span class="material-symbols-outlined text-[18px] text-slate-300 group-hover:scale-110 transition-transform duration-300">star</span>
                                @endif
                            @endfor
                        </div>
                        
                        <div class="flex items-center font-accent transform-gpu" style="will-change: transform;">
                            <span class="text-sm font-black text-slate-900 leading-none antialiased">{{ number_format($avg, 1) }}</span>
                            
                            {{-- GARIS: Menggunakan border-l (lebih stabil di browser daripada width) --}}
                            <div class="h-4 border-l-2 border-slate-300/60 mx-2 flex-shrink-0 transform-gpu" style="backface-visibility: hidden;"></div>

                            <span class="text-[9px] font-black text-slate-600 uppercase tracking-[0.2em] leading-none antialiased">
                                {{ $book->reviews->count() }} Reviews
                            </span>
                        </div>
                    </div>
                </div>

                <div class="space-y-4 group cursor-default">
                    {{-- Header Synopsis dengan Efek Hover --}}
                    <h3 class="text-[13px] font-black text-blue-600/60 group-hover:text-blue-600 uppercase tracking-[0.4em] font-accent flex items-center gap-3 transition-all duration-500 ease-out">
                        {{-- Garis yang memanjang saat hover --}}
                        <span class="w-8 h-[3px] bg-blue-600/60 rounded-full group-hover:bg-blue-600 group-hover:w-16 transition-all duration-500 ease-out"></span>
                        SYNOPSIS
                    </h3>

                    {{-- Konten Synopsis --}}
                    <div class="text-slate-500 font-medium leading-relaxed max-w-none text-[16px] serif-title transition-colors duration-500 group-hover:text-slate-600">
                        <p class="first-letter:text-4xl first-letter:font-black first-letter:text-slate-900 first-letter:mr-1 first-letter:float-left">
                            {{ $book->summary ?? 'No summary available for this book.' }}
                        </p>
                    </div>
                </div>

                {{-- Specs Grid --}}
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-8 pt-10 border-t border-slate-400 font-accent">
                {{-- Total Pages --}}
                <div class="min-w-0 group transition-transform duration-300 hover:-translate-y-2 cursor-default">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2 group-hover:text-blue-600 transition-colors">Total Pages</p>
                    <div class="flex items-baseline">
                        <p class="text-xl font-black bg-gradient-to-r from-slate-900 from-10% via-blue-700 via-50% to-blue-500 bg-clip-text text-transparent">
                            {{ $book->total_pages ?? '-' }}
                        </p>
                        <span class="text-[13px] text-blue-600 font-black ml-1">PGS</span>
                    </div>
                </div>

                {{-- Publisher --}}
                <div class="min-w-0 group transition-transform duration-300 hover:-translate-y-2 cursor-default">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2 group-hover:text-rose-500 transition-colors">Publisher</p>
                    <p class="text-xl font-black leading-tight uppercase tracking-tighter bg-gradient-to-r from-slate-900 from-10% via-rose-600 via-50% to-rose-400 bg-clip-text text-transparent">
                        {{ $book->publisher ?? 'N/A' }}
                    </p>
                </div>

                {{-- Published Date --}}
                <div class="min-w-0 group transition-transform duration-300 hover:-translate-y-2 cursor-default">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2 group-hover:text-emerald-500 transition-colors">Published</p>
                    <p class="text-xl font-black bg-gradient-to-r from-slate-900 from-10% via-emerald-600 via-50% to-emerald-400 bg-clip-text text-transparent">
                        {{ $book->published_date ?? 'N/A' }}
                    </p>
                </div>
            </div>

                {{-- Tags Section - Multi-Color Random Style --}}
                {{-- Tags Section --}}
                <div class="pb-10 border-b border-slate-400"> {{-- Div ini diam untuk menjaga border tetap di bawah --}}
                    <div class="space-y-4 font-accent group transition-transform duration-300 hover:-translate-y-2"> {{-- Efek angkat kontainer tetap utuh --}}
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] group-hover:text-violet-600 transition-colors">Tags & Keywords</p>
                        <div class="flex flex-wrap gap-x-3.5 gap-y-4">
                            @php
                                // 1. SKEMA WARNA & SHADOW (SAMA PERSIS DENGAN MODEL SEBELUMNYA)
                                $colorSchemes = [
                                    ['bg' => 'bg-blue-100',    'text' => 'text-blue-700',    'border' => 'border-blue-200',    'hover' => 'hover:bg-blue-600',    'shadow' => 'rgba(37, 99, 235, 0.18)', 'shadow_deep' => 'rgba(37, 99, 235, 0.30)'],
                                    ['bg' => 'bg-rose-100',    'text' => 'text-rose-700',    'border' => 'border-rose-200',    'hover' => 'hover:bg-rose-600',    'shadow' => 'rgba(225, 29, 72, 0.18)', 'shadow_deep' => 'rgba(225, 29, 72, 0.30)'],
                                    ['bg' => 'bg-amber-100',   'text' => 'text-amber-700',   'border' => 'border-amber-200',   'hover' => 'hover:bg-amber-600',   'shadow' => 'rgba(245, 158, 11, 0.18)', 'shadow_deep' => 'rgba(245, 158, 11, 0.30)'],
                                    ['bg' => 'bg-emerald-100', 'text' => 'text-emerald-700', 'border' => 'border-emerald-200', 'hover' => 'hover:bg-emerald-600', 'shadow' => 'rgba(16, 185, 129, 0.18)', 'shadow_deep' => 'rgba(16, 185, 129, 0.30)'],
                                    ['bg' => 'bg-indigo-100',  'text' => 'text-indigo-700',  'border' => 'border-indigo-200',  'hover' => 'hover:bg-indigo-600',  'shadow' => 'rgba(79, 70, 229, 0.18)', 'shadow_deep' => 'rgba(79, 70, 229, 0.30)'],
                                    ['bg' => 'bg-violet-100',  'text' => 'text-violet-700',  'border' => 'border-violet-200',  'hover' => 'hover:bg-violet-600',  'shadow' => 'rgba(124, 58, 237, 0.18)', 'shadow_deep' => 'rgba(124, 58, 237, 0.30)'],
                                    ['bg' => 'bg-cyan-100',    'text' => 'text-cyan-700',    'border' => 'border-cyan-200',    'hover' => 'hover:bg-cyan-600',    'shadow' => 'rgba(8, 145, 178, 0.18)',  'shadow_deep' => 'rgba(8, 145, 178, 0.30)'],
                                ];

                                // 2. LOGIKA TAGS TETAP UTUH (TIDAK BERUBAH)
                                $rawTags = explode(',', $book->tags ?? '');
                                $finalTags = [];
                                $seenKeys = [];

                                foreach ($rawTags as $tag) {
                                    $trimmed = trim($tag);
                                    if (empty($trimmed)) continue;
                                    $key = preg_replace('/[^a-z]/', '', strtolower($trimmed));
                                    $key = rtrim($key, 's'); 
                                    if (!isset($seenKeys[$key])) {
                                        $seenKeys[$key] = true;
                                        $finalTags[] = ucwords(strtolower($trimmed));
                                    }
                                }

                                $shuffledColors = $colorSchemes;
                                shuffle($shuffledColors);
                            @endphp
                            
                            @foreach($finalTags as $index => $displayTag)
                                @php 
                                    $tagColor = $shuffledColors[$index % count($shuffledColors)]; 
                                    $tagStyle = "--shadow-color: {$tagColor['shadow']}; --shadow-deep: {$tagColor['shadow_deep']};";
                                @endphp
                                <span class="inline-flex items-center px-4 py-2 rounded-xl text-[12px] font-bold tracking-tight border cursor-default transform-gpu
                                    {{-- Ketebalan Warna Sesuai Referensi --}}
                                    {{ $tagColor['bg'] }} 
                                    {{ $tagColor['text'] }} 
                                    {{ $tagColor['border'] }}
                                    
                                    {{-- Shadow Sebelum Hover (Hitam 0.02 + Warna 0.18) --}}
                                    shadow-[0_2px_8px_rgba(0,0,0,0.02),0_2px_14px_var(--shadow-color)]

                                    {{-- Transisi 700ms Cubic-Bezier Sesuai Referensi --}}
                                    transition-all duration-700 ease-[cubic-bezier(0.25,0.1,0.25,1)]

                                    {{-- Efek Hover Tag (Shadow Deep 0.30) --}}
                                    {{ $tagColor['hover'] }}
                                    hover:text-white 
                                    hover:-translate-y-1 
                                    hover:scale-105 
                                    hover:!shadow-[0_5px_12px_var(--shadow-deep)] 

                                    active:scale-95"
                                    style="{{ $tagStyle }}">
                                    #{{ $displayTag }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- Action Buttons --}}
            

                <div class="flex flex-col sm:flex-row gap-5 pt-4">
                    @php
                        $isCurrentlyBorrowed = false;
                        $hasBorrowedBefore = false;
                        $isWishlisted = false;
                        $isRejected = false;
                        $hasFine = false;
                        $cooldownExpiry = null;

                        if(auth()->check()) {
                            $currentUser = auth()->user();
                            $now = \Carbon\Carbon::now('Asia/Jakarta');
                            
                            $fineBalance = \App\Models\UserFineBalance::where('user_id', $currentUser->user_id)->first();
                            $fixedFine = $fineBalance ? $fineBalance->total_fine : 0;

                            $runningFine = 0;
                            $overdueLoans = \App\Models\Loan::where('user_id', $currentUser->user_id)
                                ->where('status', 'borrowed')
                                ->where('due_date', '<', $now)
                                ->get();

                            foreach ($overdueLoans as $loan) {
                                $due = \Carbon\Carbon::parse($loan->due_date);
                                $days = ceil($due->diffInSeconds($now) / 86400);
                                
                                if ($days >= 1) $runningFine += 10000;
                                if ($days > 1) $runningFine += ($days - 1) * 5000;
                            }

                            if (($fixedFine + $runningFine) > 0) {
                                $hasFine = true;
                            }

                            
                            $isCurrentlyBorrowed = \App\Models\Loan::where('user_id', $currentUser->user_id)
                                ->where('book_id', $book->id)
                                ->where('status', 'borrowed')
                                ->exists();

                            $isPending = \App\Models\Loan::where('user_id', $currentUser->user_id)
                                ->where('book_id', $book->id)
                                ->where('status', 'pending')
                                ->exists();


                            $hasBorrowedBefore = \App\Models\Loan::where('user_id', $currentUser->user_id)
                                ->where('book_id', $book->id)
                                ->where('status', 'returned')
                                ->exists();

                            $isWishlisted = $currentUser->wishlists()->where('book_id', $book->id)->exists();

                            $rejectedLoan = \App\Models\Loan::where('user_id', auth()->id())
                                    ->where('book_id', $book->id)
                                    ->where('status', 'rejected')
                                    ->latest('updated_at')
                                    ->first();

                                if ($rejectedLoan) {
                                    // Waktu saat admin klik reject + 24 jam tepat
                                    $expiry = $rejectedLoan->updated_at->addHours(24);
                                    
                                    if ($expiry->isFuture()) {
                                        $isRejected = true;
                                        $cooldownExpiry = $expiry->toIso8601String(); // Untuk dibaca JavaScript
                                    }
                                }
                        }
                    @endphp
                    
                    @if($isCurrentlyBorrowed)
                        {{-- Tampilan Tombol Saat Sudah Dipinjam (Disabled & Abu-abu) --}}
                        <button disabled class="flex-grow flex items-center justify-center gap-4 
                            bg-slate-200 text-slate-500 px-10 py-6 rounded-[2rem] 
                            font-black font-accent uppercase tracking-widest text-xs 
                            cursor-not-allowed border border-slate-300 shadow-inner">
                            <span class="material-symbols-outlined text-xl">bookmark_added</span>
                            Already Borrowed
                        </button>

                    @elseif($hasFine)
                        <button disabled class="flex-grow flex items-center justify-center gap-4 
                            bg-slate-200 text-slate-500 px-10 py-6 rounded-[2rem] 
                            font-black font-accent uppercase tracking-widest text-xs 
                            cursor-not-allowed border border-slate-300 shadow-inner">
                            <span class="material-symbols-outlined text-xl">block</span>
                            Pay Off Your Fine First
                        </button>


                    @elseif($isPending) {{-- TAMBAHKAN KONDISI INI --}}
                        <button disabled class="flex-grow flex items-center justify-center gap-4 
                            bg-slate-200 text-slate-500 px-10 py-6 rounded-[2rem] 
                            font-black font-accent uppercase tracking-widest text-xs 
                            cursor-not-allowed border border-slate-300 shadow-inner">
                            <span class="material-symbols-outlined text-xl">hourglass_empty</span>
                            Waiting for Approval
                        </button>

                    @elseif($isRejected)
                        <button id="btn-cooldown" disabled 
                            data-expire="{{ $cooldownExpiry }}" class="flex-grow flex items-center justify-center gap-4 
                            bg-slate-200 text-slate-500 px-10 py-6 rounded-[2rem] 
                            font-black font-accent uppercase tracking-widest text-xs 
                            cursor-not-allowed border border-slate-300 shadow-inner">
                            <span class="material-symbols-outlined text-xl">timer_off</span>
                            <span>Retry in <span id="cooldown-timer">24:00:00</span></span>
                        </button>

                    @elseif($hasBorrowedBefore)
                            {{-- Tampilan Tombol Jika Pernah Meminjam Sebelumnya (Blue to Emerald Gradient) --}}
                            <button onclick="openBorrowModal()" class="flex-grow flex items-center justify-center gap-4 
                                /* GRADIENT MODEL: Emerald Tua ke Emerald ke Emerald Terang (Konsisten dengan stops referensi) */
                                bg-gradient-to-r from-slate-950 from-0% via-emerald-700 via-25% via-emerald-600 via-35% to-emerald-500 
                                bg-[length:250%_150%] bg-left text-white 
                                
                                /* UKURAN & BENTUK: Dipertahankan tetap sama persis */
                                px-10 py-6 rounded-[2rem] font-black font-accent uppercase tracking-widest text-xs 
                                
                                /* EFEK HOVER & TRANSISI: Lift naik & Shadow Glow tebal (rgba 16, 185, 129 sesuai Emerald-500) */
                                transition-all duration-500 ease-in-out transform
                                hover:bg-right hover:-translate-y-2 
                                shadow-2xl shadow-slate-900/20 hover:shadow-[0_15px_30px_-5px_rgba(16,185,129,0.4)]
                                
                                /* STRUKTUR & BORDER */
                                group border-t border-white/10 relative overflow-hidden">
                                
                                <span class="inline-block transition-transform duration-500 group-hover:scale-110 group-hover:translate-x-1">
                                    <span class="material-symbols-outlined text-xl block">local_library</span>
                                </span>

                                <span class="relative z-10">Read This Book Again</span>
                            </button>
                    @else
                        {{-- Tampilan Tombol Normal --}}
                        <button onclick="openBorrowModal()" class="flex-grow flex items-center justify-center gap-4 
                            /* GRADIENT MODEL: Biru Tua ke Biru ke Biru Royal (Sama persis dengan referensi) */
                            bg-gradient-to-r from-slate-950 from-0% via-blue-700 via-25% via-blue-600 via-35% to-blue-500 
                            bg-[length:250%_150%] bg-left text-white 
                            
                            /* UKURAN & BENTUK: Dipertahankan tetap sama persis */
                            px-10 py-6 rounded-[2rem] font-black font-accent uppercase tracking-widest text-xs 
                            
                            /* EFEK HOVER & TRANSISI: Lift naik & Shadow Glow tebal (rgba 37, 99, 235) */
                            transition-all duration-500 ease-in-out transform
                            hover:bg-right hover:-translate-y-2 
                            shadow-2xl shadow-slate-900/20 hover:shadow-[0_15px_30px_-5px_rgba(37,99,235,0.4)]
                            
                            /* STRUKTUR & BORDER */
                            group border-t border-white/10 relative overflow-hidden">
                            
                            <span class="inline-block transition-transform duration-500 group-hover:scale-110 group-hover:translate-x-1">
                                <span class="material-symbols-outlined text-xl block">menu_book</span>
                            </span>

                            <span class="relative z-10">Borrow This Book</span>
                        </button>
                    @endif

                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const cooldownBtn = document.getElementById('btn-cooldown');
                            const timerDisplay = document.getElementById('cooldown-timer');

                            if (cooldownBtn && timerDisplay) {
                                const targetDate = new Date(cooldownBtn.dataset.expire).getTime();

                                const updateTimer = () => {
                                    const now = new Date().getTime();
                                    const distance = targetDate - now;

                                    if (distance <= 0) {
                                        clearInterval(interval);
                                        window.location.reload();
                                        return;
                                    }

                                    const h = Math.floor((distance / (1000 * 60 * 60)));
                                    const m = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                                    const s = Math.floor((distance % (1000 * 60)) / 1000);

                                    timerDisplay.textContent = `${String(h).padStart(2, '0')}:${String(m).padStart(2, '0')}:${String(s).padStart(2, '0')}`;
                                };

                                const interval = setInterval(updateTimer, 1000);
                                updateTimer(); 
                            }
                        });
                        </script>

                    {{-- Kode Wishlist Anda Tetap Di Sini --}}
                    @php
                        $isWishlisted = false;
                        // Gunakan auth() standar tanpa guard agar Admin & Siswa bisa terdeteksi
                        if(auth()->check()) {
                            $isWishlisted = auth()->user()->wishlists()->where('book_id', $book->id)->exists();
                        }
                    @endphp

                    <button id="btn-wishlist" onclick="handleWishlist({{ $book->id }})" 
                        class="flex items-center justify-center gap-2 border px-10 py-6 rounded-[2rem] font-black font-accent uppercase tracking-widest text-xs transition-all duration-300 shadow-lg group 
                        
                        /* EFEK HOVER: Tetap dipertahankan sesuai kode asli */
                        hover:-translate-y-2 hover:shadow-rose-400/40 
                        
                        /* LOGIKA PERMANEN SAAT WISHLIST AKTIF */
                        {{ $isWishlisted 
                            ? 'bg-rose-500 border-rose-500 text-white shadow-rose-200/50' 
                            : 'bg-white border-slate-200 text-slate-900 shadow-slate-200/50' 
                        }}">
                        
                        <span id="icon-wishlist" class="material-symbols-outlined text-2xl transition-transform group-hover:scale-110 
                            /* LOGIKA WARNA IKON: Putih saat aktif, Abu-abu saat tidak aktif */
                            {{ $isWishlisted ? 'text-white' : 'text-slate-400' }}" 
                            style="font-variation-settings: 'FILL' {{ $isWishlisted ? 1 : 0 }}">
                            favorite
                        </span>
                        
                        <span id="text-wishlist">Wishlist</span>
                    </button>
                </div>
            </div>
        </div>


        <div id="borrowModal" class="fixed inset-0 z-[100] hidden ">
    <div class="absolute inset-0 bg-slate-950/40 backdrop-blur-[6px] transition-opacity" onclick="closeBorrowModal()"></div>
    
    <div class="flex min-h-full items-center justify-center p-6">
        <div class="relative w-full max-w-md transform overflow-hidden group/modal rounded-[3.5rem] bg-[#F8F9FC] p-10 transition-all border border-slate-100 shadow-[0_35px_60px_-15px_rgba(37,99,235,0.25)] group/header group/modal">
            
            <div class="flex justify-between items-start mb-8">
                <div>
                    <h3 class="text-3xl font-black font-heading tracking-tighter bg-clip-text text-transparent transform-gpu pr-1"
                        style="background-image: linear-gradient(to right, #000000 0%, #1e3a8a 20%, #3b82f6 50%, #1d4ed8 100%); 
                               -webkit-background-clip: text; 
                               -webkit-text-fill-color: transparent;">
                        Borrowing Details
                    </h3>
                    
                    <p class="text-xs text-slate-400 font-bold uppercase tracking-[0.2em] mt-2 flex items-center gap-2 group-hover/header:text-blue-600 transition-colors duration-500">
                        <span class="inline-block w-8 h-[2px] bg-blue-600 rounded-full transition-[width] duration-500 ease-out group-hover/header:w-12 will-change-[width]"></span>
                        <span class="transition-transform duration-500 group-hover/header:translate-x-1">
                            Schedule System
                        </span>
                    </p>
                </div>

                <button type="button" onclick="closeBorrowModal()" class="group/close relative">
                    <div class="relative flex items-center justify-center w-11 h-11 bg-white border-2 border-slate-100 rounded-xl transition-all duration-500 
                        group-hover/close:bg-rose-500 
                        group-hover/close:border-rose-500 
                        group-hover/close:rotate-90 
                        group-hover/close:shadow-[0_0_20px_rgba(244,63,94,0.5)]">
                        <span class="material-symbols-outlined text-slate-400 group-hover/close:text-white text-xl font-bold transition-colors">close</span>
                    </div>
                </button>
            </div>

         


            <form id="borrowForm" action="{{ route('siswa.borrow.store', $book->id) }}" method="POST" class="space-y-8">
                @csrf
                
                <div id="date_group" class="space-y-3 group/date transition-all duration-300 relative group/date
                    hover:-translate-y-1 focus-within:-translate-y-1 [&.is-active]:-translate-y-1">
                    
                    <label class="text-[11px] font-extrabold text-slate-400 uppercase tracking-[0.3em] block font-accent transition-colors duration-300 
                        group-hover/date:text-blue-600 group-focus-within/date:text-blue-600 group-[.is-active]/date:text-blue-600">
                        Return Due Date
                    </label>
                    
                    <div class="relative group/card-input">
                        <span class="material-symbols-outlined absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 
                            pointer-events-none
                            group-focus-within/date:text-blue-600 group-[.is-active]/date:text-blue-600 transition-colors z-10">
                            calendar_month
                        </span>
                        
                        <input type="date" name="due_date" id="due_date_input" required 
                            oninput="checkDateInput(this)"
                            onchange="checkDateInput(this)"
                            min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                            max="{{ date('Y-m-d', strtotime('+14 days')) }}"
                            class="w-full bg-white rounded-[1.8rem] py-5 pl-14 pr-6 text-sm font-black 
                                transition-all duration-700 ease-in-out outline-none text-slate-700 shadow-inner
                                
                                /* MODEL BORDER ASIMETRIS (TETAP) */
                                border border-slate-200 border-r-4 border-r-slate-200
                                
                                /* EFEK AKTIF: Hanya saat Klik (Focus) */
                                focus:ring-8 focus:ring-blue-600/5 focus:border-blue-500/40 focus:border-r-blue-500/60 
                                focus:shadow-xl focus:shadow-blue-900/10
                                
                                /* EFEK AKTIF: Saat Tanggal Terisi (Is-Active) */
                                group-[.is-active]/date:ring-8 group-[.is-active]/date:ring-blue-600/5 
                                group-[.is-active]/date:border-blue-500/40 group-[.is-active]/date:border-r-blue-500/60
                                group-[.is-active]/date:shadow-xl group-[.is-active]/date:shadow-blue-900/10">
                    </div> 
                </div>

                <div class="!mt-6 flex items-center gap-2 px-1 transition-all duration-500 
                        group-hover/modal:opacity-100 group-[.is-active]/date:opacity-100 opacity-60
                        group-hover/modal:-translate-y-1 ">
                        
                        <span class="material-symbols-outlined text-amber-500 text-lg transition-all duration-500 
                            group-hover/modal:scale-110 
                            group-[.is-active]/date:scale-110 ">
                            info
                        </span>
                        
                        <p class="text-[12px] text-slate-500 leading-relaxed font-medium transition-all duration-500
                            group-hover/modal:font-bold group-hover/modal:text-slate-700
                            group-[.is-active]/date:font-bold group-[.is-active]/date:text-slate-700">
                            <span class="text-slate-900 font-bold">Note :</span> Maximum borrowing period is <span class="text-blue-600 font-black italic">14 days</span> from today. Please return on time to avoid penalties.
                        </p>
                    </div>

                <div class="pt-0">
                    <button type="submit" 
                        class="w-full flex items-center justify-center gap-4 px-10 py-4 rounded-[2rem] font-black font-accent uppercase tracking-widest text-[10px] text-white transition-all duration-500 ease-in-out transform 
                        
                        /* EFEK HOVER: Naik ke atas (Lift) & Pergeseran Background */
                        hover:-translate-y-1 hover:bg-right 
                        
                        /* KETEBALAN SHADOW & GLOW: Sama persis dengan model emerald (rgba 37, 99, 235 = Blue 600) */
                        shadow-2xl shadow-slate-900/20 hover:shadow-[0_15px_30px_-5px_rgba(37,99,235,0.4)]
                        
                        /* MODEL GRADIENT: Biru Tua ke Biru ke Biru Royal (Elegant & Solid) */
                        bg-gradient-to-r from-slate-950 from-0% via-blue-700 via-25% via-blue-600 via-35% to-blue-500 bg-[length:250%_150%] bg-left
                        
                        /* STRUKTUR: Border atas tipis (Reflective) & Grouping */
                        group/btn border-t border-white/10 relative overflow-hidden">
                        
                        <span class="inline-block transition-transform duration-500 group-hover/btn:scale-110 group-hover/btn:translate-x-1">
                            <span class="material-symbols-outlined text-lg block">
                                verified
                            </span>
                        </span>
                        
                        <span class="relative z-10">Confirm Borrowing</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const borrowForm = document.getElementById('borrowForm');
        let isBorrowSubmitting = false; 

        if (borrowForm) {
            borrowForm.addEventListener('submit', function(e) {
                
                if (isBorrowSubmitting) {
                    
                    e.preventDefault();
                    return false;
                }

                isBorrowSubmitting = true;

                const submitBtn = this.querySelector('button[type="submit"]');
                if (submitBtn) {
                    submitBtn.style.cursor = 'wait';
                }

            });
        }
    });
</script>



<script>
    function checkDateInput(input) {
        const group = document.getElementById('date_group');
        if (input.value && input.value !== "") {
            group.classList.add('is-active');
        } else {
            group.classList.remove('is-active');
        }
    }

    function openBorrowModal() {
        const modal = document.getElementById('borrowModal');
        const input = document.getElementById('due_date_input');
        modal.classList.remove('hidden');
        if (input) checkDateInput(input);
        const content = modal.querySelector('.relative.w-full');
        content.classList.remove('animate-modal-in');
        void content.offsetWidth; 
        content.classList.add('animate-modal-in');
        document.body.style.overflow = 'hidden';
    }

    function closeBorrowModal() {
        document.getElementById('borrowModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }
</script>

    <style>
        @keyframes modal-in {
            0% { opacity: 0; transform: scale(0.9) translateY(20px); }
            100% { opacity: 1; transform: scale(1) translateY(0); }
        }
        .animate-modal-in {
            animation: modal-in 0.4s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
        }
    </style>

            {{-- SATU GARIS PEMISAH TUNGGAL --}}
            <div class="my-16 border-b border-slate-400"></div>

            

            {{-- items-stretch tetap dipertahankan agar tinggi card kanan kiri selalu sama --}}
            <div class="flex flex-col lg:flex-row gap-4 items-stretch">
                
                {{-- CARD KIRI: Input Form --}}
                <div class="lg:w-1/3 bg-white/50 backdrop-blur-xl rounded-[3rem] border border-white/40 shadow-2xl shadow-blue-900/5 overflow-hidden border-r-4 border-r-slate-200/50 transition-all duration-700 ease-in-out hover:-translate-y-2 group/card relative

                /* STATE DEFAULT: Shadow referensi tetap sama */
                shadow-[0_15px_40px_-15px_rgba(0,0,0,0.12)]

                /* STATE HOVER: Ketebalan shadow & border kanan dibuat sama persis sesuai referensi */
                hover:border-blue-400/40
                hover:border-r-blue-400/60
                hover:shadow-[0_15px_30px_-12px_rgba(37,99,235,0.10),0_0_15px_rgba(37,99,235,0.08)]">

                {{-- Glow Edge Effect (Sama persis) --}}
                <div class="absolute inset-x-0 top-0 h-px bg-gradient-to-r from-transparent via-blue-400/30 to-transparent opacity-0 group-hover/card:opacity-100 transition-opacity duration-700"></div>

                {{-- Overlay Background (Sama persis) --}}
                <div class="absolute inset-0 bg-white/10 transition-colors duration-700 ease-in-out group-hover/card:bg-white/20 -z-10"></div>

                <div class="p-10 bg-white/20 h-full transition-colors duration-500 group-hover/card:bg-white/30">
    
                        <div class="sticky top-10">
                            <div class="mb-10">
                                <div class="flex items-center gap-4 mb-6 group/header cursor-default">
                                    <div class="w-12 h-12 bg-blue-600 rounded-2xl flex items-center justify-center text-white shrink-0 
                                        shadow-lg shadow-blue-500/20 
                                        transition-all duration-300 
                                        {{-- Sekarang menggunakan group-hover/header --}}
                                        group-hover/header:rotate-12 
                                        group-hover/header:scale-110 
                                        group-hover/header:shadow-xl 
                                        group-hover/header:shadow-blue-500/20">
                                        
                                        <span class="material-symbols-outlined text-2xl">rate_review</span>
                                    </div>
                                    <h2 class="text-3xl font-black tracking-tighter leading-none font-heading 
                                        /* Integrasi Gradient Sesuai Referensi */
                                        bg-gradient-to-r from-slate-900 from-10% via-blue-600 via-50% to-blue-500 
                                        bg-clip-text text-transparent">
                                        
                                        {{-- Span pembungkus dihapus warnanya agar mengikuti gradasi utama --}}
                                        Write Your<span class="italic">Reviews.</span>
                                    </h2>
                                </div>
                                <p class="text-slate-500/80 text-[13.5px] leading-relaxed font-medium font-accent uppercase tracking-wider">
                                    Describe your overall experience along this unique literary journey.
                                    <span class="font-black border-b border-blue-600 inline
                                        /* Integrasi Gradient Sesuai Referensi */
                                        bg-gradient-to-r from-blue-800 from-10% via-blue-600 via-30% to-blue-500 
                                        bg-clip-text text-transparent">
                                        {{ $book->title }}
                                    </span>
                                </p>
                            </div>

                            <form action="{{ route('siswa.review.store', $book->id) }}" method="POST" id="reviewForm" class="space-y-8">
                                @csrf
                                <input type="hidden" name="book_id" value="{{ $book->id }}">
                                
                                {{-- Bagian Rating --}}
                                <div id="rating_group" class="space-y-3 group/rating transition-transform duration-300">
                                    <div class="flex justify-between items-center transition-transform duration-300 group-hover/rating:-translate-y-1 group-[.is-active]/rating:-translate-y-1">
                                        <label class="text-[10px] font-black text-blue-400 uppercase tracking-[0.3em] block font-accent transition-colors duration-300 group-hover/rating:text-blue-600 group-[.is-active]/rating:text-blue-600">
                                            Give Your Rating
                                        </label>
                                        <span id="rating_error" class="hidden text-[9px] font-black text-rose-500 uppercase animate-pulse font-accent leading-none -translate-y-[1px]">
                                            Please Select a Rating First!
                                        </span>
                                    </div>

                                    @php
                                        $userReview = \App\Models\Review::where('book_id', $book->id)
                                                    ->where('user_id', (Auth::guard('siswa')->user() ?? Auth::guard('web')->user())->user_id)
                                                    ->first();
                                    @endphp

                                    <div id="star_container" class="flex justify-between items-center text-blue-200 review-stars px-1 transition-all duration-300">
                                        <input type="hidden" name="rating" id="rating_value" value="{{ $userReview ? $userReview->rating : 0 }}">
                                        @for($i = 1; $i <= 5; $i++)
                                            <button type="button" onclick="handleSetRating({{ $i }})" id="star-{{ $i }}" class="star-btn material-symbols-outlined hover:scale-125 transition-all duration-200 cursor-pointer text-4xl leading-none">star</button>
                                        @endfor
                                    </div>
                                </div>
                                
                                {{-- Bagian Comment --}}
                                <div id="comment_group" class="space-y-3 group/comment hover:-translate-y-1 focus-within:-translate-y-1 transition-transform duration-300">
                                    <label class="text-[10px] font-black text-blue-400 uppercase tracking-[0.3em] block font-accent transition-colors duration-300 group-hover/comment:text-blue-600 group-focus-within/comment:text-blue-600 group-[.is-active]/comment:text-blue-600">
                                        Share your experience
                                    </label>
                                    
                                    <textarea name="comment" id="comment_textarea" rows="4" required 
                                        oninput="checkCommentInput(this)"
                                        class="w-full bg-[#F8F9FC] border border-slate-200 border-r-4 border-r-slate-200 rounded-[1.8rem] p-5 text-sm custom-scrollbar
                                            
                                            /* Shadow & Ring tetap utuh sesuai kode asli Anda */
                                            focus:ring-8 focus:ring-blue-600/5 focus:border-blue-500/40 
                                            
                                            /* Sinkronisasi warna border kanan saat state focus */
                                            focus:border-r-blue-500/40
                                            
                                            focus:shadow-xl focus:shadow-blue-900/10

                                            group-[.is-active]/comment:ring-8 
                                            group-[.is-active]/comment:ring-blue-600/5 
                                            group-[.is-active]/comment:border-blue-500/40 
                                            group-[.is-active]/comment:border-r-blue-500/40
                                            group-[.is-active]/comment:shadow-xl 
                                            group-[.is-active]/comment:shadow-blue-900/10
                                            
                                            /* Durasi dan cubic-bezier tetap utuh sesuai kode asli Anda */
                                            transition-all duration-500 ease-[cubic-bezier(0.4,0,0.2,1)] 
                                            
                                            /* Properti lainnya tetap */
                                            placeholder:text-slate-400 font-medium outline-none shadow-inner" 
                                        placeholder="What did you think of this story?"></textarea>
                                </div>

                                <button type="submit" 
                                    class="w-full bg-gradient-to-r from-slate-950 from-50% via-blue-700 via-75% to-blue-500 bg-[length:200%_100%] bg-left text-white py-5 rounded-2xl font-black font-accent uppercase tracking-[0.2em] text-[11px] 
                                        {{-- Efek Hover Atas & Shadow: Tetap Sesuai Kode Asli Anda --}}
                                        hover:bg-right hover:-translate-y-2 hover:shadow-2xl hover:shadow-blue-500/50
                                        
                                        {{-- Transisi & Durasi: Tetap Sesuai Kode Asli Anda --}}
                                        transition-all duration-500 ease-[cubic-bezier(0.4,0,0.2,1)]
                                        shadow-xl shadow-slate-900/20 
                                        
                                        {{-- Layout & Fungsi: Tetap Sesuai Kode Asli Anda --}}
                                        flex items-center justify-center gap-3 group border-t border-white/10">
                                    
                                    Post Your Review
                                    
                                    {{-- Ikon & Efek Hover Ikon: Tetap Sesuai Kode Asli Anda --}}
                                    <span class="material-symbols-outlined text-sm transition-transform duration-500 group-hover:scale-110 group-hover:translate-x-1 block">
                                        send
                                    </span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>


            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const reviewForm = document.getElementById('reviewForm');
                    let isReviewSubmitting = false; 
                    
                    const initialRating = {{ $userReview ? $userReview->rating : 0 }};

                    if (initialRating > 0) {
                        for (let i = 1; i <= 5; i++) {
                            const star = document.getElementById('star-' + i);
                            if (star) {
                                if (i <= initialRating) {
                                    star.classList.add('text-amber-400', 'fill-icon');
                                    star.classList.remove('text-blue-200');
                                }
                                star.style.cursor = 'not-allowed';
            
                              
                                star.classList.remove('cursor-pointer');

                                document.getElementById('rating_group').classList.add('is-active');
                            }
                        }
                    }

                    if (reviewForm) {
                        reviewForm.addEventListener('submit', function(e) {
                            const ratingValue = document.getElementById('rating_value').value;

                            if (ratingValue === "0") {
                                e.preventDefault();
                                const errorMsg = document.getElementById('rating_error');
                                if (errorMsg) errorMsg.classList.remove('hidden');
                                return false;
                            }

                            if (isReviewSubmitting) {
                                e.preventDefault();
                                return false;
                            }

                            isReviewSubmitting = true;

                            const submitBtn = this.querySelector('button[type="submit"]');
                            if (submitBtn) {
                                submitBtn.style.cursor = 'wait';
                            }
                            
                        });
                    }
                });
            </script>

            <script>
                function handleSetRating(n) {
                    if (typeof setRating === "function") { setRating(n); }
                    const group = document.getElementById('rating_group');
                    if (n > 0) { group.classList.add('is-active'); }
                }

                function checkCommentInput(textarea) {
                    const group = document.getElementById('comment_group');
                    if (textarea.value.trim().length > 0) {
                        group.classList.add('is-active');
                        group.classList.add('-translate-y-1');
                    } else {
                        group.classList.remove('is-active');
                        group.classList.remove('-translate-y-1');
                    }
                }
            </script>

            <style>
                #comment_textarea::-webkit-scrollbar,
                .custom-scrollbar::-webkit-scrollbar { 
                    width: 4px !important; 
                }

                #comment_textarea::-webkit-scrollbar-track,
                .custom-scrollbar::-webkit-scrollbar-track { 
                    background: transparent !important; 
                }

                #comment_textarea::-webkit-scrollbar-thumb,
                .custom-scrollbar::-webkit-scrollbar-thumb { 
                    background: rgba(148, 163, 184, 0.2) !important; 
                    border-radius: 20px !important; 
                }

                #comment_textarea::-webkit-scrollbar-thumb:hover,
                .custom-scrollbar::-webkit-scrollbar-thumb:hover { 
                    background: rgba(59, 130, 246, 0.5) !important; 
                }
                
                #comment_textarea,
                .custom-scrollbar {
                    scrollbar-width: thin !important;
                    scrollbar-color: rgba(148, 163, 184, 0.2) transparent !important;
                }
            </style>

            
            {{-- CARD KANAN: List Komentar --}}
            {{-- Container Utama --}}
            <div class="lg:w-2/3 bg-white/50 backdrop-blur-xl rounded-[3rem] border border-white/40 shadow-2xl shadow-blue-900/5 overflow-hidden border-r-4 border-r-slate-200/50 transition-all duration-700 ease-in-out hover:-translate-y-2 group/card-list relative

            /* STATE DEFAULT: Shadow referensi tetap sama */
            shadow-[0_15px_40px_-15px_rgba(0,0,0,0.12)]

            /* STATE HOVER: 
            Radius menggunakan 35px/15px agar lebih rapat, 
            Ketebalan menggunakan Opacity 0.10/0.08 agar tetap terlihat tegas */
            hover:border-blue-400/40
            hover:border-r-blue-400/60
            hover:shadow-[0_15px_30px_-12px_rgba(37,99,235,0.10),0_0_15px_rgba(37,99,235,0.08)]">

            {{-- Glow Edge Effect (Tetap sama persis) --}}
            <div class="absolute inset-x-0 top-0 h-px bg-gradient-to-r from-transparent via-blue-400/30 to-transparent opacity-0 group-hover/card-list:opacity-100 transition-opacity duration-700"></div>

            {{-- Overlay Background (Tetap sama persis) --}}
            <div class="absolute inset-0 bg-white/10 transition-colors duration-700 ease-in-out group-hover/card-list:bg-white/20 -z-10"></div>

            <div class="p-10 h-full flex flex-col transition-colors duration-500">

                    
                    {{-- Header: Menambahkan group-hover pada h3 agar berubah biru --}}
                    <div class="flex items-center justify-between mb-6 shrink-0">
                        {{-- Header Kiri: Menambahkan group-hover/card-list:scale-110 --}}
                        <div class="flex items-center gap-4 group/latest cursor-default transition-all duration-500 hover:translate-x-2 group-hover/card-list:scale-105 origin-left">
    
                            <span class="h-2 rounded-full transition-all duration-500 ease-in-out
                                w-2 bg-blue-500/60 
                                
                                group-hover/card-list:w-5 group-hover/card-list:bg-blue-500 group-hover/card-list:scale-125
                                
                                group-hover/latest:w-10 group-hover/latest:bg-blue-600 group-hover/latest:scale-110 ">
                            </span>

                            <h3 class="text-[12px] font-black text-blue-500/60 uppercase tracking-[0.4em] font-accent transition-all duration-500 
                                group-hover/card-list:text-blue-500 
                                group-hover/latest:text-blue-600 group-hover/latest:translate-x-0">
                                Voices of Fellow Readers        
                            </h3>
                        </div>

                        {{-- Badge Kanan: Menambahkan group-hover/card-list:scale-110 --}}
                        <span class="relative overflow-hidden px-5 py-2 bg-slate-900 text-white rounded-full text-[9px] font-black font-accent tracking-widest shadow-lg transition-all duration-500 hover:-translate-y-1 cursor-pointer group-hover/card-list:scale-105 origin-right group/badge
                            group-hover/card-list:shadow-[0_5px_15px_rgba(37,99,235,0.2)]
                            hover:!shadow-[0_5px_18px_rgba(37,99,235,0.3)]">
                            
                            <span class="absolute inset-0 bg-gradient-to-r from-blue-700 to-blue-500 opacity-0 transition-opacity duration-500 group-hover/card-list:opacity-100"></span>
                            
                            <span class="relative z-10">
                                {{ $book->reviews->count() }} READER REVIEWS
                            </span>
                        </span>
                    </div>

                {{-- List Area: Menambahkan pt-2 (Padding Top) agar kartu paling atas tidak terpotong saat hover --}}
                <div class="space-y-3 overflow-y-auto flex-grow pr-4 px-2 pt-2 pb-7 custom-scrollbar" style="max-height: calc(100vh - 400px); min-height: 470px;">
                    @php
                        $commentColors = [
                            ['bg' => 'bg-blue-100/60',    'border' => 'border-blue-200/50',   'accent' => 'bg-blue-600',   'text' => 'text-blue-900',    'time' => 'text-blue-500'],
                            ['bg' => 'bg-rose-100/60',    'border' => 'border-rose-200/50',   'accent' => 'bg-rose-600',   'text' => 'text-rose-900',    'time' => 'text-rose-500'],
                            ['bg' => 'bg-violet-100/60',  'border' => 'border-violet-200/50', 'accent' => 'bg-violet-600', 'text' => 'text-violet-900',  'time' => 'text-violet-500'],
                            ['bg' => 'bg-emerald-100/60', 'border' => 'border-emerald-200/50','accent' => 'bg-emerald-600','text' => 'text-emerald-900', 'time' => 'text-emerald-500'],
                            ['bg' => 'bg-amber-100/60',   'border' => 'border-amber-200/50',  'accent' => 'bg-amber-600',  'text' => 'text-amber-900',   'time' => 'text-amber-500'],
                            ['bg' => 'bg-slate-100/60',   'border' => 'border-slate-300/50',  'accent' => 'bg-slate-800',  'text' => 'text-slate-900',   'time' => 'text-slate-500'],
                            ['bg' => 'bg-indigo-100/60',  'border' => 'border-indigo-200/50', 'accent' => 'bg-indigo-600', 'text' => 'text-indigo-900',  'time' => 'text-indigo-500'],                   
                        ];
                        $colorCount = count($commentColors);
                    @endphp

                            @forelse($book->reviews as $loopIndex => $review)
                            @php 
                                $c = $commentColors[$loopIndex % $colorCount]; 
                                
                                $shadowColorMap = [
                                    'bg-blue-600'    => 'rgba(37, 99, 235, 0.06)', // dari 0.06
                                    'bg-rose-600'    => 'rgba(225, 29, 72, 0.06)', // dari 0.06
                                    'bg-violet-600'  => 'rgba(124, 58, 237, 0.06)', // dari 0.06
                                    'bg-emerald-600' => 'rgba(52, 211, 153, 0.09)', // dari 0.09
                                    'bg-amber-600'   => 'rgba(251, 191, 36, 0.09)', // dari 0.09
                                    'bg-slate-800'   => 'rgba(148, 163, 184, 0.08)', // dari 0.08
                                    'bg-indigo-600'  => 'rgba(129, 140, 248, 0.09)', // dari 0.09
                                ];
                                
                                // Default shadow juga dikurangi sedikit
                                $currentShadow = $shadowColorMap[$c['accent']] ?? 'rgba(0, 0, 0, 0.03)';


                                // 2. Shadow Foto Profil (Lebih pekat/solid agar tidak menyatu dengan BG)
                                $profileShadowMap = [
                                    'bg-blue-600'    => 'rgba(37, 99, 235, 0.4)',
                                    'bg-rose-600'    => 'rgba(225, 29, 72, 0.4)',
                                    'bg-violet-600'  => 'rgba(124, 58, 237, 0.4)',
                                    'bg-emerald-600' => 'rgba(5, 150, 105, 0.45)', 
                                    'bg-amber-600'   => 'rgba(217, 119, 6, 0.45)',
                                    'bg-slate-800'   => 'rgba(30, 41, 59, 0.4)',
                                    'bg-indigo-600'  => 'rgba(79, 70, 229, 0.4)',
                                ];
                                $profileShadow = $profileShadowMap[$c['accent']] ?? 'rgba(0, 0, 0, 0.15)';
                            @endphp
                                
         
                            
                            {{-- Menggunakan onmouseover/out untuk menyuntikkan shadow berwarna secara dinamis --}}
                            <div class="group relative p-4 rounded-[1.5rem] {{ $c['bg'] }} border {{ $c['border'] }} hover:-translate-y-1.5 transition-all duration-500 backdrop-blur-md w-[75%] {{ $loop->even ? 'ml-auto' : 'mr-auto' }}"
                                onmouseover="this.style.boxShadow='0 10px 12px -5px {{ $currentShadow }}, 0 4px 6px -2px {{ $currentShadow }}'"
                                onmouseout="this.style.boxShadow='none'">
                                
                                <div class="flex {{ $loop->even ? 'flex-row-reverse text-right' : '' }} justify-between items-start gap-4">
                                    <div class="flex {{ $loop->even ? 'flex-row-reverse' : '' }} items-center gap-4">
                                        {{-- Ukuran Foto Profil W-11 H-11 sesuai kode asli --}}
                                        <div class="w-11 h-11 rounded-full {{ $c['accent'] }} text-white flex items-center justify-center font-black text-[11px] border border-white overflow-hidden shrink-0 transition-transform duration-500 group-hover:scale-110"
                                            style="box-shadow: 0 4px 12px {{ $profileShadow }};">
                                            @if($review->user && $review->user->foto_profile)
                                                <img src="{{ asset('storage/' . $review->user->foto_profile) }}" class="w-full h-full object-cover">
                                            @else
                                                {{ strtoupper(substr($review->user->username ?? 'U', 0, 2)) }}
                                            @endif
                                        </div>
                                        <div>
                                            <h4 class="font-black text-slate-900 text-[15px] leading-tight mb-0.5 tracking-tight font-heading">{{ $review->user->username ?? 'Anonymous' }}</h4>
                                            <div class="flex text-amber-400 scale-90 {{ $loop->even ? 'justify-end origin-right' : 'origin-left' }} transition-transform duration-500 group-hover:scale-100">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <span class="material-symbols-outlined text-sm {{ $i <= $review->rating ? 'fill-icon' : '' }}">star</span>
                                                @endfor
                                            </div>
                                        </div>
                                    </div>
                                    
                                    {{-- Peletakan Hari Ago sama persis dengan referensi (menggunakan mt-1) --}}
                                    <span class="inline-block text-[9px] font-black {{ $c['time'] }} uppercase tracking-widest font-accent shrink-0 mt-1 transition-transform duration-500 group-hover:scale-110 {{ $loop->even ? 'origin-left' : 'origin-right' }}">
                                        {{ $review->created_at->diffForHumans() }}
                                    </span>
                                </div>
                                
                                {{-- Margin top mt-3 sesuai referensi --}}
                                <div class="mt-3 flex {{ $loop->even ? 'flex-row-reverse text-right' : '' }} gap-3 items-start">
                                    <span class="material-symbols-outlined {{ $c['time'] }} opacity-50 text-[22px] mt-1 shrink-0">
                                        forum
                                    </span>
                                    <p class="{{ $c['text'] }} text-[14px] leading-relaxed font-medium serif-title break-words overflow-hidden">
                                        {{ $review->comment }}
                                    </p>
                                </div>
                            </div>
                        @empty
                        <div class="flex flex-col items-center justify-center py-24 bg-white/20 rounded-[3rem] border-2 border-dashed border-white/60">
                            <div class="w-20 h-20 bg-slate-100/50 rounded-full flex items-center justify-center mb-6 border border-white/50 shadow-inner">
                                <span class="material-symbols-outlined text-4xl text-slate-300">forum</span>
                            </div>
                            <h4 class="text-slate-400 font-black text-[10px] uppercase tracking-[0.4em] font-accent">No reviews yet</h4>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <div class="my-16 border-b border-slate-400"></div>

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

        <section class="mb-8">
                <div class="flex flex-col items-center mb-[50px] w-full"> 
                    <div class="relative text-center w-full px-4">
                        <h2 class="text-4xl md:text-6xl font-extrabold tracking-tighter font-heading mb-4 
                                text-transparent bg-clip-text 
                                bg-gradient-to-r from-slate-900 from-20% via-blue-600 via-50% to-cyan-400 pb-2 -mb-2">
                            Expand <span class="italic">Your Horizons.</span>
                        </h2>

                        <div class="flex items-center justify-center gap-4 md:gap-8 w-full">
                            <div class="flex-grow h-[6px] bg-[#2b6cee] rounded-full shadow-sm"></div>
                            
                            <div class="group relative overflow-hidden inline-block text-slate-400 font-bold text-[10px] md:text-[11px] uppercase tracking-[0.3em] whitespace-nowrap bg-white/50 px-6 py-2.5 rounded-full border border-slate-200 shadow-sm cursor-default transition-all duration-500
                                    hover:text-white hover:border-transparent"
                            style="mask-image:radial-gradient(white,black); transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);">
                            
                            <span class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-700 cubic-bezier(0.4, 0, 0.2, 1) bg-gradient-to-r from-blue-600 to-cyan-500"></span>

                            <span class="relative z-10 transition-colors duration-500 group-hover:drop-shadow-[0_0_8px_rgba(255,255,255,0.5)]">
                                Fresh insights for curious minds
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

    <style>
        .fill-icon {
            font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 48 !important;
        }
        
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-4px); }
            75% { transform: translateX(4px); }
        }
        .shake-error {
            animation: shake 0.2s ease-in-out 0s 2;
            color: #f43f5e !important; 
        }

        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: rgba(148, 163, 184, 0.2); border-radius: 20px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: rgba(59, 130, 246, 0.5); }
    </style>

    <script>
        function setRating(val) {
            const existingRating = {{ $userReview ? $userReview->rating : 0 }};
            
            if (existingRating > 0) return;

            document.getElementById('rating_error').classList.add('hidden');
            document.getElementById('star_container').classList.remove('shake-error');
            document.getElementById('rating_value').value = val;
            for (let i = 1; i <= 5; i++) {
                const star = document.getElementById('star-' + i);
                if (i <= val) {
                    star.classList.remove('text-blue-200');
                    star.classList.add('text-amber-400', 'fill-icon');
                } else {
                    star.classList.remove('text-amber-400', 'fill-icon');
                    star.classList.add('text-blue-200');
                }
            }
        }

        document.getElementById('reviewForm').addEventListener('submit', function(e) {
            const rating = document.getElementById('rating_value').value;
            
            if (rating == "0") {
                e.preventDefault(); 
                
                const errorText = document.getElementById('rating_error');
                const starContainer = document.getElementById('star_container');
                
                errorText.classList.remove('hidden');
                
                starContainer.classList.add('shake-error');
                
                setTimeout(() => {
                    starContainer.classList.remove('shake-error');
                }, 500);
            }
        });

        function handleWishlist(bookId) {
            const btn = document.getElementById('btn-wishlist');
            const icon = document.getElementById('icon-wishlist');

            const isCurrentlyActive = btn.classList.contains('bg-rose-500');

            if (!isCurrentlyActive) {
                
                btn.classList.remove('bg-white', 'border-slate-200', 'text-slate-900', 'shadow-slate-200/50');
                
                btn.classList.add('bg-rose-500', 'border-rose-500', 'text-white', 'shadow-rose-200/50');
                
                icon.classList.remove('text-slate-400');
                icon.classList.add('text-white');
                icon.style.fontVariationSettings = "'FILL' 1";
            } else {
               
                btn.classList.remove('bg-rose-500', 'border-rose-500', 'text-white', 'shadow-rose-200/50');
               
                btn.classList.add('bg-white', 'border-slate-200', 'text-slate-900', 'shadow-slate-200/50');
                
                icon.classList.remove('text-white');
                icon.classList.add('text-slate-400');
                icon.style.fontVariationSettings = "'FILL' 0";
            }

            fetch(`/dashboard/wishlist/toggle/${bookId}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            }).catch(err => {
                console.error(err);
                
            });
        }
        
    </script>


    {{-- FOOTER - IDENTIK 100% DENGAN LIBRARY --}}
    <footer class="bg-slate-950 text-white pt-16 pb-12 rounded-t-[5rem] relative overflow-hidden shadow-[0_-20px_50px_rgba(0,0,0,0.1)] mt-3">
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
</body>
</html>