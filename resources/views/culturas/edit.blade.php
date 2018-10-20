@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-3">
        <div class="col-md-12 ">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/inicio">Início</a></li>
                <li class="breadcrumb-item"><a href="{{Route('culturas.index')}}">Culturas</a></li>
                <li class="breadcrumb-item active">Editar cultura</li>
            </ol>
            <div class="card">

                <div class="card-header">

                    <h3>Editando cultura</h3>


                </div>

                <div class="card-body col-md-8 offset-lg-2" >
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
                    <form role="form" method="POST" action="{{ Route('culturas.update',[$cultura->id_culturas]) }}">

                         {{ method_field('PUT') }}
                        {!! csrf_field() !!}


                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">Data de ínicio</label>

                            <div class="col-lg-6">
                                <input
                                        type="date"
                                        class="form-control{{ $errors->has('data') ? ' is-invalid' : '' }}"
                                        name="data_inicio"
                                        value="{{ $cultura->data_inicio }}"
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

                                >{{$cultura->descricao}}</textarea>
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
                                <select name="tipo_safra" class="form-control" id="select_tipo_safra">
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
                                <select name="talhao" class="form-control" id="select_talhao" required="">
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
                                    Alterar
                                </button>

                            </div>
                        </div>

                    </form>
                    <form method="POST" action="{{Route('finalizar_culturas',$cultura->id_culturas)}}">
                        {!! csrf_field() !!}
                        @if($cultura->data_fim == null)
                             <div class="form-group row">
                                 <div class="col-lg-6 offset-lg-4">
                                     <button class="btn btn-warning" type="submit">
                                         Finalizar
                                     </button>

                                 </div>
                             </div>
                        @endif
                    </form>



                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript">

    document.getElementById('select_tipo_safra').value='{{$cultura->tipo_safra}}';

    document.getElementById('select_talhao').value={{$cultura->id_talhoes_talhoes}};

</script>

@endsection