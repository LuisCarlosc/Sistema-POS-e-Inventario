<?php 
class Conexion{
 
	public function __construct(){

		$mysqli = new mysqli('127.0.0.1', 'root', '', 'agropecuaria');
		$mysqli->set_charset("utf8");

		if (!$mysqli) {
			die("Error al conectar: ".mysql_error());
        }
        
	}

	public function ejecutar($query){
		$mysqli = new mysqli('127.0.0.1', 'root', '', 'agropecuaria');
		$mysqli->set_charset("utf8");
		return $mysqli->query($query);
	}
}
?>