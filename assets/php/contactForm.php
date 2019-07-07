<?php

if(isset($_POST)){
	function limpiarCampos($campo){
		$campo = stripcslashes($campo);
		$campo = trim($campo);
		$campo = htmlspecialchars($campo);

		return $campo;
	}

	$name = limpiarCampos($_POST['c_name']);
	$email = limpiarCampos($_POST['c_email']);
	$message = limpiarCampos($_POST['c_message']);

	$error = "faltan_valores";

	if($name && $email && $message){
		$error = "ok";
		if(!is_int($name) || !is_numeric($name)){
			$validate_name = true;
		}else{
			$validate_name = false;
			$error = "name";
		}

		if(filter_var($email, FILTER_VALIDATE_EMAIL) && strlen($email)>10){
			$validate_email = true;
		}else{
			$validate_email = false;
			$error = "email";
		}

		if(strlen($message)>2 && strlen($message)<500){
			$validate_message = true;
		}else{
			$validate_message = false;
			$error = "message";
		}
	}else{
		$error = "faltan_valores";
		header("Location:../../contacto.php?error=$error");
	}

	if($error != "ok"){
		header("Location:../../contacto.php?error=".$error);
	}elseif($error == "ok"){
		var_dump($_POST);
	}

}//termina datos post

	//$to = 'peasheeme@gmail.com';


?>