<?php 
require_once "../model/data.php";
session_start();

$carrito = $_SESSION["carrito"];
$total = $_SESSION["total"];
if (isset($_POST["cliensear"])) {
	$_SESSION["clienteventa"]=$_POST["cliensear"];
}

$d = new Data();
$cliente = $d->buscarcliente($_SESSION["clienteventa"]);

foreach ($cliente as $cli) {
	$cli->id;
	$cli->nombre;
	$cli->cedula;
	$cli->celular;
	$cli->direccion;
	$cli->credito;
}
if (true) {
	$d->crear_cotizacion($carrito, $total, $cli->cedula);
}
?>

<script type="text/javascript">
var opciones = "width=600, height=620, scrollbars=NO, top=0";
window.open("../printcot.php","nombreventa na", opciones); 

// redirigir la pestaña actual a otra URL
window.location.href = 'http://localhost/agropecuaria';
</script>