<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(!empty($_GET["id"])){
        $_SESSION['producte_actual'] = $_GET["id"];
        header('location:../Vistes/producte.php');
    }

    if(isset($_POST['botonSoporte'])){
        TODO: 
    }
    
}




?>