@extends('layouts.app')

@section('content')

<div class="container col-md-10 col-lg-10 ">
    <div class="row mt-3">
        <div class="col-md-12 ">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/inicio">Início</a></li>
                <li class="breadcrumb-item"><a href="{{Route('itens.index')}}">Itens</a></li>
                <li class="breadcrumb-item active">Editar item - NOME DO ITEM</li>
            </ol>
            <div class="card">

                <div class="card-header">

                    <h3>Editando Item {{$item->nome}}
                        <button id = "showmodal" type="button" class="btn float-right" style="background: none">
                            <i class="fas fa-question-circle fa-2x"></i>
                        </button>
                    </h3>


                </div>

                <div class="card-body col-md-8 offset-lg-2" >

                    <form role="form" method="POST" action="{{ Route('itens.update',[$item->id_itens]) }}">
                        {{ method_field('PUT') }}
                        {!! csrf_field() !!}


                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">Nome</label>

                            <div class="col-lg-5">
                                <input
                                        placeholder="Insira o nome do item aqui"
                                        type="text"
                                        class="form-control{{ $errors->has('nome') ? ' is-invalid' : '' }}"
                                        name="nome"
                                        value="{{$item->nome}}"
                                        required
                                >
                                @if ($errors->has('nome'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('nome') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">Unidade de medida</label>

                            <div class="col-lg-3">
                                <select  name="id_unidades_unidades" class="form-control" id="select_unidades">
                                    <option value="">Selecione</option>
                                    @foreach($unidades as $unidade)

                                    <option value="{{$unidade->id_unidades}}">{{$unidade->nome}}</option>


                                    @endforeach
                                </select>

                                @if ($errors->has('id_unidades_unidades'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('id_unidades_unidades') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">Tipo de item</label>

                            <div class="col-lg-3">
                                <select  name="id_tipos_itens_tipos_itens" class="form-control" id="select_tipo">
                                    <option value="">Selecione</option>
                                    @foreach($tipos_itens as $tipo_item)

                                    <option value="{{$tipo_item->id_tipos_itens}}">{{$tipo_item->nome}}</option>


                                    @endforeach
                                </select>

                                @if ($errors->has('id_tipos_itens_tipos_itens'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('id_tipos_itens_tipos_itens') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>





                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">Custo por unidade</label>

                            <div class="col-lg-3">

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                            <span class="input-group-text">R$</span>
                                          </div>
                                    <input
                                        class="form-control"
                                        type="text"
                                        name="custo_por_unidades"
                                        value="{{$item->custo_por_unidades}}"
                                        placeholder="00.00"
                                    >

                                </div>

                                @if ($errors->has('custo_por_unidades'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('custo_por_unidades') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>
<!--
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">Descrição</label>

                            <div class="col-lg-6">
                                <textarea
                                    class="form-control"
                                    id="exampleTextarea"
                                    rows="3"
                                    name="descricao"

                                ></textarea>
                                @if ($errors->has('descricao'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('descricao') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>
 -->

                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">Qauntidade inicial</label>

                            <div class="col-lg-3">
                                <input
                                        type="text"
                                        class="form-control{{ $errors->has('quantidade') ? ' is-invalid' : '' }}"
                                        name="quantidade"
                                        value="{{$item->quantidade}}"
                                        placeholder="00.00"
                                        required
                                >
                                @if ($errors->has('quantidade'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('quantidade') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>





                        <div class="form-group row">
                            <div class="col-lg-6 offset-lg-4">
                                <button type="submit" class="btn btn-primary">
                                    Alterar
                                </button>
                            </div>
                        </div>

                    </form>

                </div>
            </div>

            <div id = "popup" class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Ajuda edição de itens</h5>
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
                                    <th scope="row">Nome<span style="color:red">*</span></th>
                                    <td>Texto</td>
                                    <td>1</td>
                                    <td>46</td>
                                    <td>-</td>
                                </tr>
                                <tr>
                                    <th scope="row">Unidade de medida<span style="color:red">*</span></th>
                                    <td>Selecionável</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>Deve ser selecionada uma das opções listadas</td>
                                </tr>
                                <tr class="table-active">
                                    <th scope="row">Tipo de item<span style="color:red">*</span></th>
                                    <td>Selecionável</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>Deve ser selecionada uma das opções listadas</td>
                                </tr>
                                <tr>
                                    <th scope="row">Custo por unidade<span style="color:red">*</span></th>
                                    <td>Decimal</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>formato: 1.000,0</td>
                                </tr>
                                <tr class = "table-active">
                                    <th scope="row">Quantidade inicial<span style="color:red">*</span></th>
                                    <td>Decimal</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>formato: 1.000,0</td>
                                </tr>
                                </tbody>
                            </table>
                            <div class="alert alert-secondary">
                                <strong><span style="color:red">*</span></strong> Significa que o campo é obrigatório!
                            </div>
                            <div class="alert alert-secondary">
                                <strong>Observação:</strong> Só será possível editar um item desde que seja cadastrado anteriormente uma unidade de medida e um tipo de item.
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
<script type="text/javascript">

    document.getElementById('select_unidades').value={{$item->id_unidades_unidades}};
    document.getElementById('select_tipo').value={{$item->id_tipos_itens_tipos_itens}};

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