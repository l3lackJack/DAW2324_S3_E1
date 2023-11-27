<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si se ha subido un archivo
    if (isset($_FILES["profileImage"])) {
        $targetDir = "uploads/";  // Directorio donde se guardarán las imágenes
        $targetFile = $targetDir . basename($_FILES["profileImage"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Verificar si es una imagen real
        $check = getimagesize($_FILES["profileImage"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "El archivo no es una imagen.";
            $uploadOk = 0;
        }

        // Verificar si el archivo ya existe
        if (file_exists($targetFile)) {
            echo "Lo siento, el archivo ya existe.";
            $uploadOk = 0;
        }

        // Limitar el tamaño del archivo (puedes ajustar el límite según tus necesidades)
        if ($_FILES["profileImage"]["size"] > 500000) {
            echo "Lo siento, el archivo es demasiado grande.";
            $uploadOk = 0;
        }

        // Permitir solo ciertos formatos de imagen (puedes ajustar según tus necesidades)
        $allowedFormats = ["jpg", "jpeg", "png", "gif"];
        if (!in_array($imageFileType, $allowedFormats)) {
            echo "Solo se permiten archivos JPG, JPEG, PNG y GIF.";
            $uploadOk = 0;
        }

        // Si $uploadOk es igual a 0, se produjo un error
        if ($uploadOk == 0) {
            echo "Lo siento, tu archivo no fue subido.";
        } else {
            // Si todo está bien, intenta subir el archivo
            if (move_uploaded_file($_FILES["profileImage"]["tmp_name"], $targetFile)) {
                echo "La imagen ". basename($_FILES["profileImage"]["name"]). " ha sido subida.";
                // Aquí podrías guardar la ruta de la imagen en la base de datos para el usuario
            } else {
                echo "Lo siento, ha ocurrido un error al subir tu archivo.";
            }
        }
    }
}
?>
