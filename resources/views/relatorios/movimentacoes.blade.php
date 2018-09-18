<img height="40px" width="80px" src="{{url('/imgs/logo2.png')}}" alt="Image"/>
<p align="center">Relatório FESCON UEPG</p>
<p>Emitido em {{\Carbon\Carbon::now('America/Sao_Paulo')->format('d/m/Y H:i ')}}</p>
<p>Por: {{Auth::user()->nome}}</p>


<center><h2>Fluxo de caixa (movimentações)</h2></center>
<div class="row">
    <table style="border: 1px solid black" cellpadding="0"  width="100%" class="table table-striped">
        <tr style="border: 1px solid black">
            <th>#</th>
            <th>ID</th>
            <th>Custo (R$)</th>
            <th>Item</th>
            <th>Quantidade</th>
            <th>Atividade</th>
            <th>Data</th>
            <th>Tipo</th>
        </tr>
        @foreach ($movimentacoes as $key=>$movimentacao)
        <tr>
            <td>{{ $key+1 }}</td>
            <td>{{ $movimentacao->id_movimentacoes }}</td>
            <td>{{ $movimentacao->custo }}</td>
            <td>{{ $movimentacao->item['nome'] }}</td>
            <td>{{ $movimentacao->quantidade.$movimentacao->item->unidades['sigla'] }}</td>
            <td>{{ $movimentacao->atividade['id_atividades'] != null ?$movimentacao->atividade['id_atividades']:"sem atividade" }}</td>
            <td>{{date( 'd/m/Y' , strtotime( $movimentacao->data)) }}</td>
            <td>{{ $movimentacao->tipo_movimentacoes }}</td>
        </tr>
        @endforeach
    </table>
</div>