<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['tryAgainChoose']) && $_GET['action'] == 'change') {
        unset($_POST['tryAgainChoose']);

        if (isset($_POST['newTopic'])) {
            unset($_POST['newTopic']);

            header("Location: /Vistes/imagePrompt.php");
            exit();
        }

        if (isset($_POST['regenerate'])) {
            die('Regenerate');
        }

    }

    if (isset($_POST['imageResult']) && $_GET['action'] == 'imageResult') {

        if (isset($_POST['backButton'])) {
            unset($_POST['backButton']);

            array_pop($_SESSION['promptList']);

            header("Location: /Vistes/imageChoose.php");
            exit();
        }

        if (isset($_POST['resetButton'])) {
            unset($_POST['resetButton']);

            unset($_SESSION['promptList']);
            unset($_SESSION['imagesUrls']);

            header("Location: /Vistes/imagePrompt.php");
            exit();
        }

        if (isset($_POST['saveButton'])) {
            unset($_POST['saveButton']);
            if (isset($_SESSION['usuario_id'])) {
                die('Guardar Imagen');

            } else {
                header("Location: /Vistes/login.php");
                exit();
            }
        }
    }


    if (isset($_POST['photo']) && $_GET['action'] == 'photo') {
        $idPhotoChosen = $_POST['photo'];
        unset($_POST['photo']);

        array_push($_SESSION['promptList'], $_SESSION['topic']);

        header("Location: /Vistes/imageResult.php?id=" . $idPhotoChosen);
        exit();
    }

    if (isset($_POST['promptText']) && $_GET['action'] == 'topic') {
        $_SESSION['topic'] = htmlspecialchars($_POST['promptText']);
        unset($_POST['promptText']);

        if (empty($_SESSION['promptList'])) {
            $_SESSION['promptList'] = array();
        }
        $api_url = 'http://fastapi:8000/generateImages';

        $options = [
            'http' => [
                'method' => 'POST',
                'header' => 'Content-Type: application/json',
                'content' => json_encode(['topic' => $_SESSION['topic']])
            ]
        ];

        $context = stream_context_create($options);
        $result = file_get_contents($api_url, false, $context);
        if ($result === false) {

            echo 'Error en la solicitud a la API';
        } else {
            // Decodificar la respuesta JSON
            $imageUrls = json_decode($result, true);

            // Verificar si la respuesta es un array
            if (is_array($imageUrls)) {
                $_SESSION['imagesUrls'] = $imageUrls;
            } else {
                echo 'La respuesta de la API no es un array';
            }
        }

        header("Location: /Vistes/imageChoose.php");
        exit();
    }
}