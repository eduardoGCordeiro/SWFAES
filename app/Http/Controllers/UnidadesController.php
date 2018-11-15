<?php

namespace App\Http\Controllers;

use App\Unidade;
use Illuminate\Http\Request;
use App\Http\Requests\UnidadesRequest;
use Yajra\Datatables\Datatables;
use Session;
use Form;
use Illuminate\Support\Facades\Gate;

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
                return '<div class = "col-md-10" style="margin-rigth: 14%">'. '<div class="panel-footer row" style="margin-rigth:80%"><!-- panel-footer -->'.'<div class="col-xs-6 text-center">'.'<div class="previous">'.'<a href="'.Route('unidades.edit',[$unidade->id_unidades]).'" class="btn btn-primary"><i class="fas fa-edit"></i>Editar</a>'.'</div>
                        '.'</div>'.'<div class="col-xs-6 text-right">'.'<div style="margin-left:6%">'.'<form action="'.Route('unidades.destroy',[$unidade->id_unidades]).'" method="POST"> '.csrf_field().'
 <input name="_method" type="hidden" value="DELETE"> <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i>deletar</button></form>'.'</div>'.'</div>'.'</div>'.'</div>';
            })->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Gate::denies('gerenciar')) {
            return abort(403);
        }
        return view('unidades.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UnidadesRequest $request)
    {
        if (Gate::denies('gerenciar')) {
            return abort(403);
        }
        $unidade = new Unidade();
        $unidade->nome = mb_strtoupper($request->nome);
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
        if (Gate::denies('gerenciar')) {
            return abort(403);
        }
        $movimentacoes = $unidade->movimentacoes;
        if(count($movimentacoes)){
            Session::flash('alert-danger', 'Erro ao editar pois já está relacionado com um item!');
            return redirect()->back();
        }
        return view('unidades.edit')->with(compact('unidade'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Unidade  $unidade
     * @return \Illuminate\Http\Response
     */
    public function update(UnidadesRequest $request,  $id)
    {
        if (Gate::denies('gerenciar')) {
            return abort(403);
        }

        $unidade = Unidade::find($id);
        $unidade->nome = mb_strtoupper($request->nome);
        $unidade->sigla = $request->sigla;

        $movimentacoes = $unidade->movimentacoes;
        if(count($movimentacoes)){
            Session::flash('alert-danger', 'Erro ao editar pois já está relacionado com um item!');
            return redirect()->back();
        }

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
        if (Gate::denies('gerenciar')) {
            return abort(403);
        }

        $unidade = Unidade::find($id);
        $movimentacoes = $unidade->movimentacoes;
        if(count($movimentacoes)){
            Session::flash('alert-danger', 'Erro ao excluir pois já está relacionado com um item!');
            return redirect()->back();
        }
        if($unidade->delete()){

            Session::flash('alert-success', 'deletado com sucesso!');
            return redirect()->route('unidades.index');
        }else{
            Session::flash('alert-danger', 'Erro ao editar!');
            return redirect()->route('unidades.index');
        }
    }
}
