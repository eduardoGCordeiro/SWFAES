@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-5">
        <div class="col-md-12">
            <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/inicio">Início</a></li>
                        <li class="breadcrumb-item"><a href="{{Route('talhoes.index')}}">Requisições</a></li>
                        <li class="breadcrumb-item active">Editar Requisição</li>
                    </ol>
            <div class="card">
                <div class="card-header">


                    <h3>Editando caderneta</h3>


                    

                </div>



                <div class="card-body col-md-8 offset-lg-2">
                    <form role="form" method="POST" action="{{ Route('talhoes.store') }}">
                        {!! csrf_field() !!}


                        
                    </form>

                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
