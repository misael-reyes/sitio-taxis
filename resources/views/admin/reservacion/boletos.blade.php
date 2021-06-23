@extends('layouts.app')

@section('content')
<h1 style="text-align: center;">Boletos</h1>

<div class="row row-cols-1 row-cols-md-3 g-4">
    @php
    function costo($destino){
    $costo = 0;
    switch ($destino) {
    case "Miahuatlán":
    $costo = 50;
    break;
    case "Portillo Plaxtlán":
    $costo = 40;
    break;
    case "La Ciénega":
    $costo = 35;
    break;
    case "San José del Pacífico":
    $costo = 30;
    break;
    case "El Manzanal":
    $costo = 20;
    break;
    case "Rancho Cañas":
    $costo = 10;
    break;
    default:
    break;
    }
    return $costo;
    }
    @endphp

    @php($bandera1 = true)
    @php($bandera2 = true)
    @php($bandera3 = true)
    @php($bandera4 = true)


    @for($i = 0; $i < $boletosAgenerar; $i++) <div class="col-sm-3">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="card-title">Sitio de taxis YII-YEE</h5>
                <p class="card-text">cliente: {{ $datos2["cliente"] }}</p>
                @if (isset($datos2["num_asiento1"]) && $bandera1 == true)
                <p class="card-text">número de asiento: {{ $datos2["num_asiento1"] }}</p>
                <p class="card-text">destino: {{ $datos2["destino_intermedio1"] }}</p>
                <p class="card-text">costo: $ {{ costo($datos2["destino_intermedio1"]) }}</p>
                <p class="card-text">estatus del pago: {{ $datos2["estatus_pago"] }}</p>
                @php($bandera1 = false)
                @elseif (isset($datos2["num_asiento2"]) && $bandera2 == true)
                <p class="card-text">número de asiento: {{ $datos2["num_asiento2"] }}</p>
                <p class="card-text">destino: {{ $datos2["destino_intermedio2"] }}</p>
                <p class="card-text">costo: $ {{ costo($datos2["destino_intermedio2"]) }}</p>
                <p class="card-text">estatus del pago: {{ $datos2["estatus_pago"] }}</p>
                @php($bandera2 = false)
                @elseif (isset($datos2["num_asiento3"]) && $bandera3 == true)
                <p class="card-text">número de asiento: {{ $datos2["num_asiento3"] }}</p>
                <p class="card-text">destino: {{ $datos2["destino_intermedio3"] }}</p>
                <p class="card-text">costo: $ {{ costo($datos2["destino_intermedio3"]) }}</p>
                <p class="card-text">estatus del pago: {{ $datos2["estatus_pago"] }}</p>
                @php($bandera3 = false)
                @else
                <p class="card-text">número de asiento: {{ $datos2["num_asiento4"] }}</p>
                <p class="card-text">destino: {{ $datos2["destino_intermedio4"] }}</p>
                <p class="card-text">costo: $ {{ costo($datos2["destino_intermedio4"]) }}</p>
                <p class="card-text">estatus del pago: {{ $datos2["estatus_pago"] }}</p>
                @php($bandera4 = false)
                @endif
                <p class="card-text">hora salida: {{ $datos2["hora_salida"] }}</p>
                <p class="card-text">GRACIAS POR SU PREFERENCIA</p>
            </div>
        </div>
</div>
@endfor
</div>

<div class="d-grid gap-2 col-2 mx-auto">
    <a class="btn btn-success" href="{{ url('reservacion/') }}" style="margin-top: 80px;">Imprimir Boletos</a>
</div>

@endsection