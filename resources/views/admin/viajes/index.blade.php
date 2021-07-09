@extends('layouts.app')

@section('content')
<div class="container">
    @if(Session::has('mensaje'))
    <div class="alert alert-success alert-dismissible" role="alert">
        {{ Session::get('mensaje') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    <br>
    <a href="{{ url('/viaje/create') }}" class="btn btn-success btn-lg"> Registrar nuevo Viaje</a>
    <br>
    <br>
    <table class="table table-light">

        <thead class="thead-light">
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Fecha de inicio</th>
                <th>Fecha final</th>
                <th>Origen</th>
                <th>Destino</th>
                <th>Taxi</th>
                <th>Costo total</th>
            </tr>
        </thead>

        <tbody>
            @foreach($viajes as $viaje)
            <tr>
                <?php
                $str = strval($viaje->id);
                for ($i = strlen($str); $i < 3; $i++) {
                    $str = "0" . $str;
                }
                $str2 = strval($viaje->cab_id);
                for ($i = strlen($str2); $i < 3; $i++) {
                    $str2 = "0" . $str2;
                }
                ?>
                <td>{{ $str }}</td>
                <td>{{ $viaje->cliente }}</td>
                <td>{{ $viaje->fecha_inicio }}</td>
                <td>{{ $viaje->fecha_final }}</td>
                <td>{{ $viaje->origen }}</td>
                <td>{{ $viaje->destino }}</td>
                <td>{{ $str2 }}</td>
                <td>${{ $viaje->costo }}</td>
            </tr>
            @endforeach
        </tbody>

    </table>
</div>
@endsection