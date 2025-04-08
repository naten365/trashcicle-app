<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trashcicle Admin Panel | Inicio</title>
    <!-- Enlace a los estilos de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles/homeplus.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light ">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class=" dropdown">
                        <a class="nav-link  dropdown-toggle d-flex align-items-center " href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: white;">
                            <img src="" alt="Usuario" class="user-image me-2" id="profileImage">
                            <span>Cuenta</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="settings.php">Configuración</a></li>
                            <li><a class="dropdown-item" href="login-form.php">Cerrar sesión</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <aside class="sidebar">
        <div class="logo">
            <img class="logo" src="/TRASHCICLE ADMIN PANEL/src/public/assets/images/logo-trashcicle.png" alt="">
        </div>
        <nav>
            <ul style="padding-left: 0;">

                <li>
                    <div class="nav-item active" data-filter="todos">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-home">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                            <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                            <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                        </svg>
                        Inicio
                    </div>
                </li>
                <li>
                    <a href="user-management.php">
                        <div class="nav-item">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-users">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                                <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
                            </svg>
                            Usuarios
                        </div>
                    </a>
                </li>
                <li>
                    <a href="prototypes.php">
                        <div class="nav-item">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-device-imac-cog">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 17h-8a1 1 0 0 1 -1 -1v-12a1 1 0 0 1 1 -1h16a1 1 0 0 1 1 1v8" />
                                <path d="M3 13h13" />
                                <path d="M8 21h4" />
                                <path d="M10 17l-.5 4" />
                                <path d="M19.001 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                <path d="M19.001 15.5v1.5" />
                                <path d="M19.001 21v1.5" />
                                <path d="M22.032 17.25l-1.299 .75" />
                                <path d="M17.27 20l-1.3 .75" />
                                <path d="M15.97 17.25l1.3 .75" />
                                <path d="M20.733 20l1.3 .75" />
                            </svg>
                            Zafacones
                        </div>
                    </a>
                </li>
                <li>
                    <a href="add-products.php">
                        <div class="nav-item">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-hexagon-plus-2">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M13.092 21.72a2.269 2.269 0 0 1 -2.184 0l-6.75 -4.27a2.225 2.225 0 0 1 -1.158 -1.948v-7.285c0 -.809 .443 -1.554 1.158 -1.947l6.75 -3.98a2.33 2.33 0 0 1 2.25 0l6.75 3.98h-.033c.7 .398 1.13 1.143 1.125 1.948v4.282" />
                                <path d="M16 19h6" />
                                <path d="M19 16v6" />
                            </svg>Productos
                        </div>
                    </a>
                </li>
                <li>
                    <a href="questions-and-answers.php">
                        <div class="nav-item">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-info-square-rounded">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 9h.01" />
                                <path d="M11 12h1v4h1" />
                                <path d="M12 3c7.2 0 9 1.8 9 9s-1.8 9 -9 9s-9 -1.8 -9 -9s1.8 -9 9 -9z" />
                            </svg>Dudas
                        </div>
                    </a>
                </li>
            </ul>

        </nav>
    </aside>
    <div class="cards-container">
        <div class="welcome-card" id="welcomeCard">
            <h2>¡Bienvenido GabrielR1905! 👋</h2>
            <p id="welcomeText">Estamos felices de verte.</p>
            <p id="tutorialText">Si necesitas una guía sobre el uso de Notatio, pasa a la siguiente diapositiva.</p>
            <div class="slider-controls">
                <button class="prev-slide-button" id="prevSlideButton">
                    <svg xmlns="http://www.w3.org/2000/svg" class="arrow" width="24" height="24" viewBox="0 0 24 24" fill="white" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-left">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M5 12l14 0" />
                        <path d="M5 12l6 6" />
                        <path d="M5 12l6 -6" />
                    </svg>
                </button>
                <div class="dots">
                    <span class="dot active"></span>
                    <span class="dot"></span>
                    <span class="dot"></span>
                    <span class="dot"></span>
                    <span class="dot"></span>
                </div>
                <button class="next-slide-button" id="nextSlideButton">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="white" class="arrow" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-right">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M5 12l14 0" />
                        <path d="M13 18l6 -6" />
                        <path d="M13 6l6 6" />
                    </svg>
                </button>
            </div>
        </div>
        <div class="classes-section">
            <h3 class="classes-grid-title">Acciones:</h3>
            <div class="classes-grid">
                <div class="class-card">
                    <a href="user-management.php" class="open-user-management-site">
                        <img src="assets/images/gestionar-users.jpg" alt="user">
                        <div class="action-container">
                            <p class="open-grades">Gestionar Usuarios</p>
                        </div>
                    </a>
                </div>
                <div class="class-card">
                    <a href="prototypes.php" class="open-user-management-site">
                        <img src="assets/images/manage-prototypes.jpeg" alt="manage prototypes">
                        <div class="action-container">
                            <p class="open-grades">Gestionar Zafacones</p>
                        </div>
                    </a>
                </div>
                <div class="class-card">
                    <a href="add-products.php" class="open-user-management-site">
                        <img src="assets/images/add-products.png" alt="manage prototypes">
                        <div class="action-container">
                            <p class="open-grades">Agregar Productos</p>
                        </div>
                    </a>
                </div>
                <div class="class-card">
                    <a href="register-user-form.php" class="open-user-management-site">
                        <img src="assets/images/create-users.png" alt="manage prototypes">
                        <div class="action-container">
                            <p class="open-grades">Crear Usuarios</p>
                        </div>
                    </a>
                </div>
            </div>

        </div>
    </div>

    <script src="scripts/homeplus.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>

</html>