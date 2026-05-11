<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen flex flex-col bg-gray-50 dark:bg-gray-900">

    @include('components/nav-painel')

    <main class="flex-1 py-8">
        <div class="max-w-[95%] mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="bg-white dark:bg-gray-800 shadow-md rounded-2xl overflow-hidden border border-gray-200 dark:border-gray-700">
                <div class="p-6 border-b border-gray-200 dark:border-gray-700 flex flex-col md:flex-row justify-between items-center gap-4 bg-gray-50 dark:bg-gray-800/50">
                    <h2 class="text-2xl font-extrabold text-gray-900 dark:text-white">Meus Livros</h2>
                    <div class="flex flex-col sm:flex-row items-center gap-4 w-full md:w-auto">
                        <div class="w-full sm:w-72">
                            @include('components/busca')
                        </div>
                        <a href="{{ route('new_livro') }}" class="flex items-center justify-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-bold rounded-full px-6 py-2.5 transition-colors shadow-sm w-full sm:w-auto">
                            <i data-lucide="plus" class="w-4 h-4"></i>
                            Adicionar
                        </a>
                    </div>
                </div>

                @if($livros->count() != 0)
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-600 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-300">
                            <tr>
                                <th scope="col" class="px-6 py-4 font-bold">Imagem</th>
                                <th scope="col" class="px-6 py-4 font-bold">Autor</th>
                                <th scope="col" class="px-6 py-4 font-bold">Título</th>
                                <th scope="col" class="px-6 py-4 font-bold">Editora</th>
                                <th scope="col" class="px-6 py-4 font-bold">Publicação</th>
                                <th scope="col" class="px-6 py-4 font-bold">Gênero</th>
                                <th scope="col" class="px-6 py-4 font-bold">Resumo</th>
                                <th scope="col" class="px-6 py-4 font-bold whitespace-nowrap">Adicionado em</th>
                                <th scope="col" class="px-6 py-4 font-bold text-right">Ações</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach($livros as $livro)
                            <tr class="bg-white dark:bg-gray-800">
                                <td class="px-6 py-4">
                                    <img 
                                        src="{{ asset('storage/' . $livro->imagem) }}" 
                                        alt="Capa do livro"
                                        class="w-12 h-16 sm:w-16 sm:h-24 object-cover rounded-md border border-gray-200 dark:border-gray-600 shadow-sm"
                                    >
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">{{ $livro->autor }}</td>
                                <td class="px-6 py-4 font-bold text-gray-900 dark:text-white whitespace-nowrap">{{ $livro->titulo }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $livro->editora }}</td>
                                <td class="px-6 py-4">{{ $livro->ano_publicacao }}</td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-indigo-100 text-indigo-800 dark:bg-indigo-900/40 dark:text-indigo-300">
                                        {{ $livro->genero }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 min-w-[250px]">
                                    <p class="text-xs line-clamp-3 text-gray-500 dark:text-gray-400" title="{{ $livro->resumo }}">{{ $livro->resumo }}</p>
                                </td>
                                <td class="px-6 py-4 text-xs whitespace-nowrap">
                                    <span class="font-medium text-gray-700 dark:text-gray-300">{{ $livro->created_at->format('d/m/Y') }}</span><br>
                                    <span class="text-gray-400">{{ $livro->created_at->format('H:i:s') }}</span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('edit_livro', ['id' => Crypt::encrypt($livro->id)]) }}" class="p-2 text-indigo-600 hover:bg-indigo-50 hover:text-indigo-700 dark:text-indigo-400 dark:hover:bg-indigo-900/30 rounded-lg transition-colors" title="Editar">
                                            <i data-lucide="pencil" class="w-5 h-5"></i>
                                        </a>
                                        <a href="{{ route('delete_livro', ['id' => Crypt::encrypt($livro->id)]) }}" class="p-2 text-red-600 hover:bg-red-50 hover:text-red-700 dark:text-red-400 dark:hover:bg-red-900/30 rounded-lg transition-colors" title="Excluir">
                                            <i data-lucide="trash-2" class="w-5 h-5"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="p-16 text-center flex flex-col items-center justify-center">
                    <div class="w-20 h-20 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mb-6">
                        <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Nenhum livro cadastrado</h3>
                    <p class="text-gray-500 dark:text-gray-400 mb-8 max-w-sm mx-auto">Você ainda não possui livros na sua coleção. Adicione seu primeiro livro para começar a gerenciar sua biblioteca.</p>
                    <a href="{{ route('new_livro') }}" class="flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-bold rounded-full px-8 py-3 transition-colors shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                        <i data-lucide="plus" class="w-5 h-5"></i>
                        Adicionar Primeiro Livro
                    </a>
                </div>
                @endif
            </div>

        </div>
    </main>

    @include('components/footer')

    <script> 
        document.getElementById('searchInput')?.addEventListener('input', function () {
            const termo = this.value.toLowerCase().trim();
            const linhas = document.querySelectorAll('tbody tr:not(#semResultado)');
            let visiveis = 0;

            linhas.forEach(function (linha) {
                const colunas = linha.querySelectorAll('td');

                // Índices: 1 = Autor, 2 = Título, 5 = Gênero
                const autor  = colunas[1]?.innerText.toLowerCase() ?? '';
                const titulo = colunas[2]?.innerText.toLowerCase() ?? '';
                const genero = colunas[5]?.innerText.toLowerCase() ?? '';

                const encontrou = autor.includes(termo) || titulo.includes(termo) || genero.includes(termo);

                linha.style.display = encontrou ? '' : 'none';
                if (encontrou) visiveis++;
            });

            let aviso = document.getElementById('semResultado');
            if (!aviso) {
                aviso = document.createElement('tr');
                aviso.id = 'semResultado';
                aviso.innerHTML = `<td colspan="9" class="text-center text-gray-500 dark:text-gray-400 py-12 bg-gray-50 dark:bg-gray-800/50 font-medium">Nenhum livro encontrado para sua busca.</td>`;
                document.querySelector('tbody').appendChild(aviso);
            }
            aviso.style.display = visiveis === 0 ? '' : 'none';
        });
    </script>

</body>

</html>
