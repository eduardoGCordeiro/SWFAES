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

                    <h3>Listando atividades
                        <button id = "showmodal" type="button" class="btn float-right" style="background: none">
                            <i class="fas fa-question-circle fa-2x"></i>
                        </button></h3>
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
                            <th scope="col">Atividade</th>
                            <th scope="col">Data</th>
                            <th scope="col">Talhão</th>
                            <th scope="col">Cultura</th>
                            @if (Auth::user()->can('gerenciar-atividades'))
                            <th scope="col" class="text-center">Ações</th>
                            @endif

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
                                <p>As atividades são o registro de tarefas realizadas na fazenda escola, essas atividades possuem movimentações e estão relacionadas ou não com algum talhão.</p>
                                <p>Aqui são listadas todas as atividades registradas para a fazenda. Para cada uma delas é possível através de "Ações", editar, excluir ou ver movimentações.</p>
                                <p>Também é possível acessar a página de cadastro no botão superior "cadastrar nova".</p>
                                <p>Não é possível deletar atividades que possuem movimentações.</p>
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
            {data: 'descricao', name: 'descricao', render: $.fn.dataTable.render.ellipsis()},
            {data: 'data', name: 'data'},
            {data: 'id_talhoes_talhoes', name: 'id_talhoes_talhoes'},
            {data: 'id_culturas_culturas', name: 'id_culturas_culturas'},
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
$.fn.dataTable.render.ellipsis = function () {
    return function ( data, type, row ) {
        return type === 'display' && data.length > 10 ?
            data.substr( 0, 33) +'…' :
            data;
    }
};
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
         }).then((result) => {
          if (result.value) {
            var token = $(this).data('token');
                $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                });


                $.ajax({
                    url:'atividades/'+data_input.value,
                    type: 'post',
                    data: {_method: 'delete'},
                    success:function(msg){
                        swal("Pronto!", {
                          icon: "success",
                        }).then((reload)=>{
                            location.reload();                                
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
            font-weight: bolder !important;
        }
</style>
@endsection

