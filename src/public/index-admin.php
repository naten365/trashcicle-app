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

//Funcion que muestra el numero total de usuarios en la base de datos
function totalClientes(){
  global $pdo;
  $sql = "SELECT COUNT(*) AS totalcliente FROM users  WHERE type_users = 'cliente'";
  $stmt = $pdo->prepare($sql);
  $stmt->execute();
  $result =  $stmt->fetch(PDO ::FETCH_ASSOC); 
  return isset($result['totalcliente']) ? (int)$result['totalcliente'] : 0;
}

//Funcion que muestra el total de usuarios nuevos en la base de datos
function totalClientesHoy(){
  global $pdo;
  $sql = "SELECT COUNT(*) AS totalcliente_hoy FROM users WHERE type_users = 'cliente' AND user_register_time = CURDATE()";
  $stmt = $pdo->prepare($sql);
  $stmt->execute();
  $result =  $stmt->fetch(PDO ::FETCH_ASSOC); 
  return (int) ($result['totalcliente_hoy'] ?? 0);
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
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TrashCicle Admin Panel</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="styles/index.css">
</head>
<body>
  <!-- Sidebar -->
  <div class="sidebar" id="sidebar">
    <div class="logo-container">
     <a href="#">
      <img src="assets/images/logo-trashcicle-new.png" alt="TrashCicle Logo" class="w-full trashcicle-logo">
     </a>
    </div>
    
    <div class="mt-8">
      <div class="menu-item active" data-page="inicio">
       <a href="#">
          <i class="fas fa-home"></i>
          <span id="span-elements">Inicio</span>
       </a>
      </div>
      <div class="menu-item" data-page="usuarios">
        <a href="user-management.php">
          <i class="fas fa-users"></i>
          <span  class="span-stat">Usuarios</span>
        </a>
      </div>
      <div class="menu-item" data-page="zafacones">
       <a href="prototypes.php">
          <i class="fas fa-trash-alt"></i>
          <span  class="span-stat">Zafacones</span>
       </a>
      </div>
      <div class="menu-item" data-page="productos">
        <a href="dashboard-products.php">
          <i class="fas fa-box"></i>
          <span  class="span-stat" >Productos</span>
        </a>
      </div>
      <div class="menu-item" data-page="dudas">
        <a href="questions-and-answers.php">
          <i class="fas fa-question-circle"></i>
          <span  class="span-stat">Duda</span>
        </a>
      </div>
    </div>
  </div>
  
  <!-- Main content -->
  <div class="main-content" id="main-content">
    <div class="flex justify-between items-center mb-8">
      <h1 class="text-2xl font-bold text-700" style="color: rgb(240, 240, 240);">Panel de Administrador</h1>
      <div class="user-menu" style="background:rgb(240, 240, 240); position: relative; cursor: pointer; padding: 10px; display: flex; align-items: center; gap: 5px;">
        <img src="assets/images/logo-trashcicle-desplex.png" alt="User">
        <span class="mr-2">Cuenta</span>
        <i class="fas fa-chevron-down"></i>
        
        <div class="submenu" style="display: none; position: absolute; top: 100%; right: 0; background: white; box-shadow: 0 2px 5px rgba(0,0,0,0.2); min-width: 150px; z-index: 100; border-radius: 4px;">
          <a href="#configuracion" style="display: block; padding: 10px 15px; text-decoration: none; color: #333; border-bottom: 1px solid #eee;">Configuración</a>
          <a href="#perfil" style="display: block; padding: 10px 15px; text-decoration: none; color: #333; border-bottom: 1px solid #eee;">Mi Perfil</a>
          <a href="logout.php" style="display: block; padding: 10px 15px; text-decoration: none; color: #333;">Cerrar Sesión</a>
        </div>
      </div>
    </div>
    
    <!-- Welcome banner with slider -->
    <div class="welcome-banner mb-8 opacity-0 animate-fade-in">
      <i class="fas fa-recycle recycle-icon"></i>
      
      <div class="slider-container">
        <div class="slider" id="welcome-slider">
          <!-- Slide 1 -->
          <div class="slide">
            <h2 class="text-3xl font-bold mb-2 text-center"  style="color:  #66bb6a;;">¡Bienvenido a TrashCicle Admin Panel!</h2>
            <p class="text-center mb-2">Estamos felices de verte.</p>
            <p class="text-center">Si necesitas una guía sobre el uso de este programa, pasa a la siguiente diapositiva.</p>
          </div>
          
          <!-- Slide 2 -->
          <div class="slide">
            <h2 class="text-3xl font-bold mb-4 text-center"  style="color: #66bb6a; ;">Gestión de Usuarios</h2>
            <p class="text-center mb-2">Administra fácilmente a todos los usuarios registrados en el sistema.</p>
            <p class="text-center">Podrás ver detalles, editar información y gestionar permisos.</p>
          </div>
          
          <!-- Slide 3 -->
          <div class="slide">
            <h2 class="text-3xl font-bold mb-4 text-center"  style="color: #66bb6a;">Control de Zafacones</h2>
            <p class="text-center mb-2">Monitorea en tiempo real el estado de los zafacones inteligentes.</p>
            <p class="text-center">Visualiza datos de llenado y ubicación geográfica.</p>
          </div>
          
          <!-- Slide 4 -->
          <div class="slide">
            <h2 class="text-3xl font-bold mb-4 text-center"  style="color: #66bb6a;">Catálogo de Productos</h2>
            <p class="text-center mb-2">Gestiona todos los productos reciclables en el sistema.</p>
            <p class="text-center">Agrega nuevos productos con información detallada.</p>
          </div>
          
          <!-- Slide 5 -->
          <div class="slide">
            <h2 class="text-3xl font-bold mb-4 text-center " style="color: #66bb6a;">¿Tienes alguna duda?</h2>
            <p class="text-center mb-2">¿Tienes alguna duda? Consulta nuestra sección de preguntas frecuentes.</p>
            <p class="text-center">O contacta con soporte técnico para asistencia personalizada.</p>
          </div>
        </div>
        
        <!-- Pagination -->
        <div class="pagination">
          <div class="arrow prev-slide">
            <i class="fas fa-chevron-left"></i>
          </div>
          <div class="dot active" data-slide="0"></div>
          <div class="dot" data-slide="1"></div>
          <div class="dot" data-slide="2"></div>
          <div class="dot" data-slide="3"></div>
          <div class="dot" data-slide="4"></div>
          <div class="arrow next-slide">
            <i class="fas fa-chevron-right"></i>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Actions section -->
    <div class="mb-8">
      <h2 class="text-2xl font-bold mb-6 text-gray-700"  style="color: rgba(240, 240, 240, 0);" >Acciones:</h2>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Action Card 1 -->
        <div class="action-card opacity-0 animate-fade-in delay-100">
          <div class="card-image bg-blue-50">
          <img src="assets/images/user-manager-page.png" alt="Usuarios">
          </div>
          <div class="card-content">
            <h3 class="text-lg font-semibold mb-2 text-800">Gestionar Usuarios</h3>
            <p class="text-600 text-sm">Administra usuarios del sistema, permisos y credenciales.</p>
            <div class="card-actions">
              <a href="user-management.php" class="btn-primary">
                <i class="fas fa-users mr-2"></i> Acceder
              </a>
            </div>
          </div>
        </div>
        
        <!-- Action Card 2 -->
        <div class="action-card opacity-0 animate-fade-in delay-200">
          <div class="card-image bg-green-50">
            <img src="assets/images/zafacones-img.png" alt="Gestionar Zafacones">
          </div>
          <div class="card-content">
            <h3 class="text-lg font-semibold mb-2 text-800">Gestionar Zafacones</h3>
            <p class="text-600 text-sm">Controla el estado y ubicación de los zafacones inteligentes.</p>
            <div class="card-actions">
              <a href="prototypes.php" class="btn-primary">
                <i class="fas fa-trash-alt mr-2"></i> Acceder
              </a>
            </div>
          </div>
        </div>
        
        <!-- Action Card 3 -->
        <div class="action-card opacity-0 animate-fade-in delay-300">
          <div class="card-image bg-yellow-50">
            <img src="assets/images/agregar-productos.png" alt="Agregar Productos">
          </div>
          <div class="card-content">
            <h3 class="text-lg font-semibold mb-2 text-800">Agregar Productos</h3>
            <p class="text-600 text-sm">Añade nuevos productos reciclables al catálogo del sistema.</p>
            <div class="card-actions">
              <a href="add-products.php" class="btn-primary">
                <i class="fas fa-plus-circle mr-2"></i> Acceder
              </a>
            </div>
          </div>
        </div>
        
        <!-- Action Card 4 -->
        <div class="action-card opacity-0 animate-fade-in delay-400">
          <div class="card-image bg-purple-50">
            <img src="assets/images/registar-usuario-imagne.png" alt="Crear Usuario">
          </div>
          <div class="card-content">
            <h3 class="text-lg font-semibold mb-2 text-800">Crear Usuario</h3>
            <p class="text-600 text-sm">Registra nuevos usuarios para acceder al sistema TrashCicle.</p>
            <div class="card-actions">
              <a href="register-user-form.php" class="btn-primary">
                <i class="fas fa-user-plus mr-2"></i> Acceder
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Stats quick view -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
      <div class="stat-card opacity-0 animate-fade-in delay-100">
        <div class="flex justify-between items-center">
          <h3 class="text-500 text-sm font-medium">Total Usuarios</h3>
          <span class="badge badge-blue">HOY</span>
        </div>
        <div class="flex items-baseline mt-4">
          <span class="text-2xl font-bold text-900"><?php echo  totalClientes()?></span>
          <span class="text-green-500 text-sm font-semibold ml-2">+<?php echo totalClientesHoy()?> nuevos</span>
        </div>
        <div class="mt-2">
          <div class="w-full bg-gray-200 rounded-full h-2.5">
            <div class="bg-blue-600 h-2.5 rounded-full" style="width: 70%"></div>
          </div>
        </div>
      </div>
      
      <div class="stat-card opacity-0 animate-fade-in delay-200">
        <div class="flex justify-between items-center">
          <h3 class="text-500 text-sm font-medium">Zafacones Activos</h3>
          <span class="badge badge-green">ONLINE</span>
        </div>
        <div class="flex items-baseline mt-4">
          <span class="text-2xl font-bold text-900"><?php echo  totalZafaconesActivos()?>/ <?php echo totalZafacones()?></span>
          <span class="text-green-500 text-sm font-semibold ml-2">  Registrados</span>
        </div>
        <div class="mt-2">
          <div class="w-full bg-200 rounded-full h-2.5">
            <div class="bg-green-500 h-2.5 rounded-full" style="width: 87%"></div>
          </div>
        </div>
      </div>
      
      <div class="stat-card opacity-0 animate-fade-in delay-300">
        <div class="flex justify-between items-center">
          <h3 class="text-500 text-sm font-medium">Total Productos</h3>
          <span class="badge badge-purple">CATÁLOGO</span>
        </div>
        <div class="flex items-baseline mt-4">
          <span class="text-2xl font-bold text-900">
            <!--Span con funcion que mueste el total  de producto en la tienda-->
            <?php echo totalProductos()?>
          </span>
          <!-- Span que muestros el numero de los porductos nuevos añadidos -->
          <span class="text-green-500 text-sm font-semibold ml-2">+<?php echo totalProductoshoy()?> nuevos</span>
        </div>
        <div class="mt-2">
          <div class="w-full bg-gray-200 rounded-full h-2.5">
            <div class="bg-purple-600 h-2.5 rounded-full" style="width: 60%"></div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Footer -->
    <footer class="mt-auto pt-6">
      <div class="text-center text-gray-500 text-sm">
        © 2025 TrashCicle Admin Panel. Todos los derechos reservados.
      </div>
    </footer>
  </div>
  <script>
    const userMenu = document.querySelector('.user-menu');
    const submenu = document.querySelector('.submenu');
    
    userMenu.addEventListener('mouseenter', () => {
      submenu.style.display = 'block';
    });
    
    userMenu.addEventListener('mouseleave', () => {
      submenu.style.display = 'none';
    });
  </script>
  <script src="scripts/index.js"></script>
</body>
</html>