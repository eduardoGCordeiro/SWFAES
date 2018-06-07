@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-5">
        <div class="col-md-12 ">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/inicio">Início</a></li>
                <li class="breadcrumb-item"><a href="{{Route('itens.index')}}">Itens</a></li>
                <li class="breadcrumb-item active">Novo item</li>
            </ol>
            <div class="card">
                
                <div class="card-header">

                    <h3>Cadastro de Itens</h3>


                </div>

                <div class="card-body col-md-8 offset-lg-2" >
                    
                    <form role="form" method="POST" action="{{ Route('itens.store') }}">
                        {!! csrf_field() !!}


                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">Nome</label>

                            <div class="col-lg-6">
                                <input
                                        type="text"
                                        class="form-control{{ $errors->has('identificacao') ? ' is-invalid' : '' }}"
                                        name="nome"
                                        value="{{ old('identificacao') }}"
                                        required
                                >
                                @if ($errors->has('identificacao'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('identificacao') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">Unidade de medida</label>

                            <div class="col-lg-6">
                                <select name="unidade" class="form-control" id="exampleSelect1">
                                    <option>Kg</option>
                                    <option>g</option>
                                    <option>m</option>
                                    <option>L</option>
                                    <option>cm</option>
                                    <option>ml</option>
                                </select>
                                
                                @if ($errors->has('unidade'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('unidade') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>

                        



                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">Preço por unidade</label>

                            <div class="col-lg-6">

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                            <span class="input-group-text">R$</span>
                                          </div>
                                    <input 
                                        class="form-control"
                                        type="text"
                                        name="preco" 
                                        placeholder="00.00" 
                                    >
                                    
                                </div>

                                @if ($errors->has('preco'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('preco') }}</strong>
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
                            <label class="col-lg-4 col-form-label text-lg-right">Qauntidade inicial</label>

                            <div class="col-lg-6">
                                <input
                                        type="text"
                                        class="form-control{{ $errors->has('quantidade') ? ' is-invalid' : '' }}"
                                        name="quantidade"
                                        value="{{ old('quantidade') }}"
                                        placeholder="00.00"
                                        required
                                >
                                @if ($errors->has('quantidade'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('quantidade') }}</strong>
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


                        <div class="form-group row">
                            

                            <div class="">
                               <div class="alert alert-dismissible alert-info">
                                 <button type="button" class="close" data-dismiss="alert">&times;</button>
                                 <strong>Atenção!</strong> 
                                 Certifique-se que esses dados estejam corretos. A edição só é permitida enquanto o item não está em alguma movimentação!
                               </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
