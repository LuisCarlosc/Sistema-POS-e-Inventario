<?php
require_once "model/data.php";
require "vendor/autoload.php";
session_start();
date_default_timezone_set('America/Bogota');

if (isset($_SESSION["carrito"])) {$carrito = $_SESSION["carrito"]; } else {$carrito = array(); }
if (isset($_SESSION["total"])) {$total = $_SESSION["total"]; } else {$total = 0; }
if (isset($_SESSION["clienteventa"])) {$clienteventa = $_SESSION["clienteventa"]; } else {$clienteventa = 0; }
if (isset($_SESSION["efectivo"])) {$efectivo = $_SESSION["efectivo"]; } else {$efectivo = 0; }
if (isset($_SESSION["acreditado"])) { $acreditado = $_SESSION["acreditado"]; } else { $acreditado = 0; }
if (isset($_SESSION["tipofactura"])) { $tipofactura = $_SESSION["tipofactura"]; } else { $tipofactura = "none"; }

$d = new Data();
$cliente = $d->buscarcliente($clienteventa);

$negocio = $d->infonegocio();

foreach ($negocio as $n) {
	$n->id;
	$n->nombre;
	$n->nit;
	$n->direccion;
	$n->celular;
	$n->correo;
	$n->meta;
}

$textfactura="FACTURA DE VENTA CR NRO ";
$numfactura=$d->idultimaventa();

$Bar = new Picqer\Barcode\BarcodeGeneratorHTML();
$code = $Bar->getBarcode($numfactura, $Bar::TYPE_CODE_128);
?>
<script type="text/javascript">
	function imprimir() {
		if (window.print) {
			window.print();
		} else {
			alert("La función de impresion no esta soportada por su navegador. preciona la CTRL+P para imprimir la factura");
		}
	}
	imprimir();
</script>


<div class="todo">
	<h1><?php echo $n->nombre; ?></h1><br>
	<p><strong> MAELEIDYS ESTHER POLO PACHECO<br>
		<?php echo $n->nit; ?> <br>
	REGIMEN SIMPLIFICADO</strong></p><br>

	<p><strong> LA REINA DEL BOROJÓ</strong><br>
	Ventas de jugos naturales, como Borojó, Nispero, Zapote y suplementos multivitaminicos .</p>
	<br>
	<p>*********************************</p>
	<h3>FACTURA DE VENTAS</h3>
	<p>*********************************</p>
	<br>

	<table>
		<tr>
			<th>CAD</th>
			<th>PROD</th>
			<th>VR. UNIT</th>
			<th>DESC</th>
			<th>VR. TOTAL</th>
		</tr>
		<?php
		foreach ($carrito as $p) {
			echo "<tr>";
			echo "<td><center>".$p->stock."</center></td>";
			echo "<td>".$p->nombre."</td>";
			echo "<td align='right'>$".number_format($p->precio_venta,0,',','.')."</td>";
			echo "<td align='right'>$".number_format($p->descuento,0,',','.')."</td>";
			echo "<td align='right'>$".number_format($p->subtotal,0,',','.')."</td>";
			echo "</tr>";
		}
		?>
		<tr>
			<td colspan="2" align="center"><strong>TOTAL</strong></td>
			<td>:</td>
			<td align="right"><strong><?php echo "$".number_format($total,0,",","."); ?></strong></td>
		</tr>
	</table>
	
	<br>
	<?php
	if ($acreditado==0) {

		echo "Efectivo: $ ".number_format($efectivo,0,',','.');
        echo "<br>";
        if ($efectivo==0){
            echo "Cambio: $ ".number_format($total,0,',','.');

        }
        else{
		echo "Cambio: $ ".number_format($efectivo-$total,0,',','.');}
    }
    
    
    
    
    elseif ($acreditado>0 && $efectivo>0) {
		echo "Efectivo: $ ".number_format($efectivo,0,',','.');
		echo "<br>";
		echo "Cambio: $ ".number_format($efectivo-$total,0,',','.');
		echo "<br>";
		echo "Acreditado: $ ".number_format($acreditado,0,',','.');
	} elseif ($acreditado>0 && $efectivo==0) {
		echo "Acreditado total: $ ".number_format($acreditado,0,',','.');
	}
	?>
	<br>
	<br>
	<span style="display: flex;">
		<p style="text-align: left; width: 50%;">Fecha: <?php echo date("d-m-Y");?></p>
		<p style="text-align: right; width: 50%;"><?php echo "Hora: ".date("h:i:s"); ?></p>
	</span>
	<br>
	<p>ATENDIDO POR: <?php echo $_SESSION["nombre"]; ?></p>
	<br>
	<p><?php echo $textfactura.$numfactura; ?></p>
	<br>
	<div style="display: table; margin: auto; text-align: center;">
		<?php echo $code; ?>
	</div>
	<br>
	<p>*********************************</p>
	<h3>CLIENTE</h3>
	<p>*********************************</p>
	<br>
	<p>
		<?php
		foreach ($cliente as $cli) {
			echo $cli->nombre."<br>";
			echo "C.C ".number_format($cli->cedula,0,",",".")."<br>";
			echo $cli->celular." - ".$cli->direccion;
		}
		?>
	</p>
	<br>
	<p>*********************************</p>
	<p><strong> PARQUE CENTRAL <br>
		Cels. <?php echo $n->celular ?> <br>
		SAHAGÚN - CÓRDOBA</strong> <br>
	</p>
</div>

	<style type="text/css">
	*{
		padding: 0;
		margin: 0;
		font-size: 8pt;
	}
	.todo{
		width: 199px;
		max-width: 199px;
		padding:15px;
		display: block;
	}
	h1{
		font-size: 13pt;
		text-align: center;
	}
	h3{
		text-align: center;
	}
	p{
		text-align: center;
	}
	table{
		width: 200px;
		max-width: 219.2125984252px;
	}
</style>

<?php

//Vaciar carrito
unset ($_SESSION['carrito']);

//Eliminar total de la sesion
unset ($_SESSION['total']);

//Eliminar cliente venta de sesion
unset ($_SESSION['clienteventa']);
?>