@extends('layouts.app')

@section('content')

<div class="container col-md-10 col-lg-10 ">
    <div class="row mt-3">
        <div class="col-md-12 ">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/inicio">Início</a></li>
                <li class="breadcrumb-item"><a href="{{Route('requisicoes.index')}}">Talhões</a></li>
                <li class="breadcrumb-item active">Nova Requisição </li>
            </ol>
            <div class="card">

                <div class="card-header">

                    <h3>Cadastro de requisição
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
                    <form role="form" method="POST" action="{{ Route('requisicoes.store') }}">
                        {!! csrf_field() !!}


                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">Talhão</label>
                            <div class="col-lg-3">
                                <select name="talhao" class="form-control" id="exampleSelect1" required="">
                                    <option value="">Selecione</option>
                                    @foreach($talhoes as $talhao)
                                        <option value="{{$talhao->id_talhoes}}">{{$talhao->identificador}}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('talhao'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('talhao') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">Descrição</label>

                            <div class="col-lg-6">
                                <textarea
                                        placeholder="Insira a descrição da requisição aqui..."
                                        class="form-control"
                                        id="exampleTextarea"
                                        rows="3"
                                        name="descricao"
                                        required

                                ></textarea>
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
                                    enviar
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
                            <h5 class="modal-title" id="exampleModalLabel">Ajuda cadastro de requisição</h5>
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
                                    <th scope="row">Talhão<span style="color:red">*</span></th>
                                    <td>Selecionável</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>Deve ser selecionada uma das opções listadas</td>
                                </tr>
                                <tr>
                                    <th scope="row">Descrição<span style="color:red">*</span></th>
                                    <td>Texto</td>
                                    <td>1</td>
                                    <td>100</td>
                                    <td>-</td>
                                </tr>
                                </tbody>
                            </table>
                            <div class="alert alert-secondary">
                                <strong><span style="color:red">*</span></strong> Significa que o campo é obrigatório!
                            </div>
                            <div class="alert alert-secondary">
                                <strong>Observação:</strong> Só será possível cadastrar uma requisição se existir algum talhão pertencente ao administrador de talhão.
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
@section ('script')
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
