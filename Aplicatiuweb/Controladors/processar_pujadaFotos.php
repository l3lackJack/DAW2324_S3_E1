<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_archivo = $_FILES["imagen"]["name"];
    $tipo_archivo = $_FILES["imagen"]["type"];
    $tamano_archivo = $_FILES["imagen"]["size"];
    $archivo_temporal = $_FILES["imagen"]["tmp_name"];

    // Lista de tipos de archivos de imagen permitidos
    $tipos_permitidos = array("image/jpeg", "image/png", "image/gif");

    // Ruta absoluta de destino (ajusta la ruta según tu configuración)
    $ruta_destino = "/var/www/html/img/fotos_perfil/" . $nombre_archivo;

    // Verificar si el tipo de archivo está permitido y tiene un tamaño adecuado
    if (in_array($tipo_archivo, $tipos_permitidos) && $tamano_archivo < 5000000) {
        // Crear el directorio si no existe (de forma recursiva)
        $directorio_destino = dirname($ruta_destino);
        if (!file_exists($directorio_destino)) {
            mkdir($directorio_destino, 0777, true);
        }

        // Mover el archivo
        if (is_uploaded_file($archivo_temporal) && move_uploaded_file($archivo_temporal, $ruta_destino)) {
            echo "¡La imagen se ha subido correctamente!";
        } else {
            echo "Error al mover el archivo.";
        }
        
    } else {
        echo "Error: El archivo no es una imagen válida o supera el tamaño permitido.";
    }
}
?>
