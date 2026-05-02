<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>LibSys Chat Interface</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Plus+Jakarta+Sans:wght@700;800&family=Montserrat:wght@500;700;900&family=Space+Grotesk:wght@300;500;700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet" />

    <!-- ORIGINAL FONTS -->
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&amp;display=swap" rel="stylesheet"/>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,container-queries"></script>
    
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "primary": "#3b82f6", 
                        "primary-old": "#00288e",
                        "on-primary": "#ffffff",
                        "background": "#f7f9fb",
                        "background-light": "#F2F2F7",
                        "background-dark": "#0f172a",
                        "surface-container": "#eceef0",
                        "surface-container-low": "#f2f4f6",
                        "surface-container-lowest": "#ffffff",
                        "outline-variant": "#c4c5d5",
                        "on-surface": "#191c1e",
                        "on-surface-variant": "#444653"
                    },
                    fontFamily: {
                        sans: ["Inter", "sans-serif"],
                        display: ["Inter", "sans-serif"],
                    },
                    "spacing": {
                        "container-padding": "24px",
                        "sidebar-width": "320px",
                        "bubble-gap": "12px",
                        "md": "16px",
                        "sm": "8px",
                        "xl": "40px"
                    }
                }
            }
        }
    </script>

    <style type="text/tailwindcss">
        :root {
            --bg-silver: #F8F9FC;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-silver);
            background-image: 
                radial-gradient(at 0% 0%, rgba(43, 108, 238, 0.05) 0px, transparent 50%),
                radial-gradient(at 100% 0%, rgba(43, 108, 238, 0.03) 0px, transparent 50%);
        }

        .font-heading {
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
        .sidebar-active-card {
            @apply bg-primary text-white shadow-xl shadow-primary/30 z-50;
            transform: translateX(12px) translateY(-4px) scale(1.05);
        }
        .sidebar-item-hover {
            @apply transition-all duration-300 ease-out;
        }
        .sidebar-item-hover:hover {
            @apply -translate-y-1 scale-105 shadow-md;
        }

       .admin-row-card {
            transition: all 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
            @apply bg-white flex items-center relative overflow-visible;
            width: 100%;
            max-width: 100%;
        }

        .admin-row-card {
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        }
        .admin-row-card * {
            backface-visibility: hidden;
            -webkit-font-smoothing: antialiased;
        }

        .siswa-row-card {
            transition: all 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
            @apply bg-white flex items-center relative overflow-visible;
            width: 100%;
            max-width: 100%;
        }

        .siswa-row-card {
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        }
        .siswa-row-card * {
            backface-visibility: hidden;
            -webkit-font-smoothing: antialiased;
        }
        
        .section-container {
            @apply relative bg-white/50 backdrop-blur-xl rounded-[3rem] border border-white/40 
                overflow-hidden border-r-4 border-r-slate-200/70 
                transition-all duration-700 ease-in-out
                shadow-[0_15px_40px_-15px_rgba(0,0,0,0.12)] antialiased; 
            backface-visibility: hidden;
            transform: translateZ(0);
        }

        .chat-container-active {
            @apply border-blue-400/80 border-r-blue-400/60;
            box-shadow: 0 15px 30px -12px rgba(37, 99, 235, 0.10), 0 0 15px rgba(37, 99, 235, 0.08);
        }

        html {
            overflow-y: scroll; 
            }

            body {
                height: 100%;
                overflow: hidden; 
                font-family: 'Inter', sans-serif;
                background-color: var(--bg-silver);
        }

        .glow-edge {
            @apply absolute inset-x-0 top-0 h-px opacity-0 transition-opacity duration-700;
        }

        .section-container:hover .glow-edge {
            @apply opacity-100;
        }

        .action-card-btn {
            @apply bg-white border border-slate-200 px-4 py-2 rounded-xl text-blue-600 font-bold hover:bg-blue-50 transition-all shadow-sm flex items-center gap-2;
        }

        .glass-nav {
            backdrop-filter: blur(16px);
            background-color: rgba(255, 255, 255, 0.85);
        }

        .glass-panel { backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px); }


        .custom-scrollbar::-webkit-scrollbar {
        width: 5px;
        display: block !important; 
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background-color: #e2e8f0; 
            border-radius: 10px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background-color: #cbd5e1; 
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

        .admin-row-card.active-card {
            pointer-events: auto; 
        }

        .admin-row-card.active-card {
            transform: translateY(-0.25rem) !important; 
            box-shadow: 0 8px 20px -8px rgba(37,99,235,0.3) !important;
        }

        .active-card .group\/profile > div {
            rotate: 0deg !important;
            scale: 1.05 !important;
            transform: translateX(0.25rem) !important;
            box-shadow: 0 5px 5px -3px rgba(37,99,235,0.3) !important;
        }

        .active-card .absolute.right-3 > div {
            scale: 1.05 !important;
            transform: scale(1) !important; 
        }

        .active-card .material-symbols-outlined {
            rotate: -12deg !important;
            transform: translateX(-0.125rem) !important; 
        }
        .admin-row-card.active-card:hover {
            transform: translateY(-0.25rem) !important;
        }

        .siswa-row-card.active-card {
            pointer-events: auto;
            transform: translateY(-0.25rem) !important;
            box-shadow: 0 8px 20px -8px rgba(37,99,235,0.3) !important;
        }

        .siswa-row-card.active-card .group\/profile > div {
            rotate: 0deg !important;
            scale: 1.05 !important;
            transform: translateX(0.25rem) !important;
            box-shadow: 0 5px 5px -3px rgba(37,99,235,0.3) !important;
        }

        .siswa-row-card.active-card .absolute.right-3 > div {
            scale: 1.05 !important;
            transform: scale(1) !important;
        }

        .siswa-row-card.active-card .material-symbols-outlined {
            rotate: -12deg !important;
            transform: translateX(-0.125rem) !important;
        }

        .siswa-row-card.active-card:hover {
            transform: translateY(-0.25rem) !important;
        }
        
    </style>
</head>


<body class="text-slate-900 dark:text-slate-100 transition-colors duration-200 min-h-screen flex flex-col relative overflow-x-hidden h-screen overflow-hidden flex flex-col">
    
    <div class="antialiased overflow-x-hidden absolute top-0 right-0 -z-10 w-[600px] h-[600px] bg-blue-100/40 rounded-full blur-[120px] -translate-y-1/2 translate-x-1/2"></div>
    
    <div class="fixed bottom-0 left-0 -z-10 w-[500px] h-[500px] bg-indigo-50/30 rounded-full blur-[100px] translate-y-1/2 -translate-x-1/2"></div>
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
                            class="ml-2 h-9 w-9 flex items-center justify-center rounded-[8px] cursor-pointer transition-all duration-300 
                            border-blue-600 -translate-y-1 shadow-md shadow-blue-600/20 bg-white border active:scale-90">
                            
                            <span class="material-symbols-outlined text-blue-600 text-[18px]">
                                chat_bubble
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>


<main class="flex-1 flex justify-center items-center p-6">

    <div class="w-full max-w-6xl h-[85vh] flex section-container chat-container-active -mt-3">

 
        <aside class="w-sidebar-width flex-shrink-0 border-r-2 border-blue-200 bg-white/50 flex flex-col relative z-20 shadow-[0_0_40px_rgba(219,234,254,0.6)]">
        <div class="absolute -top-24 -left-24 -z-10 w-48 h-48 bg-blue-400/10 rounded-full blur-[60px]"></div>
        <div class="absolute -top-24 -right-24 -z-10 w-48 h-48 bg-blue-400/10 rounded-full blur-[60px]"></div>
        <div class="absolute -bottom-24 -left-24 -z-10 w-48 h-48 bg-blue-400/20 rounded-full blur-[80px]"></div>
        <div class="absolute -bottom-24 -right-24 -z-10 w-48 h-48 bg-blue-400/20 rounded-full blur-[80px]"></div>
    
            <div class="p-6 border-b-2 border-blue-200 shadow-[0_4px_20px_-5px_rgba(219,234,254,0.8)] relative z-10">
                <div class="pt-0 pb-3 px-2 flex justify-center items-center -mt-1">
                    <h2 class="text-[1.75rem] font-extrabold tracking-tighter font-heading leading-tight py-1 text-center">
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-slate-900 via-blue-600 to-blue-400">
                            MyLibAry <span class="italic">Message.</span>
                        </span>
                    </h2>
                </div>

                <div class="w-full relative h-auto flex items-left">
                    <form action="{{ route('chat.index') }}" method="GET" class="w-full relative group">
                        {{-- Button Search - Identik dengan referensi (Posisi, Efek Hover & Transisi) --}}
                        <button type="submit" class="absolute left-4 top-1/2 -translate-y-[42%] outline-none z-10">
                            <span class="material-symbols-outlined 
                                        text-slate-400 text-xl 
                                        transition-all duration-300 ease-in-out
                                        group-focus-within:text-blue-600 
                                        hover:text-blue-600 hover:translate-x-0.5 hover:scale-105 mt-0.5
                                        leading-none">
                                search
                            </span>
                        </button>

                        <input 
                            type="text" 
                            name="search" 
                            value="{{ request('search') }}"
                            class="w-full bg-white border border-slate-200 rounded-[2rem] py-3 pl-12 pr-4 text-xs transition-all outline-none text-slate-700 font-medium placeholder:text-slate-300
                                shadow-xl shadow-blue-900/5 
                                group-focus-within:ring-4 group-focus-within:ring-blue-600/10 
                                group-focus-within:border-blue-400 
                                group-focus-within:shadow-blue-900/10" 
                            placeholder="Search Username or Role..."
                        />
                    </form>
                </div>
            </div>
            
            <div class="flex-1 overflow-y-auto custom-scrollbar pb-2">
                @if($users->where('role', 'admin')->isNotEmpty())
                <div class="flex items-center justify-center gap-4 px-4 mb-1 mt-4">
                    <div class="flex-grow h-[3px] bg-gradient-to-r from-transparent via-blue-500 to-blue-600 rounded-full opacity-80"></div>
                    <h4 class="text-xl font-extrabold tracking-tighter font-heading pb-1 inline-block text-transparent bg-clip-text bg-gradient-to-r from-slate-900 via-blue-600 to-blue-400 transform-gpu whitespace-nowrap" 
                        style="-webkit-background-clip: text; -webkit-text-fill-color: transparent; backface-visibility: hidden;">
                        Administrators
                    </h4>
                    <div class="flex-grow h-[3px] bg-gradient-to-l from-transparent via-blue-500 to-blue-600 rounded-full opacity-80"></div>
                </div>

                @foreach($users->where('role', 'admin') as $user)
                    @php
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
                        
                        // TRIK: Ubah 'bg-xxx-100' menjadi 'bg-xxx-600' khusus untuk badge
                        $badgeBg = str_replace('100', '500', $clr['bg']);
                    @endphp

                    <div id="card-{{ $user->user_id }}"
                    onclick="setActiveCard({{ $user->user_id }}, '{{ $user->username }}', '{{ $user->foto_profile }}')"
                        class="admin-row-card bg-white rounded-[2.5rem] border-l-[3px] {{ $clr['border_l'] }} border border-slate-200 py-2 px-2.5 mb-2.5 cursor-pointer group/returned-card transition-all duration-500 transform-gpu 
                            hover:-translate-y-1
                            hover:shadow-[0_8px_20px_-8px_rgba(37,99,235,0.3)]
                            block relative overflow-visible"
                        style="{{ $style }} margin-left: 0.75rem; margin-right: 0.75rem; width: calc(100% - 1.5rem);">
                        
                        <div class="flex items-center gap-2 min-w-0">
                            
                            {{-- SISI KIRI: Foto & Username --}}
                            <div class="flex items-center gap-2 min-w-0">
                                <div class="relative group/profile w-9 h-9 flex-shrink-0 transition-all duration-700 ease-[cubic-bezier(0.34,1.56,0.64,1)] hover:scale-110">
                                    <div class="absolute inset-0 rounded-full bg-slate-100 border-[1.5px] border-white shadow-md overflow-hidden flex items-center justify-center 
                                        -rotate-6 translate-x-0
                                        group-hover/returned-card:rotate-0 
                                        group-hover/returned-card:scale-105 
                                        group-hover/returned-card:translate-x-1
                                        group-hover/returned-card:shadow-[0_5px_5px_-3px_rgba(37,99,235,0.3)]
                                        transition-all duration-700 ease-[cubic-bezier(0.34,1.56,0.64,1)]">

                                        @if($user->foto_profile)
                                            <img src="{{ asset('storage/' . $user->foto_profile) }}" class="w-full h-full object-cover" alt="{{ $user->username }}">
                                        @else
                                            <div class="w-full h-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold text-[7px]">
                                                {{ strtoupper(substr($user->username, 0, 2)) }}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <span class="font-black text-[13.5px] tracking-tight font-heading leading-tight transform-gpu inline-block truncate ml-1 max-w-[200px]" 
                                    style="
                                        backface-visibility: hidden;
                                        background-image: linear-gradient(to right, #2563eb 5%, #60a5fa 95%);
                                        -webkit-background-clip: text;
                                        -webkit-text-fill-color: transparent;
                                        white-space: nowrap;
                                    "
                                    title="{{ $user->username }}">
                                    {{ $user->username }}
                                </span>
                            </div>

                            {{-- SISI KANAN: Badge Administrator (FIX: Menggunakan Warna 600) --}}
                            <div class="absolute right-3 flex-shrink-0">
                                {{-- Menggunakan $badgeBg (versi 600) agar warna solid --}}
                                <div class="flex items-center px-2 h-[1.375rem] rounded-full {{ $badgeBg }} text-white transition-all duration-700 ease-[cubic-bezier(0.4,0,0.2,1)] justify-center border-none cursor-default transform-gpu 
                                    group-hover/returned-card:scale-105"
                                    style="box-shadow: none;">
                                    
                                    <p class="text-[9px] font-black font-modern uppercase tracking-tighter tabular-nums leading-none whitespace-nowrap flex items-center gap-1">
                                        @if($user->role === 'admin')
                                            Administrator
                                            <span class="material-symbols-outlined text-[10.5px] transition-all duration-700 ease-[cubic-bezier(0.25,0.1,0.25,1)] group-hover/returned-card:-rotate-12 group-hover/returned-card:-translate-x-0.5">
                                                shield_person
                                            </span>
                                        @else
                                            Library Student
                                            <span class="material-symbols-outlined text-[10.5px] transition-all duration-700 ease-[cubic-bezier(0.25,0.1,0.25,1)] group-hover/returned-card:-rotate-12 group-hover/returned-card:-translate-x-0.5">
                                                local_library
                                            </span>
                                        @endif
                                    </p>
                                </div>
                            </div>

                        </div>
                    </div>
                @endforeach
                @endif

                @if($users->where('role', '!=', 'admin')->isNotEmpty())
                <div class="flex items-center justify-center gap-4 px-4 mb-1 mt-4">
                    <div class="flex-grow h-[3px] bg-gradient-to-r from-transparent via-blue-400 to-blue-500 rounded-full opacity-80"></div>
                    <h4 class="text-xl font-extrabold tracking-tighter font-heading pb-1 inline-block text-transparent bg-clip-text bg-gradient-to-r from-slate-900 via-blue-500 to-blue-400 transform-gpu whitespace-nowrap" 
                        style="-webkit-background-clip: text; -webkit-text-fill-color: transparent; backface-visibility: hidden;">
                        Students List
                    </h4>
                    <div class="flex-grow h-[3px] bg-gradient-to-l from-transparent via-blue-400 to-blue-500 rounded-full opacity-80"></div>
                </div>  

                @foreach($users->where('role', '!=', 'admin') as $user)
                    @php
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
                        $badgeBg = str_replace('100', '500', $clr['bg']);
                    @endphp

                    <div id="card-{{ $user->user_id }}"
                        onclick="setActiveCard({{ $user->user_id }}, '{{ $user->username }}', '{{ $user->foto_profile }}')"
                        class="siswa-row-card bg-white rounded-[2.5rem] border-l-[3px] {{ $clr['border_l'] }} border border-slate-200 py-2 px-2.5 mb-2.5 cursor-pointer group/returned-card transition-all duration-500 transform-gpu 
                            hover:-translate-y-1
                            hover:shadow-[0_8px_20px_-8px_rgba(37,99,235,0.3)]
                            block relative overflow-visible"
                        style="{{ $style }} margin-left: 0.75rem; margin-right: 0.75rem; width: calc(100% - 1.5rem);">
                        
                        <div class="flex items-center gap-2 min-w-0">
                            
                            <div class="flex items-center gap-2 min-w-0">
                                <div class="relative group/profile w-9 h-9 flex-shrink-0 transition-all duration-700 ease-[cubic-bezier(0.34,1.56,0.64,1)] hover:scale-110">
                                    <div class="absolute inset-0 rounded-full bg-slate-100 border-[1.5px] border-white shadow-md overflow-hidden flex items-center justify-center 
                                        -rotate-6 translate-x-0
                                        group-hover/returned-card:rotate-0 
                                        group-hover/returned-card:scale-105 
                                        group-hover/returned-card:translate-x-1
                                        group-hover/returned-card:shadow-[0_5px_5px_-3px_rgba(37,99,235,0.3)]
                                        transition-all duration-700 ease-[cubic-bezier(0.34,1.56,0.64,1)]">

                                        @if($user->foto_profile)
                                            <img src="{{ asset('storage/' . $user->foto_profile) }}" class="w-full h-full object-cover" alt="{{ $user->username }}">
                                        @else
                                            <div class="w-full h-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold text-[7px]">
                                                {{ strtoupper(substr($user->username, 0, 2)) }}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <span class="font-black text-[13.5px] tracking-tight font-heading leading-tight transform-gpu inline-block truncate ml-1 max-w-[200px]" 
                                    style="
                                        backface-visibility: hidden;
                                        background-image: linear-gradient(to right, #2563eb 5%, #60a5fa 95%);
                                        -webkit-background-clip: text;
                                        -webkit-text-fill-color: transparent;
                                        white-space: nowrap;
                                    "
                                    title="{{ $user->username }}">
                                    {{ $user->username }}
                                </span>
                            </div>

                            <div class="absolute right-3 flex-shrink-0">
                                <div class="flex items-center px-2 h-[1.375rem] rounded-full {{ $badgeBg }} text-white transition-all duration-700 ease-[cubic-bezier(0.4,0,0.2,1)] justify-center border-none cursor-default transform-gpu 
                                    group-hover/returned-card:scale-105"
                                    style="box-shadow: none;">
                                    
                                    <p class="text-[9px] font-black font-modern uppercase tracking-tighter tabular-nums leading-none whitespace-nowrap flex items-center gap-1">
                                        Library Student
                                        <span class="material-symbols-outlined text-[10.5px] transition-all duration-700 ease-[cubic-bezier(0.25,0.1,0.25,1)] group-hover/returned-card:-rotate-12 group-hover/returned-card:-translate-x-0.5">
                                            local_library
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                @endif

                @if($users->isEmpty())
                    <div class="flex flex-col items-center justify-center py-20 px-6 text-center">
                        {{-- Icon menggunakan warna slate-200 sesuai referensi --}}
                        <span class="material-symbols-outlined text-slate-200 text-6xl mb-4">
                            search_off
                        </span>
                        
                        {{-- Teks menggunakan font-accent, uppercase, tracking-widest, dan ukuran text-xs --}}
                        <p class="text-slate-400 font-accent uppercase tracking-widest text-[11px] font-bold">
                            No <span class="text-[#2b6cee]">Users Found</span> in Database.
                        </p>
                        
                        {{-- Opsional: Menampilkan query pencarian dengan gaya yang lebih halus --}}
                        @if(request('search'))
                            <p class="text-slate-300 text-[11px] mt-2 italic font-medium">
                                "{{ request('search') }}" doesn't match any records.
                            </p>
                        @endif
                    </div>
                @endif
            </div>
        </aside>    

       <section id="chat-welcome" class="flex-1 flex flex-col items-center justify-center text-center p-10">
            <span class="material-symbols-outlined text-slate-200 text-6xl mb-4">forum</span>
            <p class="text-slate-400 font-accent uppercase tracking-widest text-xs font-bold">
                Welcome to <span class="text-[#2b6cee]">LibSys Chat</span>. 
                <br>
                <span class="mt-2 block opacity-80">Select a contact on the left to start a conversation.</span>
            </p>
        </section>

        <section id="chat-container" class="flex-1 flex flex-col relative bg-white hidden">

           <div class="h-[72px] px-6 flex items-center justify-between border-b-2 border-blue-200 bg-white glass-panel sticky top-0 z-10 shadow-[0_0_40px_rgba(219,234,254,0.6)]">
                <div class="absolute -bottom-16 -left-16 -z-10 w-40 h-40 bg-blue-400/5 rounded-full blur-[40px]"></div>
                <div class="absolute -bottom-16 -right-16 -z-10 w-40 h-40 bg-blue-400/20 rounded-full blur-[80px]"></div>
                
                <div class="flex items-center gap-4 ml-2">
                    <div class="relative w-11 h-11 shrink-0">
                        <div id="active-user-avatar" 
                            class="absolute inset-0 rounded-full bg-slate-100 border-[1.5px] border-white overflow-hidden flex items-center justify-center 
                            shadow-[0_5px_15px_-3px_rgba(37,99,235,0.3)]">
                        </div>
                    </div>
                    
                    <div>
                        <h3 id="active-user-name" 
                            class="font-black text-[20px] mt-2 tracking-tight font-heading leading-tight transform-gpu inline-block truncate max-w-[200px]" 
                            style="
                                backface-visibility: hidden;
                                background-image: linear-gradient(to right, #2563eb 5%, #60a5fa 95%);
                                -webkit-background-clip: text;
                                -webkit-text-fill-color: transparent;
                                white-space: nowrap;
                            ">
                            Select a Chat
                        </h3>
                    </div>
                </div>
                <span class="mr-4 relative overflow-hidden px-5 py-2 bg-gradient-to-r from-blue-700 to-blue-500 text-white rounded-full text-[9px] font-black font-accent tracking-widest shadow-lg">
                    <span class="relative z-10 uppercase">
                        <span id="chat-count">0</span> Total Messages
                    </span>
                </span>
            </div>

            <div id="chat-history" class="flex-1 overflow-y-auto px-6 py-4 flex flex-col gap-4 custom-scrollbar bg-slate-50">
            </div>

            <form id="chat-form" 
                enctype="multipart/form-data" 
                class="p-4 bg-white/40 border-t-2 border-blue-200 shadow-[0_-20px_40px_rgba(219,234,254,0.6)] relative z-20 overflow-hidden">

                <div class="absolute -bottom-16 -left-16 -z-10 w-40 h-40 bg-blue-400/10 rounded-full blur-[60px]"></div>
                <div class="absolute -bottom-16 -right-16 -z-10 w-40 h-40 bg-blue-400/10 rounded-full blur-[60px]"></div>
                @csrf
                <input type="hidden" id="receiver_id" name="receiver_id">

               <div id="file-preview" class="hidden mb-3 p-2 bg-white border-2 border-blue-200 rounded-2xl shadow-sm flex items-center gap-3 animate-fade-in overflow-hidden">
                <div class="relative w-12 h-12 rounded-lg overflow-hidden border border-blue-200 shrink-0 bg-slate-100">
                    <img id="image-preview-asli" src="" class="w-full h-full object-cover">
                </div>

                <div class="flex-1 min-w-0 flex flex-col justify-center"> 
                    <p id="file-name" class="text-[11px] font-bold text-slate-700 line-clamp-2 break-all leading-tight">
                    </p>
                    <p class="text-[10px] text-blue-400 font-semibold uppercase tracking-wider mt-0.5">Ready to send</p>
                </div>
                <button type="button" onclick="cancelFile()" 
                    class="group/cancel w-8 h-8 flex-shrink-0 rounded-xl bg-white border-2 border-rose-200 flex items-center justify-center cursor-pointer transition-all duration-500 ease-[cubic-bezier(0.34,1.56,0.64,1)] 
                    hover:bg-gradient-to-br hover:from-rose-500 hover:to-rose-600 
                    hover:border-white hover:shadow-[0_8px_15px_-8px_rgba(225,29,72,0.5)] 
                    relative overflow-hidden ml-auto">
                    
                    <span class="material-symbols-outlined text-rose-500 text-[20px] transition-all duration-500 ease-[cubic-bezier(0.34,1.56,0.64,1)]
                        group-hover/cancel:text-white 
                        group-hover/cancel:rotate-[90deg] 
                        group-hover/cancel:scale-110">
                        close
                    </span>
                </button>
            </div>
                
                <div class="flex items-center gap-3">
                    
                    <label class="group/attach w-10 h-10 rounded-full bg-white border-2 border-blue-200 flex items-center justify-center cursor-pointer transition-all duration-500 ease-[cubic-bezier(0.34,1.56,0.64,1)] 
                                hover:bg-gradient-to-br hover:from-blue-500 hover:to-blue-600 
                                hover:border-white hover:shadow-[0_8px_20px_-8px_rgba(37,99,235,0.5)] 
                                relative overflow-hidden">
                        
                        {{-- Input File Hidden --}}
                        <input type="file" name="file" id="file-input" class="hidden" onchange="previewFile()" accept="image/*">
                        
                        {{-- Icon: Rotate 120 derajat, No Translate, White Border on Hover --}}
                        <span class="material-symbols-outlined text-blue-500 text-[22px] transition-all duration-500 ease-[cubic-bezier(0.34,1.56,0.64,1)]
                                    group-hover/attach:text-white 
                                    group-hover/attach:rotate-[120deg] 
                                    group-hover/attach:scale-110">
                            attach_file
                        </span>

                    </label>
                    
                    <div class="flex-1 relative group transition-all duration-300 mr-1">
                        <div id="chat-bar-container"
                            class="flex items-center bg-white border border-slate-200 rounded-[2rem] px-4 py-2 transition-all outline-none
                                    shadow-xl shadow-blue-900/5 
                                    group-focus-within:ring-4 group-focus-within:ring-blue-600/10 
                                    group-focus-within:border-blue-400 
                                    group-focus-within:shadow-blue-900/10">
                            
                            <textarea 
                            id="message-input" 
                            name="message" 
                            required
                            rows="1"
                            oninput="autoResize(this); handleChatBarEffect(this)"
                            onfocus="handleChatBarEffect(this)"
                            class="bg-transparent border-none focus:ring-0 w-full text-sm p-0 text-slate-700 font-medium placeholder:text-slate-300 outline-none resize-none max-h-[60px] overflow-y-auto custom-scrollbar" 
                            placeholder="Write Your Message..."></textarea>
                        </div>
                    </div>
                    
                    <button type="submit" 
                        class="mr-3 group/send w-10 h-10 rounded-xl bg-white border-2 border-blue-200 flex items-center justify-center cursor-pointer transition-all duration-500 ease-[cubic-bezier(0.34,1.56,0.64,1)] 
                            hover:bg-gradient-to-br hover:from-blue-500 hover:to-blue-600 
                            hover:border-white hover:shadow-[0_8px_20px_-8px_rgba(37,99,235,0.5)] 
                            relative overflow-hidden">
                    
                    {{-- Icon: Rotate 20 degrees, Square Model --}}
                    <span class="material-symbols-outlined text-blue-500 text-[22px] transition-all duration-500 ease-[cubic-bezier(0.34,1.56,0.64,1)]
                                group-hover/send:text-white 
                                group-hover/send:rotate-[20deg] 
                                group-hover/send:scale-110">
                        send
                    </span>
                </button>
                </div>
            </form>
        </section>
    </div>
</main>

<script>
    function handleChatBarEffect() {
        const input = document.getElementById('message-input');
        const container = document.getElementById('chat-bar-container');
        const fileInput = document.getElementById('file-input');
        
        const activeClasses = ['ring-4', 'ring-blue-600/10', 'border-blue-400', 'shadow-blue-900/10'];

        if (input.value.length > 0 || (fileInput && fileInput.files.length > 0)) {
            activeClasses.forEach(cls => container.classList.add(cls));
        } else {
            activeClasses.forEach(cls => container.classList.remove(cls));
        }
    }

    function previewFile() {
        const file = $('#file-input')[0].files[0];
        if(file) {
            $('#file-name').text("File: " + file.name);
            $('#file-preview').removeClass('hidden');
            $('#message-input').prop('required', false);
            handleChatBarEffect();
        }
    }

    function cancelFile() {
        $('#file-input').val('');
        $('#file-preview').addClass('hidden');
        $('#message-input').prop('required', true);
        handleChatBarEffect();
    }

    function autoResize(textarea) {
        textarea.style.height = 'auto';
        
        const maxHeight = 80; 
        const currentHeight = textarea.scrollHeight;

        if (currentHeight > maxHeight) {
            textarea.style.height = maxHeight + 'px';
            textarea.style.overflowY = 'auto'; 
        } else {
            textarea.style.height = currentHeight + 'px';
            textarea.style.overflowY = 'hidden';
        }
    }

    document.getElementById('chat-bar-container').addEventListener('click', function() {
        document.getElementById('message-input').focus();
    });

    document.addEventListener('DOMContentLoaded', function() {
    const messageInput = document.getElementById('message-input');
    const chatForm = document.getElementById('chat-form');

    messageInput.addEventListener('invalid', function(e) {
        e.preventDefault(); 
        
        this.setCustomValidity('Pesan tidak boleh kosong');
        
        this.reportValidity();

        setTimeout(() => {
            this.setCustomValidity(''); 
            if (!this.validity.valid) {
                this.reportValidity();
            }
        }, 3000);
    });
    messageInput.addEventListener('input', function() {
        this.setCustomValidity('');
    });
});
</script>


<script>
    let currentReceiverId = null;
    let isUserScrollingUp = false;

    $('#chat-history').on('scroll', function() {
    const history = $(this)[0];
    const distanceFromBottom = history.scrollHeight - history.scrollTop - history.clientHeight;
    
    isUserScrollingUp = distanceFromBottom > 100;
});

   function loadChat(userId, userName, userPhoto) {
        currentReceiverId = userId;
        $('#receiver_id').val(userId);
        $('#chat-welcome').addClass('hidden');
        $('#chat-container').removeClass('hidden');
        
        $('#active-user-name').text(userName).attr('title', userName);

        let avatarContainer = $('#active-user-avatar');
        avatarContainer.empty();
        
        if (userPhoto && userPhoto !== 'null' && userPhoto !== '') {
            avatarContainer.append(`
                <img src="/storage/${userPhoto}" 
                    class="w-full h-full object-cover animate-fade-in" 
                    alt="${userName}"
                    onerror="this.src='https://ui-avatars.com/api/?name=${encodeURIComponent(userName)}&background=DBEAFE&color=2563EB'">
            `);
        } else {
            let initials = userName.substring(0, 2).toUpperCase();
            avatarContainer.append(`
                <div class="w-full h-full bg-gradient-to-br from-blue-50 to-blue-100 flex items-center justify-center text-blue-600 font-bold text-[13px] animate-fade-in">
                    ${initials}
                </div>
            `);
        }

        fetchMessages();
    }

    function fetchMessages() {
        if(!currentReceiverId) return;

        $.get(`/dashboard/chat/messages/${currentReceiverId}`, function(data) {
            $('#chat-count').text(data.length);
            let html = '';
            data.forEach(msg => {
                const isMe = msg.sender_id == "{{ Auth::id() }}";
                const alignment = isMe ? 'flex-row-reverse' : 'flex-row';
                
                const cardStyle = {
                    bg: 'bg-blue-100/90',
                    border: 'border-blue-200',
                    text: 'text-blue-800',
                    time: 'text-blue-500',
                    shadow: '0 4px 6px -1px rgba(37, 99, 235, 0.06)',
                    font: 'font-sans tracking-tight' 
                };

                let contentHtml = '';
                if(msg.file_path) {
                    contentHtml += `
                        <div class="mb-2">
                            <img src="/storage/${msg.file_path}" 
                                class="rounded-xl max-w-xs border-2 border-white shadow-sm cursor-pointer" 
                                onclick="window.open('/storage/${msg.file_path}')">
                        </div>
                    `;
                } 
                
                if(msg.message) {
                    contentHtml += `
                        <div class="flex ${isMe ? 'flex-row-reverse text-right' : 'flex-row'} gap-2 items-start">
                            <span class="material-symbols-outlined ${cardStyle.time} opacity-40 text-[18px] shrink-0 mt-1" 
                                style="font-variation-settings: 'wght' 600;">
                                forum
                            </span>
                            <p class="${cardStyle.text} ${cardStyle.font} text-[14px] leading-relaxed font-bold break-words">
                                ${msg.message}
                            </p>
                        </div>
                    `;
                }

                let avatarHtml = '';
                if (isMe) {
                    avatarHtml = `@if(auth()->user()->foto_profile)<img src="{{ asset('storage/' . auth()->user()->foto_profile) }}?t={{ time() }}" class="w-full h-full object-cover">@else<div class="w-full h-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold text-[11px]">{{ strtoupper(substr(auth()->user()->username, 0, 2)) }}</div>@endif`;
                } else {
                    if (msg.sender_foto_profile) {
                        avatarHtml = `<img src="/storage/${msg.sender_foto_profile}" class="w-full h-full object-cover">`;
                    } else {
                        const initial = (msg.sender_username || "User").substring(0, 2).toUpperCase();
                        avatarHtml = `<div class="w-full h-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold text-[11px]">${initial}</div>`;
                    }
                }

                const statusRowHtml = isMe 
                    ? ` <span class="text-[10px] font-bold ${cardStyle.time} uppercase tracking-wider">
                            ${new Date(msg.created_at).toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})}
                        </span>
                        <span class="material-symbols-outlined text-[15px] ${cardStyle.time} opacity-80">done_all</span>`
                    : ` <span class="material-symbols-outlined text-[15px] ${cardStyle.time} opacity-80">done_all</span>
                        <span class="text-[10px] font-bold ${cardStyle.time} uppercase tracking-wider">
                            ${new Date(msg.created_at).toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})}
                        </span>`;

                html += `
                    <div class="flex ${alignment} gap-2.5 mb-2 animate-fade-in">
                        <!-- Avatar Area -->
                        <div class="flex-shrink-0 mt-auto mb-1">
                            <div class="w-9 h-9 rounded-full border-2 border-white bg-white flex items-center justify-center overflow-hidden shadow-[0_3px_8px_rgba(37,99,235,0.2)]">
                                ${avatarHtml}
                            </div>
                        </div>

                        <!-- Bubble Card Lancip -->
                        <!-- Tambahkan overflow-hidden untuk memastikan konten tidak meluap -->
                        <div class="relative p-3.5 ${cardStyle.bg} border ${cardStyle.border} backdrop-blur-md max-w-[75%] w-fit overflow-hidden
                            ${isMe ? 'rounded-[1.3rem] rounded-br-none' : 'rounded-[1.3rem] rounded-bl-none'}"
                            style="box-shadow: ${cardStyle.shadow}">
                            
                            <!-- Ekor Lancip -->
                            <div class="absolute bottom-0 w-4 h-4 ${cardStyle.bg}
                                ${isMe ? '-right-1.5 -scale-x-100 rotate-[-10deg]' : '-left-1.5 rotate-[10deg]'}"
                                style="clip-path: polygon(0 0, 100% 100%, 100% 0);">
                            </div>

                            <!-- Konten Pesan -->
                            <!-- Tambahkan break-all khusus untuk menangani link URL super panjang agar dipaksa turun -->
                            <div class="relative z-10 break-all">
                                ${contentHtml}
                            </div>

                            <!-- Info Waktu & Status -->
                            <div class="mt-1.5 flex items-center gap-1.5 ${isMe ? 'justify-end' : 'justify-start'} relative z-10">
                                ${statusRowHtml}
                            </div>
                        </div>
                    </div>
                `;
            });

            $('#chat-history').html(html);
            
            if (!isUserScrollingUp) {
                scrollToBottom();
            }
        });
    }

    $('#chat-form').on('submit', function(e) {
        e.preventDefault();
        
        let messageInput = $('#message-input');
        let formData = new FormData(this);

        let submitBtn = $(this).find('button[type="submit"]');
        submitBtn.prop('disabled', true);

        $.ajax({
            url: "{{ route('chat.send') }}",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                messageInput.val('');
                cancelFile();

                setTimeout(fetchMessages, 100);
            },
            complete: function() {
                submitBtn.prop('disabled', false);
            }
        });
    });

    function previewFile() {
        const fileInput = document.getElementById('file-input');
        const file = fileInput.files[0];
        const previewContainer = document.getElementById('file-preview');
        const previewImage = document.getElementById('image-preview-asli');
        const fileNameDisplay = document.getElementById('file-name');
        const messageInput = document.getElementById('message-input');

        if (file) {
            fileNameDisplay.innerText = file.name;

            const reader = new FileReader();
            reader.onload = function(e) {
                previewImage.src = e.target.result; 
            }
            reader.readAsDataURL(file);

            previewContainer.classList.remove('hidden');
            previewContainer.classList.add('flex'); 

            messageInput.required = false;

            handleChatBarEffect();
        }
    }

    function cancelFile() {
        const fileInput = document.getElementById('file-input');
        const previewContainer = document.getElementById('file-preview');
        const previewImage = document.getElementById('image-preview-asli');
        const messageInput = document.getElementById('message-input');

        fileInput.val = ""; 
        $('#file-input').val(''); 

        previewImage.src = "";
        previewContainer.classList.add('hidden');
        previewContainer.classList.remove('flex');
        
        if (messageInput.value.trim() === "") {
            messageInput.required = true;
        }

        handleChatBarEffect();
    }

        function scrollToBottom() {
        const history = document.getElementById('chat-history');
        if (history) {
            history.scrollTo({
                top: history.scrollHeight,
                behavior: 'smooth'
            });
        }
    }


    setInterval(fetchMessages, 1000);

    function setActiveCard(userId, username, userPhoto) {

        document.querySelectorAll('.admin-row-card, .siswa-row-card').forEach(card => {
            card.classList.remove('active-card');
        });

        const currentCard = document.getElementById(`card-${userId}`);
        if (currentCard) {
            currentCard.classList.add('active-card');
        }

        if (typeof loadChat === "function") {
            loadChat(userId, username, userPhoto);
        }
    }
</script>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        const urlParams = new URLSearchParams(window.location.search);
        const selectId = urlParams.get('select_id');

        if (selectId) {
            const adminCard = document.getElementById('card-' + selectId);
            
            if (adminCard) {
                setTimeout(() => {
                    adminCard.click();
                    
                    adminCard.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });
                    
                    window.history.replaceState({}, document.title, window.location.pathname);
                }, 500);
            }
        }
    });
</script>

</body>
</html>