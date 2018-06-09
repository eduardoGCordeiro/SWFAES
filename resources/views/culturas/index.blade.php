@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-5">
        <div class="col-md-12">
            <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/inicio">Início</a></li>
                        <li class="breadcrumb-item active">Culturas</li>
                    </ol>
            <div class="card">
                <div class="card-header">


                    <h3>Lista de Culturas</h3>

                    

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

                    <button type="button" class="btn btn-secondary">Ver Culturas</button>
                    <br>
                    <hr>

                    <h4>Listando culturas do talhão</h4>  


                    <table class="table  table-hover">
                      <thead>
                        <tr>
                            <th scope="col">Código</th>
                            <th scope="col">Descrição</th>
                            <th scope="col">Data início</th>
                            <th scope="col">Data fim</th>
                            <th scope="col">tipo safra</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                        
                            <td scope="col"><a href="#">00001</a></td>
                            <td scope="col">Descrição</td>
                            <td scope="col">10/01/2010</td>
                            <td scope="col">10/06/2010</td>
                            <td scope="col">inverno</td>
                        </tr>
                        <tr>
                        
                            <td scope="col"><a href="#">00002<a href="#"></td>
                            <td scope="col">Descrição</td>
                            <td scope="col">10/01/2010</td>
                            <td scope="col">10/06/2010</td>
                            <td scope="col">inverno</td>
                        </tr>
                      </tbody>
                    </table>                   
                  



                </div>
            </div>
        </div>
    </div>
</div>
@endsection
