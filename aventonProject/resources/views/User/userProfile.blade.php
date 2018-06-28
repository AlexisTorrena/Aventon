@extends('layout.perfilLayout')

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


<div class="container">
  <div class="row">
    <div class="col">
      <div class="card" style="width:300px">
          <img class="rounded-circle" src="/images/img_avatar1.png" alt="Card image" style="width:100%">
          <div class="card-body">
            <h4 class="card-title">{{ $user['name'] }}</h4>
            <p class="card-text">{{$user['email']}}</p>
            <p class="card-text">{{$user['birthDate']}}</p>
          </div>
      </div>
    </div>
    <!--@include('User.collapseProfile')-->
  </div>
</div>


</div>

@endsection
