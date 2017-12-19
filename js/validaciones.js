/*Plantilla del config elemento 
	var config={
		maxleng:25,
		minleng:1,
		required:true,
		expReg:"/^[a-zA-Z0-9]{1,25}/",
		carPermitidosShow:"Mayusculas, minusculas, acentos en vocales y numeros"
	};
*/

function validarInicioSesion() {
	var pass= document.getElementById('pass');
	var user= document.getElementById('user');
	var config1={
		nomCampo:"password",
		maxleng:25,
		minleng:1,
		required:true,
		expReg:/^[a-z0-9ñÑáéíóúÁÉÚÍÓ_\\_\ü]+$/,
		carPermitidosShow:"Mayusculas, minusculas, acentos en vocales y numeros"
	};
	var config2={
		nomCampo:"usuario",
		maxleng:100,
		minleng:4,
		required:true,
		expReg:/^[a-z0-9ñÑáéíóúÁÉÚÍÓ_\\_\ü]+$/,
		carPermitidosShow:"Mayusculas, minusculas, acentos en vocales y numeros"
	};
	return (validarElemento(pass,config1) && 
		validarElemento(user,config2));
}
function validarContacto() {
	var asunto=document.getElementById('asunto');
	var email=document.getElementById('email');
	var mensaje=document.getElementById('mensaje');
	var configAsunto={
		nomCampo:"asunto",
		maxleng:50,
		minleng:2,
		required:true,
		expReg:/^[A-Za-z0-9ñÑáéíóúÁÉÚÍÓ :*=)/&#(,;.?¿¡!\-_\\\ü]+$/,
		carPermitidosShow:"Mayusculas, minusculas, acentos en vocales,numeros, "+
		"\n y :*=)/&#(,;.?¿¡!-_"
	};
	var configEmail={
		nomCampo:"email",
		maxleng:25,
		minleng:7,
		required:true,
		expReg:/^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,4})$/,
		carPermitidosShow:"Mayusculas, minusculas, acentos en vocales,numeros, "+
		"\n y guiones bajos"+"\n Ejemplo: correo@hotmail.com"
	};
	var configMensaje={
		nomCampo:"mensaje",
		maxleng:100,
		minleng:5,
		required:true,
		expReg:configAsunto.expReg,
		carPermitidosShow:configAsunto.carPermitidosShow
	};
	var bol = validarElemento(asunto,configAsunto) &&
	validarElemento(email,configEmail) && 
	validarElemento(mensaje,configMensaje);
	return bol;
}
function validarElemento(elem,config) {
	var value = elem.value;
	if(config.required==true && value==""){
		elem.focus();
		alert("Necesitas llenar el campo"+config.nomCampo);
	}else if(value.length > config.maxleng){
		elem.focus();
		alert("Solo se admiten un maximo de "+config.maxleng+" en el "+config.nomCampo);
	}else if(value.length < config.minleng){
		elem.focus();
		alert("Solo se admiten un minimo de "+config.minleng+" en el "+config.nomCampo);
	}else if(!config.expReg.test(value)){
		elem.focus();
		alert("En el campo "+config.nomCampo+" solo se permiten estos caracteres\n"+
			config.carPermitidosShow);
	}else{
		return true;
	}
	return false;
}



