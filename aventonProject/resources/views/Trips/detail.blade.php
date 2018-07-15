@extends('layout.detailLayout') 
@section('content')
 <div class="container">
    <h3 align="center"> Detalle de Viaje</h3>
        @if(session()->has('succesfuly'))
            <div class="alert alert-success" role="alert">{{ session('succesfuly') }} </div>
         @else
          @if(session()->has('error'))
           <div class="alert alert-danger" role="alert"> {{ session('error') }}</div>
          @endif
        @endif
    <table class="table table-striped">
        <thead class="thead-dark">
         <tr>
          <th>Origen</th>
         <th>Destino</th>
         <th>Hora</th>
         <th>Fecha</th>
         <th>Costo</th>
         <th>Duracion</th>
         <th>Frecuencia</th>
         <th width="200">Postulate!</th>
         </tr>
        </thead>
         <tbody>
             <tr>
                  <td>{{ $trip['origin'] }}</td>
                  <td>{{ $trip['destination'] }}</td>
                  <td>{{ $trip['startTime'] }}</td>
                  <td>{{ $trip['date'] }}</td>
                  <td>{{ $trip['cost'] }}</td>
                  <td>{{ $trip['duration'] }}</td>
                  <td>{{ $trip['periodicity'] }}</td>
                  <td><a class="button hollow" href="{{ action('TripsController@postulate', ['tripConfig' => $trip->trip_config_id,'date' => $trip->date,'tripId' => $trip->id]) }}">Postularse</a></td>
             </tr>
         </tbody>
        </table>
@endsection