@extends('layouts.app')

@section('content')
<div class="container col-md-10 col-lg-10 ">
    <div class="row mt-3">
        <div class="col-md-12 ">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/inicio">Início</a></li>
                <li class="breadcrumb-item"><a href="{{Route('movimentacoes.index')}}">Movimentações</a></li>
                <li class="breadcrumb-item active">Editar movimentação</li>
            </ol>
            <div class="card">

                <div class="card-header">

                    <h3>Editando movimentação
                        <button id = "showmodal" type="button" class="btn float-right" style="background: none">
                            <i class="fas fa-question-circle fa-2x"></i>
                        </button>
                    </h3>


                </div>

                <div class="card-body col-md-8 offset-lg-2" >
                    <form role="form" method="POST" action="{{ Route('movimentacoes.update', [$movimentacao->id_movimentacoes]) }}">
                        {{ method_field('PUT') }}
                        {!! csrf_field() !!}


                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">Atividade</label>
                            <div class="col-lg-5">
                                <select name="id_atividades_atividades" class="form-control" id="exampleSelect1">
                                        <option value="">Selecione</option>
                                    @foreach($atividades as $atividade)
                                        <option value="{{$atividade->id_atividades}}">{{$atividade->descricao}}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('id_atividades_atividades'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('id_atividades_atividades') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">Item</label>
                            <div class="col-lg-3">
                                <select name="id_itens_itens" class="form-control" id="item_select">
                                    @foreach($item as $itens)
                                        <option value="{{$itens->id_itens}}">{{$itens->nome}}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('id_itens_itens'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('id_itens_itens') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">Quantidade</label>
                            <div class="col-lg-3">
                                <div class="input-group mb-3">
                                    <input
                                            placeholder="00.00"
                                            onkeyup="mascara_num(this);"
                                            class="form-control"
                                            type="text"
                                            name="quantidade"
                                            value="{{$movimentacao->quantidade}}"
                                    >
                                </div>

                                @if ($errors->has('quantidade'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('quantidade') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">Custo</label>
                            <div class="col-lg-3">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">R$</span>
                                    </div>
                                    <input
                                            placeholder="00.00"
                                            onkeyup="mascara_num(this);"
                                            class="form-control"
                                            type="text"
                                            name="custo"
                                            value="{{$movimentacao->custo}}"
                                    >
                                </div>

                                @if ($errors->has('custo'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('custo') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">Data</label>

                            <div class="col-lg-3">
                                <input
                                        type="date"
                                        class="form-control{{ $errors->has('data') ? ' is-invalid' : '' }}"
                                        name="data"
                                        style="padding-left: 15%"
                                        value="{{$movimentacao->data}}"
                                        required
                                >
                                @if ($errors->has('data'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('data') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">Descrição</label>

                            <div class="col-lg-6">
                                <textarea
                                        placeholder="Insira a descrição da movimentação aqui..."
                                        class="form-control"
                                        id="exampleTextarea"
                                        rows="3"
                                        name="descricao"
                                        value="{{$movimentacao->descricao}}"

                                >{{$movimentacao->descricao}}</textarea>
                                @if ($errors->has('descricao'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('descricao') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>

                        @if($movimentacao->tipo_movimentacoes == "E")
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label text-lg-right">Tipo de movimentação</label>
                                <div class="col-lg-4 row" style="margin-top: 1%;">

                                    <div class="custom-control custom-radio" style="margin-left: 8%;">
                                        <input id="customRadio1" name="tipo_movimentacoes" class="custom-control-input" checked="" type="radio" value="E">
                                        <label class="custom-control-label" for="customRadio1">Entrada</label>
                                    </div>

                                    <div class="custom-control custom-radio" style="margin-left: 20%;">
                                        <input id="customRadio2" name="tipo_movimentacoes" class="custom-control-input" type="radio" value="S">
                                        <label class="custom-control-label" for="customRadio2">Saída</label>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label text-lg-right">Tipo de movimentação</label>
                                <div class="col-lg-4 row" style="margin-top: 1%;">

                                    <div class="custom-control custom-radio" style="margin-left: 8%;">
                                        <input id="customRadio1" name="tipo_movimentacoes" class="custom-control-input"  type="radio" value="E">
                                        <label class="custom-control-label" for="customRadio1">Entrada</label>
                                    </div>

                                    <div class="custom-control custom-radio" style="margin-left: 20%;">
                                        <input id="customRadio2" name="tipo_movimentacoes" class="custom-control-input" checked="" type="radio" value="S">
                                        <label class="custom-control-label" for="customRadio2">Saída</label>
                                    </div>
                                </div>
                            </div>
                        @endif


                        <div class="form-group row">
                            <div class="col-lg-4 row col-auto" style="margin-top: 1%;margin-left: 42%;" >
                                <div class="col-lg-2">
                                    <button type="submit" class="btn btn-primary">
                                        Salvar
                                    </button>
                                </div>
                    </form>
                                <div class="col-lg-2 offset-lg-3">
                                <meta name="csrf-token" content="{{csrf_token()}}">
                                <button type="button" class="confirm-btn btn btn-danger" value="{{$movimentacao->id_movimentacoes}}" onclick="delete_btn(this)"><i class="fas fa-trash-alt"></i>deletar</button>   
                                </div>
                            </div>
                        </div>

                        <hr>
                        <div class="form-group row">
                            <div class="col-lg-6 offset-lg-4" style="text-align: center;">
                                <div class="alert alert-dismissible alert-danger">
                                    <strong>Excluir movimentação!</strong> Para deletar essa movimentação clique no botão <strong>DELETAR</strong>, mas lembre-se que isso é irreversível.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id = "popup" class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Ajuda edição de movimentações</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <h7>Tipos de dados</h7>
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th scope="col">Campo</th>
                                        <th scope="col">Tipo de dado</th>
                                        <th scope="col">Tamanho máximo</th>
                                        <th scope="col">Tamanho mínimo</th>
                                        <th scope="col">Restrições</th>
                                    </tr>
                                    <tbody>
                                    <tr class="table-active">
                                        <th scope="row">Atividade<span style="color:red">*</span></th>
                                        <td>Selecionável</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>Deve ser selecionada uma das opções listadas</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Item<span style="color:red">*</span></th>
                                        <td>Selecionável</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>Deve ser selecionada uma das opções listadas</td>
                                    </tr>
                                    <tr class="table-active">
                                        <th scope="row">Quantidade<span style="color:red">*</span></th>
                                        <td>Decimal</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>formato: 1.000,0</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Custo<span style="color:red">*</span></th>
                                        <td>Decimal</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>formato: 1.000,0</td>
                                    </tr>
                                    <tr class="table-active">
                                        <th scope="row">Data<span style="color:red">*</span></th>
                                        <td>data</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>formato: dd/mm/aaaa</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Descrição<span style="color:red">*</span></th>
                                        <td>Texto</td>
                                        <td>1</td>
                                        <td>200</td>
                                        <td>-</td>
                                    </tr>
                                    </tbody>
                                </table>
                                <div class="alert alert-secondary">
                                    <strong><span style="color:red">*</span></strong> Significa que o campo é obrigatório!
                                </div>
                                <div class="alert alert-secondary">
                                    <strong>Observação:</strong> <p>Só será possível cadastrar uma movimentação desde que seja cadastrado anteriormente uma atividade e um item.</p>
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
    <script language="javascript">
        function mascara_num(obj){
            valida_num(obj)
            if (obj.value.match("-")){
                mod = "-";
            }else{
                mod = "";
            }
            valor = obj.value.replace("-","");
            valor = valor.replace(",","");
            if (valor.length >= 3){
                valor = poe_ponto_num(valor.substring(0,valor.length-2))+","+valor.substring(valor.length-2, valor.length);
            }
            obj.value = mod+valor;
        }
        function poe_ponto_num(valor){
            valor = valor.replace(/\./g,"");
            if (valor.length > 3){
                valores = "";
                while (valor.length > 3){
                    valores = "."+valor.substring(valor.length-3,valor.length)+""+valores;
                    valor = valor.substring(0,valor.length-3);
                }
                return valor+""+valores;
            }else{
                return valor;
            }
        }
        function valida_num(obj){
            numeros = new RegExp("[0-9]");
            while (!obj.value.charAt(obj.value.length-1).match(numeros)){
                if(obj.value.length == 1 && obj.value == "-"){
                    return true;
                }
                if(obj.value.length >= 1){
                    obj.value = obj.value.substring(0,obj.value.length-1)
                }else{
                    return false;
                }
            }
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


        function delete_btn(data_input){
            var base_url = window.location.origin;
            
            swal({
                title: "Tem certeza disso?",
                text: "uma vez excluída, não sera possivel recuperar essa informação!",
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
                        url:base_url+'/movimentacoes/'+data_input.value,
                        type: 'post',
                        data: {_method: 'delete'},
                        success:function(msg){
                            swal("Pronto!", {
                              icon: "success",
                            }).then((reload)=>{
                                window.location.replace(base_url+'/movimentacoes');                        
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

    </script>
@endsection
