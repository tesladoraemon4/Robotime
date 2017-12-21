





<?session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>inicioSesionAdmin</title>
</head>
<body>
<? include 'layouts/header.php'; ?>

	<?php

		include("Connection.class.php");
		if(!isset($_SESSION['key'])){
			echo "
			<h5>Usted no ha inicia sesion =(</h5>
			<a href='../sesion.php'>Click aqui para iniciar sesion</a>";
		}elseif ($_SESSION['key']!="12345") {
			echo "
			<h5>Usted no ha inicia sesion =(</h5>
			<a href='../sesion.php'>Click aqui para iniciar sesion</a>";
		}else{
		?>

		Confirmar pagos <br>
		<a href='configPag.php'>Confirmar pagos</a>



		<?php 
		$con =new Connection();
		if($con->hacerConeccion()){
			$rs;
			if(!$con->yaFinalizoPeriodoRegistro()){
				mysql_close();
		?>
		<form action="terminarRegistros.php" method="post" onsubmit="confirm('Esta segura que desea terminar los registros de la competencia?') && confirm('Esta muy seguro(a) de eso?')">
			<h1>Si termina los registros de la competencia ya no se podran registrar mas usuarios.</h1>
			<input type="submit" value="Terminar registros de competencias">
		</form>
		<?php
			}
		}
		?>



		









	<?php
		}
	?>


<? include 'layouts/footer.php'; ?>
</body>
</html>














