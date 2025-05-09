document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('.exchange-form');
    const submitButton = form.querySelector('button[type="submit"]');

    // Obtener los puntos necesarios y disponibles
    const userPoints = parseInt(document.querySelector('.user-points .points-value').textContent);
    const requiredPoints = parseInt(document.querySelector('.points-required .points-value').textContent);

    form.addEventListener('submit', async function (e) {
        e.preventDefault();

        // Deshabilitar el botón mientras se procesa
        submitButton.disabled = true;
        submitButton.innerHTML = 'Procesando...';

        // Validar puntos suficientes
        if (userPoints < requiredPoints) {
            showError('No tienes suficientes TrashPoints para este canje');
            submitButton.disabled = false;
            submitButton.innerHTML = 'Confirmar Canje';
            return;
        }

        // Validar campos requeridos
        const nombre = form.querySelector('#nombre').value.trim();
        const telefono = form.querySelector('#telefono').value.trim();
        const direccion = form.querySelector('#direccion').value.trim();

        if (!nombre || !telefono || !direccion) {
            showError('Por favor completa todos los campos requeridos');
            submitButton.disabled = false;
            submitButton.innerHTML = 'Confirmar Canje';
            return;
        }

        try {
            const formData = new FormData(form);
            const response = await fetch('process-product-exchange.php', {
                method: 'POST',
                body: formData
            });

            // Agregar log para debug
            console.log('Response:', response);

            const result = await response.json();
            console.log('Result:', result); // Log del resultado

            if (result.success) {
                showSuccess('¡Producto canjeado exitosamente!');
                setTimeout(() => {
                    window.location.href = 'Tienda.php';
                }, 2000);
            } else {
                throw new Error(result.message || 'Error al procesar el canje');
            }
        } catch (error) {
            console.error('Error detallado:', error); // Log del error específico
            showError(error.message || 'Ocurrió un error al procesar tu solicitud');
            submitButton.disabled = false;
            submitButton.innerHTML = 'Confirmar Canje';
        }
    });
});

// Funciones de utilidad para mostrar mensajes
function showError(message) {
    const errorDiv = document.createElement('div');
    errorDiv.className = 'alert alert-error';
    errorDiv.textContent = message;
    document.querySelector('.exchange-container').insertBefore(errorDiv, document.querySelector('.exchange-card'));

    setTimeout(() => {
        errorDiv.remove();
    }, 3000);
}

function showSuccess(message) {
    const successDiv = document.createElement('div');
    successDiv.className = 'alert alert-success';
    successDiv.textContent = message;
    document.querySelector('.exchange-container').insertBefore(successDiv, document.querySelector('.exchange-card'));

    setTimeout(() => {
        successDiv.remove();
    }, 2000);
}