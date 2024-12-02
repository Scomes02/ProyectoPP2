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

$sql = "SELECT * FROM productos";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo '<div class="product">';
        echo '<img src="guantes.jpg" alt="' . $row['nombre'] . '">';
        echo '<p>' . $row['nombre'] . '</p>';
        echo '<p class="product-price">$' . $row['precio'] . ' ' . ($row['off'] ? '<s>$' . ($row['precio'] * (1 - $row['off'] / 100)) . '</s>' : '') . '</p>';
        echo '<span>' . ($row["off"] ? 'OFF' . $row["off"] . '%' : '') . '</span>';
        echo '</div>';
    }
} else {
    echo "<p>0 productos encontrados</p>";
}

$conn->close();
?>
