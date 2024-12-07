<?php
session_start();

// Conexión a la base de datos
$conn = new mysqli("localhost", "root", "", "RocketApp");
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['Usuario'];
    $clave = $_POST['Clave'];

    // Validar que los datos no estén vacíos
    if (empty($usuario) || empty($clave)) {
        echo json_encode(["status" => "error", "message" => "Debe completar todos los campos."]);
        exit;
    }

    // Buscar el comercio en la base de datos
    $sql = "SELECT id_comercio, clave FROM comercios WHERE usuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $comercio = $result->fetch_assoc();
        // Verificar la contraseña
        if (password_verify($clave, $comercio['clave'])) {
            // Iniciar sesión
            $_SESSION['id_comercio'] = $comercio['id_comercio'];
            echo json_encode(["status" => "success", "message" => "Inicio de sesión exitoso."]);
            header("Location: RocketApp-COM.php");
        } else {
            echo json_encode(["status" => "error", "message" => "Contraseña incorrecta."]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Usuario no encontrado."]);
    }

    $stmt->close();
}

$conn->close();
?>
