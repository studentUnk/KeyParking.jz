<?php
	include("connectDB.php");
	session_start();
	
	$user_check = $_SESSION['login_user'];
	
	if($_SERVER["REQUEST_METHOD"]=="POST"){
		$myuserN=mysqli_real_escape_string($conn,$_POST['nameU']);
		$myuserA=mysqli_real_escape_string($conn,$_POST['lname']);
		$myuserDir=mysqli_real_escape_string($conn,$_POST['addr']);
		$myuserT=mysqli_real_escape_string($conn,$_POST['pho']);
		$myuserCel=mysqli_real_escape_string($conn,$_POST['smpho']);
		$myuserCor=mysqli_real_escape_string($conn,$_POST['em']);
		$myuserPwd=mysqli_real_escape_string($conn,$_POST['pwd']);
		
		$sql = "UPDATE Usuario ".
		"SET nombre_Usuario = '".$myuserN."', ".
		"apellido_Usuario = '".$myuserA."', ".
		"direccion_Usuario = '".$myuserDir."', ".
		"telefono_Usuario = '".$myuserT."', ".
		"celular_Usuario = '".$myuserCel."', ".
		"email_Usuario = '".$myuserCor."', ".
		"password_Usuario = '".$myuserPwd."' ".
		"WHERE codigo_Usuario = ".$user_check;
		if($conn->query($sql) === TRUE) {
			header("location: ../menu/successUpdateUser.php");
		}else{
			echo "Error: " . $sql . "<br>" . $conn->error;
		}		
	}
	$conn->close();
?>