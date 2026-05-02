<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>MyLibAry. | Student Dashboard</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Plus+Jakarta+Sans:wght@700;800&family=Montserrat:wght@500;700;900&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Plus+Jakarta+Sans:wght@700;800&family=Montserrat:wght@500;700;900&family=Space+Grotesk:wght@300;500;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
        .font-modern {
            font-family: 'Space Grotesk', sans-serif;
        }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
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
        .glass-nav {
            backdrop-filter: blur(16px);
            background-color: rgba(255, 255, 255, 0.85);
        }
        .text-gradient {
            background: linear-gradient(to right, #1a1a1a, #2b6cee);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .card-inner-shadow {
            box-shadow: inset 0 2px 4px 0 rgba(0, 0, 0, 0.02);
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
                <a class="font-black text-blue-600 border-b-2 border-blue-600 py-2 transition-all" href="{{ route('siswa.dashboard') }}">Dashboard</a>
                <a class="font-bold text-slate-500 hover:text-blue-600 transition-all hover:-translate-y-1" href="{{ route('siswa.library') }}">Library</a>
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

    <main class="flex-grow max-w-7xl mx-auto px-6 lg:px-12 py-8 relative">
        
        <header class="mb-10 relative flex justify-between items-start">
            <div class="relative">
                <div class="absolute -left-6 top-0 w-1 h-20 bg-blue-600 rounded-full"></div>
                <h1 class="text-6xl font-extrabold tracking-tighter text-slate-900 mb-3 font-heading leading-none">
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-slate-900 via-blue-600 to-blue-400">
                        Welcome, <span class="italic">{{ explode(' ', Auth::user()->username ?? 'Guest')[0] }}.</span>
                    </span>
                </h1>
                <p class="text-slate-500 font-medium text-lg leading-relaxed max-w-2xl border-l-0 font-modern">
                    Your personal gateway to a world of knowledge. Explore, learn, and grow.
                </p>
            </div>
            
            <div class="hidden lg:block pt-9">
                <a class="group relative isolate overflow-hidden bg-white border border-slate-200 px-6 py-3 rounded-2xl text-[#2b6cee] font-bold text-[10px] 
                    hover:text-white hover:-translate-y-1.5 hover:shadow-xl hover:shadow-blue-500/30 
                    transition-all duration-500 ease-[cubic-bezier(0.4,0,0.2,1)] 
                    flex items-center gap-2 uppercase tracking-widest font-accent shadow-sm shadow-blue-100/50" 
                    href="{{ route('landing') }}">
                    
                    {{-- Layer Gradient yang disembunyikan (Opacity 0) --}}
                    <div class="absolute inset-0 -z-10 bg-gradient-to-r from-[#2b6cee] to-[#5da2ff] opacity-0 group-hover:opacity-100 transition-opacity duration-500 ease-in-out"></div>

                    <span class="material-symbols-outlined text-lg group-hover:-translate-x-1 transition-transform duration-500">arrow_left_alt</span> 
                    <span class="relative z-10">Back to Landing</span>
                </a>
            </div>
        </header>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
            <a href="{{ route('siswa.library') }}" class="group relative overflow-hidden bg-[#2b6cee] p-8 rounded-[2.5rem] text-white shadow-2xl shadow-blue-200 cursor-pointer block border border-white/10 transition-all duration-500 [transition-timing-function:cubic-bezier(0.34,1.56,0.64,1)] hover:-translate-y-[12px] hover:scale-[1.01] hover:shadow-[0_20px_40px_rgba(43,108,238,0.25)]">
                <div class="relative z-10">
                    <div class="w-12 h-12 bg-white/20 rounded-2xl flex items-center justify-center mb-6 backdrop-blur-md transition-transform duration-500 group-hover:scale-110">
                        <span class="material-symbols-outlined font-bold text-white">add_box</span>
                    </div>
                    <h3 class="text-xl font-black mb-1 tracking-tight font-heading uppercase transition-transform duration-500 group-hover:scale-105 origin-left">Borrow</h3>
                    <p class="text-blue-100/80 font-medium text-[10px] font-accent uppercase tracking-widest">Explore the library</p>
                </div>
                <span class="material-symbols-outlined absolute -right-6 -bottom-6 text-[9rem] opacity-20 group-hover:scale-110 group-hover:rotate-12 transition-all duration-700">local_library</span>
            </a>
            
            <a href="{{ route('siswa.return') }}" class="group relative overflow-hidden bg-emerald-500 p-8 rounded-[2.5rem] text-white shadow-2xl shadow-emerald-200 cursor-pointer block border border-white/10 transition-all duration-500 [transition-timing-function:cubic-bezier(0.34,1.56,0.64,1)] hover:-translate-y-[12px] hover:scale-[1.01] hover:shadow-[0_20px_40px_rgba(16,185,129,0.25)]">
                <div class="relative z-10">
                    <div class="w-12 h-12 bg-white/20 rounded-2xl flex items-center justify-center mb-6 backdrop-blur-md transition-transform duration-500 group-hover:scale-110">
                        <span class="material-symbols-outlined font-bold text-white">assignment_return</span>
                    </div>
                    <h3 class="text-xl font-black mb-1 tracking-tight font-heading uppercase transition-transform duration-500 group-hover:scale-105 origin-left">Return</h3>
                    <p class="text-emerald-50/80 font-medium text-[10px] font-accent uppercase tracking-widest">Manage your loans</p>
                </div>
                <span class="material-symbols-outlined absolute -right-6 -bottom-6 text-[9rem] opacity-20 group-hover:scale-110 group-hover:-rotate-12 transition-all duration-700 text-white">history_edu</span>
            </a>
            
            <a href="{{ route('siswa.history') }}" class="group relative overflow-hidden bg-indigo-600 p-8 rounded-[2.5rem] text-white shadow-2xl shadow-indigo-200 cursor-pointer block border border-white/10 transition-all duration-500 [transition-timing-function:cubic-bezier(0.34,1.56,0.64,1)] hover:-translate-y-[12px] hover:scale-[1.01] hover:shadow-[0_20px_40px_rgba(79,70,229,0.25)]">
                <div class="relative z-10">
                    <div class="w-12 h-12 bg-white/20 rounded-2xl flex items-center justify-center mb-6 backdrop-blur-md transition-transform duration-500 group-hover:scale-110">
                        <span class="material-symbols-outlined font-bold text-white">history</span>
                    </div>
                    <h3 class="text-xl font-black mb-1 tracking-tight font-heading uppercase transition-transform duration-500 group-hover:scale-105 origin-left">History</h3>
                    <p class="text-indigo-100/80 font-medium text-[10px] font-accent uppercase tracking-widest">Track your journey</p>
                </div>
                <span class="material-symbols-outlined absolute -right-6 -bottom-6 text-[9rem] opacity-20 group-hover:scale-110 group-hover:rotate-12 transition-all duration-700 text-white">analytics</span>
            </a>
            
            <a href="{{ route('siswa.wishlist') }}" class="group relative overflow-hidden bg-rose-500 p-8 rounded-[2.5rem] text-white shadow-2xl shadow-rose-200 cursor-pointer block border border-white/10 transition-all duration-500 [transition-timing-function:cubic-bezier(0.34,1.56,0.64,1)] hover:-translate-y-[12px] hover:scale-[1.01] hover:shadow-[0_20px_40px_rgba(244,63,94,0.25)]">
                <div class="relative z-10">
                    <div class="w-12 h-12 bg-white/20 rounded-2xl flex items-center justify-center mb-6 backdrop-blur-md transition-transform duration-500 group-hover:scale-110">
                        <span class="material-symbols-outlined font-bold text-white">favorite</span>
                    </div>
                    <h3 class="text-xl font-black mb-1 tracking-tight font-heading uppercase transition-transform duration-500 group-hover:scale-105 origin-left">Wishlist</h3>
                    <p class="text-rose-100/80 font-medium text-[10px] font-accent uppercase tracking-widest">Saved for later</p>
                </div>
                <span class="material-symbols-outlined absolute -right-6 -bottom-6 text-[9rem] opacity-20 group-hover:scale-110 group-hover:-rotate-12 transition-all duration-700 text-white">bookmark_heart</span>
            </a>
        </div>

        <section class="mb-14 relative">
                <div class="w-full h-px bg-slate-300 mb-8"></div> 
                    <div class="flex justify-between items-end mb-[36px]"> 
                        <div class="relative">
                            <h2 class="text-4xl font-extrabold tracking-tighter font-heading leading-none text-transparent bg-clip-text transform-gpu pb-1 -mb-1 pr-2 inline-block overflow-visible" 
                                style="
                                    background-image: linear-gradient(to right, #0f172a 0%, #2563eb 20%, #7c3aed 60%, #db2777 95%);
                                    -webkit-background-clip: text;
                                    -webkit-text-fill-color: transparent;
                                    backface-visibility: hidden;
                                ">
                                Currently Your <span class="italic">Borrowed Books.</span>
                            </h2>
                            <div class="flex items-center gap-2 mt-2">
                                <span class="w-8 h-1 bg-blue-600 rounded-full"></span>
                                <p class="text-[#2b6cee] font-black text-[10px] uppercase tracking-[0.2em] font-accent">Active Reading Sessions</p>
                            </div>
                        </div>
                    <a class="group relative overflow-hidden bg-white border border-slate-200 px-6 py-3 rounded-2xl text-[#2b6cee] font-bold text-[10px] hover:text-white hover:-translate-y-2 transition-all duration-500 flex items-center gap-2 uppercase tracking-widest font-accent shadow-sm shadow-blue-100/50 
                        /* SHADOW HOVER DISAMAKAN PERSIS (Blue-500/40) */
                        hover:shadow-2xl hover:shadow-blue-500/40" 
                        href="{{ route('siswa.borrowed') }}">
                        
                        <span class="relative z-10 flex items-center gap-2">
                            All Your Books 
                            <span class="material-symbols-outlined text-lg group-hover:translate-x-2 transition-transform duration-500">arrow_right_alt</span>
                        </span>

                        {{-- GRADIENT DISAMAKAN PERSIS (Blue -> Violet -> Rose) --}}
                        <div class="absolute inset-0 bg-gradient-to-r from-[#2563eb] via-[#7c3aed] to-[#db2777] opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    </a>
                </div>
            
            
            <div id="loan-container" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    @forelse($activeLoans as $loan)
                        @php
                            $start = \Carbon\Carbon::parse($loan->loan_date);
                            $end = \Carbon\Carbon::parse($loan->due_date);
                            $startIso = $start->toIso8601String();
                            $endIso = $end->toIso8601String();
                        @endphp

                        <div id="loan-card-{{ $loan->id }}" class="loan-card js-loan-item opacity-0 group bg-white p-6 rounded-[2.5rem] border border-slate-200 shadow-xl shadow-slate-200/30 relative overflow-hidden cursor-pointer 
                                transition-all duration-500 [transition-timing-function:cubic-bezier(0.34,1.56,0.64,1)]
                                hover:-translate-y-[12px] hover:scale-[1.01] 
                                hover:border-blue-400 
                                hover:shadow-[0_20px_40px_rgba(0,0,0,0.1),0_0_25px_rgba(59,130,246,0.2)]"
                           
                                data-loan-id="{{ $loan->id }}"
                                data-start="{{ $startIso }}"
                                data-end="{{ $endIso }}"
                                data-status="{{ $loan->status }}"
                                onclick="this.dataset.status !== 'pending' && (window.location='{{ route('siswa.book.detail', $loan->book->id) }}')">
                            
                            <div class="flex gap-6 items-center">
                                <div class="relative flex-shrink-0">
                                    <div class="w-[120px] h-[168px]  rounded-2xl overflow-hidden transition-all duration-500 transform -rotate-2 
                                                border-2 border-slate-100 shadow-lg 
                                                group-hover:scale-105 group-hover:rotate-0 
                                                group-hover:border-blue-400/80 
                                                group-hover:shadow-[0_10px_30px_rgba(0,0,0,0.07),0_0_20px_rgba(37,99,235,0.3),0_0_35px_rgba(37,99,235,0.15)]">
                                        
                                        <img alt="{{ $loan->book->title }}" 
                                            class="w-full h-full object-cover" 
                                            src="{{ asset($loan->book->cover_image) }}" 
                                            onerror="this.src='https://via.placeholder.com/150x225?text=No+Cover'"/>
                                    </div>
                                </div>

                                <div class="flex flex-col justify-between py-1 flex-grow min-w-0 h-40">
                                    <div class="min-h-[75px] mb-2"> 
                                        <h4 class="font-heading font-black text-slate-900 text-xl leading-tight line-clamp-2 tracking-tight transition-all duration-500"
                                            style="background-image: linear-gradient(to right, #2563eb, #7c3aed, #db2777); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
                                            {{ $loan->book->title }}
                                        </h4>
                                        <p class="text-[10px] font-black text-blue-600/60 mt-1 uppercase tracking-widest font-accent italic truncate">
                                            {{ $loan->book->author_name }}
                                        </p>
                                    </div>

                                    <div class="mt-auto space-y-4"> 
                                        <div class="space-y-1.5">
                                            <div class="flex justify-between items-center px-1 font-accent">
                                                <span class="text-[9px] font-black text-emerald-500 uppercase tracking-tighter transition-transform duration-300 transform hover:-translate-y-1 {{ $loan->status === 'pending' ? 'cursor-not-allowed' : 'cursor-default' }} inline-block">Borrowed</span>
                                                <span class="text-[9px] font-black text-rose-500 uppercase tracking-tighter transition-transform duration-300 transform hover:-translate-y-1 {{ $loan->status === 'pending' ? 'cursor-not-allowed' : 'cursor-default' }} inline-block">Returned</span>
                                            </div>
                                            <div class="w-full bg-slate-100 h-2.5 rounded-full overflow-hidden p-[2px] border border-slate-200/50 shadow-inner">
                                                <div class="js-progress-bar h-full rounded-full bg-gradient-to-r from-emerald-400 to-emerald-600 transition-all duration-1000" style="width: 0%"></div>
                                            </div>
                                        </div>

                                        <div class="js-status-badge group/badge mx-auto flex items-center gap-1.5 px-3 py-1.5 rounded-full border bg-white shadow-[0_2px_8px_rgba(0,0,0,0.12)] transition-all duration-700 ease-[cubic-bezier(0.25,0.1,0.25,1)] w-fit transform-gpu cursor-pointer"
                                            onclick="handleBadgeAction(event, '{{ $loan->status }}', '{{ $loan->id }}', '{{ route('siswa.return') }}?open_modal={{ $loan->id }}')">
                                            <span class="material-symbols-outlined text-[14px] js-icon transition-all duration-700 ease-[cubic-bezier(0.25,0.1,0.25,1)] group-hover/badge:rotate-12 group-hover/badge:translate-x-1">sync</span>
                                            <span class="js-time-text text-[10px] font-black font-accent uppercase tracking-wider tabular-nums ">
                                                Calculating...
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <a href="{{ route('siswa.library') }}" 
                            class=" border-2 border-dashed border-slate-300 bg-slate-50/50 rounded-[2.5rem] flex flex-col items-center justify-center p-8 text-slate-400 relative overflow-hidden cursor-pointer shadow-xl shadow-slate-200/30
                                    transition-all duration-500 [transition-timing-function:cubic-bezier(0.34,1.56,0.64,1)]
                                    hover:-translate-y-[12px] hover:scale-[1.01] 
                                    hover:text-blue-500 hover:border-blue-400 hover:bg-white
                                    hover:shadow-[0_20px_40px_rgba(0,0,0,0.1),0_0_25px_rgba(59,130,246,0.2)] 
                                    group h-full min-h-[180px]">
                            
                            <div class="w-14 h-14 rounded-full bg-white flex items-center justify-center shadow-sm mb-4 group-hover:scale-110 transition-transform">
                                <span class="material-symbols-outlined text-4xl font-light">add_circle</span>
                            </div>

                            <span class="font-black text-[10px] uppercase tracking-[0.3em] font-accent transition-all duration-300 group-hover:scale-110 group-hover:text-blue-500">
                                Expand Collection
                            </span>
                        </a>
                    @endforelse
                </div>

                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            
                        function refreshVisibleCards() {
                            const allCards = document.querySelectorAll('.js-loan-item');
                            const LIMIT = 3;
                            
                            const displayCards = Array.from(allCards).slice(-LIMIT);

                            allCards.forEach(card => {
                                if (displayCards.includes(card)) {
                                    card.style.display = 'block';
                                    setTimeout(() => {
                                        card.classList.remove('opacity-0');
                                        card.classList.add('opacity-100');
                                    }, 50);
                                } else {
                                    card.style.display = 'none';
                                }
                            });
                        }

                        window.handleBadgeAction = function(event, status, loanId, returnUrl) {
                            event.stopPropagation();

                            if (status === 'rejected') {
                                if (confirm("Hapus notifikasi penolakan ini dari daftar?")) {
                                    const form = document.createElement('form');
                                    form.method = 'POST';
                                    
                                    form.action = `/dashboard/history/${loanId}`; 
                                    
                                    const csrfMeta = document.querySelector('meta[name="csrf-token"]');
                                    if (!csrfMeta) {
                                        console.error("CSRF token meta tag not found!");
                                        return;
                                    }
                                    const csrfToken = csrfMeta.getAttribute('content');
                                    
                                    form.innerHTML = `
                                        <input type="hidden" name="_token" value="${csrfToken}">
                                        <input type="hidden" name="_method" value="DELETE">
                                    `;
                                    
                                    document.body.appendChild(form);
                                    form.submit();
                                }
                            } else if (status !== 'pending') {
                                window.location.href = returnUrl;
                            }
                        }

                            function updateTimers() {
                                const now = new Date().getTime();
                                const cards = document.querySelectorAll('.js-loan-item:not(.hidden)');
                                
                                
                                cards.forEach(card => {
                                    const bar = card.querySelector('.js-progress-bar');
                                    const text = card.querySelector('.js-time-text');
                                    const badge = card.querySelector('.js-status-badge');
                                    const icon = card.querySelector('.js-icon');

                                    const start = new Date(card.dataset.start).getTime();
                                    const end = new Date(card.dataset.end).getTime();
                                    const status = card.getAttribute('data-status');

                                    const setBadgeStyle = (color) => {
                                    const config = {
                                        pending:  { cls: "bg-slate-100 border-slate-200 text-slate-500 group-hover:bg-slate-400", shadow: "rgba(148, 163, 184, 0.35)", deep: "rgba(148, 163, 184, 0.45)" },
                                        rejected: { 
                                            cls: "bg-rose-50 border-rose-200 text-rose-700 group-hover:bg-rose-700", 
                                            shadow: "rgba(190, 18, 60, 0.35)", 
                                            deep: "rgba(190, 18, 60, 0.45)" 
                                        },

                                        overdue:  { cls: "bg-slate-100 border-slate-200 text-slate-700 group-hover:bg-slate-500", shadow: "rgba(30, 41, 59, 0.35)", deep: "rgba(30, 41, 59, 0.45)" },
                                        critical: { cls: "bg-rose-100 border-rose-200 text-rose-700 group-hover:bg-rose-500", shadow: "rgba(225, 29, 72, 0.35)", deep: "rgba(225, 29, 72, 0.45)" },
                                        warning:  { cls: "bg-orange-100 border-orange-200 text-orange-700 group-hover:bg-orange-500", shadow: "rgba(245, 158, 11, 0.35)", deep: "rgba(245, 158, 11, 0.45)" },
                                        safe:     { cls: "bg-emerald-100 border-emerald-200 text-emerald-700 group-hover:bg-emerald-500", shadow: "rgba(16, 185, 129, 0.35)", deep: "rgba(16, 185, 129, 0.45)" }
                                        };

                                    const current = config[color];

                                        badge.style.setProperty('--shadow-color', current.shadow);
                                        badge.style.setProperty('--shadow-deep', current.deep);
                                        badge.className = `js-status-badge group/badge mx-auto flex items-center gap-1.5 px-3 py-1.5 rounded-full border transition-all duration-700 ease-[cubic-bezier(0.25,0.1,0.25,1)] w-fit transform-gpu cursor-pointer shadow-[0_2px_8px_rgba(0,0,0,0.12)] group-hover:scale-105 group-hover:text-white group-hover:border-transparent group-hover:shadow-[0_4px_12px_rgba(0,0,0,0.08),0_2px_14px_var(--shadow-color)] hover:!scale-110 hover:-translate-y-1 hover:!shadow-[0_5px_12px_var(--shadow-deep)] active:scale-95 ${current.cls}`;
                                    };

                                    if (status === 'pending') {
                                        if (text) text.innerText = "PENDING";
                                        card.style.cursor = 'not-allowed';
                                        card.style.pointerEvents = 'auto';
                                        if (badge) {
                                            badge.style.cursor = 'not-allowed';

                                        }
                                        if (bar) {
                                            bar.style.width = '0%';
                                            bar.className = "js-progress-bar h-full rounded-full bg-slate-200";
                                        }
                                        if (icon) icon.innerText = "pending";
                                        setBadgeStyle('pending');
                                        return; 
                                    }

                                    if (status === 'rejected') {
                                        if (text) text.innerText = "REJECTED";
                                        if (bar) {
                                            bar.style.width = '0%';
                                            bar.className = "js-progress-bar h-full rounded-full bg-rose-100";
                                        }
                                        if (icon) icon.innerText = "cancel";
                                        setBadgeStyle('rejected');
                                        return; 
                                    }

                                    const total = end - start;
                                    const elapsed = now - start;
                                    const remaining = end - now;
                                    let percentage = Math.max(1, Math.min(100, (elapsed / total) * 100)); 

                                    if (bar) bar.style.width = percentage + '%';



                                    if (remaining <= 0) {
                                        if (text) text.innerText = "OVERDUE";
                                        if (bar) bar.className = "js-progress-bar h-full rounded-full bg-slate-400";
                                        setBadgeStyle('overdue');
                                        if (icon) icon.innerText = "history_toggle_off";
                                    } else {
                                        const days = Math.floor(remaining / (1000 * 60 * 60 * 24));
                                        const hours = Math.floor((remaining % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                        const mins = Math.floor((remaining % (1000 * 60 * 60)) / (1000 * 60));
                                        const secs = Math.floor((remaining % (1000 * 60)) / 1000);

                                        if (text) text.innerText = days > 0 ? `${days} DAYS LEFT` : `${hours}H ${mins}M ${secs}S`;

                                        if (percentage >= 85) {
                                            if (bar) bar.className = "js-progress-bar h-full rounded-full bg-gradient-to-r from-rose-500 to-red-600";
                                            setBadgeStyle('critical');
                                            if (icon) { icon.innerText = "warning"; icon.classList.add('animate-pulse'); }
                                        } else if (percentage >= 50) {
                                            if (bar) bar.className = "js-progress-bar h-full rounded-full bg-gradient-to-r from-orange-400 to-orange-600";
                                            setBadgeStyle('warning');
                                            if (icon) { icon.innerText = "hourglass_top"; icon.classList.remove('animate-pulse'); }
                                        } else {
                                            if (bar) bar.className = "js-progress-bar h-full rounded-full bg-gradient-to-r from-emerald-400 to-teal-500";
                                            setBadgeStyle('safe');
                                            if (icon) { icon.innerText = "chrome_reader_mode"; icon.classList.remove('animate-pulse'); }
                                        }
                                    }
                                });
                            }
                            refreshVisibleCards();
                            setInterval(updateTimers, 1000);
                            updateTimers();
                        });
                    </script>

        </section>

        <section class="mb-10">
            <div class="w-full h-px bg-slate-300 mb-8"></div> 
            <div class="flex justify-between items-center mb-[40px]"> 
                <div class="relative">
                    <h2 class="text-4xl font-extrabold tracking-tighter font-heading pb-1 -mb-1 pr-4 inline-block text-transparent bg-clip-text bg-gradient-to-r from-slate-900 via-blue-600 to-cyan-500 transform-gpu" 
                        style="
                            -webkit-background-clip: text; 
                            -webkit-text-fill-color: transparent;
                            backface-visibility: hidden;
                        ">
                        Discover Our Specially <span class="italic"> Curated Gallery. </span>
                    </h2>
                    <div class="flex items-center gap-2.5 mt-2">
                        <span class="w-8 h-1 bg-cyan-500 rounded-full shadow-[0_0_10px_rgba(6,182,212,0.3)]"></span>
                        
                        <p class="text-cyan-600 font-black text-[10px] uppercase tracking-[0.2em] font-accent leading-none">
                            Discover New Worlds
                        </p>
                    </div>
                </div>
                <div class="flex gap-4 font-accent">
                    <a href="{{ route('siswa.library') }}" 
                        class="relative overflow-hidden px-[41px] py-4 rounded-[1.25rem] bg-slate-900 text-white text-[11px] font-black uppercase tracking-widest inline-block text-center  shadow-2xl 
                                transition-all duration-500 [transition-timing-function:cubic-bezier(0.34,1.56,0.64,1)]
                                hover:shadow-[0_20px_40px_rgba(43,108,238,0.3)] hover:-translate-y-2 hover:scale-[1.02]
                                group">
                            
                        <span class="absolute inset-0 bg-gradient-to-r from-blue-600 to-cyan-500 opacity-0 transition-opacity duration-500 group-hover:opacity-100"></span>
                        <span class="relative z-10">See All Books</span>
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-x-10 gap-y-16">
                @foreach($books as $book)
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