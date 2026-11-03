<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center px-4 py-2.5 bg-purple-600 hover:bg-purple-700 text-white dark:bg-purple-600 dark:hover:bg-purple-500 border border-transparent rounded-xl font-bold text-xs uppercase tracking-wider shadow-md shadow-purple-500/25 focus:bg-purple-700 active:bg-purple-800 focus:outline-none focus:ring-2 focus:ring-purple-400 focus:ring-offset-2 dark:focus:ring-offset-gray-900 transition-all duration-200 transform hover:-translate-y-0.5 active:translate-y-0']) }}>
    {{ $slot }}
</button>
