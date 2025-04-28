<?php
session_start();
include '../connection/conn.php';
checkUserPermissions('admin');


//Muestra el numero de productos en la base de datos
function totalProductos(){
  global $pdo;
  $sql = "SELECT COUNT(*) AS total FROM productos";
  $stmt = $pdo->prepare($sql);
  $stmt->execute();
  $result =  $stmt->fetch(PDO ::FETCH_ASSOC); 
  return isset($result['total']) ? (int)$result['total'] : 0;
}

//Muestras los ultimos 3 productos añadidos
function totalProductoshoy(){
  global $pdo;
  $sql = "SELECT COUNT(*) AS prodcutos_hoy FROM productos WHERE  fecha_creacion = CURDATE() ORDER BY fecha_creacion DESC LIMIT 5";
  $stmt = $pdo->prepare($sql);
  $stmt->execute();
  $result =  $stmt->fetch(PDO ::FETCH_ASSOC); 
  return isset($result['prodcutos_hoy']) ? (int)$result['prodcutos_hoy'] : 0;
} 


//Funcion que muestra el total de los zafacones en la base  de datos
function totalZafacones(){
    global $pdo;
    $sql = "SELECT COUNT(*) AS totalzafacones FROM zafacones_inteligentes";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result =  $stmt->fetch(PDO ::FETCH_ASSOC); 
    return isset($result['totalzafacones']) ? (int)$result['totalzafacones'] : 0;
  }
  
  //Funcion que muestra el total  de zafacones que se encuentra disponibles en  la pagina
  function totalZafaconesActivos(){
    global $pdo;
    $sql = "SELECT COUNT(*) AS totalzafacones_activos FROM zafacones_inteligentes WHERE estado= 'activo'";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result =  $stmt->fetch(PDO ::FETCH_ASSOC); 
    return isset($result['totalzafacones_activos']) ? (int)$result['totalzafacones_activos'] : 0;
  }


//Muestra el numero de comprar en la base de datos
function totalCompras(){
  global $pdo;
  $sql = "SELECT COUNT(*) AS totalcompras FROM compras";
  $stmt = $pdo->prepare($sql);
  $stmt->execute();
  $result =  $stmt->fetch(PDO ::FETCH_ASSOC); 
  return isset($result['totalcompras']) ? (int)$result['totalcompras'] : 0;
}


//Muestras los ultimos 3 productos añadidos
function totalComprashoy(){
    global $pdo;
    $sql = "SELECT COUNT(*) AS compras_hoy FROM compras WHERE  fecha_compra = CURDATE() ORDER BY fecha_compra DESC LIMIT 5";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result =  $stmt->fetch(PDO ::FETCH_ASSOC); 
    return isset($result['compras_hoy']) ? (int)$result['compras_hoy'] : 0;
  } 
  

  // Función que suma el total de puntos de los usuarios tipo "cliente"
function totalPuntosClientes(){
    global $pdo;
    $sql = "SELECT SUM(user_points) AS totalpuntos FROM users WHERE type_users = 'cliente'";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC); 
    return isset($result['totalpuntos']) ? (int)$result['totalpuntos'] : 0;
  }
  

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard de Productos - TrashCicle</title>
    <style>
        :root {
            --dark-bg: #1c1c2a;
            --panel-bg: #252536;
            --primary-green: #4CAF50;
            --hover-green: #3e8e41;
            --text-light: #ffffff;
            --text-secondary: #b0b0b0;
            --border-radius: 8px;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: var(--dark-bg);
            color: var(--text-light);
        }
        
        .container {
            min-height: 100vh;
            padding: 0;
        }
        
        .top-nav {
            background-color: var(--panel-bg);
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }
        
        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .logo img {
            height: 40px;
        }
        
        .logo h1 {
            font-size: 18px;
            font-weight: 600;
        }
        
        .nav-menu {
            display: flex;
            list-style: none;
            gap: 5px;
            flex-grow: 1;
            margin: 0 20px;
            justify-content: center;
        }
        
        .nav-menu li a {
            padding: 8px 15px;
            color: var(--text-light);
            text-decoration: none;
            border-radius: var(--border-radius);
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 5px;
        }
        
        .nav-menu li a:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }
        
        .nav-menu li a.active {
            background-color: rgba(76, 175, 80, 0.2);
            color: var(--primary-green);
        }
        
        .user-profile {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 15px;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 50px;
            cursor: pointer;
        }
        
        .user-profile img {
            width: 20px;
            height: 20px;
            border-radius: 50%;
        }
        
        .main-content {
            padding: 20px;
            overflow-y: auto;
        }
        
        .breadcrumb {
            display: flex;
            margin-bottom: 20px;
            color: var(--text-secondary);
            font-size: 14px;
            align-items: center;
        }
        
        .breadcrumb a {
            color: var(--text-secondary);
            text-decoration: none;
        }
        
        .breadcrumb a:hover {
            color: var(--primary-green);
        }
        
        .breadcrumb .separator {
            margin: 0 8px;
        }
        
        .page-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            align-items: center;
        }
        
        .page-actions {
            display: flex;
            gap: 10px;
        }
        
        .stats-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }
        
        .stat-card {
            background-color: var(--panel-bg);
            border-radius: var(--border-radius);
            padding: 20px;
            transition: transform 0.3s;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
        }
        
        .stat-card h3 {
            font-size: 15px;
            font-weight: 500;
            color: var(--text-secondary);
            margin-bottom: 8px;
            text-transform: uppercase;
        }
        
        .stat-value {
            font-size: 24px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .trend {
            font-size: 14px;
            font-weight: normal;
            color: var(--primary-green);
        }
        
        .progress-bar {
            height: 8px;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 4px;
            margin-top: 15px;
            overflow: hidden;
        }
        
        .progress-fill {
            height: 100%;
            border-radius: 4px;
        }
        
        .fill-blue {
            background-color: #2196F3;
        }
        
        .fill-green {
            background-color: var(--primary-green);
        }
        
        .fill-purple {
            background-color: #9C27B0;
        }
        
        .fill-orange {
            background-color: #FF9800;
        }
        
        .main-panel {
            background-color: var(--panel-bg);
            border-radius: var(--border-radius);
            margin-bottom: 20px;
        }
        
        .panel-tabs {
            display: flex;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            overflow-x: auto;
            white-space: nowrap;
        }
        
        .panel-tab {
            padding: 15px 25px;
            cursor: pointer;
            position: relative;
        }
        
        .panel-tab.active {
            font-weight: 500;
        }
        
        .panel-tab.active:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 3px;
            background-color: var(--primary-green);
        }
        
        .panel-content {
            padding: 20px;
        }
        
        .toolbar {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
            justify-content: space-between;
            flex-wrap: wrap;
        }
        
        .search-box {
            display: flex;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: var(--border-radius);
            overflow: hidden;
            flex: 1;
            max-width: 400px;
        }
        
        .search-box input {
            background: transparent;
            border: none;
            padding: 10px 15px;
            color: var(--text-light);
            flex: 1;
            outline: none;
        }
        
        .search-box button {
            background-color: var(--primary-green);
            border: none;
            color: white;
            width: 40px;
            cursor: pointer;
        }
        
        .action-buttons {
            display: flex;
            gap: 10px;
        }
        
        .btn {
            padding: 10px 15px;
            border-radius: var(--border-radius);
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s;
        }
        
        .btn-primary {
            background-color: var(--primary-green);
            color: white;
        }
        
        .btn-primary:hover {
            background-color: var(--hover-green);
        }
        
        .btn-secondary {
            background-color: rgba(255, 255, 255, 0.1);
            color: var(--text-light);
        }
        
        .btn-secondary:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }
        
        .filter-buttons {
            display: flex;
            gap: 10px;
            margin-bottom: 15px;
            flex-wrap: wrap;
        }
        
        .filter-btn {
            padding: 8px 15px;
            border-radius: 20px;
            border: none;
            background-color: rgba(255, 255, 255, 0.1);
            color: var(--text-light);
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .filter-btn:hover, .filter-btn.active {
            background-color: var(--primary-green);
        }
        
        .data-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .table-container {
            overflow-x: auto;
        }
        
        .data-table th {
            text-align: left;
            padding: 15px;
            color: var(--text-secondary);
            font-weight: 500;
            font-size: 14px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .data-table td {
            padding: 12px 15px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }
        
        .product-img {
            width: 40px;
            height: 40px;
            border-radius: 6px;
            object-fit: cover;
        }
        
        .status-badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
        }
        
        .badge-success {
            background-color: rgba(76, 175, 80, 0.15);
            color: #81c784;
        }
        
        .badge-warning {
            background-color: rgba(255, 152, 0, 0.15);
            color: #ffb74d;
        }
        
        .badge-danger {
            background-color: rgba(244, 67, 54, 0.15);
            color: #e57373;
        }
        
        .action-icon {
            width: 28px;
            height: 28px;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 4px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: var(--text-light);
            margin-right: 5px;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .action-icon:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }
        
        .edit-icon:hover {
            color: #2196F3;
        }
        
        .delete-icon:hover {
            color: #f44336;
        }
        
        .pagination {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
            align-items: center;
        }
        
        .page-info {
            color: var(--text-secondary);
            font-size: 14px;
        }
        
        .page-controls {
            display: flex;
            gap: 5px;
        }
        
        .page-btn {
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 4px;
            border: none;
            color: var(--text-light);
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .page-btn:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }
        
        .page-btn.active {
            background-color: var(--primary-green);
        }
        
        .tab-content {
            display: none;
        }
        
        .tab-content.active {
            display: block;
        }
        
        .bulk-actions {
            display: flex;
            gap: 10px;
            margin-bottom: 15px;
        }
        
        .view-toggle {
            display: flex;
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: var(--border-radius);
            overflow: hidden;
        }
        
        .view-toggle-btn {
            background-color: transparent;
            border: none;
            color: var(--text-light);
            padding: 5px 10px;
            cursor: pointer;
        }
        
        .view-toggle-btn.active {
            background-color: rgba(76, 175, 80, 0.2);
            color: var(--primary-green);
        }
        
        .card-view {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
        }
        
        .product-card {
            background-color: rgba(255, 255, 255, 0.05);
            border-radius: var(--border-radius);
            overflow: hidden;
            transition: all 0.3s;
        }
        
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }
        
        .product-card-img {
            height: 140px;
            background-color: rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .product-card-img img {
            max-width: 100%;
            max-height: 120px;
        }
        
        .product-card-content {
            padding: 15px;
        }
        
        .product-card-title {
            font-weight: 500;
            margin-bottom: 5px;
        }
        
        .product-card-category {
            color: var(--text-secondary);
            font-size: 13px;
            margin-bottom: 10px;
        }
        
        .product-card-stats {
            display: flex;
            justify-content: space-between;
            color: var(--text-secondary);
            font-size: 14px;
            margin-bottom: 15px;
        }
        
        .product-card-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        @media (max-width: 768px) {
            .nav-menu {
                position: absolute;
                top: 60px;
                left: 0;
                right: 0;
                background-color: var(--panel-bg);
                flex-direction: column;
                padding: 10px;
                display: none;
            }
            
            .nav-menu.show {
                display: flex;
            }
            
            .menu-toggle {
                display: block;
            }
            
            .stats-row {
                grid-template-columns: 1fr;
            }
            
            .toolbar {
                flex-direction: column;
            }
            
            .search-box {
                max-width: 100%;
            }
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
    <div class="container">
        <!-- Main Content -->
        <div class="main-content">
            <div class="breadcrumb">
                <a href="#"><i class="fas fa-home"></i></a>
                <span class="separator">/</span>
                <a href="#">Productos</a>
                <span class="separator">/</span>
                <span>Gestión</span>
            </div>
            
            <div class="page-header">
                <h1>Panel de Productos</h1>
                <div class="page-actions">
                    <button class="btn btn-secondary"><i class="fas fa-download"></i> Exportar</button>
                    <button class="btn btn-primary" onclick="window.location.href='add-products.php'">
                        <i class="fas fa-plus"></i> Agregar Producto
                    </button>
                </div>
            </div>
            
            <!-- Stats Row -->
            <div class="stats-row">
                <div class="stat-card">
                    <h3>Total Productos</h3>
                    <div class="stat-value">
                        <?php echo totalProductos()?> <span class="trend">+<?php echo totalProductoshoy()?> nuevos</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-fill fill-purple" style="width:80%"></div>
                    </div>
                </div>
                
                <div class="stat-card">
                    <h3>Canjes Realizados</h3>
                    <div class="stat-value">
                        <?php echo  totalCompras()?> <span class="trend">+<?php echo totalComprashoy()?> compras</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-fill fill-blue" style="width:65%"></div>
                    </div>
                </div>
                
                <div class="stat-card">
                    <h3>Zafacones Activos</h3>
                    <div class="stat-value">
                        <?php  echo totalZafaconesActivos()?>/<?php  echo  totalZafacones()?> <span class="trend">Registrados</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-fill fill-green" style="width:87.5%"></div>
                    </div>
                </div>
                
                <div class="stat-card">
                    <h3>Puntos Entregados</h3>
                    <div class="stat-value">
                        <?php echo  totalPuntosClientes()?> <span class="trend">Pts</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-fill fill-orange" style="width:72%"></div>
                    </div>
                </div>
            </div>
            
            <!-- Main Panel -->
            <div class="main-panel">
                <div class="panel-tabs">
                    <div class="panel-tab active" data-tab="productos">Productos</div>
                    <div class="panel-tab" data-tab="canjes">Canjes</div>
                    <div class="panel-tab" data-tab="categorias">Categorías</div>
                    <div class="panel-tab" data-tab="inventario">Inventario</div>
                    <div class="panel-tab" data-tab="alertas">Alertas</div>
                </div>
                
                <div class="panel-content">
                    <!-- Productos Tab -->
                    <div class="tab-content active" id="productos-tab">
                        <div class="toolbar">
                            <div class="search-box">
                                <input type="text" placeholder="Buscar producto...">
                                <button><i class="fas fa-search"></i></button>
                            </div>
                            
                            <div class="action-buttons">
                                <button class="btn btn-secondary"><i class="fas fa-filter"></i> Filtrar</button>
                                <div class="view-toggle">
                                    <button class="view-toggle-btn active"><i class="fas fa-list"></i></button>
                                    <button class="view-toggle-btn"><i class="fas fa-th-large"></i></button>
                                </div>
                                <button class="btn btn-primary"onclick="window.location.href = 'add-products.php'"><i class="fas fa-plus"></i> Agregar Producto</button>
                            </div>
                        </div>
                        
                        <div class="bulk-actions">
                            <button class="btn btn-secondary"><i class="fas fa-check-square"></i> Seleccionar todo</button>
                            <button class="btn btn-secondary"><i class="fas fa-tags"></i> Categoría</button>
                            <button class="btn btn-secondary"><i class="fas fa-trash"></i> Eliminar</button>
                        </div>
                        
                        <div class="filter-buttons">
                            <button class="filter-btn active">Todos</button>
                            <button class="filter-btn">Disponibles</button>
                            <button class="filter-btn">Sin Stock</button>
                            <button class="filter-btn">Más Canjeados</button>
                            <button class="filter-btn">Recién agregados</button>
                        </div>
                        
                        <div class="table-container">
                            <table class="data-table">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox"></th>
                                        <th>Producto</th>
                                        <th>Categoría</th>
                                        <th>Puntos</th>
                                        <th>Stock</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><input type="checkbox"></td>
                                        <td>
                                            <div style="display:flex; align-items:center; gap:10px;">
                                                <img src="/api/placeholder/40/40" alt="Producto" class="product-img">
                                                <span>Botella Reutilizable</span>
                                            </div>
                                        </td>
                                        <td>Recipientes</td>
                                        <td>500</td>
                                        <td>25</td>
                                        <td><span class="status-badge badge-success">Disponible</span></td>
                                        <td>
                                            <a class="action-icon edit-icon"><i class="fas fa-edit"></i></a>
                                            <a class="action-icon"><i class="fas fa-eye"></i></a>
                                            <a class="action-icon delete-icon"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox"></td>
                                        <td>
                                            <div style="display:flex; align-items:center; gap:10px;">
                                                <img src="/api/placeholder/40/40" alt="Producto" class="product-img">
                                                <span>Bolsa Ecológica</span>
                                            </div>
                                        </td>
                                        <td>Bolsas</td>
                                        <td>300</td>
                                        <td>42</td>
                                        <td><span class="status-badge badge-success">Disponible</span></td>
                                        <td>
                                            <a class="action-icon edit-icon"><i class="fas fa-edit"></i></a>
                                            <a class="action-icon"><i class="fas fa-eye"></i></a>
                                            <a class="action-icon delete-icon"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox"></td>
                                        <td>
                                            <div style="display:flex; align-items:center; gap:10px;">
                                                <img src="/api/placeholder/40/40" alt="Producto" class="product-img">
                                                <span>Kit Reciclaje Hogar</span>
                                            </div>
                                        </td>
                                        <td>Kits</td>
                                        <td>1200</td>
                                        <td>8</td>
                                        <td><span class="status-badge badge-warning">Bajo Stock</span></td>
                                        <td>
                                            <a class="action-icon edit-icon"><i class="fas fa-edit"></i></a>
                                            <a class="action-icon"><i class="fas fa-eye"></i></a>
                                            <a class="action-icon delete-icon"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox"></td>
                                        <td>
                                            <div style="display:flex; align-items:center; gap:10px;">
                                                <img src="/api/placeholder/40/40" alt="Producto" class="product-img">
                                                <span>Camiseta Reciclaje</span>
                                            </div>
                                        </td>
                                        <td>Ropa</td>
                                        <td>700</td>
                                        <td>0</td>
                                        <td><span class="status-badge badge-danger">Sin Stock</span></td>
                                        <td>
                                            <a class="action-icon edit-icon"><i class="fas fa-edit"></i></a>
                                            <a class="action-icon"><i class="fas fa-eye"></i></a>
                                            <a class="action-icon delete-icon"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox"></td>
                                        <td>
                                            <div style="display:flex; align-items:center; gap:10px;">
                                                <img src="/api/placeholder/40/40" alt="Producto" class="product-img">
                                                <span>Cuaderno Papel Reciclado</span>
                                            </div>
                                        </td>
                                        <td>Papelería</td>
                                        <td>400</td>
                                        <td>15</td>
                                        <td><span class="status-badge badge-success">Disponible</span></td>
                                        <td>
                                            <a class="action-icon edit-icon"><i class="fas fa-edit"></i></a>
                                            <a class="action-icon"><i class="fas fa-eye"></i></a>
                                            <a class="action-icon delete-icon"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox"></td>
                                        <td>
                                            <div style="display:flex; align-items:center; gap:10px;">
                                                <img src="/api/placeholder/40/40" alt="Producto" class="product-img">
                                                <span>Maceta Biodegradable</span>
                                            </div>
                                        </td>
                                        <td>Jardín</td>
                                        <td>350</td>
                                        <td>28</td>
                                        <td><span class="status-badge badge-success">Disponible</span></td>
                                        <td>
                                            <a class="action-icon edit-icon"><i class="fas fa-edit"></i></a>
                                            <a class="action-icon"><i class="fas fa-eye"></i></a>
                                            <a class="action-icon delete-icon"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="pagination">
                            <div class="page-info">
                                Mostrando 1-6 de 24 productos
                            </div>
                            <div class="page-controls">
                                <button class="page-btn"><i class="fas fa-chevron-left"></i></button>
                                <button class="page-btn active">1</button>
                                <button class="page-btn">2</button>
                                <button class="page-btn">3</button>
                                <button class="page-btn">4</button>
                                <button class="page-btn">5</button>
                                <button class="page-btn"><i class="fas fa-chevron-right"></i></button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Canjes Tab -->
                    <div class="tab-content" id="canjes-tab">
                        <div class="toolbar">
                            <div class="search-box">
                                <input type="text" placeholder="Buscar canje...">
                                <button><i class="fas fa-search"></i></button>
                            </div>
                            
                            <div class="action-buttons">
                                <button class="btn btn-secondary"><i class="fas fa-filter"></i> Filtrar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>     
</body>
</html>