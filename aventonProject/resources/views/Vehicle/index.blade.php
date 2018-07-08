@extends('layout.mainlayout')

@section('content')
<div class="container">
  <table class="table table-striped">
      <thead class="thead-dark">
          <tr>
            <th>Marca</th>
            <th>Modelo</th>
            <th>Patente</th>
            <th>Numero de asientos</th>
            <th>Accion</th>
          </tr>
      </thead>
      <tbody>
          @foreach ( $vehicles as $vehicle )
          <tr>
            <td>{{ $vehicle['brand'] }}</td>
            <td>{{ $vehicle['model'] }}</td>
            <td>{{ $vehicle['patent'] }}</td>
            <td>{{ $vehicle['seats'] }}</td>
            <td>
              <a href="{{action('VehicleController@modifyVehicle', ['id' => $vehicle['id'] ])}}" class="btn btn-info" role="button">Modificar vehículo</a>
              <a href="{{action('VehicleController@removeVehicle', ['id' => $vehicle['id'] ])}}"role="button" class="btn btn-outline-info">Borrar vehículo</a>
            </td>
          </tr>
          @endforeach
      </tbody>
  </table>
</div>
@endsection
