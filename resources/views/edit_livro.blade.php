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

    <main class="flex-1">

      <form action="{{route('edit_livro_submit')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="bg-white border border-gray-200 rounded-2xl p-8 w-full max-w-2xl shadow-sm justify-self-center">
          
          <!-- Título -->
          <h1 class="flex items-center gap-2 text-lg font-medium text-gray-800 mb-6">
            <i class="ti ti-book text-gray-400 text-xl" aria-hidden="true"></i>
            Editar livro
          </h1>
          
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

            <input type="hidden" name="id" value="{{Crypt::encrypt($livro->id)}}">
            
            <!-- Autor -->
            <div class="flex flex-col gap-1">
              <label for="autor" class="text-xs font-medium text-gray-500 tracking-wide">Autor</label>
              <input id="autor" name="autor" type="text" placeholder="Ex: Machado de Assis"
              class="border border-gray-200 rounded-lg px-3 py-2 text-sm text-gray-800 placeholder-gray-300 outline-none focus:border-gray-400 focus:ring-4 focus:ring-gray-100 transition-all" required value="{{old('autor', $livro->autor)}}"/>
              @error('autor')
                  <span class="text-red-500">
                    {{$errors->get('autor')[0]}}
                  </span>
              @enderror
            </div>
            
            <!-- Título -->
            <div class="flex flex-col gap-1">
              <label for="titulo" class="text-xs font-medium text-gray-500 tracking-wide">Título</label>
              <input id="titulo" name="titulo" type="text" placeholder="Ex: Dom Casmurro"
              class="border border-gray-200 rounded-lg px-3 py-2 text-sm text-gray-800 placeholder-gray-300 outline-none focus:border-gray-400 focus:ring-4 focus:ring-gray-100 transition-all" required value="{{old('titulo', $livro->titulo)}}"/>
              @error('titulo')
                  <span class="text-red-500">
                    {{$errors->get('titulo')[0]}}
                  </span>
              @enderror
            </div>
            
            <!-- Editora -->
            <div class="flex flex-col gap-1">
              <label for="editora" class="text-xs font-medium text-gray-500 tracking-wide">Editora</label>
              <input id="editora" name="editora" type="text" placeholder="Ex: Companhia das Letras"
              class="border border-gray-200 rounded-lg px-3 py-2 text-sm text-gray-800 placeholder-gray-300 outline-none focus:border-gray-400 focus:ring-4 focus:ring-gray-100 transition-all" required value="{{old('editora', $livro->editora)}}"/>
              @error('editora')
                  <span class="text-red-500">
                    {{$errors->get('editora')[0]}}
                  </span>
              @enderror
            </div>
            
            <!-- Ano de Publicação -->
            <div class="flex flex-col gap-1">
              <label for="ano_publicacao" class="text-xs font-medium text-gray-500 tracking-wide">Ano de publicação</label>
              <input id="ano_publicacao" name="ano_publicacao" type="number" placeholder="Ex: 1899" min="1000" max="2099"
              class="border border-gray-200 rounded-lg px-3 py-2 text-sm text-gray-800 placeholder-gray-300 outline-none focus:border-gray-400 focus:ring-4 focus:ring-gray-100 transition-all" required value="{{old('ano_publicacao', $livro->ano_publicacao)}}"/>
              @error('ano_publicacao')
                  <span class="text-red-500">
                    {{$errors->get('ano_publicacao')[0]}}
                  </span>
              @enderror
            </div>
            
            <!-- Gênero -->
            <div class="flex flex-col gap-1 sm:col-span-2">
              <label for="genero" class="text-xs font-medium text-gray-500 tracking-wide">Gênero</label>
              <select id="genero" name="genero" required
              class="border border-gray-200 rounded-lg px-3 py-2 pr-8 text-sm text-gray-800 outline-none focus:border-gray-400 focus:ring-4 focus:ring-gray-100 transition-all cursor-pointer bg-white">
              <option value="" disabled {{ old('genero', $livro->genero) == '' ? 'selected' : '' }}>Selecione um gênero</option>
              <option {{ old('genero', $livro->genero) == 'Romance' ? 'selected' : '' }}>Romance</option>
              <option {{ old('genero', $livro->genero) == 'Ficção científica' ? 'selected' : '' }}>Ficção científica</option>
              <option {{ old('genero', $livro->genero) == 'Fantasia' ? 'selected' : '' }}>Fantasia</option>
              <option {{ old('genero', $livro->genero) == 'Terror' ? 'selected' : '' }}>Terror</option>
              <option {{ old('genero', $livro->genero) == 'Mistério' ? 'selected' : '' }}>Mistério</option>
              <option {{ old('genero', $livro->genero) == 'Biografia' ? 'selected' : '' }}>Biografia</option>
              <option {{ old('genero', $livro->genero) == 'História' ? 'selected' : '' }}>História</option>
              <option {{ old('genero', $livro->genero) == 'Autoajuda' ? 'selected' : '' }}>Autoajuda</option>
              <option {{ old('genero', $livro->genero) == 'Poesia' ? 'selected' : '' }}>Poesia</option>
              <option {{ old('genero', $livro->genero) == 'Outro' ? 'selected' : '' }}>Outro</option>
            </select>
              @error('genero')
                  <span class="text-red-500">
                    {{$errors->get('genero')[0]}}
                  </span>
              @enderror
          </div>
          
          <!-- Resumo -->
          <div class="flex flex-col gap-1 sm:col-span-2">
            <label for="resumo" class="text-xs font-medium text-gray-500 tracking-wide">Resumo</label>
            <textarea id="resumo" name="resumo"  rows="4" placeholder="Escreva uma breve sinopse do livro..."
            oninput="document.getElementById('charCount').textContent = this.value.length + ' caracteres'"
            class="border border-gray-200 rounded-lg px-3 py-2 text-sm text-gray-800 placeholder-gray-300 outline-none focus:border-gray-400 focus:ring-4 focus:ring-gray-100 transition-all resize-y leading-relaxed">{{old('resumo', $livro->resumo)}}</textarea>
            <span id="charCount" class="text-xs text-gray-400 text-right">0 caracteres</span>
              @error('resumo')
                  <span class="text-red-500">
                    {{$errors->get('resumo')[0]}}
                  </span>
              @enderror
          </div>
          
          <!-- Imagem -->
          <div class="flex flex-col gap-1 sm:col-span-2">
            <label class="text-xs font-medium text-gray-500 tracking-wide">Imagem da capa</label>
            <div id="uploadArea"
            class="relative flex flex-col items-center justify-center gap-4 border-2 border-dashed border-gray-200 rounded-lg p-6 text-center cursor-pointer hover:border-gray-400 hover:bg-gray-50 transition-all min-h-28">
            <input type="file" name="imagem" accept="image/*" onchange="previewImage(event)"
            class="absolute inset-0 opacity-0 cursor-pointer w-full h-full z-10" />
            
            <div class="flex items-center justify-center gap-8 pointer-events-none w-full">
                <!-- Imagem Atual -->
                @if($livro->imagem)
                <div class="flex flex-col items-center gap-2">
                    <span class="text-xs text-gray-500 font-medium">Capa Atual</span>
                    <img src="{{ asset('storage/' . $livro->imagem) }}" class="w-16 h-24 object-cover rounded border border-gray-200 shadow-sm" alt="Capa atual" />
                </div>
                @endif

                <!-- Ícone e texto central -->
                <div id="uploadInfo" class="flex flex-col items-center gap-1 transition-all">
                    <i id="uploadIcon" class="ti ti-photo-up text-3xl text-gray-300" aria-hidden="true"></i>
                    <span id="uploadTitle" class="text-sm font-medium text-gray-400">Alterar capa (opcional)</span>
                    <span id="uploadSub" class="text-xs text-gray-300 truncate max-w-[200px]">PNG, JPG ou WEBP — máx. 5 MB</span>
                </div>

                <!-- Nova Imagem (Preview) -->
                <div id="previewContainer" class="hidden flex-col items-center gap-2">
                    <span class="text-xs text-indigo-500 font-bold">Nova Capa</span>
                    <img id="preview" class="w-16 h-24 object-cover rounded border border-indigo-200 shadow-sm" alt="Nova capa" />
                </div>
            </div>
          </div>
              @error('imagem')
                  <span class="text-red-500">
                    {{$errors->get('imagem')[0]}}
                  </span>
              @enderror
        </div>
        
        <!-- Divider -->
        <div class="sm:col-span-2 border-t border-gray-100"></div>
        
        <!-- Botão -->
        <div class="sm:col-span-2">
          <button  type="submit"
          class="w-full flex items-center justify-center gap-2 bg-gray-900 hover:bg-gray-700 text-white text-sm font-medium rounded-lg px-4 py-3 transition-colors active:scale-[.99]">
          <i class="ti ti-circle-check text-lg" aria-hidden="true"></i>
          Editar
        </button>
      </div>
    </form>

    @if (session()->has('livro_error'))
       <span class="text-red-500">
          {{session()->get('livro_error')}}
        </span>
    @endif
      
    </div>
  </div>
  
</main>

    @include('components/footer')

    <script>
        function previewImage(event) {
            const input = event.target;
            const preview = document.getElementById('preview');
            const previewContainer = document.getElementById('previewContainer');
            const uploadSub = document.getElementById('uploadSub');

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    previewContainer.classList.remove('hidden');
                    previewContainer.classList.add('flex');
                    uploadSub.textContent = input.files[0].name;
                }
                
                reader.readAsDataURL(input.files[0]);
            } else {
                preview.src = "";
                previewContainer.classList.add('hidden');
                previewContainer.classList.remove('flex');
                uploadSub.textContent = "PNG, JPG ou WEBP — máx. 5 MB";
            }
        }
    </script>
</body>

</html>
