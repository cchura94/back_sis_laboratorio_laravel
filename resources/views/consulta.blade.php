<!--{{ $data }} -->
<style>
table.content
{
    width: 100%;
    border-collapse: collapse;
    padding: 0px;
    margin: 0px;
    font-family: Arial;
    font-size: 11px;
    line-height: 1.4;
}

.content th
{
    border: solid 1px #000000;
    text-align: left;
}

.content .row
{
    border-top: solid 1px #000000;
}
</style>
<table class="content">
    <tr class="font-12">
        <th style="width: 250px">Paciente</th>
        <th style="width: 200px">Profesional</th>
        <th style="width: 100px">Sucursal</th>
    </tr>
    <tr class="row">
        <td>{{ $data->paciente->nombres }} {{ $data->paciente->apellidos }}</td>
        <td>{{ $data->profesional->nombres }} {{ $data->paciente->apellidos }}</td>
        <td>{{ $data->sucursal->nombre }}</td>
    </tr>
   
</table>