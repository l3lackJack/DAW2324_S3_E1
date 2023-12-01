<?php
     require_once "../Controladors/producteControl.php"; 
     require_once "./navbar.php";
     require_once "../Model/producteModel.php"; 
     ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productes</title>
    <script src="js/product.js"></script>
</head>


<body>
    <?php 
      $modeloProducto = new Product();

      //Cargar datos de la base de datos en array
      $datos = $modeloProducto->obtenerTodos();

     
    ?>

    <section class="section-products pt-3">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-md-8 col-lg-6 pt-2">
                    <div class="header">
                        <!-- <h3>Featured Product</h3> -->
                        <h2>Popular Products</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php
                    $i = 0;
                    foreach ($datos as $dat) : ?>
                <div class="col-md-6 col-lg-4 col-xl-3" id="product">
                    <div id="product-1" class="single-product">
                <form action="../Controladors/producteControl.php?id=<?php echo $datos[$i]['id'] ?>" method="post">
                        
                        <div class="part-1"> 
                            <img src="<?= $datos[$i]['thumb']; ?>" alt="">
                        </div>
                        <div class="part-2">
                            <h3 class="product-title"><?= $datos[$i]['name']; ?></h3>
                            <h4 class="product-price">$49.99</h4>
                            <p>
                            <input class="btn btn-primary" type="submit" value="Select">
                            </p>
                        </div>
                </form>

                    </div>
                </div>

                <?php $i++;
                    endforeach; ?>
                <!-- Single Product -->

            </div>
        </div>
    </section>
    <?php include "footer.php" ?>
</body>

</html>