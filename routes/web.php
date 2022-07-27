<?php

use App\Http\Controllers\ContatoController;
use App\Http\Controllers\PrincipalController;
use App\Http\Controllers\SobreNosController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [PrincipalController::class, 'principal'])->name('site.index');

Route::get('/sobre-nos', [SobreNosController::class, 'sobreNos'])->name('site.sobrenos');

Route::get('/contato', [ContatoController ::class, 'contato'])->name('site.contato');
Route::post('/contato', [ContatoController ::class, 'salvar'])->name('site.contato');

Route::get('/login', [ContatoController ::class, 'contato'])->name('site.login');


Route::prefix('/app')->group(function(){

    Route::get('/clientes', [ContatoController ::class, 'contato'])->name('app.clientes');

    Route::get('/fornecedores', [ContatoController ::class, 'contato'])->name('app.fornecedores');

    Route::get('/produtos', [ContatoController ::class, 'contato'])->name('app.produtos');
});

Route::fallback(function(){
    Echo 'rota não exite <a href="'.route('site.index').'">Clique aqui</a>';
});

