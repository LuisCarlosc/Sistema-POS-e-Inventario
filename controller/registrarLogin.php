<?php
session_start();
?>
<?php

$host_db = "localhost";
$user_db = "root";
$pass_db = "";
$db_name = "agropecuaria";
$tbl_name = "usuarios";

$conexion = new mysqli($host_db, $user_db, $pass_db, $db_name);

if ($conexion->connect_error) {
 die("La conexion falló: " . $conexion->connect_error);
}

$username = $_POST['username'];
$password = $_POST['password'];


$sql = "SELECT * FROM $tbl_name WHERE usuario = '$username'";

$result = $conexion->query($sql);


if ($result->num_rows > 0) {
}

 $row = $result->fetch_array(MYSQLI_ASSOC);

 if (password_verify($password, $row['password'])) { 
 
    $_SESSION['loggedin'] = true;
    $_SESSION['username'] = $username;
    $_SESSION['nombre'] = $row['nombre'];
    $_SESSION['acceso'] = $row['acceso'];
    $_SESSION['clienteventa'] = "";

    $_SESSION['mostrarinfo'] = 1;

    header('Location: /agropecuaria/index.php');
    

 }else{
   echo "Username o Password estan incorrectos.";

   echo "<br><a href='../'>Volver a Intentarlo</a>";
 }
 mysqli_close($conexion); 
 ?>