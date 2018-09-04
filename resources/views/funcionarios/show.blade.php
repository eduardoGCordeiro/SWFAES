@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-5">
        <div class="col-md-12 ">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/inicio">Início</a></li>
                <li class="breadcrumb-item"><a href="{{Route('funcionarios.index')}}">Funcionários</a></li>
                <li class="breadcrumb-item active">Ver Funcionário</li>
            </ol>
            <div class="card">

                <div class="card-header">

                    <h3>Funcionário</h3>


                </div>

                <div class="card-body col-md-8 offset-lg-2" >
                    <legend>{{$funcionario->nome}}</legend>
                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-3 col-form-label">Email</label>
                      <div class="col-sm-9">
                        <input type="text" readonly="" class="form-control-plaintext" id="staticEmail" value="email@example.com">
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-3 col-form-label">CPF:</label>
                      <div class="col-sm-9">
                        <input type="text" readonly="" class="form-control-plaintext" id="staticEmail" value="{{$funcionario->cpf}}">
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-3 col-form-label">Login:</label>
                      <div class="col-sm-9">
                        <input type="text" readonly="" class="form-control-plaintext" id="staticEmail" value="{{$funcionario->login}}">
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-3 col-form-label">Acesso ao sistema:</label>
                      <div class="col-sm-9">
                        <input type="text" readonly="" class="form-control-plaintext" id="staticEmail" value="{{$funcionario->acesso_sistema?'Sim':'Não'}}">
                      </div>
                    </div>


                    <hr>
                    <h4>Ações</h4>

                    <a href="{{Route('funcionarios.edit',[$funcionario->id_funcionarios])}}" class="btn btn-primary">Editar</a>

                    <form  action="{{ Route('funcionarios.destroy',[$funcionario->id_funcionarios]) }}" method="POST">
                    {{csrf_field()}}
                        <input  name="_method" type="hidden" value="DELETE">
                        <button s type="submit" class="btn btn-danger">deletar</button>
                    </form>



 <hr>
                    <h4>Talhões</h4>

                    <table id="data-table-talhoes" class="table  table-striped">

                      <thead>
                        <tr>

                            <th scope="col">Identificação</th>


                        </tr>
                      </thead>

                    </table>

                    </div>





                </div>
            </div>
        </div>
    </div>
</div>
@endsection



@section('script')
<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {
    $('#data-table-talhoes').DataTable({
        language:{
            "sEmptyTable": "Nenhum registro encontrado",
            "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
            "sInfoFiltered": "(Filtrados de _MAX_ registros)",
            "sInfoPostFix": "",
            "sInfoThousands": ".",
            "sLengthMenu": "_MENU_ resultados por página",
            "sLoadingRecords": "Carregando...",
            "sProcessing": "Processando...",
            "sZeroRecords": "Nenhum registro encontrado",
            "sSearch": "Pesquisar",
            "oPaginate": {
                "sNext": "Próximo",
                "sPrevious": "Anterior",
                "sFirst": "Primeiro",
                "sLast": "Último"
            },
            "oAria": {
                "sSortAscending": ": Ordenar colunas de forma ascendente",
                "sSortDescending": ": Ordenar colunas de forma descendente"
            }
        },

        processing: true,
        serverSide: true,
        ajax: '{{ route('data_table_talhoes') }}',
        columns: [

            {data: 'identificador', name: 'identificador'},


        ],
        fields:[
            {
                label: "First name:",
                name: "first_name"
            }
        ]
    });
});
</script>



@endsection
@section('style')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.css"/>

@endsection