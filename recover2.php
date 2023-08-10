<?php
require_once 'conexion.php';

if (isset($_POST['enviar'])) {
    // Obtener los valores de los campos del formulario
    $contrasena = $_POST['new_contraseña'];


    // Verificar si los campos no están vacíos
    if (!empty($contrasena)) {
        // Realizar las operaciones de registro en la base de datos
        $roles = "usaurio";
        // Ejemplo de inserción en una tabla llamada 'usuarios'
        $sql = $cnnPDO->prepare("UPDATE usuarios SET contrasena = :contrasena)");

        $sql->bindParam(':contrasena', $contrasena);

        $sql->execute();
        unset($sql);

        // Redireccionar a otra página después del registro exitoso
        header("location:login.html?mensaje2=Contraseña cambiada exitosamente");
        exit();
    } else {
        echo "Por favor, completa todos los campos.";
    }
}
?>