<?php

namespace App\Http\Controllers;

use App\Atividade;
use App\Item;
use App\Movimentacao;
use App\Http\Requests\MovimentacoesRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use DataTables;
use Session;
Use form;
Use Redirect;


class MovimentacoesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function data_tables()
    {
        $movimentacoes = Movimentacao::select(['*'])->get();
        return Datatables::of($movimentacoes)
            ->addColumn('action', function ($movimentacao) {
                return  '<div class="col-xs-6 text-left">'.
                            '<div class="previous">'.
                                '<a href="'.Route('movimentacoes.edit',[$movimentacao->id_movimentacoes]).'" class="btn btn-primary">Editar</a>'
                            .'</div>'
                        .'</div>';
            })
            ->editColumn('tipo_movimentacoes', function($movimentacao){
                return $movimentacao->tipo_movimentacoes==="S"?'Saída':'Entrada';
            })
            ->editColumn('data', function($movimentacao){
                return date( 'd/m/Y' , strtotime($movimentacao->data));
            })
            ->editColumn('id_itens_itens', function($movimentacao){
                return $movimentacao->item['nome'];
            })
            ->setRowClass(function ($movimentacoes) {
                if($movimentacoes->tipo_movimentacoes === "E"){
                    return 'table-success';
                }else if($movimentacoes->tipo_movimentacoes === "S"){
                    return 'table-danger';
                }
            })
            ->make(true);
    }

    public function index()
    {
        $movimentacao = Movimentacao::all();
        $item = Item::all();
        return view('movimentacoes.index')->with(compact('movimentacao','item'));
    }

    public function create_by_activity($id){

        $item = Item::all();
        $atividade = $id;
        return view('movimentacoes.create')->with(compact('movimentacao','item', 'atividade'));
    }

    public function create_by_activity_post(){

    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $item = Item::all();
        $atividades = Atividade::all();
        return view('movimentacoes.create')->with(compact('movimentacao','item', 'atividades'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MovimentacoesRequest $request)
    {


        $movimentacao = new Movimentacao();
        $item = Item::find($request->id_itens_itens);

        $movimentacao->custo = str_replace('.','',$request->custo);
        $movimentacao->custo =str_replace(',', '.',$movimentacao->custo);
        $movimentacao->quantidade = str_replace('.','',$request->quantidade);
        $movimentacao->quantidade =str_replace(',', '.',$movimentacao->quantidade);
        $movimentacao->data = $request->data;
        $movimentacao->tipo_movimentacoes = $request->tipo_movimentacoes;
        $movimentacao->descricao =strtoupper($request->descricao);
        $movimentacao->id_itens_itens = $request->id_itens_itens;
        $movimentacao->id_atividades_atividades = $request->id_atividades_atividades;



        //dd($movimentacao->save()->toSql());
        if($movimentacao->save() ){
            if(isset($movimentacao->id_atividades_atividades)){
                Session::flash('alert-success', 'Movimentação cadastrada com sucesso! Para cadastrar outra para a mesma atividade <a href="'. Route('transaction_by_activity',[$movimentacao->id_atividades_atividades]).'">clique aqui</a>!');

            }else{
                Session::flash('alert-success', 'Movimentação cadastrada com sucesso!');
            }
            return redirect()->route('movimentacoes.index');
        }else{
            Session::flash('alert-danger', 'Não foi possível cadastrar essa movimentação!');
            return redirect()->route('movimentacoes.index');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Movimentacao  $movimentacao
     * @return \Illuminate\Http\Response
     */
    public function show(Movimentacao $movimentacao)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Movimentacao  $movimentacao
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $movimentacao = Movimentacao::find($id);
        $item = Item::all();
        $atividades = Atividade::all();
        return view('movimentacoes.edit')->with(compact('movimentacao', 'item', 'atividades'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Movimentacao  $movimentacao
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $movimentacao= Movimentacao::find($id);
        $item= Item::find($movimentacao->id_itens_itens);



        $movimentacao->custo = str_replace('.','',$request->custo);
        $movimentacao->custo =str_replace(',', '.',$movimentacao->custo);
        $movimentacao->quantidade = str_replace('.','',$request->quantidade);
        $movimentacao->quantidade =str_replace(',', '.',$movimentacao->quantidade);
        $movimentacao->data = $request->data;
        $movimentacao->tipo_movimentacoes = $request->tipo_movimentacoes;
        $movimentacao->descricao = $request->descricao;
        $movimentacao->id_itens_itens = $request->id_itens_itens;
        $movimentacao->id_atividades_atividades = $request->id_atividades_atividades;

        if($movimentacao->update()){
            Session::flash('alert-success', 'Movimentação atualizada com sucesso!');
            return redirect()->route('movimentacoes.index');
        }else{
            Session::flash('alert-danger', 'Não foi possível atualizar essa movimentação!');
            return redirect()->route('movimentacoes.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Movimentacao  $movimentacao
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $movimentacao = Movimentacao::find($id);


        if($movimentacao->delete() )
        {
            Session::flash('alert-sucess', 'Movimentação deletada com sucesso!');
            return response('Movimentação deletada com sucesso!',200);
        }else
        {
            Session::flash('alert-danger', 'Movimentação não pode ser deletada!');
            return response('Movimentação não pode ser deletada!',405);
        }
    }
}
