@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Painel principal</div>
                <div class="card-body">
                    inicio


                    Funcionarios<br>
    - cadastro         +++<br>
    - edição +++<br>
    - listagem +++<br>
Atividades<br>
    - cadastro +++<br>
    - edição +++<br>
    - listagem +++<br>
Culturas<br>
    - cadastro +++<br>
    - edição +++<br>
    - listagem +++<br>
Itens<br>
    - cadastro         +++<br>
    - edição           +++<br>
    - listagem         +++<br>
Movimentacoes<br>
    - cadastro   <br>
    - edição         <br>
    - listagem         <br>

Requisicoes<br>
    - cadastro <br>
    - edição       <br>
    - listagem <br>
Tipo_item<br>
    - cadastro     +++<br>
    - edição           +++<br>
    - listagem         +++<br>
unidades<br>
    - cadastro     +++<br>
    - edição           +++<br>
    - listagem         +++<br>




    @if (Auth::user()->can('gerenciar'))
    pode
    @endif
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
