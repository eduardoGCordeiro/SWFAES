<img height="40px" width="80px" src="{{url('/imgs/logo2.png')}}" alt="Image"/>
<p align="center">Relatório FESCON UEPG</p>
<p>Emitido em {{\Carbon\Carbon::now('America/Sao_Paulo')->format('d/m/Y H:i ')}}</p>
<p>Por: {{Auth::user()->nome}}</p>


<center><h2>Estoque</h2></center>
<div class="row">
    <table style="border: 1px solid black" cellpadding="0"  width="100%" class="table table-striped">
        <tr style="border: 1px solid black">
            <th>#</th>
            <th>Nome</th>
            <th>Quantidade</th>
        </tr>
        @foreach ($itens as $key=>$item)
        <tr>
            <td>{{ $key+1 }}</td>
            <td>{{ $item->nome }}</td>
            <td>@php
                $pos = DB::table('movimentacoes')->select(DB::raw('coalesce(sum(quantidade),0)'))->where([['tipo_movimentacoes','=','E'],['id_itens_itens',$item->id_itens]])->first();
                $neg = DB::table('movimentacoes')->select(DB::raw('coalesce(sum(quantidade),0)'))->where([['tipo_movimentacoes','=','S'],['id_itens_itens',$item->id_itens]])->first();
                //dd($neg->coalesce);

                echo $pos->coalesce-$neg->coalesce;
             @endphp</td>
        </tr>
        @endforeach
    </table>
</div>