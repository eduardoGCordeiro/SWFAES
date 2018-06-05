@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-5">
        <div class="col-md-12">
            <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/inicio">Início</a></li>
                        <li class="breadcrumb-item"><a href="#">Usuarios</a></li>
                        <li class="breadcrumb-item active">Lista</li>
                    </ol>
            <div class="card">
                <div class="card-header">


                    <h3>Lista de Usuários</h3>

                    

                </div>

                <div class="card-body">

                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th scope="col">Nome</th>
                          <th scope="col">Nome de Usuário</th>
                          <th scope="col">CPF</th>
                          <th scope="col">email</th>
                          <th scope="col">Manter</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($usuarios as $usuario)
                          <tr class="">
                            <th scope="row">{{$usuario->nome}}</th>
                            <td>{{$usuario->login}}</td>
                            <td>{{$usuario->cpf}}</td>
                            <td>{{$usuario->email}}</td>
                            <td><button type="button" class="btn btn-outline-danger"><i class="fa fa-trash"></i></button></td>
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
