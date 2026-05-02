<!DOCTYPE html>
    <html class="light" lang="id">
    <head>
        <meta charset="utf-8"/>
        <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
        <title>MyLibAry. | Library Login</title>
        <script src="https://cdn.tailwindcss.com?plugins=forms,typography,container-queries"></script>
        <link href="https://fonts.googleapis.com" rel="preconnect"/>
        <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet"/>
        <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
        <style type="text/tailwindcss">
            @layer base {
                body { 
                    font-family: 'Plus Jakarta Sans', sans-serif; 
                    @apply bg-slate-100 dark:bg-slate-950 overflow-hidden h-screen w-screen;
                }
            }
            @layer components {
                .transition-premium {
                    transition: all 0.8s cubic-bezier(0.65, 0, 0.35, 1);
                }
                .form-container {
                    width: 40%;
                    min-width: 400px;
                }
                .image-container {
                    width: 60%;
                }
                .role-student .form-container { transform: translateX(0); }
                .role-student .image-container { transform: translateX(0); }
                .role-admin .form-container { transform: translateX(150%); }
                .role-admin .image-container { transform: translateX(-66.666%); }
                .bg-image {
                    transition: opacity 0.8s cubic-bezier(0.65, 0, 0.35, 1);
                }
                .role-student .img-student { opacity: 1; }
                .role-student .img-admin { opacity: 0; }
                .role-admin .img-student { opacity: 0; }
                .role-admin .img-admin { opacity: 1; }
                .scrollbar-hide::-webkit-scrollbar {
                    display: none;
                }
                .scrollbar-hide {
                    -ms-overflow-style: none;
                    scrollbar-width: none;
                }
                .text-gradient-primary {
                    @apply bg-clip-text text-transparent bg-gradient-to-r from-slate-900 via-primary to-blue-600 dark:from-white dark:via-blue-400 dark:to-slate-300;
                }
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
            .no-transition * {
                transition: none !important;
            }
        </style>
        <script>
            tailwind.config = {
                darkMode: "class",
                theme: {
                    extend: {
                        colors: {
                            primary: "#2563eb",
                        },
                        borderRadius: {
                            '4xl': '2rem',
                        }
                    },
                },
            };
        </script>
    </head>
    <body class="flex items-center justify-center p-4 md:p-6 {{ old('role_pintu') === 'admin' ? 'no-transition' : '' }}">
        <div class="role-student relative w-full max-w-[1600px] h-full max-h-[calc(100vh-3rem)] bg-white dark:bg-slate-900 rounded-4xl shadow-2xl overflow-hidden flex transition-premium" id="login-portal">
            <div class="form-container h-full flex flex-col transition-premium z-20 bg-white dark:bg-slate-900 relative">
                <div class="h-full overflow-hidden px-8 py-10 md:px-16 md:py-12 flex flex-col">
                    <div class="w-full max-w-md mx-auto my-auto -mt-1">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-10 h-10 bg-primary rounded-xl flex items-center justify-center shadow-lg shadow-primary/30">
                                <span class="material-symbols-outlined text-white text-2xl">auto_stories</span>
                            </div>
                            <h1 class="text-2xl font-extrabold tracking-tighter text-slate-900 dark:text-white">My<span class="text-primary italic">LibAry.</span></h1>
                        </div>
                        <div class="mb-6">
                            <h2 class="text-4xl font-extrabold text-slate-900 dark:text-white mb-2 tracking-tight" id="welcome-title">Welcome</h2>
                            <p class="text-slate-400 dark:text-slate-500 text-sm font-medium tracking-wide uppercase" id="welcome-subtitle">Your gateway to thousands of literacies awaits.</p>
                        </div>
                        <div class="relative bg-slate-100 dark:bg-slate-800 p-1 rounded-xl flex items-center mb-8 w-full">
                            <div class="absolute w-[calc(50%-4px)] h-[calc(100%-8px)] bg-white dark:bg-slate-700 rounded-lg transition-all duration-500 ease-out shadow-sm" id="role-pill" style="left: 4px;"></div>
                            <button type="button" class="relative z-10 w-1/2 py-2 text-xs font-black uppercase tracking-[0.1em] text-slate-900 dark:text-white transition-colors duration-300" onclick="switchRole('siswa')">Siswa</button>
                            <button type="button" class="relative z-10 w-1/2 py-2 text-xs font-black uppercase tracking-[0.1em] text-slate-400 dark:text-slate-500 transition-colors duration-300" onclick="switchRole('admin')">Admin</button>
                        </div>
                        <form action="{{ route('login.post') }}" method="POST" class="space-y-6">
                            @csrf
                            <input type="hidden" name="role_pintu" id="role-input" value="siswa">
                            <div>
                                <label class="block text-[11px] font-black uppercase tracking-widest text-slate-500 dark:text-slate-400 mb-2" for="user-id">
                                    <span id="label-user">Username Siswa</span>
                                </label>
                                <div class="relative group">
                                    <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-slate-300 group-focus-within:text-primary transition-colors">
                                        <span class="material-symbols-outlined text-xl">person_outline</span>
                                    </span>
                                    <input name="username" class="block w-full pl-11 pr-4 py-3.5 border-slate-200 dark:border-slate-700 rounded-xl bg-slate-50 dark:bg-slate-800/50 text-slate-900 dark:text-white font-medium placeholder-slate-300 focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all outline-none" id="user-id" placeholder="Enter Your Username" type="text" />
                                </div>
                            </div>
                            <div>
                                <label class="block text-[11px] font-black uppercase tracking-widest text-slate-500 dark:text-slate-400 mb-2" for="password">Password</label>
                                <div class="relative group">
                                    <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-slate-300 group-focus-within:text-primary transition-colors">
                                        <span class="material-symbols-outlined text-xl">lock_open</span>
                                    </span>
                                    <input name="password" class="block w-full pl-11 pr-4 py-3.5 border-slate-200 dark:border-slate-700 rounded-xl bg-slate-50 dark:bg-slate-800/50 text-slate-900 dark:text-white font-medium placeholder-slate-300 focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all outline-none" id="password" placeholder="••••••••" type="password" />
                                </div>
                            </div>

                            <div class="flex justify-end mb-4">
                                <a class="text-[13px] font-bold text-slate-400 dark:text-slate-500 hover:text-primary transition-colors decoration-primary/20 underline decoration-1 underline-offset-4" href="{{ route('password.request') }}">
                                    Forgot Your Password?
                                </a>
                            </div>
                            <button class="w-full bg-slate-900 dark:bg-primary hover:bg-primary dark:hover:bg-blue-700 text-white text-xs font-black uppercase tracking-[0.2em] py-4 rounded-xl shadow-xl shadow-slate-200 dark:shadow-primary/25 transition-all transform hover:-translate-y-0.5 active:translate-y-0" type="submit">
                                Login
                            </button>
                        </form>
                        <p class="mt-6 text-center text-sm font-bold text-slate-400 dark:text-slate-500">
                            Not registered yet? <a class="text-primary hover:text-blue-700 border-b border-primary/20 pb-0.5 transition-all" href="{{ route('register') }}">Create a New Account</a>
                        </p>
                    </div>
                </div>
            </div>
            <div class="image-container h-full relative transition-premium overflow-hidden z-10">
                <img alt="Modern Student Library" class="img-student bg-image absolute inset-0 w-full h-full object-cover" src="{{ asset('images/wle.jpg') }}"/>
                <img alt="Professional Library Office" class="img-admin bg-image absolute inset-0 w-full h-full object-cover" src="{{ asset('images/nyoba.jpg') }}"/>
                <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-900/40 to-transparent"></div>
                <div class="absolute inset-0 flex flex-col justify-end p-10 md:p-16 lg:p-20 text-white overflow-hidden">
                    <div class="max-w-xl">
                        <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/10 backdrop-blur-xl border border-white/20 text-[10px] font-black uppercase tracking-[0.2em] mb-6 shadow-2xl" id="badge-role">
                            <span class="material-symbols-outlined text-xs text-blue-400">auto_awesome</span>
                            <span id="badge-text">Student Login</span>
                        </div>
                        <h3 class="text-4xl md:text-5xl lg:text-6xl font-extrabold mb-6 leading-[1.1] tracking-tighter" id="image-title">Global Literacy Access in Your Hands.</h3>
                        <h3 class="text-sm md:text-base text-slate-300 opacity-80 leading-relaxed font-medium italic border-l-2 border-primary/50 pl-4" id="image-desc">Explore thousands of journals, ebooks, and physical collections digitally with an integrated management system.</h3>
                    </div>
                    <div class="mt-10 flex items-center gap-6 transition-opacity duration-500" id="stats-section">
                        <div class="flex -space-x-3">
                            <img alt="User" class="w-10 h-10 rounded-full border-2 border-slate-900 object-cover" src="https://www.thesprucepets.com/thmb/lE6PNkkthkF_osRnyxjhAwhsl6k=/2098x1428/filters:no_upscale():max_bytes(150000):strip_icc()/GettyImages-1020755214-2b4b78c2b0c0458fbc0a2a99356c6e9b.jpg"/>
                            <img alt="User" class="w-10 h-10 rounded-full border-2 border-slate-900 object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDs5hAA7eR3iKNseCivHp6eNV1EfsNAVJ32ECoN8aFo_xF34a8HSpD6Nu7Gg5LiA0PtPLaQ-f-jx2rsvPV--vG7WW3IuvYItU_6OoHNxpcWVDEWs7fcATsIgcadiOj6hsgFWqp7ICmtIY6bUZs_t_iJcYhXc5-Zo0rfDiQpYCb6mnex7bKaBsBB-4vgiFt0g-1UiC9y2gOFUrhoFW_PNLzVYooFix9YYlIPFo6zTai4qPQrzW81FmX6oXwwXuhvr5_ApKCQ-gaWvOh_"/>
                            <div class="w-10 h-10 rounded-full border-2 border-slate-900 bg-primary flex items-center justify-center text-[10px] font-black shadow-lg shadow-primary/40">+2k</div>
                        </div>
                        <div>
                            <p class="text-[11px] font-black uppercase tracking-widest text-white">2,400+ Active Students</p>
                            <p class="text-[10px] font-bold text-slate-400 italic">Trusted by community</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            let inputState = {
                siswa: { user: '', pass: '' },
                admin: { user: '', pass: '' }
            };
            let currentRole = 'siswa';

            function toggleDarkMode() {
                document.documentElement.classList.toggle('dark');
            }

            function switchRole(role, isInit = false) {
                const portal = document.getElementById('login-portal');
                const pill = document.getElementById('role-pill');
                const welcomeTitle = document.getElementById('welcome-title');
                const welcomeSubtitle = document.getElementById('welcome-subtitle');
                const labelUser = document.getElementById('label-user');
                const badgeText = document.getElementById('badge-text');
                const imageTitle = document.getElementById('image-title');
                const imageDesc = document.getElementById('image-desc');
                const statsSection = document.getElementById('stats-section');
                const buttons = pill.parentElement.querySelectorAll('button');
                const roleInput = document.getElementById('role-input');
                
                const userInput = document.getElementById('user-id');
                const passInput = document.getElementById('password');

                if (!isInit && userInput && passInput) {
                    inputState[currentRole].user = userInput.value;
                    inputState[currentRole].pass = passInput.value;
                }

                currentRole = role;
                roleInput.value = role; 

                if (role === 'admin') {
                    portal.classList.replace('role-student', 'role-admin');
                    pill.style.left = 'calc(50% + 0px)';
                    
                    welcomeTitle.innerText = "Administration Panel";
                    welcomeSubtitle.innerText = "Manage your library's literacy ecosystem.";
                    labelUser.innerText = "Username Admin";
                    badgeText.innerText = "Administrator Login";
                    imageTitle.innerText = "Complete Control Over Library Management.";
                    imageDesc.innerText = "Monitor book circulation and manage inventory in real-time.";
                    
                    statsSection.classList.add('opacity-0', 'pointer-events-none');
                    buttons[0].classList.add('text-slate-400', 'dark:text-slate-500');
                    buttons[0].classList.remove('text-slate-900', 'dark:text-white');
                    buttons[1].classList.remove('text-slate-400', 'dark:text-slate-500');
                    buttons[1].classList.add('text-slate-900', 'dark:text-white');
                } else {
                    portal.classList.replace('role-admin', 'role-student');
                    pill.style.left = '4px';
                    
                    welcomeTitle.innerText = "Welcome";
                    welcomeSubtitle.innerText = "Your gateway to thousands of literacies awaits.";
                    labelUser.innerText = "Username Siswa";
                    badgeText.innerText = "Student Login";
                    imageTitle.innerText = "Global Literacy Access in Your Hands.";
                    imageDesc.innerText = "Explore thousands of journals, ebooks, and physical collections digitally.";
                    
                    statsSection.classList.remove('opacity-0', 'pointer-events-none');
                    buttons[1].classList.add('text-slate-400', 'dark:text-slate-500');
                    buttons[1].classList.remove('text-slate-900', 'dark:text-white');
                    buttons[0].classList.remove('text-slate-400', 'dark:text-slate-500');
                    buttons[0].classList.add('text-slate-900', 'dark:text-white');
                }

                if (userInput && passInput) {
                    userInput.value = inputState[role].user;
                    passInput.value = inputState[role].pass;
                }
            }

            const handleValidationBalloon = (inputElement, message) => {
                if (!inputElement) return;
                inputElement.setCustomValidity(message);
                inputElement.reportValidity();
                setTimeout(() => {
                    inputElement.setCustomValidity('');
                    if (document.activeElement === inputElement) {
                        inputElement.blur();
                        inputElement.focus();
                    }
                }, 3000);
            };

            document.addEventListener('DOMContentLoaded', function() {
                const userInput = document.getElementById('user-id');
                const passInput = document.getElementById('password');
                const form = document.querySelector('form');
                const errorMessage = "{{ session('error') }}";
                const lastRole = "{{ old('role_pintu') }}";

                if (lastRole === 'admin') {
                    switchRole('admin', true);
                }

                requestAnimationFrame(() => {
                    setTimeout(() => {
                        document.body.classList.remove('no-transition');
                    }, 50);
                });

                if (errorMessage && userInput) {
                    handleValidationBalloon(userInput, errorMessage);
                }

                if (form) {
                    form.addEventListener('submit', function(e) {
                        if (userInput.value.trim() === "") {
                            e.preventDefault();
                            handleValidationBalloon(userInput, "Username tidak boleh kosong!");
                        } else if (passInput.value.trim() === "") {
                            e.preventDefault();
                            handleValidationBalloon(passInput, "Password tidak boleh kosong!");
                        }
                    });
                }

                userInput.addEventListener('input', () => {
                    userInput.setCustomValidity('');
                    inputState[currentRole].user = userInput.value;
                });
                
                passInput.addEventListener('input', () => {
                    passInput.setCustomValidity('');
                    inputState[currentRole].pass = passInput.value;
                });
            });
        </script>
    </body>
    </html>