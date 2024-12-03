<?php
// Conexión a la base de datos
$host = "localhost";
$user = "root";
$password = "";
$dbname = "RocketApp";

$conn = new mysqli($host, $user, $password, $dbname);

// Verifica si hay errores de conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Obtener el ID del producto desde la URL
if (isset($_GET['id'])) {
    $productId = $_GET['id'];

    // Eliminar el producto de la base de datos
    $sql = "DELETE FROM productos WHERE id = $productId";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error al eliminar el producto"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "ID de producto no proporcionado"]);
}

// Cierra la conexión
$conn->close();
?>
