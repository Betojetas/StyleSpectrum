<!DOCTYPE html>
<html>

<head>
    <title>Comprar Productos</title>
</head>

<body>
    <h1>Carrito de Compras</h1>
    <table>
        <tr>
            <th>Imagen</th>
            <th>Nombre del Producto</th>
            <th>Talla</th>
            <th>Cantidad</th>
            <th>Precio Unitario</th>
            <th>Precio Total</th>
        </tr>
        <script>
            // Obtener el carrito desde la URL
            const urlParams = new URLSearchParams(window.location.search);
            const carritoBase64 = urlParams.get('carrito');

            // Decodificar el carrito desde base64
            const carritoJSON = atob(carritoBase64);

            // Convertir el carrito de JSON a un objeto de JavaScript
            const carrito = JSON.parse(carritoJSON);

            let totalCompra = 0; // Variable para almacenar el total de la compra

            // Mostrar los productos en una tabla
            for (const producto of carrito) {
                document.write(`
                    <tr>
                        <td><img src="imgProductos/${producto.codigo_imagen}" alt="${producto.codigo_imagen}" style="width: 100px;"></td>
                        <td>${producto.nombre}</td>
                        <td>${producto.talla}</td>
                        <td>${producto.cantidad}</td>
                        <td>${producto.precio}</td>
                        <td>${producto.precioTotal}</td>
                    </tr>
                `);

                totalCompra += producto.precioTotal; // Sumar el precio total de cada producto al total de la compra
            }

            // Mostrar la fila con el total de la compra
            document.write(`
                <tr>
                    <td colspan="5" align="right">Total:</td>
                    <td>${totalCompra}</td>
                </tr>
            `);
        </script>
    </table>
</body>

</html>