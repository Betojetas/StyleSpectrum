<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>inicio</title>
</head>

<body>
  <?php require_once 'master_page.php'; ?>

  <div class="container">
    <?php
    require_once 'conexion.php';

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

      // Si el contador es divisible por 4, comenzar una nueva fila
      if ($contador % 4 === 0) {
        echo '<div class="row">';
      }

      // Generar la estructura de la card con los datos del producto
      echo '<div class="col-md-3">';
      echo '<div class="card">';
      echo '<img class="card-img-top" src="imgProductos/' . $codigo_imagen . '" alt="Imagen del producto">';
      echo '<div class="card-body">';
      echo '<h5 class="card-title">' . $nombre . '</h5>';
      echo '<p class="card-text">Precio: $' . $precio . '</p>';
      echo '<p class="card-text">Talla: ' . $talla . '</p>';
      echo '</div>';
      echo '</div>';
      echo '</div>';

      // Incrementar el contador
      $contador++;

      // Si el contador es divisible por 4 o se han generado todas las cards, cerrar la fila
      if ($contador % 4 === 0 || $contador === count($productos)) {
        echo '</div>';
      }
    }
    ?>


  </div>
</body>

</html>