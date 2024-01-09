<?php session_start();
$predefinedTopics = [
    [
        'topic' => 'Valentine\'s Day',
        'src' => '../img/valentinesDay.jpg',
        'prompt' => 'A photo of Valentine\'s Day'
    ],
    [
        'topic' => 'Mother\'s Day',
        'src' => '../img/mothersDay.jpg',
        'prompt' => 'A photo of Mother\'s Day'
    ],
    [
        'topic' => 'Halloween',
        'src' => '../img/halloween.png',
        'prompt' => 'A photo of Halloween'
    ],
];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        .card {
            position: relative;
            overflow: hidden;
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0);
            opacity: 0;
            transition: opacity 0.3s ease;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .text {
            color: white;
            text-align: center;
            display: none;
            font-size: 32px;
        }

        .card:hover .overlay {
            background: rgba(0, 0, 0, 0.8);
            opacity: 1;
            cursor: pointer;
        }

        .card:hover .text {
            display: block;
        }

        input[type="radio"] {
            display: none;
        }
    </style>

</head>
<?php include 'navbar.php'; ?>

<body>


    <!-- PROMPT INPUT -->
    <div class="container">
        <div id="content">
            <div class="mt-3 ms-5 me-5">
                <section class="text-center container">
                    <div class="px-4 py-5 text-center">
                        <h1 class="display-5 fw-bold">Create, personalize, surprise</h1>
                    </div>
                </section>
                <div class="row justify-content-center"> <!-- Cambio en esta línea -->
                    <form method="post" action="/Controladors/imageController.php?action=topic" class="col-6">
                        <div class="text-center"> <!-- Cambio en esta línea -->
                            <p class="lead">Write a topic you want the image to be about</p>
                        </div>
                        <div class="input-group">
                            <input type="text" class="form-control" name="promptText" id="promptText"
                                placeholder="Enter the topic here">
                            <button disabled name="promptButton" id="promptButton" type="submit"
                                class="btn btn-success">Submit</button>
                        </div>
                    </form>
                </div>
            </div>



            <div class="mt-3 ms-5 me-5">
                <section class="text-center container">
                    <div class="row">
                        <div class="col-lg-6 col-md-8 mx-auto">
                            <h1 class="fw-light mb-5">or</h1>

                            <p class="lead text-body-secondary">Select a preset topic</p>
                        </div>
                    </div>
                </section>
            </div>


            <div class="album pb-5">
                <div class="container">
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                        <?php
                        foreach ($predefinedTopics as $i => $topic) {
                            echo '<form action="/Controladors/imageController.php?action=topic" method="post">
                        <div class="col">
                            <div class="card shadow-sm">
                                <label for="' . $topic['prompt'] . '">
                                    <img class="img-card" src="' . $topic['src'] . '" alt="" height="300" width="100%">
                                    <div class="overlay">
                                        <p class="text">' . $topic['topic'] . '</p>
                                    </div>
                                </label>
                                <input required type="text" id="' . $topic['topic'] . '" name="promptText" value="' . $topic['prompt'] . '"
                                    style="display: none;">

                            </div>
                        </div>
                        </form>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <div id="spinner"
            style="display:none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(255, 255, 255, 0.8);">
            <div class="d-flex justify-content-center align-items-center" style="height: 100%;">
                <div class="text-center">
                    <div class="spinner-border" role="status" style="width: 4rem; height: 4rem;">
                        <span class="visually-hidden">Cargando...</span>
                    </div>
                    <h4 class="mt-3">Generando la imagen...</h4>
                </div>
            </div>
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

        const overlay = document.querySelectorAll('.overlay');

        overlay.forEach(element => {
            element.addEventListener('click', () => {
                document.getElementById('content').style.display = 'none';
                document.getElementById('spinner').style.display = 'block';

                element.closest('form').submit();
            });
        });


        const forms = document.querySelectorAll('form');

        forms.forEach(form => {
            form.addEventListener('submit', () => {
                document.getElementById('content').style.display = 'none';
                document.getElementById('spinner').style.display = 'block';
            });
        });

    </script>

</body>

</html>