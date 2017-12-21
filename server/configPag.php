
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Confirmar pagos</title>
	<script src="../angular/angular.js"></script>
	<script src="../js/altasBajas.js"></script>
</head>
<body ng-app="aplicacion">
<? include 'layouts/header.php'; ?>
<?php
	session_start();
	if(!isset($_SESSION['key'])||$_SESSION['key']==""){
	echo "
	<h5>Usted no ha inicia sesion =(</h5>
	<a href='../sesion.php'>Click aqui para iniciar sesion</a>";

	}else{//hacemos la consulta para empezar a confirmar pagos
		if(isset($_GET['MensajeEdo'])){
			echo "<h2>".$_GET['MensajeEdo']."</h2>";
		}
		//mensaje de cerrar sesion 
		echo "<a href='cerrarSesion.php' title='Cerrar sesion'>Cerrar sesion</a>";

		include("Connection.class.php");

		//hacemos la conneccion
		$con = new Connection();
		if($con->hacerConeccion()){//si tenemos la conneccion
			$rs;
			if($rs=mysql_query("SELECT 
				e.cve_equ,e.mail_equ,e.nom_equ,e.tel_equ,e.pag_equ 
				from equipo as e;")){
				echo "<h1>Consultando equipos</h1>";
				while ($arrayEqu=mysql_fetch_array($rs)) {
				settype($arrayEqu['pag_equ'],"integer");
				?>	
				<form ng-controller="ConfigPag" method="POST" action="configPagServ.php" onsubmit ="return mensajeConf(this)" accept-charset="utf-8">
					<div name="Equipo">
						<h3>Equipo:<?php echo $arrayEqu['nom_equ'];?></h3>
						<h6>Mail:<?php echo $arrayEqu['mail_equ'];?></h6>
						<h6>tel:<?php echo $arrayEqu['tel_equ'];?></h6>
						<input type="submit" name="configPag" value="<?echo (($arrayEqu['pag_equ']!=1)?'Confirmar pago':'Quitar confirmacion');?>">
						<input type="hidden" name="cve_equ" value="<? echo $arrayEqu['cve_equ']?>">
						<input type="hidden" name="pag_equ" value="<? echo ($arrayEqu['pag_equ']==1)?0:1; ?>">
					</div>
				</form>

				<button ng-init="showRobots<?echo $arrayEqu['cve_equ'];?>=false" type="radio" ng-click="showRobots<?echo $arrayEqu['cve_equ'];?>=!showRobots<?echo $arrayEqu['cve_equ'];?>">Ver robots</button>
				<button ng-init="showCompetidores<?echo $arrayEqu['cve_equ'];?>=false" type="radio" ng-click="showCompetidores<?echo $arrayEqu['cve_equ'];?>=!showCompetidores<?echo $arrayEqu['cve_equ'];?>">Ver Competidores</button>

				<?php
					$sql = "select r.nom_rob, r.cve_rob, c.nom_cat from robot r inner join categoria c on c.cve_cat=r.cve_cat where r.cve_equ=".$arrayEqu['cve_equ'];
					//consultamos los robots 
					if($rs2 = mysql_query($sql)){
						while ($robots=mysql_fetch_array($rs2)) {
						?>
						<div id="Robots" ng-show="showRobots<?echo $arrayEqu['cve_equ'];?>">
							<h4>Robots</h4>
							<hr>
							<h6>Nombre robot: <?php echo $robots['nom_rob'];?></h6>
							<h6>Categoria robot: <?php echo $robots['nom_cat'];?></h6>
						</div><br>
						<?php
						}
					}else{
						echo "Fallo una consulta en la tabla robots".mysql_error();
					}
					//consultamos los comp 
					if($rs2 = mysql_query("
						SELECT cve_com, apmat_com,appat_com,nom_com FROM competidor where cve_equ=".$arrayEqu['cve_equ']."
						")){
						while ($resComp=mysql_fetch_array($rs2)) {
						?>
						<div id="Competidores" ng-show="showCompetidores<?echo $arrayEqu['cve_equ'];?>">
							
							<h6>Nombre competidor:<?php echo $resComp['appat_com']." ".$resComp['apmat_com']." ".$resComp["nom_com"];?></h6>
						</div><br>
						<?php
						}
					}else{
						echo "Fallo una consulta en la tabla competidores".mysql_error();
					}
				}
			}else{
				print("Fallo la consulta =(".mysql_error());
			}	
		}
		mysql_close();
	}
?>
</body>
</html>