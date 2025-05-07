<?php
// Archivo: update-database.php
// Script para actualizar la estructura de la base de datos y añadir coordenadas a los dispositivos

require_once '../connection/conn.php';

try {
    // Verificar si las columnas ya existen
    $checkColumns = $pdo->query("SHOW COLUMNS FROM zafacones_inteligentes LIKE 'latitud'");
    $columnExists = $checkColumns->rowCount() > 0;

    if (!$columnExists) {
        // Añadir columnas para latitud y longitud
        $pdo->exec("ALTER TABLE zafacones_inteligentes ADD COLUMN latitud DECIMAL(10, 8) DEFAULT NULL AFTER ubicacion");
        $pdo->exec("ALTER TABLE zafacones_inteligentes ADD COLUMN longitud DECIMAL(11, 8) DEFAULT NULL AFTER latitud");
        
        // Actualizar dispositivos existentes con coordenadas simuladas dentro de Santo Domingo
        $devices = $pdo->query("SELECT id_zafacon FROM zafacones_inteligentes")->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($devices as $device) {
            // Generar coordenadas aleatorias dentro de Santo Domingo
            $lat = 18.4861 + (mt_rand(-100, 100) / 1000);
            $lng = -69.9312 + (mt_rand(-100, 100) / 1000);
            
            $updateStmt = $pdo->prepare("UPDATE zafacones_inteligentes SET latitud = :lat, longitud = :lng WHERE id_zafacon = :id");
            $updateStmt->execute([
                ':lat' => $lat,
                ':lng' => $lng,
                ':id' => $device['id_zafacon']
            ]);
        }
        
        echo "Base de datos actualizada correctamente. Se añadieron las columnas de coordenadas.";
    } else {
        echo "Las columnas ya existen en la base de datos.";
    }
} catch (PDOException $e) {
    echo "Error al actualizar la base de datos: " . $e->getMessage();
}
?>