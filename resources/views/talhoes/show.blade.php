@extends('layouts.app')

@section('style')
    <link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    <div class="row mt-5">
        <div class="col-md-12 ">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/inicio">Início</a></li>
                <li class="breadcrumb-item"><a href="{{Route('talhoes.index')}}">Talhões</a></li>
                <li class="breadcrumb-item active">Mostrando o talhão</li>
            </ol>
            <div class="card">

                <div class="card-header">

                    <h3>Talhão {{$talhao->id_talhoes}}</h3>


                </div>

                <div class="card  border-dark mb-3" style="margin:3%;float:left;height: 15rem;width: 18rem !important ;">
                    <a href = "{{Route('talhoes.show',[$talhao->id_identificador])}}">
                        <div class="card-header">Talhão {{$talhao->identificador}}
                            <span style="float: center" class="ml-4">Área: {{$talhao->area}}</span>
                            <span style="float: right" class="badge badge-success">{{count($talhao->requisicoes)}}</span>
                        </div>
                    </a>
                    <div class="card-body">
                        @if($talhao->culturas->first())
                            <h4 class="card-title text-dark">safra de @if($talhao->culturas->first()->tipo_safra = "I") inverno @else verão @endif</h4>
                        @else
                            <h4 class="card-title text-dark">Sem cultura atualmente</h4>
                        @endif
                        <p class="card-text text-dark">{{$talhao->descricao}}</p>
                    </div>
                    <div class="card-footer">
                        @if($talhao->tipo != "pecuaria" && $talhao->tipo != "agricultura")
                            <h4 class="card-title text-dark"> Talhão sem tipo definido.</h4>
                        @else
                            <h4 class="card-title text-dark">Talhão de {{$talhao->tipo}}.</h4>
                        @endif
                    </div>
                </div>
                <div class = "col-md-10 offset-1" style="padding-bottom: 5%">
                    <div class="panel-footer row"><!-- panel-footer -->
                        <div class="col-xs-6 text-left">
                            <div class="previous">
                                <a href="{{Route('talhoes.edit',[$talhao->id_talhoes])}}" class="btn btn-primary">Editar</a>
                            </div>
                        </div>
                        <div class="col-xs-6 text-right">
                            <div class="next offset-1">
                                <form action="{{Route('talhoes.destroy',[$talhao->id_talhoes])}}" method="POST"> {{csrf_field()}}
                                    <input name="_method" type="hidden" value="DELETE">
                                    <button type="submit" class="btn btn-danger">deletar</button>
                                </form>
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
                    ajax: '{{ route('data_table_atividades') }}',
                    columns: [

                        {data: 'data', name: 'data'},
                        {data: 'data_registro', name: 'data_registro'},
                        {data: 'descricao', name: 'descricao'},
                        {data: 'adm_geral', name: 'id_adms_gerais_adms_gerais'},
                        {data: 'id_tipos_atividades_tipos_atividades', name: 'id_tipos_atividades_tipos_atividades'},
                        {data: 'id_culturas_culturas', name: 'id_culturas_culturas'},
                        {data: 'id_requisicoes_requisicoes', name: 'id_requisicoes_requisicoes'},
                        {data: 'id_talhoes_talhoes', name: 'id_talhoes_talhoes'},
                        {data: 'action', name: 'action'},
                    ]
                });
            });

@endsection
