@props(['size' => 'md', 'showLabel' => false])

@php
    $sizeClasses = [
        'sm' => 'p-2 rounded-xl text-xs gap-1.5',
        'md' => 'p-2 sm:p-2.5 rounded-2xl text-sm gap-2',
        'lg' => 'p-3 rounded-2xl text-base gap-2.5',
    ][$size] ?? 'p-2 sm:p-2.5 rounded-2xl text-sm gap-2';

    $iconSizes = [
        'sm' => 'w-4 h-4',
        'md' => 'w-4 h-4 sm:w-5 sm:h-5',
        'lg' => 'w-5 h-5 sm:w-6 sm:h-6',
    ][$size] ?? 'w-4 h-4 sm:w-5 sm:h-5';
@endphp

<button
    type="button"
    onclick="toggleTheme()"
    x-data="{ isLight: document.documentElement.classList.contains('light-mode') || (!document.documentElement.classList.contains('dark') && localStorage.getItem('theme') === 'light') }"
    @theme-changed.window="isLight = ($event.detail === 'light')"
    :title="isLight ? 'Beralih ke Dark Mode (Mode Gelap)' : 'Beralih ke Light Mode (Mode Terang)'"
    aria-label="Toggle Dark / Light Mode"
    {{ $attributes->merge(['class' => "theme-toggle-btn group relative inline-flex items-center justify-center {$sizeClasses} font-semibold transition-all duration-300 transform hover:scale-105 active:scale-95 focus:outline-none focus:ring-2 focus:ring-purple-400/50 cursor-pointer"]) }}
>
    <!-- Sun Icon ☀️ (Ditampilkan saat Dark Mode -> Diklik untuk berganti ke Light Mode) -->
    <svg 
        class="theme-icon-sun {{ $iconSizes }} transform transition-transform duration-300 group-hover:rotate-45 text-amber-400 group-hover:text-amber-300 filter drop-shadow-[0_0_6px_rgba(251,191,36,0.6)]"
        fill="currentColor"
        viewBox="0 0 24 24"
    >
        <circle cx="12" cy="12" r="4.5" />
        <path stroke="currentColor" stroke-width="2.2" stroke-linecap="round" d="M12 2v2.5M12 19.5V22M4.93 4.93l1.77 1.77M17.3 17.3l1.77 1.77M2 12h2.5M19.5 12H22M6.7 17.3l-1.77 1.77M19.07 4.93l-1.77 1.77" />
    </svg>

    <!-- Moon Icon 🌙 (Ditampilkan saat Light Mode -> Diklik untuk berganti ke Dark Mode) -->
    <svg 
        class="theme-icon-moon {{ $iconSizes }} transform transition-transform duration-300 group-hover:-rotate-12 text-purple-700 group-hover:text-purple-900 filter drop-shadow-[0_0_6px_rgba(124,58,237,0.3)]"
        fill="currentColor" 
        viewBox="0 0 24 24"
    >
        <path d="M21.64 13a1 1 0 0 0-1.05-.14 8.049 8.049 0 0 1-3.37.73 8.15 8.15 0 0 1-8.14-8.14 8.049 8.049 0 0 1 .73-3.37 1 1 0 0 0-.91-1.39 9 9 0 0 0-.25 0 10 10 0 1 0 13.13 13.13 1 1 0 0 0-.14-.82z"/>
    </svg>

    @if($showLabel)
        <span class="text-xs font-semibold theme-label-dark">Mode Terang</span>
        <span class="text-xs font-semibold theme-label-light">Mode Gelap</span>
    @endif
</button>
