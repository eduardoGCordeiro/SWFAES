@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-5">
        <div class="col-md-12">
            <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/inicio">Início</a></li>
                        <li class="breadcrumb-item active">Requisições</li>
                    </ol>
            <div class="card">
                <div class="card-header">


                    <h3>Listando requisições</h3>

                    

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

                    <button type="button" class="btn btn-secondary">Ver requisições</button>
                    <br>
                    <hr>

                    <h4>Listando requisições do talhão</h4>  


                    <table class="table  table-hover">
                      <thead>
                        <tr>
                            <th>identificação</th>
                            <th scope="col">descrição</th>
                            <th scope="col">data</th>
                            <th scope="col">status</th>
                            <th scope="col">resposta</th>
                            
                        </tr>
                      </thead>
                      <tbody>
                        
                            
 
                            <tr class="table-success">
                                <td><a href="#">0001</a></td>
                                <th scope="row">passar o arado no talhão</th>
                                <td><a href="#">07/06/2018</a></td>
                                <td>aceito</td>
                                <td>ok</td>
                            </tr>
                            <tr class="table-default">
                                <td><a href="#">0002</a></td>
                                <th scope="row">plantio</th>
                                <td><a href="#">07/06/2018</a></td>
                                <td>aguardando</td>
                                <td>-</td>
                            </tr>
                            <tr class="table-danger">
                                <td><a href="#">0003</a></td>
                                <th scope="row">colheita</th>
                                <td><a href="#">07/06/2018</a></td>
                                <td>rejeitado</td>
                                <td>Ainda não possui cultura!</td>
                            </tr>
                            

                      </tbody>
                    </table>                   
                  



                </div>
            </div>
        </div>
    </div>
</div>
@endsection
