<?php
session_start();
include '../connection/conn.php';


$servidor = "localhost";
$usuario = "root";
$clave = "";
$baseDeDatos = "trashcicle_db";

$enlace = mysqli_connect($servidor, $usuario, $clave, $baseDeDatos);


if (!$enlace) {
    die("❌ Error de conexión: " . mysqli_connect_error());
}

$mensaje = ""; 
$productoAgregado = false; 


if (isset($_POST['registro'])) {
    $nombre = $_POST['productName'] ?? '';
    $precio = $_POST['productPrice'] ?? '';
    $descripcion = $_POST['productDescription'] ?? '';
    $stock = 1; 
    $fecha = date('Y-m-d H:i:s');

    if (!empty($nombre) && !empty($precio) && !empty($descripcion)) {
        $stmt = $enlace->prepare("INSERT INTO productos (nombre_producto, descripcion, precio, cantidad_stock, fecha_creacion) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssdis", $nombre, $descripcion, $precio, $stock, $fecha);

        if ($stmt->execute()) {
            $mensaje = "✅ Producto agregado exitosamente.";
            $productoAgregado = true; 
        } else {
            $mensaje = "❌ Error al registrar: " . $stmt->error;
        }

        $stmt->close();
    } else {
        $mensaje = "⚠️ Todos los campos son obligatorios.";
    }
}

mysqli_close($enlace);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TrashCicle - Agregar Productos</title>
    <link rel="stylesheet" href="styles/add-products.css">
    <style>
             .redirect-arrow, .help-button {
            position: fixed;
            bottom: 20px;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: #4CAF50;
            color: white;
            border: none;
            font-size: 20px;
            cursor: pointer;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .redirect-arrow {
            left: 20px;
        }
        .help-button {
            right: 20px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="form-container">
        <h1><span>Agregar</span> un producto a la <span>Tienda</span></h1>

        <form id="productForm" method="POST" enctype="multipart/form-data" novalidate onsubmit="return validateForm()">
            <div class="form-layout">
                <div class="form-group">
                    <label for="productName">Nombre</label>
                    <input type="text" id="productName" name="productName" placeholder="Nombre del producto" required>
                </div>
                
                <div class="form-group">
                    <label for="productPrice">Precio (puntos)</label>
                    <input type="number" id="productPrice" name="productPrice" placeholder="Valor en puntos" min="1" required>
                </div>
                
                <div class="form-group full-width">
                    <label for="productDescription">Descripción:</label>
                    <textarea id="productDescription" name="productDescription" placeholder="Descripción del producto" required></textarea>
                </div>
                
                <div class="form-group full-width">
                    <label for="productImage">Imagen del producto:</label>
                    <div class="file-upload" id="fileUploadContainer">
                        <input type="file" id="productImage" name="productImage" accept="image/*" required>
                        <div class="file-upload-icon">+</div>
                        <div class="file-upload-text">Subir imagen o arrastrar aquí</div>
                    </div>
                    <img id="imagePreview" class="file-preview" src="#" alt="Vista previa">
                    <div class="error-message">Se requiere una imagen del producto</div>
                </div>
            </div>
            
            <button type="submit" class="submit-btn" name="registro">Agregar</button>
        </form>
    </div>
</div>

<!-- Modal para mostrar consejos -->
<div class="modal" id="tipsModal">
    <div class="modal-content">
        <div class="modal-close" id="closeModal">✕</div>
        <h3 class="modal-title">Consejo TrashCicle</h3>
        <p class="modal-text">Añadir productos reciclados a nuestra tienda ayuda a promover la economía circular y reducir la huella de carbono.</p>
        <p class="modal-text">¡Cada producto reciclado hace la diferencia!</p>
        <div class="modal-button" id="modalButton">Entendido</div>
    </div>
</div>

<button onclick="window.location.href='index-admin.php'" type="button" class="redirect-arrow">
    <span style="transform: rotate(180deg);">➔</span>
</button>

<button type="button" class="help-button" onclick="alert('Aquí puedes agregar productos reciclados a la tienda. Asegúrate de completar todos los campos.')">
    ?
</button>

<script>
function validateForm() {
    const nombre = document.getElementById('productName').value.trim();
    const precio = document.getElementById('productPrice').value;
    const descripcion = document.getElementById('productDescription').value.trim();
    const imagen = document.getElementById('productImage').value;

    if (!nombre || !precio || !descripcion || !imagen) {
        alert('⚠️ Todos los campos son obligatorios.');
        return false; 
    }
    return true; 
}


<?php if ($productoAgregado): ?>
    alert("✅ Producto agregado exitosamente.");
<?php endif; ?>
</script>

<script src="scripts/add-products.js"></script>

</body>
</html>
