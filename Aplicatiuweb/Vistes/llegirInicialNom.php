<?php
// Incluir el archivo de conexión
include '../Model/dataBaseCon.php';

// Crear una instancia de la clase Database
$database = new Database();
$conn = $database->connect();

// Verificar si el usuario está autenticado
if (isset($_SESSION['usuario_nombre'])) {
    // Obtener el nombre del usuario de la sesión
    $usuario_nombre = $_SESSION['usuario_nombre'];

    // Consulta SQL para obtener el nombre del usuario
    $sql = "SELECT name FROM clients WHERE name = :usuario_nombre";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':usuario_nombre', $usuario_nombre, PDO::PARAM_STR);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        // Obtener el nombre del usuario
        $nombre_usuario = $result["name"];

        // Obtener la inicial del nombre
        $inicial = strtoupper(substr($nombre_usuario, 0, 1));

        // Mostrar el icono redondo con la inicial
        echo "<div class='round-icon' id='initialIcon'>$inicial</div>";
    } else {
        echo "No se encontraron resultados.";
    }
} else {
    echo "Usuario no autenticado.";
}
?>
