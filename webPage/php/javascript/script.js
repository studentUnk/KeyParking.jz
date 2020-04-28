function openR(){
	location.href="keyParkingRegistrar.html";
}
function openS(){
	location.href="keyParkingInicio.html";
}
function sendUser(){
	var u = document.getElementById("userT").value;
	if(u == "user"){
		window.alert("Bienvenido " + u);
		location.href="keyParkingMenu.html";
	}else{
		window.alert("Usuario no valido");
	}
}
function errorUser(){
	window.alert("Usuario no valido");
}
function refreshSitioD(){
	document.getElementById('divSitiosD').innerHTML = '../menu/radioSitiosD.php?f=15';
}