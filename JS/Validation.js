// Function to allow only letters
function lettersOnly(input) {
    var regex = /^[A-Za-z]+$/;
    if (!regex.test(input.value)) {
        toastr.error('Solo se permiten letras');
        input.value = "";
    }
}

// Function to allow only numbers
function numbersOnly(input) {
    var regex = /^[0-9]*$/;
    if (!regex.test(input.value)) {
        toastr.error('Solo se permiten números');

        input.value = "";
    }
}

// Function to allow letters, hyphens, and periods
function numbers_hyphen_point(input) {
    var regex = /^[0-9.-]*$/;
    if (!regex.test(input.value)) {
        toastr.error('Solo se permiten números, guiones y puntos');

        input.value = "";
    }
}

// Function to validate email format
function validateEmail(input) {
    var regex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    if (!regex.test(input.value)) {
        toastr.error('Correo electrónico inválido. Formato esperado: nombre@dominio.com');

        input.value = "";
    }
}

// Function to validate phone number format
function validatePhone(input) {
    var regex = /^[0-9-]+$/;
    if (!regex.test(input.value)) {
        toastr.error('Número de teléfono inválido. Solo se permiten números y un guion opcional');

        input.value = "";
    }
}




