// Eliminar la declaración redundante de `const users`
// const users = JSON.parse(localStorage.getItem('users')) || [];

function saveUsers() {
    localStorage.setItem('users', JSON.stringify(users));
}

const usersList = document.getElementById('usersList');
const searchInput = document.getElementById('searchInput');
const navItems = document.querySelectorAll('.nav-item');
const infoModal = document.getElementById('infoModal');
const restrictModal = document.getElementById('restrictModal');
const closeButtons = document.querySelectorAll('.close-button');

// Crear el modal de historial
const historyModal = document.createElement('div');
historyModal.className = 'modal';
historyModal.id = 'historyModal';
historyModal.innerHTML = `
    <div class="modal-content">
        <div class="modal-header">
            <h2>Historial de Puntos y Canjes</h2>
            <button class="close-button" id="historyModal" onclick="closeModal(historyModal)">&times;</button>
        </div>
        <div class="modal-body" id="historyModalContent">
        </div>
    </div>
`;
document.body.appendChild(historyModal);

let currentFilter = 'todos';

function getInitials(name) {
    const names = name.split(' ');
    const initials = names.slice(0, 2).map(n => n[0].toUpperCase()).join('');
    return initials;
}
function formatDate(dateString) {
    const options = { year: 'numeric', month: 'long', day: 'numeric' };
    return new Date(dateString).toLocaleDateString('es-ES', options);
}

function createUserCard(user) {
    const card = document.createElement('div');
    card.className = 'user-card';

    // Determina la clase del indicador de estado basado en la columna is_online
    const statusClass = user.is_online ? 'status-connected' : 'status-disconnected';

    card.innerHTML = `
        <div class="user-info">
            <div class="avatar">${getInitials(user.name)}</div>
            <div>
                <div>${user.email}</div>
                <div>${user.name}</div>
                <div class="points-display">Puntos actuales: ${user.points || 0}</div>
            </div>
            <div class="status-indicator ${statusClass}"></div>
        </div>
        <div class="user-actions">
            <button class="button button-history" onclick="showHistory(${user.user_id})">Historial</button>
            <button class="button button-info" onclick="showInfo(${user.user_id})">Información</button>
            ${user.is_restricted ?
            `<button class="button button-enable" onclick="removeRestriction(${user.user_id})">Habilitar</button>` :
            `<button class="button button-restrict" onclick="restrictUser(${user.user_id})">Restringir usuario</button>`
        }
        </div>
    `;
    return card;
}


function filterUsers() {
    const searchTerm = searchInput.value.toLowerCase();
    const filteredUsers = users.filter(user => {
        const hasName = user.name && typeof user.name === 'string';
        const matchesSearch = hasName && user.name.toLowerCase().includes(searchTerm);
        const matchesFilter = currentFilter === 'todos' ||
            (currentFilter === 'restringidos' && user.is_restricted === 1) ||
            (currentFilter === 'conectado' && user.is_online === 1) ||
            (currentFilter === 'desconectado' && user.is_online === 0);
        return matchesSearch && matchesFilter;
    });

    usersList.innerHTML = '';
    
    if (filteredUsers.length === 0 && searchTerm) {
        usersList.innerHTML = `
            <div class="no-results">
                <p>No se encontraron usuarios con el nombre "${searchTerm}"</p>
            </div>
        `;
    } else {
        filteredUsers.forEach(user => {
            usersList.appendChild(createUserCard(user));
        });
    }
}


function showHistory(userId) {
    const user = users.find(u => u.user_id === userId);
    if (!user) return;

    const content = document.getElementById('historyModalContent');
    let historyHTML = `
        <div class="user-details">
            <h3>${user.name}</h3>
            <p><strong>Puntos actuales:</strong> ${user.points || 0}</p>
            <h4>Historial de transacciones</h4>
            ${user.history && user.history.length > 0 ?
            `<div class="history-list">
                    ${user.history.map(item => `
                        <div class="history-item ${item.type}">
                            <div class="history-date">${formatDate(item.date)}</div>
                            ${item.type === 'canje' ?
                    `<div class="history-details">
                                    <div>Producto canjeado: ${item.description}</div>
                                    <div class="points-cost">${item.points} puntos</div>
                                </div>` :
                    `<div class="history-details">
                                    <div>${item.description}</div>
                                    <div class="points-earned">${item.points} puntos</div>
                                </div>`
                }
                        </div>
                    `).join('')}
                </div>` :
            '<p>No hay transacciones registradas</p>'
        }
        </div>
    `;

    content.innerHTML = historyHTML;
    historyModal.style.display = 'flex';
}

function showInfo(userId) {
    const user = users.find(u => u.user_id === userId);
    if (!user) return;

    const content = document.getElementById('infoModalContent');
    content.innerHTML = `
        <div class="user-details">
            <p><strong>Nombre:</strong> ${user.name}</p>
            <p><strong>Email:</strong> ${user.email}</p>
            <p><strong>Estado:</strong> ${user.is_restricted === 1 ? 'Restringido' : 'Habilitado'}</p>
            <p><strong>Fecha de registro:</strong> ${user.joinDate}</p>
            <p><strong>País:</strong> ${user.country}</p>
            <p><strong>Teléfono:</strong> ${user.phone}</p>
            <p><strong>Puntos totales:</strong> ${user.points}</p>
            ${user.is_restricted === 1 ?
            `<p><strong>Razón de restricción:</strong> ${user.restrictionReason || 'No especificada'}</p>` : ''}
        </div>
    `;
    infoModal.style.display = 'flex';
}

function restrictUser(userId) {
    const user = users.find(u => u.user_id === userId);
    if (!user) return;

    const reason = prompt('Por favor, ingrese el motivo de la restricción:');
    if (reason) {
        // Actualizar en la base de datos
        fetch('restrict-user.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                userId: userId,
                is_restricted: true,
                restrictionReason: reason
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Actualizar el usuario en el array local
                user.is_restricted = true;
                user.restrictionReason = reason;
                // Recargar la lista de usuarios
                location.reload();
            } else {
                alert('Error al restringir el usuario: ' + (data.message || 'Error desconocido'));
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error al conectar con el servidor');
        });
    }
}

function removeRestriction(userId) {
    const user = users.find(u => u.user_id === userId);
    if (!user) return;

    if (confirm('¿Está seguro de que desea habilitar a este usuario?')) {
        fetch('restrict-user.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                userId: userId,
                is_restricted: false,
                restrictionReason: ''
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Actualizar el usuario en el array local
                user.is_restricted = false;
                user.restrictionReason = '';
                // Recargar la lista de usuarios
                location.reload();
            } else {
                alert('Error al habilitar el usuario: ' + (data.message || 'Error desconocido'));
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error al conectar con el servidor');
        });
    }
}

function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.style.display = 'none';
    }
}

searchInput.addEventListener('input', filterUsers);

navItems.forEach(item => {
    item.addEventListener('click', () => {
        navItems.forEach(i => i.classList.remove('active'));
        item.classList.add('active');
        currentFilter = item.dataset.filter;
        filterUsers();
    });
});

closeButtons.forEach(button => {
    button.addEventListener('click', () => {
        const modal = button.closest('.modal');
        if (modal) {
            modal.style.display = 'none';
        }
    });
});

window.addEventListener('click', (e) => {
    if (e.target === infoModal) infoModal.style.display = 'none';
    if (e.target === restrictModal) restrictModal.style.display = 'none';
    if (e.target === historyModal) historyModal.style.display = 'none';
});

filterUsers();