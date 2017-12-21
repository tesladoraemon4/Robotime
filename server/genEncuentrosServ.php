<?php
	session_start();
	if(!isset($_SESSION['key'])){
		echo "
		<h5>Usted no ha inicia sesion =(</h5>
		<a href='../sesion.php'>Click aqui para iniciar sesion</a>";
	}elseif ($_SESSION['key']!="12345") {
		echo "
		<h5>Usted no ha inicia sesion. =(</h5>
		<a href='../sesion.php'>Click aqui para iniciar sesion</a>";
	}else{
		include ("Connection.class.php");
		include ("funciones.php");
		include 'layouts/header.php';

		$con = new Connection();
		$categoria=getPostParams(["Categoria"])[0];
		if($con->hacerConeccion() && $con->yaFinalizoPeriodoRegistro()){
			$sql = "
			select ro.cve_rob,e.cve_equ,ro.nom_rob,e.nom_equ 
			from ranking r 
			inner join robot ro on r.cve_rob=ro.cve_rob 
			inner join equipo e on e.cve_equ=ro.cve_equ 
			where ro.cve_cat=".$categoria." and paso_ran=0 
			limit 1;";
			echo $sql;
			if($rs=mysql_query($sql)){
				$numero = mysql_num_rows($rs);
				if($numero==0){
					mysql_close();
					header("Location:inicioSesionJuez.php?MensajeEdo=".urlencode("Ya pasaron todos los concursantes de la categoria escogida"));
				}else{
					$array = mysql_fetch_array($rs);
					$strMensaje="";
					$con->actualizaRanking($array['cve_rob'],'0','00:00:00','null','0');
					mysql_close();
					header("Location:carrera.php?MensajeEdo=".
					urlencode('Va a competir el robot '.$array['nom_rob'].' del equipo '.$array['nom_equ']).
					'&cve_rob='.urlencode($array['cve_rob']).
					"&cve_equ=".urlencode($array['cve_equ']).
					"&cve_cat=".urlencode("".$categoria));
				}
			}
		}else{
			echo "Ocurrio un error haciendo la coneccion";
		}


	}



?>