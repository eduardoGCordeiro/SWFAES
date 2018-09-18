@extends('layouts.app')

@section('content')
<div class="container">
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


                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">Item</label>
                            <div class="col-lg-6">
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
                            <label class="col-lg-4 col-form-label text-lg-right">Valor total</label>
                            <div class="col-lg-3">
                                <div class="input-group mb-3">
                                    <input onKeyPress="return(moeda(this,'.',',',event))"
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
                            <label class="col-lg-4 col-form-label text-lg-right">Quantidade</label>
                            <div class="col-lg-2">
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

                        @if(!isset($atividade))
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">Atividade</label>
                            <div class="col-lg-6">

                                <select name="id_atividades_atividades" class="form-control" id="exampleSelect1" required="">
                                    <option value="">Selecione</option>
                                    @foreach($atividades as $atividade)
                                        <option value="{{$atividade->id_atividades}}">{{$atividade->id_atividades}}</option>
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