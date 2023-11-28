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
    <script>
        // Función para mostrar u ocultar el menú desplegable
        function toggleDropdown() {
            var dropdownMenu = document.getElementById('dropdownMenu');
            dropdownMenu.classList.toggle('show');
        }

        // Cerrar el menú desplegable si el usuario hace clic fuera de él
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
    <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 250px; height: 90vh;">
    <a class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
      <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
      <span class="fs-4">Perfil</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
      <li class="nav-item">
        <a href="/Vistes/perfil.php" class="nav-link text-white">
        &nbsp;<svg xmlns="http://www.w3.org/2000/svg" height="32" width="32" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.--><path fill="#ffffff" d="M406.5 399.6C387.4 352.9 341.5 320 288 320H224c-53.5 0-99.4 32.9-118.5 79.6C69.9 362.2 48 311.7 48 256C48 141.1 141.1 48 256 48s208 93.1 208 208c0 55.7-21.9 106.2-57.5 143.6zm-40.1 32.7C334.4 452.4 296.6 464 256 464s-78.4-11.6-110.5-31.7c7.3-36.7 39.7-64.3 78.5-64.3h64c38.8 0 71.2 27.6 78.5 64.3zM256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zm0-272a40 40 0 1 1 0-80 40 40 0 1 1 0 80zm-88-40a88 88 0 1 0 176 0 88 88 0 1 0 -176 0z"/></svg>
        &nbsp;&nbsp;Datos del Usuario
        </a>
      </li>
      <li>
      <a href="/Vistes/perfil_actualitzarDades.php" class="nav-link active"  aria-current="page">
        <svg xmlns="http://www.w3.org/2000/svg" height="32" width="36" viewBox="0 0 576 512"><!--!Font Awesome Free 6.5.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.--><path fill="#ffffff" d="M528 160V416c0 8.8-7.2 16-16 16H320c0-44.2-35.8-80-80-80H176c-44.2 0-80 35.8-80 80H64c-8.8 0-16-7.2-16-16V160H528zM64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H512c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zM272 256a64 64 0 1 0 -128 0 64 64 0 1 0 128 0zm104-48c-13.3 0-24 10.7-24 24s10.7 24 24 24h80c13.3 0 24-10.7 24-24s-10.7-24-24-24H376zm0 96c-13.3 0-24 10.7-24 24s10.7 24 24 24h80c13.3 0 24-10.7 24-24s-10.7-24-24-24H376z"/></svg>
        &nbsp;&nbsp;Actualizar Datos
        </a>
      </li>
      <li>
        <a href="#" class="nav-link text-white">
        &nbsp;<svg xmlns="http://www.w3.org/2000/svg" height="32" width="28" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.--><path fill="#ffffff" d="M50.7 58.5L0 160H208V32H93.7C75.5 32 58.9 42.3 50.7 58.5zM240 160H448L397.3 58.5C389.1 42.3 372.5 32 354.3 32H240V160zm208 32H0V416c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V192z"/></svg>
        &nbsp;&nbsp;&nbsp;Mis pedidos
        </a>
      </li>
    </ul>
  </div>
        
    </div>
    </div>

    <?php include 'footer.php'; ?>
    
</body>

</html>
