<?php 

$hola="19.000.678-k";
$paso=explode(".",$hola);
echo $paso[0];
echo $paso[1];
echo $paso[2];
echo "<br>";
$juntar=$paso[0].$paso[1].$paso[2];
$resul= substr($juntar,0,5);
echo $resul;
 ?>


