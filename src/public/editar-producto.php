<?php
session_start();
include '../connection/conn.php'; // Conexión con PDO

// Obtener el id desde la URL
if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];

    // Obtener datos del producto
    $stmt = $pdo->prepare("SELECT * FROM productos WHERE id_producto = :id");
    $stmt->execute([':id' => $id]);
    $producto = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$producto) {
        echo "Producto no encontrado.";
        exit;
    }
} else {
    echo "ID no especificado.";
    exit;
}

//Bloque de codigo que se encarga de manejar la actualizacion

if (isset($_POST['actualizar'])) {
    $nombre = $_POST['nombre_producto']; // Cambiar a 'nombre' para coincidir con el formulario
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $puntos = $_POST['puntos']; // Cambiar a 'points' para coincidir con el formulario
    $etiqueta = $_POST['etiqueta']; // Cambiar a 'etiqueta' para coincidir con el formulario
    $cantidad = $_POST['stock']; // Cambiar a 'stock' para coincidir con el formulario
    $categoria = $_POST['categoria']; // Cambiar a 'categoria' para coincidir con el formulario
    $estado = $_POST['estado']; // Cambiar a 'estado' para coincidir con el formulario

    // Actualizar el producto
    $sql = "UPDATE productos SET 
        nombre_producto = :nombre,
        descripcion = :descripcion,
        precio = :precio,
        cantidad_stock = :cantidad,
        categria_producto = :categoria, 
        estado_producto = :estado,
        product_prices_points = :puntos,
        product_etiqueta = :etiqueta
        WHERE id_producto = :id";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':nombre' => $nombre,
        ':descripcion' => $descripcion,
        ':precio' => $precio,
        ':cantidad' => $cantidad,
        ':categoria' => $categoria,
        ':puntos' => $puntos,
        ':etiqueta' => $etiqueta,
        ':estado' => $estado,
        ':id' => $id
    ]);

    // Procesamiento de imagen (si se sube una nueva)
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
        $nombre_imagen = time() . '_' . $_FILES['imagen']['name'];
        $ruta_destino = 'uploads/' . $nombre_imagen;
        
        if (move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta_destino)) {
            // Actualizar solo el campo de imagen
            $sql_imagen = "UPDATE productos SET imagen_producto = :imagen WHERE id_producto = :id";
            $stmt_imagen = $pdo->prepare($sql_imagen);
            $stmt_imagen->execute([
                ':imagen' => $nombre_imagen,
                ':id' => $id
            ]);
        }
    }

    // Redirección a la página de productos
    header("Location: dashboard-products.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        
        :root {
            --primary-color: #4CAF50;
            --primary-hover: #3e9c41;
            --bg-dark: #121318;
            --bg-card: #1e1f2b;
            --text-color: #ffffff;
            --input-bg: #2a2c3d;
            --border-color: #373a54;
            --error-color: #ff5252;
            --shadow-color: rgba(0, 0, 0, 0.5);
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--bg-dark);
            color: var(--text-color);
            margin: 0;
            padding: 10px;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        
        .container {
            width: 100%;
            max-width: 900px;
            background-color: var(--bg-card);
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
            overflow: hidden;
        }
        
        header {
            background: linear-gradient(135deg, #373a54, #232534);
            padding: 12px 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        h1 {
            margin: 0;
            font-size: 18px;
            font-weight: 600;
            text-align: center;
            letter-spacing: 0.5px;
        }
        
        .content {
            padding: 15px;
        }
        
        .form-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
        }
        
        .span-2 {
            grid-column: span 2;
        }
        
        .span-3 {
            grid-column: span 3;
        }
        
        .form-group {
            margin-bottom: 12px;
        }
        
        label {
            display: block;
            margin-bottom: 4px;
            font-weight: 500;
            font-size: 12px;
            color: rgba(255, 255, 255, 0.85);
        }
        
        input[type="text"], 
        input[type="number"],
        select,
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            background-color: var(--input-bg);
            color: var(--text-color);
            font-size: 13px;
            font-family: 'Poppins', sans-serif;
            transition: all 0.3s ease;
        }
        
        /* Ajuste para los inputs */
        input[type="text"], 
        input[type="number"],
        select {
            height: 38px;
        }
        
        /* Ajuste específico para el textarea - ahora mucho más grande */
        textarea {
            height: 180px;
            resize: vertical;
            min-height: 150px;
            padding: 15px;
            line-height: 1.6;
            font-size: 14px;
        }
        
        input[type="file"] {
            padding: 8px;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            background-color: var(--input-bg);
            color: var(--text-color);
            font-size: 13px;
            cursor: pointer;
            height: 38px;
        }
        
        input:focus, 
        select:focus, 
        textarea:focus,
        input[type="file"]:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 2px rgba(76, 175, 80, 0.15);
        }
        
        button {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 10px 0;
            width: 100%;
            font-size: 14px;
            font-weight: 600;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s ease;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            box-shadow: 0 4px 8px rgba(76, 175, 80, 0.3);
        }
        
        button:hover {
            background-color: var(--primary-hover);
            transform: translateY(-1px);
            box-shadow: 0 5px 12px rgba(76, 175, 80, 0.4);
        }
        
        button:active {
            transform: translateY(0);
        }
        
        .image-section {
            display: flex;
            gap: 10px;
            align-items: center;
        }
        
        .file-input-container {
            flex: 1;
            position: relative;
        }
        
        .file-input-label {
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px dashed var(--border-color);
            border-radius: 6px;
            padding: 15px 10px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            background-color: rgba(58, 61, 77, 0.2);
            height: 80px;
        }
        
        .file-input-label:hover {
            border-color: var(--primary-color);
            background-color: rgba(76, 175, 80, 0.05);
        }
        
        .file-input-text {
            font-size: 12px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        
        input[type="file"] {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
        }
        
        .image-preview {
            width: 120px;
            height: 80px;
            object-fit: cover;
            border-radius: 6px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.15);
        }
        
        .error-message {
            color: var(--error-color);
            font-size: 11px;
            margin-top: 3px;
            display: none;
            font-weight: 500;
        }
        
        .success-message {
            background-color: rgba(76, 175, 80, 0.1);
            color: var(--primary-color);
            padding: 8px;
            border-radius: 6px;
            margin-bottom: 10px;
            display: none;
            font-weight: 500;
            font-size: 12px;
            border-left: 3px solid var(--primary-color);
        }
        
        .plus-icon {
            font-size: 18px;
            margin-bottom: 5px;
            color: var(--primary-color);
            display: inline-block;
            height: 30px;
            width: 30px;
            line-height: 26px;
            border-radius: 50%;
            border: 2px solid var(--primary-color);
        }
        
        .actions {
            display: flex;
            justify-content: flex-end;
            margin-top: 12px;
        }
        
        .actions button {
            width: auto;
            padding: 10px 30px;
        }
        
        @keyframes shake {
            0%, 100% {transform: translateX(0);}
            10%, 30%, 50%, 70%, 90% {transform: translateX(-5px);}
            20%, 40%, 60%, 80% {transform: translateX(5px);}
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1><span style="color: var(--primary-color);">Editar</span> un producto de la Tienda</h1>
        </header>
        
        <div class="content">
            <div id="successMessage" class="success-message">
                ✅ Producto actualizado correctamente
            </div>
        
            <form id="editProductForm" action="editar-producto.php?id=<?php echo $id; ?>" method="POST" enctype="multipart/form-data">
    <div class="form-grid">
        <!-- Primera fila -->
        <div class="form-group">
            <label for="nombre">Nombre del producto</label>
            <input type="text" id="nombre" name="nombre_producto" value="<?php echo $producto['nombre_producto']?>" required>
            <div id="nombreError" class="error-message">⚠️ El nombre es obligatorio</div>
        </div>
        
        <div class="form-group">
            <label for="precio">Precio (Dinero)</label>
            <input type="number" id="precio" name="precio" value="<?php echo $producto['precio']?>" min="0" step="0.01" required>
            <div id="precioError" class="error-message">⚠️ El precio debe ser mayor que 0</div>
        </div>

        <div class="form-group">
            <label for="precio">Precio (Puntos)</label>
            <input type="number" id="precio" name="puntos" value="<?php echo $producto['product_prices_points']?>" min="0" step="0.01" required>
            <div id="precioError" class="error-message">⚠️ El precio debe ser mayor que 0</div>
        </div>

        <div class="form-group">
            <label for="etiqueta">Etiqueta</label>
            <input type="text" id="etiqueta" name="etiqueta" value="<?php echo $producto['product_etiqueta']?>"required>
            <div id="etiquetaError" class="error-message">⚠️ Debe tener 3 caracteres o mas</div>
        </div>
        
        <div class="form-group">
            <label for="stock">Stock disponible</label>
            <input type="number" id="stock" name="stock" value="<?php echo $producto['cantidad_stock']?>" min="0" required>
            <div id="stockError" class="error-message">⚠️ El stock debe ser ≥ 0</div>
        </div>
        
        <!-- Segunda fila -->
        <div class="form-group">
            <label for="categoria">Categoría</label>
            <select id="categoria" name="categoria" required>
                <option value="">Seleccionar categoría</option>
                <option value="otros" <?php if ($producto['categria_producto'] == 'otros') echo 'selected'; ?>>otros</option>
                <option value="Plastico" <?php if ($producto['categria_producto'] == 'Plastico') echo 'selected'; ?>>Plastico</option>
                <option value="Organico" <?php if ($producto['categria_producto'] == 'Organico') echo 'selected'; ?>>Organico</option>
                <option value="Carton_paper" <?php if ($producto['categria_producto'] == 'Carton_paper') echo 'selected'; ?>>Carton o Paper</option>
            </select>
            <div id="categoriaError" class="error-message">⚠️ Seleccione una categoría</div>
        </div>

        
        
        <div class="form-group">
            <label for="estado">Estado del producto</label>
            <select id="estado" name="estado" required>
                <option value="">Seleccionar estado</option>
                <option value="Disponible" <?php if ($producto['estado_producto'] == 'Disponible') echo 'selected'; ?>>Disponible</option>
                <option value="No disponible" <?php if ($producto['estado_producto'] == 'No disponible') echo 'selected'; ?>>No disponible</option>
            </select>
            <div id="estadoError" class="error-message">⚠️ Seleccione un estado</div>
        </div>
        
        <div class="form-group span-3">
            <label for="descripcion">Descripción detallada del producto</label>
            <textarea id="descripcion" name="descripcion" required placeholder="Ingrese una descripción completa del producto incluyendo características, beneficios, materiales, etc."><?php echo $producto['descripcion']?></textarea>
            <div id="descripcionError" class="error-message">⚠️ La descripción es obligatoria</div>
        </div>
        
        <!-- Tercera fila - para la imagen -->
        <div class="form-group span-3">
            <label>Imagen del producto:</label>
            <div class="image-section">
                <div class="file-input-container">
                    <label for="imagen" class="file-input-label">
                        <div class="file-input-text">
                            <span class="plus-icon">+</span>
                            <p>Subir imagen</p>
                        </div>
                    </label>
                    <input type="file" id="imagen" name="imagen" accept="image/*">
                </div>
                <img src="uploads/<?php echo $producto['imagen_producto']?>" alt="Vista previa" class="image-preview" id="imagePreview">
                <div id="imagenError" class="error-message">⚠️ La imagen es obligatoria</div>
            </div>
        </div>
    </div>
    
    <div class="actions">
        <button type="submit" name="actualizar" value="1">ACTUALIZAR PRODUCTO</button>
    </div>
</form>
        </div>
    </div>

    <script>
       
       ocument.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('editProductForm');
    const fileInput = document.getElementById('imagen');
    const imagePreview = document.getElementById('imagePreview');
    const successMessage = document.getElementById('successMessage');
    
    // Variables para validación
    let imagenCargada = true; // Asumimos que ya hay una imagen cargada
    
    // Efecto hover para los campos
    const inputElements = document.querySelectorAll('input, select, textarea');
    inputElements.forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.classList.add('focused');
        });
        
        input.addEventListener('blur', function() {
            this.parentElement.classList.remove('focused');
        });
    });
    
    // Procesar la carga de imagen
    fileInput.addEventListener('change', function(e) {
        if (this.files && this.files[0]) {
            imagenCargada = true;
            document.getElementById('imagenError').style.display = 'none';
            
            // Mostrar vista previa
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.src = e.target.result;
                imagePreview.style.opacity = '0.6';
                setTimeout(() => {
                    imagePreview.style.opacity = '1';
                }, 500);
            }
            reader.readAsDataURL(this.files[0]);
        }
    });
    
    // Validación del formulario con animación
    form.addEventListener('submit', function(event) {
        // Validamos el formulario pero NO prevenimos el envío por defecto todavía
        
        // Animación del botón
        const submitButton = this.querySelector('button[type="submit"]');
        submitButton.innerHTML = 'PROCESANDO...';
        
        // Resetear mensajes de error
        const errorElements = document.querySelectorAll('.error-message');
        errorElements.forEach(error => error.style.display = 'none');
        
        let isValid = true;
        
        // Validación de Nombre
        const nombre = document.getElementById('nombre').value.trim();
        if (!nombre) {
            document.getElementById('nombreError').style.display = 'block';
            animarCampoError('nombre');
            isValid = false;
        }
        
        // Validación de Precio
        const precio = parseFloat(document.getElementById('precio').value);
        if (isNaN(precio) || precio <= 0) {
            document.getElementById('precioError').style.display = 'block';
            animarCampoError('precio');
            isValid = false;
        }
        
        // Validación de Categoría
        const categoria = document.getElementById('categoria').value;
        if (!categoria) {
            document.getElementById('categoriaError').style.display = 'block';
            animarCampoError('categoria');
            isValid = false;
        }
        
        // Validación de Stock
        const stock = parseInt(document.getElementById('stock').value);
        if (isNaN(stock) || stock < 0 || !Number.isInteger(stock)) {
            document.getElementById('stockError').style.display = 'block';
            animarCampoError('stock');
            isValid = false;
        }
        
        // Validación de Estado
        const estado = document.getElementById('estado').value;
        if (!estado) {
            document.getElementById('estadoError').style.display = 'block';
            animarCampoError('estado');
            isValid = false;
        }
        
        // Validación de Descripción
        const descripcion = document.getElementById('descripcion').value.trim();
        if (!descripcion) {
            document.getElementById('descripcionError').style.display = 'block';
            animarCampoError('descripcion');
            isValid = false;
        }
        
        // Si no es válido, prevenir el envío
        if (!isValid) {
            event.preventDefault();
            // Restaurar el botón después de un tiempo
            setTimeout(() => {
                submitButton.innerHTML = 'ACTUALIZAR PRODUCTO';
                submitButton.disabled = false;
            }, 1000);
        } else {
            // Si es válido, permitir que el formulario se envíe normalmente
            // No hacemos nada y dejamos que el formulario se envíe al servidor PHP
            
            // También podríamos mostrar un mensaje temporal de "Enviando..."
            successMessage.style.display = 'block';
            successMessage.textContent = '⏳ Enviando datos al servidor...';
        }
    });
    
    // Función para animar campo con error
    function animarCampoError(inputId) {
        const elemento = document.getElementById(inputId);
        elemento.style.borderColor = 'var(--error-color)';
        elemento.style.animation = 'shake 0.5s';
        
        setTimeout(() => {
            elemento.style.animation = '';
            elemento.style.borderColor = 'var(--border-color)';
        }, 500);
    }
});
    </script>
</body>
</html>