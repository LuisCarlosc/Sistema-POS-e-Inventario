<?php
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    if (isset($_SESSION['acceso']) && $_SESSION['acceso'] != 1) {
        header("Location: listUsuarios.php");
      }

      require_once "model/data.php";
      $d = new Data();
      if (isset($_GET["id"])) {
       $id=$_GET["id"];
     }
     $usuarios = $d->buscarusu($id);
     foreach ($usuarios as $u) {
       $u->id;
       $u->nombre;
       $u->usuario;
       $u->acceso;
     }

     function validaRequerido($valor){
        if(trim($valor) == ''){
          return false;
        }else{
          return true;
        }
      }
$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : null;
$usuario = isset($_POST['usuario']) ? $_POST['usuario'] : null;
$password = isset($_POST['password']) ? $_POST['password'] : null;
$acceso = isset($_POST['acceso']) ? $_POST['acceso'] : null;
//Este array guardará los errores de validación que surjan.
$errores = array();


//Pregunta si está llegando una petición por POST, lo que significa que el usuario envió el formulario.
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   //Valida que el campo nombre no esté vacío.
 if (!validaRequerido($nombre)) {
  $errores[] = 'El campo nombre es incorrecto.';
}
if (!validaRequerido($usuario)) {
  $errores[] = 'El campo usuario es incorrecto.';
}
if (!validaRequerido($password)) {
  $errores[] = 'El campo password es incorrecto.';
}
if (!validaRequerido($acceso)) {
  $errores[] = 'El campo acceso es incorrecto.';
}
}
$pagename="Actualizar usuario";
include 'header.php';
?>
<!--<div class="card o-hidden border-0 shadow-lg my-5">-->
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
         <!-- <div class="col-lg-5 d-none d-lg-block bg-register-image"></div> -->
          <div class="col-lg-7">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4"> <strong>Actualizar Usuario  </strong></h1>
              </div>
              <form class="user" action="controller/act_usuario.php" method="post" >
                <div class="form-group row">
                <div class="row">
                    <input type="hidden" class="form-control form-control-user" name="id" value="<?php  echo $u->id  ?>">
                  </div>
                  <div class="col-sm-6 mb-3 mb-sm-0">
                  <label for="nombre">Nombre</label>
                    <input type="text" name="nombre"  class="form-control form-control-user" id="nombre" value="<?php  echo $u->nombre  ?> "  minlength="6" required>
                  </div>
                  <div class="col-sm-6">
                  <label for="usuario">Usuario</label>
                    <input type="text" class="form-control form-control-user" id="usuario" name="usuario"  value="<?php echo $u->usuario; ?>" minlength="6" required>
                  </div>
                </div>
                <!--<div class="form-group">
                  <input type="password" name="password" class="form-control form-control-user" id="password" >
                </div>-->
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                  <label for="password">Contraseña</label>
                    <input type="password" class="form-control form-control-user" name ="password" id="password" value="" minlength="8" required >
                  </div>
                  <div class="col-sm-6">
                  <label for="acceso">Acceso</label>
                    <input type="number" name ="acceso" id="acceso"class="form-control form-control-user" value="<?php echo $u->acceso ?>"minlength="1" required>
                  </div>
                </div>
                
                <button type="submit" class="btn btn-success btn-user btn-block" name="action">
                  <strong>ACTUALIZAR </strong>
                </button>
                <hr>
                <a type="submit" href="listUsuarios.php" class="btn btn-danger btn-user btn-block" >
                  <strong>CANCELAR </strong>
                </a>
              
              </form>
              
  </hr>
              </div>
          </div>
        </div>
      </div>
    </div>

<?php
include 'footer.php';
} else {
  header("Location: login.php");
} ?>




