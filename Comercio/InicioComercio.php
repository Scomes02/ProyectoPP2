<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap-grid.min.css"
        integrity="sha512-q0LpKnEKG/pAf1qi1SAyX0lCNnrlJDjAvsyaygu07x8OF4CEOpQhBnYiFW6YDUnOOcyAEiEYlV4S9vEc6akTEw==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" href="../img/poke-icono.ico">
    <title>ROCKET APP - Inicio de Sesión</title>
    <link rel="stylesheet" href="../Gral/style2.css">
</head>

<body>
    <form action="procesar_inicio_sesion.php" method="post">
        <h1>Inicio Sesión</h1>
        <br>
        <label for="nombre_comercio">
            <i class="fa-solid fa-user"></i> Nombre del Comercio
        </label>
        <input type="text" id="nombre_comercio" name="nombre_comercio" placeholder="Ingrese Nombre del Comercio" required>
        <label for="clave">
            <i class="fa-solid fa-key"></i> Clave
        </label>
        <input type="password" id="clave" name="Clave" placeholder="Ingrese Clave" required>
        <input type="hidden" name="tipo_usuario" value="Comercio">
        <br>
        <button type="submit" class="button styled-button large">Ingresar</button>
        <br>
        <a href="../Gral/Index.php" class="button styled-button small left">Regresar</a>
        <br>
        <a href="../Gral/Registro.php?origen=2" class="button styled-button small right">Crear Cuenta</a>
    </form>
</body>

</html>