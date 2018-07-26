@extends('layout.detailLayout') 
@section('content')
<!-- Modal -->
<div class="modal fade" id="messageWindow" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="messageWindowLabel">Confirmacion</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          ¿Desea cancelar este viaje realmente?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <a class="btn btn-primary" href="{{ action('TripsController@cancelTrip', ['tripId' => $trip->id]) }}">Confirmar</a>
        </div>
      </div>
    </div>
 </div>
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
         @if( $ownerId != Auth::user()->id )
         <th width="200">Postulate!</th>
         @else
         <th width="200">Accion</th>
         @endif
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
                  @if( $ownerId != Auth::user()->id )
                  <td><a class="button hollow" href="{{ action('TripsController@postulate', ['tripConfig' => $trip->trip_config_id,'date' => $trip->date,'tripId' => $trip->id]) }}">Postularse</a></td>
                  @else
                  <td>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#messageWindow">
                                Cancelar
                        </button>
                  </td>  
                  @endif
                </tr>
         </tbody>
    </table>
        @if( $ownerId != Auth::user()->id )
        
        <form method="GET" action="{{ action('TripsController@postQuestion', ['tripConfig' => $trip->trip_config_id,'date' => $trip->date,'tripId' => $trip->id]) }}">
            <label align="center" style="width:50%"><h6>Hacé una pregunta!</h6></label>
            <div class="question-field">
                <input type="text" class="question-text" id="question" name="question" style="width: 50%; height: 100px" required>
            </div>
            <br>
                <label align="center" style="width:50%">
                    <button type="submit" class="btn btn-primary">Publicar pregunta</button>
                </label>
        </form>
        <br>
        @if(!$questions ->isEmpty())
        <div class="media-container" style="width: 50%; border: 1px solid black">
            
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
        @else
            <div class="media-container" style="width: 50%; border: 1px solid black">
                <div class="media-body">
                    <h6 align="center">No hay preguntas</h6>
                </div>
            </div>
        @endif
        @else
        @if (!$postulations ->isEmpty())
        <div class="media-container" style="width: 50%; border: 1px solid black">
            @foreach ($postulations as $postulation)
                <div class="media">
                    <div class="media-body" align="center">
                        <p><h6>{{ $postulation['name']}} quiere unirse a tu viaje!</h6>     
                        <a href="{{ action('TripsController@acceptPostulation', ['userId' => $postulation->id, 'tripId' => $trip->id,'tripConfig' => $trip->trip_config_id]) }}" class="btn btn-info" role="button">Aceptar</a>
                        <a href="{{ action('TripsController@rejectPostulation', ['userId' => $postulation->id, 'tripId' => $trip->id,'tripConfig' => $trip->trip_config_id]) }}" class="btn btn-info" role="button">Rechazar</a></p>
                    </div>
                </div>
                @endforeach
        </div>            
        @else
        <div class="media-container" style="width: 50%; border: 1px solid black">
            <div class="media">
                <div class="media-body" align="center">
                    <p><h6>Todavía no hay postulaciones.</h6></p>
                </div>
            </div>
        </div>
        @endif   
        @if (!$questions ->isEmpty())
        <div class="media-container" style="width: 50%; border: 1px solid black">
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
            @else
            <div class="media">
                <div class="media-left">
                    <img class="rounded-circle" src="/images/img_avatar1.png" alt="Card image" style="width:60px">
                </div>
                <div class="media-body">
                    <p>
                    <form method="GET" action="{{ action('TripsController@postAnswer', [$question -> id]) }}">
                        <div class="answer-field">
                            <input type="text" class="answer-text" id="answer" name="answer" style="width: 94%; height: 100px" required>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Publicar respuesta</button>
                    </form>
                    </p>
                </div>
            </div>
            <hr noshade style="height: 2px">
            @endif
            @endforeach
        </div>    
        @else
        <div class="media-container" style="width: 50%; border: 1px solid black">
                <div class="media-body">
                    <h6 align="center">No hay preguntas</h6>
                </div>
        </div>
        @endif
        
        @endif
    
        {{-- This sections belongs to Rating --}}
    <h1>Calificar</h1>
    @include('layout.partials.fiveStarControl')
 </div>
@endsection