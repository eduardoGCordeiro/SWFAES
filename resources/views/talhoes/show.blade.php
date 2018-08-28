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

                    <h3>Talhão #</h3>


                </div>

                <div class="card-body col-md-8 offset-lg-2" >

                    view show talhão

                    <a href="{{Route('talhoes.edit',[$talhao->id_talhoes])}}" class="btn btn-primary">Editar</a>
                    <form action="{{Route('talhoes.destroy',[$talhao->id_talhoes])}}" method="POST"> {{csrf_field()}}
                        <input name="_method" type="hidden" value="DELETE">
                        <button type="submit" class="btn btn-danger">deletar</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
