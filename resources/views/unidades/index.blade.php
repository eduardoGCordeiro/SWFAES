@extends('layouts.app')
@section('style')
<link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet">

@endsection
@section('content')

<div class="container col-md-10 col-lg-10 ">

    <div class="row mt-3">
        <div class="col-md-12">
            <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/inicio">Início</a></li>
                        <li class="breadcrumb-item active">Unidades de medida</li>
                    </ol>
            <div class="card">
                <div class="card-header">


                    <h3>Listando unidades
                        <button id = "showmodal" type="button" class="btn float-right" style="background: none">
                            <i class="fas fa-question-circle fa-2x"></i>
                        </button>
                    </h3>
                    <a href="{{Route('unidades.create')}}"><button type="button" class="btn btn-outline-success"> <i class="fas fa-plus"></i> Cadastrar nova</button></a>





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


                    <table id="data-table-unidades" class="table  table-striped">

                      <thead>
                        <tr>

                            <th scope="col">Nome</th>
                            <th scope="col">Sigla</th>
                            <th scope="col" style="margin-left: 50%">Ações</th>

                        </tr>
                      </thead>

                    </table>
                </div>
            </div>

            <div id = "popup" class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Help unidades de medidas</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Nessa página é possível visualizar as unidades de medidas já cadastradas no sistema!</p>
                            <p>Para cada um dos tipos de itens é possível através de "Ações", editar ou deletar. </p>
                            <p>A deleção e edição só ocorrerá se o tipo de item não estiver relacionado a um item.</p>
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
    $('#data-table-unidades').DataTable({
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
        ajax: '{{ route('data_table_unidades') }}',
        columns: [

            {data: 'nome', name: 'nome'},
            {data: 'sigla', name: 'sigla'},
            {data: 'action', name: 'action', orderable: false, searchable: false}

        ],
        fields:[
            {
                label: "First name:",
                name: "first_name"
            }
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
                text: "uma vez excluída, não será possivel recuperar essa informação!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                showCancelButton: true,
                cancelButtonText: 'Cancelar',
                closeOnCancel: false,
            }).then((result) => {
            if (result.value) {
                var token = $(this).data('token');
                    $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                    });
                    $.ajax({
                        url:base_url+'/unidades/'+data_input.value,
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

@endsection
