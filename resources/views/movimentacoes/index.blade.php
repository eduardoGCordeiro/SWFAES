@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-5">
        <div class="col-md-12">
            <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/inicio">Início</a></li>
                        <li class="breadcrumb-item active">Movimentações</li>
                    </ol>
            <div class="card">
                <div class="card-header">


                    <h4>Listando movimentações</h4>  


                                        <table class="table  table-hover">
                                          <thead>
                                            <tr>
                                                <th scope="col">Código</th>
                                                <th scope="col">Descrição</th>
                                                <th scope="col">valor (R$)</th>
                                                <th scope="col">Qauntidade (Kg)</th>
                                                <th scope="col">Data fim</th>
                                                <th scope="col">Atividade</th>
                                                <th scope="col">Talhão</th>
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
                                                <td scope="col"><a href="#">00001</a></td>
                                            </tr>
                                            <tr class="table-danger">
                                            
                                                <td scope="col"><a href="#">00002<a href="#"></td>
                                                <td scope="col">Descrição da movimentação de entrada</td>
                                                <td scope="col">300.00</td>
                                                <td scope="col">300.00</td>
                                                <td scope="col">10/06/2010</td>
                                                <td scope="col"><a href="#">ver</a></td>
                                                <td scope="col"><a href="#">00001</a></td>
                                            </tr>
                                          </tbody>
                                        </table>       

                    

                </div>

                <div class="card-body">

                    
                  



                </div>
            </div>
        </div>
    </div>
</div>
@endsection
