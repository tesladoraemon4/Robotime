<?php
/**
* ConfigurationValidation
*/
class ConfigurationValidation
{
	private $nombre;
	private $expresionRegular;
	private $min;
	private $max;
	private $caracteresPermitidos;
	private $required;
	function __construct($nombre,$expresionRegular,$min,$max,$caracteresPermitidos,$required)
	{
		$this->nombre = $nombre;
		$this->expresionRegular = $expresionRegular;
		$this->min = $min;
		$this->max = $max;
		$this->caracteresPermitidos = $caracteresPermitidos;
		$this->required = $required;
	}

	public function getRequired()
	{
	    return $this->required;
	}
	
	public function setRequired($required)
	{
	    $this->required = $required;
	    return $this;
	}
	public function getCaracteresPermitidos()
	{
	    return $this->caracteresPermitidos;
	}
	
	public function setCaracteresPermitidos($caracteresPermitidos)
	{
	    $this->caracteresPermitidos = $caracteresPermitidos;
	    return $this;
	}
	public function getMax()
	{
	    return $this->max;
	}
	
	public function setMax($max)
	{
	    $this->max = $max;
	    return $this;
	}
	public function getMin()
	{
	    return $this->min;
	}
	
	public function setMin($min)
	{
	    $this->min = $min;
	    return $this;
	}
	public function getExpresionRegular()
	{
	    return $this->expresionRegular;
	}
	
	public function setExpresionRegular($expresionRegular)
	{
	    $this->expresionRegular = $expresionRegular;
	    return $this;
	}
	public function getNombre()
	{
	    return $this->nombre;
	}
	
	public function setNombre($nombre)
	{
	    $this->nombre = $nombre;
	    return $this;
	}

	
}


?>