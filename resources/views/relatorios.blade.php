@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h3>Início</h3></div>
                <div class="card-body">
                    <h4>Relatórios</h4>
                    <hr>
                        <a href="{{Route('atividades-rel')}}"><button class="btn btn-primary" >Atividades</button></a>
                        <a href="{{Route('estoque-rel')}}"><button class="btn btn-primary" >Estoque</button></a>
                        <a href="{{Route('movimentacoes-rel')}}"><button class="btn btn-primary" >Fluxo de Caixa</button></a>

                </div>
            </div>
        </div>
    </div>
</div>



@endsection
