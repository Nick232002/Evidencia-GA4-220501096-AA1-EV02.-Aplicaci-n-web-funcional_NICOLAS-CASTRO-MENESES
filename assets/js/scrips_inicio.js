document.getElementById("loginForm").addEventListener("submit", function(event) {
    var usuario = document.getElementById("usuario").value;
    var password = document.getElementById("password").value;

    if (usuario === "" || password === "") {
        alert("Por favor, complete todos los campos obligatorios.");
        event.preventDefault(); // Evita el envío del formulario si los campos están vacíos
    }
});
