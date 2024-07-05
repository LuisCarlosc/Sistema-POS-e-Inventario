
<?php   
date_default_timezone_set('America/Bogota');
session_start();
require_once "model/data.php";

$d=  new Data();



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

$now=date("Y-m-d");
    list($año, $mes, $dia) = explode('-', $now);
    
  function calculo(){
      $mensaje="";
    $now=date("Y-F-d");
    list($año, $mes, $dia) = explode('-', $now);
    if($mes==01){
$mensaje="$dia - Enero - $año ";

    }elseif($mes=="January"){$mensaje="$dia - Febrero - $año ";}
    elseif($mes=="March"){$mensaje="$dia - Marzo - $año ";}
    elseif($mes=="April"){$mensaje="$dia - Abril - $año ";}
    elseif($mes=="May"){$mensaje="$dia - Mayo - $año ";}
    elseif($mes=="June"){$mensaje="$dia - Junio - $año ";}
    elseif($mes=="July"){$mensaje="$dia - Julio - $año ";}
    elseif($mes=="August"){$mensaje="$dia - Agosto - $año ";}
    elseif($mes=="September"){$mensaje="$dia - Septiembre - $año ";}
    elseif($mes=="October"){$mensaje="$dia - Octubre - $año ";}
    elseif($mes=="November"){$mensaje="$dia - Noviembre - $año ";}
    elseif($mes=="December"){$mensaje="$dia - Diciembre - $año ";}
    

    return $mensaje;
}

$sumaTotal=0;
$sumaCreditos=0;
$egresosMes=0;

$egresos=$d->getEgresos();

foreach($egresos as $e){
	list($fechaventas, $horaventa) = explode(" ",$e->fecha);
	list($aniodb, $mesdb, $diadb) = explode("-",$fechaventas);
	if ($mes == $mesdb) {
$egresosMes += $e->valor;
	}
}


foreach($totalVentas as $ven){
	list($fechaventas, $horaventa) = explode(" ",$ven->fecha);
	list($aniodb, $mesdb, $diadb) = explode("-",$fechaventas);
	if ($mes == $mesdb) {
		$sumaTotal+=$ven->total;
		$sumaCreditos+=$ven->acreditado;}}

$sumaAbonos=0;
		$abonos=$d->getAbonado();
foreach($abonos as $abo){
	list($fechaventas, $horaventa) = explode(" ",$abo->fecha_abono);
	list($aniodb, $mesdb, $diadb) = explode("-",$fechaventas);
	if ($mes == $mesdb) {
$sumaAbonos+=$abo->abono;

	}
}

$utilidadMes=$d->getUtilidad();
$subtotalCompraMes=0;
$totalCompraMes=0;
foreach ($utilidadMes as $uti){
	list($fechaventas, $horaventa) = explode(" ",$uti->fecha);
	list($aniodb, $mesdb, $diadb) = explode("-",$fechaventas);
	if ($mes == $mesdb) {
$subtotalCompraMes=$uti->precio_compra*$uti->cantidad;
$totalCompraMes+=$subtotalCompraMes;
	}
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


<div class="todo">
<h1 class="center"><?php echo $n->nombre; ?></h1>
<h2 class="center">Reporte Mensual</h2>
<h4 class="center"><?php echo calculo(); ?></h4>

<div class="container">

<?php


     echo "<div>";
	echo "<h1>Ventas Del Mes</h1>";
echo "<strong>Total Mes:</strong> ".number_format($sumaTotal,0,"",".");
echo "<br>";
echo "<strong>Creditos Mes:</strong> ".number_format($sumaCreditos,0,"",".");
echo "<br>";
echo "<strong>Egresos Mes:</strong> ".number_format($egresosMes,0,"",".");
echo "<br>";
echo "<strong>Abonos Mes:</strong> ".number_format($sumaAbonos,0,"",".");
echo "<br>";
echo "<strong>Total en Caja Mes:</strong> ".number_format($sumaTotal+$sumaAbonos-$sumaCreditos-$egresosMes,0,"",".");
echo "<br>";
echo "<strong>Utilidad Del Mes:</strong> ".number_format($sumaTotal-$totalCompraMes,0,"",".");
	echo "<table  class='table'>";
	echo "<thead>";
	echo "<tr>";
	echo "<th scope='col'>ID</th>";
	echo "<th scope='col'>FECHA</th>";
	echo "<th scope='col'>CÉDULA CLIENTE</th>";
	echo "<th scope='col'>TOTAL</th>";
	echo "<th scope='col'>ACREDITADO</th>";
	

	echo "</tr>";
	echo "</thead>";
	echo "<tbody>";

foreach($totalVentas as $ve){
	list($fechaventas, $horaventa) = explode(" ",$ve->fecha);
	list($aniodb, $mesdb, $diadb) = explode("-",$fechaventas);
	if ($mes == $mesdb) {
	
		echo "<tr>";
		echo "<td>".$ve->id."</td>";
		echo "<td>".$ve->fecha."</td>";
		echo "<td>".number_format($ve->cliente,0,"",".")."</td>";
		echo "<td>$ ".number_format($ve->total,0,',','.')."</td>";
		echo "<td>".number_format($ve->acreditado,0,',','.')." </td>";
	
		echo "</tr>";
		echo "</tbody>";
}}


echo "<tr>";
            echo "<td colspan='3'><strong>Total</strong></td>";
            echo "<td>$ ".number_format($sumaTotal,0,",",".")."</td>";
            echo "<td>$ ".number_format($sumaCreditos,0,",",".")."</td>";
            echo "<td colspan='1' class=''></td>";
            echo "<td colspan='1' class=''></td>";
			echo "</tr>";
			echo "<br>";
            echo "<tr>";
            echo "<td> <strong>UTILIDAD DEL MES </strong></td>";

            echo "<td>$ ".number_format($sumaTotal-$totalCompraMes,0,",",".")."</td>";
            
        
            echo "</tr>";
echo "</table>";


	echo "</div>";

            ?>

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