angular.module('carrera', []).
controller('formCarrera', ['$scope','$log',function($scope,$log){

	$scope.numPtos=0;
	$scope.numPen=0;



	$scope.sumPen = function () {
		if($scope.numPen+1 < 31){
			$scope.numPen++;
		}
	}

	
	$scope.resPen = function () {
		if($scope.numPen-1 >= 0){
			$scope.numPen--;
		}
	}



	$scope.sumPuntos=function () {
		if($scope.numPtos+1 < 31){
			$scope.numPtos++;
		}
	}


	$scope.resPuntos=function () {
		if($scope.numPtos-1 >= 0){
			$scope.numPtos--;
		}
	}
}]);


function getPuntosExtraDrone () {
	var inputs=document.getElementsByTagName('input');
	var checkBox=[];
	var suma=0;
	for (var i = inputs.length - 1; i >= 0; i--) {
		if(inputs[i].getAttribute('type')=='checkbox' && inputs[i].checked)
		{
			suma+=parseInt(inputs[i].getAttribute('value'))
		}
	};
	return suma;
}

function getPuntTiempo (min,seg,ms) {
	return Math.floor(min*60+seg+3/3000);
}

//genera el reporte de puntuaciones
var genPuntuaciones=function (form) {
	var array = form.getElementsByTagName('input'),i,cve_cat;
	for (i = array.length - 1; i >= 0; i--) {
		if(array[i].getAttribute('name')=='cve_cat'){cve_cat=array[i].getAttribute("value");break;}
	};
	var relojCad = document.getElementById('reloj').innerHTML;
	var arrayCadReloj=relojCad.split(':'),band;

	var ms = parseInt(arrayCadReloj.pop());
	var segundos = parseInt(arrayCadReloj.pop());
	var minutos = parseInt(arrayCadReloj.pop());
	if(ms==0 && segundos==0 && minutos==0){
		band = confirm("El cronometro esta en cero, \n¿seguro que esta correcto el cronometro?");
	}


	var time_ran= document.getElementById('time_ran');
	var pena_ran= document.getElementById('pena_ran');
	var pun_ran= document.getElementById('pun_ran');

	time_ran.setAttribute('value','');
	pena_ran.setAttribute('value','');
	pun_ran.setAttribute('value','');

	time_ran.setAttribute('value',relojCad);

	pena_ran.setAttribute('value',document.getElementById('numPen').innerHTML);

	if(cve_cat=='1')//sigue lineas
	{
		pun_ran.setAttribute('value',""+(
		-parseInt(document.getElementById('numPen').innerHTML)
		+parseInt(document.getElementById('numPtos').innerHTML)
		));
	}else{//drones
		//CALCULAMOS EL PUNTAJE DE LOS RANKINGS
		pun_ran.setAttribute('value',""+(
		300-getPuntTiempo(minutos,segundos,ms)
		-parseInt(document.getElementById('numPen').innerHTML)
		+parseInt(document.getElementById('numPtos').innerHTML)
		+getPuntosExtraDrone()
		));
	}

	return confirm("¿Seguro que ha terminado su recorrido?")&&band;
}

