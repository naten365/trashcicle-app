<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="IMG/recycle-favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="styles/formulario.css">
    <title>Contacta con nosotros | TrashCicle</title>
</head>

<div id="alerta-personalizada" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden transition-opacity duration-300">
  <div class="bg-[var(--oscuro)] border border-[var(--primario)] text-[var(--claro)] px-6 py-4 rounded-lg shadow-xl max-w-md w-full text-center animacion-fadeIn">
    <p id="mensaje-alerta" class="mb-2"></p>
    <button onclick="ocultarAlerta()" class="mt-2 px-4 py-1 bg-[var(--primario)] text-[--oscuro] rounded hover:bg-[var(--primario-oscuro)] transition">Cerrar</button>
  </div>
</div>

<body>
    <header class="TrashCicle">
        <nav class="nav container" id="nav">
            <a href="Index.html">
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
                    <a href="Afiliados.php" class="nav__link">Afiliados</a>
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
    <div class="form-container">
        <div class="caja-form">
            <h1>Contáctanos</h1>
            <form action="index.php" id="create-account-form">
                <input type="text" id="Name" placeholder="Ingrese su Nombre por favor"><br>
                <input type="text" id="Last-name" placeholder="Ingrese su apellido por favor"><br>
                <input type="email" id="Email" placeholder="Ingrese su email"><br>
                <textarea name="" id="TextAreaInput" rows="5" placeholder="Escribe tu mensaje aquí"></textarea><br>
                <button type="submit" id="BTNSUmbit">enviar</button>
            </form>
            <span id="spanError"></span>
        </div>
      </div>
      <div>
        <h1>DD</h1>
      </div>

    <script src="scripts/formulario.js"></script>
    <script src="scripts/nav-menu.js"></script>
    <script type="module" src="scritps/tienda.js"></script>
</body>
</html>
