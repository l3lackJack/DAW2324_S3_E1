<?php
require_once '../Model/user_class.php';

class ControladorRegistro {
    public function __construct() {}

    public function registrarUsuario($nombre, $apellidos, $username, $email, $contrasena, $confirmarContrasena) {
        // Validar y escapar los datos recibidos del formulario para evitar inyección de código
        $nombre = htmlspecialchars($nombre, ENT_QUOTES, 'UTF-8');
        $apellidos = htmlspecialchars($apellidos, ENT_QUOTES, 'UTF-8');
        $username = htmlspecialchars($username, ENT_QUOTES, 'UTF-8');
        $email = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
        $contrasena = htmlspecialchars($contrasena, ENT_QUOTES, 'UTF-8');
        $confirmarContrasena = htmlspecialchars($confirmarContrasena, ENT_QUOTES, 'UTF-8');

        // Verificar si los campos no están vacíos
        if (!empty($nombre) && !empty($apellidos) && !empty($username) && !empty($email) && !empty($contrasena) && !empty($confirmarContrasena)) {
            // Verificar si las contraseñas coinciden
            if ($contrasena == $confirmarContrasena) {
                $usuari = new User();

                if ($usuari->registrarUsuario($nombre, $apellidos, $username, $email, $contrasena)) {
                    // Obtener el ID del usuario registrado
                    $idDelUsuario = $usuari->getLastInsertedUserId();

                    // Iniciar sesión y almacenar el ID del usuario en la sesión
                    session_start();
                    $_SESSION['usuario_id'] = $idDelUsuario;
                    $_SESSION['usuario_nombre'] = $nombre;
                    $_SESSION['usuario_apellidos'] = $apellidos;
                    $_SESSION['usuario_username'] = $username; // Agregado nombre de usuario
                    $_SESSION['usuario_email'] = $email;
                    $_SESSION['usuario_contrasena'] = $contrasena;
                    $_SESSION['loggedin'] = true;

                    // Redirigir a la página de inicio o perfil
                    header("Location: /Vistes/perfil.php");
                    exit();
                } 
            } else {
                // En caso de que falle el registro, redirigir al registro
                header("Location: /Vistes/registre.php");
                exit();
            }
        } 
    }
}

// Uso del controlador en el contexto de una solicitud POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
    $apellidos = isset($_POST['apellidos']) ? $_POST['apellidos'] : '';
    $username = isset($_POST['username']) ? $_POST['username'] : ''; // Agregado nombre de usuario
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $contrasena = isset($_POST['contrasena']) ? $_POST['contrasena'] : '';
    $confirmarContrasena = isset($_POST['confirmar_contrasena']) ? $_POST['confirmar_contrasena'] : '';

    // Instanciar el controlador y llamar al método registrarUsuario
    $controladorRegistro = new ControladorRegistro();
    $controladorRegistro->registrarUsuario($nombre, $apellidos, $username, $email, $contrasena, $confirmarContrasena);
}
?>
