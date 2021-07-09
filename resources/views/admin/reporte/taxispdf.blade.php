<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <title>Taxis</title>
</head>

<body>
    <h1 style="text-align: center;">Datos de los taxis</h1>
    <table class="table table-light">

        <thead class="thead-light">
            <tr>
                <th>ID</th>
                <th>Placa</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Año</th>
                <th>Servicio</th>
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
                ?>
                <td>{{ $str }}</td>
                <td>{{ $dato->placa }}</td>
                <td>{{ $dato->marca }}</td>
                <td>{{ $dato->modelo }}</td>
                <td>{{ $dato->year }}</td>
                <td>{{ $dato->rol }}</td>
            </tr>
            @endforeach
        </tbody>

    </table>
</body>

</html>