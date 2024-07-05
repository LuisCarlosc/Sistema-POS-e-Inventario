<?php
session_start();
require_once "model/data.php";
$d= new Data();

$clientes = $d->getClientes();
$creditostodos = $d->getTodosCreditos();



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
<html>
<script src="js/filtrar.js"></script>
<body>
    

<div id="users">
<form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small  search" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary  sort" type="button" data-sort="name">
                      <i class="fas fa-exchange-alt"></i>
                        Ordenar Por Nombre
                      </button>
                    </div>
                  </div>
                </form>
<br><br>
<!-- Child elements of container with class="list" becomes list items -->
  <ul class="list">
  
  <?php foreach($clientes as $cli ){ 
    $estado="";
     $gastado = 0;
    $credito = $d->buscarcreditocedula($cli->cedula);
    foreach ($credito as $cre) {
      $cre->gastado;
    }

    foreach ($creditostodos as $creditos) {
      if ($creditos->cliente == $cli->cedula) {
        $monto = $creditos->monto;
        $gastado = $creditos->gastado;
      }
    }

    if (!isset($creditos->gastado)) { $gastado=0; }
    if ($gastado > 0) { $estado="Tiene Deuda"; }
else{
  $estado="No Deuda";
}
     
   echo "<li>";
   // The innerHTML of children with class="name" becomes this items "name" value -->
    echo "  <h3 class='name'> <i class='fas fa-user-secret' style='color:#C42F63';></i>&nbsp;&nbsp;&nbsp;<strong>".$cli->nombre."</strong></h3>";
     echo " <p class='born'><strong> C.C:</strong> ".$cli->cedula."</p>";
    echo " <p class='born'><strong> DEUDA:</strong>  ".number_format($gastado,0,'','.')."</p>";

     echo " <a  class='btn btn-primary  ' href='actcliente.php?cedula=$cli->cedula'><i class='fas fa-money-check-alt'></i>
     Movimientos</a>&nbsp;&nbsp;<a  class='btn btn-warning   ' type='submit'  ><i class='fas fa-exclamation-triangle'></i>
       ".$estado."  </a> ";

     echo"<br>";
     echo"<br>";
     echo "</li>";
    
  } ?>



  </ul>

 

  
</div>
</div>


<script type="text/javascript">     
var options = {
  valueNames: [ 'name', 'born' ]
};

var userList = new List('users', options);</script>


</body>
</html>


<script src="js/texto.js"></script>
	<link rel="stylesheet" href="CSS2/bootstrap.min.css">
	<link rel="stylesheet" href="CSS2/bootstrap-grid.min.css"> 