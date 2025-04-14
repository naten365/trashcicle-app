<?php
session_start();
include '../connection/conn.php';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TrashCicle Admin Panel | Inicio de sesión</title>
    <link rel="stylesheet" href="styles/form.css">
</head>
<body>
    <div id="error-message" class="error-message hidden">
        Por favor, llena todos los campos obligatorios.
    </div>

    <div class="container">
        <div class="image-section">
            <img src="assets/images/pexels-readymade-3850481.jpg" alt="Imagen de fondo">
        </div>
        <div class="form-section">
            <div class="form-container">
                <h1>Inicio de sesión</h1>
                <p>Inicia sesión para continuar</p>

                <?php if (isset($_GET['error'])): ?>
                    <div class="error-message visible">Nombre de usuario o contraseña incorrectos.</div>
                <?php endif; ?>

                <form action="process-login.php" method="post" id="formulario">
                    <input type="text" id="usuario" name="login_nombre_usuario" placeholder="Nombre de usuario">
                    <input type="password" id="contraseña" name="login_contraseña" placeholder="Contraseña">
                    <button type="submit">Enviar</button>
                    <label>
                        <input type="checkbox" id="condiciones">
                        Aceptar todas las condiciones
                    </label>
                    <label>
                        <a href="register-customer-form.php" style="color:green; text-decoration:none;">No tienes cuenta</a>
                    </label>
                </form>
            </div>
        </div>
    </div>
    <script src="scripts/login-form.js"></script>

</body>

</html>