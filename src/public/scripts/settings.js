const body = document.getElementById('main-body');
const lightModeToggle = document.getElementById('light-mode');
const fileInput = document.getElementById('fileInput');
const profileImage = document.getElementById('profileImage');
const editButton = document.getElementById('editButton');
const resetConfigButton = document.getElementById('reset-config');
const saveConfigButton = document.getElementById('safe-config');
const newPassword = document.getElementById('new-password');
const confirmPassword = document.getElementById('confirm-password');
const languageSelect = document.getElementById('language');
const notificationToggle = document.getElementById('notif-toggle');
const notification = document.getElementById('notification');
const Nombre = document.getElementById('new-username');

// Función para notis
function showNotification(message) {
    notification.textContent = message;
    notification.classList.add('show');
    setTimeout(() => {
        notification.classList.remove('show');
    }, 3000);
}

// Idioma
function saveLanguagePreference() {
    const selectedLanguage = languageSelect.value;
    localStorage.setItem('language', selectedLanguage);
}

function loadLanguagePreference() {
    const storedLanguage = localStorage.getItem('language');
    if (storedLanguage) {
        languageSelect.value = storedLanguage;
    }
}

// Modo claro
function enableLightMode() {
    body.classList.add('light-mode');
    localStorage.setItem('lightMode', 'enabled');
}

function disableLightMode() {
    body.classList.remove('light-mode');
    localStorage.setItem('lightMode', 'disabled');
}

// Gestión del toggle de notificaciones
function saveNotificationPreference() {
    const isNotifEnabled = notificationToggle.checked;
    localStorage.setItem('notifEnabled', isNotifEnabled);
}

function loadNotificationPreference() {
    const notifEnabled = localStorage.getItem('notifEnabled') === 'true';
    notificationToggle.checked = notifEnabled;
}

// Carga inicial
if (localStorage.getItem('lightMode') === 'enabled') {
    enableLightMode();
    lightModeToggle.checked = true;
} else {
    disableLightMode();
    lightModeToggle.checked = false;
}

loadLanguagePreference();
loadNotificationPreference();

lightModeToggle.addEventListener('change', () => {
    if (lightModeToggle.checked) {
        enableLightMode();
        showNotification("Modo claro activado");
    } else {
        disableLightMode();
        showNotification("Modo oscuro activado");
    }
});

languageSelect.addEventListener('change', saveLanguagePreference);

notificationToggle.addEventListener('change', saveNotificationPreference);

// foto de perfil
editButton.addEventListener('click', () => {
    fileInput.click();
});

fileInput.addEventListener('change', (event) => {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = (e) => {
            profileImage.src = e.target.result;
            localStorage.setItem('profileImage', e.target.result);
            showNotification("¡Foto de perfil actualizada!");
        };
        reader.readAsDataURL(file);
    }
});

// Carga la foto de perfil desde localStorage
const storedImage = localStorage.getItem('profileImage');
if (storedImage) {
    profileImage.src = storedImage;
}

// Guardar configuración
saveConfigButton.addEventListener('click', () => {
    if (newPassword.value || confirmPassword.value) {
        if (newPassword.value !== confirmPassword.value) {
            showNotification("Las contraseñas no coinciden. Inténtalo de nuevo.");
            return;
        }
        localStorage.setItem('newPassword', newPassword.value);
        showNotification("¡Contraseña actualizada con éxito!");
    }


    // Limpiar los inputs 
    newPassword.value = '';
    confirmPassword.value = '';
    Nombre.value = '';

    saveLanguagePreference();
    saveNotificationPreference();
    showNotification("¡Cambios guardados con éxito!");
});

// Restablecer configuración
resetConfigButton.addEventListener('click', () => {
    languageSelect.value = "Español Latino";
    lightModeToggle.checked = false;
    notificationToggle.checked = false;

    disableLightMode();
    newPassword.value = '';
    confirmPassword.value = '';
    Nombre.value = '';


    // Limpia los datos del localStorage
    localStorage.removeItem('lightMode');
    localStorage.removeItem('profileImage');
    localStorage.removeItem('newPassword');
    localStorage.removeItem('language');
    localStorage.removeItem('notifEnabled');

    showNotification("Configuración restablecida.");
});


