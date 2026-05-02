<!DOCTYPE html>
<html class="light" lang="id">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>MyLibAry. | Modern Library Management</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100;300;400;500;600;700;800;900&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    <link crossorigin="anonymous" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" referrerpolicy="no-referrer" rel="stylesheet" />
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#2b6cee",
                        "gold": "#D4AF37",
                        "background-light": "#ffffff",
                        "silver": "#F8F9FC",
                        
                    },
                    fontFamily: {
                        "display": ["Lexend", "sans-serif"]
                    },
                    borderRadius: {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "2xl": "1.5rem",
                        "3xl": "2.5rem",
                        "full": "9999px"
                    },
                },
            },
        }
    </script>
        <script>
        function updateNavigation() {
            let sections = document.querySelectorAll('section[id]');
            let navLinks = document.querySelectorAll('nav .hidden.lg\\:flex a');
            let top = window.scrollY;

            sections.forEach(section => {
                let offset = section.offsetTop - 150;
                let height = section.offsetHeight;
                let id = section.getAttribute('id');

                if (top >= offset && top < offset + height) {
                    navLinks.forEach(link => {
                        link.classList.remove('border-b-2', 'border-primary', 'text-primary');
                        link.classList.add('text-slate-500', 'hover:-translate-y-1');

                        let isHome = (id === 'home' && link.getAttribute('href') === '#');
                        let isCurrentSection = (link.getAttribute('href') === '#' + id);

                        if (isCurrentSection || isHome) {
                            link.classList.add('border-b-2', 'border-primary', 'text-primary');
                            link.classList.remove('text-slate-500', 'text-slate-400', 'hover:-translate-y-1');
                        }
                    });
                }
            });

            if (top < 100) {
                navLinks.forEach(link => {
                    link.classList.remove('border-b-2', 'border-primary', 'text-primary');
                    link.classList.add('text-slate-500', 'hover:-translate-y-1');
                    
                    if (link.getAttribute('href') === '#') {
                        link.classList.add('border-b-2', 'border-primary', 'text-primary');
                        link.classList.remove('text-slate-500', 'text-slate-400', 'hover:-translate-y-1');
                    }
                });
            }
        }

        window.addEventListener('scroll', updateNavigation);

        document.addEventListener('DOMContentLoaded', updateNavigation);
    </script>
    <style type="text/tailwindcss">
        @layer base {
            :root {
                --primary: #2b6cee;
                --gold: #D4AF37;
                --bg-light: #ffffff;
                --silver: #f2f4f7;
            }
        }

        @layer components {
            .glass-nav {
                @apply bg-white/60 backdrop-blur-md;
            }
            .hero-silver-blend {
                background: linear-gradient(to bottom, 
                    rgba(255, 255, 255, 0) 0%, 
                    rgba(255, 255, 255, 0.2) 60%, 
                    var(--silver) 100%
                );
            }
            .material-symbols-outlined {
                font-variation-settings: 'FILL' 0, 'wght' 300, 'GRAD' 0, 'opsz' 24;
            }
            .book-card {
                @apply transition-all duration-500 ease-out;
            }
            .book-card:hover {
                @apply -translate-y-2;
            }

            .hover-zoom-container {
                @apply overflow-hidden rounded-2xl;
                isolation: isolate;
                -webkit-mask-image: -webkit-radial-gradient(white, black);
                transform: translate3d(0, 0, 0); 
                backface-visibility: hidden;
            }

            .hover-zoom-img {
                @apply transition-all duration-700 ease-in-out;
                will-change: transform, filter;
                transform: translateZ(0);
            }

            .hover-zoom-container:hover .hover-zoom-img {
                transform: scale(1.1);
                filter: grayscale(0);
            }
        }
    </style>
</head>
<body class="font-display bg-background-light text-[#1a1a1a] transition-colors duration-500 overflow-x-hidden">
    
    <nav class="fixed top-2 left-0 right-0 z-50 mx-auto max-w-[1200px] px-4 md:px-8">
    <div class="glass-nav border border-black/5 rounded-full px-8 h-16 flex items-center justify-between shadow-sm">
        <div class="flex items-center gap-2 group cursor-pointer" onclick="window.location.href='/'">
            <div class="size-6 text-primary flex items-center justify-center">
                <span class="material-symbols-outlined text-primary text-3xl font-bold">auto_stories</span>
            </div>
            <h2 class="text-base font-extrabold tracking-tighter text-slate-900">My<span class="text-primary italic">LibAry.</span></h2>
        </div>
        
        <div class="hidden lg:flex items-center gap-10">
            <a class="nav-link text-[10px] font-bold tracking-[0.2em] uppercase transition-all duration-300 hover:text-primary" href="#">Home</a>
            <a class="nav-link text-[10px] font-bold tracking-[0.2em] uppercase transition-all duration-300 hover:text-primary" href="#about">About</a>
            <a class="nav-link text-[10px] font-bold tracking-[0.2em] uppercase transition-all duration-300 hover:text-primary" href="#collection">Collection</a>
        </div>

        <div class="flex items-center gap-4">
            @if(auth()->check())
                @php
                    $user = auth()->user();
                    $isAdmin = $user->role === 'admin'; // Sesuaikan nama kolom role di database Anda   
                    $profileRoute = $isAdmin ? route('admin.dashboard') : route('siswa.profile');
                    $roleLabel = strtoupper($user->role);
                @endphp
                
                <div class="flex items-center gap-3 cursor-pointer group pl-6  ml-4" onclick="window.location.href='{{ route('siswa.profile') }}'">
                    
                    {{-- Teks Nama dengan Efek Hover Atas & Font Dashboard (font-accent) --}}
                    <div class="hidden sm:flex flex-col text-right transition-all duration-300 group-hover:-translate-y-1">
                        <span class="text-[13px] font-bold text-slate-800 normal-case leading-none group-hover:text-blue-600 transition-colors font-heading">
                            {{ auth()->user()->username }}
                        </span>
                        <span class="text-[9px] text-blue-600 font-black mt-1 tracking-wider uppercase font-accent">
                            @if(auth()->user()->isAdmin())
                                Administrator
                            @else
                                Student
                            @endif
                        </span>
                    </div>

                    {{-- Foto Profil (Tetap Diam tanpa efek hover) --}}
                    <div class="h-9 w-9 rounded-full bg-blue-600 flex items-center justify-center text-white text-[10px] font-black shadow-lg ring-4 ring-white overflow-hidden flex-shrink-0">
                        @if(auth()->user()->foto_profile)
                            <img src="{{ asset('storage/' . auth()->user()->foto_profile) }}?t={{ time() }}" class="w-full h-full object-cover">
                        @else
                            {{ strtoupper(substr(auth()->user()->username, 0, 2)) }}
                        @endif
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}" class="text-[10px] font-extrabold tracking-widest uppercase text-slate-700 hover:text-primary transition-all hover:-translate-y-1 duration-300">Login</a>          
                <a href="{{ route('register') }}" class="bg-primary text-white px-5 py-2 rounded-full text-[10px] font-extrabold tracking-widest uppercase shadow-lg shadow-primary/20 hover:bg-slate-900 transition-all hover:-translate-y-1 duration-300">
                    Register
                </a>
            @endif
        </div>
    </div>
</nav>

    <section id="home" class="relative h-[95vh] flex items-center justify-center px-6 overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img alt="Modern library interior" class="w-full h-full object-cover opacity-90" src="{{ asset('images/hero.jpeg') }}" />
            <div class="absolute inset-0 bg-white/5"></div>
            <div class="absolute inset-0 hero-silver-blend"></div>
        </div>
        <div class="relative z-10 text-center max-w-4xl mx-auto flex flex-col items-center">
            <span class="inline-block text-[10px] font-black tracking-[0.5em] uppercase text-primary/80 mb-4 bg-primary/5 px-4 py-1 rounded-full">The Future of Reading</span>
            <h1 class="text-5xl md:text-8xl font-extralight tracking-tighter leading-[0.95] text-slate-900">
                Simplify Your <br />
                <span class="font-black bg-clip-text text-transparent bg-gradient-to-r from-slate-900 via-primary to-slate-800">Knowledge Hub</span>
            </h1>
            <p class="text-slate-600 text-lg md:text-xl font-light max-w-2xl mx-auto leading-relaxed mt-6 italic">
                Experience a <span class="text-slate-900 font-medium">refined approach</span> to library management. Intelligent, minimal, and built for the modern digital archive.
            </p>
            <div class="mt-10">
                @php
                    if (auth()->check()) {
                        $exploreUrl = auth()->user()->role === 'admin' ? route('admin.dashboard') : route('siswa.dashboard');
                    } else {
                        $exploreUrl = route('login');
                    }
                @endphp

                <a href="{{ $exploreUrl }}" 
                class="inline-block bg-slate-900 text-white px-12 py-5 rounded-full text-xs font-black tracking-[0.3em] uppercase shadow-2xl shadow-black/20 hover:bg-primary transition-all hover:scale-105">
                    Start Exploring
                </a>
            </div>
        </div>
    </section>

        <section class="py-20 relative overflow-hidden" id="about" style="background-color: #F8F9FC; background-image: radial-gradient(at 0% 0%, rgba(43, 108, 238, 0.05) 0px, transparent 50%), radial-gradient(at 100% 0%, rgba(43, 108, 238, 0.03) 0px, transparent 50%);">
        <div class="absolute top-0 right-0 -z-10 w-[500px] h-[500px] bg-blue-100/20 rounded-full blur-[120px] -translate-y-1/2 translate-x-1/2"></div>
        <div class="max-w-[1200px] mx-auto px-8 relative z-10">
            <div class="bg-white rounded-3xl p-10 lg:p-16 shadow-[0_20px_50px_rgba(0,0,0,0.03)] border border-black/5">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20 items-center">
                    <div class="relative order-2 lg:order-1">
                        <div class="hover-zoom-container shadow-xl"> 
                            <img alt="Sleek modern office" 
                                class="hover-zoom-img w-full h-[450px] object-cover grayscale" 
                                src="{{ asset('images/about.JPG') }}" />
                        </div>
                    </div>
                    <div class="space-y-8 order-1 lg:order-2">
                        <div class="space-y-6">
                            <h2 class="text-black text-xs font-black tracking-[0.4em] uppercase">About <span class="text-primary">MyLibAry.</span></h2>
                            <h3 class="text-4xl md:text-5xl font-extrabold leading-tight tracking-tighter text-slate-900">Elegance meets <br /><span class="text-primary">efficiency.</span></h3>
                            <p class="text-slate-500 text-lg leading-relaxed font-light">
                                We believe that managing knowledge <span class="text-slate-800 font-normal italic">shouldn't be complicated</span>. MyLibAry. provides a seamless interface for digital and physical archives, ensuring your collection is always within reach.
                            </p>
                        </div>
                        <div class="pt-2 flex flex-col gap-6">
                            <div class="items-start gap-4 flex">
                                <span class="material-symbols-outlined text-primary text-2xl mt-1">auto_awesome</span>
                                <div>
                                    <h4 class="font-black text-xs uppercase tracking-widest text-slate-900 mb-1">Intuitive Flow</h4>
                                    <p class="text-sm text-slate-500 leading-relaxed font-light">Designed for <span class="text-primary font-medium">speed and clarity</span> in every interaction.</p>
                                </div>
                            </div>
                            <div class="items-start gap-4 flex">
                                <span class="material-symbols-outlined text-primary text-2xl mt-1">encrypted</span>
                                <div>
                                    <h4 class="font-black text-xs uppercase tracking-widest text-slate-900 mb-1">Global Security</h4>
                                    <p class="text-sm text-slate-500 leading-relaxed font-light">Enterprise-grade encryption for your <span class="text-gold font-medium">most valuable assets</span>.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

        <section class="py-24 bg-background-light" id="collection">
        <div class="max-w-[1200px] mx-auto px-8">
            <div class="flex flex-col items-center text-center gap-4 mb-20">
                <div class="space-y-4">
                    <h2 class="text-sm font-black tracking-[0.4em] uppercase text-primary/50">Discovery</h2>
                    <h3 class="text-5xl md:text-7xl font-extrabold tracking-tighter text-slate-900 leading-tight">
                        Curated <span class="font-light italic">Collection</span>
                    </h3>
                </div>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-12">
                @foreach($books as $book)
                <div class="book-card group cursor-pointer" 
                    onclick="window.location='{{ 
                        auth()->check() ? 
                        (auth()->user()->role === 'admin' ? route('siswa.book.detail', $book->id) : route('siswa.book.detail', $book->id)) : 
                        route('login') 
                    }}'">
                    
                    <div class="relative aspect-[2/3] mb-6 shadow-md overflow-hidden rounded-2xl bg-white border border-slate-100 group-hover:shadow-blue-200/50 transition-all duration-500 hover-zoom-container">
                        <img alt="{{ $book->title }}" 
                            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" 
                            src="{{ asset($book->cover_image) }}" 
                            onerror="this.src='https://via.placeholder.com/400x600?text=No+Cover'" />
                        
                        <div class="absolute inset-0 flex flex-col items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-500 bg-slate-900/40 backdrop-blur-[2px]">
                            <div class="transform translate-y-8 group-hover:translate-y-0 transition-transform duration-500 mb-5">
                                <span class="material-symbols-outlined text-white text-4xl bg-[#2b6cee]/90 rounded-full p-3 shadow-2xl shadow-blue-500/50">add</span>
                            </div>

                            <div class="flex flex-col items-center gap-2 transform translate-y-8 group-hover:translate-y-0 transition-transform duration-500 delay-75 w-full px-4 text-center">
                                <div class="bg-[#2b6cee]/65 px-5 py-2 rounded-xl flex items-center justify-center max-w-full shadow-lg border border-white/20">
                                    <span class="text-white font-black text-[9px] uppercase tracking-widest font-accent truncate block w-full max-w-[146px] text-center">
                                        {{ $book->category_name ?? 'General' }}
                                    </span>
                                </div>

                                <div class="flex items-center justify-center bg-white/20 backdrop-blur-md px-4 py-1.5 rounded-xl border border-white/10 shadow-lg">
                                    <span class="text-white font-bold text-[9px] uppercase tracking-tighter font-accent">
                                        {{ $book->total_pages ?? '0' }} Pages
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-1 text-left px-1">
                        <h4 class="font-extrabold text-lg tracking-tight text-slate-900 group-hover:text-primary transition-colors line-clamp-1">
                            {{ Str::limit($book->title, 25) }}
                        </h4>
                        <p class="text-[10px] font-black text-blue-600/60 uppercase tracking-widest font-accent italic">
                            {{ $book->author_name ?? 'Unknown Author' }}
                        </p>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="mt-20 text-center">
                @php
                    if (auth()->check()) {
                        $libraryUrl = auth()->user()->role === 'admin' ? route('siswa.library') : route('siswa.library');
                    } else {
                        $libraryUrl = route('login');
                    }
                @endphp

                <a href="{{ $libraryUrl }}" 
                class="inline-block px-12 py-5 bg-slate-900 text-white rounded-full text-[11px] font-black tracking-[0.3em] uppercase shadow-2xl shadow-black/20 hover:bg-primary hover:scale-105 transition-all duration-300">
                    View Entire Libary
                </a>
            </div>
        </div>
    </section>

    <footer class="pt-20 pb-10 px-8 bg-slate-950 text-white/80 border-t border-white/5">
        <div class="max-w-[1200px] mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-3 items-start gap-12 pb-12">
                <div class="space-y-6">
                    <div class="flex items-center gap-2">
                        <div class="size-6 text-primary flex items-center justify-center">
                            <span class="material-symbols-outlined text-primary text-3xl font-bold">auto_stories</span>
                    </div>
                        <h2 class="text-xl font-black uppercase tracking-tighter text-white">My<span class="text-primary italic">LibAry.</span></h2>
                    </div>
                    <p class="text-[13px] font-light leading-relaxed max-w-xs text-slate-400">
                        Redefining the <span class="text-white">digital archive</span> with elegance and intelligence. Built for modern creators and curators.
                    </p>
                    <div class="flex items-center gap-6 pt-2">
                        <a class="text-slate-500 hover:text-primary hover:-translate-y-1.5 transition-all duration-300 text-lg" href="#"><i class="fab fa-youtube"></i></a>
                        <a class="text-slate-500 hover:text-primary hover:-translate-y-1.5 transition-all duration-300 text-lg" href="#"><i class="fab fa-instagram"></i></a>
                        <a class="text-slate-500 hover:text-primary hover:-translate-y-1.5 transition-all duration-300 text-lg" href="#"><i class="fab fa-github"></i></a>
                        <a class="text-slate-500 hover:text-primary hover:-translate-y-1.5 transition-all duration-300 text-lg" href="#"><i class="fab fa-facebook-f"></i></a>
                    </div>
                </div>
                <div class="flex flex-col gap-4 text-[12px] font-black tracking-[0.2em] uppercase pt-1">
                    <p class="text-primary mb-2 opacity-100 border-b border-primary/20 pb-2 w-fit">Navigation</p>
                    <a class="text-slate-400 hover:text-white hover:-translate-y-1 transition-all duration-300 w-fit" href="#">Home</a>
                    <a class="text-slate-400 hover:text-white hover:-translate-y-1 transition-all duration-300 w-fit" href="#about">About</a>
                    <a class="text-slate-400 hover:text-white hover:-translate-y-1 transition-all duration-300 w-fit" href="#collection">Collection</a>
                </div>
                <div class="flex flex-col gap-4 text-[12px] font-black tracking-[0.2em] uppercase pt-1">
                    <p class="text-gold mb-2 opacity-100 border-b border-gold/20 pb-2 w-fit">Legal</p>
                    <a class="text-slate-400 hover:text-white hover:-translate-y-1 transition-all duration-300 w-fit" href="#">Terms & Conditions</a>
                    <a class="text-slate-400 hover:text-white hover:-translate-y-1 transition-all duration-300 w-fit" href="#">Privacy Policy</a>
                    <a class="text-slate-400 hover:text-white hover:-translate-y-1 transition-all duration-300 w-fit" href="#">Cookie Policy</a>
                </div>
            </div>
            <div class="pt-8 border-t border-white/5 text-center">
                <p class="text-[11px] font-bold uppercase tracking-[0.4em] text-slate-600">© 2024 <span class="text-slate-400">MyLibAry. Management.</span> Redefining the Digital Archive.</p>
            </div>
        </div>
    </footer>

</body>



</html>