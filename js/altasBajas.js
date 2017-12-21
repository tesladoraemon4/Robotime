angular.module('aplicacion',[]).
controller('ConfigPag', ['$scope','$log',function ($scope,$log) {
	$scope.mensajeConf = function (el) {
		var cad = confirm("¿Estas seguro que pago este equipo?\n");
		el.onsubmit=cad;
	}
}]);

function mensajeConf(e) {
	var i;
	var inputs=e.getElementsByTagName('input');
	for ( i = inputs.length - 1; i >= 0; i--) {
		if(inputs[i].getAttribute('name') =='configPag')
		{
			console.log(inputs[i]);
			break;
		}
	};

	return confirm((inputs[i].getAttribute("value")=="Confirmar pago")?"¿Estas seguro que pago este equipo?\n":"¿Esta seguro que desea quitar el pago de este equipo?");
}

