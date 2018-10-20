@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-3">
        <div class="col-md-12">
            <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/inicio">Início</a></li>
                        <li class="breadcrumb-item active">Atividades</li>
                    </ol>
            <div class="card">
                <div class="card-header">

                    <h3>Listando atividades</h3>
                    @if (Auth::user()->can('gerenciar'))
                        <a href="{{Route('atividades.create')}}"><button type="button" class="btn btn-outline-success"><i class="fas fa-plus"> </i>  Cadastrar nova</button></a>
                    @endif

                </div>

                <div class="card-body">
                    <div class="flash-message">
                      @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                        @if(Session::has('alert-' . $msg))

                            <div class="alert alert-{{ $msg }} alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <p class="mb-0">{!! Session::get('alert-' . $msg) !!}</p>
                            </div>

                        @endif
                      @endforeach
                    </div>


                    <table id="data-table-atividades-all" class="table  table-striped">

                      <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Data</th>
                            <th scope="col">Talhão</th>
                            <th scope="col">Cultura</th>
                            <th scope="col">Tipo</th>
                            @if (Auth::user()->can('gerenciar-atividades'))
                            <th scope="col" class="text-center">Ações</th>
                            @endif

                        </tr>
                      </thead>

                    </table>
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
    $('#data-table-atividades-all').DataTable({
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
        ajax: '{{ route('data_table_atividades_all') }}',
        columns: [

            {data: 'id_atividades', name: 'id_atividades'},
            {data: 'data', name: 'data'},
            {data: 'id_talhoes_talhoes', name: 'id_talhoes_talhoes'},
            {data: 'id_culturas_culturas', name: 'id_culturas_culturas'},
            {data: 'tipo', name: 'tipo'},
            @if (Auth::user()->can('gerenciar-atividades'))
            {data: 'action', name: 'action', orderable: false, searchable: false}
            @endif

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
<style type="text/css">
        .mb-0 a{
            color: white;
            font-weight: bolder !important;
        }
</style>
@endsection

