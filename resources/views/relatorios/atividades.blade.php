<img height="40px" width="80px" src="{{url('/imgs/logo2.png')}}" alt="Image"/>
<p align="center">Relatório FESCON UEPG</p>
<p>Emitido em {{\Carbon\Carbon::now('America/Sao_Paulo')->format('d/m/Y H:i ')}}</p>
<p>Por: {{Auth::user()->nome}}</p>


<center><h2>Atividades</h2></center>
<div class="row">
    <table style="border: 1px solid black" cellpadding="0"  width="100%" class="table table-striped">
        <tr style="border: 1px solid black">
            <th>#</th>
            <th>Talhão</th>
            <th>Descrição</th>
            <th>Data</th>
            <th>Movimentações</th>
            <th>Total (R$)</th>
        </tr>
        @foreach ($atividades as $key=>$atividade)
        <tr>
            <td>{{ $key+1 }}</td>
            <td>{{ $atividade->talhao['identificador'] }}</td>
            <td>{{ $atividade->descricao }}</td>

            <td>{{ date( 'd/m/Y' , strtotime($atividade->data))}}</td>
            <td>{{ count($atividade->movimentacao)}}</td>
            <td>@php
                $pos = DB::table('movimentacoes')->select(DB::raw('coalesce(sum(custo),0)'))->where([['id_atividades_atividades','=',$atividade->id_atividades]])->first();

                echo str_replace('.',',',$pos->coalesce);
             @endphp</td>

        </tr>
        @endforeach
    </table>
</div>