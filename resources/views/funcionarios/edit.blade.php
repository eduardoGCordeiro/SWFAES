@extends('layouts.app')

@section('content')

<div class="container col-md-10 col-lg-10 ">
    <div class="row mt-3">
        <div class="col-md-12 ">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/inicio">Início</a></li>
                <li class="breadcrumb-item"><a href="{{Route('funcionarios.index')}}">Funcionários</a></li>
                <li class="breadcrumb-item active">Editar Funcionário</li>
            </ol>
            <div class="card">

                <div class="card-header">

                    <h3>Edição de funcionário
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

                    <form role="form" method="POST" action="{{ Route('funcionarios.update',[$funcionario->id_funcionarios])}}">
                        {{ method_field('PUT') }}
                        {!! csrf_field() !!}


                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">Nome</label>

                            <div class="col-lg-6">
                                <input
                                        type="text"
                                        class="form-control{{ $errors->has('nome') ? ' is-invalid' : '' }}"
                                        name="nome"
                                        maxlength="45"
                                        value="{{ $funcionario->nome }}"
                                        placeholder="Insira seu nome"
                                        required
                                >
                                @if ($errors->has('nome'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('nome') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">Login</label>

                            <div class="col-lg-3">
                                <input
                                        type="text"
                                        class="form-control{{ $errors->has('login') ? ' is-invalid' : '' }}"
                                        name="login"
                                        maxlength="45"
                                        value="{{ $funcionario->login }}"
                                        placeholder="Insira seu login"
                                        required
                                >
                                @if ($errors->has('login'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('login') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">CPF</label>

                            <div class="col-lg-4">
                                <input
                                        type="text"
                                        class="form-control{{ $errors->has('cpf') ? ' is-invalid' : '' }}"
                                        name="cpf"
                                        maxlength="11"
                                        pattern = "^[0-9]+$"
                                        onkeyup="numeros(this)"
                                        value="{{ $funcionario->cpf }}"
                                        placeholder="Insira seu cpf"
                                        required
                                >
                                @if ($errors->has('cpf'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('cpf') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">E-Mail</label>

                            <div class="col-lg-6">
                                <input
                                        type="email"
                                        class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                        name="email"
                                        value="{{ $funcionario->email }}"
                                        maxlength="45"
                                        placeholder="exemplo@mail.com"
                                        required
                                >

                                @if ($errors->has('email'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>




                        @if(Auth::user()->cpf != $funcionario->cpf)
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">Permitir acesso ao sistema? (Administrar talhões)</label>

                            <div class="col-lg-2">
                                <div class="custom-control custom-checkbox">
                                    <input  type="checkbox" class="custom-control-input" id="acesso_sistema" name="acesso_sistema" >
                                <label class="custom-control-label" for="acesso_sistema">Sim</label>
                            </div>

                            </div>
                        </div>

                        @endif







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

@section('styles')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">

@endsection

@section('script')
<script type="text/javascript">

    document.getElementById('acesso_sistema').checked={{$funcionario->acesso_sistema}};

    function numeros( campo )
    {
        if ( isNaN( campo.value ) )
            campo.value = campo.value.substr( 0 , campo.value.length - 1 );
    }

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
