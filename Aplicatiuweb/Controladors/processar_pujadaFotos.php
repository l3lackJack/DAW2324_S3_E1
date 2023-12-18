<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si 'usuario_id' está presente en la sesión
    if (isset($_SESSION['usuario_id'])) {
        // Obtener la ID del usuario desde la sesión
        $usuario_id = $_SESSION['usuario_id'];

        // Construir el nuevo nombre del archivo con la ID del usuario
        $nombre_archivo = $usuario_id . "." . pathinfo($_FILES["imagen"]["name"], PATHINFO_EXTENSION);
        $tipo_archivo = $_FILES["imagen"]["type"];
        $tamano_archivo = $_FILES["imagen"]["size"];
        $archivo_temporal = $_FILES["imagen"]["tmp_name"];

        // Lista de tipos de archivos de imagen permitidos
        $tipos_permitidos = array("image/jpeg", "image/png", "image/gif");

        // Ruta relativa de destino
        $ruta_destino = "Aplicatiuweb/img/fotos_perfil/" . $nombre_archivo;

        // Verificar si el tipo de archivo está permitido y tiene un tamaño adecuado
        if (in_array($tipo_archivo, $tipos_permitidos) && $tamano_archivo < 5000000) {
            // Verificar y crear el directorio de destino
            $directorio_destino = dirname($ruta_destino);

            if (!file_exists($directorio_destino)) {
                if (!mkdir($directorio_destino, 0777, true)) {
                    die('Error al crear el directorio de destino...');
                }
            }

            // Mover el archivo
            if (move_uploaded_file($archivo_temporal, $ruta_destino)) {
                // Redirigir a la página de perfil con la nueva imagen
                header("Location: /Vistes/perfil.php?imagen=" . urlencode("/Controladors/img/fotos_perfil/" . basename($ruta_destino)));
                exit();
            } else {
                echo "Error al mover el archivo.";
            }
        } else {
            echo "Error: El archivo no es una imagen válida o supera el tamaño permitido (5 MB).";
        }
    } else {
        echo "Error: No se encontró 'usuario_id' en la sesión.";
    }
}
?>
