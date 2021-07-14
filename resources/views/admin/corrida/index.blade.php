@extends('layouts.app')

@section('content')
<div class="container">
    @if(Session::has('mensaje'))
    <div class="alert alert-success" role="alert" style="text-align: center;">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
            <use xlink:href="#check-circle-fill" />
        </svg>
        {{ Session::get('mensaje') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <br>
    <a href="{{ url('/corrida/create') }}" class="btn btn-success btn-lg"> Registrar nueva Corrida</a>
    <br>
    <br>
    <table class="table table-light">

        <thead class="thead-light">
            <tr>
                <th>ID</th>
                <th>Origen</th>
                <th>Destino</th>
                <th>Hora de salida</th>
                <th>Taxi</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            @foreach($corridas as $corrida)
            <tr>
                <?php
                $str = strval($corrida->id);
                for ($i = strlen($str); $i < 3; $i++) {
                    $str = "0" . $str;
                }
                $str2 = strval($corrida->cab_id);
                for ($i = strlen($str2); $i < 3; $i++) {
                    $str2 = "0" . $str2;
                }
                ?>
                <td>{{ $str }}</td>
                <td>{{ $corrida->origen }}</td>
                <td>{{ $corrida->destino }}</td>
                <td>{{ $corrida->hora_salida }}</td>
                <td>{{ $str2 }}</td>
                <td>
                    <a href="{{ url('/corrida/'.$corrida->id.'/edit') }}" class="btn btn-primary">
                        Editar
                    </a>
                    |
                    <form action="{{ url('/corrida/'.$corrida->id) }}" class="d-inline" method="post">
                        @csrf
                        {{ method_field('DELETE') }}
                        <input class="btn btn-danger" type="submit" onclick="return confirm('¿Quieres borrar?')" value="Borrar">
                    </form>
                </td>
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

        let hoursActive = ['7:50:00', '8:20:00', '8:50:00', '9:20:00', '9:50:00',
            '10:20:00', '10:50:00', '11:20:00', '11:50:00', '12:20:00', '12:50:00',
            '13:20:00', '13:50:00', '14:20:00', '14:50:00', '15:20:00', '15:50:00',
            '16:20:00', '16:50:00', '17:20:00', '17:50:00'
        ];

        if (hoursActive.includes(myhora)) {
            let continuar = confirm("La corrida de las " + " " + myhora + " " + "está proxima a salir, verifique que todas las reservaciones se hayan pagado");
            if (continuar) {
                window.location = '/reservacion';
            }
        }
    }
</script>
@endsection