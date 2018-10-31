@extends('layouts.app')

@section('content')
<div class="container col-md-10 col-lg-10 ">
    <div class="row mt-3">
        <div class="col-md-12 ">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/inicio">Início</a></li>
                <li class="breadcrumb-item"><a href="{{Route('movimentacoes.index')}}">Movimentações</a></li>
                <li class="breadcrumb-item active">Nova movimentação</li>
            </ol>
            <div class="card">

                <div class="card-header">

                    <h3>Cadastro de movimentação @if(isset($atividade)) para atividade {{$atividade}} @endif</h3>


                </div>

                <div class="card-body col-md-8 offset-lg-2" >
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form role="form" method="POST" action="{{ Route('movimentacoes.store') }}">
                        {!! csrf_field() !!}

                        @if(!isset($atividade))
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label text-lg-right">Atividade</label>
                                <div class="col-lg-6">

                                    <select name="id_atividades_atividades" class="form-control" id="exampleSelect1" required="">
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
                        @else
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label text-lg-right">Atividade</label>
                                <div class="col-lg-2">


                                    <input name="id_atividades_atividades" class="form-control" value="{{$atividade}}" id="readOnlyInput" type="text" placeholder="Readonly input here…" readonly="">


                                    @if ($errors->has('id_atividades_atividades'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('id_atividades_atividades') }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif

                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">Item</label>
                            <div class="col-lg-5">
                                <select name="id_itens_itens" class="form-control" id="exampleSelect1" required="">
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
                                            class="form-control"
                                            type="text"
                                            name="quantidade"
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
                                    <input onkeyup="mascara_num(this);"
                                           class="form-control"
                                           type="text"
                                           name="custo"
                                           value=""
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
                            <label class="col-lg-4 col-form-label text-lg-right">Valor total</label>
                            <div class="col-lg-3">
                                <div class="input-group mb-3">
                                    <input  onkeyup="mascara_num(this);"
                                            class="form-control"
                                            type="text"
                                            name="custo"
                                            required
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
                            <label class="col-lg-4 col-form-label text-lg-right">Descrição</label>

                            <div class="col-lg-6">
                                <textarea
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


                        <div class="form-group row">
                            <div class="col-lg-6 offset-lg-4">
                                <button type="submit" class="btn btn-primary">
                                    Cadastrar
                                </button>
                            </div>
                        </div>
                    </form>

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
    </script>
@endsection
