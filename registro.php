<!DOCTYPE html>
<html lang="en" ng-app="formulario">
<head>
	<meta charset="UTF-8">
	<title>Registro</title>
	<link rel="stylesheet" type="text/css" href="css/hojaNormal.css">
	<script src="angular/angular.js"></script>
	<script src="js/formulario.js"></script>
</head>
<body ng-controller="formRegistro"> 
	<? include 'server/layouts/header.php'; ?>

	<form method="POST" onsubmit="return validar()" class="css-form" action="server/registro/registroServ.php">
		<label for="nombreEquipo">
			Nombre equipo:<br>
			<input id="nombreEquipo" type="text" placeholder="Ej. Los php istas" name="nombreEquipo"  maxlength="25" required>
		</label>
		<br>
		<label for="mail">
			Email del equipo:<br>
			<input id="mail" type="email" name="mail" placeholder="Ej. phpRobot@mail.com" maxlength="25" required>
		</label>
		<br>
		<label for="tel">
			Telefono del equipo:<br>
			<input id="tel" type="tel" name="tel" placeholder="Ej. 453263456345 (10 digitos)" maxlength="15" required>
		</label>
		<br>
		Numero de competidores: <br>
		{{numComp}}
		<input type="hidden" name="numComp" value="{{numComp}}">
		<input type="hidden" name="numRob" value="{{numRob}}">
				

		<button ng-click="sumC()">+</button>
		<button ng-click="resC()">-</button>
		<div ng-repeat="competidor in competidores">
			<label>
				Nombre:<br>
				<input name="nombre{{$index+1}}" ng-model="competidor.nombre" placeholder="Nombre" required maxlength="25">
			</label>
			<br>
			<label>
			<label>
				Apellido paterno: <br>
				<input name="apPat{{$index+1}}" ng-model="competidor.apPat" placeholder="Apellido paterno:" type="text" required maxlength="25">		
			</label>
			<br>
			<label>
				Apellido materno:<br>
				<input name="apMat{{$index+1}}" ng-model="competidor.apMat" placeholder="Apellido materno:" type="text" required maxlength="25">		
			</label>
			<br>
			Capitan: <input id ="capitan{{$index+1}}" name="capitasdfg{{$index+1}}" type="checkbox" ng-click="onlyUneCap(e)" ng-model="competidor.esCapitan" value="false">
			<input id="capitan{{$index+1}}" type="hidden" name="capitan{{$index+1}}" value="false">
			<br><hr>
		</div>
		<br>
		Numero de robots: <br>
		{{numRob}}
		<button ng-click="sumR()">+</button>
		<button ng-click="resR()">-</button>
		<div ng-repeat="robot in robots">
			<label>
				Nombre del robot:<br>
				<input name="nombreR{{$index+1}}" ng-model="robot.nom" placeholder="Nombre" type="text" required="Falta el nombre del robot">
			</label>
			<br>
			Categoria: <br>
			<select id="Categoria{{$index+1}}" name="Categoria{{$index+1}}" ng-repeat="categoria in categorias"  ng-model="robot.cat" required>
				<option 
				value="{{categorias[$index].nom}}">{{categoria.nom}}</option>
			</select>

			<br><hr>
		</div>
		<br>
		<br>
		<hr>
		<input type="submit" name="submit" value="Enviar">	
	</div>
	
	<? include 'server/layouts/footer.php'; ?>
	
</body>
</html>