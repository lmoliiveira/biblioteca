<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Main;

Route::get('/', [Main::class, 'index'])->name('index');
Route::get('/livro_info/{id}', [Main::class, 'livro_info'])->name('livro_info');

Route::middleware('CheckLogin')->group(function(){
    Route::get('/painel', [Main::class, 'painel'])->name('painel');
    Route::get('/logout', [Main::class, 'logout'])->name('logout');

    //livros
    Route::get('/new_livro', [Main::class, 'new_livro'])->name('new_livro');
    Route::post('/new_livro_submit', [Main::class, 'new_livro_submit'])->name('new_livro_submit');

    //livro edit
    Route::get('/edit_livro/{id}', [Main::class, 'edit_livro'])->name('edit_livro');
    Route::post('/edit_livro_submit', [Main::class, 'edit_livro_submit'])->name('edit_livro_submit');

    //livro delete
    Route::get('/delete_livro/{id}', [Main::class, 'delete_livro'])->name('delete_livro');
    Route::get('/delete_livro_confirm/{id}', [Main::class, 'delete_livro_confirm'])->name('delete_livro_confirm');
});
    
Route::middleware('CheckLogout')->group(function(){
    Route::get('/login', [Main::class, 'login'])->name('login');
    Route::post('/login_submit', [Main::class, 'login_submit'])->name('login_submit');
});