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
            <div class="col-lg-6 col-md-8 mx-auto mb-3">
                <!-- <h1 class="fw-light">Image Result</h1> -->

                <div class="card shadow-sm">
                    <?php
                    $imagesUrls = $_SESSION['imagesUrls'];
                    $id = $_GET['id'];
                    echo '<img src="' . $imagesUrls[$id] . '" class="img-thumbnail" alt="...">';
                    ?>
                </div>

                <form class="mt-3 mb-4 row justify-content-between" method="post" action="/Controladors/imageController.php?action=imageResult">
                    <input type="hidden" name="imageResult" value="we" />
                    <div class="col-auto">
                        <button name="backButton" id="backButton" type="submit" class="btn btn-secondary mx-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-arrow-left" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
                            </svg>
                        </button>
                        <button name="resetButton" id="resetButton" type="submit" href="/Vistes/imagePrompt.php"
                            class="btn btn-secondary">Reset Process</button>
                    </div>
                    <div class="col-auto">
                        <?php if (isset($_SESSION['usuario_id'])): ?>
                            <button name="saveButton" id="saveButton" type="submit" class="btn btn-primary">Save</button>
                        <?php else: ?>
                            <button name="saveButton" id="saveButton" type="submit" class="btn btn-primary">LogIn &
                                Save</button>
                        <?php endif; ?>
                    </div>
                </form>

            </div>
        </div>
    </section>

    <!--  HISTORY  -->
    <div class="py-2">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">History</h5>

                            <?php
                            $promptList = $_SESSION['promptList'];
                            foreach ($promptList as $i => $prompt) {
                                if ($prompt != null) {
                                    echo '<p class="card-text border rounded bg-secondary text-white p-2" style="max-width: 750px;">' . $prompt . '</p>';
                                }
                            }
                            ?>

                        </div>
                        <div class="card-body">
                            <form method="post" action="/Controladors/imageController.php?action=topic"
                                class="row row-cols-lg-auto g-3 align-items-center">
                                <div class="input-group">
                                    <input required type="text" class="form-control" name="promptText" id="promptText"
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