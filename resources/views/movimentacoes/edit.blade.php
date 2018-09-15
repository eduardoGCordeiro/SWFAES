@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-3">
        <div class="col-md-12 ">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/inicio">Início</a></li>
                <li class="breadcrumb-item"><a href="{{Route('movimentacoes.index')}}">Talhões</a></li>
                <li class="breadcrumb-item active">Editar movimentação - Número da movimentação</li>
            </ol>
            <div class="card">

                <div class="card-header">

                    <h3>Editando movimentação</h3>


                </div>

                <div class="card-body col-md-8 offset-lg-2" >
                    <form role="form" method="POST" action="{{ Route('movimentacoes.update', [$movimentacao->id_movimentacoes]) }}">
                        {{ method_field('PUT') }}
                        {!! csrf_field() !!}

                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">Item</label>
                            <div class="col-lg-6">
                                <select name="id_itens_itens" class="form-control" id="exampleSelect1">
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
                            <label class="col-lg-4 col-form-label text-lg-right">Custo</label>
                            <div class="col-lg-6">
                                <div class="input-group mb-3">
                                    <input onKeyPress="return(moeda(this,'.',',',event))"
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
                            <label class="col-lg-4 col-form-label text-lg-right">Quantidade</label>
                            <div class="col-lg-6">
                                <div class="input-group mb-3">
                                    <input
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
                            <label class="col-lg-4 col-form-label text-lg-right">Atividade</label>
                            <div class="col-lg-6">
                                <select name="id_atividades_atividades" class="form-control" id="exampleSelect1">
                                    @foreach($atividade as $atividades)
                                        <option value="{{$atividades->id_atividades}}">{{$atividades->id_atividades}}</option>
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
                            <label class="col-lg-4 col-form-label text-lg-right">Descrição</label>

                            <div class="col-lg-6">
                                <textarea
                                        class="form-control"
                                        id="exampleTextarea"
                                        rows="3"
                                        name="descricao"
                                        value="{{$movimentacao->descricao}}"

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
                            <div class="col-lg-4">

                                <div class="custom-control custom-radio">
                                    <input id="customRadio1" name="tipo_movimentacoes" class="custom-control-input" checked="" type="radio" value="E">
                                    <label class="custom-control-label" for="customRadio1">Entrada</label>
                                </div>

                                <div class="custom-control custom-radio">
                                    <input id="customRadio2" name="tipo_movimentacoes" class="custom-control-input" type="radio" value="S">
                                    <label class="custom-control-label" for="customRadio2">Saída</label>
                                </div>
                            </div>
                        </div>


                        <div class="form-group row">
                            <div class="col-lg-4 row col-auto" style="margin-top: 1%;margin-left: 42%;" >
                                <div class="col-lg-2">
                                    <button type="submit" class="btn btn-primary">
                                        Salvar
                                    </button>
                                </div>
                    </form>
                                <div class="col-lg-2 offset-lg-3">
                                    <form action="{{Route('movimentacoes.destroy',[$movimentacao->id_movimentacoes])}}" method="POST"> {{csrf_field()}}
                                        <input name="_method" type="hidden" value="DELETE">
                                        <button type="submit" class="btn btn-danger">deletar</button>
                                    </form>
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
        </div>
    </div>
</div>
@endsection
@section('script')
    <script language="javascript">
        function moeda(a, e, r, t) {
            let n = ""
                , h = j = 0
                , u = tamanho2 = 0
                , l = ajd2 = ""
                , o = window.Event ? t.which : t.keyCode;
            if (13 == o || 8 == o)
                return !0;
            if (n = String.fromCharCode(o),
            -1 == "0123456789".indexOf(n))
                return !1;
            for (u = a.value.length,
                     h = 0; h < u && ("0" == a.value.charAt(h) || a.value.charAt(h) == r); h++)
                ;
            for (l = ""; h < u; h++)
                -1 != "0123456789".indexOf(a.value.charAt(h)) && (l += a.value.charAt(h));
            if (l += n,
            0 == (u = l.length) && (a.value = ""),
            1 == u && (a.value = "0" + r + "0" + l),
            2 == u && (a.value = "0" + r + l),
            u > 2) {
                for (ajd2 = "",
                         j = 0,
                         h = u - 3; h >= 0; h--)
                    3 == j && (ajd2 += e,
                        j = 0),
                        ajd2 += l.charAt(h),
                        j++;
                for (a.value = "",
                         tamanho2 = ajd2.length,
                         h = tamanho2 - 1; h >= 0; h--)
                    a.value += ajd2.charAt(h);
                a.value += r + l.substr(u - 2, u)
            }
            return !1
        }
    </script>
@endsection
