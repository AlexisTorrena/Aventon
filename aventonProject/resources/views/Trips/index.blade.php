@extends('layout.mainlayout')
@section('content')
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
    <div class="navbar navbar-light ">
      <form  method="POST" action="/search" class="form-inline">
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Origen</span>
          </div>
          @if(isset($filter['origin']))
          <input class="form-control mr-sm-2" type="text" id='origin' name='origin' placeholder="{{ $filter['origin'] }}" aria-label="Search">
          @else
          <input class="form-control mr-sm-2" type="text" id='origin' name='origin' placeholder="..." aria-label="Search">
          @endif
        </div>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Destino</span>
          </div>
          @if(isset($filter['destination']))
          <input class="form-control mr-sm-2" type="text" id='destination' name='destination' placeholder="{{ $filter['destination'] }}" aria-label="Search">
          @else
          <input class="form-control mr-sm-2" type="text" id='destination' name='destination' placeholder="..." aria-label="Search">
          @endif
        </div>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Fecha</span>
          </div>
          <input class="form-control mr-sm-2" name="dates" id="dates" type="date" placeholder="" aria-label="Search">
        </div>
        <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Buscar</button>
        {!! csrf_field() !!}
      </form>
    </div>

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
      @if(\Carbon\Carbon::parse($trip->date) >= \Carbon\Carbon::today())
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
      @endif
      @endforeach
    </tbody>
  </table>
</div>
@endsection
