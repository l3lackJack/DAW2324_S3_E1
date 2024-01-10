<?php
require_once '../Model/user_class.php';

class ControladorRegistro {
    public function __construct() {}

    public function registrarUsuario($nombre, $email, $contrasena, $confirmarContrasena) {
        // Validar y escapar los datos recibidos del formulario per a que no nos puedan insertar codigo
        $nombre = htmlspecialchars($nombre, ENT_QUOTES, 'UTF-8');
        $email = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
        $contrasena = htmlspecialchars($contrasena, ENT_QUOTES, 'UTF-8');
        $confirmarContrasena = htmlspecialchars($confirmarContrasena, ENT_QUOTES, 'UTF-8');

        // Verificar si los campos no están vacíos
        if (!empty($nombre) && !empty($email) && !empty($contrasena) && !empty($confirmarContrasena)) {
            // Verificar si las contraseñas coinciden
            if ($contrasena == $confirmarContrasena) {
                $usuari = new User();

                if ($usuari->registrarUsuario($nombre, $email, $contrasena)) {
                    // Obtener el ID del usuario registrado
                    $idDelUsuario = $usuari->getLastInsertedUserId();

                    // Iniciar sesión y almacenar el ID del usuario en la sesión
                    session_start();
                    $_SESSION['usuario_id'] = $idDelUsuario;
                    $_SESSION['usuario_nombre'] = $nombre;
                    $_SESSION['usuario_email'] = $email;
                    $_SESSION['loggedin'] = true;

                    // Redirigir a la página de login
                    header("Location: /Vistes/login.php");
                    exit();
                } 
            } else {
                //en cas que falli el registre redirigir al registre
                header("Location: /Vistes/registre.php");
            }
        } 
    }
}

// Uso del controlador en el contexto de una solicitud POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['usuari'];
    $email = $_POST['email'];
    $contrasena = $_POST['contrasena'];
    $confirmarContrasena = $_POST['confirmar_contrasena'];

    // Instanciar el controlador y llamar al método registrarUsuario
    $controladorRegistro = new ControladorRegistro();
    $controladorRegistro->registrarUsuario($nombre, $email, $contrasena, $confirmarContrasena);
}
?>
