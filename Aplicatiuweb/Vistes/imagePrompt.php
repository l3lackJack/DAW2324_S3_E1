<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        .carousel-item img {
            width: 100%;
            /* Ajusta el ancho a 100% del contenedor */
            height: 600px;
            /* Establece la altura fija deseada */
            object-fit: cover;
            /* Ajusta la imagen a la altura */
        }

        /* Cambiar el color de los íconos de Previous y Next a negro */
        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            background-color: #000;
            /* Cambiar el color a negro (código hexadecimal) */
        }

        /* Cambiar el color de los íconos de Previous y Next a negro */
        .carousel-control-prev-icon::before,
        .carousel-control-next-icon::before {
            color: #000;
            /* Cambiar el color a negro (código hexadecimal) */
        }
    </style>

</head>
<?php include 'navbar.php'; ?>

<body>


    <!-- PROMPT INPUT -->
    <div class="container">
        <div class="my-3">
            <form method="post" action="/Controladors/imageController.php"
                class="row row-cols-lg-auto g-3 align-items-center">
                <div class="input-group">
                    <input type="text" class="form-control" name="promptText" id="promptText"
                        placeholder="Enter the topic here">
                    <button disabled name="promptButton" id="promptButton" type="submit"
                        class="btn btn-success">Submit</button>
                </div>
            </form>
        </div>

        <hr>

        <div id="carouselExample" class="carousel" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <form action="/Controladors/imageController.php" method="POST">
                        <input type="hidden" name="promptText" value="A photo of valentines day">
                        <button type="submit" name="promptButton" id="promptButton" class="btn p-0 border-0 bg-transparent w-100">
                            <img src="../img/valentinesDay.jpg" class="d-block mx-auto img-fluid" alt="Imagen 1">
                        </button>
                    </form>
                </div>
                <div class="carousel-item">
                    <form action="/Controladors/imageController.php" method="POST">
                        <input type="hidden" name="promptText" value="A photo of halloween">
                        <button type="submit" name="promptButton" id="promptButton" class="btn p-0 border-0 bg-transparent w-100">
                            <img src="../img/halloween.png" class="d-block mx-auto img-fluid" alt="Imagen 2">
                        </button>
                    </form>
                </div>
                <div class="carousel-item">
                    <form action="/Controladors/imageController.php" method="POST">
                        <input type="hidden" name="promptText" value="A photo of mother's day">
                        <button type="submit" name="promptButton" id="promptButton" class="btn p-0 border-0 bg-transparent w-100">
                            <img src="../img/mothersDay.jpg" class="d-block mx-auto img-fluid" alt="Imagen 3">
                        </button>
                    </form>
                </div>
            </div>

            <a class="carousel-control-prev" href="#carouselExample" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExample" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </a>
        </div>

    </div>


    <?php include './footer.php'; ?>

    <script>
        const promptText = document.getElementById('promptText');
        const submitButton = document.getElementById('promptButton');

        promptText.addEventListener('input', () => {
            event.preventDefault();
            if (promptText.value.length > 3) {
                submitButton.removeAttribute('disabled');
            } else {
                submitButton.setAttribute('disabled', true);
            }
        });





    </script>

</body>

</html>