<?php
	include("connectDB.php");
	
	if($_SERVER["REQUEST_METHOD"]=="POST"){
		$myuserN=mysqli_real_escape_string($conn,$_POST['userN']);
		$myuserA=mysqli_real_escape_string($conn,$_POST['userA']);
		$myuserDoc=mysqli_real_escape_string($conn,$_POST['userDoc']);
		$myuserDir=mysqli_real_escape_string($conn,$_POST['userDir']);
		$myuserT=mysqli_real_escape_string($conn,$_POST['userTel']);
		$myuserCel=mysqli_real_escape_string($conn,$_POST['userCel']);
		$myuserCor=mysqli_real_escape_string($conn,$_POST['userCorreo']);
		$myuserCod=mysqli_real_escape_string($conn,$_POST['userCode']);
		$myuserPwd=mysqli_real_escape_string($conn,$_POST['pwd']);
		
		$sql = "INSERT INTO Usuario (documento_Usuario,nombre_Usuario, apellido_Usuario, direccion_Usuario, telefono_Usuario," .
		"celular_Usuario, email_Usuario, codigo_Usuario, password_Usuario, nombre_Rol, codigo_Municipio) " .
		"VALUES ('$myuserDoc','$myuserN','$myuserA','$myuserDir','$myuserT','$myuserCel','$myuserCor'" .
		",$myuserCod,'$myuserPwd','Cliente',1101)";
		
		if($conn->query($sql) === TRUE) {
			header("location: ../keyParkingInicio.html");
		}else{
			echo "Error: " . $sql . "<br>" . $conn->error;
		}		
	}
	$conn->close();
?>