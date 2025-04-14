let form = document.querySelector('form');

form.addEventListener('submit', function (e) {
    e.preventDefault();

    // Get input elements
    let inputName = document.querySelector('#Name');
    let inputFirstName = document.querySelector('#Last-name');
    let inputEmail = document.querySelector('#Email');
    let spanError = document.querySelector('#spanError');
    const textAreaInput = document.querySelector('TextAreaInput');

    // Get input values
    let nameValue = inputName.value.trim();
    let firstNameValue = inputFirstName?.value.trim();
    let emailValue = inputEmail.value.trim();
    let passwordValue = inputPassword.value.trim();
    let textAreaValue = textAreaInput.value.trim();

    // Style error variable
    let errorStyle = 'solid 1px red';

    // Reset styles and error message
    function resetStyles() {
        inputName.style.border = "";
        inputFirstName.style.border = "";
        inputEmail.style.border = "";
        inputPassword.style.border = "";
        textAreaInput.style.border = "";
        spanError.textContent = "";
    }

    // Check if any fields are empty
    if (nameValue === "" || firstNameValue === "" || emailValue === "" || passwordValue === "" || textAreaInput === "") {
        console.log("Debes llenar todos los campos");
        inputName.style.border = errorStyle;
        inputFirstName.style.border = errorStyle;
        inputEmail.style.border = errorStyle;
        inputPassword.style.border = errorStyle;
        textAreaInput.style.border = errorStyle;
        spanError.textContent = 'Debes llenar todos los campos';

        // Reset styles and error message after 3 seconds
        setTimeout(resetStyles, 3000);
    }
    // Check if password is less than 9 characters
    else if (passwordValue.length < 9) {
        spanError.textContent = "La contraseña debe contener al menos 9 caracteres";
        inputPassword.style.border = "1px dashed red";

        // Reset styles and error message after 3 seconds
        setTimeout(resetStyles, 3000);
    }
    // Submit the form
    else {
        console.log('se envia el formulario')
        inputFirstName.style.border = "solid 1px green";
        inputEmail.style.border = "solid 1px green";
        inputName.style.border = "solid 1px green";
        inputPassword.style.border = "solid 1px green";
        form.submit();
    }
});
