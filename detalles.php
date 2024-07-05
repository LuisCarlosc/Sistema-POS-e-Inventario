<?php
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {

	require_once "model/data.php";
	$id_venta = $_GET["id"];
	$d = new Data();

	$detalles = $d->getDetalles($id_venta);

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

	$pagename="Detalles";
	include 'header.php';
	?>

	<div class="container">

		<?php

		echo "<h1>Detalle de la venta numero $id_venta</h1>";
		echo "<a href='ventas.php'>Regresar</a>";
        echo "<table class='table'>";
         echo "<thead>";
		echo "<tr>";
		echo "<th scope='col'>REF</th>";
		echo "<th scope='col'>PRODUCTO</th>";
		echo "<th scope='col'>PRECIO</th>";
		echo "<th scope='col'>CANTIDAD</th>";
		echo "<th scope='col'>SUBTOTAL</th>";
		echo "<th scope='col'>DESCUENTO</th>";
        echo "</tr>";
        echo "<thead>";
$cantidadCarro=0;
        $total = 0;
        echo "<tbody>";
		foreach ($detalles as $det) {
           // $cantidadCarro=$det->subtotal/$det->precio;
			echo "<tr>";
			echo "<td>".$det->referencia."</td>";
			echo "<td>".$det->nomproducto."</td>";
			echo "<td>$ ".number_format($det->precio,0,',','.')."</td>";
			echo "<td>".$det->cantidad."</td>";
			echo "<td>$ ".number_format($det->subtotal,0,',','.')."</td>";
			echo "<td>".number_format($det->descuento,0,',','.')."%</td>";
			$total += $det->subtotal;
            echo "</tr>";
            echo "</tbody>";
		}

		echo "<tr>";
		echo "<td colspan='4'><strong>Total</strong></td>";
		echo "<td>$ ".number_format($total,0,',','.')."</td>";
		echo "</tr>";

		echo "</table>";
		?>

	</div>

<?php
	include 'footer.php';
} else {
	header("Location: index.php");
} ?>

<script src="js/texto.js"></script>
	<link rel="stylesheet" href="CSS2/bootstrap.min.css">
	<link rel="stylesheet" href="CSS2/bootstrap-grid.min.css"> 