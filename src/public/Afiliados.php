<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="IMG/recycle-favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="styles/Afiliados.css ">
    <title>Nuestros afiliados | TrashCicle</title>
</head>

<body>

    <!-- header -->
    <header class="TrashCicle">
        <nav class="nav container" id="nav">
            <a href="index.php">
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
                    <a href="Tienda.php" class="nav__link">Tienda de puntos</a>
                </li>

                <li class="nav__item">
                    <a href="formulario-contacto.php" class="nav__link">Contactános</a>
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
    <!-- header -->

    <!-- titulo y parrafo -->
    <div class="mover_afiliados">
        <h1 class="h2">Afiliados</h1>
        <img src="assets/images/hola.webp" id="imagen" class="img40">
        <p class="p">Este proyecto tiene varios afiliados los cuales ayudan
            en la creación y mantenimiento de este sitio web y de nuestro
            prototipo, el cual ayuda al medio ambiente motivando a todo tipo
            de personas a reciclar el plastico que utilizan en su dia a dia,
            para asi que estos no lo tiren a la calle, ya que estos plasticos
            contaminan nuestro planeta.
        </p>
    </div>
    <!-- titulo y parrafo -->

    <!-- tarjetas de afiliados -->
    <div class="tag">
        <div class="afi">
            <h1>Nuestros Afiliados</h1>
            <p>TrashCicle tiene 3 afiliados potenciales para el mantenimiento
                y apoyo a nuestro sistema para mejorar nuestro pais y todo el mundo. </p>
        </div>
        <div class="container">
            <section class="sec">
                <div class="sec-image">
                    <img src="assets/images/medio.jpg" alt="">
                </div>
                <div class="sec-content">
                    <h2>Ministerio de Medio Ambiente</h2>
                    <p>El Ministerio de Medio Ambiente, colaborará con TrashCicle,
                        un proyecto nacional de recolección de basura, brindando asesoramiento y apoyo logístico.
                        Esta asociación fortalecería la capacidad de TrashCicle y promovería la cooperación entre
                        el sector público y las iniciativas privadas para prácticas sostenibles en el país.
                    </p>
                    <button id="mostrarVentana" class="btn">Más Sobre ellos</button>

                </div>
            </section>
        </div>

        <div class="container">
            <section class="sec">
                <div class="sec-image">
                    <img src="assets/images/salud.png" alt="">
                </div>
                <div class="sec-content">
                    <h2>Ministerio de Salud Publica</h2>
                    <p>El Ministerio de Salud Pública , como entidad responsable de la
                        salud de la población, podrá desempeñar un papel clave en el proyecto TrashCicle.
                        Su participación podría incluir la implementación de medidas de salud pública relacionadas con
                        la gestión
                        de residuos y la promoción de prácticas ambientales saludables, fortaleciendo así la iniciativa
                        de TrashCicle
                        y contribuyendo a un entorno más saludable para la comunidad.
                    </p>
                    <button id="mostrarVentana2" class="btn">Más Sobre ellos</button>
                </div>
            </section>
        </div>

        <div class="container">
            <section class="sec">
                <div class="sec-image">
                    <img src="assets/images/logomopc.png" alt="">
                </div>
                <div class="sec-content">
                    <h2>Ministerio de Obras Publicas y Comunicaciones</h2>
                    <p>El Ministerio de Obras Públicas y Comunicaciones, dedicado a la infraestructura y
                        comunicaciones, podrá desempeñar un papel crucial en TrashCicle, Su colaboración
                        potencial acabará la implementación de medidas enfocadas en la gestión de desechos
                        y la promoción de prácticas sostenibles, fortaleciendo así la capacidad de TrashCicle
                        y contribuyendo al avance de la infraestructura ambiental en todo el país.
                    </p>
                    <button id="mostrarVentana3" class="btn">Más Sobre ellos</button>
                </div>
            </section>
        </div>
    </div>
    <!-- tarjetas de afiliados -->

    <!-- Ventana Emergente -->
    <div id="ventanaEmergente">
        <div id="contenidoVentana">
            <p>Vas a ser redirigido a un Sitio Web donde obtendras mas informacion sobre uno de nuestros clientes
                potenciales para la elaboracion de nuestro proyecto.
            </p>
            <a href="" id="cerrarVentana" target="_blank">Aceptar</a>
        </div>
    </div>

    <div id="fondoOscuro"></div>
    <!-- Ventana Emergente -->

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
    <script  src="scripts/afiliados.js"></script>
    <script type="module" src="scripts/tienda.js"></script>
    <script src="scripts/canjear-producto.js"></script>
</body>

</html>