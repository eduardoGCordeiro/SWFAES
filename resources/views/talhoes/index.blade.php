@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-5">
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

                    
                  @foreach($talhoes as $talhao)
                    <div class="card border-success mb-3" style="max-width: 20rem;">
                      <div class="card-header">Talhão {{$talhao->id_talhoes}}</div>
                      <div class="card-body">
                        <h4 class="card-title">safra de @if($talhao->culturas->first()->tipos_safra) inverno @else verão @endif</h4>
                        <p class="card-text">{{$talhao->descricao}}</p>
                      </div>
                    </div>        


                  @endforeach
                      
                  <button type="button" class="btn btn-primary">Criar Novo</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
