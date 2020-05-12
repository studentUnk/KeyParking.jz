function en64User(){
	document.getElementById("userT").value = "111111";
}

function en64Inicio(){
	var data = document.getElementById("userT");
	en64(data);
	data = document.getElementById("pwd");
	en64(data);
}

function en64Registro(){
	var labels = ["userN","userA","userDoc","userDir","userTel","userCel","userCorreo","userCode","pwd"];
	var data;
	for(var i = 0; i < labels.length; i++){
		data = document.getElementById(labels[i]);
		en64(data);
	}	
}


function en64(d){
	var data = d.value;
	data = window.btoa(data);
	d.value = data;
}