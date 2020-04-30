<?php
	include('connectDB.php');
		
	if($_SERVER["REQUEST_METHOD"]=="POST"){
		$myq=mysqli_real_escape_string($conn,$_POST['myq']);
		
		$sql=$myq; // query from admin
		
		$result=$conn->query($sql);
		if($result->num_rows > 0 or $result === TRUE){
			header('location: ../menu/adm/successQ.php');
		}
		else{
			header('location: ../menu/adm/unsuccessQ.php');
		}
	}
?>