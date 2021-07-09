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
@endsection