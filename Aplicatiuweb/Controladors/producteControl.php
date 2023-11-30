<?php 
include '../Model/producteModel.php';

define("RUTA", "../img/product_picanova/");

class ProducteControl {
    
    private $productModel;

    public function __construct() {
        $this->productModel = new Product();
    }

    //Entre $productId que es el id del producte 
    // $nimatge el nom de la imatge que es solicita
    public function mostrarPreu($productId) {
        $preu = $this->productModel->obtenirPreu($productId);
        return $preu[0]["sell_price"]; //sols tindra un resultat
    }

    public function mostrarNom($productId) {
        $nom = $this->productModel->obtenirName($productId);
        return $nom[0]["name"]; //sols tindra un resultat
    }

    public function llistarProductes () {
        $productes = $this->productModel->obtenirTots();
        header('Content-Type: application/json');
        echo json_encode($productes);
    }

    public function llistatProducteImagens () {
        $productes = $this->productModel->obtenirProducteImagens();
        header('Content-Type: application/json');
        echo json_encode($productes);
    }

    //Entre $productId que es el id del producte 
    // $nimatge el nom de la imatge que es solicita
    public function obtenirRutaIma($productId, $nimatge) {
        $rutaImagen = $this->productModel->obtenerNomImagens($productId);
        return (RUTA.$rutaImagen[$nimatge]["nom"]);  
    }

}
