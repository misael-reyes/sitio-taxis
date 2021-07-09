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
            <input type="text" class="form-control" name="cliente" id="cliente" pattern="([A-ZÑÁÉÍÓÚ]*[a-zñáéíóú]*|[A-ZÑÁÉÍÓÚ]*[a-zñáéíóú]* [A-ZÑÁÉÍÓÚ]*[a-zñáéíóú]*)" required>
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
@endsection