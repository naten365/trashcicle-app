<?php
session_start();
include '../connection/conn.php';

//Verificar si el usuario está autenticado
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}


//Obtenemos los datos del usuario del a sesion
$user_id = $_SESSION['user_id'];

//Obtener los datos del usuario de la base de datos
$sql = "SELECT * FROM users WHERE user_id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id', $user_id, PDO::PARAM_INT);
$stmt->execute();
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TrashCicle | Inicio</title>
    <link rel="stylesheet" href="styles/Tienda.css">
    <link rel="stylesheet" href="styles/home-user.css">
</head>

<body>
    <!-- Header -->
    <header class="header" style="display: flex;
  flex-direction: row;">
        <div class="logo">
            <img src="assets/images/logo-trashcicle-new.png" alt="TrashCycle Logo" width="150px" style="object-fit: cover;">
        </div>
        <button class="menu-toggle" id="menuToggle">
            <span></span>
            <span></span>
            <span></span>
        </button>
        <!-- Añade el ID mainNav al nav -->
        <nav class="nav" id="mainNav">
            <div class="trash-points">
                <img src="assets/images/logo-trashcicle-desplex.png" alt="TrashPoints Icon">
                <span>TrashPoints: <?php echo $usuario['user_points'] ?></span>
            </div>
            <a href="home-user.php" class="nav-link active">Inicio</a>
            <a href="Tienda.php" class="nav-link">Tienda</a>
            <a href="customer-page.php" class="nav-link">Mi perfil</a>
        </nav>
    </header>
    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content home">
            <h1>¡Bienvenido a Trashcicle!</h1>
            <p>Continúa contribuyendo al medio ambiente y acumula más TrashPoints para canjear por productos sostenibles.</p>
            <div class="hero-actions">
                <a href="Tienda.php" class="cta-btn">Ver Tienda</a>
                <a href="customer-page.php" style="color: var(--text-light)">Ver mi perfil →</a>
            </div>
        </div>
    </section>

    <!-- Quick Actions -->
    <section class="quick-actions">
        <div class="action-card" onclick="window.location='ubicaciones.php'">
            <div class="action-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-map-pins">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M10.828 9.828a4 4 0 1 0 -5.656 0l2.828 2.829l2.828 -2.829z" />
                    <path d="M8 7l0 .01" />
                    <path d="M18.828 17.828a4 4 0 1 0 -5.656 0l2.828 2.829l2.828 -2.829z" />
                    <path d="M16 15l0 .01" />
                </svg></div>
            <div class="action-content">
                <h3>Puntos de Recolección</h3>
                <p>Encuentra el punto más cercano</p>
            </div>
        </div>
        <div class="action-card" onclick="window.location='canjear-puntos.php'">
            <div class="action-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-gift">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M3 8m0 1a1 1 0 0 1 1 -1h16a1 1 0 0 1 1 1v2a1 1 0 0 1 -1 1h-16a1 1 0 0 1 -1 -1z" />
                    <path d="M12 8l0 13" />
                    <path d="M19 12v7a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-7" />
                    <path d="M7.5 8a2.5 2.5 0 0 1 0 -5a4.8 8 0 0 1 4.5 5a4.8 8 0 0 1 4.5 -5a2.5 2.5 0 0 1 0 5" />
                </svg></div>
            <div class="action-content">
                <h3>Canjear Puntos</h3>
                <p>Productos disponibles para ti</p>
            </div>
        </div>
        <div class="action-card" onclick="window.location='historial.php'">
            <div class="action-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-history">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M12 8l0 4l2 2" />
                    <path d="M3.05 11a9 9 0 1 1 .5 4m-.5 5v-5h5" />
                </svg></div>
            <div class="action-content">
                <h3>Mi Historial</h3>
                <p>Ver mis reciclajes y canjes</p>
            </div>
        </div>
        <div class="action-card" onclick="window.location='referidos.php'">
            <div class="action-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-share">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M6 12m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                    <path d="M18 6m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                    <path d="M18 18m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                    <path d="M8.7 10.7l6.6 -3.4" />
                    <path d="M8.7 13.3l6.6 3.4" />
                </svg></div>
            <div class="action-content">
                <h3>Invitar Amigos</h3>
                <p>Gana puntos extra por referidos</p>
            </div>
        </div>
    </section>
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
                <h3>TrashCicle</h3>
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
            <div class="copyright">© 2025 TrashCicle. Todos los derechos reservados.</div>
            <div class="footer-legal">
                <a href="#" class="legal-link">Términos y condiciones</a>
                <a href="#" class="legal-link">Política de privacidad</a>
                <a href="#" class="legal-link">Políticas de cookies</a>
            </div>
        </div>
    </footer>
    <script src="scripts/home-user.js"></script>
</body>

</html>