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
            cursor: pointer;
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

    <div class="album py-5 bg-body-tertiary">
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                <?php
                if (isset($_SESSION['imagesUrls']) && is_array($_SESSION['imagesUrls'])) {
                    foreach ($_SESSION['imagesUrls'] as $i=>$imageUrl) {
                        echo '<form action="/Controladors/imageController.php?action=photo" method="post">
                  <div class="col">
                      <div class="card shadow-sm">
                          <img src="' . $imageUrl . '" class="img-thumbnail zoom" alt="Imagen generada" style="height: 256px; width: 100%;">
                      </div>
                  </div>
                  <input type="hidden" name="photo" value="' . $i . '">
              </form>';
                    }
                } else {
                    echo "No hay imágenes disponibles.";
                }
                ?>

            </div>
        </div>
    </div>

    <section class="text-center container">
        <div class="row">
            <div class="col-lg-6 col-md-8 mx-auto">
                <form method="post" action="/Controladors/imageController.php?action=change">
                    <input type="hidden" name="tryAgainChoose" value="we" />
                    <button type="submit" name="regenerate" class="btn btn-secondary my-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor"
                            class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2z" />
                            <path
                                d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466" />
                        </svg>
                    </button>
                    <h1 class="fw-light">or</h1>
                    <button type="submit" name="newTopic" class="btn btn-primary my-2">Enter new topic</button>
                    </p>
                </form>
            </div>
        </div>
    </section>

    <?php include './footer.php'; ?>

    <script>
        const images = document.querySelectorAll('.img-thumbnail');

        console.log(images);
        images.forEach(image => {
            image.addEventListener('click', () => {
                image.closest('form').submit();
            })
        });
    </script>
</body>

</html>