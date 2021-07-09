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
            <input type="text" class="form-control" name="remitente" id="remitente" pattern="([A-ZÑÁÉÍÓÚ]*[a-zñáéíóú]*|[A-ZÑÁÉÍÓÚ]*[a-zñáéíóú]* [A-ZÑÁÉÍÓÚ]*[a-zñáéíóú]*)" required>
        </div>

        <div class="form-group">
            <label for="destinatario" class="is-required"> Destinatario </label>
            <input type="text" class="form-control" name="destinatario" id="destinatario" pattern="([A-ZÑÁÉÍÓÚ]*[a-zñáéíóú]*|[A-ZÑÁÉÍÓÚ]*[a-zñáéíóú]* [A-ZÑÁÉÍÓÚ]*[a-zñáéíóú]*)" required>
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
@endsection