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
    <a href="{{ url('/taxi/create') }}" class="btn btn-success btn-lg"> Registrar nuevo Taxi</a>
    <br>
    <br>
    <table class="table table-light">

        <thead class="thead-light">
            <tr>
                <th>ID</th>
                <th>Placa</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Año</th>
                <th>Servicio</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            @foreach($taxis as $taxi)
            <tr>
                <?php
                $str = strval($taxi->id);
                for ($i = strlen($str); $i < 3; $i++) {
                    $str = "0" . $str;
                }
                ?>
                <td>{{ $str }}</td>
                <td>{{ $taxi->placa }}</td>
                <td>{{ $taxi->marca }}</td>
                <td>{{ $taxi->modelo }}</td>
                <td>{{ $taxi->year }}</td>
                <td>{{ $taxi->rol }}</td>
                <td>
                    <a href="{{ url('/taxi/'.$taxi->id.'/edit') }}" class="btn btn-primary">
                        Editar
                    </a>
                    |
                    <form action="{{ url('/taxi/'.$taxi->id) }}" class="d-inline" method="post">
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