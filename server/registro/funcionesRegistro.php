<?php
require_once("../funciones.php");
require_once("../clases/ConfigurationValidationNumber.class.php");
require_once("../clases/ConfigurationValidation.class.php");
function validateEquipoTable($numRob,$numComp,$nombreEquipo,$email,$tel)
{
	$strMensajeEdo;
	$allParamsCorrect=true;
	if(($strMensajeEdo=validarParamsElement($nombreEquipo,
		new 
		ConfigurationValidation('nombre del equipo',
			"/^[\wñÑáéíóúÁÉÚÍÓ ]{1,25}$/",
			1,
			25,
			"solo se permiten caracteres letras mayusculas, minusculas, números y vocales con acento",
			true)))
		!== true
	){
		return $strMensajeEdo;
	}elseif(($strMensajeEdo=validarParamsElement($email,
		new 
		ConfigurationValidation('email',
			"/^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,4})$/",
			6,
			30,
			"Mayusculas, minusculas, acentos en vocales,numeros, ".
			"<br> y guiones bajos".
			"<br> Ejemplo: correo@hotmail.com",
			true)))
		!== true
	){
		return $strMensajeEdo;
	}elseif(($strMensajeEdo=validarParamsElement($tel,
		new 
		ConfigurationValidation('telefono',
			"/^(\d{10})((\d{3}){0,1})$/",
			10,
			10,
			"Solo se permiten números de 10 digitos <br> Ejemplo: 5166400056",
			true)))
		!== true
	){
		return $strMensajeEdo;
	}elseif(($strMensajeEdo=validarParamsElement($numRob,
		new 
		ConfigurationValidationNumber('numero de robots',
			"/\d{1,2}/",
			1,
			2,
			"Solo se permiten numeros enteros =(",
			true,
			1,
			30)))
		!== true
	){
		return $strMensajeEdo;
	}elseif(($strMensajeEdo=validarParamsElement($numComp,
		new 
		ConfigurationValidationNumber('numero de competidores',
			"/\d{1,2}/",
			1,
			2,
			"Solo se permiten numeros enteros =(",
			true,
			1,
			8)))
		!== true
	){
		return $strMensajeEdo;
	}

	return true;
}

//validamos un grupo de parametros http
//precondicion:
//el name de los formularios debe llevar item1,item2,...itemN
//params (numero de parametros, nombres de los parametos,
//expresion regular, metodo por el cual fue enviado)
function validateGroupHttpParams($numberParams,
	$namesParams,$regExp,$http)
{
	$valor;
	for ($x=0; $x < $numberParams; $x++) {
		for ($i=0; $i < count($namesParams); $i++) { 
			$valor = ($http=='POST')?$_POST[$namesParams[$i].($x+1)]:$_GET[$namesParams[$i].($x+1)];
			if(!preg_match($regExp,$valor)){
				return 0;
			}
		}
	}
	return 1;
}


function getGroupHttpParams($numberParams,$namesParams,$http)
{
	$array=array();




	$valor;
	for ($i=0; $i < count($namesParams); $i++) {
		$arrayNombres = array();
		for ($x=0; $x < $numberParams; $x++) {

			$valor = ($http=='POST')?$_POST[$namesParams[$i].($x+1)]:$_GET[$namesParams[$i].($x+1)];

			$arrayNombres[$x]=$valor;
			//$arrayNombres[$namesParams[$i]]=$valor;
		}
		$array[$namesParams[$i]]=$arrayNombres;
	}





	return $array;
}


?>