<?php
require_once "../model/data.php";
$d = new Data();

$id = $_POST["id"];
$nombre = $_POST["nombre"];
$cedula = $_POST["cedula"];
$celular = $_POST["celular"];
$direccion = $_POST["direccion"];

$d->actualizar_cliente($id, $nombre, $cedula, $celular, $direccion);

header("Location: ../listaClientes.php?action=actu&nom=$nombre");

?>