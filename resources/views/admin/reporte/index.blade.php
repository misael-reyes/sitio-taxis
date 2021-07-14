@extends('layouts.app')

@section('content')
<div class="container">
    @if(Session::has('mensaje'))
    <div class="alert alert-success alert-dismissible" role="alert">
        {{ Session::get('mensaje') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <br>
    <h1 style="text-align: center;">Reportes del sistema</h1>
    <br>
    <br>
    <table class="table table-light mx-auto" style="width: 50%;">

        <thead class="thead-light">
            <tr align="center">
                <th>Número</th>
                <th>Nombre de la tabla</th>
                <th>Acción</th>
            </tr>
        </thead>

        <tbody>
            <tr align="center">
                <td>1</td>
                <td>Reservaciones</td>
                <td>
                    <a href="{{ url('/reporte/reservaciones') }}" class="btn btn-success">Descargar</a>
                </td>
            </tr>
            <tr align="center">
                <td>2</td>
                <td>Detalle de las Reservaciones</td>
                <td>
                    <a href="{{ url('/reporte/detallesReservaciones') }}" class="btn btn-success">Descargar</a>
                </td>
            </tr>
            <tr align="center">
                <td>3</td>
                <td>Envíos</td>
                <td>
                    <a href="{{ url('/reporte/envios') }}" class="btn btn-success">Descargar</a>
                </td>
            </tr>
            <tr align="center">
                <td>4</td>
                <td>Viajes Especiales</td>
                <td>
                    <a href="{{ url('/reporte/viajes') }}" class="btn btn-success">Descargar</a>
                </td>
            </tr>
            <tr align="center">
                <td>5</td>
                <td>Taxis</td>
                <td>
                    <a href="{{ url('/reporte/taxis') }}" class="btn btn-success">Descargar</a>
                </td>
            </tr>
            <tr align="center">
                <td>6</td>
                <td>Corridas</td>
                <td>
                    <a href="{{ url('/reporte/corridas') }}" class="btn btn-success">Descargar</a>
                </td>
            </tr>
            <tr align="center">
                <td>7</td>
                <td>Choferes</td>
                <td>
                    <a href="{{ url('/reporte/choferes') }}" class="btn btn-success">Descargar</a>
                </td>
            </tr>
            <tr align="center">
                <td>8</td>
                <td>Usuarios</td>
                <td>
                    <a href="{{ url('/reporte/usuarios') }}" class="btn btn-success">Descargar</a>
                </td>
            </tr>
            <!--
            <tr align="center">
                <td>9</td>
                <td>Taxis Eliminados</td>
                <td>
                    <form action="" class="d-inline">
                        <input class="btn btn-success" type="submit" value="Imprimir">
                    </form>
                </td>
            </tr>
            <tr align="center">
                <td>10</td>
                <td>Corridas Eliminadas</td>
                <td>
                    <form action="" class="d-inline">
                        <input class="btn btn-success" type="submit" value="Imprimir">
                    </form>
                </td>
            </tr>
            <tr align="center">
                <td>11</td>
                <td>Choferes Eliminados</td>
                <td>
                    <form action="" class="d-inline">
                        <input class="btn btn-success" type="submit" value="Imprimir">
                    </form>
                </td>
            </tr>
-->
        </tbody>

    </table>
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