@extends('layout.mainlayout') 
@section('content')
<div class="container">
  @include('layout.partials.actions') @if(session()->has('succesfuly'))
  <div class="alert alert-success" role="alert">{{ session('succesfuly') }} </div>
  @else @if(session()->has('error'))
  <div class="alert alert-danger" role="alert"> {{ session('error') }}</div>
  @endif @endif
  <form class="needs-validation" role="form" method="POST" action="/Trips" novalidate autocomplete="off">
    @csrf
    <div class="row">
      <div class="form-group col">
        <label for="origin">Origen:</label>
        <input type="text" class="form-control" id="origin" name="origin" required>
        <div class="invalid-feedback">
          Por Favor ingrese un Origen.
        </div>
      </div>
      <div class="form-group col">
        <label for="destination">Destino:</label>
        <input type="text" class="form-control" id="destination" name="destination" required>
        <div class="invalid-feedback">
          Por Favor ingrese un Destino.
        </div>
      </div>
    </div>
    <div class="row">
      <div class="form-group col">
        <label for="cost">Costo:</label>
        <input type="number" class="form-control" id="cost" min="1" name="cost" required>
        <div class="invalid-feedback">
          Por Favor ingrese un Costo Mayor a 0.
        </div>
      </div>
      <div class="form-group col">
        <label for="duration">Duaracion en minutos:</label>
        <input type="number" class="form-control" id="duration" min="1" name="duration" required>
        <div class="invalid-feedback">
          Por Favor ingrese una duracion Mayor a 0.
        </div>
      </div>
    </div>
    <div class="row">
      <div class="form-group col">
        <label for="dateTime">Hora de Partida:</label>
        <div class='input-group date'>
          <input type='text' id='startTime' class="form-control" name="startTime" required/>
          <span class="input-group-addon">
                    <span class="glyphicon glyphicon-time"></span>
          </span>
        </div>
      </div>
      <div class="form-group col">
        <label for="dateTime">Fecha Inicio:</label>
        <div class='input-group date'>
          <input id='startDate' type='text' class="form-control" name="startDate" required/>
          <div class="invalid-feedback">
            Por Favor ingrese una Fecha.
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="form-group dropdown col">
        <label for="freq">Frecuencia:</label>
        <select class="btn btn-primary dropdown-toggle custom-select" id="periodicity" required name="periodicity" onclick="showEndCalendar()">
                        <option value=""><span class="caret">Elige una!</option>
                        <option value="Unica">Unica</option>
                        <option value="Diaria">Diaria</option>
                        <option value="Semanal">Semanal</option>
                        <option value="Mensual">Mensual</option>
                      </select>
        <div class="invalid-feedback">Debe seleccionar una frecuencia</div>
      </div>
      <div class="form-group col float-right">
        <label for="dateTime">Fecha Fin:</label>
        <div class='input-group date float-right'>
          <input id='endDate' type='text' class="form-control" name="endDate" required disabled/>
          <div class="invalid-feedback">
            Por Favor ingrese una Fecha.
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="form-group dropdown col">
      <label for="vehicle">Vehículo:</label>
      <select class="btn btn-primary dropdown-toggle custom-select" id="vehicle" required name="vehicle">
                        <option value=""><span class="caret">Elige uno!</option>
                        @foreach( $vehicles as $vehicle )
                        <option value="{{ $vehicle['id'] }}">{{ $vehicle['patent'] }}</option>
                        @endforeach
      </select>
      <div class="invalid-feedback">Debe seleccionar un vehículo</div>
      </div>
    </div>
    <button type="submit" class="btn btn-primary float-right">Guardar</button>
  </form>
</div>
@endsection