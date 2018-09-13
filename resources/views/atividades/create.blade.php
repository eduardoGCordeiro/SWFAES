@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-5">
        <div class="col-md-12 ">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/inicio">Início</a></li>
                <li class="breadcrumb-item"><a href="{{Route('atividades.index')}}">Atividades</a></li>
                <li class="breadcrumb-item active">Nova Atividade</li>
            </ol>
            <div class="card">

                <div class="card-header">

                    <h3>Cadastro de atividade</h3>


                </div>

                <div class="card-body col-md-8 offset-lg-2" >

                    <form role="form" method="POST" action="{{ Route('atividades.store') }}">
                        {!! csrf_field() !!}


                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">Data</label>

                            <div class="col-lg-6">
                                <input
                                        type="date"
                                        class="form-control{{ $errors->has('data') ? ' is-invalid' : '' }}"
                                        name="data"
                                        value="{{ old('data') }}"
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
                            <label class="col-lg-4 col-form-label text-lg-right">Tipo de Atividade</label>

                            <div class="col-lg-6">
                                <select required="" name="tipo_atividade" class="form-control" id="exampleSelect1">
                                    <option value="">Selecione</option>
                                    @foreach($tipos_atividades as $tipo)
                                        <option value="{{$tipo->id_tipos_atividades}}">{{$tipo->nome}}</option>


                                    @endforeach

                                </select>

                                @if ($errors->has('tipo_atividade'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('tipo_atividade') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">Talhão</label>

                            <div class="col-lg-6">
                                <select name="talhao" class="form-control" id="exampleSelect1">
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
                            <label class="col-lg-4 col-form-label text-lg-right">Cultura</label>

                            <div class="col-lg-6">
                                <select name="cultura" class="form-control" id="exampleSelect1">
                                    <option value="">Selecione</option>
                                    @foreach($culturas as $cultura)
                                    <option value="{{$cultura->id_culturas}}">{{$cultura->id_culturas}}</option>


                                    @endforeach

                                </select>

                                @if ($errors->has('cultura'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('cultura') }}</strong>
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
