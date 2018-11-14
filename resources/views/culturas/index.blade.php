@extends('layouts.app')

@section('content')

<div class="container col-md-10 col-lg-10 ">
    <div class="row mt-3">
        <div class="col-md-12">
            <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/inicio">Início</a></li>
                        <li class="breadcrumb-item active">Culturas</li>
                    </ol>
            <div class="card">
                <div class="card-header">
                        <h3>Listando culturas
                            <button id = "showmodal" type="button" class="btn float-right" style="background: none">
                                <i class="fas fa-question-circle fa-2x"></i>
                            </button>
                        </h3>

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
<script type="text/javascript">
    function delete_btn(data_input){
        swal({
            title: "Tem certeza disso?",
            text: "uma vez excluída, não sera possivel recuperar essa informação!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            showCancelButton: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            var token = $(this).data('token');
                $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                });


                $.ajax({
                    url:'culturas/'+data_input.value,
                    type: 'post',
                    data: {_method: 'delete'},
                    success:function(msg){
                        swal("Pronto!", {
                          icon: "success",
                        });
                        location.reload();

                    },
                    error:function(msg){
                        location.reload();
                        swal({
                          type: 'error',
                          title: 'Não deu certo!',
                          text: 'Algo errado com essa ação!'
                        })
                    }
                });
          } else {
            swal("Your imaginary file is safe!");
          }
        });
    }

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