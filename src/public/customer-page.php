<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuario - Trashcicle</title>
    <style>
        :root {
            /* Paleta de colores premium */
            --main-bg-color: #0a0a0c;
            --secondary-bg-color: #161921;
            --accent-color: #7ed957;
            --accent-color-hover: #6bc249;
            --text-color: #ffffff;
            --text-secondary: #b0b0b0;
            --card-bg: #1e2026;
            --border-color: rgba(255, 255, 255, 0.1);
            --gradient-start: rgba(126, 217, 87, 0.15);
            --gradient-end: rgba(26, 29, 35, 0.6);
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: -apple-system, BlinkMacSystemFont, 'SF Pro Display', 'Segoe UI', Helvetica, Arial, sans-serif;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
        
        body {
            background-color: #0F1117;
            color: var(--text-color);
            min-height: 100vh;
            line-height: 1.5;
        }
        
        /* Navbar estilo premium */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.25rem 2.5rem;
            background-color: #0F1117;
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            position: sticky;
            top: 0;
            z-index: 100;
            border-bottom: 1px solid var(--border-color);
        }
        
        .logo {
            display: flex;
            align-items: center;
        }
        
        .logo img {
            height: 32px;
        }
        
        .nav-trashpoints {
            display: flex;
            align-items: center;
            background-color: rgba(30, 32, 38, 0.8);
            padding: 0.6rem 1.25rem;
            border-radius: 50px;
            border: 1px solid var(--border-color);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.25);
            font-weight: 500;
            letter-spacing: 0.2px;
        }

        
        .span-title-trashpoints{
            color: #7ED957;

        }
        .nav-trashpoints img {
            height: 20px;
            margin-right: 10px;
        }
        
        .nav-menu {
            display: flex;
            gap: 2.5rem;
        }
        
        .nav-menu a {
            color: var(--text-secondary);
            text-decoration: none;
            font-weight: 500;
            position: relative;
            padding-bottom: 5px;
            transition: color 0.2s ease;
            font-size: 0.95rem;
            letter-spacing: 0.3px;
        }
        
        .nav-menu a:hover {
            color: var(--text-color);
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
            height: 2px;
            background-color: var(--accent-color);
            border-radius: 1px;
        }
        
        .container {
            max-width: 1300px;
            margin: 0 auto;
            padding: 2.5rem;
        }
        
        .profile-wrapper {
            display: grid;
            grid-template-columns: 1fr 2.2fr;
            gap: 2.5rem;
        }
        
        /* Sidebar premium */
        .profile-sidebar {
            background-color: var(--secondary-bg-color);
            border-radius: 16px;
            padding: 2rem;
            height: fit-content;
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.2);
            border: 1px solid var(--border-color);
        }
        
        .profile-picture {
            width: 130px;
            height: 130px;
            background-color: var(--card-bg);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            overflow: hidden;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
            border: 3px solid rgba(255, 255, 255, 0.05);
        }
        
        .profile-picture img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .profile-picture-placeholder {
            font-size: 52px;
            color: var(--text-secondary);
        }
        
        .profile-info {
            text-align: center;
            margin-bottom: 2.5rem;
        }
        
        .profile-info h2 {
            margin-bottom: 0.6rem;
            font-weight: 600;
            letter-spacing: 0.3px;
            font-size: 1.5rem;
        }
        
        .profile-info p {
            color: var(--text-secondary);
            font-size: 0.9rem;
            letter-spacing: 0.2px;
        }
        
        /* Profile stats con estilo premium */
        .profile-stats {
            display: flex;
            justify-content: space-between;
            text-align: center;
            padding: 1.25rem 0;
            border-top: 1px solid var(--border-color);
            border-bottom: 1px solid var(--border-color);
            margin-bottom: 2rem;
        }
        
        .stat-item h3 {
            font-size: 1.75rem;
            color: var(--accent-color);
            margin-bottom: 0.4rem;
            font-weight: 600;
        }
        
        .stat-item p {
            font-size: 0.85rem;
            color: var(--text-secondary);
            letter-spacing: 0.2px;
        }
        
        /* Menú lateral premium */
        .sidebar-menu {
            list-style: none;
            margin-top: 1.5rem;
        }
        
        .sidebar-menu li {
            margin-bottom: 0.6rem;
        }
        
        .sidebar-menu a {
            display: flex;
            align-items: center;
            color: var(--text-color);
            text-decoration: none;
            padding: 1rem;
            border-radius: 12px;
            transition: all 0.3s ease;
            font-weight: 500;
            letter-spacing: 0.2px;
        }
        
        .sidebar-menu a:hover {
            background-color: rgba(126, 217, 87, 0.08);
            transform: translateX(3px);
        }
        
        .sidebar-menu a.active {
            background-color: rgba(126, 217, 87, 0.15);
            color: var(--accent-color);
            font-weight: 600;
            box-shadow: 0 4px 12px rgba(126, 217, 87, 0.1);
        }
        
        .menu-icon {
            margin-right: 1rem;
            width: 22px;
            height: 22px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        /* Contenido principal premium */
        .main-content {
            background-color: var(--secondary-bg-color);
            border-radius: 16px;
            padding: 2.5rem;
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.2);
            border: 1px solid var(--border-color);
        }
        
        .content-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2.5rem;
        }
        
        .content-header h1 {
            font-size: 1.8rem;
            font-weight: 600;
            letter-spacing: 0.3px;
        }
        
        /* Resumen de energía premium */
        .energy-summary {
            background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end));
            border-radius: 16px;
            padding: 2rem;
            margin-bottom: 2.5rem;
            display: flex;
            flex-direction: column;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
            border: 1px solid rgba(126, 217, 87, 0.2);
        }
        
        .energy-summary h2 {
            font-size: 1.5rem;
            margin-bottom: 0.7rem;
            font-weight: 600;
            letter-spacing: 0.3px;
        }
        
        .energy-summary p {
            color: var(--text-secondary);
            margin-bottom: 1.5rem;
            font-size: 1rem;
            letter-spacing: 0.2px;
        }
        
        .energy-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5rem;
            margin-top: 1rem;
        }
        
        .energy-stat-card {
            background-color: var(--card-bg);
            border-radius: 14px;
            padding: 1.5rem;
            text-align: center;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.15);
            border: 1px solid var(--border-color);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .energy-stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.25);
        }
        
        .energy-stat-card h3 {
            font-size: 2.2rem;
            color: var(--accent-color);
            margin-bottom: 0.8rem;
            font-weight: 600;
        }
        
        .energy-stat-card p {
            color: var(--text-secondary);
            font-size: 0.95rem;
            letter-spacing: 0.2px;
        }
        
        /* Badge premium */
        .badge {
            display: inline-block;
            background-color: rgba(126, 217, 87, 0.15);
            color: var(--accent-color);
            padding: 0.4rem 1rem;
            border-radius: 50px;
            font-size: 0.9rem;
            font-weight: 600;
            letter-spacing: 0.2px;
            border: 1px solid rgba(126, 217, 87, 0.3);
        }
        
        /* Feed de actividad premium */
        .activity-feed {
            margin-top: 2.5rem;
        }
        
        .activity-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 1.8rem;
            padding-bottom: 1.8rem;
            border-bottom: 1px solid var(--border-color);
            transition: transform 0.3s ease;
        }
        
        .activity-item:hover {
            transform: translateX(5px);
        }
        
        .activity-icon {
            background-color: rgba(126, 217, 87, 0.15);
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1.2rem;
            color: var(--accent-color);
            font-size: 1.5rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        
        .activity-content {
            flex-grow: 1;
        }
        
        .activity-content h3 {
            margin-bottom: 0.5rem;
            font-weight: 600;
            font-size: 1.1rem;
            letter-spacing: 0.2px;
        }
        
        .activity-content p {
            color: var(--text-secondary);
            margin-bottom: 0.5rem;
        }
        
        .activity-date {
            color: var(--text-secondary);
            font-size: 0.85rem;
            letter-spacing: 0.2px;
        }
        
        /* Botones premium */
        .btn {
            background: linear-gradient(135deg, var(--accent-color), #6ac04b);
            color: #0a0a0c;
            border: none;
            padding: 0.9rem 1.8rem;
            border-radius: 12px;
            font-weight: 600;
            font-size: 0.95rem;
            letter-spacing: 0.3px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 6px 16px rgba(126, 217, 87, 0.25);
        }
        
        .btn:hover {
            background: linear-gradient(135deg, #7ed957, #5fb042);
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(126, 217, 87, 0.35);
        }
        
        .btn:active {
            transform: translateY(0);
        }
        
        .btn-outline {
            background: transparent;
            border: 1.5px solid var(--accent-color);
            color: var(--accent-color);
            box-shadow: none;
            transition: all 0.3s ease;
        }
        
        .btn-outline:hover {
            background-color: rgba(126, 217, 87, 0.1);
            transform: translateY(-3px);
            box-shadow: 0 6px 16px rgba(126, 217, 87, 0.15);
        }
        
        /* Títulos de sección premium */
        .section-title {
            font-size: 1.5rem;
            margin-bottom: 2rem;
            position: relative;
            display: inline-block;
            font-weight: 600;
            letter-spacing: 0.3px;
        }
        
        .section-title::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: -10px;
            width: 50px;
            height: 3px;
            background: linear-gradient(90deg, var(--accent-color), rgba(126, 217, 87, 0.5));
            border-radius: 3px;
        }
        
        .recommendations {
            margin-top: 3rem;
        }
        
        /* Responsive mejorado */
        @media (max-width: 1200px) {
            .container {
                padding: 2rem;
            }
            
            .profile-wrapper {
                gap: 2rem;
            }
        }
        
        @media (max-width: 992px) {
            .profile-wrapper {
                grid-template-columns: 1fr;
            }
            
            .profile-sidebar {
                margin-bottom: 2rem;
            }
            
            .sidebar-menu {
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                gap: 1rem;
            }
            
            .sidebar-menu a {
                flex-direction: column;
                text-align: center;
                height: 100%;
            }
            
            .menu-icon {
                margin-right: 0;
                margin-bottom: 0.5rem;
                font-size: 1.5rem;
            }
        }
        
        @media (max-width: 768px) {
            .navbar {
                padding: 1rem 1.5rem;
                flex-wrap: wrap;
                gap: 1rem;
            }
            
            .nav-menu {
                order: 3;
                width: 100%;
                justify-content: space-between;
                gap: 0;
                margin-top: 1rem;
                overflow-x: auto;
                padding-bottom: 0.5rem;
            }
            
            .nav-menu::-webkit-scrollbar {
                height: 3px;
            }
            
            .nav-menu::-webkit-scrollbar-thumb {
                background-color: var(--accent-color);
                border-radius: 3px;
            }
            
            .container {
                padding: 1.5rem;
            }
            
            .energy-stats {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .sidebar-menu {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        
        @media (max-width: 576px) {
            .navbar {
                padding: 1rem;
            }
            
            .nav-trashpoints {
                font-size: 0.9rem;
                padding: 0.5rem 1rem;
            }
            
            .container {
                padding: 1rem;
            }
            
            .profile-sidebar, .main-content {
                padding: 1.5rem;
            }
            
            .profile-picture {
                width: 100px;
                height: 100px;
            }
            
            .profile-stats {
                flex-direction: column;
                gap: 1.5rem;
            }
            
            .stat-item {
                padding: 1rem 0;
                border-bottom: 1px solid var(--border-color);
            }
            
            .stat-item:last-child {
                border-bottom: none;
            }
            
            .content-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
            
            .energy-stats {
                grid-template-columns: 1fr;
            }
            
            .sidebar-menu {
                grid-template-columns: 1fr;
            }
            
            .activity-item {
                flex-direction: column;
            }
            
            .activity-icon {
                margin-bottom: 1rem;
            }
            
            .section-title {
                font-size: 1.3rem;
            }
            
            .btn {
                width: 100%;
                text-align: center;
            }
        }
        
        /* Animaciones y transiciones premium */
        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(126, 217, 87, 0.4);
            }
            70% {
                box-shadow: 0 0 0 10px rgba(126, 217, 87, 0);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(126, 217, 87, 0);
            }
        }
        
        .btn.animated {
            animation: pulse 2s infinite;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="logo">
            <img src="assets/images/logo-trashcicle-new.png" alt="TrashCycle Logo" width="150px" style="object-fit: cover;">
        </div>
        <div class="nav-trashpoints">
            <img src="assets/images/logo-trashcicle-desplex.png" alt="TrashPoints Icon">
            <span><span class="span-title-trashpoints">TrashPoints:</span> 0</span>
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
                    <button class="btn animated">Reciclar Ahora</button>
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