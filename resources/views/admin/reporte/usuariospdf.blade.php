<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <title>Usuarios</title>
</head>

<body>
    <h1 style="text-align: center;">Datos de los usuarios</h1>
    <table class="table table-light">

        <thead class="thead-light">
            <tr>
                <th>ID</th> 
                <th>Nombre</th>
                <th>Correo electrónico</th>
                <th>Contraseña</th>
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
                <td>{{ $dato->name }}</td>
                <td>{{ $dato->email }}</td>
                <td>{{ $dato->password }}</td>
            </tr>
            @endforeach
        </tbody>

    </table>
</body>

</html>