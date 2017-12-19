<?php
	require_once("../funciones.php");
	include("../Connection.class.php");
	include("../clases/ConfigurationValidation.class.php");
	if(!existenParametrosPost(['numRob','numComp','nombreEquipo','mail','tel'])){
		echo "No se enviaron todos los parametros del formulario =(";
		echo "<a href='../registro.html'>Regresar Al registro</a>";
	}else{
		include 'funcionesRegistro.php';
		$arrayPostParams =
		getPostParams(['numRob','numComp','nombreEquipo','mail','tel']);
		$numRob = $arrayPostParams[0];
		$numComp = $arrayPostParams[1];
		$nombreEquipo= $arrayPostParams[2];
		$email= $arrayPostParams[3];
		$tel= $arrayPostParams[4];
		//validamos el equipo
		if(($strMensajeEdo=validateEquipoTable($numRob,$numComp,$nombreEquipo,$email,$tel))!==true){
			//header("Location:../../registro.php?MensajeEdo=".urlencode($strMensajeEdo));
		}elseif(!validateGroupHttpParams($numComp,
			['nombre','apMat','apPat'],
			"/^[\wñÑáéíóúÁÉÚÍÓ ]{1,25}$/",'POST') ||
			!validateGroupHttpParams($numComp,
						['capitan'],
						"/\b(true|false)$/",'POST')){
			//validamos los competidores
			$strMensajeEdo="Hay un error en el formulario de los competidores";
		}elseif(!validateGroupHttpParams($numRob,
			['nombreR'],
			"/^[\wñÑáéíóúÁÉÚÍÓ ]{1,25}$/",'POST')||
			!validateGroupHttpParams($numRob,
						['Categoria'],
						"/\b(Sumo)$/",'POST')){
			$strMensajeEdo="Hay un error en el formulario de los robots";
		}
		if($strMensajeEdo!==true){
			echo "Fallo alguna campo =(<br>";
			header("Location:../../registro.php?MensajeEdo=".urlencode($strMensajeEdo));
		}
		//obtenemos los valores de los parametros
		$competidores=getGroupHttpParams($numComp,['nombre','apMat','apPat','capitan'],'POST');
		$arrayCap = $competidores['capitan'];
		$arrayApPat = $competidores['apPat'];
		$arrayNombres = $competidores['nombre'];
		$arrayApMat = $competidores['apMat'];
		$robots=getGroupHttpParams($numRob,
			['Categoria','nombreR'],'POST');
		$arrayCat = $robots['Categoria'];
		$arrayNombreR = $robots['nombreR'];
		//hacemos los insert a la bd
		$con =new Connection();
		if($con->hacerConeccion()){//si hacemos la coneccion a la BD
			//PREPARAMOS LOS ATRIBUTOS PARA LA CLASE CONECCION
			$con->setNombreEquipo($nombreEquipo);
			$con->setEmail($email);
			$con->setTel($tel);
			//atributos de los competidores
			$con->setNumComp($numComp);
			$con->setArrayNombres($arrayNombres);
			$con->setArrayApMat($arrayApMat);
			$con->setArrayApPat($arrayApPat);
			$con->setArrayCap($arrayCap);
			//atributos de los robots
			$con->setNumRob($numRob);
			$con->setArrayNombreR($arrayNombreR);
			$con->setArrayCat($arrayCat);
			//HACEMOS LA INSERCCION
			if($con->insertEquipoCompleto()){
				$strMensajeEdo ="Se registro satisfactoriamente su equipo =)";
			}else{
				$strMensajeEdo ="No se inserto en la BD";
			}
		}
		mysql_close();
		header("Location:../../registro.php?MensajeEdo=".urlencode($strMensajeEdo));
	}


	
?>