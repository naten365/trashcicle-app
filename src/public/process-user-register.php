<?php
include '../connection/conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Escapar los datos enviados por el usuario
    $UserRealName = htmlspecialchars($_POST['register_nombre']);
    $UserLastName = htmlspecialchars($_POST['register_apellido']);
    $UserPassword = htmlspecialchars($_POST['register_contraseña']);
    $UserName = htmlspecialchars($_POST['register_nombre_usuario']);
    $UserEmail = htmlspecialchars($_POST['register_email_usuario']);
    $UserPhone = htmlspecialchars($_POST['register_telefono_usuario']);
    $UserCountry = htmlspecialchars($_POST['register_pais']);
    $UserPoints = htmlspecialchars($_POST['register_puntos_usuario']);

    try {
        // Validar campos del formulario
        if (empty($UserRealName) || empty($UserLastName) || empty($UserPassword) || empty($UserName) || empty($UserEmail) || empty($UserPhone) || empty($UserCountry) || empty($UserPoints)) {
            throw new Exception("Todos los campos son obligatorios.");
        }

        // Procesar los datos del usuario e insertarlos
        insertUserData($UserRealName, $UserLastName, $UserPassword, $UserName, $UserEmail, $UserPhone, $UserCountry, $UserPoints, $pdo);
    } catch (Exception $e) {
        // Mostrar el mensaje de error al usuario
        echo "Error: " . $e->getMessage();
    }
}

function insertUserData($UserRealName, $UserLastName, $UserPassword, $UserName, $UserEmail, $UserPhone, $UserCountry, $UserPoints, $pdo)
{
    $EncryptedPassword = password_hash($UserPassword, PASSWORD_DEFAULT);
    // Preparar la consulta para insertar los datos
    $InsertDataQuery = 'INSERT INTO users (user_real_name, user_last_name, user_password, user_name, user_email, user_phone_number, user_country, user_points) VALUES (?, ?, ?, ?, ?, ?, ?, ?)';
    $stmt = $pdo->prepare($InsertDataQuery);

    if ($stmt) {
        $stmt->execute([$UserRealName, $UserLastName, $EncryptedPassword, $UserName, $UserEmail, $UserPhone, $UserCountry, $UserPoints]);
        echo "Usuario registrado exitosamente.";
    } else {
        echo "Error al preparar la consulta.";
    }
}
