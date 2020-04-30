<?php
	include('connectDB.php');
	session_start();
	
	$user_check = $_SESSION['login_user'];
	
	if($_SERVER["REQUEST_METHOD"]=="POST"){
		$myveh=mysqli_real_escape_string($conn,$_POST['vehiculo']);
		$mysit=mysqli_real_escape_string($conn,$_POST['sitio']);
		$find='-';
		$pos=strpos($mysit, $find);
		$sit=substr($mysit,0,$pos);
		$sed=substr($mysit,$pos+1);
		$codV="";
		$codS="not";
		
		$sql="SELECT codigo_Vehiculo ".
		"FROM Vehiculo ".
		"WHERE placa_vehiculo = '".$myveh."' AND ".
		"codigo_Usuario = ".$user_check;
		//$result=mysqli_query($conn,$sql);
		$result = $conn->query($sql);
		if($result->num_rows > 0){
			$row = $result->fetch_assoc();
			$codV=$row['codigo_Vehiculo'];
		}
		
		// It would be nice to check availabity again...

		$sql="SELECT codigo_SitioParqueadero ".
		"FROM SitioParqueadero, SedeParqueadero ".
		"WHERE SitioParqueadero.ubicacion_SitioParqueadero = '".$sit."' ".
		"AND SitioParqueadero.codigo_SedeParqueadero = SedeParqueadero.codigo_SedeParqueadero ".
		"AND SedeParqueadero.nombre_SedeParqueadero = '".$sed."'";
		//echo $sql.'<br>';
		//$result=mysqli_query($conn,$sql);
		$result = $conn->query($sql);
		if($result->num_rows > 0){
			$row = $result->fetch_assoc();
			$codS=$row['codigo_SitioParqueadero'];
		}
		
		//echo $codS.'<br>';
		$sql="INSERT INTO UsoParqueadero ".
		"(codigo_Vehiculo, codigo_SitioParqueadero, inicio_UsoParqueadero) ".
		"VALUES (".$codV.",'".$codS."','".date("Y-m-d H-i-s")."')";
		if($conn->query($sql) === TRUE) {
			$sql2="UPDATE SitioParqueadero ".
			"SET disponibilidad_SitioParqueadero = 'No' ".
			"WHERE codigo_SitioParqueadero = '".$codS."'";
			if($conn->query($sql2) === TRUE){
				echo "Solicitud enviada exitosamente<br>";
				header("location: ../menu/cli/successSol.php");
			}
			else{
				echo "Se creo factura pero el sitio no fue actualizado<br>";
			}
		}else{
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}
?>