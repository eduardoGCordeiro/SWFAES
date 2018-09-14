<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style type="text/css">
            body{
                background-image: url("/bg.png") ;
                background-repeat: no-repeat;
                background-size: cover;
                background-color: white;
                margin: 0px !important;
                padding:0px !important;
                overflow-x: hidden;
            }

            #bg{
                background-image: url("/bg2.jpg");
                opacity: 0.7;
                height: 100%;
                width: 100%;
                position: fixed;
            }

            .bg-silver{
                background-color: #f0f0f0;
                border-color: #e3e3e3;
            }

            .breadcrumb, .card{
                border-radius: unset !important;
            }

            #left-bar{
                min-height: 750px;
            }



    </style>

    @yield('style')
</head>
    <div id="bg"></div>

<body>


<div id="app">
    <div class="row">

            <div class="col-md-12">
                <nav class="navbar navbar-expand-lg navbar-light bg-silver">
                    <div class="container">
                        <a class="navbar-brand" href="{{ url('/inicio') }}">
                            {{ config('app.name', 'Laravel') }} <img height="15%" width="15%" src="/logo2.png">
                        </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                            <ul class="navbar-nav">
                                @if (Auth::guest())
                                    <li class="nav-item"><a href="{{ route('login') }}" class="nav-link">Entrar</a></li>
                                    <li class="nav-item"><a href="{{ route('register') }}" class="nav-link">Registrar</a></li>
                                @else
                                    <li class="nav-item dropdown">
                                        <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
                                           aria-haspopup="true" aria-expanded="false">
                                            {{ Auth::user()->nome }}
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                            <a href="{{ route('logout') }}" class="dropdown-item"
                                               onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                                Sair
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                  style="display: none;">
                                                {{ csrf_field() }}
                                            </form>
                                        </div>
                                    </li>
                                @endif
                            </ul>
                        </div>

                    </div>
                </nav>
        </div>



        <nav id="left-bar" class="col-md-2 d-none d-md-block bg-silver sidebar">
            <div class="sidebar-sticky">
                <ul class="nav flex-column">

                  <li class="nav-item">
                    <a class="nav-link active" href="{{url('/inicio')}}">

                      Início <span class="sr-only">(current)</span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{Route('atividades.index')}}">

                      Atividades
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{Route('culturas.index')}}">

                      Culturas
                    </a>
                  </li>
                  @if (Auth::user()->can('gerenciar'))
                    <li class="nav-item">
                      <a class="nav-link" href="{{Route('funcionarios.index')}}">

                        Funcionários
                      </a>
                    </li>
                  @endif
                  @if (Auth::user()->can('gerenciar'))
                    <li class="nav-item">
                      <a class="nav-link" href="{{Route('funcionarios.index')}}">

                        Itens
                      </a>
                    </li>
                  @endif
                  @if (Auth::user()->can('gerenciar'))
                    <li class="nav-item">
                      <a class="nav-link" href="{{Route('funcionarios.index')}}">

                        Movimentações
                      </a>
                    </li>
                  @endif
                  <li class="nav-item">
                    <a class="nav-link" href="{{Route('requisicoes.index')}}">

                      Requisições
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{Route('talhoes.index')}}">

                      Talhões
                    </a>
                  </li>

                </ul>
                @if (Auth::user()->can('gerenciar'))


                  <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                    <span>Sistema</span>

                  </h6>
                  <ul class="nav flex-column mb-2">
                      <li class="nav-item">
                        <a class="nav-link" href="{{Route('tipos_atividades.index')}}">

                          Tipos de Atividades
                        </a>
                      </li>
                    <li class="nav-item">
                      <a class="nav-link" href="{{Route('tipo_item.index')}}">

                        Tipos de Itens
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="{{Route('unidades.index')}}">

                        Unidades de medida
                      </a>
                    </li>

                  </ul>

                @endif
            </div>
        </nav>


            @yield('content')




        </div>
    </div>


</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>

    @yield('script')
</body>
</html>
