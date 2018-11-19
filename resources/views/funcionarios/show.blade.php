@extends('layouts.app')

@section('content')

<div class="container col-md-10 col-lg-10 ">
    <div class="row mt-3">
        <div class="col-md-12 ">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/inicio">Início</a></li>
                <li class="breadcrumb-item"><a href="{{Route('funcionarios.index')}}">Funcionários</a></li>
                <li class="breadcrumb-item active">Ver Funcionário</li>
            </ol>
            <div class="card">

                <div class="card-header">

                    <h3>Funcionário
                        <button id = "showmodal" type="button" class="btn float-right" style="background: none">
                            <i class="fas fa-question-circle fa-2x"></i>
                        </button>
                    </h3>


                </div>

                <div class="card-body col-md-12 offset-lg-0" >

                    <h2>Informações do funcionário</h2>


                    <table class="table">

                        <tr>
                            <th>Nome</th>
                            <td>{{$funcionario->nome}}</td>
                        </tr>
                        <tr>
                            <th>CPF</th>
                            <td>{{$funcionario->cpf}}</td>
                        </tr>
                        <tr>
                            <th>login</th>
                            <td>{{$funcionario->login}}</td>
                        </tr>
                        <tr>
                            <th>E-mail</th>
                            <td>{{$funcionario->email}}</td>
                        </tr>
                        <tr>
                            <th>Acesso ao sistema?</th>
                            <td>{{$funcionario->acesso_sistema?'Sim':'Não'}}</td>
                        </tr>
                        <tr>
                            <th>Nível de acesso</th>
                            <td>
                                @if ($funcionario->adm_geral)
                                <li class="nav-item nav-link">
                                    <span class="badge badge-danger">Adm geral</span></sub>
                                </li>
                                @elseif ($funcionario->acesso_sistema)
                                <li class="nav-item nav-link">
                                    <span class="badge badge-info">Adm talhão</span></sub>
                                </li>
                                @else
                                <li class="nav-item nav-link">
                                    <span class="badge badge-secondary">Sem acesso </span></sub>
                                </li>
                                @endif
                            </td>
                        </tr>



                    </table>



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
                                <!-- <form action="{{Route('funcionarios.destroy',[$funcionario->id_funcionarios])}}" method="POST"> {{csrf_field()}}
                                    <input name="_method" type="hidden" value="DELETE">
                                    <button type="submit" class="btn btn-danger">deletar</button>
                                </form> -->
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


                            <!-- <form role="form" method="POST" action="{{ Route('adms_talhoes.update',[$funcionario->id_funcionarios]) }}">
                            {{ method_field('PUT') }}
                            {!! csrf_field() !!}
                            <div class="form-group">

</label>
                                  <select multiple=" " name="talhoes[]" class="form-control" id="exampleSelect2">
                                    @foreach($talhoes as $talhao)
                                        <option  value="{{$talhao->id_talhoes}}">{{$talhao->identificador}}</option>

                                    @endforeach
                                  </select>
                            </div>

                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Alterar</button>

                            </div>
                        </form> -->

                    </div>





                </div>
            </div>

            <div id = "popup" class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Ajuda funcionários</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Aqui apenas são listadas as informações cadastrais de um funcionário específico.</p>
                        </div>
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
        ajax: '{{ route('data_table_funcionarios_talhoes',[$funcionario->id_funcionarios]) }}',
        columns: [


            {data: 'identificador', name: 'identificador'},
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

$(document).unbind("keyup").keyup(function(e){
    var code = e.which;
    if(code==112)
    {
        $("#popup").modal('show', 'handleUpdate');
    }
});

$('#showmodal').click(function() {
    $('#popup').modal('show');
});
</script>
@endsection

@section('style')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.css"/>

@endsection