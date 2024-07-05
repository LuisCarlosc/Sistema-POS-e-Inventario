<?php
require_once "../model/data.php";
$d = new Data();

$nombre = $_POST["nombre"];
$usuario = $_POST["usuario"];
$password = $_POST["password"];
$password_cifrada = password_hash($password, PASSWORD_DEFAULT, array("cost"=>15));
$acceso = $_POST["acceso"];

$d->insertuser($nombre, $usuario, $password_cifrada, $acceso);

header("Location: ../listUsuarios.php?action=newu&nom=$nombre");
?>