@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-5">
        <div class="col-md-12">
            <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/inicio">Início</a></li>
                        <li class="breadcrumb-item"><a href="{{Route('usuarios.index')}}">Usuários</a></li>
                        <li class="breadcrumb-item active">Editar - {{$usuario->nome}}</li>
                    </ol>
            <div class="card">
                <div class="card-header">


                    <h3>Editando Usuário</h3>


                    

                </div>



                <div class="card-body col-md-8 offset-lg-2">
                    <form role="form" action="{{Route('usuarios.update',[$usuario->id_usuario]) }}">
                      <input name="_method" type="hidden" value="PUT">
                        {!! csrf_field() !!}

                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">Nome</label>

                            <div class="col-lg-6">
                                <input
                                        type="text"
                                        class="form-control{{ $errors->has('nome') ? ' is-invalid' : '' }}"
                                        name="nome"
                                        value="{{ $usuario->nome }}"
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
                                        value="{{ $usuario->login }}"
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
                                        value="{{ $usuario->cpf }}"
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
                                        value="{{ $usuario->email }}"
                                        required
                                >

                                @if ($errors->has('email'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
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
                       
                       <hr>
                       <div class="form-group row">
                           <div class="col-lg-6 offset-lg-4">
                               <div class="alert alert-dismissible alert-danger">
                                 <button type="button" class="close" data-dismiss="alert">&times;</button>
                                 <strong>Excluir usuário!</strong> Para deletar esse usuário clique no botão abaixo, mas lembre-se que isso é irreversível.
                               </div>
                               <p></p>
                               <button type="button" class="btn btn-danger">Deletar</button>
                           </div>
                       </div>

                        <div class="form-group row">
                            <div class="col-lg-6 offset-lg-4">
                                <button type="submit" class="btn btn-primary">
                                    Salvar
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
