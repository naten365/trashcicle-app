<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dispositivos Activos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #0f111a;
            color: white;
            height: 100vh;
            overflow: hidden;
            box-sizing: border-box;
        }
        
        * {
            box-sizing: border-box;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            flex-shrink: 0;
        }
        
        .title {
            font-size: 28px;
            font-weight: bold;
        }
        
        .title span {
            color: #4CAF50;
        }
        
        .search-box {
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            padding: 10px 15px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            flex-shrink: 0;
        }
        
        .search-box input {
            background: transparent;
            border: none;
            color: white;
            width: 100%;
            padding: 5px 10px;
            font-size: 16px;
            outline: none;
        }
        
        .search-icon {
            color: #888;
            margin-right: 10px;
        }
        
        .devices-container {
            flex-grow: 1;
            overflow-y: auto;
            position: relative;
            padding-right: 10px;
            scrollbar-width: thin;
            scrollbar-color: #4CAF50 rgba(0, 0, 0, 0.2);
        }
        
        .device-card {
            background-color: #1a1c2e;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .device-info {
            flex: 1;
        }
        
        .device-name {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        
        .device-location {
            color: #888;
            font-size: 14px;
        }
        
        .device-status {
            display: flex;
            align-items: center;
            margin-right: 20px;
        }
        
        .status-label {
            margin-right: 10px;
        }
        
        .status-indicator {
            width: 15px;
            height: 15px;
            border-radius: 50%;
            margin-left: 5px;
        }
        
        .status-active {
            background-color: #4CAF50;
        }
        
        .status-inactive {
            background-color: #F44336;
        }
        
        .status-warning {
            background-color: #FFC107;
        }
        
        .device-points {
            margin-right: 20px;
            color: #888;
        }
        
        .btn {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            margin-left: 10px;
        }
        
        .btn-action {
            background-color: #2c3e50;
            margin-left: 5px;
        }
        
        .btn-add {
            background-color: #4CAF50;
            display: flex;
            align-items: center;
            padding: 10px 15px;
        }
        
        .btn-add span {
            margin-left: 5px;
        }
        
        .action-buttons {
            display: flex;
        }
        
        .device-right {
            display: flex;
            align-items: center;
        }
        
        /* Estilo para la barra de desplazamiento nativa en WebKit (Chrome, Safari, etc.) */
        .devices-container::-webkit-scrollbar {
            width: 6px;
        }
        
        .devices-container::-webkit-scrollbar-track {
            background: rgba(0, 0, 0, 0.2);
            border-radius: 3px;
        }
        
        .devices-container::-webkit-scrollbar-thumb {
            background-color: #4CAF50;
            border-radius: 3px;
        }
        
        /* Estilos para dispositivos móviles */
        @media screen and (max-width: 768px) {
            .device-card {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .device-right {
                flex-direction: column;
                align-items: flex-start;
                margin-top: 15px;
                width: 100%;
            }
            
            .device-status, .device-points {
                margin-bottom: 10px;
            }
            
            .action-buttons {
                display: flex;
                flex-wrap: wrap;
                width: 100%;
            }
            
            .btn {
                margin-top: 5px;
                flex-grow: 1;
                text-align: center;
            }
        }
        
        /* Scroll personalizado con JavaScript */
        .custom-scrollbar {
            position: absolute;
            top: 0;
            right: 0;
            width: 6px;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.2);
            border-radius: 3px;
            pointer-events: none;
        }
        
        .custom-scrollbar-thumb {
            position: absolute;
            width: 6px;
            background-color: #4CAF50;
            border-radius: 3px;
            opacity: 0.7;
            cursor: pointer;
            pointer-events: auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="title">DISPOSITIVOS <span>ACTIVOS</span></div>
            <button class="btn btn-add" id="addDeviceBtn">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                </svg>
                <span>Agregar Dispositivo</span>
            </button>
        </div>
        
        <div class="search-box">
            <div class="search-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                </svg>
            </div>
            <input type="text" placeholder="Buscar un dispositivo específico" id="searchInput">
        </div>
        
        <div class="devices-container" id="devicesContainer">
            <!-- Dispositivo 1 -->
            <div class="device-card">
                <div class="device-info">
                    <div class="device-name">PROTOTIPO GASSET_SD</div>
                    <div class="device-location">UBICACIÓN: Av. J O y Gasset 124, Santo Domingo.</div>
                </div>
                <div class="device-right">
                    <div class="device-status">
                        <div class="status-label">ESTADO:</div>
                        <div class="status-indicator status-active"></div>
                    </div>
                    <div class="device-points">PUNTOS CANJEADOS: 2340</div>
                    <div class="action-buttons">
                        <button class="btn btn-action">EDITAR</button>
                        <button class="btn btn-action">DESHABILITAR</button>
                        <button class="btn">VER MÁS</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Elementos DOM
        const devicesContainer = document.getElementById('devicesContainer');
        const customScrollbar = document.getElementById('customScrollbar');
        const scrollbarThumb = document.getElementById('scrollbarThumb');
        const addDeviceBtn = document.getElementById('addDeviceBtn');
        const searchInput = document.getElementById('searchInput');
        
        // Actualizar la barra de desplazamiento personalizada
        function updateCustomScrollbar() {
            const containerHeight = devicesContainer.clientHeight;
            const contentHeight = devicesContainer.scrollHeight;
            
            // Solo mostrar la barra de desplazamiento si el contenido supera el tamaño del contenedor
            if (contentHeight <= containerHeight) {
                customScrollbar.style.display = 'none';
                return;
            } else {
                customScrollbar.style.display = 'block';
            }
            
            // Calcular la altura del "thumb" basado en la proporción del contenido visible
            const thumbHeightRatio = containerHeight / contentHeight;
            const thumbHeight = Math.max(thumbHeightRatio * containerHeight, 30); // Al menos 30px de alto
            
            // Calcular la posición del "thumb" basado en el scroll
            const scrollRatio = devicesContainer.scrollTop / (contentHeight - containerHeight);
            const thumbPosition = scrollRatio * (containerHeight - thumbHeight);
            
            // Aplicar altura y posición
            scrollbarThumb.style.height = thumbHeight + 'px';
            scrollbarThumb.style.top = thumbPosition + 'px';
        }
        
        // Evento de scroll en el contenedor de dispositivos
        devicesContainer.addEventListener('scroll', updateCustomScrollbar);
        
        // Arrastrar la barra de desplazamiento personalizada
        let isDragging = false;
        let dragStartY = 0;
        let startScrollTop = 0;
        
        scrollbarThumb.addEventListener('mousedown', (e) => {
            isDragging = true;
            dragStartY = e.clientY;
            startScrollTop = devicesContainer.scrollTop;
            document.body.style.userSelect = 'none'; // Prevenir selección de texto mientras arrastra
        });
        
        document.addEventListener('mousemove', (e) => {
            if (!isDragging) return;
            
            const deltaY = e.clientY - dragStartY;
            const containerHeight = devicesContainer.clientHeight;
            const contentHeight = devicesContainer.scrollHeight;
            const thumbHeight = parseFloat(scrollbarThumb.style.height) || 30;
            
            // Calcular la proporción de desplazamiento
            const scrollFactor = (contentHeight - containerHeight) / (containerHeight - thumbHeight);
            
            // Actualizar la posición de scroll
            devicesContainer.scrollTop = startScrollTop + (deltaY * scrollFactor);
        });
        
        document.addEventListener('mouseup', () => {
            if (isDragging) {
                isDragging = false;
                document.body.style.userSelect = '';
            }
        });
        
        // Clic en la barra de desplazamiento (fuera del thumb)
        customScrollbar.addEventListener('click', (e) => {
            // Solo procesar si el clic no fue en el thumb
            if (e.target === customScrollbar) {
                const containerHeight = devicesContainer.clientHeight;
                const contentHeight = devicesContainer.scrollHeight;
                const thumbHeight = parseFloat(scrollbarThumb.style.height) || 30;
                
                // Calcular posición de clic relativa al contenedor
                const rect = customScrollbar.getBoundingClientRect();
                const clickPosition = e.clientY - rect.top;
                
                // Calcular posición deseada del centro del thumb
                const targetThumbCenter = clickPosition;
                
                // Calcular posición de scroll correspondiente
                const scrollFactor = (contentHeight - containerHeight) / (containerHeight - thumbHeight);
                const targetScroll = (targetThumbCenter - thumbHeight / 2) * scrollFactor;
                
                // Aplicar scroll suave
                devicesContainer.scrollTo({
                    top: targetScroll,
                    behavior: 'smooth'
                });
            }
        });
        
        // Función para agregar un dispositivo (demo)
        addDeviceBtn.addEventListener('click', () => {
            const locations = [
                "Av. Winston Churchill 88, Santo Domingo",
                "Calle El Conde 24, Santo Domingo",
                "Av. Máximo Gómez 54, Santo Domingo",
                "Av. 27 de Febrero 32, Santo Domingo",
                "Av. Abraham Lincoln 21, Santo Domingo"
            ];
            
            const randomLocation = locations[Math.floor(Math.random() * locations.length)];
            const randomPoints = Math.floor(Math.random() * 10000);
            const statuses = ["active", "inactive", "warning"];
            const randomStatus = statuses[Math.floor(Math.random() * statuses.length)];
            
            const deviceNumber = document.querySelectorAll('.device-card').length + 1;
            
            const newDeviceHtml = `
                <div class="device-card">
                    <div class="device-info">
                        <div class="device-name">PROTOTIPO NUEVO ${deviceNumber}</div>
                        <div class="device-location">UBICACIÓN: ${randomLocation}.</div>
                    </div>
                    <div class="device-right">
                        <div class="device-status">
                            <div class="status-label">ESTADO:</div>
                            <div class="status-indicator status-${randomStatus}"></div>
                        </div>
                        <div class="device-points">PUNTOS CANJEADOS: ${randomPoints}</div>
                        <div class="action-buttons">
                            <button class="btn btn-action">EDITAR</button>
                            <button class="btn btn-action">DESHABILITAR</button>
                            <button class="btn">VER MÁS</button>
                        </div>
                    </div>
                </div>
            `;
            
            // Insertar el nuevo dispositivo
            const scrollContainer = document.getElementById('devicesContainer');
            scrollContainer.insertAdjacentHTML('beforeend', newDeviceHtml);
            
            // Actualizar la barra de desplazamiento
            updateCustomScrollbar();
        });
        
        // Función de búsqueda
        searchInput.addEventListener('input', () => {
            const searchTerm = searchInput.value.toLowerCase();
            const deviceCards = document.querySelectorAll('.device-card');
            
            deviceCards.forEach(card => {
                const deviceName = card.querySelector('.device-name').textContent.toLowerCase();
                const deviceLocation = card.querySelector('.device-location').textContent.toLowerCase();
                
                if (deviceName.includes(searchTerm) || deviceLocation.includes(searchTerm)) {
                    card.style.display = 'flex';
                } else {
                    card.style.display = 'none';
                }
            });
            
            // Actualizar la barra de desplazamiento después de filtrar
            updateCustomScrollbar();
        });
        
        // Inicializar la barra de desplazamiento al cargar
        window.addEventListener('load', updateCustomScrollbar);
        
        // Actualizar la barra de desplazamiento cuando cambia el tamaño de la ventana
        window.addEventListener('resize', updateCustomScrollbar);
        
        // Inicializar la barra de desplazamiento inmediatamente
        updateCustomScrollbar();
    </script>
</body>
</html>