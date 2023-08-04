<!DOCTYPE html>
<html>

<head>
    <title>Comprar Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f5f5f5;
        }

        h1 {
            text-align: center;
            margin-top: 30px;
        }

        .cart-item {
            display: flex;
            align-items: center;
            padding: 10px;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 10px;

        }

        .cart-item img {
            max-width: 100px;
            margin-right: 20px;

        }

        .cart-item-info {
            flex: 1;
        }

        .cart-item-info h3,
        .cart-item-info p {
            margin: 0;
        }

        .total-row {
            background-color: #f0f0f0;
            font-weight: bold;
            padding: 10px;
            text-align: right;

        }

        .checkout-btn {
            display: block;
            margin: 30px auto;
            text-align: center;
            background-color: #000000;
            color: #ffffff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            position: absolute;
            left: 70%;
        }


        .checkout-btn:hover {
            background-color: #222222;
        }

        .cart-items {
            padding: 10px;
            width: 80%;

        }

        .cart-item-info-container {
            display: flex;
            align-items: center;
        }

        .cart-item-image {
            max-width: 100px;
            margin-right: 20px;
        }

        .cart-item-details {
            flex: 1;

        }

        .total-row-container {
            text-align: right;
            font-weight: bold;
            background-color: #f0f0f0;
            padding: 10px;
            margin-top: 10px;
            width: 80%;
        }

        /* Estilos anteriores... */

        .quantity-input {
            display: flex;
            align-items: center;
            border: 1px solid #ddd;
            border-radius: 5px;
            overflow: hidden;
            width: 100px;
        }

        .quantity-btn {
            background-color: #f0f0f0;
            color: #000;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 30px;
            height: 30px;
            cursor: pointer;
        }

        .quantity-btn:hover {
            background-color: #ddd;
        }

        .quantity-btn.disabled {
            pointer-events: none;
            opacity: 0.5;
        }

        .quantity-input input {
            text-align: center;
            border: none;
            width: 40px;
            height: 30px;
            font-size: 14px;
            font-weight: bold;
            outline: none;
        }
    </style>
</head>
<?php
// // Asegurarse de que el parámetro carrito esté presente en la URL
// if (isset($_GET['carrito'])) {
//     // Decodificar los datos base64
//     $carritoBase64 = $_GET['carrito'];
//     $carritoJSON = base64_decode($carritoBase64);

//     // Convertir los datos JSON de nuevo a un arreglo de PHP
//     $carrito = json_decode($carritoJSON, true);
//     $cantidad_carrito = $carrito[0]['cantidad'];

// }
?>

<body>
    <?php require_once 'master_page.php'; ?>
    <div class="container">
        <h1></h1>
        <div class="cart-items"></div>
        <div class="total-row-container">Total: <span id="totalCompra"></span></div>
        <form action="llenarDatos.php">
            <button class="checkout-btn">Realizar Compra</button>
        </form>
    </div>

    <script>



        const urlParams = new URLSearchParams(window.location.search);
        const carritoBase64 = urlParams.get('carrito');
        const carritoJSON = atob(carritoBase64);
        const carrito = JSON.parse(carritoJSON);
        let totalCompra = 0;

        const cartItemsContainer = document.querySelector('.cart-items');


        // Función para aumentar la cantidad del producto
        function increaseQuantity(input) {
            const quantity = parseInt(input.value);
            if (quantity < 10) {
                input.value = quantity + 1;
                updateTotal();
            }
        }

        // Función para disminuir la cantidad del producto
        function decreaseQuantity(input) {
            const quantity = parseInt(input.value);
            if (quantity > 1) {
                input.value = quantity - 1;
                updateTotal();
            }
        }

        // Función para actualizar el precio total del producto
        function updateTotal() {
            const quantityInputs = document.querySelectorAll('.qty-num');
            let newTotalCompra = 0;

            for (let i = 0; i < carrito.length; i++) {
                const producto = carrito[i];
                const quantity = parseInt(quantityInputs[i].value);

                // Asegurar que la cantidad no exceda el límite (10)
                const newQuantity = Math.min(Math.max(quantity, 1), 10);
                quantityInputs[i].value = newQuantity;

                const newPrecioTotal = newQuantity * producto.precio;

                newTotalCompra += newPrecioTotal;
                producto.precioTotal = newPrecioTotal;

                // Actualizar el precio total y el precio unitario para el producto actual
                const cartItemDiv = document.querySelectorAll('.cart-item')[i];
                const precioUnitarioElement = cartItemDiv.querySelector('.cart-item-details p:nth-child(3)');
                const precioTotalElement = cartItemDiv.querySelector('.cart-item-details p:nth-child(4)');
                precioUnitarioElement.innerHTML = `Precio Unitario: <b>$${producto.precio}</b>`;
                precioTotalElement.innerHTML = `Precio Total: <b>$${newPrecioTotal}</b>`;
            }

            totalCompra = newTotalCompra;
            const totalCompraSpan = document.getElementById('totalCompra');
            totalCompraSpan.textContent = `$${totalCompra}`;
        }



        for (const producto of carrito) {
            const cartItemDiv = document.createElement('div');
            cartItemDiv.classList.add('cart-item');

            cartItemDiv.innerHTML = `
                <img src="imgProductos/${producto.codigo_imagen}" alt="${producto.codigo_imagen}" class="cart-item-image">
                <div class="cart-item-info-container">
                    <div class="cart-item-details">
                        <h3>${producto.nombre}</h3>
                        <div class="quantity-input">
                            <div class="quantity-btn" onclick="decreaseQuantity(this.nextElementSibling)">&minus;</div>
                            <input class="qty-num" type="text" value="${producto.cantidad}" onchange="updateTotal()" onkeyup="this.value = this.value.replace(/[^0-9]/, '')">
                            <div class="quantity-btn" onclick="increaseQuantity(this.previousElementSibling)">&#43;</div>
                        </div>
                        <p>Precio Unitario: <b>$${producto.precio}</b></p>
                        <p>Precio Total: <b>$${producto.precioTotal}</b></p>
                    </div>
                </div>
                
            `;

            cartItemsContainer.appendChild(cartItemDiv);
            totalCompra += producto.precioTotal;
        }

        const totalCompraSpan = document.getElementById('totalCompra');
        totalCompraSpan.textContent = `$${totalCompra}`;
    </script>
</body>

</html>