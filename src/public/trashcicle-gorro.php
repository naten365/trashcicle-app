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
                <h1>Gorro EcoHarmony Trashcicle</h1>
                <img src="IMG/gorroTrashCicle.jpg" alt="">
            </div>
            <div class="product-desc-container">
                <p class="product-desc">Sumérgete en la armonía de la moda sostenible con nuestra Gorro
                    EcoHarmony de TrashCicle. Esta prenda única, elaborada con materiales reciclados de alta
                    calidad, fusiona la elegancia moderna con un compromiso innegable hacia la preservación
                    del medio ambiente. El logo distintivo de TrashCicle destaca tu apoyo a la
                    causa del reciclaje y la sostenibilidad, convirtiendo este gorro en más que una prenda,
                    en un símbolo de tu conexión con la naturaleza. Canjea tu Gorro EcoHarmony en la página
                    de reciclaje TrashCicle y vístete con propósito, demostrando que la moda y la responsabilidad
                    ambiental pueden coexistir en perfecta armonía.
                </p>

                <div class="product-exchange-info">

                    <form action="" class="product-exchange-form">
                        <p>Cantidad de puntos necesarios: <span id="amountOfPoints">1300</span>.</p>
                        <button class="product-exchange-btn">Canjear</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <img src="img/info-icon.png" alt="Imagen Informativa" onclick="openPopup()" class="popup-img5">
    <div class="contenedor-popup" id="popup">
        <div class="contenido-popup">
            <span class="close-btn" onclick="closePopup()">&times;</span>
            <h2>Instrucciones de reciclaje</h2>
            <p>Cuando llegue el momento de actualizar tu guardarropa, desmonta cualquier
                componente no reciclable y consulta con nuestros centros de reciclaje más cercanos
                para asegurarte de desecharla de la manera más responsable.</p>
        </div>
    </div>
    <script type="module" src="JS/tienda.js"></script>
    <script src="JS/canjear-producto.js"></script>
    <script src="JS/desc-producto.js"></script>
</body>

</html>