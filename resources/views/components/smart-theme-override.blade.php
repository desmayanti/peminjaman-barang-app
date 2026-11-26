<!-- Smart Theme Override & Anti-FOUC Engine -->
<script>
    (function() {
        try {
            const savedTheme = localStorage.getItem('theme');
            if (savedTheme === 'light') {
                document.documentElement.classList.add('light-mode');
                document.documentElement.classList.remove('dark');
            } else {
                // Default to dark mode if no saved preference or if 'dark'
                document.documentElement.classList.remove('light-mode');
                document.documentElement.classList.add('dark');
            }
        } catch (e) {
            document.documentElement.classList.add('dark');
        }
    })();

    if (typeof window.toggleTheme !== 'function') {
        window.toggleTheme = function() {
            const isLight = document.documentElement.classList.contains('light-mode') ||
                (!document.documentElement.classList.contains('dark') && localStorage.getItem('theme') === 'light');
            if (isLight) {
                // Beralih ke Dark Mode (Default)
                document.documentElement.classList.remove('light-mode');
                if (document.body) document.body.classList.remove('light-mode');
                document.documentElement.classList.add('dark');
                localStorage.setItem('theme', 'dark');
                window.dispatchEvent(new CustomEvent('theme-changed', {
                    detail: 'dark'
                }));
            } else {
                // Beralih ke Light Mode
                document.documentElement.classList.add('light-mode');
                if (document.body) document.body.classList.add('light-mode');
                document.documentElement.classList.remove('dark');
                localStorage.setItem('theme', 'light');
                window.dispatchEvent(new CustomEvent('theme-changed', {
                    detail: 'light'
                }));
            }
        };
    }

    document.addEventListener('DOMContentLoaded', function() {
        try {
            if (localStorage.getItem('theme') === 'light') {
                document.documentElement.classList.add('light-mode');
                if (document.body) document.body.classList.add('light-mode');
                document.documentElement.classList.remove('dark');
            } else {
                document.documentElement.classList.remove('light-mode');
                if (document.body) document.body.classList.remove('light-mode');
                document.documentElement.classList.add('dark');
            }
        } catch (e) {}
    });
</script>

<style id="smart-theme-override-styles">
    /* ==========================================================================
       SMART LIGHT MODE OVERRIDE ENGINE
       Activates whenever <html> or <body> has .light-mode class.
       Seamlessly converts hardcoded dark styles into clean, high-contrast light mode
       while preserving glowing purple/indigo accents and status badges.
       ========================================================================== */

    html.light-mode,
    body.light-mode,
    .light-mode {
        color-scheme: light !important;
    }

    /* 1. Global Page Background & Base Text */
    html.light-mode,
    html.light-mode body,
    body.light-mode {
        background-color: #F8FAFC !important;
        background-image: none !important;
        color: #0F172A !important;
    }

    /* 2. Container & Section Background Overrides */
    html.light-mode main,
    html.light-mode section,
    html.light-mode div.min-h-screen,
    body.light-mode main,
    body.light-mode section,
    body.light-mode div.min-h-screen {
        background-color: #F8FAFC;
    }

    /* Override hardcoded dark hex backgrounds */
    html.light-mode .bg-\[\#030305\],
    html.light-mode .bg-\[\#050508\],
    html.light-mode .bg-\[\#07070d\],
    html.light-mode .bg-\[\#080811\],
    html.light-mode .bg-\[\#090913\],
    html.light-mode .bg-\[\#0b0b14\],
    html.light-mode .bg-\[\#0c0c16\],
    html.light-mode .bg-\[\#0c0c17\],
    html.light-mode .bg-\[\#0e0e1a\],
    html.light-mode .bg-\[\#111022\],
    html.light-mode .bg-\[\#121124\],
    html.light-mode .bg-\[\#131224\],
    html.light-mode .bg-\[\#141328\],
    html.light-mode .bg-slate-900,
    html.light-mode .bg-slate-950,
    html.light-mode .bg-black,
    html.light-mode .bg-gray-900,
    html.light-mode .bg-gray-950,
    body.light-mode .bg-\[\#030305\],
    body.light-mode .bg-\[\#050508\],
    body.light-mode .bg-\[\#07070d\],
    body.light-mode .bg-\[\#080811\],
    body.light-mode .bg-\[\#090913\],
    body.light-mode .bg-\[\#0b0b14\],
    body.light-mode .bg-\[\#0c0c16\],
    body.light-mode .bg-\[\#0c0c17\],
    body.light-mode .bg-\[\#0e0e1a\],
    body.light-mode .bg-\[\#111022\],
    body.light-mode .bg-\[\#121124\],
    body.light-mode .bg-\[\#131224\],
    body.light-mode .bg-\[\#141328\],
    body.light-mode .bg-slate-900,
    body.light-mode .bg-slate-950,
    body.light-mode .bg-black,
    body.light-mode .bg-gray-900,
    body.light-mode .bg-gray-950 {
        background-color: #FFFFFF !important;
    }

    /* Overrides for semi-transparent dark backgrounds */
    html.light-mode [class*="bg-black/"],
    html.light-mode [class*="bg-white/\[0.02\]"],
    html.light-mode [class*="bg-white/\[0.03\]"],
    html.light-mode [class*="bg-white/\[0.04\]"],
    html.light-mode [class*="bg-white/\[0.05\]"],
    html.light-mode [class*="bg-white/\[0.06\]"],
    html.light-mode [class*="bg-white/\[0.08\]"],
    html.light-mode [class*="bg-white/\[0.1\]"],
    html.light-mode [class*="bg-white/\[0.12\]"],
    body.light-mode [class*="bg-black/"],
    body.light-mode [class*="bg-white/\[0.02\]"],
    body.light-mode [class*="bg-white/\[0.03\]"],
    body.light-mode [class*="bg-white/\[0.04\]"],
    body.light-mode [class*="bg-white/\[0.05\]"],
    body.light-mode [class*="bg-white/\[0.06\]"],
    body.light-mode [class*="bg-white/\[0.08\]"],
    body.light-mode [class*="bg-white/\[0.1\]"],
    body.light-mode [class*="bg-white/\[0.12\]"] {
        background-color: #F8FAFC !important;
    }

    /* 3. Header & Navbar Styling in Light Mode */
    html.light-mode header,
    html.light-mode nav,
    body.light-mode header,
    body.light-mode nav {
        background-color: rgba(255, 255, 255, 0.92) !important;
        border-color: #E2E8F0 !important;
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.05) !important;
    }

    /* 4. Cards, Forms, Modals & Floating Surfaces */
    html.light-mode .glass-card,
    html.light-mode .glass-card-hover,
    body.light-mode .glass-card,
    body.light-mode .glass-card-hover {
        background: #FFFFFF !important;
        background-color: #FFFFFF !important;
        border-color: #E2E8F0 !important;
        box-shadow: 0 4px 20px -2px rgba(15, 23, 42, 0.06), 0 2px 6px -1px rgba(15, 23, 42, 0.04) !important;
    }

    html.light-mode .glass-card-hover:hover,
    body.light-mode .glass-card-hover:hover {
        box-shadow: 0 12px 28px -6px rgba(124, 58, 237, 0.12), 0 4px 10px -2px rgba(0, 0, 0, 0.05) !important;
        border-color: #C084FC !important;
    }

    /* Dropdown menus & Modals */
    html.light-mode [x-show="userOpen"],
    html.light-mode [x-show="open"],
    html.light-mode .dropdown-menu,
    body.light-mode [x-show="userOpen"],
    body.light-mode [x-show="open"],
    body.light-mode .dropdown-menu {
        background-color: #FFFFFF !important;
        border-color: #E2E8F0 !important;
        box-shadow: 0 20px 25px -5px rgba(15, 23, 42, 0.1), 0 8px 10px -6px rgba(15, 23, 42, 0.08) !important;
    }

    /* Modal dialogs */
    html.light-mode .fixed.inset-0.bg-slate-900\/60,
    body.light-mode .fixed.inset-0.bg-slate-900\/60 {
        background-color: rgba(15, 23, 42, 0.4) !important;
    }

    /* 5. Border Overrides */
    html.light-mode [class*="border-white/"]:not([class*="hero-arc"]):not(.animated-ring):not(.hero-horizon-arc):not(.btn-demo-sistem):not(.btn-lacak-hero),
    html.light-mode .border-slate-800,
    html.light-mode .border-slate-700,
    html.light-mode .border-gray-800,
    html.light-mode .border-gray-700,
    body.light-mode [class*="border-white/"]:not([class*="hero-arc"]):not(.animated-ring):not(.hero-horizon-arc):not(.btn-demo-sistem):not(.btn-lacak-hero),
    body.light-mode .border-slate-800,
    body.light-mode .border-slate-700,
    body.light-mode .border-gray-800,
    body.light-mode .border-gray-700 {
        border-color: #E2E8F0 !important;
    }

    html.light-mode [class*="divide-white/"],
    html.light-mode .divide-gray-700\/60,
    body.light-mode [class*="divide-white/"],
    body.light-mode .divide-gray-700\/60 {
        border-color: #E2E8F0 !important;
    }

    /* 6. Tables & Data Grids */
    html.light-mode table,
    body.light-mode table {
        background-color: #FFFFFF !important;
        color: #0F172A !important;
    }

    html.light-mode thead,
    html.light-mode thead tr,
    body.light-mode thead,
    body.light-mode thead tr {
        background-color: #F8FAFC !important;
        border-bottom: 2px solid #E2E8F0 !important;
    }

    html.light-mode th,
    body.light-mode th {
        color: #475569 !important;
    }

    html.light-mode tbody tr,
    body.light-mode tbody tr {
        border-bottom: 1px solid #E2E8F0 !important;
        background-color: #FFFFFF;
    }

    html.light-mode tbody tr:hover,
    body.light-mode tbody tr:hover {
        background-color: #F8FAFC !important;
    }

    html.light-mode td,
    body.light-mode td {
        color: #1E293B !important;
    }

    /* 7. Form Inputs, Selects, Dropdowns & Textareas */
    html.light-mode input:not([type="submit"]):not([type="button"]):not([type="checkbox"]):not([type="radio"]),
    html.light-mode textarea,
    html.light-mode select,
    body.light-mode input:not([type="submit"]):not([type="button"]):not([type="checkbox"]):not([type="radio"]),
    body.light-mode textarea,
    body.light-mode select {
        background-color: #F1F5F9 !important;
        color: #0F172A !important;
        border-color: #CBD5E1 !important;
    }

    html.light-mode input::placeholder,
    html.light-mode textarea::placeholder,
    body.light-mode input::placeholder,
    body.light-mode textarea::placeholder {
        color: #94A3B8 !important;
    }

    html.light-mode input:focus,
    html.light-mode textarea:focus,
    html.light-mode select:focus,
    body.light-mode input:focus,
    body.light-mode textarea:focus,
    body.light-mode select:focus {
        background-color: #FFFFFF !important;
        border-color: #9333EA !important;
        box-shadow: 0 0 0 3px rgba(147, 51, 234, 0.15) !important;
        color: #0F172A !important;
    }

    html.light-mode select option,
    body.light-mode select option {
        background-color: #FFFFFF !important;
        color: #0F172A !important;
    }

    /* 8. Typography & Text Color Overrides */
    html.light-mode h1:not([class*="text-transparent"]):not([class*="bg-clip-text"]),
    html.light-mode h2:not([class*="text-transparent"]):not([class*="bg-clip-text"]),
    html.light-mode h3:not([class*="text-transparent"]):not([class*="bg-clip-text"]),
    html.light-mode h4:not([class*="text-transparent"]):not([class*="bg-clip-text"]),
    html.light-mode h5:not([class*="text-transparent"]):not([class*="bg-clip-text"]),
    html.light-mode h6:not([class*="text-transparent"]):not([class*="bg-clip-text"]),
    body.light-mode h1:not([class*="text-transparent"]):not([class*="bg-clip-text"]),
    body.light-mode h2:not([class*="text-transparent"]):not([class*="bg-clip-text"]),
    body.light-mode h3:not([class*="text-transparent"]):not([class*="bg-clip-text"]),
    body.light-mode h4:not([class*="text-transparent"]):not([class*="bg-clip-text"]),
    body.light-mode h5:not([class*="text-transparent"]):not([class*="bg-clip-text"]),
    body.light-mode h6:not([class*="text-transparent"]):not([class*="bg-clip-text"]) {
        color: #0F172A !important;
    }

    html.light-mode p,
    body.light-mode p {
        color: #334155;
    }

    /* Text-white overrides: only apply to general text, never to buttons or badges */
    html.light-mode span.text-white:not([class*="bg-"]):not([class*="badge"]):not([class*="from-"]),
    html.light-mode div.text-white:not([class*="bg-"]):not([class*="from-"]),
    html.light-mode p.text-white,
    html.light-mode a.text-white:not([class*="bg-purple"]):not([class*="bg-indigo"]):not([class*="bg-emerald"]):not([class*="bg-rose"]):not([class*="from-"]):not([class*="btn"]),
    body.light-mode span.text-white:not([class*="bg-"]):not([class*="badge"]):not([class*="from-"]),
    body.light-mode div.text-white:not([class*="bg-"]):not([class*="from-"]),
    body.light-mode p.text-white,
    body.light-mode a.text-white:not([class*="bg-purple"]):not([class*="bg-indigo"]):not([class*="bg-emerald"]):not([class*="bg-rose"]):not([class*="from-"]):not([class*="btn"]) {
        color: #0F172A !important;
    }

    html.light-mode .text-slate-100,
    html.light-mode .text-slate-200,
    html.light-mode .text-slate-300,
    html.light-mode .text-gray-100,
    html.light-mode .text-gray-200,
    html.light-mode .text-gray-300,
    body.light-mode .text-slate-100,
    body.light-mode .text-slate-200,
    body.light-mode .text-slate-300,
    body.light-mode .text-gray-100,
    body.light-mode .text-gray-200,
    body.light-mode .text-gray-300 {
        color: #334155 !important;
    }

    html.light-mode .text-slate-400,
    html.light-mode .text-gray-400,
    body.light-mode .text-slate-400,
    body.light-mode .text-gray-400 {
        color: #64748B !important;
    }

    html.light-mode .text-purple-50,
    html.light-mode .text-purple-100,
    html.light-mode .text-purple-200,
    body.light-mode .text-purple-50,
    body.light-mode .text-purple-100,
    body.light-mode .text-purple-200 {
        color: #475569 !important;
    }

    /* 9. Preserve Primary Action Buttons, Brand Accents & Badges */
    html.light-mode button[class*="bg-purple"]:not(.admin-btn-outline):not([class*="bg-white"]):not([class*="bg-purple-50"]):not([class*="bg-purple-100"]):not([class*="hover:bg-purple-50"]):not([class*="hover:bg-purple-100"]),
    html.light-mode button[class*="bg-indigo"]:not(.admin-btn-outline),
    html.light-mode button[class*="bg-emerald"]:not(.admin-btn-outline),
    html.light-mode button[class*="bg-rose"]:not(.admin-btn-outline),
    html.light-mode button[class*="bg-gradient"]:not(.admin-btn-outline),
    html.light-mode button[class*="from-purple"]:not(.admin-btn-outline),
    html.light-mode a[class*="bg-purple"]:not(nav a):not(.admin-nav-item):not(.admin-btn-outline):not(.admin-filter-badge):not([class*="bg-white"]):not([class*="bg-purple-50"]):not([class*="bg-purple-100"]):not([class*="hover:bg-purple-50"]):not([class*="hover:bg-purple-100"]),
    html.light-mode a[class*="bg-indigo"]:not(nav a):not(.admin-nav-item):not(.admin-btn-outline),
    html.light-mode a[class*="bg-emerald"]:not(nav a):not(.admin-nav-item):not(.admin-btn-outline),
    html.light-mode a[class*="bg-rose"]:not(nav a):not(.admin-nav-item):not(.admin-btn-outline),
    html.light-mode a[class*="bg-gradient"]:not(nav a):not(.admin-nav-item):not(.admin-btn-outline),
    html.light-mode a[class*="from-purple"]:not(nav a):not(.admin-nav-item):not(.admin-btn-outline),
    body.light-mode button[class*="bg-purple"]:not(.admin-btn-outline):not([class*="bg-white"]):not([class*="bg-purple-50"]):not([class*="bg-purple-100"]):not([class*="hover:bg-purple-50"]):not([class*="hover:bg-purple-100"]),
    body.light-mode button[class*="bg-indigo"]:not(.admin-btn-outline),
    body.light-mode button[class*="bg-emerald"]:not(.admin-btn-outline),
    body.light-mode button[class*="bg-rose"]:not(.admin-btn-outline),
    body.light-mode button[class*="bg-gradient"]:not(.admin-btn-outline),
    body.light-mode button[class*="from-purple"]:not(.admin-btn-outline),
    body.light-mode a[class*="bg-purple"]:not(nav a):not(.admin-nav-item):not(.admin-btn-outline):not(.admin-filter-badge):not([class*="bg-white"]):not([class*="bg-purple-50"]):not([class*="bg-purple-100"]):not([class*="hover:bg-purple-50"]):not([class*="hover:bg-purple-100"]),
    body.light-mode a[class*="bg-indigo"]:not(nav a):not(.admin-nav-item):not(.admin-btn-outline),
    body.light-mode a[class*="bg-emerald"]:not(nav a):not(.admin-nav-item):not(.admin-btn-outline),
    body.light-mode a[class*="bg-rose"]:not(nav a):not(.admin-nav-item):not(.admin-btn-outline),
    body.light-mode a[class*="bg-gradient"]:not(nav a):not(.admin-nav-item):not(.admin-btn-outline),
    body.light-mode a[class*="from-purple"]:not(nav a):not(.admin-nav-item):not(.admin-btn-outline) {
        color: #FFFFFF !important;
    }

    html.light-mode button[class*="bg-purple"]:not(.admin-btn-outline):not([class*="bg-white"]):not([class*="bg-purple-50"]):not([class*="bg-purple-100"]):not([class*="hover:bg-purple-50"]):not([class*="hover:bg-purple-100"]) *,
    html.light-mode a[class*="bg-purple"]:not(nav a):not(.admin-nav-item):not(.admin-btn-outline):not(.admin-filter-badge):not([class*="bg-white"]):not([class*="bg-purple-50"]):not([class*="bg-purple-100"]):not([class*="hover:bg-purple-50"]):not([class*="hover:bg-purple-100"]) *,
    html.light-mode button[class*="bg-gradient"]:not(.admin-btn-outline) *,
    html.light-mode a[class*="bg-gradient"]:not(nav a):not(.admin-nav-item):not(.admin-btn-outline) *,
    body.light-mode button[class*="bg-purple"]:not(.admin-btn-outline):not([class*="bg-white"]):not([class*="bg-purple-50"]):not([class*="bg-purple-100"]):not([class*="hover:bg-purple-50"]):not([class*="hover:bg-purple-100"]) *,
    body.light-mode a[class*="bg-purple"]:not(nav a):not(.admin-nav-item):not(.admin-btn-outline):not(.admin-filter-badge):not([class*="bg-white"]):not([class*="bg-purple-50"]):not([class*="bg-purple-100"]):not([class*="hover:bg-purple-50"]):not([class*="hover:bg-purple-100"]) *,
    body.light-mode button[class*="bg-gradient"]:not(.admin-btn-outline) *,
    body.light-mode a[class*="bg-gradient"]:not(nav a):not(.admin-nav-item):not(.admin-btn-outline) * {
        color: #FFFFFF !important;
    }

    html.light-mode .bg-clip-text,
    body.light-mode .bg-clip-text {
        -webkit-background-clip: text !important;
        background-clip: text !important;
        color: transparent !important;
    }

    /* 10. Ambient Glow Opacity Adjustment */
    html.light-mode .blur-\[140px\],
    html.light-mode .blur-\[150px\],
    html.light-mode .blur-\[130px\],
    html.light-mode .blur-\[120px\],
    html.light-mode .blur-\[80px\],
    body.light-mode .blur-\[140px\],
    body.light-mode .blur-\[150px\],
    body.light-mode .blur-\[130px\],
    body.light-mode .blur-\[120px\],
    body.light-mode .blur-\[80px\] {
        opacity: 0.35 !important;
    }

    /* 11. Footer */
    html.light-mode footer,
    body.light-mode footer {
        background-color: #FFFFFF !important;
        border-color: #E2E8F0 !important;
        color: #64748B !important;
    }

    /* 12. Theme Switcher Icon Behavior */
    .theme-toggle-btn {
        background: rgba(255, 255, 255, 0.06);
        border: 1px solid rgba(255, 255, 255, 0.12);
        box-shadow: 0 0 15px rgba(251, 191, 36, 0.12);
    }

    .theme-toggle-btn:hover {
        background: rgba(255, 255, 255, 0.12);
        border-color: rgba(251, 191, 36, 0.4);
    }

    /* Default / Dark Mode: Show Sun ☀️, Hide Moon 🌙 */
    html.dark .theme-icon-sun,
    html:not(.light-mode) .theme-icon-sun {
        display: inline-block !important;
    }

    html.dark .theme-icon-moon,
    html:not(.light-mode) .theme-icon-moon {
        display: none !important;
    }

    html.dark .theme-label-dark,
    html:not(.light-mode) .theme-label-dark {
        display: inline !important;
    }

    html.dark .theme-label-light,
    html:not(.light-mode) .theme-label-light {
        display: none !important;
    }

    /* Light Mode: Show Moon 🌙, Hide Sun ☀️ */
    html.light-mode .theme-icon-sun,
    body.light-mode .theme-icon-sun {
        display: none !important;
    }

    html.light-mode .theme-icon-moon,
    body.light-mode .theme-icon-moon {
        display: inline-block !important;
    }

    html.light-mode .theme-label-dark,
    body.light-mode .theme-label-dark {
        display: none !important;
    }

    html.light-mode .theme-label-light,
    body.light-mode .theme-label-light {
        display: inline !important;
    }

    html.light-mode .theme-toggle-btn,
    body.light-mode .theme-toggle-btn {
        background: #FFFFFF !important;
        border: 1px solid #E2E8F0 !important;
        box-shadow: 0 2px 5px rgba(15, 23, 42, 0.06) !important;
    }

    html.light-mode .theme-toggle-btn:hover,
    body.light-mode .theme-toggle-btn:hover {
        background: #FAF5FF !important;
        border-color: #C084FC !important;
    }

    /* ==========================================================================
       13. GLOBAL PERFORMANCE BOOST & HERO HORIZON ARC (LOW-END FRIENDLY)
       ========================================================================== */

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

    /* Ringankan Lengkungan .hero-horizon-arc (Tetap Menyala Tanpa Beban GPU) */
    .hero-horizon-arc {
        display: block !important;
        position: absolute;
        top: 45px !important;
        left: 50%;
        transform: translateX(-50%);
        width: 120vw;
        height: 600px;
        border-radius: 50%;
        border-top: 3px solid #C084FC !important;
        background: radial-gradient(50% 40% at 50% 0%, rgba(168, 85, 247, 0.38) 0%, transparent 75%) !important;
        box-shadow: none !important;
        filter: none !important;
        animation: none !important;
        pointer-events: none;
        z-index: 1 !important;
    }

    /* Saat Light Mode Aktif: Tetap Muncul & Kontras di Atas Background Putih */
    html.light-mode .hero-horizon-arc,
    body.light-mode .hero-horizon-arc,
    .light-mode .hero-horizon-arc {
        border-top: 3px solid #7C3AED !important;
        background: radial-gradient(50% 40% at 50% 0%, rgba(124, 58, 237, 0.25) 0%, transparent 75%) !important;
        box-shadow: none !important;
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

    /* Hero Floating Showcase Card Preservation in Light Mode */
    /* Hero Floating Showcase Card Styling in Light Mode */
    html.light-mode .hero-showcase-card-1,
    body.light-mode .hero-showcase-card-1,
    .light-mode .hero-showcase-card-1 {
        background: linear-gradient(135deg, #7C3AED 0%, #6D28D9 50%, #4338CA 100%) !important;
        color: #FFFFFF !important;
    }

    html.light-mode .hero-showcase-card-1 h3,
    body.light-mode .hero-showcase-card-1 h3,
    .light-mode .hero-showcase-card-1 h3 {

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
        html.light-mode .hero-showcase-card-2,
        body.light-mode .hero-showcase-card-2,
        .light-mode .hero-showcase-card-2 {
            background-color: #161329 !important;
            color: #FFFFFF !important;
            border-color: rgba(168, 85, 247, 0.45) !important;
            background-color: rgba(255, 255, 255, 0.95) !important;
            background: rgba(255, 255, 255, 0.95) !important;
            color: #1E293B !important;
            border-color: rgba(233, 213, 255, 0.8) !important;
            box-shadow: 0 20px 25px -5px rgba(147, 51, 234, 0.1), 0 8px 10px -6px rgba(147, 51, 234, 0.08) !important;
        }

        html.light-mode .hero-showcase-card-2 h4,
        body.light-mode .hero-showcase-card-2 h4,
        .light-mode .hero-showcase-card-2 h4 {
            color: #FFFFFF !important;
            color: #0F172A !important;
        }

        html.light-mode .hero-showcase-card-2 p,
        body.light-mode .hero-showcase-card-2 p,
        .light-mode .hero-showcase-card-2 p {
            color: #E2E8F0 !important;

            /* Terang jelas slate-200 */
            html.light-mode .hero-showcase-card-2 .hero-showcase-main-text,
            body.light-mode .hero-showcase-card-2 .hero-showcase-main-text,
            .light-mode .hero-showcase-card-2 .hero-showcase-main-text {
                color: #1E293B !important;
                font-weight: 600 !important;
            }

            html.light-mode .hero-showcase-card-2 span,
            body.light-mode .hero-showcase-card-2 span,
            .light-mode .hero-showcase-card-2 span {
                color: #E2E8F0 !important;

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

                html.light-mode .hero-showcase-card-2 a,
                body.light-mode .hero-showcase-card-2 a,
                .light-mode .hero-showcase-card-2 a {
                    color: #C084FC !important;

                    html.light-mode .hero-showcase-card-2 .hero-icon-box-1 svg,
                    body.light-mode .hero-showcase-card-2 .hero-icon-box-1 svg,
                    .light-mode .hero-showcase-card-2 .hero-icon-box-1 svg,
                    html.light-mode .hero-showcase-card-2 .hero-icon-box-2 svg,
                    body.light-mode .hero-showcase-card-2 .hero-icon-box-2 svg,
                    .light-mode .hero-showcase-card-2 .hero-icon-box-2 svg {
                        color: #9333EA !important;
                    }

                    html.light-mode .hero-showcase-card-2 a:hover,
                    body.light-mode .hero-showcase-card-2 a:hover,
                    .light-mode .hero-showcase-card-2 a:hover {
                        color: #E9D5FF !important;

                        html.light-mode .hero-showcase-card-2 .hero-showcase-free,
                        body.light-mode .hero-showcase-card-2 .hero-showcase-free,
                        .light-mode .hero-showcase-card-2 .hero-showcase-free {
                            color: #64748B !important;
                        }

                        html.light-mode .hero-showcase-card-2 .text-emerald-400,
                        body.light-mode .hero-showcase-card-2 .text-emerald-400,
                        .light-mode .hero-showcase-card-2 .text-emerald-400 {
                            color: #34D399 !important;

                            html.light-mode .hero-showcase-card-2 a.hero-showcase-link,
                            body.light-mode .hero-showcase-card-2 a.hero-showcase-link,
                            .light-mode .hero-showcase-card-2 a.hero-showcase-link {
                                color: #9333EA !important;
                                font-weight: 600 !important;
                            }

                            html.light-mode .hero-showcase-card-2 .text-purple-300,
                            body.light-mode .hero-showcase-card-2 .text-purple-300,
                            .light-mode .hero-showcase-card-2 .text-purple-300 {
                                color: #D8B4FE !important;

                                html.light-mode .hero-showcase-card-2 a.hero-showcase-link:hover,
                                body.light-mode .hero-showcase-card-2 a.hero-showcase-link:hover,
                                .light-mode .hero-showcase-card-2 a.hero-showcase-link:hover {
                                    color: #7E22CE !important;
                                }

                                html.light-mode .hero-showcase-card-2 .text-indigo-300,
                                body.light-mode .hero-showcase-card-2 .text-indigo-300,
                                .light-mode .hero-showcase-card-2 .text-indigo-300 {
                                    color: #A5B4FC !important;

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

                                    /* ==========================================================================
       12. Admin Navigation Contrast in Light Mode
       Pastikan semua teks navigasi (Dashboard, Permohonan Pinjam, Katalog Aset, dll.)
       berubah menjadi warna gelap tegas (#1E293B / slate-800) saat Light Mode aktif.
       ========================================================================== */
                                    html.light-mode .admin-nav-item,
                                    body.light-mode .admin-nav-item,
                                    .light-mode .admin-nav-item,
                                    html.light-mode nav a.admin-nav-item,
                                    body.light-mode nav a.admin-nav-item,
                                    .light-mode nav a.admin-nav-item,
                                    html.light-mode nav div.sm\:flex a,
                                    body.light-mode nav div.sm\:flex a,
                                    .light-mode nav div.sm\:flex a,
                                    html.light-mode nav div.space-y-1\.5 a,
                                    body.light-mode nav div.space-y-1\.5 a,
                                    .light-mode nav div.space-y-1\.5 a {
                                        color: #1E293B !important;
                                    }

                                    html.light-mode .admin-nav-item span,
                                    body.light-mode .admin-nav-item span,
                                    .light-mode .admin-nav-item span,
                                    html.light-mode nav a.admin-nav-item span,
                                    body.light-mode nav a.admin-nav-item span,
                                    .light-mode nav a.admin-nav-item span,
                                    html.light-mode nav div.sm\:flex a span,
                                    body.light-mode nav div.sm\:flex a span,
                                    .light-mode nav div.sm\:flex a span,
                                    html.light-mode nav div.space-y-1\.5 a span,
                                    body.light-mode nav div.space-y-1\.5 a span,
                                    .light-mode nav div.space-y-1\.5 a span {
                                        color: #1E293B !important;
                                    }

                                    /* Active Nav Tab in Light Mode */
                                    html.light-mode .admin-nav-item.active-tab,
                                    body.light-mode .admin-nav-item.active-tab,
                                    .light-mode .admin-nav-item.active-tab,
                                    html.light-mode nav a.active-tab,
                                    body.light-mode nav a.active-tab,
                                    .light-mode nav a.active-tab {
                                        background-color: #EDE9FE !important;
                                        /* purple-100 lembut */
                                        border-color: #C4B5FD !important;
                                        /* purple-300 */
                                        color: #1E293B !important;
                                        font-weight: 700 !important;
                                    }

                                    html.light-mode .admin-nav-item.active-tab span,
                                    body.light-mode .admin-nav-item.active-tab span,
                                    .light-mode .admin-nav-item.active-tab span,
                                    html.light-mode nav a.active-tab span,
                                    body.light-mode nav a.active-tab span,
                                    .light-mode nav a.active-tab span {
                                        color: #1E293B !important;
                                        font-weight: 700 !important;
                                    }

                                    /* Inactive Nav Tab Hover in Light Mode */
                                    html.light-mode .admin-nav-item:hover,
                                    body.light-mode .admin-nav-item:hover,
                                    .light-mode .admin-nav-item:hover,
                                    html.light-mode nav a.admin-nav-item:hover,
                                    body.light-mode nav a.admin-nav-item:hover,
                                    .light-mode nav a.admin-nav-item:hover {
                                        background-color: #F3E8FF !important;
                                        color: #0F172A !important;
                                    }

                                    html.light-mode .admin-nav-item:hover span,
                                    body.light-mode .admin-nav-item:hover span,
                                    .light-mode .admin-nav-item:hover span {
                                        color: #0F172A !important;
                                    }

                                    /* Navigation SVGs in Light Mode */
                                    html.light-mode .admin-nav-item svg,
                                    body.light-mode .admin-nav-item svg,
                                    .light-mode .admin-nav-item svg {
                                        color: #7C3AED !important;
                                        stroke: #7C3AED !important;
                                    }

                                    /* Pending Counter Badge */
                                    html.light-mode .admin-nav-item .pending-badge,
                                    body.light-mode .admin-nav-item .pending-badge,
                                    .light-mode .admin-nav-item .pending-badge,
                                    html.light-mode nav .pending-badge,
                                    body.light-mode nav .pending-badge,
                                    .light-mode nav .pending-badge {
                                        background-color: #F59E0B !important;
                                        color: #0F172A !important;
                                    }

                                    /* User dropdown profile button in Light Mode */
                                    html.light-mode .admin-user-btn,
                                    body.light-mode .admin-user-btn,
                                    .light-mode .admin-user-btn,
                                    html.light-mode .admin-user-btn div,
                                    body.light-mode .admin-user-btn div,
                                    .light-mode .admin-user-btn div {
                                        color: #1E293B !important;
                                    }

                                    /* ==========================================================================
       13. Kotak Peringatan Stok Habis (Restock Needed) in Light Mode
       Daftar kode & nama barang menjadi merah marun gelap pekat (#7F1D1D / text-red-800)
       ========================================================================== */
                                    html.light-mode .restock-alert-box,
                                    body.light-mode .restock-alert-box,
                                    .light-mode .restock-alert-box {
                                        background-color: #FFF1F2 !important;
                                        /* rose-50 pekat bersih */
                                        border-color: #FECDD3 !important;
                                        /* rose-200 */
                                    }

                                    html.light-mode .restock-alert-box .font-bold,
                                    body.light-mode .restock-alert-box .font-bold,
                                    .light-mode .restock-alert-box .font-bold,
                                    html.light-mode .restock-alert-box h3,
                                    body.light-mode .restock-alert-box h3,
                                    .light-mode .restock-alert-box h3 {
                                        color: #7F1D1D !important;
                                        /* Merah marun gelap pekat */
                                    }

                                    html.light-mode .restock-alert-box p,
                                    body.light-mode .restock-alert-box p,
                                    .light-mode .restock-alert-box p,
                                    html.light-mode .restock-alert-box li,
                                    body.light-mode .restock-alert-box li,
                                    .light-mode .restock-alert-box li,
                                    html.light-mode .restock-alert-box span,
                                    body.light-mode .restock-alert-box span,
                                    .light-mode .restock-alert-box span {
                                        color: #7F1D1D !important;
                                        /* Merah marun pekat */
                                    }

                                    html.light-mode .restock-item-badge,
                                    body.light-mode .restock-item-badge,
                                    .light-mode .restock-item-badge,
                                    html.light-mode .restock-alert-box [class*="bg-rose-100"],
                                    body.light-mode .restock-alert-box [class*="bg-rose-100"],
                                    .light-mode .restock-alert-box [class*="bg-rose-100"] {
                                        color: #7F1D1D !important;
                                        /* Merah marun pekat (#7F1D1D) */
                                        background-color: #FEE2E2 !important;
                                        /* red-100 */
                                        border-color: #FCA5A5 !important;
                                        /* red-300 */
                                        font-weight: 700 !important;
                                    }

                                    /* ==========================================================================
       14. Badge / Tombol Outline ('Semua Permohonan', 'Lihat Katalog Publik', dll.) in Light Mode
       Pastikan teks di dalam elemen badge atau tombol sekunder yang memiliki background
       terang/putih diubah menjadi warna gelap tegas (#1E293B / text-slate-800).
       ========================================================================== */
                                    html.light-mode .admin-btn-outline,
                                    body.light-mode .admin-btn-outline,
                                    .light-mode .admin-btn-outline,
                                    html.light-mode a.admin-btn-outline,
                                    body.light-mode a.admin-btn-outline,
                                    .light-mode a.admin-btn-outline,
                                    html.light-mode button.admin-btn-outline,
                                    body.light-mode button.admin-btn-outline,
                                    .light-mode button.admin-btn-outline {
                                        background-color: #FFFFFF !important;
                                        background: #FFFFFF !important;
                                        color: #1E293B !important;
                                        border: 1.5px solid #DDD6FE !important;
                                        /* purple-200 */
                                        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05) !important;
                                    }

                                    html.light-mode .admin-btn-outline *,
                                    body.light-mode .admin-btn-outline *,
                                    .light-mode .admin-btn-outline *,
                                    html.light-mode a.admin-btn-outline *,
                                    body.light-mode a.admin-btn-outline *,
                                    .light-mode a.admin-btn-outline * {
                                        color: #1E293B !important;
                                    }

                                    html.light-mode .admin-btn-outline svg,
                                    body.light-mode .admin-btn-outline svg,
                                    .light-mode .admin-btn-outline svg,
                                    html.light-mode a.admin-btn-outline svg,
                                    body.light-mode a.admin-btn-outline svg,
                                    .light-mode a.admin-btn-outline svg {
                                        color: #7C3AED !important;
                                        stroke: #7C3AED !important;
                                    }

                                    html.light-mode .admin-btn-outline:hover,
                                    body.light-mode .admin-btn-outline:hover,
                                    .light-mode .admin-btn-outline:hover,
                                    html.light-mode a.admin-btn-outline:hover,
                                    body.light-mode a.admin-btn-outline:hover,
                                    .light-mode a.admin-btn-outline:hover {
                                        background-color: #F3E8FF !important;
                                        /* purple-100 */
                                        background: #F3E8FF !important;
                                        border-color: #A855F7 !important;
                                        color: #0F172A !important;
                                    }

                                    html.light-mode .admin-btn-outline:hover *,
                                    body.light-mode .admin-btn-outline:hover *,
                                    .light-mode .admin-btn-outline:hover * {
                                        color: #0F172A !important;
                                    }

                                    /* Badge & Tab Filter Toolbar di Admin */
                                    html.light-mode .admin-filter-badge:not(.bg-purple-600),
                                    body.light-mode .admin-filter-badge:not(.bg-purple-600),
                                    .light-mode .admin-filter-badge:not(.bg-purple-600) {
                                        color: #334155 !important;
                                        /* slate-700 */
                                        background-color: #F1F5F9 !important;
                                        /* slate-100 */
                                        background: #F1F5F9 !important;
                                        border: 1px solid #E2E8F0 !important;
                                        /* slate-200 */
                                        font-weight: 600 !important;
                                    }

                                    html.light-mode .admin-filter-badge:not(.bg-purple-600) *,
                                    body.light-mode .admin-filter-badge:not(.bg-purple-600) *,
                                    .light-mode .admin-filter-badge:not(.bg-purple-600) * {
                                        color: #334155 !important;
                                    }

                                    html.light-mode .admin-filter-badge:not(.bg-purple-600):hover,
                                    body.light-mode .admin-filter-badge:not(.bg-purple-600):hover,
                                    .light-mode .admin-filter-badge:not(.bg-purple-600):hover {
                                        background-color: #E2E8F0 !important;
                                        /* slate-200 */
                                        background: #E2E8F0 !important;
                                        color: #0F172A !important;
                                        /* slate-900 */
                                        border-color: #CBD5E1 !important;
                                    }

                                    /* Link aksi sekunder di Admin */
                                    html.light-mode .admin-link-action,
                                    body.light-mode .admin-link-action,
                                    .light-mode .admin-link-action {
                                        color: #6D28D9 !important;
                                        font-weight: 700 !important;
                                    }

                                    html.light-mode .admin-link-action:hover,
                                    body.light-mode .admin-link-action:hover,
                                    .light-mode .admin-link-action:hover {
                                        color: #4C1D95 !important;
                                    }

                                    /* ==========================================================================
       15. Kotak Kartu Statistik Utama ('Semua Permohonan 23', dll.) in Light & Dark Mode
       Saat Light Mode aktif, teks judul kartu menggunakan warna gelap tegas (slate-600),
       dan angka count menggunakan teks slate-900 yang sangat kontras.
       ========================================================================== */
                                    html.light-mode .stat-card-title,
                                    body.light-mode .stat-card-title,
                                    .light-mode .stat-card-title,
                                    html.light-mode [class*="stat-card-title"]:not([class*="amber"]):not([class*="emerald"]):not([class*="blue"]):not([class*="rose"]) {
                                        color: #475569 !important;
                                        /* slate-600 */
                                        font-weight: 700 !important;
                                    }

                                    html.light-mode .stat-card-count-all,
                                    body.light-mode .stat-card-count-all,
                                    .light-mode .stat-card-count-all {
                                        color: #0F172A !important;
                                        /* slate-900 */
                                        font-weight: 800 !important;
                                    }

                                    html.light-mode .stat-card-title-amber,
                                    body.light-mode .stat-card-title-amber,
                                    .light-mode .stat-card-title-amber {
                                        color: #B45309 !important;
                                        /* amber-700 */
                                        font-weight: 700 !important;
                                    }

                                    html.light-mode .stat-card-title-emerald,
                                    body.light-mode .stat-card-title-emerald,
                                    .light-mode .stat-card-title-emerald {
                                        color: #047857 !important;
                                        /* emerald-700 */
                                        font-weight: 700 !important;
                                    }

                                    html.light-mode .stat-card-title-blue,
                                    body.light-mode .stat-card-title-blue,
                                    .light-mode .stat-card-title-blue {
                                        color: #1D4ED8 !important;
                                        /* blue-700 */
                                        font-weight: 700 !important;
                                    }

                                    html.light-mode .stat-card-title-rose,
                                    body.light-mode .stat-card-title-rose,
                                    .light-mode .stat-card-title-rose {
                                        color: #BE123C !important;
                                        /* rose-700 */
                                        font-weight: 700 !important;
                                    }
</style>
