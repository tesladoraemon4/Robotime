<?php



	if(!isset($_POST['user'])&&!isset($_POST['pass'])){
		echo "Faltaron datos en el formulario";
	}else{
		//validamos los parametros
		$user=$_POST['user'];
		$pass=$_POST['pass'];
		if(!(preg_match('/^[a-z0-9ñÑáéíóúÁÉÚÍÓ_\\_\ü]+$/', $user)&&
			preg_match('/^[a-z0-9ñÑáéíóúÁÉÚÍÓ_\\_\ü]+$/', $pass))){
			echo "El usuario y el pass no cumplen con el formato especificado";
		}elseif ($user=="admin"&&$pass=="12345") {

			session_start();//iniciamos la sesion
			$_SESSION['key']='12345';
			header("Location:inicioSesionAdmin.php");

		}elseif ($user=="juez"&&$pass=="12345") {
			session_start();//iniciamos la sesion
			$_SESSION['key']='12345';
			header("Location:inicioSesionJuez.php");


		}else{
			echo "Usuario y contraseña incorrectos";
		}
	}
?>