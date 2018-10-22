@extends('layouts.app')

@section('content')
<div class="container col-md-10 col-lg-10 ">
    <div class="row mt-3">
        <div class="col-md-12 ">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/inicio">Início</a></li>
                <li class="breadcrumb-item"><a href="{{Route('requisicoes.index')}}">Requisições</a></li>
                <li class="breadcrumb-item active">Moderar requisição</li>
            </ol>
            <div class="card">

                <div class="card-header">

                    <h3>Moderar Requisição</h3>


                </div>

                <div class="card-body col-md-8 offset-lg-2" >

                    <form role="form" method="POST" action="{{ Route('moderar_post',[$requisicao->id_requisicoes]) }}">
                        {!! csrf_field() !!}



                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">Requisição</label>
                            <div class="col-lg-6">
                                <p> {{$requisicao->descricao}} </p>
                            </div>

                        </div>

                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right"></label>

                                <div class="custom-control custom-radio">
                                  <input value="1" type="radio" id="customRadio1" name="option" class="custom-control-input" checked="">
                                  <label class="custom-control-label" for="customRadio1">Aceitar</label>
                                </div>
                                <div class="custom-control custom-radio">
                                  <input value="0" type="radio" id="customRadio2" name="option" class="custom-control-input">
                                  <label class="custom-control-label" for="customRadio2">Rejeitar</label>
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

                                >{{$requisicao->resposta}} </textarea>
                                @if ($errors->has('resposta'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('resposta') }}</strong>
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
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
