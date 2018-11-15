<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TipoItemRequest;
use App\TipoItem;
use App\Item;
use Yajra\Datatables\Datatables;
use Session;
use Form;
use Illuminate\Support\Facades\Gate;

class TipoItemController extends Controller
{
    public function index()
    {
        return view('tipo_itens.index');
    }

    public function data_tables()
    {
         $tipos = TipoItem::select(['id_tipos_itens', 'nome'])->get();

        return Datatables::of($tipos)
            ->addColumn('action', function ($tipo) {
                return '<div class = "col-md-10" style="margin-rigth: 14%">'. '<div class="panel-footer row" style="margin-rigth:80%"><!-- panel-footer -->'.'<div class="col-xs-6 text-center">'.'<div class="previous">'.'<a href="'.Route('tipo_item.edit',[$tipo->id_tipos_itens]).'" class="btn btn-primary"><i class="fas fa-edit"></i>Editar</a>'.'</div>
                        '.'</div>'.'<div class="col-xs-6 text-right">'.'<div style="margin-left:6%">'.'  <meta name="csrf-token" content="'.csrf_token().'">
 <button type="button" class="confirm-btn btn btn-danger" value="'.$tipo->id_tipos_itens.'" onclick="(delete_btn(this))"><i class="fas fa-trash-alt"></i>deletar</button>'.'</div>'.'</div>'.'</div>'.'</div>';
            })->make(true);
    }


    public function create()
    {
        if (Gate::denies('gerenciar')) {
            return abort(403);
        }
        return view('tipo_itens.create');
    }


    public function store(TipoItemRequest $request)
    {
        if (Gate::denies('gerenciar')) {
            return abort(403);
        }
        $tipo = new TipoItem();
        $tipo->nome = mb_strtoupper($request->nome);


        if($tipo->save()){
            Session::flash('alert-success', 'Novo tipo de itens cadastrado com sucesso!');
            return redirect()->route('tipo_item.index');
        }else{
            Session::flash('alert-danger', 'Erro ao cadastrar tipo de item!');
            return redirect()->route('tipo_item.index');
        }
    }


    public function show($id)
    {

    }


    public function edit($id)
    {
        if (Gate::denies('gerenciar')) {
            return abort(403);
        }
        $tipo  =  TipoItem::find($id);

        if(!$tipo){
            Session::flash('alert-danger','Esse tipo de item não existe');
            return redirect()->route('tipo_item.index');
        }
        $itens = Item::where('id_tipos_itens_tipos_itens',$id)->get();
        if(!count($itens)){
            $tipo = TipoItem::find($id);
            return view('tipo_itens.edit')->with(compact('tipo'));
        }else{
            Session::flash('alert-warning','Esse tipo de item não pode ser editado pois já está relacionado à um item!');
            return redirect()->back();
        }
    }


    public function update(TipoItemRequest $request,  $id)
    {
        if (Gate::denies('gerenciar')) {
            return abort(403);
        }
        //dd($request);
        $tipo = TipoItem::find($id);
        $tipo->nome = mb_strtoupper($request->nome);

        if($tipo->update()){

            Session::flash('alert-success', 'Editado com sucesso!');
            return redirect()->route('tipo_item.index');
        }else{
            Session::flash('alert-danger', 'Erro ao editar!');
            return redirect()->route('tipo_item.index');
        }
    }


    public function destroy($id)
    {
        if (Gate::denies('gerenciar')) {
            return abort(403);
        }
        $tipo = TipoItem::find($id);
        $movimentacoes = $tipo->movimentacoes;
        if(count($movimentacoes)){
            Session::flash('alert-danger', 'Erro ao excluir pois já está relacionado com um item!');
            return response('erro ao deletar tipo!', 405);
        }
        if($tipo->delete()){

            Session::flash('alert-success', 'deletado com sucesso!');
            return response('sucesso ao deletar tipo!', 200);
        }else{
            Session::flash('alert-danger', 'Erro ao editar!');
            return response('erro ao deletar tipo!', 405);
        }
    }
}
