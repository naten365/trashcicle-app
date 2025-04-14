<?php
session_start();
include '../connection/conn.php';
checkUserPermissions('admin');
?>
<html>
<head>
    <title>Preguntas Frecuentes</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/questions-and-answers.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>

<body>
    <div class="hero">
        <h1>Preguntas Frecuentes</h1>
        <p class="subtitle">¿Tienes preguntas? Estamos aquí para ayudar.</p>
    </div>
    <div class="container">
        <div class="search-box">
            <input type="text" id="search-input" placeholder="Buscar">
            <i class="fas fa-search"></i>
        </div>
        <div class="faq-list" id="faq-list">
            <div class="faq-item">
                <div class="faq-question">
                    <span>¿Puedo ponerme una foto de perfil personalizada?</span>
                    <i class="fas fa-plus"></i>
                </div>
                <div class="faq-answer">
                    Sí, en nuestra sección de configuración puedes editar tu foto de perfil a una personalizada y esta se verá reflejada en todo el sistema.
                </div>
            </div>
            <div class="faq-item">
                <div class="faq-question">
                    <span>¿Cómo edito mi contraseña?</span>
                    <i class="fas fa-plus"></i>
                </div>
                <div class="faq-answer">
                   En la parte de configuración puedes cambiar tu contraseña de acceso llenando el campo correspondiente y guardando tus cambios.
                </div>
            </div>
            <div class="faq-item">
                <div class="faq-question">
                    <span>¿Por qué no puedo ver todos los zafacones?</span>
                    <i class="fas fa-plus"></i>
                </div>
                <div class="faq-answer">
                    asegúrese de que su conexión a Internet sea estable y actualice la página.
                </div>
            </div>
        </div>
    </div>
    <script src="scripts/questions-and-answers.js"></script>
</body>

</html>