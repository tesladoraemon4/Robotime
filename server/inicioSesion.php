<?php



	if(!isset($_POST['user'])&&!isset($_POST['pass'])){
		echo "Faltaron datos en el formulario";
	}else{
		$user=$_POST['user'];
		$pass=$_POST['pass'];
		if(!(preg_match('/^[a-z0-9ñÑáéíóúÁÉÚÍÓ_\\_\ü]+$/', $user)&&preg_match('/^[a-z0-9ñÑáéíóúÁÉÚÍÓ_\\_\ü]+$/', $pass))){
			echo "El usuario y el pass no cumplen con el formato especificado";
		}elseif ($user=="admin"&&$pass=="12345") {
			session_start();//iniciamos la sesion
			$_SESSION['key']='12345';
			echo "Confirmar pagos <br>";
			echo "<a href='configPag.php'>Confirmar pagos</a>";
?>
	<form action="terminarRegistros.php" method="post" onsubmit="confirm('Esta segura que desea terminar los registros de la competencia?') && confirm('Esta muy seguro(a) de eso?')">
	<h1>Si termina los registros de la competencia ya no se podran registrar mas usuarios.</h1>
		<input type="submit" value="Terminar registros de competencia de sumo">
	</form>
<?php
		}elseif ($user=="juez"&&$pass=="12345") {
			session_start();//iniciamos la sesion
			$_SESSION['key']='12345';
			echo "Generar encuentros<br>";
			echo "<a href='genEncuentros.php'>Generar encuentros</a>";
		}else{
			echo "Usuario y contraseña incorrectos";
		}
	}
?>