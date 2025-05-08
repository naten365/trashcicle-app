<?php
session_start();
include '../connection/conn.php';
checkUserPermissions('cliente');

if (!isset($_SESSION['user_id']) || !isset($_GET['product_id'])) {
    header('Location: Tienda.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$product_id = $_GET['product_id'];

// Obtener datos del producto
$sql = "SELECT * FROM productos WHERE id_producto = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id', $product_id);
$stmt->execute();
$producto = $stmt->fetch(PDO::FETCH_ASSOC);

// Obtener datos del usuario
$sql = "SELECT * FROM users WHERE user_id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id', $user_id);
$stmt->execute();
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Canjear Producto - TrashCicle</title>
    <link rel="stylesheet" href="styles/exchange-product.css">
</head>

<body>
    <div class="exchange-container">
        <div class="exchange-card">
            <div class="product-preview">
                <img src="uploads/<?= htmlspecialchars($producto['imagen_producto']) ?>" alt="<?= htmlspecialchars($producto['nombre_producto']) ?>">
                <div class="preview-overlay">
                    <div class="product-details">
                        <span class="product-category"><?= htmlspecialchars($producto['categria_producto']) ?></span>
                        <h2><?= htmlspecialchars($producto['nombre_producto']) ?></h2>
                        <div class="points-required">
                            <span class="points-value"><?= htmlspecialchars($producto['product_prices_points']) ?></span>
                            <span class="points-label">TP necesarios</span>
                        </div>
                    </div>
                </div>
            </div>

            <form class="exchange-form" action="process-product-exchange.php" method="POST">
                <input type="hidden" name="product_id" value="<?= htmlspecialchars($product_id) ?>">

                <div class="form-header">
                    <h3>Datos de envío</h3>
                    <div class="user-points">
                        <span class="points-available">Tus TrashPoints: </span>
                        <span class="points-value"><?= htmlspecialchars($usuario['user_points']) ?></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="nombre">Nombre completo</label>
                    <input type="text" id="nombre" name="nombre"
                        pattern="[A-Za-z\s]+" placeholder="Ej: Juan Pérez">
                </div>

                <div class="form-group">
                    <label for="telefono">Teléfono</label>
                    <input type="tel" id="telefono" name="telefono"
                        pattern="[0-9]{10}" placeholder="Ej: 8091234567">
                </div>

                <div class="form-group">
                    <label for="direccion">Dirección de envío</label>
                    <textarea id="direccion" name="direccion" rows="3"
                        placeholder="Ingresa tu dirección completa"></textarea>
                </div>

                <div class="form-group optional">
                    <label for="referencias">Referencias adicionales (opcional)</label>
                    <textarea id="referencias" name="referencias" rows="2"
                        placeholder="Punto de referencia, color de casa, etc."></textarea>
                </div>

                <div class="form-actions">
                    <a href="Tienda.php" class="btn-secondary">Cancelar</a>
                    <button type="submit" class="btn-primary">
                        Confirmar Canje
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M5 12h14M12 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>
            </form>
        </div>
    </div>
    <script src="scripts/exchange-product.js"></script>
</body>

</html>