<?php

	// Contact
	$to = 'peasheeme@gmail.com';
    $subject = 'Mensaje de contacto de Eureka webpage';

	if(isset($_POST['c_name']) && isset($_POST['c_email']) && isset($_POST['c_message'])){
   		$name    = $_POST['c_name'];
    	$from    = $_POST['c_email'];
    	$message = $_POST['c_message'];

		if (mail($to, $subject, $message, $from)) { 
			$result = array(
				'message' => 'Gracias por contactarnos.',
				'sendstatus' => 1
				);
			echo json_encode($result);
		} else { 
			$result = array(
				'message' => 'Lo sentimos, Algo salio mal',
				'sendstatus' => 1
				);
			echo json_encode($result);
		} 
	}

?>