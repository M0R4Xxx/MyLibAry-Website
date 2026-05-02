<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>MyLibAry. | Reset Password</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    <style type="text/tailwindcss">
        @layer base {
            :root {
                --primary: #2563eb;
                --background-light: #f8fafc;
                --background-dark: #0f172a;
            }
            body { 
                font-family: 'Plus Jakarta Sans', sans-serif; 
            }
        }
        @layer components {
            .form-transition {
                transition: all 0.7s cubic-bezier(0.4, 0, 0.2, 1);
            }
        }

        input:-webkit-autofill,
        input:-webkit-autofill:hover, 
        input:-webkit-autofill:focus {
            transition: background-color 5000s ease-in-out 0s, box-shadow 5000s ease-in-out 0s;
            -webkit-text-fill-color: #334155 !important;
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
                },
            },
        };

        document.addEventListener('DOMContentLoaded', function() {
            setupValidation();
        });

        function setupValidation() {
            const form = document.getElementById('resetForm');
            const password = document.getElementById('password');
            const password_confirmation = document.getElementById('password_confirmation');

            function validateInput(el) {
                el.setCustomValidity('');
                const val = el.value.trim();

                if (el === password) {
                    if (!val) el.setCustomValidity('Password baru tidak boleh kosong');
                    else if (/\s/.test(val)) el.setCustomValidity('Password tidak boleh menggunakan space');
                    else if (val.length < 6 || val.length > 14) el.setCustomValidity('Password minimal 6 huruf dan maksimal 14');
                }

                if (el === password_confirmation) {
                    if (val !== password.value.trim()) el.setCustomValidity('Konfirmasi password tidak cocok');
                }
            }

            [password, password_confirmation].forEach(input => {
                input.addEventListener('input', () => {
                    input.setCustomValidity('');
                });
            });

            form.addEventListener('submit', function(e) {
                validateInput(password);
                validateInput(password_confirmation);

                if (!form.checkValidity()) {
                    e.preventDefault();
                    form.reportValidity();
                }
            });
        }
    </script>
</head>

<body class="bg-slate-100 dark:bg-slate-950 h-screen w-screen flex items-center justify-center p-4 md:p-6 overflow-hidden">
    <div class="relative w-full h-full max-w-6xl max-h-[calc(100vh-3rem)] bg-white dark:bg-slate-900 md:rounded-[2.5rem] shadow-2xl overflow-hidden flex flex-col md:flex-row transition-all duration-500" id="main-card">
        
        <!-- Form Side -->
        <div class="w-full md:w-1/2 h-full p-6 lg:p-10 xl:p-12 flex flex-col form-transition z-20 bg-white dark:bg-slate-900" id="form-side">
            <div class="w-full max-w-md mx-auto my-auto">
                <div class="flex-none">
                    <div class="flex items-center gap-2 mb-4">
                        <span class="material-symbols-outlined text-primary text-3xl font-bold">auto_stories</span>
                        <h1 class="text-2xl font-extrabold tracking-tighter text-slate-900 dark:text-white">My<span class="text-primary italic">LibAry.</span></h1>
                    </div>
                    <h2 class="text-4xl font-extrabold text-slate-900 dark:text-white tracking-tight leading-none">Security Recovery</h2>
                    <p class="text-slate-400 dark:text-slate-500 text-xs font-bold uppercase tracking-[0.2em] mt-3 mb-8">Update your account password securely.</p>
                </div>

                <div class="py-2 pb-8"> 
                    
                    <form action="{{ route('password.update') }}" method="POST" id="resetForm">
                        @csrf
                        
                        <input type="hidden" name="email" value="{{ session('reset_email') }}">

                        <div class="space-y-5"> 

                          
                            <div>
                                <label class="block text-[10px] font-black uppercase tracking-[0.15em] text-slate-500 dark:text-slate-400 mb-1.5 ml-1" for="username">Username Confirmation</label>
                                <div class="relative group">
                                    <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400">
                                        <span class="material-symbols-outlined text-lg">person</span>
                                    </span>
                                    
                                    <input class="block w-full pl-10 pr-4 py-3 text-sm font-bold border border-slate-200 dark:border-slate-700 rounded-xl bg-slate-100 dark:bg-slate-800 text-slate-500 cursor-not-allowed outline-none" 
                                    id="username" 
                                    name="username" 
                                    value="{{ session('reset_username') }}" 
                                    readonly 
                                    type="text" />
                                </div>
                                <p class="text-[9px] text-slate-400 mt-1.5 ml-1 italic">*Username terdeteksi otomatis dari email Anda.</p>
                                @error('username') <span class="text-red-500 text-[10px] ml-1">{{ $message }}</span> @enderror
                            </div>



                            <div class="grid grid-cols-1 gap-4">
                              
                                <div>
                                    <label class="block text-[10px] font-black uppercase tracking-[0.15em] text-slate-500 dark:text-slate-400 mb-1.5 ml-1" for="password">New Password</label>
                                    <div class="relative">
                                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-300">
                                            <span class="material-symbols-outlined text-lg">lock</span>
                                        </span>
                                        <input class="block w-full pl-10 pr-4 py-3 text-sm font-medium border border-slate-200 dark:border-slate-700 rounded-xl bg-slate-50 dark:bg-slate-800/50 text-slate-900 dark:text-white placeholder-slate-300 focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all outline-none" 
                                        id="password" name="password" placeholder="••••••••" type="password" />
                                    </div>
                                    @error('password') <span class="text-red-500 text-[10px] ml-1">{{ $message }}</span> @enderror
                                </div>

                                
                                <div>
                                    <label class="block text-[10px] font-black uppercase tracking-[0.15em] text-slate-500 dark:text-slate-400 mb-1.5 ml-1" for="password_confirmation">Confirm New Password</label>
                                    <div class="relative">
                                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-300">
                                            <span class="material-symbols-outlined text-lg">lock_reset</span>
                                        </span>
                                        <input class="block w-full pl-10 pr-4 py-3 text-sm font-medium border border-slate-200 dark:border-slate-700 rounded-xl bg-slate-50 dark:bg-slate-800/50 text-slate-900 dark:text-white placeholder-slate-300 focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all outline-none" 
                                        id="password_confirmation" name="password_confirmation" placeholder="••••••••" type="password" />
                                    </div>
                                </div>
                            </div>

                            <div class="pt-2">
                                <button class="w-full bg-slate-900 dark:bg-primary hover:bg-primary dark:hover:bg-blue-700 text-white text-[11px] font-black uppercase tracking-[0.2em] py-4 rounded-xl shadow-xl shadow-slate-200 dark:shadow-blue-500/25 transition-all transform hover:-translate-y-1 active:translate-y-0" type="submit">
                                    Update Password
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="-mt-2 text-center">
                    <p class=" text-slate-400 dark:text-slate-500 text-sm font-medium">
                        Remember your password?
                        <a class="text-primary font-extrabold hover:text-blue-700 transition-colors ml-1 decoration-primary/30 underline decoration-2 underline-offset-4" href="{{ route('login') }}">Back to Login</a>
                    </p>
                </div>
            </div>
        </div>

        <!-- Image Side -->
        <div class="hidden md:block w-1/2 h-full relative form-transition z-10 overflow-hidden" id="image-side">
            <img id="side-image" alt="Library Background" class="absolute inset-0 w-full h-full object-cover transition-opacity duration-500" src="{{ asset('images/dafSis.jpg') }}" />
            <div class="absolute inset-0 bg-gradient-to-br from-blue-900/40 via-transparent to-black/80 flex flex-col justify-end p-12">
                
                <div class="max-w-md bg-white/10 backdrop-blur-xl border border-white/20 p-8 rounded-[2.5rem] shadow-2xl">
                    <h3 class="text-3xl font-extrabold text-white mb-4 leading-[1.1] tracking-tighter">Access Vast Knowledge</h3>
                    <p class="text-blue-50 text-sm font-medium opacity-80 leading-relaxed italic border-l-2 border-primary/50 pl-4">Enjoy thousands of digital and physical collections with a single integrated student account.</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>