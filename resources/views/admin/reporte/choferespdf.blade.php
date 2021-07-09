<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <title>Choferes</title>
</head>

<body>
    <h1 style="text-align: center;">Datos de los choferes</h1>
    <table class="table table-light">

        <thead class="thead-light">
            <tr>
                <th>ID</th> 
                <th>Nombre</th>
                <th>Apellido paterno</th>
                <th>Apellido materno</th>
                <th>Célular</th>
                <th>Calle</th>
                <th>#</th>
                <th>Localidad</th>
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
                <td>{{ $dato->nombre }}</td>
                <td>{{ $dato->apellidoPaterno }}</td>
                <td>{{ $dato->apellidoMaterno }}</td>
                <td>{{ $dato->num_celular }}</td>
                <td>{{ $dato->dir_calle }}</td>
                <td>{{ $dato->dir_numero }}</td>
                <td>{{ $dato->dir_localidad }}</td>
                <td>{{ $str2 }}</td>
            </tr>
            @endforeach
        </tbody>

    </table>
</body>

</html>