<?php
require_once "../model/data.php";
$d = new Data();

$nombre = $_POST["nombre"];
$cedula = $_POST["cedula"];
$direccion = $_POST["direccion"];
$celular = $_POST["celular"];

$d->insertcliente($nombre, $cedula, $direccion, $celular);

header("Location: ../listaClientes.php?action=newc&nom=$nombre");
?>