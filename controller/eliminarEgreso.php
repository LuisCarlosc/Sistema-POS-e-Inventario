<?php 
require_once '../model/data.php';
$d = new Data();
 $id = $_POST ["id"];

$d->deleteEgreso($id);

header ("Location: ../listEgresos.php");
?>