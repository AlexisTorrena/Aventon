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
            <th width="200">Action</th>
          </tr>
      </thead>
      <tbody>
          @foreach ( $vehicles as $vehicle )
          <tr>
            <td>{{ $vehicle['brand'] }}</td>
            <td>{{ $vehicle['model'] }}</td>
            <td>{{ $vehicle['patent'] }}</td>
            <td>{{ $vehicle['seats'] }}</td>
            <td><a class="button hollow" href="./details.html">VIEW DETAILS</a></td>
          </tr>
          @endforeach
      </tbody>
  </table>
</div>
@endsection
