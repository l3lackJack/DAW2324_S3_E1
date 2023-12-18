<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Virtual Vision</title>
    <link rel="stylesheet" href="/node_modules/bootstrap/dist/css/bootstrap.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-primary">
        <div class="container">
            <a class="navbar-brand text-white " href="/"><b>VirtualVision</b></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="/Vistes/productes.php">Productos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="/Vistes/imagePrompt.php">Generar Imagen</a>
                    </li>

                    <?php
                    // Verificar si la variable $mostrarSoloInicioSesion está definida y es verdadera
                    $mostrarSoloInicioSesion = isset($mostrarSoloInicioSesion) && $mostrarSoloInicioSesion;
                    ?>

                   
                </ul>
                
        <div class="nav-item dropdown ms-auto">
            <?php
            $saludo = '';
            if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']) {
                $saludo = 'Hola, ' . $_SESSION['usuario_nombre']; // Reemplaza 'nombre_usuario' con el nombre de la clave real en tu sesión
            } else {
                $saludo = 'Mi cuenta';
            }
            ?>
            <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <?php echo $saludo; ?>
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']) : ?>
                    <li><a class="dropdown-item" href="/Vistes/perfil.php">Perfil</a></li>
                    <li><a class="dropdown-item" href="/Vistes/perfil_actualitzarDades.php">Configuración</a></li>
                    <li>
                        <form method="post" action="/Controladors/controlador_perfil.php" onsubmit="return validarFormulario()">
                            <button type="submit" id="cerrar_sesion" name="cerrar_sesion" class="btn text-danger">Cerrar Sesión</button>
                        </form>
                    </li>
                <?php else : ?>
                    <li><a class="dropdown-item" href="/Vistes/login.php">Iniciar Sesión</a></li>
                    <li><a class="dropdown-item" href="/Vistes/registre.php">Registrarse</a></li>
                <?php endif; ?>
            </ul>
        </div>  


            </div>
        </div>
    </nav>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../javascript/sessio.js"></script>
</body>

</html>
