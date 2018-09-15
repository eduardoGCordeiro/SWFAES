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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $item = Item::all();
        $atividade = Atividade::all();
        return view('movimentacoes.create')->with(compact('movimentacao','item', 'atividade'));

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

        $movimentacao->custo = str_replace(',', '.',str_replace('.','',$request->custo));
        $movimentacao->quantidade = $request->quantidade;
        $movimentacao->tipo_movimentacoes = $request->tipo_movimentacoes;
        $movimentacao->descricao = $request->descricao;
        $movimentacao->id_itens_itens = $request->id_itens_itens;
        $movimentacao->id_atividades_atividades = $request->id_atividades_atividades;


        if($movimentacao->tipo_movimentacoes == "E")
        {
            $item->quantidade += $movimentacao->quantidade;
        } else{
            $item->quantidade -= $movimentacao->quantidade;
        }

        if($movimentacao->save()){
            Session::flash('alert-success', 'Movimentação cadastrada com sucesso!');
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
        $atividade = Atividade::all();
        return view('movimentacoes.edit')->with(compact('movimentacao', 'item', 'atividade'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Movimentacao  $movimentacao
     * @return \Illuminate\Http\Response
     */
    public function update(MovimentacoesRequest $request, $id)
    {
        $movimentacao= Movimentacao::find($id);
        $item= Item::find($movimentacao->id_itens_itens);

        if($movimentacao->tipo_movimentacoes == 'E')
        {
            $item->quantidade -= $movimentacao->quantidade;
        } else{
            $item->quantidade += $movimentacao->quantidade;
        }

        $movimentacao->custo = str_replace(',', '.',str_replace('.','',$request->custo));
        $movimentacao->quantidade = $request->quantidade;
        $movimentacao->tipo_movimentacoes = $request->tipo_movimentacoes;
        $movimentacao->descricao = $request->descricao;
        $movimentacao->id_itens_itens = $request->id_itens_itens;
        $movimentacao->id_atividades_atividades = $request->id_atividades_atividades;

        if($movimentacao->tipo_movimentacoes == "E")
        {
            $item->quantidade += $movimentacao->quantidade;
        } else{
            $item->quantidade -= $movimentacao->quantidade;
        }

        if($movimentacao->save() && $item->save()){
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

        if($movimentacao->delete())
        {
            Session::flash('alert-sucess', 'Movimentação deletada com sucesso!');
            return redirect()->route('movimentacoes.index');
        }else
        {
            Session::flash('alert-danger', 'Movimentação não pode ser deletada!');
            return redirect()->route('movimentacoes.index');
        }
    }
}
