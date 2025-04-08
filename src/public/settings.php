<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trashcicle | Configuración</title>
    <link rel="stylesheet" href="styles/settings.css">
</head>

<body id="main-body">

    <img src="assets/images/logo-trashcicle.png" class="logo">

    <!-- Manito esto es Contenido -->
    <div class="content">
        <a href="home.php" class="circle">
            <svg xmlns="http://www.w3.org/2000/svg" class="arrow" width="24" height="24" viewBox="0 0 24 24" fill="white" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-left">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M5 12l14 0" />
                <path d="M5 12l6 6" />
                <path d="M5 12l6 -6" />
            </svg></a>
        <h1>Configuración</h1>
        <div class="config-container">
            <div class="config-row">
                <div class="config-item inline">
                    <label for="language">Idioma</label>
                    <select id="language">
                        <option value="Español Latino">Español Latino</option>
                        <option value="Español Castellano">Español Castellano</option>
                    </select>
                </div>

                <div class="config-item inline">
                    <label for="light-mode">Modo Claro</label>
                    <div class="toggle-switch">
                        <input type="checkbox" id="light-mode" class="toggle-input">
                        <label for="light-mode" class="toggle-label"></label>
                    </div>
                </div>
            </div>
            <div class="config-item">
                <label for="new-username">Cambiar Nombre de usuario:</label>
                <input type="text" id="new-username" placeholder="Nuevo nombre de usuario">
            </div>
            <div class="config-item">
                <label for="new-password">Cambiar contraseña:</label>
                <input type="password" id="new-password" placeholder="Nueva contraseña">
            </div>
            <div class="config-item">
                <label for="confirm-password">Confirmar contraseña:</label>
                <input type="password" id="confirm-password" placeholder="Confirmar contraseña">
            </div>
            <div class="config-item">
                <label for="notif-toggle">Activar notificaciones</label>
                <div class="toggle-switch1">
                    <input type="checkbox" id="notif-toggle" class="toggle-input1">
                    <label for="notif-toggle" class="toggle-label1"></label>
                </div>
            </div>
            <div class="config-item1">
                <label class="change-photo-profile">Cambiar foto de Perfil:</label>
            </div>
            <div class="profile-container">
                <img src="IMG/Cabra.png" alt="Foto de perfil" id="profileImage" class="profile-image">
                <button class="edit-icon" id="editButton">✏️</button>
            </div>

            <input type="file" id="fileInput" class="hidden-input" accept="image/*">

            <div class="config-row">
                <div class="config-item">
                    <button id="reset-config">Restablecer Configuración</button>
                </div>
            </div>

            <div class="config-row">
                <div class="config-item">
                    <button id="safe-config">Guardar Cambios</button>
                </div>
            </div>

        </div>
        <div id="notification" class="notification"></div>
    </div>
    <script src="scripts/settings.js"></script>
</body>

</html>