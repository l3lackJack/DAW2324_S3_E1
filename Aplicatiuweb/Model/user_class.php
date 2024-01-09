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
        
        $query = 'SELECT * FROM clients';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);;
    }

    public function getById($id) {

        $query = 'SELECT * FROM clients WHERE idClient = :id';
  
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch();
    }

   
    public function delete($id) {
        
        $query = 'DELETE FROM clients WHERE idClient = :id';
    
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
                
        $stmt->execute();
    }

    public function getLastInsertedUserId() {
        return $this->conn->lastInsertId();
    }

    public function recuperarInfoUsuari($email) {
        $query = "SELECT idClient, name FROM clients WHERE mail = :email";
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

    public function registrarUsuario($nombre, $apellidos, $username, $email, $contrasena) {
        // Hashear la contraseña antes de almacenarla
        $contrasenaHash = password_hash($contrasena, PASSWORD_DEFAULT);
        
        // Preparar la consulta SQL con los campos de nombre, apellidos, email, nombre de usuario y contraseña hasheada
        $query = 'INSERT INTO clients (name, surnames, username, mail, password) VALUES (:nombre, :apellidos, :username, :email, :contrasena)';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellidos', $apellidos);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':contrasena', $contrasenaHash);
    
        // Ejecutar la consulta y verificar el resultado
        if ($stmt->execute()) {
            return true; // Éxito
        } else {
            return false; // Fallo
        }
    }
    
    

    public function actualizarUsuario($id, $nombre, $usuario, $email) {
        $query = 'UPDATE clients SET username = :usuario, nombre = :nombre, mail = :email WHERE idClient = :id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':usuario', $usuario);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':id', $id);
    
        // Ejecutar la consulta y verificar el resultado
        return $stmt->execute();
    }
    
    
    public function loginar($email, $contrasena) {
        $query = "SELECT idClient, username, password FROM clients WHERE mail = :email";
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
        $query = 'DELETE FROM clients WHERE mail = :email';
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