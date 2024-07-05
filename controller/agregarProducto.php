<?php
require_once "../model/data.php";
$d = new Data();
$referencia=$_POST["referencia"];
$nombre = $_POST["nombre"];
$cantidad = $_POST["cantidad"];
$precio_compra = $_POST["precio_compra"];
$precio_venta=$_POST["precio_venta"];

$d->insertarProducto($referencia,$nombre, $cantidad,$precio_compra, $precio_venta);

header("Location: ../listProductos.php?action=newc&nom=$nombre");
?>