<?php

namespace App\Http\Controllers;

use App\Item;
use App\Unidade;
use App\TipoItem;
use App\Movimentacao;
use App\Http\Requests\ItensRequest;
use Illuminate\Http\Request;
use DB;
use DataTables;
use Redirect;
use Session;
use Illuminate\Support\Facades\Gate;

class ItensController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */



    public function index()
    {

        return view('itens.index');
    }

    public function data_tables()
    {
        //return \DataTables::of(Unidade::query())->make(true);
         $itens = Item::select(['*'])->get();
        // dd($itens[0]->unidade->nome);
        return Datatables::of($itens)
            ->addColumn('action', function ($item) {
                return '<a href="'.Route('itens.edit',[$item->id_itens]).'" class="btn btn-primary">Editar</a>'.'<form action="'.Route('itens.destroy',[$item->id_itens]).'" method="POST"> '.csrf_field().'
 <input name="_method" type="hidden" value="DELETE"> <button type="submit" class="btn btn-danger">deletar</button>';
            })
            ->editColumn('id_unidades_unidades', function ($item){
                return $item->unidades['nome'].'('.$item->unidades['sigla'].')';
            })
            ->editColumn('id_tipos_itens_tipos_itens', function ($item){
                return $item->tipo_item['nome'];
            })
            ->make(true);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Gate::denies('gerenciar-itens')) {
            return abort(403);
        }
        $unidades = Unidade::all();
        $tipos_itens = TipoItem::all();
        return view('itens.create')->with(compact('unidades','tipos_itens'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ItensRequest $request)
    {
        if (Gate::denies('gerenciar-itens')) {
            return abort(403);
        }
        $item = new Item();
        $item->nome = strtoupper($request->nome);
        $item->custo_por_unidades = $request->custo_por_unidades;
        $item->quantidade = $request->quantidade;
        $item->id_unidades_unidades = $request->id_unidades_unidades;
        $item->id_tipos_itens_tipos_itens = $request->id_tipos_itens_tipos_itens;

        if($item->save()){
            Session::flash('alert-success', 'Novo item cadastrado com sucesso!');
            return redirect()->route('itens.index');
        }else{
            Session::flash('alert-danger', 'Erro ao cadastrar item!');
            return redirect()->route('itens.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {



    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Gate::denies('gerenciar-itens')) {
            return abort(403);
        }
        $movimentacoes = Movimentacao::where('id_itens_itens',$id)->get();
        if(!count($movimentacoes)){
            $item = Item::find($id);
            $unidades = Unidade::all();
            $tipos_itens = TipoItem::all();
            return view('itens.edit')->with(compact('item','unidades','tipos_itens'));
        }else{
            Session::flash('alert-warning', 'Esse item não pode ser editado pois já está sendo usado em uma movimentação!');
            return redirect()->route('itens.index');
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(ItensRequest $request,$id)
    {
        if (Gate::denies('gerenciar-itens')) {
            return abort(403);
        }
        $item = Item::find($id);
        $item->nome = strtoupper($request->nome);
        $item->custo_por_unidades = $request->custo_por_unidades;
        $item->quantidade = $request->quantidade;
        $item->id_unidades_unidades = $request->id_unidades_unidades;
        $item->id_tipos_itens_tipos_itens = $request->id_tipos_itens_tipos_itens;

        if($item->save()){
            Session::flash('alert-success', 'Item editado com sucesso!');
            return redirect()->route('itens.index');
        }else{
            Session::flash('alert-danger', 'Erro ao editar item!');
            return redirect()->route('itens.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Gate::denies('gerenciar-itens')) {
            return abort(403);
        }
        $movimentacoes = Movimentacao::where('id_itens_itens',$id)->get();
        if(!count($movimentacoes)){
            $item = Item::find($id);
            $item->delete();
            Session::flash('alert-success', 'item removido com sucesso!');
            return redirect()->route('itens.index');
        }else{
            Session::flash('alert-danger', 'Esse item não pode ser removido pois já está sendo usado em movimentações dentro do sistema!');
            return redirect()->route('itens.index');
        }
    }
}
