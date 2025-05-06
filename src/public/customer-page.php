<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuario - Trashcicle</title>
    <style>
        :root {
            --main-bg-color: #121418;
            --secondary-bg-color: #1a1d23;
            --accent-color: #7ed957;
            --text-color: #ffffff;
            --text-secondary: #a0a0a0;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: var(--main-bg-color);
            color: var(--text-color);
            min-height: 100vh;
        }
        
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 2rem;
            background-color: rgba(26, 29, 35, 0.95);
            border-bottom: 1px solid #2a2e36;
        }
        
        .logo {
            display: flex;
            align-items: center;
        }
        
        .logo img {
            height: 40px;
        }
        
        .nav-trashpoints {
            display: flex;
            align-items: center;
            background-color: rgba(26, 29, 35, 0.8);
            padding: 0.5rem 1rem;
            border-radius: 50px;
            border: 1px solid #2a2e36;
        }
        
        .nav-trashpoints img {
            height: 24px;
            margin-right: 8px;
        }
        
        .nav-menu {
            display: flex;
            gap: 2rem;
        }
        
        .nav-menu a {
            color: var(--text-color);
            text-decoration: none;
            font-weight: 500;
            position: relative;
            padding-bottom: 5px;
        }
        
        .nav-menu a.active {
            color: var(--accent-color);
        }
        
        .nav-menu a.active::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: -10px;
            width: 100%;
            height: 3px;
            background-color: var(--accent-color);
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }
        
        .profile-wrapper {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 2rem;
        }
        
        .profile-sidebar {
            background-color: var(--secondary-bg-color);
            border-radius: 10px;
            padding: 1.5rem;
            height: fit-content;
        }
        
        .profile-picture {
            width: 120px;
            height: 120px;
            background-color: #2a2e36;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            overflow: hidden;
        }
        
        .profile-picture img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .profile-picture-placeholder {
            font-size: 48px;
            color: var(--text-secondary);
        }
        
        .profile-info {
            text-align: center;
            margin-bottom: 2rem;
        }
        
        .profile-info h2 {
            margin-bottom: 0.5rem;
        }
        
        .profile-info p {
            color: var(--text-secondary);
        }
        
        .profile-stats {
            display: flex;
            justify-content: space-between;
            text-align: center;
            padding: 1rem 0;
            border-top: 1px solid #2a2e36;
            border-bottom: 1px solid #2a2e36;
            margin-bottom: 1.5rem;
        }
        
        .stat-item h3 {
            font-size: 1.5rem;
            color: var(--accent-color);
            margin-bottom: 0.3rem;
        }
        
        .stat-item p {
            font-size: 0.85rem;
            color: var(--text-secondary);
        }
        
        .sidebar-menu {
            list-style: none;
        }
        
        .sidebar-menu li {
            margin-bottom: 0.8rem;
        }
        
        .sidebar-menu a {
            display: flex;
            align-items: center;
            color: var(--text-color);
            text-decoration: none;
            padding: 0.8rem;
            border-radius: 8px;
            transition: all 0.2s ease;
        }
        
        .sidebar-menu a:hover {
            background-color: rgba(126, 217, 87, 0.1);
        }
        
        .sidebar-menu a.active {
            background-color: var(--accent-color);
            color: #121418;
            font-weight: 500;
        }
        
        .menu-icon {
            margin-right: 0.8rem;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .main-content {
            background-color: var(--secondary-bg-color);
            border-radius: 10px;
            padding: 1.5rem;
        }
        
        .content-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }
        
        .energy-summary {
            background: linear-gradient(to right, rgba(126, 217, 87, 0.2), rgba(26, 29, 35, 0.8));
            border-radius: 10px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            display: flex;
            flex-direction: column;
        }
        
        .energy-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
            margin-top: 1rem;
        }
        
        .energy-stat-card {
            background-color: rgba(26, 29, 35, 0.8);
            border-radius: 8px;
            padding: 1rem;
            text-align: center;
        }
        
        .energy-stat-card h3 {
            font-size: 2rem;
            color: var(--accent-color);
            margin-bottom: 0.5rem;
        }
        
        .badge {
            display: inline-block;
            background-color: rgba(126, 217, 87, 0.2);
            color: var(--accent-color);
            padding: 0.3rem 0.8rem;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 500;
        }
        
        .activity-feed {
            margin-top: 2rem;
        }
        
        .activity-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 1.5rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid #2a2e36;
        }
        
        .activity-icon {
            background-color: rgba(126, 217, 87, 0.1);
            width: 40px;
            height: 40px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            color: var(--accent-color);
        }
        
        .activity-content {
            flex-grow: 1;
        }
        
        .activity-date {
            color: var(--text-secondary);
            font-size: 0.85rem;
        }
        
        .btn {
            background-color: var(--accent-color);
            color: #121418;
            border: none;
            padding: 0.8rem 1.5rem;
            border-radius: 8px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }
        
        .btn:hover {
            background-color: #6bc249;
        }
        
        .btn-outline {
            background-color: transparent;
            border: 1px solid var(--accent-color);
            color: var(--accent-color);
        }
        
        .btn-outline:hover {
            background-color: rgba(126, 217, 87, 0.1);
        }
        
        .section-title {
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
            position: relative;
            display: inline-block;
        }
        
        .section-title::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: -8px;
            width: 40px;
            height: 3px;
            background-color: var(--accent-color);
        }
        
        /* Responsive */
        @media (max-width: 992px) {
            .profile-wrapper {
                grid-template-columns: 1fr;
            }
            
            .profile-sidebar {
                margin-bottom: 2rem;
            }
            
            .energy-stats {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        
        @media (max-width: 768px) {
            .navbar {
                padding: 1rem;
            }
            
            .nav-menu {
                gap: 1rem;
            }
            
            .container {
                padding: 1rem;
            }
            
            .profile-picture {
                width: 100px;
                height: 100px;
            }
            
            .energy-stats {
                grid-template-columns: 1fr;
            }
        }
        
        @media (max-width: 576px) {
            .profile-stats {
                flex-direction: column;
                gap: 1rem;
            }
            
            .stat-item {
                padding: 0.5rem 0;
                border-bottom: 1px solid #2a2e36;
            }
            
            .stat-item:last-child {
                border-bottom: none;
            }
            
            .content-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="logo">
            <img src="/api/placeholder/120/40" alt="Trashcicle Logo">
        </div>
        <div class="nav-trashpoints">
            <img src="/api/placeholder/24/24" alt="TrashPoints icon">
            <span>TrashPoints: 240</span>
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
                    <div class="profile-picture-placeholder">👤</div>
                </div>
                <div class="profile-info">
                    <h2>Carlos Rodríguez</h2>
                    <p>Usuario desde Enero 2025</p>
                </div>
                <div class="profile-stats">
                    <div class="stat-item">
                        <h3>240</h3>
                        <p>TrashPoints</p>
                    </div>
                    <div class="stat-item">
                        <h3>15</h3>
                        <p>Reciclajes</p>
                    </div>
                    <div class="stat-item">
                        <h3>3</h3>
                        <p>Compras</p>
                    </div>
                </div>
                <ul class="sidebar-menu">
                    <li>
                        <a href="#" class="active">
                            <span class="menu-icon">📊</span>
                            Panel Principal
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span class="menu-icon">⚡</span>
                            Mi Energía
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span class="menu-icon">🛒</span>
                            Mis Compras
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span class="menu-icon">♻️</span>
                            Historial de Reciclaje
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span class="menu-icon">🏆</span>
                            Mis Logros
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span class="menu-icon">⚙️</span>
                            Configuración
                        </a>
                    </li>
                </ul>
            </div>
            
            <!-- Main Content -->
            <div class="main-content">
                <div class="content-header">
                    <h1>Panel Principal</h1>
                    <button class="btn">Reciclar Ahora</button>
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
                        <div class="activity-icon">♻️</div>
                        <div class="activity-content">
                            <h3>Reciclaste 2.3kg de residuos orgánicos</h3>
                            <p>Has generado 12 TrashPoints y contribuido a 3.5 kWh de energía renovable</p>
                            <p class="activity-date">Hace 2 días</p>
                        </div>
                    </div>
                    
                    <div class="activity-item">
                        <div class="activity-icon">🛒</div>
                        <div class="activity-content">
                            <h3>Compraste una Botella Ecológica</h3>
                            <p>Has canjeado 180 TrashPoints por este producto</p>
                            <p class="activity-date">Hace 1 semana</p>
                        </div>
                    </div>
                    
                    <div class="activity-item">
                        <div class="activity-icon">🏆</div>
                        <div class="activity-content">
                            <h3>¡Nuevo logro desbloqueado!</h3>
                            <p>Has conseguido el logro <span class="badge">Protector del Planeta</span> por reciclar regularmente durante un mes</p>
                            <p class="activity-date">Hace 2 semanas</p>
                        </div>
                    </div>
                </div>
                
                <!-- Recommendations -->
                <div class="recommendations">
                    <h2 class="section-title">Recomendado para ti</h2>
                    
                    <div class="energy-stats">
                        <div class="energy-stat-card">
                            <h3>⚡</h3>
                            <p>Ver tu impacto energético</p>
                            <button class="btn btn-outline">Ver detalles</button>
                        </div>
                        <div class="energy-stat-card">
                            <h3>🛒</h3>
                            <p>Productos que podrían interesarte</p>
                            <button class="btn btn-outline">Explorar</button>
                        </div>
                        <div class="energy-stat-card">
                            <h3>🏆</h3>
                            <p>Desbloquea tu próximo logro</p>
                            <button class="btn btn-outline">Ver logros</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>