@extends('layouts.app')

@section('content')
<div class="container col-md-10 col-lg-10 ">
    <div class="row mt-3">
        <div class="col-md-12 ">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/inicio">Início</a></li>
                <li class="breadcrumb-item"><a href="{{Route('requisicoes.index')}}">Requisições</a></li>
                <li class="breadcrumb-item active">Editando Requisição - Identificação do Talhão</li>
            </ol>
            <div class="card">

                <div class="card-header">

                    <h3>Editando de Requisição
                        <button id = "showmodal" type="button" class="btn float-right" style="background: none">
                            <i class="fas fa-question-circle fa-2x"></i>
                        </button>
                    </h3>


                </div>

                <div class="card-body col-md-8 offset-lg-2" >

                    <form role="form" method="POST" action="{{ Route('talhoes.store') }}">
                        {!! csrf_field() !!}






                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">Descrição</label>

                            <div class="col-lg-6">
                                <textarea
                                    class="form-control"
                                    id="exampleTextarea"
                                    rows="3"
                                    name="descricao"

                                >{{$requisicao->descricao}}</textarea>
                                @if ($errors->has('descricao'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('descricao') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>






                        <div class="form-group row">
                            <div class="col-lg-6 offset-lg-4">
                                <button type="submit" class="btn btn-primary">
                                    salvar
                                </button>
                            </div>
                        </div>


                        <hr>
                        <div class="form-group row">
                            <div class="col-lg-6 offset-lg-4">
                                <div class="alert alert-dismissible alert-danger">
                                  <button type="button" class="close" data-dismiss="alert">&times;</button>
                                  <strong>Excluir requisição!</strong> Para deletar essa requisição clique no botão abaixo, mas lembre-se que isso é irreversível.
                                </div>
                                <p></p>
                                <button type="button" class="btn btn-danger">Deletar</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>

            <div id = "popup" class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Help Talhões</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Help talhões
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
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
