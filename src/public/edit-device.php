<?php
require_once '../connection/conn.php'; // Conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['device-id'] ?? '';
    $name = $_POST['device-name'] ?? '';
    $location = $_POST['device-location'] ?? '';
    $status = $_POST['device-status'] ?? '';
    $points = $_POST['device-points'] ?? 0;
    $capacity = $_POST['device-capacity'] ?? '';

    // Validar que todos los campos requeridos estén presentes
    if (!empty($id) && !empty($name) && !empty($location) && !empty($status) && !empty($capacity)) {
        try {
            // Consulta SQL para actualizar el dispositivo
            $sql = "UPDATE zafacones_inteligentes 
                    SET nombre_zafacon = :name, 
                        ubicacion = :location, 
                        estado = :status, 
                        residuos_actuales = :points, 
                        capacidad = :capacity, 
                        fecha_ultima_actualizacion = NOW() 
                    WHERE id_zafacon = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':id' => $id,
                ':name' => $name,
                ':location' => $location,
                ':status' => $status,
                ':points' => $points,
                ':capacity' => $capacity
            ]);

            // Respuesta en formato JSON
            echo json_encode(['success' => true, 'message' => 'Dispositivo actualizado correctamente.']);
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'message' => 'Error al actualizar el dispositivo: ' . $e->getMessage()]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Todos los campos son obligatorios.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Método no permitido.']);
}
?>