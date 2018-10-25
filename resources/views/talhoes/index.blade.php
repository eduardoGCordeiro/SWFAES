@extends('layouts.app')

@section('content')
    <div class="container col-md-10 col-lg-10 ">
        <div class="row mt-3">
            <div class="col-md-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/inicio">Início</a></li>
                    <li class="breadcrumb-item active">Talhões</li>
                </ol>
                <div class="card">
                    <div class="card-header">
                        <h3>Lista de Talhões</h3>
                        @if (Auth::user()->can('gerenciar-culturas'))
                            <a href="{{Route('talhoes.create')}}">
                                <button type="button" class="btn btn-outline-success"><i class="fas fa-plus"> </i>
                                    Cadastrar novo
                                </button>
                            </a>
                        @endif
                    </div>

                    <div class="card-body">
                        <div class="flash-message col-md-12">
                            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                                @if(Session::has('alert-' . $msg))
                                    <div class="alert alert-{{ $msg }} alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                        <p class="mb-0">{{ Session::get('alert-' . $msg) }}</p>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        @foreach($talhoes as $talhao)
                            <div class="card  border-dark mb-3"
                                 style="margin:3%;float:left;height: 15rem;width: 18rem !important ;">
                                <a href="{{Route('talhoes.show',[$talhao->id_talhoes])}}">
                                    <div class="card-header">Talhão {{$talhao->identificador}}
                                        <span style="float: center" class="ml-4">Área: {{$talhao->area}} ha</span>
                                        <span style="float: right"
                                              class="badge badge-success">{{count($talhao->requisicoes)}}</span>
                                    </div>
                                </a>
                                <div class="card-body">
                                    @if($talhao->culturas->last())
                                        <h4 class="card-title text-dark">{{$talhao->culturas->last()->descricao}}</h4>
                                        <p class="card-text text-dark" onload="mascaraData(this)">Data de
                                            início: @php
                                                $data = str_replace('-','/',$talhao->culturas->last()->data_inicio);
                                                $data = explode('/',$data);
                                                echo $data[2]."/".$data[1]."/".$data[0];@endphp</p>
                                    @else
                                        <h4 class="card-title text-dark">Cultura ausente</h4>
                                    @endif
                                </div>
                                <div class="card-footer">
                                    @if($talhao->tipo != "pecuaria" && $talhao->tipo != "agricultura")
                                        <h4 class="card-title text-dark"> Talhão sem tipo definido.</h4>
                                    @else
                                        <h4 class="card-title text-dark">Talhão de {{$talhao->tipo}}.</h4>
                                    @endif
                                </div>
                            </div>
                            </a>
                        @endforeach
                    </div>
                    <div class="card-footer ">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        function mascaraData(val){
            val = str.replace(val);
            val = str.split("/", val);
            return val;
        }
    </script>
@endsection
