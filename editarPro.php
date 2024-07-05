<?php 
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    if (isset($_SESSION['acceso']) && $_SESSION['acceso'] != 1) {
        header("Location: listProductos.php");
      }




      require_once "model/data.php";
      $d = new Data();
      if (isset($_GET["id"])) {
       $id=$_GET["id"];
     }
     $producto = $d->buscarPro($id);
     foreach ($producto as $p) {
       $p->id;
       $p->referencia;
       $p->nombre;
       $p->cantidad;
       $p->precio_compra;
       $p->precio_venta;
     }

     function validaRequerido($valor){
        if(trim($valor) == ''){
          return false;
        }else{
          return true;
        }
      }
$referencia = isset($_POST['referencia']) ? $_POST['referencia'] : null;  
$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : null;
$cantidad = isset($_POST['cantidad']) ? $_POST['cantidad'] : null;
$precio_compra = isset($_POST['precio_compra']) ? $_POST['precio_compra'] : null;
$precio_venta = isset($_POST['precio_venta']) ? $_POST['precio_venta'] : null;
//Este array guardará los errores de validación que surjan.
$errores = array();


//Pregunta si está llegando una petición por POST, lo que significa que el usuario envió el formulario.
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   //Valida que el campo nombre no esté vacío.
   if (!validaRequerido($referencia)) {
    $errores[] = 'El campo referencia es incorrecto.';
  }
 if (!validaRequerido($nombre)) {
  $errores[] = 'El campo nombre es incorrecto.';
}
if (!validaRequerido($cantidad)) {
  $errores[] = 'El campo cantidad es incorrecto.';
}
if (!validaRequerido($precio_compra)) {
  $errores[] = 'El campo precio de compra es incorrecto.';
}
if (!validaRequerido($precio_venta)) {
  $errores[] = 'El campo precio de venta es incorrecto.';
}
}






include 'header.php';

?>
  <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
         <!-- <div class="col-lg-5 d-none d-lg-block bg-register-image"></div> -->
          <div class="col-lg-7">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4"> <strong>ACTUALIZAR PRODUCTO </strong></h1>
              </div>
              <form class="user" action="controller/modificarProducto.php" method="post" >
                <div class="form-group row">
                <div class="row">
                    <input type="hidden" class="form-control form-control-user" name="id" value="<?php  echo $p->id  ?>">
                  </div>
                  <div class="col-sm-6 mb-3 mb-sm-0">
                  <label for="referencia">Referencia</label>
                    <input type="number" name="referencia"  class="form-control form-control-user" id="referencia" value="<?php echo $p->referencia  ?>"   required>
                    <label for="cantidad">Cantidad</label>
                    <input type="number" class="form-control form-control-user" id="cantidad" name="cantidad"  value="<?php echo $p->cantidad  ?>"   required>
                  </div>
                  <div class="col-sm-6">
                  <label for="nombre">Nombre</label>
                    <input type="text" name="nombre"  class="form-control form-control-user" id="nombre" value="<?php echo $p->nombre  ?>"   required>
                   
                  
                  </div>
                </div>
                <!--<div class="form-group">
                  <input type="password" name="password" class="form-control form-control-user" id="password" >
                </div>-->
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                  <label for="precio_compra">Precio De Compra</label>
                    <input type="number" name="precio_compra"  class="form-control form-control-user" id="precio_compra"  value="<?php echo $p->precio_compra  ?>"   required>
                  </div>
                  <div class="col-sm-6">
                  <label for="precio_venta">Precio De Venta</label>
                    <input type="number" name="precio_venta"  class="form-control form-control-user" id="precio_venta"  value="<?php echo $p->precio_venta  ?>"   required>
                  </div>
                </div>
                
                <button type="submit" class="btn btn-success btn-user btn-block" name="action">
                  <strong>ACTUALIZAR </strong>
                </button>
                <hr>
                <a type="submit" href="listProductos.php" class="btn btn-warning btn-user btn-block" >
                  <strong>LISTA DE PRODUCTOS </strong>
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