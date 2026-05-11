<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen flex flex-col">

    @include('components/nav-index')

    <main class="flex-1 bg-gray-50 dark:bg-gray-900 py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10">
                @include('components/busca')
                <p class="mt-3 max-w-2xl mx-auto text-xl text-gray-500 dark:text-gray-400 sm:mt-4">
                    Explore nossa coleção de livros disponíveis no sistema.
                </p>
            </div>

            @if(isset($livros) && $livros->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8" id="listaLivros">
                    @foreach($livros as $livro)
                        <a href="{{ route('livro_info', ['id' => encrypt($livro->id)]) }}" class="livro-card bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-all duration-300 flex flex-col transform hover:-translate-y-1 cursor-pointer">
                            <div class="h-64 overflow-hidden relative">
                                @if($livro->imagem)
                                    <img class="w-full h-full object-cover" src="{{ asset('storage/' . $livro->imagem) }}" alt="Capa do livro {{ $livro->titulo }}">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gray-200 dark:bg-gray-700 text-gray-500 dark:text-gray-400">
                                        <span>Sem imagem</span>
                                    </div>
                                @endif
                                <div class="absolute top-0 right-0 mt-2 mr-2 bg-indigo-600 text-white text-xs font-bold px-2 py-1 rounded-md">
                                    {{ $livro->ano_publicacao }}
                                </div>
                            </div>
                            <div class="p-5 flex-1 flex flex-col">
                                <span class="livro-genero text-indigo-500 dark:text-indigo-400 font-semibold text-sm mb-1 uppercase tracking-wider">{{ $livro->genero }}</span>
                                <h3 class="livro-titulo text-lg font-bold text-gray-900 dark:text-white leading-tight mb-2">{{ $livro->titulo }}</h3>
                                <p class="text-sm text-gray-600 dark:text-gray-300 mb-4">Por <span class="livro-autor font-medium text-gray-800 dark:text-gray-200">{{ $livro->autor }}</span></p>
                                
                                <div class="mt-auto">
                                    <p class="text-xs text-gray-500 dark:text-gray-400 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                                        {{ $livro->editora }}
                                    </p>
                                </div>
                            </div>
                        </a>
                    @endforeach
                    <div id="semResultado" class="hidden col-span-full text-center py-12 bg-white dark:bg-gray-800 rounded-lg shadow-sm">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-gray-100">Nenhum livro encontrado</h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Não encontramos livros que correspondam à sua busca.</p>
                    </div>
                </div>
            @else
                <div class="text-center py-16 bg-white dark:bg-gray-800 rounded-lg shadow-sm">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-gray-100">Nenhum livro</h3>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Não há livros cadastrados no sistema no momento.</p>
                </div>
            @endif
        </div>
    </main>
    @include('components/footer')

    <script>
        document.getElementById('searchInput')?.addEventListener('input', function () {
            const termo = this.value.toLowerCase().trim();
            const cards = document.querySelectorAll('.livro-card');
            let visiveis = 0;

            cards.forEach(function (card) {
                const titulo = card.querySelector('.livro-titulo')?.innerText.toLowerCase() ?? '';
                const autor = card.querySelector('.livro-autor')?.innerText.toLowerCase() ?? '';
                const genero = card.querySelector('.livro-genero')?.innerText.toLowerCase() ?? '';

                const encontrou = titulo.includes(termo) || autor.includes(termo) || genero.includes(termo);

                card.style.display = encontrou ? '' : 'none';
                if (encontrou) visiveis++;
            });

            const aviso = document.getElementById('semResultado');
            if (aviso) {
                if (visiveis === 0 && cards.length > 0) {
                    aviso.classList.remove('hidden');
                } else {
                    aviso.classList.add('hidden');
                }
            }
        });
    </script>
</body>
</html>