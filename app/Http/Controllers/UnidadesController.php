<?php

namespace App\Http\Controllers;

use App\Unidade;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Session;
use Form;

class UnidadesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('unidades.index');
    }

    public function data_tables()
    {
        //return \DataTables::of(Unidade::query())->make(true);
         $unidades = Unidade::select(['id_unidades', 'nome', 'sigla'])->get();

        return Datatables::of($unidades)
            ->addColumn('action', function ($unidade) {
                return '<a href="'.Route('unidades.edit',[$unidade->id_unidades]).'" class="btn btn-primary">Editar</a>'.'<form action="'.Route('unidades.destroy',[$unidade->id_unidades]).'" method="POST"> '.csrf_field().'
 <input name="_method" type="hidden" value="DELETE"> <button type="submit" class="btn btn-danger">deletar</button>';
            })->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('unidades.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $unidade = new Unidade();
        $unidade->nome = strtoupper($request->nome);
        $unidade->sigla = $request->sigla;

        if($unidade->save()){
            Session::flash('alert-success', 'Nova unidade cadastrada com sucesso!');
            return redirect()->route('unidades.index');
        }else{
            Session::flash('alert-danger', 'Erro ao cadastrar unidade!');
            return redirect()->route('unidades.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Unidade  $unidade
     * @return \Illuminate\Http\Response
     */
    public function show(Unidade $unidade)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Unidade  $unidade
     * @return \Illuminate\Http\Response
     */
    public function edit(Unidade $unidade)
    {
        return view('unidades.edit')->with(compact('unidade'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Unidade  $unidade
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {

        $unidade = Unidade::find($id);
        $unidade->nome = strtoupper($request->nome);
        $unidade->sigla = $request->sigla;

        if($unidade->update()){

            Session::flash('alert-success', 'Editado com sucesso!');
            return redirect()->route('unidades.index');
        }else{
            Session::flash('alert-danger', 'Erro ao editar!');
            return redirect()->route('unidades.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Unidade  $unidade
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $unidade = Unidade::find($id);
        if($unidade->delete()){

            Session::flash('alert-success', 'deletado com sucesso!');
            return redirect()->route('unidades.index');
        }else{
            Session::flash('alert-danger', 'Erro ao editar!');
            return redirect()->route('unidades.index');
        }
    }
}
