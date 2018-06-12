@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-5">
        <div class="col-md-12 ">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/inicio">Início</a></li>
                <li class="breadcrumb-item"><a href="{{Route('usuarios.index')}}">Usuários</a></li>
                <li class="breadcrumb-item active">Novo usuário</li>
            </ol>
            <div class="card">
                
                <div class="card-header">

                    <h3>Cadastro de usuário</h3>


                </div>

                <div class="card-body col-md-8 offset-lg-2" >
                    
                    <form role="form" method="POST" action="{{ url('/register') }}">
                        {!! csrf_field() !!}

                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">Nome</label>

                            <div class="col-lg-6">
                                <input
                                        type="text"
                                        class="form-control{{ $errors->has('nome') ? ' is-invalid' : '' }}"
                                        name="nome"
                                        value="{{ old('nome') }}"
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

                            <div class="col-lg-6">
                                <input
                                        type="text"
                                        class="form-control{{ $errors->has('login') ? ' is-invalid' : '' }}"
                                        name="login"
                                        value="{{ old('login') }}"
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

                            <div class="col-lg-6">
                                <input
                                        type="text"
                                        class="form-control{{ $errors->has('cpf') ? ' is-invalid' : '' }}"
                                        name="cpf"
                                        value="{{ old('cpf') }}"
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

                            <div class="col-lg-6">
                                <input
                                        type="password"
                                        class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                        name="password"
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

                            <div class="col-lg-6">
                                <input
                                        type="password"
                                        class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}"
                                        name="password_confirmation"
                                        required
                                >
                                @if ($errors->has('password_confirmation'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <hr>
                        <div class="form-group row">
                          <label class="col-lg-4 col-form-label text-lg-right">Acesso ao sistema?</label>
                          <div class="col-lg-6">

                            <div class="custom-control custom-radio">
                              <input id="customRadio1" name="acesso_sistema" class="custom-control-input" checked="" type="radio">
                              <label class="custom-control-label" for="customRadio1">Sim</label>
                            </div>
                            <div class="custom-control custom-radio">
                              <input id="customRadio2" name="acesso_sistema" class="custom-control-input" type="radio">
                              <label class="custom-control-label" for="customRadio2">Não</label>
                            </div>
                          </div>
                          
                        </div>


                        <div class="form-group row">
                          <label class="col-lg-4 col-form-label text-lg-right">Administrador geral?</label>
                          <div class="col-lg-6">

                            <div class="custom-control custom-radio">
                              <input id="customRadio1" name="administrador_geral" class="custom-control-input" checked="" type="radio">
                              <label class="custom-control-label" for="customRadio1">Sim</label>
                            </div>
                            <div class="custom-control custom-radio">
                              <input id="customRadio2" name="administrador_geral" class="custom-control-input" type="radio">
                              <label class="custom-control-label" for="customRadio2">Não</label>
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
