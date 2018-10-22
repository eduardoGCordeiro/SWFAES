@extends('layouts.app')

@section('content')
<div class="container col-md-10 col-lg-10 ">
    <div class="row mt-3">
        <div class="col-md-12 ">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/inicio">Início</a></li>
                <li class="breadcrumb-item"><a href="{{Route('culturas.index')}}">Culturas</a></li>
                <li class="breadcrumb-item active">Nova cultura</li>
            </ol>
            <div class="card">

                <div class="card-header">
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
                    <h3>Cadastro de cultura</h3>


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

                    <form role="form" method="POST" action="{{ Route('culturas.store') }}">
                        {!! csrf_field() !!}


                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">Data de ínicio</label>

                            <div class="col-lg-6">
                                <input
                                        type="date"
                                        class="form-control{{ $errors->has('data') ? ' is-invalid' : '' }}"
                                        name="data_inicio"
                                        value="{{ old('data_inicio') }}"
                                        required
                                >
                                @if ($errors->has('data_inicio'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('data_inicio') }}</strong>
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

                                ></textarea>
                                @if ($errors->has('descricao'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('descricao') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">Tipo de safra</label>

                            <div class="col-lg-6">
                                <select name="tipo_safra" class="form-control" id="exampleSelect1">
                                    <option value="V">Verão</option>
                                    <option value="I">Inverno</option>

                                </select>

                                @if ($errors->has('tipo_safra'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('tipo_safra') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">Talhão</label>

                            <div class="col-lg-6">
                                <select name="talhao" class="form-control" id="exampleSelect1" required="">
                                    <option value="">Selecione</option>

                                    @foreach($talhoes as $talhao)
                                        <option value="{{$talhao->id_talhoes}}">{{$talhao->identificador}}</option>
                                    @endforeach

                                </select>

                                @if ($errors->has('talhao'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('talhao') }}</strong>
                                    </div>
                                @endif
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
