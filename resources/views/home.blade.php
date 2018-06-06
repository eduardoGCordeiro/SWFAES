@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-5">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">Painel principal</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    Você está logado!

<br>
                    <p>Partes que estão em dev:</p>
                    <ul>
                        <li>
                            <a href="/usuarios">Usuários</a><br>
                            <a href="/usuarios/create/">---Novo</a><br>
                            <a href="/usuarios/1/edit/">---Editar</a><br>
                        </li>
                        <li>
                            <a href="/talhoes/">Talhões</a><br>
                            <a href="/talhoes/create">---Novo</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
