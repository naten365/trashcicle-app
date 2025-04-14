<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="IMG/recycle-favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="CSS/formulario.css">
    <title>Crea tu cuenta | TrashCicle</title>
</head>

<body>
    <div class="container">
        <!-- <div class="div-button-back">
        </div> -->
        <div class="caja-form">
            <h1>Crear Cuenta</h1>
            <form action="Index.html" id="create-account-form">
                <input type="text" id="Name" placeholder="Ingrese su Nombre por favor"><br>
                <input type="text" id="Last-name" placeholder="Ingrese su apellido por favor"><br>
                <input type="email" id="Email" placeholder="Ingrese su email"><br>
                <input type="password" id="Password" placeholder="Ingrese su contraseña por favor"><br>
                <button type="submit" id="BTNSUmbit">enviar</button>
            </form>
            <span id="spanError"></span>
        </div>
    </div>

    <script src="JS/crear-cuenta.js"></script>
</body>

</html>