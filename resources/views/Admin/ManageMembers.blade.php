<!DOCTYPE html>
<html class="light" lang="id">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Manage Members - LibSys</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Plus+Jakarta+Sans:wght@700;800&family=Montserrat:wght@500;700;900&family=Space+Grotesk:wght@300;500;700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet" />
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
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

      
        .hover-indigo:hover {
            @apply -translate-y-2 border-indigo-400/40 border-r-indigo-400/60;
            box-shadow: 0 15px 30px -12px rgba(99, 102, 241, 0.10), 0 0 15px rgba(99, 102, 241, 0.08);
        }

        .hover-amber:hover {
            @apply -translate-y-2 border-amber-400/40 border-r-amber-400/60;
            box-shadow: 0 15px 30px -12px rgba(245, 158, 11, 0.10), 0 0 15px rgba(245, 158, 11, 0.08);
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

                <a class="relative overflow-hidden flex items-center justify-center gap-3 p-4 rounded-2xl border-2 border-blue-200 bg-white/50 backdrop-blur-sm text-blue-600 shadow-sm shadow-blue-100/50 transition-all duration-1000 [transition-timing-function:cubic-bezier(0.34,1.56,0.64,1)] hover:z-50 hover:text-white hover:border-transparent hover:translate-x-3 hover:-translate-y-1 
                hover:scale-x-[1.06] origin-left transform-gpu will-change-transform [backface-visibility:hidden] hover:shadow-[0_15px_30px_rgba(37,99,235,0.3)] group" href="{{ route('admin.books') }}">

                    <span class="absolute inset-0 bg-gradient-to-r from-blue-600 to-cyan-500 opacity-0 transition-opacity duration-500 group-hover:opacity-100"></span>
                    <span class="relative z-30 font-black font-accent will-change-transform uppercase tracking-[0.25em] text-[10px] 
                    transition-transform duration-1000 [transition-timing-function:inherit] group-hover:scale-x-[0.94] inline-block">Manage Books</span>
                    
                    <span class="material-icons-round text-base group-hover:rotate-[20deg] group-hover:translate-x-1 transition-transform duration-500 relative z-30 
                    group-hover:scale-x-[0.94] inline-block transform-gpu antialiased">library_books</span>
                </a>

                <a class="relative z-50 flex items-center justify-center gap-3 p-4 rounded-2xl bg-gradient-to-r border-indigo-200 from-indigo-600 to-indigo-400 text-white shadow-[0_15px_30px_rgba(79,70,229,0.3)] transform translate-x-3 -translate-y-1 scale-x-[1.06] origin-left transition-all duration-1000 transform-gpu will-change-transform [backface-visibility:hidden] [transition-timing-function:cubic-bezier(0.34,1.56,0.64,1)] group ring-2 ring-white" href="{{ route('admin.members') }}">
                    <span class="relative z-30 font-black font-accent uppercase tracking-[0.25em] text-[10px] inline-block scale-x-[0.94]">Manage Members</span>
                    <span class="material-icons-round text-base rotate-[20deg] translate-x-1 transition-transform duration-500 relative z-30 inline-block scale-x-[0.94]">people</span>
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
            <div class="p-8 max-w-[1600px] mx-auto space-y-6">
                <section class="mb-10 relative flex justify-between items-start pl-6">
                    <div class="relative">
                        <div class="absolute -left-6 top-0 w-1 h-20 bg-indigo-600 rounded-full"></div>
                        
                        <h1 class="text-6xl font-extrabold tracking-tighter text-slate-900 mb-3 font-heading leading-none">
                            <span class="text-transparent bg-clip-text bg-gradient-to-r from-slate-900 via-indigo-600 to-indigo-400">
                                Member List, <span class="italic">System Access.</span>
                            </span>
                        </h1>
                        
                        <p class="text-slate-500 font-medium text-lg leading-relaxed max-w-3xl border-l-0 font-modern">
                            Your primary dashboard to manage library membership, organize user credentials, and monitor member engagement to maintain a thriving and secure literary community.
                        </p>
                    </div>
                    
                    <div class="hidden lg:block pt-9 ">
                        <button onclick="openAddMemberModal()" class="group relative isolate overflow-hidden bg-white border border-slate-200 px-6 py-3 rounded-2xl text-indigo-600 font-bold text-[10px] 
                            hover:text-white hover:-translate-y-1.5 hover:shadow-xl hover:shadow-indigo-500/30 
                            transition-all duration-500 ease-[cubic-bezier(0.4,0,0.2,1)] 
                            flex items-center gap-2 uppercase tracking-widest font-accent shadow-sm shadow-indigo-100/50">
                            
                            {{-- Layer Gradient yang disembunyikan (Opacity 0) menggunakan Indigo --}}
                            <div class="absolute inset-0 -z-10 bg-gradient-to-r from-indigo-600 to-indigo-400 opacity-0 group-hover:opacity-100 transition-opacity duration-500 ease-in-out"></div>

                            <span class="relative z-10">Register New Member</span>
                            <span class="material-symbols-outlined text-lg group-hover:translate-x-1 group-hover:rotate-12 transition-transform duration-500">person_add</span>
                        </button>
                    </div>



                  <div id="addMemberModal" class="fixed inset-0 z-[100] hidden w-full h-full">
                    <div class="absolute inset-0 bg-slate-950/40 backdrop-blur-[6px] opacity-0 transition-opacity duration-300 ease-out" 
                        id="memberModalBackdrop"
                        onclick="closeAddMemberModal()">
                    </div>  
                    
                    <div class="relative flex w-full min-h-full items-start justify-center p-4 md:p-6 pt-24"> 
                        
                        <div id="memberModalContent" class="relative w-full max-w-4xl max-h-[85vh] mt-20 flex flex-col transform overflow-hidden group/modal rounded-[3.5rem] bg-[#F8F9FC] transition-all border border-slate-100 shadow-[0_35px_60px_-15px_rgba(79,70,229,0.25)] group/header">
                            
                            {{-- Header --}}
                            <div class="pt-10 pb-4 px-10 flex justify-between items-start">
                                <div>
                                    <h3 class="text-3xl font-black font-heading tracking-tighter bg-clip-text text-transparent transform-gpu pr-1"
                                        style="background-image: linear-gradient(to right, #4f46e5 0%, #6366f1 50%, #818cf8 100%); 
                                        -webkit-background-clip: text; 
                                        -webkit-text-fill-color: transparent;">
                                        Register New Member
                                    </h3>
                                    <p class="text-xs text-slate-400 font-bold uppercase tracking-[0.2em] mt-2 flex items-center gap-2 group-hover/header:text-indigo-600 transition-colors duration-500">
                                        <span class="inline-block w-8 h-[3px] bg-indigo-600 rounded-full transition-[width] duration-500 ease-out group-hover/header:w-12"></span>
                                        <span class="transition-transform duration-500 group-hover/header:translate-x-1">User Management System</span>
                                    </p>
                                </div>

                                <button type="button" onclick="closeAddMemberModal()" class="group/close relative">
                                    <div class="relative flex items-center justify-center w-11 h-11 bg-white border-2 border-slate-100 rounded-xl transition-all duration-500 
                                        group-hover/close:bg-rose-500 group-hover/close:border-rose-500 group-hover/close:rotate-90 
                                        group-hover/close:shadow-[0_0_20px_rgba(244,63,94,0.5)]">
                                        <span class="material-symbols-outlined text-slate-400 group-hover/close:text-white text-xl font-bold transition-colors">close</span>
                                    </div>
                                </button>
                            </div>

                            {{-- Form Content --}}
                            <div class="flex-1 overflow-y-auto px-10 custom-scrollbar">
                                <form id="addMemberForm" action="{{ route('admin.members.store') }}" method="POST" class="space-y-6 pb-2" novalidate>
                                    @csrf
                                    <input type="hidden" name="form_type" value="store">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-10 pt-4">
                                        @php
                                            $fields = [
                                                [
                                                    'name' => 'username', 
                                                    'label' => 'Username', 
                                                    'icon' => 'person', 
                                                    'placeholder' => 'e.g. rahmadewi', 
                                                    'note' => 'Min. 4 chars, no spaces, must be unique.', 
                                                    'type' => 'text'
                                                ],
                                                [
                                                    'name' => 'role', 
                                                    'label' => 'Account Role', 
                                                    'icon' => 'shield_person', 
                                                    'placeholder' => 'Select Role...', 
                                                    'note' => 'Assign administrative or student access.', 
                                                    'type' => 'dropdown', 
                                                    'options' => ['admin', 'siswa']
                                                ],
                                                
                                                [
                                                    'name' => 'password', 
                                                    'label' => 'Password', 
                                                    'icon' => 'lock', 
                                                    'placeholder' => '••••••••', 
                                                    'note' => 'Min. 6 chars, no spaces.', 
                                                    'type' => 'password'
                                                ],
                                                [
                                                    'name' => 'email', 
                                                    'label' => 'Email Address', 
                                                    'icon' => 'mail', 
                                                    'placeholder' => 'example@gmail.com', 
                                                    'note' => 'Must use @gmail.com domain.', 
                                                    'type' => 'text'
                                                ],
                                            ];
                                        @endphp

                                        @foreach($fields as $field)
                                        @php
                                            $oldValue = (old('form_type') == 'store') ? old($field['name']) : '';
                                            $hasError = (old('form_type') == 'store') && $errors->has($field['name']);
                                            $isActive = ($oldValue || $hasError) ? 'is-active' : '';
                                        @endphp
                                        <div id="group_{{ $field['name'] }}" class="space-y-3 group/field transition-all duration-300 relative hover:-translate-y-1 focus-within:-translate-y-1 [&.is-active]:-translate-y-1 {{ $isActive }} dropdown-container">
                                            <label class="text-[11px] font-extrabold text-slate-400 uppercase tracking-[0.3em] block font-accent transition-colors duration-300 group-hover/field:text-indigo-600 group-focus-within/field:text-indigo-600 group-[.is-active]/field:text-indigo-600">
                                                {{ $field['label'] }}
                                            </label>
                                            
                                            <div class="relative">
                                                <span class="material-symbols-outlined absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none group-focus-within/field:text-indigo-600 group-[.is-active]/field:text-indigo-600 transition-colors z-10">
                                                    {{ $field['icon'] }}
                                                </span>

                                                <input type="{{ $field['type'] == 'dropdown' ? 'text' : $field['type'] }}"  
                                                    name="{{ $field['name'] }}" 
                                                    id="input_{{ $field['name'] }}" 
                                                    value="{{ $oldValue }}"
                                                    autocomplete="{{ $field['type'] == 'password' ? 'new-password' : 'off' }}"
                                                    oninput="handleInput(this)"
                                                    placeholder="{{ $field['placeholder'] }}"
                                                    class="w-full bg-white rounded-[1.8rem] py-5 pl-14 text-sm font-black transition-all duration-700 ease-in-out outline-none text-slate-700 shadow-inner border border-slate-200 border-r-4 border-r-slate-200 
                                                    focus:ring-8 focus:ring-indigo-600/5 focus:border-indigo-500/40 focus:border-r-indigo-500/60 focus:shadow-xl focus:shadow-indigo-900/10 
                                                    group-[.is-active]/field:ring-8 group-[.is-active]/field:ring-indigo-600/5 group-[.is-active]/field:border-indigo-500/40 group-[.is-active]/field:border-r-indigo-500/60 group-[.is-active]/field:shadow-xl group-[.is-active]/field:shadow-indigo-900/10 
                                                    {{ $field['type'] == 'dropdown' ? 'pr-14 cursor-pointer' : 'pr-6' }}"
                                                    {{ $field['type'] == 'dropdown' ? 'readonly onclick="toggleDropdown(\'list_'.$field['name'].'\', this.nextElementSibling)"' : '' }}>

                                                @if($field['type'] == 'dropdown')
                                                    <span onclick="toggleDropdown('list_{{ $field['name'] }}', this, event)"
                                                        class="material-symbols-outlined absolute right-6 top-1/2 -translate-y-1/2 text-slate-300 cursor-pointer pointer-events-auto transition-all duration-500 hover:text-indigo-500 z-20 dropdown-trigger-icon">
                                                        expand_more
                                                    </span>

                                                    {{-- Menu Dropdown --}}
                                                    <div id="list_{{ $field['name'] }}" 
                                                        class="hidden absolute left-0 right-0 top-[105%] bg-white/95 backdrop-blur-xl border border-white/20 rounded-2xl shadow-[0_20px_50px_rgba(0,0,0,0.15)] z-[100] overflow-hidden dropdown-animate-container">
                                                        
                                                        <div class="px-4 pt-4 pb-4 text-center">
                                                            <span class="text-[13px] font-semibold uppercase tracking-[0.2em] text-indigo-600/60 font-accent">
                                                                Select {{ $field['label'] }}
                                                            </span>
                                                        </div>

                                                        <div class="py-2 max-h-40 overflow-y-auto custom-scrollbar">
                                                            @foreach($field['options'] as $option)
                                                            @php
                                                                $isSelected = (old('form_type') == 'store') && (old($field['name']) == $option);
                                                            @endphp
                                                                <div onclick="selectOption('{{ $field['name'] }}', '{{ $option }}', 'dropdown', event)"
                                                                    class="group mx-2 mb-2 flex items-center justify-between px-4 py-2.5 rounded-xl text-sm border-2 transition-all duration-500 ease-out font-accent font-semibold cursor-pointer
                                                                    {{ $isSelected ? 'item-selected bg-indigo-600 border-indigo-600 text-white' : 'bg-white border-indigo-100 text-indigo-600' }}
                                                                    hover:bg-indigo-600 hover:border-indigo-600 hover:text-white hover:-translate-y-1">
                                                                    
                                                                    <span class="truncate pr-2 uppercase max-w-[200px]">{{ $option }}</span>
                                                                    <span class="check-icon {{ $isSelected ? '' : 'hidden' }} material-symbols-outlined text-[18px] font-normal shrink-0">check_circle</span>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="flex items-center gap-2 px-1 transition-all duration-500 opacity-40 group-hover/modal:opacity-100 group-[.is-active]/field:opacity-100">
                                                <span class="material-symbols-outlined text-indigo-500 text-sm transition-all duration-500 group-hover/field:scale-110 group-[.is-active]/field:scale-110">info</span>
                                                <p class="text-[10px] text-slate-500 font-medium group-hover/modal:text-slate-700">
                                                    <span class="font-bold">Note:</span> {{ $field['note'] }}
                                                </p>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </form>
                            </div>

                            {{-- Footer Button --}}
                            <div class="px-10 pb-10 pt-4 bg-[#F8F9FC]">
                                <button type="submit" form="addMemberForm"
                                    class="w-full flex items-center justify-center gap-4 px-10 py-5 rounded-[2rem] font-black font-accent uppercase tracking-widest text-[11px] text-white transition-all duration-500 ease-in-out transform 
                                    hover:-translate-y-1 hover:bg-right 
                                    shadow-2xl shadow-slate-900/20 hover:shadow-[0_15px_30px_-5px_rgba(79,70,229,0.4)]
                                    bg-gradient-to-r from-indigo-600 via-indigo-600 to-violet-500 bg-[length:250%_150%] bg-left
                                    group/btn border-t border-white/10 relative overflow-hidden">
                                    
                                    <span class="inline-block transition-all duration-500 group-hover/btn:scale-125 group-hover/btn:rotate-12">
                                        <span class="material-symbols-outlined text-xl block">person_add</span>
                                    </span>
                                    
                                    <span class="relative z-10">Confirm Register Member</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                    <script>
                        function openAddMemberModal() {
                            const modal = document.getElementById('addMemberModal');
                            const backdrop = document.getElementById('memberModalBackdrop');
                            const content = document.getElementById('memberModalContent');

                           
                            document.body.classList.add('no-scroll');

                            
                            modal.classList.remove('hidden');
                            
                           
                            setTimeout(() => {
                                backdrop.classList.replace('opacity-0', 'opacity-100');
                                content.classList.remove('animate-modal-out'); 
                                content.classList.add('animate-modal-in');
                            }, 10);
                        }

                        function closeAddMemberModal() {
                            const modal = document.getElementById('addMemberModal');
                            const backdrop = document.getElementById('memberModalBackdrop');
                            const content = document.getElementById('memberModalContent');

                         
                            backdrop.classList.replace('opacity-100', 'opacity-0');
                            content.classList.remove('animate-modal-in');
                            content.classList.add('animate-modal-out');

                            
                            setTimeout(() => {
                            const form = document.getElementById('addMemberForm');
                            form.reset();
                            
                          
                            form.querySelectorAll('.group\\/field').forEach(el => {
                                el.classList.remove('is-active');
                            });
                            
                            modal.classList.add('hidden');
                            document.body.classList.remove('no-scroll');
                        }, 300);
                        }

                        function toggleDropdown(id, iconElement) {
                            if (event) event.stopPropagation();
                            const dropdown = document.getElementById(id);
                            const container = iconElement.closest('.group\\/field');
                            const input = document.getElementById(id.replace('list_', 'input_'));
                            const isOpen = !dropdown.classList.contains('hidden');

                            
                            document.querySelectorAll('[id^="list_"]').forEach(el => el.classList.add('hidden'));
                            document.querySelectorAll('.dropdown-trigger-icon').forEach(ic => ic.classList.remove('dropdown-active'));
                            document.querySelectorAll('.group\\/field').forEach(gr => gr.classList.remove('dropdown-open'));

                            
                            if (!isOpen) {
                                dropdown.classList.remove('hidden');
                                iconElement.classList.add('dropdown-active');
                                container.classList.add('dropdown-open');
                                
                            } else {
                                
                                if (input.value.trim() === "") {
                                    container.classList.remove('is-active');
                                }
                            }
                        }

                    
                        function selectOption(name, value, type, event) {
                            const input = document.getElementById('input_' + name);
                            const dropdown = document.getElementById('list_' + name);
                            const container = input.closest('.group\\/field');
                            const triggerIcon = container.querySelector('.dropdown-trigger-icon');

                           
                            input.value = value;
                            input.setCustomValidity('');
                            
                          
                            const allOptions = dropdown.querySelectorAll('[onclick*="selectOption"]');
                            allOptions.forEach(opt => {
                                opt.classList.remove('item-selected');
                                const check = opt.querySelector('.check-icon');
                                if (check) check.classList.add('hidden');
                            });

                          
                            const currentItem = event.currentTarget;
                            currentItem.classList.add('item-selected');
                            const currentCheck = currentItem.querySelector('.check-icon');
                            if (currentCheck) currentCheck.classList.remove('hidden');

                           
                            checkInputStatus(input);

                            
                            setTimeout(() => {
                                dropdown.classList.add('hidden');
                                if (triggerIcon) triggerIcon.classList.remove('dropdown-active');
                                container.classList.remove('dropdown-open');
                            }, 150);
                        }

                        
                        function handleInput(input) {
                            input.setCustomValidity(''); 
                           
                            checkInputStatus(input);
                        }

                        function checkInputStatus(input) {
                            const group = input.closest('.group\\/field');
                        
                            if (input.value.trim() !== "") {
                                group.classList.add('is-active');
                            } else {
                                group.classList.remove('is-active');
                            }
                        }

                        function showBalloon(input, message) {
                            input.setCustomValidity('');
                            const isReadonly = input.readOnly;
                            if (isReadonly) input.readOnly = false;

                            input.setCustomValidity(message);
                            input.reportValidity();
                            input.focus();

                            input.scrollIntoView({ behavior: 'smooth', block: 'center' });

                            if (input.balloonTimer) clearTimeout(input.balloonTimer);
                            input.balloonTimer = setTimeout(() => {
                                input.setCustomValidity('');
                                input.reportValidity(); 
                                if (isReadonly) input.readOnly = true;
                            }, 3000);
                        }

                        
                        document.addEventListener('DOMContentLoaded', function() {
                            const form = document.getElementById('addMemberForm');

                        
                            document.querySelectorAll('input').forEach(input => {
                                if (input.value.trim() !== "") {
                                    const group = input.closest('.group\\/field');
                                    if (group) group.classList.add('is-active');
                                }
                                input.addEventListener('input', () => input.setCustomValidity(''));
                            });

                           
                            form.addEventListener('submit', async function(e) {
                                e.preventDefault(); 
                                
                                const inputs = form.querySelectorAll('input[name]');
                                
                               
                                for (const input of inputs) {
                                    const val = input.value.trim();
                                    const name = input.name;
                                    if (name === "form_type" || name === "_token") continue;

                                    let errorMessage = "";
                                    if (val === "") {
                                        const labelName = name === 'role' ? 'Account Role' : name.charAt(0).toUpperCase() + name.slice(1);
                                        errorMessage = `Harap pilih atau isi ${labelName}.`;
                                    } else if (name === 'username' && val.length < 4) {
                                        errorMessage = "Username minimal 4 karakter.";
                                    } else if (name === 'email' && !val.endsWith('@gmail.com')) {
                                        errorMessage = "Email harus menggunakan @gmail.com";
                                    }

                                    if (errorMessage) {
                                        showBalloon(input, errorMessage);
                                        return; 
                                    }
                                }

                                
                                const checkFields = ['username', 'email'];
                                for (const fieldName of checkFields) {
                                    const input = document.getElementById('input_' + fieldName);
                                    if (!input) continue;

                                    try {
                                        const response = await fetch(`/dashboard/admin/members/check-availability?field=${fieldName}&value=${encodeURIComponent(input.value)}`);
                                        const data = await response.json();

                                        if (data.exists) {
                                            const label = fieldName === 'email' ? 'Alamat Email' : 'Username';
                                            showBalloon(input, `${label} ini sudah terdaftar.`);
                                            return; 
                                        }
                                    } catch (error) {
                                        console.error("Gagal mengecek ketersediaan:", error);
                                    }
                                }

                                
                                HTMLFormElement.prototype.submit.call(form);
                            });

                           
                            @if ($errors->any())
                                const formType = "{{ old('form_type') }}";
                                if (formType === 'store') {
                                    openAddMemberModal();
                                    @php 
                                        $firstErrorKey = $errors->keys()[0]; 
                                        $firstErrorMessage = $errors->first($firstErrorKey);
                                    @endphp
                                    const errorField = document.getElementById('input_{{ $firstErrorKey }}');
                                    if (errorField) {
                                        setTimeout(() => {
                                            showBalloon(errorField, "{{ $firstErrorMessage }}");
                                        }, 800);
                                    }
                                }
                            @endif
                        });
                    </script>
                    
                    <style>
                    select {
                        -webkit-appearance: none;
                        -moz-appearance: none;
                        appearance: none;
                    }

                 
                    select::-ms-expand {
                        display: none;
                    }

                    
                    @keyframes dropdown-in {
                        0% { opacity: 0; transform: translateY(-1rem) scale(0.95); }
                        100% { opacity: 1; transform: translateY(0) scale(1); }
                    }

                    .dropdown-animate-container:not(.hidden) {
                        display: block !important;
                        animation: dropdown-in 0.5s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
                    }

                  
                    .dropdown-active {
                        transform: translateY(-50%) rotate(180deg) !important;
                        color: #4f46e5 !important; 
                    }

                   
                    .group\/field.dropdown-open {
                        z-index: 50 !important;
                    }

                    .custom-scrollbar::-webkit-scrollbar { width: 4px; }
                    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
                    .custom-scrollbar::-webkit-scrollbar-thumb { 
                        background: #e2e8f0; 
                        border-radius: 10px; 
                    }
                    .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #4f46e5; }

                    .item-selected {
                        background-color: #4f46e5 !important; 
                        border-color: #4f46e5 !important;
                        color: white !important;
                    }

                    body.no-scroll {
                        position: fixed; 
                        overflow-y: scroll !important; 
                        width: 100%;
                        left: 0;
                   
                        scrollbar-gutter: stable; 
                    }

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

                    .animate-modal-in {
                        animation: modal-in 0.4s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
                    }

                    .animate-modal-out {
                        animation: modal-out 300ms ease-in forwards !important;
                    }

                
                    #memberModalBackdrop {
                        transition: opacity 300ms ease-in-out;
                        will-change: opacity;
                    }
                </style>
                </section>
                




                <div class="flex flex-wrap items-center justify-center gap-6">
                    {{-- 1. Search Bar - PLEK KETIPLEK 100% (Aksen Indigo) --}}
                    <div class="w-full max-w-2xl relative h-[70px] flex items-center">
                        <form action="{{ route('admin.members') }}" method="GET" class="w-full relative group">
                            @if(request('status'))
                                <input type="hidden" name="status" value="{{ request('status') }}">
                            @endif

                            <button type="submit" class="absolute left-6 top-1/2 -translate-y-[42%] outline-none z-10">
                                <span class="material-symbols-outlined 
                                            text-slate-400 text-2xl 
                                            transition-all duration-300 ease-in-out
                                            group-focus-within:text-indigo-600 
                                            hover:text-indigo-600 hover:translate-x-1 hover:scale-110
                                            leading-none">
                                    search
                                </span>
                            </button>
                            
                            <input 
                                type="text" 
                                name="search_all"  {{-- Ganti ini --}}
                                value="{{ request('search_all') }}"
                                autocomplete="off"
                                class="w-full bg-white border border-slate-200 rounded-[2rem] py-6 pl-16 pr-8 text-sm transition-all outline-none text-slate-700 font-medium placeholder:text-slate-300
                                    shadow-xl shadow-indigo-900/5 
                                    group-focus-within:ring-4 group-focus-within:ring-indigo-600/10 
                                    group-focus-within:border-indigo-400 
                                    group-focus-within:shadow-indigo-900/10" 
                                placeholder="Search by Username, Email, or Uer Role..." 
                            />
                        </form>
                    </div>

                    {{-- 2. Card Dropdown - PLEK KETIPLEK 100% (Aksen Indigo) --}}
                    <div class="relative" x-data="{ open: false }" @click.away="open = false">
                        <button @click="open = !open"
                                type="button"
                                class="relative overflow-hidden flex items-center justify-center bg-indigo-600 px-4 py-3 rounded-[1.25rem] text-white w-52
                                    shadow-[0_10px_25px_rgba(79,70,229,0.4)] 
                                    transition-all duration-500 [transition-timing-function:cubic-bezier(0.34,1.56,0.64,1)]
                                    hover:shadow-[0_20px_40px_rgba(67,56,202,0.5)] hover:-translate-y-2 hover:scale-[1.02]
                                    group" 
                                    :class="open ? 'shadow-[0_20px_40px_rgba(67,56,202,0.5)] -translate-y-2 scale-[1.02]' : ''">
                            
                            <span class="absolute inset-0 bg-gradient-to-r from-indigo-700 to-indigo-500 opacity-0 transition-opacity duration-500 group-hover:opacity-100" 
                            :class="open ? 'opacity-100' : 'opacity-0'"> </span>

                            <span class="relative z-10 flex items-center justify-center w-full gap-2">
                                <span class="material-symbols-outlined text-xl transition-all duration-500 group-hover:rotate-12 group-hover:scale-110 group-hover:-translate-x-1 shrink-0" 
                                :class="open ? 'rotate-12 scale-110 -translate-x-1' : ''">
                                    sort
                                </span>

                                <span class="text-sm font-semibold font-accent tracking-wide truncate text-center flex-1">
                                    @php
                                        $sortOptions = [
                                            'admin_first' => 'Admin > Siswa',
                                            'siswa_first' => 'Siswa > Admin',
                                            'latest_id'   => 'Newest ID',
                                            'oldest_id'   => 'Oldest ID',
                                            'az'          => 'Alphabet A-Z',
                                            'za'          => 'Alphabet Z-A',
                                        ];
                                        $currentSort = request('sort', 'admin_first');
                                    @endphp
                                    {{ $sortOptions[$currentSort] ?? 'Sort By' }}
                                </span>

                                <span class="material-symbols-outlined text-sm transition-all duration-500 group-hover:scale-125 shrink-0 origin-center" 
                                    :class="open ? 'rotate-180 scale-125' : ''">
                                    expand_more
                                </span>
                            </span>
                        </button>

                        {{-- Dropdown Menu --}}
                        <div x-show="open" 
                            x-cloak
                            x-transition:enter="transition ease-[cubic-bezier(0.34,1.56,0.64,1)] duration-500"
                            x-transition:enter-start="opacity-0 -translate-y-4 scale-95"
                            x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                            x-transition:leave="transition ease-in duration-200"
                            x-transition:leave-start="opacity-100 scale-100"
                            x-transition:leave-end="opacity-0 scale-95"
                            class="absolute -left-[30px] mt-4 w-64 bg-white/95 dark:bg-slate-900/95 backdrop-blur-xl border border-white/20 dark:border-slate-700/50 rounded-2xl shadow-[0_20px_50px_rgba(0,0,0,0.15)] z-50 overflow-hidden"
                            style="display: none;">
                            
                            <div class="px-4 pt-4 pb-4 text-center">
                                <span class="text-[13px] font-semibold uppercase tracking-[0.2em] text-indigo-600/60 font-accent">
                                    Sort Options
                                </span>
                            </div>

                            <div class="py-2 max-h-80 overflow-y-auto custom-scrollbar"> 
                                @foreach($sortOptions as $key => $label)
                                    <a href="{{ request()->fullUrlWithQuery(['sort' => $key]) }}"
                                    class="group mx-2 mb-2 flex items-center justify-between px-4 py-2.5 rounded-xl text-sm border-2 transition-all duration-500 ease-out font-accent font-semibold
                                    {{ request('sort', 'admin_first') == $key 
                                        ? 'bg-indigo-600 border-indigo-600 text-white' 
                                        : 'bg-white dark:bg-transparent border-indigo-100 dark:border-indigo-900/30 text-indigo-600 hover:bg-indigo-600 hover:border-indigo-600 hover:text-white hover:-translate-y-1' }}">
                                        
                                        <span class="truncate pr-2 max-w-[170px]">{{ $label }}</span>
                                        
                                        @if(request('sort', 'admin_first') == $key)
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
                                background: rgba(79, 70, 229, 0.2); 
                                border-radius: 10px; 
                            }
                        </style>
                    </div>
                </div>

                    <section class="space-y-4">
                        <div class="section-container hover-indigo group relative isolate !mt-10">
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

                        @forelse($allMembers as $user)
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
                                            <button id="member-btn-{{ $user->user_id }}" 
                                            onclick="openUpdateMemberModal('{{ $user->user_id }}', '{{ $user->username }}', '{{ $user->role }}')"
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
                                            </button>

                                            {{-- Form Tersembunyi (Gunakan $user agar konsisten) --}}
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


                        <script>
                            (function() {
                                const urlParams = new URLSearchParams(window.location.search);
                                const memberToEdit = urlParams.get('edit_member');

                                if (memberToEdit) {
                                    console.log("Sistem: Mencari Member ID " + memberToEdit);
                                    
                                    let attempts = 0;
                                    const maxAttempts = 20;

                                    const interval = setInterval(() => {
                                        const targetBtn = document.getElementById('member-btn-' + memberToEdit);
                                        attempts++;

                                        if (targetBtn) {
                                            console.log("Target Member Ditemukan! Membuka Modal...");
                                            clearInterval(interval);
                                            
                                           
                                            targetBtn.scrollIntoView({ 
                                                behavior: 'smooth', 
                                                block: 'center' 
                                            });

                                           
                                            setTimeout(() => {
                                                window.scrollBy({
                                                    top: -100, 
                                                    behavior: 'smooth'
                                                });
                                            }, 400); 

                                            
                                            setTimeout(() => targetBtn.click(), 600);

                                            
                                            const cleanUrl = window.location.protocol + "//" + window.location.host + window.location.pathname;
                                            window.history.replaceState({path: cleanUrl}, '', cleanUrl);
                                        } 
                                        
                                        if (attempts >= maxAttempts) {
                                            clearInterval(interval);
                                            console.error("Gagal menemukan tombol member setelah 2 detik.");
                                        }
                                    }, 100); 
                                }
                            })();
                            </script>

                        <div id="updateMemberModal" class="fixed inset-0 z-[100] hidden w-full h-full">
                            <div class="absolute inset-0 bg-slate-950/40 backdrop-blur-[6px] opacity-0 transition-opacity duration-300 ease-out" 
                                id="updateMemberModalBackdrop"
                                onclick="closeUpdateMemberModal()">
                            </div>  
                            
                            <div class="relative flex w-full min-h-full items-start justify-center p-4 md:p-6 pt-24"> 
                                
                                <div id="updateMemberModalContent" class="relative w-full max-w-md max-h-[85vh] mt-14 flex flex-col transform opacity-0 translate-y-10 overflow-hidden group/modal rounded-[3.5rem] bg-[#F8F9FC] transition-all duration-500 border border-slate-100 shadow-[0_35px_60px_-15px_rgba(79,70,229,0.25)] group/header">
                                    
                                    {{-- Header --}}
                                    <div class="pt-10 pb-4 px-10 flex justify-between items-start">
                                        <div>
                                            <h3 class="text-3xl font-black font-heading tracking-tighter bg-clip-text text-transparent transform-gpu pr-1"
                                                style="background-image: linear-gradient(to right, #4f46e5 0%, #6366f1 50%, #818cf8 100%); 
                                                -webkit-background-clip: text; 
                                                -webkit-text-fill-color: transparent;">
                                                Update Member 
                                            </h3>
                                            <p class="text-xs text-slate-400 font-bold uppercase tracking-[0.2em] mt-2 flex items-center gap-2 group-hover/header:text-indigo-600 transition-colors duration-500">
                                                <span class="inline-block w-8 h-[3px] bg-indigo-600 rounded-full transition-[width] duration-500 ease-out group-hover/header:w-12"></span>
                                                <span class="transition-transform duration-500 group-hover/header:translate-x-1">User Management</span>
                                            </p>
                                        </div>

                                        <button type="button" onclick="closeUpdateMemberModal()" class="group/close relative">
                                            <div class="relative flex items-center justify-center w-11 h-11 bg-white border-2 border-slate-100 rounded-xl transition-all duration-500 
                                                group-hover/close:bg-rose-500 group-hover/close:border-rose-500 group-hover/close:rotate-90 
                                                group-hover/close:shadow-[0_0_20px_rgba(244,63,94,0.5)]">
                                                <span class="material-symbols-outlined text-slate-400 group-hover/close:text-white text-xl font-bold transition-colors">close</span>
                                            </div>
                                        </button>
                                    </div>

                                    {{-- Form Content --}}
                                    <div class="flex-1 overflow-y-auto px-10 custom-scrollbar">
                                        <form id="updateMemberForm" method="POST" class="space-y-6 pb-2" novalidate autocomplete="off">
                                            @csrf
                                            @method('PUT')
                                            
                                            <input type="hidden" name="id_update_hidden" id="id_update_hidden">
    
                                            <input type="hidden" id="orig_username">
                                            <input type="hidden" id="orig_role">

                                            <div class="flex flex-col gap-y-8 pt-4">
                                                @php
                                                    $fields = [

                                                        [
                                                            'name' => 'role', 
                                                            'label' => 'Account Role', 
                                                            'icon' => 'shield_person', 
                                                            'placeholder' => 'Select Role...', 
                                                            'note' => 'Assign administrative or student access.', 
                                                            'type' => 'dropdown', 
                                                            'options' => ['admin', 'siswa']
                                                        ],
                                                        [
                                                            'name' => 'username', 
                                                            'label' => 'Username', 
                                                            'icon' => 'person', 
                                                            'placeholder' => 'e.g. rahmadewi', 
                                                            'note' => 'Min. 4 chars, no spaces, must be unique.', 
                                                            'type' => 'text'
                                                        ],
                                                        
                                                    ];
                                                @endphp

                                                @foreach($fields as $field)
                                                {{-- Tambahkan is-active secara default karena modal update pasti memiliki value --}}
                                                <div id="group_update_{{ $field['name'] }}" 
                                                class="space-y-3 group/field transition-all duration-300 relative hover:-translate-y-1 focus-within:-translate-y-1 [&.is-active]:-translate-y-1 {{ $isActive }} dropdown-container">
                                                    <label class="text-[11px] font-extrabold text-slate-400 uppercase tracking-[0.3em] block font-accent transition-all duration-500 
                                                        group-hover/field:text-indigo-600  
                                                        group-focus-within/field:text-indigo-600 
                                                        group-[.is-active]/field:text-indigo-600">
                                                        {{ $field['label'] }}
                                                    </label>
                                                    
                                                    <div class="relative transition-all duration-500">
                                                        <span class="material-symbols-outlined absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none group-focus-within/field:text-indigo-600 group-[.is-active]/field:text-indigo-600 transition-colors z-10">
                                                            {{ $field['icon'] }}
                                                        </span>

                                                        <input type="{{ $field['type'] == 'dropdown' ? 'text' : $field['type'] }}"
                                                            name="{{ $field['name'] }}" 
                                                            id="update_input_{{ $field['name'] }}" 
                                                            autocomplete="off"
                                                            oninput="handleInputUpdate('{{ $field['name'] }}')"
                                                            placeholder="{{ $field['placeholder'] }}"
                                                            class="w-full bg-white rounded-[1.8rem] py-5 pl-14 text-sm font-black transition-all duration-700 ease-in-out outline-none text-slate-700 shadow-inner border border-slate-200 border-r-4 border-r-slate-200 
                                                            focus:ring-8 focus:ring-indigo-600/5 focus:border-indigo-500/40 focus:border-r-indigo-500/60 focus:shadow-xl focus:shadow-indigo-900/10 
                                                            group-[.is-active]/field:ring-8 group-[.is-active]/field:ring-indigo-600/5 group-[.is-active]/field:border-indigo-500/40 group-[.is-active]/field:border-r-indigo-500/60 group-[.is-active]/field:shadow-xl group-[.is-active]/field:shadow-indigo-900/10 
                                                            {{ $field['type'] == 'dropdown' ? 'pr-14 cursor-pointer' : 'pr-6' }}"
                                                            {{ $field['type'] == 'dropdown' ? 'readonly onclick="toggleUpdateDropdown(\'list_update_'.$field['name'].'\', this.nextElementSibling)"' : '' }}>

                                                        @if($field['type'] == 'dropdown')
                                                            <span onclick="toggleUpdateDropdown('list_update_{{ $field['name'] }}', this, event)"
                                                                class="material-symbols-outlined absolute right-6 top-1/2 -translate-y-1/2 text-slate-300 cursor-pointer pointer-events-auto transition-all duration-500 hover:text-indigo-500 z-20 dropdown-trigger-icon">
                                                                expand_more
                                                            </span>

                                                            {{-- Menu Dropdown --}}
                                                            <div id="list_update_{{ $field['name'] }}" 
                                                                class="hidden absolute left-0 right-0 top-[105%] bg-white/95 backdrop-blur-xl border border-white/20 rounded-2xl shadow-[0_20px_50px_rgba(0,0,0,0.15)] z-[100] overflow-hidden dropdown-animate-container">
                                                                
                                                                <div class="px-4 pt-4 pb-4 text-center">
                                                                    <span class="text-[13px] font-semibold uppercase tracking-[0.2em] text-indigo-600/60 font-accent">
                                                                        Select {{ $field['label'] }}
                                                                    </span>
                                                                </div>

                                                                <div class="py-2 max-h-40 overflow-y-auto custom-scrollbar bg-white">
                                                                    @foreach($field['options'] as $option)
                                                                        <div onclick="selectUpdateOption('{{ $field['name'] }}', '{{ $option }}', event)"
                                                                            class="group mx-2 mb-2 flex items-center justify-between px-4 py-2.5 rounded-xl text-sm border-2 transition-all duration-500 ease-out font-accent font-semibold cursor-pointer
                                                                            bg-white border-indigo-100 text-indigo-600
                                                                            hover:bg-indigo-600 hover:border-indigo-600 hover:text-white hover:-translate-y-1 option-item-update"
                                                                            data-value="{{ $option }}">
                                                                            
                                                                            <span class="truncate pr-2 uppercase max-w-[200px]">{{ $option }}</span>
                                                                            <span class="check-icon hidden material-symbols-outlined text-[18px] font-normal shrink-0">check_circle</span>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </div>

                                                   <div class="flex items-center gap-2 px-1 transition-all duration-500 opacity-40 group-hover/modal:opacity-100 group-[.is-active]/field:opacity-100">
                                                        <span class="material-symbols-outlined text-indigo-500 text-sm transition-all duration-500 group-hover/field:scale-110 group-[.is-active]/field:scale-110">info</span>
                                                        <p class="text-[10px] text-slate-500 font-medium group-hover/modal:text-slate-700">
                                                            <span class="font-bold">Note:</span> {{ $field['note'] }}
                                                        </p>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        </form>
                                    </div>

                                    {{-- Footer Button --}}
                                    <div class="px-10 pb-10 pt-4 bg-[#F8F9FC]">
                                        <button type="submit" form="updateMemberForm" id="updateMemberSubmitBtn" disabled
                                            class="w-full flex items-center justify-center gap-4 px-10 py-5 rounded-[2rem] font-black font-accent uppercase tracking-widest text-[11px] text-white transition-all duration-500 ease-in-out transform 
                                            disabled:opacity-50 disabled:grayscale disabled:cursor-not-allowed
                                            hover:-translate-y-1 hover:bg-right 
                                            shadow-2xl shadow-slate-900/20 hover:shadow-[0_15px_30px_-5px_rgba(79,70,229,0.4)]
                                            bg-gradient-to-r from-indigo-600 via-indigo-600 to-violet-500 bg-[length:250%_150%] bg-left
                                            group/btn border-t border-white/10 relative overflow-hidden">
                                            
                                            <span class="inline-block transition-all duration-500 group-hover/btn:scale-125 group-hover/btn:rotate-12">
                                                <span class="material-symbols-outlined text-xl block">published_with_changes</span>
                                            </span>
                                            
                                            <span class="relative z-10">Confirm Update Member</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>


                   <script>

                    function handleInputUpdate(name) {
                        const input = document.getElementById(`update_input_${name}`);
                        const group = document.getElementById(`group_update_${name}`);

                        input.setCustomValidity('');

                        if (input.value.trim() !== "") {
                            group.classList.add('is-active');
                        } else {
                            group.classList.remove('is-active');
                        }

                        checkUpdateFormChanges();
                    }

                    function openUpdateMemberModal(id, username, role) {
                        const modal = document.getElementById('updateMemberModal');
                        const backdrop = document.getElementById('updateMemberModalBackdrop');
                        const content = document.getElementById('updateMemberModalContent');
                        const form = document.getElementById('updateMemberForm');
                        const submitBtn = document.getElementById('updateMemberSubmitBtn');
                        document.getElementById('id_update_hidden').value = id;


                        form.action = `/dashboard/admin/manage-members/update/${id}`;


                        const inputUser = document.getElementById('update_input_username');
                        const inputRole = document.getElementById('update_input_role');

                        inputUser.value = username;
                        inputRole.value = role;


                        document.getElementById('orig_username').value = username;
                        document.getElementById('orig_role').value = role;
                        syncUpdateDropdownUI('role', role);

                        if (username && username.trim() !== "") {
                            document.getElementById('group_update_username').classList.add('is-active');
                        } else {
                            document.getElementById('group_update_username').classList.remove('is-active');
                        }
                        document.getElementById('group_update_role').classList.add('is-active');

                        
                        submitBtn.disabled = true;

                       
                        modal.classList.remove('hidden');
                        document.body.classList.add('no-scroll');

                        setTimeout(() => {
                           
                            backdrop.classList.replace('opacity-0', 'opacity-100');
                            
                      
                            content.classList.remove('animate-modal-out', 'opacity-0');
                            content.classList.add('animate-modal-in');
                        }, 10);
                    }

                    function closeUpdateMemberModal() {
                        const modal = document.getElementById('updateMemberModal');
                        const backdrop = document.getElementById('updateMemberModalBackdrop');
                        const content = document.getElementById('updateMemberModalContent');
                        const form = document.getElementById('updateMemberForm'); 

                       
                        backdrop.classList.replace('opacity-100', 'opacity-0');
                        content.classList.remove('animate-modal-in');
                        content.classList.add('animate-modal-out');

                        setTimeout(() => {
                            modal.classList.add('hidden');
                            document.body.classList.remove('no-scroll');

                            form.reset(); 
                            
                            document.querySelectorAll('[id^="group_update_"]').forEach(group => {
                                group.classList.remove('is-active');
                            });

                            document.getElementById('update_input_username').setCustomValidity('');
                            document.getElementById('update_input_role').setCustomValidity('');

                            document.querySelectorAll('.dropdown-animate-container').forEach(el => el.classList.add('hidden'));

                            form.reset(); 
                            document.querySelectorAll('[id^="group_update_"]').forEach(group => {
                                group.classList.remove('is-active');
                            });
                        }, 300);
                    }

                    async function showUpdateValidationBalloon() {
                        const inputUser = document.getElementById('update_input_username');
                        const inputRole = document.getElementById('update_input_role');
                        const origUser = document.getElementById('orig_username').value;

                        
                        inputUser.setCustomValidity('');
                        inputRole.setCustomValidity('');

                        
                        if (inputRole.value.trim() === "") {
                            inputRole.setCustomValidity('Pilih role terlebih dahulu.');
                            inputRole.reportValidity();
                            return false;
                        }

                        const username = inputUser.value.trim();
                        const alphaDashRegex = /^[a-zA-Z0-9_-]+$/;

                        if (username === "") {
                            inputUser.setCustomValidity('Username tidak boleh dikosongkan.');
                        } else if (username.length < 4) {
                            inputUser.setCustomValidity('Username minimal 4 karakter.');
                        } else if (!alphaDashRegex.test(username)) {
                            inputUser.setCustomValidity('Gunakan huruf, angka, dan underscore saja.');
                        }

                        if (inputUser.validationMessage) {
                            inputUser.reportValidity();
                            return false;
                        }
                        if (username !== origUser) {
                            try {
                                
                                const response = await fetch(`/dashboard/admin/members/check-availability?field=username&value=${encodeURIComponent(username)}`);
                                const data = await response.json();

                                if (data.exists) {
                                    inputUser.setCustomValidity('Username ini telah digunakan orang lain.');
                                    inputUser.reportValidity();
                                    return false;
                                }
                            } catch (error) {
                                console.error('Error checking username:', error);
                            }
                        }
                        return true;
                    }

                    function checkUpdateFormChanges() {
                        const currentUser = document.getElementById('update_input_username').value;
                        const currentRole = document.getElementById('update_input_role').value;
                        const origUser = document.getElementById('orig_username').value;
                        const origRole = document.getElementById('orig_role').value;
                        const submitBtn = document.getElementById('updateMemberSubmitBtn');

                        const isChanged = (currentUser !== origUser || currentRole !== origRole);
                        const isNotEmpty = (currentUser.trim() !== "" && currentRole.trim() !== "");

                        submitBtn.disabled = !(isChanged && isNotEmpty);
                    }

                    function toggleUpdateDropdown(listId, triggerEl, event) {
                        if (event) event.stopPropagation();
                        const list = document.getElementById(listId);
                        
                        const icon = triggerEl?.classList.contains('dropdown-trigger-icon') 
                                    ? triggerEl 
                                    : triggerEl?.closest('.relative')?.querySelector('.material-symbols-outlined.right-6');
                        document.querySelectorAll('[id^="list_update_"]').forEach(el => {
                            if (el.id !== listId) {
                                el.classList.add('hidden');
                              
                                const otherIcon = el.closest('.relative')?.querySelector('.dropdown-trigger-icon');
                                if(otherIcon) otherIcon.classList.remove('dropdown-active');
                            }
                        });

                        const isOpening = list.classList.contains('hidden');
                        
                        if (isOpening) {
                            list.classList.remove('hidden');
                           
                            list.closest('.dropdown-container').style.zIndex = "100";
                            if (icon) icon.classList.add('dropdown-active');
                        } else {
                            list.classList.add('hidden');
                            
                            list.closest('.dropdown-container').style.zIndex = "";
                            if (icon) icon.classList.remove('dropdown-active');
                        }
                    }

                    function selectUpdateOption(fieldName, value, event) {
                        if (event) event.stopPropagation();

                        const input = document.getElementById(`update_input_${fieldName}`);
                        input.value = value;

                        syncUpdateDropdownUI(fieldName, value);

                       
                        const listId = `list_update_${fieldName}`;
                        const list = document.getElementById(listId);
                        list.classList.add('hidden');
                        
                       
                        list.closest('.dropdown-container').style.zIndex = "";

                        const group = document.getElementById(`group_update_${fieldName}`);
                        const icon = group.querySelector('.dropdown-trigger-icon');
                        if (icon) icon.classList.remove('dropdown-active');

                        group.classList.add('is-active');
                        handleInputUpdate(fieldName);
                    }
 
                    function syncUpdateDropdownUI(fieldName, selectedValue) {
                        const items = document.querySelectorAll(`#list_update_${fieldName} .option-item-update`);
                        items.forEach(item => {
                            const val = item.getAttribute('data-value');
                            const check = item.querySelector('.check-icon');

                            if (val === selectedValue) {
                                item.classList.add('item-selected', 'bg-indigo-600', 'border-indigo-600', 'text-white');
                                item.classList.remove('bg-white', 'border-indigo-100', 'text-indigo-600');
                                if (check) check.classList.remove('hidden');
                            } else {
                                item.classList.remove('item-selected', 'bg-indigo-600', 'border-indigo-600', 'text-white');
                                item.classList.add('bg-white', 'border-indigo-100', 'text-indigo-600');
                                if (check) check.classList.add('hidden');
                            }
                        });
                    }

                    document.addEventListener('DOMContentLoaded', function() {
                        const updateForm = document.getElementById('updateMemberForm');
                        
                       
                        if (updateForm) {
                            updateForm.addEventListener('submit', async function(e) {
                                e.preventDefault();
                                const isValid = await showUpdateValidationBalloon();
                                if (isValid) {
                                    this.submit();
                                }
                            });
                        }

                        @if ($errors->any())
                            const oldUpdateId = "{{ old('id_update_hidden') }}";
                            if (oldUpdateId) {
                                openUpdateMemberModal(
                                    oldUpdateId, 
                                    "{{ old('username') }}", 
                                    "{{ old('role') }}"
                                );

                                @php 
                                    $firstErrorKey = $errors->keys()[0]; 
                                    $firstErrorMessage = $errors->first($firstErrorKey);
                                @endphp

                                setTimeout(() => {
                                    const updateErrorField = document.getElementById('update_input_{{ $firstErrorKey }}');
                                    if (updateErrorField) {
                                        updateErrorField.setCustomValidity("{{ $firstErrorMessage }}");
                                        updateErrorField.reportValidity();
                                    }
                                }, 600); 
                            }
                        @endif
                        window.addEventListener('click', function() {
                            document.querySelectorAll('[id^="list_update_"]').forEach(el => el.classList.add('hidden'));
                            document.querySelectorAll('.dropdown-trigger-icon').forEach(ic => ic.classList.remove('dropdown-active'));
                        });
                    });
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

                      
                        .animate-modal-in {
                            animation: modal-in 0.4s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
                        }

                        .animate-modal-out {
                            animation: modal-out 0.3s ease-in forwards !important;
                        }

                       
                        #updateMemberModalBackdrop {
                            transition: opacity 0.3s ease-in-out, backdrop-filter 0.3s ease-in-out;
                            will-change: opacity, backdrop-filter;
                            backdrop-filter: blur(0px); 
                        }

                        #updateMemberModalBackdrop.opacity-100 {
                            backdrop-filter: blur(4px); 
                        }

                        
                        body.no-scroll {
                            position: fixed; 
                            overflow-y: scroll !important;
                            width: 100%;
                            left: 0;
                            scrollbar-gutter: stable; 
                        }

                       
                        select { appearance: none; -webkit-appearance: none; }

                       
                    
                        .dropdown-animate-container:not(.hidden) {
                            display: block !important;
                            animation: dropdown-in 0.4s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
                        }

                       
                        .dropdown-active {
                            transform: translateY(-50%) rotate(180deg) !important;
                            color: #4f46e5 !important;
                            transition: all 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
                        }

                        .custom-scrollbar::-webkit-scrollbar { width: 5px; }
                        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
                        .custom-scrollbar::-webkit-scrollbar-thumb { 
                            background: #e2e8f0; 
                            border-radius: 10px; 
                        }
                        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #6366f1; }

                        @keyframes modal-in {
                            0% { opacity: 0; transform: scale(0.9) translateY(30px); }
                            100% { opacity: 1; transform: scale(1) translateY(0); }
                        }

                        .animate-modal-in {
                            animation: modal-in 0.5s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
                        }

                        .item-selected {
                            background-color: #4f46e5 !important;
                            color: white !important;
                            border-color: #4f46e5 !important;
                        }

                        body.no-scroll {
                            overflow: hidden;
                            height: 100vh;
                        }

                        .dropdown-animate-container {
                            
                            background-color: white !important;
                     
                            backdrop-filter: none !important;
                            -webkit-backdrop-filter: none !important;
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

                        .option-item-update {
                            position: relative;
                            z-index: 1001;
                        }
                    </style>

                    <div class="pt-6 ">
                        <div class="w-full h-[1.5px] bg-slate-400/30 rounded-full"></div>
                    </div>

                <section class="space-y-4 pb-9 mt-10">
                    <div class="relative flex items-center gap-1 mb-12">
                        {{-- Sisi Kiri: Judul dan Deskripsi --}}
                        <div class="flex flex-col mt-4">
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

                        {{-- Sisi Kanan: Total Outstanding (Plek Ketiplek Samping Tulisan) --}}
                        <div class="relative top-4 flex flex-col items-start justify-center min-w-[120px] w-fit group transition-all duration-500 ease-out hover:-translate-y-1 hover:translate-x-1">

                            <div class="flex items-center justify-start gap-2">
                                {{-- Icon Section --}}
                                <div class="flex items-center justify-center w-5 h-5 rounded-md bg-amber-600 text-white shadow-lg shadow-amber-500/20 shrink-0 transition-all duration-300 group-hover:rotate-12 group-hover:scale-110">
                                    <span class="material-symbols-outlined text-[13px] font-bold">account_balance_wallet</span>
                                </div>
                                
                                {{-- Text Section --}}
                                <span class="font-accent text-[9px] font-black uppercase tracking-[0.3em] text-amber-600/60 leading-none transition-all duration-300 group-hover:translate-x-1 group-hover:scale-105 origin-left">
                                    Total Outstanding
                                </span>
                            </div>
                            
                            <div class="relative pl-4 mt-1 group">
                                {{-- Jalur Garis Abu-abu --}}
                                <div class="absolute left-0 top-1/2 -translate-y-1/2 w-[3px] h-8 bg-slate-200 rounded-full overflow-hidden transition-all duration-700 ease-[cubic-bezier(0.23,1,0.32,1)]">
                                    {{-- Elemen Pengisi --}}
                                    <div class="absolute bottom-0 left-0 w-full h-0 bg-gradient-to-t from-amber-400 to-amber-600 shadow-[0_0_15px_rgba(217,119,6,0.4)] transition-all duration-700 ease-in-out group-hover:h-full"></div>
                                </div>

                                {{-- Kontainer Angka --}}
                                <div class="group flex items-baseline gap-2 w-fit transition-transform duration-300 group-hover:scale-[1.03] origin-left">
                                    {{-- Angka Nominal --}}
                                    <span class="font-heading font-black text-3xl leading-none py-1 text-transparent bg-clip-text bg-gradient-to-r from-amber-600 to-orange-400 drop-shadow-sm">
                                        Rp {{ number_format(\App\Models\UserFineBalance::getTotalGlobalFine(), 0, ',', '.') }}
                                    </span>
                                    
                                    {{-- Tulisan Total --}}
                                    <span class="font-modern text-[12px] font-bold text-slate-500 leading-none whitespace-nowrap italic -ml-1">
                                        Total
                                    </span>
                                </div>

                                {{-- Bottom Decorative Line --}}
                                <div class="relative w-full h-1 mt-1 hidden md:block group">
                                    <div class="absolute inset-0 bg-gradient-to-r from-transparent via-amber-500/20 to-transparent rounded-full"></div>
                                    <div class="absolute inset-0 bg-gradient-to-r from-transparent via-amber-500/90 to-transparent rounded-full opacity-0 transition-opacity duration-500 ease-in-out group-hover:opacity-100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex flex-wrap items-center justify-center gap-6 mt-4">
                        {{-- 1. Search Bar - PLEK KETIPLEK 100% (Aksen Amber) --}}
                        <div class="w-full max-w-2xl relative h-[70px] flex items-center">
                            <form action="{{ route('admin.members') }}#section-denda" method="GET" class="w-full relative group">
                                @if(request('status'))
                                    <input type="hidden" name="status" value="{{ request('status') }}">
                                @endif

                                <button type="submit" class="absolute left-6 top-1/2 -translate-y-[42%] outline-none z-10">
                                    <span class="material-symbols-outlined 
                                                text-slate-400 text-2xl 
                                                transition-all duration-300 ease-in-out
                                                group-focus-within:text-amber-600 
                                                hover:text-amber-600 hover:translate-x-1 hover:scale-110
                                                leading-none">
                                        search
                                    </span>
                                </button>
                                
                                <input 
                                    type="text" 
                                    name="search_fine"  {{-- Ganti ini --}}
                                    value="{{ request('search_fine') }}"
                                    class="w-full bg-white border border-slate-200 rounded-[2rem] py-6 pl-16 pr-8 text-sm transition-all outline-none text-slate-700 font-medium placeholder:text-slate-300
                                        shadow-xl shadow-amber-900/5 
                                        group-focus-within:ring-4 group-focus-within:ring-amber-600/10 
                                        group-focus-within:border-amber-400 
                                        group-focus-within:shadow-amber-900/10" 
                                    placeholder="Search by Username, Total Late Books, Total Late Days, or Fine Amount..."
                                />
                            </form>
                        </div>

                        <script>
                            window.addEventListener('beforeunload', () => {
                                localStorage.setItem('sidebar_scroll', window.scrollY);
                            });

                            window.addEventListener('load', () => {
                                const scrollPos = localStorage.getItem('sidebar_scroll');
                                if (scrollPos) {
                                    const urlParams = new URLSearchParams(window.location.search);
                                    if (urlParams.has('search_fine')) {
                                        window.scrollTo({
                                            top: scrollPos,
                                            behavior: 'instant' 
                                        });
                                    }
                                    localStorage.removeItem('sidebar_scroll');
                                }
                            });
                        </script>

                        {{-- 2. Card Dropdown - PLEK KETIPLEK 100% (Aksen Amber) --}}
                        <div class="relative" x-data="{ open: false }" @click.away="open = false">
                            <button @click="open = !open" 
                                    type="button"
                                    class="relative overflow-hidden flex items-center justify-center bg-amber-600 px-4 py-3 rounded-[1.25rem] text-white w-52
                                        shadow-[0_10px_25px_rgba(217,119,6,0.4)] 
                                        transition-all duration-500 [transition-timing-function:cubic-bezier(0.34,1.56,0.64,1)]
                                        hover:shadow-[0_20px_40px_rgba(180,83,9,0.5)] hover:-translate-y-2 hover:scale-[1.02]
                                        group" 
                                        :class="open ? 'shadow-[0_20px_40px_rgba(180,83,9,0.5)] -translate-y-2 scale-[1.02]' : ''">
                                
                                <span class="absolute inset-0 bg-gradient-to-r from-amber-700 to-amber-500 opacity-0 transition-opacity duration-500 group-hover:opacity-100" 
                                :class="open ? 'opacity-100' : 'opacity-0'"> </span>

                                <span class="relative z-10 flex items-center justify-center w-full gap-2">
                                    <span class="material-symbols-outlined text-xl transition-all duration-500 group-hover:rotate-12 group-hover:scale-110 group-hover:-translate-x-1 shrink-0" 
                                    :class="open ? 'rotate-12 scale-110 -translate-x-1' : ''">
                                        filter_list
                                    </span>

                                    <span class="text-sm font-semibold font-accent tracking-wide truncate text-center flex-1">
                                        @php
                                        $fineOptions = [
                                            'newest_id' => 'Newest ID',
                                            'oldest_id' => 'Oldest ID',
                                            'az' => 'Alphabet A-Z',
                                            'za' => 'Alphabet Z-A',
                                            'books_1_25' => '1-25 Books',
                                            'books_26_50' => '26-50 Books',
                                            'books_51_75' => '51-75 Books',
                                            'books_76_100' => '76-100 Books',
                                            'books_gt100' => '>100 Books',
                                            'days_1_25' => '1-25 Days',
                                            'days_26_50' => '26-50 Days',
                                            'days_51_75' => '51-75 Days',
                                            'days_76_100' => '76-100 Days',
                                            'days_gt100' => '>100 Days',
                                            'money_10_100' => '10k - 100k',
                                            'money_105_200' => '105k - 200k',
                                            'money_205_300' => '205k - 300k',
                                            'money_305_400' => '305k - 400k',
                                            'money_405_500' => '405k - 500k',
                                            'money_gt500' => '>500k',
                                        ];
                                        $currentFineSort = request('sort_fine', 'newest_id');
                                    @endphp
                                    {{ $fineOptions[$currentFineSort] ?? 'Newest ID' }}
                                    </span>

                                    <span class="material-symbols-outlined text-sm transition-all duration-500 group-hover:scale-125 shrink-0 origin-center" 
                                        :class="open ? 'rotate-180 scale-125' : ''">
                                        expand_more
                                    </span>
                                </span>
                            </button>

                            {{-- Dropdown Isi --}}
                            <div x-show="open" 
                                x-cloak
                                x-transition:enter="transition ease-[cubic-bezier(0.34,1.56,0.64,1)] duration-500"
                                x-transition:enter-start="opacity-0 -translate-y-4 scale-95"
                                x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                                x-transition:leave="transition ease-in duration-200"
                                x-transition:leave-start="opacity-100 scale-100"
                                x-transition:leave-end="opacity-0 scale-95"
                                class="absolute -left-[30px] mt-4 w-64 bg-white/95 dark:bg-slate-900/95 backdrop-blur-xl border border-white/20 dark:border-slate-700/50 rounded-2xl shadow-[0_20px_50px_rgba(0,0,0,0.15)] z-50 overflow-hidden"
                                style="display: none;">
                                
                                <div class="px-4 pt-4 pb-4 text-center">
                                    <span class="text-[13px] font-semibold uppercase tracking-[0.2em] text-amber-600/60 font-accent">
                                        Fine Filters
                                    </span>
                                </div>

                                <div class="py-2 max-h-48 overflow-y-auto custom-scrollbar-amber"> 
                                    @foreach($fineOptions as $key => $label)
                                        <a href="{{ request()->fullUrlWithQuery(['sort_fine' => $key]) }}"
                                        class="group mx-2 mb-2 flex items-center justify-between px-4 py-2.5 rounded-xl text-sm border-2 transition-all duration-500 ease-out font-accent font-semibold
                                        {{ request('sort_fine', 'newest_id') == $key 
                                            ? 'bg-amber-600 border-amber-600 text-white' 
                                            : 'bg-white dark:bg-transparent border-amber-100 dark:border-amber-900/30 text-amber-600 hover:bg-amber-600 hover:border-amber-600 hover:text-white hover:-translate-y-1' }}">
                                            
                                            <span class="truncate pr-2 max-w-[170px]">{{ $label }}</span>
                                            
                                            @if(request('sort_fine', 'newest_id') == $key)
                                                <span class="material-symbols-outlined text-[18px] font-normal shrink-0">check_circle</span>
                                            @endif
                                        </a>
                                    @endforeach
                                </div>
                            </div>

                            <style>
                                .custom-scrollbar-amber::-webkit-scrollbar {
                                    width: 4px;
                                }
                                .custom-scrollbar-amber::-webkit-scrollbar-track {
                                    background: transparent;
                                }
                                .custom-scrollbar-amber::-webkit-scrollbar-thumb {
                                    background: rgba(217, 119, 6, 0.2);
                                    border-radius: 10px;
                                }
                            </style>
                        </div>
                    </div>

                    <div class="section-container hover-amber group relative isolate !mt-10">
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

                            @forelse($membersWithFines as $fine)
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
                                        $seconds = $fine->realtime_seconds ?? 0;
                                        $displayDays = floor($seconds / 86400);
                                        $displayHours = floor(($seconds % 86400) / 3600);
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
                                   
                                    <button id="pay-btn-{{ $fine->user->user_id }}"
                                    onclick="openInstallmentModal('{{ $fine->user->user_id }}', {{ $fine->realtime_fine }})"
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
                                    </button>

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
            </div>

            <script>
                (function() {
                    
                    const urlParams = new URLSearchParams(window.location.search);
                    const memberToPay = urlParams.get('pay_member');

                    if (memberToPay) {
                        console.log("Sistem: Mencari Member ID " + memberToPay);
                        
                        let attempts = 0;
                        const maxAttempts = 20; 

                        const interval = setInterval(() => {
                     
                            const targetBtn = document.getElementById('pay-btn-' + memberToPay);
                            attempts++;

                            if (targetBtn) {
                                console.log("Member Ditemukan! Menggulir dan Membuka Modal...");
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
                                console.error("Gagal menemukan member di daftar setelah 2 detik.");
                            }
                        }, 100); 
                    }
                })();
                </script>

            <script>
                function confirmPayOff(userId, username) {
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

            <div id="installmentModal" class="fixed inset-0 z-[100] hidden w-full h-full">
                <div class="absolute inset-0 bg-slate-950/40 backdrop-blur-[6px] opacity-0 transition-opacity duration-300 ease-out" 
                    id="installmentBackdrop"
                    onclick="closeInstallmentModal()">
                </div>  
                
                <div class="relative flex w-full min-h-full items-center justify-center p-4 md:p-6 pt-24"> 
                    
                    <div id="installmentContent" class="relative w-full max-w-2xl max-h-[85vh] mt-10 flex flex-col transform overflow-hidden group/modal rounded-[3.5rem] bg-[#F8F9FC] transition-all border border-slate-100 shadow-[0_35px_60px_-15px_rgba(245,158,11,0.25)] group/header">
                        
                        <div class="pt-10 pb-4 px-10 flex justify-between items-start">
                            <div>
                                <h3 class="text-3xl font-black font-heading tracking-tighter bg-clip-text text-transparent transform-gpu pr-1"
                                    style="background-image: linear-gradient(to right, #d97706 0%, #f59e0b 50%, #fbbf24 100%); 
                                        -webkit-background-clip: text; 
                                        -webkit-text-fill-color: transparent;">
                                    Fine Installment
                                </h3>
                                <p class="text-xs text-slate-400 font-bold uppercase tracking-[0.2em] mt-2 flex items-center gap-2 group-hover/header:text-amber-600 transition-colors duration-500">
                                    <span class="inline-block w-8 h-[3px] bg-amber-600 rounded-full transition-[width] duration-500 ease-out group-hover/header:w-12"></span>
                                    <span class="transition-transform duration-500 group-hover/header:translate-x-1">Payment System</span>
                                </p>
                            </div>

                            <button type="button" onclick="closeInstallmentModal()" class="group/close relative">
                                <div class="relative flex items-center justify-center w-11 h-11 bg-white border-2 border-slate-100 rounded-xl transition-all duration-500 
                                    group-hover/close:bg-rose-500 group-hover/close:border-rose-500 group-hover/close:rotate-90 
                                    group-hover/close:shadow-[0_0_20px_rgba(244,63,94,0.5)]">
                                    <span class="material-symbols-outlined text-slate-400 group-hover/close:text-white text-xl font-bold transition-colors">close</span>
                                </div>
                            </button>
                        </div>

                        <div class="flex-1 overflow-y-auto px-10 custom-scrollbar">
                            <form id="installmentForm" action="" method="POST" class="space-y-6 pb-2">
                                @csrf
                                @method('PATCH')
                                
                                <div class="grid grid-cols-1 gap-y-6">
                                    <div id="group_amount" class="space-y-3 group/field transition-all duration-300 relative hover:-translate-y-1 focus-within:-translate-y-1 [&.is-active]:-translate-y-1">
                                        <label class="text-[11px] font-extrabold text-slate-400 uppercase tracking-[0.3em] block font-accent transition-colors duration-300 group-hover/field:text-amber-600 group-focus-within/field:text-amber-600 group-[.is-active]/field:text-amber-600">
                                            Payment Amount
                                        </label>
                                        
                                        <div class="relative flex items-center bg-white rounded-[1.8rem] shadow-inner border border-slate-200 border-r-4 border-r-slate-200 transition-all duration-700 
                                            focus-within:ring-8 focus-within:ring-amber-600/5 focus-within:border-amber-500/40 focus-within:border-r-amber-500/60 focus-within:shadow-xl focus-within:shadow-amber-900/10 
                                            group-[.is-active]/field:ring-8 group-[.is-active]/field:ring-amber-600/5 group-[.is-active]/field:border-amber-500/40 group-[.is-active]/field:border-r-amber-500/60 group-[.is-active]/field:shadow-xl group-[.is-active]/field:shadow-amber-900/10">
                
                                            <span class="material-symbols-outlined absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none group-focus-within/field:text-amber-600 group-[.is-active]/field:text-amber-600 transition-colors z-10">
                                                payments
                                            </span>

                                            <div class="flex items-center ml-14 w-full overflow-hidden">
                                                <span class="text-sm font-black text-slate-700 mr-1">Rp</span>
                                                <input type="number"
                                                    step="0.01"
                                                    name="amount" 
                                                    min="0" {{-- Tambahkan ini --}}
                                                    id="input_amount" 
                                                    required 
                                                    autocomplete="off"
                                                    placeholder="0.00"
                                                    oninput="checkInputStatus(this)"
                                                    class="w-full bg-transparent py-5 text-sm font-black outline-none border-none ring-0 focus:ring-0 text-slate-700 [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none p-0 m-0">
                                            </div>
                                        </div>

                                        <div class="flex items-center gap-2 px-1 transition-all duration-500 opacity-40 group-hover/modal:opacity-100 group-[.is-active]/field:opacity-100">
                                            <span class="material-symbols-outlined text-amber-500 text-sm transition-all duration-500 group-hover/field:scale-110 group-[.is-active]/field:scale-110">info</span>
                                            <p class="text-[10px] text-slate-500 font-medium group-hover/modal:text-slate-700">
                                                <span class="font-bold">Note:</span> "Enter the installment payment amount. Example: 510500"
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="px-10 pb-7 pt-4 bg-[#F8F9FC]">
                            <button type="submit" form="installmentForm"
                                class="w-full flex items-center justify-center gap-4 px-10 py-5 rounded-[2rem] font-black font-accent uppercase tracking-widest text-[11px] text-white transition-all duration-500 ease-in-out transform 
                                hover:-translate-y-1 hover:bg-right 
                                shadow-2xl shadow-slate-900/20 hover:shadow-[0_15px_30px_-5px_rgba(245,158,11,0.4)]
                                bg-gradient-to-r from-amber-700 via-amber-600 to-yellow-500 bg-[length:250%_150%] bg-left
                                group/btn border-t border-white/10 relative overflow-hidden">
                                
                                <span class="inline-block transition-all duration-500 group-hover/btn:scale-125 group-hover/btn:rotate-12">
                                    <span class="material-symbols-outlined text-xl block">check_circle</span>
                                </span>
                                
                                <span class="relative z-10">Confirm Payment</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                let maxFineAllowed = 0;
                
                function openInstallmentModal(id, totalFineRealTime) {
                    if (!id || id === 'undefined') {
                        console.error("ID tidak ditemukan");
                        return;
                    }

                    const modal = document.getElementById('installmentModal');
                    const form = document.getElementById('installmentForm');
                    const inputAmount = document.getElementById('input_amount');

                    
                    maxFineAllowed = parseFloat(totalFineRealTime);
                    inputAmount.max = maxFineAllowed;
                    
                    
                    form.reset();
                    inputAmount.setCustomValidity(""); 
                    document.getElementById('group_amount').classList.remove('is-active');

                    
                    form.action = `/dashboard/admin/member/pay-fine/${id}`; 

                    
                    document.body.classList.add('no-scroll');
                    modal.classList.remove('hidden');
                    
                    const backdrop = document.getElementById('installmentBackdrop');
                    const content = document.getElementById('installmentContent');
                    content.classList.remove('animate-modal-out');
                    content.classList.add('animate-modal-in');

                    setTimeout(() => {
                        backdrop.classList.replace('opacity-0', 'opacity-100');
                    }, 10);
                }

            function closeInstallmentModal() {
                const modal = document.getElementById('installmentModal');
                const backdrop = document.getElementById('installmentBackdrop');
                const content = document.getElementById('installmentContent');
                
               
                backdrop.classList.replace('opacity-100', 'opacity-0');
                content.classList.remove('animate-modal-in');
                content.classList.add('animate-modal-out');
                
               
                setTimeout(() => {
                    modal.classList.add('hidden');
                  
                    document.body.classList.remove('no-scroll');
                }, 300); 
            }

                document.getElementById('installmentForm').addEventListener('submit', function(e) {
                    const input = document.getElementById('input_amount');
                    const val = parseFloat(input.value);

                    if (val > maxFineAllowed) {
                        e.preventDefault();
                        input.setCustomValidity(`Nominal melebihi denda! Maksimal adalah Rp${maxFineAllowed.toLocaleString('id-ID')}`);
                        input.reportValidity();
                    } else if (val < 0) { 
                        e.preventDefault();
                        input.setCustomValidity("Nominal tidak boleh negatif!");
                        input.reportValidity();
                    } else {
                        input.setCustomValidity("");
                    }
                });

                function checkInputStatus(input) {
                    const group = input.closest('.group\\/field');
                    const val = parseFloat(input.value);

                    if (input.value.trim() !== "") {
                        group.classList.add('is-active');
                    } else {
                        group.classList.remove('is-active');
                    }

                    if (!isNaN(val)) {
                        if (val > maxFineAllowed) {
                            input.setCustomValidity(`Nominal melebihi total denda saat ini! Maksimal: Rp${maxFineAllowed.toLocaleString('id-ID')}`);
                            input.reportValidity(); 

                          
                            setTimeout(() => {
                                input.setCustomValidity("");
                            }, 3000); 

                        } else if (val < 0) {
                            input.setCustomValidity("Nominal tidak boleh negatif!");
                            input.reportValidity();

                            setTimeout(() => {
                                input.setCustomValidity("");
                            }, 3000);
                        } else {
                            input.setCustomValidity("");
                        }
                    }
                }
                
                document.getElementById('input_amount').addEventListener('keydown', function(e) {
                    if (e.key === '-' || e.key === 'e' || e.key === 'E') {
                        e.preventDefault();
                    }
                });
            </script>

            <style>
               
            body.no-scroll {
                position: fixed;
                overflow-y: scroll; 
                width: 100%;
            }

          
            @keyframes modal-in {
                0% { opacity: 0; transform: scale(0.9) translateY(20px); }
                100% { opacity: 1; transform: scale(1) translateY(0); }
            }

            @keyframes modal-out {
                0% { opacity: 1; transform: scale(1) translateY(0); }
                100% { opacity: 0; transform: scale(0.95) translateY(10px); }
            }

            .animate-modal-in {
                animation: modal-in 0.4s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
            }

            .animate-modal-out {
                animation: modal-out 300ms ease-in forwards !important;
            }

       
            .custom-scrollbar::-webkit-scrollbar { width: 4px; }
            .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
            .custom-scrollbar::-webkit-scrollbar-thumb { 
                background: #e2e8f0; 
                border-radius: 10px; 
            }
            </style>

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