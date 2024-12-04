<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = new mysqli('localhost', 'root', '', 'RocketApp');

    if ($conn->connect_error) {
        die(json_encode(['status' => 'error', 'message' => 'Error de conexión a la base de datos.']));
    }

    // Capturar los datos del formulario
    $tipo = $_POST['tipo'] ?? null;
    $direccion = $_POST['Direccion'] ?? '';
    $telefono = $_POST['Telefono'] ?? '';
    $clave = $_POST['Clave'] ?? '';
    $nombre_comercio = $_POST['Nombre_completo'] ?? '';
    $dni_cuit = $_POST['DNI_CUIT'] ?? '';
    $correo = $_POST['Correo'] ?? '';
    $rclave = $_POST['RClave'] ?? '';

    // Validaciones básicas
    if (empty($tipo) || ($tipo !== 'Cliente' && $tipo !== 'Comercio')) {
        echo json_encode(['status' => 'error', 'message' => 'Por favor, seleccione un tipo válido (Cliente o Comercio).']);
        exit;
    }
    if (empty($nombre_comercio) || empty($telefono) || empty($clave) || empty($dni_cuit) || empty($correo) || empty($rclave)) {
        echo json_encode(['status' => 'error', 'message' => 'Por favor, complete todos los campos.']);
        exit;
    }

    if ($clave !== $rclave) {
        echo json_encode(['status' => 'error', 'message' => 'Las claves no coinciden.']);
        exit;
    }

    // Encriptar la clave
    $clave_hash = password_hash($clave, PASSWORD_DEFAULT);

    // Determinar la tabla de destino según el tipo de usuario
    if ($tipo === 'Cliente') {
        $tabla = 'clientes';
        $nombre_campo = 'nombre_cliente';
    } elseif ($tipo === 'Comercio') {
        $tabla = 'comercios';
        $nombre_campo = 'nombre_comercio';
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Tipo de usuario no válido.']);
        exit;
    }

    // Insertar los datos en la tabla correspondiente
    $sql = "INSERT INTO $tabla ($nombre_campo, telefono, clave, dni_cuit, correo, direccion) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    $stmt->bind_param('ssssss', $nombre_comercio, $telefono, $clave_hash, $dni_cuit, $correo, $direccion);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Usuario registrado exitosamente.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error al registrar el usuario: ' . $stmt->error]);
    }

    $origen = isset($_GET['origen']) ? (int)$_GET['origen'] : 0;

    if ($origen === 1) {
        $ruta = '../Cliente/InicioCliente.php';
    } elseif ($origen === 2) {
        $ruta = '../Comercio/InicioComercio.php';
    } else {
        $ruta = 'Index.php';
    }

    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../img/poke-icono.ico">
    <title> Crear Cuenta - Rocket App</title>
    <link rel="stylesheet" href="style2.css">
    <script src="https://kit.fontawesome.com/8fa0212ec6.js" crossorigin="anonymous"></script>
</head>

<body>
    <main>
        <form id="registroForm" method="POST" action="registro.php">
            <h1>Registro</h1>
            <hr>
            <div class="checkbox-group">
                <label for="cliente">
                    <i class="fa-solid fa-address-card"></i> Cliente
                </label>
                <input type="radio" id="cliente" name="tipo" value="Cliente" required>

                <label for="comercio">
                    <i class="fa-solid fa-store"></i> Comercio
                </label>
                <input type="radio" id="comercio" name="tipo" value="Comercio" required>
            </div>
            <hr>
            <div class="input-group">
                <div class="column">
                    <label for="nombre_completo">
                        <i class="fa-solid fa-users"></i> Usuario
                    </label>
                    <input type="text" id="nombre_completo" name="nombre_completo" placeholder="Ingrese Nombre Completo" required>
                    
                    <label for="telefono">
                        <i class="fa-solid fa-phone"></i> Telefono
                    </label>
                    <input type="tel" id="telefono" name="telefono" placeholder="Ingrese telefono" required>

                    <label for="clave">
                        <i class="fa-solid fa-key"></i> Clave
                    </label>
                    <input type="password" id="clave" name="clave" placeholder="Ingrese Clave" required>
                </div>
                <div class="column">
                    <label for="direccion">
                        <i class="fa-solid fa-user"></i> Direccion
                    </label>
                    <input type="text" id="direccion" name="direccion" placeholder="Ingrese Direccion" required>

                    <label for="dni_cuit">
                        <i class="fa-solid fa-id-card"></i> DNI/CUIT
                    </label>
                    <input type="text" id="dni_cuit" name="dni_cuit" placeholder="Ingrese DNI/CUIT" required>

                    <label for="correo">
                        <i class="fa-brands fa-envelope"></i> Mail
                    </label>
                    <input type="email" id="correo" name="correo" placeholder="Ingrese su Correo" required>

                    <label for="rclave">
                        <i class="fa-solid fa-key"></i> Repetir Clave
                    </label>
                    <input type="password" id="rclave" name="rclave" placeholder="Repetir Clave" required>
                </div>
            </div>
            <hr>
            <input type="submit" class="button styled-button" value="Registrarse">
            <hr>
            <a href="Index.php" class="button styled-button">Salir</a>
        </form>
    </main>
    <script src="validacion.js"></script>
</body>

</html>