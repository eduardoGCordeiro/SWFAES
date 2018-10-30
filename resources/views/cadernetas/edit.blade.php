@extends('layouts.app')

@section('content')
<<<<<<< HEAD
<div class="container">
=======
<div class="container col-md-10 col-lg-10 ">
>>>>>>> eduardo
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


<<<<<<< HEAD
                    
=======

>>>>>>> eduardo

                </div>



                <div class="card-body col-md-8 offset-lg-2">
                    <form role="form" method="POST" action="{{ Route('talhoes.store') }}">
                        {!! csrf_field() !!}


<<<<<<< HEAD
                        
                    </form>

                    
=======

                    </form>


>>>>>>> eduardo
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
