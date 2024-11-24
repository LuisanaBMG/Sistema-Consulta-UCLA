const errors = {
    campo_vacio: "Por favor, completa todos los campos.",
    contrasena_incorrecta: "Contraseña incorrecta. Verifica tus credenciales.",
    usuario_no_existe: "El usuario no existe en nuestra base de datos.",
    error_acceso: "Para acceder debe iniciar sesión."
};

function mostrarAlerta(error) {
    const alerta = document.querySelector('.alert');
    
    if (alerta) {
        alerta.textContent = errors[error] || 'Ocurrió un error desconocido.';
        alerta.classList.add('show');
        
        setTimeout(() => {
            alerta.classList.remove('show');
        }, 5000);
    }
}

window.addEventListener('load', () => {
    const urlParams = new URLSearchParams(window.location.search);
    const errorParam = urlParams.get('error');

    if (errorParam && errorParam in errors) {
        mostrarAlerta(errorParam);
    }
});

