<?php
require_once '../connection/conn.php'; // Conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = $_POST['device-id'] ?? '';
  $name = $_POST['device-name'] ?? '';
  $location = $_POST['device-location'] ?? '';
  $status = $_POST['device-status'] ?? '';
  $points = $_POST['device-points'] ?? 0;
  $capacity = $_POST['device-capacity'] ?? '';

  // Validar que todos los campos requeridos estén presentes
  if (!empty($id) && !empty($name) && !empty($location) && !empty($status) && !empty($capacity)) {
    try {
      // Consulta SQL para actualizar el dispositivo
      $sql = "UPDATE zafacones_inteligentes 
                    SET nombre_zafacon = :name, 
                        ubicacion = :location, 
                        estado = :status, 
                        residuos_actuales = :points, 
                        capacidad = :capacity, 
                        fecha_ultima_actualizacion = NOW() 
                    WHERE id_zafacon = :id";
      $stmt = $pdo->prepare($sql);
      $stmt->execute([
        ':id' => $id,
        ':name' => $name,
        ':location' => $location,
        ':status' => $status,
        ':points' => $points,
        ':capacity' => $capacity
      ]);

      // Respuesta en formato JSON
      echo json_encode(['success' => true, 'message' => 'Dispositivo actualizado correctamente.']);
    } catch (PDOException $e) {
      echo json_encode(['success' => false, 'message' => 'Error al actualizar el dispositivo: ' . $e->getMessage()]);
    }
  } else {
    echo json_encode(['success' => false, 'message' => 'Todos los campos son obligatorios.']);
  }
}
// Consulta para obtener los dispositivos
$sql = "SELECT id_zafacon, nombre_zafacon, ubicacion, capacidad, residuos_actuales, estado, fecha_instalacion, latitud, longitud FROM zafacones_inteligentes";

$stmt = $pdo->query($sql);
$devices = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dispositivos Activos con Modal</title>
  <link rel="stylesheet" href="styles/manage-prototypes.css">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
  <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
</head>

<body>
  <div class="header">
    <div class="title">DISPOSITIVOS <span>ACTIVOS</span></div>
    <a href="index-admin.php"><button class="btn btn-volver">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" width="20" height="20" stroke-width="1.25">
          <path d="M4 12l10 0"></path>
          <path d="M4 12l4 4"></path>
          <path d="M4 12l4 -4"></path>
          <path d="M20 4l0 16"></path>
        </svg>
        VOLVER
      </button></a>
    <button class="btn btn-agregar" id="open-modal">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" width="20" height="20" stroke-width="1.25">
        <path d="M12 5l0 14"></path>
        <path d="M5 12l14 0"></path>
      </svg>
      AGREGAR DISPOSITIVO
    </button>
  </div>

  <div class="filter-container">
    <label for="filter-status">Filtrar por estado:</label>
    <select id="filter-status" class="filter-select" style="outline: none;">
      <option value="all" style="outline: none;">Todos</option>
      <option value="enabled" style="outline: none;">Habilitado</option>
      <option value="disabled">Deshabilitado</option>
    </select>
  </div>

  <div class="search-container">
    <div class="search-icon">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" width="20" height="20" stroke-width="1.25">
        <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path>
        <path d="M21 21l-6 -6"></path>
      </svg>
    </div>
    <input type="text" class="search-input" placeholder="Buscar un dispositivo específico">
  </div>

  <!-- Lista de dispositivos -->
  <div id="device-list">
    <?php foreach ($devices as $device): ?>
      <div class="device-card">
        <div class="device-info">
          <div class="device-name"><?= htmlspecialchars($device['nombre_zafacon']) ?></div>
          <div class="device-location">UBICACIÓN: <?= htmlspecialchars($device['ubicacion']) ?></div>
        </div>

        <div class="device-status">
          <span>ESTADO:</span>
          <div class="status-indicator" style="background-color: <?= $device['estado'] === 'Vacío' ? 'green' : ($device['estado'] === 'Medio' ? 'orange' : 'red') ?>;"></div>
        </div>

        <div class="device-points">
          CAPACIDAD: <?= htmlspecialchars($device['capacidad']) ?>
        </div>

        <div class="action-buttons">
          <button class="btn-edit" data-id="<?= $device['id_zafacon'] ?>">EDITAR</button>
          <button class="btn-toggle-status" data-id="<?= $device['id_zafacon'] ?>">
            <?= isset($device['uso']) && $device['uso'] === '1' ? 'DESHABILITAR' : 'HABILITAR' ?>
          </button>
          <button class="btn-view-more"
            data-lat="<?= htmlspecialchars($device['latitud']) ?>"
            data-lng="<?= htmlspecialchars($device['longitud']) ?>"
            data-name="<?= htmlspecialchars($device['nombre_zafacon']) ?>">
            VER UBICACIÓN
          </button>
        </div>
      </div>
    <?php endforeach; ?>
  </div>

  <!-- Modal Agregar Dispositivo -->
  <div class="modal-overlay" id="device-modal">
    <div class="modal">
      <h2 class="modal-title"><span>Agregar</span> un dispositivo</h2>
      <form id="add-device-form" action="add-device.php" method="POST">
        <div class="form-group">
          <label for="device-name">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
              <path d="M3 7h18"></path>
              <path d="M6 7v13"></path>
              <path d="M18 7v13"></path>
              <path d="M6 20h12"></path>
              <path d="M9 3v4"></path>
              <path d="M15 3v4"></path>
            </svg> Nombre
          </label>
          <input type="text" class="form-control" id="device-name" name="device-name" placeholder="Nombre del dispositivo" required>
        </div>

        <div class="form-group">
          <label for="device-location">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
              <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"></path>
              <circle cx="12" cy="9" r="2.5"></circle>
            </svg> Ubicación
          </label>
          <input type="text" class="form-control" id="device-location" name="device-location" placeholder="Ubicación del dispositivo" required>
        </div>

        <div class="form-group">
          <label for="device-capacity">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
              <rect x="3" y="3" width="18" height="18" rx="2"></rect>
              <path d="M3 9h18"></path>
              <path d="M9 21V9"></path>
            </svg> Capacidad
          </label>
          <select class="form-control" id="device-capacity" name="device-capacity" required>
            <option value="Pequeño">Pequeño</option>
            <option value="Mediano">Mediano</option>
            <option value="Grande">Grande</option>
          </select>
        </div>

        <button type="submit" class="btn-submit">AGREGAR</button>
      </form>
    </div>
  </div>

  <!-- Modal Editar Dispositivo -->
  <div class="modal-overlay" id="edit-device-modal">
    <div class="modal">
      <h2 class="modal-title"><span>Editar</span> dispositivo</h2>
      <form id="edit-device-form" action="edit-device.php" method="POST">
        <input type="hidden" id="edit-device-id" name="device-id">

        <div class="form-group">
          <label for="edit-device-name">Nombre</label>
          <input type="text" class="form-control" id="edit-device-name" name="device-name" required>
        </div>

        <div class="form-group">
          <label for="edit-device-location">Ubicación</label>
          <input type="text" class="form-control" id="edit-device-location" name="device-location" required>
        </div>

        <div class="form-group">
          <label for="edit-device-status">Estado</label>
          <select class="form-control" id="edit-device-status" name="device-status" required>
            <option value="Vacío">Vacío</option>
            <option value="Medio">Medio</option>
            <option value="Lleno">Lleno</option>
          </select>
        </div>

        <div class="form-group">
          <label for="edit-device-points">Puntos Canjeados</label>
          <input type="number" class="form-control" id="edit-device-points" name="device-points" required>
        </div>

        <div class="form-group">
          <label for="edit-device-capacity">Capacidad</label>
          <select class="form-control" id="edit-device-capacity" name="device-capacity" required>
            <option value="Pequeño">Pequeño</option>
            <option value="Mediano">Mediano</option>
            <option value="Grande">Grande</option>
          </select>
        </div>

        <button type="submit" class="btn-submit">GUARDAR CAMBIOS</button>
      </form>
    </div>
  </div>

  <!-- Agregar antes del cierre del body -->
  <div class="modal-overlay" id="map-modal">
    <div class="modal map-modal">
      <h2 class="modal-title">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
          <circle cx="12" cy="10" r="3"></circle>
        </svg>
        <span>Ubicación</span> del dispositivo
      </h2>
      <div id="map"></div>
      
    </div>
  </div>


  <?php
  require_once '../connection/conn.php';

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['device-id'] ?? '';
    $name = $_POST['device-name'] ?? '';
    $location = $_POST['device-location'] ?? '';
    $status = $_POST['device-status'] ?? '';
    $points = $_POST['device-points'] ?? 0;
    $capacity = $_POST['device-capacity'] ?? '';

    if (!empty($id) && !empty($name) && !empty($location) && !empty($status) && !empty($capacity)) {
      try {
        $sql = "UPDATE zafacones_inteligentes 
                    SET nombre_zafacon = :name, ubicacion = :location, estado = :status, residuos_actuales = :points, capacidad = :capacity, fecha_ultima_actualizacion = NOW() 
                    WHERE id_zafacon = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
          ':id' => $id,
          ':name' => $name,
          ':location' => $location,
          ':status' => $status,
          ':points' => $points,
          ':capacity' => $capacity
        ]);

        echo json_encode(['success' => true, 'message' => 'Dispositivo actualizado correctamente.']);
      } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Error al actualizar el dispositivo: ' . $e->getMessage()]);
      }
    } else {
      echo json_encode(['success' => false, 'message' => 'Todos los campos son obligatorios.']);
    }
  }
  ?>

  <script>
    // Manejo del modal de agregar dispositivo
    // Manejo del modal de agregar dispositivo
    const openModalAddBtn = document.getElementById('open-modal');
    const addModal = document.getElementById('device-modal');
    const deviceFormAdd = document.getElementById('add-device-form');
    let map = null;
    const mapModal = document.getElementById('map-modal');
    const closeMapBtn = document.querySelector('.btn-close-map');

    // Inicializar el mapa cuando se abre el modal
    function initMap(lat, lng, deviceName) {
      if (!map) {
        map = L.map('map').setView([lat, lng], 15);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
          attribution: '© OpenStreetMap contributors'
        }).addTo(map);
      } else {
        map.setView([lat, lng], 15);
      }

      // Limpiar marcadores existentes
      map.eachLayer((layer) => {
        if (layer instanceof L.Marker) {
          map.removeLayer(layer);
        }
      });

      // Agregar nuevo marcador
      L.marker([lat, lng])
        .addTo(map)
        .bindPopup(deviceName)
        .openPopup();

      // Asegurar que el mapa se renderice correctamente
      setTimeout(() => {
        map.invalidateSize();
      }, 100);
    }

    // Evento para mostrar el mapa
    document.querySelectorAll('.btn-view-more').forEach(btn => {
      btn.addEventListener('click', () => {
        const lat = parseFloat(btn.dataset.lat);
        const lng = parseFloat(btn.dataset.lng);
        const name = btn.dataset.name;

        mapModal.classList.add('show');
        setTimeout(() => {
          initMap(lat, lng, name);
          map.invalidateSize();
        }, 100);
      });
    });

    mapModal.addEventListener('click', (e) => {
      // Si el clic fue directamente en el overlay (fuera del contenido del modal)
      if (e.target === mapModal) {
        mapModal.classList.remove('show');
        // Opcional: limpiar el mapa
        if (map) {
          map.remove();
          map = null;
        }
      }
    });

    // Actualiz
    // Cerrar el modal del mapa
    closeMapBtn.addEventListener('click', () => {
      mapModal.classList.remove('show');
    });

    mapModal.addEventListener('click', (e) => {
      if (e.target === mapModal) {
        mapModal.classList.remove('show');
      }
    });

    openModalAddBtn.addEventListener('click', () => {
      addModal.classList.add('show');
    });

    addModal.addEventListener('click', (e) => {
      if (e.target === addModal) {
        addModal.classList.remove('show');
      }
    });

    deviceFormAdd.addEventListener('submit', async (e) => {
      e.preventDefault();

      const formData = new FormData(deviceFormAdd);

      try {
        const response = await fetch(deviceFormAdd.action, {
          method: 'POST',
          body: formData,
        });

        const result = await response.json();

        if (result.success) {
          alert(result.message);
          location.reload();
        } else {
          alert(result.message);
        }
      } catch (error) {
        alert('Error al procesar la solicitud.');
        console.error('Error:', error);
      }

      addModal.classList.remove('show');
      deviceFormAdd.reset();
    });

    // Manejo del modal de editar dispositivo
    const openModalEditBtns = document.querySelectorAll('.btn-edit');
    const editModal = document.getElementById('edit-device-modal');
    const deviceFormEdit = document.getElementById('edit-device-form');

    // Abrir el modal de edición con los datos del dispositivo seleccionado
    openModalEditBtns.forEach((btn) => {
      btn.addEventListener('click', (e) => {
        const deviceId = btn.getAttribute('data-id');
        const deviceCard = btn.closest('.device-card');
        const deviceName = deviceCard.querySelector('.device-name').textContent.trim();
        const deviceLocation = deviceCard.querySelector('.device-location').textContent.replace('UBICACIÓN: ', '').trim();
        const deviceStatus = deviceCard.querySelector('.device-status span').textContent.trim();
        const devicePoints = deviceCard.querySelector('.device-points').textContent.replace('PUNTOS CANJEADOS: ', '').trim();
        const deviceCapacity = deviceCard.querySelector('.device-points').textContent.replace('CAPACIDAD: ', '').trim();

        // Rellenar los campos del formulario de edición
        document.getElementById('edit-device-id').value = deviceId;
        document.getElementById('edit-device-name').value = deviceName;
        document.getElementById('edit-device-location').value = deviceLocation;
        document.getElementById('edit-device-status').value = deviceStatus;
        document.getElementById('edit-device-points').value = devicePoints;
        document.getElementById('edit-device-capacity').value = deviceCapacity;

        // Mostrar el modal de edición
        editModal.classList.add('show');
      });
    });

    // Cerrar el modal de edición al hacer clic fuera del contenido
    editModal.addEventListener('click', (e) => {
      if (e.target === editModal) {
        editModal.classList.remove('show');
      }
    });

    // Manejar el envío del formulario de edición
    deviceFormEdit.addEventListener('submit', async (e) => {
      e.preventDefault();

      const formData = new FormData(deviceFormEdit);

      try {
        const response = await fetch(deviceFormEdit.action, {
          method: 'POST',
          body: formData,
        });

        const result = await response.json();

        if (result.success) {
          alert(result.message);
          location.reload(); // Recargar la página para mostrar los cambios
        } else {
          alert(result.message);
        }
      } catch (error) {
        alert('Error al procesar la solicitud.');
        console.error('Error:', error);
      }

      editModal.classList.remove('show');
      deviceFormEdit.reset();
    });

    const searchInput = document.querySelector('.search-input');
    const deviceCards = document.querySelectorAll('.device-card');

    searchInput.addEventListener('input', () => {
      const searchTerm = searchInput.value.toLowerCase();

      deviceCards.forEach((card) => {
        const deviceName = card.querySelector('.device-name').textContent.toLowerCase();

        if (deviceName.includes(searchTerm)) {
          card.classList.remove('hidden'); // Mostrar tarjeta
        } else {
          card.classList.add('hidden'); // Ocultar tarjeta
        }
      });
    });

    deviceFormEdit.addEventListener('submit', async (e) => {
      e.preventDefault();

      const formData = new FormData(deviceFormEdit);

      try {
        const response = await fetch(deviceFormEdit.action, {
          method: 'POST',
          body: formData,
        });

        const result = await response.json();

        if (result.success) {
          alert(result.message);
          location.reload(); // Recargar la página para mostrar los cambios
        } else {
          alert(result.message);
        }
      } catch (error) {
        alert('Error al procesar la solicitud.');
        console.error('Error:', error);
      }

      editModal.classList.remove('show');
      deviceFormEdit.reset();
    });

    searchInput.addEventListener('input', () => {
      const searchTerm = searchInput.value.toLowerCase();
      const filterValue = filterSelect.value;

      deviceCards.forEach((card) => {
        const deviceName = card.querySelector('.device-name').textContent.toLowerCase();
        const cardStatus = card.getAttribute('data-status');

        const matchesSearch = deviceName.includes(searchTerm);
        const matchesFilter =
          filterValue === 'all' ||
          (filterValue === 'enabled' && cardStatus === 'enabled') ||
          (filterValue === 'disabled' && cardStatus === 'disabled');

        if (matchesSearch && matchesFilter) {
          card.style.display = 'flex'; // Mostrar tarjeta si coincide con la búsqueda y el filtro
        } else {
          card.style.display = 'none'; // Ocultar tarjeta si no coincide
        }
      });
    });

    const filterSelect = document.getElementById('filter-status');


    filterSelect.addEventListener('change', () => {
      const filterValue = filterSelect.value;

      deviceCards.forEach((card) => {
        const cardStatus = card.getAttribute('data-status');

        if (filterValue === 'all') {
          card.style.display = 'flex'; // Mostrar todas las tarjetas
        } else if (filterValue === 'enabled' && cardStatus === 'enabled') {
          card.style.display = 'flex'; // Mostrar solo habilitados
        } else if (filterValue === 'disabled' && cardStatus === 'disabled') {
          card.style.display = 'flex'; // Mostrar solo deshabilitados
        } else {
          card.style.display = 'none'; // Ocultar las tarjetas que no coincidan
        }
      });
    });



    // Lógica para cambiar el estado del dispositivo
    document.querySelectorAll('.btn-toggle-status').forEach((button) => {
      button.addEventListener('click', async (e) => {
        const deviceId = button.getAttribute('data-id');
        const deviceCard = button.closest('.device-card');
        const currentStatus = deviceCard.getAttribute('data-status');
        const newStatus = currentStatus === 'enabled' ? 'disabled' : 'enabled';

        try {
          // Enviar solicitud al servidor para actualizar el estado
          const response = await fetch('toggle-status.php', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json'
            },
            body: JSON.stringify({
              id: deviceId,
              status: newStatus === 'enabled' ? 1 : 0
            }),
          });

          const result = await response.json();

          if (result.success) {
            // Actualizar el estado en la interfaz
            deviceCard.setAttribute('data-status', newStatus);
            deviceCard.querySelector('.status-indicator').style.backgroundColor =
              newStatus === 'enabled' ? 'green' : 'red';
            button.textContent = newStatus === 'enabled' ? 'DESHABILITAR' : 'HABILITAR';

            // Filtrar automáticamente según el estado seleccionado
            filterSelect.dispatchEvent(new Event('change'));
          } else {
            alert('Error al cambiar el estado del dispositivo.');
          }
        } catch (error) {
          console.error('Error:', error);
          alert('Error al procesar la solicitud.');
        }
      });
    });

    // Lógica para filtrar dispositivos
    filterSelect.addEventListener('change', () => {
      const filterValue = filterSelect.value;

      deviceCards.forEach((card) => {
        const cardStatus = card.getAttribute('data-status');

        if (filterValue === 'all') {
          card.style.display = 'flex'; // Mostrar todas las tarjetas
        } else if (filterValue === 'enabled' && cardStatus === 'enabled') {
          card.style.display = 'flex'; // Mostrar solo habilitados
        } else if (filterValue === 'disabled' && cardStatus === 'disabled') {
          card.style.display = 'flex'; // Mostrar solo deshabilitados
        } else {
          card.style.display = 'none'; // Ocultar las tarjetas que no coincidan
        }
      });
    });

    // Recuperar el estado inicial desde localStorage
    const deviceStates = JSON.parse(localStorage.getItem('deviceStates')) || {};

    // Inicializar los estados de las tarjetas desde localStorage
    document.querySelectorAll('.device-card').forEach((card) => {
      const deviceId = card.querySelector('.btn-toggle-status').getAttribute('data-id');
      const savedStatus = deviceStates[deviceId];

      if (savedStatus) {
        card.setAttribute('data-status', savedStatus);
        card.querySelector('.status-indicator').style.backgroundColor =
          savedStatus === 'enabled' ? 'green' : 'red';
        card.querySelector('.btn-toggle-status').textContent =
          savedStatus === 'enabled' ? 'DESHABILITAR' : 'HABILITAR';
      }
    });

    // Lógica para cambiar el estado del dispositivo
    document.querySelectorAll('.btn-toggle-status').forEach((button) => {
      button.addEventListener('click', (e) => {
        const deviceId = button.getAttribute('data-id');
        const deviceCard = button.closest('.device-card');
        const currentStatus = deviceCard.getAttribute('data-status');
        const newStatus = currentStatus === 'enabled' ? 'disabled' : 'enabled';

        // Actualizar el estado en la interfaz
        deviceCard.setAttribute('data-status', newStatus);
        deviceCard.querySelector('.status-indicator').style.backgroundColor =
          newStatus === 'enabled' ? 'green' : 'red';
        button.textContent = newStatus === 'enabled' ? 'DESHABILITAR' : 'HABILITAR';

        // Guardar el nuevo estado en localStorage
        deviceStates[deviceId] = newStatus;
        localStorage.setItem('deviceStates', JSON.stringify(deviceStates));

        // Filtrar automáticamente según el estado seleccionado
        filterSelect.dispatchEvent(new Event('change'));
      });
    });

    // Lógica para filtrar dispositivos
    filterSelect.addEventListener('change', () => {
      const filterValue = filterSelect.value;

      deviceCards.forEach((card) => {
        const cardStatus = card.getAttribute('data-status');

        if (filterValue === 'all') {
          card.style.display = 'flex'; // Mostrar todas las tarjetas
        } else if (filterValue === 'enabled' && cardStatus === 'enabled') {
          card.style.display = 'flex'; // Mostrar solo habilitados
        } else if (filterValue === 'disabled' && cardStatus === 'disabled') {
          card.style.display = 'flex'; // Mostrar solo deshabilitados
        } else {
          card.style.display = 'none'; // Ocultar las tarjetas que no coincidan
        }
      });
    });
  </script>
</body>

</html>