<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    // traemos el nav de la master_page
    require_once 'master_page.php';
    // validamos si es admin si no lo sacamos por rata
    if (isset($_SESSION['rol']) != "admin") {
        header("Location:login.html");
    }
    ?>
</body>

</html>