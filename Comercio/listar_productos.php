<?php
session_start();

if (!isset($_SESSION['id_comercio'])) {
    echo json_encode(["status" => "error", "message" => "No tienes permiso para ver productos."]);
    exit;
}

$id_comercio = $_SESSION['id_comercio'];

$conn = new mysqli("localhost", "root", "", "RocketApp");

if ($conn->connect_error) {
    echo json_encode(["status" => "error", "message" => "Error de conexión: " . $conn->connect_error]);
    exit;
}

$sql = "SELECT id_producto, nombre_producto, descripcion, precio, id_comercio FROM productos WHERE id_comercio = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_comercio);
$stmt->execute();
$result = $stmt->get_result();

$products = [];
while ($row = $result->fetch_assoc()) {
    $products[] = $row;
}

echo json_encode(["status" => "success", "products" => $products]);

$stmt->close();
$conn->close();
?>
