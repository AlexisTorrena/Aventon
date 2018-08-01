@extends('layout.mainlayout')
@section('content')
<div class="container">
    @if(session()->has('succesfuly'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">{{ session('succesfuly') }}
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      @php
      session()->forget('succesfuly');
      @endphp
      </div>
    @elseif(session()->has('error'))
      <div class="alert alert-danger alert-dismissible fade show" role="alert"> {{ session('error') }}
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      @php
          session()->forget('error');
      @endphp
      </div>
    @endif
  <table class="table table-striped">
    <thead class="thead-dark">
      <tr>
        <th>Estado</th>
        <th>Origen</th>
        <th>Destino</th>
        <th>Hora</th>
        <th>Fecha</th>
        <th>Costo</th>
        <th>Duracion</th>
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
        <td>{{ $trip['startTime'] }}</td>
        <td>{{ $trip['date']}}</td>
        <td>{{ $trip['cost'] }}</td>
        <td>{{ $trip['duration'] }}</td>
        <td>{{ $trip['periodicity'] }}</td>
        <td><a class="button hollow" href="{{ action('TripsController@detail', ['tripConfig' => $trip->trip_config_id,'date' => $trip->date,'tripId' => $trip->id]) }}">Ver</a></td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
