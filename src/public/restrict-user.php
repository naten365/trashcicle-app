<?php
include '../connection/conn.php';

header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);
$userId = intval($data['userId']);
$is_restricted = $data['is_restricted'] ? 1 : 0;
// Si está siendo habilitado, establecemos la razón como NULL, de lo contrario usamos la razón proporcionada
$restrictionReason = !$is_restricted ? null : $data['restrictionReason'];

try {
    $stmt = $pdo->prepare("UPDATE users SET is_restricted = :is_restricted, user_restriction_reason = :restrictionReason WHERE user_id = :userId");
    
    // Bindear los valores explícitamente para manejar NULL correctamente
    $stmt->bindValue(':is_restricted', $is_restricted, PDO::PARAM_INT);
    $stmt->bindValue(':restrictionReason', $restrictionReason, $restrictionReason === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
    $stmt->bindValue(':userId', $userId, PDO::PARAM_INT);
    
    $result = $stmt->execute();
    
    if ($result) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'No se pudo actualizar el usuario']);
    }
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>
