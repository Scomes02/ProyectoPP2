<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="img/poke-icono.ico">
        <title> Crear Cuenta - Rocket App</title>
        <link rel="stylesheet" href="style2.css">
        <script src="https://kit.fontawesome.com/8fa0212ec6.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <main>
            <form id="registroForm">
                <h1>Registro</h1>
                <hr>
                <div class="checkbox-group">
                    <label for="cliente">
                        <i class="fa-solid fa-address-card"></i> Cliente
                    </label>
                    <input type="checkbox" id="cliente" name="tipo" value="Cliente" >
    
                    <label for="comercio">
                        <i class="fa-solid fa-store"></i> Comercio
                    </label>
                    <input type="checkbox" id="comercio" name="tipo" value="Comercio" >
                </div>
                <hr>
                <div class="input-group">
                    <div class="column">
                        <label for="usuario">
                            <i class="fa-solid fa-user"></i> Usuario
                        </label>
                        <input type="text" id="usuario" name="Usuario" placeholder="Ingrese Usuario" required>
    
                        <label for="telefono">
                            <i class="fa-solid fa-phone"></i> Telefono
                        </label>
                        <input type="tel" id="telefono" name="Telefono" placeholder="Ingrese telefono" required>
    
                        <label for="clave">
                            <i class="fa-solid fa-key"></i> Clave
                        </label>
                        <input type="password" id="clave" name="Clave" placeholder="Ingrese Clave" required>
                    </div>
                    <div class="column">
                        <label for="nombre_completo">
                            <i class="fa-solid fa-users"></i> Nombre Completo
                        </label>
                        <input type="text" id="nombre_completo" name="Nombre_completo" placeholder="Ingrese Nombre Completo" required>
    
                        <label for="dni">
                            <i class="fa-solid fa-id-card"></i> DNI/CUIT
                        </label>
                        <input type="text" id="dni" name="DNI" placeholder="Ingrese DNI/CUIT" required>
    
                        <label for="correo">
                            <i class="fa-brands fa-envelope"></i> Mail
                        </label>
                        <input type="email" id="correo" name="Correo" placeholder="Ingrese su Correo" required>
    
                        <label for="rclave">
                            <i class="fa-solid fa-key"></i> Repetir Clave
                        </label>
                        <input type="password" id="rclave" name="RClave" placeholder="Repetir Clave" required>
                    </div>
                </div>
                <hr>
                <input type="submit" class="button styled-button" value="Registrarse">
                <hr>
                <a href="Index.html" class="button styled-button">Regresar</a>
            </form>
        </main>
        <script src="validacion.js"></script>
    </body>
</html>