<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/product-desc.css">
    <link rel="shortcut icon" href="assets/images/recycle-favicon.png" type="image/x-icon">
    <title>Canjear producto | TrashCicle</title>
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
        <div class="product-container">
            <div class="product-img">
                <h1>Pelota de baloncesto</h1>
                <img src="assets/images/basket.jpg" alt="">
            </div>
            <div class="product-desc-container">
                <p class="product-desc">Sumérgete en el juego con nuestro balón de baloncesto Trashcicle,
                    una fusión de rendimiento y conciencia ecológica. Diseñado para destacar
                    en la cancha y cuidar del planeta, este balón no solo ofrece un agarre
                    excepcional y durabilidad, sino que también contribuye a la causa del
                    reciclaje. Únete al movimiento Trashcicle y haz tu parte por el medio
                    ambiente mientras disfrutas de cada jugada.
                </p>

                <div class="product-exchange-info">
                    <p>
                        <span>¡Consigue tu balón ahora y anota puntos no solo en la cancha, sino también en
                            sostenibilidad!</span>
                    </p>

                    <div class="product-exchange-form">
                        <p>Cantidad de puntos necesarios: <span id="amountOfPoints">825</span>.</p>
                        <button class="product-exchange-btn">Canjear</button>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <img src="assets/images/info-icon.png" alt="Imagen Informativa" onclick="openPopup()" class="popup-img1">
    <div class="contenedor-popup" id="popup">
        <div class="contenido-popup">
            <span class="close-btn" onclick="closePopup()">&times;</span>
            <h2>Instrucciones de reciclaje</h2>
            <p>Cuando llegue el momento de desechar la EcoBall, asegúrate de separar
                los materiales correctamente. La cubierta exterior es reciclable y puede
                ser depositada en los contenedores de reciclaje de plástico. Consulta
                los centros de reciclaje TrashCicle locales para obtener información específica.</p>
        </div>
    </div>
    <script type="module" src="scritps/tienda.js"></script>
    <script src="scritps/canjear-producto.js"></script>
    <script src="scritps/desc-producto.js"></script>
</body>

</html>