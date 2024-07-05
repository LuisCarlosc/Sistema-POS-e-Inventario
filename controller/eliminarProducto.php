<?php 
require_once '../model/data.php';
$d = new Data();
 $id = $_POST ["id"];

$d->deleteProducto($id);

header ("Location: ../listProductos.php");
?>