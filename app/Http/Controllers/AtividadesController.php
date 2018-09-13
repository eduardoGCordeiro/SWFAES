<?php

namespace App\Http\Controllers;

use App\Atividade;
use App\TipoAtividades;
use App\Talhao;
use App\Cultura;
use App\AdmGeral;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use Session;

class atividadesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function data_tables_all()
    {
        //return \DataTables::of(Unidade::query())->make(true);
         $atividades = Atividade::select(['*'])->get();

        return Datatables::of($atividades)
            ->editColumn('id_talhoes_talhoes', function($atividade){
                return $atividade->talhao['identificador'];
            })

            ->editColumn('data', function($atividade){
                return date( 'd/m/Y' , strtotime($atividade->data));
            })
            ->addColumn('action', function ($atividade) {
                return '<a href="'.Route('atividades.edit',[$atividade->id_atividades]).'" class="btn btn-primary">Editar</a>'.'<form action="'.Route('atividades.destroy',[$atividade->id_atividades]).'" method="POST"> '.csrf_field().'
 <input name="_method" type="hidden" value="DELETE"> <button type="submit" class="btn btn-danger">deletar</button>';
            })->make(true);
    }

    public function index()
    {
        return view('atividades.index');
    }

    public function data_tables($id)
    {
        $atividades = Atividade::where('id_talhoes_talhoes', $id)->get();
        return Datatables::of($atividades)
            ->editColumn('id_tipos_atividades_tipos_atividades', function ($atividades){
                return $atividades->tipos_atividades->nome;
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
        $tipos_atividades = TipoAtividades::all();
        $talhoes = Talhao::all();
        $culturas = Cultura::all();
        return view('atividades.create')->with(compact('tipos_atividades','talhoes','culturas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd(Auth::user());
        $atividade = new Atividade();
        $atividade->data = $request->data;
        $atividade->descricao = $request->descricao;
        $atividade->id_culturas_culturas = $request->cultura;
        $atividade->id_talhoes_talhoes = $request->talhao;
        $atividade->tipos_atividades = $request->tipos_atividades;


        $atividade->id_adms_geral_adms_geral = AdmGeral::where('id_funcionarios_funcionarios',Auth::user()->id_funcionarios)->first();

        if(!$atividade->id_adms_geral_adms_geral){
            Session::flash('alert-danger', 'Você não é administrador geral, portanto não pode realizar essa ação!');
            return redirect()->route('atividades.index');
        }
        $atividade->id_adms_geral_adms_geral =  $atividade->id_adms_geral_adms_geral->id_adms_geral;

        if($atividade->save()){
            Session::flash('alert-success', 'Atividade salva com sucesso!');
            return redirect()->route('atividades.index');
        }else{
            Session::flash('alert-danger', 'Não foi possível salvar essa atividade');
            return redirect()->route('atividades.index');
        }


        dd($atividade);
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
