<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/poke-icono.ico">
    <title>Rocket App</title>
    <link rel="stylesheet" href="style3Com.css">
    <script src="https://kit.fontawesome.com/8fa0212ec6.js" crossorigin="anonymous"></script>
</head>

<body>
    <header>
        <a href="Index.html"><i class="fa-solid fa-right-from-bracket"></i>Salir</a>
        <h1>Rocket App</h1>
    </header>
    <div class="product-input">
        <form id="add-product-form" method="POST" enctype="multipart/form-data">
            <label for="product-name">Nombre del producto:</label>
            <input type="text" id="product-name" name="nombre" placeholder="Ingrese producto" required>
            <hr>
            <label for="product-codigo">Código de producto:</label>
            <input type="text" id="product-codigo" name="codigo_producto" placeholder="Código de producto" required>
            <hr>
            <label for="product-price">Precio unitario:</label>
            <input type="number" id="product-price" name="precio" placeholder="Precio unitario" step="0.01" required>
            <hr>
            <label for="product-off">OFF% (opcional):</label>
            <input type="number" id="product-off" name="off" placeholder="OFF%" step="0.01">
            <hr>
            <label for="product-image">Imagen del producto:</label>
            <input type="file" id="product-image" name="imagen" accept="image/*" required>
            <br>
            <button type="button" id="add-product-button">Agregar producto</button>
        </form>
        <div id="response-message"></div>
    </div>

    <div class="product-list" id="product-list">
        <h2>Tus productos</h2>
        <div id="products-container"></div>
    </div>

    <footer>
        <img src="img/home-icon.png" alt="Home">
        <img src="img/shop-icon.png" alt="Shop">
        <img src="img/profile-icon.png" alt="Profile">
    </footer>

    <script>
        document.getElementById("add-product-button").addEventListener("click", function () {
            var form = document.getElementById("add-product-form");
            var formData = new FormData(form);

            fetch("agregar_producto.php", {
                method: "POST",
                body: formData,
            })
                .then((response) => response.json())
                .then((data) => {
                    var messageDiv = document.getElementById("response-message");
                    
                    // Muestra el mensaje de éxito o error según el estado de la respuesta
                    if (data.status === "success") {
                        messageDiv.innerHTML = "<p style='color: green;'>" + data.message + "</p>";
                        // Opcional: si quieres hacer algo más después del éxito, puedes agregar aquí más código
                    } else {
                        messageDiv.innerHTML = "<p style='color: red;'>" + data.message + "</p>";
                    }
                })
                .catch((error) => {
                    console.error("Error:", error);
                    document.getElementById("response-message").innerHTML = "<p style='color: red;'>Ocurrió un error al procesar la solicitud.</p>";
                });
        });
    // Función para cargar todos los productos desde la base de datos
        function loadProducts() {
            fetch("listar_productos.php")
                .then((response) => response.json())
                .then((data) => {
                    var productsContainer = document.getElementById("products-container");

                    // Vacía el contenedor antes de agregar los nuevos productos
                    productsContainer.innerHTML = "";

                    // Muestra los productos en bloques
                    data.products.forEach((product) => {
                        var productDiv = document.createElement("div");
                        productDiv.classList.add("product-block");
                        productDiv.innerHTML = `
                            <h3>${product.nombre}</h3>
                            <p>Código: ${product.codigo_producto}</p>
                            <p>Precio: $${product.precio}</p>
                            <p>OFF: ${product.off || "No aplica"}</p>
                            <img src="uploads/${product.imagen}" alt="${product.nombre}" width="100" height="100">
                            <button onclick="editProduct(${product.id})">Editar</button>
                            <button onclick="deleteProduct(${product.id})">Eliminar</button>
                        `;
                        productsContainer.appendChild(productDiv);
                    });
                })
                .catch((error) => {
                    console.error("Error al cargar los productos:", error);
                });
        }

        // Función para editar un producto (por implementar)
        function editProduct(productId) {
            // Lógica para editar el producto
            console.log("Editar producto con ID: " + productId);
        }

        // Función para eliminar un producto
        function deleteProduct(productId) {
            if (confirm("¿Estás seguro de que deseas eliminar este producto?")) {
                fetch(`eliminar_producto.php?id=${productId}`, {
                    method: "GET",
                })
                    .then((response) => response.json())
                    .then((data) => {
                        if (data.status === "success") {
                            alert("Producto eliminado correctamente.");
                            loadProducts(); // Recargar la lista de productos
                        } else {
                            alert("Error al eliminar el producto.");
                        }
                    })
                    .catch((error) => {
                        console.error("Error al eliminar el producto:", error);
                    });
            }
        }

        // Cargar los productos al cargar la página
        window.onload = function () {
            loadProducts();
        };
    </script>
</body>
</html>