<?php
session_start();
include '../connection/conn.php';
checkUserPermissions('admin');
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="styles/manage-prototypes.css">
  <title>Panel de Dispositivos</title>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.29.0/feather.min.js"></script>
</head>

<body>
  <nav class="barra-navegacion">

  </nav>

  <div class="contenedor">
    <div class="encabezado">
      <h1>DISPOSITIVOS <span>ACTIVOS</span></h1>
    </div>

    <div class="contenedor-busqueda">
      <svg class="icono-busqueda" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
        stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" width="24" height="24" stroke-width="2">
        <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path>
        <path d="M21 21l-6 -6"></path>
      </svg>
      <input type="text" class="barra-busqueda" placeholder="Buscar un dispositivo específico" />
    </div>
    <div class="contenedor-principal">
      <div class="grid-dispositivos" id="contenedor-dispositivos">
      </div>
    </div>

    <div id="modal" class="modal">
      <div class="modal-contenido">
        <div class="modal-header">
          <h2>MAPA:</h2>
          <span class="cerrar-modal">&times;</span>
        </div>
        <div class="modal-body">
          <iframe
            src="https://www.google.com/maps/embed?pb=!1m23!1m12!1m3!1d2625.166232453071!2d-69.97401263934869!3d18.451003708294216!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m8!3e6!4m0!4m5!1s0x8ea561e95054d1e9%3A0x7ff1b4488d5e96de!2sAv.%20Luperon%20Con%20Calle%207%2C%20Santo%20Domingo!3m2!1d18.45158!2d-69.97346!5e0!3m2!1ses-419!2sdo!4v1736425003052!5m2!1ses-419!2sdo"
            width="720" height="450" style="border:0;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
      </div>
    </div>

  </div>

  <script src="scripts/manage-prototypes.js"></script>
</body>

</html>