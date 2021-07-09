@extends('layouts.app')

@section('content')
<?php
$disabled1 = "disabled";
$disabled2 = "disabled";
$disabled3 = "disabled";
$disabled4 = "disabled";

foreach ($asientos as $valor) {
    if ($valor->num_asiento == 1) {
        $disabled1 = "";
    } else if ($valor->num_asiento == 2) {
        $disabled2 = "";
    } else if ($valor->num_asiento == 3) {
        $disabled3 = "";
    } else if ($valor->num_asiento == 4) {
        $disabled4 = "";
    }
}
?>
@if(Session::has('mensaje'))
<div class="alert alert-danger" role="alert">
    {{ Session::get('mensaje') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
<div class="container">

    <h2 style="text-align: center; margin:20px;">Cancelación de asientos</h2>

    <br>
    <form class="form-inline" action="{{ url('/reservacion/'.$corrida->id.'/buscar') }}" method="post" name="frm">
        @csrf
        
        
        <div class="form-group mx-auto">
            <label for="first-name" class="is-required" style="margin: 15px;">Nombre del cliente</label>
            <input type="text" name="cliente" class="form-control" id="first-name" size="30px" autocomplete="off" pattern="([A-ZÑÁÉÍÓÚ]*[a-zñáéíóú]*|[A-ZÑÁÉÍÓÚ]*[a-zñáéíóú]* [A-ZÑÁÉÍÓÚ]*[a-zñáéíóú]*)" style="margin: 15px;" required>
            <input type="submit" class="btn btn-success" style="margin: 15px;" value="Buscar">
        </div>
    
    </form>

    <br>

    <table class="table table-light">

        <thead class="thead-light">
            <tr>
                <th>ID de reservación</th>
                <th>Nombre del Cliente</th>
                <th>Número de asiento</th>
                <th>Opción</th>
            </tr>
        </thead>

        <tbody>
            @foreach($asientos as $asiento)
            <tr>
                <?php
                $str = strval($asiento->id);
                for ($i = strlen($str); $i < 3; $i++) {
                    $str = "0" . $str;
                }
                ?>
                <td>{{ $str }}</td>
                <td>{{ $asiento->cliente }}</td>
                <td>Asiento {{ $asiento->num_asiento }}</td>
                <td>
                    <form action="{{ url('/reservacion/'.$corrida->id.'/cancelacion') }}" class="d-inline" method="post">
                        {{ method_field('PATCH') }}
                        @csrf
                        <input type="hidden" id="sistema" name="id_reservacion" value="{{ $asiento->id }}"/>
                        <input type="hidden" id="sistema" name="asien" value="{{ $asiento->num_asiento }}"/>
                        <input type="hidden" id="sistema" name="name" value="{{ $asiento->cliente }}"/>
                        <input class="btn btn-danger" type="submit" onclick="return confirm('¿Estas seguro de cancelar?')" value="Cancelar">
                    </form>
                </td>

            </tr>
            @endforeach
        </tbody>

    </table>
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <a class="btn btn-danger" href="{{ url('reservacion/') }}"> Regresar </a>
    </div>
</div>
@endsection