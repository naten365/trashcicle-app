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

        $stmt = $pdo->prepare("SELECT user_id, user_password, is_restricted, type_users, user_restriction_reason 
                              FROM users 
                              WHERE user_name = :user_name");
        $stmt->execute([':user_name' => $login_nombre_usuario]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($login_contraseña, $user['user_password'])) {
            $isRestricted = (int)$user['is_restricted'];
            
            if ($isRestricted === 1) {
                $reason = !empty($user['user_restriction_reason']) ? 
                         urlencode($user['user_restriction_reason']) : 
                         urlencode('Cuenta restringida');
                header("Location: account-suspended.php?reason=$reason");
                exit();
            }
            
            // Actualizar estado online
            $updateStmt = $pdo->prepare("UPDATE users SET is_online = 1, last_activity = NOW() WHERE user_id = :user_id");
            $updateStmt->execute([':user_id' => $user['user_id']]);
            
            if($user['type_users'] === 'admin') {
                $_SESSION['admin_logged_in'] = true;
                $_SESSION['admin_id'] = $user['user_id'];
                $_SESSION['admin_type'] = $user['type_users'];
                header("Location: index-admin.php");
            } else if($user['type_users'] === 'cliente') {
                $_SESSION['user_logged_in'] = true;
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['user_type'] = $user['type_users'];
                header("Location: Tienda.php");
            } else {
                header("Location: login-form.php?error=invalid_type");
            }
            exit();
        } else {
            header("Location: login-form.php?error=1");
            exit();
        }
    } catch (Exception $e) {
        header("Location: login-form.php?error=system");
        exit();
    }
}
?>