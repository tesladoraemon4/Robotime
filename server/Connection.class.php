<?php
	/**
	* Connection 
	* 	la clase sirve la hacer la coneccion la la BD hacer a,b y c
	*/
	class Connection 
	{
		private $host = "localhost";
		private $bd = "Robotime";
		private $user = "root";
		private $pass = "";

		//variables globales para preparar la consulta sql
		public $nombreEquipo;
		public $email;
		public $tel;
		//atributos de los competidores
		public $numComp;
		public $arrayNombres;
		public $arrayApMat;
		public $arrayApPat;
		public $arrayCap;
		//atributos de los robots
		public $numRob;
		public $arrayNombreR;
		public $arrayCat;
		public	$arrayCve_cat;
		//atributos de robots
		public function getArrayCve_cat()
		{
		    return $this->arrayCve_cat;
		}
		
		public function setArrayCve_cat($arrayCve_cat)
		{
		    $this->arrayCve_cat = $arrayCve_cat;
		    return $this;
		}
		public function getArrayCat()
		{
		    return $this->arrayCat;
		}
		
		public function setArrayCat($arrayCat)
		{
		    $this->arrayCat = $arrayCat;
		    return $this;
		}
		public function getArrayNombreR()
		{
		    return $this->arrayNombreR;
		}
		
		public function setArrayNombreR($arrayNombreR)
		{
		    $this->arrayNombreR = $arrayNombreR;
		    return $this;
		}
		public function getNumRob()
		{
		    return $this->numRob;
		}
		
		public function setNumRob($numRob)
		{
		    $this->numRob = $numRob;
		    return $this;
		}


		//competidores get y set
		public function getArrayCap()
		{
		    return $this->arrayCap;
		}
		
		public function setArrayCap($arrayCap)
		{
		    $this->arrayCap = $arrayCap;
		    return $this;
		}
		public function getArrayApPat()
		{
		    return $this->arrayApPat;
		}
		
		public function setArrayApPat($arrayApPat)
		{
		    $this->arrayApPat = $arrayApPat;
		    return $this;
		}
		public function getArrayApMat()
		{
		    return $this->arrayApMat;
		}
		
		public function setArrayApMat($arrayApMat)
		{
		    $this->arrayApMat = $arrayApMat;
		    return $this;
		}
		public function getArrayNombres()
		{
		    return $this->arrayNombres;
		}
		
		public function setArrayNombres($arrayNombres)
		{
		    $this->arrayNombres = $arrayNombres;
		    return $this;
		}
		public function getNumComp()
		{
		    return $this->numComp;
		}
		
		public function setNumComp($numComp)
		{
		    $this->numComp = $numComp;
		    return $this;
		}
		//get y set equipo
		public function getTel()
		{
		    return $this->tel;
		}
		
		public function setTel($tel)
		{
		    $this->tel = $tel;
		    return $this;
		}
		public function getEmail()
		{
		    return $this->email;
		}
		
		public function setEmail($email)
		{
		    $this->email = $email;
		    return $this;
		}
		public function getNombreEquipo()
		{
		    return $this->nombreEquipo;
		}
		
		public function setNombreEquipo($nombreEquipo)
		{
		    $this->nombreEquipo = $nombreEquipo;
		    return $this;
		}

		function __construct()
		{}

		//obtienes un arreglo de sentencias sql con toda la informacion de 
		//para insertar los competidores
		private function prepareSqlCompetidores($cve_equ)
		{
			$sqlArray;
			$sqlCapitan;
			for ($i=0; $i < $this->numComp; $i++) { 
				$sqlArray[$i]=
				"insert into competidor(cve_equ,appat_com,apmat_com,nom_com)
				VALUES('".$cve_equ."','".mysql_real_escape_string($this->arrayApMat[$i])."','".mysql_real_escape_string($this->arrayApPat[$i])."','
				".mysql_real_escape_string($this->arrayNombres[$i]).
				"')"
				;
			}
			return $sqlArray;
		}
		//obtienes un arreglo de sentencias sql con toda la informacion de 
		//para insertar a los robots
		private function prepareSqlRobots($cve_equ)
		{
			$sqlArray;
			for ($i=0; $i < $this->numRob; $i++) {
				$sqlArray[$i]=
				"
				insert into robot(nom_rob,cve_cat,cve_equ)
				VALUES('".mysql_real_escape_string($this->arrayNombreR[$i])."','".mysql_real_escape_string($this->arrayCve_cat[$i])."','".$cve_equ."')";
			}
			return $sqlArray;
		}
		private function prepareSqlcve_cat()
		{
			$sqlArray;
			for ($i=0; $i < $this->numRob; $i++) {
				$sqlArray[$i] = "
				SELECT cve_cat FROM categoria where nom_cat ='".mysql_real_escape_string($this->arrayCat[$i])."';
				";
			}
			return $sqlArray;
		}
		//retorna un array con las cves de cada categoria
		private function llenarArrayCve_cat()
		{
			$arrayCve;
			$arraySQL = $this->prepareSqlcve_cat();//consultamos la cve x categoria
			for ($i=0; $i < $this->numRob; $i++) {
				if($rs=mysql_query($arraySQL[$i])){
					$array=mysql_fetch_array($rs);
					$arrayCve[$i]=$array['cve_cat'];
				}else{
					print("<br>Fallo alguna consulta a categorias<br>");
				}
			}
			return $arrayCve;
		}
		//se insertara el equipo completo
		public function insertEquipoCompleto()
		{
			//insertamos el equipo
			$rs = mysql_query("
				INSERT INTO equipo (nom_equ,mail_equ,tel_equ,pag_equ)VALUES('".
					mysql_real_escape_string($this->nombreEquipo)."','"
					.mysql_real_escape_string($this->email)."','"
					.mysql_real_escape_string($this->tel)."',0)
				");

			if(!$rs){
				print("No se realizo la insercion de equipo =(".mysql_error());
				return false;
			}else{
				//sacamos la cve del mysql
				$cve_equ = mysql_insert_id();
				//fijamos las cve de las categorias
				$this->setArrayCve_cat($this->llenarArrayCve_cat());
				//arreglo de sentencias sql para insertar robots
				$arraySQL=$this->prepareSqlRobots($cve_equ);
				//insertamos los robots
				if(!$this->insertarArraySql($arraySQL)){
					print("Ocurrio un error insertando los robots".mysql_error());
					return false;
				}
				//insertamos los competidores
				$arraySQL = $this->prepareSqlCompetidores($cve_equ);
				if(!$this->insertarArraySql($arraySQL)){
					print("Ocurrio un error insertando los competidores".mysql_error());
					return false;
				}
				return true;
			}
		}
		public function insertarArraySql($arraySQL)
		{
			$band=true;
			$len = count($arraySQL);
			for ($i=0; $i < $len; $i++) {
				$band=mysql_query($arraySQL[$i]);
			}
			if(!$band){
				echo "=( alguna insercion no se pudo realizar";
			}
			return $band;
		}
		public function hacerConeccion()
		{
			if(!mysql_connect($this->host,$this->user,$this->pass)){
				return false;
			}elseif(!mysql_select_db($this->bd)){
				return false;
			}else{
				@mysql_query("SET NAMES 'utf8'");
				return true;
			}
		}

		public function terminarRegistros(){
			$sql ="SELECT cve_rob from robot where cve_cat=1";
			if(($rs = mysql_query($sql))!=false){
				$hojas = mysql_num_rows($rs);
				$sql = $this->prepareSqlPelea($rs);
				return $this->insertarArraySql([$sql]);
			}else{
				echo "Ocurrio un error haciendo una consulta ".mysql_error();
			}
		}
		//preparamos el sql para insertar los robots 
		//return arraySql
		public function prepareSqlPelea(&$rs){
			//insertar en nivel 0
			$sql = "
				INSERT INTO pelea
				(arb_pel,gan_pel,lvp_pel,disp_pel,cve_rob1,cve_rob2) VALUES
			";
			$numRob = mysql_num_rows($rs);
			//creamos el arreglo de cve_rob
			$arrayCve = array();
			while ($array=mysql_fetch_array($rs)) {
				array_push($arrayCve,$array['cve_rob']);
			}
			for ($i=0; $i < $numRob; $i+=2) {
				$sql=$sql."(0,null,".
				(((int)$numRob)%2!=0 && $i==$numRob-1)?1:0
				.",null,".$arrayCve[$i].",".(isset($arrayCve[$i+1])?$arrayCve[$i+1]:"null")."),";
			}
			//quitamos la ultima coma 
			$sql[strlen($sql)-1]='';
			return $sql;
		}
		public function asignarPeleas(){
			//buscamnos si hay un robot solo
			$sql = "SELECT cve_pel, lvp_pel FROM pelea WHERE lvp_pel=0 and (cve_rob1 IS NULL or cve_rob2 IS NULL)";
			$rs;
			if(($rs=mysql_query($sql)) && mysql_num_rows($rs)>0){
				//si esta solo un robot 
				while ($array=mysql_fetch_array($rs)) {
					$sql ="UPDATE pelea SET lvp_pel=".(((int)$array['lvp_pel'])+1)
					." where cve_pel=".$array['cve_pel'].";";
					break;
				}
				echo "".((mysql_query($sql))?"Si":"No")." se subio de nivel <br>".mysql_error();
			}
			//buscamos una pelea disponible
			$sql = "SELECT cve_pel FROM pelea WHERE disp_pel IS NULL AND cve_rob1 IS NOT NULL AND cve_rob2 IS NOT NULL";
			//si esta disponible la pelea
			$rs;
			if(($rs=mysql_query($sql))!==false && mysql_num_rows($rs)>0){
				$cve_pel;
				while ($array=mysql_fetch_array($rs)) {
					$cve_pel = $array['cve_pel'];
					$sql ="UPDATE pelea SET disp_pel=0 where cve_pel=".$cve_pel.";";
					break;
				}
				echo ((mysql_query($sql))?"Si":"No")." se cambio la disponibilidad de la pelea";
				header("Location:combateAhora.php?num=".$cve_pel);
				return true;
			}
			//verificar si hay robots en combate
			$sql = "SELECT cve_pel FROM pelea WHERE disp_pel=0 AND cve_rob1 IS NOT NULL AND cve_rob2 IS NOT NULL";
			$rs;
			if(($rs=mysql_query($sql))!=false && mysql_num_rows($rs)>0){
				//si hay robots en combate
				echo "No hay peleas disponibles espere un momento...";
			}else{
				echo "Ya termino el encuentro =( o no se ha terminado el periodo de reinscripcion";
			}
			return false;
		}

		//se hace la consulta de una pelea por cve
		public function consultarPelea($cve_pel){
			//consultamos los nombres de la pelea
			$sql = "SELECT p.lvp_pel, p.cve_rob1,p.arb_pel, p.cve_rob2 FROM pelea AS p where p.cve_pel=".mysql_real_escape_string($cve_pel);
			$rs = $this->selectSQL($sql);

			if($rs!==false){
				//consultamos los nombres de los robots
				$lvp_pel;
				$nom_rob1;
				$nom_rob2;
				$arb_pel;
				$sql=array();
				while ($array=mysql_fetch_array($rs)) {
					$sql[0] = "SELECT r.nom_rob FROM robot AS r, pelea AS p where r.cve_rob=".$array['cve_rob1'];
					$sql[1] = "SELECT r.nom_rob FROM robot AS r, pelea AS p where r.cve_rob=".$array['cve_rob2'];
					$lvp_pel = $array['lvp_pel'];
					$cve_rob1=$array['cve_rob1'];
					$cve_rob2=$array['cve_rob2'];
					$arb_pel=$array['arb_pel'];
					break;
				}
				$rsNom1 = $this->selectSQL($sql[0]);
				$rsNom2 = $this->selectSQL($sql[1]);
				if($rsNom1!==false&&$rsNom2!==false){
					$nomRob1;
					$nomRob2;
					while($nombres1=mysql_fetch_array($rsNom1)){
						$nomRob1=$nombres1["nom_rob"];
						break;
					}
					while($nombres2=mysql_fetch_array($rsNom2)){
						$nomRob2=$nombres2["nom_rob"];
						break;
					}
					return  [$nomRob1,$cve_rob1,$nomRob2,$cve_rob2,$lvp_pel,$arb_pel];

				}else{
					echo "No se realizo alguna consulta =(";
					return false;
				}
			}else{
				echo "No se realizo alguna consulta =(";
				return false;
			}
			
		}


		//params cadena sql para ejecutar las ordenes 
		//return false si fallo la consulta he imprime un mensaje 
		//de errror si fue un exito retorna el obj resultado
		public function selectSQL($sql){
			$rs;
			if(($rs=mysql_query($sql))!==false){
				if(mysql_num_rows($rs)>0){
					return $rs;
				}else{
					echo "No se obtubieron resultados de la consulta =(<br>";
				}
			}else{
				echo "Fallo la consulta =(<br>".mysql_error();
			}
			return false;	
		}

		//Actualiza la tabla de pelea y sube de nivel 
		public function subirPelea($cve_pel,$gan_pel,$lvp_pel,$arb_pel)
		{
			$strMen;
			//fijamos el ganador
			$sql = "
			UPDATE pelea set gan_pel=".$gan_pel.
			", disp_pel=1 WHERE cve_pel=".$cve_pel."
			";
			//hacemos el update 
			$this->insertarArraySql([$sql]);
			
			//checamos si hay peleas disponibles un nivel arriba
			$sql = "SELECT cve_pel, cve_rob1,cve_rob2 FROM `pelea` WHERE (cve_rob1 IS NULL OR cve_rob2 IS NULL) AND lvp_pel=".
			(((int)$lvp_pel)+1)
			." LIMIT 1";
			echo $sql."<br>";
			if(($rs=$this->selectSQL($sql))!==false){
				//si hay peleas la actualizamos
				$cve_pelDisp = mysql_result($rs, 0,0);
				$cve_rob1 = mysql_result($rs, 0,1);
				$cve_rob2 = mysql_result($rs, 0,2);
				$sql = "
				UPDATE pelea set cve_rob".
				(($cve_rob1=="NULL")?"2":"1")
				."=".mysql_real_escape_string($gan_pel)." WHERE cve_pel=".$cve_pelDisp."
				";
				//hacemos el update 
				$this->insertarArraySql([$sql]);
				$strMen = "Se subio de nivel =) el competidor";
				//=) ya quedo 
				header("Location:genEncuentros.php?");
			}else{
				//consultamos las peleas de ese nivel
				$sql = "
				SELECT cve_pel FROM pelea AS p WHERE".
				"p.lvp_pel=".$lvp_pel." AND".
				"p.arb_pel=".$arb_pel." AND". 
				"p.disp_pel=1 AND LIMIT 1";
				$sumPel=1;
				if($rs=$this->selectSQL($sql)!==false){//si ya terminaron las peleas de ese nivel
					//creamos una nueva pelea con $lvp_pel +2
					$sumPel = 2;
				}	
				$sql ="
				INSERT INTO pelea ".
				"(cve_rob1,arb_pel,lvp_pel)VALUES ".
				"(".$gan_pel.",".$arb_pel.",".((int)$lvp_pel)+$sumPel.")
				";
				if($this->insertarArraySql([$sql])){
					//se creo una nueva pelea
					$str = "se creo una nueva pelea cont ".$sumPel;
					echo $str;
				}
			}
			
			
		}


	}
	
?>