<!DOCTYPE html>
<html class="scroll-smooth" lang="id">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>PinjamBarang - Sistem Peminjaman Barang &amp; Inventaris Modern</title>
    <link rel="icon" type="image/webp" href="{{ asset('images/logo-pb.webp') }}">

    <!-- Smart Theme Override & Anti-FOUC Engine -->
    <x-smart-theme-override />

    <!-- Inter / Plus Jakarta Font Family -->
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&amp;family=Space+Grotesk:wght@500;700&amp;display=swap"
        rel="stylesheet" />
    <!-- Tailwind CSS v3 with Plugins -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <!-- Tailwind Configuration -->
    <script data-purpose="tailwind-config">
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                        display: ['"Space Grotesk"', 'sans-serif'],
                    },
                    colors: {
                        pastel: {
                            50: '#FAF5FF',
                            100: '#F3E8FF',
                            200: '#E9D5FF',
                            300: '#D8B4FE',
                            400: '#C084FC',
                            500: '#A855F7',
                            600: '#9333EA',
                            700: '#7E22CE',
                            800: '#6B21A8',
                            900: '#581C87',
                            bg: '#FAF8FF',
                            card: '#FFFFFF',
                            border: '#EDE9FE',
                        },
                        brand: {
                            pitch: '#050508',
                            surface: '#0B0B14',
                            elevated: '#121124',
                            purple: '#7C3AED',
                            deepPurple: '#5B21B6',
                            glow: '#8B5CF6',
                            accent: '#A78BFA',
                        }
                    },
                    boxShadow: {
                        'glow-sm': '0 0 20px -3px rgba(124, 58, 237, 0.4)',
                        'glow-md': '0 0 35px -5px rgba(139, 92, 246, 0.45)',
                        'glow-lg': '0 0 65px -10px rgba(139, 92, 246, 0.55)',
                        'card-dark': '0 20px 40px -15px rgba(0,0,0,0.7)',
                    }
                }
            }
        }
    </script>
    <!-- Keyframe Animations & Glow Styles -->
    <style data-purpose="animations">
        @keyframes pulseGlow {

            0%,
            100% {
                opacity: 0.85;
                transform: scale(1) translateY(0px);
                filter: drop-shadow(0 0 45px rgba(139, 92, 246, 0.65));
            }

            50% {
                opacity: 1;
                transform: scale(1.025) translateY(-4px);
                filter: drop-shadow(0 0 75px rgba(167, 139, 250, 0.95));
            }
        }

        @keyframes subtleFloat {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-6px);
            }
        }

        .animated-arc {
            animation: pulseGlow 7s ease-in-out infinite;
        }

        .float-slow {
            animation: subtleFloat 5s ease-in-out infinite;
        }

        .arc-mask {
            mask-image: radial-gradient(circle at 50% 30%, black 40%, transparent 75%);
            -webkit-mask-image: radial-gradient(circle at 50% 30%, black 40%, transparent 75%);
        }

        @keyframes ringPulse {

            0%,
            100% {
                transform: scale(1);
                filter: drop-shadow(0 0 40px rgba(124, 58, 237, 0.5));
            }

            50% {
                transform: scale(1.02);
                filter: drop-shadow(0 0 80px rgba(167, 139, 250, 1));
            }
        }

        .animated-ring {
            animation: ringPulse 4s ease-in-out infinite;
        }

        @keyframes pulseOpacity {

            0%,
            100% {
                opacity: 0.7;
            }

            50% {
                opacity: 1;
            }
        }

        .animated-pulse {
            animation: pulseOpacity 4s ease-in-out infinite;
        }

        @keyframes pageFadeIn {
            from {
                opacity: 0;
                transform: translateY(8px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .page-transition-blur {
            animation: pageFadeIn 0.5s ease-out forwards;
        }
    </style>
    <!-- Lightweight High-Performance Component Styles (Intel Celeron / All-Device 60 FPS) -->
    <style data-purpose="components">
        body {
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .glass-card {
            background: #FFFFFF;
            border: 1px solid rgba(233, 213, 255, 0.8);
            box-shadow: 0 1px 3px rgba(168, 85, 247, 0.08);
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        html.dark .glass-card {
            background: #0d0d14;
            border: 1px solid rgba(255, 255, 255, 0.08);
            box-shadow: none;
        }

        .glass-card-hover {
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .glass-card-hover:hover {
            transform: translateY(-4px);
            border-color: rgba(168, 85, 247, 0.5);
            box-shadow: 0 14px 30px -10px rgba(124, 58, 237, 0.2);
        }

        html.dark .glass-card-hover:hover {
            border-color: rgba(167, 139, 250, 0.35);
            box-shadow: 0 14px 30px -10px rgba(124, 58, 237, 0.25);
        }

        .purple-radial-gradient {
            background: radial-gradient(circle at center, rgba(124, 58, 237, 0.18) 0%, rgba(5, 5, 8, 0) 70%);
        }

        html {
            scroll-behavior: smooth;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #faf8ff;
        }

        html.dark ::-webkit-scrollbar-track {
            background: #050508;
        }

        ::-webkit-scrollbar-thumb {
            background: #e2e8f0;
            border-radius: 4px;
        }

        html.dark ::-webkit-scrollbar-thumb {
            background: #1f1d36;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #c084fc;
        }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body
    class="bg-[#FAF8FF] dark:bg-[#050508] text-slate-800 dark:text-slate-100 font-sans antialiased selection:bg-purple-600 selection:text-white overflow-x-hidden page-transition-blur transition-colors duration-300">
    <!-- BEGIN: MainHeader -->
    <header class="sticky top-0 z-50 w-full transition-all duration-300">
        <!-- Navbar Container with Frosted Glass -->
        <nav
            class="bg-white/95 dark:bg-[#0b0b14]/95 border-b border-purple-100 dark:border-white/[0.07] px-6 lg:px-12 py-3.5 transition-all duration-300 shadow-sm shadow-purple-100/50 dark:shadow-none">
            <div class="max-w-7xl mx-auto flex items-center justify-between">
                <!-- Brand Logo -->
                <a href="#" onclick="secretAdminLogin()"
                    class="flex items-center gap-3 group cursor-pointer select-none">
                    <img src="{{ asset('images/logo-pb.webp') }}" alt="Logo PB"
                        class="h-10 w-10 rounded-xl object-cover shadow-md shadow-purple-500/30 transition-transform group-hover:scale-105">
                    <span class="text-slate-900 dark:text-white font-extrabold text-lg tracking-tight font-display">
                        Pinjam<span class="text-purple-600 dark:text-purple-400">Barang.</span>
                    </span>
                </a>
                <!-- Navigation Links -->
                <div
                    class="hidden md:flex items-center space-x-8 text-sm font-medium text-slate-600 dark:text-slate-300">
                    <a class="text-purple-700 dark:text-white font-semibold hover:text-purple-600 dark:hover:text-purple-400 transition-colors duration-200"
                        href="#beranda">Beranda</a>
                    <a class="hover:text-purple-600 dark:hover:text-purple-400 transition-colors duration-200"
                        href="#fitur">Fitur</a>
                    <a class="hover:text-purple-600 dark:hover:text-purple-400 transition-colors duration-200"
                        href="#katalog">Katalog Aset</a>
                    <a class="hover:text-purple-600 dark:hover:text-purple-400 transition-colors duration-200"
                        href="#alur-kerja">Alur Kerja</a>
                    <a class="hover:text-purple-600 dark:hover:text-purple-400 transition-colors duration-200"
                        href="#bantuan">Bantuan</a>
                </div>
                <!-- Action CTA Buttons & Theme Switcher -->
                <div class="flex items-center gap-3">
                    <!-- Theme Switcher -->
                    <x-theme-toggle size="sm" />

                    <a class="btn-demo-sistem btn-secondary-outline hidden sm:inline-flex items-center px-4 py-2 text-xs font-semibold rounded-full border border-[#C4B5FD] dark:border-white/15 text-[#4C1D95] dark:text-slate-200 hover:text-purple-950 dark:hover:text-white hover:border-purple-400 dark:hover:border-purple-400/50 bg-purple-50/70 dark:bg-white/5 hover:bg-purple-100/80 transition duration-200"
                        href="#demo">
                        Demo Sistem
                    </a>
                </div>
            </div>
        </nav>
    </header>
    <!-- END: MainHeader -->
    <!-- BEGIN: HeroSection -->
    <style>
        /* Global Performance Boost untuk Semua Perangkat */
        *,
        *::before,
        *::after {
            backdrop-filter: none !important;
            -webkit-backdrop-filter: none !important;
        }

        /* Ganti efek kaca transparan dengan warna solid yang ringan */
        nav,
        header,
        .card,
        .modal,
        table {
            background-blend-mode: normal !important;
        }

        /* Hapus semua elemen dekorasi blur-3xl / blur-2xl yang memakan RAM */
        [class*="blur-2xl"],
        [class*="blur-3xl"],
        [class*="blur-["] {
            filter: none !important;
            display: none !important;
        }

        /* Sederhanakan Shadow pada Card & Tombol */
        .card,
        .glass-card,
        [class*="shadow-glow"] {
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08) !important;
        }

        /* Perbaikan Kontras Tombol Sekunder/Outline di Light Mode (Solid Ungu Pekat & Teks Putih Bersih) */
        html.light-mode .btn-secondary-outline,
        body.light-mode .btn-secondary-outline,
        .light-mode .btn-secondary-outline,
        html.light-mode .btn-lacak-hero,
        body.light-mode .btn-lacak-hero,
        .light-mode .btn-lacak-hero,
        html.light-mode .btn-demo-sistem,
        body.light-mode .btn-demo-sistem,
        .light-mode .btn-demo-sistem,
        html.light-mode a[href*="katalog"].rounded-full,
        body.light-mode a[href*="katalog"].rounded-full,
        .light-mode a[href*="katalog"].rounded-full,
        html.light-mode a[href*="lacak"],
        body.light-mode a[href*="lacak"],
        .light-mode a[href*="lacak"],
        html.light-mode button.border-purple-500\/30,
        body.light-mode button.border-purple-500\/30,
        .light-mode button.border-purple-500\/30,
        html.light-mode a.border-purple-500\/30,
        body.light-mode a.border-purple-500\/30,
        .light-mode a.border-purple-500\/30,
        html.light-mode a.border-purple-300,
        body.light-mode a.border-purple-300,
        .light-mode a.border-purple-300,
        html.light-mode a.bg-white\/5,
        body.light-mode a.bg-white\/5,
        .light-mode a.bg-white\/5,
        html.light-mode button.bg-white\/5,
        body.light-mode button.bg-white\/5,
        .light-mode button.bg-white\/5 {
            background-color: #7C3AED !important;
            /* Ungu solid pekat */
            background: #7C3AED !important;
            color: #FFFFFF !important;
            /* Teks putih bersih */
            border: 1.5px solid #6D28D9 !important;
            /* Border ungu tua */
            font-weight: 600 !important;
            box-shadow: 0 2px 6px rgba(124, 58, 237, 0.25) !important;
        }

        /* Pastikan semua teks & ikon di dalam tombol sekunder ikut berwarna putih bersih */
        html.light-mode .btn-secondary-outline *,
        body.light-mode .btn-secondary-outline *,
        .light-mode .btn-secondary-outline *,
        html.light-mode .btn-lacak-hero *,
        body.light-mode .btn-lacak-hero *,
        .light-mode .btn-lacak-hero *,
        html.light-mode .btn-demo-sistem *,
        body.light-mode .btn-demo-sistem *,
        .light-mode .btn-demo-sistem *,
        html.light-mode a[href*="katalog"].rounded-full *,
        body.light-mode a[href*="katalog"].rounded-full *,
        .light-mode a[href*="katalog"].rounded-full *,
        html.light-mode a[href*="lacak"] *,
        body.light-mode a[href*="lacak"] *,
        .light-mode a[href*="lacak"] * {
            color: #FFFFFF !important;
            stroke: #FFFFFF !important;
        }

        /* Hover state untuk tombol sekunder di Light Mode */
        html.light-mode .btn-secondary-outline:hover,
        body.light-mode .btn-secondary-outline:hover,
        .light-mode .btn-secondary-outline:hover,
        html.light-mode .btn-lacak-hero:hover,
        body.light-mode .btn-lacak-hero:hover,
        .light-mode .btn-lacak-hero:hover,
        html.light-mode .btn-demo-sistem:hover,
        body.light-mode .btn-demo-sistem:hover,
        .light-mode .btn-demo-sistem:hover,
        html.light-mode a[href*="katalog"].rounded-full:hover,
        body.light-mode a[href*="katalog"].rounded-full:hover,
        .light-mode a[href*="katalog"].rounded-full:hover,
        html.light-mode a[href*="lacak"]:hover,
        body.light-mode a[href*="lacak"]:hover,
        .light-mode a[href*="lacak"]:hover {
            background-color: #6D28D9 !important;
            /* Ungu lebih gelap saat hover */
            background: #6D28D9 !important;
            color: #FFFFFF !important;
            border-color: #5B21B6 !important;
            box-shadow: 0 4px 12px rgba(109, 40, 217, 0.35) !important;
        }

        /* Pastikan tombol utama yang berlatar ungu pekat (seperti 'Login Admin' dan 'Ajukan Peminjaman Barang') tetap memiliki teks warna putih */
        html.light-mode a[href*="login"],
        body.light-mode a[href*="login"],
        .light-mode a[href*="login"],
        html.light-mode a[href*="login"] span,
        body.light-mode a[href*="login"] span,
        .light-mode a[href*="login"] span,
        html.light-mode a[href="#ajukan"],
        body.light-mode a[href="#ajukan"],
        .light-mode a[href="#ajukan"],
        html.light-mode .bg-purple-600,
        body.light-mode .bg-purple-600,
        .light-mode .bg-purple-600,
        html.light-mode [class*="from-purple-600"],
        body.light-mode [class*="from-purple-600"],
        .light-mode [class*="from-purple-600"] {
            color: #FFFFFF !important;
        }

        /* Hero Floating Showcase Card Styling in Light Mode */
        html.light-mode .hero-showcase-card-1,
        body.light-mode .hero-showcase-card-1,
        .light-mode .hero-showcase-card-1 {
            background: linear-gradient(135deg, #7C3AED 0%, #6D28D9 50%, #4338CA 100%) !important;
            color: #FFFFFF !important;
        }

        html.light-mode .hero-showcase-card-1 h3,
        body.light-mode .hero-showcase-card-1 h3,
        .light-mode .hero-showcase-card-1 h3,
        .hero-card-title,
        html.light-mode .hero-card-title,
        body.light-mode .hero-card-title {
            color: #FFFFFF !important;
        }

        html.light-mode .hero-showcase-card-1 p,
        body.light-mode .hero-showcase-card-1 p,
        .light-mode .hero-showcase-card-1 p {
            color: #F3E8FF !important;
        }

        html.light-mode .hero-showcase-card-1 span,
        body.light-mode .hero-showcase-card-1 span,
        .light-mode .hero-showcase-card-1 span {
            color: #FFFFFF !important;
        }

        html.light-mode .hero-showcase-card-1 .text-purple-200,
        body.light-mode .hero-showcase-card-1 .text-purple-200,
        .light-mode .hero-showcase-card-1 .text-purple-200 {
            color: #E9D5FF !important;
        }

        html.light-mode .hero-showcase-card-1 .text-emerald-300,
        body.light-mode .hero-showcase-card-1 .text-emerald-300,
        .light-mode .hero-showcase-card-1 .text-emerald-300 {
            color: #6EE7B7 !important;
        }

        html.light-mode .hero-showcase-card-1 svg,
        body.light-mode .hero-showcase-card-1 svg,
        .light-mode .hero-showcase-card-1 svg {
            color: #F3E8FF !important;
        }

        /* Hero Showcase Card 2 - Terang Elegan di Light Mode */
        /* Hero Showcase Card 2 - Putih Solid & Rapi di Light Mode */
        html.light-mode .hero-showcase-card-2,
        body.light-mode .hero-showcase-card-2,
        .light-mode .hero-showcase-card-2 {
            background-color: rgba(255, 255, 255, 0.95) !important;
            background: rgba(255, 255, 255, 0.95) !important;
            background-color: #FFFFFF !important;
            background: #FFFFFF !important;
            color: #1E293B !important;
            border-color: rgba(233, 213, 255, 0.8) !important;
            box-shadow: 0 20px 25px -5px rgba(147, 51, 234, 0.1), 0 8px 10px -6px rgba(147, 51, 234, 0.08) !important;
            border-color: #E9D5FF !important;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -4px rgba(0, 0, 0, 0.05) !important;
        }

        html.light-mode .hero-showcase-card-2 h4,
        body.light-mode .hero-showcase-card-2 h4,
        .light-mode .hero-showcase-card-2 h4 {
            color: #0F172A !important;
        }

        html.light-mode .hero-showcase-card-2 .hero-showcase-main-text,
        body.light-mode .hero-showcase-card-2 .hero-showcase-main-text,
        .light-mode .hero-showcase-card-2 .hero-showcase-main-text {
            color: #1E293B !important;
            font-weight: 600 !important;
        }

        html.light-mode .hero-showcase-card-2 .hero-icon-box-1,
        body.light-mode .hero-showcase-card-2 .hero-icon-box-1,
        .light-mode .hero-showcase-card-2 .hero-icon-box-1,
        html.light-mode .hero-showcase-card-2 .hero-icon-box-2,
        body.light-mode .hero-showcase-card-2 .hero-icon-box-2,
        .light-mode .hero-showcase-card-2 .hero-icon-box-2 {
            background-color: #F3E8FF !important;
            color: #9333EA !important;
            border-color: #E9D5FF !important;
        }

        html.light-mode .hero-showcase-card-2 .hero-icon-box-1 svg,
        body.light-mode .hero-showcase-card-2 .hero-icon-box-1 svg,
        .light-mode .hero-showcase-card-2 .hero-icon-box-1 svg,
        html.light-mode .hero-showcase-card-2 .hero-icon-box-2 svg,
        body.light-mode .hero-showcase-card-2 .hero-icon-box-2 svg,
        .light-mode .hero-showcase-card-2 .hero-icon-box-2 svg {
            color: #9333EA !important;
        }

        html.light-mode .hero-showcase-card-2 .hero-showcase-free,
        body.light-mode .hero-showcase-card-2 .hero-showcase-free,
        .light-mode .hero-showcase-card-2 .hero-showcase-free {
            color: #64748B !important;
        }

        html.light-mode .hero-showcase-card-2 a.hero-showcase-link,
        body.light-mode .hero-showcase-card-2 a.hero-showcase-link,
        .light-mode .hero-showcase-card-2 a.hero-showcase-link {
            color: #9333EA !important;
            font-weight: 600 !important;
        }

        html.light-mode .hero-showcase-card-2 a.hero-showcase-link:hover,
        body.light-mode .hero-showcase-card-2 a.hero-showcase-link:hover,
        .light-mode .hero-showcase-card-2 a.hero-showcase-link:hover {
            color: #7E22CE !important;
        }

        html.light-mode .hero-showcase-card-2 .hero-wa-badge,
        body.light-mode .hero-showcase-card-2 .hero-wa-badge,
        .light-mode .hero-showcase-card-2 .hero-wa-badge {
            background-color: #ECFDF5 !important;
            color: #047857 !important;
            border-color: #A7F3D0 !important;
        }

        html.light-mode .hero-showcase-card-2 .hero-card-divider,
        body.light-mode .hero-showcase-card-2 .hero-card-divider,
        .light-mode .hero-showcase-card-2 .hero-card-divider {
            border-color: rgba(233, 213, 255, 0.6) !important;
        }

        /* Floating Pill Badge di Sudut Kanan Bawah */
        html.light-mode .hero-status-pill,
        body.light-mode .hero-status-pill,
        .light-mode .hero-status-pill {
            background-color: #FFFFFF !important;
            background: #FFFFFF !important;
            border-color: #A7F3D0 !important;
            color: #047857 !important;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -4px rgba(0, 0, 0, 0.1) !important;
        }

        html.light-mode .hero-status-pill-text,
        body.light-mode .hero-status-pill-text,
        .light-mode .hero-status-pill-text {
            color: #047857 !important;
        }
    </style>

    <!-- HERO SECTION MULAI (2-COLUMN SPLIT LAYOUT) -->
    <section
        class="relative pt-12 pb-16 lg:pt-20 lg:pb-24 overflow-hidden flex flex-col justify-center min-h-[calc(100vh-70px)]"
        id="beranda" data-purpose="hero-container">

        <!-- Latar Halus Gradasi Ungu Ringan (Tanpa Blur Berat) -->
        <div
            class="absolute inset-0 bg-gradient-to-b from-purple-100/30 via-transparent to-transparent dark:from-purple-950/20 dark:via-transparent dark:to-transparent pointer-events-none -z-10">
        </div>

        <div class="max-w-7xl mx-auto px-6 w-full">
            <!-- 2-COLUMN GRID -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-8 items-center">

                <!-- KOLOM KIRI (lg:col-span-6 text-left) -->
                <div class="lg:col-span-6 flex flex-col items-start text-left space-y-5">
                    <!-- Badge Atas: Pill Ungu Rata Kiri -->
                    <div
                        class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full border border-purple-300 dark:border-purple-500/30 bg-purple-100/90 dark:bg-purple-950/80 shadow-sm">
                        <span class="w-2 h-2 rounded-full bg-purple-600 dark:bg-purple-400 animate-pulse"></span>
                        <span
                            class="text-[11px] font-bold text-purple-800 dark:text-purple-300 tracking-wide uppercase">Sistem
                            Peminjaman Otomatis &amp; Terintegrasi Admin</span>
                    </div>

                    <!-- Judul Utama (Rata Kiri, Font Besar & Tegas) -->
                    <h1
                        class="text-4xl sm:text-5xl lg:text-[3.5rem] font-extrabold tracking-tight font-display leading-[1.12] text-[#0F172A] dark:text-white">
                        Pinjam Peralatan &amp; Aset<br class="hidden sm:inline" />
                        <span class="text-purple-600 dark:text-[#C084FC]">Lebih Cepat dan Transparan</span>
                    </h1>

                    <!-- Deskripsi Paragraf Rata Kiri -->
                    <p
                        class="text-base sm:text-lg text-slate-600 dark:text-slate-300 font-medium leading-relaxed max-w-xl">
                        Cukup isi identitas nama, nickname, kontak, dan tanggal peminjaman. Permohonan langsung
                        diteruskan ke admin secara real-time dengan status yang dapat Anda pantau mandiri.
                    </p>

                    <!-- Baris Tombol CTA -->
                    <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3.5 w-full sm:w-auto pt-1">
                        <a href="#ajukan"
                            class="inline-flex items-center justify-center gap-2 px-7 py-3.5 rounded-full font-bold text-sm text-white bg-purple-600 hover:bg-purple-700 shadow-sm hover:scale-[1.02] active:scale-[0.98] transition-all duration-200">
                            <span>Ajukan Peminjaman Barang</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </a>
                        <a href="{{ route('lacak.status') }}"
                            class="btn-lacak-hero btn-secondary-outline inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-full font-bold text-sm text-[#4C1D95] dark:text-white border border-[#C4B5FD] dark:border-white/20 bg-purple-50/90 dark:bg-white/[0.05] hover:bg-purple-100/90 dark:hover:bg-white/[0.1] hover:border-purple-400 dark:hover:border-white/50 transition duration-200 shadow-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                            </svg>
                            <span>Lacak Status Pengajuan</span>
                        </a>
                    </div>

                    <!-- Form Input Pencarian Cepat (Lebar penuh w-full max-w-md, rata kiri) -->
                    <div class="w-full max-w-md" id="lacak">
                        <form action="{{ route('lacak.status') }}" method="GET"
                            class="relative flex items-center shadow-sm rounded-full w-full">
                            <div class="absolute left-4 pointer-events-none text-slate-400 dark:text-slate-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                            <input type="text" name="keyword" placeholder="Masukkan Kode PJ- / No. WhatsApp..."
                                class="w-full pl-11 pr-28 py-3.5 rounded-full bg-white dark:bg-[#0e0e1a] text-slate-800 dark:text-white text-xs sm:text-sm border border-purple-200 dark:border-white/20 focus:border-purple-500 focus:ring-2 focus:ring-purple-300 dark:focus:ring-purple-400 outline-none transition-all placeholder:text-slate-400 dark:placeholder:text-slate-500 shadow-sm"
                                required>
                            <button type="submit"
                                class="absolute right-1.5 px-4 py-2 rounded-full bg-purple-600 hover:bg-purple-700 text-white text-xs font-semibold shadow-sm transition-all hover:scale-105 active:scale-95">
                                Cari Resi
                            </button>
                        </form>
                    </div>

                    <!-- Garis Pemisah & Quick Category Pills -->
                    <div class="w-full border-t border-purple-500/20 dark:border-white/10 pt-4 mt-2">
                        <div
                            class="text-[11px] font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2.5">
                            Kategori Siap Pinjam:
                        </div>
                        <div class="flex flex-wrap gap-2.5 pt-1">
                            <span
                                class="inline-flex items-center gap-1.5 rounded-full border border-purple-400/40 dark:border-purple-500/30 px-3.5 py-1 text-xs font-medium text-purple-900 dark:text-purple-200 bg-purple-50/80 dark:bg-purple-950/30 hover:border-purple-500 transition-colors cursor-default">
                                📽️ Proyektor Epson
                            </span>
                            <span
                                class="inline-flex items-center gap-1.5 rounded-full border border-purple-400/40 dark:border-purple-500/30 px-3.5 py-1 text-xs font-medium text-purple-900 dark:text-purple-200 bg-purple-50/80 dark:bg-purple-950/30 hover:border-purple-500 transition-colors cursor-default">
                                💻 MacBook &amp; Laptop
                            </span>
                            <span
                                class="inline-flex items-center gap-1.5 rounded-full border border-purple-400/40 dark:border-purple-500/30 px-3.5 py-1 text-xs font-medium text-purple-900 dark:text-purple-200 bg-purple-50/80 dark:bg-purple-950/30 hover:border-purple-500 transition-colors cursor-default">
                                📷 Kamera Sony Alpha
                            </span>
                            <span
                                class="inline-flex items-center gap-1.5 rounded-full border border-purple-400/40 dark:border-purple-500/30 px-3.5 py-1 text-xs font-medium text-purple-900 dark:text-purple-200 bg-purple-50/80 dark:bg-purple-950/30 hover:border-purple-500 transition-colors cursor-default">
                                🎙️ Wireless Mic
                            </span>
                            <span
                                class="inline-flex items-center gap-1.5 rounded-full border border-purple-400/40 dark:border-purple-500/30 px-3.5 py-1 text-xs font-medium text-purple-900 dark:text-purple-200 bg-purple-50/80 dark:bg-purple-950/30 hover:border-purple-500 transition-colors cursor-default">
                                🔌 Kabel &amp; Roll
                            </span>
                            <span
                                class="inline-flex items-center gap-1.5 rounded-full border border-purple-400/40 dark:border-purple-500/30 px-3.5 py-1 text-xs font-medium text-purple-900 dark:text-purple-200 bg-purple-50/80 dark:bg-purple-950/30 hover:border-purple-500 transition-colors cursor-default">
                                📦 Barang Habis Pakai
                            </span>
                        </div>
                    </div>
                </div>

                <!-- KOLOM KANAN: VISUAL FLOATING SHOWCASE BARANG SARPRAS -->
                <div
                    class="lg:col-span-6 relative w-full h-[480px] sm:h-[500px] flex items-center justify-center select-none overflow-hidden sm:overflow-visible">

                    <!-- Lingkaran Orbit Konsentris di Tengah -->
                    <div
                        class="w-[340px] h-[340px] rounded-full border border-purple-300 dark:border-purple-500/20 absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 pointer-events-none transition-colors duration-300">
                    </div>
                    <div
                        class="w-[460px] h-[460px] rounded-full border border-purple-200 dark:border-purple-500/10 absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 pointer-events-none transition-colors duration-300">
                    </div>

                    <!-- Kartu 1: Mini-Card Statistik (Sudut Kiri Atas) -->
                    <div
                        class="absolute top-2 left-1 sm:left-4 z-30 bg-white dark:bg-[#1a1730] text-slate-900 dark:text-white rounded-xl p-3 sm:p-3.5 shadow-lg border border-purple-200 dark:border-purple-500/30 w-44 sm:w-52 pointer-events-none">
                        <div class="flex items-center justify-between mb-1.5">
                            <span
                                class="text-[10px] font-extrabold uppercase tracking-wider text-purple-700 dark:text-purple-300">Stok
                                Real-Time</span>
                            <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        </div>
                        <!-- Mini Grafik Batang -->
                        <div class="flex items-end gap-1.5 h-6 mb-1.5">
                            <div class="w-3 bg-purple-500 rounded-t h-3.5"></div>
                            <div class="w-3 bg-purple-600 rounded-t h-6"></div>
                            <div class="w-3 bg-indigo-500 rounded-t h-4"></div>
                            <div class="w-3 bg-purple-400 rounded-t h-5"></div>
                            <div class="w-3 bg-violet-600 rounded-t h-3"></div>
                            <div class="w-3 bg-purple-700 rounded-t h-6"></div>
                        </div>
                        <div class="text-[10px] font-semibold text-slate-700 dark:text-slate-300">
                            72 TI &bull; 22 Media &bull; 70 Lab
                        </div>
                    </div>

                    <!-- Bulatan Ikon Ungu Terang (Kanan Atas) -->
                    <div
                        class="absolute top-2 right-1 sm:right-6 z-30 w-11 h-11 rounded-full bg-gradient-to-br from-purple-500 to-indigo-600 text-white flex items-center justify-center shadow-lg shadow-purple-500/40 pointer-events-none">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M5 13l4 4L19 7" />
                        </svg>
                    </div>

                    <!-- Kartu 2: Proyektor Laser Epson 4K (Kanan Atas - Miring rotate-2, hover rotate-0) -->
                    <div
                        class="hero-showcase-card-1 absolute top-10 sm:top-8 right-2 sm:right-6 z-10 w-[270px] sm:w-80 rounded-2xl p-5 sm:p-6 bg-gradient-to-br from-purple-600 via-purple-700 to-indigo-800 text-white shadow-xl rotate-2 hover:rotate-0 hover:scale-[1.02] transition-transform duration-300 border border-white/10">
                        <div class="flex items-center justify-between mb-3">
                            <span
                                class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-bold bg-white/20 !text-white border border-white/20 uppercase tracking-wider">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                                Aset Sekolah
                            </span>
                            <span class="text-[11px] font-mono !text-purple-200 tracking-wider">INV-SRPR-01</span>
                        </div>

                        <!-- Ikon Ilustrasi Proyektor Besar -->
                        <div
                            class="my-2 flex items-center justify-center py-3 bg-white/10 rounded-xl border border-white/10">
                            <svg class="w-14 h-14 !text-purple-100" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <rect x="2" y="7" width="20" height="10" rx="2.5" stroke-width="1.8" />
                                <circle cx="8" cy="12" r="3" stroke-width="1.8" />
                                <circle cx="8" cy="12" r="1.2" fill="currentColor" />
                                <path stroke-linecap="round" stroke-width="1.8"
                                    d="M15 10h3M15 14h3M5 17l-1.5 2M19 17l1.5 2" />
                                <path stroke-linecap="round" stroke-dasharray="2 2" stroke-width="1.5"
                                    d="M11 12l8-4M11 12l8 4" />
                            </svg>
                        </div>

                        <div class="mt-2">
                            <h3 class="hero-card-title text-base sm:text-lg font-bold !text-white tracking-tight"
                                style="color: #FFFFFF !important;">Proyektor Laser Epson 4K</h3>
                            <p class="text-xs !text-purple-100 mt-0.5">HDMI &bull; Wireless Display &bull; Audio 16W
                            </p>
                        </div>

                        <div class="mt-3.5 pt-3 border-t border-white/15 flex items-center justify-between text-xs">
                            <span class="inline-flex items-center gap-1.5 !text-emerald-300 font-semibold text-[11px]">
                                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                                Tersedia &bull; 8 Unit Siap Pakai
                            </span>
                            <span class="text-[10px] !text-purple-200 font-medium">Lab Multimedia</span>
                        </div>
                    </div>

                    <!-- Kartu 3: Total 164 Unit Terawat (Kiri Bawah - Miring -rotate-2, hover rotate-0) -->
                    <div
                        class="hero-showcase-card-2 absolute bottom-8 sm:bottom-6 left-2 sm:left-6 z-20 w-[270px] sm:w-80 rounded-2xl p-5 sm:p-6 bg-white dark:bg-[#161329] border border-purple-200 dark:border-purple-500/40 text-slate-800 dark:text-white shadow-lg dark:shadow-2xl -rotate-2 hover:rotate-0 hover:scale-[1.02] transition-transform duration-300">
                        <div class="flex items-center justify-between mb-3">
                            <div class="flex items-center gap-2">
                                <div
                                    class="hero-icon-box-1 w-8 h-8 rounded-lg bg-purple-100 dark:bg-purple-500/20 border border-purple-200 dark:border-purple-400/30 flex items-center justify-center text-purple-600 dark:text-purple-300">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div
                                    class="hero-icon-box-2 w-8 h-8 rounded-lg bg-purple-100 dark:bg-indigo-500/20 border border-purple-200 dark:border-indigo-400/30 flex items-center justify-center text-purple-600 dark:text-indigo-300">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                            </div>
                            <span
                                class="hero-wa-badge inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 dark:bg-emerald-500/20 text-emerald-700 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-500/30">
                                Respon WA Otomatis
                            </span>
                        </div>

                        <div>
                            <p
                                class="hero-showcase-main-text text-xs sm:text-sm font-bold text-slate-800 dark:text-white mt-1">
                                Total 164 Unit Terawat &bull; Siap Pakai Kegiatan</p>
                        </div>

                        <div
                            class="hero-card-divider mt-3.5 pt-3 border-t border-purple-200/60 dark:border-purple-500/20 flex items-center justify-between text-xs">
                            <span
                                class="hero-showcase-free text-[11px] font-medium text-slate-500 dark:text-slate-300">Peminjaman
                                Bebas Biaya</span>
                            <a href="#katalog"
                                class="hero-showcase-link font-bold text-[11px] text-purple-600 dark:text-purple-400 hover:text-purple-700 dark:hover:text-purple-300 flex items-center gap-1 transition-colors">
                                Cek Katalog &rarr;
                            </a>
                        </div>
                    </div>

                </div>

            </div> <!-- Penutup 2-COLUMN GRID -->

            <!-- 4 METRIK STATISTIK SISTEM (BOTTOM STRIP) -->
            <div
                class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-14 pt-8 border-t border-purple-200/60 dark:border-white/10 relative">
                <div
                    class="bg-white dark:bg-[#0e0e1a] rounded-2xl p-5 text-center border border-purple-100 dark:border-white/10 hover:border-purple-400/50 transition-colors shadow-sm">
                    <h4 class="text-3xl font-extrabold text-slate-800 dark:text-white mb-1">{{ $totalAset }}</h4>
                    <p class="text-xs text-purple-700 dark:text-purple-200 font-medium">Total Aset Barang</p>
                </div>
                <div
                    class="bg-white dark:bg-[#0e0e1a] rounded-2xl p-5 text-center border border-purple-100 dark:border-white/10 hover:border-emerald-400/50 transition-colors shadow-sm">
                    <h4 class="text-3xl font-extrabold text-emerald-600 dark:text-emerald-300 mb-1">{{ $barangSiap }}
                    </h4>
                    <p class="text-xs text-purple-700 dark:text-purple-200 font-medium">Barang Siap Dipinjam</p>
                </div>
                <div
                    class="bg-white dark:bg-[#0e0e1a] rounded-2xl p-5 text-center border border-purple-100 dark:border-white/10 hover:border-indigo-400/50 transition-colors shadow-sm">
                    <h4 class="text-3xl font-extrabold text-indigo-600 dark:text-indigo-300 mb-1">
                        {{ $totalPeminjaman }}</h4>
                    <p class="text-xs text-purple-700 dark:text-purple-200 font-medium">Total Peminjaman</p>
                </div>
                <div
                    class="bg-white dark:bg-[#0e0e1a] rounded-2xl p-5 text-center border border-purple-100 dark:border-white/10 hover:border-fuchsia-400/50 transition-colors shadow-sm">
                    <h4 class="text-3xl font-extrabold text-purple-600 dark:text-fuchsia-300 mb-1">
                        {{ $sedangDiproses }}</h4>
                    <p class="text-xs text-purple-700 dark:text-purple-200 font-medium">Sedang Diproses/Aktif</p>
                </div>
            </div>

        </div>
    </section>
    <!-- END: HeroSection -->
    <!-- BEGIN: FeatureGridSection -->
    <section class="relative py-20 px-6 lg:px-12 bg-white dark:bg-[#050508] transition-colors duration-300"
        data-purpose="features" id="fitur">

        <!-- EFEK TRANSISI BLUR & FADE OUT ANTAR SECTION -->
        <div
            class="absolute top-0 left-0 w-full h-48 bg-gradient-to-b from-purple-100/40 via-purple-50/10 to-transparent dark:from-purple-900/20 dark:via-purple-900/5 dark:to-[#050508] pointer-events-none">
        </div>

        <div class="max-w-3xl mx-auto text-center mb-16 relative z-10">
            <h2
                class="text-3xl md:text-4xl font-extrabold font-display tracking-tight text-slate-900 dark:text-white mb-4">
                Inovasi Peminjaman. <span class="text-purple-600 dark:text-purple-400">Solusi Lengkap.</span>
            </h2>
            <p class="text-slate-600 dark:text-slate-400 text-sm md:text-base leading-relaxed">
                Kelola siklus hidup inventaris dan aset dengan sistem cerdas tanpa birokrasi berbelit. Dirancang untuk
                transparansi dan ketepatan.
            </p>
        </div>
        <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 relative z-10">
            <div
                class="glass-card glass-card-hover rounded-2xl p-7 flex flex-col justify-between h-[230px] relative overflow-hidden group">
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <div
                            class="w-10 h-10 rounded-xl bg-purple-100 dark:bg-purple-500/10 border border-purple-200 dark:border-purple-500/20 flex items-center justify-center text-purple-700 dark:text-purple-400 group-hover:bg-purple-600 group-hover:text-white transition-colors duration-300">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                                viewbox="0 0 24 24">
                                <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                                <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                            </svg>
                        </div>
                        <span
                            class="text-slate-400 dark:text-slate-500 group-hover:text-purple-600 dark:group-hover:text-purple-300 transition-colors duration-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                                viewbox="0 0 24 24">
                                <line x1="7" x2="17" y1="17" y2="7"></line>
                                <polyline points="7 7 17 7 17 17"></polyline>
                            </svg>
                        </span>
                    </div>
                    <h3
                        class="text-lg font-bold text-slate-900 dark:text-white mb-2 group-hover:text-purple-600 dark:group-hover:text-purple-200 transition-colors">
                        Katalog Aset Digital</h3>
                    <p class="text-slate-600 dark:text-slate-400 text-xs leading-relaxed">
                        Daftar lengkap inventaris dengan spesifikasi teknis, kondisi fisik, foto aktual, dan status
                        ketersediaan secara real-time.
                    </p>
                </div>
                <div
                    class="flex items-center text-[11px] font-semibold text-purple-600 dark:text-purple-400 tracking-wide uppercase">
                    Eksplorasi Barang →
                </div>
            </div>
            <!-- Vibrant Solid Purple Highlight -->
            <div
                class="rounded-2xl p-7 flex flex-col justify-between h-[230px] relative bg-gradient-to-br from-purple-600 via-purple-700 to-indigo-800 dark:from-[#5B21B6] dark:via-[#6D28D9] dark:to-[#4C1D95] shadow-md shadow-purple-500/25 dark:shadow-glow-md hover:shadow-lg dark:hover:shadow-glow-lg hover:-translate-y-1 transition duration-300 text-white group">
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <div
                            class="w-10 h-10 rounded-xl bg-white/20 flex items-center justify-center text-white border border-white/20">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5"
                                viewbox="0 0 24 24">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                        </div>
                        <span class="text-purple-200 group-hover:text-white transition-colors duration-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                                viewbox="0 0 24 24">
                                <line x1="7" x2="17" y1="17" y2="7"></line>
                                <polyline points="7 7 17 7 17 17"></polyline>
                            </svg>
                        </span>
                    </div>
                    <h3 class="text-lg font-bold text-white mb-2">Verifikasi Instan Admin</h3>
                    <p class="text-purple-100/90 text-xs leading-relaxed">
                        Otomasi persetujuan berjenjang dengan one-click approval via dashboard admin atau tautan cepat
                        aman tanpa login berulang.
                    </p>
                </div>
                <div class="flex items-center text-[11px] font-bold text-white/95 tracking-wide uppercase">
                    Lihat Alur Persetujuan →
                </div>
            </div>
            <div
                class="glass-card glass-card-hover rounded-2xl p-7 flex flex-col justify-between h-[230px] relative overflow-hidden group">
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <div
                            class="w-10 h-10 rounded-xl bg-purple-100 dark:bg-purple-500/10 border border-purple-200 dark:border-purple-500/20 flex items-center justify-center text-purple-700 dark:text-purple-400 group-hover:bg-purple-600 group-hover:text-white transition-colors duration-300">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                                viewbox="0 0 24 24">
                                <rect height="18" rx="2" width="18" x="3" y="3"></rect>
                                <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                <polyline points="21 15 16 10 5 21"></polyline>
                            </svg>
                        </div>
                        <span
                            class="text-slate-400 dark:text-slate-500 group-hover:text-purple-600 dark:group-hover:text-purple-300 transition-colors duration-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                                viewbox="0 0 24 24">
                                <line x1="7" x2="17" y1="17" y2="7"></line>
                                <polyline points="7 7 17 7 17 17"></polyline>
                            </svg>
                        </span>
                    </div>
                    <h3
                        class="text-lg font-bold text-slate-900 dark:text-white mb-2 group-hover:text-purple-600 dark:group-hover:text-purple-200 transition-colors">
                        Lacak Status &amp; Barcode</h3>
                    <p class="text-slate-600 dark:text-slate-400 text-xs leading-relaxed">
                        Pengecekan posisi dan pengguna barang lewat Barcode &amp; QR Code scan untuk proses serah terima
                        transparan.
                    </p>
                </div>
                <div
                    class="flex items-center text-[11px] font-semibold text-purple-600 dark:text-purple-400 tracking-wide uppercase">
                    Sistem QR Pintar →
                </div>
            </div>
            <div
                class="glass-card glass-card-hover rounded-2xl p-7 flex flex-col justify-between h-[230px] relative overflow-hidden group">
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <div
                            class="w-10 h-10 rounded-xl bg-purple-100 dark:bg-purple-500/10 border border-purple-200 dark:border-purple-500/20 flex items-center justify-center text-purple-700 dark:text-purple-400 group-hover:bg-purple-600 group-hover:text-white transition-colors duration-300">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                                viewbox="0 0 24 24">
                                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                            </svg>
                        </div>
                        <span
                            class="text-slate-400 dark:text-slate-500 group-hover:text-purple-600 dark:group-hover:text-purple-300 transition-colors duration-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                                viewbox="0 0 24 24">
                                <line x1="7" x2="17" y1="17" y2="7"></line>
                                <polyline points="7 7 17 7 17 17"></polyline>
                            </svg>
                        </span>
                    </div>
                    <h3
                        class="text-lg font-bold text-slate-900 dark:text-white mb-2 group-hover:text-purple-600 dark:group-hover:text-purple-200 transition-colors">
                        Notifikasi WhatsApp Otomatis</h3>
                    <p class="text-slate-600 dark:text-slate-400 text-xs leading-relaxed">
                        Pengingat tenggat waktu pengembalian otomatis via WhatsApp dan Email agar aset kembali aman dan
                        bebas denda.
                    </p>
                </div>
                <div
                    class="flex items-center text-[11px] font-semibold text-purple-600 dark:text-purple-400 tracking-wide uppercase">
                    Integrasi Notifikasi →
                </div>
            </div>
            <div
                class="glass-card glass-card-hover rounded-2xl p-7 flex flex-col justify-between h-[230px] relative overflow-hidden group">
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <div
                            class="w-10 h-10 rounded-xl bg-purple-100 dark:bg-purple-500/10 border border-purple-200 dark:border-purple-500/20 flex items-center justify-center text-purple-700 dark:text-purple-400 group-hover:bg-purple-600 group-hover:text-white transition-colors duration-300">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                                viewbox="0 0 24 24">
                                <circle cx="12" cy="12" r="10"></circle>
                                <polyline points="12 6 12 12 16 14"></polyline>
                            </svg>
                        </div>
                        <span
                            class="text-slate-400 dark:text-slate-500 group-hover:text-purple-600 dark:group-hover:text-purple-300 transition-colors duration-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                                viewbox="0 0 24 24">
                                <line x1="7" x2="17" y1="17" y2="7"></line>
                                <polyline points="7 7 17 7 17 17"></polyline>
                            </svg>
                        </span>
                    </div>
                    <h3
                        class="text-lg font-bold text-slate-900 dark:text-white mb-2 group-hover:text-purple-600 dark:group-hover:text-purple-200 transition-colors">
                        Riwayat &amp; Tanda Tangan</h3>
                    <p class="text-slate-600 dark:text-slate-400 text-xs leading-relaxed">
                        Catatan log peminjaman digital permanen lengkap dengan bukti serah terima foto dan tanda tangan
                        elektronik.
                    </p>
                </div>
                <div
                    class="flex items-center text-[11px] font-semibold text-purple-600 dark:text-purple-400 tracking-wide uppercase">
                    Pelajari Audit Log →
                </div>
            </div>
            <div
                class="glass-card glass-card-hover rounded-2xl p-7 flex flex-col justify-between h-[230px] relative overflow-hidden group">
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <div
                            class="w-10 h-10 rounded-xl bg-purple-100 dark:bg-purple-500/10 border border-purple-200 dark:border-purple-500/20 flex items-center justify-center text-purple-700 dark:text-purple-400 group-hover:bg-purple-600 group-hover:text-white transition-colors duration-300">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                                viewbox="0 0 24 24">
                                <rect height="11" rx="2" ry="2" width="18" x="3" y="11">
                                </rect>
                                <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                            </svg>
                        </div>
                        <span
                            class="text-slate-400 dark:text-slate-500 group-hover:text-purple-600 dark:group-hover:text-purple-300 transition-colors duration-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                                viewbox="0 0 24 24">
                                <line x1="7" x2="17" y1="17" y2="7"></line>
                                <polyline points="7 7 17 7 17 17"></polyline>
                            </svg>
                        </span>
                    </div>
                    <h3
                        class="text-lg font-bold text-slate-900 dark:text-white mb-2 group-hover:text-purple-600 dark:group-hover:text-purple-200 transition-colors">
                        Keamanan Multi-Role</h3>
                    <p class="text-slate-600 dark:text-slate-400 text-xs leading-relaxed">
                        Hak akses berjenjang untuk Peminjam, Staff Gudang, Kepala Laboratorium, dan Super Admin dengan
                        enkripsi enterprise.
                    </p>
                </div>
                <div
                    class="flex items-center text-[11px] font-semibold text-purple-600 dark:text-purple-400 tracking-wide uppercase">
                    Sistem Keamanan →
                </div>
            </div>
        </div>
    </section>
    <!-- END: FeatureGridSection -->
    <!-- BEGIN: SolutionsAndCatalogSection -->
    <section class="relative py-24 px-6 lg:px-12 bg-[#FAF8FF] dark:bg-[#050508] transition-colors duration-300"
        data-purpose="inventory-catalog" id="katalog">
        <div class="max-w-6xl mx-auto">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2
                    class="text-3xl md:text-4xl font-extrabold font-display tracking-tight text-slate-900 dark:text-white mb-4">
                    Real Impact. <span class="text-purple-600 dark:text-purple-400">Katalog &amp; Inventaris Siap
                        Pakai.</span>
                </h2>
                <p class="text-slate-600 dark:text-slate-400 text-sm md:text-base leading-relaxed">
                    Eksplorasi berbagai kategori peralatan dan perangkat yang siap dipinjam kapan saja dengan kondisi
                    terawat.
                </p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                <div
                    class="glass-card rounded-2xl p-6 border border-purple-100 dark:border-white/10 hover:border-purple-400 dark:hover:border-purple-500/40 transition duration-300 flex flex-col justify-between">
                    <div>
                        <div
                            class="inline-block px-2.5 py-1 rounded-md text-[10px] font-semibold uppercase tracking-wider bg-purple-100 dark:bg-purple-500/20 text-purple-700 dark:text-purple-300 border border-purple-200 dark:border-purple-500/30 mb-4">
                            Komputasi &amp; IT
                        </div>
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2">Elektronik &amp; Laptop</h3>
                        <p class="text-slate-600 dark:text-slate-400 text-xs leading-relaxed mb-4">
                            Peralatan komputasi untuk ujian, presentasi, event, dan riset praktikum harian.
                        </p>
                        <ul class="space-y-2 text-xs text-slate-600 dark:text-slate-300">
                            <li class="flex items-center gap-2">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 dark:bg-emerald-400"></span>
                                <span>MacBook Pro M2 &amp; ThinkPad L14 (24 Unit)</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 dark:bg-emerald-400"></span>
                                <span>iPad Air Lab Komputer (40 Unit)</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 dark:bg-emerald-400"></span>
                                <span>Proyektor Laser Epson 4K (8 Unit)</span>
                            </li>
                        </ul>
                    </div>
                    <div
                        class="mt-6 pt-4 border-t border-purple-100 dark:border-white/10 flex items-center justify-between text-xs">
                        <span class="text-slate-500 dark:text-slate-400">Total 72 Tersedia</span>
                        <a href="{{ route('katalog.inventaris') }}"
                            class="text-[11px] font-bold text-purple-600 dark:text-purple-400 hover:text-purple-700 dark:hover:text-purple-300 hover:translate-x-1 inline-block transition-all duration-300">Detail
                            →</a>
                    </div>
                </div>
                <div
                    class="glass-card rounded-2xl p-6 border border-purple-100 dark:border-white/10 hover:border-purple-400 dark:hover:border-purple-500/40 transition duration-300 flex flex-col justify-between">
                    <div>
                        <div
                            class="inline-block px-2.5 py-1 rounded-md text-[10px] font-semibold uppercase tracking-wider bg-indigo-100 dark:bg-indigo-500/20 text-indigo-700 dark:text-indigo-300 border border-indigo-200 dark:border-indigo-500/30 mb-4">
                            Broadcast &amp; Media
                        </div>
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2">Perlengkapan Multimedia</h3>
                        <p class="text-slate-600 dark:text-slate-400 text-xs leading-relaxed mb-4">
                            Perangkat audio-visual profesional untuk liputan acara, podcast, dan konten dokumentasi.
                        </p>
                        <ul class="space-y-2 text-xs text-slate-600 dark:text-slate-300">
                            <li class="flex items-center gap-2">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 dark:bg-emerald-400"></span>
                                <span>Sony Alpha A7 IV + Lensa GM (6 Kit)</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 dark:bg-emerald-400"></span>
                                <span>Wireless Mic RØDE Go II (12 Set)</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 dark:bg-emerald-400"></span>
                                <span>DJI Mini 3 Pro Drone &amp; Gimbal (4 Unit)</span>
                            </li>
                        </ul>
                    </div>
                    <div
                        class="mt-6 pt-4 border-t border-purple-100 dark:border-white/10 flex items-center justify-between text-xs">
                        <span class="text-slate-500 dark:text-slate-400">Total 22 Tersedia</span>
                        <a href="{{ route('katalog.inventaris') }}"
                            class="text-[11px] font-bold text-purple-600 dark:text-purple-400 hover:text-purple-700 dark:hover:text-purple-300 hover:translate-x-1 inline-block transition-all duration-300">Detail
                            →</a>
                    </div>
                </div>
                <div
                    class="glass-card rounded-2xl p-6 border border-purple-100 dark:border-white/10 hover:border-purple-400 dark:hover:border-purple-500/40 transition duration-300 flex flex-col justify-between">
                    <div>
                        <div
                            class="inline-block px-2.5 py-1 rounded-md text-[10px] font-semibold uppercase tracking-wider bg-violet-100 dark:bg-violet-500/20 text-violet-700 dark:text-violet-300 border border-violet-200 dark:border-violet-500/30 mb-4">
                            Ruang &amp; Riset
                        </div>
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2">Alat Kelas &amp; Laboratorium
                        </h3>
                        <p class="text-slate-600 dark:text-slate-400 text-xs leading-relaxed mb-4">
                            Instrumen laboratorium fisika/kimia, sensor IoT, serta audio portabel untuk kegiatan
                            lapangan.
                        </p>
                        <ul class="space-y-2 text-xs text-slate-600 dark:text-slate-300">
                            <li class="flex items-center gap-2">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 dark:bg-emerald-400"></span>
                                <span>Kit Mikrokontroler Arduino &amp; ESP32 (50 Kit)</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 dark:bg-emerald-400"></span>
                                <span>Mikroskop Digital Biologi HD (15 Unit)</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 dark:bg-emerald-400"></span>
                                <span>Portable Speaker JBL EON ONE (5 Unit)</span>
                            </li>
                        </ul>
                    </div>
                    <div
                        class="mt-6 pt-4 border-t border-purple-100 dark:border-white/10 flex items-center justify-between text-xs">
                        <span class="text-slate-500 dark:text-slate-400">Total 70 Tersedia</span>
                        <a href="{{ route('katalog.inventaris') }}"
                            class="text-[11px] font-bold text-purple-600 dark:text-purple-400 hover:text-purple-700 dark:hover:text-purple-300 hover:translate-x-1 inline-block transition-all duration-300">Detail
                            →</a>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <a href="{{ route('katalog.inventaris') }}"
                    class="btn-secondary-outline inline-flex items-center gap-2 px-8 py-3.5 rounded-full font-bold text-sm text-white border border-purple-400 dark:border-purple-500/30 bg-purple-600 dark:bg-purple-950/80 hover:bg-purple-700 dark:hover:bg-purple-900/60 shadow-sm transition duration-300">
                    Lihat Semua 250+ Inventaris →
                </a>
            </div>
        </div>
    </section>
    <!-- END: SolutionsAndCatalogSection -->

    <!-- BEGIN: WorkflowSection -->
    <section
        class="relative py-24 px-6 lg:px-12 bg-white dark:bg-[#07070d] border-t border-purple-100 dark:border-white/[0.06] transition-colors duration-300"
        data-purpose="workflow-guide" id="alur-kerja">
        <div class="max-w-6xl mx-auto">
            <!-- Header Section (Tengah) -->
            <div class="text-center max-w-2xl mx-auto mb-16">
                <div
                    class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-purple-100/90 dark:bg-purple-950/40 border border-purple-200 dark:border-purple-500/30 text-purple-700 dark:text-purple-300 text-xs font-bold uppercase tracking-wider mb-4 shadow-sm">
                    <span class="w-2 h-2 rounded-full bg-purple-600 dark:bg-purple-400 animate-pulse"></span>
                    <span>PANDUAN PENGGUNA</span>
                </div>
                <h2
                    class="text-3xl md:text-4xl font-extrabold font-display tracking-tight text-slate-900 dark:text-white mb-4">
                    Cara Mudah. <span class="text-purple-600 dark:text-purple-400">Pinjam &amp; Minta Barang.</span>
                </h2>
                <p class="text-slate-600 dark:text-slate-400 text-sm md:text-base leading-relaxed">
                    Ikuti 4 langkah praktis berikut untuk mengajukan peminjaman aset sekolah atau permintaan barang
                    habis pakai secara real-time.
                </p>
            </div>

            <!-- Grid 4 Langkah (Responsif 1 Kolom di HP & 4 Kolom di Desktop) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Langkah 01 -->
                <div
                    class="glass-card glass-card-hover rounded-2xl p-6 border border-purple-100 dark:border-white/10 hover:border-purple-500/50 transition-all duration-300 flex flex-col justify-between group">
                    <div>
                        <div class="flex items-center justify-between mb-5">
                            <span
                                class="inline-flex items-center px-2.5 py-1 rounded-md text-[10px] font-extrabold uppercase tracking-wider bg-purple-100 dark:bg-purple-500/20 text-purple-700 dark:text-purple-300 border border-purple-200 dark:border-purple-500/30">
                                STEP 01
                            </span>
                            <div
                                class="w-9 h-9 rounded-xl bg-purple-100 dark:bg-purple-500/10 border border-purple-200 dark:border-purple-500/20 flex items-center justify-center text-purple-700 dark:text-purple-300 group-hover:scale-105 transition-transform">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                </svg>
                            </div>
                        </div>
                        <h3
                            class="text-base sm:text-lg font-bold text-slate-900 dark:text-white mb-2 group-hover:text-purple-600 dark:group-hover:text-purple-300 transition-colors">
                            Pilih Jenis &amp; Barang
                        </h3>
                        <p class="text-slate-600 dark:text-slate-400 text-xs leading-relaxed">
                            Cek ketersediaan stok di katalog. Pada formulir, pilih mode <strong
                                class="text-purple-700 dark:text-purple-300 font-semibold">'Pinjam Aset'</strong>
                            (untuk alat yang dikembalikan) atau <strong
                                class="text-pink-700 dark:text-pink-300 font-semibold">'Minta Barang'</strong> (untuk
                            barang habis pakai).
                        </p>
                    </div>
                    <div
                        class="mt-6 pt-3 border-t border-purple-100 dark:border-white/10 flex items-center text-[11px] font-semibold text-purple-600 dark:text-purple-400">
                        <span>Langkah Pertama</span>
                    </div>
                </div>

                <!-- Langkah 02 -->
                <div
                    class="glass-card glass-card-hover rounded-2xl p-6 border border-purple-100 dark:border-white/10 hover:border-purple-500/50 transition-all duration-300 flex flex-col justify-between group">
                    <div>
                        <div class="flex items-center justify-between mb-5">
                            <span
                                class="inline-flex items-center px-2.5 py-1 rounded-md text-[10px] font-extrabold uppercase tracking-wider bg-purple-100 dark:bg-purple-500/20 text-purple-700 dark:text-purple-300 border border-purple-200 dark:border-purple-500/30">
                                STEP 02
                            </span>
                            <div
                                class="w-9 h-9 rounded-xl bg-purple-100 dark:bg-purple-500/10 border border-purple-200 dark:border-purple-500/20 flex items-center justify-center text-purple-700 dark:text-purple-300 group-hover:scale-105 transition-transform">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        </div>
                        <h3
                            class="text-base sm:text-lg font-bold text-slate-900 dark:text-white mb-2 group-hover:text-purple-600 dark:group-hover:text-purple-300 transition-colors">
                            Isi Formulir &amp; Durasi
                        </h3>
                        <p class="text-slate-600 dark:text-slate-400 text-xs leading-relaxed">
                            Lengkapi nama, nickname, dan nomor WhatsApp aktif. Tentukan tanggal peminjaman dan
                            pengembalian (khusus peminjaman aset) beserta keperluannya.
                        </p>
                    </div>
                    <div
                        class="mt-6 pt-3 border-t border-purple-100 dark:border-white/10 flex items-center text-[11px] font-semibold text-purple-600 dark:text-purple-400">
                        <span>Input Identitas &amp; Jadwal</span>
                    </div>
                </div>

                <!-- Langkah 03 -->
                <div
                    class="glass-card glass-card-hover rounded-2xl p-6 border border-purple-100 dark:border-white/10 hover:border-purple-500/50 transition-all duration-300 flex flex-col justify-between group">
                    <div>
                        <div class="flex items-center justify-between mb-5">
                            <span
                                class="inline-flex items-center px-2.5 py-1 rounded-md text-[10px] font-extrabold uppercase tracking-wider bg-purple-100 dark:bg-purple-500/20 text-purple-700 dark:text-purple-300 border border-purple-200 dark:border-purple-500/30">
                                STEP 03
                            </span>
                            <div
                                class="w-9 h-9 rounded-xl bg-purple-100 dark:bg-purple-500/10 border border-purple-200 dark:border-purple-500/20 flex items-center justify-center text-purple-700 dark:text-purple-300 group-hover:scale-105 transition-transform">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                </svg>
                            </div>
                        </div>
                        <h3
                            class="text-base sm:text-lg font-bold text-slate-900 dark:text-white mb-2 group-hover:text-purple-600 dark:group-hover:text-purple-300 transition-colors">
                            Simpan Kode &amp; Tunggu WA
                        </h3>
                        <p class="text-slate-600 dark:text-slate-400 text-xs leading-relaxed">
                            Setelah dikirim, salin Kode Resi (<code
                                class="font-mono text-purple-700 dark:text-purple-300 font-bold">#PJ-XXXXX</code>) yang
                            muncul. Sistem akan otomatis mengirim notifikasi ke WhatsApp Anda saat Admin menyetujui
                            pengajuan.
                        </p>
                    </div>
                    <div
                        class="mt-6 pt-3 border-t border-purple-100 dark:border-white/10 flex items-center text-[11px] font-semibold text-purple-600 dark:text-purple-400">
                        <span>Notifikasi Real-Time</span>
                    </div>
                </div>

                <!-- Langkah 04 -->
                <div
                    class="glass-card glass-card-hover rounded-2xl p-6 border border-purple-100 dark:border-white/10 hover:border-purple-500/50 transition-all duration-300 flex flex-col justify-between group">
                    <div>
                        <div class="flex items-center justify-between mb-5">
                            <span
                                class="inline-flex items-center px-2.5 py-1 rounded-md text-[10px] font-extrabold uppercase tracking-wider bg-purple-100 dark:bg-purple-500/20 text-purple-700 dark:text-purple-300 border border-purple-200 dark:border-purple-500/30">
                                STEP 04
                            </span>
                            <div
                                class="w-9 h-9 rounded-xl bg-purple-100 dark:bg-purple-500/10 border border-purple-200 dark:border-purple-500/20 flex items-center justify-center text-purple-700 dark:text-purple-300 group-hover:scale-105 transition-transform">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                            </div>
                        </div>
                        <h3
                            class="text-base sm:text-lg font-bold text-slate-900 dark:text-white mb-2 group-hover:text-purple-600 dark:group-hover:text-purple-300 transition-colors">
                            Ambil &amp; Kembalikan Tepat Waktu
                        </h3>
                        <p class="text-slate-600 dark:text-slate-400 text-xs leading-relaxed">
                            Tunjukkan kode resi atau pesan WA ke petugas Ruang Sarpras untuk mengambil barang.
                            Kembalikan aset sesuai jadwal agar status berubah menjadi selesai.
                        </p>
                    </div>
                    <div
                        class="mt-6 pt-3 border-t border-purple-100 dark:border-white/10 flex items-center text-[11px] font-semibold text-purple-600 dark:text-purple-400">
                        <span>Serah Terima &amp; Selesai</span>
                    </div>
                </div>
            </div>

            <!-- Kotak Tips Cepat di Bawah Grid (Info Banner) -->
            <div
                class="mt-8 p-4 sm:p-5 rounded-2xl bg-purple-50/80 dark:bg-[#121124] border border-purple-200 dark:border-purple-500/30 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs shadow-sm transition-colors duration-300">
                <div class="flex items-start sm:items-center gap-3 text-slate-700 dark:text-slate-300">
                    <span class="text-2xl shrink-0">💡</span>
                    <div class="leading-relaxed">
                        <strong class="font-bold text-slate-900 dark:text-white">Info Penting:</strong>
                        <span><strong class="text-purple-700 dark:text-purple-300 font-semibold">'Pinjam Aset'</strong>
                            wajib mencantumkan tanggal pengembalian, sedangkan <strong
                                class="text-pink-700 dark:text-pink-300 font-semibold">'Minta Barang Habis
                                Pakai'</strong> tidak memerlukan tanggal pengembalian.</span>
                    </div>
                </div>
                <a href="#ajukan"
                    class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-xs font-bold text-white bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-500 hover:to-indigo-500 shadow-md shadow-purple-600/30 transition shrink-0 transform hover:-translate-y-0.5">
                    <span>Mulai Ajukan</span> &rarr;
                </a>
            </div>
        </div>
    </section>
    <!-- END: WorkflowSection -->
    <!-- BEGIN: BorrowingFormSection -->
    <section id="ajukan"
        class="py-24 px-6 lg:px-12 border-t border-purple-100 dark:border-white/[0.06] bg-white dark:bg-[#030305] relative overflow-hidden transition-colors duration-300">
        <div
            class="absolute inset-0 bg-[radial-gradient(circle_at_bottom,_var(--tw-gradient-stops))] from-purple-100/50 dark:from-purple-900/10 via-transparent to-transparent pointer-events-none">
        </div>
        <div class="max-w-4xl mx-auto relative z-10">
            <div class="text-center mb-12">
                <h2
                    class="text-3xl md:text-4xl font-extrabold font-display tracking-tight text-slate-900 dark:text-white mb-4">
                    Formulir <span class="text-purple-600 dark:text-purple-400">Peminjaman Aset</span>
                </h2>
                <p class="text-slate-600 dark:text-slate-400 text-sm md:text-base">Lengkapi data diri dan detail barang
                    yang ingin dipinjam. Permohonan akan langsung masuk ke Dashboard Admin.</p>
            </div>

            <!-- Notifikasi Sukses Jika Berhasil Disubmit -->
            @if (session('success'))
                <div id="success-alert"
                    class="mb-8 p-5 rounded-2xl bg-emerald-500/20 border border-emerald-500/40 text-emerald-800 dark:text-emerald-300 text-center font-semibold text-sm shadow-[0_0_30px_rgba(16,185,129,0.2)] animate-pulse">
                    ✨ Success! Request successfully sent. Please wait a moment, your request is being processed to the
                    Admin Dashboard...
                </div>
            @endif

            <!-- The Form dengan Loading State JavaScript -->
            <form action="{{ route('pinjam.store') }}" method="POST" id="loanForm"
                class="glass-card rounded-3xl p-8 md:p-12 border border-purple-100 dark:border-white/10 shadow-xl shadow-purple-100/70 dark:shadow-2xl relative z-20">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">
                    <!-- Nama Lengkap -->
                    <div class="flex flex-col space-y-2">
                        <label
                            class="text-xs font-semibold text-slate-700 dark:text-slate-300 uppercase tracking-wider">Nama
                            Lengkap</label>
                        <input type="text" name="nama" required placeholder="Masukkan nama lengkap Anda"
                            class="w-full px-4 py-3.5 rounded-xl text-sm focus:ring-2 focus:ring-purple-400 focus:border-purple-500 bg-purple-50/40 dark:bg-white/[0.03] border border-purple-200 dark:border-white/10 text-slate-800 dark:text-white placeholder:text-slate-400 dark:placeholder:text-slate-500 transition-colors">
                    </div>

                    <!-- Nickname -->
                    <div class="flex flex-col space-y-2">
                        <label
                            class="text-xs font-semibold text-slate-700 dark:text-slate-300 uppercase tracking-wider">Nickname
                            / Panggilan</label>
                        <input type="text" name="nickname" required placeholder="Nama panggilan"
                            class="w-full px-4 py-3.5 rounded-xl text-sm focus:ring-2 focus:ring-purple-400 focus:border-purple-500 bg-purple-50/40 dark:bg-white/[0.03] border border-purple-200 dark:border-white/10 text-slate-800 dark:text-white placeholder:text-slate-400 dark:placeholder:text-slate-500 transition-colors">
                    </div>

                    <!-- WhatsApp -->
                    <div class="flex flex-col space-y-2">
                        <label
                            class="text-xs font-semibold text-slate-700 dark:text-slate-300 uppercase tracking-wider">Kontak
                            WhatsApp</label>
                        <input type="text" name="whatsapp" required placeholder="Contoh: 081234567890"
                            class="w-full px-4 py-3.5 rounded-xl text-sm focus:ring-2 focus:ring-purple-400 focus:border-purple-500 bg-purple-50/40 dark:bg-white/[0.03] border border-purple-200 dark:border-white/10 text-slate-800 dark:text-white placeholder:text-slate-400 dark:placeholder:text-slate-500 transition-colors">
                    </div>

                    <!-- Email -->
                    <div class="flex flex-col space-y-2">
                        <label
                            class="text-xs font-semibold text-slate-700 dark:text-slate-300 uppercase tracking-wider">Alamat
                            Email</label>
                        <input type="email" name="email" required placeholder="email@contoh.com"
                            class="w-full px-4 py-3.5 rounded-xl text-sm focus:ring-2 focus:ring-purple-400 focus:border-purple-500 bg-purple-50/40 dark:bg-white/[0.03] border border-purple-200 dark:border-white/10 text-slate-800 dark:text-white placeholder:text-slate-400 dark:placeholder:text-slate-500 transition-colors">
                    </div>

                    <!-- Jenis Pengajuan -->
                    <div class="flex flex-col space-y-2 mb-2">
                        <label
                            class="text-xs font-semibold text-slate-700 dark:text-slate-300 uppercase tracking-wider">Jenis
                            Pengajuan</label>
                        <div class="grid grid-cols-2 gap-3">
                            <label class="relative cursor-pointer group">
                                <input type="radio" name="request_type_welcome" value="pinjam"
                                    class="peer sr-only" checked onchange="toggleWelcomeType()">
                                <div
                                    class="p-3 rounded-xl border border-purple-200 dark:border-white/10 bg-purple-50/50 dark:bg-white/[0.03] peer-checked:border-purple-500 peer-checked:bg-purple-100 dark:peer-checked:bg-purple-500/20 transition-all text-center">
                                    <span
                                        class="block text-sm font-bold text-slate-600 dark:text-slate-400 peer-checked:text-purple-700 dark:peer-checked:text-purple-300">Pinjam
                                        Aset</span>
                                </div>
                            </label>
                            <label class="relative cursor-pointer group">
                                <input type="radio" name="request_type_welcome" value="minta"
                                    class="peer sr-only" onchange="toggleWelcomeType()">
                                <div
                                    class="p-3 rounded-xl border border-purple-200 dark:border-white/10 bg-purple-50/50 dark:bg-white/[0.03] peer-checked:border-pink-500 peer-checked:bg-pink-100 dark:peer-checked:bg-pink-500/20 transition-all text-center">
                                    <span
                                        class="block text-sm font-bold text-slate-600 dark:text-slate-400 peer-checked:text-pink-700 dark:peer-checked:text-pink-300">Minta
                                        Barang</span>
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- Tanggal Peminjaman (Bisa Diatur & Diklik) -->
                    <div class="flex flex-col space-y-2">
                        <label
                            class="text-xs font-semibold text-slate-700 dark:text-slate-300 uppercase tracking-wider">Tanggal
                            &amp; Durasi Pinjam</label>
                        <div class="flex items-center gap-3">
                            <input type="date" name="tanggal_pinjam" required
                                class="w-full px-4 py-3.5 rounded-xl text-sm focus:ring-2 focus:ring-purple-400 focus:border-purple-500 bg-purple-50/40 dark:bg-white/[0.03] border border-purple-200 dark:border-white/10 text-slate-800 dark:text-white cursor-pointer transition-colors">
                            <div id="welcome_return_date_wrapper" class="flex items-center gap-3 w-full">
                                <span class="text-slate-400">s/d</span>
                                <input type="date" id="welcome_tanggal_kembali" name="tanggal_kembali" required
                                    class="w-full px-4 py-3.5 rounded-xl text-sm focus:ring-2 focus:ring-purple-400 focus:border-purple-500 bg-purple-50/40 dark:bg-white/[0.03] border border-purple-200 dark:border-white/10 text-slate-800 dark:text-white cursor-pointer transition-colors">
                            </div>
                        </div>
                    </div>

                    <!-- Pilih Barang -->
                    <div class="flex flex-col space-y-2">
                        <label
                            class="text-xs font-semibold text-slate-700 dark:text-slate-300 uppercase tracking-wider">Pilih
                            Barang yang Dipinjam</label>
                        <select id="welcome_barang_id" name="barang_id" required
                            class="w-full px-4 py-3.5 rounded-xl text-sm focus:ring-2 focus:ring-purple-400 focus:border-purple-500 bg-white dark:bg-[#0B0B14] border border-purple-200 dark:border-white/10 text-slate-800 dark:text-white transition-colors">
                            <option value="" disabled selected>Pilih dari aset/inventaris...</option>
                        </select>
                    </div>
                </div>

                <!-- Keterangan -->
                <div class="flex flex-col space-y-2 mb-10">
                    <label
                        class="text-xs font-semibold text-slate-700 dark:text-slate-300 uppercase tracking-wider">Keterangan
                        / Keperluan</label>
                    <textarea name="keterangan" rows="3" placeholder="Jelaskan secara singkat keperluan peminjaman aset ini..."
                        class="w-full px-4 py-3.5 rounded-xl text-sm focus:ring-2 focus:ring-purple-400 focus:border-purple-500 bg-purple-50/40 dark:bg-white/[0.03] border border-purple-200 dark:border-white/10 text-slate-800 dark:text-white placeholder:text-slate-400 dark:placeholder:text-slate-500 resize-none transition-colors"></textarea>
                </div>

                <!-- Tombol Submit dengan Efek Loading -->
                <button type="submit" id="submitBtn"
                    class="w-full py-4 rounded-xl font-bold text-white bg-gradient-to-r from-purple-600 via-purple-500 to-indigo-600 shadow-md shadow-purple-500/25 dark:shadow-glow-sm hover:shadow-lg dark:hover:shadow-glow-md hover:scale-[1.01] active:scale-95 transition-all duration-300 cursor-pointer flex items-center justify-center gap-2">
                    <span id="btnText">Kirim Permohonan Peminjaman</span>
                    <svg id="btnLoader" class="hidden animate-spin h-5 w-5 text-white"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                            stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor"
                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                        </path>
                    </svg>
                </button>
            </form>

            <!-- Script JavaScript untuk Efek Loading pas Disubmit -->
            <script>
                document.getElementById('loanForm').addEventListener('submit', function() {
                    const btn = document.getElementById('submitBtn');
                    const btnText = document.getElementById('btnText');
                    const btnLoader = document.getElementById('btnLoader');

                    btn.disabled = true;
                    btn.classList.add('opacity-75', 'cursor-not-allowed');
                    btnText.innerText = "Sending request, please wait...";
                    btnLoader.classList.remove('hidden');
                });

                const welcomeItems = @json(\App\Models\Item::all());

                function toggleWelcomeType() {
                    const isMinta = document.querySelector('input[name="request_type_welcome"]:checked').value === 'minta';
                    const select = document.getElementById('welcome_barang_id');

                    select.innerHTML = '<option value="" disabled selected>Pilih dari aset/inventaris...</option>';

                    welcomeItems.forEach(item => {
                        const isConsumable = item.is_consumable ? true : false;
                        if (isMinta === isConsumable) {
                            const option = document.createElement('option');
                            option.value = item.id;
                            option.textContent = `${item.name} (Stok: ${item.available_stock})`;
                            select.appendChild(option);
                        }
                    });

                    const wrapper = document.getElementById('welcome_return_date_wrapper');
                    const returnInput = document.getElementById('welcome_tanggal_kembali');
                    if (isMinta) {
                        wrapper.style.display = 'none';
                        returnInput.removeAttribute('required');
                        returnInput.value = '';
                    } else {
                        wrapper.style.display = 'flex';
                        returnInput.setAttribute('required', 'required');
                    }
                }

                document.addEventListener('DOMContentLoaded', toggleWelcomeType);
            </script>
        </div>
    </section>
    <!-- END: BorrowingFormSection -->

    <!-- BEGIN: SocialProofSection -->
    <section
        class="py-20 px-6 lg:px-12 border-t border-purple-100 dark:border-white/[0.06] bg-[#FAF8FF] dark:bg-[#080811] transition-colors duration-300"
        data-purpose="social-proof" id="bantuan">
        <div class="max-w-6xl mx-auto text-center">
            <p class="text-xs font-semibold text-purple-600 dark:text-purple-400 uppercase tracking-widest mb-3">
                Dipercaya Komunitas Edukasi &amp; Korporasi</p>
            <h2 class="text-2xl md:text-3xl font-extrabold font-display text-slate-900 dark:text-white mb-10">
                Digunakan oleh 40+ Sekolah Unggulan &amp; Perusahaan
            </h2>
            <div class="flex flex-wrap items-center justify-center gap-6 md:gap-10 opacity-90">
                <div
                    class="flex items-center gap-3 px-4 py-2 rounded-xl bg-white dark:bg-white/[0.03] border border-purple-100 dark:border-white/10 shadow-sm shadow-purple-100/50">
                    <div
                        class="w-9 h-9 rounded-full bg-gradient-to-tr from-purple-500 to-indigo-400 flex items-center justify-center text-xs font-bold text-white">
                        SMK
                    </div>
                    <div class="text-left">
                        <p class="text-xs font-bold text-slate-800 dark:text-white">SMK Telkom Sandhy</p>
                        <p class="text-[10px] text-slate-500 dark:text-slate-400">1,420+ Aset Terkelola</p>
                    </div>
                </div>
                <div
                    class="flex items-center gap-3 px-4 py-2 rounded-xl bg-white dark:bg-white/[0.03] border border-purple-100 dark:border-white/10 shadow-sm shadow-purple-100/50">
                    <div
                        class="w-9 h-9 rounded-full bg-gradient-to-tr from-indigo-500 to-blue-400 flex items-center justify-center text-xs font-bold text-white">
                        UI
                    </div>
                    <div class="text-left">
                        <p class="text-xs font-bold text-slate-800 dark:text-white">Lab Riset Elektro</p>
                        <p class="text-[10px] text-slate-500 dark:text-slate-400">920+ Transaksi Sukses</p>
                    </div>
                </div>
                <div
                    class="flex items-center gap-3 px-4 py-2 rounded-xl bg-white dark:bg-white/[0.03] border border-purple-100 dark:border-white/10 shadow-sm shadow-purple-100/50">
                    <div
                        class="w-9 h-9 rounded-full bg-gradient-to-tr from-fuchsia-500 to-purple-500 flex items-center justify-center text-xs font-bold text-white">
                        NT
                    </div>
                    <div class="text-left">
                        <p class="text-xs font-bold text-slate-800 dark:text-white">Nusantara Tech Hub</p>
                        <p class="text-[10px] text-slate-500 dark:text-slate-400">100% Zero-Loss Aset</p>
                    </div>
                </div>
                <div
                    class="flex items-center gap-3 px-4 py-2 rounded-xl bg-white dark:bg-white/[0.03] border border-purple-100 dark:border-white/10 shadow-sm shadow-purple-100/50">
                    <div
                        class="w-9 h-9 rounded-full bg-gradient-to-tr from-violet-600 to-purple-400 flex items-center justify-center text-xs font-bold text-white">
                        SMA
                    </div>
                    <div class="text-left">
                        <p class="text-xs font-bold text-slate-800 dark:text-white">SMA Unggulan 1</p>
                        <p class="text-[10px] text-slate-500 dark:text-slate-400">Audit Berkala Otomatis</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END: SocialProofSection -->
    <!-- BEGIN: MainFooter -->
    <footer
        class="bg-white dark:bg-[#030305] border-t border-purple-100 dark:border-white/[0.08] text-slate-500 dark:text-slate-400 text-xs py-12 px-6 lg:px-12 transition-colors duration-300"
        data-purpose="site-footer">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between gap-6">
            <div class="flex items-center gap-3">
                <span
                    class="text-lg font-bold font-display tracking-tight text-slate-900 dark:text-white">PinjamBarang<span
                        class="text-purple-600 dark:text-purple-400">.</span></span>
                <span class="text-slate-300 dark:text-slate-600">|</span>
                <span>© 2026 PinjamBarang SaaS. Seluruh Hak Cipta Dilindungi.</span>
            </div>
            <div class="flex items-center gap-6">
                <a class="hover:text-purple-600 dark:hover:text-purple-300 transition-colors"
                    href="#kebijakan">Kebijakan Privasi</a>
                <a class="hover:text-purple-600 dark:hover:text-purple-300 transition-colors" href="#syarat">Syarat
                    &amp; Ketentuan</a>
                <a class="hover:text-purple-600 dark:hover:text-purple-300 transition-colors"
                    href="#keamanan">Protokol Keamanan</a>
                <a class="hover:text-purple-600 dark:hover:text-purple-300 transition-colors" href="#kontak">Hubungi
                    Admin</a>
            </div>
            <div
                class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-purple-50 dark:bg-white/[0.03] border border-purple-200/80 dark:border-white/10 text-[11px] text-slate-700 dark:text-slate-300">
                <span class="w-2 h-2 rounded-full bg-emerald-500 dark:bg-emerald-400 animate-pulse"></span>
                <span>Semua Sistem Operasional</span>
            </div>
        </div>
    </footer>
    <!-- END: MainFooter -->
    <!-- Interactive Scroll Behavior Script -->
    <script data-purpose="navigation-interactivity">
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                const targetId = this.getAttribute('href');
                if (targetId && targetId !== '#') {
                    const targetElem = document.querySelector(targetId);
                    if (targetElem) {
                        e.preventDefault();
                        targetElem.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                }
            });
        });
    </script>

    <!-- Easter Egg: Secret Admin Login (3x Cepat) -->
    <script>
        let clickCount = 0;
        let clickTimer;

        function secretAdminLogin() {
            clickCount++;
            clearTimeout(clickTimer);

            // Reset hitungan jika tidak diklik lagi dalam 2 detik
            clickTimer = setTimeout(() => {
                clickCount = 0;
            }, 2000);

            // Jika diklik 3 kali berturut-turut, arahkan ke halaman login
            // Jika diklik 3 kali berturut-turut, arahkan ke pintu rahasia portal admin (auto-reset sesi & paksa form login)
            if (clickCount === 3) {
                window.location.href = "{{ route('login') }}";
                window.location.href = "{{ route('admin.portal') }}";
            }
        }
    </script>
</body>

</html>
