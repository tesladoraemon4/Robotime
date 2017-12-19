<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Incio de sesion</title>
	<link rel="stylesheet" type="text/css" href="css/hojaNormal.css">
	<script type="text/javascript" src="js/validaciones.js"></script>

</head>
<body>
<? include 'server/layouts/header.php'; ?>
	<form action="server/inicioSesion.php" method="POST" accept-charset="utf-8" onsubmit="return validarInicioSesion()">
		<label>USUARIO <br>
			<input id="user" maxlength="25" type="text" name="user" placeholder="Usuario">
		</label>
		<br>
		<label>PASSWORD <br>
			<input id="pass" maxlength="100" type="password" name="pass" placeholder="Password">
		</label>
		<br>
		<input type="submit" value="Iniciar Sesion">
	</form>






</body>
</html>