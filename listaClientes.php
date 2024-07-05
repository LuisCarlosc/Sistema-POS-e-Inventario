<?php
session_start();
require_once "model/data.php";
$d= new Data();

$clientes = $d->getClientes();

?>
 <?php
$pagename="Lista Clientes";

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
<!-- Busqueda-->
  
  
   
         <!-- Busqueda-->

  
  <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Lista Clientes</h6>
              <div  style="text-align: right;width:1000px">
  
             
<span style='display:block; width:100%; text-align: right;'><button id="btn-abrir-popup" class="btn btn-success btn-icon-split btn-abrir-popup" >
                    <span class="icon text-white-50">
                    <i class="fas fa-user-circle fa-sm text-white-50"></i>
                    </span>
                    <span class="text">Nuevo Cliente</span>
                  </button></span>
  </div>
            </div>
          
    <div class="card-body">
     <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
         <thead>
          <tr>
           <th  >#</th>
          <th >Cedula</th>
          <th  >Nombre completo</th>
          <th  >Celular</th>
          <th  >Direccion</th>
          <th>Credito Actual</th>
          <th>Credito Gastado</th>
          <th >Hacer Creditos</th>
          <th   >Hacer Pagos</th>
          <th   >Acciones</th>
        </tr>
      </thead>
      <tfoot>
          <tr>
           <th  >#</th>
          <th >Cedula</th>
          <th  >Nombre completo</th>
          <th  >Celular</th>
          <th  >Direccion</th>
          <th>Credito Actual</th>
          <th>Credito Gastado</th>
          <th >Hacer Creditos</th>
          <th   >Hacer Pagos</th>
          <th   >Acciones</th>
        </tr>
      </tfoot>
      <tbody>
       <?php
	$creditostodos = $d->getTodosCreditos();

  foreach ($clientes as $cli) {
    $monto = 0; $gastado = 0;
    $credito = $d->buscarcreditocedula($cli->cedula);
    foreach ($credito as $cre) {
      $cre->monto;
      $cre->gastado;
    }

    foreach ($creditostodos as $creditos) {
      if ($creditos->cliente == $cli->cedula) {
        $monto = $creditos->monto;
        $gastado = $creditos->gastado;
      }
    }

    if (isset($gastado) && $gastado>0) {
      $classdisabled="disabled";
      $classdisabledpago="enabled";
    } else {
      $classdisabled="enabled";
      $classdisabledpago="disabled";
    }

    if (isset($monto) && $monto>0) {
      $classdisabledcredito="disabled";
    } else {
      $classdisabledcredito="enabled";
    }

    if (!isset($creditos->monto)) { $monto=0; }
    if (!isset($creditos->gastado)) { $gastado=0; }




        
          echo "<tr>";
         echo "<td class=text-center >" .$cli->id."</td>";
          echo "<td class=text-center > ".number_format($cli->cedula,0,'','.')."</td>";
          echo "<td class='name' >".$cli->nombre."</td>";
       
          echo "<td class=text-center >".$cli->celular."</td>";
       
          echo "<td class=text-center >".$cli->direccion."</td>";
          echo "<td><p class='right'>$ ".number_format($monto,0,'','.')."</p></td>";
          echo "<td><p class='right'>$ ".number_format($gastado,0,'','.')."</p></td>";
          echo "<td class='center'>";
          echo "<a  type='button' class='btn btn-primary ".$classdisabled." ".$classdisabledcredito."' data-toggle='modal' data-target='#exampleModal$cli->id'><i class='fas fa-credit-card'></i>
          Credito
        </a> ";
          echo "</td>";
          echo "<td class='center'>";
          echo "<a  type='button' class='btn btn-warning ".$classdisabledpago."' data-toggle='modal' data-target='#exampleModalPago$cli->id'><i class='fas fa-credit-card'></i>
          Bonficar
        </a> ";
          echo "</td>";
echo "<td class='center'>";
echo"<a  class='btn btn-primary btn-circle  ' href='actcliente.php?cedula=$cli->cedula'><i class='far fa-edit'></i>
 </a>";

 echo "<br>";
 echo "<br>";

 
 echo"<a  class='btn btn-danger btn-circle  ' type='submit' data-toggle='modal' data-target='#exampleModalBorrar$cli->id'><i class='fas fa-trash'></i>
 </a>"; 
echo "</td>";

          echo "</tr>"; 
         



        ?>





      </tbody>
      

<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade " id="exampleModal<?php echo $cli->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <form action="controller/asignar_credito.php"  method="post" >
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cliente: <?php echo $cli->nombre; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
     
      <div class="modal-body">
      <input type="hidden" name="id" value="<?php echo $cli->id; ?>">
										<input type="hidden" name="cliente" value="<?php echo $cli->cedula; ?>">
										<input id="credito<?php echo $cli->id; ?>" name="credito" type="number" class="validate"  autocomplete="off" minlength="3" required>
										<label for="credito<?php echo $cli->id; ?>">Inserte el credito</label>
										<input type="hidden" name="cajero" value="<?php echo $_SESSION['nombre']; ?>">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button name="action"  id="action"type="submit" class="btn btn-primary">Guardar Credito</button>
      </div>
    </div>
  </div>
  </form>
</div>



<!-- MODAL PAGO -->
<div class="modal fade " id="exampleModalPago<?php echo $cli->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <form action="controller/abono.php" method="post" >
      <div class="modal-header">
      <h1><strong>Realizar Abono </strong> </h1>
        <h5 class="modal-title" id="exampleModalLabel"> <strong> Cliente:</strong> <?php echo $cli->nombre; ?> <br>
        <strong> Saldo actual:</strong> <br> <?php echo "$ ".number_format($cre->gastado,0,",","."); ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
     
      <div class="modal-body">
      <input type="hidden" name="cedula" value="<?php echo $cli->cedula; ?>">
											<input id="abono<?php echo $cli->id; ?>" name="abono" type="number" max="<?php echo $gastado; ?>" class="validate"  autocomplete="off" minlength="8" required>
											<label for="abono<?php echo $cli->id; ?>">Inserte el Abono</label>
											<input type="hidden" name="atendido" value="<?php echo $_SESSION['nombre']; ?>">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button name="action"  id="action"type="submit" class="btn btn-primary">Abonar </button>
      </div>
    </div>
  </div>
  </form>
</div>

 <!--  MODAL BORRAR -->

 <div class="modal fade " id="exampleModalBorrar<?php echo $cli->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <form action="controller/eliminarCliente.php"  method="post" >
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> Borrar A: <?php echo $cli->nombre; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
     
      <div class="modal-body">
      <input type="hidden" name="id" value="<?php echo $cli->id; ?>">
									
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
				<h3>AGREGAR CLIENTE</h3>
				
				<form action="controller/nuevo_cliente.php" method="post">
				<div class="input-field col s12 m12">
					
				</div>
					<div class="contenedor-inputs">
					<div>
					<label for="nombre">Nombre</label>
					<input id="nombre" name="nombre" type="text" class="validate"  minlength="6" required>
					
          </div>
          <label for="cedula">Cedula</label>
					<input id="cedula" name="cedula" type="number" class="validate" minlength="6"required>
					
					<label for="direccion">Dirección</label>
					<input id="direccion" name="direccion" type="text" class="validate" minlength="8" required>
					
					<label for="celular">Celular</label>
					<input id="celular" name="celular" type="text" class="validate" minlength="8" required>
					
					
					
					</div>
					<input type="submit" class="btn-submit " value="AGREGAR">
				</form>
			</div>
		</div>
	</div> 





  
 <?php
include 'footer.php';
 ?>
<script>

var options = {
  valueNames: [ 'name' ]
};

var userList = new List('users', options);</script>

<script src="popup.js"></script>
<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,600|Open+Sans" rel="stylesheet"> 
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
	<link rel="stylesheet" href="estilos.css">

  <script src="js/texto.js"></script>
	<link rel="stylesheet" href="CSS2/bootstrap.min.css">
	<link rel="stylesheet" href="CSS2/bootstrap-grid.min.css"> 
	<!--<link rel="stylesheet" href="CSS2/estilos.css">-->
  