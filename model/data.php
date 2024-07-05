<?php 
require_once "conexion.php";
require_once "categoria.php";
require_once "producto.php";
require_once "venta.php";
require_once "detalle.php";
require_once "usuario.php";
require_once "cliente.php";
require_once "negocio.php";
require_once "abono.php";
require_once "creditos.php";
require_once "egreso.php";
require_once "media.php";


class Data {
    private $con;

	public function __construct(){
		$this->con = new Conexion();
	}


	public function insertcliente($nombre, $cedula,$direccion, $celular ){
		//nuevo cliente
		$query = "SELECT cedula FROM clientes where cedula=$cedula LIMIT 1";
		$res = $this->con->ejecutar($query);

		if ($reg = $res->fetch_object()) {
			echo "<script>window.alert('Este cliente ya fue ingresado al sistema.');</script>";
		} else {
			$query = "INSERT into clientes values(null, '$nombre', $cedula, '$direccion', '$celular')";
			$this->con->ejecutar($query);
		}
	}

	public function actualizar_cliente($id, $nombre, $cedula, $celular, $direccion){
		//Actualizar cliente
		$query = "UPDATE clientes set nombre = '$nombre', cedula = $cedula, celular = '$celular', direccion = '$direccion' where id=$id";
		$this->con->ejecutar($query);
	}

	public function getClientes(){
		$clientes = array();

		$query = "SELECT * from clientes ORDER BY id desc";
		$res = $this->con->ejecutar($query);

		while($reg = $res->fetch_object()){
			$cli = new Cliente();

			$cli->id = $reg->id;
			$cli->nombre = $reg->nombre;
			$cli->cedula = $reg->cedula;
            $cli->direccion = $reg->direccion;
            $cli->celular = $reg->celular;

			array_push($clientes, $cli);
		}

		return $clientes;
	}

	public function buscarcliente($nombre){
		$cliente = array();

		$query = "SELECT * from clientes where nombre LIKE '%$nombre%' ";
		$res = $this->con->ejecutar($query);

		while($reg = $res->fetch_object()){
			$cli = new Cliente();

			$cli->id = $reg->id;
			$cli->nombre = $reg->nombre;
			$cli->cedula = $reg->cedula;
			$cli->direccion = $reg->direccion;
			$cli->celular = $reg->celular;
		

			array_push($cliente, $cli);
		}

		return $cliente;
	}

	public function buscarclientecedula($cedula){
		$cliente = array();

		$query = "SELECT * from clientes where cedula = $cedula";
		$res = $this->con->ejecutar($query);

		while($reg = $res->fetch_object()){
			$cli = new Cliente();

			$cli->id = $reg->id;
			$cli->nombre = $reg->nombre;
			$cli->cedula = $reg->cedula;
			$cli->celular = $reg->celular;
			$cli->direccion = $reg->direccion;

			array_push($cliente, $cli);
		}

		return $cliente;
	}


	public function infonegocio(){
		$negocio = array();

		$query = "SELECT * from negocio LIMIT 1";
		$res = $this->con->ejecutar($query);

		while($reg = $res->fetch_object()){
			$n = new Negocio();

			$n->id = $reg->id;
			$n->nombre = $reg->nombre;
			$n->nit = $reg->nit;
			$n->direccion = $reg->direccion;
			$n->celular = $reg->celular;
			$n->correo = $reg->correo;
			$n->meta = $reg->meta;

			array_push($negocio, $n);
		}

		return $negocio;
	}

	public function actualizar_negocio($id, $nombre, $nit, $celular, $direccion, $correo, $meta){
		//Actualizar cliente
		$query = "UPDATE negocio set nombre = '$nombre', nit = '$nit', celular = '$celular', direccion = '$direccion', correo = '$correo', meta = $meta where id=$id";
		$this->con->ejecutar($query);
	}




	public function getUsuarios(){
		$usuarios = array();
	
		$query = "select * from usuarios";
		$res = $this->con->ejecutar($query);
	
		while($reg = $res->fetch_object()){
			$u = new Usuario();
	
			$u->id = $reg->id;
			$u->nombre = $reg->nombre;
			$u->usuario = $reg->usuario;
			$u->password = $reg->password;
			$u->acceso = $reg->acceso;
	
			array_push($usuarios, $u);
		}
	
		return $usuarios;
	}





	public function buscarusu($id){
		$usuario = array();

		$query = "SELECT * from usuarios where id = $id";
		$res = $this->con->ejecutar($query);

		while($reg = $res->fetch_object()){
			$u = new Usuario();

			$u->id = $reg->id;
			$u->nombre = $reg->nombre;
			$u->usuario = $reg->usuario;
			$u->password = $reg->password;
			$u->acceso = $reg->acceso;

			array_push($usuario, $u);
		}

		return $usuario;
	}
	public function actualizar_usuario($id, $nombre, $usuario, $password, $acceso){
		//Actualizar usuarios
		$query = "UPDATE usuarios set nombre = '$nombre', usuario = '$usuario', password = '$password', acceso = $acceso where id=$id";
		$this->con->ejecutar($query);
	}

	public function insertuser($nombre, $usuario, $password_cifrada, $acceso){
		//nuevo usuario
		$query = "INSERT into usuarios values(null, '$nombre', '$usuario', '$password_cifrada', $acceso)";
		$this->con->ejecutar($query);
	}


	public function insertarCliente($nombre,$cedula,$direccion,$celular){
		$query = "INSERT into clientes values(null, '$nombre', '$cedula', '$direccion', $celular)";
		$this->con->ejecutar($query);



	}




	public function realizarcredito($cliente, $credito, $cajero){
		$query = "INSERT into creditos values(null, $cliente, '$cajero', now(),null , $credito,0 )";
		$res = $this->con->ejecutar($query);
		echo $query;
		echo "<br>";
	}

	public function getTodosCreditos(){
		$creditos = array();

		$query = "SELECT * from creditos";
		$res = $this->con->ejecutar($query);

		while($reg = $res->fetch_object()){
			$cre = new Creditos();

			$cre->id = $reg->id;
			$cre->cliente = $reg->cliente;
			$cre->monto = $reg->monto;
			$cre->gastado = $reg->saldo_pendiente;
			$cre->fecha_credito = $reg->fecha_credito;
			$cre->fecha_gasto = $reg->fecha_gasto;
			$cre->cajero = $reg->cajero;

			array_push($creditos, $cre);
		}

		return $creditos;
	}

	public function getCreditos($cedula){
		$creditos = array();

		$query = "SELECT * from creditos where cliente=$cedula ORDER BY id desc";
		$res = $this->con->ejecutar($query);

		while($reg = $res->fetch_object()){
			$cre = new Creditos();

			$cre->id = $reg->id;
			$cre->cliente = $reg->cliente;
			$cre->monto = $reg->monto;
			$cre->gastado = $reg->saldo_pendiente;
			$cre->fecha_credito = $reg->fecha_credito;
			$cre->fecha_gasto = $reg->fecha_gasto;
			$cre->cajero = $reg->cajero;

			array_push($creditos, $cre);
		}

		return $creditos;
	}

	public function buscarcreditocedula($cedula){
		$credito = array();

		$query = "SELECT * FROM creditos WHERE (id) = (SELECT id FROM creditos where cliente = $cedula ORDER BY id DESC LIMIT 1) AND cliente = $cedula";
		$res = $this->con->ejecutar($query);

		while($reg = $res->fetch_object()){
			$cre = new Creditos();

			$cre->id = $reg->id;
			$cre->cliente = $reg->cliente;
			$cre->cajero = $reg->cajero;
			$cre->fecha_credito = $reg->fecha_credito;
			$cre->fecha_gasto = $reg->fecha_gasto;
			$cre->monto = $reg->monto;
			$cre->gastado = $reg->saldo_pendiente;
			
			
			

			array_push($credito, $cre);
		}

		return $credito;
	}


	public function realizarabono($cedula, $abono, $atendido){
		$query = "SELECT * from creditos where cliente=$cedula AND id = (SELECT id FROM creditos where cliente=$cedula ORDER BY id DESC LIMIT 1)";
		$res = $this->con->ejecutar($query);

		$id_credito = 0;
		if ($reg = $res->fetch_object()) {
			$id_credito = $reg->id;
		}

		$query = "INSERT into abonos values(null, $cedula, $id_credito, $abono, now(), '$atendido')";
		$res = $this->con->ejecutar($query);

		$query = "SELECT saldo_pendiente from creditos where cliente=$cedula  AND id = $id_credito";
		$res = $this->con->ejecutar($query);
		$saldo_actual=0;

		if ($reg = $res->fetch_object()) {
			$saldo_actual=$reg->saldo_pendiente;
		}

		$saldo_actual -= $abono;

		$query = "UPDATE creditos set saldo_pendiente = $saldo_actual where cliente=$cedula  AND id = $id_credito";
		$res = $this->con->ejecutar($query);
	}


	public function getAbonos($cedula){
		$abonos = array();

		$query = "SELECT * from abonos  where id_cliente = $cedula ORDER BY id desc";
		$res = $this->con->ejecutar($query);

		while($reg = $res->fetch_object()){
			$ab = new Abono();

			$ab->id = $reg->id;
			$ab->id_credito = $reg->id_credito;
			$ab->cedula = $reg->id_cliente;
			$ab->abono = $reg->abono;
			$ab->atendido = $reg->atendido;
			$ab->fecha_abono = $reg->fecha_abono;
			

			array_push($abonos, $ab);
		}

		return $abonos;
	}

	public function deleteCliente($id){
		
		$query = "DELETE FROM clientes WHERE  id=$id  ";
		$this->con->ejecutar($query);
	}

	
//Nuevo Producto
	public function insertarProducto($referencia, $nombre,$cantidad, $precio_compra, $precio_venta){
		//nuevo cliente
		$query = "SELECT referencia FROM productos where referencia=$referencia LIMIT 1";
		$res = $this->con->ejecutar($query);

		if ($reg = $res->fetch_object()) {
			echo "<script>window.alert('Este producto ya fue ingresado al sistema.');</script>";
		} else {
			$query = "INSERT into productos values(null, '$referencia','$nombre', $cantidad, '$precio_compra', '$precio_venta')";
			$this->con->ejecutar($query);
		}
	}



	public function getProductos(){
		$productos = array();

		$query = "SELECT * from productos ORDER BY id desc";
		$res = $this->con->ejecutar($query);

		while($reg = $res->fetch_object()){
			$pro = new Producto();

			$pro->id = $reg->id;
			$pro->referencia = $reg->referencia;
			
			$pro->nombre = $reg->nombre;
			$pro->cantidad = $reg->cantidad;
			$pro->precio_compra = $reg->precio_compra;
			$pro->precio_venta = $reg->precio_venta;
           

			array_push($productos, $pro);
		}

		return $productos;
	}


	public function deleteProducto($id){
		
		$query = "DELETE FROM productos WHERE  id=$id  ";
		$this->con->ejecutar($query);
	}


	public function buscarPro($id){
		$producto = array();

		$query = "SELECT * from productos where id = $id";
		$res = $this->con->ejecutar($query);

		while($reg = $res->fetch_object()){
			$p = new Producto();

			$p->id = $reg->id;
			$p->referencia = $reg->referencia;
			$p->nombre = $reg->nombre;
			$p->cantidad = $reg->cantidad;
			$p->precio_compra = $reg->precio_compra;
			$p->precio_venta = $reg->precio_venta;

			array_push($producto, $p);
		}

		return $producto;

	}


	public function actualizar_producto ($id,$referencia, $nombre, $cantidad, $precio_compra, $precio_venta){
		//Actualizar usuarios
		$query = "UPDATE `productos` SET `referencia`=$referencia,`nombre`='$nombre',`cantidad`=$cantidad,`precio_compra`=$precio_compra,`precio_venta`=$precio_venta WHERE id =$id";
		$this->con->ejecutar($query);
	}


	public function buscarProductos($product){
		$products = array();

		$query = "SELECT * from productos where nombre like '%$product%' or referencia like '%$product%' ";
		$res = $this->con->ejecutar($query);

		while($reg = $res->fetch_object()){
			$p = new Producto();

			$p->id = $reg->id;
			$p->referencia = $reg->referencia;
			$p->nombre = $reg->nombre;
			$p->cantidad = $reg->cantidad;
			$p->precio_compra = $reg->precio_compra;
			$p->precio_venta = $reg->precio_venta;

			array_push($products, $p);
		}

		return $products;
	}
public function getEgresos(){
		$egresos = array();

		$query = "SELECT * from egresos ORDER BY id desc";
		$res = $this->con->ejecutar($query);

		while($reg = $res->fetch_object()){
			$egre = new Egreso();

			$egre->id = $reg->id;
			$egre->comentario = $reg->comentario;
			$egre->valor = $reg->valor;
			$egre->fecha = $reg->fecha;
			$egre->usuario = $reg->usuario;
			
           

			array_push($egresos, $egre);
		}

		return $egresos;
	}

	public function getEgresoshoy(){
		$egresos = array();
		$hoy = date("Y-m-d");
		$query = "SELECT * FROM egresos WHERE CAST(Fecha AS DATE)= '$hoy' ORDER BY id DESC";
		$res = $this->con->ejecutar($query);

		while($reg = $res->fetch_object()){
			$egre = new Egreso();

			$egre->id = $reg->id;
			$egre->comentario = $reg->comentario;
			$egre->valor = $reg->valor;
			$egre->fecha = $reg->fecha;
			$egre->usuario = $reg->usuario;
			
           

			array_push($egresos, $egre);
		}

		return $egresos;
	}


	public function getEgresosprueba(){
		$egresos = array();
		$hoy = date("Y-m-d");
		$query = "SELECT * FROM egresos WHERE CAST(Fecha AS DATE)= '$hoy' ORDER BY id DESC";
		$res = $this->con->ejecutar($query);

		while($reg = $res->fetch_object()){
			$egre = new Egreso();

			$egre->id = $reg->id;
			$egre->comentario = $reg->comentario;
			$egre->valor = $reg->valor;
			$egre->fecha = $reg->fecha;
			$egre->usuario = $reg->usuario;
			
           

			array_push($egresos, $egre);
		}

		return $egresos;
	}
     /*
	public function getEgresosmes(){
		$egresos = array();
		$mes = date("Y-m-");
		$query = "SELECT * FROM egresos WHERE CAST(Fecha AS DATE)= '$mes' ORDER BY id DESC";
		$res = $this->con->ejecutar($query);

		while($reg = $res->fetch_object()){
			$egre = new Egreso();

			$egre->id = $reg->id;
			$egre->comentario = $reg->comentario;
			$egre->valor = $reg->valor;
			$egre->fecha = $reg->fecha;
			$egre->usuario = $reg->usuario;
			
           

			array_push($egresos, $egre);
		}

		return $egresos;
	}*/
public function registrarEgreso($comentario,$valor,$responsable){
	$query = "INSERT into egresos values(null, '$comentario', '$valor', now(), '$responsable')";
	$this->con->ejecutar($query);



}

public function deleteEgreso($id){
$query= "DELETE FROM egresos WHERE id=$id";
$this->con->ejecutar($query);



}

public function ultimosPro(){
	$productos = array();
$query="SELECT `id`, `referencia`, `nombre`, `cantidad`, `precio_compra`, `precio_venta` FROM `productos` ORDER BY id DESC LIMIT 4";

		$res = $this->con->ejecutar($query);

		while($reg = $res->fetch_object()){
			$pro = new Producto();

			$pro->id = $reg->id;
			$pro->referencia = $reg->referencia;
		
			$pro->nombre = $reg->nombre;
			$pro->cantidad = $reg->cantidad;
			$pro->precio_compra = $reg->precio_compra;
			$pro->precio_venta = $reg->precio_venta;
           

			array_push($productos, $pro);
		}

		return $productos;

}


public function crear_cotizacion($lista_productos, $total, $clienteventa){
	//crear venta
	$query = "INSERT into cotizaciones values(null, now(), $clienteventa, $total)";
	$this->con->ejecutar($query);

	//rescatar ultima cotizacion (id)
	$query = "SELECT * FROM cotizaciones ORDER BY id DESC LIMIT 1";
	$res = $this->con->ejecutar($query);

	$idultimacotizacion=0;
	if ($reg = $res->fetch_object()) {
		$idultimacotizacion=$reg->id;
	}
	//insert en el detalles de cotizaciones
	$comentario="Nada";
	foreach ($lista_productos as $p) {
		$query="INSERT into detallescotizacion values(null,
		'".$idultimacotizacion."',
		'".$p->referencia."',
		'".$p->id."',
		'".$p->cantidad."',
		'".$comentario."',
		'".$p->subtotal."')";

		echo $query;
		echo "<br>";

		$this->con->ejecutar($query);
	} 
}

public function idultimacotizacion(){
	//rescatar ultima venta (id)
	$query = "SELECT * FROM cotizaciones ORDER BY id DESC LIMIT 1";
	$res = $this->con->ejecutar($query);

	$idultimacotizacion=0;
	if ($reg = $res->fetch_object()) {
		$idultimacotizacion=$reg->id;
	}
	return $idultimacotizacion;
}	

public function actualizar_stock($id, $stock_descontar){
	$query = "SELECT cantidad from productos where id=$id";
	$res = $this->con->ejecutar($query);
	$stock_actual=0;

	if ($reg = $res->fetch_object()) {
		$stock_actual=$reg->cantidad;
	}

	$stock_actual -= $stock_descontar;

	$query = "UPDATE productos set cantidad = $stock_actual where id=$id";
	$this->con->ejecutar($query);
}

public function crear_venta($lista_productos, $total, $clienteventa){
	//crear venta
	$acreditado = 0;
	$query = "INSERT into ventas values(null, now(), $clienteventa, $total, $acreditado)";
	$this->con->ejecutar($query);

	//rescatar ultima venta (id)
	$query = "SELECT * FROM ventas ORDER BY id DESC LIMIT 1";
	$res = $this->con->ejecutar($query);

	$idultimaventa=0;
	if ($reg = $res->fetch_object()) {
		$idultimaventa=$reg->id;
	}
	//insert en el detalle
	$comentario="Nada";
	foreach ($lista_productos as $p) {
		$query="INSERT into detalle values(null,
		'".$idultimaventa."',
		'".$p->referencia."',
		'".$p->id."',
		'".$p->stock."',
		'".$comentario."',
		'".$p->subtotal."',
		'".$p->descuento."')";

		$this->con->ejecutar($query);
		$this->actualizar_stock($p->id, $p->stock);
	} 
}


public function crear_venta_credito($lista_productos, $total, $clienteventa, $acreditado){
	//crear venta
	$query = "INSERT into ventas values(null, now(), $clienteventa, $total, $acreditado)";
	$this->con->ejecutar($query);

	// rescatar ultima venta (id)
	$query = "SELECT * FROM ventas ORDER BY id DESC LIMIT 1";
	$res = $this->con->ejecutar($query);

	$idultimaventa=0;
	if ($reg = $res->fetch_object()) {
		$idultimaventa=$reg->id;
	}
	//insert en el detalle
	$comentario="Nada";
	foreach ($lista_productos as $p) {
		$query="INSERT into detalle values(null,
		'".$idultimaventa."',
		'".$p->referencia."',
		'".$p->id."',
		'".$p->stock."',
		'".$comentario."',
		'".$p->subtotal."',
		'".$p->descuento."')";

		$this->con->ejecutar($query);
		$this->actualizar_stock($p->id, $p->stock);
	}
	$this->actualizar_credito($clienteventa, $acreditado);
}

public function actualizar_credito($clienteventa, $credito_descontar){
	$query = "SELECT id, monto, saldo_pendiente from creditos where cliente=$clienteventa and id = (SELECT id FROM creditos where cliente=$clienteventa ORDER BY id DESC LIMIT 1)";
	$res = $this->con->ejecutar($query);
	echo $query;
	echo "<br>";
	$credito_actual=0; $id_credito=0; $saldo_pen=0;

	if ($reg = $res->fetch_object()) {
		$credito_actual=$reg->monto;
		$id_credito=$reg->id;
		$saldo_pen=$reg->saldo_pendiente;
	}

	$credito_actual -= $credito_descontar;
	$saldo_pen += $credito_descontar;

	$query = "UPDATE creditos set monto = $credito_actual, saldo_pendiente = $saldo_pen where cliente=$clienteventa and id=$id_credito";
	$this->con->ejecutar($query);
}

public function idultimaventa(){
	//rescatar ultima venta (id)
	$query = "SELECT * FROM ventas ORDER BY id DESC LIMIT 1";
	$res = $this->con->ejecutar($query);

	$idultimaventa=0;
	if ($reg = $res->fetch_object()) {
		$idultimaventa=$reg->id;
	}
	return $idultimaventa;
}


public function ultimasVentas(){
	$ventas = array();
	$query="SELECT `id`, `fecha`, `cliente`, `total`, `acreditado` FROM `ventas` ORDER BY id DESC LIMIT 3";
	
			$res = $this->con->ejecutar($query);
	
			while($reg = $res->fetch_object()){
				$venta = new Venta();
	
				$venta->id = $reg->id;
				$venta->fecha = $reg->fecha;
			
				$venta->cliente = $reg->cliente;
				$venta->total = $reg->total;
				$venta->acreditado = $reg->acreditado;
				
			   
	
				array_push($ventas, $venta);
			}
	
			return $ventas;



}

public function ventasHoy(){

	$ventas = array();
	$hoy = date("Y-m-d");
	$query = "SELECT * FROM ventas WHERE CAST(Fecha AS DATE)= '$hoy' ORDER BY id DESC";
	$res = $this->con->ejecutar($query);

	while($reg = $res->fetch_object()){
		$venta = new Venta();
	
				$venta->id = $reg->id;
				$venta->fecha = $reg->fecha;
				$venta->cliente = $reg->cliente;
				$venta->total = $reg->total;
				$venta->acreditado = $reg->acreditado;
				
			   
	
				array_push($ventas, $venta);
			
	}

	return $ventas;


}

 public function  totalVentas(){
	$ventas = array();
	
	$query = "SELECT * FROM ventas ORDER BY id DESC";
	$res = $this->con->ejecutar($query);

	while($reg = $res->fetch_object()){
		$venta = new Venta();
	
				$venta->id = $reg->id;
				$venta->fecha = $reg->fecha;
				$venta->cliente = $reg->cliente;
				$venta->total = $reg->total;
				$venta->acreditado = $reg->acreditado;
				
			   
	
				array_push($ventas, $venta);
			
	}

	return $ventas;



 }

 public function getDetalles($id_venta){
	$query = "SELECT *
	from detalle d, productos p 
	where d.producto = p.id and d.venta=$id_venta";

	$detalles=array();

	$res = $this->con->ejecutar($query);
	while($reg = $res->fetch_object()){
		$d = new Detalle();
		$d->id=$reg->id;
		$d->referencia = $reg->referencia;
		$d->nomproducto=$reg->nombre;
		$d->idproducto=$reg->producto;
		$d->cantidad=$reg->stock;
		$d->subtotal=$reg->subtotal;
		$d->precio_compra=$reg->precio_compra;
		$d->precio=$reg->precio_venta;
		$d->descuento=$reg->descuento;

		array_push($detalles, $d);
	}
	return $detalles;
}
public function getAbonado(){
	$abonos = array();

	$query = "SELECT * from abonos ORDER BY id desc";
	$res = $this->con->ejecutar($query);

	while($reg = $res->fetch_object()){
		$ab = new Abono();

		$ab->id = $reg->id;
		$ab->id_credito = $reg->id_credito;
		$ab->cedula = $reg->id_cliente;
		$ab->abono = $reg->abono;
		$ab->atendido = $reg->atendido;
		$ab->fecha_abono = $reg->fecha_abono;
		

		array_push($abonos, $ab);
	}

	return $abonos;
}


	public function getAbonadoHoy(){
		$abonos = array();
		$hoy = date("Y-m-d");
		$query = "SELECT * FROM abonos WHERE CAST(fecha_abono AS DATE)= '$hoy' ORDER BY id DESC";
		$res = $this->con->ejecutar($query);
	
		while($reg = $res->fetch_object()){
			$ab = new Abono();
	
			$ab->id = $reg->id;
			$ab->id_credito = $reg->id_credito;
			$ab->cedula = $reg->id_cliente;
			$ab->abono = $reg->abono;
			$ab->atendido = $reg->atendido;
			$ab->fecha_abono = $reg->fecha_abono;
			
	
			array_push($abonos, $ab);
		}
	
		return $abonos;
	}


	public function getUtilidadHoy(){
		$hoy = date("Y-m-d");
		$query = "SELECT *
		from detalle d, productos p, ventas v
		where d.producto = p.id AND d.venta=v.id AND CAST(fecha AS DATE)= '$hoy' ";
	
		$detalles=array();
	
		$res = $this->con->ejecutar($query);
		while($reg = $res->fetch_object()){
			$d = new Detalle();
			$d->id=$reg->id;
			$d->referencia = $reg->referencia;
			$d->nomproducto=$reg->nombre;
			$d->idproducto=$reg->producto;
			$d->cantidad=$reg->stock;
			$d->subtotal=$reg->subtotal;
			$d->precio_compra=$reg->precio_compra;
			$d->precio=$reg->precio_venta;
			$d->descuento=$reg->descuento;
			$d->fecha=$reg->fecha;
			array_push($detalles, $d);
		}
		return $detalles;
	}

	public function getUtilidad(){
		
		$query = "SELECT *
		from detalle d, productos p, ventas v
		where d.producto = p.id AND d.venta=v.id ";
	
		$detalles=array();
	
		$res = $this->con->ejecutar($query);
		while($reg = $res->fetch_object()){
			$d = new Detalle();
			$d->id=$reg->id;
			$d->referencia = $reg->referencia;
			$d->nomproducto=$reg->nombre;
			$d->idproducto=$reg->producto;
			$d->cantidad=$reg->stock;
			$d->subtotal=$reg->subtotal;
			$d->precio_compra=$reg->precio_compra;
			$d->precio=$reg->precio_venta;
			$d->descuento=$reg->descuento;
			$d->fecha=$reg->fecha;
			array_push($detalles, $d);
		}
		return $detalles;
	}

}



?>