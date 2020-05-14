<?php
	@ include('../../php/session.php');
?>
<!DOCTYPE html>
<html>
<head>
<script type="text/javascript" src="../../javascript/script.js"></script>
<style>
.column {
	float: left;
}

.left {
	width: 20%;
	height: 100vmax;
	background-color: #F0F8FF;
}

.right {
	width: 80%;
}

.row:after {
	content: "";
	display: table;
	clear: both;
}

h1 {
	text-align: center;
}

.vertical-menu a{
	text-align: center;
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
	$placaError = $colorError = "";
	if($_SERVER["REQUEST_METHOD"]=="POST"){
		$checkMe = 1;
		if (empty($_POST['mypl'])){
			$placaError = "Por favor ingrese la placa";
			$checkMe = 0;
		} else {
			$myuserPl = $_POST['mypl'];
			$myuserPl = check_input2($myuserPl);
			if($myuserPl == "" or ! size_Me($myuserPl, 15)){
				$placaError = "La placa ingresada no es valida";
				$checkMe = 0;
			}else{
				$sql = "SELECT placa_Vehiculo ".
				"FROM Vehiculo ".
				"WHERE Vehiculo.codigo_Usuario = ".$user_check." ".
				"AND Vehiculo.placa_Vehiculo = '".$myuserPl."'";
				//echo $sql;
				$result = $conn->query($sql);
				if($result->num_rows > 0){
					$placaError = "El usuario ya esta asociado a esta placa";
					$checkMe = 0;
				}else{
					$myuserPl = mysqli_real_escape_string($conn,$myuserPl);
				}
			}
		}
		if (empty($_POST['myco'])){
			$colorError = "Por favor ingrese un color";
			$checkMe = 0;
		} else {
			$myuserCo = $_POST['myco'];
			$myuserCo = check_input2($myuserCo);
			if($myuserCo == "" or ! size_Me($myuserCo, 15)){
				$colorError = "El color ingresado no es valido";
				$checkMe = 0;
			}else{
				$myuserCo=mysqli_real_escape_string($conn,$myuserCo);
			}
		}
		if($checkMe == 1){
			//$myuserPl=mysqli_real_escape_string($conn,$_POST['mypl']);
			//$myuserCo=mysqli_real_escape_string($conn,$_POST['myco']);
			$myuserTy=mysqli_real_escape_string($conn,$_POST['myty']);
			$myuserBr=mysqli_real_escape_string($conn,$_POST['mybr']);
			
			$sql = "INSERT INTO Vehiculo (placa_Vehiculo, color_Vehiculo, codigo_TipoVehiculo,".
			"codigo_MarcaVehiculo, codigo_Usuario) ".
			"VALUES ('".$myuserPl."', '".$myuserCo."', ".$myuserTy.", ".$myuserBr.", ".$user_check.")";
			
			if($conn->query($sql) === TRUE) {
				header("location: successVeh.php");
			}else{
				echo "Error: " . $sql . "<br>" . $conn->error;
			}	
		}	
	}
?>

<img src="../../img/logoF.png" alt="logo" width="140" height="45" style="float:left;">
<h1> Bienvenido <?php echo '<i>'.$login_session.'</i>'; ?></h1>
<div id="menuCompleto" name="menuCompleto">
	<div class="column left" id="menuCompleto" name="menuCompleto" style="background-color:#F0F8FF;">
		<div class="vertical-menu">
		<a href="../../php/logout.php">Cerrar sesion</a><br>
		<a href="SolicitarCupo.php">Solicitar cupo</a>
		<a href="PagarFactura.php">Pagar factura</a>
		<a href="FacturaPagada.php">Facturas pagadas</a>
		<a href="AlternativaParqueadero.php">Alternativas parqueadero</a>
		<a href="ModificarDatos.php">Modificar datos personales</a>
		<a href="AgregarVehiculo.php">Agregar vehiculo</a>
		</div>
	</div>
	<div class="column right">
		<div id="solicitarCupoTexto" name="solicitarCupoTexto">
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
			<label for="mypl">Placa</label>
			<br>
			<input type="text" id="mypl" name="mypl">
			<?php echo '<span class="error"><i>'.$placaError.'</i></span>';?>
			<br>
			<label for="myco">Color</label>
			<br>
			<input type="text" id="myco" name="myco">
			<?php echo '<span class="error"><i>'.$colorError.'</i></span>';?>
			<br><br>
			<label for="myty">Tipo de vehiculo</label>
			<br>
			<select id="myty" name="myty">
			<?php
				$sql="SELECT codigo_TipoVehiculo, nombre_TipoVehiculo ".
				"FROM TipoVehiculo ";
				$result = $conn->query($sql);
				if($result->num_rows > 0){				
					while($row = $result->fetch_assoc()){
						echo '<option value="'.$row['codigo_TipoVehiculo'].'">'.
						$row['nombre_TipoVehiculo'].'</option>';
					}				
				}
				else{
					echo '<option value="ningunaS">Ninguna</option>';
				}
			?>
			</select>
			<br><br>
			<label for="mybr">Marca de vehiculo</label>
			<br>
			<select id="mybr" name="mybr">
			<?php
				$sql="SELECT codigo_MarcaVehiculo, nombre_MarcaVehiculo ".
				"FROM MarcaVehiculo";
				$result = $conn->query($sql);
				if($result->num_rows > 0){				
					while($row = $result->fetch_assoc()){
						echo '<option value="'.$row['codigo_MarcaVehiculo'].'">'.
						$row['nombre_MarcaVehiculo'].'</option>';
					}				
				}
				else{
					echo '<option value="ningunaS">Ninguna</option>';
				}
			?>
			</select>
			<br><br>
			<input type="submit" value="Agregar">
		</form>
		</div>
	</div>
</div>

</body>
</html>