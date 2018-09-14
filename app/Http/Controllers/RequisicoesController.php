<?php

namespace App\Http\Controllers;

use App\Requisicao;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Session;

class RequisicoesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

       public function data_tables()
       {
            $requisicoes = Requisicao::all();
            //dd($requisicoes[0]->talhao);
           return Datatables::of($requisicoes)
                ->editColumn('id_talhoes_talhoes', function($requisicao){
                    return $requisicao->talhao['identificador']!=null?$requisicao->talhao['identificador']:'Sem talhão';
                })
                ->editColumn('resposta', function($requisicao){
                    return $requisicao->resposta!=null?$requisicao->resposta:'Ainda não moderado';
                })
                ->editColumn('data', function($requisicao){
                    return date( 'd/m/Y' , strtotime($requisicao->data));
                })
               ->addColumn('action', function ($requisicao) {
                   return '<a href="'.Route('moderar_get',[$requisicao->id_requisicoes]).'" class="btn btn-primary">Moderar</a>';
               })
               ->setRowClass(function ($requisicao) {
                    if($requisicao->id_status_requisicoes_status_requisicoes == 2){
                        return 'table-success';
                    }else if($requisicao->id_status_requisicoes_status_requisicoes ==3){
                        return 'table-danger';
                    }
                })
               ->make(true);
       }

    public function index()
    {
        $requisicao = Requisicao::all();
        return view('requisicoes.index')->with(compact('requisicao'));
    }


    public function moderar_get($id){
        $requisicao = Requisicao::find($id);
        return view('requisicoes.moderar')->with(compact('requisicao'));
    }

    public function moderar(Request $request,$id){
        $requisicao = Requisicao::find($id);
        $requisicao->resposta = $request->resposta;
        if($request->option == 1){
            $requisicao->id_status_requisicoes_status_requisicoes = 2;
        }else{
            $requisicao->id_status_requisicoes_status_requisicoes = 3;
        }

        if($requisicao->update()){
            Session::flash('alert-success', 'Moderado com sucesso!');
            return redirect()->route('requisicoes.index');
        }else{
            Session::flash('alert-danger', 'Erro ao moderar!');
            return redirect()->route('requisicoes.index');
        }
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
        return view('requisicoes.moderar')->with(compact('requisicao'));
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
