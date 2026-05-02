<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>MyLibAry. | Forgot Password</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    
    <!-- Google Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&display=swap" rel="stylesheet" />

    <style type="text/tailwindcss">
        @layer base {
            :root {
                --primary: #2563eb;
            }
            body { 
                font-family: 'Plus Jakarta Sans', sans-serif; 
            }
            .material-symbols-outlined {
                font-family: 'Material Symbols Outlined' !important;
                font-weight: normal;
                font-style: normal;
                line-height: 1;
                letter-spacing: normal;
                text-transform: none;
                display: inline-block;
                white-space: nowrap;
                word-wrap: normal;
                direction: ltr;
                -webkit-font-feature-settings: 'liga';
                -webkit-font-smoothing: antialiased;
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
                theme: { extend: { colors: { primary: "#2563eb" } } }
            };

                document.addEventListener('DOMContentLoaded', function() {
                        const emailInput = document.getElementById('email');
                        const form = emailInput.closest('form');
                        let validationTimeout;

                        function validateEmailLogic(el) {
                el.setCustomValidity(''); 
                const val = el.value.trim();

                if (!val) {
                    el.setCustomValidity('Harap isi email Anda terlebih dahulu!');
                } else if (/\s/.test(val)) {
                    el.setCustomValidity('Email tidak boleh menggunakan space');
                } else if (!val.includes('@')) {
                    el.setCustomValidity('Email harus menggunakan tanda "@"');
                } else if (!val.toLowerCase().endsWith('@gmail.com')) {
                    el.setCustomValidity('Email harus menggunakan domain @gmail.com');
                }
            }

            emailInput.addEventListener('input', function() {
                this.setCustomValidity('');
            });

            form.addEventListener('submit', function(e) {
                validateEmailLogic(emailInput);

                if (!emailInput.checkValidity()) {
                    e.preventDefault();
                    emailInput.reportValidity();
                    
                    clearTimeout(validationTimeout);
                    validationTimeout = setTimeout(() => {
                        emailInput.setCustomValidity('');
                    }, 5000);
                }
            });
        });
    </script>
</head>

<body class="bg-slate-100 dark:bg-slate-950 h-screen w-screen flex items-center justify-center p-4 md:p-6 overflow-hidden">
    <div class="relative w-full h-full max-w-6xl max-h-[calc(100vh-3rem)] bg-white dark:bg-slate-900 md:rounded-[2.5rem] shadow-2xl overflow-hidden flex flex-col md:flex-row transition-all duration-500">
        
        <!-- Form Side -->
        <div class="w-full md:w-1/2 h-full p-6 lg:p-10 xl:p-12 flex flex-col z-20 bg-white dark:bg-slate-900">
            <div class="w-full max-w-md mx-auto my-auto">
                <div class="flex items-center gap-2 mb-4">
                    <span class="material-symbols-outlined text-primary text-3xl font-bold">auto_stories</span>
                    <h1 class="text-2xl font-extrabold tracking-tighter text-slate-900 dark:text-white">My<span class="text-primary italic">LibAry.</span></h1>
                </div>

                <div class="mb-8">
                    <h2 class="text-4xl font-extrabold text-slate-900 dark:text-white tracking-tight leading-none">Forgot Password?</h2>
                    <p class="text-slate-400 dark:text-slate-500 text-xs font-bold uppercase tracking-[0.2em] mt-3">Enter your registered email to verify your account.</p>
                </div>

                <form action="{{ route('password.email') }}" method="POST" novalidate>
                    @csrf

                    <div class="relative group mb-10">
                        <label class="block text-[10px] font-black uppercase tracking-[0.15em] text-slate-500 dark:text-slate-400 mb-1.5 ml-1" for="email">
                            Email Address
                        </label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-300 group-focus-within:text-primary transition-colors">
                                <span class="material-symbols-outlined text-lg">mail</span>
                            </span>
                            <input class="block w-full pl-10 pr-4 py-3.5 text-sm font-medium border border-slate-200 dark:border-slate-700 rounded-xl bg-slate-50 dark:bg-slate-800/50 text-slate-900 dark:text-white placeholder-slate-300 focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all outline-none" 
                            id="email" name="email" placeholder="example@email.com" type="text" />
                        </div>
        
                        <div class="absolute -bottom-6 left-1 h-4">
                                @error('email') 
                                    <span class="text-red-500 text-[10px] font-bold not-italic leading-none">{{ $message }}</span> 
                                @enderror
                            </div>
                        </div>

                    <button class="mt-4 w-full bg-slate-900 dark:bg-primary hover:bg-primary dark:hover:bg-blue-700 text-white text-[11px] font-black uppercase tracking-[0.2em] py-4 rounded-xl shadow-xl shadow-slate-200 dark:shadow-blue-500/25 transition-all transform hover:-translate-y-1 active:translate-y-0" type="submit">
                        Verify Email
                    </button>
                </form>

                <div class="mt-8 text-center">
                    <a class="text-slate-400 dark:text-slate-500 text-sm font-bold hover:text-primary transition-colors inline-flex items-center gap-2" href="{{ route('login') }}">
                        <span class="material-symbols-outlined text-sm">arrow_back</span>
                        Back to Login
                    </a>
                </div>
            </div>
        </div>

        <!-- Image Side (Konsisten dengan model sebelumnya) -->
        <div class="hidden md:block w-1/2 h-full relative z-10 overflow-hidden">
            <img alt="Security" class="absolute inset-0 w-full h-full object-cover" src="{{ asset('images/nyoba.jpg') }}" />
            <div class="absolute inset-0 bg-gradient-to-br from-blue-900/40 via-transparent to-black/80 flex flex-col justify-end p-12">
                <div class="max-w-md bg-white/10 backdrop-blur-xl border border-white/20 p-8 rounded-[2.5rem] shadow-2xl">
                    <h3 class="text-3xl font-extrabold text-white mb-4 leading-[1.1] tracking-tighter">Account Protection</h3>
                    <p class="text-blue-50 text-sm font-medium opacity-80 leading-relaxed italic border-l-2 border-primary/50 pl-4">We ensure your literacy data remains private and secure through advanced verification layers.</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>