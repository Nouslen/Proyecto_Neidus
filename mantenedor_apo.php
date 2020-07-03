<?php 

session_start();


if(empty($_SESSION['nombre'])){ 

header('Location:index.html');
}

	include("function/conexion.php");
	include("template/header.php");
	include("template/menu_admin.php");
	$mensaje = "";
if (empty($_POST)) {
	$run="";
	$nombres = "";
	$paterno = "";
	$materno = "";
	$correo = "";
	$telefono="";
	$edad = "";
	$sexo = "";
	$curso = "";
	$val_curso=-1;
	$nom_al="";
	$val_al="";

}else{
	$run=$_POST['run'];
	$nombres =$_POST['nombres'];
	$paterno =$_POST['paterno'];
	$materno =$_POST['materno'];
	$correo =$_POST['correo'];
	$telefono=$_POST['telefono'];
	$edad =$_POST['edad'];
	$sexo =$_POST['sexo'];
	$curso =$_POST['curso'];
	$val_al=$_POST['alumno'];


	$sql_pre_parche="SELECT id_alumno, Persona_Rut, Curso_id_Curso FROM alumno WHERE id_alumno =".$val_al."";
		$resul_prep_parch=mysqli_query($conexion, $sql_pre_parche);
		$datosp=mysqli_fetch_assoc($resul_prep_parch);
		$coper=$datosp['id_alumno'];
		$ruleta=$datosp['Persona_Rut'];
		$magikarp=$datosp['Curso_id_Curso'];

		$_SESSION['puxa']=$coper;

		$qsl="SELECT Nombre, Ap_Paterno, Ap_Materno FROM persona where Rut ='".$ruleta."'";
		$resuleta=mysqli_query($conexion, $qsl);
		$datosa=mysqli_fetch_assoc($resuleta);

		$charmander=$datosa['Nombre'];
		$charmaleon=$datosa['Ap_Paterno'];
		$charizard=$datosa['Ap_Materno'];

		$mega_charizard= $charmander." ".$charmaleon." ".$charizard."";
		$nom_al=$mega_charizard;
//aca va el nombre y valor del alumno

	
}

?>
<!-- CSS para los div de busqueda -->
<style type="text/css">
	#mostrar {
		/*estilos para el div principal en donde se muestran los resultados de la busqueda en forma de lista*/
		width: 400px;
		/* ancho del div que mostrara los resultados*/
		display: none;
		/* esconde el div de muestra os elementos encontrados*/
		overflow: hidden;
		/* oculta el contenido texto que desborde del div*/
	}

	.div_encontrado

	/*estilos para el div que muestra cada usuario encontrado*/
		{
		padding: 2px;
		padding-left: 10px;
		font-size: 16px;
		height: 65px;
		color: #FFF;
		background-color: #666;
	}

	.div_encontrado:hover {
		/*estilos para el div que muestra cada usuario encontrado. cuando el cursor se pocisiona sobre el area*/
		background-color: #1D66E8;
	}

	.div_detalle {
		/*estilo para el div que muestra el perfil*/
		color: #FFF;
		font-size: 16;
	}

	.div_detalle:hover

	/*estilo para el div que muestra el perfil. cuando el cursor se pocisiona sobre el area */
		{
		color: #F8DC20;
	}
</style>


<script src="js/jquery-3.5.0.min.js"></script>

<script type="text/javascript">
	$(document).ready(function() {
		$(".busca").keyup(function() //se crea la funcion keyup
			{
				var texto = $(this).val(); //se recupera el valor del input de texto y se guarda en la variable texto
				var cadenaBuscar = 'palabra=' + texto; //se guarda en una variable nueva para posteriormente pasarla a buscarUsuario.php
				if (texto == '') //si no tiene ningun valor el input de texto no realiza ninguna accion
				{} else {
					$.ajax({ //metodo ajax
						type: "POST", //aqui puede  ser get o post
						url: "buscarApoderado.php", //la url adonde se va a mandar la cadena a buscar
						data: cadenaBuscar,
						cache: false,
						success: function(html) //funcion que se activa al recibir un dato
						{
							$("#mostrar").html(html).show(); // funcion jquery que muestra el div con identificador mostrar, como formato html
						}
					});
				}
				return false;
			});
	});
</script>

	<script>
				$( document ).ready(function(){
    		$('#correo').blur(function(){
			//consultarUsuarioG();
			 if(!(document.reg_usuarios.correo.value==""))
				  {
						expresion = /\w+@\w+\.+[a-z]/;
			if (!expresion.test(document.reg_usuarios.correo.value)){
				
			alert ("El correo no es valido, introducir correo VALIDO");
			document.reg_usuarios.correo.focus();
					  document.reg_usuarios.correo.value="";
			return false;		
			}
				  }
	
		});
		});
			</script>

	

<?php

//******* para buscar ********************
if (@$_SESSION['modo'] == "cargar") {
	if (!empty($_GET['id'])) {

		$consu_run="SELECT * FROM apoderado WHERE id_apoderado ='".$_GET['id']."'";
		$resultado_run = mysqli_query($conexion, $consu_run);
		$encontra_run = mysqli_fetch_assoc($resultado_run);
		$runa=$encontra_run['Persona_Rut'];
		$nombreAlumno=$encontra_run['matricula_alumno'];
		$paso_curso=$encontra_run['Alumno_Curso_id_Curso'];
		$paso_alu=$encontra_run['Alumno_id_alumno'];

		$consu_curso="SELECT * FROM curso WHERE id_Curso=".$paso_curso."";
		$resu_curso=mysqli_query($conexion, $consu_curso);
		$enc_curso=mysqli_fetch_assoc($resu_curso);
		$nom_curso=$enc_curso['nombre_curso'];

		$consulta_buscar = "SELECT * FROM persona WHERE Rut ='".$runa. "'";
		$resultado_buscar = mysqli_query($conexion, $consulta_buscar);
		$encontrados = mysqli_num_rows($resultado_buscar);
		if ($encontrados > 0) {
			$fila_buscar = mysqli_fetch_assoc($resultado_buscar);
			$run = $runa;
			$nombres=$fila_buscar['Nombre'];
			$paterno = $fila_buscar['Ap_Paterno'];
			$materno = $fila_buscar['Ap_Materno'];
			$correo = $fila_buscar['correo'];
			$telefono = $fila_buscar['Telefono'];
			$edad = $fila_buscar['Edad'];
			$sexo = $fila_buscar['Sexo'];
			$curso=$nom_curso;
			$val_curso=$paso_curso;
			$val_al=$paso_alu;
			$nom_al=$nombreAlumno;
			

			
			$_SESSION['apa']=$paterno;

			
			
		} else {
			$_SESSION['modo'] = "";
			$run="";
			$nombres = "";
			$paterno = "";
			$materno = "";
			$correo = "";
			$telefono="";
			$edad = "";
			$sexo = "";
			$curso = "";
			$val_curso=-1;
			$ruta="images/Alumno/";
			$foto = "usuario.jpg";
		}
	}
}
//********* fin buscar *******************




//********** ingresar ********************
if (isset($_POST['btn_registrar'])) {
	//TODO: buscar usuario, armar query, ejecutar query, informar
	$consulta = "SELECT * FROM persona WHERE Rut='" . $run . "' OR correo='" . $correo . "'";
	$resultado = mysqli_query($conexion, $consulta);
	$encontrados = mysqli_num_rows($resultado);
	if ($encontrados > 0) {
		$mensaje = "<div class='alert alert-danger'><strong>Imposible Registrar</strong>, el usuario ya existe</div>";
	} else {
		//armar clave (5 primeros digitos del Run)
		$paso=explode(".",$run);
		if (isset($paso[1]) && isset($paso[2])) {
			$juntar=$paso[0].$paso[1].$paso[2];
		}else{
			$juntar=$paso[0].$paso[0].$paso[0];
		}
		
		$resul_clave= substr($juntar,0,5);
		

		//TODO: insert
		//armar query (Para persona)
		$sqlinsertar = "INSERT INTO persona (Rut, Nombre, Ap_Paterno, Ap_Materno, Telefono, Edad, Sexo, correo, numero, clave) VALUES ('" . $run . "', '" . $nombres . "', '" . $paterno . "', '" . $materno . "', '" . $telefono . "', " . $edad . ", '" . $sexo . "', '" . $correo . "', 2, '".$resul_clave."')";
		//ejecutar query
		$resultado = mysqli_query($conexion, $sqlinsertar);
		//Armar query para alumno
		
		

		$sql_insert_alumn="INSERT INTO apoderado ( matricula_alumno , estado, Persona_Rut, Alumno_id_alumno, Alumno_Curso_id_Curso) VALUES ('".$mega_charizard."', 1, '".$run."', ".$val_al.", ".$magikarp.")";
		$res_in_alu= mysqli_query($conexion, $sql_insert_alumn);

		

		//informamos ok	
		$mensaje = "<div class='alert alert-success'><strong>Usuario Registrado</strong></div>";
		//header('Location:mantenedor_al.php');
	}
}
//******** fin ingresar ******************


//********* modificar ********************
if (isset($_POST['btn_modificar'])) {
	$pichu="SELECT id_alumno, Curso_id_Curso FROM alumno WHERE id_alumno = ".$_SESSION['puxa']."";
	$pikachu= mysqli_query($conexion, $pichu);
	$raichu=mysqli_fetch_assoc($pikachu);
	$nuevo_curso=$raichu['Curso_id_Curso'];
	

	//TODO: buscar usuario, armar query, ejecutar query, informar
	$consulta = "SELECT id_apoderado, Persona_Rut, Alumno_id_alumno FROM apoderado WHERE id_apoderado='" . $_GET['id'] . "'";
	$resultado = mysqli_query($conexion, $consulta);
	$encontrados = mysqli_num_rows($resultado);
	$rowtwo=mysqli_fetch_assoc($resultado);
	$rut=$rowtwo['Persona_Rut'];
	$previo_alu=$rowtwo['Alumno_id_alumno'];
	

	if ($encontrados > 0) {
		//armar query  
		
		$sqlmodificar = "UPDATE persona SET Nombre = '" . $_POST['nombres'] . "', Ap_Paterno = '" . $_POST['paterno'] . "', Ap_Materno = '" . $_POST['materno'] ."', Telefono ='".$_POST['telefono']."', Edad ='".$_POST['edad']."', Sexo ='".$_POST['sexo']."', correo = '" . $_POST['correo']."' WHERE Rut ='".$rut."'";
		//ejecutar query
		mysqli_query($conexion, $sqlmodificar);

	$sql_up="UPDATE apoderado SET  matricula_alumno ='".$mega_charizard."', Alumno_id_alumno =".$_SESSION['puxa']." , Alumno_Curso_id_Curso = ".$nuevo_curso." WHERE id_apoderado =".$_GET['id']." AND Alumno_id_alumno=".$previo_alu."";
		mysqli_query($conexion, $sql_up);

		




		//informamos ok	
		
		$mensaje = "<div class='alert alert-success'><strong>Usuario Modificado</strong></div>";
		header('Location: mantenedor_apo.php');
		

	} else {
		$mensaje = "<div class='alert alert-danger'><strong>No se encontro el Registro del Usuario que desea Modificar</strong></div>";
	}
}

//******** fin modificar ******************



//********* eliminar ********************
if (isset($_POST['btn_eliminar'])) {
	//TODO: buscar usuario, armar query, ejecutar query, informar
	$consulta = "SELECT Persona_Rut FROM apoderado WHERE id_apoderado='" . $_GET['id'] . "'";
	$resultado = mysqli_query($conexion, $consulta);
	$encontrados = mysqli_num_rows($resultado);
	$rowtwo=mysqli_fetch_assoc($resultado);
	$run_del=$rowtwo['Persona_Rut'];

	if ($encontrados > 0) {
		//armar query
		$sqleliminar = "DELETE FROM apoderado WHERE id_apoderado = " . $_GET['id'] . "";
		//ejecutar query
		mysqli_query($conexion, $sqleliminar);

		$sql_del_perso = "DELETE FROM persona WHERE Rut = '" . $run_del . "'";
		//ejecutar query
		mysqli_query($conexion, $sql_del_perso);

		//informamos ok	
		header('Location: mantenedor_apo.php');
		$mensaje = "<div class='alert alert-success'>Usuario Eliminado</div>";
	} else {
		$mensaje = "<div class='alert alert-danger'><strong>No se encontro el Registro del Usuario que desea Eliminar</strong></div>";
	}
}
//******** fin eliminar ******************


 ?>
















 <!DOCTYPE html>
 <html>
 <head>
 	<title>Mantenedor Alumno</title>
 </head>
 <body>

 


<section class="container">
	<div class="row">
		<div class="container">
			<form enctype="multipart/form-data" action="" method="post" id="reg_usuarios" name="reg_usuarios">
				<div class="row alert alert-info mt-3">
					<div class="col-lg-4">
						<h5>Mantenedor de Apoderados</h5>
					</div>
					<!-- *************  BUSCADOR ******************** -->
					<div class="col-lg-8 input-group">
						<input type="text" class="busca form-control" placeholder="Ingrese nombre del apoderado a buscar" id="caja_busqueda" name="clave">
						<div id="mostrar"></div>
						<div class="input-group-append"><button class="btn btn-info" type="button" id="buscar_usu" name="buscar_usu" disabled>Buscar</button></div>
					</div>
					<!-- ************* FIN BUSCADOR ***************** -->
				</div>
				<div class="row">
					<div class="col-lg-9">

						<div class="row">

								<div class="form-group col-lg-3">
								<label for="Run">Run:</label>
								<input type="text" class="form-control" name="run" id="run" placeholder="Ingrese Run" value="<?php echo $run ?>"  <?php if (!(empty($_GET))) { ?> readonly="readonly"  <?php } ?>>
								</div>
								<div class="form-group col-lg-3">
								<label for="nombres">Nombres:</label>
								<input type="text" class="form-control" name="nombres" id="nombres" placeholder="Ingrese Nombre..." value="<?php echo $nombres ?>">
							</div>
							<div class="form-group col-lg-3">
								<label for="paterno">Apellido Paterno:</label>
								<input type="text" class="form-control" name="paterno" id="paterno" placeholder="Ingrese Apellido Paterno..." value="<?php echo $paterno ?>">
							</div>
							<div class="form-group col-lg-3">
								<label for="materno">Apellido materno:</label>
								<input type="text" class="form-control" name="materno" id="materno" placeholder="Ingrese Apellido Materno..." value="<?php echo $materno ?>">
							</div>

					    </div>



						<div class="row">
							<div class="form-group col-lg-3">
								<label for="telefono">Teléfono:</label>
								<input type="text" class="form-control" name="telefono" id="telefono" placeholder="Ingrese teléfono..." value="<?php echo $telefono ?>">
							</div>
							<div class="form-group col-lg-3">
								<label for="edad">Edad:</label>
								<input type="number" maxlength="3" min="0" max="130" class="form-control" name="edad" id="edad" placeholder="Ingrese edad..." value="<?php echo $edad ?>">
							</div>
							
							<div class="form-group col-lg-3">
							<label for="sexo">Sexo:</label>
							<select class="form-control" id="sexo" name="sexo">
								<?php 
								if (!(empty($_GET))) {
							 ?>
								<option value="<?php echo $sexo;?>"  selected=""><?php echo $sexo; ?></option>	
							<?php } ?>


							<?php if (empty($_GET)) {
								
							 ?>
							<option value="0">Seleccione sexo</option>
							<option value="Masculino">Masculino</option>
							<option value="Femenino">Femenino</option>
								<?php }else{  ?>

							<?php 
									if ($sexo=="Masculino") {
							?>
						
							<option value="Femenino">Femenino</option>

							<?php }else{
							 ?>
							<option value="Masculino">Masculino</option>

							<?php } } ?>


							</select>
							</div>
								
							<div class="form-group col-lg-3">
								<label for="correo">Correo Electronico:</label>
								<input type="email" class="form-control" name="correo" id="correo" placeholder="Ingrese su Correo..." value="<?php echo $correo ?>">
							</div>
						</div>

<?php 
		//activar si viene algo por get - inicio curso
					if (!(empty($_GET))) {  
						
?>					

						<div class="row">


							<div class="form-group col-lg-3">
								<label for="curso">Curso del alumno:</label>
								<input type="text" class="form-control" name="curso" id="curso" value="<?php echo $curso ?>" readonly="readonly">
							</div>

							
						</div>

  <?php  //fin curso
			}
  ?>
							

						
					</div>
					<div class="col-lg-2">
						
						<div class="container mt-4 "> <!--aca va el alumno -->

							<label for="alumno">Alumno:</label>
							<select class="form-control-sm" id="alumno" name="alumno" width="400px">
								
							</style>>
								<?php 
								if (!(empty($_GET))) {
							 ?>
							 <option value="<?php echo $val_al; ?>" selected>
									<?php echo $nom_al; ?>
								</option>
							
							<?php } ?>

							<?php if (empty($_GET)) {
								
							 ?>
							 <option value="0">Seleccione el Alumno</option>

								<?php } ?>

								<?php 
									$consulta_buscar = "SELECT * FROM alumno";
									$resultado_buscar = mysqli_query($conexion,$consulta_buscar);
									while($datosc=mysqli_fetch_array($resultado_buscar)){
									$taza=$datosc['Persona_Rut'];

									$consultal = "SELECT * FROM persona WHERE Rut='".$taza."'";
									$sql_resl=mysqli_query($conexion,$consultal);
									$rowal=mysqli_fetch_array($sql_resl);//sacamos nombre profe
									$nick=$rowal['Nombre']."";
									$nick_apa=$rowal['Ap_Paterno']."";
									$nick_ama=$rowal['Ap_Materno']."";
									$anivia= $nick." ".$nick_apa." ".$nick_ama."";


									if (!($val_al==$datosc['id_alumno'])) {
										
									
								 ?>

								<option value="<?php echo $datosc['id_alumno']; ?>">
									<?php echo $anivia; ?>
								</option>


							<?php
								}
							 } ?>
							</select>
						</div>
					</div>
				</div>
				<div class="container"><?php echo $mensaje; ?></div>
				<div class="container mt-3">
					<di class="col-lg-4">
						<input type="submit" name="btn_registrar" class="btn btn-success" value="Registrar Apoderado"   />
					</di>
					<di class="col-lg-4">
						<input type="submit" name="btn_modificar" class="btn btn-warning" value="Modificar Apoderado" />
					</di>
					<di class="col-lg-4">
						<input type="submit" name="btn_eliminar" class="btn btn-danger" value="Eliminar Apoderado" />
					</di>
				</div>
				<div id="buscarr"></div>
			</form>
		</div>
	</div>
 </section>




 <!-- jQuery first, then Popper.js, then Bootstrap JS -->
     
    <script src="js/popper.min.js" ></script>
    <script src="js/bootstrap.min.js"></script>
    


  </body>
  </html>