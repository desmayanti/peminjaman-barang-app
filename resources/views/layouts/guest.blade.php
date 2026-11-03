<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    @if (request()->isSecure())
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    @endif
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'PinjamBarang') }}</title>

    <!-- Smart Theme Override & Anti-FOUC Engine -->
    <x-smart-theme-override />

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Space+Grotesk:wght@600;700&display=swap"
        rel="stylesheet" />

    <!-- Tailwind CDN & Scripts -->
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                        display: ['"Space Grotesk"', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body
    class="font-sans text-slate-800 dark:text-slate-100 antialiased bg-[#FAF8FF] dark:bg-[#07070d] min-h-screen selection:bg-purple-500 selection:text-white transition-colors duration-300 relative overflow-x-hidden">

    <!-- Ambient Glow -->
    <div
        class="fixed top-0 left-1/2 -translate-x-1/2 w-[600px] h-[300px] bg-purple-200/40 dark:bg-purple-600/10 blur-[130px] rounded-full pointer-events-none -z-10">
    </div>

    <!-- Top Corner Switcher & Back Link -->
    <div class="absolute top-5 right-5 z-20 flex items-center gap-3">
        <x-theme-toggle size="md" />
        <a href="{{ route('home') }}"
            class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl text-xs font-semibold text-slate-600 dark:text-slate-300 hover:text-purple-700 dark:hover:text-white bg-white/80 dark:bg-white/[0.05] border border-purple-200/80 dark:border-white/10 shadow-sm transition">
            <span>&larr; Beranda</span>
        </a>
    </div>

    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-8 sm:pt-0 px-4">
        <div class="mb-6">
            <a href="/" class="flex flex-col items-center gap-2 group">
                <div
                    class="w-12 h-12 rounded-2xl bg-gradient-to-tr from-purple-600 to-indigo-500 flex items-center justify-center text-white shadow-lg shadow-purple-500/30 group-hover:scale-105 transition-transform">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                </div>
                <span
                    class="text-xl font-extrabold tracking-tight text-slate-900 dark:text-white font-display">Pinjam<span
                        class="text-purple-600 dark:text-purple-400">Barang.</span></span>
            </a>
        </div>

        <div
            class="w-full sm:max-w-md px-6 py-8 bg-white dark:bg-[#0e0e1a] border border-purple-100 dark:border-white/[0.08] shadow-xl shadow-purple-200/50 dark:shadow-2xl overflow-hidden rounded-3xl relative backdrop-blur-xl transition-colors duration-300">
            {{ $slot }}
        </div>
    </div>
</body>

</html>
