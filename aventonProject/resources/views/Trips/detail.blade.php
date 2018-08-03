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

        <br/>
                    <h1>Reputación</h1>
                    <br/>
                    @php
                    $user = $trip->TripConfiguration->owner;
                    @endphp
                    
                    @if(!$user->HasReputation)
                    <div class="row"
                        <p>
                        El usuario {{$user->name}} todavía no posee suficientes calificaciones! Debe tener al menos tres calificaciones.
                        </p>
                    </div>
                    @else
                       <div class="row"
                            <P>
                            La reputación actual de {{$user->name}} es:
                            </P>
                            <br/>
                        @php
                        $index = 1;
                        @endphp
                        
                        <div class="align-self-center mr-3 float-left">
                            <div class="stars" id="receivedRating{{$index}}">
                                <input class="star star-5" id="owner-received-star-5-{{$index}}" type="radio" name="owner-star{{$index}}"/>
                                <label class="star full-star star-5" for="received-star-5-{{$index}}"></label>
                                <input class="star star-4" id="owner-received-star-4-{{$index}}" type="radio" name="owner-star{{$index}}"/>
                                <label class="star full-star star-4" for="received-star-4-{{$index}}"></label>
                                <input class="star star-3" id="owner-received-star-3-{{$index}}" type="radio" name="owner-star{{$index}}"/>
                                <label class="star full-star star-3" for="received-star-3-{{$index}}"></label>
                                <input class="star star-2" id="owner-received-star-2-{{$index}}" type="radio" name="owner-star{{$index}}"/>
                                <label class="star full-star star-2" for="received-star-2-{{$index}}"></label>
                                <input class="star star-1" id="owner-received-star-1-{{$index}}" type="radio" name="owner-star{{$index}}"/>
                                <label class="star full-star star-1" for="received-star-1-{{$index}}"></label>
                            </div>
                            <script type="text/javascript">
                                        //no tocar , pacto con el diablo jaja
                                    var selector = "owner-received-star-"+ {{$user->avergeReputation}} +"-" +{{$index}};
                                    var radiobtn = document.getElementById(selector);
                                    radiobtn.checked = true;
                                    var name = "owner-star"+{{$index}};
                                        var x = document.querySelectorAll("input[name="+  CSS.escape(name) + "]");
                                        var i;
                                        for (i = 0; i < x.length; i++) {
                                                x[i].disabled = true;
                                        }
                            </script>
                        </div>
                       </div> 
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
            <th>Conductor</th>
            @if(!$trip->isRatable)
                @if( $ownerId != Auth::user()->id )
                <th width="200">Postulate!</th>
                @else
                <th width="200">Accion</th>
                @endif
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
                    <td> <a href="{{action('UserController@showProfile', ['id' => $trip->TripConfiguration->owner->id ])}}">{{$trip->TripConfiguration->owner->name }}</a></td>
                    @if(!$trip->isRatable)
                        @if( $ownerId != Auth::user()->id )
                        <td><a class="button hollow" href="{{ action('TripsController@postulate', ['tripConfig' => $trip->trip_config_id,'date' => $trip->date,'tripId' => $trip->id]) }}">Postularse</a></td>
                        @else
                        <td>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#messageWindow">
                                        Cancelar
                                </button>
                        </td>  
                        @endif
                    @endif
                </tr>
            </tbody>
        </table>
       @if($ownerId == Auth::user()->id) 
        @if(!$trip->realPassengers->isEmpty())
            <h3>Tus Pasajeros Son:</h3>
            <table class="table table-striped">
                    <thead class="thead-dark">
                    <tr>
                    <th>Nombre</th>
                    <th width="200">Accion</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($trip->realPassengers as $realPassenger)
                        <tr>
                            <td>{{ $realPassenger->name }}</td>
                            <td> <a href="{{action('UserController@showProfile', ['id' => $realPassenger->id ])}}">Ver Perfil</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <hr noshade style="height: 2px">
        @endif
       @endif
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
    @if($trip->IsRatable)

        @if( $ownerId == Auth::user()->id )
            @if (!$trip->passengersToScore->isEmpty())
                <br/> 
                <h1>Calificar</h1>
                <br/> 
                <h4>Por favor califica a tus pasajeros!</h4>
                <br/>
                @php
                $index = 0;
                @endphp
                @foreach ($trip->passengersToScore as $passanger)
                    @php
                    $index = $index+1;
                    @endphp
                    <div class="row">
                        <div class="col">
                            <div class="align-self-start mr-3">
                                <h5>Califica al usuario {{ $passanger->name}}</h5>
                            </div>
                            <div class="align-self-center mr-3 float-left">
                                <div class="stars" id="rating{{$index}}" onclick="setRatingForHidden({{$index}})">
                                    <input class="star star-5" id="star-5-{{$index}}" type="radio" name="star{{$index}}" value="5"/>
                                    <label class="star full-star star-5" for="star-5-{{$index}}"></label>
                                    <input class="star star-4" id="star-4-{{$index}}" type="radio" name="star{{$index}}" value="4"/>
                                    <label class="star full-star star-4" for="star-4-{{$index}}"></label>
                                    <input class="star star-3" id="star-3-{{$index}}" type="radio" name="star{{$index}}" value="3"/>
                                    <label class="star full-star star-3" for="star-3-{{$index}}"></label>
                                    <input class="star star-2" id="star-2-{{$index}}" type="radio" name="star{{$index}}" value="2"/>
                                    <label class="star full-star star-2" for="star-2-{{$index}}"></label>
                                    <input class="star star-1" id="star-1-{{$index}}" type="radio" name="star{{$index}}" value="1"/>
                                    <label class="star full-star star-1" for="star-1-{{$index}}"></label>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="media-body">
                                <p>
                                    <form method="POST" action="{{ action('TripsController@rateTrip') }}" autocomplete="off">
                                        @csrf
                                        <div class="answer-field">
                                            <textarea name="comment" cols="50" rows="5" minlength="20" style="width: 94%; height: 100px" required></textarea>
                                        </div>
                                        <br>
                                        <input type="hidden" id="hiddenRating{{$index}}" name="rating" value="">
                                        <input type="hidden" id="trip" name="tripId" value="{{$trip->id}}">
                                        <input type="hidden" id="owner" name="ownerId" value="{{$passanger->id}}">
                                    <button type="submit" class="btn btn-primary">Calificar</button>
                                    </form>
                                </p>
                            </div>
                        </div>
                    </div>
                    <hr noshade style="height: 2px"> 
                @endforeach 
            @endif
        @else
            @if(!$trip->alreadyRatedByMe)
                <br/> 
                <h1>Calificar</h1>
                <br/> 
                <h4>Por favor califica a tu conductor!</h4>
                <br/>
                @php
                 $index = 1;
                @endphp
                <div class="row">
                    <div class="col">
                        <div class="align-self-start mr-3">
                            <h5>Califica al usuario {{ $trip->TripConfiguration->owner->name }}</h5>
                        </div>
                        <div class="align-self-center mr-3 float-left">
                            <div class="stars" id="rating{{$index}}" onclick="setRatingForHidden({{$index}})">
                                <input class="star star-5" id="star-5-{{$index}}" type="radio" name="star{{$index}}" value="5"/>
                                <label class="star full-star star-5" for="star-5-{{$index}}"></label>
                                <input class="star star-4" id="star-4-{{$index}}" type="radio" name="star{{$index}}" value="4"/>
                                <label class="star full-star star-4" for="star-4-{{$index}}"></label>
                                <input class="star star-3" id="star-3-{{$index}}" type="radio" name="star{{$index}}" value="3"/>
                                <label class="star full-star star-3" for="star-3-{{$index}}"></label>
                                <input class="star star-2" id="star-2-{{$index}}" type="radio" name="star{{$index}}" value="2"/>
                                <label class="star full-star star-2" for="star-2-{{$index}}"></label>
                                <input class="star star-1" id="star-1-{{$index}}" type="radio" name="star{{$index}}" value="1"/>
                                <label class="star full-star star-1" for="star-1-{{$index}}"></label>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="media-body">
                            <p>
                                <form method="POST" action="{{ action('TripsController@rateTrip') }}" autocomplete="off">
                                    @csrf
                                    <div class="answer-field">
                                        <textarea name="comment" cols="50" rows="5" minlength="20" style="width: 94%; height: 100px" required></textarea>
                                    </div>
                                    <br>
                                    <input type="hidden" id="hiddenRating{{$index}}" name="rating" value="">
                                    <input type="hidden" id="trip" name="tripId" value="{{$trip->id}}">
                                    <input type="hidden" id="owner" name="ownerId" value="{{ $trip->TripConfiguration->owner->id}}">
                                <button type="submit" class="btn btn-primary">Calificar</button>
                                </form>
                            </p>
                        </div>
                    </div>
                </div>
                <hr noshade style="height: 2px"> 
            @endif
        @endif
        @if(!$trip->scores->isEmpty())
            <br/>
            <h1>Calificaciones</h1>
            <br/>
                <h4>Te calificaron</h4>
                <br/>
                {{-- calificaciones para el usuario loggeado, puede ser el owner o no, no importa --}}
                @php
                    $index = 0;
                @endphp
                @foreach($trip->scoresForUser(Auth::user()->id) as $score)
                    @php
                    $index = $index+1;
                    @endphp
                    <div class="row">
                        <div class="col">
                            <div class="align-self-start mr-3">
                                <h5>Te califico el usuario {{ $score->qualifier->name}}</h5>
                            </div>
                            <div class="align-self-center mr-3 float-left">
                                <div class="stars" id="receivedRating{{$index}}">
                                    <input class="star star-5" id="received-star-5-{{$index}}" type="radio" name="r-star{{$index}}"/>
                                    <label class="star full-star star-5" for="received-star-5-{{$index}}"></label>
                                    <input class="star star-4" id="received-star-4-{{$index}}" type="radio" name="r-star{{$index}}"/>
                                    <label class="star full-star star-4" for="received-star-4-{{$index}}"></label>
                                    <input class="star star-3" id="received-star-3-{{$index}}" type="radio" name="r-star{{$index}}"/>
                                    <label class="star full-star star-3" for="received-star-3-{{$index}}"></label>
                                    <input class="star star-2" id="received-star-2-{{$index}}" type="radio" name="r-star{{$index}}"/>
                                    <label class="star full-star star-2" for="received-star-2-{{$index}}"></label>
                                    <input class="star star-1" id="received-star-1-{{$index}}" type="radio" name="r-star{{$index}}"/>
                                    <label class="star full-star star-1" for="received-star-1-{{$index}}"></label>
                                </div>
                                <script type="text/javascript">
                                            //no tocar , pacto con el diablo jaja
                                        var selector = "received-star-"+ {{$score->value}} +"-" +{{$index}};
                                        var radiobtn = document.getElementById(CSS.escape(selector));
                                        radiobtn.checked = true;
                                        var name = "r-star"+{{$index}};
                                            var x = document.querySelectorAll("input[name="+  CSS.escape(name) + "]");
                                            var i;
                                            for (i = 0; i < x.length; i++) {
                                                    x[i].disabled = true;
                                            }
                                </script>
                            </div>
                        </div>
                        <div class="col">
                            <div class="media-body">
                                <p>
                                    {{$score->comment}}
                                </p>
                            </div>
                        </div>
                    </div>
                    <hr noshade style="height: 2px"> 
                @endforeach
                <hr noshade style="height: 2px">
                <br/> 
                <h4>Tu calificación</h4>
                <br/>
                {{-- calificaciones que dio el usuario loggeado, puede ser el owner o no, no importa --}}
                @php
                $index = 0;
                @endphp
                @foreach($trip->myScores(Auth::user()->id) as $score)
                    @php
                    $index = $index+1;
                    @endphp
                    <div class="row">
                        <div class="col">
                            <div class="align-self-start mr-3">
                                <h5> Calificaste al usuario {{ $score->owner->name}}</h5>
                            </div>
                            <div class="align-self-center mr-3 float-left">
                                <div class="stars" id="givenRating{{$index}}">
                                    <input class="star star-5" id="given-star-5-{{$index}}" type="radio" name="g-star{{$index}}" value="5"/>
                                    <label class="star full-star star-5" for="given-star-5-{{$index}}"></label>
                                    <input class="star star-4" id="given-star-4-{{$index}}" type="radio" name="g-star{{$index}}" value="4"/>
                                    <label class="star full-star star-4" for="given-star-4-{{$index}}"></label>
                                    <input class="star star-3" id="given-star-3-{{$index}}" type="radio" name="g-star{{$index}}" value="3"/>
                                    <label class="star full-star star-3" for="given-star-3-{{$index}}"></label>
                                    <input class="star star-2" id="given-star-2-{{$index}}" type="radio" name="g-star{{$index}}" value="2"/>
                                    <label class="star full-star star-2" for="given-star-2-{{$index}}"></label>
                                    <input class="star star-1" id="given-star-1-{{$index}}" type="radio" name="g-star{{$index}}" value="1"/>
                                    <label class="star full-star star-1" for="given-star-1-{{$index}}"></label>
                                </div>
                                <script type="text/javascript">
                                    //no tocar , pacto con el diablo jaja
                                var selector = "given-star-"+ {{$score->value}} +"-" +{{$index}};
                                var radiobtn = document.getElementById(CSS.escape(selector));
                                radiobtn.checked = true;
                                var name = "g-star"+{{$index}};
                                var x = document.querySelectorAll("input[name="+  CSS.escape(name) + "]");
                                var i;
                                    for (i = 0; i < x.length; i++) {
                                        x[i].disabled = true;
                                    }
                                </script>
                            </div>
                        </div>
                        <div class="col">
                            <div class="media-body">
                                <p>
                                    {{$score->comment}}
                                </p>
                            </div>
                        </div>
                    </div>
                    <hr noshade style="height: 2px">
                @endforeach
         @endif        
    @endif
 </div>
 <script>
     function setRatingForHidden($index)
     {
         //no tocar , pacto con el diablo jaja
        var name = 'star' + $index;
        var selector = 'hiddenRating'+ $index;
        var rating = document.querySelector("input[name="+  CSS.escape(name) + "]:checked").value;
        document.querySelector("#"+  CSS.escape(selector)).value = rating;
     }
</script>
@endsection
