<?php
session_start();
include '../connection/conn.php';
checkUserPermissions('admin');

//Fragmento de codigo que obtiene los producos de la base de datos
$sql = "SELECT * FROM productos"; // Tu tabla se llama productos
$stmt = $pdo->prepare($sql);
$stmt->execute();
$productos = $stmt->fetchAll(PDO::FETCH_ASSOC);


//Codigo para obtener todas las compras
$sql = 'SELECT * FROM canjes';
$stmt = $pdo->prepare($sql);
$stmt->execute();
$canjes = $stmt->fetchAll(PDO::FETCH_ASSOC);



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
                    <button class="btn btn-secondary" id="exportar-pdf"><i class="fas fa-download" ></i> Exportar</button>
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
                    <h3>Zafacones</h3>
                    <div class="stat-value">
                        <?php  echo  totalZafacones()?> <span class="trend">Registrados</span>
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
                                <input type="text" id="buscarProducto" placeholder="Buscar producto...">
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
                            <button class="filter-btn active" data-filtro="todos">Todos</button>
                            <button class="filter-btn" data-filtro="mas-canjeados">Más canjeados</button>
                            <button class="filter-btn" data-filtro="No-disponible">No disponible</button>
                            <button class="filter-btn" data-filtro="Disponibles">Disponibles</button>
                            <button class="filter-btn" data-filtro="recientes">Recién agregados</button>
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
                                <tbody id="lista-productos">
                                    <?php foreach($productos as $producto): 
                                        $estado = $producto['estado_producto'];
                                        $badgeClass = ($estado == 'Disponible') ? 'badge-success' : 'badge-danger';

                                        // Clases de estado para el filtro
                                        $claseEstado = ($estado == 'Disponible') ? 'Disponibles' : 'No-disponible';

                                        // Clases para los filtros "Más Canjeados" y "Recién agregados"
                                        $masCanjeados = ($producto['cantidad_stock'] <= 5) ? 'mas-canjeados' : '';
                                        $reciente = (strtotime($producto['fecha_creacion']) >= strtotime('-7 days')) ? 'recientes' : '';

                                        // Combinar clases
                                        $clasesFila = "$claseEstado $masCanjeados $reciente";
                                    ?>
                                    <tr class="<?php echo $clasesFila; ?>">
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
                                            <span class="status-badge <?php echo $badgeClass; ?>"><?php echo htmlspecialchars($estado); ?></span>
                                        </td>
                                        <td>
                                            <a href="editar-producto.php?id=<?php echo $producto['id_producto']; ?>" class="action-icon edit-icon"><i class="fas fa-edit"></i></a>
                            
                                            <a href="eliminar-producto.php?id=<?php echo $producto['id_producto']; ?>" class="action-icon delete-icon"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <!-- Mensaje cuando no hay resultado -->
                            <p id="sin-resultados-productos" style="display: none; text-align: center; padding: 10px; color: gray;">
                                No hay productos que coincidan con tu búsqueda.
                            </p>
                            <!-- Mensaje cuando no hay resultados -->
                            <p id="no-resultados" style="display: none; text-align: center; color: white; margin-top: 15px; font-weight: bold;">
                                No hay resultados para este filtro.
                            </p>
                        </div>
                        <!-- Info del producto -->
                        <div class="page-info">
                           
                        </div>
                    </div>
                    <!-- Contenido del tab Canjes -->
                    <div class="tab-content" id="canjes-tab">
                        <div class="toolbar">
                            <div class="search-box">
                                <input type="text"  id="buscarCanje" placeholder="Buscar canje...">
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
                            <button class="filter-btn active" data-filtro="todos">Todos</button>
                            <button class="filter-btn" data-filtro="canjeo-exitoso">Exitosos</button>
                            <button class="filter-btn" data-filtro="pendiente">Pendientes</button>

                        </div>
                                        

                        <div class="table-container">
                            <table class="data-table">
                                <thead>
                                    <tr>
                                        <th>Producto</th>
                                        <th>Usuario</th>
                                        <th>Puntos</th>
                                        <th>Fecha</th>
                                        <th>Estado</th>
                                    </tr>
                                </thead>
                                <tbody id="lista-canjes">
                                <?php foreach($canjes as  $canje): 
                                    // Asignar clase según el estado
                                    $estado = $canje['estado'];
                                    $badgeClass = ($estado === 'Canjeo exitoso') ? 'badge-success' : 'badge-warning';
            

                                    // Filtros por fecha
                                    $fecha = strtotime($canje['fecha_canje']);
                                    $hoy = strtotime(date('Y-m-d'));
                                    $semana = strtotime('-7 days');
                                    $mes = strtotime('-30 days');

                                    $claseFecha = '';
                                    if ($fecha >= $hoy) $claseFecha = 'hoy';
                                    elseif ($fecha >= $semana) $claseFecha = 'semana';
                                    elseif ($fecha >= $mes) $claseFecha = 'mes';

                                    // Filtro pendiente
                                    $clasePendiente = ($estado === 'pendiente') ? 'pendiente' : '';

                                    // Nueva clase basada en estado (para botón "canjeo exitoso")
                                    $estadoClass = strtolower(str_replace(' ', '-', $estado));

                                    // Clases combinadas para filtros
                                    $clasesFila = "$claseFecha $clasePendiente $estadoClass";

                                ?>
                                <tr class="<?php echo $clasesFila; ?>">
                                    <td>
                                        <div style="display:flex; align-items:center; gap:10px;">
                                            <img src="uploads/<?php echo htmlspecialchars($canje['imagen_producto'] ?? 'placeholder.png'); ?>" alt="Producto" class="product-img" style="width:40px; height:40px;">
                                            <span><?php echo htmlspecialchars($canje['nombre_producto']); ?></span>
                                        </div>
                                    </td>
                                    <td><?php echo htmlspecialchars($canje['nombre_entrega']); ?></td>
                                    <td><?php echo (int)$canje['product_prices_points']; ?></td>
                                    <td><?php echo date('d/m/Y', strtotime($canje['fecha_canje'])); ?></td>
                                    <td><span class="status-badge <?php echo $badgeClass; ?>"><?php echo ucfirst($estado); ?></span></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                            </table>

                            <!-- Mensaje cuando no hay resultado -->
                            <p id="sin-resultados-canjes" style="display: none; text-align: center; color: gray; padding: 10px;">
                                No hay canjes que coincidan con tu búsqueda.
                            </p>
                            <!-- Mensaje cuando no hay resultados -->
                            <p id="no-resultados-canjes" style="display: none; text-align: center; color: white; margin-top: 15px; font-weight: bold;">
                                No hay resultados para este filtro.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="scripts/dashboard-products.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
</body>
</html>