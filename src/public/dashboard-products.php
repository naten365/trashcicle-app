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

// 1. Define cuántos productos mostrar por página
$productosPorPagina = 6;

// 2. Verifica si se recibió el número de página por GET, si no, empieza en 1
$paginaActual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;

// 3. Calcula el offset (desde qué producto empezar)
$offset = ($paginaActual - 1) * $productosPorPagina;

// 4. Obtiene el total de productos
$sqlTotal = "SELECT COUNT(*) AS total FROM productos";
$stmtTotal = $pdo->prepare($sqlTotal);
$stmtTotal->execute();
$totalProductos = $stmtTotal->fetch(PDO::FETCH_ASSOC)['total'];

// 5. Calcula cuántas páginas necesitas
$totalPaginas = ceil($totalProductos / $productosPorPagina);

// 6. Obtiene los productos para la página actual
$sql = "SELECT * FROM productos LIMIT :limit OFFSET :offset";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':limit', $productosPorPagina, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$productos = $stmt->fetchAll(PDO::FETCH_ASSOC);


//Obtenemos todos los valores de la compras
// Parámetros para paginación
$canjesPorPagina = 6;
$paginaActual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$offset = ($paginaActual - 1) * $canjesPorPagina;

// Consulta paginada
$sql = "SELECT * FROM compras LIMIT :limit OFFSET :offset";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':limit', $canjesPorPagina, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$canjes = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Obtener total de canjes para paginación
$totalCanjes = $pdo->query("SELECT COUNT(*) FROM compras")->fetchColumn();
$totalPaginas = ceil($totalCanjes / $canjesPorPagina);
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
                            <button class="filter-btn active">Todos</button>
                            <button class="filter-btn" data-filtro="disponibles">Disponibles</button>
                            <button class="filter-btn" data-filtro="No-disponible">No disponible</button>
                            <button class="filter-btn" data-filtro="mas-canjeados">Más Canjeados</button>
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
                                        $claseEstado = ($estado == 'Disponible') ? 'disponibles' : 'No-disponible';

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
                                            <a href="ver-producto.php?id=<?php echo $producto['id_producto']; ?>" class="action-icon"><i class="fas fa-eye"></i></a>
                                            <a href="eliminar-producto.php?id=<?php echo $producto['id_producto']; ?>" class="action-icon delete-icon"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <!--Paginacion de la pagina-->
                        <div class="pagination">
                            <div class="page-info">
                                Mostrando <?php echo $offset + 1; ?> - 
                                <?php echo min($offset + $productosPorPagina, $totalProductos); ?> 
                                de <?php echo $totalProductos; ?> productos
                            </div>

                            <div class="page-controls">
                                <?php if($paginaActual > 1): ?>
                                <a href="?pagina=<?php echo $paginaActual - 1; ?>" class="page-btn"><i class="fas fa-chevron-left"></i></a>
                                <?php endif; ?>

                                <?php for($i = 1; $i <= $totalPaginas; $i++): ?>
                                <a href="?pagina=<?php echo $i; ?>" style="text-decoration: none; font-weight:600;" class="page-btn <?php echo ($i == $paginaActual) ? 'active' : ''; ?>"><?php echo $i; ?></a>
                                <?php endfor; ?>

                                <?php if($paginaActual < $totalPaginas): ?>
                                <a href="?pagina=<?php echo $paginaActual + 1; ?>" style="text-decoration: none; font-weight:600;" class="page-btn"><i class="fas fa-chevron-right"></i></a>
                                <?php endif; ?>
                            </div>
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
                            <button class="filter-btn" data-filtro="Canjeo exitoso">Exitosos</button>
                            <button class="filter-btn" data-filtro="pendiente">Pendientes</button>
                            <button class="filter-btn" data-filtro="recientes">Recién Canjeados</button>
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
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody id="lista-canjes">
                                <?php foreach($canjes as  $canje): 
                                    // Asignar clase según el estado
                                    $estado = $canje['estado_compras'];
                                    $badgeClass = ($estado === 'Canjeo exitoso') ? 'badge-success' : 'badge-warning';

                                    // Filtros por fecha
                                    $fecha = strtotime($canje['fecha_compra']);
                                    $hoy = strtotime(date('Y-m-d'));
                                    $semana = strtotime('-7 days');
                                    $mes = strtotime('-30 days');

                                    $claseFecha = '';
                                    if ($fecha >= $hoy) $claseFecha = 'hoy';
                                    elseif ($fecha >= $semana) $claseFecha = 'semana';
                                    elseif ($fecha >= $mes) $claseFecha = 'mes';

                                    // Filtro pendiente
                                    $clasePendiente = ($estado === 'pendiente') ? 'pendiente' : '';

                                    // Clases combinadas para filtros
                                    $clasesFila = "$claseFecha $clasePendiente";
                                ?>
                                <tr class="<?php echo $clasesFila; ?>">
                                    <td>
                                        <div style="display:flex; align-items:center; gap:10px;">
                                            <img src="uploads/<?php echo htmlspecialchars($canje['imagen_producto'] ?? 'placeholder.png'); ?>" alt="Producto" class="product-img" style="width:40px; height:40px;">
                                            <span><?php echo htmlspecialchars($canje['compra']); ?></span>
                                        </div>
                                    </td>
                                    <td><?php echo htmlspecialchars($canje['usuario_nombre']); ?></td>
                                    <td><?php echo (int)$canje['puntos']; ?></td>
                                    <td><?php echo date('d/m/Y', strtotime($canje['fecha_compra'])); ?></td>
                                    <td><span class="status-badge <?php echo $badgeClass; ?>"><?php echo ucfirst($estado); ?></span></td>
                                    <td><a href="ver-canje.php?id=<?php echo $canje['id']; ?>" class="action-icon"><i class="fas fa-eye"></i></a></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                            </table>
                        </div>
                        <!--Paginacion de la pagina-->
                        <div class="pagination">
                            <div class="page-info">
                                Mostrando <?php echo $offset + 1; ?> -
                                <?php echo min($offset + $canjesPorPagina, $totalCanjes); ?>
                                de <?php echo $totalCanjes; ?> canjes
                            </div>

                            <div class="page-controls">
                                <?php if($paginaActual > 1): ?>
                                    <a href="?pagina=<?php echo $paginaActual - 1; ?>" class="page-btn"><i class="fas fa-chevron-left"></i></a>
                                <?php endif; ?>

                                <?php for($i = 1; $i <= $totalPaginas; $i++): ?>
                                    <a href="?pagina=<?php echo $i; ?>" class="page-btn <?php echo ($i == $paginaActual) ? 'active' : ''; ?>"><?php echo $i; ?></a>
                                <?php endfor; ?>

                                <?php if($paginaActual < $totalPaginas): ?>
                                    <a href="?pagina=<?php echo $paginaActual + 1; ?>" class="page-btn"><i class="fas fa-chevron-right"></i></a>
                                <?php endif; ?>
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
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.page-btn').forEach(function (btn) {
                btn.addEventListener('click', function (e) {
                    e.preventDefault();
                    const url = this.getAttribute('href');

                    fetch(url)
                        .then(response => response.text())
                        .then(data => {
                            // Extrae solo los productos y la nueva paginación
                            const parser = new DOMParser();
                            const htmlDoc = parser.parseFromString(data, 'text/html');
                            
                            const nuevosProductos = htmlDoc.querySelector('#lista-productos');
                            const nuevoPaginado = htmlDoc.querySelector('#paginado');

                            document.querySelector('#lista-productos').innerHTML = nuevosProductos.innerHTML;
                            document.querySelector('#paginado').innerHTML = nuevoPaginado.innerHTML;
                            
                            // Reasigna los eventos a los nuevos botones
                            document.querySelectorAll('.page-btn').forEach(function (btn) {
                                btn.addEventListener('click', arguments.callee);
                            });
                        });
                });
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const inputBuscar = document.getElementById("buscarProducto");
            const filas = document.querySelectorAll("#lista-productos tr");

            inputBuscar.addEventListener("keyup", function () {
                const filtro = inputBuscar.value.toLowerCase();

                filas.forEach(fila => {
                    const nombreProducto = fila.querySelector("td span").textContent.toLowerCase();
                    fila.style.display = nombreProducto.includes(filtro) ? "" : "none";
                });
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const botonesFiltro = document.querySelectorAll(".filter-btn");
            const filas = document.querySelectorAll("#lista-productos tr");

            botonesFiltro.forEach(btn => {
                btn.addEventListener("click", () => {
                    // Activar botón
                    botonesFiltro.forEach(b => b.classList.remove("active"));
                    btn.classList.add("active");

                    const filtro = btn.getAttribute("data-filtro");

                    filas.forEach(fila => {
                        if (filtro === "todos") {
                            fila.style.display = "";
                        } else {
                            fila.style.display = fila.classList.contains(filtro) ? "" : "none";
                        }
                    });
                });
            });
        });
    </script>
    <script>
            document.getElementById("buscarCanje").addEventListener("input", function () {
                const filtro = this.value.toLowerCase();
                const filas = document.querySelectorAll("#lista-canjes tr");

                filas.forEach(fila => {
                    const texto = fila.textContent.toLowerCase();
                    fila.style.display = texto.includes(filtro) ? "" : "none";
                });
            });

            </script>
</body>
</html>