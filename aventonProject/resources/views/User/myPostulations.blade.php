@extends('layout.mainlayout') 
@section('content')
<div class="container">
  @include('layout.partials.actions') 
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
      @foreach ( $postulations as $postulation )
      <tr>
        <td>{{ $postulation['status'] }}</td>
        <td>{{ $postulation['origin'] }}</td>
        <td>{{ $postulation['destination'] }}</td>
        <td>{{ $postulation['startTime'] }}</td>
        <td>{{ $postulation['date']}}</td>
        <td>{{ $postulation['cost'] }}</td>
        <td>{{ $postulation['duration'] }}</td>
        <td>{{ $postulation['periodicity'] }}</td>
        <td><a class="button hollow" href="{{ action('TripsController@deletePostulation', ['tripId' => $postulation->id]) }}">Borrar postulación</a></td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection