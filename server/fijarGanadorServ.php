<?php //fijamos el ganador de x encuentro 
	session_start();

	if(!isset($_SESSION['key'])){
		echo "
		<h5>Usted no ha inicia sesion o ocurrio un error. =(</h5>
		<a href='../sesion.php'>Click aqui para iniciar sesion</a>";
	}elseif ($_SESSION['key']!="12345") {
		echo "
		<h5>Usted no ha inicia sesion o ocurrio un error. =(</h5>
		<a href='../sesion.php'>Click aqui para iniciar sesion</a>";
	}else{//hacemos la coneccion
		include 'Connection.class.php';
		include 'funciones.php';
		$con = new Connection();

		if($con->hacerConeccion() && existenParametrosGet(['cve_gan','lvp_pel','cve_pel','arb_pel'])){
			$values = getGetParams(['cve_gan','lvp_pel','cve_pel','arb_pel']);
			echo "Subimos la pelea ";
			$con->subirPelea($values[2],$values[0],$values[1],$values[3]);

		}else{
			echo "No se pudo hacer conneccion con la BD =(";
			mysql_close();
		}
	}

	
?>