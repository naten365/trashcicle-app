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


//Funcion para gestionar los tipos de usuarios
if (!function_exists('checkUserPermissions')) {
    function checkUserPermissions($requiredType)
    {
        if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== $requiredType) {
            header('Location: login-form.php?error=access_denied');
            exit();
        }
    }
}

