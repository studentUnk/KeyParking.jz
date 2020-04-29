<?php
	include('../php/connectDB.php');
	
	if($_SERVER["REQUEST_METHOD"]=="POST"){
		$myveh=mysqli_real_escape_string($conn,$_POST['placaV']);
		$mysit=mysqli_real_escape_string($conn,$_POST['sitio']);
		$mycod=mysqli_real_escape_string($conn,$_POST['nameU']);
		$find='-';
		$pos=strpos($mysit, $find);
		$sit=substr($mysit,0,$pos);
		$sed=substr($mysit,$pos+1);
		$codV="";
		$codS="not";
		
		$sql="SELECT codigo_Vehiculo ".
		"FROM Vehiculo ".
		"WHERE placa_vehiculo = '".$myveh."' ".
		"AND codigo_Usuario = ".$mycod;
		$result = $conn->query($sql);
		if($result->num_rows > 0){
			$row = $result->fetch_assoc();
			$codV=$row['codigo_Vehiculo'];
		}
		else{
		
		}
		
		// It would be nice to check availabity again...

		$sql="SELECT codigo_SitioParqueadero ".
		"FROM SitioParqueadero, SedeParqueadero ".
		"WHERE SitioParqueadero.ubicacion_SitioParqueadero = '".$sit."' ".
		"AND SitioParqueadero.codigo_SedeParqueadero = SedeParqueadero.codigo_SedeParqueadero ".
		"AND SedeParqueadero.nombre_SedeParqueadero = '".$sed."'";
		$result = $conn->query($sql);
		if($result->num_rows > 0){
			$row = $result->fetch_assoc();
			$codS=$row['codigo_SitioParqueadero'];
		}
		
		$sql="INSERT INTO UsoParqueadero ".
		"(codigo_Vehiculo, codigo_SitioParqueadero, inicio_UsoParqueadero) ".
		"VALUES (".$codV.",'".$codS."','".date("Y-m-d H-i-s")."')";
		if($conn->query($sql) === TRUE) {
			$sql2="UPDATE SitioParqueadero ".
			"SET disponibilidad_SitioParqueadero = 'No' ".
			"WHERE codigo_SitioParqueadero = '".$codS."'";
			if($conn->query($sql2) === TRUE){
				echo "Solicitud enviada exitosamente<br>";
				header("location: ../menu/successAuxSol.php");
			}
			else{
				echo "Se creo factura pero el sitio no fue actualizado<br>";
			}
		}else{
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
		//$result=mysqli_query($conn,$sql);
		//$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
		//$active=$row['active'];
		
		//$count=mysqli_num_rows($result);
		// if the user matched then the table must return 1 user
		//if($count==1){
			//session_register("codigo_Usuario");
		//	$_SESSION['login_user']=$myuser;
		//	header("location: ../menu/SolicitarCupo.php");
			//header("location: testW.php");
		//}else{
		//	$error="Acceso no valido";
			//echo "$error";
		//	header("location: ../keyParkingInicio.html");
		//}
		//echo $myveh.'<br>';
		//echo $mysit.'<br>';
		//echo substr($mysit,0,$pos).'<br>';
		//echo substr($mysit,$pos+1).'<br>';
		//echo date("Y-m-d H-i-s");
	}
	//echo 'Solicitud exitosa';
?>