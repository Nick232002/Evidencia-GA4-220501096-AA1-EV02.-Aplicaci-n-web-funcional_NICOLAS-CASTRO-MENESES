document.getElementById("registroForm").addEventListener("submit", function(event) {
    var password = document.getElementById("password").value;
    var confirmPassword = document.getElementById("confirm_password").value;

    if (password !== confirmPassword) {
        alert("Las contraseñas no coinciden. Por favor, inténtelo de nuevo.");
        event.preventDefault(); // Evita el envío del formulario si las contraseñas no coinciden
    }
});
