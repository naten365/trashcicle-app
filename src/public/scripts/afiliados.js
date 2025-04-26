const imagenes = [
    'assets/images/hola.webp',
    'assets/images/imagen2.jpg',
    'assets/images/imagen3.webp'
];

let indiceActual = 0;
const imagenElement = document.getElementById('imagen');

function mostrarImagenActual() {
    imagenElement.style.opacity = 0;

    setTimeout(() => {
        imagenElement.src = imagenes[indiceActual];
        imagenElement.style.opacity = 1;
    }, 500); // espera que se desvanezca antes de cambiar la imagen
}

function siguienteImagen() {
    indiceActual = (indiceActual + 1) % imagenes.length;
    mostrarImagenActual();
}

function iniciarCambioAutomatico() {
    setInterval(siguienteImagen, 4000); // cada 4 segundos
}

// Iniciar el carrusel
mostrarImagenActual();
iniciarCambioAutomatico();

// Resto del código...

// Funcion de las imagenes //

const enlaceInformacion = document.getElementById('cerrarVentana');
const MOPC_LINK = 'https://www.mopc.gob.do/';
const MINISTERIO_SALUD_LINK = 'https://www.msp.gob.do/web/';
const MINISTERIO_AMBIENTE_LINK = 'https://ambiente.gob.do';

// Función para abrir la ventana emergente
function abrirVentana(link) {
    document.getElementById('fondoOscuro').style.display = 'block';
    document.getElementById('ventanaEmergente').style.display = 'block';

    // Configura el enlace de aceptar con el valor proporcionado
    document.getElementById('cerrarVentana').setAttribute('href', link);
}

// Función para cerrar la ventana emergente
function cerrarVentana() {
    document.getElementById('fondoOscuro').style.display = 'none';
    document.getElementById('ventanaEmergente').style.display = 'none';
}

// Asigna las funciones a los botones
document.getElementById('mostrarVentana').addEventListener('click', function () {
    abrirVentana(MINISTERIO_AMBIENTE_LINK);
});

document.getElementById('mostrarVentana2').addEventListener('click', function () {
    abrirVentana(MINISTERIO_SALUD_LINK);
});

document.getElementById('mostrarVentana3').addEventListener('click', function () {
    abrirVentana(MOPC_LINK);
});

document.getElementById('cerrarVentana').addEventListener('click', cerrarVentana);

// Evento para cerrar la ventana si se hace clic fuera del modal
document.getElementById('fondoOscuro').addEventListener('click', function (event) {
    if (event.target === this) {
        cerrarVentana();
    }
});