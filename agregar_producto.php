<?php
// Conexión a la base de datos
$host = "localhost";
$user = "root";
$password = "";
$dbname = "RocketApp";

$conn = new mysqli($host, $user, $password, $dbname);

// Verifica si hay errores de conexión
if ($conn->connect_error) {
    echo json_encode(["status" => "error", "message" => "Error de conexión: " . $conn->connect_error]);
    exit();
}

// Procesa los datos del formulario
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = $conn->real_escape_string($_POST['nombre']);
    $codigo_producto = $conn->real_escape_string($_POST['codigo_producto']);
    $precio = $conn->real_escape_string($_POST['precio']);
    $off = isset($_POST['off']) ? $conn->real_escape_string($_POST['off']) : null;

    // Procesar la imagen
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === 0) {
        $imagen_nombre = basename($_FILES['imagen']['name']);
        $imagen_ruta = "uploads/" . $imagen_nombre;

        // Crea la carpeta si no existe
        if (!file_exists("uploads")) {
            mkdir("uploads", 0777, true);
        }

        // Mueve el archivo subido
        if (move_uploaded_file($_FILES['imagen']['tmp_name'], $imagen_ruta)) {
            // Inserta los datos en la base de datos
            $sql = "INSERT INTO productos (nombre, codigo_producto, precio, off, imagen) 
                    VALUES ('$nombre', '$codigo_producto', '$precio', '$off', '$imagen_nombre')";

            if ($conn->query($sql) === TRUE) {
                echo json_encode(["status" => "success", "message" => "Producto agregado exitosamente."]);
            } else {
                echo json_encode(["status" => "error", "message" => "Error al agregar el producto: " . $conn->error]);
            }
        } else {
            echo json_encode(["status" => "error", "message" => "Error al subir la imagen."]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Por favor, selecciona una imagen."]);
    }
}

// Cierra la conexión
$conn->close();
?>
