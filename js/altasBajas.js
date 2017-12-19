angular.module('aplicacion',[]).
controller('ConfigPag', ['$scope','$log',function ($scope,$log) {
	$scope.mensajeConf = function (el) {
		var cad = confirm("¿Estas seguro que pago este equipo?\n");
		el.onsubmit=cad;
	}
}]);



function mensajeConf(e) {
	return confirm("¿Estas seguro que pago este equipo?\n");
}

