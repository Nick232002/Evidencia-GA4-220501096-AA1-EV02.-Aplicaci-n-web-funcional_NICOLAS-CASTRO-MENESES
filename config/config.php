<?php
class Database {
    private $host = "localhost"; // Cambia esto si tu servidor es remoto
    private $db_name = "bdd_proyecto"; // Nombre de tu base de datos
    private $username = "root"; // Usuario de tu base de datos (ajusta según tu configuración)
    private $password = ""; // Contraseña del usuario (ajusta según sea necesario)
    public $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name . ";charset=utf8", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Modo de errores para depuración
        } catch (PDOException $exception) {
            echo "Error de conexión: " . $exception->getMessage();
        }
        return $this->conn;
    }
}

?>
