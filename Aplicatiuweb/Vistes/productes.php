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

<section id="homeProducts" class="section-products pt-3">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-md-8 col-lg-6 pt-2">
                    <div class="header">
                        <h1 class="h1-center-black">Productos populares</h1>
                        <p class="p-center-black">Explora nuestro catálogo hoy y da vida a tus pensamientos con arte personalizado. ¡Cada producto es una oportunidad para expresar tu creatividad única!</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php
                    $i = 0;
                    foreach ($datos as $dat) : ?>
                <div class="col-md-6 col-lg-4 col-xl-4" id="product">
                    <div id="product-1" class="single-product" style="border-radius: 10px;overflow: hidden;overflow: hidden;box-shadow: 3px 4px 15px #00000026;margin-bottom: 20px;">
                        <form action="../Controladors/producteControl.php?id=<?php echo $datos[$i]['id'] ?>"
                            method="post">

                            <div class="part-1" style="background-color:white;">
                                <img src="<?= $datos[$i]['thumb']; ?>" alt="" style="text-align:center !important;display: flex;justify-content: center;align-items: center; width:100%;height:100%">
                            </div>
                            <div class="part-2" ">
                                <h3 class="product-title" style="text-align:center;margin-top:20px;font-weight:bold"><?= $datos[$i]['name']; ?></h3>
                                <!-- <p class="product-price" style="text-align:center;">$49.99</p> -->
                                <p style="text-align: center;">
                                    <input class="btn btn-primary" style="width:200px" type="submit" value="Seleccionar">
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
                <?php $i++;
                    endforeach; ?>
            </div>
        </div>
    </section>
    <?php include "footer.php" ?>
</body>

</html>