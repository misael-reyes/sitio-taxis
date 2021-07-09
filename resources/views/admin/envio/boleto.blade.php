@extends('layouts.app')

@section('content')
<h1 style="text-align: center;">Boleto del viaje</h1>


    <div class="col-sm-3 mx-auto">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="card-title">Sitio de taxis YII-YEE</h5>
                <p class="card-text">Remitente: {{ $datos["remitente"] }}</p>
                <p class="card-text">Destinatario: {{ $datos["destinatario"] }}</p>
                <p class="card-text">Descripción: {{ $datos["descripcion"] }}</p>
                <p class="card-text">Destino: {{ $datos["destino"] }}</p>
                <p class="card-text">Costo de envio: {{ $datos["costo"] }}</p>
                <p class="card-text">Estatus del pago: {{ $datos["estatus_pago"] }}</p>
                <p class="card-text">Fecha: {{ $datos["fecha_envio"] }}</p>
                <?php
                $str = strval($datos["corrida_id"]);
                for ($i = strlen($str); $i < 3; $i++) {
                    $str = "0" . $str;
                }
                ?>
                <p class="card-text">Id de la corrida: {{ $str }}</p>
                <p class="card-text">GRACIAS POR SU PREFERENCIA</p>
            </div>
        </div>
    </div>


<div class="d-grid gap-2 col-2 mx-auto">
    <a class="btn btn-success" href="{{ url('envio/') }}" style="margin-top: 80px;">Imprimir Boleto</a>
</div>

@endsection