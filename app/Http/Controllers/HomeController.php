<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Funcionario;
use App\Talhao;
use App\TipoAtividades;
use Auth;
use Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {


        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if(Auth::check() && !Auth::user()->acesso_sistema){
            Auth::logout();
            Session::flush();
            Session::flash('alert-danger', 'Sem acesso ao sistema!');
            return redirect()->route('login');
        }

        $talhoes = Talhao::all();
        $tipos_atividades = TipoAtividades::all();

        return view('relatorios')->with(compact('tipos_atividades','talhoes'));
    }
}
