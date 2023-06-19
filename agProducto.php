<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Agregar Producto</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/agg_producto.css">

  <!-- Librerias de sweetalert 2-->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="js/alertas.js"></script>
</head>

<body>
  <?php
  ob_start();
  // traemos el nav de la master_page
  require_once 'master_page.php';
  // validamos si es admin si no lo sacamos por rata
  if (isset($_SESSION['rol']) != "admin") {
    header("Location:login.html");
  }
  ?>
  <div class="container">
    <div class="add-product-container">
      <h2 class="text-center">Agregar Producto</h2>
      <form method="POST" enctype="multipart/form-data">
        <div class="form-group">
          <label for="name">Nombre del producto</label>
          <input type="text" class="form-control" id="name" name="nombre" placeholder="Ingrese el nombre del producto"
            required>
        </div>

        <div class="form-group">
          <label for="price">Precio del producto</label>
          <input type="number" class="form-control" id="price" name="precio"
            placeholder="Ingrese el precio del producto" required>
        </div>
        <!-- <div class="form-group">
          <label for="size">Talla</label>
          <input type="text" class="form-control" id="size" name="talla" placeholder="Ingrese la talla del producto"
            required>
        </div> -->

        <div class="form-group">
          <label for="size">Talla del producto</label><br>
          <div class="form-check-inline">
            <input type="checkbox" class="form-check-input" id="sizeXG" name="talla" value="XG">
            <label class="form-check-label" for="sizeXG">XG</label>
          </div>
          <div class="form-check-inline">
            <input type="checkbox" class="form-check-input" id="sizeG" name="talla" value="G">
            <label class="form-check-label" for="sizeG">G</label>
          </div>
          <div class="form-check-inline">
            <input type="checkbox" class="form-check-input" id="sizeM" name="talla" value="M">
            <label class="form-check-label" for="sizeM">M</label>
          </div>
        </div>
        <div class="form-group">
          <label for="color">Color</label>
          <input type="color" id="color" name="color" required>
        </div>
        <div class="form-group">
          <label for="image">Imagen del producto</label>
          <input type="file" class="form-control-file" id="imagen_producto" name="imagen_producto" required>
        </div>
        <button type="submit" name="subir_producto" class="btn btn-primary btn-block">Agregar Producto</button>
      </form>
    </div>
  </div>
</body>

</html>

<?php
require_once 'conexion.php';

if (isset($_POST['subir_producto'])) {
  // Obtener los valores de los campos del formulario
  $nombre = $_POST['nombre'];
  $precio = $_POST['precio'];
  $talla = $_POST['talla'];
  $color = $_POST['color'];
  $imagen_producto = $_FILES['imagen_producto'];

  // Ruta de la carpeta donde se guardarán las imágenes
  $directorio_imagenes = 'D:\xampp\htdocs\StyleSpectrum\imgProductos\\';

  // Verificar si los campos no están vacíos
  if (!empty($nombre) && !empty($precio) && !empty($talla) && !empty($color) && !empty($imagen_producto)) {
    // Obtener el nombre y la extensión del archivo
    $nombre_archivo = $imagen_producto['name'];
    $extension_archivo = pathinfo($nombre_archivo, PATHINFO_EXTENSION);

    // Generar un nombre único para el archivo combinando uniqid() y la extensión del archivo original
    $nombre_unico = uniqid() . '.' . $extension_archivo;

    // Ruta completa del archivo en la carpeta de imágenes
    $ruta_imagen = $directorio_imagenes . $nombre_unico;

    // Mover el archivo a la carpeta de imágenes
    move_uploaded_file($imagen_producto['tmp_name'], $ruta_imagen);

    // Realizar las operaciones de registro en la base de datos
    $sql = $cnnPDO->prepare("INSERT INTO productos (nombre, precio, talla, color) VALUES (:nombre, :precio, :talla, :color)");

    $sql->bindParam(':nombre', $nombre);
    $sql->bindParam(':precio', $precio);
    $sql->bindParam(':talla', $talla);
    $sql->bindParam(':color', $color);

    $sql->execute();
    unset($sql);

    // Redireccionar a otra página después del registro exitoso
    header("location:agProducto.php?mensaje2=Se registró el producto exitosamente");

    exit();
  } else {
    echo "Por favor, completa todos los campos.";
  }
}
ob_end_flush();
?>