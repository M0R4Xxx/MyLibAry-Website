<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>MyLibAry. | Library Registration</title>
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
            .no-scrollbar::-webkit-scrollbar {
                display: none;
            }
            .no-scrollbar {
                -ms-overflow-style: none;
                scrollbar-width: none;
            }
        }

        input:-webkit-autofill,
            input:-webkit-autofill:hover, 
            input:-webkit-autofill:focus {
                transition: background-color 5000s ease-in-out 0s, box-shadow 5000s ease-in-out 0s;
                
                -webkit-text-fill-color: #334155 !important;
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
            const currentRole = "{{ old('role', 'siswa') }}";
            if (currentRole === 'admin') {
                switchRole('admin', true); 
            }
            
            setupValidation();
        });

        function switchRole(role, isInitial = false) {
            const roleInput = document.getElementById('role-input');
            const toggleBg = document.getElementById('toggle-bg');
            const btnStudent = document.getElementById('btn-student');
            const btnAdmin = document.getElementById('btn-admin');
            const welcomeText = document.getElementById('welcome-text');
            const welcomeSub = document.getElementById('welcome-sub');
            const formSide = document.getElementById('form-side');
            const imageSide = document.getElementById('image-side');
            const sideImage = document.getElementById('side-image');
            const imageTitle = document.getElementById('image-title');
            const imageDesc = document.getElementById('image-desc');


            if (isInitial) {
                formSide.style.transition = 'none';
                imageSide.style.transition = 'none';
            } else {
                formSide.style.transition = 'all 0.7s cubic-bezier(0.4, 0, 0.2, 1)';
                imageSide.style.transition = 'all 0.7s cubic-bezier(0.4, 0, 0.2, 1)';
            }

            if (role === 'admin') {
                roleInput.value = 'admin';
                toggleBg.style.transform = 'translateX(100%)';
                btnAdmin.classList.replace('text-slate-600', 'text-white');
                btnStudent.classList.replace('text-white', 'text-slate-600');
                welcomeText.innerText = "Register Admin Account";
                welcomeSub.innerText = "Register a new library management account.";
                imageTitle.innerText = "Manage Digital Efficiency";
                imageDesc.innerText = "Use our management tools to monitor inventory and book circulation in real-time.";
                sideImage.src = "{{ asset('images/dafAdmin.jpg') }}";
                
                if (window.innerWidth >= 768) {
                    formSide.style.transform = 'translateX(100%)';
                    imageSide.style.transform = 'translateX(-100%)';
                }
            } else {
                roleInput.value = 'siswa';
                toggleBg.style.transform = 'translateX(0)';
                btnStudent.classList.replace('text-slate-600', 'text-white');
                btnAdmin.classList.replace('text-white', 'text-slate-600');
                welcomeText.innerText = "Student Registration";
                welcomeSub.innerText = "Join us to borrow your favorite books.";
                imageTitle.innerText = "Access Vast Knowledge";
                imageDesc.innerText = "Enjoy thousands of digital and physical collections with a single integrated student account.";
                sideImage.src = "{{ asset('images/dafSis.jpg') }}";

                if (window.innerWidth >= 768) {
                    formSide.style.transform = 'translateX(0)';
                    imageSide.style.transform = 'translateX(0)';
                }
            }
        }

        function setupValidation() {
    const form = document.getElementById('registerForm');
    const username = document.getElementById('fullname');
    const email = document.getElementById('email');
    const password = document.getElementById('password');

    function validateInput(el) {
        el.setCustomValidity('');

        if (el === username) {
            const val = el.value.trim();
            if (!val) el.setCustomValidity('Username tidak boleh kosong');
            else if (/\s/.test(val)) el.setCustomValidity('Username tidak boleh menggunakan space');
            else if (val.length < 4 || val.length > 14) el.setCustomValidity('Username minimal 4 huruf dan maksimal 14');
        }

        if (el === email) {
            const val = el.value.trim();
            if (!val) el.setCustomValidity('Email tidak boleh kosong');
            else if (/\s/.test(val)) el.setCustomValidity('Email tidak boleh menggunakan space');
            else if (!val.endsWith('@gmail.com')) el.setCustomValidity('Email harus menggunakan tulisan "@gmail.com"');
        }

        if (el === password) {
            const val = el.value.trim();
            if (!val) el.setCustomValidity('Password tidak boleh kosong');
            else if (/\s/.test(val)) el.setCustomValidity('Password tidak boleh menggunakan space');
            else if (val.length < 6 || val.length > 14) el.setCustomValidity('Password minimal 6 huruf dan maksimal 14');
        }
    }

    [username, email, password].forEach(input => {
        input.addEventListener('input', () => {
            input.setCustomValidity(''); 
        });
    });

    form.addEventListener('submit', function(e) {
        validateInput(username);
        validateInput(email);
        validateInput(password);

        if (!form.checkValidity()) {
            e.preventDefault();
            form.reportValidity();
            
            setTimeout(() => {
                [username, email, password].forEach(el => el.setCustomValidity(''));
            }, 5000);
        }
    });

    @if($errors->any())
        @if($errors->has('username'))
            username.setCustomValidity("{{ $errors->first('username') }}");
            username.reportValidity();
        @elseif($errors->has('email'))
            email.setCustomValidity("{{ $errors->first('email') }}");
            email.reportValidity();
        @elseif($errors->has('password'))
            password.setCustomValidity("{{ $errors->first('password') }}");
            password.reportValidity();
        @endif
        
        setTimeout(() => {
            username.setCustomValidity('');
            email.setCustomValidity('');
            password.setCustomValidity('');
        }, 5000);
    @endif
}
</script>
</head>

<body class="bg-slate-100 dark:bg-slate-950 h-screen w-screen flex items-center justify-center p-4 md:p-6 overflow-hidden">
    <div class="relative w-full h-full max-w-6xl max-h-[calc(100vh-3rem)] bg-white dark:bg-slate-900 md:rounded-[2.5rem] shadow-2xl overflow-hidden flex flex-col md:flex-row transition-all duration-500" id="main-card">
        
        <div class="w-full md:w-1/2 h-full p-6 lg:p-10 xl:p-12 flex flex-col form-transition z-20 bg-white dark:bg-slate-900" id="form-side">
            <div class="w-full max-w-md mx-auto my-auto">
                <div class="flex-none">
                    <div class="flex items-center gap-2 mb-4">
                        <span class="material-symbols-outlined text-primary text-3xl font-bold">auto_stories</span>
                        <h1 class="text-2xl font-extrabold tracking-tighter text-slate-900 dark:text-white">My<span class="text-primary italic">LibAry.</span></h1>
                    </div>
                    <h2 class="text-4xl font-extrabold text-slate-900 dark:text-white tracking-tight leading-none" id="welcome-text">Student Registration</h2>
                    <p class="text-slate-400 dark:text-slate-500 text-xs font-bold uppercase tracking-[0.2em] mt-3 mb-6" id="welcome-sub">Join us to borrow your favorite books.</p>
                    
                    <div class="relative bg-slate-100 dark:bg-slate-800 p-1 rounded-xl flex items-center mb-8 w-full max-w-[280px]">
                        <div class="absolute w-[calc(50%-4px)] h-[calc(100%-8px)] bg-primary rounded-lg transition-transform duration-500 ease-out shadow-lg" id="toggle-bg" style="transform: translateX(0);"></div>
                        <button class="relative z-10 w-1/2 py-2 text-[10px] font-black uppercase tracking-widest text-white transition-colors duration-300" id="btn-student" onclick="switchRole('siswa')">Siswa</button>
                        <button class="relative z-10 w-1/2 py-2 text-[10px] font-black uppercase tracking-widest text-slate-600 dark:text-slate-300 transition-colors duration-300" id="btn-admin" onclick="switchRole('admin')">Admin</button>
                    </div>
                </div>

                <div class="py-2 pb-8"> 
                    <form action="{{ route('register') }}" method="POST" id="registerForm">
                        @csrf
                        <input type="hidden" name="role" id="role-input" value="{{ old('role', 'siswa') }}">
                        
                        <div class="space-y-5"> <div class="grid grid-cols-1 gap-4">
                                <div>
                                    <label class="block text-[10px] font-black uppercase tracking-[0.15em] text-slate-500 dark:text-slate-400 mb-1.5 ml-1" for="fullname">Username</label>
                                    <div class="relative">
                                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-300">
                                            <span class="material-symbols-outlined text-lg">badge</span>
                                        </span>
                                        <input class="block w-full pl-10 pr-4 py-3 text-sm font-medium border border-slate-200 dark:border-slate-700 rounded-xl bg-slate-50 dark:bg-slate-800/50 text-slate-900 dark:text-white placeholder-slate-300 focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all outline-none" 
                                        id="fullname" name="username" placeholder="john_doe" type="text" value="{{ old('username') }}" />
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-[10px] font-black uppercase tracking-[0.15em] text-slate-500 dark:text-slate-400 mb-1.5 ml-1" for="email">Email</label>
                                    <div class="relative">
                                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-300">
                                            <span class="material-symbols-outlined text-lg">mail</span>
                                        </span>
                                        <input class="block w-full pl-10 pr-4 py-3 text-sm font-medium border border-slate-200 dark:border-slate-700 rounded-xl bg-slate-50 dark:bg-slate-800/50 text-slate-900 dark:text-white placeholder-slate-300 focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all outline-none" 
                                        id="email" name="email" placeholder="name@email.com" type="email" value="{{ old('email') }}" />
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-[10px] font-black uppercase tracking-[0.15em] text-slate-500 dark:text-slate-400 mb-1.5 ml-1" for="password">Password</label>
                                    <div class="relative">
                                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-300">
                                            <span class="material-symbols-outlined text-lg">lock</span>
                                        </span>
                                        <input class="block w-full pl-10 pr-4 py-3 text-sm font-medium border border-slate-200 dark:border-slate-700 rounded-xl bg-slate-50 dark:bg-slate-800/50 text-slate-900 dark:text-white placeholder-slate-300 focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all outline-none" 
                                        id="password" name="password" placeholder="••••••••" type="password" value="{{ old('password') }}" />
                                    </div>
                                </div>
                            </div>
                            <div class="pt-2">
                                <button class="w-full bg-slate-900 dark:bg-primary hover:bg-primary dark:hover:bg-blue-700 text-white text-[11px] font-black uppercase tracking-[0.2em] py-4 rounded-xl shadow-xl shadow-slate-200 dark:shadow-blue-500/25 transition-all transform hover:-translate-y-1 active:translate-y-0" type="submit" id="btnSubmit">
                                    Register Now
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="-mt-2 text-center">
                    <p class=" text-slate-400 dark:text-slate-500 text-sm font-medium">
                        Already have an account?
                        <a class="text-primary font-extrabold hover:text-blue-700 transition-colors ml-1 decoration-primary/30 underline decoration-2 underline-offset-4" href="{{ route('login') }}">Login here</a>
                    </p>
                </div>
            </div>
        </div>

        <div class="hidden md:block w-1/2 h-full relative form-transition z-10 overflow-hidden" id="image-side">
            <img id="side-image" alt="Library Background" class="absolute inset-0 w-full h-full object-cover transition-opacity duration-500" src="{{ asset('images/dafSis.jpg') }}" />
            <div class="absolute inset-0 bg-gradient-to-br from-blue-900/40 via-transparent to-black/80 flex flex-col justify-end p-12">
                <div class="max-w-md bg-white/10 backdrop-blur-xl border border-white/20 p-8 rounded-[2.5rem] shadow-2xl">
                    <h3 class="text-3xl font-extrabold text-white mb-4 leading-[1.1] tracking-tighter" id="image-title">Access Vast Knowledge</h3>
                    <p class="text-blue-50 text-sm font-medium opacity-80 leading-relaxed italic border-l-2 border-primary/50 pl-4" id="image-desc">Enjoy thousands of digital and physical collections with a single integrated student account.</p>
                </div>
            </div>
    
        </div>
    </div>
</body>
</html>