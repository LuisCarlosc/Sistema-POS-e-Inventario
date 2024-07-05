<?php 
require_once '../model/data.php';
$d = new Data();
 $id = $_POST ["id"];

$d->deleteCliente($id);

header ("Location: ../listaClientes.php");
?>