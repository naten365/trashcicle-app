<?php
session_start();
include '../connection/conn.php';
header('Content-Type: application/json');

try {
    if (!isset($_SESSION['user_id'])) {
        throw new Exception('Debes iniciar sesión para realizar el canje');
    }


    $user_id = $_SESSION['user_id'];
    $product_id = $_POST['product_id'] ?? null;
    $nombre = $_POST['nombre'] ?? null;
    $telefono = $_POST['telefono'] ?? null;
    $direccion = $_POST['direccion'] ?? null;
    $referencias = $_POST['referencias'] ?? '';

    // Validar campos requeridos
    if (!$product_id || !$nombre || !$telefono || !$direccion) {
        throw new Exception('Todos los campos son requeridos');
    }

    // Validar formato de los campos
    if (!preg_match('/^[A-Za-zÁÉÍÓÚáéíóúñÑ\s]{3,}$/', $nombre)) {
        throw new Exception('El nombre no tiene un formato válido');
    }

    if (!preg_match('/^[0-9]{10}$/', $telefono)) {
        throw new Exception('El teléfono debe tener 10 dígitos');
    }

    if (strlen($direccion) < 10) {
        throw new Exception('La dirección es demasiado corta');
    }

    $pdo->beginTransaction();

    // Verificar puntos disponibles
    $stmt = $pdo->prepare("SELECT user_points FROM users WHERE user_id = ?");
    $stmt->execute([$user_id]);
    $user_points = $stmt->fetchColumn();

    // Obtener información completa del producto
    $stmt = $pdo->prepare("SELECT id_producto, nombre_producto, imagen_producto, product_prices_points FROM productos WHERE id_producto = ?");
    $stmt->execute([$product_id]);
    $producto = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$producto) {
        throw new Exception('El producto no existe');
    }

    $required_points = $producto['product_prices_points'];

    if ($user_points < $required_points) {
        throw new Exception('No tienes suficientes TrashPoints para este canje');
    }

    // Registrar el canje con todos los campos necesarios
    $stmt = $pdo->prepare("INSERT INTO canjes (
    user_id, 
    product_id, 
    nombre_entrega, 
    telefono, 
    direccion, 
    referencias, 
    fecha_canje, 
    estado,
    nombre_producto,
    imagen_producto,
    product_prices_points
    ) VALUES (
        ?, ?, ?, ?, ?, ?, 
        NOW(), 
        'pendiente',
        ?, ?, ?
    )");

    $stmt->execute([
        $user_id,
        $product_id,
        $nombre,
        $telefono,
        $direccion,
        $referencias,
        $producto['nombre_producto'],
        $producto['imagen_producto'],
        $producto['product_prices_points']
    ]);

    // Actualizar puntos del usuario
    $new_points = $user_points - $required_points;
    $stmt = $pdo->prepare("UPDATE users SET user_points = ? WHERE user_id = ?");
    $stmt->execute([$new_points, $user_id]);

    // Enviar correo de confirmación (implementar después)
    // sendConfirmationEmail($usuario['email'], $producto['nombre_producto']);

    $pdo->commit();

    echo json_encode([
        'success' => true,
        'message' => '¡Producto canjeado exitosamente!'
    ]);
} catch (Exception $e) {
    if ($pdo->inTransaction()) {
        $pdo->rollBack();
    }

    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
