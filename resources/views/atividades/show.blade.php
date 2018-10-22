@extends('layouts.app')

@section('content')
<div class="container col-md-10 col-lg-10 ">
    <div class="row mt-3">
        <div class="col-md-12">
            <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/inicio">Início</a></li>
                        <li class="breadcrumb-item active">Atividades</li>
                    </ol>
            <div class="card">
                <div class="card-header">

                    <h3>Listando movimentações dessa atividade</h3>


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


                    <table id="data-table-movimentacoes" class="table  table-striped">
                        <thead>
                        <tr>
                            <th scope="col">Movimentação</th>
                            <th scope="col">Tipo de movimentação</th>
                            <th scope="col">Descricao</th>
                            <th scope="col">Quantidade</th>
                            <th scope="col">Custo</th>
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
        ajax: '{{ route('atividades_list_transactions',[$atividade->id_atividades]) }}',
        columns: [
                 {data: 'id_movimentacoes', name: 'id_movimentacoes', width: '0.1%', tragets:0, className:'dt-body-center dt-head-center'},
                    {data: 'tipo_movimentacoes', name: 'tipo_movimentacoes', width: '1%', tragets:0, className:'dt-body-center dt-head-center'},
                    {data: 'descricao', name: 'descricao', width: '6%', tragets:0, className:'dt-body-rigth dt-head-center'},
                    {data: 'quantidade', name: 'quantidade', width: '1%', tragets:0},
                    {data: 'custo', name: 'custo', render: $.fn.dataTable.render.number( '.', ',', 2, 'R$ ' ), width: '2%', tragets:0},
                    {data: 'action', name: 'action', width: '1%', tragets:0, className:'dt-body-center', orderable: false, searchable: false},
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

