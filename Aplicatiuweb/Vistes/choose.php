<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

</head>
<?php include 'navbar.php'; ?>

<body>

    <div class="d-flex flex-column align-items-center justify-content-center" style="height: 70vh;">
        <div class="text-center mb-4">
            <p class="display-4">Per on començem?</p>
        </div>
        <div class="d-flex gap-2">
            <a href="/Vistes/imagePrompt.php"
                class="btn btn-outline-secondary d-flex flex-column align-items-center btn-lg p-4 w-200">
                <svg xmlns="http://www.w3.org/2000/svg" height="3em" viewBox="0 0 512 512"
                    style="margin-bottom: 0.5em;">
                    <path
                        d="M448 80c8.8 0 16 7.2 16 16V415.8l-5-6.5-136-176c-4.5-5.9-11.6-9.3-19-9.3s-14.4 3.4-19 9.3L202 340.7l-30.5-42.7C167 291.7 159.8 288 152 288s-15 3.7-19.5 10.1l-80 112L48 416.3l0-.3V96c0-8.8 7.2-16 16-16H448zM64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zm80 192a48 48 0 1 0 0-96 48 48 0 1 0 0 96z">
                    </path>
                </svg>
                <span class="mx-auto" style="font-size: 1.5em;">Imatge</span>
            </a>
            <a href="/Vistes/productes.php"
                class="btn btn-outline-secondary d-flex flex-column align-items-center btn-lg p-4 w-200">
                <svg xmlns="http://www.w3.org/2000/svg" height="3em" viewBox="0 0 640 512"
                    style="margin-bottom: 0.5em;">
                    <path
                        d="M211.8 0c7.8 0 14.3 5.7 16.7 13.2C240.8 51.9 277.1 80 320 80s79.2-28.1 91.5-66.8C413.9 5.7 420.4 0 428.2 0h12.6c22.5 0 44.2 7.9 61.5 22.3L628.5 127.4c6.6 5.5 10.7 13.5 11.4 22.1s-2.1 17.1-7.8 23.6l-56 64c-11.4 13.1-31.2 14.6-44.6 3.5L480 197.7V448c0 35.3-28.7 64-64 64H224c-35.3 0-64-28.7-64-64V197.7l-51.5 42.9c-13.3 11.1-33.1 9.6-44.6-3.5l-56-64c-5.7-6.5-8.5-15-7.8-23.6s4.8-16.6 11.4-22.1L137.7 22.3C155 7.9 176.7 0 199.2 0h12.6z">
                    </path>
                </svg>
                <span class="mx-auto" style="font-size: 1.5em;">Producte</span>
            </a>
        </div>
    </div>

    <?php include 'footer.php'; ?>
</body>




</html>