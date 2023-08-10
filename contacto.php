<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto - Tienda de Ropa Elegante</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>

    <?php require_once 'master_page.php'; ?>

    <div class="container mt-4">
        <h1>Contacto</h1>
        <p>¿Tienes alguna pregunta o comentario? ¡Contáctanos!</p>

        <div class="row">
            <div class="col-md-6">
                <h3>Información de Contacto</h3>
                <p><strong>Dirección:</strong> Calle Principal #123, Ciudad Elegante</p>
                <p><strong>Teléfono:</strong> (844) 204-38-86</p>
                <p><strong>Correo Electrónico:</strong> stylespectrum@gmail.com</p>
            </div>
            <div class="col-md-6">
                <h3>Formulario de Contacto</h3>
                <form method="post">
                    <div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>
                    <div class="form-group">
                        <label for="correo">Correo Electrónico:</label>
                        <input type="email" class="form-control" id="correo" name="correo" required>
                    </div>
                    <div class="form-group">
                        <label for="mensaje">Mensaje:</label>
                        <textarea class="form-control" id="mensaje" name="mensaje" rows="4" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Enviar Mensaje</button>
                </form>
            </div>
        </div>
    </div>

    <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>