// Inicializar Feather Icons
feather.replace();

// Datos de los dispositivos
const dispositivos = [
    {
        nombre: "PROTOTIPO GASSET_SD",
        ubicacion: "Av. J O y Gasset 124, Santo Domingo.",
        estado: "activo",
        puntos: 2340,
    },
    {
        nombre: "PROTOTIPO ALTAGRACIA",
        ubicacion: "Altagracia 24, Santo Domingo.",
        estado: "inactivo",
        puntos: 6110,
    },
    {
        nombre: "PROTOTIPO OVANDO",
        ubicacion: "N De Ovando 1, Santo Domingo.",
        estado: "activo",
        puntos: 4110,
    },
    {
        nombre: "PROTOTIPO LA ISABELA",
        ubicacion: "Carr. La Isabela No. 33 Nave, Santo Domingo.",
        estado: "inactivo",
        puntos: 7280,
    },
];


function asignarEstadoPorPuntos(puntos) {
    if (puntos >= 6000) {
        return 'activo'; 
    } else if (puntos >= 3000 && puntos < 6000) {
        return 'amarillo'; 
    } else {
        return 'inactivo';
    }
}


function crearTarjetasDispositivos() {
    const contenedor = document.getElementById("contenedor-dispositivos");

    dispositivos.forEach((dispositivo) => {
        const tarjeta = document.createElement("div");
        tarjeta.className = "tarjeta-dispositivo";


        const estadoColor = asignarEstadoPorPuntos(dispositivo.puntos);

        tarjeta.innerHTML = `
            <div class="info-dispositivo">
                <div class="nombre-dispositivo">${dispositivo.nombre}</div>
                <div class="ubicacion-dispositivo">UBICACIÓN: ${dispositivo.ubicacion}</div>
            </div>
            <div class="estado-dispositivo">
                <div class="indicador-estado">
                    <span>ESTADO:</span><br/><br/>
                    <div class="punto-estado ${estadoColor}"></div>
                </div>
                <div class="puntos">
                    PUNTOS CANJEADOS: ${dispositivo.puntos}
                </div>
                <button class="boton-ver-mas">VER MÁS</button>
            </div>
        `;

        contenedor.appendChild(tarjeta);
    });
}

// Inicializar la aplicación
crearTarjetasDispositivos();


// Implementar la funcionalidad de búsqueda
const barraBusqueda = document.querySelector(".barra-busqueda");
barraBusqueda.addEventListener("input", (e) => {
    const terminoBusqueda = e.target.value.toLowerCase();
    const tarjetasDispositivos = document.querySelectorAll(".tarjeta-dispositivo");

    tarjetasDispositivos.forEach((tarjeta) => {
        const nombreDispositivo = tarjeta
            .querySelector(".nombre-dispositivo")
            .textContent.toLowerCase();
        const ubicacionDispositivo = tarjeta
            .querySelector(".ubicacion-dispositivo")
            .textContent.toLowerCase();

        if (
            nombreDispositivo.includes(terminoBusqueda) ||
            ubicacionDispositivo.includes(terminoBusqueda)
        ) {
            tarjeta.style.display = "flex";
        } else {
            tarjeta.style.display = "none";
        }
    });
});

// Funcionalidad del modal
function inicializarModal() {
    const modal = document.getElementById("modal");
    const botones = document.querySelectorAll(".boton-ver-mas");
    const cerrarModal = document.querySelector(".cerrar-modal");

    botones.forEach(boton => {
        boton.addEventListener("click", () => {
            modal.style.display = "block";
        });
    });

    cerrarModal.addEventListener("click", () => {
        modal.style.display = "none";
    });

    window.addEventListener("click", (e) => {
        if (e.target === modal) {
            modal.style.display = "none";
        }
    });
}

// Añade esta línea al final de tu archivo js.js
document.addEventListener("DOMContentLoaded", () => {
    inicializarModal();
});


let map;

async function initMap() {
  const { Map } = await google.maps.importLibrary("maps");

  map = new Map(document.getElementById("map"), {
    center: { lat: -34.397, lng: 150.644 },
    zoom: 8,
  });
}

initMap();