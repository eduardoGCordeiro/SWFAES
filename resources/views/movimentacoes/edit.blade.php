@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-5">
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
                    
                    <form role="form" method="POST" action="{{ Route('talhoes.store') }}">
                        {!! csrf_field() !!}



                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">Item</label>

                            <div class="col-lg-6">
                                <select name="tipo_atividade" class="form-control" id="exampleSelect1">
                                    <option>Item 1</option>
                                    <option>Item 2</option>
                                    
                                </select>
                                
                                @if ($errors->has('tipo_atividade'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('tipo_atividade') }}</strong>
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
                                        name="area" 
                                    >
                                    <div class="input-group-append">
                                        <span class="input-group-text">Kg</span>
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



                            <label class="col-lg-4 col-form-label text-lg-right">Valor por unidade</label>

                            <div class="col-lg-6">

                                <div class="input-group mb-3">
                                    
                                    <input 
                                        class="form-control"
                                        type="text"
                                        name="area" 
                                    >
                                    <div class="input-group-append">
                                        <span class="input-group-text">R$</span>
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



                            <label class="col-lg-4 col-form-label text-lg-right">Valor Total</label>

                            <div class="col-lg-6">

                                <div class="input-group mb-3">
                                    
                                    <input 
                                        class="form-control"
                                        type="text"
                                        name="area" 
                                    >
                                    <div class="input-group-append">
                                        <span class="input-group-text">R$</span>
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
                            <label class="col-lg-4 col-form-label text-lg-right">Identificador da Atividade</label>

                            <div class="col-lg-6">
                                <select name="tipo_atividade" class="form-control" id="exampleSelect1">
                                    <option>00001</option>
                                    <option>00002</option>
                                    
                                </select>
                                
                                @if ($errors->has('tipo_atividade'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('tipo_atividade') }}</strong>
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
                                  <strong>Excluir movimentação!</strong> Para deletar essa movimentação clique no botão abaixo, mas lembre-se que isso é irreversível.
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
