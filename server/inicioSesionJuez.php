<?session_start();?>
<?php
	include("Connection.class.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>inicioSesionAdmin</title>
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

		<form  action="genEncuentrosServ.php" method='POST'>
			<input type="submit" value="Obtener encuentro">

			<select id="Categoria" name="Categoria" required>
			<?php 
				$con =new Connection();
				if($con->hacerConeccion()){
					$sql = 'select * from categoria;';
					$rs = mysql_query($sql);
					while ($array=mysql_fetch_array($rs)) {
			?>
			<option value=<?php echo $array['cve_cat'];?>>
				<?php echo $array['nom_cat'];?>
			</option>

			<?php
					}
				}
		}
			?>
			</select>
		</form>
<? include 'layouts/footer.php'; ?>
</body>
</html>