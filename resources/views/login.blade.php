<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 dark:bg-gray-900 min-h-screen flex items-center justify-center p-4">

    <div class="max-w-md w-full bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden">
        <div class="p-8">
            <div class="text-center mb-8">
                <a href="{{ route('index') }}">
                    <img src="{{ asset('assets/coruja-logo.png') }}" alt="Biblioteca logo" class="mx-auto h-24 w-auto mb-4 hover:scale-105 transition-transform duration-300">
                </a>
                <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white tracking-tight">Bem-vindo de volta!</h2>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">Faça login na sua conta para continuar</p>
            </div>

            <form action="{{ route('login_submit') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">E-mail</label>
                    <input id="email" type="email" name="email" required autocomplete="email" value="{{old('email')}}"
                        class="w-full rounded-lg bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 px-4 py-2.5 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200" placeholder="seu@email.com" />
                    @error('email')
                        <p class="mt-1 text-sm text-red-500 dark:text-red-400 font-medium">{{ $errors->first('email') }}</p>
                    @enderror
                </div>

                <div>
                    <div class="flex items-center justify-between mb-2">
                        <label for="password" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Senha</label>
                    </div>
                    <input id="password" type="password" name="password" required autocomplete="current-password"
                        class="w-full rounded-lg bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 px-4 py-2.5 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200" placeholder="••••••••" />
                    @error('password')
                        <p class="mt-1 text-sm text-red-500 dark:text-red-400 font-medium">{{ $errors->first('password') }}</p>
                    @enderror
                </div>

                @if (session()->has('login_error'))
                    <div class="p-3 rounded-lg bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-800">
                        <p class="text-sm text-red-600 dark:text-red-400 font-medium text-center">{{ session()->get('login_error') }}</p>
                    </div>
                @endif

                <button type="submit"
                    class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-md text-sm font-bold text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200 transform hover:-translate-y-0.5">
                    Entrar no Sistema
                </button>
            </form>
        </div>
    </div>

</body>

</html>
