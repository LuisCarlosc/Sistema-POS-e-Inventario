<?php 
session_start();

require_once "model/data.php";

$d=  new Data();
$totalVentas=$d->totalVentas();
$sumaAbonos=0;
$sumaVentas=0;
$creditos=0;
$sumaCreditos=0;
foreach ($totalVentas as $ven){
$sumaVentas += $ven->total;
$sumaCreditos += $ven->acreditado;
}


$abonos=$d->getAbonado();
foreach($abonos as $abo){
$sumaAbonos += $abo->abono;

}
$creditos=$sumaCreditos-$sumaAbonos;
$egresos = $d->getEgresos();

include 'header.php';
?>



<div class="row">
    <div class="col s12 l4"></div>
    <div class="col s12 l4"></div>
    <div class="col s12 l4"></div>

    <div class="col s12 l6"></div>

    <div class="col s12 l6"></div>
  </div>

  <div class="container-fluid">

  <strong> Total Ventas: $</strong> <?php echo number_format($sumaVentas,0,'','.') ?> <br>
 <strong> Creditos Vigentes: $</strong> <?php echo number_format($creditos,0,'','.') ?> <br> 
<br>
 <table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">FECHA</th>
      <th scope="col">C.C CLIENTE</th>
      <th scope="col">TOTAL</th>
      <th scope="col">ACREDITADO</th>
      <th scope="col">DETALLES</th>
      
    </tr>
  </thead>
  <tbody>
<?php

foreach ($totalVentas as $ve){
   echo " <tr>";
   echo   "<th scope='row'>".$ve->fecha."</th>";
    echo  "<td scope='row'>".number_format($ve->cliente,0,'','.') ."</td>";
     echo "<td>".number_format($ve->total,0,'','.')."</td>";
    echo  "<td>".number_format($ve->acreditado,0,'','.')."</td>";

    echo "<td>";
		echo "<a href='detalles.php?id=".$ve->id."'>Ver detalles</a>";
		echo "</td>";
  echo  "</tr>";
    
  echo "</tbody>";

}
  ?>
</table>

</div>


<script src="js/texto.js"></script>
	<link rel="stylesheet" href="CSS2/bootstrap.min.css">
	<link rel="stylesheet" href="CSS2/bootstrap-grid.min.css"> 