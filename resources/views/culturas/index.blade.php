@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-3">
        <div class="col-md-12">
            <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/inicio">Início</a></li>
                        <li class="breadcrumb-item active">Culturas</li>
                    </ol>
            <div class="card">
                <div class="card-header">
                        <h3>Listando culturas</h3>
                        @if (Auth::user()->can('gerenciar-culturas'))
                        <a href="{{Route('culturas.create')}}"><button type="button" class="btn btn-outline-success"><i class="fas fa-plus"></i> Cadastrar nova</button></a>
                        @endif





                    </div>




                    <div class="card-body">
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


                        <table id="data-table-culturas" class="table  table-striped">

                          <thead>
                            <tr>


                                <th scope="col">ID</th>
                                <th scope="col">Talhão</th>
                                <th scope="col">Data início</th>
                                <th scope="col">Data fim</th>
                                <th scope="col">Tipo de safra</th>
                                <th scope="col">Descrição</th>
                                @if (Auth::user()->can('gerenciar-culturas'))
                                    <th scope="col">Actions</th>
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
    $('#data-table-culturas').DataTable({
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
        ajax: '{{ route('data_table_culturas') }}',
        columns: [

            {data: 'id_culturas', name: 'id_culturas'},
            {data: 'id_talhoes_talhoes', name: 'id_talhoes_talhoes'},
            {data: 'data_inicio', name: 'data_inicio'},
            {data: 'data_fim', name: 'data_fim'},
            {data: 'tipo_safra', name: 'tipo_safra'},
            {data: 'descricao', name: 'descricao'},
            @if (Auth::user()->can('gerenciar-culturas'))
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

@endsection