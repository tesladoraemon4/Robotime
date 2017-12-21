
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
	include ("Connection.class.php");
	$arrayParams = getPostParams(['time_ran','pena_ran','pun_ran','cve_rob','cve_equ','cve_cat']);
	$con =new Connection();
	$strMensajeEdo="";
	if($con->hacerConeccion()){
		$rs;
		//$cve_rob,$pun_ran,$time_ran,$paso_ran,$pena_ran
		if($con->actualizaRanking($arrayParams[3],$arrayParams[2],$arrayParams[0],'1',
			$arrayParams[1])){
			mysql_close();
			$strMensajeEdo.="<br>Se actualizo satisfactoriamente el puntaje.<br>";
		}else{
			$strMensajeEdo.="No se actualizo el estado del ranking.".mysql_error();
			mysql_close();
		}
	}else{
		$strMensajeEdo.="No se logro conectar con la BD.";
	}
	header("Location:inicioSesionJuez.php?MensajeEdo=".urlencode($strMensajeEdo));
}
?>