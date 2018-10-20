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
    public function atividades(Request $request){
        if(is_null($request->tipo) && is_null($request->talhao) )
            $atividades= Atividade::whereBetween('data',[$request->data_inicio,$request->data_fim])->get();
        else if( is_null($request->talhao) && !is_null($request->tipo) )
            $atividades= Atividade::where('id_tipos_atividades_tipos_atividades',$request->tipo)
                ->whereBetween('data',[$request->data_inicio,$request->data_fim])->get();
        else if(is_null($request->tipo) && !is_null($request->talhao) )
            $atividades= Atividade::where('id_talhoes_talhoes',$request->talhao)
                ->whereBetween('data',[$request->data_inicio,$request->data_fim])->get();
        else
            $atividades= Atividade::where('id_talhoes_talhoes',$request->talhao)
                ->where('id_tipos_atividades_tipos_atividades',$request->tipo)
                ->whereBetween('data',[$request->data_inicio,$request->data_fim])->get();

        $pdf = PDF::loadView('relatorios.atividades',compact('atividades'));

        return $pdf->download();

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
