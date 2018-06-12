@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-5">
        <div class="col-md-12 ">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/inicio">Início</a></li>
                <li class="breadcrumb-item"><a href="{{Route('atividades.index')}}">Atividades</a></li>
                <li class="breadcrumb-item active">Editando atividade</li>
            </ol>
            <div class="card">
                
                <div class="card-header">

                    <h3>Editando Atividade</h3>


                </div>
                <div class="card-body col-md-8 offset-lg-2" >
                    
                    <form role="form" method="put" action="{{ Route('atividades.update',[$atividade->id_atividades]) }}">
                        {!! csrf_field() !!}


                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">Data</label>

                            <div class="col-lg-6">
                                <input
                                        type="date"
                                        class="form-control{{ $errors->has('data') ? ' is-invalid' : '' }}"
                                        name="data"
                                        value="{{ $atividade->data }}"
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

                                >{{$atividade->descricao}}</textarea>
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
                                <select name="tipo_atividade" class="form-control" id="exampleSelect1">
                                    <option>tipo1</option>
                                    <option>tipo2</option>
                                    
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
                                    <option>talhão 1</option>
                                    <option>talhão 2</option>
                                    
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
                                    Salvar
                                </button>
                            </div>
                        </div>


                        <hr>
                        <div class="form-group row">
                            <div class="col-lg-6 offset-lg-4">
                                <div class="alert alert-dismissible alert-danger">
                                  <button type="button" class="close" data-dismiss="alert">&times;</button>
                                  <strong>Excluir Atividade!</strong> Para deletar essa atividade clique no botão abaixo, mas lembre-se que isso é irreversível.
                                </div>
                                <p></p>
                                <button type="button" class="btn btn-danger">Deletar</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
