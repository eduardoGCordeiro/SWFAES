@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-3">
        <div class="col-md-12">
            <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/inicio">Início</a></li>
                        <li class="breadcrumb-item active">Movimentações</li>
                    </ol>
            <div class="card">

                <div class="card-header">
                    <h4>Listando movimentações</h4>
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

                    <table id="data-table-movimentacoes" class="table  table-striped">
                        <thead>
                        <tr>
                            <th scope="col">Movimentação</th>
                            <th scope="col">Tipo de movimentação</th>
                            <th scope="col">Quantidade</th>
                            <th scope="col">Custo</th>
                            <th scope="col">Descricao</th>
                            <th scope="col">Ações</th>
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
            $('#data-table-movimentacoes').DataTable({
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
                ajax: '{{route('data_table_movimentacoes')}}',
                columns: [
                    {data: 'id_movimentacoes', name: 'id_movimentacoes'},
                    {data: 'tipo_movimentacoes', name: 'tipo_movimentacoes'},
                    {data: 'quantidade', name: 'quantidade'},
                    {data: 'custo', name: 'custo'},
                    {data: 'descricao', name: 'descricao'},
                    {data: 'action', name: 'action'},
                ]
            });
        });
    </script>
@endsection

@section('style')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.css"/>
@endsection
