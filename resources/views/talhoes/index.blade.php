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
                    <div class="card text-white bg-success  mb-3" style="max-width: 20rem;">
                      <div class="card-header">Talhão {{$talhao->id_talhoes}}</div>
                      <div class="card-body">
                        <h4 class="card-title">safra de @if($talhao->culturas->first()->tipos_safra) inverno @else verão @endif</h4>
                        <p class="card-text">{{$talhao->descricao}}</p>
                      </div>
                    </div>        


                  @endforeach
                      
                  <button type="button" class="btn btn-primary">Criar Novo</button>



                  <ul class="list-group">
  <li class="list-group-item d-flex justify-content-between align-items-center">
    Cras justo odio
    <span class="badge badge-primary badge-pill">14</span>
  </li>
  <li class="list-group-item d-flex justify-content-between align-items-center">
    Dapibus ac facilisis in
    <span class="badge badge-primary badge-pill">2</span>
  </li>
  <li class="list-group-item d-flex justify-content-between align-items-center">
    Morbi leo risus
    <span class="badge badge-primary badge-pill">1</span>
  </li>
</ul> 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
