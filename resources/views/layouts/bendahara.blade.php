<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') - Kasly</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        * { scroll-behavior: smooth; }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            overflow-x: hidden;
        }

        /* Animated Background */
        .bg-gradient-mesh {
            background:
                radial-gradient(at 0% 0%, rgba(59, 130, 246, 0.15) 0px, transparent 50%),
                radial-gradient(at 100% 0%, rgba(147, 197, 253, 0.1) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(96, 165, 250, 0.15) 0px, transparent 50%);
            background-size: 100% 100%;
        }

        .dark .bg-gradient-mesh {
            background:
                radial-gradient(at 0% 0%, rgba(30, 58, 138, 0.4) 0px, transparent 50%),
                radial-gradient(at 100% 0%, rgba(29, 78, 216, 0.3) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(37, 99, 235, 0.4) 0px, transparent 50%);
        }

        /* Glass Card */
        .glass-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.9);
            box-shadow: 0 10px 40px -10px rgba(59, 130, 246, 0.15);
        }

        .dark .glass-card {
            background: rgba(15, 23, 42, 0.8);
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 10px 40px -10px rgba(59, 130, 246, 0.25);
        }

        /* Sidebar */
        .sidebar {
            background: linear-gradient(180deg, #ffffff 0%, #f8fafc 100%);
            border-right: 1px solid #e2e8f0;
        }

        .dark .sidebar {
            background: linear-gradient(180deg, #0f172a 0%, #1e293b 100%);
            border-right: 1px solid #1e293b;
        }

        /* Sidebar Link */
        .sidebar-link {
            transition: all 0.3s ease;
            color: #64748b;
            position: relative;
        }

        .sidebar-link::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 3px;
            background: linear-gradient(180deg, #3B82F6, #60A5FA);
            transform: scaleY(0);
            transition: transform 0.3s ease;
        }

        .sidebar-link:hover::before {
            transform: scaleY(1);
        }

        .sidebar-link:hover {
            background: linear-gradient(90deg, rgba(59, 130, 246, 0.1), transparent);
            color: #2563eb;
        }

        .sidebar-link.active {
            background: linear-gradient(90deg, rgba(59, 130, 246, 0.15), rgba(59, 130, 246, 0.05));
            color: #2563eb;
            font-weight: 600;
        }

        .sidebar-link.active::before {
            transform: scaleY(1);
        }

        .dark .sidebar-link {
            color: #94a3b8;
        }

        .dark .sidebar-link:hover {
            background: linear-gradient(90deg, rgba(59, 130, 246, 0.2), transparent);
            color: #60a5fa;
        }

        .dark .sidebar-link.active {
            background: linear-gradient(90deg, rgba(59, 130, 246, 0.3), rgba(59, 130, 246, 0.1));
            color: #60a5fa;
        }

        /* Theme Toggle */
        .theme-toggle {
            position: relative;
            width: 52px;
            height: 26px;
            background: linear-gradient(135deg, #e0f2fe, #bae6fd);
            border-radius: 26px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .theme-toggle:hover {
            background: linear-gradient(135deg, #bae6fd, #7dd3fc);
        }

        .theme-toggle-ball {
            position: absolute;
            top: 3px;
            left: 3px;
            width: 20px;
            height: 20px;
            background: white;
            border-radius: 50%;
            transition: transform 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 8px rgba(59, 130, 246, 0.3);
        }

        .dark .theme-toggle {
            background: linear-gradient(135deg, #1e3a8a, #1e40af);
        }

        .dark .theme-toggle:hover {
            background: linear-gradient(135deg, #1e40af, #3b82f6);
        }

        .dark .theme-toggle-ball {
            transform: translateX(26px);
            background: #0f172a;
        }

        /* Button */
        .btn-primary {
            background: linear-gradient(135deg, #2563EB 0%, #3B82F6 100%);
            color: white;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.4);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(37, 99, 235, 0.5);
        }

        /* Scrollbar */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #f1f5f9; }
        .dark ::-webkit-scrollbar-track { background: #1e293b; }
        ::-webkit-scrollbar-thumb {
            background: linear-gradient(180deg, #3B82F6, #60A5FA);
            border-radius: 10px;
        }

        /* Mobile Sidebar */
        .mobile-sidebar {
            transform: translateX(-100%);
            transition: transform 0.3s ease;
        }
        .mobile-sidebar.open {
            transform: translateX(0);
        }

        .overlay {
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s ease;
        }
        .overlay.active {
            opacity: 1;
            pointer-events: auto;
        }

        /* Delete Modal Animation */
        #deleteModal {
            transition: opacity 0.3s ease;
        }
        #deleteModal.hidden {
            opacity: 0;
            pointer-events: none;
        }
        #deleteModal:not(.hidden) {
            opacity: 1;
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-900 antialiased dark:bg-slate-950 dark:text-slate-100">

    <!-- Animated Background -->
    <div class="fixed inset-0 bg-gradient-mesh z-0 pointer-events-none"></div>

    <!-- Overlay -->
    <div class="overlay fixed inset-0 bg-black/30 backdrop-blur-sm z-40 lg:hidden" id="overlay"></div>

    <div class="relative z-10 flex min-h-screen">

        <!-- SIDEBAR Desktop -->
        <aside class="sidebar fixed lg:sticky top-0 left-0 h-screen w-64 hidden lg:flex flex-col">
            <!-- Logo -->
            <div class="p-6 border-b border-slate-200 dark:border-slate-800">
                <a href="{{ route('dashboard.bendahara') }}" class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center shadow-lg shadow-blue-500/30">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold bg-gradient-to-r from-blue-600 to-blue-400 bg-clip-text text-transparent">Kasly</h1>
                        <p class="text-xs text-slate-500 dark:text-slate-400">Dashboard Bendahara</p>
                    </div>
                </a>
            </div>

            <!-- Menu -->
            <nav class="flex-1 p-4 space-y-1 overflow-y-auto">
                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-3 px-3">Menu Utama</p>

                <a href="{{ route('dashboard.bendahara') }}" class="sidebar-link {{ request()->routeIs('dashboard.bendahara') ? 'active' : '' }} flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    Dashboard
                </a>

                <a href="{{ route('siswa.index') }}" class="sidebar-link {{ request()->routeIs('siswa.*') ? 'active' : '' }} flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    Data Siswa
                </a>

                <!-- ✅ ICON PEMASUKAN: TRENDING UP (Grafik Naik) -->
                <a href="{{ route('pembayaran.index') }}" class="sidebar-link {{ request()->routeIs('pembayaran.*') ? 'active' : '' }} flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                    </svg>
                    Pemasukan
                </a>

                <!-- ✅ ICON PENGELUARAN: TRENDING DOWN (Grafik Turun) -->
                <a href="{{ route('pengeluaran.index') }}" class="sidebar-link {{ request()->routeIs('pengeluaran.*') ? 'active' : '' }} flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"></path>
                    </svg>
                    Pengeluaran
                </a>

                <a href="{{ route('pengumuman.index') }}" class="sidebar-link {{ request()->routeIs('pengumuman.*') ? 'active' : '' }} flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path>
                    </svg>
                    Pengumuman
                </a>

                <a href="{{ route('laporan.index') }}" class="sidebar-link {{ request()->routeIs('laporan.*') ? 'active' : '' }} flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Laporan
                </a>

                <a href="{{ route('rekap.index') }}" class="sidebar-link {{ request()->routeIs('rekap.*') ? 'active' : '' }} flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    Rekap Bulanan
                </a>

                <a href="{{ route('aktivitas.index') }}" class="sidebar-link {{ request()->routeIs('aktivitas.*') ? 'active' : '' }} flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                    Aktivitas
                </a>

                <div class="pt-4 mt-4 border-t border-slate-200 dark:border-slate-800">
                    <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-3 px-3">Akun</p>

                    <a href="{{ route('settings.index') }}" class="sidebar-link {{ request()->routeIs('settings.*') ? 'active' : '' }} flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        Pengaturan
                    </a>

                    <form action="{{ route('logout') }}" method="POST" class="mt-1">
                        @csrf
                        <button type="submit" class="sidebar-link w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm text-rose-600 dark:text-rose-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                            Logout
                        </button>
                    </form>
                </div>
            </nav>

            <!-- User Info -->
            <div class="p-4 border-t border-slate-200 dark:border-slate-800">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center text-white font-bold shadow-lg shadow-blue-500/30">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold truncate">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-slate-500 dark:text-slate-400 truncate">{{ Auth::user()->email }}</p>
                    </div>
                </div>
            </div>
        </aside>

        <!-- MOBILE SIDEBAR -->
        <aside class="mobile-sidebar fixed top-0 left-0 h-screen w-64 flex-shrink-0 flex flex-col z-50 lg:hidden sidebar">
            <div class="p-6 border-b border-slate-200 dark:border-slate-800 flex justify-between items-center">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center shadow-lg shadow-blue-500/30">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h1 class="text-xl font-bold bg-gradient-to-r from-blue-600 to-blue-400 bg-clip-text text-transparent">Kasly</h1>
                </div>
                <button id="closeSidebar" class="text-slate-500">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <nav class="flex-1 p-4 space-y-1 overflow-y-auto">
                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-3 px-3">Menu Utama</p>

                <a href="{{ route('dashboard.bendahara') }}" class="sidebar-link {{ request()->routeIs('dashboard.bendahara') ? 'active' : '' }} flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm">Dashboard</a>
                <a href="{{ route('siswa.index') }}" class="sidebar-link {{ request()->routeIs('siswa.*') ? 'active' : '' }} flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm">Data Siswa</a>
                <a href="{{ route('pembayaran.index') }}" class="sidebar-link {{ request()->routeIs('pembayaran.*') ? 'active' : '' }} flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm">Pemasukan</a>
                <a href="{{ route('pengeluaran.index') }}" class="sidebar-link {{ request()->routeIs('pengeluaran.*') ? 'active' : '' }} flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm">Pengeluaran</a>
                <a href="{{ route('pengumuman.index') }}" class="sidebar-link {{ request()->routeIs('pengumuman.*') ? 'active' : '' }} flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm">Pengumuman</a>
                <a href="{{ route('laporan.index') }}" class="sidebar-link {{ request()->routeIs('laporan.*') ? 'active' : '' }} flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm">Laporan</a>
                <a href="{{ route('rekap.index') }}" class="sidebar-link {{ request()->routeIs('rekap.*') ? 'active' : '' }} flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm">Rekap Bulanan</a>
                <a href="{{ route('aktivitas.index') }}" class="sidebar-link {{ request()->routeIs('aktivitas.*') ? 'active' : '' }} flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm">Aktivitas</a>

                <div class="pt-4 mt-4 border-t border-slate-200 dark:border-slate-800">
                    <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-3 px-3">Akun</p>
                    <a href="{{ route('settings.index') }}" class="sidebar-link {{ request()->routeIs('settings.*') ? 'active' : '' }} flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm">Pengaturan</a>
                    <form action="{{ route('logout') }}" method="POST" class="mt-1">
                        @csrf
                        <button type="submit" class="sidebar-link w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm text-rose-600">Logout</button>
                    </form>
                </div>
            </nav>
        </aside>

        <!-- MAIN CONTENT -->
        <div class="flex-1 flex flex-col min-h-screen">
            <!-- Topbar -->
            <header class="sticky top-0 z-20 bg-white/80 dark:bg-slate-950/80 backdrop-blur-lg border-b border-slate-200 dark:border-slate-800">
                <div class="flex items-center justify-between px-4 lg:px-8 py-4">
                    <button id="openSidebar" class="lg:hidden text-slate-600 dark:text-slate-300">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>

                    <div class="flex-1 lg:flex-none">
                        <h2 class="text-xl font-bold bg-gradient-to-r from-blue-600 to-blue-400 bg-clip-text text-transparent">
                            @yield('page_title', 'Dashboard')
                        </h2>
                        <p class="text-sm text-slate-500 dark:text-slate-400">
                            @yield('page_subtitle', 'Selamat datang kembali, ' . Auth::user()->name . ' ')
                        </p>
                    </div>

                    <div class="flex items-center gap-3">
                        <button id="themeToggle" class="theme-toggle">
                            <div class="theme-toggle-ball">
                                <svg class="w-3.5 h-3.5 text-yellow-500 dark:hidden" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" clip-rule="evenodd"></path>
                                </svg>
                                <svg class="w-3.5 h-3.5 text-blue-400 hidden dark:block" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                                </svg>
                            </div>
                        </button>

                        <div class="lg:hidden w-9 h-9 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center text-white font-bold shadow-lg shadow-blue-500/30">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                    </div>
                </div>
            </header>

            <!-- Content -->
            <main class="flex-1 p-4 lg:p-8">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- ============================================ -->
    <!-- GLOBAL DELETE MODAL (BERLAKU UNTUK SEMUA HALAMAN) -->
    <!-- ============================================ -->
    <div id="deleteModal" class="fixed inset-0 z-[100] hidden">
        <!-- Overlay -->
        <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="closeDeleteModal()"></div>

        <!-- Modal Content -->
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full max-w-md px-4">
            <div class="glass-card rounded-2xl p-6 border border-white/20 dark:border-white/10 shadow-2xl">
                <!-- Icon -->
                <div class="flex justify-center mb-4">
                    <div class="w-16 h-16 bg-gradient-to-br from-rose-500 to-rose-600 rounded-full flex items-center justify-center shadow-lg shadow-rose-500/30">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                    </div>
                </div>

                <!-- Text -->
                <h3 class="text-lg font-bold text-center text-slate-900 dark:text-white mb-2">
                    Hapus Data?
                </h3>
                <p class="text-sm text-center text-slate-600 dark:text-slate-400 mb-6">
                    Yakin ingin menghapus data ini? Tindakan ini tidak dapat dibatalkan.
                </p>

                <!-- Buttons -->
                <div class="flex gap-3">
                    <button onclick="closeDeleteModal()"
                            class="flex-1 px-4 py-2.5 bg-slate-200 dark:bg-slate-700 hover:bg-slate-300 dark:hover:bg-slate-600 text-slate-700 dark:text-slate-300 text-sm font-semibold rounded-xl transition-all">
                        Batal
                    </button>
                    <form id="deleteForm" method="POST" class="flex-1">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="w-full px-4 py-2.5 bg-gradient-to-r from-rose-600 to-rose-500 hover:from-rose-700 hover:to-rose-600 text-white text-sm font-semibold rounded-xl shadow-lg shadow-rose-500/30 transition-all">
                            Ya, Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        // Theme Toggle
        const themeToggle = document.getElementById('themeToggle');
        const html = document.documentElement;
        const currentTheme = localStorage.getItem('theme') || 'light';

        if (currentTheme === 'dark') {
            html.classList.add('dark');
        }

        themeToggle.addEventListener('click', () => {
            html.classList.toggle('dark');
            localStorage.setItem('theme', html.classList.contains('dark') ? 'dark' : 'light');
        });

        // Mobile Sidebar
        const openSidebar = document.getElementById('openSidebar');
        const closeSidebar = document.getElementById('closeSidebar');
        const mobileSidebar = document.querySelector('.mobile-sidebar');
        const overlay = document.getElementById('overlay');

        if (openSidebar) {
            openSidebar.addEventListener('click', () => {
                mobileSidebar.classList.add('open');
                overlay.classList.add('active');
                document.body.style.overflow = 'hidden';
            });
        }

        if (closeSidebar) {
            closeSidebar.addEventListener('click', () => {
                mobileSidebar.classList.remove('open');
                overlay.classList.remove('active');
                document.body.style.overflow = '';
            });
        }

        if (overlay) {
            overlay.addEventListener('click', () => {
                mobileSidebar.classList.remove('open');
                overlay.classList.remove('active');
                document.body.style.overflow = '';
            });
        }

        // ============================================
        // GLOBAL DELETE MODAL FUNCTIONS
        // ============================================
        function showDeleteModal(url) {
            const modal = document.getElementById('deleteModal');
            const form = document.getElementById('deleteForm');
            form.action = url;
            modal.classList.remove('hidden');
        }

        function closeDeleteModal() {
            const modal = document.getElementById('deleteModal');
            modal.classList.add('hidden');
        }

        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeDeleteModal();
            }
        });
    </script>
</body>
</html>
