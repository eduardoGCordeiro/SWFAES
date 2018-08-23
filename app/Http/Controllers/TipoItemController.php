<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TipoItem;
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
                return '<a href="'.Route('tipo_item.edit',[$tipo->id_tipo_itens]).'" class="btn btn-primary">Editar</a>'.'<form action="'.Route('tipo_item.destroy',[$tipo->id_tipos_itens]).'" method="POST"> '.csrf_field().'
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
            Session::flash('alert-success', 'Novo tipo de intens cadastrado com sucesso!');
            return redirect()->route('tipo_item.index');
        }else{
            Session::flash('alert-danger', 'Erro ao cadastrar tipo de item!');
            return redirect()->route('tipo_item.index');
        }
    }


    public function show(TipoItem $tipo)
    {

    }


    public function edit(TipoItem $tipo)
    {
        return view('tipo_item.edit')->with(compact('tipo'));
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
