<?php

namespace App\Http\Controllers;

use App\Unidade;
use Illuminate\Http\Request;

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
            return redirect()->back()->with('success','Salvo com sucesso');
        }else{
            return redirect()->back()->with('error','Erro ao salvar');
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
            return redirect()->back()->with('success','Salvo com sucesso');
        }else{
            return redirect()->back()->with('error','Erro ao salvar');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Unidade  $unidade
     * @return \Illuminate\Http\Response
     */
    public function destroy(Unidade $unidade)
    {
        //
    }
}
