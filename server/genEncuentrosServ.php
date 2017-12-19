<?php
	session_start();
	if(!isset($_SESSION['key'])){
		echo "
		<h5>Usted no ha inicia sesion =(</h5>
		<a href='../sesion.php'>Click aqui para iniciar sesion</a>";
	}elseif ($_SESSION['key']!="12345") {
		echo "
		<h5>Usted no ha inicia sesion. =(</h5>
		<a href='../sesion.php'>Click aqui para iniciar sesion</a>";
	}else{
		include ("Connection.class.php");
		$con = new Connection();
		if($con->hacerConeccion()){
			$con->asignarPeleas();
		}else{
			$strMen="Ocurrio un error haciendo la coneccion";
		}


	}



?>