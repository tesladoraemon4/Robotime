<?session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Generar encuentros</title>
</head>
<body>
<? include 'layouts/header.php'; ?>

	<?php
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
			
		<form  action="genEncuentrosServ.php">
			<input type="submit" value="Obtener encuentro">
		</form>
	<?php
		}
	?>
</body>
</html>