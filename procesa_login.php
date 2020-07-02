<?php
include("function/conexion.php");
session_start();

@$rut = $_POST['rut'];
@$pass = $_POST['pass'];




$consulta = "SELECT Nombre,Ap_Paterno,numero FROM persona WHERE Rut = '" . $rut . "' AND clave = '" . $pass . "'";

$resultado = mysqli_query($conexion, $consulta) or die("<strong> Lo sentimos, algo salió mal :( </strong>");

$encontrados = mysqli_num_rows($resultado);
if ($encontrados > 0) {
	$filaEncontrada = mysqli_fetch_assoc($resultado);
	$_SESSION['nombre'] = $filaEncontrada['Nombre']." ".$filaEncontrada['Ap_Paterno'] ;
	
	$_SESSION['numero'] = $filaEncontrada['numero'];


switch ($_SESSION['numero']) {
    case 1:
        header("location: inicio_al.php");
        break;
    case 2:
        header("location: inicio_ap.php");
        break;
    case 3:
        header("location: inicio_doc.php");
        break;
    case 4:
        header("location: inicio_adm.php");
        break;
}



}else{

	header("location: index.html");
}
	
	














?>