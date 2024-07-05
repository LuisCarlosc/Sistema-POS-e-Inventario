<?php
require_once "../model/data.php";
$d = new Data();

$cliente = $_POST["cliente"];
$credito = $_POST["credito"];
$cajero = $_POST["cajero"];

$d->realizarcredito($cliente, $credito, $cajero);

header("Location: ../listaClientes.php");

?>