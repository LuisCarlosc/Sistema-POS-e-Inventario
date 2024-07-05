<?php 

//require_once "../model/producto.php";
require_once "../model/data.php";

$p = new Producto();

$p->stock = $_POST["txt_cantidad"];
$p->descuento = $_POST["txt_descuento"];

if ($p->stock > 0) {

	$p->id = $_POST["txt_id"];
	$p->referencia = $_POST["txt_ref"];
	$p->nombre = $_POST["txt_nombre"];
	$p->precio_venta = $_POST["txt_precio"];
	$p->cantidad = $_POST["txt_stock"]; 
	$p->subtotal = ($p->precio_venta * $p->stock)-($p->descuento* $p->stock);

	$d = new Data();

	//Añadir producto al carrito
	session_start();

	if (isset($_SESSION["carrito"])) {
		$carrito=$_SESSION["carrito"];
	}else{
		$carrito=array();
	}

	$suma_cantidades=0;
	foreach ($carrito as $pro) {
		if ($pro->id==$p->id) {
			$suma_cantidades += $pro->stock;
		}
	}

	$suma_cantidades += $p->stock;

	//tengo Stock
	 if ($p->cantidad >= $suma_cantidades) {
		array_push($carrito, $p);
		$_SESSION["carrito"] = $carrito;
		header("location: ../carrito.php?action=added&nom=$p->nombre");
	} else {
		header("location: ../carrito.php?m=1");
	}

} else {
	header("location: ../carrito.php?m=2");
}

?>