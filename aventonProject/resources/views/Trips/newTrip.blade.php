@extends('layout.mainlayout') 
@section('content')
<div class="container">
  @include('layout.partials.actions')
  @if(session()->has('succesfuly'))
  <div class="alert alert-success" role="alert">{{ session('succesfuly') }} </div>
  @else @if(session()->has('error'))
  <div class="alert alert-danger" role="alert"> {{ session('error') }}</div>
  @endif @endif
  <form class="needs-validation" role="form" method="POST" action="/Trips" novalidate>
    @csrf
    <div class="form-group">
      <label for="origin">Origen:</label>
      <input type="text" class="form-control" id="origin" name="origin" required>
      <div class="invalid-feedback">
        Por Favor ingrese un Origen.
      </div>
    </div>
    <div class="form-group">
      <label for="destination">Destino:</label>
      <input type="text" class="form-control" id="destination" name="destination" required>
      <div class="invalid-feedback">
        Por Favor ingrese un Destino.
      </div>
    </div>
    <div class="form-group">
      <label for="dateTime">Fecha y Hora:</label>
      <div class='input-group date'>
        <input id='datetimepicker1' type='text' class="form-control" name="datetime" required/>
        <div class="invalid-feedback">
          Por Favor ingrese una Fecha y Hora.
        </div>
      </div>
    </div>
    <div class="form-group">
      <label for="cost">Costo:</label>
      <input type="number" class="form-control" id="cost" min="1" name="cost" required>
      <div class="invalid-feedback">
        Por Favor ingrese un Costo Mayor a 0.
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="form-group dropdown">
          <label for="freq">Frecuencia:</label>
          <select class="btn btn-primary dropdown-toggle custom-select" required name="periodicity">
                        <option value=""><span class="caret">Elige una!</option>
                        <option value="Unica">Unica</option>
                        <option value="Diaria">Diaria</option>
                        <option value="Semanal">Semanal</option>
                        <option value="Semanal">Mensual</option>
                      </select>
          <div class="invalid-feedback">Debe seleccionar una frecuencia</div>
        </div>
      </div>
    </div>
      <button type="submit" class="btn btn-primary">Guardar</button>
  </form>
</div>
@endsection()