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
@if(Session::has('mensajeexito'))
<div class="alert alert-success" role="alert" style="text-align: center;">
    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
        <use xlink:href="#check-circle-fill" />
    </svg>
    {{ Session::get('mensajeexito') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
<h1 style="text-align: center;">Corridas disponibles</h1>
<div class="row">
    @foreach($corridas as $corrida)

    <div class="col-sm-6">
        <div class="card text-dark bg-light mb-3" style="margin: 10px;">
            <div class="card-body">
                <h5 class="card-title">Hora de salida: {{ $corrida->hora_salida }}</h5>
                <p class="card-text">Origen: San Miguel Suchixtepec</p>
                <p class="card-text">Destino: Miahutlán</p>
                <a href="{{ url('/reservacion/'.$corrida->id.'/asientos') }}" class="btn btn-success">Empezar a reservar</a>
                <a href="{{ url('/reservacion/'.$corrida->id.'/cancelar') }}" class="btn btn-danger">Cancelar reservación</a>
                <a href="{{ url('/reservacion/'.$corrida->id.'/cobrar') }}" class="btn btn-primary">Generar boletos</a>
            </div>
        </div>
    </div>
    @endforeach
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