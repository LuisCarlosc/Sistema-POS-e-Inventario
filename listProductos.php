<?php
session_start();

require_once "model/data.php";
$d= new Data();

$productos = $d->getProductos();


$total=0;
  foreach ($productos as $prod){
      $subtotal=0;
     $precioCompra=0;
     $utilidad=0;
     
      $subtotal= $prod->precio_venta*$prod->cantidad;
      $precioCompra=$prod->precio_compra*$prod->cantidad;
      $utilidad=$subtotal-$precioCompra;
     $total += $utilidad;}



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
  <div class="row">

<div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">UTILIDAD TOTAL</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo number_format($total,0,'','.')   ?></div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
        
  </div>
<!-- Busqueda-->
<div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Lista Productos</h6>
              <div  style="text-align: right;width:1000px">
  
             
<span style='display:block; width:100%; text-align: right;'><button id="btn-abrir-popup" class="btn btn-success btn-icon-split btn-abrir-popup" >
                    <span class="icon text-white-50">
                    <i class="fas fa-user-circle fa-sm text-white-50"></i>
                    </span>
                    <span class="text">Nuevo Producto</span>
                  </button></span>
  </div>
            </div>
    <div class="card-body">
     <div class="table-responsive">

<table class="table  ">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Referencia</th>
    
      <th scope="col">Nombre</th>
      <th scope="col">Cantidad</th>
      <th scope="col">Precio De Compra</th>
      <th scope="col">Precio De Venta</th>
      <th scope="col">Subtotal</th>
      <th scope="col">Utilidad</th>
      <th scope="col">Acciones</th>
      
    </tr>
  </thead>
  <tbody>
  <?php 
  
  foreach ($productos as $pro){
      $subtotal=0;
     $precioCompra=0;
     $utilidad=0;
     
      $subtotal= $pro->precio_venta*$pro->cantidad;
      $precioCompra=$pro->precio_compra*$pro->cantidad;
      $utilidad=$subtotal-$precioCompra;
     
      
   echo "<tr>";
     echo "<th scope='row'>".$pro->referencia ." </th>";
   
     echo " <td>".$pro->nombre."</td>";
     echo "<td>".$pro->cantidad."</td>";
       echo "<td>$".number_format($pro->precio_compra,0,'','.')."</td>";
       echo "<td>$".number_format($pro->precio_venta,0,'','.')."</td>";
       echo "<td>$ ".number_format($subtotal,0,'','.')."</td>";
       echo "<td>$ ".number_format($utilidad,0,'','.')."</td>";
       echo "<td >";
echo"<a  class='btn btn-primary btn-circle  ' href='editarPro.php?id=$pro->id'><i class='far fa-edit'></i>
 </a>";

 echo "<br>";
 echo "<br>";

 
 echo"<a  class='btn btn-danger btn-circle  ' type='submit' data-toggle='modal' data-target='#exampleModalBorrar$pro->referencia'><i class='fas fa-trash'></i>
 </a>"; 
echo "</td>";
   echo " </tr>";


    ?>
  </tbody>
 

<!-- MODAL BORRAR-->
<div class="modal fade " id="exampleModalBorrar<?php echo $pro->referencia; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <form action="controller/eliminarProducto.php"  method="post" >
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> Borrar  El Prodcuto: <?php echo $pro->nombre; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
     
      <div class="modal-body">
      <input type="hidden" name="id" value="<?php echo $pro->id; ?>">
									
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button name="action"  id="action"type="submit" class="btn btn-primary">Borrar</button>
      </div>
    </div>
  </div>
  </form>
</div>



<?php 
  }
  
?>

</table>
</div>
    </div>
    </div>
  </div>




  <div class="overlay" id="overlay">
			<div class="popup" id="popup">
				<a href="#" id="btn-cerrar-popup" class="btn-cerrar-popup"><i class="fas fa-times"></i></a>
				<h1>AGREGAR PRODUCTO</h1>
				
				<form action="controller/agregarProducto.php" method="post">
				<div class="input-field col s12 m12">
					
				</div>
					<div class="contenedor-inputs">
					<div>
                    <label for="referencia">Referencia</label>
					<input id="referencia" name="referencia" type="number" class="validate" required>
					<label for="nombre">Nombre</label>
					<input id="nombre" name="nombre" type="text" class="validate"   required>
					
          </div>
          <label for="cantidad">Cantidad</label>
					<input id="cantidad" name="cantidad" type="number" class="validate" required>
         
					
					<label for="precio_compra">Precio De Compra</label>
					<input id="precio_compra" name="precio_compra" type="number" class="validate"  required>
					
					<label for="precio_venta">Precio De Venta</label>
					<input id="precio_venta" name="precio_venta" type="number" class="validate"  required>
					</div>
					<input type="submit" class="btn-submit " value="AGREGAR">
				</form>
			</div>
		</div>
	</div> 


  
 <?php
include 'footer.php';
 ?>

  <script src="popup.js"></script>



<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,600|Open+Sans" rel="stylesheet"> 
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
<link rel="stylesheet" href="estilos.css">

<script src="js/texto.js"></script>
	<link rel="stylesheet" href="CSS2/bootstrap.min.css">
	<link rel="stylesheet" href="CSS2/bootstrap-grid.min.css"> 