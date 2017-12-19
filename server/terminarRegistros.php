<?php //termina los registros de la comptetencia 
//y se insertan a la tabla pelea todos los usuarios existentes en la BD.
	include 'Connection.class.php';
	$con = new Connection();
	if($con->hacerConeccion()){
		$strMen="";
		if($con->terminarRegistros())
		{
			$strMen = "Se termino el periodo de registro satisfactoriamente";
		}else{
			$strMen="Ocurrio un error cuando se generaban las tablas de la competencia (contacte con el admin del sistema)";
		}
		header("Location:configPag.php?MensajeEdo=".urlencode($strMen));
	}else{
		print("Ocurrio un error al hacer la coneccion =(");
	}
?>