@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-5">
        <div class="col-md-12">
            <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/inicio">Início</a></li>
                        <li class="breadcrumb-item active">Usuarios</li>
                        
                    </ol>
            <div class="card">
                <div class="card-header">


                    <h3>Listando usuários</h3>

                    

                </div>

                <div class="card-body">

                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th scope="col">Nome</th>
                          <th scope="col">Nome de Usuário</th>
                          <th scope="col">CPF</th>
                          <th scope="col">email</th>
                          <th scope="col">Acesso ao sistema</th>

                        </tr>
                      </thead>
                      <tbody>
                        @foreach($usuarios as $usuario)
                          <tr class="">
                            <th scope="row"><a href="{{Route('usuarios.edit',[$usuario->id_usuarios])}}">{{$usuario->nome}}</a></th>
                            <td>{{$usuario->login}}</td>
                            <td>{{$usuario->cpf}}</td>
                            <td>{{$usuario->email}}</td>
                            <td>@if($usuario->acesso_sistema) sim @else não @endif</td>
                          </tr>
                          


                        @endforeach
                      </tbody>
                    </table> 

                    <button type="button" class="btn btn-primary">Criar Novo</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
