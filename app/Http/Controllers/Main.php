<?php

namespace App\Http\Controllers;

use App\Models\Livro;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

use function Laravel\Prompts\title;

class Main extends Controller
{
    public function index(){
        $model = new Livro();
        $livros = $model->whereNull('deleted_at')->get();

        $data = [
            'title' => 'Biblioteca Online',
            'livros' => $livros
        ];
        return view('index', $data);
    }


    
    public function painel(){
        $data = [
            'title' => 'Painel Administrativo',
            'livros' => $this->_get_livros()
        ];
        return view('painel', $data);
    }  
    //login
    public function login(){
        $data = [
            'title' => 'Login'
        ];

        return view('login', $data);
    }

    public function login_submit(Request $request){
        $request->validate([
            'email' => 'required|min:3',
            'password' => 'required|min:3',
        ], [
            'email.required' => 'Campo obrigatório.',
            'email.min' => 'Campo deve ter no mínimo 3 caracteres.',
            'senha.required' => 'Campo obrigatório.',
            'senha.min' => 'Campo deve ser maior que 3.',
        ]);

        $email = $request->input('email');
        $password = $request->input('password');

        $model = new User();
        $user = $model->where('email', '=', $email)
                      ->whereNull('deleted_at')
                      ->first();
        if($user) {
            if(password_verify($password, $user->password)){
                $session_data = [
                    'id' => $user->id,
                    'name' => $user->name
                ];
                session()->put($session_data);
                return redirect()->route('painel');
            }
        }

        return redirect()->route('login')->withInput()->with('login_error', 'Login Inválido');
    }

    //logout
    public function logout(){
        session()->flush();
        return redirect()->route('login');
    }


    //novo livro
    public function new_livro(){
        $data = [
            'title' => 'Novo livro'
        ];
        
        return view('new_livro', $data);
    }

    public function new_livro_submit(Request $request){

        $request->validate([
            'autor' => 'required|min:3|max:200',
            'titulo' => 'required|min:2|max:200',
            'editora' => 'required|min:3|max:200',
            'resumo' => 'required|min:3|max:1000',
            'ano_publicacao' => 'required',
            'genero' => 'required',
            'imagem' => 'required|max:5120',
        ], [
            'titulo.required' => 'Campo obrigatório.',
            'titulo.min' => 'Campo deve ter no mínimo 2 caracteres.',
            'titulo.max' => 'Campo deve ter no máximo 200 caracteres.',

            'editora.required' => 'Campo obrigatório.',
            'editora.min' => 'Campo deve ter no mínimo 3 caracteres.',
            'editora.max' => 'Campo deve ter no mínimo 200 caracteres.',

            'autor.required' => 'Campo obrigatório.',
            'autor.min' => 'Campo deve ter no mínimo 3 caracteres.',
            'autor.max' => 'Campo deve ter no mínimo 200 caracteres.',

            'resumo.required' => 'Campo obrigatório.',
            'resumo.min' =>'Campo deve ter no mínimo 3 caracteres.',
            'resumo.max' => 'Campo grande demais.',

            'ano_publicacao.required' => 'Campo obrigatório.',
            'genero.required' => 'Campo obrigatório.',
            'imagem.required' => 'Campo obrigatório.',
            'imagem.max' => 'Imagem muito grande',
        ]);

        $livro_autor = $request->input('autor');
        $livro_titulo = $request->input('titulo');
        $livro_editora = $request->input('editora');
        $livro_resumo = $request->input('resumo');
        $livro_ano_publicacao = $request->input('ano_publicacao');
        $livro_genero = $request->input('genero');
        $request->file('imagem');

        $model = new Livro();
        $livro = $model->where('user_id', '=', session('id'))
                       ->where('titulo', '=', $livro_titulo)
                       ->where('autor', '=', $livro_autor)
                       ->where('editora', '=', $livro_editora)
                       ->where('ano_publicacao', '=', $livro_ano_publicacao)
                       ->whereNull('deleted_at')
                       ->first();
        if($livro){
            return redirect()->route('new_livro')->with('livro_error', "Esse livro já foi cadastrado.");
        }

        $livro_imagem = null;

        if($request->hasFile('imagem')) {

            $livro_imagem = $request
                ->file('imagem')
                ->store('livros', 'public');

        }

        // inserir no banco
        $model->user_id = session('id');
        $model->autor = $livro_autor;
        $model->titulo = $livro_titulo;
        $model->editora = $livro_editora;
        $model->resumo = $livro_resumo;
        $model->ano_publicacao = $livro_ano_publicacao;
        $model->genero = $livro_genero;
        $model->imagem = $livro_imagem;
        $model->created_at = date('Y-m-d H:i:s');
        $model->save();

        return redirect()->route('painel');
    }

    // exibir livro pelo id
    public function livro_info($id){
        try{
            $id = Crypt::decrypt($id);
        } catch(\Exception $e){
            return redirect()->route('index');
        }

        $model = new Livro();

        $livro = $model->where('id', '=', $id)
                    ->whereNull('deleted_at')
                    ->first();

        if(empty($livro)){
            return redirect()->route('index');
        }

        $data = [
            'title' => $livro->titulo,
            'livro' => $livro
        ];

        return view('livro_info', $data);
    }

    // edit livro
    public function edit_livro($id){
        try{
            $id = Crypt::decrypt($id);
        } catch(\Exception $e){
            return redirect()->route('painel');
        }

        $model = new Livro();
        $livro = $model->where('id', '=', $id)->first();

        if(empty($livro)){
            return redirect()->route('painel');
        }

        $data = [
            'title' => 'Editar Livro',
            'livro' => $livro
        ];

        return view('edit_livro', $data);
    }

    public function edit_livro_submit(Request $request){

        $request->validate([
            'autor' => 'required|min:3|max:200',
            'titulo' => 'required|min:2|max:200',
            'editora' => 'required|min:3|max:200',
            'resumo' => 'required|min:3|max:1000',
            'ano_publicacao' => 'required',
            'genero' => 'required',
            'imagem' => 'nullable|max:5120',
        ], [
            'titulo.required' => 'Campo obrigatório.',
            'titulo.min' => 'Campo deve ter no mínimo 2 caracteres.',
            'titulo.max' => 'Campo deve ter no máximo 200 caracteres.',

            'editora.required' => 'Campo obrigatório.',
            'editora.min' => 'Campo deve ter no mínimo 3 caracteres.',
            'editora.max' => 'Campo deve ter no mínimo 200 caracteres.',

            'autor.required' => 'Campo obrigatório.',
            'autor.min' => 'Campo deve ter no mínimo 3 caracteres.',
            'autor.max' => 'Campo deve ter no mínimo 200 caracteres.',

            'resumo.required' => 'Campo obrigatório.',
            'resumo.min' =>'Campo deve ter no mínimo 3 caracteres.',
            'resumo.max' => 'Campo grande demais.',

            'ano_publicacao.required' => 'Campo obrigatório.',
            'genero.required' => 'Campo obrigatório.',
            'imagem.required' => 'Campo obrigatório.',
            'imagem.max' => 'Imagem muito grande',
        ]);

        $id = null;
        try {
            $id = Crypt::decrypt($request->input('id'));
        } catch (\Exception $e) {
            return redirect()->route('painel');
        }


        $livro_autor = $request->input('autor');
        $livro_titulo = $request->input('titulo');
        $livro_editora = $request->input('editora');
        $livro_resumo = $request->input('resumo');
        $livro_ano_publicacao = $request->input('ano_publicacao');
        $livro_genero = $request->input('genero');
        $request->file('imagem');

        $model = new Livro();
        $livro = $model->where('user_id', '=', session('id'))
                       ->where('titulo', '=', $livro_titulo)
                       ->where('autor', '=', $livro_autor)
                       ->where('editora', '=', $livro_editora)
                       ->where('ano_publicacao', '=', $livro_ano_publicacao)
                       ->where('id', '!=', $id)
                       ->whereNull('deleted_at')
                       ->first();
        if($livro){
            return redirect()->route('edit_livro', ['id' => Crypt::encrypt($id)])->with('livro_error', "Esse livro já foi cadastrado.");
        }

        $update_data = [
            'autor' => $livro_autor,
            'titulo' => $livro_titulo,
            'editora' => $livro_editora,
            'resumo' => $livro_resumo,
            'ano_publicacao' => $livro_ano_publicacao,
            'genero' => $livro_genero,
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        if($request->hasFile('imagem')) {
            $update_data['imagem'] = $request->file('imagem')->store('livros', 'public');
        }

        $model->where('id', '=', $id)->update($update_data);

        return redirect()->route('painel');
    }


    // deletar livro
    public function delete_livro($id){
        try {
            $id = Crypt::decrypt($id);
        } catch (\Exception $e) {
            return redirect()->route('painel');
        }

        $model = new Livro();
        $livro = $model->where('id', '=', $id)->first();

        if(empty($livro)){
            return redirect()->route('painel');
        }

        $data = [
            'title' => 'Excluir Livro',
            'livro' => $livro
        ];

        return view('delete_livro', $data);
    }

    public function delete_livro_confirm($id){

        try {
            $id = Crypt::decrypt($id);
        } catch (\Exception $e) {
            return redirect()->route('painel');
        }

        $model = new Livro();
        $model->where('id', '=', $id)
              ->update([
                'deleted_at' => date('Y-m-d H:i:s')
              ]);

        return redirect()->route('painel');
    }


    // métodos
    private function _get_livros(){
        $model = new Livro();
        return $model->where('user_id', '=', session()->get('id'))
                     -> whereNull('deleted_at')
                     -> get();
    }
}
