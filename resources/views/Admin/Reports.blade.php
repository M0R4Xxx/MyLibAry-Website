<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Lending Reports - LibSys</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Plus+Jakarta+Sans:wght@700;800&family=Montserrat:wght@500;700;900&family=Space+Grotesk:wght@300;500;700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Plus+Jakarta+Sans:wght@700;800&family=Montserrat:wght@500;700;900&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Plus+Jakarta+Sans:wght@700;800&family=Montserrat:wght@500;700;900&family=Space+Grotesk:wght@300;500;700&display=swap" rel="stylesheet" />
    
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,container-queries"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        primary: "#3b82f6",
                        "background-light": "#F2F2F7",
                        "background-dark": "#0f172a",
                    },
                    fontFamily: {
                        sans: ["Inter", "sans-serif"],
                        display: ["Inter", "sans-serif"],
                    },
                },
            },
        };
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
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            @apply bg-white p-4 flex items-center gap-6 ; 
        }

        .section-container {
            @apply pt-6 pb-6 px-6 space-y-4 relative bg-white/50 backdrop-blur-xl rounded-[3rem] border border-white/40 
                overflow-hidden border-r-4 border-r-slate-200/70 
                transition-all duration-700 ease-in-out
                shadow-[0_15px_40px_-15px_rgba(0,0,0,0.12)] antialiased; 
            backface-visibility: hidden;
            transform: translateZ(0);
        }

        .hover-fuchsia:hover {
            @apply -translate-y-2 border-fuchsia-400/40 border-r-fuchsia-400/60;
            box-shadow: 0 15px 30px -12px rgba(192, 38, 211, 0.10), 0 0 15px rgba(192, 38, 211, 0.08);
        }

        .hover-rose:hover {
            @apply -translate-y-2 border-rose-400/40 border-r-rose-400/60;
            box-shadow: 0 15px 30px -12px rgba(225, 29, 72, 0.10), 0 0 15px rgba(225, 29, 72, 0.08);
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

        .font-heading {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .font-accent {
            font-family: 'Montserrat', sans-serif;
        }
        .glass-nav {
            backdrop-filter: blur(16px);
            background-color: rgba(255, 255, 255, 0.85);
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

    <script>
    let scrollTimeout;
    window.addEventListener('scroll', function() {
        clearTimeout(scrollTimeout);
        scrollTimeout = setTimeout(function() {
            sessionStorage.setItem('admin_transaction_scroll', window.scrollY);
        }, 100); 
    });

    window.addEventListener('load', function() {
        const savedScroll = sessionStorage.getItem('admin_transaction_scroll');
        
        if (savedScroll !== null) {
            
            setTimeout(function() {
                window.scrollTo({
                    top: parseInt(savedScroll),
                    behavior: 'instant' 
                });
            }, 100);
        }
    });
</script>
</head>

<body class="text-slate-900 dark:text-slate-100 transition-colors duration-200 min-h-screen flex flex-col relative overflow-x-hidden">
    
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
                        <a class="font-black text-blue-600 border-b-2 border-blue-600 py-2 transition-all flex items-center gap-1" href="{{ route('admin.dashboard') }}">
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

    <div class="flex flex-1 relative items-start w-full isolate">

       <aside class="sticky top-20 h-[calc(100vh-5rem)] w-64 flex-shrink-0 
        bg-white border-r border-slate-200 
        z-40 transform-gpu md:translate-x-0 -translate-x-full will-change-transform transition-[transform,shadow,border-color] 
        antialiased shadow-none after:content-[''] after:absolute after:top-0 after:left-0 after:w-full after:h-[150%] after:bg-inherit after:-z-10" style="backface-visibility: hidden; perspective: 1000px; transform: translateZ(0);" id="sidebar">

            <nav class="mt-8 px-4 flex flex-col space-y-4">
                
                <a class="relative overflow-hidden flex items-center justify-center gap-3 p-4 rounded-2xl border-2 border-blue-200 bg-white/50 backdrop-blur-sm text-blue-600 shadow-sm shadow-blue-100/50 transition-all duration-1000 [transition-timing-function:cubic-bezier(0.34,1.56,0.64,1)] hover:z-50 hover:text-white hover:border-transparent hover:translate-x-3 hover:-translate-y-1 
                hover:scale-x-[1.06] origin-left transform-gpu will-change-transform [backface-visibility:hidden] hover:shadow-[0_15px_30px_rgba(37,99,235,0.3)] group" href="{{ route('admin.dashboard') }}">

                    <span class="absolute inset-0 bg-gradient-to-r from-blue-600 to-blue-400 opacity-0 transition-opacity duration-500 group-hover:opacity-100"></span>
                    <span class="relative z-30 font-black font-accent will-change-transform uppercase tracking-[0.25em] text-[10px] 
                    transition-transform duration-1000 [transition-timing-function:inherit] group-hover:scale-x-[0.94] inline-block">Admin Panel</span>
                    
                    <span class="material-icons-round text-base group-hover:rotate-[20deg] group-hover:translate-x-1 transition-transform duration-500 relative z-30 
                    group-hover:scale-x-[0.94] inline-block transform-gpu antialiased">dashboard</span>
                </a>

                <a class="relative overflow-hidden flex items-center justify-center gap-3 p-4 rounded-2xl border-2 border-blue-200 bg-white/50 backdrop-blur-sm text-blue-600 shadow-sm shadow-blue-100/50 transition-all duration-1000 [transition-timing-function:cubic-bezier(0.34,1.56,0.64,1)] hover:z-50 hover:text-white hover:border-transparent hover:translate-x-3 hover:-translate-y-1 
                hover:scale-x-[1.06] origin-left transform-gpu will-change-transform [backface-visibility:hidden] hover:shadow-[0_15px_30px_rgba(37,99,235,0.3)] group" href="{{ route('admin.books') }}">

                    <span class="absolute inset-0 bg-gradient-to-r from-blue-600 to-cyan-500 opacity-0 transition-opacity duration-500 group-hover:opacity-100"></span>
                    <span class="relative z-30 font-black font-accent will-change-transform uppercase tracking-[0.25em] text-[10px] 
                    transition-transform duration-1000 [transition-timing-function:inherit] group-hover:scale-x-[0.94] inline-block">Manage Books</span>
                    
                    <span class="material-icons-round text-base group-hover:rotate-[20deg] group-hover:translate-x-1 transition-transform duration-500 relative z-30 
                    group-hover:scale-x-[0.94] inline-block transform-gpu antialiased">library_books</span>
                </a>

                <a class="relative overflow-hidden flex items-center justify-center gap-3 p-4 rounded-2xl border-2 border-indigo-200 bg-white/50 backdrop-blur-sm text-indigo-600 shadow-sm shadow-indigo-100/50 transition-all duration-1000 [transition-timing-function:cubic-bezier(0.34,1.56,0.64,1)] hover:z-50 hover:text-white hover:border-transparent hover:translate-x-3 hover:-translate-y-1 
                hover:scale-x-[1.06] origin-left transform-gpu will-change-transform [backface-visibility:hidden] hover:shadow-[0_15px_30px_rgba(79,70,229,0.3)] group" href="{{ route('admin.members') }}">

                    <span class="absolute inset-0 bg-gradient-to-r from-indigo-600 to-indigo-400 opacity-0 transition-opacity duration-500 group-hover:opacity-100"></span>
                    <span class="relative z-30 font-black font-accent will-change-transform uppercase tracking-[0.25em] text-[10px]
                    transition-transform duration-1000 [transition-timing-function:inherit] group-hover:scale-x-[0.94] inline-block">Manage Members</span>

                    <span class="material-icons-round text-base group-hover:rotate-[20deg] group-hover:translate-x-1 transition-transform duration-500 relative z-30
                    group-hover:scale-x-[0.94] inline-block transform-gpu antialiased">people</span>
                </a>

                <a class="relative overflow-hidden flex items-center justify-center gap-3 p-4 rounded-2xl border-2 border-emerald-200 bg-white/50 backdrop-blur-sm text-emerald-600 shadow-sm shadow-emerald-100/50 transition-all duration-1000 [transition-timing-function:cubic-bezier(0.34,1.56,0.64,1)] hover:z-50 hover:text-white hover:border-transparent hover:translate-x-3 hover:-translate-y-1 
                hover:scale-x-[1.06] origin-left transform-gpu will-change-transform [backface-visibility:hidden] hover:shadow-[0_15px_30px_rgba(16,185,129,0.3)] group" href="{{ route('admin.transactions') }}">

                    <span class="absolute inset-0 bg-gradient-to-r from-emerald-600 to-emerald-400 opacity-0 transition-opacity duration-500 group-hover:opacity-100"></span>
                    <span class="relative z-30 font-black font-accent will-change-transform uppercase tracking-[0.25em] text-[10px]
                    transition-transform duration-1000 [transition-timing-function:inherit] group-hover:scale-x-[0.94] inline-block">Transactions</span>

                    <span class="material-icons-round text-base group-hover:rotate-[20deg] group-hover:translate-x-1 transition-transform duration-500 relative z-30
                    group-hover:scale-x-[0.94] inline-block transform-gpu antialiased">swap_horiz</span>
                </a>

                <div class="pt-5 pb-2 text-center">
                    <p class="px-3 text-[10px] font-black text-blue-400 uppercase tracking-[0.2em] font-accent">Reporting Tools</p>
                </div>

                <a class="relative z-50 flex items-center justify-center gap-3 p-4 rounded-2xl bg-gradient-to-r border-rose-200 from-rose-600 to-rose-400 text-white shadow-[0_15px_30px_rgba(244,63,94,0.3)] transform translate-x-3 -translate-y-1 scale-x-[1.06] origin-left transition-all duration-1000 transform-gpu will-change-transform [backface-visibility:hidden] [transition-timing-function:cubic-bezier(0.34,1.56,0.64,1)] group ring-2 ring-white" href="{{ route('admin.reports') }}">
                    <span class="relative z-30 font-black font-accent will-change-transform uppercase tracking-[0.25em] text-[10px] inline-block scale-x-[0.94]">Lending Reports</span>
                    <span class="material-icons-round text-base rotate-[20deg] translate-x-1 transition-transform duration-500 relative z-30 inline-block scale-x-[0.94]">bar_chart</span>
                </a>
            </nav>
        </aside>

        <main class="flex-1 min-h-screen pt-2">
        <div class="p-8 max-w-[1600px] mx-auto space-y-10 mb-7">    
            <section class="mb-10 relative flex justify-between items-start pl-6">
                    <div class="relative">
                        <div class="absolute -left-6 top-0 w-1 h-20 bg-rose-600 rounded-full"></div>
                        
                        <h1 class="text-6xl font-extrabold tracking-tighter text-slate-900 mb-3 font-heading leading-none">
                            <span class="text-transparent bg-clip-text bg-gradient-to-r from-slate-900 via-rose-600 to-rose-400">
                                Lending & Circulation  <span class="italic">Report Analytics.</span>
                            </span>
                        </h1>
                        
                        <p class="text-slate-500 font-medium text-lg leading-relaxed max-w-6xl border-l-0 font-modern">
                            Dive deep into comprehensive data insights covering every book transaction, monitor real-time active lending trends, and evaluate member engagement through detailed analytical reporting to ensure a highly efficient and well-governed library ecosystem.
                        </p>
                    </div>
                </section>

            <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-5 mb-12 items-stretch">
                <div class="group h-[127px] flex flex-col justify-between  relative overflow-hidden bg-blue-600 p-6 rounded-[2rem] shadow-sm border border-blue-700/10 transition-all duration-500 [transition-timing-function:cubic-bezier(0.34,1.56,0.64,1)] hover:-translate-y-[12px] hover:scale-[1.01] hover:shadow-[0_20px_40px_rgba(37,99,235,0.25)] cursor-default">
                    <div class="relative z-10">
                        <p class="text-[10.5px] font-bold uppercase tracking-widest text-blue-100 mb-1 font-accent">
                            Total Books
                        </p>
                        <h3 class="text-[23px] font-black text-white font-heading transition-transform duration-500 group-hover:scale-105 origin-left leading-tight">
                            {{ \App\Models\Book::count() }} <span class="font-bold text-[19px]">Books</span> <br>
                            <span class="block pt-[5px] italic font-bold opacity-95 text-[18px]"> Collections</span>
                        </h3>
                    </div>
                    <span class="material-symbols-outlined absolute -right-3 -bottom-4 text-[6rem] text-white/20 transition-all duration-700 group-hover:scale-110 group-hover:-rotate-12 pointer-events-none select-none" data-weight="fill">
                        library_books
                    </span>
                </div>

                <div class="group relative overflow-hidden bg-indigo-600 p-6 rounded-[2rem] shadow-sm border border-indigo-700/10 transition-all duration-500 [transition-timing-function:cubic-bezier(0.34,1.56,0.64,1)] hover:-translate-y-[12px] hover:scale-[1.01] hover:shadow-[0_20px_40px_rgba(79,70,229,0.25)] cursor-default">
                    <div class="relative z-10 ">
                        <p class="text-[10.5px] font-bold uppercase tracking-widest text-indigo-100 mb-1 font-accent">
                            Total Libary Users
                        </p>
                        <h3 class="text-[23px] ml-1 font-black text-white font-heading transition-transform duration-500 group-hover:scale-105 origin-left leading-tight">
                            {{ \DB::table('all_library_users')->count() }} <span class=" font-bold text-[19px]">MyLibAry</span> <br> <span class="block pt-[5px] italic font-bold opacity-95 text-[18px] ">Users</span>
                        </h3>
                    </div>
                    <span class="material-symbols-outlined absolute -right-0 -bottom-7 text-[6.9rem] text-white/20 transition-all duration-700 group-hover:scale-110 group-hover:-rotate-12 pointer-events-none select-none" data-weight="fill">
                        groups
                    </span>
                </div>

                <div class="group relative overflow-hidden bg-emerald-600 p-6 rounded-[2rem] shadow-sm border border-emerald-700/10 transition-all duration-500 [transition-timing-function:cubic-bezier(0.34,1.56,0.64,1)] hover:-translate-y-[12px] hover:scale-[1.01] hover:shadow-[0_20px_40px_rgba(16,185,129,0.25)] cursor-default">
                    <div class="relative z-10">
                        <p class="text-[10.5px] font-bold uppercase tracking-widest text-emerald-100 mb-1 font-accent">
                            Total All Loans
                        </p>
                        <h3 class="text-[23px] font-black text-white font-heading transition-transform duration-500 group-hover:scale-105 origin-left leading-tight">
                           {{ \DB::table('loans')->count() }} <span class="font-bold text-[19px]">Recorded</span> <br> <span class="block pt-[5px] italic font-bold opacity-95 text-[18px]"> Transaction</span>
                        </h3>
                    </div>
                    <span class="material-symbols-outlined absolute -right-3 -bottom-5 text-[6rem] text-white/20 transition-all duration-700 group-hover:scale-110 group-hover:-rotate-12 pointer-events-none select-none" data-weight="fill">
                        history_edu
                    </span>
                </div>

                <div class="group relative overflow-hidden bg-rose-600 p-6 rounded-[2rem] shadow-sm border border-rose-700/10 transition-all duration-500 [transition-timing-function:cubic-bezier(0.34,1.56,0.64,1)] hover:-translate-y-[12px] hover:scale-[1.01] hover:shadow-[0_20px_40px_rgba(244,63,94,0.25)] cursor-default">
                    <div class="relative z-10">
                        <p class="text-[10.5px] font-bold uppercase tracking-widest text-rose-100 mb-1 font-accent">
                            Total Wishlist Books
                        </p>
                        <h3 class="text-[23px] font-black text-white font-heading transition-transform duration-500 group-hover:scale-105 origin-left leading-tight">
                            {{ \DB::table('wishlists')->count() }} <span class="font-bold text-[19px]">Books On</span> <br> <span class="block pt-[5px] italic font-bold opacity-95 text-[18px]">User Wishlist</span>
                        </h3>
                    </div>
                    <span class="material-symbols-outlined absolute -right-5 -bottom-3 text-[6rem] text-white/20 transition-all duration-700 group-hover:scale-110 group-hover:-rotate-12 pointer-events-none select-none" data-weight="fill">
                        bookmark_heart
                    </span>
                </div>

                <div class="group relative overflow-hidden bg-amber-500 p-6 rounded-[2rem] shadow-sm border border-amber-700/10 transition-all duration-500 [transition-timing-function:cubic-bezier(0.34,1.56,0.64,1)] hover:-translate-y-[12px] hover:scale-[1.01] hover:shadow-[0_20px_40px_rgba(245,158,11,0.25)] cursor-default">
                    <div class="relative z-10">
                        <p class="text-[10.5px] font-bold uppercase tracking-widest text-amber-100 mb-1 font-accent">
                            Total Penalty Charges
                        </p>
                        <h3 class="text-[23px] font-black text-white font-heading transition-transform duration-500 group-hover:scale-105 origin-left leading-tight whitespace-nowrap">
                            <span class="text-[15px] opacity-90">Rp</span> {{ number_format(\App\Models\UserFineBalance::getTotalGlobalFine(), 0, ',', '.') }}<br> 
                             <span class="block pt-[5px] italic font-bold opacity-95 text-[18.5px]">Unpaid Fines</span>
                        </h3>
                    </div>
                    <span class="material-symbols-outlined absolute -right-4 -bottom-2 text-[5.5rem] text-white/20 transition-all duration-700 group-hover:scale-110 group-hover:-rotate-12 pointer-events-none select-none" data-weight="fill">
                        monetization_on
                    </span>
                </div>
            </section>      

            <div class="py-1">
                <div class="w-full h-[1.5px] bg-slate-400/30 rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 gap-6">
                
                <div class="section-container hover-rose group relative isolate">
                    <div class="absolute -top-32 -left-32 -z-10 w-72 h-72 bg-rose-200/15 rounded-full blur-[90px]"></div>
                    <div class="absolute -top-32 -right-32 -z-10 w-72 h-72 bg-rose-200/15 rounded-full blur-[90px]"></div>
                    <div class="absolute -bottom-32 -left-32 -z-10 w-72 h-72 bg-rose-100/15 rounded-full blur-[90px]"></div>
                    <div class="absolute -bottom-32 -right-32 -z-10 w-80 h-80 bg-rose-200/15 rounded-full blur-[110px]"></div>

                    <div class="flex items-center justify-center gap-6 ">
                        <div class="flex-grow h-[6px] bg-gradient-to-r from-transparent via-rose-500 to-rose-600 rounded-full opacity-80"></div>
                    
                        <h4 class="text-4xl font-extrabold tracking-tighter font-heading pb-1 inline-block text-transparent bg-clip-text bg-gradient-to-r from-slate-900 via-rose-600 to-pink-500 transform-gpu whitespace-nowrap" 
                            style="
                                -webkit-background-clip: text; 
                                -webkit-text-fill-color: transparent;
                                backface-visibility: hidden;
                            ">
                           Monthly Transactions Momentum Trends Analytics
                        </h4>
                        <div class="flex-grow h-[6px] bg-gradient-to-l from-transparent via-rose-500 to-rose-600 rounded-full opacity-80"></div>
                    </div>
                    
                    <div class="h-80 w-full">
                        <canvas id="borrowingLineChart"></canvas>
                    </div>
                </div>

                <!-- Library Chart.js -->
                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

                <script>
                    const ctxLine = document.getElementById('borrowingLineChart').getContext('2d');
                    
                    const lineDataCounts = @json($counts);
                    
                    const roseGradient = ctxLine.createLinearGradient(0, 0, 0, 400);
                    roseGradient.addColorStop(0, 'rgba(225, 29, 72, 0.4)'); 
                    roseGradient.addColorStop(1, 'rgba(225, 29, 72, 0)');

                    new Chart(ctxLine, {
                        type: 'line',
                        data: {
                            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                            datasets: [{
                                label: 'Total Pinjaman',
                                data: lineDataCounts,
                                fill: true,
                                backgroundColor: roseGradient,
                                borderColor: '#e11d48', 
                                borderWidth: 4,
                                pointBackgroundColor: '#ffffff',
                                pointBorderColor: '#e11d48',
                                pointBorderWidth: 2,
                                pointRadius: 4,

                                pointHoverRadius: 7,
                                pointHoverBackgroundColor: '#fffafb', 
                                pointHoverBorderColor: '#e11d48',     
                                pointHoverBorderWidth: 3,
                                tension: 0.4,
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            interaction: {
                                intersect: false,
                                mode: 'index',
                            },
                            plugins: {
                                legend: { display: false },
                                tooltip: {
                                   
                                    backgroundColor: 'rgba(225, 29, 72, 0.95)', 
                                    titleColor: '#ffffff',
                                    bodyColor: '#ffffff',
                                    titleFont: { size: 13, weight: 'bold' },
                                    bodyFont: { size: 13 },
                                    padding: 12,
                                    cornerRadius: 10,
                                    displayColors: false,
                                    borderColor: '#be123c', 
                                    borderWidth: 1
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    max: 50,
                                    border: {
                                        display: true,
                                        color: '#e11d48', 
                                    },
                                    grid: {
                                        color: 'rgba(225, 29, 72, 0.15)', 
                                        tickColor: '#e11d48',
                                    },
                                    ticks: { 
                                        color: '#fb7185', 
                                        stepSize: 5,
                                        font: { weight: '600' }
                                    }
                                },
                                x: {
                                    border: {
                                        display: true,
                                        color: '#e11d48', 
                                    },
                                    grid: { 
                                        display: true,
                                        color: 'transparent',
                                        tickColor: '#e11d48',
                                    },
                                    ticks: { 
                                        color: '#fb7185', 
                                        font: { weight: '600' }
                                    }
                                }
                            }
                        }
                    });
                </script>

                 <div class="pt-6 ">
                    <div class="w-full h-[1.5px] bg-slate-400/30 rounded-full"></div>
                </div>
                
                <section class="space-y-4">
                    <div class="flex items-end px-2 pt-4">
                        <div class="relative">
                            {{-- H4: Model Font & Gradient Fuchsia-Pink Plek Ketiplek --}}
                            <h4 class="text-4xl font-extrabold tracking-tighter font-heading pb-1 -mb-1 pr-4 inline-block text-transparent bg-clip-text bg-gradient-to-r from-slate-900 via-fuchsia-600 to-pink-500 transform-gpu" 
                                style="
                                    -webkit-background-clip: text; 
                                    -webkit-text-fill-color: transparent;
                                    backface-visibility: hidden;
                                ">
                                Real-time Lending & Circulation
                            </h4>

                            <div class="flex items-center gap-2.5 mt-2">
                                {{-- Garis: Ukuran w-8 h-1 dengan Shadow Fuchsia --}}
                                <span class="w-8 h-1 bg-fuchsia-500 rounded-full shadow-[0_0_10px_rgba(192,38,211,0.3)]"></span>
                                
                                {{-- P: Font Black, Text 10px, Fuchsia-600 --}}
                                <p class="text-fuchsia-600 font-black text-[10px] uppercase tracking-[0.2em] font-accent leading-none">
                                    View all current borrowing statuses and previous return cycles instantly now.
                                </p>
                            </div>
                        </div>
                    </div>


                <div class="pt-4">
                    <div class="flex flex-wrap items-center justify-center gap-6 py-4">
                        {{-- 1. Search Bar - PLEK KETIPLEK 100% (Hanya Ubah Blue ke Fuchsia) --}}
                        <div class="w-full max-w-2xl relative h-[70px] flex items-center">
                                <form action="{{ route('admin.reports') }}" method="GET" class="w-full relative group flex items-center m-0">
                                    {{-- Button Search - Persis Referensi --}}
                                    <button type="submit" class="absolute left-6 top-1/2 -translate-y-[42%] outline-none z-10">
                                        <span class="material-symbols-outlined 
                                                    text-slate-400 text-2xl 
                                                    transition-all duration-300 ease-in-out
                                                    group-focus-within:text-fuchsia-600 
                                                    hover:text-fuchsia-600 hover:translate-x-1 hover:scale-110
                                                    leading-none">
                                            search
                                        </span>
                                    </button>
                                    
                                    {{-- Input Search - Persis Referensi --}}
                                    <input 
                                        type="text" 
                                        name="search" 
                                        value="{{ request('search') }}"
                                        class="w-full bg-white border border-slate-200 rounded-[2rem] py-6 pl-16 pr-8 text-sm transition-all outline-none text-slate-700 font-medium placeholder:text-slate-300
                                            shadow-xl shadow-fuchsia-900/5 
                                            group-focus-within:ring-4 group-focus-within:ring-fuchsia-600/10 
                                            group-focus-within:border-fuchsia-400 
                                            group-focus-within:shadow-fuchsia-900/10" 
                                        placeholder="Search by Title, Member or Transaction Status..." 
                                    />
                                </form>
                        </div>

                        {{-- 2. Dropdown Filter 1 - Fuchsia (Shadow & Posisi Sejajar) --}}
                        <div class="relative" x-data="{ open: false }" @click.away="open = false">
                            <button @click="open = !open" 
                                    type="button"
                                    class="relative overflow-hidden flex items-center justify-center bg-fuchsia-600 px-4 py-3 rounded-[1.25rem] text-white w-52
                                        shadow-[0_10px_25px_rgba(192,38,211,0.4)] 
                                        transition-all duration-500 [transition-timing-function:cubic-bezier(0.34,1.56,0.64,1)]
                                        hover:shadow-[0_20px_40px_rgba(192,38,211,0.5)] hover:-translate-y-2 hover:scale-[1.02]
                                        group" 
                                    :class="open ? 'shadow-[0_20px_40px_rgba(192,38,211,0.5)] -translate-y-2 scale-[1.02]' : ''">
                                
                                <span class="absolute inset-0 bg-gradient-to-r from-fuchsia-700 to-pink-500 opacity-0 transition-opacity duration-500 group-hover:opacity-100" 
                                :class="open ? 'opacity-100' : 'opacity-0'"> </span>

                                <span class="relative z-10 flex items-center justify-center w-full gap-2">
                                    <span class="material-symbols-outlined text-xl transition-all duration-500 group-hover:rotate-12 group-hover:scale-110 group-hover:-translate-x-1 shrink-0" 
                                    :class="open ? 'rotate-12 scale-110 -translate-x-1' : ''">
                                        filter_list
                                    </span>
                                    <span class="text-sm font-semibold font-accent tracking-wide truncate text-center flex-1">
                                        {{ $sortOptions[request('sort', 'latest')] ?? 'Newest Transaction' }}
                                    </span>
                                    <span class="material-symbols-outlined text-sm transition-all duration-500 group-hover:scale-125 shrink-0 origin-center" 
                                        :class="open ? 'rotate-180 scale-125' : ''">
                                        expand_more
                                    </span>
                                </span>
                            </button>

                            {{-- Dropdown Menu (Sama Persis Plek Ketiplek) --}}
                            <div x-show="open" 
                                x-cloak
                                x-transition:enter="transition ease-[cubic-bezier(0.34,1.56,0.64,1)] duration-500"
                                x-transition:enter-start="opacity-0 -translate-y-4 scale-95"
                                x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                                x-transition:leave="transition ease-in duration-200"
                                x-transition:leave-start="opacity-100 scale-100"
                                x-transition:leave-end="opacity-0 scale-95"
                                class="absolute -left-[25px] mt-[18px] w-64 bg-white/95 dark:bg-slate-900/95 backdrop-blur-xl border border-white/20 dark:border-slate-700/50 rounded-2xl shadow-[0_20px_50px_rgba(0,0,0,0.15)] z-50 overflow-hidden"
                                style="display: none;">
                                
                                <div class="px-4 pt-4 pb-4 text-center">
                                    <span class="text-[13px] font-semibold uppercase tracking-[0.2em] text-fuchsia-600/60 font-accent">
                                        Sort Options
                                    </span>
                                </div>

                                <div class="py-2 max-h-80 overflow-y-auto custom-scrollbar"> 
                                    @foreach($sortOptions as $key => $label)
                                        @php $isActive = request('sort', 'latest') == $key; @endphp
                                        
                                        <a href="{{ request()->fullUrlWithQuery(['sort' => $key]) }}"
                                        class="group mx-2 mb-2 flex items-center justify-between px-4 py-2.5 rounded-xl text-sm border-2 transition-all duration-500 ease-out font-accent font-semibold
                                        {{ $isActive 
                                            ? 'bg-fuchsia-600 border-fuchsia-600 text-white pointer-events-none' 
                                            : 'bg-white dark:bg-transparent border-fuchsia-100 dark:border-fuchsia-900/30 text-fuchsia-600 hover:bg-fuchsia-600 hover:border-fuchsia-600 hover:text-white hover:-translate-y-1' }}">
                                            
                                            <span class="truncate pr-2 max-w-[170px]">{{ $label }}</span>
                                            
                                            @if($isActive)
                                                <span class="material-symbols-outlined text-[18px] font-normal shrink-0">check_circle</span>
                                            @endif
                                        </a>
                                    @endforeach
                                </div>
                            </div>

                            <style>
                                .custom-scrollbar::-webkit-scrollbar { width: 4px; }
                                .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
                                .custom-scrollbar::-webkit-scrollbar-thumb { 
                                    background: rgba(192, 38, 211, 0.2); 
                                    border-radius: 10px; 
                                }
                            </style>
                        </div>

                        {{-- 3. Dropdown Filter 2 - Fuchsia (Shadow & Posisi Sejajar) --}}
                        <div class="relative h-[70px] flex items-center" x-data="{ open: false }" @click.away="open = false">
                            <button @click="open = !open" 
                                    type="button"
                                    class="relative overflow-hidden flex items-center justify-center bg-fuchsia-600 px-4 py-3 rounded-[1.25rem] text-white w-52
                                        shadow-[0_10px_25px_rgba(192,38,211,0.4)] 
                                        transition-all duration-500 [transition-timing-function:cubic-bezier(0.34,1.56,0.64,1)]
                                        hover:shadow-[0_20px_40px_rgba(192,38,211,0.5)] hover:-translate-y-2 hover:scale-[1.02]
                                        group" 
                                    :class="open ? 'shadow-[0_20px_40px_rgba(192,38,211,0.5)] -translate-y-2 scale-[1.02]' : ''">
                                
                                <span class="absolute inset-0 bg-gradient-to-r from-fuchsia-700 to-pink-500 opacity-0 transition-opacity duration-500 group-hover:opacity-100" :class="open ? 'opacity-100' : 'opacity-0'"> </span>

                                <span class="relative z-10 flex items-center justify-center w-full gap-2">
                                    <span class="material-symbols-outlined text-xl transition-all duration-500 group-hover:rotate-12 group-hover:scale-110 group-hover:-translate-x-1 shrink-0" :class="open ? 'rotate-12 scale-110 -translate-x-1' : ''">
                                        sort
                                    </span>
                                    <span class="text-sm font-semibold font-accent tracking-wide truncate text-center flex-1">
                                        {{ $statusOptions[$currentFilter] ?? 'Filter' }}

                                        @if($currentMonthFilter !== 'all')
                                            <span class="opacity-75 mx-1">|</span> 
                                            <span class="text-[11px] italic">{{ $monthRangeOptions[$currentMonthFilter] ?? '' }}</span>
                                        @endif
                                    </span>
                                    <span class="material-symbols-outlined text-sm transition-all duration-500 group-hover:scale-125 shrink-0 origin-center" 
                                        :class="open ? 'rotate-180 scale-125' : ''">
                                        expand_more
                                    </span>
                                </span>
                            </button>

                            {{-- Dropdown Menu (Plek Ketiplek 100%) --}}
                            <div x-show="open" 
                                x-cloak
                                x-transition:enter="transition ease-[cubic-bezier(0.34,1.56,0.64,1)] duration-500"
                                x-transition:enter-start="opacity-0 -translate-y-4 scale-95"
                                x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                                x-transition:leave="transition ease-in duration-200"
                                x-transition:leave-start="opacity-100 scale-100"
                                x-transition:leave-end="opacity-0 scale-95"
                                class="absolute -left-6 top-[90%] l mt-4 w-64 bg-white/95 dark:bg-slate-900/95 backdrop-blur-xl border border-white/20 dark:border-slate-700/50 rounded-2xl shadow-[0_20px_50px_rgba(0,0,0,0.15)] z-50 overflow-hidden"
                                x-anchor="$refs.button" 
                                style="display: none;">
                                
                                <div class="px-4 pt-4 pb-4 text-center">
                                    <span class="text-[13px] font-semibold uppercase tracking-[0.2em] text-fuchsia-600/60 font-accent">
                                        Filter & Months
                                    </span>
                                </div>

                                <div class="py-2 max-h-80 overflow-y-auto custom-scrollbar"> 
                                    {{-- Bagian Status --}}
                                    @foreach($statusOptions as $val => $label)
                                        @php $activeStatus = ($currentFilter == $val); @endphp
                                        <a href="{{ request()->fullUrlWithQuery(['filter' => $val === 'all' ? null : $val]) }}"
                                        class="group mx-2 mb-2 flex items-center justify-between px-4 py-2.5 rounded-xl text-sm border-2 transition-all duration-500 ease-out font-accent font-semibold
                                        {{ $activeStatus 
                                            ? 'bg-fuchsia-600 border-fuchsia-600 text-white pointer-events-none' 
                                            : 'bg-white dark:bg-transparent border-fuchsia-100 dark:border-fuchsia-900/30 text-fuchsia-600 hover:bg-fuchsia-600 hover:border-fuchsia-600 hover:text-white hover:-translate-y-1' }}">
                                            <span class="truncate pr-2">{{ $label }}</span>
                                            @if($activeStatus)
                                                <span class="material-symbols-outlined text-[18px] font-normal shrink-0">check_circle</span>
                                            @endif
                                        </a>
                                    @endforeach

                                    <div class="h-[5px] w-full bg-gradient-to-r from-transparent via-fuchsia-300 to-transparent dark:via-fuchsia-900/50 my-4 opacity-80"></div>

                                    {{-- Bagian Rentang Bulan --}}
                                    @foreach($monthRangeOptions as $key => $label)
                                        @php $activeMonth = ($currentMonthFilter == $key); @endphp
                                        <a href="{{ request()->fullUrlWithQuery(['month_range' => $key === 'all' ? null : $key]) }}"
                                        class="group mx-2 mb-2 flex items-center justify-between px-4 py-2.5 rounded-xl text-sm border-2 transition-all duration-500 ease-out font-accent font-semibold
                                        {{ $activeMonth 
                                            ? 'bg-fuchsia-600 border-fuchsia-600 text-white pointer-events-none' 
                                            : 'bg-white dark:bg-transparent border-fuchsia-100 dark:border-fuchsia-900/30 text-fuchsia-600 hover:bg-fuchsia-600 hover:border-fuchsia-600 hover:text-white hover:-translate-y-1' }}">
                                            <span class="truncate pr-2">{{ $label }}</span>
                                            @if($activeMonth)
                                                <span class="material-symbols-outlined text-[18px] font-normal shrink-0">check_circle</span>
                                            @endif
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <style>
                            .custom-scrollbar::-webkit-scrollbar { width: 4px; }
                            .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
                            .custom-scrollbar::-webkit-scrollbar-thumb { 
                                background: rgba(192, 38, 211, 0.2); 
                                border-radius: 10px; 
                            }
                        </style>
                        </div>
                    </div>

                    <div class="section-container hover-fuchsia group relative isolate !mt-6">
                            <div class="glow-edge absolute inset-x-0 top-0 h-px bg-gradient-to-r from-transparent via-fuchsia-400/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-700 z-10"></div>
                            <div class="absolute inset-0 bg-white/10 transition-colors duration-700 ease-in-out group-hover:bg-white/20 -z-10"></div>

                            <div class="flex items-center gap-6 px-5 mb-6 relative z-20 -top-[11px]">
                            <div class="w-14 flex-shrink-0"></div> 

                            <div class="flex-grow grid grid-cols-6 items-center gap-6">
                                {{-- 1. Book --}}
                                <div class="flex items-center gap-2 group/item cursor-default w-fit transform -translate-x-[35px]">
                                    <div class="flex items-center justify-center w-6 h-6 rounded-md bg-fuchsia-500 text-white shadow-md shadow-fuchsia-500/20 shrink-0 transition-all duration-500 ease-in-out group-hover/item:rotate-12 group-hover/item:scale-110">
                                        <span class="material-symbols-outlined text-[14px] font-bold">import_contacts</span>
                                    </div>
                                    <span class="font-accent text-[10px] font-black uppercase tracking-[0.2em] text-fuchsia-600/60 leading-none whitespace-nowrap">
                                        Book Detail
                                    </span>
                                </div>

                                {{-- 2. Borrower --}}
                                <div class="flex items-center gap-2 group/item cursor-default w-fit transform translate-x-[44px]">
                                    <div class="flex items-center justify-center w-6 h-6 rounded-md bg-fuchsia-500 text-white shadow-md shadow-fuchsia-500/20 shrink-0 transition-all duration-500 ease-in-out group-hover/item:rotate-12 group-hover/item:scale-110">
                                        <span class="material-symbols-outlined text-[14px] font-bold">group</span>
                                    </div>
                                    <span class="font-accent text-[10px] font-black uppercase tracking-[0.2em] text-fuchsia-600/60 leading-none whitespace-nowrap">
                                        Borrower
                                    </span>
                                </div>

                                {{-- 3. Status --}}
                                <div class="flex items-center gap-2 group/item cursor-default w-fit transform translate-x-[80px]">
                                    <div class="flex items-center justify-center w-6 h-6 rounded-md bg-fuchsia-500 text-white shadow-md shadow-fuchsia-500/20 shrink-0 transition-all duration-500 ease-in-out group-hover/item:rotate-12 group-hover/item:scale-110">
                                        <span class="material-symbols-outlined text-[14px] font-bold">info</span>
                                    </div>
                                    <span class="font-accent text-[10px] font-black uppercase tracking-[0.2em] text-fuchsia-600/60 leading-none whitespace-nowrap">
                                        Status
                                    </span>
                                </div>

                                {{-- 4. Borrow Date --}}
                                <div class="flex items-center gap-2 group/item cursor-default w-fit transform translate-x-[81px]">
                                    <div class="flex items-center justify-center w-6 h-6 rounded-md bg-fuchsia-500 text-white shadow-md shadow-fuchsia-500/20 shrink-0 transition-all duration-500 ease-in-out group-hover/item:rotate-12 group-hover/item:scale-110">
                                        <span class="material-symbols-outlined text-[14px] font-bold">calendar_add_on</span>
                                    </div>
                                    <span class="font-accent text-[10px] font-black uppercase tracking-[0.2em] text-fuchsia-600/60 leading-none whitespace-nowrap">
                                        Loan Date
                                    </span>
                                </div>

                                {{-- 5. Due Date --}}
                                <div class="flex items-center gap-2 group/item cursor-default w-fit transform translate-x-[86px]">
                                    <div class="flex items-center justify-center w-6 h-6 rounded-md bg-fuchsia-500 text-white shadow-md shadow-fuchsia-500/20 shrink-0 transition-all duration-500 ease-in-out group-hover/item:rotate-12 group-hover/item:scale-110">
                                        <span class="material-symbols-outlined text-[14px] font-bold">event_busy</span>
                                    </div>
                                    <span class="font-accent text-[10px] font-black uppercase tracking-[0.2em] text-fuchsia-600/60 leading-none whitespace-nowrap">
                                        Due Date
                                    </span>
                                </div>

                                <div class="flex items-center gap-2 group/item cursor-default w-fit transform translate-x-[76px]">
                                    <div class="flex items-center justify-center w-6 h-6 rounded-md bg-fuchsia-500 text-white shadow-md shadow-fuchsia-500/20 shrink-0 transition-all duration-500 ease-in-out group-hover/item:rotate-12 group-hover/item:scale-110">
                                        <span class="material-symbols-outlined text-[14px] font-bold">event_available</span>
                                    </div>
                                    <span class="font-accent text-[10px] font-black uppercase tracking-[0.2em] text-fuchsia-600/60 leading-none whitespace-nowrap">
                                        Returned
                                    </span>
                                </div>
                            </div>

                            {{-- 6. Action Button (Posisi dipertahankan sama persis) --}}
                            <div class="w-[140px] flex justify-center">
                                <div class="flex items-center gap-2 group/item cursor-default w-fit transform translate-x-[40px]">
                                    <div class="flex items-center justify-center w-6 h-6 rounded-md bg-fuchsia-500 text-white shadow-md shadow-fuchsia-500/20 shrink-0 transition-all duration-500 ease-in-out group-hover/item:rotate-12 group-hover/item:scale-110">
                                        <span class="material-symbols-outlined text-[14px] font-bold">settings_suggest</span>
                                    </div>
                                    <span class="font-accent text-[10px] font-black uppercase tracking-[0.2em] text-fuchsia-600/60 leading-none whitespace-nowrap">
                                        Action
                                    </span>
                                </div>
                            </div>
                        </div>

                           @forelse($allTransactions as $transaction)
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
                            @endphp

                            <div class="admin-row-card loan-card bg-white rounded-[2.5rem] border-l-4 {{ $clr['border_l'] }} border border-slate-200 py-4 px-4 md:px-5 flex flex-col md:flex-row items-center gap-1 group/returned-card shadow-sm transition-all duration-500 transform-gpu hover:-translate-y-[0.375rem] hover:shadow-[0_0_20px_rgba(192,38,211,0.2),0_15px_30px_-15px_rgba(0,0,0,0.1)]"
                                data-start="{{ $transaction->loan_date }}" 
                                data-end="{{ $transaction->due_date }}" 
                                data-status="{{ $transaction->status }}"
                                style="{{ $style }}">
                                
                                <div class="w-14 h-20 ml-2 flex-shrink-0 rounded-xl overflow-hidden shadow-md transition-all duration-500 transform transform-gpu
                                            -translate-x-1 -rotate-3 border border-slate-200 bg-white
                                            
                                            group-hover/returned-card:rotate-0 
                                            group-hover/returned-card:translate-x-0 
                                            group-hover/returned-card:scale-105
                                            group-hover/returned-card:border-fuchsia-400/80
                                            group-hover/returned-card:shadow-[0_0_15px_rgba(192,38,211,0.25),0_8px_15px_-5px_rgba(0,0,0,0.15)]
                                            
                                            hover:!rotate-[1.5deg] 
                                            hover:!scale-110 
                                            hover:!shadow-[0_4px_10px_rgba(192,38,211,0.35),0_2px_5px_rgba(0,0,0,0.1)]
                                            cursor-pointer">
                                            
                                    @php
                                        $imagePath = $transaction->book->image ?? $transaction->book->cover_image ?? '';
                                        $finalUrl = str_contains($imagePath, 'http') ? $imagePath : asset('storage/' . $imagePath);
                                    @endphp

                                    {{-- PERBAIKAN PADA ATRIBUT ALT --}}
                                    <img alt="{{ $transaction->book->title ?? 'Cover' }}" 
                                        class="w-full h-full object-cover" 
                                        src="{{ $finalUrl }}" 
                                        onerror="this.onerror=null; this.src='https://via.placeholder.com/150x225?text=No+Cover'"/>
                                </div>



                                <div class="flex-grow grid grid-cols-6 items-center gap-6 -ml-2">
                                   <div class="flex items-center gap-4 col-span-1">
                                    <div class="min-w-0 overflow-visible w-[160px]">
                                        {{-- Title: Rose Gradient Edition --}}
                                        <h3 class="font-black text-lg tracking-tighter font-heading leading-[1.2] py-2 -my-2 line-clamp-2 transform-gpu max-w-[10rem]" 
                                            style="
                                                backface-visibility: hidden;
                                                background-image: linear-gradient(to right, #c026d3 5%, #e879f9 95%);
                                                -webkit-background-clip: text;
                                                -webkit-text-fill-color: transparent;
                                                padding-bottom: 0.1em;
                                                margin-bottom: -0.1em;
                                            "
                                            title="{{ $transaction->book->title ?? 'Judul Tidak Ada' }}">
                                            {{ $transaction->book->title ?? 'Judul Tidak Ada' }}
                                        </h3>

                                        <div class="flex flex-row items-center mt-1">
                                            <span class="w-4 h-[2px] bg-fuchsia-500/60 rounded-full flex-shrink-0
                                                transition-all duration-700 [transition-timing-function:cubic-bezier(0.34,1.56,0.64,1)] 
                                                group-hover:scale-x-[1.2] 
                                                group-hover/returned-card:!scale-x-[1.8] 
                                                origin-left 
                                                transform-gpu will-change-transform [backface-visibility:hidden]">
                                            </span>

                                            <p class="text-[10px] text-fuchsia-500/60 font-black font-accent uppercase tracking-[0.15em] italic truncate leading-tight max-w-[10rem] flex-1 min-w-0 
                                                transition-all duration-700 [transition-timing-function:cubic-bezier(0.34,1.56,0.64,1)]
                                                ml-2 
                                                group-hover:pl-1
                                                group-hover/returned-card:!pl-4
                                                transform-gpu"
                                                title="{{ $transaction->book->author_name ?? 'Penulis' }}">
                                                {{ $transaction->book->author_name ?? 'Unknown Author' }}
                                            </p>
                                        </div>  
                                    </div>
                                </div>

                                    <div class="w-[135px] flex-shrink-0 ml-4">
                                        <div class="flex items-center justify-center gap-2 px-3 py-1.5 rounded-xl border transition-all duration-500 cursor-pointer group/category-badge
                                            {{-- KONDISI AWAL --}}  
                                            {{ $clr['bg'] }} {{ $clr['border'] }} {{ $clr['text'] }}
                                            shadow-[0_2px_4px_rgba(0,0,0,0.08)] 
                                            
                                            {{-- TAHAP 1: Card Hover --}}
                                            {{ $clr['hover_bg'] }}
                                            group-hover/returned-card:text-white 
                                            group-hover/returned-card:border-transparent    
                                            group-hover/returned-card:scale-105
                                            group-hover/returned-card:shadow-[0_4px_8px_var(--shadow-color)]

                                            {{-- TAHAP 2: Self Hover --}}
                                            hover:!scale-110 
                                            hover:-translate-y-1 
                                            hover:!shadow-[0_6px_12px_var(--shadow-deep)]
                                            
                                            {{-- Efek BG Level 600 --}}
                                            @if(str_contains($clr['hover_bg'], 'blue')) hover:!bg-blue-600 @endif
                                            @if(str_contains($clr['hover_bg'], 'rose')) hover:!bg-rose-600 @endif
                                            @if(str_contains($clr['hover_bg'], 'emerald')) hover:!bg-emerald-600 @endif
                                            @if(str_contains($clr['hover_bg'], 'amber')) hover:!bg-amber-600 @endif
                                            @if(str_contains($clr['hover_bg'], 'indigo')) hover:!bg-indigo-600 @endif
                                            @if(str_contains($clr['hover_bg'], 'slate')) hover:!bg-slate-600 @endif
                                            @if(str_contains($clr['hover_bg'], 'violet')) hover:!bg-violet-600 @endif"
                                            
                                            style="--shadow-color: {{ $clr['shadow'] }}; --shadow-deep: {{ $clr['shadow_deep'] }};">
                                            
                                            {{-- ICON: Rotate & Geser Kanan --}}
                                            <span class="material-symbols-outlined text-base transition-all duration-500 transform
                                                @if(str_contains($clr['text'], 'blue')) text-blue-600 @endif
                                                @if(str_contains($clr['text'], 'rose')) text-rose-600 @endif
                                                @if(str_contains($clr['text'], 'emerald')) text-emerald-600 @endif
                                                @if(str_contains($clr['text'], 'amber')) text-amber-600 @endif
                                                @if(str_contains($clr['text'], 'indigo')) text-indigo-600 @endif
                                                @if(str_contains($clr['text'], 'slate')) text-slate-600 @endif
                                                @if(str_contains($clr['text'], 'violet')) text-violet-600 @endif
                                                
                                                group-hover/returned-card:text-white
                                                
                                                group-hover/category-badge:translate-x-1
                                                group-hover/category-badge:rotate-12
                                                group-hover/category-badge:scale-110">
                                                person
                                            </span>
                                            
                                            {{-- TEXT REQUESTER --}}
                                            <div class="flex flex-col min-w-0">
                                                <span class="text-[13px] font-black font-modern tracking-tighter tabular-nums leading-none whitespace-nowrap truncate">
                                                    {{ $transaction->user->username ?? $transaction->user->name ?? 'User' }}
                                                </span>
                                                <span class="text-[9px] font-bold uppercase opacity-80 leading-tight">
                                                    {{ $transaction->user->role ?? 'N/A' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    @php
                                        // 1. Definisi 5 skema warna (Presisi sesuai config JS Anda - Plek Ketiplek 100%)
                                        $color_options = [
                                            'rose' => [
                                                'bg' => 'bg-rose-100', 'border' => 'border-rose-200', 'text' => 'text-rose-700',
                                                'hover_bg' => 'group-hover/returned-card:bg-rose-500', 
                                                'shadow' => 'rgba(225, 29, 72, 0.40)', 'shadow_deep' => 'rgba(225, 29, 72, 0.45)'
                                            ],
                                            'emerald' => [
                                                'bg' => 'bg-emerald-100', 'border' => 'border-emerald-200', 'text' => 'text-emerald-700',
                                                'hover_bg' => 'group-hover/returned-card:bg-emerald-500',
                                                'shadow' => 'rgba(16, 185, 129, 0.40)', 'shadow_deep' => 'rgba(16, 185, 129, 0.45)'
                                            ],
                                            'amber' => [
                                                'bg' => 'bg-amber-100', 'border' => 'border-amber-200', 'text' => 'text-amber-700',
                                                'hover_bg' => 'group-hover/returned-card:bg-amber-500',
                                                'shadow' => 'rgba(245, 158, 11, 0.40)', 'shadow_deep' => 'rgba(245, 158, 11, 0.45)'
                                            ],
                                            'violet' => [
                                                'bg' => 'bg-violet-100', 'border' => 'border-violet-200', 'text' => 'text-violet-700',
                                                'hover_bg' => 'group-hover/returned-card:bg-violet-500',
                                                'shadow' => 'rgba(124, 58, 237, 0.40)', 'shadow_deep' => 'rgba(124, 58, 237, 0.45)'
                                            ],
                                            'blue' => [
                                                'bg' => 'bg-blue-100', 'border' => 'border-blue-200', 'text' => 'text-blue-700',
                                                'hover_bg' => 'group-hover/returned-card:bg-blue-500',
                                                'shadow' => 'rgba(37, 99, 235, 0.40)', 'shadow_deep' => 'rgba(37, 99, 235, 0.45)'
                                            ],
                                        ];

                                        // 2. Fungsi RANDOM: Memilih 1 dari 5 secara acak
                                        $clr = $color_options[array_rand($color_options)];
                                    @endphp

                                    <div class=" w-[120px] flex-shrink-0 ml-8">
                                        {{-- Card Overdue Books: Presisi 100% mengikuti instruksi radius, shadow, & efek hover --}}
                                        <div class="flex items-center justify-center gap-2 px-4 h-8 rounded-xl border transition-all duration-500 cursor-pointer group/category-badge
                                            {{-- KONDISI AWAL --}}
                                            {{ $clr['bg'] }} {{ $clr['border'] }} {{ $clr['text'] }}
                                            shadow-[0_2px_4px_rgba(0,0,0,0.08)] 
                                            
                                            {{-- TAHAP 1: Card Hover (Shadow 0.40 - Radius 8px) --}}
                                            {{ $clr['hover_bg'] }}
                                            group-hover/returned-card:text-white 
                                            group-hover/returned-card:border-transparent 
                                            group-hover/returned-card:scale-105
                                            group-hover/returned-card:shadow-[0_4px_8px_var(--shadow-color)]

                                            {{-- TAHAP 2: Self Hover (Shadow 0.45 - Radius 12px & Terangkat) --}}
                                            hover:!scale-110 
                                            hover:-translate-y-1 
                                            hover:!shadow-[0_6px_12px_var(--shadow-deep)]
                                            
                                            {{-- Efek BG Level 600 saat kursor tepat di card --}}
                                            @if(str_contains($clr['hover_bg'], 'blue')) hover:!bg-blue-600 @endif
                                            @if(str_contains($clr['hover_bg'], 'rose')) hover:!bg-rose-600 @endif
                                            @if(str_contains($clr['hover_bg'], 'emerald')) hover:!bg-emerald-600 @endif
                                            @if(str_contains($clr['hover_bg'], 'amber')) hover:!bg-amber-600 @endif
                                            @if(str_contains($clr['hover_bg'], 'violet')) hover:!bg-violet-600 @endif"
                                            
                                            style="--shadow-color: {{ $clr['shadow'] }}; --shadow-deep: {{ $clr['shadow_deep'] }};">
                                            
                                            {{-- ICON: Auto Stories (Rotate, Translate, & Scale) --}}
                                            <span class="material-symbols-outlined text-base transition-all duration-500 transform
                                                @if(str_contains($clr['text'], 'blue')) text-blue-600 @endif
                                                @if(str_contains($clr['text'], 'rose')) text-rose-600 @endif
                                                @if(str_contains($clr['text'], 'emerald')) text-emerald-600 @endif
                                                @if(str_contains($clr['text'], 'amber')) text-amber-600 @endif
                                                @if(str_contains($clr['text'], 'violet')) text-violet-600 @endif
                                                
                                                group-hover/returned-card:text-white
                                                
                                                group-hover/category-badge:translate-x-1
                                                group-hover/category-badge:rotate-12
                                                group-hover/category-badge:scale-110">
                                                Radio_Button_Checked
                                            </span>
                                            
                                            {{-- TEXT: Total Books --}}
                                            <span class="text-[11px] font-black font-modern uppercase tracking-tighter tabular-nums leading-none whitespace-nowrap">
                                                {{ ucfirst($transaction->status) ?? 'Unknown' }}
                                            </span>
                                        </div>
                                    </div>

                                    @php
                                        $durationColors = [
                                            ['bg' => 'bg-rose-500',    'text_top' => 'text-rose-600/70',    'text_hover' => 'group-hover/returned:text-rose-500',    'shadow' => 'rgba(225,29,72,0.4)',  'shadow_deep' => 'rgba(225,29,72,0.45)'],
                                            ['bg' => 'bg-emerald-500', 'text_top' => 'text-emerald-600/70', 'text_hover' => 'group-hover/returned:text-emerald-500', 'shadow' => 'rgba(16,185,129,0.4)', 'shadow_deep' => 'rgba(16,185,129,0.45)'],
                                            ['bg' => 'bg-blue-500',    'text_top' => 'text-blue-600/70',    'text_hover' => 'group-hover/returned:text-blue-500',    'shadow' => 'rgba(37,99,235,0.4)',   'shadow_deep' => 'rgba(37,99,235,0.45)'],
                                        ];
                                        
                                        // Card 1: Emerald (Loan Date)
                                        $clrEmerald = $durationColors[1];
                                        $styleEmerald = "--shadow-color: {$clrEmerald['shadow']}; --shadow-deep: {$clrEmerald['shadow_deep']};";
                                        
                                        // Card 2: Rose (Due Date)
                                        $clrRose = $durationColors[0];
                                        $styleRose = "--shadow-color: {$clrRose['shadow']}; --shadow-deep: {$clrRose['shadow_deep']};";

                                        // Card 3: Blue Edition (Baru)
                                        $clrBlue = $durationColors[2];
                                        $styleBlue = "--shadow-color: {$clrBlue['shadow']}; --shadow-deep: {$clrBlue['shadow_deep']};";
                                    @endphp

                                    {{-- Tanggal Pinjam: Emerald Edition (Plek Ketiplek 100%) --}}
                                    <div class="ml-10 text-center w-[120px] flex flex-col items-center group/returned transition-all duration-700 ease-[cubic-bezier(0.4,0,0.2,1)] transform-gpu hover:-translate-y-1 -translate-x-2">
                                        <div class="w-full">
                                            <div class="flex items-center px-4 h-9 rounded-full {{ $clrEmerald['bg'] }} text-white transition-all duration-700 ease-[cubic-bezier(0.4,0,0.2,1)] w-full justify-center border-none cursor-default transform-gpu 
                                                shadow-[0_4px_12px_var(--shadow-color)] 
                                                group-hover/returned:scale-105 
                                                group-hover/returned:shadow-[0_6px_16px_var(--shadow-deep)]"
                                                style="{{ $styleEmerald }}">
                                                <p class="text-[12px] font-black font-modern uppercase tracking-tighter tabular-nums leading-none whitespace-nowrap">
                                                    {{ $transaction->loan_date ? \Carbon\Carbon::parse($transaction->loan_date)->format('M d, H:i') : '-' }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Tanggal Jatuh Tempo: Rose Edition (Plek Ketiplek 100%) --}}
                                    <div class="ml-6 text-center w-[120px] flex flex-col items-center group/returned transition-all duration-700 ease-[cubic-bezier(0.4,0,0.2,1)] transform-gpu hover:-translate-y-1 -translate-x-2">
                                        <div class="w-full">
                                            <div class="flex items-center px-4 h-9 rounded-full {{ $clrRose['bg'] }} text-white transition-all duration-700 ease-[cubic-bezier(0.4,0,0.2,1)] w-full justify-center border-none cursor-default transform-gpu 
                                                shadow-[0_4px_12px_var(--shadow-color)] 
                                                group-hover/returned:scale-105 
                                                group-hover/returned:shadow-[0_6px_16px_var(--shadow-deep)]"
                                                style="{{ $styleRose }}">
                                                <p class="text-[12px] font-black font-modern uppercase tracking-tighter tabular-nums leading-none whitespace-nowrap">
                                                    {{ $transaction->due_date ? \Carbon\Carbon::parse($transaction->due_date)->format('M d, H:i') : '-' }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Tanggal Pengembalian: Blue Edition (Plek Ketiplek 100%) --}}
                                    <div class="ml-2 text-center w-[120px] flex flex-col items-center group/returned transition-all duration-700 ease-[cubic-bezier(0.4,0,0.2,1)] transform-gpu hover:-translate-y-1 -translate-x-2">
                                        <div class="w-full">
                                            <div class="flex items-center px-4 h-9 rounded-full {{ $clrBlue['bg'] }} text-white transition-all duration-700 ease-[cubic-bezier(0.4,0,0.2,1)] w-full justify-center border-none cursor-default transform-gpu 
                                                shadow-[0_4px_12px_var(--shadow-color)] 
                                                group-hover/returned:scale-105 
                                                group-hover/returned:shadow-[0_6px_16px_var(--shadow-deep)]"
                                                style="{{ $styleBlue }}">
                                                <p class="text-[12px] font-black font-modern uppercase tracking-tighter tabular-nums leading-none whitespace-nowrap">
                                                    @if($transaction->status === 'returned' && $transaction->return_date)
                                                        {{ \Carbon\Carbon::parse($transaction->return_date)->format('M d, H:i') }}
                                                    @else
                                                        None
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                    </div>        
                                </div>

                                <div class="flex items-center gap-2 pr-2">
                                    <form action="{{ route('admin.reports.destroy', $transaction->id) }}" method="POST" class="m-0 inline-flex items-center">    
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus permanen transaksi ini?\n\nBuku: {{ $transaction->book->title ?? 'Judul Tidak Ada' }}\nUser: {{ $transaction->user->username ?? $transaction->user->name ?? 'User' }}\nStatus: {{ ucfirst($transaction->status) ?? 'Unknown' }}')"
                                        class="group/del-btn w-10 h-10 flex items-center justify-center bg-rose-600 text-white rounded-xl transition-all duration-300 transform-gpu cursor-pointer
                                            /* TAHAP 1: Shadow Fokus (8px) */
                                            shadow-[0_4px_8px_rgba(225,29,72,0.35)] 
                                            
                                            /* TAHAP 2: Hover (Naik, BG, Shadow Rapat 12px) */
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
                            @empty
                                <div class="col-span-full py-24 flex flex-col items-center justify-center w-full">
                                    <span class="material-symbols-outlined text-slate-200 text-7xl mb-4 select-none">
                                        sync_alt
                                    </span>
                                    <p class="text-slate-400 font-accent uppercase tracking-[0.2em] text-xs font-black text-center">
                                        No <span class="text-fuchsia-600/80">Active Transactions</span> in System.
                                    </p>
                                </div>
                            @endforelse
                        </div>

                        <div class="flex justify-center items-center gap-2 font-accent pt-12">
                            @if ($allTransactions->hasPages())
                                {{-- Tombol Previous --}}
                                @if ($allTransactions->onFirstPage())
                                    {{-- Hilang/Kosong sesuai perilaku kode referensi --}}
                                @else
                                    <a href="{{ $allTransactions->previousPageUrl() }}" class="w-10 h-10 md:w-12 md:h-12 flex items-center justify-center rounded-xl border-2 border-slate-200 bg-white text-slate-400 hover:text-fuchsia-600 hover:border-fuchsia-600 hover:-translate-y-1.5 transition-all duration-300 shadow-sm mr-2 group">
                                        <span class="material-symbols-outlined text-sm transition-transform group-hover:scale-110">arrow_back_ios_new</span>
                                    </a>
                                @endif

                                {{-- Logika Perhitungan Angka --}}
                                @php
                                    $currentPage = $allTransactions->currentPage();
                                    $lastPage = $allTransactions->lastPage();
                                    $start = max(1, $currentPage - ($currentPage == $lastPage ? 2 : 1));
                                    $end = min($lastPage, $currentPage + ($currentPage == 1 ? 2 : 1));
                                    
                                    if($currentPage == 1) $end = min($lastPage, 3);
                                    if($currentPage == $lastPage) $start = max(1, $lastPage - 2);
                                @endphp

                                {{-- Halaman Pertama & Separator --}}
                                @if($start > 1)
                                    <a href="{{ $allTransactions->url(1) }}" class="w-9 h-9 flex items-center justify-center rounded-lg border-2 border-slate-200 bg-white text-slate-400 font-medium text-[11px] hover:text-fuchsia-600 hover:border-fuchsia-600 hover:-translate-y-1.5 transition-all duration-300 shadow-sm">1</a>
                                    @if($start > 2)
                                        <div class="flex items-center justify-center h-12">
                                            <span class="text-slate-400 px-1 text-[12px] font-extrabold tracking-widest leading-none">...</span>
                                        </div>
                                    @endif
                                @endif

                                {{-- Range Angka Tengah --}}
                                @foreach (range($start, $end) as $page)
                                    @if ($page == $currentPage)
                                        {{-- STATUS AKTIF: Hitam, Lebih Besar (w-14), Shadow 2XL, Glow Fuchsia --}}
                                        <div class="relative group transition-all duration-300">
                                            <span class="w-12 h-12 md:w-14 md:h-14 flex items-center justify-center rounded-2xl bg-slate-900 text-white font-black text-base shadow-2xl shadow-slate-900/30 z-10 relative">
                                                {{ $page }}
                                            </span>
                                            <div class="absolute inset-0 bg-fuchsia-500/20 blur-xl rounded-full scale-75 group-hover:scale-110 transition-all duration-300"></div>
                                        </div>
                                    @else
                                        {{-- STATUS TIDAK AKTIF: Border 2, Hover Fuchsia 600, Translate-y --}}
                                        <a href="{{ $allTransactions->url($page) }}" class="w-10 h-10 md:w-11 md:h-11 flex items-center justify-center rounded-xl border-2 border-slate-200 bg-white text-slate-500 font-bold text-sm hover:text-fuchsia-600 hover:border-fuchsia-600 hover:-translate-y-1.5 transition-all duration-300 shadow-sm">
                                            {{ $page }}
                                        </a>
                                    @endif
                                @endforeach

                                {{-- Separator & Halaman Terakhir --}}
                                @if($end < $lastPage)
                                    @if($end < $lastPage - 1)
                                        <div class="flex items-center justify-center h-12">
                                            <span class="text-slate-400 px-1 text-[12px] font-extrabold tracking-widest leading-none">...</span>
                                        </div>
                                    @endif
                                    <a href="{{ $allTransactions->url($lastPage) }}" class="w-9 h-9 flex items-center justify-center rounded-lg border-2 border-slate-200 bg-white text-slate-400 font-medium text-[11px] hover:text-fuchsia-600 hover:border-fuchsia-600 hover:-translate-y-1.5 transition-all duration-300 shadow-sm">
                                        {{ $lastPage }}
                                    </a>
                                @endif

                                {{-- Tombol Next --}}
                                @if ($allTransactions->hasMorePages())
                                    <a href="{{ $allTransactions->nextPageUrl() }}" class="w-10 h-10 md:w-12 md:h-12 flex items-center justify-center rounded-xl border-2 border-slate-200 bg-white text-slate-400 hover:text-fuchsia-600 hover:border-fuchsia-600 hover:-translate-y-1.5 transition-all duration-300 shadow-sm ml-2 group">
                                        <span class="material-symbols-outlined text-sm transition-transform group-hover:scale-110">arrow_forward_ios</span>
                                    </a>
                                @endif
                            @endif
                        </div>
                </section>
            </div>
        </div>
    </main>
</div>  

<footer class="bg-slate-950 text-white pt-16 pb-12 rounded-t-[5rem] relative overflow-hidden shadow-[0_-20px_50px_rgba(0,0,0,0.1)] w-full block">
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

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('-translate-x-full');
        }

        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
</body>

</html>