<?php // Es el header de todas las pàginas y muestra el mensaje de estado
	if(isset($_GET['MensajeEdo'])){
?>
		<header id="header" class="">
			<?echo "<h2>".$_GET['MensajeEdo']."</h2>";?>
		</header>
<?php
	}else{
?>

<?php
	}
?>


