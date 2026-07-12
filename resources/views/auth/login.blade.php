<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Kasly</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        * { scroll-behavior: smooth; }
        body {
            font-family: 'Plus Jakarta Sans', 'Inter', sans-serif;
            overflow-x: hidden;
        }

        .bg-gradient-mesh {
            background:
                radial-gradient(at 0% 0%, rgba(59, 130, 246, 0.1) 0px, transparent 50%),
                radial-gradient(at 100% 0%, rgba(147, 197, 253, 0.15) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(96, 165, 250, 0.1) 0px, transparent 50%),
                radial-gradient(at 0% 100%, rgba(191, 219, 254, 0.15) 0px, transparent 50%);
            background-size: 200% 200%;
            animation: gradient 15s ease infinite;
        }

        .dark .bg-gradient-mesh {
            background:
                radial-gradient(at 0% 0%, rgba(30, 58, 138, 0.3) 0px, transparent 50%),
                radial-gradient(at 100% 0%, rgba(29, 78, 216, 0.25) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(37, 99, 235, 0.2) 0px, transparent 50%),
                radial-gradient(at 0% 100%, rgba(59, 130, 246, 0.3) 0px, transparent 50%);
        }

        @keyframes gradient {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }

        .floating-shape {
            position: fixed;
            border-radius: 50%;
            filter: blur(80px);
            z-index: 0;
            pointer-events: none;
        }

        .floating-shape-1 { background: rgba(59, 130, 246, 0.15); animation: float 8s ease-in-out infinite; }
        .floating-shape-2 { background: rgba(147, 197, 253, 0.15); animation: float 10s ease-in-out infinite 2s; }
        .floating-shape-3 { background: rgba(96, 165, 250, 0.1); animation: float 12s ease-in-out infinite 4s; }
        .dark .floating-shape-1 { background: rgba(59, 130, 246, 0.25); }
        .dark .floating-shape-2 { background: rgba(147, 197, 253, 0.2); }
        .dark .floating-shape-3 { background: rgba(96, 165, 250, 0.15); }

        @keyframes float {
            0%, 100% { transform: translate(0, 0); }
            50% { transform: translate(30px, -30px); }
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.85) !important;
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.9);
            box-shadow: 0 10px 40px -10px rgba(0, 0, 0, 0.08), 0 4px 12px -4px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .dark .glass-card {
            background: rgba(15, 23, 42, 0.7) !important;
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 20px 60px -15px rgba(0, 0, 0, 0.5), 0 10px 30px -10px rgba(0, 0, 0, 0.4);
        }

        .text-gradient {
            background: linear-gradient(135deg, #2563EB 0%, #3B82F6 50%, #60A5FA 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .dark .text-gradient {
            background: linear-gradient(135deg, #60A5FA 0%, #3B82F6 50%, #2563EB 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .btn-primary {
            background: linear-gradient(135deg, #2563EB 0%, #3B82F6 100%);
            box-shadow: 0 10px 30px -5px rgba(37, 99, 235, 0.4), 0 4px 10px -2px rgba(37, 99, 235, 0.2);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.5s ease;
        }

        .btn-primary:hover::before { left: 100%; }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 40px -5px rgba(37, 99, 235, 0.5), 0 8px 15px -3px rgba(37, 99, 235, 0.3);
        }

        .theme-toggle {
            position: relative;
            width: 56px;
            height: 28px;
            background: #E2E8F0;
            border-radius: 28px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .theme-toggle:hover { background: #CBD5E1; }
        .theme-toggle-ball {
            position: absolute;
            top: 2px;
            left: 2px;
            width: 24px;
            height: 24px;
            background: white;
            border-radius: 50%;
            transition: transform 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .dark .theme-toggle { background: #334155; }
        .dark .theme-toggle:hover { background: #475569; }
        .dark .theme-toggle-ball { transform: translateX(28px); background: #1E293B; }

        input:focus {
            outline: none;
            border-color: #3B82F6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .password-toggle {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #94a3b8;
            transition: color 0.3s ease;
            background: none;
            border: none;
            padding: 0;
        }

        .password-toggle:hover {
            color: #3B82F6;
        }

        ::-webkit-scrollbar { width: 12px; }
        ::-webkit-scrollbar-track { background: rgba(241, 245, 249, 0.5); border-radius: 10px; }
        .dark ::-webkit-scrollbar-track { background: rgba(30, 41, 59, 0.5); }
        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #3B82F6, #60A5FA);
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(59, 130, 246, 0.3);
        }
        .dark ::-webkit-scrollbar-thumb { background: linear-gradient(135deg, #60A5FA, #3B82F6); }
        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, #2563EB, #3B82F6);
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.5);
        }

        .entrance-scale { animation: entranceScale 0.6s ease-out forwards; }
        @keyframes entranceScale {
            from { opacity: 0; transform: scale(0.9); }
            to { opacity: 1; transform: scale(1); }
        }

        .login-tab {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            cursor: pointer;
        }

        .login-tab.active {
            background: linear-gradient(135deg, #2563EB 0%, #3B82F6 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(37, 99, 235, 0.4);
            transform: scale(1.02);
        }

        .login-tab:not(.active) {
            background: rgba(255, 255, 255, 0.5);
            color: #64748b;
            transform: scale(1);
        }

        .dark .login-tab:not(.active) {
            background: rgba(15, 23, 42, 0.5);
            color: #94a3b8;
        }

        .login-tab:not(.active):hover {
            background: rgba(255, 255, 255, 0.8);
            transform: scale(1.02);
        }

        .dark .login-tab:not(.active):hover {
            background: rgba(15, 23, 42, 0.8);
        }

        .login-form {
            opacity: 0;
            transform: translateY(15px);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: absolute;
            width: 100%;
            top: 0;
            left: 0;
            pointer-events: none;
            visibility: hidden;
        }

        .login-form.active {
            opacity: 1;
            transform: translateY(0);
            position: relative;
            pointer-events: auto;
            visibility: visible;
        }

        .form-wrapper {
            position: relative;
            min-height: 180px;
            transition: min-height 0.4s ease;
        }

        .login-form.active .input-group {
            animation: inputSlideIn 0.5s cubic-bezier(0.4, 0, 0.2, 1) forwards;
            opacity: 0;
        }

        .login-form.active .input-group:nth-child(1) { animation-delay: 0.1s; }
        .login-form.active .input-group:nth-child(2) { animation-delay: 0.2s; }

        @keyframes inputSlideIn {
            from {
                opacity: 0;
                transform: translateX(-15px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .login-form.active .input-icon {
            animation: iconBounce 0.6s cubic-bezier(0.4, 0, 0.2, 1) forwards;
            opacity: 0;
        }

        .login-form.active .input-group:nth-child(1) .input-icon { animation-delay: 0.15s; }
        .login-form.active .input-group:nth-child(2) .input-icon { animation-delay: 0.25s; }

        @keyframes iconBounce {
            0% {
                opacity: 0;
                transform: scale(0.5);
            }
            50% {
                transform: scale(1.2);
            }
            100% {
                opacity: 1;
                transform: scale(1);
            }
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-900 antialiased dark:bg-slate-950 dark:text-slate-100 transition-colors duration-300">

    <div class="fixed inset-0 bg-gradient-mesh z-0 pointer-events-none"></div>

    <div class="floating-shape floating-shape-1 top-20 left-10 w-72 h-72"></div>
    <div class="floating-shape floating-shape-2 bottom-20 right-10 w-96 h-96"></div>
    <div class="floating-shape floating-shape-3 top-1/2 left-1/2 w-80 h-80"></div>

    <div class="fixed top-6 right-6 z-50">
        <button id="themeToggle" class="theme-toggle" aria-label="Toggle Dark Mode">
            <div class="theme-toggle-ball">
                <svg class="w-3.5 h-3.5 text-yellow-500 dark:hidden" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" clip-rule="evenodd"></path>
                </svg>
                <svg class="w-3.5 h-3.5 text-blue-400 hidden dark:block" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                </svg>
            </div>
        </button>
    </div>

    <div class="relative z-10 min-h-screen flex items-center justify-center px-6 py-12">
        <div class="w-full max-w-md entrance-scale">

            <a href="{{ route('landing') }}" class="inline-flex items-center gap-2 text-sm font-medium text-slate-600 dark:text-slate-400 hover:text-blue-600 dark:hover:text-blue-400 transition-colors mb-8">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali ke Beranda
            </a>

            <div class="glass-card rounded-3xl p-8 md:p-10">

                <div class="text-center mb-6">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg shadow-blue-500/30">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h1 class="text-3xl font-extrabold text-slate-900 dark:text-white mb-2">Selamat Datang</h1>
                    <p class="text-slate-600 dark:text-slate-400">Login untuk mengelola kas kelas</p>
                </div>

                <div class="flex gap-2 p-1 bg-slate-100 dark:bg-slate-800 rounded-xl mb-6">
                    <button type="button"
                            class="login-tab active flex-1 py-2.5 rounded-lg text-sm font-semibold flex items-center justify-center gap-2"
                            id="tabBendahara">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        Bendahara
                    </button>
                    <button type="button"
                            class="login-tab flex-1 py-2.5 rounded-lg text-sm font-semibold flex items-center justify-center gap-2"
                            id="tabSiswa">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                        Siswa
                    </button>
                </div>

                @if ($errors->any())
                    <div class="mb-6 p-4 rounded-xl bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800">
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-red-600 dark:text-red-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div class="flex-1">
                                <p class="text-sm font-semibold text-red-800 dark:text-red-200 mb-1">Login Gagal</p>
                                <ul class="text-sm text-red-700 dark:text-red-300 space-y-1">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                <form action="{{ route('login') }}" method="POST" class="space-y-5">
                    @csrf
                    <input type="hidden" name="login_type" id="loginType" value="bendahara">

                    <div class="form-wrapper">

                        <!-- BENDAHARA FORM -->
                        <div id="formBendahara" class="login-form active">
                            <div class="input-group mb-4">
                                <label for="email" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Email</label>
                                <div class="relative">
                                    <div class="input-icon absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                    <input type="email"
                                           name="email"
                                           id="email"
                                           value="{{ old('email') }}"
                                           class="w-full pl-12 pr-4 py-3 rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-800 text-slate-900 dark:text-white transition-all"
                                           placeholder="nama@email.com">
                                </div>
                            </div>

                            <div class="input-group">
                                <label for="password_bendahara" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Password</label>
                                <div class="relative">
                                    <div class="input-icon absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                        </svg>
                                    </div>
                                    <input type="password"
                                           name="password_bendahara"
                                           id="password_bendahara"
                                           class="w-full pl-12 pr-12 py-3 rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-800 text-slate-900 dark:text-white transition-all"
                                           placeholder="••••••••">
                                    <button type="button"
                                            class="password-toggle"
                                            onclick="togglePassword('password_bendahara', this)">
                                        <svg class="w-5 h-5 eye-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- SISWA FORM -->
                        <div id="formSiswa" class="login-form">
                            <div class="input-group mb-4">
                                <label for="nis" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">NIS</label>
                                <div class="relative">
                                    <div class="input-icon absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"></path>
                                        </svg>
                                    </div>
                                    <input type="text"
                                           name="nis"
                                           id="nis"
                                           value="{{ old('nis') }}"
                                           class="w-full pl-12 pr-4 py-3 rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-800 text-slate-900 dark:text-white transition-all"
                                           placeholder="Masukkan NIS">
                                </div>
                            </div>

                            <div class="input-group">
                                <label for="password_siswa" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Password</label>
                                <div class="relative">
                                    <div class="input-icon absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                        </svg>
                                    </div>
                                    <input type="password"
                                           name="password_siswa"
                                           id="password_siswa"
                                           class="w-full pl-12 pr-12 py-3 rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-800 text-slate-900 dark:text-white transition-all"
                                           placeholder="••••••••">
                                    <button type="button"
                                            class="password-toggle"
                                            onclick="togglePassword('password_siswa', this)">
                                        <svg class="w-5 h-5 eye-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox"
                               name="remember"
                               id="remember"
                               class="w-4 h-4 text-blue-600 border-slate-300 dark:border-slate-600 rounded focus:ring-blue-500">
                        <label for="remember" class="ml-2 text-sm text-slate-600 dark:text-slate-400">Ingat saya</label>
                    </div>

                    <button type="submit"
                            class="w-full btn-primary px-6 py-3.5 rounded-xl font-bold text-white flex items-center justify-center gap-2">
                        Masuk
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </button>
                </form>

                <div class="mt-6 p-4 rounded-xl bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800">
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-blue-600 dark:text-blue-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div class="flex-1">
                            <p class="text-xs font-semibold text-blue-800 dark:text-blue-200 mb-1">Informasi Login</p>
                            <ul class="text-xs text-blue-700 dark:text-blue-300 space-y-1">
                                <li><strong>Bendahara:</strong> Login dengan email & password</li>
                                <li><strong>Siswa:</strong> Login dengan NIS & password</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <p class="text-center text-sm text-slate-500 dark:text-slate-400 mt-6">
                © 2026 Kasly. Sistem Manajemen Kas Kelas Modern.
            </p>
        </div>
    </div>

    <script>
        const themeToggle = document.getElementById('themeToggle');
        const html = document.documentElement;
        const currentTheme = localStorage.getItem('theme') || 'light';

        if (currentTheme === 'dark') {
            html.classList.add('dark');
        } else {
            html.classList.remove('dark');
        }

        themeToggle.addEventListener('click', () => {
            html.classList.toggle('dark');
            const theme = html.classList.contains('dark') ? 'dark' : 'light';
            localStorage.setItem('theme', theme);
        });

        function togglePassword(inputId, button) {
            const input = document.getElementById(inputId);
            const icon = button.querySelector('.eye-icon');

            if (input.type === 'password') {
                input.type = 'text';
                icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>';
            } else {
                input.type = 'password';
                icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>';
            }
        }

        const tabBendahara = document.getElementById('tabBendahara');
        const tabSiswa = document.getElementById('tabSiswa');
        const formBendahara = document.getElementById('formBendahara');
        const formSiswa = document.getElementById('formSiswa');
        const loginType = document.getElementById('loginType');

        function switchTab(activeTab, inactiveTab, activeForm, inactiveForm, type) {
            activeTab.classList.add('active');
            inactiveTab.classList.remove('active');
            inactiveForm.classList.remove('active');
            setTimeout(() => {
                activeForm.classList.add('active');
            }, 50);
            loginType.value = type;
        }

        tabBendahara.addEventListener('click', () => {
            switchTab(tabBendahara, tabSiswa, formBendahara, formSiswa, 'bendahara');
        });

        tabSiswa.addEventListener('click', () => {
            switchTab(tabSiswa, tabBendahara, formSiswa, formBendahara, 'siswa');
        });
    </script>

</body>
</html>
