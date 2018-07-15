@extends('layout.mainlayout')

@section('content')
<div class="container">
  <div class="alert alert-danger" role="alert">
    <h4 class="alert-heading">No posee Viajes!</h4>
    <p>Usted no posee viajes organizados en el sistema por favor agregue uno</p>
    <hr>
    <a href="registerTrip" class="btn btn-outline-danger">Dar Aventon!</a>
  </div>
</div>
@endsection
