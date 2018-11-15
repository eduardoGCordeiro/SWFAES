@extends('layouts.app')

@section('content')

<div class="container col-md-10 col-lg-10 ">
    <div class="row mt-3">
        <div class="col-md-12 ">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/inicio">Início</a></li>
                <li class="breadcrumb-item"><a href="{{Route('talhoes.index')}}">Talhões</a></li>
                <li class="breadcrumb-item active">Novo Talhão</li>
            </ol>
            <div class="card">

                <div class="card-header">

                    <h3>Cadastro de talhão
                        <button id = "showmodal" type="button" class="btn float-right" style="background: none">
                            <i class="fas fa-question-circle fa-2x"></i>
                        </button>
                    </h3>


                </div>

                <div class="card-body col-md-8 offset-lg-2" >
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                    <form role="form" method="POST" action="{{ Route('talhoes.store') }}">
                        {!! csrf_field() !!}


                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">Identificação</label>

                            <div class="col-lg-4">
                                <input
                                        placeholder="Identificação do talhão"
                                        type="text"
                                        class="form-control{{ $errors->has('identificador') ? ' is-invalid' : '' }}"
                                        name="identificador"
                                        value="{{ old('identificador') }}"
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
                                    <option value="">Selecione</option>
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
                                    <input class="form-control{{ $errors->has('area') ? ' is-invalid' : '' }}"
                                           type="text"
                                           name="area"
                                           required
                                           placeholder="00.00"
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
                                        required

                                ></textarea>
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

                                    <input id="customRadio1" name="tipo" class="custom-control-input" checked="" type="radio" value="AGRICULTURA">
                                    <label class="custom-control-label" for="customRadio1">Agricultura</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input id="customRadio2" name="tipo" class="custom-control-input" type="radio" value="PECUARIA">

                                    <label class="custom-control-label" for="customRadio2">Pecuária</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-lg-6 offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Cadastrar
                                </button>
                            </div>
                        </div>
                    </form>

                    </div>
                </div>
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
                            Help talhões
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
