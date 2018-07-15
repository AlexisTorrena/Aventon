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
        <h6>Hacé una pregunta!</h6>
        <form method="GET" action="{{ action('TripsController@postQuestion', ['tripConfig' => $trip->trip_config_id,'date' => $trip->date,'tripId' => $trip->id]) }}">
            <div class="question-field">
                <input type="text" class="question-text" id="question" name="question" style="width: 500px; height: 100px">
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Publicar pregunta</button>
        </form>
        <br>
        <div class="media-container" style="width: 600px; border: 1px solid black">
            @foreach ($questions as $question)
            <div class="media">
                <div class="media-body" align="right">
                    <p>{{ $question['question'] }}</p>
                </div>
                <div class="media-right">
                    <img class="rounded-circle" src="/images/img_avatar1.png" alt="Card image" style="width:60px">
                </div>
            </div>
            <hr noshade>
            @if($question['answer'] != null)
            <div class="media">
                <div class="media-left">
                    <img class="rounded-circle" src="/images/img_avatar1.png" alt="Card image" style="width:60px">
                </div>
                <div class="media-body">
                    <p>{{ $question['answer'] }}</p>               
                </div>
            </div>
            <hr noshade style="height: 2px">
            @endif
            @endforeach
        </div>
        

@endsection