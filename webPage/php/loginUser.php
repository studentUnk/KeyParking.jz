<?php
	include("connectDB.php");
	//session_start();
	if($_SERVER["REQUEST_METHOD"]=="POST"){
		$myuser=mysqli_real_escape_string($conn,$_POST['userT']);
		$mypass=mysqli_real_escape_string($conn,$_POST['pwd']);
		
		$sql="SELECT codigo_Usuario FROM Usuario WHERE codigo_usuario=$myuser AND password_Usuario='$mypass'";
		$result=mysqli_query($conn,$sql);
		$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
		$active=$row['active'];
		
		$count=mysqli_num_rows($result);
		// if the user matched then the table must return 1 user
		if($count==1){
			//session_register("myuser");
			//$_SESSION['login_user']=$myuser;
			header("location: ../keyParkingMenu.html");
		}else{
			//$error="Acceso no valido";
			//echo "$error";
			header("location: ../keyParkingInicio.html");
		}
	}
?>