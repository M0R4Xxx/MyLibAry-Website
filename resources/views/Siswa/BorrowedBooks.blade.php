<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>MyLibAry. | Your Books</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Plus+Jakarta+Sans:wght@700;800&family=Montserrat:wght@500;700;900&family=Space+Grotesk:wght@300;500;700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
                radial-gradient(at 0% 0%, rgba(43, 108, 238, 0.08) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(99, 102, 241, 0.05) 0px, transparent 50%),
                radial-gradient(at 50% 50%, rgba(14, 165, 233, 0.03) 0px, transparent 50%);
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

        .loan-card {
            transition: all 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
            background: linear-gradient(145deg, #ffffff, #f8fafc);
        }
        .loan-card:hover {
            transform: translateY(-12px) scale(1.01);
            @apply border-blue-400 shadow-2xl shadow-blue-500/20;
            background: linear-gradient(145deg, #ffffff, #f1f5f9);
        }

        .glass-nav {
            backdrop-filter: blur(20px);
            background-color: rgba(255, 255, 255, 0.75);
        }

        .text-gradient-hero {
            background: linear-gradient(135deg, #0f172a 0%, #2b6cee 50%, #6366f1 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }


        .text-gradient-book {
            background: linear-gradient(to right, #2563eb, #3b82f6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }


        .author-line {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            will-change: width; 
            backface-visibility: hidden; 
        }
   
        .loan-card:hover .author-line {
            width: 3rem;

            @apply bg-blue-600/60; 
        }

        .status-glow-safe { box-shadow: 0 0 20px rgba(16, 185, 129, 0.2); }
        .status-glow-warning { box-shadow: 0 0 20px rgba(245, 158, 11, 0.2); }
        .status-glow-danger { box-shadow: 0 0 20px rgba(239, 68, 68, 0.2); }

        .js-progress-bar {
            transition: width 1.5s cubic-bezier(0.1, 0.7, 0.1, 1), background-color 0.5s ease;
        }
    </style>
</head>
<body class="text-slate-800 min-h-screen flex flex-col overflow-x-hidden m-0 p-0 shadow-none border-none">
    <div class="absolute top-0 right-0 -z-10 w-[600px] h-[600px] bg-blue-200/20 rounded-full blur-[140px] -translate-y-1/2 translate-x-1/2"></div>
    <div class="absolute bottom-0 left-0 -z-10 w-[400px] h-[400px] bg-indigo-200/20 rounded-full blur-[120px] translate-y-1/2 -translate-x-1/2"></div>

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
                <a class="font-bold text-slate-500 hover:text-blue-600 transition-all hover:-translate-y-1" href="{{ route('siswa.history') }}">History</a>
                <a class="font-bold text-slate-500 hover:text-blue-600 transition-all hover:-translate-y-1" href="{{ route('siswa.wishlist') }}">Wishlist</a>
                <a class="font-black text-blue-600 border-b-2 border-blue-600 py-2 transition-all" href="{{ route('siswa.borrowed') }}">Your Books</a>
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
        </nav>

    <main class="flex-grow w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 relative">
        <header class="mb-14 relative flex flex-col md:flex-row md:items-start justify-between gap-6">
            <div class="relative pl-0"> 
                <div class="absolute -left-6 top-0 w-1 h-20 bg-blue-600 rounded-full"></div>
                
                <h1 class="text-6xl font-extrabold tracking-tighter mb-3 font-heading leading-tight flex items-baseline gap-3">
                    <span class="text-transparent bg-clip-text transform-gpu" 
                        style="
                            background-image: linear-gradient(to right, #0f172a 0%, #2563eb 20%, #7c3aed 60%, #db2777 95%);
                            -webkit-background-clip: text;
                            -webkit-text-fill-color: transparent;
                            backface-visibility: hidden;
                        ">
                        Currently <i class="italic">Borrowed.</i>
                    </span>

                    <div class="relative flex items-baseline gap-2 pb-2">
                        <span class="text-7xl font-black leading-none text-transparent bg-clip-text bg-gradient-to-br from-blue-600 via-violet-600 to-rose-500 overflow-visible inline-block pr-2 -mr-2">
                            {{ $borrowedBooks->where('status', 'borrowed')->count() }}
                        </span>
                        
                        <span class="text-3xl font-modern uppercase tracking-tighter text-slate-400 leading-none whitespace-nowrap">
                            Books
                        </span>

                        <div class="absolute -bottom-1 left-0 w-full h-1.5 bg-gradient-to-r from-transparent via-rose-500/20 to-transparent rounded-full hidden md:block"></div>
                    </div>
                </h1>

                <p class="text-slate-500 mt-4 text-lg font-medium max-w-xl font-modern">
                    Your digital library backpack. Track your reading progress and manage upcoming deadlines.
                </p>
            </div>

            <a class="mt-14 group relative overflow-hidden bg-slate-900 px-8 py-4 rounded-2xl text-white font-bold text-[11px] hover:shadow-2xl hover:shadow-blue-500/40 hover:-translate-y-2 transition-all duration-500 flex items-center gap-3 uppercase tracking-widest font-accent" href="{{ route('siswa.library') }}">
                <span class="relative z-10 flex items-center gap-2">
                    Explore The Library <span class="material-symbols-outlined text-lg group-hover:translate-x-2 transition-transform duration-500">arrow_right_alt</span>
                </span>
                
                <div class="absolute inset-0 bg-gradient-to-r from-[#2563eb] via-[#7c3aed] to-[#db2777] opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
            </a>
        </header>

        <div class="grid grid-cols-1 gap-8 mb-16">
            @forelse($borrowedBooks as $loan)
                @php
                    $start = \Carbon\Carbon::parse($loan->loan_date);
                    $end = \Carbon\Carbon::parse($loan->due_date);
                    $startIso = $start->toIso8601String();
                    $endIso = $end->toIso8601String();
                @endphp

                <div class="loan-card w-full group p-2 rounded-[3rem] border border-slate-200 flex flex-col md:flex-row items-center gap-8 shadow-xl shadow-slate-200/60 transition-all duration-500
                    {{ $loan->status === 'pending' ? 'cursor-not-allowed' : 'cursor-pointer' }}"
                    id="loan-card-{{ $loan->id }}"
                    data-start="{{ $startIso }}"
                    data-end="{{ $endIso }}"
                    data-status="{{ $loan->status }}"
                    onclick="{{ $loan->status === 'pending' ? 'event.stopPropagation()' : "window.location='" . route('siswa.book.detail', $loan->book->id) . "'" }}">
                    
                    <div class="w-full md:w-32 h-48 flex-shrink-0 rounded-[2.5rem] overflow-hidden shadow-2xl transition-all duration-500 transform transform-gpu
                        md:-translate-x-4 md:rotate-[-2deg] 
                        
                        /* Border Slate 200 (Statis) */
                        border border-slate-200 bg-white
                        
                        /* Level 1: Hover Card (Saat kursor masuk area card) */
                        group-hover:-translate-y-1 
                        /* Shadow Biru Level 1 (Ditingkatkan Opasitas & Blur agar Sedikit Lebih Tebal) */
                        group-hover:shadow-[0_20px_40px_-12px_rgba(0,0,0,0.2),0_0_35px_rgba(37,99,235,0.35)]
                        
                        /* Level 2: Hover Gambar (Saat kursor menyentuh gambar langsung) */
                        hover:!-translate-y-1.5 hover:!rotate-0 hover:scale-105 
                        
                        /* Border Biru saat Hover Gambar */
                        hover:border-blue-400/80
                        
                        /* Shadow Level 2: Mewah & Smooth (Tetap seperti sebelumnya) */
                        hover:!shadow-[0_25px_50px_-12px_rgba(0,0,0,0.25),0_10px_30px_rgba(0,0,0,0.07),0_0_20px_rgba(37,99,235,0.3),0_0_35px_rgba(37,99,235,0.15)]">

                        <img alt="{{ $loan->book->title }}" 
                            class="w-full h-full object-cover transition-transform duration-700" 
                            src="{{ asset($loan->book->cover_image) }}" 
                            onerror="this.src='https://via.placeholder.com/150x225?text=No+Cover'"/>
                            
                    </div>

                    <div class="flex-grow grid grid-cols-1 md:grid-cols-12 gap-8 items-center w-full px-6 py-4 md:py-0">
                        
                        <div class="md:col-span-4 text-left md:-ml-10 min-w-0"> 
                            <div>
                                <h3 class="font-black text-3xl tracking-tighter font-heading leading-[1.2] pb-2 -mb-2 line-clamp-2 text-gradient-book max-w-[280px] md:max-w-[290px] transform-gpu" 
                                    style="
                                        backface-visibility: hidden;
                                        background-image: linear-gradient(to right, #2563eb 5%, #7c3aed 50%, #db2777 95%);
                                        -webkit-background-clip: text;
                                        -webkit-text-fill-color: transparent;
                                    "
                                    title="{{ $loan->book->title }}">
                                    {{ $loan->book->title }}
                                </h3>
                            </div>
                            
                            <div class="flex items-center gap-2 mt-3 max-w-[270px] transform-gpu" style="backface-visibility: hidden;"> 
                                <span class="author-line w-8 h-[3px] bg-blue-600/60 rounded-full flex-shrink-0 transition-all duration-500 group-hover:w-12"></span>
                                <p class="text-[11px] text-blue-600/60 font-black font-accent uppercase tracking-[0.15em] italic truncate leading-none">
                                    {{ $loan->book->author_name }}
                                </p>
                            </div>
                        </div>

                        <div class="md:col-span-5 flex flex-col gap-5 md:-ml-14 md:pr-3">
                            <div class="flex justify-between items-end"> 
                                
                                <div class="text-center transition-transform duration-500 hover:-translate-y-1.5 {{ $loan->status === 'pending' ? 'cursor-not-allowed' : 'cursor-default' }}">
                                    <p class="text-[10px] font-black text-emerald-500 uppercase tracking-widest mb-1 font-modern">Borrow On</p>
                                    
                                    <p class="text-[13px] font-bold text-white bg-emerald-500 px-3 py-1 rounded-lg shadow-sm">
                                        {{ $start->format('M d, H:i') }}
                                    </p>
                                </div>
                                
                                <div class="text-center transition-transform duration-500 hover:-translate-y-1.5 {{ $loan->status === 'pending' ? 'cursor-not-allowed' : 'cursor-default' }}">
                                    <p class="text-[10px] font-black text-rose-400 uppercase tracking-widest mb-1 font-modern">Return On</p>
                                    
                                    <p class="text-[13px] font-black text-white bg-rose-600 px-3 py-1 rounded-lg shadow-sm">
                                        {{ $end->format('M d, H:i') }}
                                    </p>
                                </div>
                                
                            </div>
                            
                            <div class="relative w-full h-4 bg-slate-100 rounded-full overflow-hidden shadow-inner p-1 border border-slate-200/50">
                                <div class="js-progress-bar h-full rounded-full bg-gradient-to-r from-emerald-400 to-emerald-600" style="width: 0%"></div>
                            </div>
                        </div>

                        
                        <div class="md:col-span-3 flex flex-col items-center self-center transition-all duration-500 group-hover:-translate-y-2"> 
                            <div class="w-full group/badge"> 
                            <div class="js-status-badge flex items-center gap-2 px-4 h-12 rounded-full bg-emerald-500 text-white transition-all duration-500 w-full justify-center shadow-md border-none cursor-pointer transform-gpu hover:!scale-105 hover:!-translate-y-2"
                            onclick="{{ $loan->status === 'pending' 
                                ? 'event.stopPropagation()' 
                                : "handleBadgeAction(event, '$loan->status', '$loan->id', '" . route('siswa.return') . "?open_modal=" . $loan->id . "')" }}">
                                <span class="material-symbols-outlined text-[18px] js-icon transition-transform duration-500 group-hover/badge:translate-x-1">sync</span>
                                <span class="js-time-text text-[15px] font-black font-modern uppercase tracking-tight tabular-nums leading-none">
                                    Calculating...
                                </span>
                            </div>
                            <p class="js-sub-text text-[10px] font-black mt-2 uppercase tracking-[0.2em] text-center w-full block transition-all duration-500 font-accent text-emerald-600/70"></p>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-span-full w-full py-20 text-center">
            <span class="material-symbols-outlined text-slate-200 text-6xl mb-4">
                dictionary
            </span>
            
            <p class="text-slate-400 font-accent uppercase tracking-widest text-xs font-bold mb-2">
                Your Reading List is Empty. 
                <a href="{{ route('siswa.library') }}" 
                class="relative inline-block text-[#2b6cee] hover:text-[#1a56cc] transition-colors duration-300 group">
                    Explore the library!
                    <span class="absolute left-0 bottom-[-2px] w-0 h-[2px] bg-current transition-all duration-300 group-hover:w-full"></span>
                </a>
            </p>
        </div>
    @endforelse
</div>

<div class="w-full h-px bg-slate-400 my-12"></div>

<script>
    window.handleBadgeAction = function(event, status, loanId, returnUrl) {
        event.stopPropagation();

        if (status === 'rejected') {
            if (confirm("Permintaan ini ditolak oleh admin. Hapus notifikasi ini dari tampilan secara permanen?")) {
                const card = document.getElementById(`loan-card-${loanId}`);
                
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `/dashboard/history/${loanId}`; 
                
                const csrfMeta = document.querySelector('meta[name="csrf-token"]');
                const csrfToken = csrfMeta ? csrfMeta.getAttribute('content') : '';
                
                form.innerHTML = `
                    <input type="hidden" name="_token" value="${csrfToken}">
                    <input type="hidden" name="_method" value="DELETE">
                `;
                
                if (card) {
                    card.style.opacity = '0';
                    card.style.transform = 'scale(0.95)';
                    card.style.transition = 'all 0.4s ease';
                }

                document.body.appendChild(form);
                
                setTimeout(() => {
                    form.submit();
                }, 300);
            }
        } else if (status !== 'pending') {
            window.location.href = returnUrl;
        }
    }


    document.addEventListener('DOMContentLoaded', function() {
        function updateTimers() {
            const now = new Date().getTime();
            const cards = document.querySelectorAll('.loan-card');
            
            cards.forEach(card => {
                const start = new Date(card.dataset.start).getTime();
                const end = new Date(card.dataset.end).getTime();
                const status = card.getAttribute('data-status');

                const bar = card.querySelector('.js-progress-bar');
                const text = card.querySelector('.js-time-text');
                const badge = card.querySelector('.js-status-badge');
                const icon = card.querySelector('.js-icon');
                const subText = card.querySelector('.js-sub-text');

                const updateStatusClass = (element, newBg, shadowColor) => {
                    if (!element) return;
                    const currentStatus = element.getAttribute('data-status-color');
                    if (currentStatus !== newBg) {
                        const baseClasses = "js-status-badge flex items-center gap-2 px-4 h-12 rounded-full text-white transition-all duration-500 w-full justify-center shadow-md border-none cursor-pointer transform-gpu hover:!scale-105 hover:!-translate-y-1";
                        
                        element.style.boxShadow = '';
                        element.className = `${baseClasses} ${newBg}`;
                        element.setAttribute('data-status-color', newBg);
                    }
                        element.onmouseenter = () => {
                            element.style.boxShadow = `0 3px 5px -1px rgba(0,0,0,0.07), 0 9px 18px -6px ${shadowColor}`;
                        };
                        element.onmouseleave = () => {
                            element.style.boxShadow = ''; 
                        };
                    
                }

                if (status === 'pending') {
                    card.style.cursor = 'not-allowed'; 
                    if (badge) badge.style.cursor = 'not-allowed';
                    if (bar) {
                        bar.style.width = '0%';
                        bar.className = "js-progress-bar h-full rounded-full bg-slate-200"; 
                    }
                    if (text) text.innerText = "PENDING";
                    if (subText) {
                        subText.innerText = "Waiting for Admin";
                        subText.className = "js-sub-text text-[10px] font-black mt-2 uppercase tracking-[0.2em] text-center w-full block transition-all duration-500 font-accent text-slate-400";
                    }
                    updateStatusClass(badge, "bg-slate-400", "rgba(148, 163, 184, 0.5)"); 
                    if (icon) {
                        icon.innerText = "pending";
                        icon.classList.remove('animate-pulse');
                    }
                    return; 
                }

                if (status === 'rejected') {
                    if (bar) {
                        bar.style.width = '0%';
                        bar.className = "js-progress-bar h-full rounded-full bg-rose-100"; 
                    }
                    if (text) text.innerText = "REJECTED";
                    if (subText) {
                        subText.innerText = "Request Denied";
                        subText.className = "js-sub-text text-[10px] font-black mt-2 uppercase tracking-[0.2em] text-center w-full block transition-all duration-500 font-accent text-rose-700";
                    }
                    updateStatusClass(badge, "bg-rose-700", "rgba(190, 18, 60, 0.5)");
                    if (icon) {
                        icon.innerText = "cancel";      
                        icon.classList.remove('animate-pulse');
                    }
                    return;
                }

                const total = end - start;
                const elapsed = now - start;
                const remaining = end - now;

                let percentage = (elapsed / total) * 100;

                percentage = Math.max(1, Math.min(100, percentage)); 

                if (bar) bar.style.width = percentage + '%';

                if (remaining <= 0) {
                    if (text) text.innerText = "OVERDUE";
                    if (subText) {
                        subText.innerText = "Return Immediately";
                        subText.className = "js-sub-text text-[10px] font-black mt-2 uppercase tracking-[0.2em] text-center w-full block transition-all duration-500 font-accent text-slate-500";
                    }
                    if (bar) bar.className = "js-progress-bar h-full rounded-full bg-slate-400 transition-all duration-500";
                    updateStatusClass(badge, "bg-slate-600", "rgba(71, 85, 105, 0.5)"); 
                    if (icon) icon.innerText = "history_toggle_off";
                } else {
                    const days = Math.floor(remaining / (1000 * 60 * 60 * 24));
                    const hours = Math.floor((remaining % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    const mins = Math.floor((remaining % (1000 * 60 * 60)) / (1000 * 60));
                    const secs = Math.floor((remaining % (1000 * 60)) / 1000);

                    if (text) {
                        text.innerText = days > 0 
                            ? `${days}D ${hours}H LEFT` 
                            : `${hours}H ${mins}M ${secs}S`;
                    }

                    if (percentage >= 85) {
                        if (bar) bar.className = "js-progress-bar h-full rounded-full bg-gradient-to-r from-rose-500 to-red-600 transition-all duration-500";
                        updateStatusClass(badge, "bg-rose-600", "rgba(225, 29, 72, 0.6)"); 
                        if (subText) {
                            subText.innerText = "Deadline Approaching";
                            subText.className = "js-sub-text text-[10px] font-black mt-2 uppercase tracking-[0.2em] text-center w-full block transition-all duration-500 font-accent text-rose-600";
                        }
                        if (icon) { icon.innerText = "warning"; icon.classList.add('animate-pulse'); }
                    } 
                    else if (percentage >= 50) {
                        if (bar) bar.className = "js-progress-bar h-full rounded-full bg-gradient-to-r from-orange-400 to-orange-600 transition-all duration-500";
                        updateStatusClass(badge, "bg-orange-500", "rgba(249, 115, 22, 0.6)"); 
                        if (subText) {
                            subText.innerText = "Mid-Way Period";
                            subText.className = "js-sub-text text-[10px] font-black mt-2 uppercase tracking-[0.2em] text-center w-full block transition-all duration-500 font-accent text-orange-600";
                        }
                        if (icon) { icon.innerText = "hourglass_top"; icon.classList.remove('animate-pulse'); }
                    } 
                    else {
                        if (bar) bar.className = "js-progress-bar h-full rounded-full bg-gradient-to-r from-emerald-400 to-teal-500 transition-all duration-500";
                        updateStatusClass(badge, "bg-emerald-500", "rgba(16, 185, 129, 0.6)"); 
                        if (subText) {
                            subText.innerText = "Enjoy Your Reading";
                            subText.className = "js-sub-text text-[10px] font-black mt-2 uppercase tracking-[0.2em] text-center w-full block transition-all duration-500 font-accent text-emerald-600/70";
                        }
                        if (icon) { icon.innerText = "chrome_reader_mode"; icon.classList.remove('animate-pulse'); }
                    }
                }
            });
        }
        setInterval(updateTimers, 1000);
        updateTimers();
    });
</script>

        <style type="text/tailwindcss">
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
        </style>

       <section class="relative mt-0">
            <div class="flex justify-between items-end mb-12">
                <div class="relative">
                    <h2 class="text-5xl font-extrabold text-slate-900 tracking-tighter font-heading leading-none">
                        Your <span class="text-transparent bg-clip-text bg-gradient-to-r from-slate-900 via-rose-600 to-pink-500 italic font-heading">Reading Dreams.</span>
                    </h2>
                    
                   <div class="flex items-center gap-2 mt-3">
                        <span class="w-8 h-1 bg-rose-600 rounded-full"></span>
                        
                        <p class="text-rose-600 font-black text-[11px] uppercase tracking-[0.2em] font-accent">
                            SAVED STORIES FOR FUTURE ADVENTURES
                        </p>
                    </div>
                </div>

                @if($wishlists->isEmpty())
                    {{-- Tombol saat Wishlist Kosong (Mengarahkan ke Library) --}}
                    <a class="group relative overflow-hidden bg-white border border-slate-200 px-6 py-3 mb-1 rounded-2xl text-rose-600 font-bold text-[10px] hover:text-white hover:shadow-2xl hover:shadow-rose-500/40 hover:-translate-y-1.5 transition-all duration-500 ease-in-out flex items-center gap-2 uppercase tracking-widest font-accent shadow-sm shadow-rose-100/50" 
                    href="{{ route('siswa.library') }}">
                        <span class="relative z-10 flex items-center gap-2">
                            Find Your Wishlist in Library
                            <span class="material-symbols-outlined text-lg group-hover:translate-x-1 transition-transform duration-500">arrow_right_alt</span>
                        </span>
                        {{-- Gradient Hover diubah ke Rose --}}
                        <div class="absolute inset-0 bg-gradient-to-r from-rose-600 to-pink-600 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    </a>
                @else
                    {{-- Tombol saat Wishlist Ada Isi --}}
                    <a class="group relative overflow-hidden bg-white border border-slate-200 px-6 py-3 mb-1 rounded-2xl text-rose-600 font-bold text-[10px] hover:text-white hover:shadow-2xl hover:shadow-rose-500/40 hover:-translate-y-1.5 transition-all duration-500 ease-in-out flex items-center gap-2 uppercase tracking-widest font-accent shadow-sm shadow-rose-100/50" 
                    href="{{ route('siswa.wishlist') }}">
                        <span class="relative z-10 flex items-center gap-2">
                            Explore Your Wishlist 
                            <span class="material-symbols-outlined text-lg group-hover:translate-x-1 transition-transform duration-500">arrow_right_alt</span>
                        </span>
                        {{-- Gradient Hover diubah ke Rose --}}
                        <div class="absolute inset-0 bg-gradient-to-r from-rose-600 to-pink-600 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    </a>
                @endif
            </div>

            <div class="w-full grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-x-10 gap-y-16 mb-7">
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
                                
                                <div class="absolute -top-3 -right-3 z-50">
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
                <div class="col-span-full w-full py-20 text-center">
                    <span class="material-symbols-outlined text-slate-200 text-6xl mb-4">
                        heart_plus
                    </span>

                    <p class="text-slate-400 font-accent uppercase tracking-widest text-xs font-bold mb-[22px]">
                        No <span class="text-[#e11d48]">Books Found</span> in Wishlist. 
                        <a href="{{ route('siswa.library') }}" 
                        class="relative inline-block text-[#e11d48] hover:text-[#e11d48] transition-colors duration-300 group">
                            Find your first wishlist!
                            <span class="absolute left-0 bottom-[-2px] w-0 h-[2px] bg-current transition-all duration-300 group-hover:w-full"></span>
                        </a>
                    </p>
                </div>
                @endforelse
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
                        <li><a class="hover:text-white transition-all flex items-center gap-2 group justify-center md:justify-start" href="{{ route('siswa.wishlist') }}"><span class="w-1 h-1 bg-blue-600 rounded-full group-hover:w-3 transition-all"></span> Wishlist</a></li>
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