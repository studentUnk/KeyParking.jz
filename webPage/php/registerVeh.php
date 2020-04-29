<?php
	include("connectDB.php");
	
	session_start();
	
	$user_check = $_SESSION['login_user'];
	
	if($_SERVER["REQUEST_METHOD"]=="POST"){
		$myuserPl=mysqli_real_escape_string($conn,$_POST['mypl']);
		$myuserCo=mysqli_real_escape_string($conn,$_POST['myco']);
		$myuserTy=mysqli_real_escape_string($conn,$_POST['myty']);
		$myuserBr=mysqli_real_escape_string($conn,$_POST['mybr']);
		
		$sql = "INSERT INTO Vehiculo (placa_Vehiculo, color_Vehiculo, codigo_TipoVehiculo,".
		"codigo_MarcaVehiculo, codigo_Usuario) ".
		"VALUES ('".$myuserPl."', '".$myuserCo."', ".$myuserTy.", ".$myuserBr.", ".$user_check.")";
		
		if($conn->query($sql) === TRUE) {
			header("location: ../menu/successVeh.php");
		}else{
			echo "Error: " . $sql . "<br>" . $conn->error;
		}		
	}
	$conn->close();
?>