<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-4 py-2.5 bg-purple-50 hover:bg-purple-100/90 text-purple-700 border border-purple-200/80 dark:bg-gray-800 dark:border-gray-600 rounded-xl font-semibold text-xs dark:text-gray-200 uppercase tracking-wider shadow-sm dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-purple-400 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition-all duration-200']) }}>
    {{ $slot }}
</button>
