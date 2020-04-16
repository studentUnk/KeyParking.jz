<?php
	include('connectDB.php');
	session_start();
	
	$user_check = $_SESSION['login_user'];
	
	$sql = "SELECT nombre_Usuario FROM Usuario WHERE codigo_Usuario=$user_check";
	$ses_sql = mysqli_query($conn,$sql);
	
	$row = mysqli_fetch_array($ses_sql, MYSQLI_ASSOC);
	
	$login_session = $row['nombre_Usuario'];
	
	if(!isset($_SESSION['login_user'])){ // look for the user
		header("location: ../keyParkingInicio.html");
		die(); // close the session
	}
?>