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
}

 $credito = $d->buscarcreditocedula($cli->cedula);
 foreach ($credito as $cre) {
  $cre->monto;
  $cre->gastado;
  $cre->fecha_credito;
  $cre->fecha_gasto;
}

if ($cre->monto == 0) {
	$_SESSION["acreditado"] = 0;
	$d->crear_venta($carrito, $total, $cli->cedula);
} elseif ($cre->monto >= $total) {
	$acreditado = $total;
	$d->crear_venta_credito($carrito, $total, $cli->cedula, $acreditado);
	$_SESSION["acreditado"] = $acreditado;
} else if ($cre->monto < $total && $_SESSION["efectivo"] > 0){
	$acreditado = $cli->credito;
	$d->crear_venta_credito($carrito, $total, $cli->cedula, $acreditado);
	$_SESSION["acreditado"] = $acreditado;
	$_SESSION["efectivo"] = 0;
}
?>

<script type="text/javascript">
	var opciones = "width=600, height=620, scrollbars=NO, top=0";
	window.open("../facturas.php","nombreventa na", opciones);

// redirigir la pestaña actual a otra URL
window.location.href = 'http://localhost/agropecuaria'; 
</script> 