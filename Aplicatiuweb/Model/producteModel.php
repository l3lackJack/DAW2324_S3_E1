<?php
require_once "dataBaseCon.php";

class Product {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }


    
    public function obtenerTodos () {
        $sql = "SELECT p.id, p.name,p.price, i.thumb, i.original FROM productos as p, imagenes as i where p.id = i.producto_id GROUP by p.name";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        if ($resultado) {
            return $resultado;
        } else {
            return "Algo ha salido mal...";
        }
    }

    public function obtenerUno($id) {
        $sql = "SELECT p.name,p.price, i.thumb FROM productos as p, imagenes as i where p.id = {$id} and p.id = i.producto_id GROUP by p.name";
        $stmt = $this->conn->prepare($sql); 

        $stmt->execute();


        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        if ($resultado) {
            return $resultado;
        } else {
            return "Algo ha salido mal...";
        }
    }

    

    public function printArray($array){
        echo '<pre>'; print_r($array); echo '</pre>';
    }

    
}
