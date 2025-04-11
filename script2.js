// Funcionalidad para mostrar el modal de registro
document.getElementById('register-link').addEventListener('click', function() {
    document.getElementById('register-modal').style.display = 'flex';
});

// Cerrar el modal
document.getElementById('close-modal').addEventListener('click', function() {
    document.getElementById('register-modal').style.display = 'none';
});

// Cerrar el modal si se hace clic fuera de la caja del modal
window.onclick = function(event) {
    if (event.target === document.getElementById('register-modal')) {
        document.getElementById('register-modal').style.display = 'none';
    }
};

// Manejar el evento de inicio de sesión
function handleLogin(event) {
    event.preventDefault(); // Prevenir el envío del formulario

    // Obtener los valores del formulario
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;

    // Validación (puedes agregar validaciones más complejas)
    if (username && password) {
        // Simulación de login exitoso
        alert('Inicio de sesión exitoso');
        window.location.href = 'home.html'; // Redirigir al home
    } else {
        alert('Por favor ingresa tus credenciales correctamente');
    }
}

// Manejar el evento de registro
function handleRegister(event) {
    event.preventDefault(); // Prevenir el envío del formulario

    // Obtener los valores del formulario
    const username = document.getElementById('reg-username').value;
    const password = document.getElementById('reg-password').value;
    const confirmPassword = document.getElementById('reg-confirm-password').value;

    // Validación básica
    if (password === confirmPassword && username && password) {
        // Simulación de registro exitoso
        alert('Registro exitoso');
        window.location.href = 'home.html'; // Redirigir al home
    } else {
        alert('Por favor verifica la contraseña o completa todos los campos');
    }
}

// Funcionalidad para mostrar el modal de registro
document.getElementById('register-link').addEventListener('click', function() {
    document.getElementById('register-modal').style.display = 'flex';
});

// Cerrar el modal
document.getElementById('close-modal').addEventListener('click', function() {
    document.getElementById('register-modal').style.display = 'none';
});

// Cerrar el modal si se hace clic fuera de la caja del modal
window.onclick = function(event) {
    if (event.target === document.getElementById('register-modal')) {
        document.getElementById('register-modal').style.display = 'none';
    }
};