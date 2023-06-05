<meta charset="utf-8">
 <link rel="icon" href="img/imagen11.jpeg">

<?php

/* Conectar a una base de datos de MySQL Local */
$db_host = 'mysql:dbname=style_spectrum;host=localhost';
$usuario = 'root';
$password = 'root'; 

/* Conectar a una base de datos de MySQL remoto
$db_host = 'mysql:dbname=id16840286_db_web;host=localhost';
$usuario = 'id16840286_db_aplicaciones';
$password = 'Utc_web2021*'; */
try {
	$cnnPDO = new PDO($db_host, $usuario, $password);
} catch (PDOException $e) {


	echo "<br><br><center>
	<div class='card text-white bg-danger mb-3' style='max-width: 50rem;'>
	<div class='card-header'><h3>Error de Conexión</h3></div>
	<div class='card-body'>
	<h4 class='card-title'>Ha surgido un error y no se puede conectar a la base de datos!</h4>
	<h5 class='card-title'>Detalle:</h5>
	<p class='card-text text-white'>". $e->getMessage()."</p>
	</div>
	</div>
	";
}

?>