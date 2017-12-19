<?php

	if(!(isset($_POST['Asunto'])&&isset($_POST['Email'])&&isset($_POST['Mensaje']))){
		echo "olvido llenar algun campo del formulario";
	}elseif(!preg_match(("/^[A-Za-z0-9ñÑáéíóúÁÉÚÍÓ :*=)&#(,;.?¿¡!\-_\\\ü]+$/"), $_POST['Asunto'])){
		echo "El asunto no cumple con el formato especificado";
		echo "Se admiten textos alfanumericos acentos, comas y puntos";
	}elseif (!preg_match(("/^[A-Za-z0-9ñÑáéíóúÁÉÚÍÓ :*=)&#(,;.?¿¡!\-_\\\ü]+$/"), $_POST['Mensaje'])) {
		echo "El Mensaje no cumple con el formato especificado";
		echo "Se admiten textos alfanumericos acentos, comas, arrobas y puntos";
	}elseif (!preg_match("/^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,4})$/", $_POST['Email'])) {
		echo "El Email no cumple con el formato especificado";
		echo "Ejemplo de formato hola@hotmail.com";
	}else{
		$remitente ="Form:<".$_POST['Email'].">";
		if(mail("tesladoraemon5@gmail.com", $_POST['Asunto'], $_POST['Mensaje'],$remitente)){
			$url="Se mando el mensaje satisfactoriamente";
		}else{
			$url="Ocurrio un error al mandar el mensaje";
		}
		header("Location:../contacto.php?mensaje=".urlencode($url));

	}

?>