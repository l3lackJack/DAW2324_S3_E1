<?php
session_start();
require_once '../Model/user_class.php';

class UserController {
    private $userModel;

    public function __construct() {
        $this->userModel = new User();
    }

    public function actualizarUsuario($id, $nombre, $email) {
        // Validar las datos antes de hacer cualquier operación
        if ($this->validarDatos($nombre, $email)) {
            // Actualizar el usuario en la base de datos
            if ($this->userModel->actualizarUsuario($id, $nombre, $email)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    private function validarDatos($nombre, $email) {
        // Verificar que los campos no estén vacíos
        if (!empty($nombre) && !empty($email)) {
            // Puedes implementar lógica adicional de validación aquí (longitud, formato de correo, etc.)
            return true; // retornar true si los datos son válidos
        } else {
            return false; // si no, retornar false
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['cerrar_sesion'])) {
        // Destruir la sesión
        session_destroy();
        // Redirigir a la página de inicio de sesión
        header("Location: /Vistes/login.php");
        exit();
    } elseif (isset($_POST['borrar_cuenta'])) {
        $usuari = new User();
        $borrarcuenta = $usuari->borrarCuenta($_SESSION['usuario_email']);
        session_destroy();
        // Redirigir a la página de registro u otra página
        header("Location: /Vistes/registre.php");
        exit();
    } else {
        if (isset($_SESSION['usuario_id'])) {
            $id = $_SESSION['usuario_id'];
            $nuevoNombre = $_POST['nombre'];
            $nuevoEmail = $_POST['email'];

            $userController = new UserController();

            if ($userController->actualizarUsuario($id, $nuevoNombre, $nuevoEmail)) {
                // Actualizar las variables de sesión con los nuevos valores
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
