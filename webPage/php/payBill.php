<?php
	include('connectDB.php');
	session_start();
	
	$user_check = $_SESSION['login_user'];
	
	if($_SERVER["REQUEST_METHOD"]=="POST"){
		$mybill=mysqli_real_escape_string($conn,$_POST['facturasL']);
		$submitforP=0;
		$dateS="";
		$codeSP=0; // codigo_SitioParqueadero
		$checkMe=0; // check any error to stop queries
		// get payment that is related to the vehicle
		$sql="SELECT cobroMinuto_TipoVehiculo ".
		"FROM Vehiculo, UsoParqueadero, TipoVehiculo ".
		"WHERE UsoParqueadero.codigo_UsoParqueadero = ".$mybill." ".
		"AND UsoParqueadero.codigo_Vehiculo = Vehiculo.codigo_Vehiculo ".
		"AND Vehiculo.codigo_TipoVehiculo = TipoVehiculo.codigo_TipoVehiculo";
		//$result=mysqli_query($conn,$sql);
		$result = $conn->query($sql);
		if($result->num_rows > 0 and $checkMe == 0){
			$row = $result->fetch_assoc();
			$submitforP=$row['cobroMinuto_TipoVehiculo'];
		}
		else{
			//echo "Error obteniendo cobro<br>";
			$checkMe = 1;
		}
		// get start time
		$sql="SELECT inicio_UsoParqueadero, codigo_SitioParqueadero ".
		"FROM UsoParqueadero ".
		"WHERE UsoParqueadero.codigo_UsoParqueadero = ".$mybill;
		//$result=mysqli_query($conn,$sql);
		$result = $conn->query($sql);
		$dateSS = "";
		if($result->num_rows > 0 and $checkMe == 0){
			$row = $result->fetch_assoc();
			$dateSS = $row['inicio_UsoParqueadero'];
			$codeSP = $row['codigo_SitioParqueadero'];
			$dateS = new DateTime($dateSS);
			//$dateS = $row['inicio_UsoParqueadero'];
		}
		else{
			// Fix
			header("location: ../menu/cli/Menue.php");
			//echo "Error obteniendo datos del parqueadero<br>";
			$checkMe = 1;
		}
		
		$dateE = date("Y-m-d H:i:s");		
		$diffT = $dateS->diff(new DateTime($dateE));
		// Just minutes and hours for now
		$amountToPay = 0;
		$amountToPay += $diffT->d*24*60;
		$amountToPay += $diffT->h*60;
		$amountToPay += $diffT->i;
		$amountToPay *= $submitforP;		
		
		echo $submitforP."<br>";
		echo $dateSS."<br>";
		echo $dateE."<br>";
		echo $amountToPay."<br>";
		
		$lastBU=0; // last change of the user 
		
		//insert Factura
		$sql="INSERT INTO Factura ".
		"(fecha_Factura, codigo_Usuario, precio_Factura, cancelado_Factura) ".
		"VALUES ('".$dateE."', ".$user_check.", ".$amountToPay.", 'Si')";
		if($conn->query($sql) === TRUE and $checkMe == 0) {
			echo "Factura ha sido cancelada<br>";
		}
		else{
			//echo "La factura no se pudo cancelar<br>";
			$checkMe = 1;
		}
		
		// gest last change of the user
		$sql="SELECT codigo_Factura ".
		"FROM Factura ".
		"WHERE codigo_Usuario = ".$user_check." ".
		"ORDER BY codigo_Factura DESC LIMIT 1";
		$result = $conn->query($sql);
		if($result->num_rows > 0 and $checkMe == 0){
			$row = $result->fetch_assoc();
			$lastBU = $row['codigo_Factura'];
		}
		else{
			//echo "No se obtuvo la ultima factura<br>";
			$checkMe = 1;
		}
		
		// update UsoParqueadero
		$sql="UPDATE UsoParqueadero ".
		"SET codigo_Factura = ".$lastBU.", fin_UsoParqueadero = '".$dateE."' ".
		"WHERE codigo_UsoParqueadero = ".$mybill;
		if($conn->query($sql) === TRUE and $checkMe == 0) {
			echo "Factura actualizada<br>";
		}
		else{
			echo "La factura no fue actualizada<br>";
			$checkMe = 1;
		}
		
		// update SitioParqueadero
		$sql="UPDATE SitioParqueadero ".
		"SET disponibilidad_SitioParqueadero = 'Si' ".
		"WHERE codigo_SitioParqueadero = '".$codeSP."'";
		echo $codeSP."<br>";
		if($conn->query($sql) === TRUE and $checkMe == 0) {
			echo "Sitio del parqueadero actualizado<br>";
		}
		else{
			//echo "El sitio del parqueadero no ha sido modificado<br>";
			$checkMe = 1;
		}
		
		if($checkMe == 0){
			header("location: ../menu/cli/successBill.php");
		}
		else{
			//Fix
			header("location: ../menu/cli/MenuE.php");
		}
	}
?>