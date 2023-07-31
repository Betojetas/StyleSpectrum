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
        <form action="tu_archivo_php.php" method="post">
            <div class="tallas">
                <h4>Selecciona la talla</h4>
                <input type="radio" name="talla" value="S" id="talla-s" required>
                <label for="talla-s">S</label>
                <input type="radio" name="talla" value="M" id="talla-m"  required>
                <label for="talla-m">M</label>
                <input type="radio" name="talla" value="L" id="talla-l" required>
                <label for="talla-l">L</label>
            </div>
            <br>
            <!-- Otros elementos del formulario y botón de envío si es necesario -->
        </form>';

        echo '<button onclick="agregarAlCarrito(\'' . $nombre . '\',' . $precio . ')">agregar al carrito</button>';

        echo '</div>';

        echo '<div class="carrito" id="carrito-container" style="display: none;">
        <br>
        <h2>Productos agregados</h2>
        <ul id="lista-carrito">
        </ul>
        <p>Total: $<span id="total-carrito">0</span></p>
    </div>
    ';

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

    let carrito = [];
    let total = 0;

    function agregarAlCarrito(nombre, precio) {
        const tallaSeleccionada = document.querySelector('input[name="talla"]:checked');
        if (!tallaSeleccionada) {

            alerta("Por favor, selecciona una talla antes de agregar al carrito.");
            return; // La función se detiene si no hay una talla seleccionada.
        }
        total += precio;
        mostrarCarrito();
        mostrarCarritoPorUnTiempo();

        // Buscar el producto en el carrito
        const productoEnCarrito = carrito.find((item) => item.nombre === nombre);
        if (productoEnCarrito) {
            if (productoEnCarrito.cantidad === 10) {
                alerta("No se pueden agregar más de 10 unidades del mismo producto.");
                return;
            }

            // Si el producto ya está en el carrito, aumentar la cantidad y actualizar el precio
            productoEnCarrito.cantidad++;
            productoEnCarrito.precioTotal += precio;
        } else {
            // Si el producto no está en el carrito, agregarlo con cantidad y precio inicial
            carrito.push({ nombre, precio, cantidad: 1, precioTotal: precio });
        }

        total += precio;
        mostrarCarrito();
        mostrarCarritoPorUnTiempo();
    }

    function mostrarCarritoPorUnTiempo() {
        const carritoContainer = document.getElementById("carrito-container");
        carritoContainer.style.display = "block"; // Mostrar el carrito

        setTimeout(() => {
            carritoContainer.style.display = "none"; // Ocultar el carrito después de 2 segundos (ajústalo según tus necesidades)
        }, 7000); // 7000 milisegundos = 7 segundos (ajústalo según tus necesidades)
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
                li.textContent = `${item.nombre} - Cantidad: ${item.cantidad}`;
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

</script>

</html>