<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TipoItem;
use App\Item;
use Yajra\Datatables\Datatables;
use Session;
use Form;

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
                return '<a href="'.Route('tipo_item.edit',[$tipo->id_tipos_itens]).'" class="btn btn-primary">Editar</a>'.'<form action="'.Route('tipo_item.destroy',[$tipo->id_tipos_itens]).'" method="POST"> '.csrf_field().'
 <input name="_method" type="hidden" value="DELETE"> <button type="submit" class="btn btn-danger">deletar</button>';
            })->make(true);
    }


    public function create()
    {
        return view('tipo_itens.create');
    }


    public function store(Request $request)
    {
        $tipo = new TipoItem();
        $tipo->nome = strtoupper($request->nome);


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
        $itens = Item::where('id_tipos_itens_tipos_itens',$id)->get();
        if(!count($itens)){
            $tipo = TipoItem::find($id);
            return view('tipo_itens.edit')->with(compact('tipo'));
        }else{
            Session::flash('alert-warning','Esse tipo de item não pode ser editado pois já está relacionado à um item!');
            return redirect()->back();
        }
    }


    public function update(Request $request,  $id)
    {

        $tipo = TipoItem::find($id);
        $tipo->nome = strtoupper($request->nome);

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
        $tipo = TipoItem::find($id);
        if($tipo->delete()){

            Session::flash('alert-success', 'deletado com sucesso!');
            return redirect()->route('tipo_item.index');
        }else{
            Session::flash('alert-danger', 'Erro ao editar!');
            return redirect()->route('tipo_item.index');
        }
    }
}
