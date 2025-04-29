<?php
// incluir la conexión a la base de datos
session_start();
include '../connection/conn.php'; // cambia esto por tu archivo real de conexión

function eliminarProducto($idProducto) {
    global $pdo;
    $sql = "DELETE FROM productos WHERE id_producto = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $idProducto, PDO::PARAM_INT);

    return $stmt->execute();
}

// Capturamos el id que viene por GET
if (isset($_GET['id'])) {
    $idProducto = (int) $_GET['id'];

    if (eliminarProducto($idProducto)) {
        // Eliminado correctamente
        header('Location: dashboard-products.php');
        exit();
    } else {
        // Error al eliminar
        header('Location: productos.php?mensaje=Error+al+eliminar+el+producto');
        exit();
    }
} else {
    // Si no viene id
    header('Location: productos.php?mensaje=ID+no+especificado');
    exit();
}
?>