<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <link rel="stylesheet" href="css/detalle_producto.css">
    <style>
        /* Estilos para la alerta bonita */
        .alerta {
            position: fixed;
            top: -100px;
            /* Inicialmente, la alerta estará fuera de la pantalla */
            left: 50%;
            transform: translateX(-50%);
            background-color: #FF0000;
            /* Fondo rojo */
            color: #FFFFFF;
            /* Letras blancas */
            padding: 12px 24px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            font-size: 16px;
            z-index: 9999;
            animation: mostrarAlerta 1s forwards;
            /* Animación para mostrar la alerta */
        }

        /* Animación para mostrar la alerta */
        @keyframes mostrarAlerta {
            0% {
                top: -100px;
            }

            100% {
                top: 30px;
            }

            /* La posición final en la que se mostrará la alerta */
        }
    </style>
</head>

<body>
    <?php require_once 'master_page.php'; ?>
    <?php

    if (isset($_GET['codigo_imagen']) && $_GET['id_producto'] && $_GET['nombre'] && $_GET['precio']) {
        $codigo_imagen = $_GET['codigo_imagen'];
        $id_producto = $_GET['id_producto'];
        $nombre = $_GET['nombre'];
        $precio = $_GET['precio'];
        echo '<div class="product-image">';
        echo '<img src="imgProductos/' . $codigo_imagen . '" alt="Imagen del producto">';
        echo '</div>';
        echo '<div class="info">
        <div class="tallas">
          <h4>Selecciona la talla</h4>
          <input type="radio" name="talla" value="S" id="talla-s" required>
          <label for="talla-s">S</label>
          <input type="radio" name="talla" value="M" id="talla-m" required>
          <label for="talla-m">M</label>
          <input type="radio" name="talla" value="L" id="talla-l" required>
          <label for="talla-l">L</label>
          <input type="radio" name="talla" value="XL" id="talla-xl" required>
          <label for="talla-xl">XL</label>
        </div><br>';
        echo '<button onclick="agregarAlCarrito(' . $id_producto . ', \'' . $nombre . '\', ' . $precio . ', \'' . $codigo_imagen . '\')">agregar al carrito</button><br><br>';
        echo '</div>';



        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // Obtener los datos JSON enviados desde el lado del cliente
            $jsonData = file_get_contents('php://input');
            $item = json_decode($jsonData, true);

            // Agregar el artículo al carrito en la sesión
            $_SESSION['carrito'][] = $item;

            // Devolver la cantidad actualizada del carrito
            $cantidad_carrito = count($_SESSION['carrito']);
            echo $cantidad_carrito;


            // Mostrar la cantidad de productos en el carrito
            echo '<script>document.getElementById("cantidad-carrito").innerText = ' . $cantidad_carrito . ';</script>';
        }
        echo '<div class="carrito" id="carrito-container" style="display: none;">
        <br>
        <h2>Productos agregados</h2>
        <ul id="lista-carrito">
        </ul>
        <p>Total: $<span id="total-carrito">0</span></p>
        </div>';
    }
    ?>
</body>


<script src="js/carrito.js"></script>
<script src="js/funcionesCarrito.js"></script>
<?php


?>

</html>