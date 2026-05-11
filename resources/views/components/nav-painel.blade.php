<nav class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 shadow-sm sticky top-0 z-40">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <div class="flex items-center gap-3">
                <a href="{{ route('painel') }}" class="flex items-center gap-2 group">
                    <img src="{{ asset('assets/coruja-logo.png') }}" alt="Logo" class="h-8 w-auto group-hover:scale-105 transition-transform duration-300">
                    <span class="text-lg font-extrabold text-gray-900 dark:text-white tracking-tight">Dashboard</span>
                </a>
            </div>

            <div class="flex items-center gap-6">
                <div class="flex items-center gap-2 text-sm font-semibold text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 px-4 py-1.5 rounded-full shadow-sm">
                    <i data-lucide="user" class="w-4 h-4 text-indigo-500"></i>
                    <span>{{ session()->get('name') }}</span>
                </div>

                <a href="{{ route('logout') }}" class="flex items-center gap-2 text-sm font-bold text-red-600 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300 transition-colors bg-red-50 hover:bg-red-100 dark:bg-red-900/20 dark:hover:bg-red-900/40 px-4 py-1.5 rounded-full">
                    <i data-lucide="log-out" class="w-4 h-4"></i>
                    Sair
                </a>
            </div>
        </div>
    </div>
</nav>