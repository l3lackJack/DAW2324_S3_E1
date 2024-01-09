<?php
session_start();

// Prompt button
if (isset($_POST['promptButton'])) {
    $topic = htmlspecialchars($_POST['promptText']);
    if (empty($_SESSION['promptList'])){
        $_SESSION['promptList'] = array();
    }
    array_push($_SESSION['promptList'], $topic);

    $api_url = 'http://fastapi:8000/generateImages';

    $options = [
        'http' => [
            'method' => 'POST',
            'header' => 'Content-Type: application/json',
            'content' => json_encode(['topic' => $topic])
        ]
    ];

    $context = stream_context_create($options);

    $result = file_get_contents($api_url, false, $context);

    if ($result === false) {
        echo 'Error';
    } else {
        $_SESSION['imagesUrls'] = [];
        $_SESSION['imagesUrls'] = json_decode($result, true);
    }

    header("Location: /Vistes/imageChoose.php");
}


if(isset($_POST['saveButton'])) {
    var_dump(1);
}

// Reset button
if (isset($_POST['resetButton'])) {
    unset($_SESSION['promptList']);
    unset($_SESSION['imagesUrls']);
    header("Location: /Vistes/imagePrompt.php");
}

if (isset($_POST['tryAgainChoose'])){
    header("Location: /Vistes/imagePrompt.php");
}