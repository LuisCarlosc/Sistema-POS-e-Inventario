<?php
require_once "../model/data.php";

$d=new Data();
/*
$negocio = $d->infonegocio();

foreach ($negocio as $n) {
	
	$n->correo;
	
}
*/

$id = $_POST["id"];
$nombre = $_POST["nombre"];
$nit = $_POST["nit"];
$celular = $_POST["celular"];
$direccion = $_POST["direccion"];
$correo=$_POST["correo"];
//$n->correo = $_POST["correo"];
$meta = $_POST["meta"];

$d->actualizar_negocio($id, $nombre, $nit, $celular, $direccion, $correo, $meta);

header("Location: ../perfilNegocio.php");


?>