<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <title>Reservaciones</title>
</head>

<body>
    <h1 style="text-align: center;">Datos de las reservaciones</h1>
    <table class="table table-light">

        <thead class="thead-light">
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Costo total</th>
                <th>Estatus del pago</th>
                <th>Fecha de reservación</th>
                <th>ID Usuario</th>
            </tr>
        </thead>

        <tbody>
            @foreach($reservaciones as $reservacion)
            <tr>
                <?php
                $str = strval($reservacion->id);
                for ($i = strlen($str); $i < 3; $i++) {
                    $str = "0" . $str;
                }
                $str2 = strval($reservacion->user_id);
                for ($i = strlen($str2); $i < 3; $i++) {
                    $str2 = "0" . $str2;
                }
                ?>
                <td>{{ $str }}</td>
                <td>{{ $reservacion->cliente }}</td>
                <td>{{ $reservacion->costo_total }}</td>
                <td>{{ $reservacion->estatus_pago }}</td>
                <td>{{ $reservacion->fecha_reservacion }}</td>
                <td>{{ $str2 }}</td>
            </tr>
            @endforeach
        </tbody>

    </table>
</body>

</html>