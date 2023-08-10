<?php
$correoEmisor = "coronasr.hikod@gmail.com";
$nombreEmisor = "Style Spectrum";
$destinatario = "luis.hikod@gmail.com";
$nombreDestinatario = "Luis";
$asunto = "Recuperación de contraseña";
$cuerpo = '
<html>
    <head>
        <title>Correo de prueba</title>
    </head>
    <body>
        <h1>Correo para recuperar contraseña</h1>
        <p>Este es un correo de prueba</p>
    </body>
</html>';
$aviso = "Gracias, Correo enviado";

include('./config/_mail.php');

?>
