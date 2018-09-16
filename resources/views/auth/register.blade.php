
@extends('layouts.app')

@section('content')
<div class="container">
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
                        {!! csrf_field() !!}

                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">Nome</label>

                            <div class="col-lg-6">
                                <input
                                        type="text"
                                        class="form-control{{ $errors->has('nome') ? ' is-invalid' : '' }}"
                                        name="nome"
                                        value="{{ old('nome') }}"
                                        placeholder="João da Silva"
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
                                        value="{{ old('login') }}"
                                        placeholder="joaodasilva"
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
                                        value="{{ old('cpf') }}"
                                        placeholder="99999999999"
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
                            <label class="col-lg-4 col-form-label text-lg-right">Senha</label>

                            <div class="col-lg-3">
                                <input
                                        type="password"
                                        id="password"
                                        class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                        name="password"
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
                            <label class="col-lg-4 col-form-label text-lg-right">Permitir acesso ao sistema?</label>

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


    </script>


@endsection
