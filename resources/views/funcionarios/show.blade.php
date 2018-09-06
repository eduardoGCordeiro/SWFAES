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

                <div class="card-body col-md-12 offset-lg-0" >

                    <legend>{{$funcionario->nome}}</legend>
                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-3 col-form-label"><b>Email: </b></label>
                      <div class="col-sm-9">
                        <input type="text" readonly="" class="form-control-plaintext" id="staticEmail" value="email@example.com">
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-3 col-form-label"><b>CPF:</b></label>
                      <div class="col-sm-9">
                        <input type="text" readonly="" class="form-control-plaintext" id="staticEmail" value="{{$funcionario->cpf}}">
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-3 col-form-label"><b>Login:</b></label>
                      <div class="col-sm-9">
                        <input type="text" readonly="" class="form-control-plaintext" id="staticEmail" value="{{$funcionario->login}}">
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-3 col-form-label"><b>Acesso ao sistema:</b></label>
                      <div class="col-sm-9">
                        <input type="text" readonly="" class="form-control-plaintext" id="staticEmail" value="{{$funcionario->acesso_sistema?'Sim':'Não'}}">
                      </div>
                    </div>


                    <hr>
                    <h4>Ações</h4>

                    <div class = "col-md-12 " style="padding-bottom: 5%">
                    <div class="panel-footer row"><!-- panel-footer -->
                        <div class="col-xs-6 text-left">
                            <div class="previous">
                                <a href="{{Route('funcionarios.edit',[$funcionario->id_funcionarios])}}" class="btn btn-primary">Editar</a>
                            </div>
                        </div>
                        <div class="col-xs-6 text-right">
                            <div class="next offset-1">
                                <form action="{{Route('funcionarios.destroy',[$funcionario->id_funcionarios])}}" method="POST"> {{csrf_field()}}
                                    <input name="_method" type="hidden" value="DELETE">
                                    <button type="submit" class="btn btn-danger">deletar</button>
                                </form>
                            </div>
                        </div>
                    </div>



 <hr>
                    <h4>Talhões</h4>

                    <div class="flash-message">
                      @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                        @if(Session::has('alert-' . $msg))

                            <div class="alert alert-{{ $msg }} alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <p class="mb-0">{{ Session::get('alert-' . $msg) }}</p>
                            </div>



                        @endif
                      @endforeach
                    </div>

                    <table id="data-table-unidades" class="table  table-striped">

                      <thead>
                        <tr>

                            <th scope="col">Identificador do talhão</th>

                            <th scope="col">Ações</th>

                        </tr>
                      </thead>

                    </table>


                            <form role="form" method="POST" action="{{ Route('adms_talhoes.update',[$funcionario->id_funcionarios]) }}">
                            {{ method_field('PUT') }}
                            {!! csrf_field() !!}
                            <div class="form-group">
                                  <label for="exampleSelect2">Caso deseje selecione novamente os talhões para esse funcionário</label>
                                  <select multiple=" " name="talhoes[]" class="form-control" id="exampleSelect2">
                                    @foreach($talhoes as $talhao)
                                        <option  value="{{$talhao->id_talhoes}}">{{$talhao->identificador}}</option>

                                    @endforeach
                                  </select>
                            </div>

                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Alterar</button>

                            </div>
                        </form>

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
    $('#data-table-unidades').DataTable({
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
        ajax: '{{ route('data_table_adms_talhoes',[$funcionario->id_funcionarios]) }}',
        columns: [


            {data: 'nome_talhoes', name: 'nome_talhoes'},
            {data: 'action', name: 'action', orderable: false, searchable: false},


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