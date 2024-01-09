<?php 
    require_once "Controladors/producteControl.php"; 
    require_once "Vistes/navbar.php";
    require_once "Model/producteModel.php";  
    ?>

<head>
    <title>CustomAize</title>
    <link href="Vistes/css/style.css" rel="stylesheet">
    <style>
    </style>

</head>
<body>

    <section id="sesionStartImage">
        <div class="my-5">
            <div class="p-5 text-center">
                <div class="container py-5">
                    <h1 class="h1White">Da vida a tus pensamientos</h1>
                    <p class="col-lg-8 mx-auto lead pWhite">
                    ¡Transforma tus pensamientos en obras maestras únicas con nuestro servicio de Arte Personalizado con Inteligencia Artificial.
                    </p>
                    <button class="glow-on-hover"><a href="" style="color:black;">Empezar a crear</a></button>
                </div>
            </div>
        </div>
    </section>
    <?php 
      $modeloProducto = new Product();

      //Cargar datos de la base de datos en array
      $datos = $modeloProducto->obtenerTodosLimite();

     
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
  


    </div>








    <?php include 'Vistes/footer.php'; ?>

</body>

</html>