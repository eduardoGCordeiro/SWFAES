@extends('layouts.app')

@section('content')

    <div class="container col-md-10 col-lg-10 ">
        <div class="row mt-3">
            <div class="col-md-12 ">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/inicio">Início</a></li>
                    <li class="breadcrumb-item"><a href="{{Route('culturas.index')}}">Culturas</a></li>
                    <li class="breadcrumb-item active">Mostrando cultura</li>
                </ol>
                <div class="card">
                    <div class="card-body col-md-12 offset-lg-0" >
                        <h2>Informações da cultura
                            <button id = "showmodal" type="button" class="btn float-right" style="background: none">
                                <i class="fas fa-question-circle fa-2x"></i>
                            </button>
                        </h2>
                        <table class="table">
                            <tr>
                                <th>ID</th>
                                <td>{{$cultura->id_culturas}}</td>
                            </tr>
                            <tr>
                                <th>Data de ínicio</th>
                                <td>{{date( 'd/m/Y' , strtotime($cultura->data_inicio))}}</td>
                            </tr>
                            <tr>
                                <th>Data de finalização</th>
                                <td>{{$cultura->data_fim!=null?date( 'd/m/Y' , strtotime($cultura->data_fim)):"não finalizado ainda"}}</td>
                            </tr>
                            <tr>
                                <th>Tipo de safra</th>
                                <td>{{$cultura->tipo_safra=='I'?"Inverno":"Verão"}}</td>
                            </tr>
                            <tr>
                                <th>Talhão</th>
                                <td>{{$cultura->talhao['identificador']}}</td>
                            </tr>
                        </table>
                        <hr>

                        <h2>Atividades na cultura</h2>
                        <div class="col-md-10 offset-lg-1">
                            <ul class="timeline">

                                <li class="">
                                    <div class="timeline-badge">

                                        <b>{{date( 'd/m' , strtotime($cultura->data_inicio))}}</b>
                                    </div>
                                    <div class="timeline-panel">
                                        <div class="timeline-heading">
                                            <h4 class="timeline-title">Início</h4>
                                        </div>
                                        <div class="timeline-body">

                                        </div>
                                    </div>
                                </li>

                                @foreach($atividades as $key=>$atividade)
                                    <li class="{{$key%2==0?'timeline-inverted':''}}">
                                        <div class="timeline-badge">

                                            <b>{{date( 'd/m' , strtotime($atividade->data))}}</b>
                                        </div>
                                        <div class="timeline-panel">
                                            <div class="timeline-heading">
                                                <p class="text-muted">atividade</p>

                                            </div>
                                            <div class="timeline-body">
                                                {{$atividade->descricao}}
                                            </div>
                                        </div>
                                    </li>
                                @endforeach

                                @if($cultura->data_fim!=null)
                                    <li class="{{count($atividades)==0?'timeline-inverted':''}}">
                                        <div class="timeline-badge">
                                            <b>{{date( 'd/m' , strtotime($cultura->data_fim))}}</b>
                                        </div>
                                        <div class="timeline-panel">
                                            <div class="timeline-heading">
                                                <p class="text-muted"><h4>Cultura finalizada</h4></p>

                                            </div>
                                            <div class="timeline-body">

                                            </div>
                                        </div>
                                    </li>

                                @endif

                            </ul>
                        </div>
                    </div>
                </div>

                 <div id = "popup" class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Ajuda culturas</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>Aqui é possível ver a descrição da cultura e as atividades que foram realizadas na linha do tempo.</p>
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

        @section('style')
            <link rel="stylesheet" type="text/css" href="{{asset('css/timeline.css')}}"/>
        @endsection