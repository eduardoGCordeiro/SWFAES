<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/inicio', 'HomeController@index')->name('home');


Route::resource('administradores', 'AdministradoresController');

Route::resource('atividades', 'AtividadesController');

Route::resource('cadernetas', 'CadernetasController');

Route::resource('culturas', 'CulturasController');

Route::resource('funcionarios', 'FuncionariosController');

Route::resource('itens', 'ItensController');

Route::resource('movimentacoes', 'MovimentacoesController');

Route::resource('requisicoes', 'RequisicoesController');

Route::resource('talhoes', 'TalhoesController');

Route::resource('usuarios', 'UsuariosController');