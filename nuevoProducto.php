<?php 
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    if (isset($_SESSION['acceso']) && $_SESSION['acceso'] != 1) {
        header("Location: listUsuarios.php");
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
                <h1 class="h4 text-gray-900 mb-4"> <strong>Agregar Producto  </strong></h1>
              </div>
              <form class="user" action="controller/agregarProducto.php" method="post" >
                <div class="form-group row">
                
                  <div class="col-sm-6 mb-3 mb-sm-0">
                  <label for="referencia">Referencia</label>
                    <input type="number" name="referencia"  class="form-control form-control-user" id="referencia"    required>
                    <label for="cantidad">Cantidad</label>
                    <input type="number" class="form-control form-control-user" id="cantidad" name="cantidad"    required>
                   
                  </div>
                  <div class="col-sm-6">
                  <label for="nombre">Nombre</label>
                    <input type="text" name="nombre"  class="form-control form-control-user" id="nombre"   required>
                   
                  
                  </div>
                </div>
                <!--<div class="form-group">
                  <input type="password" name="password" class="form-control form-control-user" id="password" >
                </div>-->
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                  <label for="precio_compra">Precio De Compra</label>
                    <input type="number" name="precio_compra"  class="form-control form-control-user" id="precio_compra"    required>
                  </div>
                  <div class="col-sm-6">
                  <label for="precio_venta">Precio De Venta</label>
                    <input type="number" name="precio_venta"  class="form-control form-control-user" id="precio_venta"    required>
                  </div>
                </div>
                
                <button type="submit" class="btn btn-success btn-user btn-block" name="action">
                  <strong>GUARDAR PRODUCTO </strong>
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