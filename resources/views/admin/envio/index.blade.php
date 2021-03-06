@extends('layouts.app')

@section('content')

@if(Session::has('mensaje'))
<div class="alert alert-danger" role="alert" style="text-align: center;">
    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
        <use xlink:href="#exclamation-triangle-fill" />
    </svg>
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
            <label for="fecha_a_buscar" class="is-required" style="margin: 15px; font-weight: bold; color:white;">Ingrese la fecha</label>
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