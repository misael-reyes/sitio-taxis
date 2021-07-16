@extends('layouts.app')

@section('content')
<h1 style="text-align: center;">Boletos</h1>

<div class="row row-cols-1 row-cols-md-3 mx-auto">
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


    @for($i = 0; $i < $boletosAgenerar; $i++) <div class="col-sm-3 mx-auto">
        <div class="card h-100">
            <div class="card-body" id="tarjeta">
                <h4 class="card-title">Sitio de taxis YII-YEE</h4>
                <p class="card-text">Id de reservación: {{ $id_registro }}</p>
                <p class="card-text" style="font-weight: bold;">Pasajero: {{ $datos2["cliente"] }}</p>
                @if (isset($datos2["num_asiento1"]) && $bandera1 == true)
                <p class="card-text">Número de asiento: {{ $datos2["num_asiento1"] }}</p>
                <p class="card-text">Origen: San Miguel Suchixtepec</p>
                <p class="card-text">Destino: {{ $datos2["destino_intermedio"] }}</p>
                <p class="card-text">Costo: $ {{ costo($datos2["destino_intermedio"]) }}</p>
                @php($bandera1 = false)
                @elseif (isset($datos2["num_asiento2"]) && $bandera2 == true)
                <p class="card-text">Número de asiento: {{ $datos2["num_asiento2"] }}</p>
                <p class="card-text">Origen: San Miguel Suchixtepec</p>
                <p class="card-text">Destino: {{ $datos2["destino_intermedio"] }}</p>
                <p class="card-text">Costo: $ {{ costo($datos2["destino_intermedio"]) }}</p>
                @php($bandera2 = false)
                @elseif (isset($datos2["num_asiento3"]) && $bandera3 == true)
                <p class="card-text">Número de asiento: {{ $datos2["num_asiento3"] }}</p>
                <p class="card-text">Origen: San Miguel Suchixtepec</p>
                <p class="card-text">Destino: {{ $datos2["destino_intermedio"] }}</p>
                <p class="card-text">Costo: $ {{ costo($datos2["destino_intermedio"]) }}</p>
                @php($bandera3 = false)
                @else
                <p class="card-text">Número de asiento: {{ $datos2["num_asiento4"] }}</p>
                <p class="card-text">Origen: San Miguel Suchixtepec</p>
                <p class="card-text">Destino: {{ $datos2["destino_intermedio"] }}</p>
                <p class="card-text">Costo: $ {{ costo($datos2["destino_intermedio"]) }}</p>
                @php($bandera4 = false)
                @endif
                <p class="card-text">hora salida: {{ $datos2["hora_salida"] }}</p>
                <br>
                <p>Se le solicita estar al pendiente de su hora de salida, ya que no hay cambios ni devoluciones</p>
                <p>No pierda su boleto, ya que es su pase de abordar</p>
                <p>Se le invita a realizar el pago de su boleto en ventanilla 10 minutos antes de su viaje</p>
                <h4 class="card-text">GRACIAS POR SU PREFERENCIA</h4>
            </div>
        </div>
</div>
@endfor
</div>

<div class="d-grid gap-2 d-md-flex justify-content-md-end" style="margin: 50px;">
    <a class="btn btn-success" href="{{ url('reservacion/') }}" style="margin: 0px 10px;">Imprimir Boletos</a>
    <form action="{{ url('/reservacion/'.$id_registro.'/guardar') }}" class="d-inline" method="post">
        @csrf
        {{ method_field('PATCH') }}
        <input class="btn btn-primary" type="submit" value="Reservar Boletos" style="margin: 0px 10px;">
    </form>
</div>
<script>
    var myVar = setInterval(function() {
        myTimer()
    }, 1000);

    function myTimer() {
        var hora = new Date();
        var myhora = hora.toLocaleTimeString();
        
        let hoursActive = ['7:50:00','8:20:00','8:50:00','9:20:00','9:50:00',
        '10:20:00','10:50:00','11:20:00','11:50:00','12:20:00','12:50:00',
        '13:20:00','13:50:00','14:20:00','14:50:00','15:20:00','15:50:00',
        '16:20:00','16:50:00','17:20:00','17:50:00'];

        if (hoursActive.includes(myhora)) {
            let continuar = confirm("La corrida de las " + " " + myhora + " " + "está proxima a salir, verifique que todas las reservaciones se hayan pagado");
            if(continuar){
                window.location='/reservacion'; 
            }
        }
    }
</script>
@endsection