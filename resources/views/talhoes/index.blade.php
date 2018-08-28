@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-4">
        <div class="col-md-12">
            <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/inicio">Início</a></li>
                        <li class="breadcrumb-item active">Talhões</li>
                    </ol>
            <div class="card">
                <div class="card-header">


                    <h3>Lista de Talhões</h3>

                    

                </div>

                <div class="card-body">
                    <div class="col-md-4">
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
                    </div>
                    @foreach($talhoes as $talhao)
                        <div class="card  border-dark col-md-3 mb-3" style="margin:10px;float:left;height: 15rem;width: 18rem !important ;">
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
                    @endforeach

                </div>
                <div class="card-footer ">
                  <a href="{{Route('talhoes.create')}}"><button type="button" class="btn btn-primary">Criar Novo</button></a>
                </div>



                </div>
            </div>
        </div>
    </div>
</div>
@endsection
