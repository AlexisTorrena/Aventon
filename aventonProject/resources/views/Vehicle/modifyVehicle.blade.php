@extends('layout.mainlayout')

@section('content')
<div class="container">
  @include('layout.partials.actions')
  @if(session()->has('succesfuly'))
      <div class="alert alert-success" role="alert">{{ session('succesfuly') }} </div>
  @else
    @if(session()->has('error'))
      <div class="alert alert-danger" role="alert"> {{ session('error') }}</div>
    @endif
  @endif
  <form method="POST" action="{{url('vehicleModifyStore')}}">
  <div class="form-group">
    <label for="exampleInputEmail1">Marca</label>
    <input type="text" class="form-control" maxlength="15" id="brandVehicle" name="brandVehicle" value="{{ $vehicles['brand'] }}" required>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Modelo</label>
    <input type="text" class="form-control" maxlength="15" id="modelVehicle" name="modelVehicle" value="{{ $vehicles['model'] }}" required>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Patente</label>
    <input type="text" class="form-control" maxlength="8" id="patentVehicle" name="patentVehicle" value="{{ $vehicles['patent'] }}" required>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Cantidad de asientos</label>
    <input type="number" class="form-control" name="numberOfSeats" id="numberOfSeats" value="{{$vehicles['seats']}}" required>
  </div>
  <input type="hidden" name="idVehicle" value="{{$vehicles['id']}}">
  {!! csrf_field() !!}
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>
@endsection
