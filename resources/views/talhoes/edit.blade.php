@extends('layouts.app')

@section('content')

<div class="container col-md-10 col-lg-10 ">
    <div class="row mt-3">
        <div class="col-md-12">
            <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/inicio">Início</a></li>
                        <li class="breadcrumb-item"><a href="{{Route('talhoes.index')}}">Talhões</a></li>
                        <li class="breadcrumb-item active">Editar - {{$talhoes->identificador}}</li>
                    </ol>
            <div class="card">
                <div class="card-header">
                    <h3>Editando talhão {{$talhoes -> identificador}}
                        <button id = "showmodal" type="button" class="btn float-right" style="background: none">
                            <i class="fas fa-question-circle fa-2x"></i>
                        </button>
                    </h3>
                </div>

                <div class="card-body col-md-8 offset-lg-2">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form role="form" method="POST" action="{{ Route('talhoes.update', [$talhoes->id_talhoes]) }}">
                        {{ method_field('PUT') }}
                        {!! csrf_field() !!}

                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">Identificação</label>

                            <div class="col-lg-4">
                                <input
                                        placeholder="Identificação do talhão"
                                        type="text"
                                        class="form-control{{ $errors->has('identificador') ? ' is-invalid' : '' }}"
                                        name="identificador"
                                        value="{{$talhoes->identificador}}"
                                        required
                                >
                                @if ($errors->has('identificador'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('identificador') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">Administrador do talhão</label>

                            <div class="col-lg-5">
                                    <select class="form-control" id="exampleFormControlSelect1" name="id_adms_talhoes_adms_talhoes">
                                        @if($talhoes->id_adms_talhoes_adms_talhoes == null)
                                            <option value="">Selecione</option>
                                        @else
                                            <option value="{{$talhoes->id_adms_talhoes_adms_talhoes}}">{{$adms_talhoes_nome->funcionarios->login}}</option>
                                            <option value="">Selecione</option>
                                        @endif
                                        @foreach($adms_talhoes as $adm_talhao)
                                                <option value="{{$adm_talhao->id_adms_talhoes}}">{{$adm_talhao->funcionarios->login}}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('id_adms_talhoes_adms_talhoes'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('id_adms_talhoes_adms_talhoes') }}</strong>
                                        </div>
                                    @endif
                            </div>
                        </div>

                        <div class="form-group row">

                            <label class="col-lg-4 col-form-label text-lg-right">Área</label>

                            <div class="col-lg-3">

                                <div class="input-group">
                                    <input class="form-control" type="text" name="area" value="{{$talhoes->area}}"  placeholder="0,00"
                                           onkeyup="mascara_num(this);">
                                    <div class="input-group-append">
                                        <span class="input-group-text">ha</span>
                                    </div>
                                </div>

                                @if ($errors->has('area'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('area') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">Descrição</label>

                            <div class="col-lg-6">
                                <textarea
                                        placeholder="Insira a descrição do talhão aqui..."
                                        class="form-control"
                                        id="exampleTextarea"
                                        rows="3"
                                        name="descricao"

                                >{{$talhoes->descricao}}</textarea>
                                @if ($errors->has('descricao'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('descricao') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">Tipo</label>
                            <div class="col-lg-4">

                                <div class="custom-control custom-radio">
                                    <input id="customRadio1" name="tipo" class="custom-control-input" checked="" type="radio" value="agricultura">
                                    <label class="custom-control-label" for="customRadio1">Agricultura</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input id="customRadio2" name="tipo" class="custom-control-input" type="radio" value="pecuaria">
                                    <label class="custom-control-label" for="customRadio2">Pecuária</label>
                                </div>
                            </div>

                        </div>

                        <div class="form-group row">
                            <div class="col-lg-6 offset-lg-6">
                                <button type="submit" class="btn btn-primary">
                                    Salvar
                                </button>

                            </div>
                        </div>
                        <hr>
                    </form>


                </div>
            </div>

            <div id = "popup" class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Ajuda edição de talhão</h5>
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
                                    <th scope="row">Identificador<span style="color:red">*</span></th>
                                    <td>Texto</td>
                                    <td>1</td>
                                    <td>45</td>
                                    <td>Deve conter apenas letras e números.</td>
                                </tr>
                                <tr>
                                    <th scope="row">Administrador do talhão<span style="color:red"></span></th>
                                    <td>Selecionável</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>Deve ser selecionada uma das opções listadas</td>
                                </tr>
                                <tr class="table-active">
                                    <th scope="row">Área<span style="color:red">*</span></th>
                                    <td>Decimal</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>formato: 1.000,0</td>
                                </tr>
                                <th scope="row">Descrição<span style="color:red">*</span></th>
                                <td>Texto</td>
                                <td>1</td>
                                <td>400</td>
                                <td>-</td>
                                </tr>
                                <tr class="table-active">
                                    <th scope="row">Tipo<span style="color:red">*</span></th>
                                    <td>Selecionável</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>Deve ser selecionada uma das opções listadas</td>
                                </tr>
                                </tbody>
                            </table>
                            <div class="alert alert-secondary">
                                <strong><span style="color:red">*</span></strong> Significa que o campo é obrigatório!
                            </div>
                            <div class="alert alert-secondary">
                                <strong>Observação:</strong> Só será possível selecionar um administrador de talhão se anteriormente for cadastrado um administrador de talhão.
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
    <script>
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

    </script>
@endsection
