@extends('layouts.app')

@section('content')
<div class="container col-md-10 col-lg-10 ">
    <div class="row mt-3">
        <div class="col-md-12">
            <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/inicio">Início</a></li>
                        <li class="breadcrumb-item active">Movimentações</li>
                    </ol>
            <div class="card">

                <div class="card-header">
                    <h3>Listando movimentações
                        <button id = "showmodal" type="button" class="btn float-right" style="background: none">
                            <i class="fas fa-question-circle fa-2x"></i>
                        </button>
                    </h3>
                    <a href="{{Route('movimentacoes.create')}}"><button type="button" class="btn btn-outline-success"><i class="fas fa-plus"> </i>  Cadastrar nova</button></a>
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
                            <th scope="col">Data Movimentação</th>
                            <th scope="col">Tipo de movimentação</th>
                            <th scope="col">Item</th>
                            <th scope="col">Descricao</th>
                            <th scope="col">Quantidade</th>
                            <th scope="col">Custo</th>
                            <th scope="col">Ações</th>
                        </tr>
                        </thead>
                    </table>

                </div>
            </div>

            <div id = "popup" class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Ajuda movimentações</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Aqui é possível ver a lista de movimentações cadastradas no sistema e suas informações, as movimentações são classificadas como <strong>ENTRADAS (E)</strong> e <strong>SAÍDAS (S)</strong>. As movimentações são relacionados a atividades, ou seja, a movimentação é gerada a partir de uma atividade. </p>
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
                    },
                },

                processing: true,
                serverSide: true,
                ajax: '{{route('data_table_movimentacoes')}}',
                columns: [
                    {data: 'id_movimentacoes', name: 'id_movimentacoes', width: '0.1%', tragets:0, className:'dt-body-center dt-head-center'},
                    {data: 'data', name: 'data_movimentacao', width: '1%', tragets:0, className:'dt-body-center dt-head-center'},
                    {data: 'tipo_movimentacoes', name: 'tipo_movimentacoes', width: '1%', tragets:0, className:'dt-body-center dt-head-center'},
                    {data: 'id_itens_itens', name: 'itens', width: '0.1%', tragets:0, className:'dt-body-center dt-head-center', orderable: false},
                    {data: 'descricao', name: 'descricao', width: '6%', tragets:0, className:'dt-body-rigth dt-head-center'},
                    {data: 'quantidade', name: 'quantidade', width: '1%', tragets:0},
                    {data: 'custo', name: 'custo', render: $.fn.dataTable.render.number( '.', ',', 2, 'R$ ' ), width: '2%', tragets:0},
                    {data: 'action', name: 'action', width: '1%', tragets:0, className:'dt-body-center', orderable: false, searchable: false},
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
    <style type="text/css">
        .mb-0 a{
            color: white;
            font-weight: bolder;
        }
    </style>
@endsection
