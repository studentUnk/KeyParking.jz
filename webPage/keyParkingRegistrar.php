<!DOCTYPE html>
<html>
<head>
<script type="text/javascript" src="javascript/script.js"></script>
<script type="text/javascript" src="javascript/enc.js"></script>
<style>
	#datosP label{
		display: inline-block;
		width: 150px;
	}
	.error {
		color: #33AEF9;
	}
</style>
</head>
<body>

<?php
	include("php/functionsCheck.php");
	include("php/connectDB.php");
	include("php/encAES.php");
			
	$nameError = $lnameError = $docError = $dirError = "";
	$telError = $celError = $emailError = $codeError = $pwdError = "";
	
	if($_SERVER["REQUEST_METHOD"]=="POST"){
		$checkMe = 1;
		//check that everything is Ok!
		$myuserN = "";
		if (empty($_POST['userN'])){
			$nameError = "Por favor ingrese su nombre";
			$checkMe = 0;
		} else {
			$myuserN = $_POST['userN'];
			$myuserN = base64_decode($myuserN); // dump encoding
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
		if (empty($_POST['userA'])){
			$lnameError = "Por favor ingrese su apellido";
			$checkMe = 0;
		} else {
			$myuserA = $_POST['userA'];
			$myuserA = base64_decode($myuserA);
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
		if (empty($_POST['userDoc'])){
			$docError = "Por favor ingrese su documento";
			$checkMe = 0;
		} else {
			$myuserDoc = $_POST['userDoc'];
			$myuserDoc = base64_decode($myuserDoc);
			$myuserDoc = check_input2($myuserDoc);
			if($myuserDoc == ""){
				$docError = "Por favor ingrese correctamente su documento";
				$checkMe = 0;
			}else{
				if(size_Me($myuserDoc, 30)){
					$myuserDoc=mysqli_real_escape_string($conn,$myuserDoc);
				}else{
					$docError = "Su documento no debe exceder los 30 caracteres";
					$checkMe = 0;
				}
			}
		}
		if (empty($_POST['userDir'])){
			$dirError = "Por favor ingrese su direccion";
			$checkMe = 0;
		} else {
			$myuserDir = $_POST['userDir'];
			$myuserDir = base64_decode($myuserDir);
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
		if (empty($_POST['userTel'])){ 
			$telError = "Por favor ingrese su telefono";
			$checkMe = 0;
		} else {
			$myuserT = $_POST['userTel'];
			$myuserT = base64_decode($myuserT);
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
		if (empty($_POST['userCel'])){ 
			$celError = "Por favor ingrese su numero de celular";
			$checkMe = 0;
		} else {
			$myuserCel = $_POST['userCel'];
			$myuserCel = base64_decode($myuserCel);
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
		if (empty($_POST['userCorreo'])){
			$emailError = "Por favor ingrese su correo";
			$checkMe = 0;
		} else {
			$myuserCor = $_POST['userCorreo'];
			$myuserCor = base64_decode($myuserCor);
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
		if (empty($_POST['userCode'])){
			$codeError = "Por favor ingrese un numero que conste de 0-9, hasta el 9999999999";
			$checkMe = 0;
		} else {
			$myuserCod = $_POST['userCode'];
			$myuserCod = base64_decode($myuserCod);
			$myuserCod = check_input($myuserCod);
			if($myuserCod == "" or ! check_user($myuserCod)){
				$codeError = "Su codigo debe constar de solo codigos del 0-9";
				$checkMe = 0;				
			}else{
				if(size_Me($myuserCod, 11)){
					//test if the code already exists
					$myuserCod=mysqli_real_escape_string($conn,$myuserCod);
					$sql = "SELECT codigo_Usuario ".
					"FROM Usuario ".
					"WHERE Usuario.codigo_Usuario = ".$myuserCod;
					$result = $conn->query($sql);
					if($result->num_rows > 0){
						$codeError = "El codigo elegido ya existe, por favor escoja otro";
						$checkMe = 0;
					}
				} else{
					$codeError = "Su codigo no debe exceder 11 digitos";
					$checkMe = 0;
				}				
			}
		}
		if (empty($_POST['pwd'])){
			$pwdError = "Por favor ingrese un password";
			$checkMe = 0;
		} else {
			$myuserPwd = $_POST['pwd'];
			$myuserPwd = base64_decode($myuserPwd);
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
		
		if($checkMe){			
			$sql = "INSERT INTO Usuario (documento_Usuario,nombre_Usuario, apellido_Usuario, direccion_Usuario, telefono_Usuario," .
			"celular_Usuario, email_Usuario, codigo_Usuario, password_Usuario, nombre_Rol, codigo_Municipio) " .
			"VALUES ('$myuserDoc','$myuserN','$myuserA','$myuserDir','$myuserT','$myuserCel','$myuserCor'" .
			",$myuserCod,'$myuserPwd','Cliente',1101)";
			
			if($conn->query($sql) === TRUE) {
				header("location: keyParkingInicio.php");
			}else{
				echo "Error: " . $sql . "<br>" . $conn->error;
			}
		}	
	}
	$conn->close();
?>

<h1> Registro keyParking.jz </h1>

<div id="datosP" name="datosP">
	<!--<form action="php/registerUser.php" method="post">-->
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" onsubmit="en64Registro()">
		<label for="userN">Nombre</label>
		<input type="text" id="userN" name="userN">
		<?php echo '<span class="error"><i>'.$nameError.'</i><br></span>';?>
		<br>
		<label for="userA">Apellido</label>
		<input type="text" id="userA" name="userA">
		<?php echo '<span class="error"><i>'.$lnameError.'</i><br></span>';?>
		<br>
		<label for="userDoc">Documento</label>
		<input type="text" id="userDoc" name="userDoc">
		<?php echo '<span class="error"><i>'.$docError.'</i><br></span>';?>
		<br>
		<label for="userDir">Direccion</label>
		<input type="text" id="userDir" name="userDir">
		<?php echo '<span class="error"><i>'.$dirError.'</i><br></span>';?>
		<br>
		<label for="userTel">Telefono</label>
		<input type="text" id="userTel" name="userTel">
		<?php echo '<span class="error"><i>'.$telError.'</i><br></span>';?>
		<br>
		<label for="userCel">Celular</label>
		<input type="text" id="userCel" name="userCel">
		<?php echo '<span class="error"><i>'.$celError.'</i><br></span>';?>
		<br>
		<label for="userCorreo">Correo</label>
		<input type="text" id="userCorreo" name="userCorreo">
		<?php echo '<span class="error"><i>'.$emailError.'</i><br></span>';?>
		<br>
		<label for="userCode">Codigo</label>
		<input type="text" id="userCode" name="userCode">
		<?php echo '<span class="error"><i>'.$codeError.'</i><br></span>';?>
		<br>
		<label for="pass">Password</label>
		<input type="password" id="pwd" name="pwd">
		<?php echo '<span class="error"><i>'.$pwdError.'</i><br></span>';?>
		<br>
		<button type="button" id="noSend" name="noSend" onclick="openS()">Regresar</button>
		<input type="submit" value="Enviar">
	</form>
</div>

</body>
</html>