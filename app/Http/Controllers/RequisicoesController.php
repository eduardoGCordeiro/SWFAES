<?php

namespace App\Http\Controllers;

use App\Requisicao;
use App\Talhao;
use App\Cultura;
use App\AdmTalhao;
use App\AdmGeral;
use App\Funcionario;
use App\Http\Requests\RequisicoesRequest;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Session;
use Illuminate\Support\Facades\Gate;
use Auth;

class RequisicoesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

       public function data_tables()
       {
            $admTalhao = AdmTalhao::where('id_funcionarios_funcionarios',Auth::user()->id_funcionarios)->first();
            $admGeral = AdmGeral::where('id_funcionarios_funcionarios',Auth::user()->id_funcionarios)->get();

            if(isset($admTalhao) && !count($admGeral)){
                //dd($admTalhao);
                $requisicoes = Requisicao::where('id_adms_talhoes_adms_talhoes',$admTalhao->id_adms_talhoes)->get();
            }else{
                $requisicoes = Requisicao::all();

            }

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
                 ->editColumn('id_adms_talhoes_adms_talhoes', function($requisicao){
                    $funcionario = $funcionario = Funcionario::find(AdmTalhao::find($requisicao->id_adms_talhoes_adms_talhoes)->id_funcionarios_funcionarios);

                    return $funcionario->nome;
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
        // if (Gate::denies('gerenciar-requisicoes')) {
        //     return abort(403);
        // }
        $requisicao = Requisicao::find($id);
        $requisicao->resposta = strtoupper($request->resposta);
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
        $adm = AdmTalhao::where('id_funcionarios_funcionarios',Auth::user()->id_funcionarios)->first();

        $talhoes = Talhao::where('id_adms_talhoes_adms_talhoes',$adm->id_adms_talhoes)->get();

        if(!$adm){
            if(count($talhoes) == 0){
                Session::flash('alert-danger', 'Você não pode cadastrar requisicao pois não possui talhões!');
                return redirect()->route('requisicoes.index');
            }
            Session::flash('alert-danger', 'Você não pode cadastrar requisicao pois não é administrador de talhões!');
            return redirect()->route('requisicoes.index');
        }

        return view('requisicoes.create')->with(compact('talhoes','culturas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequisicoesRequest $request)
    {
        $talhao = $request->talhao;

        $adm_talhao = AdmTalhao::where([['id_funcionarios_funcionarios', Auth::user()->id_funcionarios]])->first();
        //dd($adm_talhao);
        //if($adm_talhao && )
        $requisicao = new Requisicao();
        $requisicao->id_adms_talhoes_adms_talhoes = $adm_talhao->id_adms_talhoes;
        $requisicao->descricao = strtoupper($request->descricao);
        $requisicao->id_talhoes_talhoes = $request->talhao;

        if($requisicao->save()){
            Session::flash('alert-success', 'Nova requisicao cadastrada com sucesso, aguarde a moderação de um administrador geral!');
            return redirect()->route('requisicoes.index');
        }else{
            Session::flash('alert-danger', 'Erro ao cadastrar requisicao!');
            return redirect()->route('requisicoes.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Requisicao  $requisicao
     * @return \Illuminate\Http\Response
     */
    public function show(RequisicoesRequest $requisicao)
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
    public function update(RequisicoesRequest $request, Requisicao $requisicao)
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
