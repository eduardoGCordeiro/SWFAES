@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-5">
        <div class="col-md-12 ">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/inicio">Início</a></li>
                <li class="breadcrumb-item"><a href="{{Route('talhoes.index')}}">Talhões</a></li>
                <li class="breadcrumb-item active">Mostrando o talhão</li>
            </ol>
            <div class="card">

                <div class="card-header">

                    <h3>Talhão {{$talhao->id_talhoes}}</h3>


                </div>

                <div class="card-body col-md-11" >
                    <div class="card  border-dark col-md-4 mb-4 float-left" style="margin:10px;float:left;height: 15rem;width: 18rem !important ;">
                        <div class="card-header">Talhão {{$talhao->id_talhoes}}<span style="float: right" class="badge badge-success">1</span></div>
                        <div class="card-body">
                            @if($talhao->culturas->first())
                                <h4 class="card-title">safra de @if($talhao->culturas->first()->tipos_safra) inverno @else verão @endif</h4>
                            @else
                                <h4 class="card-title">Sem cultura atualmente</h4>
                            @endif
                            <p class="card-text">{{$talhao->descricao}}</p>
                        </div>
                    </div>
                </div>
                <div class = "col-md-10 offset-1" style="padding-bottom: 5%">
                    <div class="panel-footer row"><!-- panel-footer -->
                        <div class="col-xs-6 text-left">
                            <div class="previous">
                                <a href="{{Route('talhoes.edit',[$talhao->id_talhoes])}}" class="btn btn-primary">Editar</a>
                            </div>
                        </div>
                        <div class="col-xs-6 text-right">
                            <div class="next offset-1">
                                <form action="{{Route('talhoes.destroy',[$talhao->id_talhoes])}}" method="POST"> {{csrf_field()}}
                                    <input name="_method" type="hidden" value="DELETE">
                                    <button type="submit" class="btn btn-danger">deletar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
