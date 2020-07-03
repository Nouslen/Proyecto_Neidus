<?php

	require 'PHPMailer/PHPMailerAutoload.php';

	$mail = new PHPMailer();

	$mail->isSMTP();
	$mail->SMTPAuth = true;
	$mail->SMTPSecure = 'tls';
	$mail->Host = 'smtp.gmail.com';
	$mail->Port = '587';
	$mail->Username = '@gmail.com';
	$mail->Password = '';

	$mail->setFrom('@gmail.com','Codigos de programacion')''

	$mail->addAddress('bronipls@gmail.com','Prueba');
	$mail->
	$mail->Subject = 'Hola';
	$mail->Body = '<b>Hola amico jeje como estas</b>';
	$mail->IsHTML(true);

	if($mail->send()){
	echo 'Enviado';
	}else{
	echo "Error";
	}

?>