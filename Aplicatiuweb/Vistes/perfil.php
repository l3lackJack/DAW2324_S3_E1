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
    <script>
        function validarFormulario() {
            var nombre = document.getElementById('nombre').value.trim();
            var email = document.getElementById('email').value.trim();

            document.getElementById('nombre').style.backgroundColor = 'white';
            document.getElementById('email').style.backgroundColor = 'white';

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

        function toggleUpdateForm() {
            var updateFormContainer = document.getElementById('updateFormContainer');
            updateFormContainer.style.display = (updateFormContainer.style.display === 'none') ? 'block' : 'none';
        }
    </script>

    <script>
        function toggleDropdown() {
            var dropdownMenu = document.getElementById('dropdownMenu');
            dropdownMenu.classList.toggle('show');
        }

        window.onclick = function(event) {
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
    <div class="row">
        <div class="d-flex flex-column flex-shrink-0 p-3 " style="width: 250px; height: 90vh;">
            <a class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-decoration-none">
            &nbsp;<svg xmlns="http://www.w3.org/2000/svg" height="32" width="32" viewBox="0 0 512 512"><path fill="#ffffff" d="M406.5 399.6C387.4 352.9 341.5 320 288 320H224c-53.5 0-99.4 32.9-118.5 79.6C69.9 362.2 48 311.7 48 256C48 141.1 141.1 48 256 48s208 93.1 208 208c0 55.7-21.9 106.2-57.5 143.6zm-40.1 32.7C334.4 452.4 296.6 464 256 464s-78.4-11.6-110.5-31.7c7.3-36.7 39.7-64.3 78.5-64.3h64c38.8 0 71.2 27.6 78.5 64.3zM256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zm0-272a40 40 0 1 1 0-80 40 40 0 1 1 0 80zm-88-40a88 88 0 1 0 176 0 88 88 0 1 0 -176 0z"/></svg>
            &nbsp;&nbsp;<span class="fs-4">Perfil</span>
            </a>
            <hr>
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                        &nbsp;&nbsp;Mis Datos
                </li>
                <li>
                    <form method="post" action="/Controladors/controlador_perfil.php" onsubmit="return validarFormulario()">
                        <button type="submit" id="cerrar_sesion" name="cerrar_sesion" class="btn btn-secondary">Cerrar Sesión</button>
                    </form>
                </li>
            </ul>
        </div>

        <div class="col m-4">
            <h1>Bienvenido, <?php echo htmlspecialchars($_SESSION['usuario_nombre'], ENT_QUOTES, 'UTF-8'); ?>!</h1>

            <?php
            // Verificar si la variable $_GET['imagen'] está definida
            if (isset($_GET['imagen'])) {
                $ruta_destino = htmlspecialchars(urldecode($_GET['imagen']), ENT_QUOTES, 'UTF-8');
                // Comprobar si la imagen existe
                echo '<img src="/Aplicatiuweb/img/fotos_perfil/' . basename($ruta_destino) . '" alt="Imagen de perfil" height="300" width="300">';
            }
            ?>

            <p>Nombre: <?php echo htmlspecialchars($_SESSION['usuario_nombre'], ENT_QUOTES, 'UTF-8'); ?></p>
            <p>Correo Electrónico: <?php echo htmlspecialchars($_SESSION['usuario_email'], ENT_QUOTES, 'UTF-8'); ?></p>

            <button type="button" class="btn btn-primary" onclick="toggleUpdateForm()">Actualizar Datos</button>

            <div id="updateFormContainer" style="display: none;">
                <h2>Actualizar Datos</h2>
                <form method="post" action="/Controladors/controlador_perfil.php" onsubmit="return validarFormulario()">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo htmlspecialchars($_SESSION['usuario_nombre'], ENT_QUOTES, 'UTF-8'); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($_SESSION['usuario_email'], ENT_QUOTES, 'UTF-8'); ?>">
                    </div>

                    <button type="submit" class="btn btn-primary">Actualizar</button>
                    <button type="submit" id="cerrar_sesion" name="borrar_cuenta" class="btn btn-danger end-0 me-5">Borrar Cuenta</button>

                    <div id="mensaje-error" class="alert alert-danger" style="display: none;"></div>
                </form>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>
</body>

</html>
