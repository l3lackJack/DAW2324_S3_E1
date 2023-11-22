<?php
session_start();
if(isset($_SESSION['usuario_nombre'])) {
    // La sesión está iniciada, redirigir a la página de perfil 
    header("Location: /Vistes/perfil.php");
    exit();
}
$mostrarSoloInicioSesion = false;
?>

<!DOCTYPE html>
<html lang="en">

<?php include 'navbar.php'; ?>
<head>
    <script>
        // En validacions per als camps del formulari registre

        function escapeHTML(str) {
            var div = document.createElement('div');
            div.appendChild(document.createTextNode(str));
            return div.innerHTML;
        }

        function validarFormulari() {
            var usuario = document.getElementById('usuari');
            var email = document.getElementById('email');
            var contrasena = document.getElementById('contrasena');
            var confirmarContrasena = document.getElementById('confirmar_contrasena');

            usuario.value = escapeHTML(usuario.value.trim());
            email.value = escapeHTML(email.value.trim());

            document.getElementById('mensaje-error').style.display = 'none';
            document.getElementById('mensaje-error').innerHTML = '';

            // Restablecer el color de fondo al enviar el formulario
            usuario.style.backgroundColor = '';
            email.style.backgroundColor = '';
            contrasena.style.backgroundColor = '';
            confirmarContrasena.style.backgroundColor = '';

            if (usuario.value === '' || email.value === '' || contrasena.value === '' || confirmarContrasena.value === '') {
                mostrarError('Por favor, complete todos los campos.');
                
                // Cambiar el color de fondo de los campos vacíos a rojo
                if (usuario.value === '') usuario.style.backgroundColor = 'rgba(255, 0, 0, 0.2)';
                if (email.value === '') email.style.backgroundColor = 'rgba(255, 0, 0, 0.2)';
                if (contrasena.value === '') contrasena.style.backgroundColor = 'rgba(255, 0, 0, 0.2)';
                if (confirmarContrasena.value === '') confirmarContrasena.style.backgroundColor = 'rgba(255, 0, 0, 0.2)';

                return false;
            }

            // Verificar la longitud del nombre de usuario
            if (usuario.value.length > 10) {
                mostrarError('El nombre de usuario no puede tener más de 10 caracteres.');
                // Cambiar el color de fondo del campo de nombre de usuario a rojo
                usuario.style.backgroundColor = 'rgba(255, 0, 0, 0.2)';
                return false;
            }

            // Verificar si las contraseñas coinciden
            if (contrasena.value !== confirmarContrasena.value) {
                mostrarError('Las contraseñas no coinciden.');
                // Cambiar el color de fondo de los campos de contraseña a rojo
                contrasena.style.backgroundColor = 'rgba(255, 0, 0, 0.2)';
                confirmarContrasena.style.backgroundColor = 'rgba(255, 0, 0, 0.2)';
                return false;
            }

            return true;
        }

        function mostrarError(mensaje) {
            var mensajeError = document.getElementById('mensaje-error');
            mensajeError.style.display = 'block';
            mensajeError.innerHTML = escapeHTML(mensaje);
        }
    </script>
</head>

<body>
    <!-- element que mostra els missatges d'error per defecete esta en display none per a que no es veigui --> 
    <div id="mensaje-error" class="alert alert-danger" style="display: none;"></div>
    <main class="container d-flex justify-content-center">
    <div class="my-5">
        <h1>Crear cuenta</h1>

        <!-- Formulario -->
        <form method="post" action="/Controladors/procesar_registre.php" id="registre-form" onsubmit="return validarFormulari()">
            <div class="mb-3">
                <label for="nombre" class="form-label">Usuario</label>
                <input type="text" class="form-control" id="usuari" name="usuari" placeholder="Nombre de usuario">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Nombre@ejemplo.com">
            </div>
            <div class="mb-3">
                <label for="contraseña" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="contrasena" name="contrasena" placeholder="Escriba su contraseña">
            </div>
            <div class="mb-3">
                <label for="ccontraseña" class="form-label">Confirmar Contraseña</label>
                <input type="password" class="form-control" id="confirmar_contrasena" name="confirmar_contrasena" placeholder="Escriba su contraseña de nuevo">
            </div>
            <div class="text-center">
            <button type="submit" class="btn btn-primary">Crear cuenta</button>
            </div>
        </form>
    </div>
    </main>

    <?php include 'footer.php'; ?>

    <!-- Scripts de Bootstrap -->
</body>

</html>
