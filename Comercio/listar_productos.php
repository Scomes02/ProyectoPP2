<?php
// Conexión a la base de datos
$host = "localhost";
$user = "root";
$password = "";
$dbname = "RocketApp";

$conn = new mysqli($host, $user, $password, $dbname);


if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Consulta para obtener los productos
$sql = "SELECT * FROM productos";
$result = $conn->query($sql);

$products = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}

// Devuelve los productos en formato JSON
echo json_encode(["products" => $products]);

// Cierra la conexión
$conn->close();
?>
