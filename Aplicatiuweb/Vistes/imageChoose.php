<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        .zoom {
            background-color: green;
            transition: transform .2s;
            /* Animation */
        }

        .zoom:hover {
            transform: scale(1.07);
            /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
        }
    </style>

</head>
<?php include 'navbar.php'; ?>

<body>
    

    <section class="text-center container">
        <div class="row py-lg-5">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h1 class="fw-light">Choose an image</h1>
                <p class="lead text-body-secondary">or</p>
                <form method="post" action="/Controladors/imageController.php">
                    <button type="submit" name="tryAgainChoose" class="btn btn-secondary my-2">Try again</button>
                </p>
            </div>
        </div>
    </section>

    <div class="album py-5 bg-body-tertiary">
        <div class="container">

            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                <?php
                $imagesUrls = $_SESSION['imagesUrls'];
                foreach ($imagesUrls as $i => $imageUrl) {
                    echo '<div class="col">
                            <div class="card shadow-sm">
                                <a href="/Vistes/imageResult.php?id='.$i.'">
                                    <img src="' . $imageUrl["url"] . '" class="img-thumbnail zoom" alt="...">
                                </a>
                            </div>
                        </div>';
                }
                ?>
            </div>
        </div>
    </div>

    <?php include './footer.php'; ?>
</body>

</html>