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
    <a href="{{ url('/taxi/create') }}" class="btn btn-success btn-lg"> Registrar nuevo Taxi</a>
    <br>
    <br>
    <table class="table table-light">

        <thead class="thead-light">
            <tr>
                <th>ID</th>
                <th>Placa</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Año</th>
                <th>Servicio</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            @foreach($taxis as $taxi)
            <tr>
                <?php
                $str = strval($taxi->id);
                for ($i = strlen($str); $i < 3; $i++) {
                    $str = "0" . $str;
                }
                ?>
                <td>{{ $str }}</td>
                <td>{{ $taxi->placa }}</td>
                <td>{{ $taxi->marca }}</td>
                <td>{{ $taxi->modelo }}</td>
                <td>{{ $taxi->year }}</td>
                <td>{{ $taxi->rol }}</td>
                <td>
                    <a href="{{ url('/taxi/'.$taxi->id.'/edit') }}" class="btn btn-primary">
                        Editar
                    </a>
                    |
                    <form action="{{ url('/taxi/'.$taxi->id) }}" class="d-inline" method="post">
                        @csrf
                        {{ method_field('DELETE') }}
                        <input class="btn btn-danger" type="submit" onclick="return confirm('¿Quieres borrar?')" value="Borrar">
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>

    </table>
</div>
@endsection