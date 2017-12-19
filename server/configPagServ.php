<?php
	//hacemos la consirmacion de pago a x equipo
	session_start();

	if(!isset($_SESSION['key'])||$_SESSION['key']==""){
		echo "
		<h5>Usted no ha inicia sesion =(</h5>
		<a href='../sesion.php'>Click aqui para iniciar sesion</a>";
	}else{
		if(!isset($_POST['cve_equ']) ||!isset($_POST['pag_equ']) || !preg_match("/\d{1,11}/", $_POST['cve_equ'])|| !preg_match("/\d{1}/", $_POST['pag_equ'])){
			$string ="Falto un parametro en el formulario o no cumple con el formato especificado";
		}else{
			require 'Connection.class.php';
			$cve_equ =$_POST['cve_equ'];
			$pag_equ =$_POST['pag_equ'];
			$con = new Connection();
			if($con->hacerConeccion()){
				$sql = "UPDATE `equipo` SET equipo.pag_equ=".$pag_equ." WHERE cve_equ=".$cve_equ.";";
				if(mysql_query($sql)){
					$string = "La actualizacion fue un exito =)";

				}else{
					$string = "No se pudo realizar la actualizacion";
				}
			}else{
				$string =("Fallo la coneccion =(".mysql_error());
			}


		}

		header("Location:configPag.php?MensajeEdo=".urlencode($string));
		exit();
	}

?>