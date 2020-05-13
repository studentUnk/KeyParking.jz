<?php
	@ include('../../php/session.php');
?>
<!DOCTYPE html>
<html>
<head>
<script type="text/javascript" src="javascript/script.js"></script>
<style>
.menuCompleto:{

}

.vertical-menu {
	width: 200px;
	float: left;
}
.vertical-menu a{
	background-color: #F0F8FF;
	display: block;
	padding: 8px;
}
.vertical-menu a:hover{
	background-color: #FFEBCD;
}
.vertical-menu a.active {
	background-color: #A52A2A;
}

.solicitarCupoTexto {
	float: right;
}

.mydate {
	visibility: hidden;
	hidden;
}
.error {
	color: #33AEF9;
}
</style>
</head>
<body>
<?php
	include("../../php/functionsCheck.php");
	//include('../../php/connectDB.php');
	$sitioError = $nameError = $placaError = "";
	if($_SERVER["REQUEST_METHOD"]=="POST"){
		$checkMe = 1;
		if (empty($_POST['placaV'])){
			$placaError = "Por favor ingrese la placa del vehiculo";
			$checkMe = 0;
		} else {
			$myveh = $_POST['placaV'];
			$myveh = check_input2($myveh);
			if($myveh == "" or ! size_Me($myveh, 15)){ // empty or not exist
				$placaError = "Por favor ingrese correctamente la placa del vehiculo";
				$checkMe = 0;
			} else{
				$myveh=mysqli_real_escape_string($conn,$myveh);
			}
		}
		if (empty($_POST['nameU'])){
			$nameError = "Por favor ingrese el codigo del usuario";
			$checkMe = 0;
		} else {
			$mycod = $_POST['nameU'];
			$mycod = check_input2($mycod);
			if($mycod == "" or ! size_Me($mycod, 11)){ // empty or not exist
				$nameError = "Por favor ingrese correctamente el codigo del usuario";
				$checkMe = 0;
			} else{
				$mycod = mysqli_real_escape_string($conn,$mycod);
			}
		}
		$mysit = mysqli_real_escape_string($conn,$_POST['sitio']);
		if ($mysit == "ningunaS"){ // Review this
			$sitioError = "No puede solicitar parqueadero porque no hay sitio disponible";
			$checkMe = 0;
		}
		if($checkMe == 1){
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
				header("location: unsuccessAuxSol.php");
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
			else{
				header("location: unsuccessAuxSol.php");
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
					header("location: successAuxSol.php");
				}
				else{
					echo "Se creo factura pero el sitio no fue actualizado<br>";
				}
			}else{
				echo "Error: " . $sql . "<br>" . $conn->error;
			}
		}
	}

?>

<h1> Bienvenido <?php echo $login_session; ?></h1>

<div id="menuCompleto" name="menuCompleto">
	<form action="../../php/logout.php" method="post">
		<input type="submit" value="Cerrar sesion">
		<br><br>
	</form>
	Facilita la solicitud de parqueadero al usuario.
	<br><br>
	
	<div id="insertUser" name="insertUser">
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
		<label for="nameU">Codigo del usuario</label>
		<br>
		<input type="text" id="nameU" name="nameU">
		<?php echo '<span class="error"><i>'.$nameError.'</i><br></span>';?>
		<br><br>
		<label for="placaV">Placa del vehiculo</label>
		<br>
		<input type="text" id="placaV" name="placaV">
		<?php echo '<span class="error"><i>'.$placaError.'</i><br></span>';?>
		<br><br>
		<label for="sitio">Sitios disponibles</label>
		<br>
		<?php
			$sql="SELECT ubicacion_SitioParqueadero, nombre_SedeParqueadero ".
			"FROM SitioParqueadero, SedeParqueadero ".
			"WHERE SitioParqueadero.codigo_SedeParqueadero = SedeParqueadero.codigo_SedeParqueadero ".
			"AND SitioParqueadero.disponibilidad_SitioParqueadero = 'Si'";
			$result = $conn->query($sql);
			echo '<select id="sitio" name="sitio">';
			$vtemp = 0;
			if($result->num_rows > 0){				
				while($row = $result->fetch_assoc()){
					echo '<option value="'.$row['ubicacion_SitioParqueadero'].
					"-".$row['nombre_SedeParqueadero'].'">'.
					$row['ubicacion_SitioParqueadero'].'-'.
					$row['nombre_SedeParqueadero'].'</option>';
				}
			}
			else{
				echo '<option value="ningunaS">No hay disponibles</option>';
			}
			echo '</select>';
			echo '<br>';
		?>
		<br><br>
		<?php echo '<span class="error"><i>'.$sitioError.'</i><br></span>';?>
		<input type="submit" value="Asignar">
	</form>
	</div>
</div>

</body>
</html>