<?php
session_start();
include '../connection/conn.php';

// Actualizar el estado online del usuario
function updateOnlineStatus($userId, $status) {
    global $pdo;
    try {
        $stmt = $pdo->prepare("UPDATE users SET is_online = ?, last_activity = NOW() WHERE user_id = ?");
        return $stmt->execute([$status, $userId]);
    } catch (PDOException $e) {
        return false;
    }
}

// Cuando el usuario inicia sesión
if (isset($_SESSION['user_id'])) {
    updateOnlineStatus($_SESSION['user_id'], 1);
}

// Limpiar estados de usuarios inactivos (más de 5 minutos sin actividad)
try {
    $stmt = $pdo->prepare("UPDATE users SET is_online = 0 WHERE last_activity < NOW() - INTERVAL 5 MINUTE");
    $stmt->execute();
} catch (PDOException $e) {
    // Manejar error si es necesario
}