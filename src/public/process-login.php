<?php
session_start();
include '../connection/conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login_nombre_usuario = htmlspecialchars($_POST['login_nombre_usuario']);
    $login_contraseña = htmlspecialchars($_POST['login_contraseña']);

    try {
        if (empty($login_nombre_usuario) || empty($login_contraseña)) {
            throw new Exception("Todos los campos son obligatorios.");
        }

        // Consulta para obtener el usuario desde la base de datos
        $stmt = $pdo->prepare("SELECT user_id, user_password, is_restricted, type_users, user_restriction_reason FROM users WHERE user_name = :user_name");
        $stmt->execute([':user_name' => $login_nombre_usuario]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($login_contraseña, $user['user_password'])) {
            if ($user['is_restricted'] == 1) {
                $reason = urlencode($user['user_restriction_reason']);
                header("Location: account-suspended.php?reason=$reason");
                exit();
            } else {
                // Guardar información del usuario en la sesión
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['user_type'] = $user['type_users'];
                header("Location: index-admin.php");
                exit();
            }
        } else {
            // Credenciales inválidas
            header("Location: login-form.php?error=invalid_credentials");
            exit();
        }
    } catch (Exception $e) {
        // Manejo de errores
        echo "Error: " . $e->getMessage();
    }
}
?>