@extends('layouts.app')
@section('style')
<link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet">

@endsection
@section('content')
<div class="container">
    <div class="row mt-5">
        <div class="col-md-12">
            <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/inicio">Início</a></li>
                        <li class="breadcrumb-item active">Itens</li>
                    </ol>
            <div class="card">
                <div class="card-header">


                    <h3>Listando itens</h3>



                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col form-group">
                            <label for="exampleSelect2">Selecione um dos itens:</label>
                            <select multiple="" class="form-control" id="exampleSelect2">
                                <option>Item 1</option>
                                <option>Item 2</option>
                                <option>Item 3</option>
                                <option>Item 4</option>
                                <option>Item 5</option>
                            </select>
                        </div>
                    </div>

                    <button type="button" class="btn btn-secondary">Ver item</button>
                    <br>
                    <hr>

                        <h4>Descrição do Item</h4>
                    <hr>

                        <div class="card border-primary mb-3" style="max-width: 20rem;">
                          <div class="card-header">Item 1</div>
                          <div class="card-body">
                            <p class="card-text"><b>Custo por item(R$):</b> 1.00</p>
                            <p class="card-text"><b>Quantidade(Kg):</b> 700.00</p>
                            <p class="card-text"><b>Tipo:</b> tipo item</p>
                          </div>
                        </div>

                        <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                          <button type="button" class="btn btn-info">ações</button>
                          <div class="btn-group" role="group">
                            <button id="btnGroupDrop3" type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                            <div class="dropdown-menu" aria-labelledby="btnGroupDrop3" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 36px, 0px);">
                              <a class="dropdown-item" href="#">Editar</a>
                              <a class="dropdown-item" href="#">Deletar</a>
                            </div>
                          </div>
                        </div>

                    <hr>

                    <h4>Listando movimentações do Item</h4>


                    <table id="data-table-itens" class="table  table-striped">

                      <thead>
                        <tr>
                            <th scope="col">id_item</th>
                            <th scope="col">nome</th>
                            <th scope="col">custo_por_unidade</th>
                            <th scope="col">quantidade</th>
                            <th scope="col">id_unidade_unidade</th>
                            <th scope="col">id_tipos_item_tipos_item</th>

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
    $('#data-table-itens').DataTable({
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
        ajax: '{{ route('data_table_itens') }}',
        columns: [
            {data: 'id_item', name: 'id_item'},
            {data: 'nome', name: 'nome'},
            {data: 'custo_por_unidade', name: 'custo_por_unidade'},
            {data: 'quantidade', name: 'quantidade'},
            {data: 'id_unidade_unidade', name: 'id_unidade_unidade'},
            {data: 'id_tipos_item_tipos_item', name: 'id_tipos_item_tipos_item'},

        ]
    });
});
</script>
@endsection