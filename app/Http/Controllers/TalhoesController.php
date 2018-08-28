<?php

namespace App\Http\Controllers;

use App\Http\Requests\TalhoesRequest;
use Illuminate\Http\Request;
use App\Talhao;
use Session;
Use form;

class TalhoesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $talhoes = Talhao::all();
        //dd($usuarios);
        return view('talhoes.index')->with(compact('talhoes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('talhoes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TalhoesRequest $request)
    {
        $talhao = new Talhao();
        $talhao->area = $request->area;
        $talhao->descricao = $request->descricao;

        if($talhao->save()){
            Session::flash('alert-success', 'Novo talhao cadastrado com sucesso!');
            return redirect()->route('talhoes.index');
        }else{
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $talhao = Talhao::find($id);
        return view('talhoes')->with(compact('talhoes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id_talhao = TalhoesRequest::find($id);
        if($id_talhao->delete())
        {
            Session::flash('alert-sucess', 'Talhão deletado com sucesso!');
            return redirect()->route('talhoes.index');
        }else
        {
            Session::flash('alert-danger', 'Talhão não pode ser deletado!');
            reuturn redirect()->route('talhoes.index');
        }
    }
}
