@extends('layout.mainlayout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Aventon</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    Registro completado! Ya podés compartir viajes con Aventon!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection