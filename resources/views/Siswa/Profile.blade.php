<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Student Profile & Settings - MyLibAry.</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Plus+Jakarta+Sans:wght@700;800&family=Montserrat:wght@500;700;900&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    
    <style type="text/tailwindcss">
        :root {
            --bg-silver: #2b6cee;
            --primary-blue: #2b6cee;
            --charcoal: #334155;
            --slate-label: #64748b;
        }
        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-silver);
            background-image: 
                radial-gradient(at 0% 0%, rgba(43, 108, 238, 0.05) 0px, transparent 50%),
                radial-gradient(at 100% 0%, rgba(43, 108, 238, 0.03) 0px, transparent 50%);
        }

        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 700, 'GRAD' 0, 'opsz' 24;
        }

        .nav-icon {
        font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24 !important;
    }
        
        h1, h2, h3, .font-heading { font-family: 'Plus Jakarta Sans', sans-serif; }
        .font-accent { font-family: 'Montserrat', sans-serif; }
        .glass-nav { backdrop-filter: blur(16px); background-color: rgba(255, 255, 255, 0.85); }
        
        .text-gradient {
            background: linear-gradient(to right, #1a1a1a, #2b6cee);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .settings-card { 
            @apply relative bg-white backdrop-blur-xl rounded-[3rem] border border-white/40 
                overflow-hidden border-r-4 border-r-slate-200/50 
                transition-all duration-700 ease-in-out
                shadow-2xl shadow-blue-900/5 antialiased; 
                
                backface-visibility: hidden;
                transform: translateZ(0);
        }
        
        .hover-blue:hover { 
            @apply -translate-y-2 border-blue-400/40 border-r-blue-400/60 
                shadow-[0_15px_30px_-12px_rgba(37,99,235,0.10),0_0_15px_rgba(37,99,235,0.08)]; 
        }
        .hover-purple:hover { 
            @apply -translate-y-2 border-indigo-400/40 border-r-indigo-400/60 
                shadow-[0_15px_30px_-12px_rgba(99,102,241,0.10),0_0_15px_rgba(99,102,241,0.08)]; 
        }

        .hover-red:hover { 
            @apply -translate-y-2 border-red-400/40 border-r-red-400/60 
                shadow-[0_15px_30px_-12px_rgba(239,68,68,0.10),0_0_15px_rgba(239,68,68,0.08)]; 
        }

        .hover-emerald:hover { 
            @apply -translate-y-2 border-emerald-400/40 border-r-emerald-400/60 
                shadow-[0_15px_30px_-12px_rgba(16,185,129,0.10),0_0_15px_rgba(16,185,129,0.08)]; 
        }



        .input-field { @apply w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-600/10 focus:border-blue-600 focus:bg-white transition-all outline-none text-slate-700 font-medium; }
        .input-field:disabled { @apply bg-slate-100 text-slate-400 border-slate-200 cursor-not-allowed; }
        .label-style { @apply block text-[9px] font-black text-emerald-600/60 mb-1.5 ml-1 uppercase tracking-widest font-accent italic; }
        .section-title { @apply text-base font-black text-slate-900 flex items-center gap-2 uppercase tracking-tight font-heading; }

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

    <nav class="sticky top-0 z-50 glass-nav border-b border-slate-200">
        <div class="max-w-full mx-auto px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <div class="flex items-center gap-2 flex-shrink-0 cursor-pointer" onclick="window.location.href='{{ route('siswa.dashboard') }}'">
                    <span class="material-symbols-outlined nav-icon text-blue-600 text-3xl font-bold">auto_stories</span>
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
                            class="ml-2 h-9 w-9 flex items-center justify-center rounded-lg border border-slate-200 bg-white shadow-sm cursor-pointer transition-all duration-300 
                            hover:border-blue-600 hover:-translate-y-1 hover:shadow-md hover:shadow-blue-600/20 active:scale-90 group/chat">
                            
                            <span class="material-symbols-outlined nav-icon text-slate-400 transition-colors duration-300 group-hover/chat:text-blue-600 text-[18px]">
                                chat_bubble
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <main class="flex-grow max-w-4xl mx-auto w-full px-6 lg:px-12 py-10 relative">
        @if(session('success'))
            <div class="mb-6 p-4 bg-white border border-emerald-200 rounded-2xl shadow-sm flex items-center gap-3">
                <span class="material-symbols-outlined text-emerald-500 font-bold">check_circle</span>
                <span class="text-[10px] font-black uppercase tracking-[0.2em] text-emerald-600 font-accent">{{ session('success') }}</span>
            </div>
        @endif

        {{-- PROFILE HEADER CARD --}}
        <div class="settings-card hover-blue mb-8 p-10 flex flex-col md:flex-row items-center justify-between gap-8 group/card relative overflow-hidden bg-white">
    
            <div class="absolute -top-40 -left-40 w-[600px] h-[600px] bg-blue-400/5 rounded-full blur-[150px] pointer-events-none -z-10"></div>

            <div class="absolute -top-10 -left-10 w-[800px] h-[800px] bg-blue-300/[0.03] rounded-full blur-[180px] pointer-events-none -z-10"></div>

            <div class="absolute inset-x-0 top-0 h-px bg-gradient-to-r from-transparent via-blue-400/30 to-transparent opacity-0 group-hover/card:opacity-100 transition-opacity duration-700"></div>

            <div class="absolute inset-0 bg-white/10 transition-colors duration-700 ease-in-out group-hover/card:bg-white/20 -z-10"></div>
    


            {{-- KONTEN UTAMA: Harus dibungkus 'relative z-10' agar teks tetap di depan --}}
            <div class="flex flex-col md:flex-row items-center gap-8 text-left relative z-10 w-full">
                <div class="relative">
                    <div class="relative group/profile w-32 h-32 flex items-center justify-center">
                        <div class="absolute inset-0 rounded-full bg-slate-100 border-4 border-white shadow-lg overflow-hidden flex items-center justify-center 
                            -rotate-6 translate-x-0
                            group-hover/card:rotate-0 group-hover/card:scale-105 group-hover/card:translate-x-3 
                            group-hover/card:shadow-[0_10px_20px_-2px_rgba(59,130,246,0.25)]
                            group-hover/profile:scale-110 
                            group-hover/profile:shadow-[0_12px_25px_-5px_rgba(37,99,235,0.35)] 
                            transition-all duration-700 ease-[cubic-bezier(0.34,1.56,0.64,1)]">

                            @if(auth()->user()->foto_profile)
                                <img id="profileDisplay" alt="Profile" 
                                    class="w-full h-full object-cover transition-transform duration-700 ease-out group-hover/profile:scale-105" 
                                    src="{{ asset('storage/' . auth()->user()->foto_profile) }}?t={{ time() }}"
                                    onerror="this.onerror=null; this.parentElement.innerHTML='<div class=\'w-full h-full bg-red-500 flex items-center justify-center text-white font-bold\'>Error</div>';"/>
                            @else
                                <div id="profileDisplay" class="w-full h-full bg-blue-600 flex items-center justify-center text-white text-3xl font-black font-heading transition-colors duration-700 group-hover/profile:bg-blue-600">
                                    {{ strtoupper(substr(auth()->user()->username, 0, 2)) }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="absolute -bottom-2 -right-2 w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center border-4 border-white shadow-lg 
                        transition-all duration-700 ease-[cubic-bezier(0.34,1.56,0.64,1)]
                        group-hover/card:-translate-y-1
                        group-hover/card:shadow-[0_10px_20px_-2px_rgba(59,130,246,0.25)]
                        hover:scale-110 
                        hover:shadow-[0_12px_25px_-5px_rgba(37,99,235,0.35)]">
                        
                        <span class="material-symbols-outlined text-white text-lg font-bold">
                            badge
                        </span>
                    </div>
                </div>
                <div class="text-center md:text-left">
                    <div class="relative inline-block">
                        {{-- Shadow Menyebar 1: Sangat rapat ke teks atas/bawah --}}
                        <div class="absolute top-1/2 left-0 -translate-y-1/2 w-[220px] h-[50px] bg-blue-400/10 rounded-full blur-[35px] pointer-events-none -z-10"></div>
                        
                        {{-- Shadow Menyebar 2: Radius sekunder, tetap rapat atas/bawah --}}
                        <div class="absolute top-1/2 left-5 -translate-y-1/2 w-[350px] h-[65px] bg-blue-400/10 rounded-full blur-[50px] pointer-events-none -z-10"></div>

                        {{-- Tulisan Username --}}
                        <h1 class="text-4xl font-extrabold tracking-tighter font-heading leading-tight bg-gradient-to-r from-blue-900 via-blue-600 to-blue-400 bg-clip-text text-transparent relative z-10">
                            {{ auth()->user()->username }}
                        </h1>
                        
                        {{-- Tulisan Email --}}
                        <p class="text-blue-600/60 text-[13px] font-black tracking-[0.2em] font-accent italic mt-1 relative z-10">
                            {{ auth()->user()->email }}
                        </p>
                    </div>
                    <div class="mt-5 flex flex-wrap gap-4 justify-center md:justify-start font-accent">
                        <span class="group relative isolate overflow-hidden px-4 py-1.5 bg-white text-blue-600 text-[9px] font-black uppercase tracking-[0.2em] rounded-xl shadow-sm border border-blue-200 cursor-default transform-gpu
                            {{-- Transisi dasar --}}
                            transition-all duration-500 ease-[cubic-bezier(0.4,0,0.2,1)] 

                            {{-- EFEK 1: Zoom saat kursor masuk area Card (luar) --}}
                            group-hover/card:scale-[1.05]

                            {{-- EFEK 2: Perbaikan - Paksa zoom lebih besar saat kursor TEPAT di Badge --}}
                            group-hover/card:hover:-translate-y-1 

                            {{-- EFEK LAIN: Tetap sama --}}
                            hover:text-white 
                            hover:border-transparent 
                            hover:shadow-[0_10px_20px_-2px_rgba(59,130,246,0.25)]">
                            
                            {{-- Layer Gradient --}}
                            <div class="absolute inset-0 -z-10 bg-gradient-to-r from-[#2b6cee] to-[#5da2ff] opacity-0 group-hover:opacity-100 transition-opacity duration-500 ease-in-out"></div>
                            
                            <span class="relative z-10">
                                @if(auth()->user()->isAdmin())
                                    Administrator
                                @else
                                    Student
                                @endif
                            </span>
                        </span>

                        <span class="group relative isolate overflow-hidden px-4 py-1.5 bg-slate-900 text-white text-[9px] font-black uppercase tracking-[0.2em] rounded-xl border border-white/10 cursor-default transform-gpu
                            {{-- Shadow asli Anda tetap di sini --}}
                            shadow-lg shadow-slate-200
                            
                            {{-- Transisi dasar --}}
                            transition-all duration-500 ease-[cubic-bezier(0.4,0,0.2,1)] 

                            {{-- EFEK BARU: Zoom tahap 1 (Card) --}}
                            group-hover/card:scale-[1.05]

                            {{-- EFEK BARU: Zoom tahap 2 + Naik (Tepat di Badge) --}}
                            group-hover/card:hover:-translate-y-1 

                            {{-- EFEK HOVER ASLI ANDA (Shadow biru muncul di sini) --}}
                            hover:border-blue-500/50 
                            hover:bg-[#2b6cee] 
                            hover:shadow-[0_10px_20px_-2px_rgba(59,130,246,0.25)]" 
                            style="backface-visibility: hidden;">
                            
                            {{-- Layer Gradient --}}
                            <div class="absolute inset-0 -z-10 bg-gradient-to-r from-[#2b6cee] to-[#5da2ff] opacity-0 group-hover:opacity-100 transition-opacity duration-500 ease-in-out"></div>
                            
                            <span class="relative z-10">
                                @if(auth()->user()->isAdmin())
                                    STAFF OFFICER
                                @else
                                    ACTIVE MEMBER
                                @endif
                            </span>
                        </span>
                    </div>
                </div>
            </div>

            <div class="flex-shrink-0">
                <button type="button" 
                    onclick="document.getElementById('photoInputMain').click()" 
                    class="group relative isolate overflow-hidden bg-white border border-blue-200 px-8 py-4 rounded-2xl text-[#2b6cee] font-bold text-[10px] 
                    hover:text-white hover:-translate-y-1.5 hover:shadow-xl hover:shadow-blue-500/30 
                    hover:border-transparent transition-all duration-500 ease-[cubic-bezier(0.4,0,0.2,1)] 
                    flex items-center gap-3 uppercase tracking-widest font-accent shadow-sm shadow-blue-100/50">
                    
                    {{-- Layer Gradient --}}
                    <div class="absolute inset-0 -z-10 bg-gradient-to-r from-[#2b6cee] to-[#5da2ff] opacity-0 group-hover:opacity-100 transition-opacity duration-500 ease-in-out"></div>

                    <span class="material-symbols-outlined text-xl group-hover:rotate-[20deg] group-hover:translate-x-1 transition-transform duration-500 relative z-10">
                        add_a_photo
                    </span>
                    
                    <span class="relative z-10">Update Photo</span>
                </button>
            </div>
        </div>

        <form action="{{ route('siswa.profile.update') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 gap-8">
            @csrf
            @method('PUT')
            <input type="file" id="photoInputMain" name="foto_profile" class="hidden" accept="image/*" onchange="previewImage(this)">

            
            
            {{-- ACCOUNT INFO CARD --}}
            <section class="settings-card hover-emerald group/section relative overflow-hidden transform-gpu ">
                    <div class="absolute inset-x-0 top-0 h-px bg-gradient-to-r from-transparent via-emerald-400/30 to-transparent opacity-0 group-hover/section:opacity-100 transition-opacity duration-700 z-20"></div>
                    <div class="absolute inset-0 bg-white/5 transition-colors duration-700 ease-in-out group-hover/section:bg-emerald-50/10 -z-10"></div>
                    <div class="relative z-10">
                    <div class="absolute inset-0 -z-10 opacity-0 group-hover/section:opacity-100 transition-opacity duration-500 bg-[linear-gradient(to_right,transparent_0%,rgba(16,185,129,0.05)_30%,rgba(16,185,129,0.05)_70%,transparent_100%)]"></div>


                    <div class="px-10 py-6 flex justify-between items-center">
                        <h2 class="flex items-center gap-3 text-lg font-heading group-hover/section:text-emerald-700 transition-all duration-500">
                            <span class="flex-shrink-0 material-symbols-outlined text-2xl font-bold bg-emerald-50 text-emerald-600 p-2 rounded-xl border border-emerald-100 transition-all duration-500 group-hover/section:bg-emerald-600 group-hover/section:text-white group-hover/section:rotate-[20deg] group-hover/section:translate-x-1.5 shadow-sm shadow-emerald-100">
                                assignment_ind
                            </span>
                            <span class="block transition-transform duration-500 group-hover/section:translate-x-2 font-black uppercase tracking-wide">
                                User Access Credentials
                            </span>
                        </h2>
                        <span class="inline-block text-[9px] font-black text-slate-300 uppercase tracking-widest font-accent transition-all duration-500 group-hover/section:text-emerald-500/60 group-hover/section:scale-110 origin-right">
                            Authentication Details
                        </span>
                    </div>
                    <div class="px-10">
                        <div class="h-px bg-slate-300 w-full"></div>
                    </div>
                </div>


                <div class="p-10 bg-white/20 relative z-10">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="md:col-span-2 group focus-within:scale-[1.01] transition-all duration-500 cubic-bezier[0.4,0,0.2,1]"> 
                            {{-- Label: Zoom tetap 1.05, transisi diperhalus --}}
                            <label class="block text-[11px] font-black text-emerald-600/60 mb-1.5 ml-1 uppercase tracking-widest font-accent italic transition-all duration-500 ease-in-out group-hover:scale-[1.05] group-focus-within:scale-[1.05] origin-center w-fit will-change-transform">
                                Your Identity Tag
                            </label>

                            <div class="relative transition-all duration-500 ease-in-out group-hover:scale-[1.02] group-focus-within:scale-[1.02] will-change-transform">
                                {{-- Input: Shadow tetap 0.12, Glow tetap ring-4, animasi diperhalus --}}
                                <input class="peer w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 pr-10 text-sm focus:ring-4 focus:ring-emerald-600/10 focus:border-emerald-600 focus:bg-white transition-all duration-500 ease-in-out outline-none text-slate-700 font-medium group-hover:shadow-[0_2px_8px_-2px_rgba(0,0,0,0.12)] group-focus-within:shadow-[0_2px_8px_-2px_rgba(0,0,0,0.12)]" 
                                    name="username" 
                                    placeholder="Enter username" 
                                    type="text" 
                                    maxlength="50" 
                                    value="{{ auth()->user()->username }}"/>
                                    
                                {{-- Ikon: Zoom tetap 1.10, warna Emerald memudar masuk dengan halus --}}
                                <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-slate-300 text-sm transition-all duration-500 ease-in-out group-hover:scale-110 group-focus-within:scale-110 group-focus-within:text-emerald-500 will-change-transform">
                                    person_pin
                                </span>
                            </div>
                        </div>


                        {{-- Container Utama: Tetap menggunakan cubic-bezier referensi Anda --}}
                        <div class="group transition-all duration-500 cubic-bezier[0.4,0,0.2,1]"> 
                            
                            {{-- Label: Tetap sesuai ukuran asli [11px] dengan animasi smooth --}}
                            <label class="block text-[11px] font-black text-emerald-600/60 mb-1.5 ml-1 uppercase tracking-widest font-accent italic transition-all duration-500 ease-in-out group-hover:scale-[1.05] origin-center w-fit will-change-transform">
                                Registered Email
                            </label>

                            <div class="relative transition-all duration-500 ease-in-out group-hover:scale-[1.02] will-change-transform">
                                
                                {{-- INPUT: Hanya menggunakan duration-500 untuk shadow (Tanpa cubic-bezier/ease) --}}
                                <input class="input-field w-full shadow-transparent transition-shadow duration-500 group-hover:shadow-[0_2px_8px_-2px_rgba(0,0,0,0.12)] cursor-not-allowed" 
                                    disabled="" 
                                    type="email" 
                                    value="{{ auth()->user()->email }}"/>
                                    
                                {{-- Ikon: Zoom 1.10 saat hover, tetap text-slate-300 sesuai referensi --}}
                                <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-slate-300 text-sm transition-all duration-500 ease-in-out group-hover:scale-110 will-change-transform">
                                    mail
                                </span>
                            </div>
                        </div>


                        {{-- Container Utama: Menggunakan cubic-bezier referensi Anda --}}
                        <div class="group transition-all duration-500 cubic-bezier[0.4,0,0.2,1]"> 
                            
                            {{-- Label: Zoom 1.05, ukuran 11px, font-black Emerald --}}
                            <label class="block text-[11px] font-black text-emerald-600/60 mb-1.5 ml-1 uppercase tracking-widest font-accent italic transition-all duration-500 ease-in-out group-hover:scale-[1.05] origin-center w-fit will-change-transform">
                                Security Key
                            </label>

                            <div class="relative transition-all duration-500 ease-in-out group-hover:scale-[1.02] will-change-transform">
                                @php
                                    // Logika PHP tetap dipertahankan sesuai permintaan Anda
                                    $passwordLength = strlen(auth()->user()->password);
                                @endphp
                                
                                {{-- INPUT: Shadow [0_2px_8px_-2px_rgba(0,0,0,0.12)] & duration-500 murni untuk shadow --}}
                                <input class="input-field w-full shadow-transparent transition-shadow duration-500 group-hover:shadow-[0_2px_8px_-2px_rgba(0,0,0,0.12)] cursor-not-allowed pr-10" 
                                    disabled="" 
                                    type="password" 
                                    value="{{ str_repeat('•', $passwordLength) }}"/>
                                    
                                {{-- Ikon: Zoom 1.10 saat hover, warna text-slate-300 --}}
                                <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-slate-300 text-sm transition-all duration-500 ease-in-out group-hover:scale-110 will-change-transform">
                                    shield_person
                                </span>
                            </div>
                        </div>
                    </div>
                </div>


            </section>
            {{-- PASSWORD CARD --}}
            <section class="settings-card hover-purple group/section relative overflow-hidden">
                <div class="absolute inset-x-0 top-0 h-px bg-gradient-to-r from-transparent via-indigo-400/30 to-transparent opacity-0 group-hover/section:opacity-100 transition-opacity duration-700 z-20"></div>
                <div class="absolute inset-0 bg-white/5 transition-colors duration-700 ease-in-out group-hover/section:bg-indigo-50/10 -z-10"></div>
                <div class="relative z-10">
                    <div class="absolute inset-0 -z-10 opacity-0 group-hover/section:opacity-100 transition-opacity duration-500 bg-[linear-gradient(to_right,transparent_0%,rgba(79,70,229,0.06)_30%,rgba(79,70,229,0.06)_70%,transparent_100%)]"></div>

                
                    <div class="px-10 py-6 flex justify-between items-center">
                        <h2 class="flex items-center gap-3 text-lg font-heading group-hover/section:text-indigo-700 transition-all duration-500">
                            {{-- Ikon: Rotasi 20deg, translate-x-1.5, border, dan shadow --}}
                            <span class="flex-shrink-0 material-symbols-outlined text-2xl font-bold bg-indigo-50 text-indigo-600 p-2 rounded-xl border border-indigo-100 transition-all duration-500 group-hover/section:bg-indigo-600 group-hover/section:text-white group-hover/section:rotate-[20deg] group-hover/section:translate-x-1.5 shadow-sm shadow-indigo-100">
                                lock_reset
                            </span>
                            {{-- Teks Judul: font-black, uppercase, translate-x-2 --}}
                            <span class="block transition-transform duration-500 group-hover/section:translate-x-2 font-black uppercase tracking-wide">
                                Refresh Access Passkey
                            </span>
                        </h2>
                        {{-- Label Kanan: text-[9px], scale-110, origin-right --}}
                        <span class="inline-block text-[9px] font-black text-slate-300 uppercase tracking-widest font-accent transition-all duration-500 group-hover/section:text-indigo-500/60 group-hover/section:scale-110 origin-right">
                            Cipher Key Management
                        </span>
                    </div>
                    <div class="px-10">
                        <div class="h-px bg-slate-300 w-full"></div>
                    </div>


                    
                </div>
               <div class="p-10 bg-white/20 relative z-10">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        {{-- Input: New Password --}}
                        <div class="group focus-within:scale-[1.02] transition-all duration-500 cubic-bezier[0.4,0,0.2,1]">
                            {{-- Label: Zoom 1.05, Indigo-600/60, text-[11px], font-black --}}
                            <label class="block text-[11px] font-black text-indigo-600/60 mb-1.5 ml-1 uppercase tracking-widest font-accent italic transition-all duration-500 ease-in-out group-hover:scale-[1.05] group-focus-within:scale-[1.05] origin-center w-fit will-change-transform">
                                Updated Passcode
                            </label>

                            <div class="relative transition-all duration-500 ease-in-out group-hover:scale-[1.02] group-focus-within:scale-[1.02] will-change-transform">
                                {{-- Input: Shadow 0.12, Glow ring-4, focus:border-indigo-600 --}}
                                <input class="peer w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 pr-10 text-sm focus:ring-4 focus:ring-indigo-600/10 focus:border-indigo-600 focus:bg-white transition-all duration-500 ease-in-out outline-none text-slate-700 font-medium group-hover:shadow-[0_2px_8px_-2px_rgba(0,0,0,0.12)] group-focus-within:shadow-[0_2px_8px_-2px_rgba(0,0,0,0.12)]" 
                                    name="password" 
                                    placeholder="Min. 6 Characters" 
                                    type="password"/>
                                    
                                
                                {{-- Ikon: Zoom 1.10, Menyala Indigo-500 saat klik/focus --}}
                                <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-slate-300 text-sm transition-all duration-500 ease-in-out group-hover:scale-110 group-focus-within:scale-110 group-focus-within:text-indigo-500 will-change-transform">
                                    lock_person
                                </span>
                            </div>
                        </div>

                        {{-- Input: Confirm Password --}}
                        <div class="group focus-within:scale-[1.02] transition-all duration-500 cubic-bezier[0.4,0,0.2,1]">
                            {{-- Label: Zoom 1.05, Indigo-600/60, text-[11px], font-black --}}
                            <label class="block text-[11px] font-black text-indigo-600/60 mb-1.5 ml-1 uppercase tracking-widest font-accent italic transition-all duration-500 ease-in-out group-hover:scale-[1.05] group-focus-within:scale-[1.05] origin-center w-fit will-change-transform">
                                Validate Shield
                            </label>

                            <div class="relative transition-all duration-500 ease-in-out group-hover:scale-[1.02] group-focus-within:scale-[1.02] will-change-transform">
                                {{-- Input: Shadow 0.12, Glow ring-4, focus:border-indigo-600 --}}
                                <input class="peer w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 pr-10 text-sm focus:ring-4 focus:ring-indigo-600/10 focus:border-indigo-600 focus:bg-white transition-all duration-500 ease-in-out outline-none text-slate-700 font-medium group-hover:shadow-[0_2px_8px_-2px_rgba(0,0,0,0.12)] group-focus-within:shadow-[0_2px_8px_-2px_rgba(0,0,0,0.12)]" 
                                    name="password_confirmation" 
                                    placeholder="Repeat Password" 
                                    type="password"/>
                                    
                                
                                {{-- Ikon: Zoom 1.10, Menyala Indigo-500 saat klik/focus --}}
                                <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-slate-300 text-sm transition-all duration-500 ease-in-out group-hover:scale-110 group-focus-within:scale-110 group-focus-within:text-indigo-500 will-change-transform">
                                    shield_lock
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="mt-10 flex flex-col md:flex-row justify-between items-center gap-4">

                        <p class="text-[10.5px] font-medium text-slate-500 max-w-[400px] leading-relaxed italic mt-2">
                            <span class="font-black text-slate-900/80 not-italic">Note :</span> 
                            Clicking <span class="font-bold text-indigo-600/80">"Save Changes"</span> will synchronize all updates across your profile, including your 
                            <span class="font-bold text-indigo-600/80">avatar</span>, 
                            <span class="font-bold text-indigo-600/80">username</span>, and 
                            <span class="font-bold text-indigo-600/80">security credentials</span>.
                        </p>
                        <button type="submit" id="submitBtn" disabled
                            class="group relative overflow-hidden px-10 py-4 rounded-2xl font-black uppercase tracking-widest transition-all duration-700 font-accent
                            /* Kondisi Aktif (Default diatur oleh JS nanti, di sini kita set state awal disabled) */
                            disabled:bg-slate-200 disabled:text-slate-500 disabled:border-slate-300 disabled:shadow-inner disabled:cursor-not-allowed disabled:transform-none disabled:hover:none
                            /* Kondisi Normal/Aktif */
                            bg-slate-900 text-white text-[11px] shadow-2xl border border-white/10
                            [transition-timing-function:cubic-bezier(0.34,1.56,0.64,1)]
                            enabled:hover:shadow-[0_20px_40px_rgba(79,70,229,0.3)] enabled:hover:-translate-y-2 enabled:hover:scale-[1.02]"
                            style="transition-duration: 1000ms; transition-property: background-color, color, border-color, shadow, transform;">
                            
                            {{-- Layer Gradient Indigo (Hanya muncul saat enabled:group-hover) --}}
                            <span class="absolute inset-0 bg-gradient-to-r from-indigo-600 to-indigo-400 opacity-0 transition-opacity duration-500 group-enabled:group-hover:opacity-100"></span>
                            
                            {{-- Konten: Teks tetap, ditambah icon di sebelah kanan --}}
                            <span class="relative z-30 flex items-center justify-center gap-3">
                                <span class="inline-block">
                                    Save Changes
                                </span>
                                {{-- Icon sesuai permintaan dengan efek hover yang Anda minta --}}
                                <span class="material-symbols-outlined text-sm group-hover:rotate-[-20deg] group-hover:-translate-x-1 transition-transform duration-500 relative z-10">
                                    published_with_changes
                                </span>
                            </span>
                        </button>
                    </div>
                </div>
            </section>
        </form>

        {{-- LOGOUT CARD --}}
                <section class="settings-card hover-red mt-8 group/danger relative overflow-hidden">
                    <div class="absolute inset-x-0 top-0 h-px bg-gradient-to-r from-transparent via-rose-400/30 to-transparent opacity-0 group-hover/danger:opacity-100 transition-opacity duration-700 z-20"></div>
                    <div class="absolute inset-0 bg-white/5 transition-colors duration-700 ease-in-out group-hover/danger:bg-rose-50/10 -z-10"></div>
                    <div class="relative z-10">
                        <div class="absolute inset-0 -z-10 opacity-0 group-hover/danger:opacity-100 transition-opacity duration-500 bg-[linear-gradient(to_right,transparent_0%,rgba(225,29,72,0.05)_30%,rgba(225,29,72,0.05)_70%,transparent_100%)]"></div>

            
               <div class="px-10 py-6 flex justify-between items-center">
                    <h2 class="flex items-center gap-3 text-lg font-heading group-hover/danger:text-rose-700 transition-all duration-500">
                        <span class="flex-shrink-0 material-symbols-outlined text-2xl font-bold bg-rose-50 text-rose-600 p-2 rounded-xl border border-rose-100 transition-all duration-500 group-hover/danger:bg-rose-600 group-hover/danger:text-white group-hover/danger:rotate-[20deg] group-hover/danger:translate-x-1.5 shadow-sm shadow-rose-100">
                            move_item
                        </span>
                        <span class="block transition-transform duration-500 group-hover/danger:translate-x-2 font-black uppercase tracking-wide">
                            Secure Session Exit
                        </span>
                    </h2>
                    <span class="inline-block text-[9px] font-black text-slate-300 uppercase tracking-widest font-accent transition-all duration-500 group-hover/danger:text-rose-500/60 group-hover/danger:scale-110 origin-right">
                        Sign Out Safely
                    </span>
                </div>
                <div class="px-10">
                    <div class="h-px bg-slate-300 w-full"></div>
                </div>

            </div>
            <div class="p-10 bg-white/20 flex flex-col md:flex-row items-center justify-between gap-6 relative z-10">
                <div class="text-center md:text-left">
                    {{-- Judul --}}
                    <p class="text-md font-black font-heading uppercase tracking-tight bg-gradient-to-r from-red-700 via-red-500 to-red-300 bg-clip-text text-transparent">
                        End Secure Identity Session
                    </p>
                    
                    {{-- Sub-judul dengan batasan lebar (max-w) agar tidak menabrak --}}
                    <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest font-accent italic mt-1 leading-relaxed max-w-xs md:max-w-[450px]">
                            Please ensure all <span class="font-black text-slate-600 not-italic">pending data synchronizations</span> are <span class="font-black text-slate-600 not-italic">finalized</span> to prevent any loss of <span class="font-black text-red-500/70 not-italic">active credentials</span>.
                        </p>
                </div> 
                
                <form action="{{ route('siswa.logout') }}" method="POST" class="w-full md:w-auto">
                @csrf
                <button type="submit" 
                    class="group relative overflow-hidden w-full px-10 py-3.5 border-2 border-red-200 text-red-600 rounded-2xl text-[10px] font-black transition-all duration-700 font-accent uppercase tracking-[0.25em] bg-white/50 backdrop-blur-sm 
                    /* Shadow normal tetap sesuai permintaan */
                    shadow-sm shadow-rose-100/50 
                    /* Efek Hover: Border dibuat benar-benar transparan agar gradient terlihat penuh */
                    [transition-timing-function:cubic-bezier(0.34,1.56,0.64,1)]
                    hover:text-white hover:border-transparent hover:-translate-y-2 hover:scale-[1.02] 
                    hover:shadow-[0_20px_40px_rgba(244,63,94,0.3)]"
                    style="transition-duration: 1000ms; transition-property: all;">
                    
                    {{-- Layer Gradient Rose --}}
                    <span class="absolute inset-0 bg-gradient-to-r from-rose-600 to-rose-400 opacity-0 transition-opacity duration-500 group-hover:opacity-100"></span>
                    
                    <span class="relative z-30 flex items-center justify-center gap-3">
                        <span class="inline-block">
                            Logout Now
                        </span>
                        <span class="material-symbols-outlined text-sm group-hover:rotate-[20deg] group-hover:translate-x-1 transition-transform duration-500 relative z-10">
                            move_item
                        </span>
                    </span>
                </button>
            </form>
            </div>
        </section>
    </main>

    <footer class="bg-slate-950 text-white pt-16 pb-12 rounded-t-[5rem] relative overflow-hidden shadow-[0_-20px_50px_rgba(0,0,0,0.1)] mt-3">
        <div class="absolute top-0 right-0 w-[400px] h-[400px] bg-blue-600/10 rounded-full blur-[100px] translate-x-1/2 -translate-y-1/2"></div>
        
        <div class="max-w-7xl mx-auto px-6 lg:px-12 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-16 mb-12 text-center md:text-left">
                <div class="lg:col-span-2">
                    <div class="flex items-center gap-4 mb-8 justify-center md:justify-start">
                        <div class="w-14 h-14 bg-white/5 rounded-2xl flex items-center justify-center border border-white/10">
                            <span class="material-symbols-outlined text-[#2b6cee] text-4xl" 
                            style="font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;">
                            auto_stories
                        </span>
                        </div><span class="text-4xl font-black tracking-tighter font-heading uppercase">My<span class="text-[#2b6cee] italic">LibAry.</span></span>
                        
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
    (function() {
        const profileForm = document.querySelector('form');
        const usernameInput = document.querySelector('input[name="username"]');
        const passwordInput = document.querySelector('input[name="password"]');
        const confirmInput = document.querySelector('input[name="password_confirmation"]');
        const photoInput = document.getElementById('photoInputMain');
        const submitBtn = document.getElementById('submitBtn');

        const initialValues = {
            username: usernameInput.value.trim(),
        };

        function previewImage(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const profileDisplay = document.getElementById('profileDisplay');
                    if (profileDisplay) {
                        if (profileDisplay.tagName === 'IMG') {
                            profileDisplay.src = e.target.result;
                        } else {
                            const parent = profileDisplay.parentElement;
                            parent.innerHTML = `<img id="profileDisplay" alt="Profile" class="w-full h-full object-cover" src="${e.target.result}"/>`;
                        }
                    }
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        function checkChanges() {
            usernameInput.setCustomValidity('');
            passwordInput.setCustomValidity('');
            confirmInput.setCustomValidity('');

            const currentUsername = usernameInput.value.trim();
            const currentPass = passwordInput.value;
            const currentConfirm = confirmInput.value;

            const isUsernameChanged = currentUsername !== initialValues.username && currentUsername !== "";
            const isPasswordFilled = currentPass.length > 0;
            const isPhotoSelected = photoInput.files.length > 0;

            if (isPasswordFilled && currentPass !== currentConfirm && currentConfirm.length > 0) {
                confirmInput.setCustomValidity('Password confirmation does not match!');
            }

            submitBtn.disabled = !(isUsernameChanged || isPasswordFilled || isPhotoSelected);
        }

        [usernameInput, passwordInput, confirmInput].forEach(input => {
            input.addEventListener('input', checkChanges);
        });

        photoInput.addEventListener('change', function() {
            previewImage(this); 
            checkChanges();     
        });

        profileForm.addEventListener('submit', function(e) {
            let isValid = true;
            const hasSpace = /\s/;

            if (hasSpace.test(usernameInput.value)) {
                usernameInput.setCustomValidity('Username cannot contain spaces!');
                isValid = false;
            } else if (usernameInput.value.length < 4 || usernameInput.value.length > 14) {
                usernameInput.setCustomValidity('Username must be between 4 and 14 characters!');
                isValid = false;
            }

            if (passwordInput.value.length > 0) {
                if (hasSpace.test(passwordInput.value)) {
                    passwordInput.setCustomValidity('Password cannot contain spaces!');
                    isValid = false;
                } else if (passwordInput.value.length < 6 || passwordInput.value.length > 14) {
                    passwordInput.setCustomValidity('Password must be between 6 and 14 characters!');
                    isValid = false;
                }
                
                if (passwordInput.value !== confirmInput.value) {
                    confirmInput.setCustomValidity('Password confirmation does not match!');
                    isValid = false;
                }
            }

            if (!isValid) {
                e.preventDefault();
                this.reportValidity();
                
                setTimeout(() => {
                    usernameInput.setCustomValidity('');
                    passwordInput.setCustomValidity('');
                    confirmInput.setCustomValidity('');
                }, 4000);
            } else {
                submitBtn.innerHTML = '<span class="animate-pulse">Saving Changes...</span>';
                submitBtn.classList.add('opacity-50', 'cursor-not-allowed');
                submitBtn.style.pointerEvents = 'none';
            }
        });
    })();
</script>
</body>
</html>