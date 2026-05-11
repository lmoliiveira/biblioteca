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

    @include('components/nav-painel')

    <main  class="flex-1">
        
      <div class="fixed inset-0 flex items-center justify-center bg-black/30 z-50">
        <div class="bg-white border border-gray-200 rounded-2xl p-6 w-full max-width-sm max-w-[360px] flex flex-col gap-4 shadow-sm">

          <!-- Texto -->
          <div>
            <p class="text-sm font-medium text-gray-800 mb-1">Deseja excluir o livro?</p>
            <p class="text-xs text-gray-400 leading-relaxed">
              Esta ação não poderá ser desfeita. O livro
              <span class="text-gray-700 font-medium">"{{ $livro->titulo }}"</span>
              será removido permanentemente.
            </p>
          </div>

          <!-- Botões -->
          <div class="flex gap-2 mt-1">
            <a href="{{route('painel')}}"
              class="flex-1 py-2 text-sm text-center font-medium text-gray-500 border border-gray-200 rounded-lg hover:bg-gray-50 hover:text-gray-700 transition-colors">
              Cancelar
            </a>
            <a href="{{route('delete_livro_confirm', ['id' => Crypt::encrypt($livro->id)])}}"
              class="flex-1 py-2 text-sm text-center font-medium text-white bg-red-600 rounded-lg hover:opacity-85 transition-opacity active:scale-[.98]">
              Confirmar
            </a>
          </div>

        </div>
      </div>

    </main>

    @include('components/footer')

</body>

</html>
