<?php

namespace App\Http\Controllers;

use App\Atividade;
use App\Http\Requests\CulturasRequest;
use App\Http\Requests\TalhoesRequest;
use App\TipoAtividades;
use App\Talhao;
use App\Movimentacao;
use App\Cultura;
use App\AdmGeral;
use Illuminate\Http\Request;
use App\Http\Requests\AtividadesRequest;
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


                ->editColumn('descricao', function($atividade){
                    return $atividade->descricao;
                })

                ->editColumn('data', function($atividade){
                    return date( 'd/m/Y' , strtotime($atividade->data));
                })
                ->editColumn('id_culturas_culturas', function($atividade){
                    if($atividade->cultura){
                        return $atividade->cultura['descricao'];
                    }
                })
                ->addColumn('action', function ($atividade) {
                    return '<div class = "col-md-10 offset-1">'. '<div class="panel-footer row" style="margin-left: 18%"><!-- panel-footer -->'.'<div class="col-xs-6 text-center">'.'<div class="previous">'.'<a href="'.Route('atividades.edit',[$atividade->id_atividades]).'" class="btn btn-primary"><i class="fas fa-edit"></i>Editar</a>'.'</div>
                        '.'</div>'.'<div class="col-xs-6 text-right">'.'<div class="next offset-1"> <meta name="csrf-token" content="'.csrf_token().'">
 <button type="button" class="confirm-btn btn btn-danger" value="'.$atividade->id_atividades.'" onclick="(delete_btn(this))"><i class="fas fa-trash-alt"></i>deletar</button>
</div>'.'</div>'.'</div>'.'</div>';
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
    public function store(AtividadesRequest $request)
    {
        //dd($request);
        if (Gate::denies('gerenciar-atividades')) {
            return abort(403);
        }
        //dd(Auth::user());
        $cultura = Cultura::where([['id_talhoes_talhoes',$request->talhao],['data_fim',NULL]])->first();
        $atividade = new Atividade();

        if(!$cultura){
            $atividade->id_culturas_culturas =null;
        }else{
            $atividade->id_culturas_culturas = $cultura->id_culturas;
        }

        $atividade->data = $request->data;
        $atividade->descricao =  mb_strtoupper($request->descricao);

        $atividade->id_talhoes_talhoes = $request->talhao;
        $atividade->id_tipos_atividades_tipos_atividades = $request->tipo_atividade;


        $atividade->id_adms_geral_adms_geral = AdmGeral::where('id_funcionarios_funcionarios',Auth::user()->id_funcionarios)->first();

        // if(!$atividade->id_adms_geral_adms_geral){
        //     Session::flash('alert-danger', 'Você não é administrador geral, portanto não pode realizar essa ação!');
        //     return redirect()->route('atividades.index');
        // }
        $atividade->id_adms_geral_adms_geral =  $atividade->id_adms_geral_adms_geral->id_adms_geral;

        if($atividade->save()){

            Session::flash('alert-success', 'Atividade salva com sucesso! Essa atividade possui alguma movimentação? <a href="'.Route('transaction_by_activity',[$atividade->id_atividades]).'" >Clique aqui para cadastrá-las</a>');
            return redirect()->route('atividades.index');
        }else{
            Session::flash('alert-danger', 'Não foi possível salvar essa atividade');
            return redirect()->route('atividades.index');
        }


        dd($atividade);
    }


    public function atividades_list_transactions($id){
        $movimentacoes = movimentacao::where('id_atividades_atividades',$id)->get();

        return Datatables::of($movimentacoes)

                ->addColumn('action', function ($movimentacao) {
                    return '<a href="'.Route('movimentacoes.edit',[$movimentacao->id_movimentacoes]).'" class="btn btn-primary"><i class="fas fa-edit"></i>Editar</a>'.'<form action="'.Route('movimentacoes.destroy',[$movimentacao->id_movimentacoes]).'" method="POST"> '.csrf_field().'
 <input name="_method" type="hidden" value="DELETE"> <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i>deletar</button></form>';
                    })
            ->make(true);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Atividade  $atividade
     * @return \Illuminate\Http\Response
     */
    public function show(Atividade $atividade)
    {
        return view('atividades.show')->with(compact('atividade'));
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
        $talhao_atividade = Talhao::where('id_talhoes',$atividade->id_talhoes_talhoes)->first();

        return view('atividades.edit')->with(compact('atividade','tipos_atividades','talhoes','culturas', 'talhao_atividade'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Atividade  $atividade
     * @return \Illuminate\Http\Response
     */
    public function update(AtividadesRequest $request,$id)
    {
        if (Gate::denies('gerenciar-atividades')) {
            return abort(403);
        }
        $atividade = Atividade::find($id);
        $cultura = Cultura::where([['id_talhoes_talhoes',$request->talhao],['data_fim',NULL]])->first();

        if(!$cultura){
            $atividade->id_culturas_culturas =null;
        }else{
            $atividade->id_culturas_culturas = $cultura->id_culturas;
        }

        $atividade->data = $request->data;
        $atividade->descricao = mb_strtoupper($request->descricao);
        $atividade->id_tipos_atividades_tipos_atividades = $request->tipo_atividade;
        $atividade->id_talhoes_talhoes = $request->talhao;

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
            return response('Erro ao excluir pois já está relacionado com um item!', 405);
            
        }
        if($atividade->delete()){

            Session::flash('alert-success', 'deletado com sucesso!');
            return response('sucesso ao deletar atividade!', 200);
        }else{
            Session::flash('alert-danger', 'Erro ao deletar!');
            return response('Erro ao deletar atividade!', 405);
        }
    }
}
