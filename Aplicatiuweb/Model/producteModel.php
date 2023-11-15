<?php
require_once "dataBaseCon.php";

class Product {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function obtenirPreu($productId) {
        $sql = "SELECT sell_price FROM products WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $productId);
        $stmt->execute();

        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        if ($resultado) {
            return $resultado;
        } else {
            return null;
        }
    }

    public function obtenirName($productId) {
        $sql = "SELECT name FROM products WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $productId);
        $stmt->execute();

        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        if ($resultado) {
            return $resultado;
        } else {
            return null;
        }
    }   
    
    public function obtenirTots () {
        $sql = "SELECT * FROM products";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        if ($resultado) {
            return $resultado;
        } else {
            return null;
        }
    }

    public function obtenirProducteImagens () {
        $sql = "SELECT products.id, products.sell_price, products.name, productImages.nom
                FROM products 
                LEFT JOIN productImages ON productImages.product_id =  products.id and productImages.nom LIKE '%ima1.%'";  
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        if ($resultado) {
            return $resultado;
        } else {
            return null;
        }
    }

    public function obtenerNomImagens($productId) {
        $sql = "SELECT nom FROM productImages WHERE product_id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $productId);
        $stmt->execute();

        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        if ($resultado) {
            return $resultado;
        } else {
            return null;
        }
    }

}
