@extends('layouts.app')

@section('content')
@if(Session::has('mensaje'))
<div class="alert alert-success alert-dismissible" role="alert">
    {{ Session::get('mensaje') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
<h1 style="text-align: center;">Corridas disponibles</h1>
<div class="row">
    @foreach($corridas as $corrida)

    <div class="col-sm-6">
        <div class="card text-white bg-primary mb-3" style="margin: 10px;">
            <div class="card-body">
                <h5 class="card-title">Hora de salida: {{ $corrida->hora_salida }}</h5>
                <p class="card-text">Origen: San Miguel Suchixtepec</p>
                <p class="card-text">Destino: Miahutlán</p>
                <a href="{{ url('/reservacion/'.$corrida->id.'/asientos') }}" class="btn btn-light">Empezar a reservar</a>
                <a href="{{ url('/reservacion/'.$corrida->id.'/cancelar') }}" class="btn btn-danger">Cancelar reservación</a>

            </div>
        </div>
    </div>
    @endforeach
</div>

@endsection