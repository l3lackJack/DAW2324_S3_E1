<?php session_start();
if(!isset($_SESSION['usuario_nombre'])) {
    header("Location: /Vistes/login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include 'navbar.php';?>
<head>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
<script>
        function validarFormulario() {
            var nombre = document.getElementById('nombre').value.trim();
            var nombre = document.getElementById('username').value.trim();
            var email = document.getElementById('email').value.trim();

            document.getElementById('nombre').style.backgroundColor = 'white';
            document.getElementById('username').style.backgroundColor = 'white';
            document.getElementById('email').style.backgroundColor = 'white';

            if (nombre === '') {
                mostrarError('Por favor, complete el campo Nombre.');
                document.getElementById('nombre').style.backgroundColor = 'rgba(255, 0, 0, 0.2)';
                document.getElementById('username').style.backgroundColor = 'rgba(255, 0, 0, 0.2)';
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
        function toggleUpdateForm() {
            var overlay = document.getElementById('overlay');
            var updateFormContainer = document.getElementById('updateFormContainer');
            overlay.style.display = 'block';
            updateFormContainer.style.display = 'block';
        }
        function cerrarUpdateForm() {
            var overlay = document.getElementById('overlay');
            var updateFormContainer = document.getElementById('updateFormContainer');
            overlay.style.display = 'none';
            updateFormContainer.style.display = 'none';
        }
        function toggleDropdown() {
            var dropdownMenu = document.getElementById('dropdownMenu');
            dropdownMenu.classList.toggle('show');
        }
        window.onclick = function (event) {
            if (!event.target.matches('.dropdown-toggle')) {
                var dropdowns = document.getElementsByClassName('dropdown-menu');
                for (var i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        }
    </script>
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-content">
            <div class="perfil-container">
                <?php include 'llegirInicialNom.php'; ?> 
                <div class="mi-perfil">
                   <p>Bienvenido, <?php echo htmlspecialchars($_SESSION['usuario_nombre'], ENT_QUOTES, 'UTF-8'); ?>!</p>
                </div>
            </div>
            <hr>
            <ul class="nav nav-pills flex-column">
                <h4>Mi Cuenta</h4>
                <li class="nav-item">
                    <a href="#mis-datos">Mis Datos</a>
                    <a href="">Mis Pedidos</a>
                    <a href="">Mis Direcciones</a>
                </li>
            </ul>
            <hr>
            <ul class="nav nav-pills flex-column">
                <h4>Mis Pedidos</h4>
                <li class="nav-item">
                    <a href="">Pedidos</a>
                    <a href="">Pedidos cancelados</a>
                </li>
            </ul>
        </div>
    </div>

        <div class="container-perfil">
        <div class="content">
            <h1>Mis Datos</h1>
            <div class="profile-container">
                <p>Nombre: <?php echo htmlspecialchars($_SESSION['usuario_nombre'], ENT_QUOTES, 'UTF-8'); ?></p>
                <p>Apellido: <?php echo htmlspecialchars($_SESSION['usuario_apellidos'], ENT_QUOTES, 'UTF-8'); ?></p>
                <p>Nombre de Usuario: <?php echo htmlspecialchars($_SESSION['usuario_username'] , ENT_QUOTES, 'UTF-8'); ?></p>
                <p>Correo Electrónico: <?php echo htmlspecialchars($_SESSION['usuario_email'], ENT_QUOTES, 'UTF-8'); ?></p>

                <button type="button" class="glow-on-hover" onclick="toggleUpdateForm()">Actualizar Datos</button>
                <button type="submit" id="cerrar_sesion" name="borrar_cuenta" class="borrar_cuenta">Borrar Cuenta</button>

                <div class="overlay" id="overlay" onclick="cerrarUpdateForm()"></div>
                <div class="update-datos" id="updateFormContainer" style="display: none;">
                    <h2>Actualizar Datos</h2>
                    <h2>Configuración de la Cuenta</h2>
                    <form method="post" action="/Controladors/controlador_perfil.php" onsubmit="return validarFormulario()">
                        <h5>Actualizar Datos</h5>
                        <div class="mb-3 justify-content-center">
                            <label for="nombre" class="form-label">Nombre de Usuario</label>
                            <input type="text" class="form-control" id="username" name="username" value="<?php echo htmlspecialchars($_SESSION['usuario_username'], ENT_QUOTES, 'UTF-8'); ?>">
                        </div>
                        <div class="mb-3 justify-content-center">
                            <label for="email" class="form-label">Correo Electrónico</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($_SESSION['usuario_email'], ENT_QUOTES, 'UTF-8'); ?>">
                        </div>

                        <button type="submit" class="btn btn-primary update">Actualizar</button>
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                        <button type="submit" id="cerrar_sesion" name="borrar_cuenta" class="btn btn-danger end-0 me-5">Borrar Cuenta</button>

                        <div id="mensaje-error" class="alert alert-danger" style="display: none;"></div>
                    </form>
                </div>
            </div>

        </div>
        <div class="content-1">
            <h2>Pedidos en curso</h2>
            <div class="profile-container-2">
                <h3>0</h3>
                <button class="pedidos">Mas información</button>
            </div>
            <hr>
            <h2>Total pedidos</h2>
            <div class="profile-container-2">
                <h3>0</h3>
                <button class="pedidos">Mas información</button>
            </div>
        </div>

        </div>
        </div>

    <?php include 'footer.php'; ?>
</body>
</html>