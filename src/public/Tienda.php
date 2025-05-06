<?php
session_start();
include '../connection/conn.php';
checkUserPermissions('cliente');

//Verificar si el usuario está autenticado
if(!isset($_SESSION['user_id'])){
    header('Location: login.php');
    exit();
}

//Obtenemos los datos del usuario del a sesion
$user_id = $_SESSION['user_id'];

//Obtener los datos del usuario de la base de datos
$sql =  "SELECT * FROM users WHERE user_id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id',$user_id, PDO::PARAM_INT);
$stmt->execute();
$usuarios=  $stmt->fetch((PDO::FETCH_ASSOC));


//Obtener los datos de la tabla productos de la base de datos
$sql =  "SELECT * FROM productos";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$productos_tienda=  $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/Tienda.css">
    <title>TrashCycle - Tienda Premium Sostenible</title>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="logo">
            <img src="assets/images/logo-trashcicle-new.png" alt="TrashCycle Logo" width="150px" style="object-fit: cover;">
        </div>
        <div class="trash-points">
            <img src="assets/images/logo-trashcicle-desplex.png" alt="TrashPoints Icon">
            <span>TrashPoints: <?php echo $usuarios['user_points']?></span>
        </div>
        <nav class="nav">
            <a href="Tienda.php" class="nav-link active">Tienda</a>
            <a href="Afiliados.php" class="nav-link">Nuestros afiliados</a>
            <a href="formulario-contacto.php" class="nav-link">Contáctanos</a>
        </nav>
    </header>
    <!-- Hero Section -->
    <section class="hero">
        <h1>Energía Renovable</h1>
        <p>Gracias a tu ayuda, Trashcicle convierte desechos orgánicos en energía para las zonas que más lo necesitan. ¡Descubre cuánta energía has generado haciendo clic en "Ver energía"!</p>
        <a href="#" class="cta-button">Ver energía acomulada</a>
    </section>

    <!-- Filter Bar -->
    <div class="filter-bar">
        <h2 class="filter-title">Productos Destacados</h2>
        <div class="filter-options">
            <button class="filter-button active">Todos</button>
            <button class="filter-button">Deportes</button>
            <button class="filter-button">Hogar</button>
            <button class="filter-button">Otros</button>
        </div>
    </div>

    <!-- Product Grid -->
     <div class="wreapper">
        <div class="product-grid">
            <?php foreach ($productos_tienda as $producto): ?>
                <div class="product-card">
                    <div class="product-image">
                        <img src="uploads/<?= htmlspecialchars($producto['imagen_producto']) ?>" alt="<?= htmlspecialchars($producto['nombre_producto']) ?>">
                        <div class="product-tag"><?= htmlspecialchars($producto['product_etiqueta']) ?></div>
                    </div>
                    <div class="product-info">
                        <h3 class="product-title"><?= htmlspecialchars($producto['nombre_producto']) ?></h3>
                        <p class="product-description"><?= htmlspecialchars($producto['descripcion']) ?></p>
                        <div class="product-footer">
                            <div class="product-price">$RD<?= htmlspecialchars($producto['precio']) ?></div>
                            <div class="trash-points-badge">
                                <span><?= htmlspecialchars($producto['product_prices_points']) ?> TP</span>
                            </div>
                        </div>
                        <button class="add-to-cart">Canjear Producto</button>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Newsletter Section --> 
    <section class="newsletter">
        <h2>Únete a nuestra comunidad sostenible</h2>
        <p>Suscríbete para recibir las últimas novedades, ofertas exclusivas y consejos para un estilo de vida más sostenible.</p>
        <form class="newsletter-form">
            <input type="email" placeholder="Tu correo electrónico" class="newsletter-input">
            <button type="submit" class="newsletter-button">Suscribirse</button>
        </form>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <div class="footer-column">
                <h3>TrashCycle</h3>
                <p style="color: var(--text-light); margin-bottom: var(--spacing-md);">Transformando residuos en productos premium sostenibles.</p>
                <div class="footer-social">
                    <a href="#" class="social-icon">F</a>
                    <a href="#" class="social-icon">I</a>
                    <a href="#" class="social-icon">T</a>
                    <a href="#" class="social-icon">Y</a>
                </div>
            </div>
            <div class="footer-column">
                <h3>Navegación</h3>
                <div class="footer-links">
                    <a href="#" class="footer-link">Inicio</a>
                    <a href="#" class="footer-link">Productos</a>
                    <a href="#" class="footer-link">Sobre Nosotros</a>
                    <a href="#" class="footer-link">Blog</a>
                    <a href="#" class="footer-link">Contáctanos</a>
                </div>
            </div>
            <div class="footer-column">
                <h3>Categorías</h3>
                <div class="footer-links">
                    <a href="#" class="footer-link">Deportes</a>
                    <a href="#" class="footer-link">Hogar</a>
                    <a href="#" class="footer-link">Escolar</a>
                    <a href="#" class="footer-link">Accesorios</a>
                    <a href="#" class="footer-link">Novedades</a>
                </div>
            </div>
            <div class="footer-column">
                <h3>TrashPoints</h3>
                <div class="footer-links">
                    <a href="#" class="footer-link">¿Cómo funcionan?</a>
                    <a href="#" class="footer-link">Beneficios</a>
                    <a href="#" class="footer-link">Estado de puntos</a>
                    <a href="#" class="footer-link">Canjear puntos</a>
                    <a href="#" class="footer-link">Programa de afiliados</a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="copyright">© 2025 TrashCycle. Todos los derechos reservados.</div>
            <div class="footer-legal">
                <a href="#" class="legal-link">Términos y condiciones</a>
                <a href="#" class="legal-link">Política de privacidad</a>
                <a href="#" class="legal-link">Políticas de cookies</a>
            </div>
        </div>
    </footer>
    <script src="scripts/tienda.js"></script>
</body>
</html>