@extends('layouts.app')

@section('content')

@if(Session::has('mensaje'))
<div class="alert alert-danger" role="alert">
    {{ Session::get('mensaje') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
<div class="container">
    <h2 style="text-align: center; margin:20px;">Servicio de paquetería</h2>
    <br>
    <a href="{{ url('/envio/create') }}" class="btn btn-success btn-lg"> Registrar nuevo envío</a>
    <form class="form-inline" action="{{ url('/envio/buscar') }}" method="post">
        @csrf
        <div class="form-group mx-auto">
            <label for="fecha_a_buscar" class="is-required" style="margin: 15px;">Ingrese la fecha</label>
            <input type="date" id="fecha_a_buscar" name="fecha_a_buscar" required>
            <input type="submit" class="btn btn-success" style="margin: 15px;" value="Buscar">
        </div>
    </form>
    <br>
    <table class="table table-light">
        <thead class="thead-light">
            <tr>
                <th>ID de envio</th>
                <th>Remitente</th>
                <th>Destinatario</th>
                <th>Descripción</th>
                <th>Destino</th>
                <th>Costo</th>
                <th>Estatus del pago</th>
                <th>Fecha</th>
                <th>ID de corrida</th>
            </tr>
        </thead>

        <tbody>
            @foreach($envios as $envio)
            <tr>
                <?php
                $str = strval($envio->id);
                for ($i = strlen($str); $i < 3; $i++) {
                    $str = "0" . $str;
                }
                $str2 = strval($envio->corrida_id);
                for ($i = strlen($str2); $i < 3; $i++) {
                    $str2 = "0" . $str2;
                }
                ?>
                <td>{{ $str }}</td>
                <td>{{ $envio->remitente }}</td>
                <td>{{ $envio->destinatario }}</td>
                <td>{{ $envio->descripcion }}</td>
                <td>{{ $envio->destino }}</td>
                <td>{{ $envio->costo }}</td>
                <td>{{ $envio->estatus_pago }}</td>
                <td>{{ $envio->fecha_envio }}</td>
                <td>{{ $str2 }}</td>
            </tr>
            @endforeach
        </tbody>

    </table>
</div>
@endsection