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


//Route::resource('funcionarios', 'FuncionariosController');
//-------------------- rotas referentes à ItensController --------------------- //
// data tables
Route::get('adms_talhoes/{id}/getdata', 'AdmsTalhoesController@data_tables')->name('data_table_adms_talhoes');
//ressource
Route::resource('adms_talhoes', 'AdmsTalhoesController');
//------------------------------------------------------------------------------////-------------------- rotas referentes à ItensController --------------------- //
// data tables
Route::get('itens/getdata', 'ItensController@data_tables')->name('data_table_itens');
//ressource
Route::resource('itens', 'ItensController');
//------------------------------------------------------------------------------//----------------- rotas referentes à FuncionariosController --------------------- //
// data tables
Route::get('data_table_funcionarios/getdata', 'FuncionariosController@data_tables')->name('data_table_funcionarios');
//ressource
Route::resource('funcionarios', 'FuncionariosController');
//------------------------------------------------------------------------------//

//-------------------- rotas referentes à ItensController --------------------- //
// data tables
Route::get('unidades/getdata', 'UnidadesController@data_tables')->name('data_table_unidades');
//ressource
Route::resource('unidades', 'UnidadesController');
//------------------------------------------------------------------------------//

//-------------------- rotas referentes à TipoItemController ------------------ //
// data tables
Route::get('tipo_item/getdata', 'TipoItemController@data_tables')->name('data_table_tipo_item');
//ressource
Route::resource('tipo_item', 'TipoItemController');
//------------------------------------------------------------------------------////-------------------- rotas referentes à CulturasController ------------------ //
// data tables
Route::get('culturas/getdata', 'CulturasController@data_tables')->name('data_table_culturas');
//finalizar
Route::post('culturas/{id}/finalizar', 'CulturasController@finalizar')->name('finalizar_culturas');
//ressource
Route::resource('culturas', 'CulturasController');
//------------------------------------------------------------------------------//


Route::resource('movimentacoes', 'MovimentacoesController');

Route::resource('requisicoes', 'RequisicoesController');
Route::resource('requisicoes/{id}/moderar', 'RequisicoesController@moderarget');

//-------------------- rotas referentes à TalhoesController --------------------- //
//ressource
//-------------------- rotas referentes à FuncionariosController ------------------- //
// data tables
Route::get('talhoes/getdata', 'TalhoesController@data_tables')->name('data_table_talhoes');
//ressource
Route::resource('talhoes', 'TalhoesController');
//------------------------------------------------------------------------------//


//-------------------- rotas referentes à AtividadesController --------------------- //
// data tables
Route::get('tipos_atividades/getdata', 'TiposAtividadesController@data_tables')->name('data_table_tipos_atividades');
//ressource
Route::resource('tipos_atividades', 'TiposAtividadesController');
//------------------------------------------------------------------------------//


//-------------------- rotas referentes à AtividadesController --------------------- //
// data tables
Route::get('atividades/{id}/getdata', 'AtividadesController@data_tables')->name('data_table_atividades');
//ressource
Route::resource('atividades', 'AtividadesController');
//------------------------------------------------------------------------------//
//------------------------------------------------------------------------------//

Route::resource('usuarios', 'UsuariosController');

