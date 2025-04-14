<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/product-desc.css">
    <link rel="shortcut icon" href="IMG/recycle-favicon.png" type="image/x-icon">
    <title>Canjear producto | TrashCicle</title>
</head>

<body>
    <!-- header -->
    <header class="TrashCicle">
        <nav class="nav container" id="nav">
            <a href="Index.html">
                <img src="IMG/logo.png" alt="logo" height="50px">
            </a>

            <ul class="nav__links">

                <li class="nav__item">
                    <div class="tooltip">
                        <p class="nav__link" id="user-points">TrashPoints: <span id="userPointsValue"></span></p>
                        <span class="tooltiptext">Estos son tus puntos actuales</span>
                    </div>
                </li>
                <li class="nav__item">
                    <a href="Tienda.html" class="nav__link">Tienda de puntos</a>
                </li>
                <li class="nav__item">
                    <a href="Afiliados.html" class="nav__link">Afiliados</a>
                </li>
                <li class="nav__item">
                    <a href="formulario-contacto.html" class="nav__link">Contáctanos</a>
                </li>

            </ul>
            <a href="#nav" class="nav__hamburguer">
                <img src="IMG/menu.svg" class="nav__icon">
                <a href="#" class="nav__close">
                    <img src="IMG/close.svg" class="nav__icon">
                </a>
            </a>
        </nav>
    </header>
    <main>
        <div class="product-container">
            <div class="product-img">
                <h1>Tarjeta de viajes OMSA</h1>
                <img src="IMG/omsa.jpg" alt="">
            </div>
            <div class="product-desc-container">
                <p class="product-desc">¡Explora una nueva era de movilidad sostenible con la Tarjeta TrashCicle
                    OMSA! Esta tarjeta exclusiva de autobuses metropolitanos te ofrece viajes mientras
                    contribuyes al bienestar del planeta. Convierte tus
                    desplazamientos diarios en una oportunidad para ser parte del cambio. Únete a TrashCicle
                    y experimenta una forma única y gratificante de moverte por la ciudad mientras cuidas del
                    medio ambiente. ¡Viaja, recicla y sé parte de la revolución sostenible!
                </p>

                <div class="product-exchange-info">

                    <form action="" class="product-exchange-form">
                        <p>Cantidad de puntos necesarios: <span id="amountOfPoints">1500</span>.</p>
                        <button class="product-exchange-btn">Canjear</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <img src="img/1.png" alt="Imagen Informativa" onclick="openPopup()" class="popup-img4">
    <div class="contenedor-popup" id="popup">
        <div class="contenido-popup">
            <span class="close-btn" onclick="closePopup()">&times;</span>
            <h2>Instrucciones de reciclaje</h2>
            <p>Mantén tu EcoPass en buen estado evitando dobleces y daños físicos. Cuando llegue
                el momento de reciclarla, asegúrate de llevarla a al centro de reciclaje TrashCicle
                más cercano. La tarjeta es recargable, pero también es reciclable</p>
        </div>
    </div>
    <script type="module" src="JS/tienda.js"></script>
    <script src="JS/canjear-producto.js"></script>
    <script src="JS/desc-producto.js"></script>
</body>

</html>