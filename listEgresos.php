<?php

date_default_timezone_set('America/Bogota');
session_start();


require_once "model/data.php";
$d= new Data();

$egresos = $d->getEgresos();


include 'header.php';

//EGRESOS TODOS
$total=0;
foreach ($egresos as $egre){
$total+= $egre->valor;


}

//EGRESOS HOY
$egresosHoy=$d->getEgresosHoy();
$totalHoy=0;
foreach($egresosHoy as $egre){
$totalHoy+=$egre->valor;

}
/*$egresosMes=$d->getEgresosmes();
$totalMes=0;
foreach($egresosMes as $egre){
$totalMes+=$egre->valor;

}*/
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
              <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Egresos De Hoy</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo number_format($totalHoy,0,'','.')   ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

  <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total De Egresos</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo number_format($total,0,'','.')   ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
<!--
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Total De Egresos Del Mes</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><//?php echo number_format($totalMes,0,'','.')   ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-dollar-sign  fa-2x text-gray-300 " ></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
-->

            </div>
<!-- Busqueda-->

<div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Egresos Registrados</h6>
              <div  style="text-align: right;width:1000px">
  
             
<span style='display:block; width:100%; text-align: right;'><button id="btn-abrir-popup" class="btn btn-success btn-icon-split btn-abrir-popup" >
                    <span class="icon text-white-50">
                    <i class="fas fa-user-circle fa-sm text-white-50"></i>
                    </span>
                    <span class="text">Registrar Egreso</span>
                  </button></span>
  </div>
            </div>
    <div class="card-body">
     <div class="table-responsive">

<table class="table  ">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Comentario</th>
      <th scope="col">valor</th>
      <th scope="col">Fecha De Registro</th>
      <th scope="col">Responsable</th>
      <th scope="col">Accion</th>
     
    </tr>
  </thead>
  <tbody>
  <?php 
  
  foreach ($egresos as $egre){
  
      
   echo "<tr>";
     echo "<th scope='row'>". $egre->id." </th>";
     echo " <td class='description'>".$egre->comentario."</td>";
    
       echo "<td>".number_format($egre->valor,0,'','.')."</td>";
       echo "<td>".$egre->fecha."</td>";
       echo "<td >".$egre->usuario."</td>";
      echo "<td class='center'>";
      echo "<a  class='btn btn-danger btn-circle  ' type='submit' data-toggle='modal' data-target='#exampleModalBorrar$egre->id'><i class='fas fa-trash'></i>
      </a>";
      
      echo "</td>";
       

   echo " </tr>"; 

    ?>
  </tbody>



<div class="modal fade " id="exampleModalBorrar<?php echo $egre->id ; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <form action="controller/eliminarEgreso.php"  method="post" >
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> Borrar  El Egreso: <?php echo $egre->comentario; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
     
      <div class="modal-body">
      <input type="hidden" name="id" value="<?php echo $egre->id; ?>">
									
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
				<h3>REGISTRAR EGRESO</h3>
				
				<form action="controller/registrarEgreso.php" method="post">
				<div class="input-field col s12 m12">
					
				</div>
					<div class="contenedor-inputs">
					<div>
            <label for="comentario">Comentario</label>
					<input id="comentario" name="comentario" type="text" class="validate" required>
				
					
          </div>
          <label for="valor">Valor</label>
					<input id="valor" name="valor" type="number" class="validate" required>	
					
					<input  id="usuario" name="usuario" type="hidden" class="validate" value="<?php echo $_SESSION['nombre'];  ?>"  >
					
					
					
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

  