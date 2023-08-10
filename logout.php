<?php
session_start(); // Iniciar o reanudar la sesión

// Destruir todas las variables de sesión
session_unset();
// Destruir la sesión
session_destroy();

// Redirigir a la página de inicio o a donde desees
header("Location: login.html");
exit();
?>