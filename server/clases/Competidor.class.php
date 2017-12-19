<?php 
	/**
	* Competidor
	*/
	class Competidor
	{
		public $cve_com;
		public $cap_com;
		public $apmat_com;
		public $apat_com;
		public $nom_com;
		public $cve_equ;
		function __construct($cve_com,$cap_com,$cve_equ,$apmat_com,$apat_com,$nom_com)
		{
			$this->$cve_com=$cve_com;
			$this->$cap_com=$cap_com;
			$this->$apmat_com=$apmat_com;
			$this->$apat_com=$apat_com;
			$this->$nom_com=$nom_com;
			$this->$cve_equ=$cve_equ;
		}
		public function getNom_com()
		{
		    return $this->nom_com;
		}
		
		public function setNom_com($nom_com)
		{
		    $this->nom_com = $nom_com;
		    return $this;
		}
		public function getApat_com()
		{
		    return $this->apat_com;
		}
		
		public function setApat_com($apat_com)
		{
		    $this->apat_com = $apat_com;
		    return $this;
		}
		public function getApmat_com()
		{
		    return $this->apmat_com;
		}
		
		public function setApmat_com($apmat_com)
		{
		    $this->apmat_com = $apmat_com;
		    return $this;
		}
		public function getCap_com()
		{
		    return $this->cap_com;
		}
		
		public function setCap_com($cap_com)
		{
		    $this->cap_com = $cap_com;
		    return $this;
		}
		public function getCve_equ()
		{
		    return $this->cve_equ;
		}
		
		public function setCve_equ($cve_equ)
		{
		    $this->cve_equ = $cve_equ;
		    return $this;
		}
		public function getCve_com()
		{
		    return $this->cve_com;
		}
		
		public function setCve_com($cve_com)
		{
		    $this->cve_com = $cve_com;
		    return $this;
		}
	}



 ?>