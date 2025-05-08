
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="IMG/recycle-favicon.png" type="image/x-icon">
    <title>TrashCicle - ¡Recicla y gana al hacerlo!</title>
    <link rel="stylesheet" href="styles/maquina.css">
    <link rel="stylesheet" href="styles/home.css">
</head>

<div class="main-container">

    <!-- header -->
    <header class="TrashCicle">
        <nav class="nav container" id="nav" style="overflow-x: hidden;">
            <a href="#">
                <img src="assets/images/logo.png" alt="logo" height="50px">
            </a>
            <ul class="nav__links">

                <!-- <li class="nav__item">
                    <div class="tooltip">
                        <p class="nav__link" id="user-points">TrashPoints: <span id="userPointsValue"></span></p>
                        <span class="tooltiptext">Estos son tus puntos actuales</span>
                    </div>
                </li> -->
                <li class="nav__item">
                    <a href="Tienda.php" class="nav__link">Tienda de puntos</a>
                </li>
                <li class="nav__item">
                    <a href="Afiliados.php" class="nav__link">Afiliados</a>
                </li>
                <li class="nav__item">
                    <a href="formulario-contacto.php" class="nav__link">Contáctanos</a>
                </li>
                <a href="login-form.php" class="nav__link">Ingresar</a>
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
    <!-- main section -->

    <main>
        <div class="main-info-container">
            <p>Cuida lo que amas, Cuida nuestro Planeta</p>
            <h1>¡<span>Recicla</span> y <span>Gana</span> al Hacerlo!</h1>
            <p>Somos una organización la cual se encarga del cuidado del medio
                ambiente y la salud de la comunidad, Nuestra organización fue creada
                con la finalidad de motivar a las personas, Especialmente a los jóvenes
                de hoy en día a cuidar y proteger el medio ambiente.
            </p>
            <form action="mapa.php">
                <button class="recicle-button">Recicla</button>
            </form>
        </div>
        <img src="assets/images/Basura.png" class="img_mover">
    </main>
    <div class="wave-svg-continer">
        <div class="wave-svg">
            <svg viewBox="0 0 500 150" preserveAspectRatio="none" style="height: 100%; width: 100%;">
                <path d="M-12.13,95.23 C118.79,-151.45 296.56,229.45 500.00,49.98 L500.00,150.00 L0.00,150.00 Z"
                    style="stroke: none; fill: rgb(252, 252, 252);"></path>
            </svg>
        </div>
    </div>
</div>
<!-- Informative section -->
<section>
    <div class="informative-section">
        <div class="recycle-title-container">
            <h2 class="recycle-title">♻️El reciclaje♻️</h2>
        </div>
        <div class="video-container">
            <video src="VIDEO/BENEFICIOS DEL RECICLAJE ♻️ ¿Qué es el reciclaje .mp4" controls class="recycle-video">
            </video>

            <p class="recycle-desc">El reciclaje es una práctica esencial para preservar nuestro planeta y mitigar
                el
                impacto ambiental. Al
                separar y reutilizar materiales, contribuimos a la reducción de residuos y la conservación de
                recursos
                naturales. Este pequeño gesto cotidiano tiene un efecto positivo significativo, ya que ayuda a
                disminuir
                la contaminación y promueve un estilo de vida sostenible.</p>
        </div>
    </div>
</section>
<!-- About us section -->
<section class="about-us-section">
    <div class="about-us-header">
        <h2>Sobre Nosotros</h2>
    </div>
    <div class="about-us-info-container">
        <div class="about-us-vision">
            <h3>La visión</h3>
            <p class="about-us-text">Nuestra visión es crear una sociedad en la que las personas tengan más en
                cuenta el tema del reciclaje, siendo más conscientes del daño que producen los desechos al medio
                ambiente y<span id="dots">...</span> <span id="moreContent">donde todos tomen acción para
                    cuidar
                    más nuestro hogar común, la tierra.</span></p>
            <button id="readMoreBtn" onclick="showContent(this)">Leer más</button>
        </div>
        <div class="about-us-mission">
            <h3>La misión</h3>
            <p class="about-us-text">Nuestra misión es educar a la comunidad acerca de la importancia
                ambiental y las repercusiones que trae una inadecuada gestión de residuos sólidos a<span
                    id="dots">...</span>
                <span id="moreContent"> nivel
                    global. Trabajamos para fomentar la conciencia sobre el cuidado del planeta.</span>
            </p>
            <button id="readMoreBtn" onclick="showContent(this)">Leer más</button>
        </div>
        <div class="about-us-skills">
            <h3>Nuestros valores</h3>
            <ul>
                <li>Honestidad</li>
                <li>Responsabilidad</li>
                <li>Solidaridad</li>
            </ul>
        </div>
    </div>
    <div class="prototipe-model-info-container">
        <div id="3d-model"
            style="position: relative; margin-left: 15px; border: 2px dashed #84ec57; width: fit-content; border-radius: 10px;">
        </div>

        <div class="prototipe-model-desc-container">
            <h2 class="prototipe-model-desc-title">Nuestro prototipo.</h2>
            <p class="prototipe-model-desc">Este es nuestro prototipo de zafacón inteligente llamado TrashCicle. Con el
                descubrirás una nueva forma de reciclar, ayudando al
                medio ambiente de una manera tecnológica y efectiva.</p>
            <button id="resetModelPosition">Reset</button>
        </div>
    </div>
    <script src="scriptstienda.js"></script>
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

<script src="scripts/home.js"></script>
<script type="module" src="scripts/tienda.js"></script>
<script type="module" src="scripts/maquina.js"></script>
</body>

</html>