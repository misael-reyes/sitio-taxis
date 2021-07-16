@extends('layouts.app')

@section('content')
<h1 style="text-align: center;">Boletos</h1>

<div class="row row-cols-1 row-cols-md-3 mx-auto">
    @foreach($asientos as $asiento)
    <div class="col-sm-3 mx-auto">
        <div class="card h-100">
            <div class="card-body" id="tarjeta">
                <h4 class="card-title">Sitio de taxis YII-YEE</h4>
                <p class="card-text">Id de reservación: {{ $reservacion->id }}</p>
                <p class="card-text">Pasajero: {{ $reservacion->cliente }}</p>
                
                <p class="card-text">Número de asiento: {{ $asiento->num_asiento }}</p>
                <p class="card-text">Origen: San Miguel Suchixtepec</p>
                <p class="card-text">Destino: {{ $precio[0]->destino_intermedio }}</p>
                <p class="card-text">Costo: $ {{ $precio[0]->precio_unitario }}</p>
                
                <p class="card-text">Hora salida: {{ $corrida->hora_salida }}</p>
                <br>
                <p>Se le solicita estar al pendiente de su hora de salida, ya que no hay cambios ni devoluciones</p>
                <p>No pierda su boleto, ya que es su pase de abordar</p>
                <p>Se le invita a realizar el pago de su boleto en ventanilla 10 min antes de su viaje</p>
                <h4 class="card-text">GRACIAS POR SU PREFERENCIA</h4>
            </div>
        </div>
    </div>
    @endforeach
</div>

<div class="d-grid gap-2 d-md-flex justify-content-md-center" style="margin: 50px;">
    <a class="btn btn-success" href="{{ url('reservacion/') }}" style="margin: 0px 10px;">Imprimir Boletos</a>
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