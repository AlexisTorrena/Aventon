@extends('layout.mainlayout')

@section('content')
<div class="container">
  @include('layout.partials.actions')
  <table class="table table-striped">
      <thead class="thead-dark">
          <tr>
            <th>Marca</th>
            <th>Modelo</th>
            <th>Patente</th>
            <th>Numero de asientos</th>
          </tr>
      </thead>
      <tbody>
          @foreach ( $vehicles as $vehicle )
          <tr>
            <td>{{ $vehicle['brand'] }}</td>
            <td>{{ $vehicle['model'] }}</td>
            <td>{{ $vehicle['patent'] }}</td>
            <td>{{ $vehicle['seats'] }}</td>
          </tr>
          @endforeach
      </tbody>
  </table>
</div>
@endsection