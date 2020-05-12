<?php
	include("connectDB.php");
	session_start();
	
	$uPError = $userError = $passError = "";
	$checkMe = 1;
	
	if($_SERVER["REQUEST_METHOD"]=="POST"){
		$myuser = $mypass = "";
		if (empty($_POST['userT'])){
			$userError = "Por favor ingrese su usuario";
			$checkMe = 0;
		} else {
			$myuser=mysqli_real_escape_string($conn,$_POST['userT']);
		}
		if (empty($_POST['pwd'])){
			$passError = "Por favor ingrese su password";
			$checkMe = 0;
		} else {
			$mypass=mysqli_real_escape_string($conn,$_POST['pwd']);
		}
		if($checkMe == 1){
			$sql="SELECT codigo_Usuario, nombre_Rol FROM Usuario WHERE codigo_Usuario=$myuser AND password_Usuario='$mypass'";
			$result=mysqli_query($conn,$sql);
			$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
			$active=$row['active'];
			
			$count=mysqli_num_rows($result);
			// if the user matched then the table must return 1 user
			$conn->close();
			if($count==1){
				//session_register("codigo_Usuario");
				$_SESSION['login_user']=$myuser;
				$typeU = array("Cliente","Auxiliar");
				if(strcmp($row['nombre_Rol'],$typeU[0]) == 0){
					header("location: ../menu/cli/Menue.php");
				}
				else{
					if(strcmp($row['nombre_Rol'],$typeU[1]) == 0){
						header("location: ../menu/aux/Administrame.php");
					}
					else{
						// you are god!! good luck! :P
						header("location: ../menu/adm/OpcionAdministrador.php");
					}
				}
				//header("location: testW.php");
			}else{
				//$error="Acceso no valido";
				//echo "$error";
				//header("location: keyParkingInicio.php");
				$uPError = "Password o usuario incorrecto";
			}
		}
	}
	/***
	include("connectDB.php");
	session_start();
	if($_SERVER["REQUEST_METHOD"]=="POST"){
		if (empty($_POST['userT'])){
			$userError = "Por favor ingrese su usuario";
		} else {
			$myuser=mysqli_real_escape_string($conn,$_POST['userT']);
		}
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
				header("location: ../menu/cli/Menue.php");
			}
			else{
				if(strcmp($row['nombre_Rol'],$typeU[1]) == 0){
					header("location: ../menu/aux/Administrame.php");
				}
				else{
					// you are god!! good luck! :P
					header("location: ../menu/adm/OpcionAdministrador.php");
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
	
	***/
?>