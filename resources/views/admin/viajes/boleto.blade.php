@extends('layouts.app')

@section('content')
<h1 style="text-align: center;">Boleto del viaje</h1>


    <div class="col-sm-3 mx-auto">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="card-title">Sitio de taxis YII-YEE</h5>
                <p class="card-text">cliente: {{ $datos["cliente"] }}</p>
                <p class="card-text">fecha de inicio: {{ $datos["fecha_inicio"] }}</p>
                <p class="card-text">fecha de retorno: {{ $datos["fecha_final"] }}</p>
                <p class="card-text">origen: {{ $datos["origen"] }}</p>
                <p class="card-text">destino: {{ $datos["destino"] }}</p>
                <?php
                $str = strval($datos["cab_id"]);
                for ($i = strlen($str); $i < 3; $i++) {
                    $str = "0" . $str;
                }
                ?>
                <p class="card-text">Id del taxi: {{ $str }}</p>
                <p class="card-text">GRACIAS POR SU PREFERENCIA</p>
            </div>
        </div>
    </div>


<div class="d-grid gap-2 col-2 mx-auto">
    <a class="btn btn-success" href="{{ url('viaje/') }}" style="margin-top: 80px;">Imprimir Boleto</a>
</div>

@endsection