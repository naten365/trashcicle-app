<?php
session_start();
include '../connection/conn.php';
checkUserPermissions('cliente');

//Verificar si el usuario está autenticado
if(!isset($_SESSION['user_id'])){
    header('Location: login.php');
    exit();
}

//Obtenemos los datos del usuario del a sesion
$user_id = $_SESSION['user_id'];

//Obtener los datos del usuario de la sesion de la base de datos
$sql =  "SELECT * FROM users WHERE user_id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id',$user_id, PDO::PARAM_INT);
$stmt->execute();
$usuarios=  $stmt->fetch((PDO::FETCH_ASSOC));

// Obtenemos la cantidad total de compras del usuario
$sql = "SELECT COUNT(*) AS total FROM compras WHERE usuario_id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id', $user_id, PDO::PARAM_INT);
$stmt->execute();
$compras = $stmt->fetch(PDO::FETCH_ASSOC);

// Acceder al número de compras
$totalCompras = $compras['total'];

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/customer-page.css">
    <title>Perfil de Usuario - Trashcicle</title>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="logo">
            <img src="assets/images/logo-trashcicle-new.png" alt="TrashCycle Logo" width="150px" style="object-fit: cover;">
        </div>
        <div class="nav-trashpoints">
            <img src="assets/images/logo-trashcicle-desplex.png" alt="TrashPoints Icon">
            <span><span class="span-title-trashpoints">TrashPoints:</span> <?php echo $usuarios['user_points']?></span>
        </div>
        <div class="nav-menu">
            <a href="#">Tienda</a>
            <a href="#">Nuestros afiliados</a>
            <a href="#">Contáctanos</a>
            <a href="#" class="active">Mi Perfil</a>
        </div>
    </nav>
    
    <!-- Main Container -->
    <div class="container">
        <div class="profile-wrapper">
            <!-- Sidebar -->
            <div class="profile-sidebar">
                <div class="profile-picture">
                    <div class="profile-picture-placeholder">
                        <img src="assets/images/rec1.png" alt="" width="100%" height="100%" style="object-fit: cover;">
                    </div>
                </div>
                <div class="profile-info">
                    <h2><?php echo $usuarios['user_real_name'] . ' ' . $usuarios['user_last_name']; ?></h2>
                    <p>Nombre de usuario: <strong><?php echo $usuarios['user_name']; ?></strong></p>
                </div>
                <div class="profile-stats">
                    <div class="stat-item">
                        <h3><?php echo $usuarios['user_points']; ?></h3>
                        <p>TrashPoints</p>
                    </div>
                    <div class="stat-item">
                        <h3><?php echo $usuarios['numero_reciclaje']; ?></h3>
                        <p>Reciclajes</p>
                    </div>
                    <div class="stat-item">
                        <h3><?php echo $totalCompras ?></h3>
                        <p>Compras</p>
                    </div>
                </div>
                <ul class="sidebar-menu">
                    <li>
                        <a href="#" class="active">
                            <span class="menu-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#7ed957" stroke-linecap="round" stroke-linejoin="round" width="24" height="24" stroke-width="2"> <path d="M3 3m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z"></path> <path d="M9 15v2"></path> <path d="M12 11v6"></path> <path d="M15 13v4"></path> </svg> </span>
                            Panel Principal
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span class="menu-icon" style="color: white;"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#7ed957" stroke-linecap="round" stroke-linejoin="round" width="24" height="24" stroke-width="2"> <path d="M13 3l0 7l6 0l-8 11l0 -7l-6 0l8 -11"></path> </svg> </span>
                            Mi Energía
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span class="menu-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#7ed957" stroke-linecap="round" stroke-linejoin="round" width="24" height="24" stroke-width="2"> <path d="M6.331 8h11.339a2 2 0 0 1 1.977 2.304l-1.255 8.152a3 3 0 0 1 -2.966 2.544h-6.852a3 3 0 0 1 -2.965 -2.544l-1.255 -8.152a2 2 0 0 1 1.977 -2.304z"></path> <path d="M9 11v-5a3 3 0 0 1 6 0v5"></path> </svg> </span>
                            Mis Compras
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span class="menu-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#7ed957" stroke-linecap="round" stroke-linejoin="round" width="24" height="24" stroke-width="2"> <path d="M4 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z"></path> <path d="M4 14m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z"></path> <path d="M14 14m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z"></path> <path d="M14 7l6 0"></path> <path d="M17 4l0 6"></path> </svg> </span>
                            Historial de Reciclaje
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span class="menu-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#7ed957" stroke-linecap="round" stroke-linejoin="round" width="24" height="24" stroke-width="2"> <path d="M4 12l10 0"></path> <path d="M4 12l4 4"></path> <path d="M4 12l4 -4"></path> <path d="M20 4l0 16"></path> </svg> </span>
                            Cerrar Sesión
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Main Content -->
            <div class="main-content">
                <!-- Panel General -->
                <div class="div-contend-panel-general">
                    <div class="content-header">
                        <h1>Panel Principal</h1>
                        <button class="btn animated" onclick="window.location.href='Tienda.php'">Reciclar Ahora</button>
                    </div>
                    
                    <!-- Energy Summary -->
                    <div class="energy-summary">
                        <h2>Tu Impacto Energético</h2>
                        <p>Gracias a tu ayuda, has contribuido a generar energía renovable</p>
                        
                        <div class="energy-stats">
                            <div class="energy-stat-card">
                                <h3>45 kWh</h3>
                                <p>Energía generada</p>
                            </div>
                            <div class="energy-stat-card">
                                <h3>15 kg</h3>
                                <p>Residuos reciclados</p>
                            </div>
                            <div class="energy-stat-card">
                                <h3>32 kg</h3>
                                <p>CO₂ evitado</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Activity Feed -->
                    <div class="activity-feed">
                        <h2 class="section-title">Actividad Reciente</h2>
                        
                        <div class="activity-item">
                            <div class="activity-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#7ed957" stroke-linecap="round" stroke-linejoin="round" width="24" height="24" stroke-width="2"> <path d="M12 17l-2 2l2 2"></path> <path d="M10 19h9a2 2 0 0 0 1.75 -2.75l-.55 -1"></path> <path d="M8.536 11l-.732 -2.732l-2.732 .732"></path> <path d="M7.804 8.268l-4.5 7.794a2 2 0 0 0 1.506 2.89l1.141 .024"></path> <path d="M15.464 11l2.732 .732l.732 -2.732"></path> <path d="M18.196 11.732l-4.5 -7.794a2 2 0 0 0 -3.256 -.14l-.591 .976"></path> </svg> </div>
                            <div class="activity-content">
                                <h3>Reciclaste 2.3kg de residuos orgánicos</h3>
                                <p>Has generado 12 TrashPoints y contribuido a 3.5 kWh de energía renovable</p>
                                <p class="activity-date">Hace 2 días</p>
                            </div>
                        </div>
                        
                        <div class="activity-item">
                            <div class="activity-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#7ed957" stroke-linecap="round" stroke-linejoin="round" width="24" height="24" stroke-width="2"> <path d="M12 19h-6a3 3 0 0 1 -3 -3v-8a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v4.5"></path> <path d="M3 10h18"></path> <path d="M16 19h6"></path> <path d="M19 16l3 3l-3 3"></path> <path d="M7.005 15h.005"></path> <path d="M11 15h2"></path> </svg> </div>
                            <div class="activity-content">
                                <h3>Compraste una Botella Ecológica</h3>
                                <p>Has canjeado 180 TrashPoints por este producto</p>
                                <p class="activity-date">Hace 1 semana</p>
                            </div>
                        </div>
                        
                        <div class="activity-item">
                            <div class="activity-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#7ed957" stroke-linecap="round" stroke-linejoin="round" width="24" height="24" stroke-width="2"> <path d="M8 21l4 0"></path> <path d="M10 21l0 -18"></path> <path d="M10 4l9 4l-9 4"></path> </svg> </div>
                            <div class="activity-content">
                                <h3>¡Nuevo logro desbloqueado!</h3>
                                <p>Has conseguido el logro <span class="badge">Protector del Planeta</span> por reciclar regularmente durante un mes</p>
                                <p class="activity-date">Hace 2 semanas</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Recommendations -->
                    <div class="recommendations">
                        <h2 class="section-title">Mi Energia</h2>
                    </div>
                </div>
                <!-- Panel de Energía -->
                <div class="div-contend-energia">
                    
                    <div class="content-header">
                        <h1>Panel de Energía</h1>
                        <button class="btn animated" onclick="window.location.href='Tienda.php'">Ver Estadísticas</button>
                    </div>

                    <!-- Energy Dashboard -->
                    <div class="energy-dashboard" style="display: none;">
                        <h2>Tu Producción Energética</h2>
                        <p>Visualiza tu contribución a la energía renovable a través del tiempo</p>
                        
                        <div class="energy-chart-container">
                            <canvas id="energyChart"></canvas>
                        </div>
                        
                        <div class="energy-highlights">
                            <div class="highlight-card">
                                <div class="highlight-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#7ed957" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M13 2L3 14h9l-1 8 10-16h-9l1-4z"></path>
                                    </svg>
                                </div>
                                <div class="highlight-content">
                                    <h3>45 kWh</h3>
                                    <p>Energía total generada</p>
                                </div>
                            </div>
                            
                            <div class="highlight-card">
                                <div class="highlight-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#7ed957" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M6 3v12"></path>
                                        <path d="M18 9v6"></path>
                                        <path d="M6 15h12"></path>
                                        <path d="M12 3v6"></path>
                                        <path d="M12 15v6"></path>
                                    </svg>
                                </div>
                                <div class="highlight-content">
                                    <h3>+27%</h3>
                                    <p>Incremento mensual</p>
                                </div>
                            </div>
                            
                            <div class="highlight-card">
                                <div class="highlight-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#7ed957" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M12 5v14"></path>
                                        <path d="M5 12h14"></path>
                                    </svg>
                                </div>
                                <div class="highlight-content">
                                    <h3>8 kWh</h3>
                                    <p>Meta semanal</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="scripts/customer-page-grafic.js"></script>
    <script src="scripts/customer-page.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
</body>
</html>