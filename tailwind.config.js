import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['"Plus Jakarta Sans"', 'Figtree', ...defaultTheme.fontFamily.sans],
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
                },
            },
            boxShadow: {
                'pastel-sm': '0 2px 8px -1px rgba(168, 85, 247, 0.08), 0 1px 4px -1px rgba(168, 85, 247, 0.04)',
                'pastel-md': '0 8px 24px -4px rgba(168, 85, 247, 0.12), 0 4px 12px -2px rgba(168, 85, 247, 0.06)',
                'pastel-lg': '0 16px 36px -6px rgba(168, 85, 247, 0.16), 0 6px 16px -3px rgba(168, 85, 247, 0.08)',
            },
        },
    },

    plugins: [forms],
};
