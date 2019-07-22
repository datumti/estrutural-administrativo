<style>
td {
    width: 200px;
}
</style>
<table style="background-color: #ff00ff">
    <thead  style="background-color: gray;size: 20pt;">
    <tr>
        <th colspan="8" style="text-align: center; height:30cm; font-size: 20cm; background-color: #d9d9d9"><strong> EFETIVO DIÁRIO DE OBRA</strong></th>
    </tr>
    </thead>
    <tbody>
        <tr>
            <td style="width: 10pt"><strong>Contratante: </strong></td>
            <td>{{ $construction->name }}</td>
            <td colspan="2"><strong>Local: </strong></td>
            <td colspan="3">Duque de Caxias - RJ</td>
            <td colspan="1" style="text-align: center; height:20cm"><strong>DATA</strong></td>
        </tr>
        <tr>
            <td><strong>Contratada: </strong></td>
            <td>Estrutural Serviços Industriais LTDA</td>
            <td colspan="2"><strong>Contrato: </strong></td>
            <td colspan="3">123</td>
            <td rowspan="2" style="font-size: 15cm; text-align:center"><strong>{{\Carbon\Carbon::now()->format('d/m/Y')}}</strong></td>
        </tr>
        <tr>
            <td style="height:20cm; text-align: center; font-size: 15cm" colspan="7">
                <strong>TURNO: {{$filter['date']}} {{$filter['start_time']}} A {{$filter['end_time']}}</strong>
            </td>
        </tr>
        <tr>
            <td colspan="4" style="text-align: center; background-color:#deebf7; border:5cm solid #000000">
                <strong>Mão de Obra Indireta</strong>
            </td>
            <td colspan="4" style="text-align:center; background-color:#deebf7; border:5cm solid #000000">
                <strong>Mão de Obra Direta</strong>
            </td>
        </tr>
        <tr style="">
            <td>
                <strong>Função</strong>
            </td>
            <td style="width: 1cm">
                <strong>Total</strong>
            </td>
            <td>
                <strong>Falta</strong>
            </td>
            <td>
                <strong>Presente</strong>
            </td>
            <td>
                <strong>Função</strong>
            </td>
            <td>
                <strong>Total</strong>
            </td>
            <td>
                <strong>Falta</strong>
            </td>
            <td>
                <strong>Presente</strong>
            </td>
        </tr>
        @foreach ($construction->vacancy as $vacancy)
            <tr>
                <td>{{ $vacancy->job->name }}</td>
                <td>2</td>
                <td>1</td>
                <td>1</td>
                <td>{{ $vacancy->job->name }}</td>
                <td>2</td>
                <td>1</td>
                <td>1</td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td style="background-color: #dbdbdb">Total Indiretos</td>
            <td style="background-color: #dbdbdb">2</td>
            <td style="background-color: #dbdbdb">1</td>
            <td style="background-color: #dbdbdb">1</td>
            <td style="background-color: #dbdbdb">Total Diretos</td>
            <td style="background-color: #dbdbdb">2</td>
            <td style="background-color: #dbdbdb">1</td>
            <td style="background-color: #dbdbdb">1</td>
        </tr>
        <tr>
            <td colspan="5" style="background-color: #bfbfbf; font-size: 15cm">
                <strong>Total Estrutural</strong>
            </td>
        </tr>
    </tfoot>
</table>
