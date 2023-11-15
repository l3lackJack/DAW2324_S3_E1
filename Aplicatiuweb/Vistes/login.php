<?php
session_start();
if(isset($_SESSION['usuario_nombre'])) {
    // La sesión está iniciada, redirigir a la página de perfil o a la página que desees
    header("Location: /Vistes/perfil.php");
    exit();
}?>

<!DOCTYPE html>
<html lang="en">
<?php include 'navbar.php'; ?>
<head>
    <script> //Script validació de camps al formulari
        function validarInicioSesion() {
            var email = document.getElementById('email').value.trim();
            var contrasena = document.getElementById('contrasena').value.trim();

            // Restablecer el color de fondo
            document.getElementById('email').style.backgroundColor = '';
            document.getElementById('contrasena').style.backgroundColor = '';

            // Validar campos en caso de no estar rellenos se ponen rojos
            if (email === '' || contrasena === '') {
                mostrarError('Por favor, complete todos los campos.');
                if (email === '') {
                    document.getElementById('email').style.backgroundColor = 'rgba(255, 0, 0, 0.2)';
                }
                if (contrasena === '') {
                    document.getElementById('contrasena').style.backgroundColor = 'rgba(255, 0, 0, 0.2)';
                }
                return false;
            }

            return true;
        }

        function mostrarError(mensaje) { //misatge d'error que mostrarem per pantalla
            var mensajeError = document.getElementById('mensaje-error');
            mensajeError.style.display = 'block';
            mensajeError.innerHTML = mensaje;
        }
    </script>
</head>

<body>
    <!-- element que mostrarà el missatge d'error -->
    <div id="mensaje-error" class="alert alert-danger" style="display: <?php echo isset($_GET['error']) ? 'block' : 'none'; ?>;">
        <?php echo isset($_GET['error']) ? 'Usuario o contraseña incorrectos.' : ''; ?>
    </div>
    <div class="container mt-5">
        <h1>Iniciar Sesión</h1>

        <!-- Formulario de Inicio de Sesión -->
        <form method="post" action="/Controladors/procesar_login.php" onsubmit="return validarInicioSesion()"> <!-- validació dels camps gràcies al script anterior -->
            <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="nombre@ejemplo.com">
            </div>
            <div class="mb-3">
                <label for="contrasena" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="contrasena" name="contrasena" placeholder="escriba su contraseña">
            </div>

            <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
            <a href="registre.php" class="btn btn-secondary">Registrarse</a>
        </form>
    </div>
    
    <?php include 'footer.php'; ?>
</body>

</html>
