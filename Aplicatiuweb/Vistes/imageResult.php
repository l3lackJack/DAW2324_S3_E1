<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>


</head>

<body>
    <?php include 'navbar.php'; ?>



    <!--  MAIN  -->
    <section class="text-center container">
        <div class="row pt-lg-3">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h1 class="fw-light">Image Result</h1>

                <div class="card shadow-sm">
                    <?php
                    $imagesUrls = $_SESSION['imagesUrls'];
                    $id = $_GET['id'];
                    echo '<img src="' . $imagesUrls[$id]["url"] . '" class="img-thumbnail" alt="...">';
                    ?>
                </div>

                <form class="mt-2" method="post" action="/Controladors/imageController.php">
                    <button name="resetButton" id="resetButton" type="submit" href="/Vistes/imagePrompt.php"
                        class="btn btn-secondary mx-3">Reset Process</button>
                    <button type="submit" name="saveButton" class="btn btn-primary">Save</button>
                    </p>
            </div>
        </div>
    </section>

    <!--  HISTORY  -->
    <div class="py-2 bg-body-tertiary">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">History</h5>
                            <div>

                            </div>
                            <?php
                            $promptList = $_SESSION['promptList'];
                            foreach ($promptList as $i => $prompt) {
                                echo '<p class="card-text border rounded bg-secondary text-white p-2" style="max-width: 750px;">' . $prompt . '</p>';
                            }
                            ?>

                        </div>
                        <div class="card-body">
                            <form method="post" action="imageController.php"
                                class="row row-cols-lg-auto g-3 align-items-center">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="promptText" id="promptText"
                                        placeholder="Enter the topic here">
                                    <button disabled name="promptButton" id="promptButton" type="submit"
                                        class="btn btn-success">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--  FOOTER  -->
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