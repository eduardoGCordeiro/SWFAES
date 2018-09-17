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
use Illuminate\Support\Facades\Gate;

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
                    return '<a href="'.Route('atividades.edit',[$atividade->id_atividades]).'" class="btn btn-primary"><i class="fas fa-edit"></i>Editar</a>'.'<form action="'.Route('atividades.destroy',[$atividade->id_atividades]).'" method="POST"> '.csrf_field().'
 <input name="_method" type="hidden" value="DELETE"> <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i>deletar</button></form>';
                    })
            ->make(true);



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
        if (Gate::denies('gerenciar-atividades')) {
            return abort(403);
        }
        $tipos_atividades = TipoAtividades::all();
        $talhoes = Talhao::all();
        $culturas = Cultura::whereNull('data_fim')->get();
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
        //dd($request);
        if (Gate::denies('gerenciar-atividades')) {
            return abort(403);
        }
        //dd(Auth::user());
        $atividade = new Atividade();
        $atividade->data = $request->data;
        $atividade->descricao = $request->descricao;
        $atividade->id_culturas_culturas = $request->cultura;
        $atividade->id_talhoes_talhoes = $request->talhao;
        $atividade->id_tipos_atividades_tipos_atividades = $request->tipo_atividade;


        $atividade->id_adms_geral_adms_geral = AdmGeral::where('id_funcionarios_funcionarios',Auth::user()->id_funcionarios)->first();

        // if(!$atividade->id_adms_geral_adms_geral){
        //     Session::flash('alert-danger', 'Você não é administrador geral, portanto não pode realizar essa ação!');
        //     return redirect()->route('atividades.index');
        // }
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
        if (Gate::denies('gerenciar-atividades')) {
            return abort(403);
        }
        $atividade = Atividade::find($id);
        $tipos_atividades = TipoAtividades::all();
        $talhoes = Talhao::all();

        $culturas = Cultura::all();
        return view('atividades.edit')->with(compact('atividade','tipos_atividades','talhoes','culturas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Atividade  $atividade
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        if (Gate::denies('gerenciar-atividades')) {
            return abort(403);
        }
        $atividade = Atividade::find($id);

        $atividade->data = $request->data;
        $atividade->descricao = $request->descricao;
        $atividade->id_tipos_atividades_tipos_atividades = $request->tipo_atividade;
        $atividade->id_talhoes_talhoes = $request->talhao;
        $atividade->id_culturas_culturas = $request->cultura;



        if($atividade->update()){

            Session::flash('alert-success', 'Editado com sucesso!');
            return redirect()->route('atividades.index');
        }else{
            Session::flash('alert-danger', 'Erro ao editar!');
            return redirect()->route('atividades.index');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Atividade  $atividade
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Gate::denies('gerenciar-atividades')) {
            return abort(403);
        }
        $atividade = Atividade::find($id);
        $movimentacoes = $atividade->movimentacao;
        if(count($movimentacoes)){
            Session::flash('alert-danger', 'Erro ao excluir pois já está relacionado com um item!');
            return redirect()->back();
        }
        if($atividade->delete()){

            Session::flash('alert-success', 'deletado com sucesso!');
            return redirect()->route('atividades.index');
        }else{
            Session::flash('alert-danger', 'Erro ao editar!');
            return redirect()->route('atividades.index');
        }
    }
}
