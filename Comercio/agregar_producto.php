<?php
session_start();

// Verificar sesión activa del comercio
if (!isset($_SESSION['id_comercio'])) {
    echo json_encode(["status" => "error", "message" => "No tienes permiso para agregar productos."]);
    exit;
}

$id_comercio = $_SESSION['id_comercio'];

// Conexión a la base de datos
$conn = new mysqli("localhost", "root", "", "RocketApp");

if ($conn->connect_error) {
    echo json_encode(["status" => "error", "message" => "Error de conexión: " . $conn->connect_error]);
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = $conn->real_escape_string($_POST['nombre']);
    $codigo_producto = $conn->real_escape_string($_POST['codigo_producto']);
    $precio = $conn->real_escape_string($_POST['precio']);
    $off = isset($_POST['off']) ? $conn->real_escape_string($_POST['off']) : null;

    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === 0) {
        $imagen_nombre = uniqid() . "_" . basename($_FILES['imagen']['name']);
        $imagen_ruta = "../uploads/" . $imagen_nombre;

        // Crear carpeta si no existe
        if (!file_exists("../uploads")) {
            mkdir("../uploads", 0777, true);
        }

        if (move_uploaded_file($_FILES['imagen']['tmp_name'], $imagen_ruta)) {
            // Depurar la consulta SQL para verificar si es correcta
            $sql = "INSERT INTO productos (nombre_producto, codigo_producto, precio, off, imagen, id_comercio) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);

            // Verificar si la preparación de la consulta fue exitosa
            if ($stmt === false) {
                echo json_encode(["status" => "error", "message" => "Error al preparar la consulta: " . $conn->error]);
                exit();
            }

            // Pasar los parámetros
            $stmt->bind_param("ssdsdi", $nombre, $codigo_producto, $precio, $off, $imagen_nombre, $id_comercio);

            if ($stmt->execute()) {
                echo json_encode(["status" => "success", "message" => "Producto agregado exitosamente."]);
            } else {
                echo json_encode(["status" => "error", "message" => "Error al agregar producto: " . $stmt->error]);
            }
            $stmt->close();
        } else {
            echo json_encode(["status" => "error", "message" => "Error al mover la imagen."]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Por favor, selecciona una imagen válida."]);
    }
}

$conn->close();
?>
