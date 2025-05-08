document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("#formulario");
    const usuario = document.querySelector("#usuario");
    const contraseña = document.querySelector("#contraseña");
    const errorMessage = document.querySelector("#error-message");

    form.addEventListener("submit", function (e) {
        e.preventDefault();

        let isValid = true;

        const inputs = [usuario, contraseña];
        inputs.forEach(input => {
            input.classList.remove("error"); // Limpiar clase error
        });

        // Validar campos
        if (usuario.value.trim() === "") {
            usuario.classList.add("error");
            isValid = false;
        }

        if (contraseña.value.trim() === "") {
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
