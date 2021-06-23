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
<div class="container" id="advanced-search-form">

    <h2>Cancelación de asientos</h2>

    <form action="{{ url('/reservacion/'.$corrida->id.'/cancelacion') }}" method="post" name="frm">
        {{ method_field('PATCH') }}
        @csrf
        <div class="form-group">
            <label for="first-name" class="is-required">Nombre del cliente</label>
            <input type="text" name="cliente" class="form-control" id="first-name" autocomplete="off" pattern="([A-ZÑÁÉÍÓÚ]*[a-zñáéíóú]*|[A-ZÑÁÉÍÓÚ]*[a-zñáéíóú]* [A-ZÑÁÉÍÓÚ]*[a-zñáéíóú]*)" required>

        </div>

        <div class="form-group2">
            <label>Hora de salida</label>
            <input type="text" name="hora_salida" readonly="true" class="form-control" id="country" value="{{ $corrida->hora_salida }}">
        </div>

        <img src="/dash/img/vehiculo.png" width="400" height="270">
        <br>

        <div class="origen">
            <label for="">Seleccione los asientos a cancelar</label>
            <div class="form-check">
                <input class="form-check-input" name="num_asiento1" type="checkbox" value="1" id="flexCheckDefault" {{$disabled1}}>

                <label class="form-check-label" for="flexCheckDefault">
                    1
                </label>
            </div>
            <br>
            <div class="form-check">

                <input class="form-check-input" name="num_asiento2" type="checkbox" value="2" id="flexCheckChecked" {{$disabled2}}>
                <label class="form-check-label" for="flexCheckChecked">
                    2
                </label>
            </div>
            <br>
            <div class="form-check">
                <input class="form-check-input" name="num_asiento3" type="checkbox" value="3" id="flexCheckDefault" {{$disabled3}}>
                <label class="form-check-label" for="flexCheckDefault">
                    3
                </label>
            </div>
            <br>
            <div class="form-check">
                <input class="form-check-input" name="num_asiento4" type="checkbox" value="4" id="flexCheckChecked" {{$disabled4}}>
                <label class="form-check-label" for="flexCheckChecked">
                    4
                </label>
            </div>
            <br>

        </div>

        <div class="ok3">
            <input class="btn btn-success" type="submit" value="Cancelación">
        </div>

        <div class="cancelar3">
            <a class="btn btn-danger" href="{{ url('reservacion/') }}"> Regresar </a>
        </div>

    </form>
</div>
@endsection