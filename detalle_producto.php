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
                <input type="radio" name="talla" value="M" id="talla-m"  required>
                <label for="talla-m">M</label>
                <input type="radio" name="talla" value="L" id="talla-l" required>
                <label for="talla-l">L</label>
            </div>
            <br>';

        echo '<button onclick="agregarAlCarrito(' . $id_producto . ', \'' . $nombre . '\', ' . $precio . ', \'' . $codigo_imagen . '\')">agregar al carrito</button><br><br>';


        echo '</div>';


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

<script>
    // Crea una alerta personalizada con estilo
    function alerta(mensaje) {
        const alertaDiv = document.createElement("div");
        alertaDiv.classList.add("alerta");
        alertaDiv.textContent = mensaje;

        const cuerpo = document.querySelector("body");
        cuerpo.appendChild(alertaDiv);

        // Elimina la alerta después de unos segundos (ajusta el tiempo en milisegundos)
        setTimeout(() => {
            cuerpo.removeChild(alertaDiv);
        }, 3000); // 3000 ms = 3 segundos
    }
    //carrito
    let carrito = [];
    let total = 0;

    function agregarAlCarrito(id_producto, nombre, precio, codigo_imagen) {
        const tallaSeleccionada = document.querySelector('input[name="talla"]:checked');
        if (!tallaSeleccionada) {
            alerta("Por favor, selecciona una talla antes de agregar al carrito.");
            return; // La función se detiene si no hay una talla seleccionada.
        }

        const talla = tallaSeleccionada.value; // Obtener el valor de la talla seleccionada o cadena vacía si no hay talla seleccionada

        // Buscar el producto en el carrito
        const productoEnCarrito = carrito.find((item) => item.id_producto === id_producto && item.talla === talla);
        if (productoEnCarrito) {
            if (productoEnCarrito.cantidad === 10) {
                alerta("No se pueden agregar más de 10 unidades del mismo producto.");
                return;
            }

            // Si el producto ya está en el carrito, aumentar la cantidad y actualizar el precio
            productoEnCarrito.cantidad++;
            productoEnCarrito.precioTotal += precio;
        } else {
            // Si el producto no está en el carrito, agregarlo con cantidad, precio, e incluir la talla, el código de la imagen y el ID del producto
            carrito.push({ id_producto, nombre, precio, talla, codigo_imagen, cantidad: 1, precioTotal: precio });
        }

        total += precio;
        mostrarCarrito();
        mostrarCarritoPorUnTiempo();


        var cantidadActual = parseInt(document.getElementById("cantidad-carrito").innerText);
        document.getElementById("cantidad-carrito").innerText = cantidadActual + 1;
    }
    function mostrarCarrito() {
        const listaCarrito = document.getElementById("lista-carrito");
        const totalCarrito = document.getElementById("total-carrito");
        const numProductos = carrito.length;

        listaCarrito.innerHTML = "";

        if (numProductos === 0) {
            listaCarrito.textContent = "El carrito está vacío.";
            totalCarrito.textContent = "$0";
        } else {
            let total = 0;
            for (const item of carrito) {
                const li = document.createElement("li");
                li.textContent = `${item.nombre} - Talla: ${item.talla} - Cantidad: ${item.cantidad}`; // Agregar la talla a la lista
                listaCarrito.appendChild(li);
                total += item.precioTotal;
            }
            totalCarrito.textContent = `${total}`;
        }

        const carritoContainer = document.getElementById("carrito-container");
        // Remover la clase "nuevo-producto" para reiniciar la animación
        carritoContainer.classList.remove("nuevo-producto");
        // Agregar la clase "nuevo-producto" para iniciar la animación
        carritoContainer.classList.add("nuevo-producto");
        // Eliminar la clase "nuevo-producto" después de 1 segundo para que no se repita la animación
        setTimeout(() => {
            carritoContainer.classList.remove("nuevo-producto");
        }, 7000);


    }

    function mostrarCarritoPorUnTiempo() {
        const carritoContainer = document.getElementById("carrito-container");
        carritoContainer.style.display = "block"; // Mostrar el carrito

        setTimeout(() => {
            carritoContainer.style.display = "none"; // Ocultar el carrito después de 2 segundos (ajústalo según tus necesidades)
        }, 7000); // 7000 milisegundos = 7 segundos (ajústalo según tus necesidades)
    }


    function irAComprarProducto() {
        // Obtener el carrito en formato JSON
        const carritoJSON = JSON.stringify(carrito);

        // Codificar el carrito en base64 para que la URL no tenga problemas con caracteres especiales
        const carritoBase64 = btoa(carritoJSON);

        // Redireccionar a la página de comprar_producto.php con el carrito como parámetro en la URL
        window.location.href = 'comprar_producto.php?carrito=' + carritoBase64;
    }


</script>
<?php
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = array();
}

$cantidad_carrito = count($_SESSION['carrito']);

// Mostrar la cantidad de productos en el carrito
echo '<script>document.getElementById("cantidad-carrito").innerText = ' . $cantidad_carrito . ';</script>';

?>

</html>