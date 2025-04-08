<?php
include '../connection/conn.php';

header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);
$userId = intval($data['userId']); // Convertir a entero
$is_restricted = $data['is_restricted'] ? 1 : 0; // Asegurar valor booleano
$restrictionReason = $data['restrictionReason'];

try {
    $stmt = $pdo->prepare("UPDATE users SET is_restricted = :is_restricted, user_restriction_reason = :restrictionReason WHERE user_id = :userId");
    $result = $stmt->execute([
        ':is_restricted' => $is_restricted,
        ':restrictionReason' => $restrictionReason,
        ':userId' => $userId
    ]);
    
    if ($result) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'No se pudo actualizar el usuario']);
    }
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>
