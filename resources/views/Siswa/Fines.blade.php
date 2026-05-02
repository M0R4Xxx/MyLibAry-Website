<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Overdue & Fines | MyLibAry.</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Plus+Jakarta+Sans:wght@700;800&family=Montserrat:wght@500;700;900&family=Space+Grotesk:wght@300;500;700&family=Manrope:wght@400;600;700;800&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />

    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "primary-blue": "#2b6cee",
                        "on-tertiary-fixed": "#2a1700",
                        "surface-container-high": "#e6e8ea",
                        "outline": "#737686",
                        "tertiary-container": "#996100",
                        "on-surface": "#191c1e",
                        "on-secondary": "#ffffff",
                        "primary-fixed": "#dbe1ff",
                        "on-tertiary-fixed-variant": "#653e00",
                        "inverse-on-surface": "#eff1f3",
                        "secondary-fixed-dim": "#4edea3",
                        "surface-container-lowest": "#ffffff",
                        "on-tertiary-container": "#ffeedd",
                        "primary": "#004ac6",
                        "on-error-container": "#93000a",
                        "on-primary-fixed-variant": "#003ea8",
                        "on-primary-container": "#eeefff",
                        "tertiary-fixed-dim": "#ffb95f",
                        "surface-container": "#eceef0",
                        "primary-container": "#2563eb",
                        "on-background": "#191c1e",
                        "tertiary-fixed": "#ffddb8",
                        "inverse-surface": "#2d3133",
                        "on-tertiary": "#ffffff",
                        "secondary-container": "#6cf8bb",
                        "error-container": "#ffdad6",
                        "on-secondary-container": "#00714d",
                        "surface-tint": "#0053db",
                        "outline-variant": "#c3c6d7",
                        "error": "#ba1a1a",
                        "secondary-fixed": "#6ffbbe",
                        "on-secondary-fixed": "#002113",
                        "surface-dim": "#d8dadc",
                        "secondary": "#006c49",
                        "inverse-primary": "#b4c5ff",
                        "surface": "#f7f9fb",
                        "on-secondary-fixed-variant": "#005236",
                        "on-surface-variant": "#434655",
                        "background": "#f7f9fb",
                        "surface-variant": "#e0e3e5",
                        "surface-container-low": "#f2f4f6",
                        "on-error": "#ffffff",
                        "primary-fixed-dim": "#b4c5ff",
                        "on-primary-fixed": "#00174b",
                        "tertiary": "#784b00",
                        "surface-bright": "#f7f9fb",
                        "on-primary": "#ffffff",
                        "surface-container-highest": "#e0e3e5"
                    },
                    "borderRadius": {
                        "DEFAULT": "1rem",
                        "lg": "2rem",
                        "xl": "3rem",
                        "full": "9999px"
                    },
                    "fontFamily": {
                        "headline": ["Manrope"],
                        "body": ["Inter"],
                        "label": ["Inter"],
                        "heading": ["Plus Jakarta Sans"],
                        "accent": ["Montserrat"],
                        "modern": ["Space Grotesk"]
                    }
                },
            },
        }
    </script>

    <style type="text/tailwindcss">
        body { 
            font-family: 'Inter', sans-serif; 
            background-color: #F8F9FC; 
            background-image: 
                radial-gradient(at 0% 0%, rgba(43, 108, 238, 0.05) 0px, transparent 50%),
                radial-gradient(at 100% 0%, rgba(43, 108, 238, 0.03) 0px, transparent 50%);
        }
        h1, h2, h3, .font-headline { font-family: 'Manrope', sans-serif; }
        
        .glass-nav {
            backdrop-filter: blur(16px);
            background-color: rgba(255, 255, 255, 0.85);
        }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .font-heading { font-family: 'Plus Jakarta Sans', sans-serif; }
        .font-accent { font-family: 'Montserrat', sans-serif; }
        
        .nav-link-hover {
            @apply transition-all duration-300 hover:-translate-y-1 hover:text-blue-600;
        }

        .font-modern {
            font-family: 'Space Grotesk', sans-serif;
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
            border-color: #fbbf24; 
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.1), 0 0 25px rgba(251, 191, 36, 0.2);
            background: linear-gradient(145deg, #ffffff, #f1f5f9);
        }
    </style>

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

</head>

<body class="text-on-surface min-h-screen flex flex-col relative overflow-x-hidden">
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
                    <a class="font-bold text-slate-500 hover:text-blue-600 transition-all hover:-translate-y-1" href="{{ route('siswa.history') }}">History</a>
                    <a class="font-bold text-slate-500 hover:text-blue-600 transition-all hover:-translate-y-1" href="{{ route('siswa.wishlist') }}">Wishlist</a>
                    <a class="font-bold text-slate-500 hover:text-blue-600 transition-all hover:-translate-y-1" href="{{ route('siswa.borrowed') }}">Your Books</a>
                    <a class="font-black text-blue-600 border-b-2 border-blue-600 py-2 transition-all" href="{{ route('siswa.fines') }}">Arrears</a>
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
                            class="ml-2 h-9 w-9 flex items-center justify-center rounded-md border border-slate-200 bg-white shadow-sm cursor-pointer transition-all duration-300 
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

    <main class="flex-grow max-w-7xl mx-auto px-6 lg:px-12 py-12">
        <header class="mb-12 relative flex flex-col md:flex-row justify-between items-start gap-8">
          <div class="relative">
              <div class="absolute -left-6 top-0 w-1 h-20 bg-gradient-to-b from-blue-600 to-indigo-400 rounded-full shadow-[0_0_15px_rgba(37,99,235,0.4)]"></div>
              
              <h1 class="text-6xl font-extrabold tracking-tighter text-slate-900 mb-3 font-heading leading-none">
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-slate-900 via-blue-600 to-indigo-500">
                    Personal <span class="italic">Fine Summaries.</span>
                </span>
            </h1>
              <p class="text-slate-500 font-medium text-lg leading-relaxed max-w-xl font-modern border-l-0">
                  Manage your outstanding library obligations, track overdue items, and settle your accounts to restore full access.
              </p>
          </div>

          <div class="group flex items-stretch gap-4 relative">
            <div class="relative isolate overflow-hidden bg-white border border-slate-200 p-5 rounded-[2rem] shadow-sm shadow-blue-100/50 
                        hover:-translate-y-2 hover:shadow-2xl hover:shadow-blue-500/15 transition-all duration-700 ease-[cubic-bezier(0.23,1,0.32,1)]
                        flex flex-col gap-3.5 min-w-[310px] z-10">
                
                

                <div class="flex items-center gap-4">
                    <div class="relative shrink-0">
                        <div class="w-12 h-12 bg-blue-600 rounded-2xl flex items-center justify-center shadow-lg shadow-blue-600/30 transition-all duration-700 ease-out group-hover:rotate-[15deg] group-hover:scale-110">
                            <span class="material-symbols-outlined text-white text-2xl transition-all duration-500 group-hover:scale-110">
                              support_agent
                          </span>
                        </div>
                        <div class="absolute -top-1 -right-1 w-3.5 h-3.5 bg-emerald-500 border-[3px] border-white rounded-full  transition-all"></div>
                    </div>

                    <div class="flex flex-col gap-1">
                        <h3 class="font-heading font-black text-xl leading-tight transition-all duration-500 text-transparent bg-clip-text bg-gradient-to-r from-blue-900 via-blue-500 to-indigo-500 ">
                            MyLibAry <span class="italic font-light">Support.</span>
                        </h3>
                        <p class="text-[10px] font-bold text-slate-500 transition-colors duration-500 font-modern uppercase tracking-wider">
                            Payment issues? We're here. 
                        </p>
                    </div>
                </div>

                <div class="flex flex-col gap-3">
                    <button onclick="window.location.href='{{ route('chat.index') }}'"
                    class="group/btn relative isolate overflow-hidden px-3 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest font-accent
               text-white transition-all duration-500 shadow-lg hover:shadow-lg hover:shadow-blue-500/40 
               group-hover:scale-[1.02] hover:!scale-[1.03] flex items-center justify-center gap-2">
    
                      <div class="absolute inset-0 -z-10 
                                  bg-gradient-to-r from-slate-900 from-0% via-blue-600 via-35% to-indigo-600 
                                  bg-[length:250%_100%] bg-left group-hover/btn:bg-right 
                                  transition-all duration-700 ease-in-out">
                      </div>
                      
                      <div class="absolute inset-0 -z-20 bg-white"></div>

                      <span class="relative z-10">Contact Our Support</span>
        
                        <span class="material-symbols-outlined text-sm relative z-10 transition-all duration-500 inline-block
                                    group-hover:scale-[1.10] group-hover/btn:!scale-[1.20] group-hover/btn:translate-x-1">     
                            send  
                        </span>
                  </button>
                </div>

                <div class="absolute -right-6 -bottom-6 w-20 h-20 bg-blue-600/5 rounded-full blur-3xl group-hover:bg-white/20 transition-all"></div>
            </div>

            <div class="w-[4px] self-stretch bg-slate-200 rounded-full overflow-hidden relative transition-all duration-700 ease-[cubic-bezier(0.23,1,0.32,1)] group-hover:-translate-y-2">
              <div class="absolute bottom-0 left-0 w-full h-0 bg-gradient-to-b from-blue-600 to-indigo-500 transition-all duration-700 ease-in-out group-hover:h-full"></div>
          </div>
        </div>
      </header>

     

    
        <section class="grid grid-cols-1 lg:grid-cols-12 gap-8 mb-16 items-stretch">
            <div class="lg:col-span-5 flex flex-col justify-between gap-3">

            @php
                $isAccountSafe = ($totalFine == 0 && $overdueCount == 0);
            @endphp

            @if(!$isAccountSafe)
                <div class="group relative overflow-hidden bg-rose-500 p-6 rounded-[2rem] shadow-sm flex justify-between items-center border border-rose-600/10
                transition-all duration-500 
                [transition-timing-function:cubic-bezier(0.34,1.56,0.64,1)] 
                hover:-translate-y-[12px] hover:scale-[1.01] 
                hover:shadow-[0_20px_40px_rgba(244,63,94,0.25)] cursor-default h-[22%]">
    
                    <div class="relative z-10">
                        <div class="flex items-baseline gap-2 mb-2">
                            <p class="text-[15px] font-bold uppercase tracking-widest text-rose-100 font-accent whitespace-nowrap">
                                Account Status :
                            </p>
                            <h3 class="text-2xl font-black text-white font-heading transition-transform duration-500 group-hover:scale-105 origin-left leading-none">
                                Fine Due
                            </h3>
                        </div>

                        <p class="text-[14px] leading-snug text-rose-100/90 font-semibold max-w-[80%] transition-colors duration-500 group-hover:text-white">
                            Settle your fines immediately to prevent account suspension and maintain library access.
                        </p>
                    </div>

                    <span class="material-symbols-outlined absolute -right-4 -bottom-5 text-[9rem] text-white/20 transition-all duration-700 group-hover:scale-110 group-hover:-rotate-12 pointer-events-none select-none antialiased will-change-transform" data-weight="fill">
                        warning
                    </span>
                </div>
            @else
                <div class="group relative overflow-hidden bg-emerald-500 p-6 rounded-[2rem] shadow-sm flex justify-between items-center border border-emerald-600/10
                transition-all duration-500 
                [transition-timing-function:cubic-bezier(0.34,1.56,0.64,1)] 
                hover:-translate-y-[12px] hover:scale-[1.01] 
                hover:shadow-[0_20px_40px_rgba(16,185,129,0.25)] cursor-default h-[22%]">
    
                    <div class="relative z-10">
                        <div class="flex items-baseline gap-2 mb-2">
                            {{-- Account Status: Sama persis tanpa ubahan sedikitpun selain warna --}}
                            <p class="text-[15px] font-bold uppercase tracking-widest text-emerald-100 font-accent whitespace-nowrap">
                                Account Status :
                            </p>
                            {{-- Status Title: All Cleared --}}
                            <h3 class="text-2xl font-black text-white font-heading transition-transform duration-500 group-hover:scale-105 origin-left leading-none">
                                All Good!
                            </h3>
                        </div>

                        {{-- Caption: Panjang karakter disesuaikan agar sama persis dengan referensi --}}
                        <p class="text-[14px] leading-snug text-emerald-100/90 font-semibold max-w-[80%] transition-colors duration-500 group-hover:text-white">
                            Your account is safe. You can now enjoy full access and borrow books without any worries.
                        </p>
                    </div>

                    {{-- Icon: Posisi, Ukuran, Opacity, dan Efek Hover sama persis plek ketiplek --}}
                    <span class="material-symbols-outlined absolute -right-4 -bottom-6 text-[9rem] text-white/20 transition-all duration-700 group-hover:scale-110 group-hover:-rotate-12 pointer-events-none select-none antialiased will-change-transform" data-weight="fill">
                        verified_user
                    </span>
                </div>
            @endif



               <div class="flex flex-col items-start justify-center min-w-[140px] w-fit group transition-all duration-500 ease-out hover:-translate-y-1 hover:translate-x-1">
                    {{-- Header Section: Icon & Label --}}
                    <div class="flex items-center justify-start gap-2 ">
                        {{-- Icon Section: Efek asli dipertahankan, hanya ditambahkan sedikit ekstra zoom pada hover --}}
                        <div class="flex items-center justify-center w-7 h-7 rounded-md bg-blue-600 text-white shadow-lg shadow-blue-500/20 shrink-0 transition-all duration-300 group-hover:rotate-12 group-hover:scale-110">
                            <span class="material-symbols-outlined text-[17px] font-bold">point_of_sale</span>
                        </div>
                        
                        {{-- Text Section: Ditambahkan translate-x-1 dan efek zoom (scale) saat hover --}}
                        <span class="font-accent text-[11px] font-black uppercase tracking-[0.3em] text-blue-600/60 leading-none transition-all duration-300 group-hover:translate-x-1 group-hover:scale-105 origin-left">
                            Total Fine Amount
                        </span>
                    </div>
                    
                    {{-- Value Section: Currency & Amount --}}
                    <div class="relative pl-4 group">
                        {{-- Kontainer Garis (Jalur Abu-abu yang terlihat duluan) --}}
                        <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1 h-14 bg-slate-200 rounded-full overflow-hidden transition-all duration-700 ease-[cubic-bezier(0.23,1,0.32,1)]">
                            
                            {{-- Elemen Pengisi (Garis Biru yang muncul dari bawah saat hover) --}}
                            <div class="absolute bottom-0 left-0 w-full h-0 bg-gradient-to-t from-cyan-400 to-blue-600 shadow-[0_0_15px_rgba(37,99,235,0.4)] transition-all duration-700 ease-in-out group-hover:h-full"></div>
                        </div>

                        <div class="group flex items-baseline gap-2 w-fit transition-transform duration-300 group-hover:scale-[1.03] origin-left">
                            {{-- Angka Nominal: Sama persis tanpa ubahan --}}
                            <span class="font-heading font-black text-6xl leading-none py-1 text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-cyan-500 drop-shadow-sm">
                                Rp. {{ number_format($totalFine, 0, ',', ',') }}
                            </span>
                            
                            {{-- Tulisan Total: Sama persis tanpa ubahan --}}
                            <span class="font-modern text-[22px] font-bold text-slate-500 leading-none whitespace-nowrap italic -ml-1">
                                Total
                            </span>
                        </div>

                        {{-- Bottom Decorative Line --}}
                        {{-- Bottom Decorative Line --}}
                        <div class="relative w-full h-1.5 mt-2 hidden md:block group">
                            {{-- Layer Dasar (Opacity 20 - Selalu Ada) --}}
                            <div class="absolute inset-0 bg-gradient-to-r from-transparent via-blue-500/20 to-transparent rounded-full"></div>
                            
                            {{-- Layer Hover (Opacity 90 - Muncul Halus saat Hover) --}}
                            <div class="absolute inset-0 bg-gradient-to-r from-transparent via-blue-500/90 to-transparent rounded-full opacity-0 transition-opacity duration-500 ease-in-out group-hover:opacity-100"></div>
                        </div>
                    </div>
                </div>


                <div class="grid grid-cols-2 gap-4 h-[22%]">
                    <div class="group relative overflow-hidden bg-amber-500 p-6 rounded-[2rem] shadow-sm flex flex-col justify-between border border-amber-600/10 transition-all duration-500 [transition-timing-function:cubic-bezier(0.34,1.56,0.64,1)] hover:-translate-y-[12px] hover:scale-[1.01] hover:shadow-[0_20px_40px_rgba(245,158,11,0.25)] cursor-default">
                        
                        <div class="relative z-10 -mt-1">
                            <p class="text-[10px] font-bold uppercase tracking-widest text-amber-100 mb-1 font-accent">
                                Total Overdue Days
                            </p>
                            <h3 class="text-[23px] ml-1 font-black text-white font-heading transition-transform duration-500 group-hover:scale-105 origin-left leading-tight">
                                {{ $days }} Days</span> <br> <span class="italic font-bold opacity-95"> {{ $hours }} Hours</span>    
                            </h3>
                        </div>

                        <span class="material-symbols-outlined absolute -right-7 -bottom-4 text-[6.8rem] text-white/20 transition-all duration-700 group-hover:scale-110 group-hover:-rotate-12 pointer-events-none select-none" data-weight="fill">
                            history
                        </span>
                    </div>

                    <div class="group relative overflow-hidden bg-indigo-600 p-6 rounded-[2rem] shadow-sm flex flex-col justify-between border border-indigo-700/10 transition-all duration-500 [transition-timing-function:cubic-bezier(0.34,1.56,0.64,1)] hover:-translate-y-[12px] hover:scale-[1.01] hover:shadow-[0_20px_40px_rgba(79,70,229,0.25)] cursor-default">
                        
                        <div class="relative z-10 -mt-1">
                            <p class="text-[10px] font-bold uppercase tracking-widest text-indigo-100 mb-1 font-accent">
                                Total Overdue Books
                            </p>
                            <h3 class="text-[23px] ml-1 font-black text-white font-heading transition-transform duration-500 group-hover:scale-105 origin-left leading-tight">
                                {{ $overdueCount }} Late <br> <span class=" italic font-bold opacity-95">Books</span>
                            </h3>
                        </div>

                        <span class="material-symbols-outlined absolute -right-5 -bottom-5 text-[6.9rem] text-white/20 transition-all duration-700 group-hover:scale-110 group-hover:-rotate-12 pointer-events-none select-none" data-weight="fill">
                            menu_book
                        </span>
                    </div>
                </div>

                    @php
                        $targetAdmin = $users->where('role', 'admin')
                                            ->where('user_id', '!=', auth()->user()->user_id)
                                            ->first();
                    @endphp

                <div class="relative w-full">
                    @if(!$targetAdmin)
                        <input type="text" id="adminCheck" required title="Maaf, tidak ada admin lain yang tersedia saat ini." class="absolute opacity-0 pointer-events-none top-1/2 left-1/2 w-1 h-1">
                    @endif    

                    <button @if($targetAdmin)
                        onclick="window.location.href='{{ route('chat.index', ['select_id' => $targetAdmin->user_id]) }}'"
                        @else
                            type="submit" onclick="document.getElementById('adminCheck').reportValidity()"
                        @endif
                        
                        class="group relative w-full overflow-hidden bg-blue-600 text-white rounded-full font-bold text-lg shadow-lg flex items-center justify-center gap-3 py-6
                            transition-all duration-500 [transition-timing-function:cubic-bezier(0.34,1.56,0.64,1)] 
                            hover:-translate-y-[12px] hover:scale-[1.01] 
                            hover:shadow-[0_20px_40px_rgba(37,99,235,0.30)]">

                    

                        {{-- Layer Gradient (Muncul Halus di Atas bg-blue-600) --}}
                        <div class="absolute inset-0 bg-gradient-to-r from-blue-700 via-blue-600 to-blue-400 opacity-0 group-hover:opacity-100 transition-opacity duration-500 ease-in-out"></div>

                        {{-- Konten Button: Di atas layer gradient menggunakan z-10 --}}
                        <span class="relative z-10 flex items-center justify-center gap-3.5">
                            <span class="material-symbols-outlined transition-transform duration-500 group-hover:rotate-[20deg] group-hover:translate-x-1 group-hover:scale-110 relative z-10">
                                payments
                            </span>
                            <span class="font-accent text-[13.5px] font-black uppercase tracking-widest leading-none">
                                Settle Your Fines with Admin
                            </span>
                        </span>
                    </button>
                </div> 
            </div>

            

            {{-- Container Utama: Identik dengan kode awal Anda --}}
            <div class="lg:col-span-7 p-10 rounded-3xl shadow-sm flex flex-col group/main relative overflow-visible
                        transition-all duration-500 [transition-timing-function:cubic-bezier(0.34,1.56,0.64,1)]
                        hover:-translate-y-[12px] hover:scale-[1.01] 
                        shadow-[0_15px_40px_-15px_rgba(0,0,0,0.12)]
                        transform-gpu will-change-transform [backface-visibility:hidden] [perspective:1000px]">
                        

                {{-- 1. GRADIENT SHADOW: Ketebalan, Warna, Blur, dan Animasi tetap 100% sama --}}
                <div class="absolute inset-0 rounded-3xl transition-all duration-500 opacity-0 group-hover/main:opacity-25 pointer-events-none"
                    style="
                        background: linear-gradient(to right, #2563eb 0%, #7c3aed 50%, #db2777 95%);
                        filter: blur(25px); 
                        transform: translateY(15px) scale(0.95);
                        z-index: -20; {{-- Dipastikan berada di paling bawah --}}
                    ">
                </div>

                {{-- 2. LANTAI PENUTUP (Overlay): Diubah menjadi bg-white solid agar tidak tembus --}}
                <div class="absolute inset-0 rounded-3xl overflow-hidden pointer-events-none -z-10"
                style="transform: translateZ(0); will-change: transform;">
                    {{-- Layer Dasar Putih Card --}}
                    <div class="absolute inset-0 bg-white"></div>

                    {{-- Shadow 4 Warna: Statis (Hapus class group-hover agar tidak berubah) --}}
                    <div class="absolute -top-16 -left-16 w-64 h-64 bg-blue-500/[0.08] rounded-full blur-[80px]"></div>
                    <div class="absolute -bottom-16 -left-16 w-64 h-64 bg-indigo-900/[0.12] rounded-full blur-[80px]"></div>
                    <div class="absolute -top-16 -right-16 w-64 h-64 bg-purple-400/[0.12] rounded-full blur-[80px]"></div>
                    <div class="absolute -bottom-16 -right-16 w-64 h-64 bg-red-500/[0.08] rounded-full blur-[80px]"></div>
                </div>
                

                {{-- 3. LAYER BORDER GRADIENT: Tetap sama persis (Kanan lebih tebal) --}}
                <div class="absolute inset-0 rounded-3xl p-0 pointer-events-none z-10"
                    style="
                        padding: 1px;
                        padding-right: 4px;
                        background: linear-gradient(to right, #2563eb 0%, #7c3aed 50%, #db2777 95%);
                        -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
                        -webkit-mask-composite: xor;
                        mask-composite: exclude;
                        /* TAMBAHKAN INI UNTUK MENGHILANGKAN PATAH */
                        transform: translateZ(0);
                        will-change: transform;
                    ">
                </div>

                {{-- 4. Glow Edge Effect: Tetap dipertahankan di lapisan atas --}}
                <div class="absolute inset-x-0 top-0 h-px bg-gradient-to-r from-transparent via-[#2563eb]/30 to-transparent opacity-0 group-hover/main:opacity-100 transition-opacity duration-700 z-20"></div>

                {{-- 5. Konten Step-Step: Menggunakan z-50 agar di atas segalanya --}}
                <div class="relative z-30">

                



            
            {{-- Heading Section: Posisi gap-3 dan mb-6 tetap dipertahankan --}}
            <h2 class="text-3xl font-black mb-3 flex items-center gap-3 group/main">
                {{-- Icon Section: TETAP SAMA --}}
                <div class="flex items-center justify-center w-9 h-9 rounded-[10px] text-white shadow-lg shadow-blue-500/20 shrink-0 transition-all duration-300 group-hover/main:rotate-12 group-hover/main:scale-110"
                    style="background: linear-gradient(135deg, #2563eb 0%, #7c3aed 45%, #db2777 100%);">
                    <span class="material-symbols-outlined text-[22px] font-bold">assignment</span>
                </div>

                {{-- Wrapper Container: Agar garis ikut melebar saat teks zoom/scale --}}
                <div class="flex flex-col transition-all duration-300 group-hover/main:translate-x-1 group-hover/main:scale-105 origin-left">
                    
                    {{-- Text Section: TETAP SAMA --}}
                        <span class="bg-clip-text text-transparent font-heading inline-block"
                            style="
                                background-image: linear-gradient(to right, #2563eb 0%, #7c3aed 50%, #db2777 95%);
                                -webkit-background-clip: text;
                                -webkit-text-fill-color: transparent;
                            ">
                            Simple Steps to Settle Your Fines
                        </span>

                    {{-- Garis Transparan: Ukuran h-1 tetap, Opacity mengisi dari KIRI ke KANAN --}}
                    <div class="relative w-full h-1 mt-2 hidden md:block overflow-hidden">
                        {{-- Layer Dasar (Selalu Ada - Opacity 20) --}}
                        <div class="absolute inset-0 rounded-full opacity-20"
                            style="background: linear-gradient(to right, transparent, #7c3aed, transparent);">
                        </div>
                        
                        {{-- Layer Hover: Mengisi/Menebal Opacity dari KIRI ke KANAN --}}
                        <div class="absolute inset-0 w-0 h-full rounded-full opacity-0 transition-all duration-700 ease-in-out group-hover/main:w-full group-hover/main:opacity-90 left-0"
                            style="background: linear-gradient(to right, transparent, #2563eb, #7c3aed, #db2777, transparent);">
                        </div>
                    </div>
                </div>
            </h2>


            <div class="relative space-y-6 flex flex-col group/main">
                <div class="absolute left-5 w-[3px] bg-slate-200 z-0" style="top: 2.5rem; height: calc(100% - 5rem);">
                    <div class="w-full h-0 transition-all duration-1000 group-hover/main:h-full opacity-50"
                        style="background: linear-gradient(to bottom, #2563eb, #7c3aed, #db2777);">
                    </div>
                </div>

            {{-- Step 1 --}}
                <div class="flex items-center gap-6 group relative z-10 transition-all duration-500">
                    {{-- Card Angka: Tetap Translate --}}
                    <div class="relative w-10 h-10 shrink-0 rounded-full flex items-center justify-center font-black text-white overflow-hidden transition-all duration-500 [transition-timing-function:cubic-bezier(0.34,1.56,0.64,1)] bg-[#2563eb] group-hover:rotate-[15deg] group-hover:scale-110 group-hover:translate-x-2 group-hover:shadow-lg group-hover:shadow-blue-500/40">
                        <span class="relative z-10">1</span>
                        <span class="absolute inset-0 bg-gradient-to-r from-blue-600 to-blue-400 opacity-0 transition-opacity duration-500 group-hover:opacity-100"></span>
                        <div class="absolute inset-0 bg-[#2563eb] opacity-100 transition-opacity duration-500 group-hover:opacity-0"></div>
                    </div>

                    <div>
                        <div class="flex items-center gap-3">
                            {{-- GARIS: Ditambahkan group-hover:pr-8 agar mendorong tulisan --}}
                            <span class="w-8 h-[3px] bg-blue-600/60 rounded-full flex-shrink-0 transition-all duration-700 [transition-timing-function:cubic-bezier(0.34,1.56,0.64,1)] 
                                group-hover:bg-blue-600 group-hover:w-16 group-hover:translate-x-2 group-hover:pr-8
                                transform-gpu will-change-[width,transform,padding] [backface-visibility:hidden] translate-z-0">
                            </span>

                            {{-- H4: Ditambahkan group-hover:translate-x-2 agar sinkron --}}
                            <h4 class="font-['Montserrat'] font-extrabold text-[15px] uppercase tracking-wide transition-all duration-700 text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-blue-400 transform-gpu group-hover:translate-x-2"
                                style="
                                    -webkit-background-clip: text; 
                                    -webkit-text-fill-color: transparent;
                                    backface-visibility: hidden;
                                ">
                                Identify Overdue Items
                            </h4>
                        </div>
                        
                        {{-- Caption: Transisi smooth dengan timing function khusus --}}
                    <p class="text-[13px] leading-relaxed font-modern text-blue-400 transform-gpu transition-all duration-500 [transition-timing-function:cubic-bezier(0.4,0,0.2,1)] group-hover:text-blue-600 group-hover:translate-x-2 will-change-transform antialiased translate-z-0">
                        Browse your current list of overdue books and verify the specific titles and their respective original return deadlines.
                    </p>
                    </div>
                </div>

            {{-- Step 2: Menggunakan struktur dan efek persis seperti referensi --}}
                <div class="flex items-center gap-6 group relative z-10 transition-all duration-500">
                    {{-- Card Angka 2: Efek Zoom, Rotate, Shadow, dan Transisi Warna Sama Persis --}}
                    <div class="relative w-10 h-10 shrink-0 rounded-full flex items-center justify-center font-black text-white overflow-hidden transition-all duration-500 [transition-timing-function:cubic-bezier(0.34,1.56,0.64,1)] bg-[#7c3aed] group-hover:rotate-[15deg] group-hover:scale-110 group-hover:translate-x-2 group-hover:shadow-lg group-hover:shadow-purple-500/40">
                        <span class="relative z-10">2</span>
                        
                        {{-- Layer Gradasi Ungu saat Hover --}}
                        <span class="absolute inset-0 bg-gradient-to-r from-purple-600 to-indigo-500 opacity-0 transition-opacity duration-500 group-hover:opacity-100"></span>
                        
                        {{-- Overlay Ungu Solid dasar --}}
                        <div class="absolute inset-0 bg-[#7c3aed] opacity-100 transition-opacity duration-500 group-hover:opacity-0"></div>
                    </div>

                    <div>
                        <div class="flex items-center gap-3">
                            {{-- GARIS: Ungu, Solid, Memanjang, mendorong tulisan (pr-8) tanpa glitch --}}
                            <span class="w-8 h-[3px] bg-[#7c3aed]/60 rounded-full flex-shrink-0 transition-all duration-700 [transition-timing-function:cubic-bezier(0.34,1.56,0.64,1)] 
                                group-hover:bg-[#7c3aed] group-hover:w-16 group-hover:translate-x-2 group-hover:pr-8
                                transform-gpu will-change-[width,transform,padding] [backface-visibility:hidden] translate-z-0">
                            </span>

                            {{-- H4: Gradient Ungu, Font Montserrat, Translate-x-2 --}}
                            <h4 class="font-['Montserrat'] font-extrabold text-[15px] uppercase tracking-wide transition-all duration-700 text-transparent bg-clip-text bg-gradient-to-r from-[#7c3aed] to-indigo-400 transform-gpu group-hover:translate-x-2"
                                style="
                                    -webkit-background-clip: text; 
                                    -webkit-text-fill-color: transparent;
                                    backface-visibility: hidden;
                                ">
                                Visit Circulation Desk
                            </h4>
                        </div>
                        
                        {{-- Caption: Font Modern, Warna Ungu Muda ke Tua, Smooth Transition, No Glitch --}}
                        <p class="text-[13px] leading-relaxed font-modern text-[#7c3aed]/60 transform-gpu transition-all duration-500 [transition-timing-function:cubic-bezier(0.4,0,0.2,1)] group-hover:text-[#7c3aed] group-hover:translate-x-2 will-change-transform antialiased translate-z-0">
                            Present the overdue materials at the main library counter during standard operating hours for physical verification.
                        </p>
                    </div>
                </div>



                    {{-- Step 3: Struktur dan efek identik dengan referensi utama --}}
                <div class="flex items-center gap-6 group relative z-10 transition-all duration-500">
                    {{-- Card Angka 3: Zoom, Rotate, Shadow, dan Transisi Warna Persis Referensi --}}
                    <div class="relative w-10 h-10 shrink-0 rounded-full flex items-center justify-center font-black text-white overflow-hidden transition-all duration-500 [transition-timing-function:cubic-bezier(0.34,1.56,0.64,1)] bg-[#ad41e4] group-hover:rotate-[15deg] group-hover:scale-110 group-hover:translate-x-2 group-hover:shadow-lg group-hover:shadow-purple-400/40">
                        <span class="relative z-10">3</span>
                        
                        {{-- Layer Gradasi saat Hover --}}
                        <span class="absolute inset-0 bg-gradient-to-r from-[#ad41e4] to-[#c084fc] opacity-0 transition-opacity duration-500 group-hover:opacity-100"></span>
                        
                        {{-- Overlay Solid Dasar --}}
                        <div class="absolute inset-0 bg-[#ad41e4] opacity-100 transition-opacity duration-500 group-hover:opacity-0"></div>
                    </div>

                    <div>
                        <div class="flex items-center gap-3">
                            {{-- GARIS: Ungu Muda, Solid, Memanjang, Mendorong tulisan (pr-8) tanpa glitch --}}
                            <span class="w-8 h-[3px] bg-[#ad41e4]/60 rounded-full flex-shrink-0 transition-all duration-700 [transition-timing-function:cubic-bezier(0.34,1.56,0.64,1)] 
                                group-hover:bg-[#ad41e4] group-hover:w-16 group-hover:translate-x-2 group-hover:pr-8
                                transform-gpu will-change-[width,transform,padding] [backface-visibility:hidden] translate-z-0">
                            </span>

                            {{-- H4: Gradient Ungu Muda, Font Montserrat, Translate-x-2 --}}
                            <h4 class="font-['Montserrat'] font-extrabold text-[15px] uppercase tracking-wide transition-all duration-700 text-transparent bg-clip-text bg-gradient-to-r from-[#ad41e4] to-[#c492fa] transform-gpu group-hover:translate-x-2"
                                style="
                                    -webkit-background-clip: text; 
                                    -webkit-text-fill-color: transparent;
                                    backface-visibility: hidden;
                                ">
                                Process Payment
                            </h4>
                        </div>
                        
                        {{-- Caption: Font Modern, Warna Ungu Muda, Smooth Transition, No Glitch --}}
                        <p class="text-[13px] leading-relaxed font-modern text-[#ad41e4]/60 transform-gpu transition-all duration-500 [transition-timing-function:cubic-bezier(0.4,0,0.2,1)] group-hover:text-[#ad41e4] group-hover:translate-x-2 group-hover:font-semibold will-change-transform antialiased translate-z-0">
                            Complete the settlement of outstanding fines via our integrated e-wallet system or direct bank transfer at the designated counter.
                        </p>
                    </div>
                </div>




                    {{-- Step 4: Struktur dan efek identik dengan referensi utama --}}
                <div class="flex items-center gap-6 group relative z-10 transition-all duration-500">
                    {{-- Card Angka 4: Zoom, Rotate, Shadow, dan Transisi Warna Persis Referensi --}}
                    <div class="relative w-10 h-10 shrink-0 rounded-full flex items-center justify-center font-black text-white overflow-hidden transition-all duration-500 [transition-timing-function:cubic-bezier(0.34,1.56,0.64,1)] bg-[#db2777] group-hover:rotate-[15deg] group-hover:scale-110 group-hover:translate-x-2 group-hover:shadow-lg group-hover:shadow-pink-500/40">
                        <span class="relative z-10">4</span>
                        
                        {{-- Layer Gradasi saat Hover --}}
                        <span class="absolute inset-0 bg-gradient-to-r from-[#db2777] to-[#f472b6] opacity-0 transition-opacity duration-500 group-hover:opacity-100"></span>
                        
                        {{-- Overlay Solid Dasar --}}
                        <div class="absolute inset-0 bg-[#db2777] opacity-100 transition-opacity duration-500 group-hover:opacity-0"></div>
                    </div>

                    <div>
                        <div class="flex items-center gap-3">
                            {{-- GARIS: Merah Muda, Solid, Memanjang, Mendorong tulisan (pr-8) tanpa glitch --}}
                            <span class="w-8 h-[3px] bg-[#db2777]/60 rounded-full flex-shrink-0 transition-all duration-700 [transition-timing-function:cubic-bezier(0.34,1.56,0.64,1)] 
                                group-hover:bg-[#db2777] group-hover:w-16 group-hover:translate-x-2 group-hover:pr-8
                                transform-gpu will-change-[width,transform,padding] [backface-visibility:hidden] translate-z-0">
                            </span>

                            {{-- H4: Gradient Merah Muda, Font Montserrat, Translate-x-2 --}}
                            <h4 class="font-['Montserrat'] font-extrabold text-[15px] uppercase tracking-wide transition-all duration-700 text-transparent bg-clip-text bg-gradient-to-r from-[#db2777] to-[#fb7185] transform-gpu group-hover:translate-x-2"
                                style="
                                    -webkit-background-clip: text; 
                                    -webkit-text-fill-color: transparent;
                                    backface-visibility: hidden;
                                ">
                                Verify Account Status
                            </h4>
                        </div>
                        
                        {{-- Caption: Font Modern, Warna Merah Muda, Smooth Transition, No Glitch --}}
                        <p class="text-[13px] leading-relaxed font-modern text-[#db2777]/60 transform-gpu transition-all duration-500 [transition-timing-function:cubic-bezier(0.4,0,0.2,1)] group-hover:text-[#db2777] group-hover:translate-x-2 group-hover:font-semibold will-change-transform antialiased translate-z-0">
                            Please allow up to 24 hours for the system to process your payment and restore your full library borrowing privileges.
                        </p>
                    </div>
                </div>
            </div> 
        </div> 
    </div>
        </section>

        <div class="w-full h-px bg-slate-300 my-12"></div>

        <section>
        {{-- Header Section: Overdue Books --}}
            <div class="flex items-center gap-5 mb-10 -mt-1">
                <div class="relative">
                    <h2 class="text-5xl font-extrabold text-slate-900 tracking-tighter font-heading leading-none">
                        Your <span class="text-transparent bg-clip-text bg-gradient-to-r from-slate-900 via-amber-600 to-orange-500 italic font-heading">Overdue Books.</span>
                    </h2>
                    
                    <div class="flex items-center gap-2 mt-3">
                        <span class="w-8 h-1 bg-amber-600 rounded-full"></span>
                        
                        <p class="text-amber-600 font-black text-[11px] uppercase tracking-[0.2em] font-accent">
                            MANAGE YOUR FINES AND RETURN DEADLINES
                        </p>
                    </div>
                </div>

                @php
                    $overdueCount = $activeLoans->filter(function($loan) {
                        return \Carbon\Carbon::parse($loan->due_date)->isPast();
                    })->count();
                @endphp

                <div class="flex flex-col items-start justify-center min-w-[140px] w-fit group">
                    {{-- Top Label Section --}}
                    <div class="flex items-center gap-2 mb-2">
                        <div class="flex items-center justify-center w-6 h-6 rounded-md bg-amber-600 text-white shadow-md shadow-amber-500/20 shrink-0 transition-all duration-500 ease-in-out group-hover:rotate-12 group-hover:scale-110">
                            <span class="material-symbols-outlined text-[13px] font-bold">timer</span>
                        </div>
                        
                        <span class="font-accent text-[9.5px] font-black uppercase tracking-[0.3em] text-amber-600/60 leading-none">
                            Total Overdue
                        </span>
                    </div>
                    
                    {{-- Main Counter Section --}}
                    <div class="flex items-center gap-2">
                        <span class="font-heading font-black text-5xl leading-none text-transparent bg-clip-text bg-gradient-to-r from-amber-600 to-orange-500 drop-shadow-sm">
                            {{ $overdueCount }}
                        </span>
                        
                        <span class="font-modern text-[21px] font-bold text-slate-500 leading-[0.9] whitespace-nowrap">
                            Book <br> Overdue
                        </span>
                    </div>

                    {{-- Bottom Decorative Line --}}
                    <div class="w-full h-1.5 bg-gradient-to-r from-transparent via-amber-500/20 to-transparent mt-2 rounded-full hidden md:block"></div>
                </div>
            </div>

            
            <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-x-6 gap-y-[38px]">
                            @php
                            // 1. Lakukan sorting SEBELUM loop dimulai
                            $sortedLoans = $activeLoans->sortByDesc('loan_date');
                        @endphp

                        @forelse($sortedLoans as $loan)
                            @php
                                $start = \Carbon\Carbon::parse($loan->loan_date);
                                $end = \Carbon\Carbon::parse($loan->due_date);
                                
                                // JIKA BELUM OVERDUE, SKIP
                                if (!$end->isPast()) {
                                    continue; 
                                }

                                // 2. DEFINE KEMBALI VARIABEL ISO (Ini yang tadi hilang)
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
                                    border-2 border-slate-100 shadow-lg 
                                    group-hover:scale-105 group-hover:-rotate-1 
                                    /* Glow Edge diubah ke Amber dengan opasitas & radius yang sama persis */
                                    group-hover:border-amber-400/80 
                                    group-hover:shadow-[0_0_25px_rgba(0,0,0,0.15),0_0_4px_rgba(251,191,36,0.8)]">
                            
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
                                    {{-- Borrowed label diubah ke Amber --}}
                                    <span class="text-[9px] font-black text-emerald-500 uppercase tracking-tighter transition-transform duration-300 transform hover:-translate-y-1 cursor-default inline-block">
                                        Borrowed
                                    </span>

                                    <span class="text-[9px] font-black text-rose-500 uppercase tracking-tight transition-transform duration-300 transform hover:-translate-y-1 cursor-default inline-block">
                                        Returned
                                    </span>
                                </div>
                                <div class="relative w-full h-3 bg-slate-100 rounded-full overflow-hidden shadow-inner p-0.5 border border-slate-200/50">
                                    {{-- Progress bar diubah ke Amber-Orange --}}
                                    <div class="js-progress-bar h-full rounded-full bg-gradient-to-r from-amber-400 to-amber-600 transition-all duration-1000" style="width: 0%"></div>
                                </div>
                            </div>

                            <button type="button" 
                                    onclick="event.stopPropagation(); window.location='{{ route('siswa.return') }}?open_modal={{ $loan->id }}'"
                                    class="transform-gpu will-change-transform [backface-visibility:hidden] antialiased group/btn font-accent w-full py-3.5 rounded-2xl text-[11px] font-black uppercase tracking-widest text-white transition-all duration-500 ease-in-out transform hover:-translate-y-1 active:scale-95 flex items-center justify-center gap-2 leading-none

                                        bg-gradient-to-r from-slate-900 from-0% via-amber-600 via-15% via-amber-500 via-45% to-orange-500 
                                        bg-[length:250%_150%] bg-left hover:bg-right 

                                        shadow-lg shadow-slate-200 hover:shadow-amber-500/30 border-t border-white/5 group">
                                    
                                    <span>SETTLE NOW</span>
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
                        NO OVERDUE BOOKS DETECTED.
                        <a href="{{ route('siswa.library') }}" 
                        class="relative inline-block text-[#2b6cee] hover:text-[#1a56cc] transition-colors duration-300 group">
                            EXPLORE NEW TITLES NOW
                            <span class="absolute left-0 bottom-[-2px] w-0 h-[2px] bg-current transition-all duration-300 group-hover:w-full"></span>
                        </a>
                    </p>
                </div>
            @endforelse
        </section>

        <div class="w-full py-16 flex items-center justify-center">
            <div class="w-full h-px bg-slate-400"></div>
        </div>


        <section class="mb-8">
                <div class="flex flex-col items-center mb-[50px] w-full"> 
                    <div class="relative text-center w-full px-4">
                        <h2 class="text-4xl md:text-6xl font-extrabold tracking-tighter font-heading mb-4 
                                text-transparent bg-clip-text 
                                bg-gradient-to-r from-slate-900 from-20% via-blue-600 via-50% to-cyan-400 pb-2 -mb-2">
                            Respect The <span class="italic">Story's Time.</span>
                        </h2>

                        <div class="flex items-center justify-center gap-4 md:gap-8 w-full">
                            <div class="flex-grow h-[6px] bg-[#2b6cee] rounded-full shadow-sm"></div>
                            
                            <div class="group relative overflow-hidden inline-block text-slate-400 font-bold text-[10px] md:text-[11px] uppercase tracking-[0.3em] whitespace-nowrap bg-white/50 px-6 py-2.5 rounded-full border border-slate-200 shadow-sm cursor-default transition-all duration-500
                                    hover:text-white hover:border-transparent"
                            style="mask-image:radial-gradient(white,black); transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);">
                            
                            <span class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-700 cubic-bezier(0.4, 0, 0.2, 1) bg-gradient-to-r from-blue-600 to-cyan-500"></span>

                            <span class="relative z-10 transition-colors duration-500 group-hover:drop-shadow-[0_0_8px_rgba(255,255,255,0.5)]">
                                BE A RESPONSIBLE READER, LET'S START AGAIN
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
                            setBadge('slate');
                            if (bar) bar.className = "js-progress-bar h-full rounded-full bg-slate-400 transition-all duration-1000";
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
                        <a class="w-11 h-11 bg-white/5 rounded-[12px] flex items-center justify-center text-slate-400 hover:text-[#2b6cee] hover:bg-white/10 hover:-translate-y-1 transition-all duration-300 border border-white/10 shadow-xl" href="#"><i class="fab fa-youtube"></i></a>
                        <a class="w-11 h-11 bg-white/5 rounded-[12px] flex items-center justify-center text-slate-400 hover:text-[#2b6cee] hover:bg-white/10 hover:-translate-y-1 transition-all duration-300 border border-white/10 shadow-xl" href="#"><i class="fab fa-instagram"></i></a>
                        <a class="w-11 h-11 bg-white/5 rounded-[12px] flex items-center justify-center text-slate-400 hover:text-[#2b6cee] hover:bg-white/10 hover:-translate-y-1 transition-all duration-300 border border-white/10 shadow-xl" href="#"><i class="fab fa-github"></i></a>
                        <a class="w-11 h-11 bg-white/5 rounded-[12px] flex items-center justify-center text-slate-400 hover:text-[#2b6cee] hover:bg-white/10 hover:-translate-y-1 transition-all duration-300 border border-white/10 shadow-xl" href="#"><i class="fab fa-facebook-f"></i></a>
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