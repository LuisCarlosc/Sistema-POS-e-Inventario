<?php 
require_once "model/data.php";

session_start();
$d = new Data();

//$egresos = $d->getEgresos(); 
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

$pagename="Perfil";
include 'header.php';

?>
<div class="row" style="margin-top: 10px;">
	<div class="col s12 m4 center">
	<div class="col s12"><h4><?php echo "<strong>$n->nombre</strong> " ?></h4></div> 
		<img src="images/reina.png" class="circle foto_perfil" alt="Foto perfil" width="50%">
	</div>	
	<div class="col m8">
		
			
			<div class="col s12"><?php echo "<strong>NIT:</strong> ".$n->nit; ?></div>
			<div class="col s12"><?php echo "<strong>Dirección:</strong> ".$n->direccion; ?></div> 
			<div class="col s12"><?php echo "<strong>Celular:</strong> ".$n->celular; ?></div> 
			<div class="col s12"><?php echo "<strong>Correo:</strong> ".$n->correo; ?></div>
		
	</div>
</div>
</div>
<div class="row" >
<!-- &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button id="btn-abrir-popup" class="btn-abrir-popup btn-primary btn-icon-split"  class="icon text-white-50">
					<i class="fas fa-house-damage"></i>
                    
                    
                    <span class="text">Editar Negocio</span>
					</button>
	</div> -->
	
	<div class="row" >
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button id="btn-abrir-popup" class="btn btn-success btn-icon-split btn-abrir-popup" >
                    <span class="icon text-white-50">
					<i class="fas fa-house-damage"></i>
                    </span>
                    <span class="text">Editar Negocio</span>
                  </button>
	</div>
	
	
	
	</br>



	<div class="row" >
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="listUsuarios.php" class="btn btn-primary btn-icon-split">
                    <span class="icon text-white-50">
					<i class="fas fa-user-cog"></i>
                    </span>
                    <span class="text">Usuarios</span>
                  </a>
	</div>
	<div class="my-2"></div>

	</br>


	<div class="row" >
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" class="btn btn-danger btn-icon-split">
                    <span class="icon text-white-50">
					<i class="fas fa-dollar-sign"></i>
                    </span>
                    <span class="text">Registrar Egreso</span>
                  </a>
	</div>
	<div class="my-2"></div>
	
	<div class="overlay" id="overlay">
			<div class="popup" id="popup">
				<a href="#" id="btn-cerrar-popup" class="btn-cerrar-popup"><i class="fas fa-times"></i></a>
				<h3>EDITAR NEGOCIO</h3>
				
				<form action="controller/actNegocio.php" method="post">
				<div class="input-field col s12 m12">
					
				</div>
					<div class="contenedor-inputs">
					<input name="id" type="hidden" value="<?php  echo $n->id; ?>">
					<label for="nombre">Nombre</label>
					<input id="nombre" name="nombre" type="text" class="validate" value="<?php  echo $n->nombre; ?>" required>
					<label for="nit">NIT</label>
					<input id="nit" name="nit" type="text" class="validate" value="<?php echo $n->nit; ?>" required>
					
					<label for="direccion">Dirección</label>
					<input id="direccion" name="direccion" type="text" class="validate" value="<?php echo $n->direccion; ?>" required>
					
					<label for="celular">celular</label>
					<input id="celular" name="celular" type="text" class="validate" value="<?php echo $n->celular; ?>" required>
					
					<label for="correo">Correo</label>
					<input id="correo" name="correo" type="email" class="validate" value="<?php echo $n->correo; ?>" required>
					
					<label for="meta">meta</label>
					<input id="meta" name="meta" type="text" class="validate" value="<?php echo $n->meta; ?>" required>
					
					</div>
					<input type="submit" class="btn-submit " value="ACTUALIZAR">
				</form>
			</div>
		</div>
	</div>

	<script src="popup.js"></script>



	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,600|Open+Sans" rel="stylesheet"> 
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
	<link rel="stylesheet" href="estilos.css">