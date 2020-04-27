<?php
	//include("connectDB.php");
	
	$sql = "SELECT nombre_SedeParqueadero ".
	"FROM SedeParqueadero";
	$result = $conn->query($sql);
	if($result->num_rows > 0){
		
	}
		
		if($conn->query($sql) === TRUE) {
			header("location: ../keyParkingInicio.html");
		}else{
			echo "Error: " . $sql . "<br>" . $conn->error;
		}		
	}
	$conn->close();
?>