<?php
session_start(); //inciem sessió per manejar variables de sessió
require_once '../Model/user_class.php';

class ControladorLogin {
    // Constructor buit
    public function __construct() {}

    // Función para manejar el inicio de sesión
    public function logejar($email, $contrasena) {
        // Verificar si los campos no están vacíos
        if (!empty($email) && !empty($contrasena)) {
            // Verificar si las contraseñas coinciden
            $usuari = new User();
            $loginar = $usuari->loginar($email, $contrasena);
            if ($loginar) {
                $infousuari = $usuari->recuperarInfoUsuari($email);
                // El usuario fue autenticado correctamente
                // Iniciar sesión y redirigirlo a la página de perfil
                if ($infousuari) {
                    $valor = true; //s'usará per a que posteriorment desaparegue "Iniciar sessión" del header hi aparegue perfil
                    $_SESSION['loggedin'] = $valor;
                    $_SESSION['usuario_id'] = $infousuari['id'];
                    $_SESSION['usuario_nombre'] = $infousuari['username'];
                    $_SESSION['usuario_email'] = $email;
                    
                }
                header("Location: /Vistes/perfil.php");// Redirige a la página de perfil después del inicio de sesión exitoso
                exit();
            } else {
                // El usuario no fue autenticado correctamente
                // Redirigirlo a la página de inicio de sesión con un mensaje de error
                header("Location: /Vistes/login.php?error=1"); // Agrega el parámetro error=1
                exit();
            }
        } else {
            // Campos vacíos, mostrar mensaje de error
            header("Location: /Vistes/login.php?error=1"); // Agrega el parámetro error=1
            exit();
        }
    }
}

// Uso del controlador en el contexto de una solicitud POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $contrasena = $_POST['contrasena'];
    // Instanciar el controlador y llamar al método logejar para manejar el inicio de sesión
    $controladorlogin = new ControladorLogin();
    $controladorlogin->logejar($email, $contrasena);   
} else {
    echo("L'usuari o la contrasenya son incorrectes");
}
?>
