const imagenes = [
    'IMG/hola.webp',
    'IMG/imagen2.jpg',
    'IMG/imagen3.webp',
];

let indiceActual = 0;
const imagenElement = document.getElementById('imagen');

function mostrarImagenActual() {
    imagenElement.src = imagenes[indiceActual];
    imagenElement.style.transition = 'all 1s ease-in-out'; // Restablece la transición
    imagenElement.style.opacity = 1; // Restablece la opacidad
}

function siguienteImagen() {
    if (indiceActual < imagenes.length - 1) {
        indiceActual++;
    } else {
        indiceActual = 0;
    }

    imagenElement.style.transition = 'all 1s ease-in-out'; // Agrega transición de 1 segundo
    imagenElement.style.opacity = 0.5;

    setTimeout(() => {
        mostrarImagenActual();
    }, 2000); // Espera 2 segundos antes de mostrar la próxima imagen
}

function iniciarCambioAutomatico() {
    setInterval(siguienteImagen, 4000);
}

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