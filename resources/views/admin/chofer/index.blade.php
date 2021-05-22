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
    <a href="{{ url('/chofer/create') }}" class="btn btn-success btn-lg"> Registrar nuevo Chofer</a>
    <br>
    <br>
    <table class="table table-light">

        <thead class="thead-light">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Primer apellido</th>
                <th>Segundo apellido</th>
                <th>Celular</th>
                <th>Calle</th>
                <th>Número</th>
                <th>Localidad</th>
                <th>Taxi</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            @foreach($choferes as $chofer)
            <tr>
                <?php
                $str = strval($chofer->id);
                for ($i = strlen($str); $i < 3; $i++) {
                    $str = "0" . $str;
                }
                $str2 = strval($chofer->cab_id);
                for ($i = strlen($str2); $i < 3; $i++) {
                    $str2 = "0" . $str2;
                }
                ?>
                <td>{{ $str }}</td>
                <td>{{ $chofer->nombre }}</td>
                <td>{{ $chofer->apellidoPaterno }}</td>
                <td>{{ $chofer->apellidoMaterno }}</td>
                <td>{{ $chofer->num_celular }}</td>
                <td>{{ $chofer->dir_calle }}</td>
                <td>{{ $chofer->dir_numero }}</td>
                <td>{{ $chofer->dir_localidad }}</td>
                <td>{{ $str2 }}</td>
                <td>
                    <a href="{{ url('/chofer/'.$chofer->id.'/edit') }}" class="btn btn-primary">
                        Editar
                    </a>
                    |
                    <form action="{{ url('/chofer/'.$chofer->id) }}" class="d-inline" method="post">
                        @csrf
                        {{ method_field('DELETE') }}
                        <input class="btn btn-danger" type="submit" onclick="return confirm('¿Quieres borrar?')" value="Borrar">
                    </form>
                </td>
                <td></td>
            </tr>
            @endforeach
        </tbody>

    </table>
</div>
@endsection