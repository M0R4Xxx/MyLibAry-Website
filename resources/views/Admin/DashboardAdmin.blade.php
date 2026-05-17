<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Admin Dashboard - LibSys</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Plus+Jakarta+Sans:wght@700;800&family=Montserrat:wght@500;700;900&family=Space+Grotesk:wght@300;500;700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Plus+Jakarta+Sans:wght@700;800&family=Montserrat:wght@500;700;900&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Plus+Jakarta+Sans:wght@700;800&family=Montserrat:wght@500;700;900&family=Space+Grotesk:wght@300;500;700&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,container-queries"></script>
    
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


        .hover-blue:hover {
            @apply -translate-y-2 border-blue-400/40 border-r-blue-400/60;
            box-shadow: 0 15px 30px -12px rgba(37, 99, 235, 0.10), 0 0 15px rgba(37, 99, 235, 0.08);
        }


        .hover-indigo:hover {
            @apply -translate-y-2 border-indigo-400/40 border-r-indigo-400/60;
            box-shadow: 0 15px 30px -12px rgba(99, 102, 241, 0.10), 0 0 15px rgba(99, 102, 241, 0.08);
        }


        .hover-emerald:hover {
            @apply -translate-y-2 border-emerald-400/40 border-r-emerald-400/60;
            box-shadow: 0 15px 30px -12px rgba(16, 185, 129, 0.10), 0 0 15px rgba(16, 185, 129, 0.08);
        }


        .hover-rose:hover {
            @apply -translate-y-2 border-rose-400/40 border-r-rose-400/60;
            box-shadow: 0 15px 30px -12px rgba(225, 29, 72, 0.10), 0 0 15px rgba(225, 29, 72, 0.08);
        }


        .hover-amber:hover {
            @apply -translate-y-2 border-amber-400/40 border-r-amber-400/60;
            box-shadow: 0 15px 30px -12px rgba(245, 158, 11, 0.10), 0 0 15px rgba(245, 158, 11, 0.08);
        }

        .hover-fuchsia:hover {
            @apply -translate-y-2 border-fuchsia-400/40 border-r-fuchsia-400/60;
            box-shadow: 0 15px 30px -12px rgba(192, 38, 211, 0.10), 0 0 15px rgba(192, 38, 211, 0.08);
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
        bg-white dark:bg-slate-800 border-r border-slate-200 dark:border-slate-700 
        z-40 transform-gpu md:translate-x-0 -translate-x-full will-change-transform transition-[transform,shadow,border-color] 
        antialiased shadow-none after:content-[''] after:absolute after:top-0 after:left-0 after:w-full after:h-[150%] after:bg-inherit after:-z-10" style="backface-visibility: hidden; perspective: 1000px; transform: translateZ(0);" id="sidebar">

            <nav class="mt-8 px-4 flex flex-col space-y-4">
                
                <a class="relative z-50 flex items-center justify-center gap-3 p-4 rounded-2xl bg-gradient-to-r border-blue-200 from-blue-600 to-blue-400 text-white shadow-[0_15px_30px_rgba(37,99,235,0.3)] transform translate-x-3 -translate-y-1 scale-x-[1.06] origin-left transition-all duration-1000 transform-gpu will-change-transform [backface-visibility:hidden] [transition-timing-function:cubic-bezier(0.34,1.56,0.64,1)] group ring-2 ring-white" href="#">
                    <span class="relative z-30 font-black font-accent uppercase tracking-[0.25em] text-[10px] inline-block scale-x-[0.94]">Admin Panel</span>
                    <span class="material-icons-round text-base rotate-[20deg] translate-x-1 transition-transform duration-500 relative z-30 inline-block scale-x-[0.94]">dashboard</span>
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

                <div class="pt-6 pb-2 text-center">
                    <p class="px-3 text-[10px] font-black text-blue-400 uppercase tracking-[0.2em] font-accent">Reporting Tools</p>
                </div>

                <a class="relative overflow-hidden flex items-center justify-center gap-3 p-4 rounded-2xl border-2 border-rose-200 bg-white/50 backdrop-blur-sm text-rose-600 shadow-sm shadow-rose-100/50 transition-all duration-1000 [transition-timing-function:cubic-bezier(0.34,1.56,0.64,1)] hover:z-50 hover:text-white hover:border-transparent hover:translate-x-3 hover:-translate-y-1 
                hover:scale-x-[1.06] origin-left transform-gpu will-change-transform [backface-visibility:hidden] hover:shadow-[0_15px_30px_rgba(244,63,94,0.3)] group" href="{{ route('admin.reports') }}">

                    <span class="absolute inset-0 bg-gradient-to-r from-rose-600 to-rose-400 opacity-0 transition-opacity duration-500 group-hover:opacity-100"></span>
                    <span class="relative z-30 font-black font-accent will-change-transform uppercase tracking-[0.25em] text-[10px]
                    transition-transform duration-1000 [transition-timing-function:inherit] group-hover:scale-x-[0.94] inline-block">Lending Reports</span>

                    <span class="material-icons-round text-base group-hover:rotate-[20deg] group-hover:translate-x-1 transition-transform duration-500 relative z-30
                    group-hover:scale-x-[0.94] inline-block transform-gpu antialiased">bar_chart</span>
                </a>
            </nav>
        </aside>

        
        <main class="flex-1 min-h-screen pt-2">
            <div class="p-8 max-w-[1600px] mx-auto space-y-10 mb-7">
                <section class="mb-10 relative flex justify-between items-start pl-6">
                    <div class="relative">
                        <div class="absolute -left-6 top-0 w-1 h-20 bg-blue-600 rounded-full"></div>
                        
                        <h1 class="text-6xl font-extrabold tracking-tighter text-slate-900 mb-3 font-heading leading-none">
                            <span class="text-transparent bg-clip-text bg-gradient-to-r from-slate-900 via-blue-600 to-blue-400">
                                Hello Admin, <span class="italic">{{ explode(' ', Auth::user()->username ?? 'Admin')[0] }}.</span>
                            </span>
                        </h1>
                        
                        <p class="text-slate-500 font-medium text-lg leading-relaxed max-w-3xl border-l-0 font-modern">
                            Your central hub to oversee operations, manage library assets, and monitor all system activities in real-time to ensure seamless library management.
                        </p>
                    </div>
                    
                    <div class="hidden lg:block pt-9 ">
                        <a class="group relative isolate overflow-hidden bg-white border border-slate-200 px-6 py-3 rounded-2xl text-[#2b6cee] font-bold text-[10px] 
                            hover:text-white hover:-translate-y-1.5 hover:shadow-xl hover:shadow-blue-500/30 
                            transition-all duration-500 ease-[cubic-bezier(0.4,0,0.2,1)] 
                            flex items-center gap-2 uppercase tracking-widest font-accent shadow-sm shadow-blue-100/50" 
                            href="{{ route('admin.transactions') }}">
                            
                            {{-- Layer Gradient yang disembunyikan (Opacity 0) --}}
                            <div class="absolute inset-0 -z-10 bg-gradient-to-r from-[#2b6cee] to-[#5da2ff] opacity-0 group-hover:opacity-100 transition-opacity duration-500 ease-in-out"></div>

                            <span class="relative z-10">View Transactions</span>
                            <span class="material-symbols-outlined text-lg group-hover:translate-x-1 transition-transform duration-500">arrow_right_alt</span> 
                        </a>
                    </div>
                </section>

               <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-5 mb-12">
                <div class="group relative overflow-hidden bg-blue-600 p-6 rounded-[2rem] shadow-sm border border-blue-700/10 transition-all duration-500 [transition-timing-function:cubic-bezier(0.34,1.56,0.64,1)] hover:-translate-y-[12px] hover:scale-[1.01] hover:shadow-[0_20px_40px_rgba(37,99,235,0.25)] cursor-default">
                    <div class="relative z-10">
                        <p class="text-[10.5px] font-bold uppercase tracking-widest text-blue-100 mb-1 font-accent">
                            Total Books
                        </p>
                        <h3 class="text-[23px] font-black text-white font-heading transition-transform duration-500 group-hover:scale-105 origin-left leading-tight">
                            {{ \App\Models\Book::count() }} <span class="font-bold text-[19px]">Books</span>  <span class="italic font-bold opacity-95 text-[18px]"> Collections</span>
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
                            {{ \DB::table('all_library_users')->count() }} <span class=" font-bold text-[19px]">MyLibAry</span> <br> <span class="italic font-bold opacity-95 text-[18px] ">Users</span>
                        </h3>
                    </div>
                    <span class="material-symbols-outlined absolute -right-0 -bottom-7 text-[6.9rem] text-white/20 transition-all duration-700 group-hover:scale-110 group-hover:-rotate-12 pointer-events-none select-none" data-weight="fill">
                        groups
                    </span>
                </div>

                <div class="group relative overflow-hidden bg-emerald-600 p-6 rounded-[2rem] shadow-sm border border-emerald-700/10 transition-all duration-500 [transition-timing-function:cubic-bezier(0.34,1.56,0.64,1)] hover:-translate-y-[12px] hover:scale-[1.01] hover:shadow-[0_20px_40px_rgba(16,185,129,0.25)] cursor-default">
                    <div class="relative z-10">
                        <p class="text-[10.5px] font-bold uppercase tracking-widest text-emerald-100 mb-1 font-accent">
                            Total Active Loans
                        </p>
                        <h3 class="text-[23px] font-black text-white font-heading transition-transform duration-500 group-hover:scale-105 origin-left leading-tight">
                            {{ \DB::table('loans')->where('status', 'borrowed')->count() }} <span class="font-bold text-[19px]">Books Still</span> <br> <span class="italic font-bold opacity-95 text-[18px]"> Borrowed</span>
                        </h3>
                    </div>
                    <span class="material-symbols-outlined absolute -right-3 -bottom-5 text-[6rem] text-white/20 transition-all duration-700 group-hover:scale-110 group-hover:-rotate-12 pointer-events-none select-none" data-weight="fill">
                        library_add_check
                    </span>
                </div>

                <div class="group relative overflow-hidden bg-rose-600 p-6 rounded-[2rem] shadow-sm border border-rose-700/10 transition-all duration-500 [transition-timing-function:cubic-bezier(0.34,1.56,0.64,1)] hover:-translate-y-[12px] hover:scale-[1.01] hover:shadow-[0_20px_40px_rgba(244,63,94,0.25)] cursor-default">
                    <div class="relative z-10">
                        <p class="text-[10.5px] font-bold uppercase tracking-widest text-rose-100 mb-1 font-accent">
                            Total Delayed Returns
                        </p>
                        <h3 class="text-[23px] font-black text-white font-heading transition-transform duration-500 group-hover:scale-105 origin-left leading-tight">
                            {{ \DB::table('loans')->where('status', 'borrowed')->where('due_date', '<', now())->count() }} <span class="font-bold text-[19px]">Expired</span> <br> <span class="italic font-bold opacity-95 text-[18px]">Loan Period</span>
                        </h3>
                    </div>
                    <span class="material-symbols-outlined absolute -right-3 -bottom-3 text-[6rem] text-white/20 transition-all duration-700 group-hover:scale-110 group-hover:-rotate-12 pointer-events-none select-none" data-weight="fill">
                        event_busy
                    </span>
                </div>

                <div class="group relative overflow-hidden bg-amber-500 p-6 rounded-[2rem] shadow-sm border border-amber-700/10 transition-all duration-500 [transition-timing-function:cubic-bezier(0.34,1.56,0.64,1)] hover:-translate-y-[12px] hover:scale-[1.01] hover:shadow-[0_20px_40px_rgba(245,158,11,0.25)] cursor-default">
                    <div class="relative z-10">
                        <p class="text-[10.5px] font-bold uppercase tracking-widest text-amber-100 mb-1 font-accent">
                            Total Penalty Charges
                        </p>
                        <h3 class="text-[23px] font-black text-white font-heading transition-transform duration-500 group-hover:scale-105 origin-left leading-tight whitespace-nowrap">
                            <span class="text-[15px] opacity-90">Rp</span> {{ number_format(\App\Models\UserFineBalance::getTotalGlobalFine(), 0, ',', '.') }}<br> 
                             <span class="italic font-bold opacity-95 text-[18.5px]">Unpaid Fines</span>
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
                
                <div class="flex flex-col gap-10 transform -translate-y-2"> 
                    <section class="space-y-4">
                        <div class="flex items-end justify-between px-2">
                            <div class="relative">
                                <h4 class="text-4xl font-extrabold tracking-tighter font-heading pb-1 -mb-1 pr-4 inline-block text-transparent bg-clip-text bg-gradient-to-r from-slate-900 via-blue-600 to-cyan-500 transform-gpu" 
                                    style="
                                        -webkit-background-clip: text; 
                                        -webkit-text-fill-color: transparent;
                                        backface-visibility: hidden;
                                    ">
                                    Books Collection
                                </h4>
                                <div class="flex items-center gap-2.5 mt-2">
                                    <span class="w-8 h-1 bg-cyan-500 rounded-full shadow-[0_0_10px_rgba(6,182,212,0.3)]"></span>
                                    
                                    <p class="text-cyan-600 font-black text-[10px] uppercase tracking-[0.2em] font-accent leading-none">
                                        Manage and monitor all physical and digital assets in the library.
                                    </p>
                                </div>
                            </div>
                            <button onclick="window.location.href='{{ route('admin.books') }}'" class="group relative isolate overflow-hidden bg-white border border-slate-200 px-6 py-3 rounded-2xl text-blue-600 font-bold text-[10px] 
                                hover:text-white hover:-translate-y-1.5 hover:shadow-xl hover:shadow-blue-500/30 
                                transition-all duration-500 ease-[cubic-bezier(0.4,0,0.2,1)] 
                                flex items-center gap-2 uppercase tracking-widest font-accent shadow-sm shadow-blue-100/50">
                                
                                <div class="absolute inset-0 -z-10 bg-gradient-to-r from-blue-600 to-cyan-500 opacity-0 group-hover:opacity-100 transition-opacity duration-500 ease-in-out"></div>

                                <span class="relative z-10">View All Records</span>
                                
                                <span class="material-icons-round text-sm group-hover:translate-x-1 transition-transform duration-500">arrow_forward</span> 
                            </button>
                        </div>

                        
                        <div class="section-container hover-blue group relative isolate !mt-12">
                            {{-- Glow Edge Effect --}}
                            <div class="glow-edge absolute inset-x-0 top-0 h-px bg-gradient-to-r from-transparent via-blue-400/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-700 z-10"></div>
                            
                            {{-- Overlay Background --}}
                            <div class="absolute inset-0 bg-white/10 transition-colors duration-700 ease-in-out group-hover:bg-white/20 -z-10"></div>

                           <div class="flex items-center gap-6 px-5 mb-6 relative z-20 -top-[11px]">
                                {{-- Spacer Kiri --}}
                                <div class="w-14 flex-shrink-0"></div> 

                                <div class="flex-grow grid grid-cols-4 items-center gap-6">
                                    {{-- 1. Books Title --}}
                                    <div class="flex items-center gap-2 group/item cursor-default w-fit transform -translate-x-[35px]">
                                        <div class="flex items-center justify-center w-6 h-6 rounded-md bg-blue-500 text-white shadow-md shadow-blue-500/20 shrink-0 transition-all duration-500 ease-in-out group-hover/item:rotate-12 group-hover/item:scale-110">
                                            <span class="material-symbols-outlined text-[14px] font-bold">book</span>
                                        </div>
                                        <span class="font-accent text-[10px] font-black uppercase tracking-[0.2em] text-blue-600/60 leading-none whitespace-nowrap">
                                            Books Title
                                        </span>
                                    </div>

                                    {{-- 2. Books Author --}}
                                    <div class="flex items-center gap-2 group/item cursor-default w-fit transform translate-x-[33px]">
                                        <div class="flex items-center justify-center w-6 h-6 rounded-md bg-blue-500 text-white shadow-md shadow-blue-500/20 shrink-0 transition-all duration-500 ease-in-out group-hover/item:rotate-12 group-hover/item:scale-110">
                                            <span class="material-symbols-outlined text-[14px] font-bold">person_edit</span>
                                        </div>
                                        <span class="font-accent text-[10px] font-black uppercase tracking-[0.2em] text-blue-600/60 leading-none whitespace-nowrap">
                                            Books Author
                                        </span>
                                    </div>

                                    {{-- 3. Books Category --}}
                                    <div class="flex items-center gap-2 group/item cursor-default w-fit transform translate-x-[20px]">
                                        <div class="flex items-center justify-center w-6 h-6 rounded-md bg-blue-500 text-white shadow-md shadow-blue-500/20 shrink-0 transition-all duration-500 ease-in-out group-hover/item:rotate-12 group-hover/item:scale-110">
                                            <span class="material-symbols-outlined text-[14px] font-bold">category</span>
                                        </div>
                                        <span class="font-accent text-[10px] font-black uppercase tracking-[0.2em] text-blue-600/60 leading-none whitespace-nowrap">
                                            Books Category
                                        </span>
                                    </div>

                                    {{-- 4. Books Pages --}}
                                    <div class="flex items-center gap-2 group/item cursor-default w-fit transform translate-x-[33px]">
                                        <div class="flex items-center justify-center w-6 h-6 rounded-md bg-blue-500 text-white shadow-md shadow-blue-500/20 shrink-0 transition-all duration-500 ease-in-out group-hover/item:rotate-12 group-hover/item:scale-110">
                                            <span class="material-symbols-outlined text-[14px] font-bold">auto_stories</span>
                                        </div>
                                        <span class="font-accent text-[10px] font-black uppercase tracking-[0.2em] text-blue-600/60 leading-none whitespace-nowrap">
                                            Books Pages
                                        </span>
                                    </div>
                                </div>

                                {{-- 5. Action Button (Diperbaiki agar tidak enter) --}}
                                <div class="w-[140px] flex justify-center">
                                    <div class="flex items-center gap-2 group/item cursor-default w-fit transform translate-x-[18px]">
                                        <div class="flex items-center justify-center w-6 h-6 rounded-md bg-blue-500 text-white shadow-md shadow-blue-500/20 shrink-0 transition-all duration-500 ease-in-out group-hover/item:rotate-12 group-hover/item:scale-110">
                                            <span class="material-symbols-outlined text-[14px] font-bold">settings_suggest</span>
                                        </div>
                                        <span class="font-accent text-[10px] font-black uppercase tracking-[0.2em] text-blue-600/60 leading-none whitespace-nowrap">
                                            Action
                                        </span>
                                    </div>
                                </div>
                            </div>  


                            @forelse(\App\Models\Book::orderBy('id', 'desc')->limit(10)->get() as $book)
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
                                // Menambahkan variabel style agar shadow mengikuti warna kategori (dinamis)
                                $style = "--shadow-color: {$clr['shadow']}; --shadow-deep: {$clr['shadow_deep']};";
                            @endphp

                                <div class="admin-row-card bg-white rounded-[2.5rem] border-l-4 {{ $clr['border_l'] }} border border-slate-200 py-4 px-4 md:px-5 flex flex-col md:flex-row items-center gap-1 loan-item group/returned-card shadow-sm transition-all duration-500 transform-gpu 
                                    hover:-translate-y-[0.375rem]
                                    hover:shadow-[0_0_20px_rgba(37,99,235,0.2),0_15px_30px_-15px_rgba(0,0,0,0.1)]"
                                    style="{{ $style }}">

                                <div class="w-14 h-20 ml-2 flex-shrink-0 rounded-xl overflow-hidden shadow-md transition-all duration-500 transform transform-gpu
                                    -translate-x-1 -rotate-3 border border-slate-200 bg-white
                                    
                                    /* Tahap 1: Hover pada Card - Shadow Blue 0.25 (Sesuai rasio Indigo 0.25 di History) */
                                    group-hover/returned-card:rotate-0 
                                    group-hover/returned-card:translate-x-0 
                                    group-hover/returned-card:scale-105
                                    group-hover/returned-card:border-blue-400/80
                                    group-hover/returned-card:shadow-[0_0_15px_rgba(37,99,235,0.25),0_8px_15px_-5px_rgba(0,0,0,0.15)]
                                    
                                    /* Tahap 2: Hover tepat pada area Buku - Shadow Blue 0.35 (Sesuai rasio Indigo 0.35 di History) */
                                    hover:!rotate-[1.5deg] 
                                    hover:!scale-110 
                                    hover:!shadow-[0_4px_10px_rgba(37,99,235,0.35),0_2px_5px_rgba(0,0,0,0.1)]
                                    cursor-pointer">
                                    
                                    <img alt="{{ $book->title }}" class="w-full h-full object-cover" src="{{ asset($book->cover_image) }}" 
                                        onerror="this.src='https://via.placeholder.com/150x225?text=No+Cover'"/>
                                </div>

                                    <div class="flex-grow grid grid-cols-4 -ml-2 items-center gap-6">
                                        <div class="min-w-0 overflow-visible"> <h3 class="font-black text-xl tracking-tighter font-heading leading-[1.2] py-2 -my-2 line-clamp-2 transform-gpu max-w-[12rem]" 
                                            style="
                                                backface-visibility: hidden;
                                                background-image: linear-gradient(to right, #2563eb 5%, #06b6d4 95%);
                                                -webkit-background-clip: text;
                                                -webkit-text-fill-color: transparent;
                                                /* Memberikan sedikit padding extra di dalam klip teks */
                                                padding-bottom: 0.1em;
                                                margin-bottom: -0.1em;
                                            "
                                            title="{{ $book->title }}">
                                            {{ $book->title }}
                                        </h3>   
                                    </div>
                                    <div class="min-w-0 flex flex-col items-center -ml-6">
                                                    <p class="text-[11px] text-blue-500/60 font-black font-accent uppercase tracking-[0.15em] italic line-clamp-2 leading-tight max-w-[12rem] text-center"
                                                    title="{{ $book->author_name }}">
                                                        {{ $book->author_name }}
                                                    </p>

                                                    {{-- 3. Garis Underline dengan Logika State --}}
                                        <span class="w-10 h-[2px] bg-blue-500/60 rounded-full flex-shrink-0 mt-1.5
                                            transition-transform duration-700 [transition-timing-function:cubic-bezier(0.34,1.56,0.64,1)] 
                                            
                                            group-hover:scale-x-[1.5] 
                                            group-hover/returned-card:!scale-x-[2.5] 
                                            
                                            origin-center 
                                            
                                            transform-gpu will-change-transform [backface-visibility:hidden]">
                                        </span>
                                    </div>

                                    @php
                                        // 1. Definisi 5 skema warna (Presisi sesuai config JS Anda)
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

                                    <div class="min-w-[145px] w-fit max-w-[160px] flex-shrink-0 mx-auto -translate-x-8">
                                        {{-- Badge Kategori: Presisi 100% mengikuti instruksi radius & shadow --}}
                                        <div class="flex items-center justify-center gap-2 px-3 py-1.5 rounded-xl border transition-all duration-500 cursor-pointer group/category-badge
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
                                            
                                            {{-- Efek BG Level 600 saat kursor di area kategori --}}
                                            @if(str_contains($clr['hover_bg'], 'blue')) hover:!bg-blue-600 @endif
                                            @if(str_contains($clr['hover_bg'], 'rose')) hover:!bg-rose-600 @endif
                                            @if(str_contains($clr['hover_bg'], 'emerald')) hover:!bg-emerald-600 @endif
                                            @if(str_contains($clr['hover_bg'], 'amber')) hover:!bg-amber-600 @endif
                                            @if(str_contains($clr['hover_bg'], 'violet')) hover:!bg-violet-600 @endif"
                                            
                                            style="--shadow-color: {{ $clr['shadow'] }}; --shadow-deep: {{ $clr['shadow_deep'] }};">
                                            
                                            {{-- ICON: Rotate & Geser Kanan --}}
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
                                                category
                                            </span>
                                            
                                            {{-- TEXT KATEGORI --}}
                                            <span class="text-[11px] font-black font-modern uppercase tracking-tighter tabular-nums leading-none whitespace-nowrap truncate">
                                                {{ $book->category_name }}
                                            </span>
                                        </div>
                                    </div>
                                    @php
                                        $durationColors = [
                                            ['bg' => 'bg-blue-500',    'text_top' => 'text-blue-600/70',    'text_hover' => 'group-hover/returned:text-blue-500',    'shadow' => 'rgba(37,99,235,0.4)',  'shadow_deep' => 'rgba(37,99,235,0.45)'],
                                            ['bg' => 'bg-rose-500',    'text_top' => 'text-rose-600/70',    'text_hover' => 'group-hover/returned:text-rose-500',    'shadow' => 'rgba(225,29,72,0.4)',  'shadow_deep' => 'rgba(225,29,72,0.45)'],
                                            ['bg' => 'bg-violet-500',  'text_top' => 'text-violet-600/70',  'text_hover' => 'group-hover/returned:text-violet-500',  'shadow' => 'rgba(124,58,237,0.4)', 'shadow_deep' => 'rgba(124,58,237,0.45)'],
                                            ['bg' => 'bg-emerald-500', 'text_top' => 'text-emerald-600/70', 'text_hover' => 'group-hover/returned:text-emerald-500', 'shadow' => 'rgba(16,185,129,0.4)', 'shadow_deep' => 'rgba(16,185,129,0.45)'],
                                            ['bg' => 'bg-amber-500',   'text_top' => 'text-amber-600/70',   'text_hover' => 'group-hover/returned:text-amber-500',   'shadow' => 'rgba(245,158,11,0.4)',  'shadow_deep' => 'rgba(245,158,11,0.45)'],
                                            ['bg' => 'bg-slate-500',   'text_top' => 'text-slate-600/70',   'text_hover' => 'group-hover/returned:text-slate-500',   'shadow' => 'rgba(30,41,59,0.4)',   'shadow_deep' => 'rgba(30,41,59,0.45)'],
                                            ['bg' => 'bg-indigo-500',  'text_top' => 'text-indigo-600/70',  'text_hover' => 'group-hover/returned:text-indigo-500',  'shadow' => 'rgba(79,70,229,0.4)',  'shadow_deep' => 'rgba(79,70,229,0.45)'],
                                        ];
                                        $clr = $durationColors[$loop->index % count($durationColors)];
                                        $style = "--shadow-color: {$clr['shadow']}; --shadow-deep: {$clr['shadow_deep']};";
                                    @endphp

                                    {{-- WRAPPER UTAMA: Efek Hover Naik (Translate-Y) --}}
                                    <div class="text-center w-[145px] flex flex-col items-center group/returned transition-all duration-700 ease-[cubic-bezier(0.4,0,0.2,1)] transform-gpu hover:-translate-y-1 -translate-x-2">

                                        <div class="w-full">
                                            {{-- CARD UTAMA: Efek Zoom & Shadow Rapat --}}
                                            <div class="flex items-center px-4 h-9 rounded-full {{ $clr['bg'] }} text-white transition-all duration-700 ease-[cubic-bezier(0.4,0,0.2,1)] w-full justify-center border-none cursor-default transform-gpu 
                                                /* TAHAP 1: Shadow Normal (0.4) */
                                                shadow-[0_4px_12px_var(--shadow-color)] 
                                                
                                                /* TAHAP 2: Zoom 105% & Shadow Lebih Rapat (0.45) */
                                                group-hover/returned:scale-105 
                                                group-hover/returned:shadow-[0_6px_16px_var(--shadow-deep)]"
                                                style="{{ $style }}">
                                                
                                                <p class="text-[12px] font-black font-modern uppercase tracking-tighter tabular-nums leading-none whitespace-nowrap">
                                                    {{ $book->total_pages }} 
                                                </p>
                                            </div>
                                        </div>
                                    </div>


                                </div>

                                <div class="flex items-center gap-2 pr-2">
                                    <a href="{{ route('admin.books', ['edit_book' => $book->id]) }}" onclick="console.log('Navigasi ke: ' + this.href)"
                                    class="group/edit-btn w-10 h-10 flex items-center justify-center bg-blue-600 text-white rounded-xl transition-all duration-300 transform-gpu cursor-pointer
                                        /* TAHAP 1: Shadow Fokus (8px) */
                                        shadow-[0_4px_8px_rgba(37,99,235,0.35)] 
                                        
                                        /* TAHAP 2: Hover (Naik, BG, Shadow Rapat 12px) */
                                        hover:-translate-y-1 hover:bg-blue-500 
                                        hover:shadow-[0_6px_12px_rgba(37,99,235,0.45)] 
                                        active:scale-95">
                                        <span class="material-symbols-outlined text-[20px] transition-transform duration-300 group-hover/edit-btn:-rotate-12">
                                            edit
                                        </span>
                                    </a>

                                    <form action="{{ route('admin.books.destroy', $book->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus buku {{ $book->title }}? Tindakan ini tidak dapat dibatalkan.')"
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
                                        folder_open
                                    </span>
                                    <p class="text-slate-400 font-accent uppercase tracking-[0.2em] text-xs font-black">
                                        No <span class="text-[#2b6cee]/80">Books Found</span> in Library.
                                    </p>
                                </div>
                            @endforelse
                        </div>
                    </section>

                    <div class="pt-1 ">
                        <div class="w-full h-[1.5px] bg-slate-400/30 rounded-full"></div>
                    </div>

                    <section class="space-y-4">
                        <div class="flex items-end justify-between px-2">
                            <div class="relative">
                                {{-- H4: Menggunakan Model Font & Gradient Indigo-Purple (Sama Persis Plek Ketiplek) --}}
                                <h4 class="text-4xl font-extrabold tracking-tighter font-heading pb-1 -mb-1 pr-4 inline-block text-transparent bg-clip-text bg-gradient-to-r from-slate-900 via-indigo-600 to-purple-500 transform-gpu" 
                                    style="
                                        -webkit-background-clip: text; 
                                        -webkit-text-fill-color: transparent;
                                        backface-visibility: hidden;
                                    ">
                                    User Management
                                </h4>

                                <div class="flex items-center gap-2.5 mt-2">
                                    {{-- Garis: Ukuran w-8 h-1 dengan Shadow Indigo --}}
                                    <span class="w-8 h-1 bg-indigo-500 rounded-full shadow-[0_0_10px_rgba(99,102,241,0.3)]"></span>
                                    
                                    {{-- P: Font Black, Text 10px, Uppercase, Tracking 0.2em --}}
                                    <p class="text-indigo-600 font-black text-[10px] uppercase tracking-[0.2em] font-accent leading-none">
                                        Review active student accounts and library membership roles.
                                    </p>
                                </div>
                            </div>

                            {{-- Button: Model, Hover, Shadow, dan Gradient Indigo-Purple (Tanpa Perbedaan Sedikitpun) --}}
                            <button onclick="window.location.href='{{ route('admin.members') }}'" class="group relative isolate overflow-hidden bg-white border border-slate-200 px-6 py-3 rounded-2xl text-indigo-600 font-bold text-[10px] 
                                hover:text-white hover:-translate-y-1.5 hover:shadow-xl hover:shadow-indigo-500/30 
                                transition-all duration-500 ease-[cubic-bezier(0.4,0,0.2,1)] 
                                flex items-center gap-2 uppercase tracking-widest font-accent shadow-sm shadow-indigo-100/50">
                                
                                {{-- Efek Gradient Background saat Hover --}}
                                <div class="absolute inset-0 -z-10 bg-gradient-to-r from-indigo-600 to-purple-500 opacity-0 group-hover:opacity-100 transition-opacity duration-500 ease-in-out"></div>

                                <span class="relative z-10">See All Library User</span>
                                
                                {{-- Icon dengan efek translasi --}}
                                <span class="material-icons-round text-sm group-hover:translate-x-1 transition-transform duration-500">arrow_forward</span> 
                            </button>
                        </div>



                        <div class="section-container hover-indigo group relative isolate !mt-12">
                            {{-- Glow Edge Effect --}}
                            <div class="glow-edge absolute inset-x-0 top-0 h-px bg-gradient-to-r from-transparent via-indigo-400/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-700 z-10"></div>
                            <div class="absolute inset-0 bg-white/10 transition-colors duration-700 ease-in-out group-hover:bg-white/20 -z-10"></div>



                            <div class="flex items-center gap-6 px-5 mb-6 relative z-20 -top-[11px]">
                            <div class="w-14 flex-shrink-0"></div> 
                            <div class="flex-grow grid grid-cols-3 items-center gap-6">
                                {{-- 1. User Identity --}}
                                <div class="flex items-center gap-2 group/item cursor-default w-fit transform -translate-x-[53px]">
                                    <div class="flex items-center justify-center w-6 h-6 rounded-md bg-indigo-500 text-white shadow-md shadow-indigo-500/20 shrink-0 transition-all duration-500 ease-in-out group-hover/item:rotate-12 group-hover/item:scale-110">
                                        <span class="material-symbols-outlined text-[14px] font-bold">badge</span>
                                    </div>
                                    <span class="font-accent text-[10px] font-black uppercase tracking-[0.2em] text-indigo-600/60 leading-none whitespace-nowrap">
                                        User Identity
                                    </span>
                                </div>

                                {{-- 2. Email --}}
                                <div class="flex items-center gap-2 group/item cursor-default w-fit transform translate-x-[18px]">
                                    <div class="flex items-center justify-center w-6 h-6 rounded-md bg-indigo-500 text-white shadow-md shadow-indigo-500/20 shrink-0 transition-all duration-500 ease-in-out group-hover/item:rotate-12 group-hover/item:scale-110">
                                        <span class="material-symbols-outlined text-[14px] font-bold">mail</span>
                                    </div>
                                    <span class="font-accent text-[10px] font-black uppercase tracking-[0.2em] text-indigo-600/60 leading-none whitespace-nowrap">
                                        Email
                                    </span>
                                </div>

                                {{-- 3. Role --}}
                                <div class="flex items-center gap-2 group/item cursor-default w-fit transform translate-x-[60px]">
                                    <div class="flex items-center justify-center w-6 h-6 rounded-md bg-indigo-500 text-white shadow-md shadow-indigo-500/20 shrink-0 transition-all duration-500 ease-in-out group-hover/item:rotate-12 group-hover/item:scale-110">
                                        <span class="material-symbols-outlined text-[14px] font-bold">manage_accounts</span>
                                    </div>
                                    <span class="font-accent text-[10px] font-black uppercase tracking-[0.2em] text-indigo-600/60 leading-none whitespace-nowrap">
                                        Role
                                    </span>
                                </div>
                            </div>

                            {{-- 4. Action --}}
                            <div class="w-[140px] flex justify-center">
                                <div class="flex items-center gap-2 group/item cursor-default w-fit transform translate-x-[18px]">
                                    <div class="flex items-center justify-center w-6 h-6 rounded-md bg-indigo-500 text-white shadow-md shadow-indigo-500/20 shrink-0 transition-all duration-500 ease-in-out group-hover/item:rotate-12 group-hover/item:scale-110">
                                        <span class="material-symbols-outlined text-[14px] font-bold">settings_suggest</span>
                                    </div>
                                    <span class="font-accent text-[10px] font-black uppercase tracking-[0.2em] text-indigo-600/60 leading-none whitespace-nowrap">
                                        Action
                                    </span>
                                </div>
                            </div>
                        </div>



                        @forelse($allUsers as $user)
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
                                // Menambahkan variabel style agar shadow mengikuti warna kategori (dinamis)
                                $style = "--shadow-color: {$clr['shadow']}; --shadow-deep: {$clr['shadow_deep']};";
                            @endphp

                            <div class="admin-row-card bg-white rounded-[2.5rem] border-l-4 {{ $clr['border_l'] }} border border-slate-200 py-4 px-4 md:px-5 flex flex-col md:flex-row items-center gap-1 loan-item group/returned-card shadow-sm transition-all duration-500 transform-gpu 
                                hover:-translate-y-[0.375rem]
                                hover:shadow-[0_0_20px_rgba(79,70,229,0.2),0_15px_30px_-15px_rgba(0,0,0,0.1)]"
                                style="{{ $style }}">

                

            
                                        {{-- Bagian Foto Profile / Inisial --}}
                                        <div class="relative group/profile w-12 h-12 flex-shrink-0 transition-all duration-700 ease-[cubic-bezier(0.34,1.56,0.64,1)]
                                            hover:scale-110">
                                            
                                            {{-- Kontainer Utama --}}
                                            <div class="absolute inset-0 rounded-full bg-slate-100 border-2 border-white shadow-lg overflow-hidden flex items-center justify-center 
                                                {{-- Kondisi Default --}}
                                                -rotate-6 translate-x-0
                                                
                                                {{-- Tahap 1: Hover di area Card --}}
                                                group-hover/returned-card:rotate-0 
                                                group-hover/returned-card:scale-105 
                                                group-hover/returned-card:translate-x-2
                                                group-hover/returned-card:shadow-[0_10px_20px_-2px_rgba(79,70,229,0.25)]
                                                
                                                {{-- Tahap 2: Efek tambahan pada Shadow saat kursor di area Profile --}}
                                                group-hover/profile:shadow-[0_12px_25px_-5px_rgba(67,56,202,0.45)]
                                                
                                                {{-- Animasi --}}
                                                transition-all duration-700 ease-[cubic-bezier(0.34,1.56,0.64,1)]">

                                                @if($user->foto_profile)
                                                    <img src="{{ asset('storage/' . $user->foto_profile) }}" 
                                                        class="w-full h-full object-cover" 
                                                        alt="{{ $user->username }}">
                                                @else
                                                    <div class="w-full h-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold text-[10px]">
                                                        {{ strtoupper(substr($user->username, 0, 2)) }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        {{-- Grid Info User --}}
                                        <div class="flex-grow grid grid-cols-3 items-center gap-6">
                                            <span class="font-black text-xl tracking-tighter font-heading leading-[1.2] py-2 -my-2 transform-gpu inline-block" 
                                                style="
                                                    backface-visibility: hidden;
                                                    /* Gradasi Indigo-600 ke Indigo-400 yang lebih terang */
                                                    background-image: linear-gradient(to right, #4f46e5 5%, #818cf8 95%);
                                                    -webkit-background-clip: text;
                                                    -webkit-text-fill-color: transparent;
                                                    padding-bottom: 0.1em;
                                                    margin-bottom: -0.1em;
                                                    white-space: nowrap;
                                                "
                                                title="{{ $user->username }}">
                                                {{ $user->username }}
                                            </span>
                                            
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

                                            <div class="group/badge justify-self-center relative -left-[104px] flex items-center gap-2 px-3 py-1.5 rounded-full border {{ $clr['bg'] }} {{ $clr['border'] }} {{ $clr['text'] }} w-fit cursor-pointer transform-gpu
                                                /* TAHAP 1: Dasar (Shadow Hitam) - Plek Ketiplek */
                                                shadow-[0_2px_8px_rgba(0,0,0,0.12)] 
                                                
                                                /* TRANSISI - Plek Ketiplek */
                                                transition-all duration-700 ease-[cubic-bezier(0.25,0.1,0.25,1)]

                                                /* TAHAP 2: Hover Card (Shadow Berwarna & Skala 105) - Plek Ketiplek */
                                                {{ $clr['hover_bg'] }}
                                                group-hover/returned-card:text-white 
                                                group-hover/returned-card:border-transparent 
                                                group-hover/returned-card:scale-105 
                                                group-hover/returned-card:shadow-[0_4px_12px_rgba(0,0,0,0.08),0_2px_14px_var(--shadow-color)]

                                                /* TAHAP 3: Hover Badge (Shadow Deep & Skala 110) - Plek Ketiplek */
                                                hover:!scale-110 
                                                hover:-translate-y-1 
                                                hover:!shadow-[0_5px_12px_var(--shadow-deep)] 
                                                
                                                active:scale-95"
                                                style="{{ $style }}">
                                                
                                                <span class="material-symbols-outlined text-[14px] transition-all duration-700 ease-[cubic-bezier(0.25,0.1,0.25,1)] group-hover/badge:rotate-12 group-hover/badge:translate-x-1">
                                                    mail
                                                </span>

                                                <span class="text-[10px] font-black font-accent uppercase tracking-wider tabular-nums leading-none">
                                                    {{ $user->email }}
                                                </span>
                                            </div>

                                            
                                            @php
                                                $durationColors = [
                                                    ['bg' => 'bg-blue-500',    'text_top' => 'text-blue-600/70',    'text_hover' => 'group-hover/returned:text-blue-500',    'shadow' => 'rgba(37,99,235,0.4)',  'shadow_deep' => 'rgba(37,99,235,0.45)'],
                                                    ['bg' => 'bg-rose-500',    'text_top' => 'text-rose-600/70',    'text_hover' => 'group-hover/returned:text-rose-500',    'shadow' => 'rgba(225,29,72,0.4)',  'shadow_deep' => 'rgba(225,29,72,0.45)'],
                                                    ['bg' => 'bg-violet-500',  'text_top' => 'text-violet-600/70',  'text_hover' => 'group-hover/returned:text-violet-500',  'shadow' => 'rgba(124,58,237,0.4)', 'shadow_deep' => 'rgba(124,58,237,0.45)'],
                                                    ['bg' => 'bg-emerald-500', 'text_top' => 'text-emerald-600/70', 'text_hover' => 'group-hover/returned:text-emerald-500', 'shadow' => 'rgba(16,185,129,0.4)', 'shadow_deep' => 'rgba(16,185,129,0.45)'],
                                                    ['bg' => 'bg-amber-500',   'text_top' => 'text-amber-600/70',   'text_hover' => 'group-hover/returned:text-amber-500',   'shadow' => 'rgba(245,158,11,0.4)',  'shadow_deep' => 'rgba(245,158,11,0.45)'],
                                                    ['bg' => 'bg-slate-500',   'text_top' => 'text-slate-600/70',   'text_hover' => 'group-hover/returned:text-slate-500',   'shadow' => 'rgba(30,41,59,0.4)',   'shadow_deep' => 'rgba(30,41,59,0.45)'],
                                                    ['bg' => 'bg-indigo-500',  'text_top' => 'text-indigo-600/70',  'text_hover' => 'group-hover/returned:text-indigo-500',  'shadow' => 'rgba(79,70,229,0.4)',  'shadow_deep' => 'rgba(79,70,229,0.45)'],
                                                ];
                                                $clr = $durationColors[$loop->index % count($durationColors)];
                                                $style = "--shadow-color: {$clr['shadow']}; --shadow-deep: {$clr['shadow_deep']};";
                                            @endphp

                                            {{-- WRAPPER UTAMA: Efek Hover Naik (Translate-Y) --}}
                                            <div class="text-center w-[145px] flex flex-col items-center group/returned transition-all duration-700 ease-[cubic-bezier(0.4,0,0.2,1)] transform-gpu hover:-translate-y-1 -translate-x-2">

                                                <div class="w-full">
                                                    {{-- CARD UTAMA: Efek Zoom & Shadow Rapat --}}
                                                    <div class="flex items-center px-4 h-8 rounded-full {{ $clr['bg'] }} text-white transition-all duration-700 ease-[cubic-bezier(0.4,0,0.2,1)] w-full justify-center border-none cursor-default transform-gpu 
                                                        /* TAHAP 1: Shadow Normal (0.4) */
                                                        shadow-[0_4px_12px_var(--shadow-color)] 
                                                        
                                                        /* TAHAP 2: Zoom 105% & Shadow Lebih Rapat (0.45) */
                                                        group-hover/returned:scale-105 
                                                        group-hover/returned:shadow-[0_6px_16px_var(--shadow-deep)]"
                                                        style="{{ $style }}">
                                                        
                                                        <p class="text-[12px] font-black font-modern uppercase tracking-tighter tabular-nums leading-none whitespace-nowrap flex items-center gap-2">
                                                            @if($user->role === 'admin')
                                                                Administrator
                                                                <span class="material-symbols-outlined text-[14px] transition-all duration-700 ease-[cubic-bezier(0.25,0.1,0.25,1)] group-hover/returned:-rotate-12 group-hover/returned:-translate-x-1">
                                                                    shield_person
                                                                </span>
                                                            @else
                                                                Library Student
                                                                <span class="material-symbols-outlined text-[14px] transition-all duration-700 ease-[cubic-bezier(0.25,0.1,0.25,1)] group-hover/returned:-rotate-12 group-hover/returned:-translate-x-1">
                                                                    local_library
                                                                </span>
                                                            @endif
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>



                                        {{-- Tombol Aksi --}}
                                        <div class="flex items-center gap-2 pr-2">
                                            <a href="{{ route('admin.members', ['edit_member' => $user->user_id]) }}"
                                            class="group/edit-btn w-10 h-10 flex items-center justify-center bg-indigo-600 text-white rounded-2xl transition-all duration-300 transform-gpu cursor-pointer
                                                /* TAHAP 1: Shadow Fokus (8px) */
                                                shadow-[0_4px_8px_rgba(79,70,229,0.35)]
                                                
                                                /* TAHAP 2: Hover (Naik, BG, Shadow Rapat 12px) */
                                                hover:-translate-y-1 hover:bg-indigo-500 
                                                hover:shadow-[0_6px_12px_rgba(79,70,229,0.45)]
                                                active:scale-95">
                                                <span class="material-symbols-outlined text-[20px] transition-transform duration-300 group-hover/edit-btn:-rotate-12">
                                                    edit
                                                </span>
                                            </a>

                                            <form id="delete-form-{{ $user->user_id }}" 
                                                action="{{ route('admin.members.destroy', $user->user_id) }}" 
                                                method="POST" 
                                                style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>

                                            <button onclick="if(confirm('Apakah Anda yakin ingin menghapus user {{ $user->username }} secara permanen?')) { document.getElementById('delete-form-{{ $user->user_id }}').submit(); }"
                                            class="group/del-btn w-10 h-10 flex items-center justify-center bg-rose-600 text-white rounded-2xl transition-all duration-300 transform-gpu cursor-pointer
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
                                        </div>
                                    </div>
                                @empty
                                   <div class="col-span-full py-24 flex flex-col items-center justify-center w-full">
                                        <span class="material-symbols-outlined text-slate-200 text-7xl mb-4 select-none">
                                            person_search
                                        </span>
                                        <p class="text-slate-400 font-accent uppercase tracking-[0.2em] text-xs font-black">
                                            No <span class="text-indigo-600/80">Users Found</span> in System.
                                        </p>
                                    </div>
                                @endforelse
                            </div>
                    </section>


                    <div class="pt-1 ">
                        <div class="w-full h-[1.5px] bg-slate-400/30 rounded-full"></div>
                    </div>
                    

                    <section class="space-y-4">
                        <div class="flex items-end justify-between px-2">
                            <div class="relative">
                                <div class="flex items-center gap-1">
                                    {{-- H4: Model Font & Gradient Emerald-Teal Plek Ketiplek --}}
                                    <h4 class="text-4xl font-extrabold tracking-tighter font-heading pb-1 -mb-1 pr-4 inline-block text-transparent bg-clip-text bg-gradient-to-r from-slate-900 via-emerald-600 to-teal-500 transform-gpu" 
                                        style="
                                            -webkit-background-clip: text; 
                                            -webkit-text-fill-color: transparent;
                                            backface-visibility: hidden;
                                        ">
                                        Transaction Approval
                                    </h4>
                                    
                                    <div class="flex items-center gap-3 group cursor-default w-fit relative -top-[8px]">
                                        {{-- Icon Box: Ukuran dikecilkan sedikit (w-10 -> w-9) --}}
                                        <div class="flex items-center justify-center w-9 h-9 rounded-xl bg-emerald-500 text-white shadow-lg shadow-emerald-500/20 shrink-0 transition-all duration-300 group-hover:rotate-12 group-hover:scale-110">
                                            <span class="material-symbols-outlined text-[18px]">
                                                order_approve
                                            </span>
                                        </div>

                                        <div class="flex flex-col justify-center">
                                            {{-- Label Atas: Tetap sama (9px sudah sangat kecil) --}}
                                            <span class="font-accent text-[9px] font-black uppercase tracking-[0.2em] text-emerald-600/60 leading-none mb-1">
                                                Total Request
                                            </span>
                                            
                                            <div class="flex items-center gap-2">
                                                {{-- Angka: Dikecilkan sedikit (3xl -> 2xl) --}}
                                                    <span class="font-heading font-black text-2xl leading-none text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 to-teal-500 drop-shadow-sm">
                                                        {{ $totalPendingCount }}
                                                    </span>
                                                    
                                                {{-- Label Samping: Dikecilkan sedikit (12px -> 11px) --}}
                                                <span class="font-modern text-[11px] font-bold text-slate-500 leading-none whitespace-nowrap">
                                                    Pending Requests
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex items-center gap-2.5 mt-2">
                                    {{-- Garis: w-8 h-1 dengan Shadow Emerald --}}
                                    <span class="w-8 h-1 bg-emerald-500 rounded-full shadow-[0_0_10px_rgba(16,185,129,0.3)]"></span>
                                    
                                    {{-- P: Font Black, Text 10px, Emerald-600 --}}
                                    <p class="text-emerald-600 font-black text-[10px] uppercase tracking-[0.2em] font-accent leading-none">
                                        Approve or reject book loan requests from members.
                                    </p>
                                </div>
                            </div>

                            {{-- Button: Model, Hover, Shadow, dan Gradient Emerald Sama Persis --}}
                            <button onclick="window.location.href='{{ route('admin.transactions') }}'" class="group relative isolate overflow-hidden bg-white border border-slate-200 px-6 py-3 rounded-2xl text-emerald-600 font-bold text-[10px] 
                                hover:text-white hover:-translate-y-1.5 hover:shadow-xl hover:shadow-emerald-500/30 
                                transition-all duration-500 ease-[cubic-bezier(0.4,0,0.2,1)] 
                                flex items-center gap-2 uppercase tracking-widest font-accent shadow-sm shadow-emerald-100/50">
                                
                                {{-- Layer Gradient Emerald saat Hover --}}
                                <div class="absolute inset-0 -z-10 bg-gradient-to-r from-emerald-600 to-teal-500 opacity-0 group-hover:opacity-100 transition-opacity duration-500 ease-in-out"></div>

                                <span class="relative z-10">View All Pending Transaction</span>
                                
                                <span class="material-icons-round text-sm group-hover:translate-x-1 transition-transform duration-500">arrow_forward</span> 
                            </button>
                        </div>

                        <div class="section-container hover-emerald group relative isolate !mt-12">
                            <div class="glow-edge absolute inset-x-0 top-0 h-px bg-gradient-to-r from-transparent via-emerald-400/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-700 z-10"></div>
                            <div class="absolute inset-0 bg-white/10 transition-colors duration-700 ease-in-out group-hover:bg-white/20 -z-10"></div>

                        
                            <div class="flex items-center gap-6 px-5 mb-6 relative z-20 -top-[11px]">
                            {{-- Spacer Kiri --}}
                            <div class="w-14 flex-shrink-0"></div> 

                            <div class="flex-grow grid grid-cols-4 items-center gap-6">
                                {{-- 1. Book Detail --}}
                                <div class="flex items-center gap-2 group/item cursor-default w-fit transform -translate-x-[35px]">
                                    <div class="flex items-center justify-center w-6 h-6 rounded-md bg-emerald-500 text-white shadow-md shadow-emerald-500/20 shrink-0 transition-all duration-500 ease-in-out group-hover/item:rotate-12 group-hover/item:scale-110">
                                        <span class="material-symbols-outlined text-[14px] font-bold">menu_book</span>
                                    </div>
                                    <span class="font-accent text-[10px] font-black uppercase tracking-[0.2em] text-emerald-600/60 leading-none whitespace-nowrap">
                                        Book Detail
                                    </span>
                                </div>

                                {{-- 2. Requester --}}
                                <div class="flex items-center gap-2 group/item cursor-default w-fit transform translate-x-[47px]">
                                    <div class="flex items-center justify-center w-6 h-6 rounded-md bg-emerald-500 text-white shadow-md shadow-emerald-500/20 shrink-0 transition-all duration-500 ease-in-out group-hover/item:rotate-12 group-hover/item:scale-110">
                                        <span class="material-symbols-outlined text-[14px] font-bold">person_search</span>
                                    </div>
                                    <span class="font-accent text-[10px] font-black uppercase tracking-[0.2em] text-emerald-600/60 leading-none whitespace-nowrap">
                                        Requester
                                    </span>
                                </div>

                                {{-- 3. Borrow Date --}}
                                <div class="flex items-center gap-2 group/item cursor-default w-fit transform translate-x-[35px]">
                                    <div class="flex items-center justify-center w-6 h-6 rounded-md bg-emerald-500 text-white shadow-md shadow-emerald-500/20 shrink-0 transition-all duration-500 ease-in-out group-hover/item:rotate-12 group-hover/item:scale-110">
                                        <span class="material-symbols-outlined text-[14px] font-bold">calendar_today</span>
                                    </div>
                                    <span class="font-accent text-[10px] font-black uppercase tracking-[0.2em] text-emerald-600/60 leading-none whitespace-nowrap">
                                        Borrow Date
                                    </span>
                                </div>

                                {{-- 4. Due Date --}}
                                <div class="flex items-center gap-2 group/item cursor-default w-fit transform translate-x-[46px]">
                                    <div class="flex items-center justify-center w-6 h-6 rounded-md bg-emerald-500 text-white shadow-md shadow-emerald-500/20 shrink-0 transition-all duration-500 ease-in-out group-hover/item:rotate-12 group-hover/item:scale-110">
                                        <span class="material-symbols-outlined text-[14px] font-bold">event_busy</span>
                                    </div>
                                    <span class="font-accent text-[10px] font-black uppercase tracking-[0.2em] text-emerald-600/60 leading-none whitespace-nowrap">
                                        Due Date
                                    </span>
                                </div>
                            </div>

                            {{-- 5. Action Button (SAMA PERSIS DENGAN REFERENSI) --}}
                            <div class="w-[140px] flex justify-center">
                                <div class="flex items-center gap-2 group/item cursor-default w-fit transform translate-x-[18px]">
                                    <div class="flex items-center justify-center w-6 h-6 rounded-md bg-emerald-500 text-white shadow-md shadow-emerald-500/20 shrink-0 transition-all duration-500 ease-in-out group-hover/item:rotate-12 group-hover/item:scale-110">
                                        <span class="material-symbols-outlined text-[14px] font-bold">settings_suggest</span>
                                    </div>
                                    <span class="font-accent text-[10px] font-black uppercase tracking-[0.2em] text-emerald-600/60 leading-none whitespace-nowrap">
                                        Action
                                    </span>
                                </div>
                            </div>
                        </div>


                            <div class="space-y-4">
                            @forelse($pendingTransactions as $transaction)
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
                                // Menambahkan variabel style agar shadow mengikuti warna kategori (dinamis)
                                $style = "--shadow-color: {$clr['shadow']}; --shadow-deep: {$clr['shadow_deep']};";
                            @endphp

                                <div class="admin-row-card bg-white rounded-[2.5rem] border-l-4 {{ $clr['border_l'] }} border border-slate-200 py-4 px-4 md:px-5 flex flex-col md:flex-row items-center gap-1 loan-item group/returned-card shadow-sm transition-all duration-500 transform-gpu 
                                    hover:-translate-y-[0.375rem]
                                    /* Shadow diubah ke Emerald dengan ketebalan 0.2 dan radius 20px (Sama persis dengan History) */
                                    hover:shadow-[0_0_20px_rgba(16,185,129,0.2),0_15px_30px_-15px_rgba(0,0,0,0.1)]"
                                    style="{{ $style }}">
                                    


                                
                                    {{-- Foto Cover Buku dengan Animasi Kompleks --}}
                                    <div class="w-14 h-20 ml-2 flex-shrink-0 rounded-xl overflow-hidden shadow-md transition-all duration-500 transform transform-gpu
                                                -translate-x-1 -rotate-3 border border-slate-200 bg-white
                                                
                                                /* Tahap 1: Hover pada Card - Shadow Emerald 0.25 */
                                                group-hover/returned-card:rotate-0 
                                                group-hover/returned-card:translate-x-0 
                                                group-hover/returned-card:scale-105
                                                group-hover/returned-card:border-emerald-400/80
                                                group-hover/returned-card:shadow-[0_0_15px_rgba(16,185,129,0.25),0_8px_15px_-5px_rgba(0,0,0,0.15)]
                                                
                                                /* Tahap 2: Hover tepat pada area Buku - Shadow Emerald 0.35 */
                                                hover:!rotate-[1.5deg] 
                                                hover:!scale-110 
                                                hover:!shadow-[0_4px_10px_rgba(16,185,129,0.35),0_2px_5px_rgba(0,0,0,0.1)]
                                                cursor-pointer">
                                                    
                                        @php
                                            // Logika untuk memastikan path gambar benar
                                            $imagePath = $transaction->book->cover_image ?? '';
                                            // Jika path tidak diawali 'http' dan tidak diawali 'storage', kita tambahkan asset()
                                            $finalUrl = str_contains($imagePath, 'http') ? $imagePath : asset('storage/' . $imagePath);
                                        @endphp

                                        <img alt="{{ $transaction->book->title ?? 'Cover' }}" 
                                            class="w-full h-full object-cover" 
                                            src="{{ $finalUrl }}" 
                                            onerror="this.onerror=null; this.src='https://via.placeholder.com/150x225?text=No+Cover'"/>
                                    </div>

                                    {{-- Grid Info Peminjaman --}}
                                    <div class="flex-grow grid grid-cols-4 -ml-2 items-center gap-6">
                                        
                                        {{-- Info Buku (Title & Author) --}}
                                        <div class="flex items-center gap-4 col-span-1">
                                            <div class="min-w-0 overflow-visible"> 
                                                <h3 class="font-black text-lg tracking-tighter font-heading leading-[1.2] py-2 -my-2 line-clamp-2 transform-gpu max-w-[10rem]" 
                                                    style="
                                                        backface-visibility: hidden;
                                                        background-image: linear-gradient(to right, #10b981 5%, #24e09a 95%);
                                                        -webkit-background-clip: text;
                                                        -webkit-text-fill-color: transparent;
                                                        padding-bottom: 0.1em;
                                                        margin-bottom: -0.1em;
                                                    "
                                                    title="{{ $transaction->book->title ?? 'Buku Tidak Ditemukan' }}">
                                                    {{ $transaction->book->title ?? 'Judul Tidak Ada' }}
                                                </h3>  

                                                <div class="flex flex-row items-center mt-1">
                                                    {{-- Garis Horizontal: Emerald Edition (Sama persis dengan model Blue) --}}
                                                    <span class="w-6 h-[2px] bg-emerald-500/60 rounded-full flex-shrink-0
                                                        transition-all duration-700 [transition-timing-function:cubic-bezier(0.34,1.56,0.64,1)] 
                                                        group-hover:scale-x-[1.2] 
                                                        group-hover/returned-card:!scale-x-[1.8] 
                                                        origin-left 
                                                        transform-gpu will-change-transform [backface-visibility:hidden]">
                                                    </span>

                                                    {{-- Tulisan Penulis: Emerald Edition --}}
                                                    <p class="text-[10px] text-emerald-500/60 font-black font-accent uppercase tracking-[0.15em] italic truncate leading-tight max-w-[10rem] flex-1 min-w-0 
                                                        transition-all duration-700 [transition-timing-function:cubic-bezier(0.34,1.56,0.64,1)]
                                                        ml-2 
                                                        group-hover:pl-2
                                                        group-hover/returned-card:!pl-6
                                                        transform-gpu"
                                                        title="{{ $transaction->book->author_name ?? 'Penulis' }}">
                                                        {{ $transaction->book->author_name ?? 'Unknown Author' }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="w-[145px] flex-shrink-0 ml-4">
                                            <div class="flex items-center justify-center gap-2 px-3 py-1.5 rounded-xl border transition-all duration-500 cursor-pointer group/category-badge
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
                                                
                                                {{-- Efek BG Level 600 saat kursor di area kategori --}}
                                                @if(str_contains($clr['hover_bg'], 'blue')) hover:!bg-blue-600 @endif
                                                @if(str_contains($clr['hover_bg'], 'rose')) hover:!bg-rose-600 @endif
                                                @if(str_contains($clr['hover_bg'], 'emerald')) hover:!bg-emerald-600 @endif
                                                @if(str_contains($clr['hover_bg'], 'amber')) hover:!bg-amber-600 @endif
                                                @if(str_contains($clr['hover_bg'], 'violet')) hover:!bg-violet-600 @endif"
                                                
                                                style="--shadow-color: {{ $clr['shadow'] }}; --shadow-deep: {{ $clr['shadow_deep'] }};">
                                                
                                                {{-- ICON: Rotate & Geser Kanan (Identik 100%) --}}
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
                                                    person
                                                </span>
                                                
                                                {{-- TEXT REQUESTER --}}
                                                <div class="flex flex-col min-w-0">
                                                    <span class="text-[13px] font-black font-modern tracking-tighter tabular-nums leading-none whitespace-nowrap truncate">
                                                        {{ $transaction->user->username ?? 'User' }}
                                                    </span>
                                                    <span class="text-[9px] font-bold uppercase opacity-80 leading-tight">
                                                        {{ $transaction->user->role ?? 'N/A' }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        @php
                                            $durationColors = [
                                                ['bg' => 'bg-rose-500',    'text_top' => 'text-rose-600/70',    'text_hover' => 'group-hover/returned:text-rose-500',    'shadow' => 'rgba(225,29,72,0.4)',  'shadow_deep' => 'rgba(225,29,72,0.45)'],
                                                ['bg' => 'bg-emerald-500', 'text_top' => 'text-emerald-600/70', 'text_hover' => 'group-hover/returned:text-emerald-500', 'shadow' => 'rgba(16,185,129,0.4)', 'shadow_deep' => 'rgba(16,185,129,0.45)'],
                                            ];
                                            // Card 1: Emerald (Loan Date)
                                            $clrEmerald = $durationColors[1];
                                            $styleEmerald = "--shadow-color: {$clrEmerald['shadow']}; --shadow-deep: {$clrEmerald['shadow_deep']};";
                                            
                                            // Card 2: Rose (Due Date)
                                            $clrRose = $durationColors[0];
                                            $styleRose = "--shadow-color: {$clrRose['shadow']}; --shadow-deep: {$clrRose['shadow_deep']};";
                                        @endphp

                                        {{-- Tanggal Pinjam: Emerald Edition (Plek Ketiplek 100%) --}}
                                        <div class="ml-4 text-center w-[145px] flex flex-col items-center group/returned transition-all duration-700 ease-[cubic-bezier(0.4,0,0.2,1)] transform-gpu hover:-translate-y-1 -translate-x-2">
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
                                        <div class=" text-center w-[145px] flex flex-col items-center group/returned transition-all duration-700 ease-[cubic-bezier(0.4,0,0.2,1)] transform-gpu hover:-translate-y-1 -translate-x-2">
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
                                    </div>

                                    {{-- Tombol Aksi --}}
                                    <div class="flex items-center gap-2 pr-2">
                                        {{-- Tombol Approve: Emerald (Plek Ketiplek 100% dari Model Blue) --}}
                                        <form action="{{ route('admin.loans.approve', $transaction->id) }}" method="POST" class="m-0 flex items-center">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" onclick="return confirm('Setujui peminjaman ini?')" 
                                                class="group/approve-btn w-10 h-10 flex items-center justify-center bg-emerald-600 text-white rounded-xl transition-all duration-300 transform-gpu cursor-pointer
                                                /* TAHAP 1: Shadow Fokus (8px) */
                                                shadow-[0_4px_8px_rgba(16,185,129,0.35)] 
                                                
                                                /* TAHAP 2: Hover (Naik, BG Cerah, Shadow Rapat 12px) */
                                                hover:-translate-y-1 hover:bg-emerald-500 
                                                hover:shadow-[0_6px_12px_rgba(16,185,129,0.45)] 
                                                active:scale-95">
                                                <span class="material-symbols-outlined text-[20px] transition-transform duration-300 group-hover/approve-btn:-rotate-12">
                                                    check
                                                </span>
                                            </button>
                                        </form>

                                        {{-- Tombol Reject: Rose (Plek Ketiplek 100% dari Model Rose) --}}
                                        <form action="{{ route('admin.loans.reject', $transaction->id) }}" method="POST" class="m-0 flex items-center">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" onclick="return confirm('Tolak peminjaman ini?')" 
                                                class="group/reject-btn w-10 h-10 flex items-center justify-center bg-rose-600 text-white rounded-xl transition-all duration-300 transform-gpu cursor-pointer
                                                /* TAHAP 1: Shadow Fokus (8px) */
                                                shadow-[0_4px_8px_rgba(225,29,72,0.35)] 
                                                
                                                /* TAHAP 2: Hover (Naik, BG Cerah, Shadow Rapat 12px) */
                                                hover:-translate-y-1 hover:bg-rose-500 
                                                hover:shadow-[0_6px_12px_rgba(225,29,72,0.45)] 
                                                active:scale-95">
                                                <span class="material-symbols-outlined text-[20px] transition-transform duration-300 group-hover/reject-btn:rotate-12">
                                                    close
                                                </span>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @empty
                                <div class="col-span-full py-24 flex flex-col items-center justify-center w-full">
                                    <span class="material-symbols-outlined text-slate-200 text-7xl mb-4 select-none">
                                        account_balance_wallet
                                    </span>
                                    <p class="text-slate-400 font-accent uppercase tracking-[0.2em] text-xs font-black text-center">
                                        No <span class="text-emerald-500/80">Pending Approval</span> in Queue.
                                    </p>
                                </div>
                            @endforelse
                        </div>
                    </section>

                    <div class="pt-1 ">
                        <div class="w-full h-[1.5px] bg-slate-400/30 rounded-full"></div>
                    </div>

                    <section class="space-y-4">
                        <div class="flex items-end justify-between px-2">
                            <div class="relative">
                                {{-- H4: Menggunakan Model Font & Gradient Rose-Pink Plek Ketiplek --}}
                                <h4 class="text-4xl font-extrabold tracking-tighter font-heading pb-1 -mb-1 pr-4 inline-block text-transparent bg-clip-text bg-gradient-to-r from-slate-900 via-rose-600 to-pink-500 transform-gpu" 
                                    style="
                                        -webkit-background-clip: text; 
                                        -webkit-text-fill-color: transparent;
                                        backface-visibility: hidden;
                                    ">
                                    Return Tracking
                                </h4>

                                <div class="flex items-center gap-2.5 mt-2">
                                    {{-- Garis: Ukuran w-8 h-1 dengan Shadow Rose --}}
                                    <span class="w-8 h-1 bg-rose-500 rounded-full shadow-[0_0_10px_rgba(225,29,72,0.3)]"></span>
                                    
                                    {{-- P: Font Black, Text 10px, Rose-600 --}}
                                    <p class="text-rose-600 font-black text-[10px] uppercase tracking-[0.2em] font-accent leading-none">
                                        Track books currently on loan and their return timelines.
                                    </p>
                                </div>
                            </div>

                            {{-- Button: Model, Hover, Shadow, dan Gradient Rose (Sama Persis Plek Ketiplek) --}}
                            <button onclick="window.location.href='{{ route('admin.transactions') }}'" class="group relative isolate overflow-hidden bg-white border border-slate-200 px-6 py-3 rounded-2xl text-rose-600 font-bold text-[10px] 
                                hover:text-white hover:-translate-y-1.5 hover:shadow-xl hover:shadow-rose-500/30 
                                transition-all duration-500 ease-[cubic-bezier(0.4,0,0.2,1)] 
                                flex items-center gap-2 uppercase tracking-widest font-accent shadow-sm shadow-rose-100/50">
                                
                                {{-- Layer Gradient Rose-Pink saat Hover --}}
                                <div class="absolute inset-0 -z-10 bg-gradient-to-r from-rose-600 to-pink-500 opacity-0 group-hover:opacity-100 transition-opacity duration-500 ease-in-out"></div>

                                <span class="relative z-10">See All Return Tracking</span>
                                
                                {{-- Icon dengan transisi x-1 --}}
                                <span class="material-icons-round text-sm group-hover:translate-x-1 transition-transform duration-500">arrow_forward</span> 
                            </button>
                        </div>

                        <div class="section-container hover-rose group relative isolate !mt-12">
                            <div class="glow-edge absolute inset-x-0 top-0 h-px bg-gradient-to-r from-transparent via-rose-400/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-700 z-10"></div>
                            <div class="absolute inset-0 bg-white/10 transition-colors duration-700 ease-in-out group-hover:bg-white/20 -z-10"></div>

                            <div class="flex items-center gap-6 px-5 mb-6 relative z-20 -top-[11px]">
                            <div class="w-14 flex-shrink-0"></div> 

                            <div class="flex-grow grid grid-cols-5 items-center gap-6">
                                {{-- 1. Book --}}
                                <div class="flex items-center gap-2 group/item cursor-default w-fit transform -translate-x-[35px]">
                                    <div class="flex items-center justify-center w-6 h-6 rounded-md bg-rose-500 text-white shadow-md shadow-rose-500/20 shrink-0 transition-all duration-500 ease-in-out group-hover/item:rotate-12 group-hover/item:scale-110">
                                        <span class="material-symbols-outlined text-[14px] font-bold">book</span>
                                    </div>
                                    <span class="font-accent text-[10px] font-black uppercase tracking-[0.2em] text-rose-600/60 leading-none whitespace-nowrap">
                                        Book
                                    </span>
                                </div>

                                {{-- 2. Borrower --}}
                                <div class="flex items-center gap-2 group/item cursor-default w-fit transform translate-x-[30px]">
                                    <div class="flex items-center justify-center w-6 h-6 rounded-md bg-rose-500 text-white shadow-md shadow-rose-500/20 shrink-0 transition-all duration-500 ease-in-out group-hover/item:rotate-12 group-hover/item:scale-110">
                                        <span class="material-symbols-outlined text-[14px] font-bold">person</span>
                                    </div>
                                    <span class="font-accent text-[10px] font-black uppercase tracking-[0.2em] text-rose-600/60 leading-none whitespace-nowrap">
                                        Borrower
                                    </span>
                                </div>

                                {{-- 3. Status --}}
                                <div class="flex items-center gap-2 group/item cursor-default w-fit transform translate-x-[44px]">
                                    <div class="flex items-center justify-center w-6 h-6 rounded-md bg-rose-500 text-white shadow-md shadow-rose-500/20 shrink-0 transition-all duration-500 ease-in-out group-hover/item:rotate-12 group-hover/item:scale-110">
                                        <span class="material-symbols-outlined text-[14px] font-bold">flaky</span>
                                    </div>
                                    <span class="font-accent text-[10px] font-black uppercase tracking-[0.2em] text-rose-600/60 leading-none whitespace-nowrap">
                                        Status
                                    </span>
                                </div>

                                {{-- 4. Borrow Date --}}
                                <div class="flex items-center gap-2 group/item cursor-default w-fit transform translate-x-[20px]">
                                    <div class="flex items-center justify-center w-6 h-6 rounded-md bg-rose-500 text-white shadow-md shadow-rose-500/20 shrink-0 transition-all duration-500 ease-in-out group-hover/item:rotate-12 group-hover/item:scale-110">
                                        <span class="material-symbols-outlined text-[14px] font-bold">calendar_today</span>
                                    </div>
                                    <span class="font-accent text-[10px] font-black uppercase tracking-[0.2em] text-rose-600/60 leading-none whitespace-nowrap">
                                        Loan Date
                                    </span>
                                </div>

                                {{-- 5. Due Date --}}
                                <div class="flex items-center gap-2 group/item cursor-default w-fit transform -translate-x-[2px]">
                                    <div class="flex items-center justify-center w-6 h-6 rounded-md bg-rose-500 text-white shadow-md shadow-rose-500/20 shrink-0 transition-all duration-500 ease-in-out group-hover/item:rotate-12 group-hover/item:scale-110">
                                        <span class="material-symbols-outlined text-[14px] font-bold">event_busy</span>
                                    </div>
                                    <span class="font-accent text-[10px] font-black uppercase tracking-[0.2em] text-rose-600/60 leading-none whitespace-nowrap">
                                        Due Date
                                    </span>
                                </div>
                            </div>

                            {{-- 6. Action Button (Posisi dipertahankan sama persis) --}}
                            <div class="w-[140px] flex justify-center">
                                <div class="flex items-center gap-2 group/item cursor-default w-fit transform -translate-x-[8px]">
                                    <div class="flex items-center justify-center w-6 h-6 rounded-md bg-rose-500 text-white shadow-md shadow-rose-500/20 shrink-0 transition-all duration-500 ease-in-out group-hover/item:rotate-12 group-hover/item:scale-110">
                                        <span class="material-symbols-outlined text-[14px] font-bold">settings_suggest</span>
                                    </div>
                                    <span class="font-accent text-[10px] font-black uppercase tracking-[0.2em] text-rose-600/60 leading-none whitespace-nowrap">
                                        Action
                                    </span>
                                </div>
                            </div>
                        </div>



                           @forelse($returnTracking as $loan)
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

                            <div class="admin-row-card loan-card bg-white rounded-[2.5rem] border-l-4 {{ $clr['border_l'] }} border border-slate-200 py-4 px-4 md:px-5 flex flex-col md:flex-row items-center gap-1 group/returned-card shadow-sm transition-all duration-500 transform-gpu hover:-translate-y-[0.375rem] hover:shadow-[0_0_20px_rgba(225,29,72,0.2),0_15px_30px_-15px_rgba(0,0,0,0.1)]"
                                data-start="{{ $loan->loan_date }}" 
                                data-end="{{ $loan->due_date }}" 
                                data-status="{{ $loan->status }}"
                                style="{{ $style }}">
                                
                                <div class="w-14 h-20 ml-2 flex-shrink-0 rounded-xl overflow-hidden shadow-md transition-all duration-500 transform transform-gpu
                                        -translate-x-1 -rotate-3 border border-slate-200 bg-white
                                        
                                        group-hover/returned-card:rotate-0 
                                        group-hover/returned-card:translate-x-0 
                                        group-hover/returned-card:scale-105
                                        group-hover/returned-card:border-rose-400/80
                                        group-hover/returned-card:shadow-[0_0_15px_rgba(225,29,72,0.25),0_8px_15px_-5px_rgba(0,0,0,0.15)]
                                        
                                        hover:!rotate-[1.5deg] 
                                        hover:!scale-110 
                                        hover:!shadow-[0_4px_10px_rgba(225,29,72,0.35),0_2px_5px_rgba(0,0,0,0.1)]
                                        cursor-pointer">
                                        
                                @php
                                    $imagePath = $loan->book->image ?? $loan->book->cover_image ?? '';
                                    $finalUrl = str_contains($imagePath, 'http') ? $imagePath : asset('storage/' . $imagePath);
                                @endphp

                                <img alt="{{ $loan->book->title ?? 'Cover' }}" 
                                    class="w-full h-full object-cover" 
                                    src="{{ $finalUrl }}" 
                                    onerror="this.onerror=null; this.src='https://via.placeholder.com/150x225?text=No+Cover'"/>
                            </div>



                                <div class="flex-grow grid grid-cols-5 items-center gap-6 -ml-2">
                                   <div class="flex items-center gap-4 col-span-1">
                                    <div class="min-w-0 overflow-visible w-[160px]">
                                        {{-- Title: Rose Gradient Edition --}}
                                        <h3 class="font-black text-lg tracking-tighter font-heading leading-[1.2] py-2 -my-2 line-clamp-2 transform-gpu max-w-[10rem]" 
                                            style="
                                                backface-visibility: hidden;
                                                background-image: linear-gradient(to right, #e11d48 5%, #fb7185 95%);
                                                -webkit-background-clip: text;
                                                -webkit-text-fill-color: transparent;
                                                padding-bottom: 0.1em;
                                                margin-bottom: -0.1em;
                                            "
                                            title="{{ $loan->book->title ?? 'Judul Tidak Ada' }}">
                                            {{ $loan->book->title ?? 'Judul Tidak Ada' }}
                                        </h3>  

                                        <div class="flex flex-row items-center mt-1">
                                            <span class="w-4 h-[2px] bg-rose-500/60 rounded-full flex-shrink-0
                                                transition-all duration-700 [transition-timing-function:cubic-bezier(0.34,1.56,0.64,1)] 
                                                group-hover:scale-x-[1.2] 
                                                group-hover/returned-card:!scale-x-[1.8] 
                                                origin-left 
                                                transform-gpu will-change-transform [backface-visibility:hidden]">
                                            </span>

                                            <p class="text-[10px] text-rose-500/60 font-black font-accent uppercase tracking-[0.15em] italic truncate leading-tight max-w-[10rem] flex-1 min-w-0 
                                                transition-all duration-700 [transition-timing-function:cubic-bezier(0.34,1.56,0.64,1)]
                                                ml-2 
                                                group-hover:pl-1
                                                group-hover/returned-card:!pl-4
                                                transform-gpu"
                                                title="{{ $loan->book->author_name ?? 'Penulis' }}">
                                                {{ $loan->book->author_name ?? 'Unknown Author' }}
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
                                                    {{ $loan->user->username ?? $loan->user->name ?? 'User' }}
                                                </span>
                                                <span class="text-[9px] font-bold uppercase opacity-80 leading-tight">
                                                    {{ $loan->user->role ?? 'N/A' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="w-[135px] flex-shrink-0 ml-5">
                                        <div class="js-status-badge flex items-center justify-center gap-2 px-3 py-2 rounded-xl border-none transition-all duration-500 cursor-pointer group/status-badge text-white transform-gpu hover:!scale-110 hover:-translate-y-1 shadow-md"
                                            data-status-color="">
                                            
                                            <span class="material-symbols-outlined text-[17px] js-icon transition-transform duration-500 group-hover/status-badge:translate-x-1">
                                                sync
                                            </span>

                                            <div class="flex flex-col min-w-0">
                                                <span class="js-time-text text-[12px] font-black font-modern uppercase tracking-tight tabular-nums leading-none whitespace-nowrap truncate">
                                                    Calculating...
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    @php
                                        $durationColors = [
                                            ['bg' => 'bg-rose-500',    'text_top' => 'text-rose-600/70',    'text_hover' => 'group-hover/returned:text-rose-500',    'shadow' => 'rgba(225,29,72,0.4)',  'shadow_deep' => 'rgba(225,29,72,0.45)'],
                                            ['bg' => 'bg-emerald-500', 'text_top' => 'text-emerald-600/70', 'text_hover' => 'group-hover/returned:text-emerald-500', 'shadow' => 'rgba(16,185,129,0.4)', 'shadow_deep' => 'rgba(16,185,129,0.45)'],
                                        ];
                                        
                                        // Card 1: Emerald (Loan Date)
                                        $clrEmerald = $durationColors[1];
                                        $styleEmerald = "--shadow-color: {$clrEmerald['shadow']}; --shadow-deep: {$clrEmerald['shadow_deep']};";
                                        
                                        // Card 2: Rose (Due Date)
                                        $clrRose = $durationColors[0];
                                        $styleRose = "--shadow-color: {$clrRose['shadow']}; --shadow-deep: {$clrRose['shadow_deep']};";
                                    @endphp

                                    {{-- Tanggal Pinjam: Emerald Edition (Plek Ketiplek 100%) --}}
                                    <div class="ml-8 text-center w-[120px] flex flex-col items-center group/returned transition-all duration-700 ease-[cubic-bezier(0.4,0,0.2,1)] transform-gpu hover:-translate-y-1 -translate-x-2">
                                        <div class="w-full">
                                            <div class="flex items-center px-4 h-9 rounded-full {{ $clrEmerald['bg'] }} text-white transition-all duration-700 ease-[cubic-bezier(0.4,0,0.2,1)] w-full justify-center border-none cursor-default transform-gpu 
                                                shadow-[0_4px_12px_var(--shadow-color)] 
                                                group-hover/returned:scale-105 
                                                group-hover/returned:shadow-[0_6px_16px_var(--shadow-deep)]"
                                                style="{{ $styleEmerald }}">
                                                <p class="text-[12px] font-black font-modern uppercase tracking-tighter tabular-nums leading-none whitespace-nowrap">
                                                    {{ $loan->loan_date ? \Carbon\Carbon::parse($loan->loan_date)->format('M d, H:i') : '-' }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Tanggal Jatuh Tempo: Rose Edition (Plek Ketiplek 100%) --}}
                                    <div class="ml-2 text-center w-[120px] flex flex-col items-center group/returned transition-all duration-700 ease-[cubic-bezier(0.4,0,0.2,1)] transform-gpu hover:-translate-y-1 -translate-x-2">
                                        <div class="w-full">
                                            <div class="flex items-center px-4 h-9 rounded-full {{ $clrRose['bg'] }} text-white transition-all duration-700 ease-[cubic-bezier(0.4,0,0.2,1)] w-full justify-center border-none cursor-default transform-gpu 
                                                shadow-[0_4px_12px_var(--shadow-color)] 
                                                group-hover/returned:scale-105 
                                                group-hover/returned:shadow-[0_6px_16px_var(--shadow-deep)]"
                                                style="{{ $styleRose }}">
                                                <p class="text-[12px] font-black font-modern uppercase tracking-tighter tabular-nums leading-none whitespace-nowrap">
                                                    {{ $loan->due_date ? \Carbon\Carbon::parse($loan->due_date)->format('M d, H:i') : '-' }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <form action="{{ route('admin.returnBook', $loan->id) }}" method="POST" class="m-0 inline-flex items-center"
                                onsubmit="return confirm('Apakah Anda yakin ingin memproses pengembalian buku \'{{ $loan->book->title }}\' milik {{ $loan->user->username ?? $loan->user->name }}?')">
                                @csrf
                                <button type="submit"
                                class="group/return-btn px-4 py-2 w-[155px] flex items-center justify-center gap-2 bg-rose-600 text-white rounded-xl transition-all duration-300 cursor-pointer
                                    /* SHADOW AWAL: Merah Tipis */
                                    shadow-[0_4px_8px_rgba(225,29,72,0.35)] 

                                    /* HOVER TOMBOL: Naik & Shadow Tebal */
                                    hover:-translate-y-1 hover:bg-rose-500 
                                    hover:shadow-[0_6px_12px_rgba(225,29,72,0.45)] 
                                    active:scale-95">
                                    
                                    <span class="material-symbols-outlined text-[18px] inline-block transition-all duration-300 
                                        group-hover/return-btn:-translate-x-1 
                                        group-hover/return-btn:scale-105 
                                        group-hover/return-btn:rotate-12">
                                        keyboard_return
                                    </span>
                                    
                                    <span class="text-[10px] font-bold uppercase tracking-wide whitespace-nowrap">
                                        Return This Book
                                    </span>
                                </button>
                                </form>
                            </div>
                            @empty
                            <div class="col-span-full py-24 flex flex-col items-center justify-center w-full">
                                <span class="material-symbols-outlined text-slate-200 text-7xl mb-4 select-none">
                                    assignment_return
                                </span>
                                <p class="text-slate-400 font-accent uppercase tracking-[0.2em] text-xs font-black text-center">
                                    No <span class="text-rose-600/80">Pending Returns</span> to Track.
                                </p>
                            </div>
                        @endforelse
                        </div>

                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                function updateTimers() {
                                    const now = new Date().getTime();
                                    const cards = document.querySelectorAll('.loan-card');

                                    cards.forEach(card => {
                                        const start = new Date(card.dataset.start).getTime();
                                        const end = new Date(card.dataset.end).getTime();
                                        const status = card.getAttribute('data-status');

                                        const text = card.querySelector('.js-time-text');
                                        const badge = card.querySelector('.js-status-badge');
                                        const icon = card.querySelector('.js-icon');

                                    
                                        const getSoftShadow = (colorStr) => {
                                            return colorStr.replace(/0\.[0-9]+/, '0.35'); 
                                        };

                                        const updateStatusClass = (element, newBg, shadowColor) => {
                                            if (!element) return;
                                            
                                            if (element.getAttribute('data-status-color') !== newBg) {
                                                const colorClasses = ['bg-emerald-500', 'bg-orange-500', 'bg-rose-600', 'bg-slate-600', 'bg-slate-400', 'bg-rose-950'];
                                                element.classList.remove(...colorClasses);
                                                element.classList.add(newBg);
                                                element.setAttribute('data-status-color', newBg);
                                                element.setAttribute('data-shadow-raw', shadowColor);
                                            }

                                          
                                            element.onmouseenter = (e) => {
                                                e.stopPropagation();
                                                element.style.transform = 'scale(1.1) translateY(-4px)';
                                                element.style.boxShadow = `0 3px 5px -1px rgba(0,0,0,0.07), 0 9px 18px -6px ${shadowColor}`;
                                            };

                                            element.onmouseleave = () => {
                                               
                                                element.style.transform = 'scale(1.05)';
                                                element.style.boxShadow = `0 4px 8px -2px rgba(0,0,0,0.12), 0 5px 10px -3px ${getSoftShadow(shadowColor)}`;
                                            };
                                        };

                                        
                                        card.onmouseenter = () => {
                                            if (badge) {
                                                const rawColor = badge.getAttribute('data-shadow-raw') || 'rgba(0,0,0,0.2)';
                                                badge.style.transform = 'scale(1.05)';
                                            
                                                badge.style.boxShadow = `0 4px 8px -2px rgba(0,0,0,0.12), 0 5px 10px -3px ${getSoftShadow(rawColor)}`;
                                            }
                                        };

                                        card.onmouseleave = () => {
                                            if (badge) {
                                                badge.style.transform = '';
                                                badge.style.boxShadow = '';
                                            }
                                        };

                                     
                                        if (status === 'pending') {
                                            if (text) text.innerText = "PENDING";
                                            if (icon) { icon.innerText = "pending"; icon.classList.remove('animate-pulse'); }
                                            updateStatusClass(badge, "bg-slate-400", "rgba(148, 163, 184, 0.5)");
                                        } else if (status === 'rejected') {
                                            if (text) text.innerText = "REJECTED";
                                            if (icon) { icon.innerText = "cancel"; icon.classList.remove('animate-pulse'); }
                                            updateStatusClass(badge, "bg-rose-950", "rgba(69, 10, 10, 0.5)");
                                        } else {
                                            const total = end - start;
                                            const elapsed = now - start;
                                            const remaining = end - now;
                                            let percentage = (elapsed / total) * 100;

                                            if (remaining <= 0) {
                                                if (text) text.innerText = "OVERDUE";
                                                if (icon) { icon.innerText = "history_toggle_off"; icon.classList.remove('animate-pulse'); }
                                                updateStatusClass(badge, "bg-rose-600", "rgba(225, 29, 72, 0.6)");
                                            } else {
                                                const days = Math.floor(remaining / (1000 * 60 * 60 * 24));
                                                const hours = Math.floor((remaining % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                                const mins = Math.floor((remaining % (1000 * 60 * 60)) / (1000 * 60));
                                                const secs = Math.floor((remaining % (1000 * 60)) / 1000);

                                                if (text) text.innerText = days > 0 ? `${days}D ${hours}H LEFT` : `${hours}H ${mins}M ${secs}S`;

                                                if (percentage >= 85) {
                                                    updateStatusClass(badge, "bg-rose-600", "rgba(225, 29, 72, 0.6)");
                                                    if (icon) { icon.innerText = "warning"; icon.classList.add('animate-pulse'); }
                                                } else if (percentage >= 50) {
                                                    updateStatusClass(badge, "bg-orange-500", "rgba(249, 115, 22, 0.6)");
                                                    if (icon) { icon.innerText = "hourglass_top"; icon.classList.remove('animate-pulse'); }
                                                } else {
                                                    updateStatusClass(badge, "bg-emerald-500", "rgba(16, 185, 129, 0.6)");
                                                    if (icon) { icon.innerText = "schedule"; icon.classList.remove('animate-pulse'); }
                                                }
                                            }
                                        }
                                    });
                                }

                                setInterval(updateTimers, 1000);
                                updateTimers();
                            });
                            </script>
                    </section>


                    <div class="pt-1 ">
                        <div class="w-full h-[1.5px] bg-slate-400/30 rounded-full"></div>
                    </div>

                    <section class="space-y-4">
                        <div class="flex items-center justify-between px-2 w-full">
                            <div class="relative flex items-center gap-1">
                                {{-- Sisi Kiri: Judul dan Deskripsi --}}
                                <div class="flex flex-col -mt-4">
                                    {{-- H4: Tidak berubah sedikit pun --}}
                                    <h4 class="text-4xl font-extrabold tracking-tighter font-heading pb-1 -mb-1 pr-4 inline-block text-transparent bg-clip-text bg-gradient-to-r from-slate-900 via-amber-600 to-orange-500 transform-gpu" 
                                        style="
                                            -webkit-background-clip: text; 
                                            -webkit-text-fill-color: transparent;
                                            backface-visibility: hidden;
                                        ">
                                        Outstanding Fines & Sanctions
                                    </h4>

                                    <div class="flex items-center gap-2.5 mt-2">
                                        {{-- Garis dekoratif --}}
                                        <span class="w-8 h-1 bg-amber-500 rounded-full shadow-[0_0_10px_rgba(217,119,6,0.3)]"></span>
                                        
                                        {{-- P: Tidak berubah sedikit pun --}}
                                        <p class="text-amber-600 font-black text-[10px] uppercase tracking-[0.2em] font-accent leading-none">
                                            Monitor unpaid penalties and member code violations.
                                        </p>
                                    </div>
                                </div>
                                <div class="flex flex-col items-start justify-center min-w-[120px] w-fit group transition-all duration-500 ease-out hover:-translate-y-1 hover:translate-x-1 -mt-0">

                                    <div class="flex items-center justify-start gap-2">
                                        {{-- Icon Section: Skala diperkecil ke w-5 h-5, Font 13px --}}
                                        <div class="flex items-center justify-center w-5 h-5 rounded-md bg-amber-600 text-white shadow-lg shadow-amber-500/20 shrink-0 transition-all duration-300 group-hover:rotate-12 group-hover:scale-110">
                                            <span class="material-symbols-outlined text-[13px] font-bold">account_balance_wallet</span>
                                        </div>
                                        
                                        {{-- Text Section: Skala diperkecil ke text-[9px] --}}
                                        <span class="font-accent text-[9px] font-black uppercase tracking-[0.3em] text-amber-600/60 leading-none transition-all duration-300 group-hover:translate-x-1 group-hover:scale-105 origin-left">
                                            Total Outstanding
                                        </span>
                                    </div>
                                
                                    <div class="relative pl-4 mt-1 group">
                                        {{-- Jalur Garis Abu-abu: Lebar w-1 (3px) TETAP, Tinggi h-8 disesuaikan font --}}
                                        <div class="absolute left-0 top-1/2 -translate-y-1/2 w-[3px] h-8 bg-slate-200 rounded-full overflow-hidden transition-all duration-700 ease-[cubic-bezier(0.23,1,0.32,1)]">
                                            
                                            {{-- Elemen Pengisi: Efek & Durasi SAMA PERSIS --}}
                                            <div class="absolute bottom-0 left-0 w-full h-0 bg-gradient-to-t from-amber-400 to-amber-600 shadow-[0_0_15px_rgba(217,119,6,0.4)] transition-all duration-700 ease-in-out group-hover:h-full"></div>
                                        </div>

                                        {{-- Kontainer Angka: Skala Hover SAMA PERSIS --}}
                                        <div class="group flex items-baseline gap-2 w-fit transition-transform duration-300 group-hover:scale-[1.03] origin-left">
                                            {{-- Angka Nominal: Skala diperkecil ke text-3xl --}}
                                            <span class="font-heading font-black text-3xl leading-none py-1 text-transparent bg-clip-text bg-gradient-to-r from-amber-600 to-orange-400 drop-shadow-sm">
                                                Rp {{ number_format(\App\Models\UserFineBalance::getTotalGlobalFine(), 0, ',', '.') }}
                                            </span>
                                            
                                            {{-- Tulisan Total: Skala diperkecil ke text-[12px] --}}
                                            <span class="font-modern text-[12px] font-bold text-slate-500 leading-none whitespace-nowrap italic -ml-1">
                                                Total
                                            </span>
                                        </div>

                                        {{-- Bottom Decorative Line: Efek SAMA PERSIS --}}
                                        <div class="relative w-full h-1 mt-1 hidden md:block group">
                                            <div class="absolute inset-0 bg-gradient-to-r from-transparent via-amber-500/20 to-transparent rounded-full"></div>
                                            <div class="absolute inset-0 bg-gradient-to-r from-transparent via-amber-500/90 to-transparent rounded-full opacity-0 transition-opacity duration-500 ease-in-out group-hover:opacity-100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Button: Model, Hover, Shadow, dan Gradient Amber (Sama Persis Tanpa Terkecuali) --}}
                            <button onclick="window.location.href='{{ route('admin.members') }}'" class="group relative isolate overflow-hidden bg-white border border-slate-200 px-6 py-3 rounded-2xl text-amber-600 font-bold text-[10px] 
                                hover:text-white hover:-translate-y-1.5 hover:shadow-xl hover:shadow-amber-500/30 
                                transition-all duration-500 ease-[cubic-bezier(0.4,0,0.2,1)] 
                                flex items-center gap-2 uppercase tracking-widest font-accent shadow-sm shadow-amber-100/50">
                                
                                {{-- Layer Gradient Amber-Orange saat Hover --}}
                                <div class="absolute inset-0 -z-10 bg-gradient-to-r from-amber-600 to-orange-500 opacity-0 group-hover:opacity-100 transition-opacity duration-500 ease-in-out"></div>

                                <span class="relative z-10">See All User Fines</span>
                                
                                <span class="material-icons-round text-sm group-hover:translate-x-1 transition-transform duration-500">arrow_forward</span> 
                            </button>
                        </div>
                        

                        <div class="section-container hover-amber group relative isolate !mt-8">
                            {{-- Glow Edge Effect: Amber Version (Sama Persis Plek Ketiplek) --}}
                            <div class="glow-edge absolute inset-x-0 top-0 h-px bg-gradient-to-r from-transparent via-amber-400/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-700 z-10"></div>
                            
                            {{-- Overlay Background --}}
                            <div class="absolute inset-0 bg-white/10 transition-colors duration-700 ease-in-out group-hover:bg-white/20 -z-10"></div>

                            {{-- Header Tabel --}}
                            <div class="flex items-center gap-6 px-5 mb-6 relative z-20 -top-[11px]">
                                {{-- Spacer Kiri (Sama Persis w-14) --}}
                                <div class="w-14 flex-shrink-0"></div> 

                                <div class="flex-grow grid grid-cols-4 items-center gap-6">
                                    {{-- 1. Member --}}
                                    <div class="flex items-center gap-2 group/item cursor-default w-fit transform -translate-x-[35px]">
                                        <div class="flex items-center justify-center w-6 h-6 rounded-md bg-amber-500 text-white shadow-md shadow-amber-500/20 shrink-0 transition-all duration-500 ease-in-out group-hover/item:rotate-12 group-hover/item:scale-110">
                                            <span class="material-symbols-outlined text-[14px] font-bold">badge</span>
                                        </div>
                                        <span class="font-accent text-[10px] font-black uppercase tracking-[0.2em] text-amber-600/60 leading-none whitespace-nowrap">
                                            Member
                                        </span>
                                    </div>

                                    {{-- 2. Total Overdue Books --}}
                                    <div class="flex items-center gap-2 group/item cursor-default w-fit transform -translate-x-[14px]">
                                        <div class="flex items-center justify-center w-6 h-6 rounded-md bg-amber-500 text-white shadow-md shadow-amber-500/20 shrink-0 transition-all duration-500 ease-in-out group-hover/item:rotate-12 group-hover/item:scale-110">
                                            <span class="material-symbols-outlined text-[14px] font-bold">library_books</span>
                                        </div>
                                        <span class="font-accent text-[10px] font-black uppercase tracking-[0.2em] text-amber-600/60 leading-none whitespace-nowrap">
                                            Late Books
                                        </span>
                                    </div>

                                    {{-- 3. Total Overdue Days --}}
                                    <div class="flex items-center gap-2 group/item cursor-default w-fit transform -translate-x-[26px]">
                                        <div class="flex items-center justify-center w-6 h-6 rounded-md bg-amber-500 text-white shadow-md shadow-amber-500/20 shrink-0 transition-all duration-500 ease-in-out group-hover/item:rotate-12 group-hover/item:scale-110">
                                            <span class="material-symbols-outlined text-[14px] font-bold">history_toggle_off</span>
                                        </div>
                                        <span class="font-accent text-[10px] font-black uppercase tracking-[0.2em] text-amber-600/60 leading-none whitespace-nowrap">
                                            Late Days
                                        </span>
                                    </div>

                                    {{-- 4. Fine Amount --}}
                                    <div class="flex items-center gap-2 group/item cursor-default w-fit transform -translate-x-[24px]">
                                        <div class="flex items-center justify-center w-6 h-6 rounded-md bg-amber-500 text-white shadow-md shadow-amber-500/20 shrink-0 transition-all duration-500 ease-in-out group-hover/item:rotate-12 group-hover/item:scale-110">
                                            <span class="material-symbols-outlined text-[14px] font-bold">payments</span>
                                        </div>
                                        <span class="font-accent text-[10px] font-black uppercase tracking-[0.2em] text-amber-600/60 leading-none whitespace-nowrap">
                                            Fine Amount
                                        </span>
                                    </div>
                                </div>

                                {{-- 5. Action Button (Posisi Plek Ketiplek 140px & translate-x-[18px]) --}}
                                <div class="w-[380px] flex justify-center">
                                    <div class="flex items-center gap-2 group/item cursor-default w-fit transform -translate-x-[6px]">
                                        <div class="flex items-center justify-center w-6 h-6 rounded-md bg-amber-500 text-white shadow-md shadow-amber-500/20 shrink-0 transition-all duration-500 ease-in-out group-hover/item:rotate-12 group-hover/item:scale-110">
                                            <span class="material-symbols-outlined text-[14px] font-bold">settings_suggest</span>
                                        </div>
                                        <span class="font-accent text-[10px] font-black uppercase tracking-[0.2em] text-amber-600/60 leading-none whitespace-nowrap">
                                            Action Buttons
                                        </span>
                                    </div>
                                </div>
                            </div>

                            @forelse($outstandingFines as $fine)
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

                                <div class="admin-row-card bg-white rounded-[2.5rem] border-l-4 {{ $clr['border_l'] }} border border-slate-200 py-4 px-4 md:px-5 flex flex-col md:flex-row items-center gap-1 loan-item group/returned-card shadow-sm transition-all duration-500 transform-gpu 
                                    hover:-translate-y-[0.375rem] 
                                    hover:shadow-[0_0_20px_rgba(245,158,11,0.2),0_15px_30px_-15px_rgba(0,0,0,0.1)]" 
                                    style="{{ $style }}">



                                {{-- Bagian Foto Profile / Inisial --}}
                                    <div class="relative group/profile w-12 h-12 flex-shrink-0 transition-all duration-700 ease-[cubic-bezier(0.34,1.56,0.64,1)] hover:scale-110">

                                        {{-- Kontainer Utama --}}
                                        <div class="absolute inset-0 rounded-full bg-slate-100 border-2 border-white shadow-lg overflow-hidden flex items-center justify-center 
                                            {{-- Kondisi Default --}}
                                            -rotate-6 translate-x-0
                                            
                                            {{-- Tahap 1: Hover di area Card --}}
                                            group-hover/returned-card:rotate-0 
                                            group-hover/returned-card:scale-105 
                                            group-hover/returned-card:translate-x-2
                                            group-hover/returned-card:shadow-[0_10px_20px_-2px_rgba(245,158,11,0.25)]
                                            
                                            {{-- Tahap 2: Efek tambahan pada Shadow saat kursor di area Profile --}}
                                            group-hover/profile:shadow-[0_12px_25px_-5px_rgba(245,158,11,0.45)]
                                            
                                            {{-- Animasi --}}
                                            transition-all duration-700 ease-[cubic-bezier(0.34,1.56,0.64,1)]">

                                            @if($fine->user && $fine->user->foto_profile)
                                                <img src="{{ asset('storage/' . $fine->user->foto_profile) }}" 
                                                    class="w-full h-full object-cover" 
                                                    alt="{{ $fine->user->username }}"
                                                    onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                                
                                                {{-- Backup jika gambar gagal dimuat (Link Patah) --}}
                                                <div class="hidden w-full h-full bg-amber-100 items-center justify-center text-amber-600 font-bold text-[10px]">
                                                    {{ strtoupper(substr($fine->user->username ?? '??', 0, 2)) }}
                                                </div>
                                            @else
                                                <div class="w-full h-full bg-amber-100 flex items-center justify-center text-amber-600 font-bold text-[10px]">
                                                    {{ strtoupper(substr($fine->user->username ?? '??', 0, 2)) }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>


                                

                                <div class="flex-grow grid grid-cols-4 items-center gap-6">
                                    <span class="font-black text-xl tracking-tighter font-heading leading-[1.2] py-2 -my-2 transform-gpu inline-block truncate max-w-[8rem]" 
                                        style="
                                            backface-visibility: hidden;
                                            /* Gradasi Amber-600 ke Amber-400 yang sesuai tema */
                                            background-image: linear-gradient(to right, #d97706 5%, #fbbf24 95%);
                                            -webkit-background-clip: text;
                                            -webkit-text-fill-color: transparent;
                                            padding-bottom: 0.1em;
                                            margin-bottom: -0.1em;
                                            white-space: nowrap;
                                        "
                                        title="{{ $fine->user->username ?? 'Unknown' }}">
                                        {{ $fine->user->username ?? 'Unknown' }}
                                    </span>
                                    
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

                                    <div class="-ml-3 w-[120px] flex-shrink-0">
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
                                                auto_stories
                                            </span>
                                            
                                            {{-- TEXT: Total Books --}}
                                            <span class="text-[11px] font-black font-modern uppercase tracking-tighter tabular-nums leading-none whitespace-nowrap">
                                                {{ $fine->realtime_books }} Books
                                            </span>
                                        </div>
                                    </div>


                                    @php
                                        // 1. Definisi skema warna URUT (Sesuai urutan perintah: blue, rose, violet, emerald, amber, slate, indigo)
                                        $color_list = [
                                            [ // BLUE
                                                'bg' => 'bg-blue-100', 'border' => 'border-blue-200', 'text' => 'text-blue-700',
                                                'hover_bg' => 'group-hover/returned-card:bg-blue-500',
                                                'shadow' => 'rgba(37, 99, 235, 0.40)', 'shadow_deep' => 'rgba(37, 99, 235, 0.45)'
                                            ],
                                            [ // ROSE
                                                'bg' => 'bg-rose-100', 'border' => 'border-rose-200', 'text' => 'text-rose-700',
                                                'hover_bg' => 'group-hover/returned-card:bg-rose-500', 
                                                'shadow' => 'rgba(225, 29, 72, 0.40)', 'shadow_deep' => 'rgba(225, 29, 72, 0.45)'
                                            ],
                                            [ // VIOLET
                                                'bg' => 'bg-violet-100', 'border' => 'border-violet-200', 'text' => 'text-violet-700',
                                                'hover_bg' => 'group-hover/returned-card:bg-violet-500',
                                                'shadow' => 'rgba(124, 58, 237, 0.40)', 'shadow_deep' => 'rgba(124, 58, 237, 0.45)'
                                            ],
                                            [ // EMERALD
                                                'bg' => 'bg-emerald-100', 'border' => 'border-emerald-200', 'text' => 'text-emerald-700',
                                                'hover_bg' => 'group-hover/returned-card:bg-emerald-500',
                                                'shadow' => 'rgba(16, 185, 129, 0.40)', 'shadow_deep' => 'rgba(16, 185, 129, 0.45)'
                                            ],
                                            [ // AMBER
                                                'bg' => 'bg-amber-100', 'border' => 'border-amber-200', 'text' => 'text-amber-700',
                                                'hover_bg' => 'group-hover/returned-card:bg-amber-500',
                                                'shadow' => 'rgba(245, 158, 11, 0.40)', 'shadow_deep' => 'rgba(245, 158, 11, 0.45)'
                                            ],
                                            [ // SLATE
                                                'bg' => 'bg-slate-100', 'border' => 'border-slate-200', 'text' => 'text-slate-700',
                                                'hover_bg' => 'group-hover/returned-card:bg-slate-500',
                                                'shadow' => 'rgba(71, 85, 105, 0.40)', 'shadow_deep' => 'rgba(71, 85, 105, 0.45)'
                                            ],
                                            [ // INDIGO
                                                'bg' => 'bg-indigo-100', 'border' => 'border-indigo-200', 'text' => 'text-indigo-700',
                                                'hover_bg' => 'group-hover/returned-card:bg-indigo-500',
                                                'shadow' => 'rgba(79, 70, 229, 0.40)', 'shadow_deep' => 'rgba(79, 70, 229, 0.45)'
                                            ],
                                        ];

                                        // 2. Logika URUT (Menggunakan modulus agar tidak error jika data lebih banyak dari pilihan warna)
                                        $clr = $color_list[$loop->index % count($color_list)];

                                        // 3. Kalkulasi Waktu
                                        $displayDays = floor($fine->realtime_seconds / 86400);
                                        $displayHours = floor(($fine->realtime_seconds % 86400) / 3600);
                                    @endphp

                                    <div class="-ml-7 w-[120px] flex-shrink-0">
                                        <div class="flex items-center justify-center gap-2 px-4 h-8 rounded-xl border transition-all duration-500 cursor-pointer group/category-badge
                                            {{-- KONDISI AWAL (Plek Ketiplek) --}}
                                            {{ $clr['bg'] }} {{ $clr['border'] }} {{ $clr['text'] }}
                                            shadow-[0_2px_4px_rgba(0,0,0,0.08)] 
                                            
                                            {{-- TAHAP 1: Card Hover (Scale 105 & Shadow 0.40) --}}
                                            {{ $clr['hover_bg'] }}
                                            group-hover/returned-card:text-white 
                                            group-hover/returned-card:border-transparent 
                                            group-hover/returned-card:scale-105
                                            group-hover/returned-card:shadow-[0_4px_8px_var(--shadow-color)]

                                            {{-- TAHAP 2: Self Hover (Scale 110 & Shadow 0.45 & Translate) --}}
                                            hover:!scale-110 
                                            hover:-translate-y-1 
                                            hover:!shadow-[0_6px_12px_var(--shadow-deep)]
                                            
                                            {{-- Efek BG Menggelap ke 600 saat kursor tepat di card --}}
                                            @if(str_contains($clr['hover_bg'], 'blue')) hover:!bg-blue-600 @endif
                                            @if(str_contains($clr['hover_bg'], 'rose')) hover:!bg-rose-600 @endif
                                            @if(str_contains($clr['hover_bg'], 'violet')) hover:!bg-violet-600 @endif
                                            @if(str_contains($clr['hover_bg'], 'emerald')) hover:!bg-emerald-600 @endif
                                            @if(str_contains($clr['hover_bg'], 'amber')) hover:!bg-amber-600 @endif
                                            @if(str_contains($clr['hover_bg'], 'slate')) hover:!bg-slate-600 @endif
                                            @if(str_contains($clr['hover_bg'], 'indigo')) hover:!bg-indigo-600 @endif"
                                            
                                            style="--shadow-color: {{ $clr['shadow'] }}; --shadow-deep: {{ $clr['shadow_deep'] }};">
                                      
                                            
                                            {{-- TEXT (Plek Ketiplek: Font Modern & Ukuran 11px) --}}
                                            <span class="text-[11px] font-black font-modern uppercase tracking-tighter tabular-nums leading-none whitespace-nowrap">
                                                {{ $displayDays }}D {{ $displayHours }}H
                                            </span>



                                            <span class="material-symbols-outlined text-base transition-all duration-500 transform
                                                @if(str_contains($clr['text'], 'blue')) text-blue-600 @endif
                                                @if(str_contains($clr['text'], 'rose')) text-rose-600 @endif
                                                @if(str_contains($clr['text'], 'violet')) text-violet-600 @endif
                                                @if(str_contains($clr['text'], 'emerald')) text-emerald-600 @endif
                                                @if(str_contains($clr['text'], 'amber')) text-amber-600 @endif
                                                @if(str_contains($clr['text'], 'slate')) text-slate-600 @endif
                                                @if(str_contains($clr['text'], 'indigo')) text-indigo-600 @endif
                                                
                                                group-hover/returned-card:text-white
                                                
                                                group-hover/category-badge:-translate-x-1
                                                group-hover/category-badge:-rotate-12
                                                group-hover/category-badge:scale-110">
                                                schedule
                                            </span>
                                        </div>
                                    </div>
                                
                                    @php
                                        $clrAmber = [
                                            'bg' => 'bg-amber-500', 
                                            'text_top' => 'text-amber-600/70', 
                                            'text_hover' => 'group-hover/returned:text-amber-500', 
                                            'shadow' => 'rgba(245, 158, 11, 0.4)', 
                                            'shadow_deep' => 'rgba(245, 158, 11, 0.45)'
                                        ];

                                        $styleAmber = "--shadow-color: {$clrAmber['shadow']}; --shadow-deep: {$clrAmber['shadow_deep']};";
                                    @endphp

                                    {{-- Container Utama: Menggunakan durasi 700ms, ease-cubic, translate-y-1 saat hover, dan -translate-x-2 --}}
                                    <div class="-ml-5 text-center w-[140px] flex flex-col items-center group/returned transition-all duration-700 ease-[cubic-bezier(0.4,0,0.2,1)] transform-gpu hover:-translate-y-1 -translate-x-2">
                                        <div class="w-full">
                                            {{-- Card Body: Amber-500, h-9, rounded-full, shadow 4 12, hover zoom 105 & shadow 6 16 --}}
                                            <div class="flex items-center px-4 h-[34px] rounded-full {{ $clrAmber['bg'] }} text-white transition-all duration-700 ease-[cubic-bezier(0.4,0,0.2,1)] w-full justify-center border-none cursor-default transform-gpu 
                                                shadow-[0_4px_12px_var(--shadow-color)] 
                                                group-hover/returned:scale-105 
                                                group-hover/returned:shadow-[0_6px_16px_var(--shadow-deep)]"
                                                style="{{ $styleAmber }}">
                                                
                                                {{-- Text Nominal: Ukuran 12px, Font Modern, Black, Tabular Nums --}}
                                                <p class="text-[13px] font-black font-modern uppercase tracking-tighter tabular-nums leading-none whitespace-nowrap">
                                                    Rp {{ number_format($fine->realtime_fine, 0, ',', '.') }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex items-center gap-2 w-[380px] justify-end">
                                    

                                    {{-- Button 2: Blue (Installment) --}}
                                    <a href="{{ route('admin.members', ['pay_member' => $fine->user->user_id]) }}"
                                    class="group/return-btn px-3 py-2 flex-1 flex items-center justify-center gap-1.5 bg-blue-600 text-white rounded-xl transition-all duration-300 cursor-pointer
                                        shadow-[0_4px_8px_rgba(37,99,235,0.35)] 
                                        hover:-translate-y-1 hover:bg-blue-500 
                                        hover:shadow-[0_6px_12px_rgba(37,99,235,0.45)] 
                                        active:scale-95">
                                        
                                        <span class="material-symbols-outlined text-[16px] inline-block transition-all duration-300 
                                            group-hover/return-btn:-translate-x-1 
                                            group-hover/return-btn:scale-105 
                                            group-hover/return-btn:rotate-12">
                                            payments
                                        </span>
                                        
                                        <span class="text-[9px] font-black uppercase tracking-tight whitespace-nowrap">
                                            Installment
                                        </span>
                                    </a>

                                    {{-- Button 3: Emerald (Pay Off) --}}
                                    <button onclick="confirmPayOff('{{ $fine->user->user_id }}', '{{ $fine->user->username }}')"
                                    class="group/return-btn px-3 py-2 flex-1 flex items-center justify-center gap-1.5 bg-emerald-600 text-white rounded-xl transition-all duration-300 cursor-pointer
                                        shadow-[0_4px_8px_rgba(16,185,129,0.35)] 
                                        hover:-translate-y-1 hover:bg-emerald-500 
                                        hover:shadow-[0_6px_12px_rgba(16,185,129,0.45)] 
                                        active:scale-95">
                                        
                                        <span class="material-symbols-outlined text-[16px] inline-block transition-all duration-300 
                                            group-hover/return-btn:-translate-x-1 
                                            group-hover/return-btn:scale-105 
                                            group-hover/return-btn:rotate-12">
                                            check_circle
                                        </span>
                                        
                                        <span class="text-[9px] font-black uppercase tracking-tight whitespace-nowrap">
                                            Pay Off
                                        </span>
                                    </button>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full py-24 flex flex-col items-center justify-center w-full">
                                <span class="material-symbols-outlined text-slate-200 text-7xl mb-4 select-none">
                                    gavel
                                </span>
                                <p class="text-slate-400 font-accent uppercase tracking-[0.2em] text-xs font-black text-center">
                                    No <span class="text-amber-500/80">Outstanding Fines</span> or Sanctions.
                                </p>
                            </div>
                        @endforelse
                        </div>
                    </section>

                    <script>
                        function confirmPayOff(userId, username) {
                            // Alert konfirmasi sesuai permintaan
                            if (confirm("Apakah Anda yakin ingin memputihkan (melunasi) seluruh denda untuk user " + username + "?\n\nSemua riwayat denda akan nol dan status buku yang telat akan dianggap kembali.")) {
                                
                                let form = document.createElement('form');
                                form.method = 'POST';
                                
                                form.action = '/dashboard/admin/member/pay-off/' + userId;
                                let csrfInput = document.createElement('input');
                                csrfInput.type = 'hidden';
                                csrfInput.name = '_token';
                                csrfInput.value = '{{ csrf_token() }}';
                                
                                form.appendChild(csrfInput);
                                document.body.appendChild(form);
                                
                                form.submit();
                            }
                        }
                    </script>


                    <div class="pt-1 ">
                        <div class="w-full h-[1.5px] bg-slate-400/30 rounded-full"></div>
                    </div>

                    <section class="space-y-4">
                        <div class="flex items-end justify-between px-2">
                            <div class="relative">
                                {{-- H4: Menggunakan Model Font & Gradient Fuchsia-Pink Plek Ketiplek --}}
                                <h4 class="text-4xl font-extrabold tracking-tighter font-heading pb-1 -mb-1 pr-4 inline-block text-transparent bg-clip-text bg-gradient-to-r from-slate-900 via-fuchsia-600 to-pink-500 transform-gpu" 
                                    style="
                                        -webkit-background-clip: text; 
                                        -webkit-text-fill-color: transparent;
                                        backface-visibility: hidden;
                                    ">
                                    Integrated Book Borrowing System
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

                            {{-- Button: Model, Hover, Shadow, dan Gradient Rose (Sama Persis Plek Ketiplek) --}}
                            <button onclick="window.location.href='{{ route('admin.reports') }}'" class="group relative isolate overflow-hidden bg-white border border-slate-200 px-6 py-3 rounded-2xl text-fuchsia-600 font-bold text-[10px] 
                                hover:text-white hover:-translate-y-1.5 hover:shadow-xl hover:shadow-fuchsia-500/30 
                                transition-all duration-500 ease-[cubic-bezier(0.4,0,0.2,1)] 
                                flex items-center gap-2 uppercase tracking-widest font-accent shadow-sm shadow-fuchsia-100/50">
                                
                                {{-- Layer Gradient Fuchsia-Pink saat Hover --}}
                                <div class="absolute inset-0 -z-10 bg-gradient-to-r from-fuchsia-600 to-pink-500 opacity-0 group-hover:opacity-100 transition-opacity duration-500 ease-in-out"></div>

                                <span class="relative z-10">View Full Circulation Logs</span>
                                
                                {{-- Icon dengan transisi x-1 --}}
                                <span class="material-icons-round text-sm group-hover:translate-x-1 transition-transform duration-500">arrow_forward</span> 
                            </button>
                        </div>

                        <div class="section-container hover-fuchsia group relative isolate !mt-12">
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
                                    <div class="flex items-center gap-2 group/item cursor-default w-fit transform translate-x-[16px]">
                                        <div class="flex items-center justify-center w-6 h-6 rounded-md bg-fuchsia-500 text-white shadow-md shadow-fuchsia-500/20 shrink-0 transition-all duration-500 ease-in-out group-hover/item:rotate-12 group-hover/item:scale-110">
                                            <span class="material-symbols-outlined text-[14px] font-bold">group</span>
                                        </div>
                                        <span class="font-accent text-[10px] font-black uppercase tracking-[0.2em] text-fuchsia-600/60 leading-none whitespace-nowrap">
                                            Borrower
                                        </span>
                                    </div>

                                    {{-- 3. Status --}}
                                    <div class="flex items-center gap-2 group/item cursor-default w-fit transform translate-x-[42px]">
                                        <div class="flex items-center justify-center w-6 h-6 rounded-md bg-fuchsia-500 text-white shadow-md shadow-fuchsia-500/20 shrink-0 transition-all duration-500 ease-in-out group-hover/item:rotate-12 group-hover/item:scale-110">
                                            <span class="material-symbols-outlined text-[14px] font-bold">info</span>
                                        </div>
                                        <span class="font-accent text-[10px] font-black uppercase tracking-[0.2em] text-fuchsia-600/60 leading-none whitespace-nowrap">
                                            Status
                                        </span>
                                    </div>

                                    {{-- 4. Borrow Date --}}
                                    <div class="flex items-center gap-2 group/item cursor-default w-fit transform translate-x-[30px]">
                                        <div class="flex items-center justify-center w-6 h-6 rounded-md bg-fuchsia-500 text-white shadow-md shadow-fuchsia-500/20 shrink-0 transition-all duration-500 ease-in-out group-hover/item:rotate-12 group-hover/item:scale-110">
                                            <span class="material-symbols-outlined text-[14px] font-bold">calendar_add_on</span>
                                        </div>
                                        <span class="font-accent text-[10px] font-black uppercase tracking-[0.2em] text-fuchsia-600/60 leading-none whitespace-nowrap">
                                            Loan Date
                                        </span>
                                    </div>

                                    {{-- 5. Due Date --}}
                                    <div class="flex items-center gap-2 group/item cursor-default w-fit transform translate-x-[34px]">
                                        <div class="flex items-center justify-center w-6 h-6 rounded-md bg-fuchsia-500 text-white shadow-md shadow-fuchsia-500/20 shrink-0 transition-all duration-500 ease-in-out group-hover/item:rotate-12 group-hover/item:scale-110">
                                            <span class="material-symbols-outlined text-[14px] font-bold">event_busy</span>
                                        </div>
                                        <span class="font-accent text-[10px] font-black uppercase tracking-[0.2em] text-fuchsia-600/60 leading-none whitespace-nowrap">
                                            Due Date
                                        </span>
                                    </div>

                                    <div class="flex items-center gap-2 group/item cursor-default w-fit transform translate-x-[32px]">
                                        <div class="flex items-center justify-center w-6 h-6 rounded-md bg-fuchsia-500 text-white shadow-md shadow-fuchsia-500/20 shrink-0 transition-all duration-500 ease-in-out group-hover/item:rotate-12 group-hover/item:scale-110">
                                            <span class="material-symbols-outlined text-[14px] font-bold">event_available</span>
                                        </div>
                                        <span class="font-accent text-[10px] font-black uppercase tracking-[0.2em] text-fuchsia-600/60 leading-none whitespace-nowrap">
                                            Returned
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

                                    <div class="w-[135px] flex-shrink-0 ml-0">
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

                                    <div class="w-[120px] flex-shrink-0 ml-5">
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

                                    <div class="ml-8 text-center w-[120px] flex flex-col items-center group/returned transition-all duration-700 ease-[cubic-bezier(0.4,0,0.2,1)] transform-gpu hover:-translate-y-1 -translate-x-2">
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

                                    <div class="ml-8 text-center w-[120px] flex flex-col items-center group/returned transition-all duration-700 ease-[cubic-bezier(0.4,0,0.2,1)] transform-gpu hover:-translate-y-1 -translate-x-2">
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

                                    <div class="ml-8 text-center w-[120px] flex flex-col items-center group/returned transition-all duration-700 ease-[cubic-bezier(0.4,0,0.2,1)] transform-gpu hover:-translate-y-1 -translate-x-2">
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
                    </section>  


                    <div class="pt-1 ">
                        <div class="w-full h-[1.5px] bg-slate-400/30 rounded-full"></div>
                    </div>

                    <section class="space-y-4">
                        <div class="flex items-center justify-between px-2 w-full ">
                            <div class="relative flex items-center gap-1">
                                <div class="flex flex-col ">
                                    <h4 class="text-4xl font-extrabold tracking-tighter font-heading pb-1 -mb-1 pr-4 inline-block text-transparent bg-clip-text bg-gradient-to-r from-slate-900 via-amber-600 to-orange-500 transform-gpu" 
                                        style="
                                            -webkit-background-clip: text; 
                                            -webkit-text-fill-color: transparent;
                                            backface-visibility: hidden;
                                        ">
                                        Fine Recapitulation & Transaction Audit Logs
                                    </h4>

                                    <div class="flex items-center gap-2.5 mt-2">
                                        <span class="w-8 h-1 bg-amber-500 rounded-full shadow-[0_0_10px_rgba(217,119,6,0.3)]"></span>
                                        
                                        <p class="text-amber-600 font-black text-[10px] uppercase tracking-[0.2em] font-accent leading-none">
                                           Detailed comprehensive audit of overdue penalties and member transaction history reports.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <button onclick="window.location.href='{{ route('admin.reports') }}'" class="group relative isolate overflow-hidden bg-white border border-slate-200 px-6 py-3 rounded-2xl text-amber-600 font-bold text-[10px] 
                                hover:text-white hover:-translate-y-1.5 hover:shadow-xl hover:shadow-amber-500/30 
                                transition-all duration-500 ease-[cubic-bezier(0.4,0,0.2,1)] 
                                flex items-center gap-2 uppercase tracking-widest font-accent shadow-sm shadow-amber-100/50">
                                
                                {{-- Layer Gradient Amber-Orange saat Hover --}}
                                <div class="absolute inset-0 -z-10 bg-gradient-to-r from-amber-600 to-orange-500 opacity-0 group-hover:opacity-100 transition-opacity duration-500 ease-in-out"></div>

                                <span class="relative z-10">See Detailed Penalty Audits</span>
                                
                                <span class="material-icons-round text-sm group-hover:translate-x-1 transition-transform duration-500">arrow_forward</span> 
                            </button>
                        </div>
                        

                        <div class="section-container hover-amber group relative isolate !mt-12">
                                    <div class="glow-edge absolute inset-x-0 top-0 h-px bg-gradient-to-r from-transparent via-fuchsia-400/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-700 z-10"></div>
                                    <div class="absolute inset-0 bg-white/10 transition-colors duration-700 ease-in-out group-hover:bg-white/20 -z-10"></div>

                                    <div class="flex items-center gap-6 px-5 mb-6 relative z-20 -top-[11px]">
                                    <div class="w-14 flex-shrink-0"></div> 

                                     <div class="flex-grow grid grid-cols-7 items-center gap-6">
                                        {{-- 1. Book --}}
                                        <div class="flex items-center gap-2 group/item cursor-default w-fit transform -translate-x-[35px]">
                                            <div class="flex items-center justify-center w-6 h-6 rounded-md bg-amber-500 text-white shadow-md shadow-amber-500/20 shrink-0 transition-all duration-500 ease-in-out group-hover/item:rotate-12 group-hover/item:scale-110">
                                                <span class="material-symbols-outlined text-[14px] font-bold">import_contacts</span>
                                            </div>
                                            <span class="font-accent text-[10px] font-black uppercase tracking-[0.2em] text-amber-600/60 leading-none whitespace-nowrap">
                                                Book Detail
                                            </span>
                                        </div>

                                        {{-- 2. Borrower --}}
                                        <div class="flex items-center gap-2 group/item cursor-default w-fit transform translate-x-[16px]">
                                            <div class="flex items-center justify-center w-6 h-6 rounded-md bg-amber-500 text-white shadow-md shadow-amber-500/20 shrink-0 transition-all duration-500 ease-in-out group-hover/item:rotate-12 group-hover/item:scale-110">
                                                <span class="material-symbols-outlined text-[14px] font-bold">group</span>
                                            </div>
                                            <span class="font-accent text-[10px] font-black uppercase tracking-[0.2em] text-amber-600/60 leading-none whitespace-nowrap">
                                                Borrower
                                            </span>
                                        </div>

                                        {{-- 4. Borrow Date --}}
                                        <div class="flex items-center gap-2 group/item cursor-default w-fit transform translate-x-[20px]">
                                            <div class="flex items-center justify-center w-6 h-6 rounded-md bg-amber-500 text-white shadow-md shadow-amber-500/20 shrink-0 transition-all duration-500 ease-in-out group-hover/item:rotate-12 group-hover/item:scale-110">
                                                <span class="material-symbols-outlined text-[14px] font-bold">calendar_add_on</span>
                                            </div>
                                            <span class="font-accent text-[10px] font-black uppercase tracking-[0.2em] text-amber-600/60 leading-none whitespace-nowrap">
                                                Loan Date
                                            </span>
                                        </div>

                                        {{-- 5. Due Date --}}
                                        <div class="flex items-center gap-2 group/item cursor-default w-fit transform translate-x-[10px]">
                                            <div class="flex items-center justify-center w-6 h-6 rounded-md bg-amber-500 text-white shadow-md shadow-amber-500/20 shrink-0 transition-all duration-500 ease-in-out group-hover/item:rotate-12 group-hover/item:scale-110">
                                                <span class="material-symbols-outlined text-[14px] font-bold">event_busy</span>
                                            </div>
                                            <span class="font-accent text-[10px] font-black uppercase tracking-[0.2em] text-amber-600/60 leading-none whitespace-nowrap">
                                                Due Date
                                            </span>
                                        </div>

                                        <div class="flex items-center gap-2 group/item cursor-default w-fit transform -translate-x-[6px]">
                                            <div class="flex items-center justify-center w-6 h-6 rounded-md bg-amber-500 text-white shadow-md shadow-amber-500/20 shrink-0 transition-all duration-500 ease-in-out group-hover/item:rotate-12 group-hover/item:scale-110">
                                                <span class="material-symbols-outlined text-[14px] font-bold">event_available</span>
                                            </div>
                                            <span class="font-accent text-[10px] font-black uppercase tracking-[0.2em] text-amber-600/60 leading-none whitespace-nowrap">
                                                Returned
                                            </span>
                                        </div>

                                        <div class="flex items-center gap-2 group/item cursor-default w-fit transform -translate-x-[2px]">
                                            <div class="flex items-center justify-center w-6 h-6 rounded-md bg-amber-500 text-white shadow-md shadow-amber-500/20 shrink-0 transition-all duration-500 ease-in-out group-hover/item:rotate-12 group-hover/item:scale-110">
                                                <span class="material-symbols-outlined text-[14px] font-bold">payments</span>
                                            </div>
                                            <span class="font-accent text-[10px] font-black uppercase tracking-[0.2em] text-amber-600/60 leading-none whitespace-nowrap">
                                                Fine Value
                                            </span>
                                        </div>

                                         {{-- 3. Status --}}
                                        <div class="flex items-center gap-2 group/item cursor-default w-fit transform translate-x-[18px]">
                                            <div class="flex items-center justify-center w-6 h-6 rounded-md bg-amber-500 text-white shadow-md shadow-amber-500/20 shrink-0 transition-all duration-500 ease-in-out group-hover/item:rotate-12 group-hover/item:scale-110">
                                                <span class="material-symbols-outlined text-[14px] font-bold">info</span>
                                            </div>
                                            <span class="font-accent text-[10px] font-black uppercase tracking-[0.2em] text-amber-600/60 leading-none whitespace-nowrap">
                                                Status
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                @forelse($fineReports as $fine)
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

                                    <div class="admin-row-card loan-card bg-white rounded-[2.5rem] border-l-4 {{ $clr['border_l'] }} border border-slate-200 py-4 px-4 md:px-5 flex flex-col md:flex-row items-center gap-1 group/returned-card shadow-sm transition-all duration-500 transform-gpu hover:-translate-y-[0.375rem] hover:shadow-[0_0_20px_rgba(217,119,6,0.2),0_15px_30px_-15px_rgba(0,0,0,0.1)]"
                                        data-start="{{ $fine->loan_date }}" 
                                        data-end="{{ $fine->due_date }}" 
                                        data-status="{{ $fine->status }}"
                                        style="{{ $style }}">
                                        
                                        <div class="w-14 h-20 ml-2 flex-shrink-0 rounded-xl overflow-hidden shadow-md transition-all duration-500 transform transform-gpu
                                                    -translate-x-1 -rotate-3 border border-slate-200 bg-white
                                                    
                                                    group-hover/returned-card:rotate-0 
                                                    group-hover/returned-card:translate-x-0 
                                                    group-hover/returned-card:scale-105
                                                    group-hover/returned-card:border-amber-400/80
                                                    group-hover/returned-card:shadow-[0_0_15px_rgba(217,119,6,0.25),0_8px_15px_-5px_rgba(0,0,0,0.15)]
                                                    
                                                    hover:!rotate-[1.5deg] 
                                                    hover:!scale-110 
                                                    hover:!shadow-[0_4px_10px_rgba(217,119,6,0.35),0_2px_5px_rgba(0,0,0,0.1)]
                                                    cursor-pointer">
                                                    
                                            @php
                                                $imagePath = $fine->book->image ?? $fine->book->cover_image ?? '';
                                                $finalUrl = str_contains($imagePath, 'http') ? $imagePath : asset('storage/' . $imagePath);
                                            @endphp 

                                            {{-- PERBAIKAN PADA ATRIBUT ALT --}}
                                            <img alt="{{ $fine->book->title ?? 'Cover' }}" 
                                                class="w-full h-full object-cover" 
                                                src="{{ $finalUrl }}" 
                                                onerror="this.onerror=null; this.src='https://via.placeholder.com/150x225?text=No+Cover'"/>
                                        </div>



                                        <div class="flex-grow grid grid-cols-7 items-center gap-6 -ml-2">
                                            <div class="flex items-center gap-4 col-span-1">
                                            <div class="min-w-0 overflow-visible w-[160px]">
                                                {{-- Title: Amber Gradient Edition --}}
                                                <h3 class="font-black text-lg tracking-tighter font-heading leading-[1.2] py-2 -my-2 line-clamp-2 transform-gpu max-w-[10rem]" 
                                                    style="
                                                        backface-visibility: hidden;
                                                        background-image: linear-gradient(to right, #d97706 5%, #fbbf24 95%);
                                                        -webkit-background-clip: text;
                                                        -webkit-text-fill-color: transparent;
                                                        padding-bottom: 0.1em;
                                                        margin-bottom: -0.1em;
                                                    "
                                                    title="{{ $fine->book->title ?? 'Judul Tidak Ada' }}">
                                                    {{ $fine->book->title ?? 'Judul Tidak Ada' }}
                                                </h3>

                                                <div class="flex flex-row items-center mt-1">
                                                    <span class="w-4 h-[2px] bg-amber-500/60 rounded-full flex-shrink-0
                                                        transition-all duration-700 [transition-timing-function:cubic-bezier(0.34,1.56,0.64,1)] 
                                                        group-hover:scale-x-[1.2] 
                                                        group-hover/returned-card:!scale-x-[1.8] 
                                                        origin-left 
                                                        transform-gpu will-change-transform [backface-visibility:hidden]">
                                                    </span>

                                                    <p class="text-[10px] text-amber-500/60 font-black font-accent uppercase tracking-[0.15em] italic truncate leading-tight max-w-[10rem] flex-1 min-w-0 
                                                        transition-all duration-700 [transition-timing-function:cubic-bezier(0.34,1.56,0.64,1)]
                                                        ml-2 
                                                        group-hover:pl-1
                                                        group-hover/returned-card:!pl-4
                                                        transform-gpu"
                                                        title="{{ $fine->book->author_name ?? 'Penulis' }}">
                                                        {{ $fine->book->author_name ?? 'Unknown Author' }}
                                                    </p>
                                                </div>  
                                            </div>
                                        </div>

                                            <div class="w-[135px] flex-shrink-0 ml-0">
                                                <div class="flex items-center justify-center gap-2 px-2 py-1.5 rounded-xl border transition-all duration-500 cursor-pointer group/category-badge
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
                                                        <span class="text-[13px] font-black font-modern tracking-tighter tabular-nums leading-none whitespace-nowrap truncate w-full">
                                                            {{ $fine->user->username ?? $fine->user->name ?? 'User' }}
                                                        </span>
                                                        <span class="text-[9px] font-bold uppercase opacity-80 leading-tight">
                                                            {{ $fine->user->role ?? 'N/A' }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>

                                            @php
                                                $durationColors = [
                                                    ['bg' => 'bg-rose-500',    'text_top' => 'text-rose-600/70',    'text_hover' => 'group-hover/returned:text-rose-500',    'shadow' => 'rgba(225,29,72,0.4)',  'shadow_deep' => 'rgba(225,29,72,0.45)'],
                                                    ['bg' => 'bg-emerald-500', 'text_top' => 'text-emerald-600/70', 'text_hover' => 'group-hover/returned:text-emerald-500', 'shadow' => 'rgba(16,185,129,0.4)', 'shadow_deep' => 'rgba(16,185,129,0.45)'],
                                                    ['bg' => 'bg-blue-500',    'text_top' => 'text-blue-600/70',    'text_hover' => 'group-hover/returned:text-blue-500',    'shadow' => 'rgba(37,99,235,0.4)',   'shadow_deep' => 'rgba(37,99,235,0.45)'],
                                                    ['bg' => 'bg-amber-500',   'text_top' => 'text-amber-600/70',   'text_hover' => 'group-hover/returned:text-amber-500',   'shadow' => 'rgba(245,158,11,0.4)',  'shadow_deep' => 'rgba(245,158,11,0.45)'],
                                                ];
                                                
                                                // Card 1: Emerald (Loan Date)
                                                $clrEmerald = $durationColors[1];
                                                $styleEmerald = "--shadow-color: {$clrEmerald['shadow']}; --shadow-deep: {$clrEmerald['shadow_deep']};";
                                                
                                                // Card 2: Rose (Due Date)
                                                $clrRose = $durationColors[0];
                                                $styleRose = "--shadow-color: {$clrRose['shadow']}; --shadow-deep: {$clrRose['shadow_deep']};";

                                                // Card 3: Blue Edition
                                                $clrBlue = $durationColors[2];
                                                $styleBlue = "--shadow-color: {$clrBlue['shadow']}; --shadow-deep: {$clrBlue['shadow_deep']};";

                                                // Card 4: Amber Edition (Baru)
                                                $clrAmber = $durationColors[3];
                                                $styleAmber = "--shadow-color: {$clrAmber['shadow']}; --shadow-deep: {$clrAmber['shadow_deep']};";
                                            @endphp

                                            {{-- Tanggal Pinjam: Emerald Edition (Plek Ketiplek 100%) --}}
                                            <div class="ml-6 text-center w-[110px] flex flex-col items-center group/returned transition-all duration-700 ease-[cubic-bezier(0.4,0,0.2,1)] transform-gpu hover:-translate-y-1 -translate-x-2">
                                                <div class="w-full">
                                                    <div class="flex items-center px-4 h-9 rounded-full {{ $clrEmerald['bg'] }} text-white transition-all duration-700 ease-[cubic-bezier(0.4,0,0.2,1)] w-full justify-center border-none cursor-default transform-gpu 
                                                        shadow-[0_4px_12px_var(--shadow-color)] 
                                                        group-hover/returned:scale-105 
                                                        group-hover/returned:shadow-[0_6px_16px_var(--shadow-deep)]"
                                                        style="{{ $styleEmerald }}">
                                                        <p class="text-[11px] font-black font-modern uppercase tracking-tighter tabular-nums leading-none whitespace-nowrap">
                                                            {{ $fine->loan_date ? \Carbon\Carbon::parse($fine->loan_date)->format('M d, H:i') : '-' }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- Tanggal Jatuh Tempo: Rose Edition (Plek Ketiplek 100%) --}}
                                            <div class="ml-3 text-center w-[110px] flex flex-col items-center group/returned transition-all duration-700 ease-[cubic-bezier(0.4,0,0.2,1)] transform-gpu hover:-translate-y-1 -translate-x-2">
                                                <div class="w-full">
                                                    <div class="flex items-center px-4 h-9 rounded-full {{ $clrRose['bg'] }} text-white transition-all duration-700 ease-[cubic-bezier(0.4,0,0.2,1)] w-full justify-center border-none cursor-default transform-gpu 
                                                        shadow-[0_4px_12px_var(--shadow-color)] 
                                                        group-hover/returned:scale-105 
                                                        group-hover/returned:shadow-[0_6px_16px_var(--shadow-deep)]"
                                                        style="{{ $styleRose }}">
                                                        <p class="text-[11px] font-black font-modern uppercase tracking-tighter tabular-nums leading-none whitespace-nowrap">
                                                            {{ $fine->due_date ? \Carbon\Carbon::parse($fine->due_date)->format('M d, H:i') : '-' }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- Tanggal Pengembalian: Blue Edition (Plek Ketiplek 100%) --}}
                                            <div class="ml-0 text-center w-[110px] flex flex-col items-center group/returned transition-all duration-700 ease-[cubic-bezier(0.4,0,0.2,1)] transform-gpu hover:-translate-y-1 -translate-x-2">
                                                <div class="w-full">
                                                    <div class="flex items-center px-4 h-9 rounded-full {{ $clrBlue['bg'] }} text-white transition-all duration-700 ease-[cubic-bezier(0.4,0,0.2,1)] w-full justify-center border-none cursor-default transform-gpu 
                                                        shadow-[0_4px_12px_var(--shadow-color)] 
                                                        group-hover/returned:scale-105 
                                                        group-hover/returned:shadow-[0_6px_16px_var(--shadow-deep)]"
                                                        style="{{ $styleBlue }}">
                                                        <p class="text-[11px] font-black font-modern uppercase tracking-tighter tabular-nums leading-none whitespace-nowrap">
                                                            @if($fine->status === 'returned' || $fine->return_date)
                                                                {{ \Carbon\Carbon::parse($fine->return_date)->format('M d, H:i') }}
                                                            @else
                                                                None
                                                            @endif
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>    


                                            <div class="-ml-2 text-center w-[140px] flex flex-col items-center group/returned transition-all duration-700 ease-[cubic-bezier(0.4,0,0.2,1)] transform-gpu hover:-translate-y-1 -translate-x-2">
                                                <div class="w-full">
                                                    <div class="flex items-center px-4 h-9 rounded-full {{ $clrAmber['bg'] }} text-white transition-all duration-700 ease-[cubic-bezier(0.4,0,0.2,1)] w-full justify-center border-none cursor-default transform-gpu 
                                                        shadow-[0_4px_12px_var(--shadow-color)] 
                                                        group-hover/returned:scale-105 
                                                        group-hover/returned:shadow-[0_6px_16px_var(--shadow-deep)]"
                                                        style="{{ $styleAmber }}">
                                                        <p class="text-[12px] font-black font-modern uppercase tracking-tighter tabular-nums leading-none whitespace-nowrap">
                                                            Rp {{ number_format($fine->calculated_fine, 0, ',', '.') }}
                                                        </p>
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

                                            <div class="ml-0 w-[120px] flex-shrink-0 ">
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
                                                        @if($fine->payment_status === 'Pay Off')
                                                            check_circle
                                                        @elseif($fine->payment_status === 'Installments')
                                                            published_with_changes
                                                        @else {{-- Unpaid --}}
                                                            cancel
                                                        @endif
                                                    </span>
                                                    
                                                    {{-- TEXT: Total Books --}}
                                                    <span class="text-[11px] font-black font-modern uppercase tracking-tighter tabular-nums leading-none whitespace-nowrap">
                                                        {{ $fine->payment_status }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @empty
                                        <div class="col-span-full py-24 flex flex-col items-center justify-center w-full">
                                            <span class="material-symbols-outlined text-slate-200 text-7xl mb-4 select-none">
                                                payments
                                            </span>
                                            <p class="text-slate-400 font-accent uppercase tracking-[0.2em] text-xs font-black text-center">
                                                No <span class="text-amber-600/80">Fines Transactions</span> in System.
                                            </p>
                                        </div>
                                    @endforelse
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
        </script>
    </body>
</html>