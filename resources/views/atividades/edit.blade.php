@extends('layouts.app')

@section('content')

<div class="container col-md-10 col-lg-10 ">
    <div class="row mt-3">
        <div class="col-md-12 ">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/inicio">Início</a></li>
                <li class="breadcrumb-item"><a href="{{Route('atividades.index')}}">Atividades</a></li>
                <li class="breadcrumb-item active">Editando atividade</li>
            </ol>
            <div class="card">

                <div class="card-header">

                    <h3>Editando Atividade
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

                    <form role="form" method="post" action="{{ Route('atividades.update',[$atividade->id_atividades]) }}">
                        {!! csrf_field() !!}
                        {{ method_field('PUT') }}


                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">Data</label>

                            <div class="col-lg-3">
                                <input
                                        type="date"
                                        style="padding-left: 15%"
                                        class="form-control{{ $errors->has('data') ? ' is-invalid' : '' }}"
                                        name="data"
                                        value="{{ $atividade->data }}"
                                        required
                                >
                                @if ($errors->has('data'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('data') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">Tipo de Atividade</label>

                            <div class="col-lg-3">
                                <select required="" name="tipo_atividade" class="form-control" id="select_tipos">
                                    <option value="">Selecione</option>
                                    @foreach($tipos_atividades as $tipo)
                                        <option value="{{$tipo->id_tipos_atividades}}">{{$tipo->nome}}</option>
                                    @endforeach

                                </select>

                                @if ($errors->has('tipo_atividade'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('tipo_atividade') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">Talhão</label>

                            <div class="col-lg-3">
                                <select name="talhao" class="form-control" id="select_talhoes">
                                    @if( $talhao_atividade != null)
                                        <option value="{{$talhao_atividade->id_talhoes}}">{{$talhao_atividade->identificador}}</option>
                                        @foreach($talhoes as $talhao)
                                            <option value="{{$talhao->id_talhoes}}">{{$talhao->identificador}}</option>
                                        @endforeach
                                    @else
                                        <option value="">Selecione</option>
                                        @foreach($talhoes as $talhao)
                                            <option value="{{$talhao->id_talhoes}}">{{$talhao->identificador}}</option>
                                        @endforeach
                                    @endif

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
                                        placeholder="Insira a descrição da atividade..."
                                        class="form-control"
                                        id="exampleTextarea"
                                        rows="3"
                                        name="descricao"

                                >{{$atividade->descricao}}</textarea>
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
                                    Alterar
                                </button>
                            </div>
                        </div>
                    </form>

                        <div id = "popup" class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Ajuda edição de atividades</h5>
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
                                            </thead>
                                            <tbody>
                                                <tr class="table-active">
                                                    <th scope="row">Data<span style="color:red">*</span></th>
                                                    <td>data</td>
                                                    <td>-</td>
                                                    <td>-</td>
                                                    <td>formato: dd/mm/aaaa</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Tipo de atividade<span style="color:red">*</span></th>
                                                    <td>Selecionável</td>
                                                    <td>-</td>
                                                    <td>-</td>
                                                    <td>Deve ser selecionada uma das opções listadas</td>
                                                </tr>
                                                <tr class="table-active">
                                                    <th scope="row">Talhão</th>
                                                    <td>Selecionável</td>
                                                    <td>-</td>
                                                    <td>-</td>
                                                    <td>Deve ser selecionada uma das opções listadas</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Descrição<span style="color:red">*</span></th>
                                                    <td>Texto</td>
                                                    <td>1</td>
                                                    <td>500</td>
                                                    <td>-</td>
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
    </div>
</div>

@endsection
@section('script')
<script type="text/javascript">

    document.getElementById('select_tipos').value={{$atividade->tipos_atividades->id_tipos_atividades}};

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