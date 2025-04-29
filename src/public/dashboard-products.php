<?php
session_start();
include '../connection/conn.php';
checkUserPermissions('admin');

//Fragmento de codigo que obtiene los producos de la base de datos
$sql = "SELECT * FROM productos"; // Tu tabla se llama productos
$stmt = $pdo->prepare($sql);
$stmt->execute();
$productos = $stmt->fetchAll(PDO::FETCH_ASSOC);


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
    <link rel="stylesheet" href="styles/dashboard-products.css">
    <title>Dashboard de Productos - TrashCicle</title>
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
                    <button class="btn btn-primary"  onclick="window.location.href = 'add-products.php'">
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
                                <button class="btn btn-primary" onclick="window.location.href = 'add-products.php'"><i class="fas fa-plus"></i> Agregar Producto</button>
                            </div>
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
                                        <th>Producto</th>
                                        <th>Categoría</th>
                                        <th>Puntos</th>
                                        <th>Stock</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($productos as $producto): ?>
                                        <tr>
                                            <td>
                                                <div style="display:flex; align-items:center; gap:10px;">
                                                    <img src="uploads/<?php echo htmlspecialchars($producto['imagen_producto']); ?>" alt="Producto" class="product-img" style="width:40px; height:40px;">
                                                    <span><?php echo htmlspecialchars($producto['nombre_producto']); ?></span>
                                                </div>
                                            </td>
                                            <td><?php echo htmlspecialchars($producto['categria_producto']); ?></td>
                                            <td><?php echo number_format($producto['precio'], 2); ?></td>
                                            <td><?php echo (int)$producto['cantidad_stock']; ?></td>
                                            <td>
                                                <?php
                                                $estado = $producto['estado_producto'];
                                                $badgeClass = ($estado == 'Disponible') ? 'badge-success' : 'badge-danger';
                                                ?>
                                                <span class="status-badge <?php echo $badgeClass; ?>"><?php echo htmlspecialchars($estado); ?></span>
                                            </td>
                                            <td>
                                                <a href="editar-producto.php?id=<?php echo $producto['id_producto']; ?>" class="action-icon edit-icon"><i class="fas fa-edit"></i></a>
                                                <a href="ver-producto.php?id=<?php echo $producto['id_producto']; ?>" class="action-icon"><i class="fas fa-eye"></i></a>
                                                <a href="eliminar-producto.php?id=<?php echo $producto['id_producto']; ?>" class="action-icon delete-icon"><i class="fas fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
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
                    <!-- Contenido del tab Canjes -->
                    <div class="tab-content" id="canjes-tab">
                        <div class="toolbar">
                            <div class="search-box">
                                <input type="text" placeholder="Buscar canje...">
                                <button><i class="fas fa-search"></i></button>
                            </div>
                            
                            <div class="action-buttons">
                                <button class="btn btn-secondary"><i class="fas fa-filter"></i> Filtrar</button>
                                <div class="view-toggle">
                                    <button class="view-toggle-btn active"><i class="fas fa-list"></i></button>
                                    <button class="view-toggle-btn"><i class="fas fa-th-large"></i></button>
                                </div>
                            </div>
                        </div>
 
                        <div class="filter-buttons">
                            <button class="filter-btn active">Todos los canjes</button>
                            <button class="filter-btn">Hoy</button>
                            <button class="filter-btn">Esta semana</button>
                            <button class="filter-btn">Este mes</button>
                            <button class="filter-btn">Pendientes</button>
                        </div>
                        
                        <div class="table-container">
                            <table class="data-table">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox"></th>
                                        <th>Producto</th>
                                        <th>Usuario</th>
                                        <th>Puntos</th>
                                        <th>Fecha</th>
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
                                        <td>María Pérez</td>
                                        <td>500</td>
                                        <td>28/04/2025</td>
                                        <td><span class="status-badge badge-success">Completado</span></td>
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
                                        <td>Juan Rodríguez</td>
                                        <td>300</td>
                                        <td>27/04/2025</td>
                                        <td><span class="status-badge badge-success">Completado</span></td>
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
                                        <td>Ana Martínez</td>
                                        <td>1200</td>
                                        <td>25/04/2025</td>
                                        <td><span class="status-badge badge-warning">Pendiente</span></td>
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
                                        <td>Carlos López</td>
                                        <td>400</td>
                                        <td>24/04/2025</td>
                                        <td><span class="status-badge badge-success">Completado</span></td>
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
                                        <td>Laura Gómez</td>
                                        <td>350</td>
                                        <td>23/04/2025</td>
                                        <td><span class="status-badge badge-danger">Cancelado</span></td>
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
                                        <td>Pedro Sánchez</td>
                                        <td>700</td>
                                        <td>22/04/2025</td>
                                        <td><span class="status-badge badge-success">Completado</span></td>
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
                                Mostrando 1-6 de 18 canjes
                            </div>
                            <div class="page-controls">
                                <button class="page-btn"><i class="fas fa-chevron-left"></i></button>
                                <button class="page-btn active">1</button>
                                <button class="page-btn">2</button>
                                <button class="page-btn">3</button>
                                <button class="page-btn"><i class="fas fa-chevron-right"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Función para cambiar entre pestañas (Productos y Canjes)
        document.addEventListener('DOMContentLoaded', function() {
            // Seleccionar las pestañas
            const tabs = document.querySelectorAll('.panel-tab');
            
            // Agregar evento de clic a cada pestaña
            tabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    // Quitar la clase active de todas las pestañas
                    tabs.forEach(t => t.classList.remove('active'));
                    
                    // Agregar la clase active a la pestaña actual
                    this.classList.add('active');
                    
                    // Ocultar todos los contenidos de pestañas
                    document.querySelectorAll('.tab-content').forEach(content => {
                        content.classList.remove('active');
                    });
                    
                    // Mostrar el contenido correspondiente a la pestaña actual
                    const tabId = this.getAttribute('data-tab') + '-tab';
                    document.getElementById(tabId).classList.add('active');
                });
            });
        });
    </script>     
</body>
</html>