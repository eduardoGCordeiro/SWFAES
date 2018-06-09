@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-5">
        <div class="col-md-12 ">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/inicio">Início</a></li>
                <li class="breadcrumb-item"><a href="{{Route('culturas.index')}}">Culturas</a></li>
                <li class="breadcrumb-item active">Editar cultura</li>
            </ol>
            <div class="card">
                
                <div class="card-header">

                    <h3>Alteração de Culturas</h3>


                </div>

                <div class="card-body col-md-8 offset-lg-2" >
                    
                    <form role="form" method="POST" action="{{ Route('culturas.update',[$cultura->id_culturas]) }}">
                        {!! csrf_field() !!}


                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">Data de ínicio</label>

                            <div class="col-lg-6">
                                <input
                                        type="date"
                                        class="form-control{{ $errors->has('data_inicio') ? ' is-invalid' : '' }}"
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
                                <select name="tipo_atividade" class="form-control" id="exampleSelect1">
                                    <option>Verão</option>
                                    <option>Inverno</option>
                                    
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
                                  <strong>Excluir cultura!</strong> Para deletar essa cultura clique no botão abaixo, mas lembre-se que isso é irreversível.
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
