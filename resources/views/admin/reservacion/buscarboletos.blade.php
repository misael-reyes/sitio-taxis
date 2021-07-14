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

    <h2 style="text-align: center; margin:20px;">Cobrar reservaciones</h2>

    <br>
    <form class="form-inline" action="{{ url('/reservacion/'.$corrida->id.'/buscarboleto') }}" method="post" name="frm">
        @csrf
        <div class="form-group mx-auto">
            <label for="first-name" class="is-required" style="margin: 15px; color:white; font-weight: bold;">Nombre del pasajero</label>
            <input type="text" name="cliente" class="form-control" id="first-name" size="30px" autocomplete="off" pattern="^[\w'\-,.][^0-9_!¡?÷?¿/\\+=@#$%ˆ&*(){}|~<>;:[\]]{2,}$" style="margin: 15px;" required>
            <input type="submit" class="btn btn-success" style="margin: 15px;" value="Buscar">
        </div>
    </form>

    <br>

    <table class="table table-light">

        <thead class="thead-light">
            <tr>
                <th>ID de reservación</th>
                <th>Nombre del Pasajero</th>
                <th>Estatus del pago</th>
                <th>Total a pagar</th>
                <th>Fecha de reservación</th>
                <th>Opción</th>
            </tr>
        </thead>

        <tbody>
            @foreach($reservaciones as $reservacion)
            <tr>
                <?php
                $str = strval($reservacion->id);
                for ($i = strlen($str); $i < 3; $i++) {
                    $str = "0" . $str;
                }
                ?>
                <td>{{ $str }}</td>
                <td>{{ $reservacion->cliente }}</td>
                <td>{{ $reservacion->estatus_pago }}</td>
                <td>{{ $reservacion->costo_total }}</td>
                <td>{{ $reservacion->fecha_reservacion }}</td>
                <td>
                    <a href="{{ url('/reservacion/'.$corrida->id.'/'.$reservacion->id.'/boletosapagar') }}" class="btn btn-success">
                        Generar boletos
                    </a>
                </td>

            </tr>
            @endforeach
        </tbody>

    </table>
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <a class="btn btn-danger" href="{{ url('reservacion/') }}"> Regresar </a>
    </div>
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