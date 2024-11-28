<?php
class Usuario {
    private $conn;
    private $table_name = "usuarios";

    public $nombre;
    public $correo;
    public $contrasena;
    
    public function __construct($db) {
        $this->conn = $db;
    }

    // Registrar un nuevo usuario
    public function registrarUsuario($nombre, $correo, $contrasena) {
        // Definir la consulta SQL
        $query = "INSERT INTO usuarios (nombre, correo, contrasena) VALUES (:nombre, :correo, :contrasena)";
        
        // Preparar la sentencia
        $stmt = $this->conn->prepare($query);
        
        // Vincular los valores
        $stmt->bindValue(':nombre', $nombre);
        $stmt->bindValue(':correo', $correo);
        $stmt->bindValue(':contrasena', password_hash($contrasena, PASSWORD_DEFAULT)); // Seguridad
        return $stmt->execute();
    }

    // Autenticar un usuario
    public function autenticarUsuario($correo, $contrasena) {
        $query = "SELECT id, contrasena FROM " . $this->table_name . " WHERE correo = :correo";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':correo', $correo);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if (password_verify($contrasena, $row['contrasena'])) {
                return $row['id']; // Devuelve el ID del usuario si las credenciales son correctas
            }
        }

        return false;
    }
}
?>
