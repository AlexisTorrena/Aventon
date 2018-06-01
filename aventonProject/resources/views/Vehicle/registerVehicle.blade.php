@extends('layout.mainlayout')

@section('content')
<div class="container">
  @if(session()->has('succesfuly'))
      <div class="alert alert-success" role="alert">{{ session('succesfuly') }} </div>
  @else
    @if(session()->has('error'))
      <div class="alert alert-danger" role="alert"> {{ session('error') }}</div>
    @endif
  @endif
  <form method="POST" action="{{url('vehicleCreate')}}">
  <div class="form-group">
    <label for="exampleInputEmail1">Marca</label>
    <input type="text" class="form-control" id="brandVehicle" name="brandVehicle" placeholder="Volkswagen" required>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Modelo</label>
    <input type="text" class="form-control" id="modelVehicle" name="modelVehicle" placeholder="Fox" required>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Patente</label>
    <input type="text" class="form-control" id="patentVehicle" name="patentVehicle" placeholder="LHN 640" required>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Cantidad de asientos</label>
    <input type="number" class="form-control" name="numberOfSeats" id="numberOfSeats" placeholder="5" required>
  </div>
  {!! csrf_field() !!}
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>
@endsection
