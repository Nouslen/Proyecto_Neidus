<?php
//inicia la sesión activa para este archivo
session_start();
//limpia la sesión
session_unset();
//destruye la sesión
session_destroy();
//redirecciona al archivo index
header("location: index.html");
?>