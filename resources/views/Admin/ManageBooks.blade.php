<!DOCTYPE html>
<html class="light" lang="id">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Manage Books - LibSys Admin</title>

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
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

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
                bg-white dark:bg-slate-800 border-r border-slate-200 dark:border-slate-700 
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

                        <a class="relative z-50 flex items-center justify-center gap-3 p-4 rounded-2xl bg-gradient-to-r border-blue-200 from-blue-600 to-cyan-500 text-white shadow-[0_15px_30px_rgba(37,99,235,0.3)] transform translate-x-3 -translate-y-1 scale-x-[1.06] origin-left transition-all duration-1000 transform-gpu will-change-transform [backface-visibility:hidden] [transition-timing-function:cubic-bezier(0.34,1.56,0.64,1)] group ring-2 ring-white" href="{{ route('admin.books') }}">
                            <span class="relative z-30 font-black font-accent uppercase tracking-[0.25em] text-[10px] inline-block scale-x-[0.94]">Manage Books</span>
                            <span class="material-icons-round text-base rotate-[20deg] translate-x-1 transition-transform duration-500 relative z-30 inline-block scale-x-[0.94]">library_books</span>
                        </a>

                        <a class="relative overflow-hidden flex items-center justify-center gap-3 p-4 rounded-2xl border-2 border-indigo-200 bg-white/50 backdrop-blur-sm text-indigo-600 shadow-sm shadow-indigo-100/50 transition-all duration-1000 [transition-timing-function:cubic-bezier(0.34,1.56,0.64,1)] hover:z-50 hover:text-white hover:border-transparent hover:translate-x-3 hover:-translate-y-1 
                        hover:scale-x-[1.06] origin-left transform-gpu will-change-transform [backface-visibility:hidden] hover:shadow-[0_15px_30px_rgba(79,70,229,0.3)] group" href="{{ route('admin.members') }}">
                            <span class="absolute inset-0 bg-gradient-to-r from-indigo-600 to-indigo-400 opacity-0 transition-opacity duration-500 group-hover:opacity-100"></span>
                            <span class="relative z-30 font-black font-accent will-change-transform uppercase tracking-[0.25em] text-[10px] transition-transform duration-1000 [transition-timing-function:inherit] group-hover:scale-x-[0.94] inline-block">Manage Members</span>
                            <span class="material-icons-round text-base group-hover:rotate-[20deg] group-hover:translate-x-1 transition-transform duration-500 relative z-30 group-hover:scale-x-[0.94] inline-block transform-gpu antialiased">people</span>
                        </a>

                        <a class="relative overflow-hidden flex items-center justify-center gap-3 p-4 rounded-2xl border-2 border-emerald-200 bg-white/50 backdrop-blur-sm text-emerald-600 shadow-sm shadow-emerald-100/50 transition-all duration-1000 [transition-timing-function:cubic-bezier(0.34,1.56,0.64,1)] hover:z-50 hover:text-white hover:border-transparent hover:translate-x-3 hover:-translate-y-1 
                        hover:scale-x-[1.06] origin-left transform-gpu will-change-transform [backface-visibility:hidden] hover:shadow-[0_15px_30px_rgba(16,185,129,0.3)] group" href="{{ route('admin.transactions') }}">
                            <span class="absolute inset-0 bg-gradient-to-r from-emerald-600 to-emerald-400 opacity-0 transition-opacity duration-500 group-hover:opacity-100"></span>
                            <span class="relative z-30 font-black font-accent will-change-transform uppercase tracking-[0.25em] text-[10px] transition-transform duration-1000 [transition-timing-function:inherit] group-hover:scale-x-[0.94] inline-block">Transactions</span>
                            <span class="material-icons-round text-base group-hover:rotate-[20deg] group-hover:translate-x-1 transition-transform duration-500 relative z-30 group-hover:scale-x-[0.94] inline-block transform-gpu antialiased">swap_horiz</span>
                        </a>

                        <div class="pt-6 pb-2 text-center">
                            <p class="px-3 text-[10px] font-black text-blue-400 uppercase tracking-[0.2em] font-accent">Reporting Tools</p>
                        </div>

                        <a class="relative overflow-hidden flex items-center justify-center gap-3 p-4 rounded-2xl border-2 border-rose-200 bg-white/50 backdrop-blur-sm text-rose-600 shadow-sm shadow-rose-100/50 transition-all duration-1000 [transition-timing-function:cubic-bezier(0.34,1.56,0.64,1)] hover:z-50 hover:text-white hover:border-transparent hover:translate-x-3 hover:-translate-y-1 
                        hover:scale-x-[1.06] origin-left transform-gpu will-change-transform [backface-visibility:hidden] hover:shadow-[0_15px_30px_rgba(244,63,94,0.3)] group" href="{{ route('admin.reports') }}">
                            <span class="absolute inset-0 bg-gradient-to-r from-rose-600 to-rose-400 opacity-0 transition-opacity duration-500 group-hover:opacity-100"></span>
                            <span class="relative z-30 font-black font-accent will-change-transform uppercase tracking-[0.25em] text-[10px] transition-transform duration-1000 [transition-timing-function:inherit] group-hover:scale-x-[0.94] inline-block">Lending Reports</span>
                            <span class="material-icons-round text-base group-hover:rotate-[20deg] group-hover:translate-x-1 transition-transform duration-500 relative z-30 group-hover:scale-x-[0.94] inline-block transform-gpu antialiased">bar_chart</span>
                        </a>
                    </nav>
                </aside>

                <main class="flex-1 min-h-screen pt-2">
                    <div class="p-8 max-w-[1600px] mx-auto space-y-6">
                        <section class="mb-10 relative flex justify-between items-start pl-6">
                            <div class="relative">
                                {{-- Garis vertikal sama persis - Gradient Blue ke Cyan --}}
                                <div class="absolute -left-6 top-0 w-1 h-20 bg-gradient-to-b from-blue-600 to-cyan-500 rounded-full"></div>
                                
                                <h1 class="text-6xl font-extrabold tracking-tighter mb-3 font-heading leading-none">
                                    {{-- Sisi Kiri: Hitam --}}
                                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-slate-900 to-blue-900">Manage,</span>

                                    {{-- Tengah: Angka dengan Gradient Biru-Cyan & Underline --}}
                                    <span class="relative inline-block pb-2 px-1">
                                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-cyan-500">
                                            {{ \App\Models\Book::count() }}
                                        </span>
                                        <span class="absolute bottom-0 left-0 w-full h-1.5 bg-gradient-to-r from-blue-600 via-cyan-400 to-transparent rounded-full"></span>
                                    </span>

                                    {{-- Sisi Kanan: Gradient Hitam via Biru ke Cyan (Plek Ketiplek) --}}
                                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-900 via-blue-600 to-cyan-500 italic">
                                        Library Books.
                                    </span>
                                </h1>
                                
                                <p class="text-slate-500 font-medium text-lg leading-relaxed max-w-4xl border-l-0 font-modern">
                                    Manage and monitor all physical and digital assets in the library to ensure every collection is organized and accessible for all members.
                                </p>
                            </div>
                            
                            <div class="hidden lg:block pt-9 ">
                                <button onclick="openAddBookModal()" class="group relative isolate overflow-hidden bg-white border border-slate-200 px-6 py-3 rounded-2xl text-blue-600 font-bold text-[10px] 
                                    hover:text-white hover:-translate-y-1.5 hover:shadow-xl hover:shadow-blue-500/30 
                                    transition-all duration-500 ease-[cubic-bezier(0.4,0,0.2,1)] 
                                    flex items-center gap-2 uppercase tracking-widest font-accent shadow-sm shadow-blue-100/50">
                                    
                                    {{-- Layer Gradient Blue 600 to Cyan 500 (Opacity 0) --}}
                                    <div class="absolute inset-0 -z-10 bg-gradient-to-r from-blue-600 to-cyan-500 opacity-0 group-hover:opacity-100 transition-opacity duration-500 ease-in-out"></div>

                                    <span class="relative z-10 flex items-center gap-2">
                                        <span class="material-symbols-outlined text-lg group-hover:rotate-90 transition-transform duration-500">add</span>
                                        <span>Register New Asset</span>
                                    </span>
                                </button>
                            </div>
                        </section>


                      <div id="borrowModal" class="fixed inset-0 z-[100] hidden w-full h-full">
                        <div class="absolute inset-0 bg-slate-950/40 backdrop-blur-[6px] opacity-0 transition-opacity duration-300 ease-out" 
                            id="modalBackdrop"
                            onclick="closeAddBookModal()">
                        </div>  
                        
                        <div class="relative flex w-full min-h-full items-center justify-center p-4 md:p-6 pt-24"> 
                            
                            <div id="modalContent" class="relative w-full max-w-4xl max-h-[85vh] mt-10 flex flex-col transform overflow-hidden group/modal rounded-[3.5rem] bg-[#F8F9FC] transition-all border border-slate-100 shadow-[0_35px_60px_-15px_rgba(37,99,235,0.25)] group/header">
                                
                                <div class="pt-10 pb-4 px-10 flex justify-between items-start">
                                    <div>
                                        <h3 class="text-3xl font-black font-heading tracking-tighter bg-clip-text text-transparent transform-gpu pr-1"
                                               style="background-image: linear-gradient(to right, #2563eb 0%, #0891b2 50%, #22d3ee 100%); 
                                                -webkit-background-clip: text; 
                                                -webkit-text-fill-color: transparent;">
                                            Add New Book Asset
                                        </h3>
                                        <p class="text-xs text-slate-400 font-bold uppercase tracking-[0.2em] mt-2 flex items-center gap-2 group-hover/header:text-blue-600 transition-colors duration-500">
                                            <span class="inline-block w-8 h-[3px] bg-blue-600 rounded-full transition-[width] duration-500 ease-out group-hover/header:w-12"></span>
                                            <span class="transition-transform duration-500 group-hover/header:translate-x-1">Inventory System</span>
                                        </p>
                                    </div>

                                    <button type="button" onclick="closeAddBookModal()" class="group/close relative">
                                        <div class="relative flex items-center justify-center w-11 h-11 bg-white border-2 border-slate-100 rounded-xl transition-all duration-500 
                                            group-hover/close:bg-rose-500 group-hover/close:border-rose-500 group-hover/close:rotate-90 
                                            group-hover/close:shadow-[0_0_20px_rgba(244,63,94,0.5)]">
                                            <span class="material-symbols-outlined text-slate-400 group-hover/close:text-white text-xl font-bold transition-colors">close</span>
                                        </div>
                                    </button>
                                </div>

                                <div class="flex-1 overflow-y-auto px-10 custom-scrollbar">
                                    <form id="addBookForm" action="{{ route('admin.books.store') }}" method="POST" class="space-y-6 pb-2">
                                        @csrf
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                                            @php
                                                $fields = [
                                                    ['name' => 'title', 'label' => 'Book Title', 'icon' => 'menu_book', 'placeholder' => 'e.g. Keluarga Cemara', 'note' => 'Use the official title of the book.', 'type' => 'text', 'max' => 100],
                                                    ['name' => 'author_name', 'label' => 'Author Name', 'icon' => 'person_edit', 'placeholder' => 'e.g. Arswendo Atmowiloto', 'note' => "Author's full name.", 'type' => 'dropdown', 'options' => $authors, 'max' => 50],
                                                    ['name' => 'category_name', 'label' => 'Category', 'icon' => 'category', 'placeholder' => 'e.g. Novel', 'note' => "The primary category.", 'type' => 'dropdown', 'options' => $categories, 'max' => 40],
                                                    ['name' => 'publisher', 'label' => 'Publisher', 'icon' => 'apartment', 'placeholder' => 'e.g. Gramedia Pustaka Utama', 'note' => 'The name of publishing company.', 'type' => 'dropdown', 'options' => ['Gramedia Pustaka Utama'], 'max' => 50],
                                                    ['name' => 'published_date', 'label' => 'Published Date', 'icon' => 'event', 'placeholder' => '', 'note' => 'Format: Day Month Year.', 'type' => 'date'],
                                                    ['name' => 'total_pages', 'label' => 'Total Pages', 'icon' => 'auto_stories', 'placeholder' => 'e.g. 288', 'note' => 'Total number of pages.', 'type' => 'pages', 'min' => 1, 'max' => 1000],
                                                    ['name' => 'tags', 'label' => 'Tags / Keywords', 'icon' => 'sell', 'placeholder' => 'e.g. Novel, Teen', 'note' => 'Max 10 tags, separate with commas.', 'type' => 'tags', 'options' => $tags, 'max' => 225],
                                                    ['name' => 'cover_image', 'label' => 'Cover Image URL', 'icon' => 'link', 'placeholder' => 'https://...', 'note' => 'Ensure valid image URL.', 'type' => 'text', 'max' => 225],
                                                ];
                                            @endphp

                                            @foreach($fields as $field)
                                            <div id="group_{{ $field['name'] }}" class="space-y-3 group/field transition-all duration-300 relative hover:-translate-y-1 focus-within:-translate-y-1 [&.is-active]:-translate-y-1 dropdown-container">
                                                <label class="text-[11px] font-extrabold text-slate-400 uppercase tracking-[0.3em] block font-accent transition-colors duration-300 group-hover/field:text-blue-600 group-focus-within/field:text-blue-600 group-[.is-active]/field:text-blue-600">
                                                    {{ $field['label'] }}
                                                </label>
                                                
                                                    <div class="relative {{ $field['type'] == 'pages' ? 
                                                        'flex items-center bg-white rounded-[1.8rem] shadow-inner border border-slate-200 border-r-4 border-r-slate-200 transition-all duration-700 ' .
                                                        'focus-within:ring-8 focus-within:ring-blue-600/5 focus-within:border-blue-500/40 focus-within:border-r-blue-500/60 focus-within:shadow-xl focus-within:shadow-blue-900/10 ' .
                                                        'group-[.is-active]/field:ring-8 group-[.is-active]/field:ring-blue-600/5 group-[.is-active]/field:border-blue-500/40 group-[.is-active]/field:border-r-blue-500/60 group-[.is-active]/field:shadow-xl group-[.is-active]/field:shadow-blue-900/10' 
                                                        : '' }}">
        
                                                        <span class="material-symbols-outlined absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none group-focus-within/field:text-blue-600 group-[.is-active]/field:text-blue-600 transition-colors z-10">
                                                            {{ $field['icon'] }}
                                                        </span>

                                                    <div class="{{ $field['type'] == 'pages' ? 'flex items-center ml-14 w-full overflow-hidden' : '' }}">
                                                    <input type="{{ $field['type'] == 'date' ? 'date' : ($field['type'] == 'pages' ? 'number' : 'text') }}"
                                                        name="{{ $field['name'] }}" 
                                                        id="input_{{ $field['name'] }}" 
                                                        required 
                                                        autocomplete="off"
                                                        

                                                        @if(isset($field['max']))
                                                            @if($field['type'] == 'pages')
                                                                max="{{ $field['max'] }}"
                                                            @else
                                                                maxlength="{{ $field['max'] }}"
                                                            @endif
                                                        @endif

                                                        @if(isset($field['max']) && $field['type'] !== 'pages') 
                                                            maxlength="{{ $field['max'] }}" 
                                                        @endif

                                                        @if($field['type'] == 'pages')
                                                            min="{{ $field['min'] ?? 1 }}"
                                                            max="{{ $field['max'] ?? 1000 }}"
                                                            onkeydown="if(['e', 'E', '+', '-', '0'].includes(event.key) && this.value.length === 0) event.preventDefault(); if(['e', 'E', '+', '-'].includes(event.key)) event.preventDefault();"
                                                        @endif

                                                        oninput="checkInputStatus(this); handleMaxLimit(this); if('{{ $field['type'] }}' === 'pages') {
                                                            if(parseInt(this.value) > {{ $field['max'] ?? 1000 }}) this.value = {{ $field['max'] ?? 1000 }};
                                                            const charCount = this.value.length > 0 ? this.value.length : this.placeholder.length;
                                                            const factor = this.value.length > 0 ? 8.5 : 7.5; 
                                                            this.style.width = (charCount * factor + 4) + 'px';
                                                        }"
                                                       {{-- @if($field['type'] == 'tags') onkeydown="handleTagInput(event, this)" @endif --}}
                                                        placeholder="{{ $field['placeholder'] }}"
                                                        @if($field['type'] == 'pages') 
                                                            style="width: {{ strlen($field['placeholder']) * 7.5 + 2 }}px; min-width: 10px; max-width: fit-content;"
                                                        @endif
                                                        class="{{ $field['type'] == 'pages' 
                                                            ? 'bg-transparent py-5 text-sm font-black outline-none border-none ring-0 focus:ring-0 text-slate-700 [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none p-0 m-0' 
                                                            : 'w-full bg-white rounded-[1.8rem] py-5 pl-14 text-sm font-black transition-all duration-700 ease-in-out outline-none text-slate-700 shadow-inner border border-slate-200 border-r-4 border-r-slate-200 ' . 
                                                            'focus:ring-8 focus:ring-blue-600/5 focus:border-blue-500/40 focus:border-r-blue-500/60 focus:shadow-xl focus:shadow-blue-900/10 ' .
                                                            'group-[.is-active]/field:ring-8 group-[.is-active]/field:ring-blue-600/5 group-[.is-active]/field:border-blue-500/40 group-[.is-active]/field:border-r-blue-500/60 group-[.is-active]/field:shadow-xl group-[.is-active]/field:shadow-blue-900/10 ' .
                                                            (in_array($field['type'], ['dropdown', 'tags']) ? 'pr-14' : 'pr-6') 
                                                        }}">

                                                    @if($field['type'] == 'pages')
                                                        <span class="text-sm font-black text-slate-400 pointer-events-none  ml-0.5 whitespace-nowrap">
                                                            pages
                                                        </span>
                                                    @endif
                                                </div>
                                                
                                                    @if(in_array($field['type'], ['dropdown', 'tags']))
                                                        <span onclick="toggleDropdown('list_{{ $field['name'] }}', this)" 
                                                            class="material-symbols-outlined absolute right-6 top-1/2 -translate-y-1/2 text-slate-300 cursor-pointer pointer-events-auto transition-all duration-500 hover:text-blue-500 z-20 dropdown-trigger-icon">
                                                            expand_more
                                                        </span>

                                                        {{-- Menu Dropdown Melayang --}}
                                                        <div id="list_{{ $field['name'] }}" 
                                                            class="hidden absolute left-0 right-0 top-[105%] bg-white/95 backdrop-blur-xl border border-white/20 rounded-2xl shadow-[0_20px_50px_rgba(0,0,0,0.15)] z-[100] overflow-hidden dropdown-animate-container">
                                                            
                                                            {{-- Header Dropdown (Sort Options Style) --}}
                                                            <div class="px-4 pt-4 pb-4 text-center">
                                                                <span class="text-[13px] font-semibold uppercase tracking-[0.2em] text-blue-600/60 font-accent">
                                                                    Select {{ $field['label'] }}
                                                                </span>
                                                            </div>

                                                            <div class="py-2 max-h-40 overflow-y-auto custom-scrollbar">
                                                                @foreach($field['options'] as $option)
                                                                    <div onclick="selectOption('{{ $field['name'] }}', '{{ $option }}', '{{ $field['type'] }}')" 
                                                                        class="group mx-2 mb-2 flex items-center justify-between px-4 py-2.5 rounded-xl text-sm border-2 transition-all duration-500 ease-out font-accent font-semibold cursor-pointer
                                                                        bg-white border-blue-100 text-blue-600 hover:bg-blue-600 hover:border-blue-600 hover:text-white hover:-translate-y-1">
                                                                        
                                                                        <span class="truncate pr-2 max-w-[200px]">{{ $option }}</span>
                                                                        
                                                                        {{-- Ikon Check (Akan muncul jika value di input sama dengan opsi ini) --}}
                                                                        <span class="check-icon hidden material-symbols-outlined text-[18px] font-normal shrink-0">check_circle</span>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>

                                                <div class="flex items-center gap-2 px-1 transition-all duration-500 opacity-40 group-hover/modal:opacity-100 group-[.is-active]/field:opacity-100">
                                                    <span class="material-symbols-outlined text-blue-500 text-sm transition-all duration-500 group-hover/field:scale-110 group-[.is-active]/field:scale-110">info</span>
                                                    <p class="text-[10px] text-slate-500 font-medium group-hover/modal:text-slate-700">
                                                        <span class="font-bold">Note:</span> {{ $field['note'] }}
                                                    </p>
                                                </div>
                                            </div>
                                            @endforeach

                                            <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-4 gap-6 items-stretch"> <div id="group_summary" class="md:col-span-3 flex flex-col space-y-3 group/field transition-all duration-300 relative hover:-translate-y-1 focus-within:-translate-y-1 [&.is-active]:-translate-y-1 h-full">
                                                    <label class="text-[11px] font-extrabold text-slate-400 uppercase tracking-[0.3em] block font-accent transition-colors duration-300 
                                                        group-hover/field:text-blue-600 group-focus-within/field:text-blue-600 group-[.is-active]/field:text-blue-600">
                                                        Book Summary
                                                    </label>
                                                    
                                                    <div class="relative flex-grow">
                                                        <textarea name="summary" id="input_summary" required maxlength="1500" oninput="checkInputStatus(this); handleMaxLimit(this)"
                                                            class="w-full h-full bg-white rounded-[1.8rem] py-5 px-8 text-sm font-black transition-all duration-700 ease-in-out outline-none text-slate-700 shadow-inner border border-slate-200 border-r-4 border-r-slate-200 resize-none
                                                            focus:ring-8 focus:ring-blue-600/5 focus:border-blue-500/40 focus:border-r-blue-500/60 focus:shadow-xl focus:shadow-blue-900/10
                                                            group-[.is-active]/field:ring-8 group-[.is-active]/field:ring-blue-600/5 group-[.is-active]/field:border-blue-500/40 group-[.is-active]/field:border-r-blue-500/60 group-[.is-active]/field:shadow-xl group-[.is-active]/field:shadow-blue-900/10"></textarea>
                                                    </div>

                                                    <div class="flex items-center gap-2 px-1 transition-all duration-500 opacity-40 group-hover/modal:opacity-100 group-[.is-active]/field:opacity-100">
                                                        <span class="material-symbols-outlined text-blue-500 text-sm transition-all duration-500 group-hover/field:scale-110 group-[.is-active]/field:scale-110">description</span>
                                                        <p class="text-[10px] text-slate-500 font-medium group-hover/modal:text-slate-700">
                                                            <span class="font-bold">Note:</span> Enter a brief story summary or book synopsis that highlights the main conflict and characters.
                                                        </p>
                                                    </div>
                                                </div>

                                                <div id="group_cover_preview" class="md:col-span-1 space-y-3 group/field transition-all duration-300 relative hover:-translate-y-1 [&.is-active]:-translate-y-1">
                                                    <label class="text-[11px] font-extrabold text-slate-400 uppercase tracking-[0.3em] block font-accent transition-colors duration-300 
                                                        group-hover/field:text-blue-600 group-[.is-active]/field:text-blue-600 text-center">
                                                        Cover Preview
                                                    </label>
                                                    
                                                    <div id="cover_preview_card" class="relative aspect-[3/4] bg-white rounded-[1.8rem] shadow-inner border border-slate-200 border-r-4 border-r-slate-200 overflow-hidden flex items-center justify-center transition-all duration-700
                                                        group-[.is-active]/field:ring-8 group-[.is-active]/field:ring-blue-600/5 group-[.is-active]/field:border-blue-500/40 group-[.is-active]/field:border-r-blue-500/60 group-[.is-active]/field:shadow-xl group-[.is-active]/field:shadow-blue-900/10">
                                                        
                                                        <div id="placeholder_icon" class="flex flex-col items-center text-slate-300">
                                                            <span class="material-symbols-outlined text-3xl">image</span>
                                                            <span class="text-[11px] font-black tracking-tighter text-center">No Preview</span>
                                                        </div>
                                                        <img id="preview_img" src="" class="hidden w-full h-full object-cover">
                                                    </div>
                                                </div>
                                            </div>

                                            <script>
                                                document.getElementById('input_cover_image').addEventListener('input', function() {
                                                    const previewImg = document.getElementById('preview_img');
                                                    const placeholder = document.getElementById('placeholder_icon');
                                                    const groupPreview = document.getElementById('group_cover_preview');
                                                    
                                                    if (this.value.trim() !== "") {
                                                        previewImg.src = this.value;
                                                        previewImg.classList.remove('hidden');
                                                        placeholder.classList.add('hidden');
                                                        groupPreview.classList.add('is-active');
                                                    } else {
                                                        previewImg.classList.add('hidden');
                                                        previewImg.src = "";
                                                        placeholder.classList.remove('hidden');
                                                        groupPreview.classList.remove('is-active');
                                                    }
                                                });
                                            </script>
                                        </div>
                                    </form>
                                </div>

                                <div class="px-10 pb-7 pt-4 bg-[#F8F9FC]">
                                    <button type="submit" form="addBookForm"
                                        class="w-full flex items-center justify-center gap-4 px-10 py-5 rounded-[2rem] font-black font-accent uppercase tracking-widest text-[11px] text-white transition-all duration-500 ease-in-out transform 
                                        hover:-translate-y-1 hover:bg-right 
                                        shadow-2xl shadow-slate-900/20 hover:shadow-[0_15px_30px_-5px_rgba(37,99,235,0.4)]
                                        bg-gradient-to-r from-blue-700 via-blue-600 to-cyan-500 bg-[length:250%_150%] bg-left
                                        group/btn border-t border-white/10 relative overflow-hidden">
                                        
                                        <span class="inline-block transition-all duration-500 group-hover/btn:scale-125 group-hover/btn:rotate-12">
                                            <span class="material-symbols-outlined text-xl block">add_circle</span>
                                        </span>
                                        
                                        <span class="relative z-10">Confirm Add New Book</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script>

                    function handleTagInput(event, element) {
                        if (event.key === ',') {
                            setTimeout(() => {
                                if (!element.value.endsWith(', ')) {
                                    element.value = element.value.trim() + ', ';
                                }
                            }, 0);
                        }
                    }
                        function checkInputStatus(input) {
                            const container = input.closest('.group\\/field');
                            if (container) {
                                if (input.value && input.value.trim() !== "") {
                                    container.classList.add('is-active');
                                } else {
                                    container.classList.remove('is-active');
                                }
                            }
                        }

                        function handleMaxLimit(input) {
                            const maxLength = input.getAttribute('maxlength');
                            const maxValue = input.getAttribute('max');
                            input.setCustomValidity("");
                            let isMax = false;
                            let message = "";

                            if (maxLength && input.value.length >= maxLength) {
                                isMax = true;
                                message = "Batas maksimal " + maxLength + " karakter telah tercapai.";
                            } else if (maxValue && input.type === 'number' && parseInt(input.value) >= parseInt(maxValue)) {
                                isMax = true;
                                message = "Nilai maksimal adalah " + maxValue + ".";
                            }

                            if (isMax) {
                                input.setCustomValidity(message);
                                input.reportValidity();
                                setTimeout(() => {
                                    input.setCustomValidity("");
                                    input.reportValidity();
                                }, 3000);
                            }
                        }

                        function toggleDropdown(id, iconElement) {
                            const dropdown = document.getElementById(id);
                            const container = iconElement.closest('.group\\/field');
                            const input = document.getElementById(id.replace('list_', 'input_'));
                            const isOpen = !dropdown.classList.contains('hidden');

                            document.querySelectorAll('[id^="list_"]').forEach(el => el.classList.add('hidden'));
                            document.querySelectorAll('.dropdown-trigger-icon').forEach(ic => ic.classList.remove('dropdown-active'));
                            document.querySelectorAll('.group\\/field').forEach(gr => gr.classList.remove('dropdown-open'));

                            if (!isOpen) {
                                updateActiveState(id.replace('list_', ''), input.value);
                                dropdown.classList.remove('hidden');
                                iconElement.classList.add('dropdown-active');
                                container.classList.add('dropdown-open');
                            }
                        }

                        function selectOption(name, value, type) {
                            const input = document.getElementById('input_' + name);
                            if (type === 'tags') {
                                let tags = input.value.split(',').map(t => t.trim()).filter(t => t !== "");
                                if (!tags.includes(value)) {
                                    if (tags.length < 10) {
                                        tags.push(value);
                                        input.value = tags.join(', ') + ', ';
                                    }
                                } else {
                                    tags = tags.filter(t => t !== value);
                                    input.value = tags.length > 0 ? tags.join(', ') + ', ' : '';
                                }
                                updateActiveState(name, input.value);
                                setTimeout(() => { input.scrollLeft = input.scrollWidth; }, 10);
                            } else {
                                input.value = value;
                                updateActiveState(name, value);
                                setTimeout(() => {
                                    document.getElementById('list_' + name).classList.add('hidden');
                                    const trigger = input.closest('.relative')?.querySelector('.dropdown-trigger-icon');
                                    if (trigger) trigger.classList.remove('dropdown-active');
                                }, 150);
                            }
                            checkInputStatus(input);
                        }

                        function updateActiveState(fieldName, currentInputValue) {
                            const listItems = document.querySelectorAll(`#list_${fieldName} .group`);
                            const isTags = fieldName.includes('tags');
                            const currentTags = currentInputValue.split(',').map(t => t.trim()).filter(t => t !== "");

                            listItems.forEach(item => {
                                const text = item.querySelector('span').innerText.trim();
                                const check = item.querySelector('.check-icon');
                                const isActive = isTags ? currentTags.includes(text) : (text === currentInputValue.trim());

                                if (isActive) {
                                    item.classList.add('bg-blue-600', 'text-white', 'item-selected');
                                    item.classList.remove('bg-white', 'text-blue-600');
                                    check?.classList.remove('hidden');
                                } else {
                                    item.classList.remove('bg-blue-600', 'text-white', 'item-selected');
                                    item.classList.add('bg-white', 'text-blue-600');
                                    check?.classList.add('hidden');
                                }
                            });
                        }

                        document.addEventListener('DOMContentLoaded', function() {
                            const addBookForm = document.getElementById('addBookForm');
                            const tagsInput = document.getElementById('input_tags');
                            const pageInput = document.getElementById('input_total_pages');
                            let isSubmitting = false;

                            if (addBookForm) {
                                addBookForm.addEventListener('submit', function(e) {
                                    if (pageInput) {
                                const numericValue = pageInput.value.toString().replace(/[^0-9]/g, '');
                                pageInput.value = numericValue;
                            }

                                    if (isSubmitting) {
                                        e.preventDefault();
                                        return false;
                                    }
                                    isSubmitting = true;
                                    const submitBtn = this.querySelector('button[type="submit"]');
                                    if (submitBtn) {
                                        submitBtn.disabled = true;
                                        submitBtn.innerHTML = `<span class="material-symbols-outlined animate-spin">sync</span><span>Processing...</span>`;
                                    }
                                });
                            }

                            if (tagsInput) {
                                tagsInput.addEventListener('input', function() {
                                    if (this.value.endsWith(',')) {
                                        this.value = this.value + ' ';
                                        updateActiveState('tags', this.value);
                                    }
                                    checkInputStatus(this);
                                });
                            }
                        });

                        function openAddBookModal() {
                            const modal = document.getElementById('borrowModal');
                            const scrollY = window.scrollY;
                            modal.classList.remove('hidden');
                            modal.classList.add('flex');
                            document.body.style.cssText = `position: fixed; top: -${scrollY}px; width: 100%; overflow-y: scroll;`;
                            
                            requestAnimationFrame(() => {
                                document.getElementById('modalBackdrop').classList.add('opacity-100');
                                document.getElementById('modalContent').classList.add('animate-modal-in');
                            });
                        }

                        function closeAddBookModal() {
                            const modal = document.getElementById('borrowModal');
                            const content = document.getElementById('modalContent');
                            const scrollY = document.body.style.top;
                            
                            modal.classList.add('hidden');
                            modal.classList.remove('flex');
                            document.body.style.cssText = '';
                            window.scrollTo(0, parseInt(scrollY || '0') * -1);
                        }

                        window.onclick = function(e) {
                            if (!e.target.closest('.dropdown-container')) {
                                document.querySelectorAll('[id^="list_"]').forEach(el => el.classList.add('hidden'));
                                document.querySelectorAll('.dropdown-trigger-icon').forEach(ic => ic.classList.remove('dropdown-active'));
                            }
                        }
                    </script>

                    <style>
                        @keyframes modal-in {
                            0% { 
                                opacity: 0; 
                                transform: scale(0.9) translateY(20px); 
                            }
                            100% { 
                                opacity: 1; 
                                transform: scale(1) translateY(0); 
                            }
                        }
                        .animate-modal-in {
                            animation: modal-in 0.4s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
                        }
                            .custom-scrollbar::-webkit-scrollbar {
                                width: 5px;
                            }
                            .custom-scrollbar::-webkit-scrollbar-track {
                                background: transparent;
                            }
                            .custom-scrollbar::-webkit-scrollbar-thumb {
                                background: #E2E8F0;
                                border-radius: 10px;
                            }
                            .custom-scrollbar::-webkit-scrollbar-thumb:hover {
                                background: #3B82F6;
                            }
                            .custom-scrollbar {
                                scrollbar-width: thin;
                                scrollbar-color: #E2E8F0 transparent;
                            }
                        #modalBackdrop {
                            will-change: opacity, backdrop-filter;
                        }
                        @keyframes modal-out {
                            0% { 
                                opacity: 1; 
                                transform: scale(1) translateY(0); 
                            }
                            100% { 
                                opacity: 0; 
                                transform: scale(0.95) translateY(10px); 
                            }
                        }
                        .animate-modal-out {
                            animation: modal-out 300ms ease-in forwards !important;
                        }
                        #modalBackdrop {
                            transition: opacity 300ms ease-in-out;
                            will-change: opacity;
                        }
                        .dropdown-active {
                            transform: translateY(-50%) rotate(180deg) !important;
                            color: #2563eb !important;
                        }
                        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
                        .custom-scrollbar::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }
                        .group\/field:focus-within, 
                        .group\/field.dropdown-open {
                            z-index: 50 !important;
                        }
                        [id^="list_"] {
                            background-color: white !important;
                            opacity: 1 !important;
                            visibility: visible !important;
                        }
                        .dropdown-animate-container:not(.hidden) {
                            display: block !important;
                            animation: dropdown-in 0.5s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
                        }
                        @keyframes dropdown-in {
                            0% { opacity: 0; transform: translateY(-1rem) scale(0.95); }
                            100% { opacity: 1; transform: translateY(0) scale(1); }
                        }
                        @supports not (backdrop-filter: blur(20px)) {
                            .backdrop-blur-xl {
                                background-color: rgba(255, 255, 255, 0.98) !important;
                            }
                        }
                        .item-selected {
                            background-color: #2563eb !important; 
                            border-color: #2563eb !important;
                            color: white !important;
                        }
                    </style>

                    
                
                        <div class="flex flex-wrap items-center justify-center gap-6">
                            {{-- 1. Category Filter Dropdown (Tetap sesuai model Anda) --}}
                            <div class="relative" x-data="{ open: false }" @click.away="open = false">
                                    <button @click="open = !open" 
                                        type="button"
                                        class="relative overflow-hidden flex items-center justify-center bg-blue-600 px-4 py-3 rounded-[1.25rem] text-white w-48
                                            shadow-[0_10px_25px_rgba(37,99,235,0.4)] 
                                            transition-all duration-500 [transition-timing-function:cubic-bezier(0.34,1.56,0.64,1)]
                                            hover:shadow-[0_20px_40px_rgba(43,108,238,0.5)] hover:-translate-y-2 hover:scale-[1.02]
                                            group" :class="open ? 'shadow-[0_20px_40px_rgba(43,108,238,0.5)] -translate-y-2 scale-[1.02]' : ''">
                                    
                                    <span class="absolute inset-0 bg-gradient-to-r from-blue-700 to-cyan-500 opacity-0 transition-opacity duration-500 group-hover:opacity-100" :class="open ? 'opacity-100' : 'opacity-0'"> </span>

                                    <span class="relative z-10 flex items-center justify-center w-full gap-2">
                                        <span class="material-symbols-outlined text-xl transition-all duration-500 group-hover:rotate-12 group-hover:scale-110 group-hover:-translate-x-1 shrink-0" :class="open ? 'rotate-12 scale-110 -translate-x-1' : ''">
                                            filter_list
                                        </span>

                                        <span class="text-sm font-semibold font-accent tracking-wide truncate text-center flex-1">
                                            {{ request('category') && request('category') !== 'All Books' ? request('category') : 'All Books' }}
                                        </span>

                                        <span class="material-symbols-outlined text-sm transition-all duration-500 group-hover:scale-125 shrink-0 origin-center" 
                                            :class="open ? 'rotate-180 scale-125' : ''">
                                            expand_more
                                        </span>
                                    </span>
                                </button>

                                <div x-show="open" 
                                    x-cloak
                                    x-transition:enter="transition ease-[cubic-bezier(0.34,1.56,0.64,1)] duration-500"
                                    x-transition:enter-start="opacity-0 -translate-y-4 scale-95"
                                    x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                                    x-transition:leave="transition ease-in duration-200"
                                    x-transition:leave-start="opacity-100 scale-100"
                                    x-transition:leave-end="opacity-0 scale-95"
                                    class="absolute -left-[36px] mt-4 w-64 bg-white/95 dark:bg-slate-900/95 backdrop-blur-xl border border-white/20 dark:border-slate-700/50 rounded-2xl shadow-[0_20px_50px_rgba(0,0,0,0.15)] z-50 overflow-hidden"
                                    style="display: none;">
                                    
                                    <div class="px-4 pt-4 pb-4 text-center">
                                        <span class="text-[13px] font-semibold uppercase tracking-[0.2em] text-blue-600/60 font-accent">
                                            Select Category
                                        </span>
                                    </div>

                                    <div class="py-2 max-h-72 overflow-y-auto custom-scrollbar"> 
                                        <a href="{{ route('admin.books', ['search' => request('search'), 'sort' => request('sort')]) }}"
                                        class="group mx-2 mb-2 flex items-center justify-between px-4 py-2.5 rounded-xl text-sm border-2 transition-all duration-500 ease-out font-accent font-semibold
                                        {{ !request('category') || request('category') == 'All Books' 
                                            ? 'bg-blue-600 border-blue-600 text-white' 
                                            : 'bg-white dark:bg-transparent border-blue-100 dark:border-blue-900/30 text-blue-600 hover:bg-blue-600 hover:border-blue-600 hover:text-white hover:-translate-y-1' }}">
                                        <span class="truncate pr-2 max-w-[170px]">All Books</span>
                                        @if(!request('category') || request('category') == 'All Books')
                                                <span class="material-symbols-outlined text-[18px] font-normal shrink-0">check_circle</span>
                                        @endif
                                        </a>

                                        @foreach($categories as $cat)
                                            @if(!empty(trim($cat))) 
                                            <a href="{{ route('admin.books', ['category' => $cat, 'search' => request('search'), 'sort' => request('sort')]) }}"
                                            class="group mx-2 mb-2 flex items-center justify-between px-4 py-2.5 rounded-xl text-sm border-2 transition-all duration-500 ease-out font-accent font-semibold
                                            {{ request('category') == $cat 
                                                ? 'bg-blue-600 border-blue-600 text-white' 
                                                : 'bg-white dark:bg-transparent border-blue-100 dark:border-blue-900/30 text-blue-600 hover:bg-blue-600 hover:border-blue-600 hover:text-white hover:-translate-y-1' }}">
                                                <span class="capitalize truncate pr-2 max-w-[170px]">{{ $cat }}</span>
                                                @if(request('category') == $cat)
                                                    <span class="material-symbols-outlined text-[18px] font-normal shrink-0">check_circle</span>
                                                @endif
                                            </a>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>

                                <style>
                                    .custom-scrollbar::-webkit-scrollbar {
                                        width: 4px;
                                    }
                                    .custom-scrollbar::-webkit-scrollbar-track {
                                        background: transparent;
                                    }
                                    .custom-scrollbar::-webkit-scrollbar-thumb {
                                        background: rgba(100, 116, 139, 0.2);
                                        border-radius: 10px;
                                    }
                                </style>
                            </div>

                            {{-- 2. Search Bar - PLEK KETIPLEK 100% (Ukuran, Efek, & Posisi Sejajar) --}}
                            <div class="w-full max-w-2xl relative h-[70px] flex items-center"> {{-- Container penyeimbang tinggi --}}
                                <form action="{{ route('admin.books') }}" method="GET" class="w-full relative group">
                                    @if(request('category'))
                                        <input type="hidden" name="category" value="{{ request('category') }}">
                                    @endif

                                    @if(request('sort'))
                                        <input type="hidden" name="sort" value="{{ request('sort') }}">
                                    @endif

                                    {{-- Button Search - Persis Referensi (Tanpa Zoom saat Klik/Focus) --}}
                                    <button type="submit" class="absolute left-6 top-1/2 -translate-y-[42%] outline-none z-10">
                                        <span class="material-symbols-outlined 
                                                    text-slate-400 text-2xl 
                                                    transition-all duration-300 ease-in-out
                                                    group-focus-within:text-blue-600 
                                                    hover:text-blue-600 hover:translate-x-1 hover:scale-110
                                                    leading-none">
                                            search
                                        </span>
                                    </button>
                                    
                                    {{-- Input Search - Persis Referensi (Tinggi py-6 & Rounded-[2rem]) --}}
                                    <input 
                                        type="text" 
                                        name="search" 
                                        value="{{ request('search') }}"
                                        class="w-full bg-white border border-slate-200 rounded-[2rem] py-6 pl-16 pr-8 text-sm transition-all outline-none text-slate-700 font-medium placeholder:text-slate-300
                                            shadow-xl shadow-blue-900/5 
                                            group-focus-within:ring-4 group-focus-within:ring-blue-600/10 
                                            group-focus-within:border-blue-400 
                                            group-focus-within:shadow-blue-900/10" 
                                        placeholder="Search Titles, Authors Or Category..." 
                                    />
                                </form>
                            </div>

                            


                            {{-- 2. Sort Filter Dropdown (Plek Ketiplek Sama Persis) --}}
                        <div class="relative" x-data="{ open: false }" @click.away="open = false">
                            <button @click="open = !open" 
                                type="button"
                                class="relative overflow-hidden flex items-center justify-center bg-blue-600 px-4 py-3 rounded-[1.25rem] text-white w-48
                                    shadow-[0_10px_25px_rgba(37,99,235,0.4)] 
                                    transition-all duration-500 [transition-timing-function:cubic-bezier(0.34,1.56,0.64,1)]
                                    hover:shadow-[0_20px_40px_rgba(43,108,238,0.5)] hover:-translate-y-2 hover:scale-[1.02]
                                    group" 
                                :class="open ? 'shadow-[0_20px_40px_rgba(43,108,238,0.5)] -translate-y-2 scale-[1.02]' : ''">
                                
                                {{-- Efek Gradient Background --}}
                                <span class="absolute inset-0 bg-gradient-to-r from-blue-700 to-cyan-500 opacity-0 transition-opacity duration-500 group-hover:opacity-100" 
                                    :class="open ? 'opacity-100' : 'opacity-0'"> 
                                </span>

                                <span class="relative z-10 flex items-center justify-center w-full gap-2">
                                    {{-- Icon Kiri (Sort) --}}
                                    <span class="material-symbols-outlined text-xl transition-all duration-500 group-hover:-rotate-12 group-hover:scale-110 group-hover:translate-x-1 shrink-0" 
                                        :class="open ? '-rotate-12 scale-110 translate-x-1' : ''">
                                        sort
                                    </span>

                                    {{-- Tulisan Sort By --}}
                                    <span class="text-sm font-semibold font-accent tracking-wide truncate text-center flex-1">
                                        @php
                                            $sortOptions = [
                                                'latest_id'     => 'Newest ID',
                                                'oldest_id'     => 'Oldest ID',
                                                'az'            => 'Alphabet A-Z',
                                                'za'            => 'Alphabet Z-A',
                                                'most_borrowed' => 'Most Borrowed'
                                            ];
                                            $currentSort = request('sort', 'latest_id');
                                        @endphp
                                        {{ $sortOptions[$currentSort] ?? 'Newest ID' }}
                                    </span>

                                    {{-- Icon Panah (Kanan) --}}
                                    <span class="material-symbols-outlined text-sm transition-all duration-500 group-hover:scale-125 shrink-0 origin-center" 
                                        :class="open ? 'rotate-180 scale-125' : ''">
                                        expand_more
                                    </span>
                                </span>
                            </button>

                            {{-- Dropdown Isi Sort (Gunakan x-show="open" agar sama) --}}
                            <div x-show="open" 
                                x-cloak
                                x-transition:enter="transition ease-[cubic-bezier(0.34,1.56,0.64,1)] duration-500"
                                x-transition:enter-start="opacity-0 -translate-y-4 scale-95"
                                x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                                x-transition:leave="transition ease-in duration-200"
                                x-transition:leave-start="opacity-100 scale-100"
                                x-transition:leave-end="opacity-0 scale-95"
                                class="absolute -left-[36px] mt-4 w-64 bg-white/95 dark:bg-slate-900/95 backdrop-blur-xl border border-white/20 dark:border-slate-700/50 rounded-2xl shadow-[0_20px_50px_rgba(0,0,0,0.15)] z-50 overflow-hidden"
                                style="display: none;">
                                
                                <div class="px-4 pt-4 pb-4 text-center">
                                    <span class="text-[13px] font-semibold uppercase tracking-[0.2em] text-blue-600/60 font-accent">
                                        Sort Options
                                    </span>
                                </div>

                                <div class="py-2 max-h-72 overflow-y-auto custom-scrollbar"> 
                                    @php
                                        $sortOptions = [
                                            'latest_id'     => 'Newest ID',
                                            'oldest_id'     => 'Oldest ID',
                                            'az'            => 'Alphabet A-Z',
                                            'za'            => 'Alphabet Z-A',
                                            'most_borrowed' => 'Most Borrowed'
                                        ];
                                    @endphp

                                    @foreach($sortOptions as $key => $label)
                                        <a href="{{ request()->fullUrlWithQuery(['sort' => $key]) }}"
                                        class="group mx-2 mb-2 flex items-center justify-between px-4 py-2.5 rounded-xl text-sm border-2 transition-all duration-500 ease-out font-accent font-semibold
                                        {{ request('sort', 'latest_id') == $key 
                                            ? 'bg-blue-600 border-blue-600 text-white' 
                                            : 'bg-white dark:bg-transparent border-blue-100 dark:border-blue-900/30 text-blue-600 hover:bg-blue-600 hover:border-blue-600 hover:text-white hover:-translate-y-1' }}">
                                            
                                            {{-- Truncate dan Max-Width disamakan persis dengan referensi --}}
                                            <span class="truncate pr-2 max-w-[170px]">{{ $label }}</span>
                                            
                                            @if(request('sort', 'latest_id') == $key)
                                                {{-- Ikon menggunakan font-normal dan ukuran 18px sesuai referensi --}}
                                                <span class="material-symbols-outlined text-[18px] font-normal shrink-0">check_circle</span>
                                            @endif
                                        </a>
                                    @endforeach
                                </div>
                            </div>

                            <style>
                                .custom-scrollbar::-webkit-scrollbar {
                                    width: 4px;
                                }
                                .custom-scrollbar::-webkit-scrollbar-track {
                                    background: transparent;
                                }
                                .custom-scrollbar::-webkit-scrollbar-thumb {
                                    background: rgba(100, 116, 139, 0.2);
                                    border-radius: 10px;
                                }
                            </style>
                        </div>

                            
                        </div>

                        <div class="section-container hover-blue group relative isolate !mt-10">
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


                            @forelse($books as $book)
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
                                    /* Shadow diubah ke Blue dengan ketebalan 0.2 dan radius 20px (Sama persis dengan History) */
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
                                    <button type="button" 
                                        id="edit-btn-{{ $book->id }}"
                                        onclick='openUpdateModal(@json($book))' class="group/edit-btn w-10 h-10 flex items-center justify-center bg-blue-600 text-white rounded-xl transition-all duration-300 transform-gpu cursor-pointer
                                        /* TAHAP 1: Shadow Fokus (8px) */
                                        shadow-[0_4px_8px_rgba(37,99,235,0.35)] 
                                        
                                        /* TAHAP 2: Hover (Naik, BG, Shadow Rapat 12px) */
                                        hover:-translate-y-1 hover:bg-blue-500 
                                        hover:shadow-[0_6px_12px_rgba(37,99,235,0.45)] 
                                        active:scale-95">
                                        <span class="material-symbols-outlined text-[20px] transition-transform duration-300 group-hover/edit-btn:-rotate-12">
                                            edit
                                        </span>
                                    </button>

                                    <form action="{{ route('admin.books.destroy', $book->id) }}" method="POST" class="inline">    
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="return confirm('Apakah Anda yakin ingin menghapus buku {{ $book->title }}? Tindakan ini tidak dapat dibatalkan.')" class="group/del-btn w-10 h-10 flex items-center justify-center bg-rose-600 text-white rounded-xl transition-all duration-300 transform-gpu cursor-pointer
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



                        <div id="updateModal" class="fixed inset-0 z-[100] hidden w-full h-full">
                            <div class="absolute inset-0 bg-slate-950/40 backdrop-blur-[6px] opacity-0 transition-opacity duration-300 ease-in-out"
                                id="updateModalBackdrop"
                                onclick="closeUpdateModal()">
                            </div>  
                            
                            <div class="relative flex w-full min-h-full items-center justify-center p-4 md:p-6 pt-24"> 
                                
                                <div id="updateModalContent" class="relative w-full max-w-4xl max-h-[85vh] mt-10 flex flex-col transform overflow-hidden group/modal rounded-[3.5rem] bg-[#F8F9FC] transition-all border border-slate-100 shadow-[0_35px_60px_-15px_rgba(37,99,235,0.25)] group/header">
                                    
                                    <div class="pt-10 pb-4 px-10 flex justify-between items-start">
                                        <div>
                                            <h3 class="text-3xl font-black font-heading tracking-tighter bg-clip-text text-transparent transform-gpu pr-1"
                                                style="background-image: linear-gradient(to right, #2563eb 0%, #0891b2 50%, #22d3ee 100%); 
                                                    -webkit-background-clip: text; 
                                                    -webkit-text-fill-color: transparent;">
                                                Update Book Asset
                                            </h3>
                                            <p class="text-xs text-slate-400 font-bold uppercase tracking-[0.2em] mt-2 flex items-center gap-2 group-hover/header:text-blue-600 transition-colors duration-500">
                                                <span class="inline-block w-8 h-[3px] bg-blue-600 rounded-full transition-[width] duration-500 ease-out group-hover/header:w-12"></span>
                                                <span class="transition-transform duration-500 group-hover/header:translate-x-1">Inventory System</span>
                                            </p>
                                        </div>

                                        <button type="button" onclick="closeUpdateModal()" class="group/close relative">
                                            <div class="relative flex items-center justify-center w-11 h-11 bg-white border-2 border-slate-100 rounded-xl transition-all duration-500 
                                                group-hover/close:bg-rose-500 group-hover/close:border-rose-500 group-hover/close:rotate-90 
                                                group-hover/close:shadow-[0_0_20px_rgba(244,63,94,0.5)]">
                                                <span class="material-symbols-outlined text-slate-400 group-hover/close:text-white text-xl font-bold transition-colors">close</span>
                                            </div>
                                        </button>
                                    </div>

                                    <div class="flex-1 overflow-y-auto px-10 custom-scrollbar">
                                        <form id="updateBookForm" action="" method="POST" class="space-y-6 pb-2">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="api_id" id="update_input_api_id">

                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                                                @php
                                                    $updateFields = [
                                                        ['name' => 'title', 'label' => 'Book Title', 'icon' => 'menu_book', 'placeholder' => 'e.g. Keluarga Cemara', 'note' => 'Use the official title of the book.', 'type' => 'text', 'max' => 100],
                                                        ['name' => 'author_name', 'label' => 'Author Name', 'icon' => 'person_edit', 'placeholder' => 'e.g. Arswendo Atmowiloto', 'note' => "Author's full name.", 'type' => 'dropdown', 'options' => $authors, 'max' => 50],
                                                        ['name' => 'category_name', 'label' => 'Category', 'icon' => 'category', 'placeholder' => 'e.g. Novel', 'note' => "The primary category.", 'type' => 'dropdown', 'options' => $categories, 'max' => 40],
                                                        ['name' => 'publisher', 'label' => 'Publisher', 'icon' => 'apartment', 'placeholder' => 'e.g. Gramedia Pustaka Utama', 'note' => 'The name of publishing company.', 'type' => 'dropdown', 'options' => ['Gramedia Pustaka Utama'], 'max' => 50],
                                                        ['name' => 'published_date', 'label' => 'Published Date', 'icon' => 'event', 'placeholder' => '', 'note' => 'Format: Day Month Year.', 'type' => 'date'],
                                                        ['name' => 'total_pages', 'label' => 'Total Pages', 'icon' => 'auto_stories', 'placeholder' => 'e.g. 288', 'note' => 'Total number of pages.', 'type' => 'pages', 'min' => 1, 'max' => 1000],
                                                        ['name' => 'tags', 'label' => 'Tags / Keywords', 'icon' => 'sell', 'placeholder' => 'e.g. Novel, Teen', 'note' => 'Max 10 tags, separate with commas.', 'type' => 'tags', 'options' => $tags, 'max' => 225],
                                                        ['name' => 'cover_image', 'label' => 'Cover Image URL', 'icon' => 'link', 'placeholder' => 'https://...', 'note' => 'Ensure valid image URL.', 'type' => 'text', 'max' => 225],
                                                    ];
                                                @endphp

                                                @foreach($updateFields as $field)
                                                <div id="update_group_{{ $field['name'] }}" class="space-y-3 group/field transition-all duration-500 relative dropdown-container 
                                                    hover:-translate-y-1 focus-within:-translate-y-1 
                                                    [&.is-active]:-translate-y-1">
                                                    <label class="text-[11px] font-extrabold text-slate-400 uppercase tracking-[0.3em] block font-accent transition-colors duration-300 group-hover/field:text-blue-600 group-focus-within/field:text-blue-600 group-[.is-active]/field:text-blue-600">
                                                        {{ $field['label'] }}
                                                    </label>
                                                    
                                                    <div class="relative {{ $field['type'] == 'pages' ? 'flex items-center bg-white rounded-[1.8rem] shadow-inner border border-slate-200 border-r-4 border-r-slate-200 transition-all duration-700 focus-within:ring-8 focus-within:ring-blue-600/5 focus-within:border-blue-500/40 focus-within:border-r-blue-500/60 focus-within:shadow-xl focus-within:shadow-blue-900/10 group-[.is-active]/field:ring-8 group-[.is-active]/field:ring-blue-600/5 group-[.is-active]/field:border-blue-500/40 group-[.is-active]/field:border-r-blue-500/60 group-[.is-active]/field:shadow-xl group-[.is-active]/field:shadow-blue-900/10' : '' }}">
                                                        <span class="material-symbols-outlined absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none group-focus-within/field:text-blue-600 group-[.is-active]/field:text-blue-600 transition-colors z-10">
                                                            {{ $field['icon'] }}
                                                        </span>

                                                        <div class="{{ $field['type'] == 'pages' ? 'flex items-center ml-14 w-full overflow-hidden' : '' }}">
                                                            <input type="{{ $field['type'] == 'date' ? 'date' : ($field['type'] == 'pages' ? 'number' : 'text') }}"
                                                                name="{{ $field['name'] }}" 
                                                                id="update_input_{{ $field['name'] }}" 
                                                                required 
                                                                autocomplete="off"
                                                                @if($field['type'] == 'pages') max="{{ $field['max'] ?? 1000 }}" @else maxlength="{{ $field['max'] ?? 225 }}" @endif
                                                                oninput="checkUpdateChange(this); handleMaxLimit(this); if('{{ $field['type'] }}' === 'pages') { updatePagesWidth(this, {{ $field['max'] ?? 1000 }}); }"
                                                                placeholder="{{ $field['placeholder'] }}"
                                                                @if($field['type'] == 'pages') 
                                                                    style="min-width: 10px; max-width: fit-content;"
                                                                @endif
                                                                class="{{ $field['type'] == 'pages' 
                                                                    ? 'bg-transparent py-5 text-sm font-black outline-none border-none ring-0 focus:ring-0 text-slate-700 [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none p-0 m-0' 
                                                                    : 'w-full bg-white rounded-[1.8rem] py-5 pl-14 text-sm font-black transition-all duration-700 ease-in-out outline-none text-slate-700 shadow-inner border border-slate-200 border-r-4 border-r-slate-200 focus:ring-8 focus:ring-blue-600/5 focus:border-blue-500/40 focus:border-r-blue-500/60 focus:shadow-xl focus:shadow-blue-900/10 group-[.is-active]/field:ring-8 group-[.is-active]/field:ring-blue-600/5 group-[.is-active]/field:border-blue-500/40 group-[.is-active]/field:border-r-blue-500/60 group-[.is-active]/field:shadow-xl group-[.is-active]/field:shadow-blue-900/10 ' . (in_array($field['type'], ['dropdown', 'tags']) ? 'pr-14' : 'pr-6') }}">
                                                            
                                                            @if($field['type'] == 'pages')
                                                                <span class="text-sm font-black text-slate-400 pointer-events-none ml-0.5 whitespace-nowrap">pages</span>
                                                            @endif
                                                        </div>

                                                        @if(in_array($field['type'], ['dropdown', 'tags']))
                                                            {{-- Trigger Icon --}}
                                                            <span onclick="toggleDropdownUpdate('update_list_{{ $field['name'] }}', this)" 
                                                                class="material-symbols-outlined absolute right-6 top-1/2 -translate-y-1/2 text-slate-300 cursor-pointer pointer-events-auto transition-all duration-500 hover:text-blue-500 z-20 dropdown-trigger-icon">
                                                                expand_more
                                                            </span>

                                                            {{-- Dropdown Menu Container --}}
                                                            <div id="update_list_{{ $field['name'] }}" 
                                                                class="hidden absolute left-0 right-0 top-[105%] bg-white/95 backdrop-blur-xl border border-white/20 rounded-2xl shadow-[0_20px_50px_rgba(0,0,0,0.15)] z-[100] overflow-hidden dropdown-animate-container">
                                                                
                                                                {{-- Header Dropdown (Label) --}}
                                                                <div class="px-4 pt-4 pb-4 text-center">
                                                                    <span class="text-[13px] font-semibold uppercase tracking-[0.2em] text-blue-600/60 font-accent">
                                                                        Select {{ $field['label'] }}
                                                                    </span>
                                                                </div>

                                                                {{-- Options List --}}
                                                                <div class="py-2 max-h-40 overflow-y-auto custom-scrollbar">
                                                                    @foreach($field['options'] as $option)
                                                                        <div onclick="selectUpdateOption('{{ $field['name'] }}', '{{ $option }}', '{{ $field['type'] }}')" 
                                                                            class="group mx-2 mb-2 flex items-center justify-between px-4 py-2.5 rounded-xl text-sm border-2 transition-all duration-500 ease-out font-accent font-semibold cursor-pointer 
                                                                            bg-white border-blue-100 text-blue-600 hover:bg-blue-600 hover:border-blue-600 hover:text-white hover:-translate-y-1">
                                                                            
                                                                            <span class="truncate pr-2 max-w-[200px]">{{ $option }}</span>
                                                                            
                                                                            {{-- Icon Check --}}
                                                                            <span class="check-icon hidden material-symbols-outlined text-[18px] font-normal shrink-0">
                                                                                check_circle
                                                                            </span>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </div>

                                                    <div class="flex items-center gap-2 px-1 transition-all duration-500 opacity-40 group-hover/modal:opacity-100 group-[.is-active]/field:opacity-100">
                                                        <span class="material-symbols-outlined text-blue-500 text-sm transition-all duration-500 group-hover/field:scale-110 group-[.is-active]/field:scale-110">info</span>
                                                        <p class="text-[10px] text-slate-500 font-medium group-hover/modal:text-slate-700">
                                                            <span class="font-bold">Note:</span> {{ $field['note'] }}
                                                        </p>
                                                    </div>
                                                </div>
                                                @endforeach

                                                <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-4 gap-6 items-stretch">
                                                    <div id="update_group_summary" class="md:col-span-3 flex flex-col space-y-3 group/field transition-all duration-500 relative h-full
                                                        hover:-translate-y-1 focus-within:-translate-y-1 
                                                        [&.is-active]:-translate-y-1">
                                                        <label class="text-[11px] font-extrabold text-slate-400 uppercase tracking-[0.3em] block font-accent transition-colors duration-300 group-hover/field:text-blue-600 group-focus-within/field:text-blue-600 group-[.is-active]/field:text-blue-600">
                                                            Book Summary
                                                        </label>
                                                        <div class="relative flex-grow">
                                                            <textarea name="summary" id="update_input_summary" required maxlength="1500" oninput="checkUpdateChange(this); handleMaxLimit(this)"
                                                                class="w-full h-full bg-white rounded-[1.8rem] py-5 px-8 text-sm font-black transition-all duration-700 ease-in-out outline-none text-slate-700 shadow-inner border border-slate-200 border-r-4 border-r-slate-200 resize-none focus:ring-8 focus:ring-blue-600/5 focus:border-blue-500/40 focus:border-r-blue-500/60 focus:shadow-xl focus:shadow-blue-900/10 group-[.is-active]/field:ring-8 group-[.is-active]/field:ring-blue-600/5 group-[.is-active]/field:border-blue-500/40 group-[.is-active]/field:border-r-blue-500/60 group-[.is-active]/field:shadow-xl group-[.is-active]/field:shadow-blue-900/10"></textarea>
                                                        </div>
                                                        <div class="flex items-center gap-2 px-1 transition-all duration-500 opacity-40 group-hover/modal:opacity-100 group-[.is-active]/field:opacity-100">
                                                            <span class="material-symbols-outlined text-blue-500 text-sm transition-all duration-500 group-hover/field:scale-110 group-[.is-active]/field:scale-110">description</span>
                                                            <p class="text-[10px] text-slate-500 font-medium group-hover/modal:text-slate-700">
                                                                <span class="font-bold">Note:</span> Enter a brief story summary.
                                                            </p>
                                                        </div>
                                                    </div>

                                                    <div id="update_group_cover_preview" class="md:col-span-1 space-y-3 group/field transition-all duration-300 relative 
                                                        hover:-translate-y-1 focus-within:-translate-y-1 
                                                        [&.is-active]:-translate-y-1">
                                                        <label class="text-[11px] font-extrabold text-slate-400 uppercase tracking-[0.3em] block font-accent transition-colors duration-300 group-hover/field:text-blue-600 group-[.is-active]/field:text-blue-600 text-center">
                                                            Cover Preview
                                                        </label>
                                                        <div id="update_cover_preview_card" class="relative aspect-[3/4] bg-white rounded-[1.8rem] shadow-inner border border-slate-200 border-r-4 border-r-slate-200 overflow-hidden flex items-center justify-center transition-all duration-700 group-[.is-active]/field:ring-8 group-[.is-active]/field:ring-blue-600/5 group-[.is-active]/field:border-blue-500/40 group-[.is-active]/field:border-r-blue-500/60 group-[.is-active]/field:shadow-xl group-[.is-active]/field:shadow-blue-900/10">
                                                            <div id="update_placeholder_icon" class="flex flex-col items-center text-slate-300 hidden">
                                                                <span class="material-symbols-outlined text-3xl">image</span>
                                                                <span class="text-[11px] font-black tracking-tighter text-center">No Preview</span>
                                                            </div>
                                                            <img id="update_preview_img" src="" class="w-full h-full object-cover">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                    <div class="px-10 pb-7 pt-4 bg-[#F8F9FC]">
                                        <button type="submit" form="updateBookForm" id="updateSubmitBtn" disabled
                                            class="w-full flex items-center justify-center gap-4 px-10 py-5 rounded-[2rem] font-black font-accent uppercase tracking-widest text-[11px] text-white transition-all duration-500 ease-in-out transform 
                                            disabled:opacity-50 disabled:grayscale disabled:cursor-not-allowed
                                            hover:-translate-y-1 hover:bg-right 
                                            shadow-2xl shadow-slate-900/20 hover:shadow-[0_15px_30px_-5px_rgba(37,99,235,0.4)]
                                            bg-gradient-to-r from-blue-700 via-blue-600 to-cyan-500 bg-[length:250%_150%] bg-left
                                            group/btn border-t border-white/10 relative overflow-hidden">
                                            
                                            <span class="inline-block transition-all duration-500 group-hover/btn:scale-125 group-hover/btn:rotate-12">
                                                <span class="material-symbols-outlined text-xl block">published_with_changes</span>
                                            </span>
                                            <span class="relative z-10">Confirm Update Book</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <script>
                            (function() {
                                const urlParams = new URLSearchParams(window.location.search);
                                const bookToEdit = urlParams.get('edit_book');

                                if (bookToEdit) {
                                    console.log("Sistem: Mencari Buku ID " + bookToEdit);
                                    
                                    let attempts = 0;
                                    const maxAttempts = 20;

                                    const interval = setInterval(() => {
                                        const targetBtn = document.getElementById('edit-btn-' + bookToEdit);
                                        attempts++;

                                        if (targetBtn) {
                                            console.log("Target Ditemukan! Membuka Modal...");
                                            clearInterval(interval);
                                            
                                            targetBtn.scrollIntoView({ 
                                                behavior: 'smooth', 
                                                block: 'center' 
                                            });

                                            setTimeout(() => {
                                                window.scrollBy({
                                                    top: -200, 
                                                    behavior: 'smooth'
                                                });
                                            }, 400); 

                                            setTimeout(() => targetBtn.click(), 600);

                                            const cleanUrl = window.location.protocol + "//" + window.location.host + window.location.pathname;
                                            window.history.replaceState({path: cleanUrl}, '', cleanUrl);
                                        } 
                                        
                                        if (attempts >= maxAttempts) {
                                            clearInterval(interval);
                                            console.error("Gagal menemukan tombol setelah 2 detik.");
                                        }
                                    }, 100); 
                                }
                            })();
                            </script>


                        <script>
                            let originalData = {};

                            function openUpdateModal(book) {
                                const modal = document.getElementById('updateModal');
                                const content = document.getElementById('updateModalContent');
                                const backdrop = document.getElementById('updateModalBackdrop');
                                const form = document.getElementById('updateBookForm');

                                originalData = { ...book };
   
                                form.action = "{{ route('admin.books.update', 'ID_TEMPORARY') }}".replace('ID_TEMPORARY', book.id);

                                const fields = ['api_id', 'title', 'author_name', 'category_name', 'publisher', 'published_date', 'total_pages', 'tags', 'cover_image', 'summary'];
                                
                                fields.forEach(field => {
                                    const input = document.getElementById(`update_input_${field}`);
                                    if (input) {
                                        let value = book[field];

                                    
                                        if (field === 'published_date' && value) {
                                            let finalDate = "";

                                            const months = {
                                             
                                                'Januari': '01', 'Februari': '02', 'Maret': '03', 'April': '04',
                                                'Mei': '05', 'Juni': '06', 'Juli': '07', 'Agustus': '08',
                                                'September': '09', 'Oktober': '10', 'November': '11', 'Desember': '12',
                                               
                                                'January': '01', 'February': '02', 'March': '03', 'April': '04',
                                                'May': '05', 'June': '06', 'July': '07', 'August': '08',
                                                'September': '09', 'October': '10', 'November': '11', 'December': '12'
                                            };

                                            const dateParts = value.trim().split(' ');

                                            if (dateParts.length === 3) {
                                                
                                                const day = dateParts[0].padStart(2, '0');
                                                const monthName = dateParts[1];
                                                const year = dateParts[2];
                                                
                                                const month = months[monthName]; 
                                                
                                                if (month) {
                                                    finalDate = `${year}-${month}-${day}`;
                                                }
                                            } 
                                            else if (dateParts.length === 2) {
                                                
                                                const month = months[dateParts[0]];
                                                const year = dateParts[1];
                                                if (month) finalDate = `${year}-${month}-01`;
                                            }
                                            else if (value.includes('-')) {
                                             
                                                finalDate = value.split(' ')[0];
                                            } 
                                            else if (!isNaN(value) && value.length === 4) {
                                                
                                                finalDate = `${value}-01-01`;
                                            }

                                            value = finalDate; 
                                        }


                                        if (field === 'total_pages' && typeof value === 'string') {
                                            value = value.replace(' pages', '');
                                        }
                                        
                                        input.value = value || '';
                                        
                                        if (field === 'total_pages') updatePagesWidth(input, 1000);
                                    }
                                });

                                const previewImg = document.getElementById('update_preview_img');
                                const placeholder = document.getElementById('update_placeholder_icon');
                                if (book.cover_image) {
                                    previewImg.src = book.cover_image;
                                    previewImg.classList.remove('hidden');
                                    placeholder.classList.add('hidden');
                                }

                                checkUpdateChange(); 
                                document.getElementById('updateSubmitBtn').disabled = true;

                                modal.classList.remove('hidden');
                                setTimeout(() => {
                                    backdrop.classList.add('opacity-100');
                                    backdrop.classList.remove('opacity-0'); 
                                    content.classList.add('translate-y-0', 'opacity-100');
                                    content.classList.remove('translate-y-4', 'opacity-0');
                                }, 10);
                            }

                            function closeUpdateModal() {
                                const modal = document.getElementById('updateModal');
                                const content = document.getElementById('updateModalContent');
                                const backdrop = document.getElementById('updateModalBackdrop');

                                
                                backdrop.classList.replace('opacity-100', 'opacity-0');
                                content.classList.remove('translate-y-0', 'opacity-100');
                                content.classList.add('translate-y-4', 'opacity-0');

                                setTimeout(() => {
                                    modal.classList.add('hidden');
                                    
                                }, 300);
                            }


                            function handleMaxLimit(input) {
                                let isOverLimit = false;
                                let message = "";

                             
                                if (input.maxLength > 0 && input.value.length >= input.maxLength) {
                                    isOverLimit = true;
                                    message = `Maksimal ${input.maxLength} karakter tercapai`;
                                } 
                               
                                else if (input.type === 'number' && input.max && parseFloat(input.value) >= parseFloat(input.max)) {
                                    if (parseFloat(input.value) > parseFloat(input.max)) {
                                        input.value = input.max; 
                                    }
                                    isOverLimit = true;
                                    message = `Nilai maksimal adalah ${input.max}`;
                                }

                                if (isOverLimit) {
                                    
                                    input.setCustomValidity(message);
                                    
                                    input.reportValidity();

                                   
                                    setTimeout(() => {
                                        input.setCustomValidity('');
                                    }, 3000);
                                } else {
                                    
                                    input.setCustomValidity('');
                                }
                            }

                            
                            function checkUpdateChange() {
                                const btn = document.getElementById('updateSubmitBtn');
                                let hasChanged = false;
                                const fields = ['title', 'author_name', 'category_name', 'publisher', 'published_date', 'total_pages', 'tags', 'cover_image', 'summary'];

                                fields.forEach(field => {
                                    const input = document.getElementById(`update_input_${field}`);
                                    const group = document.getElementById(`update_group_${field}`);
                                    
                                    if (input && group) {
                                        if (input.value.trim() !== "") {
                                            group.classList.add('is-active');
                                        } else {
                                            group.classList.remove('is-active');
                                        }

                                        let originalVal = originalData[field] || '';
                                        if (field === 'total_pages' && typeof originalVal === 'string') {
                                            originalVal = originalVal.replace(' pages', '');
                                        }
                                        if (String(input.value) !== String(originalVal)) {
                                            hasChanged = true;
                                        }
                                    }
                                });

                                if(btn) btn.disabled = !hasChanged;

                                
                                const coverInput = document.getElementById('update_input_cover_image');
                                const previewImg = document.getElementById('update_preview_img');
                                const placeholder = document.getElementById('update_placeholder_icon');
                                const previewGroup = document.getElementById('update_group_cover_preview'); 
                                
                                if (coverInput && coverInput.value.trim() !== "") {
                                    previewImg.src = coverInput.value;
                                    previewImg.classList.remove('hidden');
                                    placeholder.classList.add('hidden');
                                    
                                    
                                    previewGroup.classList.add('is-active');
                                } else if (previewGroup) {
                                    previewImg.classList.add('hidden');
                                    placeholder.classList.remove('hidden');
                                    
                                    
                                    previewGroup.classList.remove('is-active');
                                }
                            }

                          
                            function updatePagesWidth(el, max) {
                                if(parseInt(el.value) > max) el.value = max;
                                const charCount = el.value.length > 0 ? el.value.length : el.placeholder.length;
                                const factor = el.value.length > 0 ? 8.5 : 7.5; 
                                el.style.width = (charCount * factor + 4) + 'px';
                            }

                            function selectUpdateOption(name, value, type) {
                                const input = document.getElementById(`update_input_${name}`);
                                
                                if (type === 'tags') {
                                   
                                    let currentTags = input.value.split(',')
                                        .map(t => t.trim())
                                        .filter(t => t !== "");

                                    const index = currentTags.indexOf(value);

                                    if (index > -1) {
                                     
                                        currentTags.splice(index, 1);
                                    } else {
                                     
                                        if (currentTags.length >= 20) {
                                          
                                            input.setCustomValidity('Maksimal 20 tag diperbolehkan');
                                            input.reportValidity(); 

                                           
                                            setTimeout(() => {
                                                input.setCustomValidity('');
                                            }, 3000);
                                            
                                            return;
                                        }
                                       
                                        currentTags.push(value);
                                    }

                                    
                                    input.value = currentTags.join(', ');

                                    input.scrollLeft = input.scrollWidth;
                                    
                                   
                                    updateActiveStateUpdate(name, input.value);
                                    checkUpdateChange();
                                } else {
                                   
                                    input.value = value;
                                    const list = document.getElementById(`update_list_${name}`);
                                    list.classList.add('hidden');
                                    
                                 
                                    document.querySelectorAll('.dropdown-trigger-icon').forEach(ic => ic.classList.remove('dropdown-active'));
                                    document.querySelectorAll('.group\\/field').forEach(gr => gr.classList.remove('dropdown-open'));
                                }

                              
                                checkUpdateChange();
                            }


                            function toggleDropdownUpdate(id, iconElement) {
                                const dropdown = document.getElementById(id);
                                const container = iconElement.closest('.group\\/field');
                                const inputId = id.replace('update_list_', 'update_input_');
                                const input = document.getElementById(inputId);
                                
                                if (!dropdown || !input) return;

                                const isOpen = !dropdown.classList.contains('hidden');

                          
                                document.querySelectorAll('[id^="update_list_"]').forEach(el => el.classList.add('hidden'));
                                document.querySelectorAll('.dropdown-trigger-icon').forEach(ic => ic.classList.remove('dropdown-active'));
                                document.querySelectorAll('.group\\/field').forEach(gr => gr.classList.remove('dropdown-open'));
                                
                                if (!isOpen) {
                                    updateActiveStateUpdate(id.replace('update_list_', ''), input.value);
                                    dropdown.classList.remove('hidden');
                                    iconElement.classList.add('dropdown-active');
                                    container.classList.add('dropdown-open');
                                }
                            }

                            function updateActiveStateUpdate(fieldName, currentInputValue) {
                                const listItems = document.querySelectorAll(`#update_list_${fieldName} .group`);
                                const val = currentInputValue || "";
                                const isTags = fieldName.includes('tags');
                                const currentTags = val.split(',').map(t => t.trim()).filter(t => t !== "");

                                listItems.forEach(item => {
                                    const text = item.querySelector('span')?.innerText.trim();
                                    const check = item.querySelector('.check-icon');
                                    const isActive = isTags ? currentTags.includes(text) : (text === val.trim());

                                    if (isActive) {
                                     
                                        item.classList.add('bg-blue-600', 'text-white', 'border-blue-600', 'item-selected');
                                        item.classList.remove('bg-white', 'text-blue-600', 'border-blue-100'); 
                                        check?.classList.remove('hidden');
                                    } else {
                                     
                                        item.classList.remove('bg-blue-600', 'text-white', 'border-blue-600', 'item-selected');
                                        
                                        
                                        item.classList.add('bg-white', 'text-blue-600', 'border-blue-100'); 
                                        item.classList.remove('text-slate-600', 'border-transparent'); 
                                      
                                        
                                        check?.classList.add('hidden');
                                    }
                                });
                            }

                           
                            window.addEventListener('click', function(e) {
                                if (!e.target.closest('.relative')) {
                                    document.querySelectorAll('[id^="update_list_"]').forEach(el => el.classList.add('hidden'));
                                    document.querySelectorAll('.dropdown-trigger-icon').forEach(ic => ic.classList.remove('dropdown-active'));
                                    document.querySelectorAll('.group\\/field').forEach(gr => gr.classList.remove('dropdown-open'));
                                }
                            });


                            document.addEventListener('DOMContentLoaded', function() {
                                const tagsInput = document.getElementById('update_input_tags');
                                if (tagsInput) {
                                    tagsInput.addEventListener('input', function(e) {
                                        const value = this.value;
                                        
                                        if (value.endsWith(',') && !value.endsWith(', ')) {
                                            this.value = value + ' ';
                                        }
                                        
                                        
                                        this.scrollLeft = this.scrollWidth;
                                    });
                                }
                            });
                        </script>

                        <style>
                            .group\/field.dropdown-open {
                                z-index: 100 !important;
                            }

                            .dropdown-active {
                                transform: translateY(-50%) rotate(180deg) !important;
                                color: #2563eb !important;
                            }


                            .dropdown-animate-container {
                                background-color: #ffffff;
                                pointer-events: none; 
                                opacity: 0;
                            }

                            .dropdown-animate-container:not(.hidden) {
                                pointer-events: auto;
                                animation: dropdown-in 0.4s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
                            }

                            @keyframes dropdown-in {
                                0% { 
                                    opacity: 0; 
                                    transform: translateY(-10px) scale(0.95); 
                                }
                                100% { 
                                    opacity: 1; 
                                    transform: translateY(0) scale(1); 
                                }
                            }

                            .item-selected {
                                background-color: #2563eb !important;
                                color: white !important;
                                border-color: #2563eb !important;
                            }

                            .group.mx-2 {
                                transition: all 0.5s ease-out;
                            }
                        </style>


                        <div class="flex justify-center items-center gap-2 font-accent pt-6 pb-8">
                            @if ($books->hasPages())
                                {{-- Tombol Previous --}}
                                @if ($books->onFirstPage())
                                    {{-- Hilang/Kosong sesuai perilaku kode referensi Anda (hanya muncul jika NOT onFirstPage) --}}
                                @else
                                    <a href="{{ $books->previousPageUrl() }}" class="w-10 h-10 md:w-12 md:h-12 flex items-center justify-center rounded-xl border-2 border-slate-200 bg-white text-slate-400 hover:text-blue-600 hover:border-blue-600 hover:-translate-y-1.5 transition-all duration-300 shadow-sm mr-2 group">
                                        <span class="material-symbols-outlined text-sm transition-transform group-hover:scale-110">arrow_back_ios_new</span>
                                    </a>
                                @endif

                                {{-- Logika Perhitungan Angka Sesuai Referensi --}}
                                @php
                                    $currentPage = $books->currentPage();
                                    $lastPage = $books->lastPage();
                                    $start = max(1, $currentPage - ($currentPage == $lastPage ? 2 : 1));
                                    $end = min($lastPage, $currentPage + ($currentPage == 1 ? 2 : 1));
                                    if($currentPage == 1) $end = min($lastPage, 3);
                                    if($currentPage == $lastPage) $start = max(1, $lastPage - 2);
                                @endphp

                                {{-- Halaman Pertama & Separator --}}
                                @if($start > 1)
                                    <a href="{{ $books->url(1) }}" class="w-9 h-9 flex items-center justify-center rounded-lg border-2 border-slate-200 bg-white text-slate-400 font-medium text-[11px] hover:text-blue-600 hover:border-blue-600 hover:-translate-y-1.5 transition-all duration-300 shadow-sm">1</a>
                                    @if($start > 2)
                                        <div class="flex items-center justify-center h-12">
                                            <span class="text-slate-400 px-1 text-[12px] font-extrabold tracking-widest leading-none">...</span>
                                        </div>
                                    @endif
                                @endif

                                {{-- Range Angka Tengah --}}
                                @foreach (range($start, $end) as $page)
                                    @if ($page == $currentPage)
                                        {{-- STATUS AKTIF (Plek Ketiplek): Hitam, Shadow 2XL, Blur Glow Biru --}}
                                        <div class="relative group transition-all duration-300">
                                            <span class="w-12 h-12 md:w-14 md:h-14 flex items-center justify-center rounded-2xl bg-slate-900 text-white font-black text-base shadow-2xl shadow-slate-900/30 z-10 relative">
                                                {{ $page }}
                                            </span>
                                            <div class="absolute inset-0 bg-blue-500/20 blur-xl rounded-full scale-75 group-hover:scale-110 transition-all duration-300"></div>
                                        </div>
                                    @else
                                        {{-- STATUS TIDAK AKTIF (Plek Ketiplek): Border 2, Hover Blue 600, Translate-y --}}
                                        <a href="{{ $books->url($page) }}" class="w-10 h-10 md:w-11 md:h-11 flex items-center justify-center rounded-xl border-2 border-slate-200 bg-white text-slate-500 font-bold text-sm hover:text-blue-600 hover:border-blue-600 hover:-translate-y-1.5 transition-all duration-300 shadow-sm">
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
                                    <a href="{{ $books->url($lastPage) }}" class="w-9 h-9 flex items-center justify-center rounded-lg border-2 border-slate-200 bg-white text-slate-400 font-medium text-[11px] hover:text-blue-600 hover:border-blue-600 hover:-translate-y-1.5 transition-all duration-300 shadow-sm">
                                        {{ $lastPage }}
                                    </a>
                                @endif

                                {{-- Tombol Next --}}
                                @if ($books->hasMorePages())
                                    <a href="{{ $books->nextPageUrl() }}" class="w-10 h-10 md:w-12 md:h-12 flex items-center justify-center rounded-xl border-2 border-slate-200 bg-white text-slate-400 hover:text-blue-600 hover:border-blue-600 hover:-translate-y-1.5 transition-all duration-300 shadow-sm ml-2 group">
                                        <span class="material-symbols-outlined text-sm transition-transform group-hover:scale-110">arrow_forward_ios</span>
                                    </a>
                                @endif
                            @endif
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