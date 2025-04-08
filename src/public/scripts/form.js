document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("#formulario");
    const nombre = document.querySelector("#nombre");
    const apellido = document.querySelector("#apellido");
    const usuario = document.querySelector("#usuario");
    const telefono = document.querySelector("#telefono");
    const email = document.querySelector("#email");
    const pais = document.querySelector("#pais");
    const contraseña = document.querySelector("#contraseña");
    const puntos = document.querySelector("#puntos");
    const errorMessage = document.querySelector("#error-message");

    form.addEventListener("submit", function (e) {
        e.preventDefault();

        let isValid = true;

        const inputs = [nombre, apellido, usuario, contraseña, telefono, email, puntos];
        inputs.forEach(input => {
            input.classList.remove("error"); // Limpiar clase error
        });
        pais.classList.remove("error"); // Limpiar clase error del select

        // Validar campos
        if (nombre.value.trim() === "") {
            nombre.classList.add("error");
            isValid = false;
        }

        if (apellido.value.trim() === "") {
            apellido.classList.add("error");
            isValid = false;
        }

        if (usuario.value.trim() === "") {
            usuario.classList.add("error");
            isValid = false;
        }

        function formatearTelefono(telefono) {
            // Elimina todos los caracteres que no sean dígitos
            telefono = telefono.replace(/\D/g, '');
            // Formatea el número de teléfono (ejemplo: (123) 456-7890)
            return telefono.replace(/(\d{3})(\d{3})(\d{4})/, '($1) $2-$3');
        }

        function esTelefonoValido(telefono) {
            // Elimina todos los caracteres que no sean dígitos
            telefono = telefono.replace(/\D/g, '');
            // Verifica si el número tiene 10 dígitos
            return /^\d{10}$/.test(telefono);
        }


        if (telefono.value.trim() === "" || !esTelefonoValido(telefono.value.trim())) {
            telefono.classList.add("error");
            isValid = false;
        } else {
            // Formatea el número de teléfono y lo asigna al campo
            telefono.value = formatearTelefono(telefono.value.trim());
        }

        if (email.value.trim() === "") {
            email.classList.add("error");
            isValid = false;
        }

        if (pais.value === "Selecciona un país") {
            pais.classList.add("error");
            isValid = false;
        }

        if (puntos.value.trim() === "" || isNaN(puntos.value.trim()) || parseInt(puntos.value.trim()) < 1) {
            puntos.classList.add("error");
            isValid = false;
        }

        if (contraseña.value.trim().length < 9) {
            contraseña.classList.add("error");
            isValid = false;
        }

        if (!isValid) {
            errorMessage.classList.remove("hidden");
            errorMessage.classList.add("visible");

            setTimeout(() => {
                errorMessage.classList.remove("visible");
            }, 4000);
        } else {
            form.submit();
        }
    });
});
