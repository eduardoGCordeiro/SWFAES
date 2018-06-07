<?php

namespace App\Http\Controllers;

use App\Requisicao;
use Illuminate\Http\Request;

class RequisicoesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $requisicao = Requisicao::all();
        
        return view('requisicoes.index')->with(compact('requisicao'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('requisicoes.create');
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
     * @param  \App\Requisicao  $requisicao
     * @return \Illuminate\Http\Response
     */
    public function show(Requisicao $requisicao)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Requisicao  $requisicao
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $requisicao = Requisicao::find($id);
        return view('requisicoes.edit')->with(compact('requisicao'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Requisicao  $requisicao
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Requisicao $requisicao)
    {
        dd('testando');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Requisicao  $requisicao
     * @return \Illuminate\Http\Response
     */
    public function destroy(Requisicao $requisicao)
    {
        //
    }
}
