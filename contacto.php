<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Contacto</title>
	<script src="angular/angular.js"></script>
	<script src="js/altasBajas.js"></script>
	<script src="js/validaciones.js"></script>
</head>
<body>
<? include 'server/layouts/header.php'; ?>
	<h1>Contacto</h1>
	Direccion <br>
	Avenida siempre viva sin numero. <br>
	<?php 
		if(isset($_GET['mensaje'])){
			echo "<h1>".$_GET['mensaje']."</h1>";
		}
	?>

	<form id="form" action="server/contactoMail.php" method="POST" accept-charset="utf-8" onsubmit="return validarContacto()">
		<label>Asunto <br>
			<input id="asunto" type="text" name="Asunto" placeholder="Asunto" >
		</label><br>
		<label>Tu email<br>
			<input id="email" type="mail" name="Email" placeholder="email" >
		</label><br>
		<label>Mensaje <br>
			<textarea id="mensaje" name="Mensaje" placeholder="Escribe tu mensaje aqui"></textarea>
		</label><br>
		<input type="submit"  value="Enviar">
	</form>


</body>
</html>