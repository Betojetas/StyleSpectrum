<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Productos</title>
    <link rel="stylesheet" href="css/actproducto.css">
    <!-- Librerias de sweetalert 2-->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="js/alertas.js"></script>

</head>

<body>

    <?php require_once 'master_page.php'; ?>
    <div class="container">
        <div class="row">
            <?php
            require_once 'conexion.php';

            // Verificar si se ha enviado el formulario con la ID del producto
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_producto'])) {
                $id_producto = $_POST['id_producto'];
                // Realizar las operaciones necesarias con la ID del producto
            }

            // Realizar la consulta para obtener los datos de los productos
            $sql = $cnnPDO->prepare("SELECT * FROM productos");
            $sql->execute();
            $productos = $sql->fetchAll(PDO::FETCH_ASSOC);

            // Inicializar un contador
            $contador = 0;

            // Generar las cards para cada producto
            foreach ($productos as $producto) {
                $nombre = $producto['nombre'];
                $precio = $producto['precio'];
                $talla = $producto['talla'];
                $color = $producto['color'];
                $codigo_imagen = $producto['codigo_imagen'];
                $id_producto = $producto['id_producto'];
                ?>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-image">
                            <a href="detalle_producto.php?id_producto=<?php echo $id_producto; ?>&codigo_imagen=<?php echo $codigo_imagen; ?>&nombre=<?php echo $nombre; ?>&precio=<?php echo $precio; ?>&carrito=<?php echo empty($carrito) ? '' : $carritoBase64; ?>&categoria=<?php echo $categoria; ?>"
                                style="text-decoration: none; color: inherit;">
                                <img class="card-img-top" src="imgProductos/<?php echo $codigo_imagen; ?>"
                                    alt="Imagen del producto">
                                <div class="card-overlay">
                                    <div class="card-overlay-text">
                                        Precio: $
                                        <?php echo $precio; ?><br>
                                        Descripción:
                                        <?php echo $nombre; ?>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="update-btn">
                            <a href="actualizarProducto.php?id_producto=<?php echo $id_producto; ?>">
                                <i class="fas fa-sync-alt"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <?php
            }
            ?>
        </div>
    </div>

</body>

</html>