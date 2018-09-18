<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use App\Item;
use App\Atividade;
use App\Movimentacao;
use App;
use View;

class RelatoriosController extends Controller
{



    public function estoque(){
        $itens= Item::orderBy('nome')->get();
        $pdf = PDF::loadView('relatorios.estoque',compact('itens'));
        //$pdf = PDF::loadView('relatorios.estoque', $data);
        return $pdf->download();
        //redirect()->back();
    }
    public function atividades(){
        $atividades= Atividade::all();
        //dd($atividades);
        $pdf = PDF::loadView('relatorios.atividades',compact('atividades'));
        //$pdf = PDF::loadView('relatorios.estoque', $data);
        return $pdf->download();
        //redirect()->back();
    }

    public function movimentacoes(){
        $movimentacoes= Movimentacao::orderBy('id_movimentacoes')->get();
        //dd($atividades);
        $pdf = PDF::loadView('relatorios.movimentacoes',compact('movimentacoes'));
        //$pdf = PDF::loadView('relatorios.estoque', $data);
        return $pdf->download();
        //redirect()->back();
    }
}
