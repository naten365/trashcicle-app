<?php
session_start();
include '../connection/conn.php';

// Actualizar estado offline antes de destruir la sesión
if (isset($_SESSION['user_id'])) {
    $stmt = $pdo->prepare("UPDATE users SET is_online = 0 WHERE user_id = ?");
    $stmt->execute([$_SESSION['user_id']]);
}

// Destruye todas las variables de sesión
$_SESSION = array();

// Si se usa una cookie de sesión, también se borra
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Finalmente se destruye la sesión
session_destroy();

// Redirige al formulario de login
header("Location: login-form.php");
exit();
?>
