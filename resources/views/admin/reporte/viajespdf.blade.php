<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <title>Viajes especiales</title>
</head>

<body>
    <h1 style="text-align: center;">Datos de los viajes especiales</h1>
    <table class="table table-light">

        <thead class="thead-light">
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Fecha inicio</th>
                <th>Fecha final</th>
                <th>Origen</th>
                <th>Destino</th>
                <th>Costo</th>
                <th>Taxi</th>
            </tr>
        </thead>

        <tbody>
            @foreach($datos as $dato)
            <tr>
                <?php
                $str = strval($dato->id);
                for ($i = strlen($str); $i < 3; $i++) {
                    $str = "0" . $str;
                }
                $str2 = strval($dato->cab_id);
                for ($i = strlen($str2); $i < 3; $i++) {
                    $str2 = "0" . $str2;
                }
                ?>
                <td>{{ $str }}</td>
                <td>{{ $dato->cliente }}</td>
                <td>{{ $dato->fecha_inicio }}</td>
                <td>{{ $dato->fecha_final }}</td>
                <td>{{ $dato->origen }}</td>
                <td>{{ $dato->destino }}</td>
                <td>{{ $dato->costo }}</td>
                <td>{{ $str2 }}</td>
            </tr>
            @endforeach
        </tbody>

    </table>
</body>

</html>