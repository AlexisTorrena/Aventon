@extends('layout.mainlayout')
 
@section('content')
<div class="container">
  <table class="table table-striped">
      <thead class="thead-dark">
          <tr>
            <th>Estado</th>
            <th>Origen</th>
            <th>Destino</th>
            <th>Fecha</th>
            <th>Costo</th>
            <th>Frecuencia</th>
            <th>ShareLink</th>
            <th width="200">Action</th>
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
            <td>{{ $trip['isPeriodic'] }}</td>
            <td>{{ $trip['shareLink'] }}</td>
            <td><a class="button hollow" href="./details.html">VIEW DETAILS</a></td>
          </tr>
          @endforeach
      </tbody>
  </table>
</div>
@endsection