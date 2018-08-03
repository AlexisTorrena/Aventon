@extends('layout.mainlayout')

@section('content')
<div class="container">
  <div class="alert alert-danger" role="alert">
    <h4 class="alert-heading">No posee vehiculos!</h4>
    <p>Usted no posee vehiculos en el sistema. Para poder organizar un viaje por favor agregue uno</p>
    <hr>
    <a href="registerVehicle" class="btn btn-outline-danger">Agregar un vehiculo!</a>
  </div>
</div>
@endsection
