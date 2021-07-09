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
    <a href="{{ url('/corrida/create') }}" class="btn btn-success btn-lg"> Registrar nueva Corrida</a>
    <br>
    <br>
    <table class="table table-light">

        <thead class="thead-light">
            <tr>
                <th>ID</th>
                <th>Origen</th>
                <th>Destino</th>
                <th>Hora de salida</th>
                <th>Taxi</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            @foreach($corridas as $corrida)
            <tr>
                <?php
                $str = strval($corrida->id);
                for ($i = strlen($str); $i < 3; $i++) {
                    $str = "0" . $str;
                }
                $str2 = strval($corrida->cab_id);
                for ($i = strlen($str2); $i < 3; $i++) {
                    $str2 = "0" . $str2;
                }
                ?>
                <td>{{ $str }}</td>
                <td>{{ $corrida->origen }}</td>
                <td>{{ $corrida->destino }}</td>
                <td>{{ $corrida->hora_salida }}</td>
                <td>{{ $str2 }}</td>
                <td>
                    <a href="{{ url('/corrida/'.$corrida->id.'/edit') }}" class="btn btn-primary">
                        Editar
                    </a>
                    |
                    <form action="{{ url('/corrida/'.$corrida->id) }}" class="d-inline" method="post">
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