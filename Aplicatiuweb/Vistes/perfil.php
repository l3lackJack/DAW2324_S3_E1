<?php session_start(); //inciar sessió per usar les variables de sessió
if(!isset($_SESSION['usuario_nombre'])) { //en cas que no s'ha iniciat sessió encara redirigir al login
    header("Location: /Vistes/login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<?php include 'navbar.php';?>
<head>
    <script> //validacions javascript per al formulari
        function validarFormulario() {
            var nombre = document.getElementById('nombre').value.trim();
            var email = document.getElementById('email').value.trim();

            // Restablecer colores de fondo a blanco
            document.getElementById('nombre').style.backgroundColor = 'white';
            document.getElementById('email').style.backgroundColor = 'white';

            // Validar campos
            if (nombre === '') {
                mostrarError('Por favor, complete el campo Nombre.');
                document.getElementById('nombre').style.backgroundColor = 'rgba(255, 0, 0, 0.2)';
                return false;
            }

            if (email === '') {
                mostrarError('Por favor, complete el campo Correo Electrónico.');
                document.getElementById('email').style.backgroundColor = 'rgba(255, 0, 0, 0.2)';
                return false;
            }

            return true;
        }

        function mostrarError(mensaje) {
            var mensajeError = document.getElementById('mensaje-error');
            mensajeError.style.display = 'block';
            mensajeError.innerHTML = escapeHTML(mensaje);
        }

        function escapeHTML(str) {
            var div = document.createElement('div');
            div.appendChild(document.createTextNode(str));
            return div.innerHTML;
        }
    </script>
</head>

<body>
    <div class="container mt-5"> <!-- mostrar per pantalla al usuari el seu nom id i email (modificable) --> 
    <div class="row">
        <div class="col">
        <h1>Bienvenido, <?php echo htmlspecialchars($_SESSION['usuario_nombre'], ENT_QUOTES, 'UTF-8'); ?>!</h1>
            <form action="upload.php" method="post" enctype="multipart/form-data">
                <label for="profileImage">Selecciona una nueva foto de perfil:</label>
                <input type="file" name="profileImage" id="profileImage" accept="image/*">
                <input type="submit" value="Actualizar Foto de Perfil">
            </form>
            <!-- Mostrar la imagen actual del perfil -->
            <img src="mostrar_imagen.php" alt="Foto de perfil">
        <p>ID de Usuario: <?php echo htmlspecialchars($_SESSION['usuario_id'], ENT_QUOTES, 'UTF-8'); ?></p>
        <p>Correo Electrónico: <?php echo htmlspecialchars($_SESSION['usuario_email'], ENT_QUOTES, 'UTF-8'); ?></p>
        </div> 
        <div class="col">    
            <!-- Formulario de actualización -->
            <h2>Actualizar Datos</h2>
                
                    <form method="post" action="/Controladors/controlador_perfil.php" onsubmit="return validarFormulario()"> <!-- en enviar formulari realitzar el script de validació -->
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label> 
                            <!-- evitar inserció codi -->
                            <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo htmlspecialchars($_SESSION['usuario_nombre'], ENT_QUOTES, 'UTF-8'); ?>">  
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo Electrónico</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($_SESSION['usuario_email'], ENT_QUOTES, 'UTF-8'); ?>">
                        </div>
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                        <button type="submit" id="cerrar_sesion" name="cerrar_sesion" class="btn btn-secondary">Cerrar Sesión</button>
                        <button type="submit" id="cerrar_sesion" name="borrar_cuenta" class="btn btn-danger position-absolute end-0 me-5">Borrar Cuenta</button>

                        <div id="mensaje-error" class="alert alert-danger" style="display: none;"></div>
                    </form>
                </div>
            </div>
    </div>
    </div>

    <?php include 'footer.php'; ?>
    
</body>

</html>
