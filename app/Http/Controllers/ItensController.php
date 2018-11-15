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

                return '<div class = "col-md-10 offset-1" style="margin-left: 14%">'. '<div class="panel-footer row"><!-- panel-footer -->'.'<div class="col-xs-6 text-center">'.'<div class="previous">'.'<a href="'.Route('itens.edit',[$item->id_itens]).'" class="btn btn-primary"><i class="fas fa-edit"></i>Editar</a>'.'</div>
                        '.'</div>'.'<div class="col-xs-6 text-right">'.'<div style="margin-left:6%">'.'<meta name="csrf-token" content="'.csrf_token().'">
 <button type="button" class="confirm-btn btn btn-danger" value="'.$item->id_itens.'" onclick="(delete_btn(this))"><i class="fas fa-trash-alt"></i>deletar</button></div>'.'</div>'.'</div>'.'</div>';
            })
            ->editColumn('id_unidades_unidades', function ($item){
                return $item->unidades['nome'].'('.$item->unidades['sigla'].')';
            })
            ->editColumn('id_tipos_itens_tipos_itens', function ($item){
                return $item->tipo_item['nome'];
            })
            ->editColumn('quantidade', function ($item){
                $pos = DB::table('movimentacoes')->select(DB::raw('coalesce(sum(quantidade),0)'))->where([['tipo_movimentacoes','=','E'],['id_itens_itens',$item->id_itens]])->first();
                $neg = DB::table('movimentacoes')->select(DB::raw('coalesce(sum(quantidade),0)'))->where([['tipo_movimentacoes','=','S'],['id_itens_itens',$item->id_itens]])->first();
                //dd($neg->coalesce);

                return $pos->coalesce-$neg->coalesce;
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
        $item->nome = mb_strtoupper($request->nome);
        $custo_por_unidade = str_replace('.', '', $request->custo_por_unidades);
        $item->custo_por_unidades = str_replace(',', '.', $custo_por_unidade);
        $quantidade = str_replace('.', '', $request->quantidade);
        $item->quantidade = str_replace(',', '.', $quantidade);
        $item->id_unidades_unidades = $request->id_unidades_unidades;
        $item->id_tipos_itens_tipos_itens = $request->id_tipos_itens_tipos_itens;


        if($item->save()){
            if($item->quantidade > 0){
                $movimentacao = new Movimentacao();
                $movimentacao->custo = $item->custo_por_unidades * $item->quantidade;
                $movimentacao->quantidade = abs($item->quantidade);
                $movimentacao->tipo_movimentacoes = 'E';
                $movimentacao->id_itens_itens = $item->id_itens;
                var_dump($movimentacao -> id_itens_itens);
                $movimentacao->descricao = "Movimentacao automatica, cadastro de item.";
                $movimentacao->save();
            }else if($item->quantidade<0){
                $movimentacao = new Movimentacao();
                $movimentacao->custo = $item->custo_por_unidades * $item->quantidade;
                $movimentacao->quantidade = abs($item->quantidade);
                $movimentacao->tipo_movimentacoes = 'S';
                $movimentacao->id_itens_itens = $item->id_itens;
                $movimentacao->descricao = "Movimentacao automatica, cadastro de item.";
                $movimentacao->save();
            }
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
        $item->nome = mb_strtoupper($request->nome);
        $request->custo_por_unidade = str_replace('.', '', $request->custo_por_unidades);
        $item->custo_por_unidades = str_replace(',', '.', $request->custo_por_unidades);
        $request->quantidade = str_replace('.', '', $request->quantidade);
        $item->quantidade = str_replace(',', '.', $request->quantidade);
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
            return response('item removido com sucesso!',200);
        }else{
            Session::flash('alert-danger', 'Esse item não pode ser removido pois já está sendo usado em movimentações dentro do sistema!');
            return response('Erro ao deletar item!', 405);
        }
    }
}
