<?php
	/**
	* Equipo
	* 	Modela a la tabla equipo de la BD
	*/
	class Equipo
	{
		public $nom_equ;
		public $cve_equ;
		public $pag_equ;
		public $tel_equ;
		public $mail_equ;
		public $competidores;
		public $robots;


		function __construct($cve_equ,$nom_equ,$mail_equ,$tel_equ,$pag_equ)
		{
			$this->nom_equ=$nom_equ;
			$this->cve_equ=$cve_equ;
			$this->pag_equ=$pag_equ;
			$this->tel_equ=$tel_equ;
			$this->mail_equ=$mail_equ;
		}
		public function getRobots()
		{
		    return $this->robots;
		}
		
		public function setRobots($robots)
		{
		    $this->robots = $robots;
		    return $this;
		}
		public function getCompetidores()
		{
		    return $this->competidores;
		}
		
		public function setCompetidores($competidores)
		{
		    $this->competidores = $competidores;
		    return $this;
		}
		public function getMail_equ()
		{
		    return $this->mail_equ;
		}
		
		public function setMail_equ($mail_equ)
		{
		    $this->mail_equ = $mail_equ;
		    return $this;
		}
		public function getTel_equ()
		{
		    return $this->tel_equ;
		}
		
		public function setTel_equ($tel_equ)
		{
		    $this->tel_equ = $tel_equ;
		    return $this;
		}
		public function getPag_equ()
		{
		    return $this->pag_equ;
		}
		
		public function setPag_equ($pag_equ)
		{
		    $this->pag_equ = $pag_equ;
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
		public function getNom_equ()
		{
		    return $this->nom_equ;
		}
		
		public function setNom_equ($nom_equ)
		{
		    $this->nom_equ = $nom_equ;
		    return $this;
		}


	}
?>