<?php

namespace App\Http\Controllers;

use App\Movimentacao;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use DataTables;
use Session;
Use form;
Use Redirect;


class MovimentacoesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function data_tables()
    {
        $movimentacoes = Movimentacao::select(['*'])->get();
        return Datatables::of($movimentacoes)
            ->addColumn('action', function ($movimentacoes) {
                return '<a href="'.Route('movimentacoes.edit',[$movimentacoes->id_movimentacoes]).'" class="btn btn-primary">Editar</a>'.'<form action="'.Route('movimentacoes.destroy',[$movimentacoes->id_movimentacoes]).'" method="POST"> '.csrf_field().'
                        <input name="_method" type="hidden" value="DELETE"> <button type="submit" class="btn btn-danger">deletar</button>';
            })
            ->make(true);
    }

    public function index()
    {
        $movimentacao = Movimentacao::all();
        return view('movimentacoes.index')->with(compact('movimentacao'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('movimentacoes.create');
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
     * @param  \App\Movimentacao  $movimentacao
     * @return \Illuminate\Http\Response
     */
    public function show(Movimentacao $movimentacao)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Movimentacao  $movimentacao
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $movimentacao = Movimentacao::find($id);
        return view('movimentacoes.edit')->with(compact('movimentacao'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Movimentacao  $movimentacao
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Movimentacao $movimentacao)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Movimentacao  $movimentacao
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movimentacao $movimentacao)
    {
        //
    }
}
