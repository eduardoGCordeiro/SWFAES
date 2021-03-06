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



//Route::resource('funcionarios', 'FuncionariosController');

//-------------------- rotas referentes à ItensController --------------------- //
// data tables
//Route::get('adms_talhoes/{id}/getdata', 'AdmsTalhoesController@data_tables')->name('data_table_adms_talhoes');
//ressource
Route::resource('adms_talhoes', 'AdmsTalhoesController')->middleware('auth');
//------------------------------------------------------------------------------//


//-------------------- rotas referentes à AtividadesController --------------------- //
// data tables
Route::get('atividades/{id}/getdata', 'AtividadesController@data_tables')->name('data_table_atividades');
Route::get('atividades/getdata', 'AtividadesController@data_tables_all')->name('data_table_atividades_all');
Route::get('atividades/{atividade}/atividades_list_transactions', 'AtividadesController@atividades_list_transactions')->name('atividades_list_transactions');

//ressource

Route::resource('atividades', 'AtividadesController')->middleware('auth');
//------------------------------------------------------------------------------//






//-------------------- rotas referentes à RequisicoesController --------------------- //
// data tables
Route::get('requisicoes/getdata', 'RequisicoesController@data_tables')->name('data_table_requisicoes');
//ressource
Route::get('requisicoes/{id}/moderar', 'RequisicoesController@moderar_get')->name('moderar_get');
Route::post('requisicoes/{id}/moderar', 'RequisicoesController@moderar')->name('moderar_post');
Route::resource('requisicoes', 'RequisicoesController')->middleware('auth');
//------------------------------------------------------------------------------//








//-------------------- rotas referentes à ItensController --------------------- //
// data tables
Route::get('itens/getdata', 'ItensController@data_tables')->name('data_table_itens');
//ressource
Route::resource('itens', 'ItensController')->middleware('auth');
//------------------------------------------------------------------------------//----------------- rotas referentes à FuncionariosController --------------------- //
// data tables
Route::get('funcionarios/getdata', 'FuncionariosController@data_tables')->name('data_table_funcionarios');
Route::get('funcionarios/{id}/getdata_talhoes', 'FuncionariosController@data_tables_talhoes')->name('data_table_funcionarios_talhoes');
//ressource
Route::resource('funcionarios', 'FuncionariosController')->middleware('auth');
//------------------------------------------------------------------------------//

//-------------------- rotas referentes à ItensController --------------------- //
// data tables
Route::get('unidades/getdata', 'UnidadesController@data_tables')->name('data_table_unidades');
//ressource
Route::resource('unidades', 'UnidadesController')->middleware('auth');
//------------------------------------------------------------------------------//

//-------------------- rotas referentes à TipoItemController ------------------ //
// data tables
Route::get('tipo_item/getdata', 'TipoItemController@data_tables')->name('data_table_tipo_item');
//ressource
Route::resource('tipo_item', 'TipoItemController')->middleware('auth');
//------------------------------------------------------------------------------////-------------------- rotas referentes à CulturasController ------------------ //
// data tables
Route::get('culturas/getdata', 'CulturasController@data_tables')->name('data_table_culturas');
//finalizar
Route::post('culturas/{id}/finalizar', 'CulturasController@finalizar')->name('finalizar_culturas');
//ressource
Route::resource('culturas', 'CulturasController')->middleware('auth');
//------------------------------------------------------------------------------//



//-------------------- rotas referentes à MovimentacoesController --------------------- //
// data tables
Route::get('movimentacoes/getdata', 'MovimentacoesController@data_tables')->name('data_table_movimentacoes');
//ressource
Route::get('movimentacoes/{atividade}/create', 'MovimentacoesController@create_by_activity')->name('transaction_by_activity');
Route::post('movimentacoes/{atividade}/create', 'MovimentacoesController@create_by_activity_post')->name('transaction_by_activity_post');
Route::resource('movimentacoes', 'MovimentacoesController')->middleware('auth');
//------------------------------------------------------------------------------//


//-------------------- rotas referentes à TalhoesController --------------------- //
//ressource
Route::resource('talhoes', 'TalhoesController')->middleware('auth');
// data tables
Route::get('talhoes/getdata', 'TalhoesController@data_tables')->name('data_table_talhoes');
//------------------------------------------------------------------------------//

//-------------------- rotas referentes à FuncionariosController ------------------- //

//ressource
//------------------------------------------------------------------------------//


//-------------------- rotas referentes à AtividadesController --------------------- //
// data tables
Route::get('tipos_atividades/getdata', 'TiposAtividadesController@data_tables')->name('data_table_tipos_atividades');
//ressource
Route::resource('tipos_atividades', 'TiposAtividadesController')->middleware('auth');
//------------------------------------------------------------------------------//


//--------------referente à RelatoriosController ---------------------------//
Route::get('relatorios/estoque', 'RelatoriosController@estoque')->name('estoque-rel');
Route::get('relatorios/atividades', 'RelatoriosController@atividades')->name('atividades-rel');
Route::get('relatorios/movimentacoes', 'RelatoriosController@movimentacoes')->name('movimentacoes-rel');
Route::resource('relatorios', 'RelatoriosController')->middleware('auth');