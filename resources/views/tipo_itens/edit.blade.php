@extends('layouts.app')

@section('content')

<div class="container col-md-10 col-lg-10 ">
    <div class="row mt-3">
        <div class="col-md-12 ">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/inicio">Início</a></li>
                <li class="breadcrumb-item"><a href="{{Route('unidades.index')}}">Tipos</a></li>
                <li class="breadcrumb-item active">Editar tipo</li>
            </ol>
            <div class="card">

                <div class="card-header">

                    <h3>Edição de tipo
                        <button id = "showmodal" type="button" class="btn float-right" style="background: none">
                            <i class="fas fa-question-circle fa-2x"></i>
                        </button>
                    </h3>


                </div>

                <div class="card-body col-md-8 offset-lg-2" >

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form role="form" method="POST" action="{{ Route('tipo_item.update',[$tipo->id_tipos_itens]) }}">
                        {{ method_field('PUT') }}
                        {!! csrf_field() !!}


                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">Nome</label>

                            <div class="col-lg-4">
                                <input
                                        placeholder="Insira o nome do item"
                                        type="text"
                                        class="form-control{{ $errors->has('nome') ? ' is-invalid' : '' }}"
                                        name="nome"
                                        value="{{ $tipo->nome }}"
                                        required
                                >
                                @if ($errors->has('nome'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('nome') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">Sigla</label>

                            <div class="col-lg-2">
                                <input
                                        type="text"
                                        class="form-control{{ $errors->has('sigla') ? ' is-invalid' : '' }}"
                                        name="sigla"
                                        value="{{ $tipo->sigla }}"
                                        required
                                >
                                @if ($errors->has('sigla'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('sigla') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div> -->







                        <div class="form-group row">
                            <div class="col-lg-6 offset-lg-4">
                                <button type="submit" class="btn btn-primary">
                                    Alterar
                                </button>
                            </div>
                        </div>



                    </form>

                </div>
            </div>

            <div id = "popup" class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Ajuda edição do tipo de item</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <h7>Tipos de dados</h7>
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th scope="col">Campo</th>
                                    <th scope="col">Tipo de dado</th>
                                    <th scope="col">Tamanho máximo</th>
                                    <th scope="col">Tamanho mínimo</th>
                                    <th scope="col">Restrições</th>
                                </tr>
                                <tbody>
                                <tr class="table-active">
                                    <th scope="row">Nome<span style="color:red">*</span></th>
                                    <td>Texto</td>
                                    <td>1</td>
                                    <td>45</td>
                                    <td>Deve conter apenas letras.</td>
                                </tr>
                                </tbody>
                            </table>
                            <div class="alert alert-secondary">
                                <strong><span style="color:red">*</span></strong> Significa que o campo é obrigatório!
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@section('styles')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">

@endsection

@section('script')
    <script>
        $(document).unbind("keyup").keyup(function(e){
            var code = e.which;
            if(code==112)
            {
                $("#popup").modal('show', 'handleUpdate');
            }
        });

        $('#showmodal').click(function() {
            $('#popup').modal('show');
        });
    </script>
@endsection
