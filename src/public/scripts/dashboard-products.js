
//Funcion para la navegacion en entra la tabla productos y canjeo
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

//Funcion para fitrar productos por categoria
// // Esta función se ejecuta cuando el DOM está completamente cargado
document.addEventListener('DOMContentLoaded', function () {
    const botones = document.querySelectorAll('.filter-btn');
    const filas = document.querySelectorAll('#lista-productos tr');
    const mensajeSinResultados = document.getElementById('no-resultados');

    botones.forEach(boton => {
        boton.addEventListener('click', function () {
            botones.forEach(b => b.classList.remove('active'));
            this.classList.add('active');

            const filtro = this.getAttribute('data-filtro');
            let hayCoincidencia = false;

            filas.forEach(fila => {
                if (filtro === 'todos') {
                    fila.style.display = '';
                    hayCoincidencia = true;
                } else if (fila.classList.contains(filtro)) {
                    fila.style.display = '';
                    hayCoincidencia = true;
                } else {
                    fila.style.display = 'none';
                }
            });

            // Mostrar u ocultar el mensaje de "No hay resultados"
            mensajeSinResultados.style.display = hayCoincidencia ? 'none' : 'block';
        });
    });
});


//Funcion para filtrar productos por busqueda
document.addEventListener('DOMContentLoaded', function () {
    const inputBusqueda = document.getElementById('buscarProducto');
    const filasProductos = document.querySelectorAll('#lista-productos tr');
    const mensajeSinResultados = document.getElementById('sin-resultados-productos');

    inputBusqueda.addEventListener('input', function () {
        const valor = this.value.toLowerCase().trim(); // Lo que escribe el usuario
        let hayCoincidencias = false;

        filasProductos.forEach(fila => {
            const textoFila = fila.textContent.toLowerCase(); // Texto completo de la fila
            const coincide = textoFila.includes(valor); // Coincide con lo que se escribe

            fila.style.display = coincide ? '' : 'none';
            if (coincide) hayCoincidencias = true;
        });

        // Mostrar o ocultar el mensaje si no hay coincidencias
        mensajeSinResultados.style.display = hayCoincidencias ? 'none' : 'block';
    });
});

// ----------------------------------------------------------------------------

//✅ JavaScript para búsqueda y botones de filtro en la tabla de canjes
document.addEventListener('DOMContentLoaded', function () {
    const inputBusqueda = document.getElementById('buscarCanje');
    const botonesFiltro = document.querySelectorAll('.filter-btn');
    const filasCanjes = document.querySelectorAll('#lista-canjes tr');

    const mensajeBusqueda = document.getElementById('sin-resultados-canjes');
    const mensajeFiltro = document.getElementById('no-resultados-canjes');

    let filtroActivo = 'todos';

    function aplicarFiltros() {
        const valorBusqueda = inputBusqueda.value.toLowerCase().trim();
        let hayCoincidencias = false;

        filasCanjes.forEach(fila => {
            const textoFila = fila.textContent.toLowerCase();
            const coincideBusqueda = textoFila.includes(valorBusqueda);
            const coincideFiltro = filtroActivo === 'todos' || fila.classList.contains(filtroActivo);

            if (coincideBusqueda && coincideFiltro) {
                fila.style.display = '';
                hayCoincidencias = true;
            } else {
                fila.style.display = 'none';
            }
        });

        // Mostrar mensajes según el caso
        if (valorBusqueda) {
            mensajeBusqueda.style.display = hayCoincidencias ? 'none' : 'block';
            mensajeFiltro.style.display = 'none';
        } else {
            mensajeBusqueda.style.display = 'none';
            mensajeFiltro.style.display = hayCoincidencias ? 'none' : 'block';
        }
    }

    inputBusqueda.addEventListener('input', aplicarFiltros);

    botonesFiltro.forEach(boton => {
        boton.addEventListener('click', function () {
            botonesFiltro.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
            filtroActivo = this.dataset.filtro;
            aplicarFiltros();
        });
    });

    aplicarFiltros(); // Inicializar con estado actual
});

