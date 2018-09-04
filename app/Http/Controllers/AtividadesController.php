<?php

namespace App\Http\Controllers;

use App\Atividade;
use Illuminate\Http\Request;

class atividadesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $atividades = Atividade::all();
        
        return view('atividades.index')->with(compact('atividades'));
    }

    public function data_tables()
    {
        $atividades = Atividade::select(['*'])->get();
        return Datatables::of($atividades)
            ->addColumn('action', function ($atividades) {
                return '<a href="'.Route('atividades.edit',[$atividades->id_atividades]).'" class="btn btn-primary">Editar</a>'.'<form action="'.Route('atividades.destroy',[$atividades->id_atividades]).'" method="POST"> '.csrf_field().'
 <input name="_method" type="hidden" value="DELETE"> <button type="submit" class="btn btn-danger">deletar</button>';
            })
            ->editColumn('id_atividades_atividades', function ($atividades){
                return $atividades->tipos_atividades->nome.'('.$atividades->tipos_atividades->nome.')';
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
        return view('atividades.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Atividade  $atividade
     * @return \Illuminate\Http\Response
     */
    public function show(Atividade $atividade)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Atividade  $atividade
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $atividade = Atividade::find($id);
        return view('atividades.edit')->with(compact('atividade'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Atividade  $atividade
     * @return \Illuminate\Http\Response
     */
    public function update()
    {
        dd('testando');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Atividade  $atividade
     * @return \Illuminate\Http\Response
     */
    public function destroy(Atividade $atividade)
    {
        //
    }
}
