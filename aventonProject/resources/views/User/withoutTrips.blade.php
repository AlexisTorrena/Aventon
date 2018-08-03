@extends('layout.mainlayout')

@section('content')
<div class="container">
  <div class="alert alert-danger" role="alert">
    <h4 class="alert-heading">No posee Viajes!</h4>
    <p>Usted no forma parte de ningun viaje en el sistema por favor Busque uno</p>
    <hr>
    <a href="Trips" class="btn btn-outline-danger">Buscar Aventon!</a>
  </div>
</div>
@endsection
