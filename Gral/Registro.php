<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Conexión a la base de datos
    $conn = new mysqli('localhost', 'root', '', 'RocketApp');

    if ($conn->connect_error) {
        die(json_encode(['status' => 'error', 'message' => 'Error de conexión a la base de datos.']));  // Mejora en la respuesta
    }

    // Capturar los datos del formulario
    $tipo = $_POST['tipo'] ?? null;
    $usuario = $_POST['Usuario'] ?? '';
    $telefono = $_POST['Telefono'] ?? '';
    $clave = $_POST['Clave'] ?? '';
    $nombre_completo = $_POST['Nombre_completo'] ?? '';
    $dni = $_POST['DNI'] ?? '';
    $correo = $_POST['Correo'] ?? '';
    $rclave = $_POST['RClave'] ?? '';

    // Validaciones básicas
    if (empty($tipo) || empty($usuario) || empty($telefono) || empty($clave) || empty($nombre_completo) || empty($dni) || empty($correo) || empty($rclave)) {
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
    } elseif ($tipo === 'Comercio') {
        $tabla = 'comercios';
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Tipo de usuario no válido.']);
        exit;
    }

    // Insertar los datos en la tabla correspondiente
    $sql = "INSERT INTO $tabla (usuario, telefono, clave, nombre_completo, dni, correo) 
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssssss', $usuario, $telefono, $clave_hash, $nombre_completo, $dni, $correo);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Usuario registrado exitosamente.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error al registrar el usuario: ' . $stmt->error]);
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
            <form id="registroForm">
                <h1>Registro</h1>
                <hr>
                <div class="checkbox-group">
                    <label for="cliente">
                        <i class="fa-solid fa-address-card"></i> Cliente
                    </label>
                    <input type="checkbox" id="cliente" name="tipo" value="Cliente" >
    
                    <label for="comercio">
                        <i class="fa-solid fa-store"></i> Comercio
                    </label>
                    <input type="checkbox" id="comercio" name="tipo" value="Comercio" >
                </div>
                <hr>
                <div class="input-group">
                    <div class="column">
                        <label for="usuario">
                            <i class="fa-solid fa-user"></i> Usuario
                        </label>
                        <input type="text" id="usuario" name="Usuario" placeholder="Ingrese Usuario" required>
    
                        <label for="telefono">
                            <i class="fa-solid fa-phone"></i> Telefono
                        </label>
                        <input type="tel" id="telefono" name="Telefono" placeholder="Ingrese telefono" required>
    
                        <label for="clave">
                            <i class="fa-solid fa-key"></i> Clave
                        </label>
                        <input type="password" id="clave" name="Clave" placeholder="Ingrese Clave" required>
                    </div>
                    <div class="column">
                        <label for="nombre_completo">
                            <i class="fa-solid fa-users"></i> Nombre Completo
                        </label>
                        <input type="text" id="nombre_completo" name="Nombre_completo" placeholder="Ingrese Nombre Completo" required>
    
                        <label for="dni">
                            <i class="fa-solid fa-id-card"></i> DNI/CUIT
                        </label>
                        <input type="text" id="dni" name="DNI" placeholder="Ingrese DNI/CUIT" required>
    
                        <label for="correo">
                            <i class="fa-brands fa-envelope"></i> Mail
                        </label>
                        <input type="email" id="correo" name="Correo" placeholder="Ingrese su Correo" required>
    
                        <label for="rclave">
                            <i class="fa-solid fa-key"></i> Repetir Clave
                        </label>
                        <input type="password" id="rclave" name="RClave" placeholder="Repetir Clave" required>
                    </div>
                </div>
                <hr>
                <input type="submit" class="button styled-button" value="Registrarse">
                <hr>
                <a href="Index.php" class="button styled-button">Regresar</a>
            </form>
        </main>
        <script src="validacion.js"></script>
    </body>
</html>