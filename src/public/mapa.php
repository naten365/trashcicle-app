<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/mapa.css">
    <link rel="shortcut icon" href="assets/images/recycle-favicon.png" type="image/x-icon">
    <title>Puntos verdes | TrashCicle</title>
</head>

<body>
    <!-- header -->
    <header class="TrashCicle">
        <nav class="nav container" id="nav">
            <a href="index.html">
                <img src="assets/images//logo.png" alt="logo" height="50px">
            </a>

            <ul class="nav__links">
                <li class="nav__item">
                    <a href="Tienda.php" class="nav__link">Tienda de puntos</a>
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
        <div class="map-container">
            <h1><span class="title">Puntos verdes</span> disponibles:</h1>
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d80805.84009116059!2d-69.84156098772507!3d18.506350007902153!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8eaf86f1f07bf257%3A0x79a94f00155fb584!2sSanto%20Domingo%20Este!5e0!3m2!1ses-419!2sdo!4v1705342929846!5m2!1ses-419!2sdo"
                width="900" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>

            <button onclick="openWindow()">Más información</button>

            <div class="overlay" id="overlay" onclick="closeWindow()"></div>

            <div class="window-container" id="popup">
                <p>En esta sección, se presenta la ubicación de cada punto verde. Actualmente, los puntos disponibles se
                    encuentran exclusivamente en <span>Santo Domingo</span>, <span>Puerto Plata</span>, <span>La Romana
                        y Boca Chica</span>.</p>
                <button class="btn-close" onclick="closeWindow()">Cerrar</button>
            </div>
        </div>
    </main>
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
    <script src="scripts/nav-menu.js"></script>
    <script src="scripts/abrir-modal.js"></script>
</body>

</html>