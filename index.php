<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>inicio</title>
  <link rel="stylesheet" href="css/index.css">
</head>

<body>
  <?php require_once 'master_page.php'; ?>

  <div class="container">
    <div class="row">
      <?php
      require_once 'conexion.php';

      // Realizar la consulta para obtener los datos de los productos
      $sql = $cnnPDO->prepare("SELECT * FROM productos");
      $sql->execute();
      $productos = $sql->fetchAll(PDO::FETCH_ASSOC);


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
            <img class="card-img-top" src="imgProductos/<?php echo $codigo_imagen; ?>" alt="Imagen del producto">
            <div class="card-body">
              <h5 class="card-title">
                <?php echo $nombre; ?>
              </h5>
              <p class="card-text">Precio: $
                <?php echo $precio; ?>
              </p>
              <p class="card-text">Talla:
                <?php echo $talla; ?>
              </p>
              <button class="btn btn-primary add-to-cart" value="<?php echo $id_producto; ?>"
                data-product-id="<?php echo $id_producto; ?>">Agregar al
                carrito</button>
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