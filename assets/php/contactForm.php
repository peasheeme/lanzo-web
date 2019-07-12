<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require_once 'PHPMailer/Exception.php';
require_once 'PHPMailer/PHPMailer.php';
require_once 'PHPMailer/SMTP.php';


if (isset($_POST)) {
	function limpiarCampos($campo)
	{
		$campo = stripcslashes($campo);
		$campo = trim($campo);
		$campo = htmlspecialchars($campo);

		return $campo;
	}

	$name = limpiarCampos($_POST['c_name']);
	$email = limpiarCampos($_POST['c_email']);
	$message = limpiarCampos($_POST['c_message']);

	$error = "faltan_valores";

	if ($name && $email && $message) {
		$error = "ok";
		if (!is_int($name) || !is_numeric($name) && !empty($name) && strlen($name) > 2 && strlen($name) < 100) {
			$validate_name = true;
		} else {
			$validate_name = false;
			$error = "name";
		}

		if (filter_var($email, FILTER_VALIDATE_EMAIL) && strlen($name) > 2 && strlen($email) < 150 && !empty($email)) {
			$validate_email = true;
		} else {
			$validate_email = false;
			$error = "email";
		}

		if (strlen($message) > 2 && strlen($message) < 500 && !empty($message)) {
			$validate_message = true;
		} else {
			$validate_message = false;
			$error = "message";
		}

		if (isset($_POST['terms'])) {
			$validate_terms = true;
		} else {
			$validate_terms = false;
			$error = "terms";
		}
	} else {
		$error = "faltan_valores";
		header("Location:../../contacto.php?error=$error");
	}

	if ($error != "ok") {
		header("Location:../../contacto.php?error=" . $error);
	} elseif ($error == "ok") {
		
		$phpmailer = new PHPMailer(true);
		$phpmailer->CharSet = 'UTF-8';
		try {
			//configuración del servidor
			$phpmailer->SMTPDebug = false;
			$phpmailer->isSMTP();
			$phpmailer->Host = "smtp.gmail.com; smtp.live.com";
			$phpmailer->SMTPAuth = true;
			$phpmailer->Username = "lanzoweb@gmail.com";
			$phpmailer->Password = "lanzoweb1234";
			$phpmailer->SMTPSecure = 'tls';
			$phpmailer->Port = 587;

			//recipients
			$phpmailer->setFrom($email, $name);
			$phpmailer->addReplyTo('juan_27angel@hotmail.com', 'Juan Angel Hernández Antopia');
			$phpmailer->addAddress('juan_27angel@hotmail.com', 'Juan Angel Hernández Antopia');

			//Content
			$phpmailer->isHTML(true);
			$phpmailer->Subject = 'Mensaje desde la página web';
			$phpmailer->addEmbeddedImage('../images/logo.png', 'logo', 'logo.png');
			$phpmailer->Body = '
					<p>
						<h1>Mensaje de la página web</h1>
						
						<p style="font-size:15px;">' . $message . '</p>
					</p>
					
					<p style="font-size:15px;">
						Puedes ponerte en contacto con <strong>' . $name . '</strong> al correo: <a href="' . $email.'"></a>
					</p>

					<p>
						<img src="cid:logo" alt="logo" width="85">
					</p>
			';

			//permisos para usar ssl
			$phpmailer->SMTPOptions = array('ssl' => array(
				'verify_peer' => false,
				'verify_peer_name' => false,
				'allow_self_signed' => true
			));

			$send = $phpmailer->send();

			if($send){
				header("Location:../../contacto.php?enviado=correctamente");
			}else{
				header("Location:../../contacto.php?fallo");
			}
		} catch (Exception $e) {
			header("Location:../../contacto.php?error=" . $phpmailer->ErrorInfo);
		}
	}
}//termina datos post

//$to = 'peasheeme@gmail.com';