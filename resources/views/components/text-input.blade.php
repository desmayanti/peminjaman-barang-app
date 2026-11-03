@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-purple-200 dark:border-gray-700 bg-white dark:bg-gray-900 text-slate-800 dark:text-gray-300 focus:border-purple-500 dark:focus:border-indigo-600 focus:ring-purple-400 dark:focus:ring-indigo-600 rounded-xl shadow-sm transition-colors duration-200']) }}>
