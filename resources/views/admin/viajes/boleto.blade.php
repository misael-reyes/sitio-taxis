@extends('layouts.app')

@section('content')
<h1 style="text-align: center;">Boleto del viaje</h1>


    <div class="col-sm-3 mx-auto">
        <div class="card h-100">
            <div class="card-body" id="tarjeta">
                <h4 class="card-title">Sitio de taxis YII-YEE</h4>
                <p class="card-text">pasajero: {{ $datos["cliente"] }}</p>
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
                <br>
                <p>Se le solicita estar al pendiente de su hora de salida, ya que no hay cambios ni devoluciones</p>
                <p>No pierda su boleto, ya que es su pase de abordar</p>
                <p>Se le invita a realizar el pago de su boleto en ventanilla 10 min antes de su viaje</p>
                <h4 class="card-text">GRACIAS POR SU PREFERENCIA</h4>
            </div>
        </div>
    </div>


<div class="d-grid gap-2 d-md-flex justify-content-md-center">
    <a class="btn btn-success" href="{{ url('viaje/') }}" style="margin-top: 40px;">Imprimir Boleto</a>
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
            let continuar = confirm("La corrida de las " + " " + myhora + " " + "est?? proxima a salir, verifique que todas las reservaciones se hayan pagado");
            if(continuar){
                window.location='/reservacion'; 
            }
        }
    }
</script>
@endsection