@extends('layouts.app')

@section('content')

<div class="container col-md-10 col-lg-10 ">
    <div class="row mt-3">
        <div class="col-md-12 ">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/inicio">Início</a></li>
                <li class="breadcrumb-item"><a href="{{Route('talhoes.index')}}">Talhões</a></li>
                <li class="breadcrumb-item active">Mostrando o talhão</li>
            </ol>
            <div class="card">

                <div class="card-header">
                    <h3>Talhão {{$talhao->identificador}}
                        <button id = "showmodal" type="button" class="btn float-right" style="background: none">
                            <i class="fas fa-question-circle fa-2x"></i>
                        </button></h3>
                </div>


                <div class="card  border-dark mb-3" style="margin: 3%;float:left;height: 15rem;width: 18rem !important;">
                        <div class="card-header" style="color: #158cba">Talhão {{$talhao->identificador}}
                            <span style="float: center" class="ml-4">Área: {{$talhao->area}} ha</span>
                            <span style="float: right" class="badge badge-success">{{count($talhao->requisicoes)}}</span>
                        </div>
                    <div class="card-body">
                        @if($talhao->culturas->first())
                            <h4 class="card-title text-dark">{{$talhao->culturas->last()->descricao}}</h4>
                            <p class="card-text text-dark" onload="mascaraData(this)">Data de
                                início: @php
                                    $data = str_replace('-','/',$talhao->culturas->last()->data_inicio);
                                    $data = explode('/',$data);
                                    echo $data[2]."/".$data[1]."/".$data[0];@endphp</p>
                        @else
                            <h4 class="card-title text-dark">Cultura ausente</h4>
                        @endif
                    </div>
                    <div class="card-footer">
                        @if($talhao->tipo != "pecuaria" && $talhao->tipo != "agricultura")
                            <h4 class="card-title text-dark"> Talhão sem tipo definido.</h4>
                        @else
                            <h4 class="card-title text-dark">Talhão de {{$talhao->tipo}}.</h4>
                        @endif
                    </div>
                </div>

                @if(Auth::user()->can('gerenciar-culturas'))
                <div class = "col-md-10 offset-1" style="padding-bottom: 5%">
                    <div class="panel-footer row"><!-- panel-footer -->
                        <div class="col-xs-6 text-left">
                            <div class="previous">
                                <a href="{{Route('talhoes.edit',[$talhao->id_talhoes])}}" class="btn btn-primary">Alterar</a>
                            </div>
                        </div>
                        <div class="col-xs-6 text-right">
                            <div class="next offset-1">
                                <meta name="csrf-token" content="{{csrf_token()}}">
                                <button type="button" class="confirm-btn btn btn-danger" value="{{$talhao->id_talhoes}}" onclick="delete_btn(this)"><i class="fas fa-trash-alt"></i>deletar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                @endif

                    @if(!Auth::user()->can('gerenciar-culturas'))
                    <div style="margin-top: 3% !important;"></div>
                    @endif

                    <table id="data-table-atividades" class="table  table-striped">
                        <thead>
                        <tr>
                            <th scope="col">Data da atividade</th>
                            <th scope="col">Descrição</th>
                            <th scope="col">Tipo de atividade</th>
                            <th scope="col">Requisição</th>
                        </tr>
                        </thead>
                    </table>
                </div>

                <div id = "popup" class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Help Talhões</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Help talhões
                            </div>
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
            $('#data-table-atividades').DataTable({
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
                ajax: '{{ route('data_table_atividades', [$talhao->id_talhoes]) }}',
                columns: [
                    {data: 'data', name: 'data'},
                    {data: 'descricao', name: 'descricao'},
                    {data: 'id_tipos_atividades_tipos_atividades', name: 'id_tipos_atividades_tipos_atividades'},
                    {data: 'id_requisicoes_requisicoes', name: 'id_requisicoes_requisicoes'},
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

    <script type="text/javascript">
        function delete_btn(data_input){
            var base_url = window.location.origin;

            swal({
                title: "Tem certeza disso?",
                text: "uma vez excluída, não sera possivel recuperar essa informação!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                showCancelButton: true,
            }).then((result) => {
              if (result.value) {
                var token = $(this).data('token');
                    $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                    });


                    $.ajax({
                        url:base_url+'/talhoes/'+data_input.value,
                        type: 'post',
                        data: {_method: 'delete'},
                        success:function(msg){
                            swal("Pronto!", {
                              icon: "success",
                            }).then((reload)=>{
                                window.location.replace(base_url+'/talhoes');
                            });

                        },
                        error:function(msg){
                            swal({
                              type: 'error',
                              title: 'Não deu certo!',
                              text: msg.responseText
                            }).then((reload)=>{
                                location.reload();
                            });
                        }
                    });
              }
            });
        }

    </script>
@endsection

@section('style')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.css"/>
@endsection