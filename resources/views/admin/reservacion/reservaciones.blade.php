@extends('layouts.app')

@section('content')
<?php
    $disabled1 = "";
    $disabled2 = "";
    $disabled3 = "";
    $disabled4 = "";

    foreach($consulta as $valor){
        if($valor->num_asiento == 1){
            $disabled1 = "disabled";
        } else if($valor->num_asiento == 2){
            $disabled2 = "disabled";
        } else if($valor->num_asiento == 3){
            $disabled3 = "disabled";
        } else if($valor->num_asiento == 4){
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
<div class="container" id="advanced-search-form">

    <h2>Reservación</h2>

    <form action="{{ url('/reservacion/'.$corrida->id.'/boletos') }}" method="post" name="frm">
        @csrf
        <div class="form-group">
            <label for="first-name" class="is-required">Cliente</label>
            <input type="text" name="cliente" class="form-control" id="first-name" autocomplete="off" pattern="([A-ZÑÁÉÍÓÚ]*[a-zñáéíóú]*|[A-ZÑÁÉÍÓÚ]*[a-zñáéíóú]* [A-ZÑÁÉÍÓÚ]*[a-zñáéíóú]*)" required>

        </div>

        <div class="form-group2">
            <label>Hora de salida</label>
            <input type="text" name="hora_salida" readonly="true" class="form-control" id="country" value="{{ $corrida->hora_salida }}">
        </div>

        <div class="form-group2">
            <label>Estatus del pago</label>
            <select style="height: 35px;" name="estatus_pago">
                <option value="pagado">Pagado</option>
                <option value="por pagar">Por Pagar</option>
            </select>
        </div>



        <img src="/dash/img/vehiculo.png" width="400" height="270">
        <br>

        <div class="origen">
        
            <label for="">Seleccione los asientos</label>
            <div class="form-check">
                <input class="form-check-input" name="num_asiento1" type="checkbox" value="1" id="flexCheckDefault" 
                onclick="JavaScript:document.frm.destino_intermedio1.disabled = !this.checked" {{$disabled1}}>

                <label class="form-check-label" for="flexCheckDefault">
                    1
                </label>
                
                <select name="destino_intermedio1" disabled id="destino1" onchange="calcularTotal(this.value, 1)" required>
                    <option></option>
                    @foreach($intermedios as $intermedio)
                    <option value="{{ $intermedio->destino_intermedio }}">{{ $intermedio->destino_intermedio }}</option>
                    @endforeach
                </select>
                
            </div>
            <br>
            <div class="form-check">
                
                <input class="form-check-input" name="num_asiento2" type="checkbox" value="2" id="flexCheckChecked" 
                onclick="JavaScript:document.frm.destino_intermedio2.disabled = !this.checked" {{$disabled2}}>
                <label class="form-check-label" for="flexCheckChecked">
                    2
                </label>
                
                <select name="destino_intermedio2" disabled id="destino2" onchange="calcularTotal(this.value, 2)" required>
                    <option></option>
                    @foreach($intermedios as $intermedio)
                    <option value="{{ $intermedio->destino_intermedio }}">{{ $intermedio->destino_intermedio }}</option>
                    @endforeach
                </select>
                
            </div>
            <br>
            <div class="form-check">
                <input class="form-check-input" name="num_asiento3" type="checkbox" value="3" id="flexCheckDefault" 
                onclick="JavaScript:document.frm.destino_intermedio3.disabled = !this.checked" {{$disabled3}}>
                <label class="form-check-label" for="flexCheckDefault">
                    3
                </label>
                
                <select name="destino_intermedio3" disabled id="destino3" onchange="calcularTotal(this.value, 3)" required>
                    <option></option>
                    @foreach($intermedios as $intermedio)
                    <option value="{{ $intermedio->destino_intermedio }}">{{ $intermedio->destino_intermedio }}</option>
                    @endforeach
                </select>
                
            </div>
            <br>
            <div class="form-check">
                <input class="form-check-input" name="num_asiento4" type="checkbox" value="4" id="flexCheckChecked" 
                onclick="JavaScript:document.frm.destino_intermedio4.disabled = !this.checked" {{$disabled4}}>
                <label class="form-check-label" for="flexCheckChecked">
                    4
                </label>
                
                <select name="destino_intermedio4" disabled id="destino4" onchange="calcularTotal(this.value, 4)" required>
                    <option></option>
                    @foreach($intermedios as $intermedio)
                    <option value="{{ $intermedio->destino_intermedio }}">{{ $intermedio->destino_intermedio }}</option>
                    @endforeach
                </select>
                
            </div>
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
        let ultimo = 0;
        let select1 = 0;
        let select2 = 0;
        let select3 = 0;
        let select4 = 0;

        function calcularTotal(cod, num) {

            if (num == 1) {
                condiciones(cod);
                select1 = costo_unitario;
            } else if (num == 2) {
                condiciones(cod);
                select2 = costo_unitario;
            } else if (num == 3) {
                condiciones(cod);
                select3 = costo_unitario;
            } else if (num == 4) {
                condiciones(cod);
                select4 = costo_unitario;
            }

            costo_total = select1 + select2 + select3 + select4;

            document.getElementById("toto").value = costo_total;
        }

        function condiciones(cod) {
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