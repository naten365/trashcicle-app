<?php
session_start();
include '../connection/conn.php';
checkUserPermissions('admin');
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TrashCicle Admin Panel | Registro de usuarios</title>
    <link rel="stylesheet" href="styles/register-users-form.css">
</head>

<body>

    <div id="error-message" class="error-message hidden">
        Por favor, llena todos los campos obligatorios.
    </div>

    <div class="container">
        <div class="form-section">
            <div class="form-container register">
                <h1>Registro de usuarios</h1>
                <p>Agregar usuarios que accedan al sistema</p>
                <form action="process-user-register.php" method="post" id="formulario">
                    <div class="fields-container">
                        <input type="text" id="nombre" name="register_nombre" placeholder="Nombre">
                        <input type="text" id="apellido" name="register_apellido" placeholder="Apellido">
                    </div>
                    <div class="fields-container">
                        <input type="text" id="usuario" name="register_nombre_usuario" placeholder="Nombre de usuario">
                        <input type="text" id="email" name="register_email_usuario" placeholder="Correo electrónico">
                    </div>
                    <div class="fields-container">
                        <input type="password" id="contraseña" name="register_contraseña" placeholder="Contraseña">
                        <input type="text" id="telefono" name="register_telefono_usuario" placeholder="Número de teléfono">
                    </div>
                    <div class="fields-container">
                        <select name="register_pais" id="pais">
                            <option value="Selecciona un país">Selecciona un país</option>
                            <option value="Republica Dominicana">República Dominicana</option>
                        </select>
                        <input type="number" id="puntos" name="register_puntos_usuario" placeholder="Cantidad de puntos" style="outline: none;">
                    </div>
                    <input type="submit" value="Enviar" class="send-button">
                </form>
            </div>
        </div>
    </div>
    <script src="scripts/form.js"></script>

</body>

</html>