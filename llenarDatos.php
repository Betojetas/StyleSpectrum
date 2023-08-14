<!DOCTYPE html>
<html>

<head>
    <title>Formulario de la Tienda de Ropa Elegante</title>
    <link rel="stylesheet" href="css/llenar_datos.css">
</head>

<body>
    <?php require_once 'master_page.php'; ?>
    <div class="cart-item">
        <form method="POST">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required placeholder="Nombre">

            <label for="apellido">Apellido:</label>
            <input type="text" id="apellido" name="apellido" required placeholder="Apellido">

            <label for="telefono">Número de Teléfono:</label>
            <input type="text" id="telefono" name="telefono" required placeholder="Número de Teléfono">

            <label for="direccion">Dirección:</label>
            <input type="text" id="direccion" name="direccion" required
                placeholder="Direccion-Calle y Numero (ejemplo: calle6 numero 230#)">

            <label for="referencias">Referencias:</label>
            <input type="text" id="referencias" name="referencias"
                placeholder="Referencias-Negocio en la esquina, porton negro, casa color verde">

            <div class="input-group">
                <div style="flex: 1;">
                    <label for="codigo-postal">Código Postal:</label>
                    <input type="text" id="codigo-postal" name="codigo_postal" required
                        placeholder="Codigo Postal- Ejemplo 25015">
                </div>
                <div style="flex: 1;">
                    <label for="estado">Estado:</label>
                    <input type="text" id="estado" name="estado" required placeholder="Estado">
                </div>
            </div>

            <label for="ciudad">Ciudad:</label>
            <input type="text" id="ciudad" name="ciudad" required placeholder="Ciudad"><br>

            <input type="submit" name="comprar" value="comprar">
        </form>

    </div>

    <script>
        function seguirComprando() {
            // Obtener los parámetros de la URL
            const urlParams = new URLSearchParams(window.location.search);

            // Obtener el valor de la categoría de los parámetros de la URL
            const categoria = urlParams.get('categoria');

            // Obtener el valor del carrito de los parámetros de la URL
            const carrito = urlParams.get('carrito');

            // Construir la URL con los parámetros para llenarDatos.php
            const url = `index.php?categoria=${categoria}&carrito=${carrito}`;

            // Redireccionar a la página de llenarDatos.php con los parámetros en la URL
            window.location.href = url;
        }
    </script>
</body>

</html>

<?php
ob_start();
require_once 'conexion.php';

if (isset($_POST['comprar'])) {
    // Recuperar la ID de usuario de la sesión
    $id_usuario = $_SESSION["id_usuario"];

    // Recuperar los datos del formulario
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $telefono = $_POST["telefono"];
    $direccion = $_POST["direccion"];
    $referencias = $_POST["referencias"];
    $codigo_postal = $_POST["codigo_postal"];
    $estado = $_POST["estado"];
    $ciudad = $_POST["ciudad"];

    $fecha = date("Y-m-d"); // Fecha actual
    $status = "Pendiente"; // Estado inicial del pedido

    // Preparar la consulta SQL para insertar el pedido
    $sql = $cnnPDO->prepare("INSERT INTO Pedidos (id_usuario, fecha, status, nombre, apellido, telefono, direccion, referencias, codigo_postal, estado, ciudad) 
                            VALUES (:id_usuario, :fecha, :status, :nombre, :apellido, :telefono, :direccion, :referencias, :codigo_postal, :estado, :ciudad)");

    // Enlazar los parámetros
    $sql->bindParam(':id_usuario', $id_usuario);
    $sql->bindParam(':status', $status);
    $sql->bindParam(':nombre', $nombre);
    $sql->bindParam(':apellido', $apellido);
    $sql->bindParam(':fecha', $fecha);
    $sql->bindParam(':telefono', $telefono);
    $sql->bindParam(':direccion', $direccion);
    $sql->bindParam(':referencias', $referencias);
    $sql->bindParam(':codigo_postal', $codigo_postal);
    $sql->bindParam(':estado', $estado);
    $sql->bindParam(':ciudad', $ciudad);

    // Execute the query
    if ($sql->execute()) {
        echo "<script>
        // Espera 5 segundos y luego redirige
        setTimeout(function() {
            window.location.href = 'logout.php';
        }, 1); 
    </script>";
        exit();
    } else {
        echo "Error al insertar el registro: " . $sql->errorInfo()[2];
    }
}
ob_end_flush();
?>