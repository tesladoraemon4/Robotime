<?php
/**
* ConfigurationValidationNumber
*/
include_once("ConfigurationValidation.class.php");

class ConfigurationValidationNumber extends ConfigurationValidation
{
	private $minVal;
	private $maxVal;
	function __construct($nombre,$expresionRegular,$min,$max,$caracteresPermitidos,$required,$minVal,$maxVal)
	{
		parent::__construct($nombre,$expresionRegular,$min,$max,$caracteresPermitidos,$required);
		$this->minVal=$minVal;
		$this->maxVal=$maxVal;
	}
	public function getMaxVal()
	{
	    return $this->maxVal;
	}
	
	public function setMaxVal($maxVal)
	{
	    $this->maxVal = $maxVal;
	    return $this;
	}
	public function getMinVal()
	{
	    return $this->minVal;
	}
	
	public function setMinVal($minVal)
	{
	    $this->minVal = $minVal;
	    return $this;
	}
	
}


?>