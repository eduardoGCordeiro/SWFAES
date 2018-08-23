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


//Route::resource('administradores', 'AdministradoresController');

Route::resource('atividades', 'AtividadesController');

Route::resource('funcionarios', 'FuncionariosController');

Route::resource('culturas', 'CulturasController');

//Route::resource('funcionarios', 'FuncionariosController');
//-------------------- rotas referentes à ItensController --------------------- //
// data tables
Route::get('itens/getdata', 'ItensController@data_tables')->name('data_table_itens');
//ressource
Route::resource('itens', 'ItensController');
//------------------------------------------------------------------------------//

//-------------------- rotas referentes à ItensController --------------------- //
// data tables
Route::get('unidades/getdata', 'UnidadesController@data_tables')->name('data_table_unidades');
//ressource
Route::resource('unidades', 'UnidadesController');
//------------------------------------------------------------------------------//

Route::resource('movimentacoes', 'MovimentacoesController');

Route::resource('requisicoes', 'RequisicoesController');
Route::resource('requisicoes/{id}/moderar', 'RequisicoesController@moderarget');
Route::resource('talhoes', 'TalhoesController');



Route::resource('usuarios', 'UsuariosController');

