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

        $stmt = $pdo->prepare("SELECT user_id, user_password, is_restricted, user_restriction_reason FROM users WHERE user_name = :user_name");
        $stmt->execute([':user_name' => $login_nombre_usuario]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($login_contraseña, $user['user_password'])) {
            if ($user['is_restricted'] == 1) {
                $reason = urlencode($user['user_restriction_reason']);
                header("Location: account-suspended.php?reason=$reason");
                exit();
            } else {
                $_SESSION['user_id'] = $user['user_id'];
                header("Location: home.php");
                exit();
            }
        } else {
            header("Location: login-form.php?error=1");
            exit();
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
