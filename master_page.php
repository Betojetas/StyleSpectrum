<?php
session_start();
require_once 'conexion.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <!-- Agrega los enlaces a los archivos CSS de Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
    <!-- estilos de la master page -->
    <link rel="stylesheet" href="css/master_page.css">
</head>

<body>
    <?php
    // validamos si es admin si no lo sacamos por rata
    if ($_SESSION['rol'] === "admin") {
        ?>
        <!-- Navbar admin -->
        <nav class="navbar navbar-expand-md navbar-custom">
            <div class="container">
                <!-- Logo de la empresa -->
                <a class="navbar-brand" href="admin.php">
                    <img src="img/logo.jpeg" width="150" />
                </a>
                <!-- Botón para colapsar el navbar en pantallas pequeñas -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!-- Contenido del navbar -->
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="admin.php">Inicio</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Productos
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="agProducto.php">Agregar productos</a>
                                <a class="dropdown-item" href="eliProducto.php">Eliminar productos</a>
                                <a class="dropdown-item" href="actProducto.php">Actualizar productos</a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="inventario.php">Inventario</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="pedidos.php">Pedidos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="usuarios.php">Usuarios</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="configuracion.php">Configuración</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-shopping-cart cart-icon"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-user-circle profile-logo"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <br>
        <br>
        <br>
    <?php } else {
        if (!isset($_SESSION['carrito'])) {
            $_SESSION['carrito'] = array();
        }

        $cantidad_carrito = count($_SESSION['carrito']); ?>
        <!-- Navbar usuario -->
        <nav class="navbar navbar-expand-md navbar-custom">
            <div class="container">
                <!-- Logo de la empresa -->
                <a class="navbar-brand" href="index.php">
                    <img src="img/logo.jpeg" width="150" />
                </a>
                <!-- Botón para colapsar el navbar en pantallas pequeñas -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!-- Contenido del navbar -->
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Hombre</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Mujer</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Ofertas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contacto</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" onclick="irAComprarProducto()">
                                <i class=" fas fa-shopping-cart cart-icon"></i>
                                <span id="cantidad-carrito">0</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <img src="img/perfil.png" class="profile-logo" />
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    <?php } ?>
    <br>
    <!-- Agrega los enlaces a los archivos JS de Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <!-- Agrega los enlaces a los archivos JavaScript de Bootstrap -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <!-- Agrega los enlaces a los archivos JavaScript de Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>

</body>

</html>