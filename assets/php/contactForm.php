<?php


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

		//a quién será enviado
		$destino = "juan_27angel@hotmail.com";

		//asunto
		$asunto = "Mensaje enviado desde la página web";

		//cabeceras para el envío del mail en formato html
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type: text/html; charset=UTF-8\r\n";

		//contenido del mensaje
		$contenido = '
			<!DOCTYPE html>
			<html lang="es">
			<head></head>
			<body>
				<h2>' . $name . ' ha enviado el siguiente mensaje a través de tu sitio web:</h2>
			
				<p>' . $message . '</p>
		
				<p>Contacta a  ' . $name . ' al correo:  <span style="color:blue;"> ' . $email . '</span> </p>
				
				<p>Ir a mi sitio web <span style="color:blue">http://www.lanzo.com.mx/</span></p>
			</body>
			</html>
		';

		//envío de mail
		$envio = mail($destino, $asunto, $contenido, $headers);

		if ($envio) {
			header("Location:../../contacto.php?enviado=Enviado correctamente");

			//enviando autorespuesta
			$pfw_header = "From: tucorreo@mail.comn"
				. "Reply-To: tucorreo@mail.comn";
			$pfw_subject = "Mensaje recibido";
			$pfw_email_to = "$email";
			$pfw_message = "Muchas Gracias $name, por su mensaje: $message"
				. "Su mensaje ha sido recibido satisfactoriamente. n"
				. "Nos pondremos en contacto contigo lo antes posible en su e-mail: $email n"
				. " n"
				. " n"
				. "--------------------------------------------------------------------------n"
				. "Favor de NO responder este E-mail ya que es generado Automaticamente.n";
			@mail($pfw_email_to, $pfw_subject, $pfw_message, $pfw_header);
		} else {
			header("Location:../contacto.php?error=Inténtelo de nuevo en unos momentos");
		}
	}
}//termina datos post

//$to = 'peasheeme@gmail.com';
