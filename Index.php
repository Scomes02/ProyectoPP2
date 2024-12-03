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
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/8fa0212ec6.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <div class="logo">
            <img src="img/rocektTeam.png" alt="Logo de la empresa" class="imag">
        </div>
        <div class="titulo">
            <h1>Bienvenido a Rocket App</h1>
        </div>
    </header>
    <main>
        <section class="contenedor-formulario">
            <h2>¿Quién eres?</h2>
            <form>
                <div class="botones">
					<div class="boton-contenedor">
						<img src="img/Clientes.png" alt="Imagen de Clientes" class="imagen-boton">
						<a type="submit" href="InicioCliente.php" class="styled-button">Cliente</a>
					</div>
					<div class="boton-contenedor">
                        <img src="img/Comercios.png" alt="Imagen de Comercios" class="imagen-boton">
                        <a type="submit" href="InicioComercio.php" class="styled-button">Comercio</a>
                    </div>
                </div>
				<br>
				<a href="Registro.php" class="button">Crear Cuenta</a>
            </form>
        </section>
    </main>
	<footer>
        <img src="img/charmander-unscreen.gif" alt="charmander corriendo" class="charmander">
        <img src="img/squirtle-unscreen.gif" alt="squirtle corriendo" class="squirtle">
        <img src="img/boulbasour-unscreen.gif" alt="baulbasaur corriendo" class="baulbasaur">
		<img src="img/running-pikachu-transparent-snivee.gif" alt="Pikachu corriendo" class="pikachu">
        <img src="img/poke-unscreen.gif" alt="poke corriendo" class="poke">
	</footer>
</body>
</html>
