<?php 
session_start(); //Iniciem sessió per manejar les variables de sessió
require_once '../Model/user_class.php'; // Importem la classe d'usuari necessària

class UserController {
    private $userModel;

    public function __construct() {
        $this->userModel = new User(); // Creem una instància del model d'usuari
    }
    // Mètode per actualitzar les dades de l'usuari
    public function actualizarUsuario($id, $nombre, $email) {
        // Validar les dades abans de fer cap operació
        if ($this->validarDatos($nombre, $email)) {
            // Actualitzem l'usuari a la base de dades
            if ($this->userModel->actualizarUsuario($id, $nombre, $email)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    // Mètode privat per validar les dades
    private function validarDatos($nombre, $email) {
        // Verifiquem que els camps no estiguin buits
        if (!empty($nombre) && !empty($email)) {
            // Podem implementar lògica addicional de validació aquí (longitud, format de correu, etc.)
            return true; // tornar true si les dades son válides
        } else {
            return false; // si no, tornar false
        }
    }
}

// agafar la solicitud del formulari tipus post
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar si se ha enviat solicitud per a tancar sessió
    if (isset($_POST['cerrar_sesion'])) {
        // Destruir la sessió
        session_destroy();
        session_unset();
        // Redirigir a la página de inic de sessió
        header("Location: /Vistes/login.php");
        exit();
    } elseif (isset($_POST['borrar_cuenta'])) { //En cas de rebre borrar compte al formulari
        // Eliminem el compte de l'usuari i redirigim a la pàgina de registre
        $usuari = new User(); //instanciem la clase usuari
        $borrarcuenta = $usuari->borrarCuenta($_SESSION['usuario_email']); //cridem al metode per borrar compte de la clase usuari
        session_destroy();
        session_unset();
        header("Location: /Vistes/registre.php"); //redirigim al registre ja que acabem de borrar el compte
        exit();
    } else {
        // En cas de que hem rebut un post pero no es de borrar compte ni de tancar sessio, será de actualizar l'informació ja que només hi han estes 3 opcions
        if (isset($_SESSION['usuario_id'])) { //verifiquem que l'usuari ha inciat sessió
            $id = $_SESSION['usuario_id'];
            $nuevoNombre = $_POST['nombre']; // Asignar el valor del formulari a $nuevoNombre
            $nuevoEmail = $_POST['email']; // Asignar el valor del formulari a $nuevoEmail

            // instanciem la clase per a posteriorment cridar el metode "actualitzarusuari"
            $userController = new UserController();

            // Actualizar el usuari en la base de dades y verificar si la actualizació ha sigut existosa
            if ($userController->actualizarUsuario($id, $nuevoNombre, $nuevoEmail)) {
                // Actualizar las variables de sesión amb els nous valors
                $_SESSION['usuario_nombre'] = $nuevoNombre;
                $_SESSION['usuario_email'] = $nuevoEmail;

                // Redirigir a la página de perfil con un mensaje de éxito
                header("Location: /Vistes/perfil.php");
                exit();
            } else {
                // La actualización en la base de datos falló, redirigir con un mensaje de error
                header("Location: /Vistes/perfil.php?error=1");
                exit();
            }
        } else {
            // El usuario no está autenticado, redirigir a la página de inicio de sesión
            header("Location: /Vistes/login.php");
            exit();
        }
    }
}
?>
