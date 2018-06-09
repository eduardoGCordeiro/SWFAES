@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-5">
        <div class="col-md-12">
            <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/inicio">Início</a></li>
                        <li class="breadcrumb-item active">Itens</li>
                    </ol>
            <div class="card">
                <div class="card-header">


                    <h3>Lista de Itens</h3>

                    

                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col form-group">
                            <label for="exampleSelect2">Selecione um dos itens:</label>
                            <select multiple="" class="form-control" id="exampleSelect2">
                                <option>Item 1</option>
                                <option>Item 2</option>
                                <option>Item 3</option>
                                <option>Item 4</option>
                                <option>Item 5</option>
                            </select>
                        </div>
                    </div>

                    <button type="button" class="btn btn-secondary">Ver item</button>
                    <br>
                    <hr>

                        <h4>Descrição do Item</h4>
                    <hr>

                        <div class="card border-primary mb-3" style="max-width: 20rem;">
                          <div class="card-header">Item 1</div>
                          <div class="card-body">
                            <p class="card-text"><b>Custo por item(R$):</b> 1.00</p>
                            <p class="card-text"><b>Quantidade(Kg):</b> 700.00</p>
                            <p class="card-text"><b>Tipo:</b> tipo item</p>
                          </div>
                        </div>

                        <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                          <button type="button" class="btn btn-info">ações</button>
                          <div class="btn-group" role="group">
                            <button id="btnGroupDrop3" type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                            <div class="dropdown-menu" aria-labelledby="btnGroupDrop3" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 36px, 0px);">
                              <a class="dropdown-item" href="#">Editar</a>
                              <a class="dropdown-item" href="#">Deletar</a>
                            </div>
                          </div>
                        </div>

                    <hr>

                    <h4>Listando movimentações do Item</h4>  


                    <table class="table  table-hover">
                      <thead>
                        <tr>
                            <th scope="col">Código</th>
                            <th scope="col">Descrição</th>
                            <th scope="col">valor (R$)</th>
                            <th scope="col">Qauntidade (Kg)</th>
                            <th scope="col">Data fim</th>
                            <th scope="col">Atividade</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr class="table-success">
                        
                            <td scope="col"><a href="#">00001</a></td>
                            <td scope="col">Descrição da movimentação de saída</td>
                            <td scope="col">1000.00</td>
                            <td scope="col">1000.00</td>
                            <td scope="col">10/06/2010</td>
                            <td scope="col"><a href="#">ver</a></td>
                        </tr>
                        <tr class="table-danger">
                        
                            <td scope="col"><a href="#">00002<a href="#"></td>
                            <td scope="col">Descrição da movimentação de entrada</td>
                            <td scope="col">300.00</td>
                            <td scope="col">300.00</td>
                            <td scope="col">10/06/2010</td>
                            <td scope="col"><a href="#">ver</a></td>
                        </tr>
                      </tbody>
                    </table>                   
                  



                </div>
            </div>
        </div>
    </div>
</div>
@endsection
