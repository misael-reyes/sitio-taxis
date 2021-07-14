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
<div class="alert alert-warning" role="alert" style="text-align: center;">
    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
        <use xlink:href="#exclamation-triangle-fill" />
    </svg>
    {{ Session::get('mensaje') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
<div class="container" id="advanced-search-form2">

    <h2>Reservación</h2>
    <h5 style="text-align: center;">Ruta: San Miguel Suchixtepec-Miahuatlán</h5>

    <form action="{{ url('/reservacion/'.$corrida->id.'/boletos') }}" method="post" name="frm">
        @csrf
        <div class="form-group">
            <label for="hora_salida">Hora de salida</label>
            <input type="text" name="hora_salida" readonly="true" class="form-control" id="country" value="{{ $corrida->hora_salida }}">
        </div>

        <div class="form-group">
            <label for="origen">Origen</label>

            <input type="text" name="origen" readonly="false" class="form-control" id="origen" value="{{ $corrida->origen }}">
        </div>

        <div class="form-group">
            <label for="destino" class="is-required">Destino</label>
            <select name="destino_intermedio" id="destino" onchange="condiciones(this.value); mostrarFormulario()" required style="height: 35px;">
                <option disabled selected value="">Elige una opción</option>
                @foreach($intermedios as $intermedio)
                <option value="{{ $intermedio->destino_intermedio }}">{{ $intermedio->destino_intermedio }}</option>
                @endforeach
            </select>
        </div>
        <img src="/dash/img/taxifinal.png" width="230" height="390" style="margin-left: 100px;">
        <br>
        <div class="origen2" id="formulario">
            <label for="cliente" class="is-required">Nombre completo</label>
            <br>
            <input type="text" name="cliente" class="form-control" id="first-name" autocomplete="off" 
            pattern="^[\w'\-,.][^0-9_!¡?÷?¿/\\+=@#$%ˆ&*(){}|~<>;:[\]]{2,}$" required>
            <br>
            <label for="">Seleccione los asientos</label>
            <br>
            <div class="form-check form-check-inline">

                <input class="form-check-input" name="num_asiento1" onclick="calcularTotal(this)" type="checkbox" value="1" id="inlineCheckbox1" {{$disabled1}}>

                <label class="form-check-label" for="inlineCheckbox1" style="margin-right: 45px;">
                    1
                </label>
                <input class="form-check-input" name="num_asiento2" onclick="calcularTotal(this)" type="checkbox" value="2" id="inlineCheckbox2" {{$disabled2}}>
                <label class="form-check-label" for="inlineCheckbox2" style="margin-right: 45px;">
                    2
                </label>
                <input class="form-check-input" name="num_asiento3" onclick="calcularTotal(this)" type="checkbox" value="3" id="inlineCheckbox3" {{$disabled3}}>
                <label class="form-check-label" for="inlineCheckbox3" style="margin-right: 45px;">
                    3
                </label>
                <input class="form-check-input" name="num_asiento4" onclick="calcularTotal(this)" type="checkbox" value="4" id="inlineCheckbox4" {{$disabled4}}>
                <label class="form-check-label" for="inlineCheckbox4">
                    4
                </label>

            </div>
            <br>
            <br>
            <br>
            <label form="costo_unitario">Costo unitario: $ </label>
            <input type="text" class="form-control-inline" readonly="true" id="costo_unitario" name="costo_unitario" value="0" style="border:none;background:none;color:white;width:30%">
            <label>MXN</label>
            <br>

            <label form="toto">Total: $</label>
            <input type="text" class="form-control-inline" readonly="true" id="toto" name="total" value="0" style="border:none;background:none;color:white;width:30%">
            <label>MXN</label>

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
            document.getElementById("costo_unitario").value = costo_unitario;
        }

        function mostrarFormulario() {
            document.getElementById("formulario").style.visibility = 'visible';
        }

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

</div>


@endsection