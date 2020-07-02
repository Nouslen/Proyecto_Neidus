<?php 

//session_start();


$nombreCompleto=$_SESSION['nombre'];
 ?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="inicio_adm.php">
    <input type="image" name="logo" value="logo" src="https://images-wixmp-ed30a86b8c4ca887773594c2.wixmp.com/f/2b374a72-5b0e-416c-8568-026b37f3253c/ddmboc3-65cca47b-8e2d-47ad-9433-14314281cd37.gif?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ1cm46YXBwOiIsImlzcyI6InVybjphcHA6Iiwib2JqIjpbW3sicGF0aCI6IlwvZlwvMmIzNzRhNzItNWIwZS00MTZjLTg1NjgtMDI2YjM3ZjMyNTNjXC9kZG1ib2MzLTY1Y2NhNDdiLThlMmQtNDdhZC05NDMzLTE0MzE0MjgxY2QzNy5naWYifV1dLCJhdWQiOlsidXJuOnNlcnZpY2U6ZmlsZS5kb3dubG9hZCJdfQ.uieUJZu0bju6PQeWQdq6g25pBaHG2A5f3DYhGtPVeA4" width="40px" length="40px" ></a>


  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">

 <ul class="navbar-nav">
      
      
      <li class="nav-item">
        <a class="nav-link" href="inicio_adm.php">Inicio <span class="sr-only">(current)</span></a>
      </li>


     <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown"   aria-haspopup="true" aria-expanded="false" >Mantenedores</a>
     <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
      <a class="dropdown-item" href="mantenedor_al.php">Alumnos</a>
      </div>
      </li>
    
  </ul>
  </div>
  <span class="text-white mr-5 ">Bienvenido:<?php echo " <strong>".$nombreCompleto."</strong>, con perfil: <strong>Administrador</strong>" ?> </span><a href="cerrar_sesion.php" class="text-warning">Cerrar Sesión</a>
</nav>

<script>
$(document).ready(function(){
  $(".dropdown-toggle").dropdown("toggle");
});
</script>