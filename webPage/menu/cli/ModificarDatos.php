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

#solicitarCupoTexto label{
	display: inline-block;
	width: 85px;
}

</style>
</head>
<body>

<?php
	include("../../php/functionsCheck.php");
	include("../../php/encAES.php");
	//session_start();
	
	//$user_check = $_SESSION['login_user'];
	$nameError = $lnameError = $dirError = "";
	$telError = $celError = $emailError = $pwdError = "";
	
	if($_SERVER["REQUEST_METHOD"]=="POST"){
		$checkMe = 1;
		if (empty($_POST['nameU'])){
			$nameError = "Su nombre no puede quedar vacio";
			$checkMe = 0;
		} else {
			$myuserN = $_POST['nameU'];
			//$myuserN = base64_decode($myuserN); // dump encoding
			$myuserN = check_input2($myuserN);
			if($myuserN == ""){
				$nameError = "Por favor ingrese correctamente su nombre";
				$checkMe = 0;
			}else{
				if(size_Me($myuserN,45)){
					$myuserN=mysqli_real_escape_string($conn,$myuserN);
				}else{
					$nameError = "Su nombre no debe exceder los 40 caracteres";
					$checkMe = 0;
				}
			}
		}
		if (empty($_POST['lname'])){
			$lnameError = "Su apellido no debe quedar vacio";
			$checkMe = 0;
		} else {
			$myuserA = $_POST['lname'];
			//$myuserA = base64_decode($myuserA);
			$myuserA = check_input2($myuserA);
			if($myuserA == ""){
				$lnameError = "Por favor ingrese correctamente su apellido";
				$checkMe = 0;
			}else{
				if(size_Me($myuserA, 45)){
					$myuserA=mysqli_real_escape_string($conn,$myuserA);
				}else{
					$lnameError = "Su apellido no debe exceder los 45 caracteres";
					$checkMe = 0;
				}
			}
		}
		if (empty($_POST['addr'])){
			$dirError = "Su direccion no debe quedar vacia";
			$checkMe = 0;
		} else {
			$myuserDir = $_POST['addr'];
			//$myuserDir = base64_decode($myuserDir);
			$myuserDir = check_input2($myuserDir);
			if($myuserDir == ""){
				$dirError = "Por favor ingrese correctamente su direccion";
				$checkMe = 0;
			}else{
				if(size_Me($myuserDir, 45)){
					$myuserDir=mysqli_real_escape_string($conn,$myuserDir);
				}else{
					$dirError = "Su direccion no debe exceder los 45 caracteres";
					$checkMe = 0;
				}
			}
		}
		if (empty($_POST['pho'])){ 
			$telError = "Su numero de telefono no debe quedar vacio";
			$checkMe = 0;
		} else {
			$myuserT = $_POST['pho'];
			//$myuserT = base64_decode($myuserT);
			$myuserT = check_input2($myuserT);
			if($myuserT == "" or ! is_a_number($myuserT)){
				$telError = "Por favor ingrese correctamente su telefono";
				$checkMe = 0;
			}else{
				if(size_Me($myuserT, 10)){
					$myuserT=mysqli_real_escape_string($conn,$myuserT);
				}else{
					$telError = "Su numero no debe exceder los 10 digitos";
					$checkMe = 0;
				}
			}
		}
		if (empty($_POST['smpho'])){ 
			$celError = "Su numero de celular no debe quedar vacio";
			$checkMe = 0;
		} else {
			$myuserCel = $_POST['smpho'];
			//$myuserCel = base64_decode($myuserCel);
			$myuserCel = check_input2($myuserCel);
			if($myuserCel == "" or ! is_a_number($myuserCel)){
				$celError = "Por favor ingrese correctamente su celular";
				$checkMe = 0;
			}else{
				if(size_Me($myuserCel, 13)){
					$myuserCel=mysqli_real_escape_string($conn,$myuserCel);
				}else{
					$celError = "Su celular no debe exceder los 13 digitos";
					$checkMe = 0;
				}
			}
		}
		if (empty($_POST['em'])){
			$emailError = "Su correo no debe quedar vacio";
			$checkMe = 0;
		} else {
			$myuserCor = $_POST['em'];
			//$myuserCor = base64_decode($myuserCor);
			$myuserCor = check_input2($myuserCor);
			if($myuserCor == "" or ! is_an_email($myuserCor)){
				$emailError = "Por favor ingrese correctamente su correo";
				$checkMe = 0;
			}else{
				if(size_Me($myuserCor, 25)){
					$myuserCor=mysqli_real_escape_string($conn,$myuserCor);
				}else{
					$emailError = "Su correo no debe exceder los 25 caracteres";
					$checkMe = 0;
				}
			}
		}
		if (empty($_POST['pwd'])){
			$pwdError = "Su password no debe quedar vacio";
			$checkMe = 0;
		} else {
			$myuserPwd = $_POST['pwd'];
			//$myuserPwd = base64_decode($myuserPwd);
			$myuserPwd = check_input2($myuserPwd);
			if($myuserPwd == ""){
				$pwdError = "Por favor ingrese correctamente su password";
				$checkMe = 0;
			}else{
				if(size_Me($myuserPwd, 30)){
					// encrypt password
					$encryption = openssl_encrypt($myuserPwd, $methodEncrypt, $encryption_key,
						$options, $encryption_iv);
					$myuserPwd=mysqli_real_escape_string($conn,$encryption);
				}else{
					$pwdError = "Su password no debe exceder los 30 caracteres";
					$checkMe = 0;
				}
			}
		}
		if($checkMe == 1){			
			$sql = "UPDATE Usuario ".
			"SET nombre_Usuario = '".$myuserN."', ".
			"apellido_Usuario = '".$myuserA."', ".
			"direccion_Usuario = '".$myuserDir."', ".
			"telefono_Usuario = '".$myuserT."', ".
			"celular_Usuario = '".$myuserCel."', ".
			"email_Usuario = '".$myuserCor."', ".
			"password_Usuario = '".$myuserPwd."' ".
			"WHERE codigo_Usuario = ".$user_check;
			if($conn->query($sql) === TRUE) {
				header("location: successUpdateUser.php");
			}else{
				echo "Error: " . $sql . "<br>" . $conn->error;
			}
		}		
	}
	//$conn->close();
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
			<?php
				$sql="SELECT nombre_Usuario, apellido_Usuario, direccion_Usuario,".
				"telefono_Usuario, celular_Usuario, password_Usuario, email_Usuario ".
				"FROM Usuario ".
				"WHERE codigo_Usuario = ".$user_check;
				$result = $conn->query($sql);
				$checkMe = 0;
				if($result->num_rows > 0){
					$row = $result->fetch_assoc();
					echo '<label for="nameU">Nombre </label>';
					echo '<input type="text" id="nameU" name="nameU" value="'.$row["nombre_Usuario"].'">';
					echo '<span class="error"><i>'.$nameError.'</i></span>';
					echo '<br>';
					echo '<label for="lname">Apellido </label>';
					echo '<input type="text" id="lname" name="lname" value="'.$row["apellido_Usuario"].'">';
					echo '<span class="error"><i>'.$lnameError.'</i></span>';
					echo '<br>';
					echo '<label for="addr">Direccion </label>';
					echo '<input type="text" id="addr" name="addr" value="'.$row["direccion_Usuario"].'">';
					echo '<span class="error"><i>'.$dirError.'</i></span>';
					echo '<br>';
					echo '<label for="pho">Telefono </label>';
					echo '<input type="text" id="pho" name="pho" value="'.$row["telefono_Usuario"].'">';
					echo '<span class="error"><i>'.$telError.'</i></span>';
					echo '<br>';
					echo '<label for="smpho">Celular </label>';
					echo '<input type="text" id="smpho" name="smpho" value="'.$row["celular_Usuario"].'">';
					echo '<span class="error"><i>'.$celError.'</i></span>';
					echo '<br>';
					echo '<label for="em">Correo </label>';
					echo '<input type="text" id="em" name="em" value="'.$row["email_Usuario"].'">';
					echo '<span class="error"><i>'.$emailError.'</i></span>';
					echo '<br>';
					echo '<label for="pwd">Password </label>';
					echo '<input type="password" id="pwd" name="pwd" value="'.
						decrypt_Openssl($row["password_Usuario"]).'">';
					echo '<span class="error"><i>'.$pwdError.'</i></span>';
				}
				else{
					echo "No se cargaron los datos";
					$checkMe = 1;
				}
			?>
			<br>
			<br>
			<input type="submit" value="Actualizar">
			
		</form>
		</div>
	</div>
</div>

</body>
</html>