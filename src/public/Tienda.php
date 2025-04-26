<?php
session_start();
include '../connection/conn.php';
// Verifica si el usuario está logueado
if (!isset($_SESSION['user_id'])) {
    header("Location: login-form.php"); // Redirige al login si no hay sesión
    exit();
}
checkUserPermissions('cliente');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="IMG/recycle-favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="styles/Tienda.css">
    <title>¡Canjea tus recompensas! | TrashCicle</title>
</head>

<body>
    <!-- header -->
    <header class="TrashCicle">
        <nav class="nav container" id="nav">
            <a href="index.html">
                <img src="assets/images/logo.png" alt="logo" height="50px">
            </a>

            <ul class="nav__links">

                <li class="nav__item">
                    <div class="tooltip">
                        <p class="nav__link" id="user-points">TrashPoints: <span id="userPointsValue"></span></p>
                        <span class="tooltiptext">Estos son tus puntos actuales</span>
                    </div>
                </li>
                <li class="nav__item">
                    <a href="index.php" class="nav__link">Inicio</a>
                </li>
                <li class="nav__item">
                    <a href="Afiliados.php" class="nav__link">Afiliados</a>
                </li>
                <li class="nav__item">
                    <a href="formulario-contacto.php" class="nav__link">Contáctanos</a>
                </li>

            </ul>

            <a href="#nav" class="nav__hamburguer">
                <img src="assets/images/menu.svg" class="nav__icon">
                <a href="#" class="nav__close">
                    <img src="assets/images/close.svg" class="nav__icon">
                </a>
            </a>
        </nav>
    </header>
    <main>
        <div class="shop-title-container">
            <h1>¡Bienvenido a la tienda de TrashCicle!</h1>
        </div>
        <div class="slider">
            <div class="slide-track">
                <div class="slide">
                    <img src="assets/images/rec1.png" alt="">
                </div>
                <div class="slide">
                    <img src="assets/images/rec2.jpg" alt="">
                </div>
                <div class="slide">
                    <img src="assets/images/rec3.jpg" alt="">
                </div>
                <div class="slide">
                    <img src="assets/images/rec4.jpg" alt="">
                </div>
                <div class="slide">
                    <img src="assets/images/rec5.jpg" alt="">
                </div>
                <div class="slide">
                    <img src="assets/images/rec6.jpg" alt="">
                </div>
                <div class="slide">
                    <img src="assets/images/rec7.jpg" alt="">
                </div>

                <div class="slide">
                    <img src="assets/images/rec1.png" alt="">
                </div>
                <div class="slide">
                    <img src="assets/images/rec2.jpg" alt="">
                </div>
                <div class="slide">
                    <img src="assets/images/rec3.jpg" alt="">
                </div>
                <div class="slide">
                    <img src="assets/images/rec4.jpg" alt="">
                </div>
                <div class="slide">
                    <img src="assets/images/rec5.jpg" alt="">
                </div>
                <div class="slide">
                    <img src="assets/images/rec6.jpg" alt="">
                </div>
                <div class="slide">
                    <img src="assets/images/rec7.jpg" alt="">
                </div>
            </div>
        </div>
    </main>
    <div class="shop-arrow-container">
        <img src="assets/images/arrow.png" alt="">
    </div>
    <section>
        <div class="shop-product-container">
            <div class="product-card">
                <a href="balon-basket.php">
                    <img src="assets/images/basket.jpg" alt="" class="product">
                </a>
                <div class="product-image-text">
                    <p>Balón de basketball.</p>
                </div>
            </div>
            <div class="product-card">
                <a href="balon-basket.php">
                    <img src="assets/images/balon-de-futbol-soccer.jpg" alt="" class="product">
                </a>
                <div class="product-image-text">
                    <p>Balón balon de fútbol.</p>
                </div>
            </div>
            <div class="product-card">
                <a href="balon-basket.php">
                    <img src="assets/images//bate.jpg" alt="" class="product">
                </a>
                <div class="product-image-text">
                    <p>Bate de béisbol.</p>
                </div>
            </div>
            <div class="product-card">
                <a href="balon-basket.php">
                    <img src="assets/images//omsa.jpg" alt="" class="product">
                </a>
                <div class="product-image-text">
                    <p>Tarjeta de viajes en la OMSA.</p>
                </div>
            </div>
            <div class="product-card">
                <a href="balon-basket.php">
                    <img src="assets/images/gorroTrashCicle.jpg" alt="" class="product">
                </a>
                <div class="product-image-text">
                    <p>Merch de TrashCicle (Gorro).</p>
                </div>
            </div>
            <div class="product-card">
                <a href="balon-basket.php">
                    <img src="assets/images/trashCicleHoodie.jpg" alt="" class="product">
                </a>
                <div class="product-image-text">
                    <p>Merch de TrashCicle (Abrigo).</p>
                </div>
            </div>
        </div>
    </section>
    <!-- Footer section -->
    <footer>
        <div class="footer">
            <div class="logof">
                <img src="assets/images/logo.png" alt="">
            </div>
            <div class="row">
                <a href="#"></a>
                <a href="#"></a>
                <a href="#"></a>
                <a href="#"></a>
            </div>

            <div class="row">
                <ul>
                    <li><a href="formulario-contacto.php">Contáctanos</a></li>
                    <li><a href="#">Política de privacidad</a></li>
                    <li><a href="#">Términos y condiciones</a></li>
                    <li><a href="#">Política de cookies</a></li>
                </ul>
            </div>

            <div class="row">
                <p>TRASHCICLE Copyright © 2024 || Designed By: Frederick R.</p>
            </div>
        </div>
    </footer>

    <script src="scritps/nav-menu.js"></script>
    <script type="module" src="scritps/tienda.js"></script>
</body>

</html>