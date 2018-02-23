<style>
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;

}

td, th {
    border: 1px solid #000000;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #dddddd;
}
</style>

 <html>
    <table>
      <tr>
        <th>{{$actividad->sede->cliente->nombre}}</th>
        <td><b>Sede:</b> {{$actividad->sede->nombre}}</td>
      </tr>
      <tr>
        <td><b>Actividad:</b> {{$actividad->actividad->nombre}}</td>
        <td><b>Fecha:</b> {{$actividad->fecha}} - <b>Hora:</b> {{$actividad->hora_inicio}}</td>
      </tr>
    </table>
    <br>
    <table>
      <tr>
        <th>Cedula</th>
        <th>Nombre</th>
        <th>Area</th>
        <th>Hora</th>
      </tr>
      @foreach ($asistencias as $key)
      <tr>
          <td>{{$key->persona->identificacion}}</td>
          <td>{{$key->persona->apellidos}} {{$key->persona->nombres}}</td>
          <td>{{$key->persona->area}}</td>
          <td>{{$key->created_at}}</td>
      </tr>
      @endforeach
    </table>
</html>
