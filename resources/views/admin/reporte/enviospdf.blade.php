<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <title>Envios</title>
</head>

<body>
    <h1 style="text-align: center;">Datos de los envíos</h1>
    <table class="table table-light">

        <thead class="thead-light">
            <tr>
                <th>ID</th>
                <th>Remitente</th>
                <th>Destinatario</th>
                <th>Descripción</th>
                <th>Destino</th>
                <th>Costo</th>
                <th>Estatus pago</th>
                <th>Fecha envío</th>
                <th>Corrida</th>
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
                $str2 = strval($dato->corrida_id);
                for ($i = strlen($str2); $i < 3; $i++) {
                    $str2 = "0" . $str2;
                }
                ?>
                <td>{{ $str }}</td>
                <td>{{ $dato->remitente }}</td>
                <td>{{ $dato->destinatario }}</td>
                <td>{{ $dato->descripcion }}</td>
                <td>{{ $dato->destino }}</td>
                <td>{{ $dato->costo }}</td>
                <td>{{ $dato->estatus_pago }}</td>
                <td>{{ $dato->fecha_envio }}</td>
                <td>{{ $str2 }}</td>
            </tr>
            @endforeach
        </tbody>

    </table>
</body>

</html>