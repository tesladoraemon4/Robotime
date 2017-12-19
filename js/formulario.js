/**
* formulario Module
*
* Description
Es el modulo encargado de la validacion de formularios y envio de los 
mismos
*/
angular.module('formulario', []).
controller('formRegistro', ['$scope','$log','$http',function($scope,$log,$http){
	scope = $scope; 
	
	$scope.onlyUneCap = function (e) {
		var cont=0,band=true;
		for (var i = $scope.competidores.length - 1; i >= 0;i--){
			if($scope.competidores[i].esCapitan)
				cont++;
			if(cont>1){
				alert("solo puede haber un capitan por equipo");
				$scope.competidores[i].esCapitan=false;
				band=false;
				break;
			}
		}
		if(band){
			var elementoHiden = document.getElementById('capitan'+(parseInt(e.index)+1));
			elementoHiden.value = band;
		}
	}



	$scope.numComp=1;
	$scope.numRob=1;

	$scope.competidores=[{}];
	$scope.robots=[{}];
	$scope.categorias=
	[{
		nom:'Sumo'
	}];
	$scope.noHayCapitan=false;
	function concatVar() {
		var cad="";
		//concatenamos los robots
		cad += "numRob="+$scope.numRob+"&";
		for (var i = $scope.robots.length - 1; i >= 0; i--) {
			cad += "nombreR"+i+"="+$scope.robots[i].nom+"&"+
			"categoria"+i+"="+$scope.robots[i].cat+"&";
		}
		//concatenamos los competidores
		cad += "numComp="+$scope.numComp+"&";
		for (var i = $scope.competidores.length - 1; i >= 0; i--) {
			cad += "nombreC"+i+"="+$scope.competidores[i].nombre+"&";
			cad += "apPat"+i+"="+$scope.competidores[i].apPat+"&"
			cad += "apMat"+i+"="+$scope.competidores[i].apMat+"&"
			cad += "esCapitan"+i+"="+$scope.competidores[i].esCapitan+"&"
		}
		return cad;
	}
	
	$scope.sumC=function () {
		if($scope.numComp+1 < 9){
			$scope.numComp++;
			$scope.competidores.push({});
		}
	}
	$scope.resC=function () {
		if($scope.numComp-1 > 0){
			$scope.numComp--;
			$scope.competidores.pop();
		}
	}
	$scope.sumR=function () {
		if($scope.numRob+1 < 31){
			$scope.numRob++;
			$scope.robots.push({});
		}
	}
	$scope.resR=function () {
		if($scope.numRob-1 > 0){
			$scope.numRob--;
			$scope.robots.pop();
		}
	}
}]);


function validar() {
	return validarCompetidores() &&
	validarCategoriaRobots();
}
function validarCompetidores() {
	var competidores = scope.competidores;
	for (var i = competidores.length - 1; i >= 0; i--) {
		console.log(competidores[i].esCapitan);
		if(competidores[i].esCapitan!=true || 
			competidores[i].esCapitan==undefined){
			alert("Falta un capitan");
			document.getElementById('capitan'+(i+1)).focus();
			return false;
		}
	}
	return true;
}
function validarCategoriaRobots() {
	var robots = scope.robots;
	for (var i = robots.length - 1; i >= 0; i--) {
		if(robots[i].cat=="" || robots[i].cat==undefined){
			alert("Falta seleccionar la categoria");
			document.getElementById('Categoria'+(i+1)).focus();
			return false;
		}
	}
	return true;
}


