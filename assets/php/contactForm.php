<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once 'PHPMailer/Exception.php';
require_once 'PHPMailer/PHPMailer.php';
require_once 'PHPMailer/SMTP.php';


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
		if(!is_int($name) || !is_numeric($name) && !empty($name) && strlen($name)>2 && strlen($name)<100){
			$validate_name = true;
		}else{
			$validate_name = false;
			$error = "name";
		}

		if(filter_var($email, FILTER_VALIDATE_EMAIL) && strlen($name)>2 && strlen($email)<150 && !empty($email)){
			$validate_email = true;
		}else{
			$validate_email = false;
			$error = "email";
		}

		if(strlen($message)>2 && strlen($message)<500 && !empty($message)){
			$validate_message = true;
		}else{
			$validate_message = false;
			$error = "message";
		}

		if(isset($_POST['terms'])){
			$validate_terms = true;
		}else{
			$validate_terms = false;
			$error = "terms";
		}
	}else{
		$error = "faltan_valores";
		header("Location:../../contacto.php?error=$error");
	}

	if($error != "ok"){
		header("Location:../../contacto.php?error=".$error);
	}elseif($error == "ok"){
		var_dump($_POST);
		$phpmailer = new PHPMailer(true);
		try{
			//configuración del servidor
			$phpmailer->SMTPDebug = false;
			$phpmailer->isSMTP();
			$phpmailer->Host = "smtp.gmail.com, smtp.live.com.com";
			$phpmailer->SMTPAuth = true;
		}catch(Exception $e){
			header("Location:".$phpmailer->ErrorInfo);
		}
	}

}//termina datos post

//$to = 'peasheeme@gmail.com';
?>