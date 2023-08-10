<?php
require_once 'conexion.php';

if (isset($_POST['registrar'])) {
    // Obtener los valores de los campos del formulario
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];
    $correo_electronico = $_POST['correo_electronico'];
    $contrasena = $_POST['contrasena'];

    // Verificar si los campos no están vacíos
    if (!empty($nombre) && !empty($direccion) && !empty($correo_electronico) && !empty($contrasena)) {
        // Verificar si ya existe un usuario con el mismo correo electrónico o nombre
        $sql_check = $cnnPDO->prepare("SELECT * FROM usuarios WHERE correo_electronico = :correo_electronico OR nombre = :nombre");
        $sql_check->bindParam(':correo_electronico', $correo_electronico);
        $sql_check->bindParam(':nombre', $nombre);
        $sql_check->execute();

        if ($sql_check->rowCount() == 0) {
            // Realizar las operaciones de registro en la base de datos
            $roles = "usaurio";
            // Ejemplo de inserción en una tabla llamada 'usuarios'
            $sql = $cnnPDO->prepare("INSERT INTO usuarios (nombre, direccion, correo_electronico, contrasena, roles) VALUES (:nombre, :direccion, :correo_electronico, :contrasena, :roles)");

            $sql->bindParam(':nombre', $nombre);
            $sql->bindParam(':direccion', $direccion);
            $sql->bindParam(':correo_electronico', $correo_electronico);
            $sql->bindParam(':contrasena', $contrasena);
            $sql->bindParam(':roles', $roles);

            $sql->execute();
            unset($sql);

            // Redireccionar a otra página después del registro exitoso
            header("location:login.html?mensaje2=Se registró exitosamente");
            exit();
        } else {
            header("location:login.html?mensaje=Ya existe un usuario con el mismo correo electrónico o nombre de usuario.");
        }
    } else {
        echo "Por favor, completa todos los campos.";
    }
}
?>