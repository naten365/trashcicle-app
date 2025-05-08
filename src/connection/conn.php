<?php
$host = 'localhost';
$dbname = 'trashcicle_db';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Mostrar el mensaje de error al usuario
    echo "Error: " . $e->getMessage();
}

//Función para gestionar los tipos de usuarios
if (!function_exists('checkUserPermissions')) {
    function checkUserPermissions($requiredType)
    {
        if($requiredType === 'admin') {
            // Verificar sesión de administrador
            if(!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in'] || $_SESSION['admin_type'] !== 'admin') {
                header('Location: login-form.php?error=access_denied');
                exit();
            }
        } else if($requiredType === 'cliente') {
            // Verificar sesión de cliente
            if(!isset($_SESSION['user_logged_in']) || !$_SESSION['user_logged_in'] || $_SESSION['user_type'] !== 'cliente') {
                header('Location: login-form.php?error=access_denied');
                exit();
            }
        } else {
            // Tipo no reconocido
            header('Location: login-form.php?error=invalid_type');
            exit();
        }
    }
}