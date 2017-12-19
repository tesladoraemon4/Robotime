<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Combate ahora</title>
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
	include ("Connection.class.php");
	$con = new Connection();
	if($con->hacerConeccion() && ($arrayInfo=$con->consultarPelea(
		(ctype_digit($_GET['num']))?$_GET['num']:-1
		))!==false){
?>
	<h1><?echo $arrayInfo[0]?> VS <?echo $arrayInfo[2]?></h1>
	<form action="fijarGanadorServ.php">

	Ganador<br>
	<select name="cve_gan">
		<option value="<?echo $arrayInfo[1];?>"><?echo $arrayInfo[0]?></option>
		<option value="<?echo $arrayInfo[3];?>"><?echo $arrayInfo[2]?></option>
	</select><br>
	

	<input type="hidden" name="lvp_pel" value="<?echo $arrayInfo[4]?>">
	<input type="hidden" name="cve_pel" value="<?echo $_GET['num']?>">
	<input type="hidden" name="arb_pel" value="<?echo $arrayInfo[5]?>">
	
	<input type="submit" value="Fijar ganador">

	</form>



<?php
	}else{
		echo "Ocurrio un error haciendo la coneccion";
	}
}
?>






	
</body>
</html>