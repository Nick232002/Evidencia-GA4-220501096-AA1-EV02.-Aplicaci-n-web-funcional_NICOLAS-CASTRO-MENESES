<?php
session_start();
require_once 'config/config.php';
require_once 'class/usuario.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $correo = htmlspecialchars($_POST['correo']);
    $contraseña = htmlspecialchars($_POST['contraseña']);

    $database = new Database();
    $conn = $database->getConnection();

    $usuario = new Usuario($conn);

    $usuario_id = $usuario->autenticarUsuario($correo, $contraseña);

    if ($usuario_id) {
        $_SESSION['usuario_id'] = $usuario_id;
        header("Location:producto.php"); // Redirige al usuario a una página principal
        echo "Ingreso Correcto";
        exit;
    } else {
        echo "Correo o contraseña incorrectos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="assets/css/styles_pantalla_incio.css">
</head>
<body>
    <h2>Inicio de Sesión</h2>
    <form method="POST">
        <label for="correo">Correo Electrónico:</label>
        <input type="email" id="correo" name="correo" required><br>

        <label for="contraseña">Contraseña:</label>
        <input type="password" id="contraseña" name="contraseña" required><br>

        <button type="submit">Iniciar Sesión</button>
        <a href="register.php">Registarse</a>
    </form>
    
</body>
</html>
