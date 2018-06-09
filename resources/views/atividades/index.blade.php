@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-5">
        <div class="col-md-12">
            <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/inicio">Início</a></li>
                        <li class="breadcrumb-item active">Atividades</li>
                    </ol>
            <div class="card">
                <div class="card-header">


                    <h3>Lista de Atividades</h3>

                    

                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col form-group">
                            <label for="exampleSelect2">Selecione um dos talhões</label>
                            <select multiple="" class="form-control" id="exampleSelect2">
                                <option>Talhão 1</option>
                                <option>Talhão 2</option>
                                <option>Talhão 3</option>
                                <option>Talhão 4</option>
                                <option>Talhão 5</option>
                            </select>
                        </div>
                    </div>

                    <button type="button" class="btn btn-secondary">Ver atividades</button>
                    <br>
                    <hr>

                    <h4>Listando atividades do talhão</h4>  


                    <table class="table  table-hover">
                      <thead>
                        <tr>
                            <th scope="col">Tipo</th>
                            <th scope="col">Código</th>
                            <th scope="col">Descrição</th>
                            <th scope="col">Data</th>
                            <th scope="col">Movimentações</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($atividades as $atividade)
                            <tr>
 
                                <tr class="table-active">
                                    <th scope="row">{{$atividade->id_tipos_atividades_tipos_atividades}}</th>
                                    <td><a href="#">{{$atividade->id_atividades}}</a></td>
                                    <td>{{$atividade->descricao}}</td>
                                    <td>{{$atividade->data}}</td>
                                    <td>@if($atividade->movimentacao) <a href="#"> sim</a> @else não @endif</td>
                                </tr>
                            </tr>

                        @endforeach
                      </tbody>
                    </table>                   
                  



                </div>
            </div>
        </div>
    </div>
</div>
@endsection
