<?php
// Conexión a la base de datos
require_once '../connection/conn.php'; // Asegúrate de que este archivo contiene la conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['device-name'] ?? '';
    $ubicacion = $_POST['device-location'] ?? '';
    $capacidad = $_POST['device-capacity'] ?? '';

    // Validar los datos
    if (!empty($nombre) && !empty($ubicacion) && !empty($capacidad)) {
        try {
            $sql = "INSERT INTO zafacones_inteligentes (nombre_zafacon, ubicacion, capacidad, residuos_actuales, estado, fecha_instalacion, fecha_ultima_actualizacion) 
                    VALUES (:nombre, :ubicacion, :capacidad, 0, 'Vacío', NOW(), NOW())";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':nombre' => $nombre,
                ':ubicacion' => $ubicacion,
                ':capacidad' => $capacidad
            ]);

            echo json_encode(['success' => true, 'message' => 'Dispositivo agregado correctamente.']);
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'message' => 'Error al agregar el dispositivo: ' . $e->getMessage()]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Todos los campos son obligatorios.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Método no permitido.']);
}
?>