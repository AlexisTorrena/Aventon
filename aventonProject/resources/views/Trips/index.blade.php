@extends('layout.mainlayout') 
@section('content')
<div class="container">
  @include('layout.partials.actions')
  <table class="table table-striped">
    <thead class="thead-dark">
      <tr>
        <th>Estado</th>
        <th>Origen</th>
        <th>Destino</th>
        <th>Fecha</th>
        <th>Costo</th>
        <th>Frecuencia</th>
        <th width="200">Detalle</th>
      </tr>
    </thead>
    <tbody>
      @foreach ( $trips as $trip )
      <tr>
        <td>{{ $trip['status'] }}</td>
        <td>{{ $trip['origin'] }}</td>
        <td>{{ $trip['destination'] }}</td>
        <td>{{ $trip['date'] }}</td>
        <td>{{ $trip['cost'] }}</td>
        <td>{{ $trip['periodicity'] }}</td>
        <td><a class="button hollow" href="./details.html">Ver</a></td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection