<?php
require_once "../model/data.php";
$d = new Data();

$cedula = $_POST["cedula"];
$abono = $_POST["abono"];
$atendido = $_POST["atendido"];

$d->realizarabono($cedula, $abono, $atendido);

header("Location: ../listaClientes.php");
?>