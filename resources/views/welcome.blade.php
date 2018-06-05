<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>SWFAES | SISTEMA WEB FAZENDA ESCOLA</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html{
                background-image: url("bg.png") ;
                background-repeat: no-repeat;
                background-size: cover;
            }
            #bg{
                background-image: url("bg2.jpg");
                opacity: 0.6;
                height: 100%;
                width: 100%;
                position: fixed;
            }
            body {
                
                color: lightgreen;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }
            .full-height {
                height: 100vh;
            }
            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }
            .position-ref {
                position: relative;
            }
            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }
            .content {
                text-align: center;
            }
            .title {
                font-size: 84px;
            }
            .links > a,.links-bottom > a {
                color: lightgreen;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }
            .m-b-md {
                float: left;
                margin-bottom: 30px;
                margin-top:10%;
            }
            .links-bottom   {
                left: 10px;
                position: fixed;
                bottom: 10px;
                
            }
        </style>
    </head>
    <div id="bg"></div>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/inicio') }}">Início</a>
                    @else
                        <a href="{{ route('login') }}">Entrar</a>
                    @endauth
                </div>
            @endif

            <div class="content">
                <div>
                    <img src="logo.png">
                    <div class="title m-b-md">SWFAES</div>
                </div>
                <div class="links-bottom">
                    <a href="#">Documentação</a>
                    <a href="https://github.com/luisthiagop/swfaes">GitHub</a>
                </div>
            </div>
        </div>
    </body>
</html>