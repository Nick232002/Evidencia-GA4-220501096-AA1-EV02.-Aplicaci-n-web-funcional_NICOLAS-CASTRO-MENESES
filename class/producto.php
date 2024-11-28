<?php
class Producto {
    private $conn;
    private $table_name = "productos"; 

    public $idproducto;
    public $nombre;
    public $descripcion;
    public $valor;
    public $fecha_creacion;
    public $fecha_actualizada;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Crear un nuevo producto
    public function insertarProducto($nombre, $descripcion, $precio) {
        try {
            $query = "INSERT INTO " . $this->table_name . " (nombre, descripcion, precio) 
                      VALUES (:nombre, :descripcion, :precio)";
            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':descripcion', $descripcion);
            $stmt->bindParam(':precio', $precio);

            if ($stmt->execute()) {
                echo "Producto insertado correctamente.";
                return true;
            }
            return false;
        } catch (PDOException $exception) {
            echo "Error al insertar el producto: " . $exception->getMessage();
            return false;
        }
    }

    // Leer un producto por ID
    public function obtenerProductoPorId($idproducto) {
        try {
            $query = "SELECT * FROM " . $this->table_name . " WHERE idproducto = :idproducto LIMIT 1";
            $stmt = $this->conn->prepare($query);
    
            // Vincular el parámetro :id
            $stmt->bindParam(':idproducto', $idproducto, PDO::PARAM_INT);
    
            // Ejecutar la consulta
            $stmt->execute();
    
            // Retornar el resultado
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            echo "Error al obtener el producto: " . $exception->getMessage();
            return false;
        }
    }
    

    // Leer todos los productos
    public function leerTodosLosProductos() {
        try {
            $query = "SELECT * FROM " . $this->table_name;
            $stmt = $this->conn->prepare($query);

            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            echo "Error al leer los productos: " . $exception->getMessage();
            return [];
        }
    }

    // Actualizar un producto
    public function actualizarProducto($idproducto, $nombre, $descripcion, $precio) {
        try {
            $query = "UPDATE " . $this->table_name . " 
                      SET nombre = :nombre, descripcion = :descripcion, precio = :precio 
                      WHERE idproducto = :idproducto";
    
            $stmt = $this->conn->prepare($query);
    
            $stmt->bindParam(':idproducto', $idproducto, PDO::PARAM_INT);
            $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $stmt->bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
            $stmt->bindParam(':precio', $precio, PDO::PARAM_STR);
    
            return $stmt->execute();
        } catch (PDOException $exception) {
            echo "Error al actualizar el producto: " . $exception->getMessage();
            return false;
        }
    }
    
    
    
    // Eliminar un producto
    public function eliminarProducto($idproducto) {
        try {
            $query = "DELETE FROM " . $this->table_name . " WHERE idproducto = :idproducto";
            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(':idproducto', $idproducto);

            if ($stmt->execute()) {
                echo "Producto eliminado correctamente.";
                return true;
            }
            return false;
        } catch (PDOException $exception) {
            echo "Error al eliminar el producto: " . $exception->getMessage();
            return false;
        }
    }
}