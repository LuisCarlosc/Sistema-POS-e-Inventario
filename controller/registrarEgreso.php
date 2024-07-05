<?php
require_once "../model/data.php";
$d = new Data();

$comentario = $_POST["comentario"];
$valor = $_POST["valor"];
$responsable = $_POST["usuario"];


$d->registrarEgreso($comentario,$valor,$responsable);

header("Location: ../listEgresos.php?action=newc&nom=$comentario");
?>