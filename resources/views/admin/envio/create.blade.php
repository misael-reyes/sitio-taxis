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

    <form action="{{ url('envio') }}" method="post" style="text-align: center;">
        @csrf
        <h1>Registrar nuevo envío</h1>
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
            <label for="remitente" class="is-required"> Remitente </label>
            <input type="text" class="form-control" name="remitente" id="remitente" pattern="^[\w'\-,.][^0-9_!¡?÷?¿/\\+=@#$%ˆ&*(){}|~<>;:[\]]{2,}$" required>
        </div>

        <div class="form-group">
            <label for="destinatario" class="is-required"> Destinatario </label>
            <input type="text" class="form-control" name="destinatario" id="destinatario" pattern="^[\w'\-,.][^0-9_!¡?÷?¿/\\+=@#$%ˆ&*(){}|~<>;:[\]]{2,}$" required>
        </div>

        <div class="form-group">
            <label class="is-required" for="descripcion"> Descripción del paquete </label>
            <input type="text" class="form-control" name="descripcion" id="descripcion" required>
        </div>

        <div class="form-group">
            <label class="is-required" for="destino"> Destino </label>
            <select class="form-control" name="destino" id="destino" required>
                <option disabled selected value="">Elige una opción</option>
                <option value="Rancho Cañas">Rancho Cañas</option>
                <option value="El Manzanal">El Manzanal</option>
                <option value="San José del Pacífico">San José del Pacífico</option>
                <option value="La Ciénega">La Ciénega</option>
                <option value="Portillo Plaxtán">Portillo Plaxtán</option>
                <option value="Miahuatlán">Miahuatlán</option>
            </select>
        </div>

        <div class="form-group">
            <label for="costo" class="is-required"> Costo </label>
            <input type="number" class="form-control" name="costo" id="costo"  required>
        </div>

        <div class="form-group">
            <label for="estatus_pago" class="is-required"> Estatus del pago </label>
            <select class="form-control" name="estatus_pago" id="estatus_pago" required>
                <option disabled selected value="">Elige una opción</option>
                <option value="pagado">Pagado</option>
                <option value="por pagar">Por Pagar</option>
            </select>
        </div>

        <div class="form-group">
            <label for="corrida_id" class="is-required"> Corrida </label>
            <select class="form-control" name="corrida_id" id="corrida_id" required>
                <option disabled selected value="">Elige la hora</option>
                @foreach($corridas as $corrida)
                <option value="{{ $corrida->id }}">{{ $corrida->hora_salida }}</option>
                @endforeach
            </select>
        </div>

        <div class="ok">
            <input class="btn btn-success" type="submit" value="Guardar datos">
        </div>
        <div class="cancelar">
            <a class="btn btn-danger" href="{{ url('envio/') }}"> Regresar </a>
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