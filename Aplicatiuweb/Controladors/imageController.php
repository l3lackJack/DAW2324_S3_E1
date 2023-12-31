<?php
session_start();

// Prompt button
if (isset($_POST['promptButton'])) {
    $topic = $_POST['promptText'];
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
        $imagesUrls = $result;
        $_SESSION['imagesUrls'] = json_decode($imagesUrls, true);
    }

    header("Location: /Vistes/imageChoose.php");
}

// Reset button
if (isset($_POST['resetButton'])) {
    unset($_SESSION['promptList']);
    unset($_SESSION['imagesUrls']);
    header("Location: /Vistes/imagePrompt.php");
}