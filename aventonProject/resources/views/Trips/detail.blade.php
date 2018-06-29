@extends('layout.detailLayout') 
@section('content')


<h1> Detalle de Viaje
    <h1>

        <div class="container">
            <div class="row">
                <label class="" for="origin">Origen: {{ $trip['origin'] }}</label>
            </div>
            <div class="row">
                <label class="" for="destination">Destino: {{$trip['destination']}}</label>
            </div>
            <div class="row">
                <label class="" for="duration">Duracion: {{$trip['duration']}}</label>
            </div>
            <div class="row">
                <label class="" for="cost">Costo: {{$trip['cost']}}</label>
            </div>
            <div class="row">
                <label class="" for="date">Fecha: {{$trip['date']}}</label>
            </div>
            <div class="row">
                <label class="" for="startTime">Hora: {{$trip['startTime']}}</label>
            </div>
        </div>
@endsection