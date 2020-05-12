function openR(){
	location.href="keyParkingRegistrar.php";
}
function openS(){
	location.href="keyParkingInicio.php";
}
function openMC(){
	location.href="../menu/Menue.php";
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
function showP(){
	window.alert("Bicicleta $4 x minuto\nMoto $20 x minuto\nAuto $50 x minuto");
}
function errorUser(){
	window.alert("Usuario no valido");
}
function refreshSitioD(){
	document.getElementById('divSitiosD').innerHTML = '../menu/radioSitiosD.php?f=15';
}