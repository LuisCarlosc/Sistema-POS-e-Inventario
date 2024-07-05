<?php   
date_default_timezone_set('America/Bogota');
session_start();
require_once "model/data.php";

$d=  new Data();

$ventasHoy=$d->ventasHoy();
 $totalHoy=0;
 $acreditadoHoy=0;
foreach($ventasHoy as $venta){
$totalHoy+=$venta->total;
$acreditadoHoy+= $venta->acreditado;

}

$totalVentas=$d->totalVentas();



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

$abonosHoy=$d->getAbonadoHoy();
$sumaAbonos=0;
foreach($abonosHoy as $abo){
  $sumaAbonos+=$abo->abono;

}

$egresosHoy=$d->getEgresoshoy();
$egreHoy=0;



foreach($egresosHoy as $egre){
$egreHoy+=$egre->valor;

}


$utilidad=$d->getUtilidadHoy();

$subtotalCompra=0;
$totalCompra=0;
foreach ($utilidad as $uti){
$subtotalCompra=$uti->precio_compra*$uti->cantidad;
$totalCompra+=$subtotalCompra;

}

?>    








<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/>

<style type="text/css">
*{margin: 0; padding: 0;}
	.todo{
		width: 215.9mm;
		max-width: 215.9mm;
		min-width: 215.9mm;

		padding: 10px 100px;
	}
</style>


<style type="text/css">
 @media print {
     html,body{
        font-size: 9.5pt;
        margin: 0;
        padding: 0;
     }.page-break {
       page-break-before:always;
       width: auto;
       margin: auto;
      }
    }
    .page-break{
      width: 980px;
      margin: 0 auto;
    }
     .sale-head{
       margin: 40px 0;
       text-align: center;
     }.sale-head h1,.sale-head strong{
       padding: 10px 20px;
       display: block;
     }.sale-head h1{
       margin: 0;
       border-bottom: 1px solid #212121;
     }.table>thead:first-child>tr:first-child>th{
       border-top: 1px solid #000;
      }
      table thead tr th {
       text-align: center;
       border: 1px solid #ededed;
     }table tbody tr td{
       vertical-align: middle;
     }.sale-head,table.table thead tr th,table tbody tr td,table tfoot tr td{
       border: 1px solid #212121;
       white-space: nowrap;
     }.sale-head h1,table thead tr th,table tfoot tr td{
       background-color: #f8f8f8;
     }tfoot{
       color:#000;
       text-transform: uppercase;
       font-weight: 500;
     }
</style>
   

<div class="todo">
<h1 class="center"><?php echo $n->nombre; ?></h1>
<h2 class="center">Reporte Diario</h2>
<h4 class="center"><?php echo date("Y-m-d"); ?></h4>

<div class="container">
		<?php 
		echo "<div>";
		echo "<br>";
		echo "<strong>Ventas De Hoy:</strong> $ ".number_format($totalHoy,0,",",".");
		echo "<br>";
		echo "<strong>Créditos: </strong>$ ".number_format($acreditadoHoy,0,",",".");
		echo "<br>";
        echo "<strong>Egresos De Hoy: </strong>$ ".number_format($egreHoy,0,",",".");
        echo "<br>";
        echo "<strong>Abonos De Hoy: </strong>$ ".number_format($sumaAbonos,0,",",".");
		echo "<br>";
		echo "<strong>Total en caja:</strong> $ ".number_format($totalHoy+$sumaAbonos - $acreditadoHoy - $egreHoy,0,",",".");
		echo "<br>";
		echo "<strong>Utilidad De Hoy:</strong> $ ".number_format($totalHoy-$totalCompra,0,",",".");
        echo "<table  class='table'>";
        echo "<thead>";
		echo "<tr>";
		echo "<th>ID</th>";
		echo "<th>FECHA</th>";
		echo "<th>CÉDULA CLIENTE</th>";
		echo "<th>TOTAL</th>";
		echo "<th>ACREDITADO</th>";

        echo "</tr>";
        echo "</thead>";
        $i=0;
         echo "<tbody>";
		foreach ($ventasHoy as $ve) {
			echo "<tr>";
			echo "<td>".$ve->id."</td>";
			echo "<td>".$ve->fecha."</td>";
			echo "<td>".number_format($ve->cliente,0,"",".")."</td>";
			echo "<td>$ ".number_format($ve->total,0,',','.')."</td>";
			echo "<td>$ ".number_format($ve->acreditado,0,',','.')."</td>";
			
            
            
            echo "</tr>";
            echo "</tbody>";
           
        } 
            echo "<tr>";
            echo "<td colspan='3'> <strong>TOTAL </strong></td>";

            echo "<td>$ ".number_format($totalHoy,0,",",".")."</td>";
            echo "<td>$ ".number_format($acreditadoHoy,0,",",".")."</td>";
        
            echo "</tr>";
echo "<br>";
            echo "<tr>";
            echo "<td> <strong>UTILIDAD </strong></td>";

            echo "<td>$ ".number_format($totalHoy-$totalCompra,0,",",".")."</td>";
            
        
            echo "</tr>";
          
        echo "</table>"; ?>

</div>

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