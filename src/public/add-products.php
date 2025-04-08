<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TrashCicle - Agregar Producto</title>
    <link rel="stylesheet" href="styles/add-products.css">
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h1><span>Agregar</span> un producto a la <span>Tienda</span></h1>
            <form id="productForm" novalidate>
                <div class="form-layout">
                    <div class="form-group">
                        <label for="productName">Nombre</label>
                        <input type="text" id="productName" name="productName" placeholder="Nombre del producto" required>
                        <div class="error-message">El nombre del producto es obligatorio</div>
                    </div>
                    
                    <div class="form-group">
                        <label for="productPrice">Precio (puntos)</label>
                        <input type="number" id="productPrice" name="productPrice" placeholder="Valor en puntos" min="1" required>
                        <div class="error-message">El precio debe ser mayor a 0</div>
                    </div>
                    
                    <div class="form-group full-width">
                        <label for="productDescription">Descripción:</label>
                        <textarea id="productDescription" name="productDescription" placeholder="Descripción del producto" required></textarea>
                        <div class="error-message">La descripción es obligatoria</div>
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
                
                <button type="submit" class="submit-btn">Agregar</button>
            </form>
        </div>
    </div>
    
    <div class="open-tips" id="openTips">?</div>
    <button onclick="window.location.href='home.php'" type="button" class="btn-regresar" style="position: fixed; bottom: 20px; left: 20px; width: 50px; height: 50px; border-radius: 50%; background-color: #4CAF50; color: white; border: none; font-size: 20px; cursor: pointer; display: flex; justify-content: center; align-items: center;">
      <span style="transform: rotate(180deg);">➔</span>
    </button>
    
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
    <script src="scripts/add-products.js"></script>
</body>
</html>