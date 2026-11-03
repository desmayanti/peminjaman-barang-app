<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        @if(request()->isSecure())
            <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
        @endif
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'PinjamBarang') }} &mdash; Panel Administrasi</title>

        <!-- Smart Theme Override & Anti-FOUC Engine -->
        <x-smart-theme-override />

        <!-- Google Fonts: Plus Jakarta Sans & Space Grotesk -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Space+Grotesk:wght@500;600;700&family=JetBrains+Mono:wght@500;700&display=swap" rel="stylesheet" />

        <!-- Tailwind CSS & Vite Scripts -->
        <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
        <script>
            tailwind.config = {
                darkMode: 'class',
                theme: {
                    extend: {
                        fontFamily: {
                            sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                            display: ['"Space Grotesk"', 'sans-serif'],
                            mono: ['"JetBrains Mono"', 'monospace'],
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
                                pitch: '#07070d',
                                card: '#0e0e1a',
                                border: 'rgba(255, 255, 255, 0.08)',
                                purple: '#7C3AED',
                                indigo: '#6366F1',
                                accent: '#A78BFA',
                            }
                        }
                    }
                }
            }
        </script>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <style>
            body {
                background-color: #FAF8FF;
                color: #0f172a;
                font-family: 'Plus Jakarta Sans', sans-serif;
                transition: background-color 0.3s ease, color 0.3s ease;
            }
            html.dark body {
                background-color: #07070d;
                color: #f1f5f9;
            }
            .font-display { font-family: 'Space Grotesk', sans-serif; }
            .font-mono { font-family: 'JetBrains Mono', monospace; }
        </style>
    </head>
    <body class="font-sans antialiased bg-[#FAF8FF] dark:bg-[#07070d] text-slate-800 dark:text-slate-100 min-h-screen relative selection:bg-purple-500 selection:text-white overflow-x-hidden transition-colors duration-300">
        
        <!-- Ambient Background Glows -->
        <div class="fixed top-0 left-1/4 -translate-x-1/2 w-[700px] h-[350px] bg-purple-200/40 dark:bg-purple-600/10 blur-[140px] rounded-full pointer-events-none -z-10 transition-colors duration-500"></div>
        <div class="fixed top-1/3 right-10 w-[550px] h-[350px] bg-indigo-100/40 dark:bg-indigo-600/10 blur-[150px] rounded-full pointer-events-none -z-10 transition-colors duration-500"></div>
        <div class="fixed bottom-10 left-1/3 w-[600px] h-[300px] bg-violet-100/40 dark:bg-violet-900/10 blur-[130px] rounded-full pointer-events-none -z-10 transition-colors duration-500"></div>

        <div class="min-h-screen flex flex-col">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white/95 dark:bg-[#0c0c16]/95 border-b border-purple-100 dark:border-white/[0.06] shadow-sm shadow-purple-100/50 dark:shadow-lg dark:shadow-black/20 relative z-10 transition-colors duration-300">
                    <div class="max-w-7xl mx-auto py-5 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="flex-grow">
                {{ $slot }}
            </main>

            <!-- Admin Footer -->
            <footer class="py-6 border-t border-purple-100 dark:border-white/[0.05] bg-white/80 dark:bg-[#07070d]/80 text-center text-xs text-slate-500 dark:text-slate-400 transition-colors duration-300">
                <div class="max-w-7xl mx-auto px-4 flex flex-col sm:flex-row items-center justify-between gap-2">
                    <div class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 dark:bg-emerald-400 animate-pulse"></span>
                        <span>Panel Administrasi PinjamBarang &bull; v2.0 Modern Asset Hub</span>
                    </div>
                    <div class="flex items-center gap-4">
                        <a href="{{ route('home') }}" target="_blank" class="hover:text-purple-600 dark:hover:text-purple-400 font-medium transition-colors">Lihat Halaman Publik &rarr;</a>
                    </div>
                </div>
            </footer>
        </div>
    </body>
</html>
