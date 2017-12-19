<?php
	/**
	* Robot
	*/
	class Robot
	{
		public $cve_rob;
		public $nom_rob;
		public $cve_cat;
		public $categoria;
		function __construct($cve_rob,$nom_rob,$categoria)
		{
			$this->cve_rob=$cve_rob;
			$this->nom_rob=$nom_rob;
			$this->categoria=$categoria;
		}
		public function getCve_rob()
		{
		    return $this->cve_rob;
		}
		
		public function setCve_rob($cve_rob)
		{
		    $this->cve_rob = $cve_rob;
		    return $this;
		}
		public function getNom_rob()
		{
		    return $this->nom_rob;
		}
		
		public function setNom_rob($nom_rob)
		{
		    $this->nom_rob = $nom_rob;
		    return $this;
		}
		public function getCategoria()
		{
		    return $this->categoria;
		}
		
		public function setCategoria($categoria)
		{
		    $this->categoria = $categoria;
		    return $this;
		}
		public function getCve_cat()
		{
		    return $this->cve_cat;
		}
		
		public function setCve_cat($cve_cat)
		{
		    $this->cve_cat = $cve_cat;
		    return $this;
		}
	}






?>