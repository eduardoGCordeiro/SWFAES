
@extends('layouts.app')

@section('content')

<div class="container col-md-10 col-lg-10 ">
    <div class="row mt-3">
        <div class="col-md-12 ">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/inicio">Início</a></li>
                <li class="breadcrumb-item"><a href="{{Route('funcionarios.index')}}">Funcionários</a></li>
                <li class="breadcrumb-item active">Novo Funcionário</li>
            </ol>
            <div class="card">

                <div class="card-header">

                    <h3>Cadastro de Funcionários</h3>


                </div>


                <div class="card-body col-md-8 offset-lg-2" >


                    <form role="form" method="POST" action="{{ Route('funcionarios.store')}}">

                    <div class="flash-message col-md-12">
                        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                            @if(Session::has('alert-' . $msg))
                                <div class="alert alert-{{ $msg }} alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <p class="mb-0">{{ Session::get('alert-' . $msg) }}</p>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <form role="form" method="POST" action="{{ Route('funcionarios.store')}}" name="form_funcionarios">

                        {!! csrf_field() !!}

                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">Nome</label>

                            <div class="col-lg-6">
                                <input
                                        type="text"
                                        class="form-control{{ $errors->has('nome') ? ' is-invalid' : '' }}"
                                        name="nome"
                                        maxlength="45"
                                        value="{{ old('nome') }}"
                                        placeholder="Insira o nome"
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
                            <label class="col-lg-4 col-form-label text-lg-right">E-Mail</label>

                            <div class="col-lg-6">
                                <input
                                        type="email"
                                        class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                        name="email"
                                        maxlength="45"
                                        value="{{ old('email') }}"
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

                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">Login</label>

                            <div class="col-lg-3">
                                <input
                                        type="text"
                                        class="form-control{{ $errors->has('login') ? ' is-invalid' : '' }}"
                                        name="login"
                                        maxlength="45"
                                        value="{{ old('login') }}"
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
                                        value="{{ old('cpf') }}"
                                        placeholder="Insira seu CPF"
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
                            <label class="col-lg-4 col-form-label text-lg-right">Senha</label>

                            <div class="col-lg-3">
                                <input
                                        type="password"
                                        id="password"
                                        class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                        name="password"
                                        maxlength="60"
                                        placeholder="********"
                                        required
                                >
                                @if ($errors->has('password'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">Confirme a senha</label>

                            <div class="col-lg-3">
                                <input
                                        type="password"
                                        id="password_confirmation"
                                        class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}"
                                        name="password_confirmation"
                                        maxlength="60"
                                        placeholder="********"
                                        required
                                >
                                @if ($errors->has('password_confirmation'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">Permitir acesso ao sistema? (Administrar talhões)</label>

                            <div class="col-lg-2">
                                <div class="custom-control custom-checkbox">
                                    <input onchange="verify_password_input();" type="checkbox" class="custom-control-input" id="acesso_sistema" name="acesso_sistema" checked="">
                                <label class="custom-control-label" for="acesso_sistema">Sim</label>
                            </div>

                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-lg-6 offset-lg-4">
                                <button type="submit" class="btn btn-primary">
                                    Cadastrar
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script type="text/javascript">
        function verify_password_input(){
            if(!document.getElementById('acesso_sistema').checked){
                document.getElementById("password").setAttribute("disabled","true");
                document.getElementById("password_confirmation").setAttribute("disabled","true");
            }else{
                document.getElementById("password").removeAttribute("disabled","true");
                document.getElementById("password_confirmation").removeAttribute("disabled","true");
            }
        }

        function numeros( campo )
        {
            if ( isNaN( campo.value ) )
                campo.value = campo.value.substr( 0 , campo.value.length - 1 );
        }
    </script>

@endsection
