<?php 
      require_once "../Controladors/producteControl.php"; 
      require_once "./navbar.php";
      require_once "../Model/producteModel.php"; 
 
      $modeloProducto = new Product();

      $producto = $modeloProducto->obtenerUno($_SESSION['producte_actual']);
   
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productes</title>
    <link rel="stylesheet" href="../bootstrap/css/productes.css">
    <script src="../bootstrap/js/product_detail.js"></script>
    <script src="./js/llistaProductes.js"></script>
    <script src="js/product.js"></script>
</head>
<body>

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="row align-items-center product-detail-top">
                    <div class="col-md-6">
                        <img src="<?=$producto[0]['thumb'];?>" style="height:100%;width:100%" alt="">
                    </div>
                    <div class="col-md-6">
                        <div class="product-content">
                            <div class="title">
                                <h2><?=$producto[0]['name'];?></h2>
                            </div>
                            <div class="price">$22</div>
                            <div class="details">
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. In condimentum quam ac mi
                                    viverra dictum. In efficitur ipsum diam, at dignissim lorem tempor in. Vivamus
                                    tempor hendrerit finibus. Nulla tristique viverra nisl, sit amet bibendum ante
                                    suscipit non.
                                </p>
                                <form method="post" action="../Controladors/producteControl.php">
                                    <input class="btn btn-primary" type="submit" name="botonSoporte" value="Select Support"/>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>


<?php include "footer.php" ?>


</body>

</html> 