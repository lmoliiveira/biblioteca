<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen flex flex-col bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 font-sans">

    @include('components/nav-index')

    <main class="flex-1 w-full max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12 relative z-10">
        
        <!-- Botão Voltar -->
        <div class="mb-8">
            <a href="{{ route('index') }}" class="inline-flex items-center text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300 font-medium transition-colors duration-200">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Voltar ao catálogo
            </a>
        </div>

        <!-- Conteúdo do Livro -->
        <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-2xl overflow-hidden flex flex-col lg:flex-row transform transition-all hover:shadow-3xl duration-500 border border-gray-100 dark:border-gray-700/50">
            
            <!-- Imagem do Livro -->
            <div class="lg:w-2/5 xl:w-1/3 relative bg-gray-100 dark:bg-gray-800 flex-shrink-0 group overflow-hidden border-b lg:border-b-0 lg:border-r border-gray-200 dark:border-gray-700">
                @if($livro->imagem)
                    <div class="h-[400px] lg:h-full w-full relative">
                        <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" src="{{ asset('storage/' . $livro->imagem) }}" alt="Capa do livro {{ $livro->titulo }}">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-60"></div>
                    </div>
                @else
                    <div class="w-full h-[400px] lg:h-full flex flex-col items-center justify-center text-gray-400 dark:text-gray-500">
                        <svg class="w-20 h-20 mb-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        <span class="text-xl font-medium tracking-wide">Sem capa</span>
                    </div>
                @endif
                
                <div class="absolute bottom-4 left-4 lg:hidden z-20">
                    <span class="bg-indigo-600/90 backdrop-blur text-white text-xs font-bold px-3 py-1.5 rounded-full uppercase tracking-wider shadow-lg">
                        {{ $livro->genero }}
                    </span>
                </div>
            </div>
            
            <!-- Detalhes do Livro -->
            <div class="p-8 lg:p-12 xl:p-16 lg:w-3/5 xl:w-2/3 flex flex-col justify-center relative bg-white dark:bg-gray-800">
                
                <!-- Gênero (Desktop) -->
                <div class="hidden lg:block mb-4">
                    <span class="bg-indigo-50 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 text-xs font-bold px-4 py-1.5 rounded-full uppercase tracking-wider border border-indigo-100 dark:border-indigo-800/50 inline-block shadow-sm">
                        {{ $livro->genero }}
                    </span>
                </div>

                <!-- Título -->
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-extrabold text-gray-900 dark:text-white mb-4 leading-tight tracking-tight">
                    {{ $livro->titulo }}
                </h1>
                
                <!-- Autor -->
                <div class="flex items-center mb-8 mt-2">
                    <div class="flex items-center justify-center w-12 h-12 rounded-full bg-indigo-50 dark:bg-gray-700/50 text-indigo-600 dark:text-indigo-400 mr-4 shadow-sm border border-indigo-100 dark:border-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wider font-semibold mb-0.5">Escrito por</p>
                        <p class="text-xl font-bold text-gray-800 dark:text-gray-200">{{ $livro->autor }}</p>
                    </div>
                </div>

                <!-- Resumo -->
                <div class="mb-12 relative">
                    <div class="absolute -left-4 -top-6 text-indigo-100 dark:text-gray-700 opacity-50 z-0">
                        <svg class="w-16 h-16" fill="currentColor" viewBox="0 0 32 32"><path d="M10 8c-3.3 0-6 2.7-6 6v10h10V14H8c0-1.1.9-2 2-2h4V8h-4zm18 0c-3.3 0-6 2.7-6 6v10h10V14h-6c0-1.1.9-2 2-2h4V8h-4z"></path></svg>
                    </div>
                    <div class="relative z-10">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-3 flex items-center">
                            Sinopse
                        </h3>
                        <div class="prose prose-lg dark:prose-invert max-w-none text-gray-600 dark:text-gray-300 leading-relaxed text-justify">
                            <p>{{ $livro->resumo }}</p>
                        </div>
                    </div>
                </div>

                <!-- Informações Adicionais -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mt-auto pt-8 border-t border-gray-100 dark:border-gray-700/60">
                    <div class="flex items-center p-4 rounded-2xl bg-gray-50 dark:bg-gray-800/50 border border-gray-100 dark:border-gray-700/50 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                        <div class="flex-shrink-0 w-12 h-12 rounded-xl bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 shadow-sm flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-indigo-500 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        </div>
                        <div>
                            <span class="block text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1">Editora</span>
                            <span class="block font-bold text-gray-900 dark:text-white text-lg">{{ $livro->editora }}</span>
                        </div>
                    </div>
                    
                    <div class="flex items-center p-4 rounded-2xl bg-gray-50 dark:bg-gray-800/50 border border-gray-100 dark:border-gray-700/50 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                        <div class="flex-shrink-0 w-12 h-12 rounded-xl bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 shadow-sm flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-indigo-500 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                        <div>
                            <span class="block text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1">Ano de Publicação</span>
                            <span class="block font-bold text-gray-900 dark:text-white text-lg">{{ $livro->ano_publicacao }}</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>

    @include('components/footer')

</body>
</html>