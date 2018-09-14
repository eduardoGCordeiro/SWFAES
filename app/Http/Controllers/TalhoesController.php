<?php

namespace App\Http\Controllers;

use App\Atividade;
use App\AdmTalhao;
use App\Funcionario;
use App\Http\Requests\TalhoesRequest;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use App\Talhao;
use Session;
Use form;
Use Redirect;
use Illuminate\Support\Facades\Gate;
use Auth;

class TalhoesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $talhoes = Talhao::orderby('id_talhoes', 'ASC')->get();
        return view('talhoes.index')->with(compact('talhoes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        if (Gate::denies('gerenciar-talhoes')) {
            return abort(403);
        }
        $adms_talhoes = AdmTalhao::all();
        return view('talhoes.create')->with(compact('talhoes','adms_talhoes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TalhoesRequest $request)
    {
        if (Gate::denies('gerenciar-talhoes')) {
            return abort(403);
        }
        $this->validate($request, ['identificador' => 'unique:talhoes'], ['identificador.unique' => 'O campo :attribute deve ser único!']);
        $talhao = new Talhao();
        $talhao->identificador = strtoupper($request->identificador);
        $talhao->tipo = $request->tipo;
        $talhao->area = $request->area;
        $talhao->descricao = $request->descricao;
        $talhao->id_adms_talhoes_adms_talhoes = $request->id_adms_talhoes_adms_talhoes;


        if ($talhao->save()) {
            Session::flash('alert-success', 'Novo talhao cadastrado com sucesso!');
            return redirect()->route('talhoes.index');
        } else {
            Session::flash('alert-danger', 'Erro ao cadastrar o talhao!');
            return redirect()->route('talhoes.index');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $talhao  = Talhao::find($id);
        return view("talhoes.show")->with(compact('talhao'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Gate::denies('gerenciar-talhoes')) {
            return abort(403);
        }
        $talhoes = Talhao::find($id);
        $adms_talhoes = AdmTalhao::all();
        return view('talhoes.edit')->with(compact('talhoes','adms_talhoes'));;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TalhoesRequest $request, $id)
    {
        if (Gate::denies('gerenciar-talhoes')) {
            return abort(403);
        }

        $talhao = Talhao::find($id);

        Validator::make($request->all() , [
            'identificador' => ['required',
                Rule::unique('talhoes')->ignore($talhao->id, 'id_talhoes'),]
        ], ['O campo :attribute deve ser único!']);

        $talhao->identificador = strtoupper($request->identificador);
        $talhao ->tipo = $request->tipo;
        $talhao->area = $request->area;
        $talhao->descricao = $request->descricao;

        if($talhao->save()){
            Session::flash('alert-success', 'Talhão editado com sucesso!');
            return redirect()->route('talhoes.index');
        }else{
            Session::flash('alert-danger', 'Erro ao editar talhão!');
            return redirect()->route('talhoes.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Gate::denies('gerenciar-talhoes')) {
            return abort(403);
        }
        $talhao = Talhao::find($id);

        if($talhao->delete())
        {
            Session::flash('alert-sucess', 'Talhão deletado com sucesso!');
            return redirect()->route('talhoes.index');
        }else
        {
            Session::flash('alert-danger', 'Talhão não pode ser deletado!');
            return redirect()->route('talhoes.index');
        }
    }
}
