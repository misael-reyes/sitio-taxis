@extends('layouts.app')

@section('content')
<div class="container" id="advanced-search-form">

    @if(Session::has('mensaje'))
    <div class="alert alert-danger" role="alert">
        {{ Session::get('mensaje') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <form action="{{ url('viaje') }}" method="post" style="text-align: center;">
        @csrf
        <h1>Registrar nuevo viaje especial</h1>
        <br>
        @if(count($errors)>0)
        <div class="alert alert-danger" role="alert">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="form-group">
            <label for="cliente" class="is-required"> Nombre del cliente </label>
            <input type="text" class="form-control" name="cliente" id="cliente" pattern="^[\w'\-,.][^0-9_!¡?÷?¿/\\+=@#$%ˆ&*(){}|~<>;:[\]]{2,}$" required>
        </div>

        <div class="form-group">
            <label for="cab_id" class="is-required"> Taxi </label>
            <select class="form-control" name="cab_id" id="cab_id" required>
                <option disabled selected value="">Elige una opción</option>
                @foreach($taxis as $taxi)
                <?php
                $str = strval($taxi->id);
                for ($i = strlen($str); $i < 3; $i++) {
                    $str = "0" . $str;
                }
                ?>
                <option value="{{ $taxi->id }}">{{ $str }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label class="is-required" for="origen"> Origen </label>
            <input type="text" class="form-control" name="origen" id="origen" pattern="([A-ZÑÁÉÍÓÚ]*[a-zñáéíóú]*|[A-ZÑÁÉÍÓÚ]*[a-zñáéíóú]* [A-ZÑÁÉÍÓÚ]*[a-zñáéíóú]*)" required>
        </div>

        <div class="form-group">
            <label for="destino" class="is-required"> Destino </label>
            <input type="text" class="form-control" name="destino" id="destino"  pattern="([A-ZÑÁÉÍÓÚ]*[a-zñáéíóú]*|[A-ZÑÁÉÍÓÚ]*[a-zñáéíóú]* [A-ZÑÁÉÍÓÚ]*[a-zñáéíóú]*)" required>
        </div>

        <div class="form-group">
            <label for="fecha_inicio" class="is-required"> Fecha de inicio </label>
            <input type="date" class="form-control" name="fecha_inicio" id="fecha_inicio" required>
        </div>

        <div class="form-group">
            <label for="fecha_final" class="is-required"> Fecha final </label>
            <input type="date" class="form-control" name="fecha_final" id="fecha_final" required>
        </div>

        <div class="form-group">
            <label for="costo" class="is-required"> Costo total </label>
            <input type="number" class="form-control" name="costo" id="costo" required>
        </div>

        <div class="ok">
            <input class="btn btn-success" type="submit" value="Guardar datos">
        </div>
        <div class="cancelar">
            <a class="btn btn-danger" href="{{ url('viaje/') }}"> Regresar </a>
        </div>
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