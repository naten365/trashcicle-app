<?php
session_start();
include '../connection/conn.php';
checkUserPermissions('cliente');

//Verificar si el usuario está autenticado
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

//Obtenemos los datos del usuario del a sesion
$user_id = $_SESSION['user_id'];

//Obtener los datos del usuario de la base de datos
$sql = "SELECT * FROM users WHERE user_id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id', $user_id, PDO::PARAM_INT);
$stmt->execute();
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);


//Obtener los datos de la tabla productos de la base de datos
$sql =  "SELECT * FROM productos";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$productos_tienda =  $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/Tienda.css">
    <title>TrashCicle - Tienda Premium Sostenible</title>
</head>

<body>
    <!-- Header -->
    <header class="header">
        <div class="logo">
            <img src="assets/images/logo-trashcicle-new.png" alt="TrashCycle Logo" width="150px" style="object-fit: cover;">
        </div>
        <nav class="nav">
            <div class="trash-points">
                <img src="assets/images/logo-trashcicle-desplex.png" alt="TrashPoints Icon">
                <span>TrashPoints: <?php echo $usuario['user_points'] ?></span>
            </div>
            <a href="home-user.php" class="nav-link">Inicio</a>
            <a href="Tienda.php" class="nav-link active">Tienda</a>
            <a href="Afiliados.php" class="nav-link">Nuestros afiliados</a>
            <a href="formulario-contacto.php" class="nav-link">Contáctanos</a>
            <a href="customer-page.php" class="nav-link">Mi perfil</a>
        </nav>
    </header>
    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <span class="hero-badge">Nueva Colección</span>
            <h1>Productos Sostenibles Premium</h1>
            <p>Transforma tus TrashPoints en productos eco-amigables de alta calidad.</p>
        </div>
    </section>

    <!-- Filter Bar -->
    <div class="filter-container">
        <div class="filter-bar">
            <div class="filter-header">
                <h2 class="filter-title">Productos</h2>
                <span class="filter-count"><?php echo count($productos_tienda); ?> productos</span>
            </div>
            <div class="filter-options">
                <button class="filter-button active">
                    <span class="filter-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-archive">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M3 4m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z" />
                            <path d="M5 8v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-10" />
                            <path d="M10 12l4 0" />
                        </svg></span>
                    Todos
                </button>
                <button class="filter-button">
                    <span class="filter-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-play-football">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M11 4a1 1 0 1 0 2 0a1 1 0 0 0 -2 0" />
                            <path d="M3 17l5 1l.75 -1.5" />
                            <path d="M14 21v-4l-4 -3l1 -6" />
                            <path d="M6 12v-3l5 -1l3 3l3 1" />
                            <path d="M19.5 20a.5 .5 0 1 0 0 -1a.5 .5 0 0 0 0 1z" fill="currentColor" />
                        </svg></span>
                    Deportes
                </button>
                <button class="filter-button">
                    <span class="filter-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-home">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                            <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                            <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                        </svg></span>
                    Hogar
                </button>
                <button class="filter-button">
                    <span class="filter-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-stack-2">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M12 4l-8 4l8 4l8 -4l-8 -4" />
                            <path d="M4 12l8 4l8 -4" />
                            <path d="M4 16l8 4l8 -4" />
                        </svg></span>
                    Otros
                </button>
            </div>
        </div>
    </div>

    <!-- Product Grid -->
    <div class="products-container">
        <div class="product-grid">
            <?php foreach ($productos_tienda as $producto): ?>
                <div class="product-card"
                    data-category="<?= htmlspecialchars($producto['categria_producto']) ?>"
                    data-product-id="<?= htmlspecialchars($producto['id_producto']) ?>">
                    <div class="product-image">
                        <img src="uploads/<?= htmlspecialchars($producto['imagen_producto']) ?>" alt="<?= htmlspecialchars($producto['nombre_producto']) ?>">
                        <div class="product-overlay">
                            <button class="quick-view-btn"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-eye">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                    <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                </svg>Vista Rápida</button>
                        </div>
                        <div class="product-tag"><?= htmlspecialchars($producto['product_etiqueta']) ?></div>
                    </div>
                    <div class="product-info">
                        <div class="product-category"><?= htmlspecialchars($producto['categria_producto']) ?></div>
                        <h3 class="product-title"><?= htmlspecialchars($producto['nombre_producto']) ?></h3>
                        <p class="product-description"><?= htmlspecialchars($producto['descripcion']) ?></p>
                        <div class="product-footer">
                            <div class="product-price">
                                <span class="price-label">Precio Regular</span>
                                <span class="price-value">$RD<?= htmlspecialchars($producto['precio']) ?></span>
                            </div>
                            <div class="trash-points-badge">
                                <span class="points-value"><?= htmlspecialchars($producto['product_prices_points']) ?></span>
                                <span class="points-label">TP</span>
                            </div>
                        </div>
                        <button class="add-to-cart" onclick="location.href='exchange-product.php?product_id=<?= htmlspecialchars($producto['id_producto']) ?>'">
                            <span class="cart-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-shopping-bag">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M6.331 8h11.339a2 2 0 0 1 1.977 2.304l-1.255 8.152a3 3 0 0 1 -2.966 2.544h-6.852a3 3 0 0 1 -2.965 -2.544l-1.255 -8.152a2 2 0 0 1 1.977 -2.304z" />
                                    <path d="M9 11v-5a3 3 0 0 1 6 0v5" />
                                </svg></span>
                            Canjear Producto
                        </button>
                    </div>
                </div>
            <?php endforeach; ?>
            <!-- Mensaje de no productos -->
            <div class="no-products-message" style="display: none;">
                <div class="no-products-content">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3 3h18v18H3z" />
                        <path d="M12 8v8" />
                        <path d="M8 12h8" />
                    </svg>
                    <h3>No hay productos disponibles</h3>
                    <p>No se encontraron productos en esta categoría.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick View Modal -->
    <div id="quickViewModal" class="modal">
        <div class="modal-content">
            <span class="close-modal">&times;</span>
            <div class="modal-body">
                <div class="product-preview">
                    <div class="preview-image">
                        <img id="modalProductImage" src="" alt="Product Preview">
                    </div>
                    <div class="preview-info">
                        <span id="modalProductCategory" class="preview-category"></span>
                        <h2 id="modalProductName" class="preview-title"></h2>
                        <p id="modalProductDescription" class="preview-description"></p>
                        <div class="preview-price-container">
                            <div class="preview-price">
                                <span class="price-label">Precio Regular</span>
                                <span id="modalProductPrice" class="price-value"></span>
                            </div>
                            <div class="preview-points">
                                <span class="points-label">TrashPoints necesarios</span>
                                <span id="modalProductPoints" class="points-value"></span>
                            </div>
                        </div>
                        <button class="preview-cta" id="modalExchangeButton">
                            <span class="cart-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-shopping-bag">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M6.331 8h11.339a2 2 0 0 1 1.977 2.304l-1.255 8.152a3 3 0 0 1 -2.966 2.544h-6.852a3 3 0 0 1 -2.965 -2.544l-1.255 -8.152a2 2 0 0 1 1.977 -2.304z" />
                                    <path d="M9 11v-5a3 3 0 0 1 6 0v5" />
                                </svg>
                            </span>
                            Canjear Producto
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <div class="footer-column">
                <h3>TrashCicle</h3>
                <p style="color: var(--text-light); margin-bottom: var(--spacing-md);">Transformando residuos en productos premium sostenibles.</p>
                <div class="footer-social">
                    <a href="#" class="social-icon">F</a>
                    <a href="#" class="social-icon">I</a>
                    <a href="#" class="social-icon">T</a>
                    <a href="#" class="social-icon">Y</a>
                </div>
            </div>
            <div class="footer-column">
                <h3>Navegación</h3>
                <div class="footer-links">
                    <a href="#" class="footer-link">Inicio</a>
                    <a href="#" class="footer-link">Productos</a>
                    <a href="#" class="footer-link">Sobre Nosotros</a>
                    <a href="#" class="footer-link">Blog</a>
                    <a href="#" class="footer-link">Contáctanos</a>
                </div>
            </div>
            <div class="footer-column">
                <h3>Categorías</h3>
                <div class="footer-links">
                    <a href="#" class="footer-link">Deportes</a>
                    <a href="#" class="footer-link">Hogar</a>
                    <a href="#" class="footer-link">Escolar</a>
                    <a href="#" class="footer-link">Accesorios</a>
                    <a href="#" class="footer-link">Novedades</a>
                </div>
            </div>
            <div class="footer-column">
                <h3>TrashPoints</h3>
                <div class="footer-links">
                    <a href="#" class="footer-link">¿Cómo funcionan?</a>
                    <a href="#" class="footer-link">Beneficios</a>
                    <a href="#" class="footer-link">Estado de puntos</a>
                    <a href="#" class="footer-link">Canjear puntos</a>
                    <a href="#" class="footer-link">Programa de afiliados</a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="copyright">© 2025 TrashCicle. Todos los derechos reservados.</div>
            <div class="footer-legal">
                <a href="#" class="legal-link">Términos y condiciones</a>
                <a href="#" class="legal-link">Política de privacidad</a>
                <a href="#" class="legal-link">Políticas de cookies</a>
            </div>
        </div>
    </footer>
    <script src="scripts/tienda.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const filterButtons = document.querySelectorAll('.filter-button');
            const productGrid = document.querySelector('.product-grid');
            const productCards = document.querySelectorAll('.product-card');
            const modal = document.getElementById('quickViewModal');
            const closeModal = document.querySelector('.close-modal');
            const quickViewButtons = document.querySelectorAll('.quick-view-btn');



            // Verificar si hay productos
            if (productCards.length === 0) {
                console.log('No hay productos para mostrar');
                return;
            }

            filterButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Obtener solo el texto, ignorando el SVG
                    const category = Array.from(this.childNodes)
                        .filter(node => node.nodeType === Node.TEXT_NODE)
                        .map(node => node.textContent.trim())
                        .join('')
                        .trim();

                    console.log('Categoría seleccionada:', category);

                    // Quitar active de todos los botones
                    filterButtons.forEach(btn => btn.classList.remove('active'));
                    // Añadir active al botón clickeado
                    this.classList.add('active');

                    let visibleProducts = 0;

                    productCards.forEach(card => {
                        const productCategory = card.dataset.category;
                        console.log('Categoría del producto:', productCategory);

                        if (category === 'Todos' || productCategory === category) {
                            card.style.display = '';
                            visibleProducts++;
                        } else {
                            card.style.display = 'none';
                        }
                    });

                    // Actualizar visualización del grid
                    productGrid.style.display = visibleProducts > 0 ? 'grid' : 'block';

                    // Mostrar mensaje si no hay productos
                    const noProductsMessage = document.querySelector('.no-products-message');
                    if (noProductsMessage) {
                        noProductsMessage.style.display = visibleProducts === 0 ? 'block' : 'none';
                    }
                });
            });

            // Iniciar con "Todos" seleccionado
            filterButtons[0].click();

            function openModal(productData) {
                // Primero mostramos el modal pero mantenemos opacity 0
                modal.style.display = 'flex';

                // Forzamos un reflow para que la transición funcione
                modal.offsetHeight;

                // Agregamos la clase show para iniciar la animación
                modal.classList.add('show');
                document.body.style.overflow = 'hidden';

                document.getElementById('modalProductImage').src = productData.image;
                document.getElementById('modalProductCategory').textContent = productData.category;
                document.getElementById('modalProductName').textContent = productData.name;
                document.getElementById('modalProductDescription').textContent = productData.description;
                document.getElementById('modalProductPrice').textContent = `$RD${productData.price}`;
                document.getElementById('modalProductPoints').textContent = `${productData.points} TP`;

                modal.classList.add('show');
                document.body.style.overflow = 'hidden';

                // Actualizar el botón de canje con el ID del producto
                document.getElementById('modalExchangeButton').onclick = function() {
                    location.href = `exchange-product.php?product_id=${productData.productId}`;
                };
            }

            quickViewButtons.forEach(button => {
                button.addEventListener('click', (e) => {
                    e.preventDefault();
                    const card = button.closest('.product-card');
                    const productData = {
                        image: card.querySelector('.product-image img').src,
                        category: card.querySelector('.product-category').textContent,
                        name: card.querySelector('.product-title').textContent,
                        description: card.querySelector('.product-description').textContent,
                        price: card.querySelector('.price-value').textContent.replace('$RD', ''),
                        points: card.querySelector('.points-value').textContent,
                        productId: card.dataset.productId
                    };
                    openModal(productData);
                });
            });


            closeModal.addEventListener('click', () => {
                modal.classList.remove('show');
                document.body.style.overflow = '';
            });

            modal.addEventListener('click', (e) => {
                if (e.target === modal) {
                    modal.classList.remove('show');
                    document.body.style.overflow = '';
                }
            });

            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && modal.classList.contains('show')) {
                    modal.classList.remove('show');
                    document.body.style.overflow = '';
                }
            });
        });
    </script>
</body>

</html>