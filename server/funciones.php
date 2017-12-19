<?php 

	function valNom($cad,$dat)
	{
		if(preg_match("/^[\wñÑáéíóúÁÉÚÍÓ ]+$/",$cad) && strlen($cad)<26){
			return "=)";
		}else{
			return "Algun ".$dat."no tiene el formato especificado";
		}
	}
	//validamos un elemento 
	function validarParamsElement($value,$config){
		if($config->getRequired()==true && $value==""){
			return ("Necesitas llenar el campo".$config->getNombre());
		}
		if($config instanceof ConfigurationValidationNumber){
			if((int)$value > $config->getMaxVal()){
				return ("Solo se admiten un maximo valor de ".$config->getMaxVal()." en el ".$config->getNombre());
			}else if(((int)$value) < $config->getMinVal()){
				return ("Solo se admiten un minimo valor de ".$config->getMinVal()." en el ".$config->getNombre());
			}
		}
		if(strlen($value) > $config->getMax()){
			return ("Solo se admiten un maximo de ".$config->getMax()." ".(is_numeric($value)?"digitos":"caracteres")." en el ".$config->getNombre());
		}else if(strlen($value) < $config->getMin()){
			return ("Solo se admiten un minimo de ".$config->getMin()." ".(is_numeric($value)?"digitos":"caracteres")." en el ".$config->getNombre());
		}
		else if(!preg_match($config->getExpresionRegular(), $value)){
			return ("En el campo ".$config->getNombre()." solo se permiten estos caracteres\n".
				$config->getCaracteresPermitidos());
		}else{
			return true;
		}
	}



	function valCap($cad)
	{
		if(preg_match("/^[\wñÑáéíóúÁÉÚÍÓ ]+$/",$cad)){
			if($cad=="true"|| $cad=="false"){
				return "=)";
			}
		}
		return "Algun valor no coincide";
	}

	function getPostParams($arrayCad)
	{
		$array=array();
		foreach ($arrayCad as $c)
			array_push($array, $_POST[$c]);
		return $array;
	}
	
	function existenParametrosPost($arrayCad)
	{
		foreach ($arrayCad as $cad) 
			if(!isset($_POST[$cad]))
				return false;
		return true;
	}
	function existenParametrosGet($arrayCad)
	{
		foreach ($arrayCad as $cad) 
			if(!isset($_GET[$cad]))
				return false;
		return true;
	}
	function getGetParams($arrayCad)
	{
		$array=array();
		foreach ($arrayCad as $c)
			array_push($array, $_GET[$c]);
		return $array;
	}
	


?>