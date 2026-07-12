<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kasly - Sistem Manajemen Kas Kelas Modern</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'Inter', 'sans-serif'],
                    },
                    colors: {
                        primary: {
                            50: '#EFF6FF',
                            100: '#DBEAFE',
                            200: '#BFDBFE',
                            300: '#93C5FD',
                            400: '#60A5FA',
                            500: '#3B82F6',
                            600: '#2563EB',
                            700: '#1D4ED8',
                        }
                    },
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                        'float-delayed': 'float 6s ease-in-out 2s infinite',
                        'pulse-slow': 'pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                        'bounce-slow': 'bounce 3s infinite',
                        'spin-slow': 'spin 8s linear infinite',
                        'fade-in-up': 'fadeInUp 0.8s ease-out forwards',
                        'slide-in-left': 'slideInLeft 0.8s ease-out forwards',
                        'slide-in-right': 'slideInRight 0.8s ease-out forwards',
                        'scale-in': 'scaleIn 0.6s ease-out forwards',
                        'gradient': 'gradient 8s ease infinite',
                        'entrance-fade': 'entranceFade 0.8s ease-out forwards',
                        'entrance-slide-up': 'entranceSlideUp 0.8s ease-out forwards',
                        'entrance-scale': 'entranceScale 0.6s ease-out forwards',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0px)' },
                            '50%': { transform: 'translateY(-20px)' },
                        },
                        fadeInUp: {
                            '0%': { opacity: '0', transform: 'translateY(30px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        },
                        slideInLeft: {
                            '0%': { opacity: '0', transform: 'translateX(-50px)' },
                            '100%': { opacity: '1', transform: 'translateX(0)' },
                        },
                        slideInRight: {
                            '0%': { opacity: '0', transform: 'translateX(50px)' },
                            '100%': { opacity: '1', transform: 'translateX(0)' },
                        },
                        scaleIn: {
                            '0%': { opacity: '0', transform: 'scale(0.8)' },
                            '100%': { opacity: '1', transform: 'scale(1)' },
                        },
                        gradient: {
                            '0%, 100%': { backgroundPosition: '0% 50%' },
                            '50%': { backgroundPosition: '100% 50%' },
                        },
                        entranceFade: {
                            '0%': { opacity: '0' },
                            '100%': { opacity: '1' },
                        },
                        entranceSlideUp: {
                            '0%': { opacity: '0', transform: 'translateY(40px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        },
                        entranceScale: {
                            '0%': { opacity: '0', transform: 'scale(0.9)' },
                            '100%': { opacity: '1', transform: 'scale(1)' },
                        }
                    }
                }
            }
        }
    </script>
    <style>
        * {
            scroll-behavior: smooth;
        }

        html {
            scroll-padding-top: 80px;
        }

        body {
            font-family: 'Plus Jakarta Sans', 'Inter', sans-serif;
            overflow-x: hidden;
        }

        /* ============================================ */
        /* SMOOTH SCROLLBAR - FIREFOX + WEBKIT */
        /* ============================================ */
        html {
            scrollbar-width: thin;
            scrollbar-color: #3B82F6 rgba(241, 245, 249, 0.5);
        }

        .dark html,
        html.dark {
            scrollbar-color: #60A5FA rgba(30, 41, 59, 0.5);
        }

        ::-webkit-scrollbar {
            width: 10px;
        }

        ::-webkit-scrollbar-track {
            background: #F1F5F9;
        }

        .dark ::-webkit-scrollbar-track {
            background: #1E293B;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(180deg, #60A5FA 0%, #3B82F6 50%, #2563EB 100%);
            border-radius: 10px;
            border: 2px solid #F1F5F9;
            transition: all 0.3s ease;
        }

        .dark ::-webkit-scrollbar-thumb {
            background: linear-gradient(180deg, #93C5FD 0%, #60A5FA 50%, #3B82F6 100%);
            border: 2px solid #1E293B;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(180deg, #3B82F6 0%, #2563EB 50%, #1D4ED8 100%);
            box-shadow: 0 0 10px rgba(59, 130, 246, 0.4);
        }

        .dark ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(180deg, #60A5FA 0%, #3B82F6 50%, #2563EB 100%);
            box-shadow: 0 0 10px rgba(96, 165, 250, 0.5);
        }

        ::-webkit-scrollbar-thumb:active {
            background: linear-gradient(180deg, #2563EB 0%, #1D4ED8 100%);
        }

        /* Animated Background */
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

        /* ============================================ */
        /* GLASS CARD - HOVER SMOOTH & SLOW */
        /* ============================================ */
        .glass-card {
            background: rgba(255, 255, 255, 0.85) !important;
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.9);
            box-shadow:
                0 10px 40px -10px rgba(0, 0, 0, 0.08),
                0 4px 12px -4px rgba(0, 0, 0, 0.05);
            /* TRANSITION LEBIH LAMBAT & SMOOTH */
            transition: transform 0.7s cubic-bezier(0.23, 1, 0.32, 1),
                        box-shadow 0.7s cubic-bezier(0.23, 1, 0.32, 1),
                        border-color 0.7s cubic-bezier(0.23, 1, 0.32, 1);
            will-change: transform, box-shadow;
            position: relative;
        }

        .dark .glass-card {
            background: rgba(15, 23, 42, 0.7) !important;
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow:
                0 20px 60px -15px rgba(0, 0, 0, 0.5),
                0 10px 30px -10px rgba(0, 0, 0, 0.4);
        }

        /* CARD HOVER - SMOOTH SLOW ZOOM */
        .glass-card:hover {
            transform: translateY(-10px) scale(1.02) !important;
            box-shadow:
                0 30px 60px -12px rgba(59, 130, 246, 0.25),
                0 18px 36px -18px rgba(59, 130, 246, 0.15),
                0 0 40px -10px rgba(59, 130, 246, 0.15) !important;
            border-color: rgba(59, 130, 246, 0.5) !important;
        }

        .dark .glass-card:hover {
            transform: translateY(-10px) scale(1.02) !important;
            box-shadow:
                0 30px 60px -12px rgba(59, 130, 246, 0.25),
                0 18px 36px -18px rgba(59, 130, 246, 0.15),
                0 0 40px -10px rgba(59, 130, 246, 0.15) !important;
            border-color: rgba(59, 130, 246, 0.5) !important;
        }

        /* ============================================ */
        /* CTA CARD - EXTRA SMOOTH HOVER */
        /* ============================================ */
        .cta-card {
            /* Transition lebih pelan khusus CTA */
            transition: transform 0.9s cubic-bezier(0.19, 1, 0.22, 1),
                        box-shadow 0.9s cubic-bezier(0.19, 1, 0.22, 1),
                        border-color 0.9s cubic-bezier(0.19, 1, 0.22, 1) !important;
        }

        .cta-card:hover {
            transform: translateY(-12px) scale(1.015) !important;
        }

        /* ICON HOVER */
        .glass-card:hover .icon-container {
            transform: scale(1.1);
            box-shadow: 0 10px 30px -5px rgba(59, 130, 246, 0.4);
        }

        .glass-card:hover .step-circle,
        .glass-card:hover .w-16.h-16.rounded-full {
            transform: scale(1.1);
            box-shadow: 0 10px 30px -5px rgba(59, 130, 246, 0.4);
        }

        .icon-container,
        .step-circle,
        .w-16.h-16.rounded-full {
            transition: all 0.7s cubic-bezier(0.23, 1, 0.32, 1);
        }

        /* Gradient Text */
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

        /* Button */
        .btn-primary {
            background: linear-gradient(135deg, #2563EB 0%, #3B82F6 100%);
            box-shadow:
                0 10px 30px -5px rgba(37, 99, 235, 0.4),
                0 4px 10px -2px rgba(37, 99, 235, 0.2);
            transition: all 0.4s cubic-bezier(0.23, 1, 0.32, 1);
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
            transition: left 0.6s ease;
        }

        .btn-primary:hover::before {
            left: 100%;
        }

        .btn-primary:hover {
            transform: translateY(-3px) scale(1.03);
            box-shadow:
                0 15px 40px -5px rgba(37, 99, 235, 0.5),
                0 8px 15px -3px rgba(37, 99, 235, 0.3);
        }

        /* Theme Toggle */
        .theme-toggle {
            position: relative;
            width: 56px;
            height: 28px;
            background: #E2E8F0;
            border-radius: 28px;
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.23, 1, 0.32, 1);
        }

        .theme-toggle:hover {
            background: #CBD5E1;
        }

        .theme-toggle-ball {
            position: absolute;
            top: 2px;
            left: 2px;
            width: 24px;
            height: 24px;
            background: white;
            border-radius: 50%;
            transition: transform 0.4s cubic-bezier(0.23, 1, 0.32, 1);
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .dark .theme-toggle { background: #334155; }
        .dark .theme-toggle:hover { background: #475569; }
        .dark .theme-toggle-ball {
            transform: translateX(28px);
            background: #1E293B;
        }

        /* Mockup Styles */
        .mockup-window {
            background: linear-gradient(135deg, rgba(255,255,255,0.98) 0%, rgba(248,250,252,0.98) 100%);
            border: 1px solid rgba(226, 232, 240, 0.9);
        }

        .dark .mockup-window {
            background: linear-gradient(135deg, rgba(30, 41, 59, 0.95) 0%, rgba(15, 23, 42, 0.95) 100%);
            border: 1px solid rgba(255, 255, 255, 0.15);
        }

        .mockup-sidebar {
            background: linear-gradient(180deg, #3B82F6 0%, #2563EB 100%);
        }

        .dark .mockup-sidebar {
            background: linear-gradient(180deg, #1E40AF 0%, #1E3A8A 100%);
        }

        .mockup-card {
            background: rgba(255, 255, 255, 0.95);
            border: 1px solid rgba(226, 232, 240, 0.8);
        }

        .dark .mockup-card {
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.15);
        }

        /* Scroll Animations */
        .reveal {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.9s cubic-bezier(0.23, 1, 0.32, 1);
        }

        .reveal.active {
            opacity: 1;
            transform: translateY(0);
        }

        /* Entrance Animations */
        .entrance-fade {
            animation: entranceFade 0.8s ease-out forwards;
        }

        .entrance-slide-up {
            animation: entranceSlideUp 0.8s ease-out forwards;
        }

        .entrance-scale {
            animation: entranceScale 0.6s ease-out forwards;
        }

        /* Animasi selesai - reset biar hover bisa jalan */
        .entrance-scale.done,
        .entrance-fade.done,
        .entrance-slide-up.done {
            animation: none;
            transform: none;
            opacity: 1;
        }

        @keyframes entranceFade {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes entranceSlideUp {
            from {
                opacity: 0;
                transform: translateY(40px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes entranceScale {
            from {
                opacity: 0;
                transform: scale(0.9);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        /* Stagger Animation Delays */
        .stagger-1 { animation-delay: 0.1s; }
        .stagger-2 { animation-delay: 0.2s; }
        .stagger-3 { animation-delay: 0.3s; }
        .stagger-4 { animation-delay: 0.4s; }
        .stagger-5 { animation-delay: 0.5s; }
        .stagger-6 { animation-delay: 0.6s; }
        .stagger-7 { animation-delay: 0.7s; }
        .stagger-8 { animation-delay: 0.8s; }
        .stagger-9 { animation-delay: 0.9s; }
        .stagger-10 { animation-delay: 1.0s; }

        /* Step Line */
        .step-line {
            position: absolute;
            top: 30px;
            left: 20%;
            right: 20%;
            height: 2px;
            background: linear-gradient(to right, #3B82F6, #60A5FA, #3B82F6);
            background-size: 200% 100%;
            animation: gradient 3s ease infinite;
            z-index: 0;
        }

        @media (max-width: 768px) {
            .step-line { display: none; }
        }

        /* FAQ ACCORDION */
        .faq-item {
            overflow: hidden;
            transition: all 0.6s cubic-bezier(0.23, 1, 0.32, 1);
        }

        .faq-answer {
            max-height: 0;
            overflow: hidden;
            opacity: 0;
            transition: max-height 0.6s cubic-bezier(0.23, 1, 0.32, 1),
                        opacity 0.4s ease,
                        padding 0.6s ease;
        }

        .faq-item.active .faq-answer {
            max-height: 500px;
            opacity: 1;
            padding-top: 0.5rem;
            padding-bottom: 1.25rem;
        }

        .faq-item.active .faq-icon {
            transform: rotate(180deg);
        }

        .faq-icon {
            transition: transform 0.6s cubic-bezier(0.23, 1, 0.32, 1);
        }

        /* Counter Animation */
        .counter {
            display: inline-block;
        }

        /* Navbar Scroll Effect */
        .navbar-scrolled {
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(20px) !important;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
            transition: all 0.5s cubic-bezier(0.23, 1, 0.32, 1);
        }

        .dark .navbar-scrolled {
            background: rgba(15, 23, 42, 0.95) !important;
            box-shadow: 0 4px 30px rgba(0,0,0,0.4);
        }

        /* Floating Elements */
        .floating-shape {
            position: fixed;
            border-radius: 50%;
            filter: blur(80px);
            z-index: 0;
            pointer-events: none;
        }

        .floating-shape-1 {
            background: rgba(59, 130, 246, 0.15);
            animation: float 8s ease-in-out infinite;
        }

        .floating-shape-2 {
            background: rgba(147, 197, 253, 0.15);
            animation: float 10s ease-in-out infinite 2s;
        }

        .floating-shape-3 {
            background: rgba(96, 165, 250, 0.1);
            animation: float 12s ease-in-out infinite 4s;
        }

        .dark .floating-shape-1 { background: rgba(59, 130, 246, 0.25); }
        .dark .floating-shape-2 { background: rgba(147, 197, 253, 0.2); }
        .dark .floating-shape-3 { background: rgba(96, 165, 250, 0.15); }

        /* Badge Shine */
        .badge-shine {
            position: relative;
            overflow: hidden;
        }

        .badge-shine::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.6), transparent);
            animation: shine 3s infinite;
        }

        @keyframes shine {
            0% { left: -100%; }
            50%, 100% { left: 100%; }
        }

        a, button {
            transition: all 0.4s cubic-bezier(0.23, 1, 0.32, 1);
        }

        .icon-container {
            position: relative;
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-900 antialiased dark:bg-slate-950 dark:text-slate-100 transition-colors duration-300">

    <!-- Animated Background -->
    <div class="fixed inset-0 bg-gradient-mesh z-0 pointer-events-none"></div>

    <!-- Floating Elements -->
    <div class="floating-shape floating-shape-1 top-20 left-10 w-72 h-72"></div>
    <div class="floating-shape floating-shape-2 bottom-20 right-10 w-96 h-96"></div>
    <div class="floating-shape floating-shape-3 top-1/2 left-1/2 w-80 h-80"></div>

    <!-- HEADER / NAVBAR -->
    <header id="navbar" class="fixed top-0 left-0 right-0 z-50 transition-all duration-300 bg-white/70 backdrop-blur-lg border-b border-slate-200/50 dark:bg-slate-900/70 dark:border-slate-800/50">
        <nav class="max-w-7xl mx-auto px-6 py-4">
            <div class="flex justify-between items-center">
                <a href="#beranda" class="flex items-center gap-2 group">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center shadow-lg shadow-blue-500/30 group-hover:scale-110 transition-transform">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <span class="text-xl font-extrabold tracking-tight">Kasly</span>
                </a>

                <div class="hidden md:flex items-center gap-8">
                    <a href="#beranda" class="text-sm font-medium text-slate-600 hover:text-blue-600 transition-colors relative group dark:text-slate-300 dark:hover:text-blue-400">
                        Beranda
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-blue-600 transition-all group-hover:w-full"></span>
                    </a>
                    <a href="#fitur" class="text-sm font-medium text-slate-600 hover:text-blue-600 transition-colors relative group dark:text-slate-300 dark:hover:text-blue-400">
                        Fitur
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-blue-600 transition-all group-hover:w-full"></span>
                    </a>
                    <a href="#cara-kerja" class="text-sm font-medium text-slate-600 hover:text-blue-600 transition-colors relative group dark:text-slate-300 dark:hover:text-blue-400">
                        Cara Kerja
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-blue-600 transition-all group-hover:w-full"></span>
                    </a>
                    <a href="#testimoni" class="text-sm font-medium text-slate-600 hover:text-blue-600 transition-colors relative group dark:text-slate-300 dark:hover:text-blue-400">
                        Testimoni
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-blue-600 transition-all group-hover:w-full"></span>
                    </a>
                    <a href="#faq" class="text-sm font-medium text-slate-600 hover:text-blue-600 transition-colors relative group dark:text-slate-300 dark:hover:text-blue-400">
                        FAQ
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-blue-600 transition-all group-hover:w-full"></span>
                    </a>
                    <a href="#kontak" class="text-sm font-medium text-slate-600 hover:text-blue-600 transition-colors relative group dark:text-slate-300 dark:hover:text-blue-400">
                        Kontak
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-blue-600 transition-all group-hover:w-full"></span>
                    </a>
                </div>

                <div class="flex items-center gap-3">
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

                    <a href="{{ route('login') }}" class="hidden sm:flex btn-primary px-6 py-2.5 rounded-full text-white text-sm font-semibold items-center gap-1.5">
                        Masuk
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </nav>
    </header>

    <!-- HERO SECTION -->
    <section id="beranda" class="relative z-10 max-w-7xl mx-auto px-6 pt-32 pb-16">
        <div class="text-center max-w-4xl mx-auto">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-blue-50 border border-blue-200 text-blue-700 text-xs font-bold mb-10 entrance-scale badge-shine dark:bg-blue-900/30 dark:border-blue-800 dark:text-blue-400">
                <span class="w-2 h-2 rounded-full bg-blue-500 animate-pulse"></span>
                SISTEM MANAJEMEN KAS KELAS v1.0
            </div>

            <h1 class="text-5xl md:text-7xl font-extrabold leading-[1.1] mb-8 tracking-tight entrance-fade stagger-1">
                Kelola Kas Kelas <br>
                <span class="text-gradient">Lebih Cerdas & Transparan</span>
            </h1>

            <p class="text-lg md:text-xl text-slate-600 max-w-2xl mx-auto mb-12 leading-relaxed entrance-fade stagger-2 dark:text-slate-400">
                Platform digital terintegrasi untuk bendahara dan siswa. Pantau arus kas, riwayat transaksi, dan laporan keuangan secara <span class="font-semibold text-slate-900 dark:text-slate-100">real-time</span> dengan antarmuka modern.
            </p>

            <div class="flex flex-col sm:flex-row justify-center items-center gap-4 mb-20 entrance-slide-up stagger-3">
                <a href="{{ route('login') }}" class="btn-primary px-8 py-4 rounded-full font-bold text-white flex items-center gap-2 text-base">
                    Mulai Sekarang
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                    </svg>
                </a>
                <a href="#fitur" class="px-8 py-4 rounded-full font-semibold text-slate-700 border-2 border-slate-300 hover:border-blue-500 hover:text-blue-600 transition-all flex items-center gap-2 text-base dark:text-slate-300 dark:border-slate-700 dark:hover:border-blue-500 dark:hover:text-blue-400">
                    Pelajari Fitur
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </a>
            </div>
        </div>

        <!-- Mockup Dashboard -->
        <div class="relative max-w-5xl mx-auto entrance-scale stagger-4">
            <div class="absolute inset-0 bg-gradient-to-t from-slate-50 via-transparent to-transparent z-10 pointer-events-none h-32 bottom-0 top-auto dark:from-slate-950"></div>
            <div class="glass-card rounded-3xl p-4 shadow-2xl">
                <div class="mockup-window rounded-2xl overflow-hidden">
                    <div class="flex justify-between items-center px-6 py-3 border-b border-slate-200 dark:border-slate-700 reveal stagger-1">
                        <div class="flex gap-2">
                            <div class="w-3 h-3 rounded-full bg-red-400"></div>
                            <div class="w-3 h-3 rounded-full bg-yellow-400"></div>
                            <div class="w-3 h-3 rounded-full bg-green-400"></div>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="h-6 w-48 bg-slate-100 rounded-lg dark:bg-slate-800"></div>
                            <div class="w-8 h-8 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full"></div>
                        </div>
                    </div>

                    <div class="flex">
                        <div class="mockup-sidebar w-48 p-4 hidden md:block reveal stagger-2">
                            <div class="text-white font-bold text-lg mb-6">Kasly</div>
                            <div class="space-y-2">
                                <div class="bg-white/20 rounded-lg p-2 text-white text-xs font-medium">Dashboard</div>
                                <div class="text-white/70 text-xs p-2">Data Siswa</div>
                                <div class="text-white/70 text-xs p-2">Pembayaran</div>
                                <div class="text-white/70 text-xs p-2">Pengeluaran</div>
                                <div class="text-white/70 text-xs p-2">Laporan</div>
                            </div>
                        </div>

                        <div class="flex-1 p-6">
                            <div class="grid grid-cols-3 gap-3 mb-4">
                                <div class="mockup-card rounded-xl p-3 reveal stagger-3">
                                    <div class="text-xs text-slate-500 mb-1 dark:text-slate-400">Pemasukan</div>
                                    <div class="text-lg font-bold text-green-600 dark:text-green-400">Rp 600K</div>
                                </div>
                                <div class="mockup-card rounded-xl p-3 reveal stagger-4">
                                    <div class="text-xs text-slate-500 mb-1 dark:text-slate-400">Pengeluaran</div>
                                    <div class="text-lg font-bold text-red-600 dark:text-red-400">Rp 60K</div>
                                </div>
                                <div class="mockup-card rounded-xl p-3 reveal stagger-5">
                                    <div class="text-xs text-slate-500 mb-1 dark:text-slate-400">Saldo</div>
                                    <div class="text-lg font-bold text-blue-600 dark:text-blue-400">Rp 540K</div>
                                </div>
                            </div>

                            <div class="mockup-card rounded-xl p-4 h-48 flex items-end justify-around gap-2 reveal stagger-6 mb-4">
                                <div class="w-8 bg-gradient-to-t from-blue-400 to-blue-300 rounded-t-lg h-[40%] animate-entrance-scale" style="animation-delay: 0.7s;"></div>
                                <div class="w-8 bg-gradient-to-t from-blue-400 to-blue-300 rounded-t-lg h-[70%] animate-entrance-scale" style="animation-delay: 0.8s;"></div>
                                <div class="w-8 bg-gradient-to-t from-cyan-400 to-cyan-300 rounded-t-lg h-[50%] animate-entrance-scale" style="animation-delay: 0.9s;"></div>
                                <div class="w-8 bg-gradient-to-t from-cyan-400 to-cyan-300 rounded-t-lg h-[90%] animate-entrance-scale" style="animation-delay: 1.0s;"></div>
                                <div class="w-8 bg-gradient-to-t from-purple-400 to-purple-300 rounded-t-lg h-[60%] animate-entrance-scale" style="animation-delay: 1.1s;"></div>
                                <div class="w-8 bg-gradient-to-t from-purple-400 to-purple-300 rounded-t-lg h-[80%] animate-entrance-scale" style="animation-delay: 1.2s;"></div>
                            </div>

                            <div class="mt-4 flex items-center gap-4 reveal stagger-7">
                                <div class="relative w-16 h-16">
                                    <svg class="w-full h-full" viewBox="0 0 100 100">
                                        <circle cx="50" cy="50" r="45" fill="none" stroke="#E5E7EB" stroke-width="10"/>
                                        <circle cx="50" cy="50" r="45" fill="none" stroke="url(#mockupGradient)" stroke-width="10" stroke-dasharray="236, 283" stroke-linecap="round" transform="rotate(-90 50 50)" class="animate-entrance-scale" style="animation-delay: 1.3s;"></circle>
                                        <defs>
                                            <linearGradient id="mockupGradient" x1="0%" y1="0%" x2="100%" y2="0%">
                                                <stop offset="0%" stop-color="#3B82F6" />
                                                <stop offset="100%" stop-color="#60A5FA" />
                                            </linearGradient>
                                        </defs>
                                    </svg>
                                    <div class="absolute inset-0 flex items-center justify-center">
                                        <span class="text-xs font-bold animate-entrance-scale" style="animation-delay: 1.4s;">83%</span>
                                    </div>
                                </div>
                                <div>
                                    <div class="text-xs font-semibold animate-entrance-scale" style="animation-delay: 1.5s;">Progress Pembayaran</div>
                                    <div class="text-xs text-slate-500 dark:text-slate-400 animate-entrance-scale" style="animation-delay: 1.6s;">30/36 Siswa Lunas</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- STATS SECTION -->
    <section class="relative z-10 max-w-7xl mx-auto px-6 py-12">
        <div class="glass-card rounded-3xl p-8 md:p-10 reveal entrance-scale">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div class="reveal stagger-1">
                    <div class="text-5xl md:text-6xl font-extrabold text-gradient mb-2 counter" data-target="36">0</div>
                    <div class="text-sm text-slate-600 font-medium dark:text-slate-400">Total Siswa</div>
                </div>
                <div class="reveal stagger-2">
                    <div class="text-5xl md:text-6xl font-extrabold text-gradient mb-2"><span class="counter" data-target="83">0</span>%</div>
                    <div class="text-sm text-slate-600 font-medium dark:text-slate-400">Tingkat Pembayaran</div>
                </div>
                <div class="reveal stagger-3">
                    <div class="text-5xl md:text-6xl font-extrabold text-gradient mb-2"><span class="counter" data-target="100">0</span>%</div>
                    <div class="text-sm text-slate-600 font-medium dark:text-slate-400">Transparan</div>
                </div>
                <div class="reveal stagger-4">
                    <div class="text-5xl md:text-6xl font-extrabold text-gradient mb-2">24/7</div>
                    <div class="text-sm text-slate-600 font-medium dark:text-slate-400">Akses Online</div>
                </div>
            </div>
        </div>
    </section>

    <!-- FEATURES SECTION -->
    <section id="fitur" class="relative z-10 max-w-7xl mx-auto px-6 py-16">
        <div class="text-center mb-12 reveal">
            <div class="inline-block px-4 py-2 rounded-full bg-blue-100 text-blue-700 text-xs font-bold mb-6 badge-shine dark:bg-blue-900/30 dark:text-blue-400">FITUR UNGGULAN</div>
            <h2 class="text-4xl md:text-6xl font-extrabold mb-6">Semua yang Kamu Butuhkan <br><span class="text-gradient">Dalam Satu Platform</span></h2>
            <p class="text-slate-600 max-w-xl mx-auto text-lg dark:text-slate-400">Dirancang khusus untuk kebutuhan manajemen keuangan kelas yang efisien, aman, dan transparan.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="glass-card p-8 rounded-3xl reveal stagger-1">
                <div class="icon-container w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center mb-6 text-white shadow-lg shadow-blue-500/30">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold mb-3">Real-time Monitoring</h3>
                <p class="text-slate-600 leading-relaxed dark:text-slate-400">Pantau saldo, pemasukan, dan pengeluaran kelas secara langsung dengan grafik interaktif yang mudah dipahami.</p>
            </div>

            <div class="glass-card p-8 rounded-3xl reveal stagger-2">
                <div class="icon-container w-16 h-16 bg-gradient-to-br from-cyan-500 to-cyan-600 rounded-2xl flex items-center justify-center mb-6 text-white shadow-lg shadow-cyan-500/30">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold mb-3">Keamanan Terjamin</h3>
                <p class="text-slate-600 leading-relaxed dark:text-slate-400">Sistem autentikasi berlapis dengan kewajiban ganti password pertama kali dan proteksi role berbasis middleware.</p>
            </div>

            <div class="glass-card p-8 rounded-3xl reveal stagger-3">
                <div class="icon-container w-16 h-16 bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl flex items-center justify-center mb-6 text-white shadow-lg shadow-purple-500/30">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold mb-3">Laporan Otomatis</h3>
                <p class="text-slate-600 leading-relaxed dark:text-slate-400">Generate laporan keuangan bulanan dalam format PDF secara instan untuk transparansi penuh kepada seluruh siswa.</p>
            </div>
        </div>
    </section>

    <!-- HOW IT WORKS SECTION -->
    <section id="cara-kerja" class="relative z-10 max-w-7xl mx-auto px-6 py-16">
        <div class="text-center mb-12 reveal">
            <div class="inline-block px-4 py-2 rounded-full bg-cyan-100 text-cyan-700 text-xs font-bold mb-6 badge-shine dark:bg-cyan-900/30 dark:text-cyan-400">CARA KERJA</div>
            <h2 class="text-4xl md:text-6xl font-extrabold mb-6">Mudah Digunakan <br><span class="text-gradient">Hanya 3 Langkah</span></h2>
            <p class="text-slate-600 max-w-xl mx-auto text-lg dark:text-slate-400">Mulai mengelola kas kelas dengan cara yang lebih modern dan efisien.</p>
        </div>

        <div class="relative grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="step-line hidden md:block"></div>

            <div class="glass-card p-8 rounded-3xl text-center relative reveal stagger-1">
                <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center mx-auto mb-6 text-white font-bold text-2xl shadow-lg shadow-blue-500/30">1</div>
                <h3 class="text-xl font-bold mb-3">Login ke Akun</h3>
                <p class="text-slate-600 dark:text-slate-400">Bendahara login dengan email, siswa login dengan nama dan NIS. Ganti password saat pertama kali masuk.</p>
            </div>

            <div class="glass-card p-8 rounded-3xl text-center relative reveal stagger-2">
                <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center mx-auto mb-6 text-white font-bold text-2xl shadow-lg shadow-blue-500/30">2</div>
                <h3 class="text-xl font-bold mb-3">Kelola Transaksi</h3>
                <p class="text-slate-600 dark:text-slate-400">Bendahara menginput pembayaran dan pengeluaran. Semua tercatat otomatis dan real-time.</p>
            </div>

            <div class="glass-card p-8 rounded-3xl text-center relative reveal stagger-3">
                <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center mx-auto mb-6 text-white font-bold text-2xl shadow-lg shadow-blue-500/30">3</div>
                <h3 class="text-xl font-bold mb-3">Pantau & Laporan</h3>
                <p class="text-slate-600 dark:text-slate-400">Siswa dapat melihat status pembayaran. Bendahara dapat export laporan PDF kapan saja.</p>
            </div>
        </div>
    </section>

    <!-- TESTIMONIALS SECTION -->
    <section id="testimoni" class="relative z-10 max-w-7xl mx-auto px-6 py-16">
        <div class="text-center mb-12 reveal">
            <div class="inline-block px-4 py-2 rounded-full bg-purple-100 text-purple-700 text-xs font-bold mb-6 badge-shine dark:bg-purple-900/30 dark:text-purple-400">TESTIMONI</div>
            <h2 class="text-4xl md:text-5xl font-extrabold mb-6">Apa Kata <span class="text-gradient">Mereka?</span></h2>
            <p class="text-slate-600 max-w-xl mx-auto dark:text-slate-400">Pengalaman pengguna yang telah menggunakan Kasly.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="glass-card p-6 rounded-2xl reveal stagger-1">
                <div class="flex gap-1 mb-4">
                    <span class="text-yellow-400 text-lg">★★★★★</span>
                </div>
                <p class="text-slate-600 mb-6 text-sm italic leading-relaxed dark:text-slate-400">"Kasly membuat tugas bendahara jadi jauh lebih mudah. Tidak perlu catat manual lagi!"</p>
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full flex items-center justify-center text-white font-bold">A</div>
                    <div>
                        <div class="font-semibold text-sm">Anggia</div>
                        <div class="text-xs text-slate-500 dark:text-slate-400">Bendahara Kelas</div>
                    </div>
                </div>
            </div>

            <div class="glass-card p-6 rounded-2xl reveal stagger-2">
                <div class="flex gap-1 mb-4">
                    <span class="text-yellow-400 text-lg">★★★★★</span>
                </div>
                <p class="text-slate-600 mb-6 text-sm italic leading-relaxed dark:text-slate-400">"Sekarang saya bisa cek status pembayaran kapan saja. Transparan!"</p>
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-cyan-400 to-cyan-600 rounded-full flex items-center justify-center text-white font-bold">B</div>
                    <div>
                        <div class="font-semibold text-sm">Budi</div>
                        <div class="text-xs text-slate-500 dark:text-slate-400">Siswa</div>
                    </div>
                </div>
            </div>

            <div class="glass-card p-6 rounded-2xl reveal stagger-3">
                <div class="flex gap-1 mb-4">
                    <span class="text-yellow-400 text-lg">★★★★★</span>
                </div>
                <p class="text-slate-600 mb-6 text-sm italic leading-relaxed dark:text-slate-400">"Laporan PDF-nya sangat membantu saat presentasi ke wali kelas!"</p>
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-purple-400 to-purple-600 rounded-full flex items-center justify-center text-white font-bold">S</div>
                    <div>
                        <div class="font-semibold text-sm">Siti</div>
                        <div class="text-xs text-slate-500 dark:text-slate-400">Bendahara Kelas</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ SECTION -->
    <section id="faq" class="relative z-10 max-w-4xl mx-auto px-6 py-16">
        <div class="text-center mb-12 reveal">
            <div class="inline-block px-4 py-2 rounded-full bg-green-100 text-green-700 text-xs font-bold mb-6 badge-shine dark:bg-green-900/30 dark:text-green-400">FAQ</div>
            <h2 class="text-4xl md:text-6xl font-extrabold mb-6">Pertanyaan <span class="text-gradient">Umum</span></h2>
            <p class="text-slate-600 max-w-xl mx-auto text-lg dark:text-slate-400">Jawaban untuk pertanyaan yang sering ditanyakan.</p>
        </div>

        <div class="space-y-4">
            <div class="faq-item glass-card rounded-2xl reveal stagger-1">
                <button class="faq-toggle w-full px-6 py-5 flex justify-between items-center text-left font-semibold">
                    <span>Bagaimana cara login sebagai siswa?</span>
                    <svg class="faq-icon w-5 h-5 text-blue-600 dark:text-blue-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div class="faq-answer px-6 text-slate-600 dark:text-slate-400">
                    Siswa login menggunakan nama lengkap dan NIS sebagai password awal. Setelah login pertama kali, siswa wajib mengganti password.
                </div>
            </div>

            <div class="faq-item glass-card rounded-2xl reveal stagger-2">
                <button class="faq-toggle w-full px-6 py-5 flex justify-between items-center text-left font-semibold">
                    <span>Apakah data saya aman?</span>
                    <svg class="faq-icon w-5 h-5 text-blue-600 dark:text-blue-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div class="faq-answer px-6 text-slate-600 dark:text-slate-400">
                    Ya, semua data dilindungi dengan sistem autentikasi berlapis dan enkripsi password. Hanya bendahara yang dapat mengakses data keuangan.
                </div>
            </div>

            <div class="faq-item glass-card rounded-2xl reveal stagger-3">
                <button class="faq-toggle w-full px-6 py-5 flex justify-between items-center text-left font-semibold">
                    <span>Bisakah saya export laporan ke PDF?</span>
                    <svg class="faq-icon w-5 h-5 text-blue-600 dark:text-blue-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div class="faq-answer px-6 text-slate-600 dark:text-slate-400">
                    Ya, bendahara dapat mengexport laporan keuangan bulanan dalam format PDF kapan saja untuk keperluan presentasi atau dokumentasi.
                </div>
            </div>

            <div class="faq-item glass-card rounded-2xl reveal stagger-4">
                <button class="faq-toggle w-full px-6 py-5 flex justify-between items-center text-left font-semibold">
                    <span>Bagaimana jika saya lupa password?</span>
                    <svg class="faq-icon w-5 h-5 text-blue-600 dark:text-blue-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div class="faq-answer px-6 text-slate-600 dark:text-slate-400">
                    Hubungi bendahara kelas untuk mereset password Anda. Password akan dikembalikan ke NIS sebagai password awal.
                </div>
            </div>
        </div>
    </section>

    <!-- CTA SECTION - EXTRA SMOOTH HOVER -->
    <section class="relative z-10 max-w-7xl mx-auto px-6 py-16">
        <div class="glass-card cta-card rounded-3xl p-12 md:p-16 text-center relative overflow-hidden reveal">
            <div class="absolute top-0 right-0 w-64 h-64 bg-blue-400/20 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 left-0 w-64 h-64 bg-cyan-400/20 rounded-full blur-3xl"></div>
            <div class="relative z-10">
                <h2 class="text-4xl md:text-5xl font-extrabold mb-6">Siap Mengelola Kas Kelas <br><span class="text-gradient">Dengan Lebih Baik?</span></h2>
                <p class="text-slate-600 max-w-xl mx-auto mb-8 text-lg dark:text-slate-400">Bergabunglah dengan sistem manajemen kas kelas yang modern, transparan, dan mudah digunakan.</p>
                <a href="{{ route('login') }}" class="btn-primary inline-flex px-10 py-5 rounded-full font-bold text-white items-center gap-2 text-lg">
                    Mulai Sekarang
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                </a>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer id="kontak" class="relative z-10 border-t border-slate-200 bg-white/80 backdrop-blur-lg dark:border-slate-800 dark:bg-slate-900/80">
        <div class="max-w-7xl mx-auto px-6 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                <div class="md:col-span-2">
                    <div class="flex items-center gap-2 mb-4">
                        <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center shadow-lg shadow-blue-500/30">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <span class="text-xl font-bold">Kasly</span>
                    </div>
                    <p class="text-slate-600 text-sm mb-4 max-w-md dark:text-slate-400">
                        Sistem Manajemen Kas Kelas yang modern dan transparan. Membantu bendahara dan siswa mengelola keuangan kelas dengan lebih efisien dan akuntabel.
                    </p>
                    <div class="flex gap-3">
                        <a href="#" class="w-10 h-10 bg-slate-100 rounded-lg flex items-center justify-center text-slate-600 hover:bg-blue-100 hover:text-blue-600 transition-all hover:scale-110 dark:bg-slate-800 dark:text-slate-400 dark:hover:bg-blue-900/30 dark:hover:text-blue-400">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg>
                        </a>
                        <a href="#" class="w-10 h-10 bg-slate-100 rounded-lg flex items-center justify-center text-slate-600 hover:bg-blue-100 hover:text-blue-600 transition-all hover:scale-110 dark:bg-slate-800 dark:text-slate-400 dark:hover:bg-blue-900/30 dark:hover:text-blue-400">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
                        </a>
                        <a href="#" class="w-10 h-10 bg-slate-100 rounded-lg flex items-center justify-center text-slate-600 hover:bg-blue-100 hover:text-blue-600 transition-all hover:scale-110 dark:bg-slate-800 dark:text-slate-400 dark:hover:bg-blue-900/30 dark:hover:text-blue-400">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        </a>
                    </div>
                </div>

                <div>
                    <h4 class="font-bold text-slate-900 mb-4 dark:text-white">Menu</h4>
                    <ul class="space-y-2 text-sm text-slate-600 dark:text-slate-400">
                        <li><a href="#beranda" class="hover:text-blue-600 transition-colors dark:hover:text-blue-400">Beranda</a></li>
                        <li><a href="#fitur" class="hover:text-blue-600 transition-colors dark:hover:text-blue-400">Fitur</a></li>
                        <li><a href="#cara-kerja" class="hover:text-blue-600 transition-colors dark:hover:text-blue-400">Cara Kerja</a></li>
                        <li><a href="#testimoni" class="hover:text-blue-600 transition-colors dark:hover:text-blue-400">Testimoni</a></li>
                        <li><a href="#faq" class="hover:text-blue-600 transition-colors dark:hover:text-blue-400">FAQ</a></li>
                        <li><a href="#kontak" class="hover:text-blue-600 transition-colors dark:hover:text-blue-400">Kontak</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-bold text-slate-900 mb-4 dark:text-white">Kontak</h4>
                    <ul class="space-y-2 text-sm text-slate-600 dark:text-slate-400">
                        <li>kasly@school.id</li>
                        <li>+62 812-3456-7890</li>
                        <li>SMK Budi Bakti Ciwidey<br>Jl. Babakan Tiga No. 82</li>
                    </ul>
                </div>
            </div>

            <div class="pt-8 border-t border-slate-200 flex flex-col md:flex-row justify-between items-center gap-4 dark:border-slate-800">
                <p class="text-sm text-slate-600 dark:text-slate-400">© 2026 Kasly. All rights reserved.</p>
                <p class="text-sm text-slate-500 italic dark:text-slate-400">Created with ❤️ by <span class="font-semibold text-blue-600 dark:text-blue-400">Anggia</span></p>
            </div>
        </div>
    </footer>

    <!-- JavaScript -->
    <script>
        // Theme Toggle
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

        // Navbar Scroll Effect
        const navbar = document.getElementById('navbar');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                navbar.classList.add('navbar-scrolled');
            } else {
                navbar.classList.remove('navbar-scrolled');
            }
        });

        // Scroll Reveal Animation
        const reveals = document.querySelectorAll('.reveal');
        const revealOnScroll = () => {
            reveals.forEach(element => {
                const elementTop = element.getBoundingClientRect().top;
                const windowHeight = window.innerHeight;
                if (elementTop < windowHeight - 100) {
                    element.classList.add('active');
                }
            });
        };
        window.addEventListener('scroll', revealOnScroll);
        revealOnScroll();

        // Counter Animation
        const counters = document.querySelectorAll('.counter');
        const animateCounter = (counter) => {
            const target = +counter.getAttribute('data-target');
            const duration = 2000;
            const increment = target / (duration / 16);
            let current = 0;

            const updateCounter = () => {
                current += increment;
                if (current < target) {
                    counter.innerText = Math.ceil(current);
                    requestAnimationFrame(updateCounter);
                } else {
                    counter.innerText = target;
                }
            };
            updateCounter();
        };

        const counterObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateCounter(entry.target);
                    counterObserver.unobserve(entry.target);
                }
            });
        });

        counters.forEach(counter => counterObserver.observe(counter));

        // FAQ Accordion
        const faqItems = document.querySelectorAll('.faq-item');
        faqItems.forEach(item => {
            const toggle = item.querySelector('.faq-toggle');
            toggle.addEventListener('click', () => {
                const isActive = item.classList.contains('active');

                faqItems.forEach(i => {
                    i.classList.remove('active');
                });

                if (!isActive) {
                    item.classList.add('active');
                }
            });
        });

        // Reset entrance animations after completion so hover works smoothly
        document.querySelectorAll('.entrance-scale, .entrance-fade, .entrance-slide-up').forEach(el => {
            el.addEventListener('animationend', () => {
                el.classList.add('done');
            });
        });
    </script>

</body>
</html>
