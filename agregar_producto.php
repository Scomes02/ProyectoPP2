<?php
$host = "localhost";
$User = "root";
$pass = "";
$db = "rocketapp";

$conn = new mysqli($host, $User, $pass, $db);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$nombre = $_POST['nombre'];
$codigo_producto = $_POST['codigo_producto'];
$precio = $_POST['precio'];
$off = $_POST['off'];

$sql = "INSERT INTO productos (nombre, codigo_producto, precio, off) VALUES ('$nombre', '$codigo_producto', '$precio', '$off')";

if ($conn->query($sql) === TRUE) {
    echo "Producto agregado exitosamente";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>