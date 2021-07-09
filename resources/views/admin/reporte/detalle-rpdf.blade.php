<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <title>Detalles de las reservaciones</title>
</head>

<body>
    <h1 style="text-align: center;">Datos de los detalles de las reservaciones</h1>
    <table class="table table-light">

        <thead class="thead-light">
            <tr>
                <th>Número de asiento</th>
                <th>Estatus del asiento</th>
                <th>ID de la reservación</th>
                <th>ID de la corrida</th>
                <th>ID del precio</th>
            </tr>
        </thead>

        <tbody>
            @foreach($datos as $dato)
            <tr>
                <?php
                $str = strval($dato->reservation_id);
                for ($i = strlen($str); $i < 3; $i++) {
                    $str = "0" . $str;
                }
                $str2 = strval($dato->corrida_id);
                for ($i = strlen($str2); $i < 3; $i++) {
                    $str2 = "0" . $str2;
                }
                $str3 = strval($dato->precio_id);
                for ($i = strlen($str3); $i < 3; $i++) {
                    $str3 = "0" . $str3;
                }
                ?>
                <td>{{ $dato->num_asiento }}</td>
                <td>{{ $dato->estatus }}</td>
                <td>{{ $str }}</td>
                <td>{{ $str2 }}</td>
                <td>{{ $str3 }}</td>
            </tr>
            @endforeach
        </tbody>

    </table>
</body>

</html>