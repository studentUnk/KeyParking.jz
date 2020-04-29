<?php
	include("connectDB.php");
	session_start();
	if($_SERVER["REQUEST_METHOD"]=="POST"){
		$myuser=mysqli_real_escape_string($conn,$_POST['userT']);
		$mypass=mysqli_real_escape_string($conn,$_POST['pwd']);
		
		$sql="SELECT codigo_Usuario, nombre_Rol FROM Usuario WHERE codigo_Usuario=$myuser AND password_Usuario='$mypass'";
		$result=mysqli_query($conn,$sql);
		$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
		$active=$row['active'];
		
		$count=mysqli_num_rows($result);
		// if the user matched then the table must return 1 user
		if($count==1){
			//session_register("codigo_Usuario");
			$_SESSION['login_user']=$myuser;
			$typeU = array("Cliente","Auxiliar");
			if(strcmp($row['nombre_Rol'],$typeU[0]) == 0){
				header("location: ../menu/Menue.php");
			}
			else{
				if(strcmp($row['nombre_Rol'],$typeU[1]) == 0){
					header("location: ../menu/Administrame.php");
				}
				else{
					// you are god!! good luck! :P
					header("location: ../menu/OpcionAdministrador.php");
				}
			}
			//header("location: testW.php");
		}else{
			//$error="Acceso no valido";
			//echo "$error";
			header("location: ../keyParkingInicio.html");
		}
	}
	$conn->close();
?>