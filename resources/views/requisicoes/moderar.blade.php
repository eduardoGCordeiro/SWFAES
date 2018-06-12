@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-5">
        <div class="col-md-12 ">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/inicio">Início</a></li>
                <li class="breadcrumb-item"><a href="{{Route('requisicoes.index')}}">Talhões</a></li>
                <li class="breadcrumb-item active">Moderar requisição - Identificação da requisição</li>
            </ol>
            <div class="card">
                
                <div class="card-header">

                    <h3>Moderar Requisição</h3>


                </div>

                <div class="card-body col-md-8 offset-lg-2" >
                    
                    <form role="form" method="POST" action="{{ Route('talhoes.store') }}">
                        {!! csrf_field() !!}


                        
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">Requisição</label>
                            <div class="col-lg-6">
                                <p> descrição da requisição</p>
                            </div>

                        </div>
                        

                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">Resposta</label>

                            <div class="col-lg-6">
                                <textarea 
                                    class="form-control" 
                                    id="exampleTextarea" 
                                    rows="3"
                                    name="resposta"

                                ></textarea>
                                @if ($errors->has('resposta'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('resposta') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>


                        
                        
                        

                        <div class="form-group row">
                            <div class="col-lg-6 offset-lg-4">
                                <button type="submit" class="btn btn-success">
                                    aceitar
                                </button>
                                <button type="submit" class="btn btn-danger">
                                    rejeitar
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
