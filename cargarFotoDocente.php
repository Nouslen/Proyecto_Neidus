<?php 
session_start();

if(empty($_SESSION['nombre'])){ 

header('Location:index.html');
}


	include("function/conexion.php");
	include("template/header.php");
	include("template/menu_admin.php");

if($_GET){
	$idusuario = $_GET['id'];
	$_SESSION['idp']= $_GET['id'];
	$consulta_buscar = "SELECT * FROM profesor WHERE idProfesor = ".$idusuario."";
	$resultado_buscar = mysqli_query($conexion,$consulta_buscar);
	if($fila_buscar = mysqli_fetch_assoc($resultado_buscar)){
		$idusuario=$fila_buscar['idProfesor'];
		if(!($fila_buscar['Foto']=="usuario.jpg")){
			$foto = $fila_buscar['Foto'];
			$nom_carp=$fila_buscar['nombreCarpeta'];

			$ruta = "images/".$nom_carp."";
			

		}else{
			$foto = "usuario.jpg";
			$ruta = "images/Alumno";
		}
	}else{
		$idusuario="";
		$foto = "usuario.jpg";
		$ruta = "images/Alumno";	
	}
}


if(isset($_POST['guardar'])){
//++++++++++++ INGRESAMOS LA FOTOGRAFIA DEL USUARIO ++++++++++++++++++++++
//Estos datos se reciben del input que recoge la imagen
	@$nombre_img = $_FILES['foto']['name'];
	@$tipo = $_FILES['foto']['type'];
	@$tamano = $_FILES['foto']['size'];
//Verificamos si existe imagen y tamaño correcto
	if(($nombre_img == !NULL) && ($_FILES['foto']['size']<=30000000)){
	//Ahora verificamos los formatos permitidos
		if(($_FILES["foto"]["type"]=="image/gif") || ($_FILES["foto"]["type"]=="image/jpeg") 
		|| ($_FILES["foto"]["type"]=="image/jpg") || ($_FILES["foto"]["type"]=="image/png")){
		//Indicamos la ruta donde subiremos los archivos
		//$ruta = "images/Profe_".$_SESSION['idp']."_".$_SESSION['apa']."";

		$sql_pre_parche="SELECT Foto FROM profesor WHERE idProfesor =".$_SESSION['idp']."";
		$resul_prep_parch=mysqli_query($conexion, $sql_pre_parche);
		$datosp=mysqli_fetch_assoc($resul_prep_parch);
		$prev_foto=$datosp['Foto'];
		


		// crear el nombreCarpeta
		$name_folder="Profe_".$_SESSION['idp']."_".$_SESSION['apa']."";

		$sqlup="UPDATE profesor SET nombreCarpeta='".$name_folder."' WHERE idProfesor=".$_SESSION['idp']."";
		mysqli_query($conexion, $sqlup);
		
		$ruta="images/".$name_folder."";

	
				
				
	//Con esto preguntamos si existe la carpeta y si no, la creamos
				
	if(!file_exists($ruta)){
		mkdir($ruta, 0777) or die("No se puede crear el directorio de extracci&oacute;n");	
	}



	//Ahora movemos la imagen desde el directorio temporal al directorio definitivo
		$nom_foto="Profe_".$idusuario."";
	
		
		if ($prev_foto==$nom_foto) {
			
			$pre_post_foto=$nom_foto."-".$_SESSION['idp'];
			$post_foto=$pre_post_foto;
		}else{

			$post_foto=$nom_foto;
		}






		move_uploaded_file($_FILES['foto']['tmp_name'],$ruta."/".$post_foto.".jpg");

		$query_mod="UPDATE profesor SET Foto='".$post_foto.".jpg' WHERE idProfesor=".$idusuario."";
		//Ahora actualizamos el nombre del archivo en la base de datos
		@$res_modif_foto=mysqli_query($conexion,$query_mod);
		$query_bus="SELECT idProfesor FROM profesor WHERE idProfesor=".$idusuario."";
		$sql_res=mysqli_query($conexion,$query_bus);

		while($row=mysqli_fetch_assoc($sql_res)){
			$idusuario=$row['idusuario'];		
		}
		@$_SESSION['modo']="cargar";
		header("location:mantenedor_doc.php");
		}else{
			//Si el formato no es permitido
			echo '<script type="text/javascript">alert("El formato del archivo no esta permitido.")</script>';
		}
	}else{
		//Si el archivo es de tamaño mayor al permitido
		if($nom_foto == !NULL)
		echo '<script type="text/javascript">alert("El archivo tiene un tamaño mayor al permitido.")</script>';
	}
}




 ?>


 <!DOCTYPE html>
 <html>
 <head>
 	<title>Cargar Foto Alumno</title>
 </head>
 <body>

<form name="cargaFoto" id="cargaFoto" enctype="multipart/form-data" action="" method="post">
<div class="container">
	<div class="row">
		<div align="center" class="col-md-12">
        <a href="<?php echo $ruta."/".$foto ?>" target="new">
        <img src="<?php echo $ruta."/".$foto ?>" alt="" width="240" height="270" id="fotografia_per" align="absmiddle" class="img-rounded" />
        </a>
        </div>
		<div class="row mt-4 container">
        <div class="form-group col-lg-8">
			<div class="input-group mb-3">
			  <div class="input-group-prepend">
				<span class="input-group-text">Subir imagen</span>
			  </div>
			  <div class="custom-file">
				<input type="file" class="custom-file-input" id="foto" name="foto">
				<label class="custom-file-label" for="foto">Haga Click Aquí para buscar imagen</label>
			  </div>
			</div>
		</div>	
		<div class="col-lg-4">
			<input type="submit" name="guardar" id="guardar" value="Guardar Fotografia" class="btn btn-success"/> 
		</div>
		</div>
    </div>
</div>
</form>


	<script src="js/jquery-3.5.0.min.js"></script>
	<script src="js/popper.min.js" ></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/main.js"></script>

 
 </body>
 </html>