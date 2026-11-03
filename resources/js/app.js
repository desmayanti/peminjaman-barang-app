import Alpine from 'alpinejs';

window.Alpine = Alpine;

// Global Theme Switcher Helper (Support .light-mode and .dark with localStorage persistence)
window.toggleTheme = function() {
    const isLight = document.documentElement.classList.contains('light-mode') || 
                    (!document.documentElement.classList.contains('dark') && localStorage.getItem('theme') === 'light');
    
    if (isLight) {
        // Beralih ke Dark Mode (Default)
        document.documentElement.classList.remove('light-mode');
        if (document.body) document.body.classList.remove('light-mode');
        document.documentElement.classList.add('dark');
        localStorage.setItem('theme', 'dark');
        window.dispatchEvent(new CustomEvent('theme-changed', { detail: 'dark' }));
    } else {
        // Beralih ke Light Mode
        document.documentElement.classList.add('light-mode');
        if (document.body) document.body.classList.add('light-mode');
        document.documentElement.classList.remove('dark');
        localStorage.setItem('theme', 'light');
        window.dispatchEvent(new CustomEvent('theme-changed', { detail: 'light' }));
    }
};

window.setTheme = function(theme) {
    if (theme === 'light') {
        document.documentElement.classList.add('light-mode');
        if (document.body) document.body.classList.add('light-mode');
        document.documentElement.classList.remove('dark');
        localStorage.setItem('theme', 'light');
        window.dispatchEvent(new CustomEvent('theme-changed', { detail: 'light' }));
    } else {
        document.documentElement.classList.remove('light-mode');
        if (document.body) document.body.classList.remove('light-mode');
        document.documentElement.classList.add('dark');
        localStorage.setItem('theme', 'dark');
        window.dispatchEvent(new CustomEvent('theme-changed', { detail: 'dark' }));
    }
};

Alpine.start();
