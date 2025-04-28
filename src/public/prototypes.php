<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dispositivos Activos con Modal</title>
  <link rel="stylesheet" href="styles\manage-prototypes.css">
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

  <div class="search-container">
    <div class="search-icon">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" width="20" height="20" stroke-width="1.25">
        <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path>
        <path d="M21 21l-6 -6"></path>
      </svg>
    </div>
    <input type="text" class="search-input" placeholder="Buscar un dispositivo específico">
  </div>

  <div class="device-card">
    <div class="device-info">
      <div class="device-name">PROTOTIPO GASSET_SD</div>
      <div class="device-location">UBICACIÓN: Av. J O y Gasset 124, Santo Domingo.</div>
    </div>

    <div class="device-status">
      <span>ESTADO:</span>
      <div class="status-indicator"></div>
    </div>

    <div class="device-points">
      PUNTOS CANJEADOS: 2340
    </div>

    <div class="action-buttons">
      <button class="btn-edit" id="open-modal-edit">EDITAR</button>
      <button class="btn-disable">DESHABILITAR</button>
      <button class="btn-view-more">VER MÁS</button>
    </div>
  </div>

  <!-- Modal -->
  <!-- Modal Agregar Dispositivo -->
  <div class="modal-overlay" id="device-modal">
    <div class="modal">
      <h2 class="modal-title"><span>Agregar</span> un dispositivo</h2>
      <form id="add-device-form">
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
          <input type="text" class="form-control" id="device-name" placeholder="Nombre del dispositivo">
        </div>

        <div class="form-group">
          <label for="device-location">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
              <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"></path>
              <circle cx="12" cy="9" r="2.5"></circle>
            </svg> Ubicación
          </label>
          <input type="text" class="form-control" id="device-location" placeholder="Ubicación del dispositivo">
        </div>

        <div class="form-group">
          <label for="device-capacity">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
              <rect x="3" y="3" width="18" height="18" rx="2"></rect>
              <path d="M3 9h18"></path>
              <path d="M9 21V9"></path>
            </svg> Capacidad
          </label>
          <select class="form-control" id="device-capacity">
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
      <form id="edit-device-form">
        <div class="form-group">
          <label for="edit-device-name">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
              <path d="M3 7h18"></path>
              <path d="M6 7v13"></path>
              <path d="M18 7v13"></path>
              <path d="M6 20h12"></path>
              <path d="M9 3v4"></path>
              <path d="M15 3v4"></path>
            </svg> Nombre
          </label>
          <input type="text" class="form-control" id="edit-device-name" placeholder="Nombre del dispositivo">
        </div>

        <div class="form-group">
          <label for="edit-device-location">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
              <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"></path>
              <circle cx="12" cy="9" r="2.5"></circle>
            </svg> Ubicación
          </label>
          <input type="text" class="form-control" id="edit-device-location" placeholder="Ubicación del dispositivo">
        </div>

        <div class="form-group">
          <label for="edit-device-status">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
              <circle cx="12" cy="12" r="10"></circle>
              <path d="M12 6v6l4 2"></path>
            </svg> Estado
          </label>
          <select class="form-control" id="edit-device-status">
            <option value="Vacio" style="color: green;">Vacío</option>
            <option value="Medio" style="color: orange;">Medio</option>
            <option value="Lleno" style="color: red;">Lleno</option>
          </select>
        </div>

        <div class="form-group">
          <label for="edit-device-points">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
              <path d="M12 1v22"></path>
              <path d="M17 5H9.5a2.5 2.5 0 0 0 0 5H14a2.5 2.5 0 0 1 0 5H6"></path>
            </svg> Puntos Canjeados
          </label>
          <input type="number" class="form-control" id="edit-device-points" placeholder="Puntos canjeados">
        </div>

        <div class="form-group">
          <label for="edit-device-capacity">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
              <rect x="3" y="3" width="18" height="18" rx="2"></rect>
              <path d="M3 9h18"></path>
              <path d="M9 21V9"></path>
            </svg> Capacidad
          </label>
          <select class="form-control" id="edit-device-capacity">
            <option value="Pequeño">Pequeño</option>
            <option value="Mediano">Mediano</option>
            <option value="Grande">Grande</option>
          </select>
        </div>

        <button type="submit" class="btn-submit">GUARDAR CAMBIOS</button>
      </form>
    </div>
  </div>


  <script>
    // JavaScript para manejar el modal de agregar
    const openModalAddBtn = document.getElementById('open-modal');
    const addModal = document.getElementById('device-modal');

    openModalAddBtn.addEventListener('click', () => {
      addModal.classList.add('show');
    });

    addModal.addEventListener('click', (e) => {
      if (e.target === addModal) {
        addModal.classList.remove('show');
      }
    });

    const deviceFormAdd = document.getElementById('add-device-form');
    deviceFormAdd.addEventListener('submit', (e) => {
      e.preventDefault();

      const name = document.getElementById('device-name').value;
      const location = document.getElementById('device-location').value;
      const capacity = document.getElementById('device-capacity').value;

      console.log('Dispositivo a agregar:', {
        name,
        location,
        capacity
      });

      addModal.classList.remove('show');
      deviceFormAdd.reset();
    });

    // JavaScript para manejar el modal de editar
    const openModalEditBtn = document.getElementById('open-modal-edit');
    const editModal = document.getElementById('edit-device-modal');

    openModalEditBtn.addEventListener('click', () => {
      editModal.classList.add('show');
    });

    editModal.addEventListener('click', (e) => {
      if (e.target === editModal) {
        editModal.classList.remove('show');
      }
    });

    // Manejar el formulario de edición
    const deviceFormEdit = document.getElementById('edit-device-form');
    deviceFormEdit.addEventListener('submit', (e) => {
      e.preventDefault();

      const name = document.getElementById('edit-device-name').value;
      const location = document.getElementById('edit-device-location').value;
      const status = document.getElementById('edit-device-status').value;
      const points = document.getElementById('edit-device-points').value;
      const capacity = document.getElementById('edit-device-capacity').value;

      console.log('Dispositivo editado:', {
        name,
        location,
        status,
        points,
        capacity
      });

      editModal.classList.remove('show');
      deviceFormEdit.reset();
    });
  </script>
</body>

</html>