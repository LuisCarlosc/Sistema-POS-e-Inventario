
 
<?php



 require_once "model/data.php";
 $d= new Data();
 session_start(); 
include 'header.php';


$estado="";
?>

<?php
if (isset($_GET["m"])) {
		$m = $_GET["m"];

		switch ($m) {
			case '1':
			echo "<div class='alert alert-warning' role='alert'>
      El Producto Se Encuentra Agotado
    </div>";
			break;
			case '2':
			echo "<div class='alert alert-danger' role='alert'>
     !OJO¡ La Cantidad Ingresada No Es Correcta
    </div>";
			break;
		}
  }
  

  if (isset($_GET["action"])) {
		$action = $_GET["action"];
		if (isset($_GET["nom"])) {
			$nom = $_GET["nom"];
		}

		if ($action=="added") {
      echo "<div class='alert alert-success' role='alert'>
      Agregado el producto $nom al carrito.
     </div>";		} elseif ($action=="deleted") {
       echo "<div class='alert alert-danger' role='alert'>
       Producto $nom Eliminado del Carrito.
      </div>";
		} elseif ($action=="venta") {
			echo "<script type='text/javascript'> document.addEventListener('DOMContentLoaded', function() { M.toast({html: '¡Venta realizada!', classes: 'rounded'});; });</script>";
		} elseif ($action=="newp") {
			echo "<script type='text/javascript'> document.addEventListener('DOMContentLoaded', function() { M.toast({html: '¡$nom a sido agregado al inventario!', classes: 'rounded'});; });</script>";
		}
	}  

?>
<center><h1><strong> CARRITO</strong></h1> <br></center>
<br>

<form class="form-inline mr-auto w-100 navbar-search" method="post"  action="controller/buscarpro.php">
                  <div class="input-group">
                    <input name="product" type="text" class="form-control bg-light border-0 small  search" placeholder="Buscar Producto" aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary  sort" type="button" data-sort="name">
                      <i class="fas fa-search"></i>
                        
                      </button>
                    </div>
                  </div>
                </form>

<div class="main">
			<div class="row">

				<div class="col s12 m12 center"><!--Todo menos carrito-->

					




          <div class="container">




<?php
if (isset($_SESSION["carrito"])) {
  $carrito = $_SESSION["carrito"];

  echo "<h2>Carrito</h2>";
  echo "<table class='table'>";
   echo "<thead>";
  echo "<tr>";
  echo "<th scope='col'>REF</th>";
  echo "<th scope='col'>NOMBRE</th>";
  echo "<th scope='col'>PRECIO</th>";
  echo "<th scope='col'>STOCK</th>";
  echo "<th scope='col'>CANTIDAD</th>";
  echo "<th scope='col'>DESCUENTO</th>";
  echo "<th scope='col'>SUBTOTAL</th>";
  echo "<th scope='col'>ACCIONES</th>";
  echo "</tr>";
   echo "</thead>";

   echo "<tbody>";
  $total=0;
  $i=0;

  foreach ($carrito as $p) {
    echo "<tr>";
    echo "<td scope='row'>".$p->referencia."</td>";
    echo "<td>".$p->nombre."</td>";
    echo "<td>$ ".number_format($p->precio_venta,0,',','.')."</td>";
    echo "<td>".$p->cantidad."</td>";
    echo "<td>".$p->stock."</td>";
    echo "<td>$ ".number_format($p->descuento,0,'','.')."</td>";
    echo "<td>$ ".number_format($p->subtotal,0,',','.')."</td>";
    echo "<td>";
    echo "<a  class='btn btn-danger' href='controller/eliminarProCarrito.php?in=$i&nom=$p->nombre''>Eliminar</a>";
    echo "</td>";
    $total += $p->subtotal;
    $i++;
    echo "</tr>";
  } 
 echo " </tbody>";
  echo "<tr>";
  echo "<td colspan='6'><strong>Total</strong></td>";
  echo "<td> <strong>$ ".number_format($total,0,',','.')." </strong></td>";
  $_SESSION["total"]=$total;
  echo "<td>";
  echo "<button id='btn-abrir-popup' class='btn btn-success btn-icon-split btn-abrir-popup' >
  <span class='text'>Vender</span>
</button>";
  echo "&nbsp;&nbsp;<a  type='button' class='btn btn-warning ' data-toggle='modal' data-target='#exampleModal'>
 <strong> Cotización </strong>
</a> ";
  echo "</td>";
  echo "</tr>";
 
  echo "</table>";
  echo " <strong>Cantidad de productos: </strong>".count($carrito); 
}
?>
</div><!--container cerrar-->


					<div class="table-container">
						<?php if (isset($_GET["produ"])) { ?>

                            <table class="table">
  <thead>
  <tr>
									<th>REF</th>
									<th>NOMBRE</th>
									<th>PRECIO</th>
									<th> DISPONIBLE</th>
									<th style="width: 2em">CANTIDAD</th>
									<th style="width: 4em;">DESCUENTO</th>
									<th style="width: 12em;" class="center">ACCIONES</th>
								</tr>
  </thead>
  <tbody>
  <?php

$products = $d->buscarProductos($_GET["produ"]);
foreach ($products as $p) {
    echo "<tr>";
    echo "<td>".$p->referencia."</td>";
    echo "<td>".$p->nombre."</td>";
    echo "<td>$ ".number_format($p->precio_venta,0,',','.')."</td>";
    echo "<td>".$p->cantidad."</td>";
	echo "<form action='controller/agregar.php' method='post'>";
    echo "<td>";
    echo "<input type='hidden' name='txt_id' value='".$p->id."'>";
    echo "<input type='hidden' name='txt_ref' value='".$p->referencia."'>";
    echo "<input type='hidden' name='txt_nombre' value='".$p->nombre."'>";
    echo "<input type='hidden' name='txt_precio' value='".$p->precio_venta."'>";
    echo "<input type='hidden' name='txt_stock' value='".$p->cantidad."'>";
    echo "<input type='number' name='txt_cantidad' value='1' required>";
    echo "</td>";
    echo "<td>";
    echo "<input type='number' name='txt_descuento' value='0' required>";
    echo "</td>";
    echo "<td class='center'>";
    echo "<button type='submit' class='btn btn-success' name='action'><i class='fas fa-cart-plus'></i> Añadir</button>";
    echo "</td>";
    echo "</form>"; 
    echo "</tr>";
}?>
  </tbody>
</table>



                    <?php } 
                    
                 ?>
				</div> <!-- Table container div -->
</div>
</div>
</div>

<div class="overlay" id="overlay">
			<div class="popup" id="popup">
				<a href="#" id="btn-cerrar-popup" class="btn-cerrar-popup"><i class="fas fa-times"></i></a>
				<h3>HACER VENTA</h3>
				<div class="col s12"><?php echo "Total: $ ".number_format($_SESSION["total"],0,',','.'); ?></div>

        <form class="col s12 center" onsubmit="return false" action="return false">
										<input type="number" id="efectivo" name="efectivo" placeholder="Efectivo"  autocomplete="off" required>
										<button onclick="Registrarefectivo();" class="btn btn-success">CAMBIO</button>
										<br style="clear:both;">
									</form>

<div id="respuestaefe" class="center"></div>

				<form action="controller/generarventa.php" method="post">
				<div class="input-field col s12 m12">
					
				</div>
					<div class="contenedor-inputs">
					<div>
          <h5 class="modal-title" id="exampleModalLabel"> <strong>Buscar Cliente:</strong>  </h5> <br>
        <input autocomplete="off" id="cliensear" class="typeahead form-control" name="cliensear" type="search" placeholder="Buscar cliente" required>
					
					</div>
					<input type="submit" class="btn-submit " value="VENDER">
				</form>
			</div>
		</div>
	</div> 

  <div class="modal fade " id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <form action="controller/generarCotizacion.php"  method="post" >
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> Buscar Cliente: </h5> <br>
        <input autocomplete="off" id="cliensear" class="typeahead form-control" name="cliensear" type="search" placeholder="Buscar cliente" required>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
     
      <div class="modal-body">
      <input type="hidden" name="id" value="">
									
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button name="action"  id="action"type="submit" class="btn btn-primary">Cotizar</button>
      </div>
    </div>
  </div>
  </form>
</div>
<script type="text/javascript">
			/*BUSCAR CLIENTES EN BARRA DE BUSQUEDA CON SUJERENCIAS EN VIVO*/
			$( document ).ready(function() {
				$('input.typeahead').typeahead({
					source: function (query, process) {
						return $.get('search_data.php', { query: query }, function (data) {
							data = $.parseJSON(data);
							return process(data);
						});
					},
					showHintOnFocus:'all'
				});
			}); 
      
      
      function Registrarefectivo(){
				var efectivo = $("#efectivo").val();
				$("#respuestaefe").html("Por favor espera un momento");
				$.ajax({
					type: "POST",
					dataType: 'html',
					url: "controller/cajacambio.php",
					data: "efectivo="+efectivo,
					success: function(respu){
						$('#respuestaefe').html(respu);
						Limpiar();
						Cargar();
					}
				});
			}
      
      
       </script>
<script src="popup.js"></script>
<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,600|Open+Sans" rel="stylesheet"> 
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
	<link rel="stylesheet" href="estilos.css">

  <script src="js/typeahead.js"></script>



  