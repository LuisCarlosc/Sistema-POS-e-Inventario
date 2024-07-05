<?php
session_start();
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
require_once "model/data.php";

$d = new Data();

$usuarios=$d->getUsuarios();


include  'header.php';
?>


<div class="container">

<h1><strong>Lista De Usuarios</strong></h1>

<a href="perfilNegocio.php">Volver</a>
<span style='display:block; width:100%; text-align: right;'><button id="btn-abrir-popup" class="btn btn-success btn-icon-split btn-abrir-popup" >
                    <span class="icon text-white-50">
                    <i class="fas fa-user-plus"></i>
                    </span>
                    <span class="text">Nuevo Usuario</span>
                  </button></span>

<div class="card-body">
     <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
         <thead>
          <tr>
           <th  >#</th>
          <th >NOMBRE</th>
          <th  >USUARIO</th>
          <th  >NIVEL DE ACCESO</th>
          <th  >ACCIONES</th>
          
        </tr>
      </thead>
     
      <tbody>
        <?php
        foreach ($usuarios as $u) {
          echo "<tr>";
         echo "<td class=text-center >" .$u->id."</td>";
          echo "<td class=text-center > ".$u->nombre."</td>";
          echo "<td class=text-center >".$u->usuario."</td>";
       
          echo "<td class=text-center >".$u->acceso."</td>";
          
          
          echo "<td class='center'>";
          echo "<a href='actusuario.php?id=$u->id' class='acceuno waves-effect waves-red btn-flat btn' name='action'><i class='fas fa-user-edit'  style='color:#FF5733';></i>Modificar</a></td>";
          echo "</tr>";
        }
        ?>
      </tbody>
    </table>
    </div>
    </div>

</div>


<div class="overlay" id="overlay">
			<div class="popup" id="popup">
				<a href="#" id="btn-cerrar-popup" class="btn-cerrar-popup"><i class="fas fa-times"></i></a>
				<h3>AGREGAR USUARIO</h3>
				
				<form action="controller/nuevo_usuario.php" method="post">
				<div class="input-field col s12 m12">
					
				</div>
					<div class="contenedor-inputs">
					<div>
					<label for="nombre">Nombre</label>
					<input id="nombre" name="nombre" type="text" class="validate"  minlength="6" required>
					
          </div>
          <label for="usuario">Usuario</label>
					<input id="usuario" name="usuario" type="text" class="validate" minlength="6"required>
					
					<label for="password">Contraseña</label>
					<input id="password" name="password" type="password" class="validate" minlength="8" required>
					
					<label for="acceso">Acceso</label>
					<input id="acceso" name="acceso" type="number" class="validate" minlength="1" required>
					
					
					
					</div>
					<input type="submit" class="btn-submit " value="AGREGAR">
				</form>
			</div>
		</div>
	</div>


<?php
}else {

    header("Location: login.php");

}



?>
	<script src="popup.js"></script>


<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,600|Open+Sans" rel="stylesheet"> 
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
	<link rel="stylesheet" href="estilos.css">

