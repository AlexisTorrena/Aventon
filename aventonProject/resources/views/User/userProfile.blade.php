@extends('layout.perfilLayout')
@section('content')
<div class="container">

  @if(session()->has('succesfuly'))
      <div class="alert alert-success" role="alert">{{ session('succesfuly') }} </div>
  @else
    @if(session()->has('error'))
      <div class="alert alert-danger" role="alert"> {{ session('error') }}</div>
    @endif
  @endif


<div class="container">
  <div class="row">
    <div class="col">
      <div class="card" style="width:300px">
          <img class="rounded-circle" src="/images/img_avatar1.png" alt="Card image" style="width:100%">
          <div class="card-body">
            <h4 class="card-title">{{ $user['name'] }}</h4>
            <p class="card-text">{{$user['email']}}</p>
            <p class="card-text">{{$user['birthDate']}}</p>
            <a href="myVehicles" class="btn btn-info" role="button">Mis vehículos</a>
            <a href="myTrips" class="btn btn-info" role="button">Mis viajes</a>
          </div>
      </div>
    </div>
    <div class="col">
      <h1>Reputación</h1>
       @if(!$user->HasReputation)
          <p>
            El usuario {{$user->name}} todavia no posee suficientes calificaciones!. Debe tener al menos tres calificaciones.
          </p>
       @else
          <P>
           {{$user->name}} tu reputacion actual es:
          </P>
          @php
          $index = 1;
          @endphp
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
                      var selector = "received-star-"+ {{$user->avergeReputation}} +"-" +{{$index}};
                      var radiobtn = document.getElementById(selector);
                      radiobtn.checked = true;
                      var name = "r-star"+{{$index}};
                          var x = document.querySelectorAll("input[name="+  CSS.escape(name) + "]");
                          var i;
                          for (i = 0; i < x.length; i++) {
                                  x[i].disabled = true;
                          }
              </script>
          </div>
       @endif
    </div>
    <!--@include('User.collapseProfile')-->
  </div>
</div>


</div>

@endsection
