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