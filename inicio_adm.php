<?php 
session_start();


if(!(empty($_SESSION['nombre'])))
{
	include("function/conexion.php");
include("template/header.php");
include("template/menu_admin.php");
//echo var_dump($_SESSION['nombre']);


 ?>

<!DOCTYPE html>
<html>
<body>





admin aeaaaaaaaaaaaaaaaaa
<br><br><br><br><br><br>
<center><input type="image" src="https://pa1.narvii.com/6691/6376183e2cc600fb0eccfabb0f5dc6d38e48d164_00.gif" ></center>


<br><br><br><br>
 <a href="index.html" >Volver al inicio</a>
<br><br>




  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
     <script src="js/jquery-3.5.0.min.js"></script>
    <script src="js/popper.min.js" ></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>

<?php

}else{

	header('Location:index.html');
}
?>
