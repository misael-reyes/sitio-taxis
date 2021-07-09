@extends('layouts.app')

@section('content')
<?php
$disabled1 = "";
$disabled2 = "";
$disabled3 = "";
$disabled4 = "";

foreach ($consulta as $valor) {
    if ($valor->num_asiento == 1) {
        $disabled1 = "disabled";
    } else if ($valor->num_asiento == 2) {
        $disabled2 = "disabled";
    } else if ($valor->num_asiento == 3) {
        $disabled3 = "disabled";
    } else if ($valor->num_asiento == 4) {
        $disabled4 = "disabled";
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
<div class="container" id="advanced-search-form3">

    <h2>Reservación</h2>
    <h5>Ruta: San Miguel Suchixtepec-Miahuatlán</h5>

        <form action="{{ url('/reservacion/'.$corrida->id.'/boletos') }}" method="post" name="frm">
            @csrf
            <div class="form-group">
                <label for="first-name" class="is-required">Nombre completo</label>
                <input type="text" name="cliente" class="form-control" id="first-name" autocomplete="off" pattern="([A-ZÑÁÉÍÓÚ]*[a-zñáéíóú]*|[A-ZÑÁÉÍÓÚ]*[a-zñáéíóú]* [A-ZÑÁÉÍÓÚ]*[a-zñáéíóú]*)" required>

            </div>

            <div class="form-group2">
                <label>Hora de salida</label>
                <input type="text" name="hora_salida" readonly="true" class="form-control" id="country" value="{{ $corrida->hora_salida }}">
            </div>

            <div class="form-group2">
                <label>Estatus del pago</label>
                <select style="height: 35px;" name="estatus_pago" required>
                    <option disabled selected value="">Elige una opción</option>
                    <option value="pagado">Pagado</option>
                    <option value="apartado">Apartado</option>
                </select>
            </div>

            
            <img src="/dash/img/taxi_vertical2.png" width="230" height="390" style="margin-left: 100px;">
        
            <br>

            <div class="origen2">

                <label for="destino1">Seleccione el destino</label>
                <br>
                <select name="destino_intermedio" id="destino1" onchange="condiciones(this.value)" required>
                    <option disabled selected value="">Elige una opción</option>
                    @foreach($intermedios as $intermedio)
                    <option value="{{ $intermedio->destino_intermedio }}">{{ $intermedio->destino_intermedio }}</option>
                    @endforeach
                </select>
                <br>
                <label for="">Seleccione los asientos</label>
                <br>
                <div class="form-check form-check-inline">

                    <input class="form-check-input" name="num_asiento1" onclick="calcularTotal(this)" type="checkbox" value="1" id="inlineCheckbox1" {{$disabled1}}>

                    <label class="form-check-label" for="inlineCheckbox1" style="margin-right: 20px;">
                        1
                    </label>
                    <input class="form-check-input" name="num_asiento2" onclick="calcularTotal(this)" type="checkbox" value="2" id="inlineCheckbox2" {{$disabled2}}>
                    <label class="form-check-label" for="inlineCheckbox2" style="margin-right: 20px;">
                        2
                    </label>
                    <input class="form-check-input" name="num_asiento3" onclick="calcularTotal(this)" type="checkbox" value="3" id="inlineCheckbox3" {{$disabled3}}>
                    <label class="form-check-label" for="inlineCheckbox3" style="margin-right: 20px;">
                        3
                    </label>
                    <input class="form-check-input" name="num_asiento4" onclick="calcularTotal(this)" type="checkbox" value="4" id="inlineCheckbox4" {{$disabled4}}>
                    <label class="form-check-label" for="inlineCheckbox4">
                        4
                    </label>

                </div>
                <br>
                <br>

                <label>Total</label>
                <input type="text" class="form-control" readonly="true" id="toto" name="total" value="0">

            </div>

            <div class="ok3">
                <input class="btn btn-success" type="submit" value="Reservar">
            </div>

            <div class="cancelar3">
                <a class="btn btn-danger" href="{{ url('reservacion/') }}"> Regresar </a>
            </div>

        </form>
        <!--
    <form>
        <select name="country" onchange="hola()">
            <option value="" disabled selected>--select--</option>
            <option value="india">India</option>
            <option value="us">Us</option>
            <option value="europe">Europe</option>
        </select>
    </form>
    -->
        <script>
            let costo_total = 0;
            let costo_unitario = 0;

            function calcularTotal(element) {

                if (element.checked) {
                    costo_total += costo_unitario;

                } else {
                    costo_total -= costo_unitario;
                }

                document.getElementById("toto").value = costo_total;
            }

            function condiciones(cod) {

                document.getElementById("toto").value = 0;
                document.getElementById("inlineCheckbox1").checked = false;
                document.getElementById("inlineCheckbox2").checked = false;
                document.getElementById("inlineCheckbox3").checked = false;
                document.getElementById("inlineCheckbox4").checked = false;
                costo_total = 0;

                switch (cod) {
                    case "Miahuatlán":
                        costo_unitario = 50;
                        break;
                    case "Portillo Plaxtlán":
                        costo_unitario = 40;
                        break;
                    case "La Ciénega":
                        costo_unitario = 35;
                        break;
                    case "San José del Pacífico":
                        costo_unitario = 30;
                        break;
                    case "El Manzanal":
                        costo_unitario = 20;
                        break;
                    case "Rancho Cañas":
                        costo_unitario = 10;
                        break;
                    default:
                        //
                        break;
                }
            }
        </script>

</div>


@endsection