<!DOCTYPE html>
<html lang="en" ng-app="carrera">
<head>
	<style type="text/css">
	  .boton_personalizado{
	    text-decoration: none;
	    padding: 10px;
	    font-weight: 600;
	    font-size: 20px;
	    color: #ffffff;
	    background-color: #1883ba;
	    border-radius: 6px;
	    border: 2px solid #0016b0;
	  }
	</style>
	<meta charset="UTF-8">
	<title>Carrera ahora</title>
	<script src="../angular/angular.js"></script>
	<script src="../js/cronometro.js"></script>
	<script src="../js/carrera.js"></script>
	<link rel="stylesheet" type="text/css" href="../css/cronometroCSS.css">
</head>
<body>
<? include 'layouts/header.php'; ?>
<?php
session_start();
if(!isset($_SESSION['key']) && !isset($_GET['num'])){
	echo "
	<h5>Usted no ha inicia sesion o ocurrio un error. =(</h5>
	<a href='../sesion.php'>Click aqui para iniciar sesion</a>";
}elseif ($_SESSION['key']!="12345") {
	echo "
	<h5>Usted no ha inicia sesion o ocurrio un error. =(</h5>
	<a href='../sesion.php'>Click aqui para iniciar sesion</a>";
}else{
	include ("funciones.php");
	$arrayParams = getGetParams(['cve_rob','cve_equ','cve_cat']);
?>

<h1>CRONÓMETRO</h1>
<div id="cronometro">
  <div  id="reloj"> 00 : 00 : 00</div>
  <form name="cron" action="#">
    <input type="button" value="Empezar" name="empieza" />
    <input type="button" value="Parar" name="para" /><br/>
    <input type="button" value="Continuar" name="continua" />
    <input type="button" value="Reiniciar" name="reinicia" />
  </form>
</div>


<form method='POST'  onsubmit="return genPuntuaciones(this)" action='terminarCarrera.php' ng-controller="formCarrera">
	<!--
	PArametros para enviar
	-->
	<input type="hidden" value='' id="time_ran" name="time_ran">
	<input type="hidden" value='' id="pena_ran" name="pena_ran">
	<input type="hidden" value='' id="pun_ran" name="pun_ran">
	<input type="hidden" value="<?php echo $arrayParams[0];?>" name="cve_rob">
	<input type="hidden" value="<?php echo $arrayParams[1];?>" name="cve_equ">
	<input type="hidden" value="<?php echo $arrayParams[2];?>" name="cve_cat">


	<h1>Puntos actuales</h1>
	<div id="numPtos">{{numPtos}}</div>
	<a ng-click="sumPuntos()" class="boton_personalizado" href="#">+</a>
	<a ng-click="resPuntos()" class="boton_personalizado" href="#">-</a>
	<br>

	<h1>Penalizaciones</h1>
	<div id="numPen">{{numPen}}</div>
	<a ng-click="sumPen()" ng-click="sumPen()" class="boton_personalizado" href="#">+</a>
	<a ng-click="resPen()" ng-click="resPen()" class="boton_personalizado" href="#">-</a>
<?php
	if($arrayParams[2]!='1'){//si es  siguelineas
?>
	<br>
	<!--
		para drones 
	-->
	<label for="estructura">¿La estructura del Drone realizada por los integrantes del equipo?+10</label><br/>
	<input type="checkbox" name="estructura" value="10" id="estructura"/> 
	<br>
	<label for="control">¿El controlador de vuelo diseñado,manufacturado y programado por los integrantes del equipo?+30</label><br/>
	<input type="checkbox" name="control" value="30" id="control"/> 

	<br>
	<label for="controlProg">¿El controlador de vuelo programado por los participantes?+10</label><br/>
	<input type="checkbox" name="controlProg" value="10" id="controlProg"/> 

	<br>	
	<label for="drone">¿El drone ensamblado por los integrantes del equipo?+15</label><br/>
	<input type="checkbox" name="drone" value="15" id="drone"/> 

	<br>		
	<label for="droneComprado">¿El drone comprado RTF por los integrantes del equipo:?+5</label><br/>
	<input type="checkbox" name="droneComprado" value="5" id="droneComprado"/> 
<?php
	}
}
?>

<br>

<input type="submit" name="submit" value="Enviar">	
</form>

</body>
</html>