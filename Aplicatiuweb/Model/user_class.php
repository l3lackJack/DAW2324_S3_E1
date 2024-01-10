<?php
require_once "dataBaseCon.php";

 class User {
    private $conn;
    public $id;
    public $userName;
    public $email;
 
    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function getAll() {
        
        $query = 'SELECT * FROM users';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);;
    }

    public function getById($id) {

        $query = 'SELECT * FROM users WHERE id = :id';
  
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch();
    }

   
    public function delete($id) {
        
        $query = 'DELETE FROM users WHERE id = :id';
    
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
                
        $stmt->execute();
    }

    public function getLastInsertedUserId() {
        return $this->conn->lastInsertId();
    }

    public function recuperarInfoUsuari($email) {
        $query = "SELECT id, username FROM users WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($resultado) {
            return $resultado; // Devuelve un array asociativo con 'id' y 'username'
        } else {
            return null; // Si el usuario no se encuentra, devuelve null o un valor que indique la ausencia de información.
        }
    }

    public function registrarUsuario($nombre, $email, $contrasena) {
        $contrasenaHash = password_hash($contrasena, PASSWORD_DEFAULT);

        $query = 'INSERT INTO users (username, email, password) VALUES (:nombre, :email, :contrasena)';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':contrasena', $contrasenaHash);

        // Ejecutar la consulta y verificar el resultado
        if ($stmt->execute()) {
            return true; // Éxito
        } else {
            return false; // Fallo
        }
    }

    public function actualizarUsuario($id, $nombre, $email) {
        $query = 'UPDATE users SET username = :nombre, email = :email WHERE id = :id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':id', $id);        

        if ($stmt->execute()) {
            return true; // Éxito
        } else {
            return false; // Fallo
        }
    }
    
    public function loginar($email, $contrasena) {
        $query = "SELECT id, username, password FROM users WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($usuario && password_verify($contrasena, $usuario['password'])) {
            return $usuario;
        } else {
            return false;
        }
    }
    public function borrarCuenta($email) {
        $query = 'DELETE FROM users WHERE email = :email';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
    
        // Ejecutar la consulta y verificar el resultado
        if ($stmt->execute()) {
            return true; // Éxito
        } else {
            return false; // Fallo
        }
    }
    
} 
?>