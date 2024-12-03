<?php
$conn = new mysqli("localhost", "root", "", "RocketApp");

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$sql = "SELECT nombre, codigo_producto, precio, off, imagen FROM productos";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div class='producto'>";
        echo "<img src='uploads/" . $row['imagen'] . "' alt='" . $row['nombre'] . "'>";
        echo "<h3>" . $row['nombre'] . "</h3>";
        echo "<p>Código: " . $row['codigo_producto'] . "</p>";
        echo "<p>Precio: $" . $row['precio'] . "</p>";
        if ($row['off']) {
            echo "<p>Descuento: " . $row['off'] . "%</p>";
        }
        echo "</div>";
    }
} else {
    echo "No hay productos.";
}

$conn->close();
?>
