<!DOCTYPE html>
<html>
<head>
<script type="text/javascript" src="javascript/script.js"></script>
<script type="text/javascript" src="javascript/enc.js"></script>
<style>
	body, html {
		height: 80%;
		width: 100%;
	}
	body {
		background-image: url('img/logoF.png');
		background-repeat: no-repeat;
		background-position: bottom;
		background-size:90%
	}
	#datosU {
		margin: auto;
		text-align: center;
	}
	#datosU label{
		display: inline-block;
		width: 75px;
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
	
	session_start();
	
	$uPError = $userError = $passError = "";
	$checkMe = 1;
	
	if($_SERVER["REQUEST_METHOD"]=="POST"){
		$myuser = $mypass = "";
		if (empty($_POST['userT'])){
			$userError = "Por favor ingrese su usuario";
			$checkMe = 0;
		} else {
			$myuser = check_input($_POST['userT']);
			$myuser = base64_decode($myuser); // dummy protection
			//echo $myuser." data user";
			if($myuser == ""){
				$userError = "Usuario no es valido";
				$checkMe = 0;
			} else{
				//echo $myuser." data user";
				if(check_user($myuser)){
					//echo $myuser." data user";
					$myuser = mysqli_real_escape_string($conn,$myuser);
					//$myuser = check_input($myuser);
				} else{
					$userError = "Usuario no es valido";
					$checkMe = 0;
				}
			}
		}
		if (empty($_POST['pwd'])){
			$passError = "Por favor ingrese su password";
			$checkMe = 0;
		} else {
			$mypass = check_input2($_POST['pwd']);
			$mypass = base64_decode($mypass);
			if($mypass == ""){
				$passError = "Password no es valido";
				$checkMe = 0;
			} else{
				$mypass=mysqli_real_escape_string($conn,$mypass);
			}
		}
		if($checkMe == 1){
			$sql = "SELECT codigo_Usuario, nombre_Rol ".
			"FROM Usuario ".
			"WHERE codigo_Usuario = ".$myuser;
			$result = $conn->query($sql);
			if($result->num_rows > 0){
				$row = $result->fetch_assoc();
				$tU = $row['nombre_Rol'];
				if(strcmp($tU, "Cliente") == 0){ // client
					$mypass = encrypt_Openssl($mypass); // encrypt the password to check
				}
				else{ // admin and aux
					$sql2 = "SELECT AES_ENCRYPT('".$mypass."', 'ProgramacionAvanzada') ";
					$result2 = $conn->query($sql2);
					//$result2->num_rows;
					$row2 = $result2->fetch_assoc();
					$mypass = $row2["AES_ENCRYPT('".$mypass."', 'ProgramacionAvanzada')"];
				}
			}
			
			$sql="SELECT codigo_Usuario, nombre_Rol FROM Usuario WHERE codigo_Usuario=$myuser AND password_Usuario='$mypass'";
			$result=mysqli_query($conn,$sql);
			$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
			$active=$row['active'];
			
			$count=mysqli_num_rows($result);
			// if the user matched then the table must return 1 user
			$conn->close();
			if($count==1){
				//session_register("codigo_Usuario");
				$_SESSION['login_user']=$myuser;
				$typeU = array("Cliente","Auxiliar");
				if(strcmp($row['nombre_Rol'],$typeU[0]) == 0){
					header("location: menu/cli/Menue.php");
				} else{
					if(strcmp($row['nombre_Rol'],$typeU[1]) == 0){
						header("location: menu/aux/Administrame.php");
					} else{
						// you are god!! good luck! :P
						header("location: menu/adm/OpcionAdministrador.php");
					}
				}
				//header("location: testW.php");
			}else{
				//$error="Acceso no valido";
				//echo "$error";
				//header("location: keyParkingInicio.php");
				$uPError = "Password o usuario incorrecto";
			}
		}
	}
?>

<h1> Bienvenido a keyParking.jz </h1>

<div id="datosU" name="datosU">
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" onsubmit="en64Inicio()" >
		<label for="userT">Usuario</label>
		<input type="text" id="userT" name="userT">
		<br>
		<label for="pwd">Password</label>
		<input type="password" id="pwd" name="pwd">
		<br><br>
		<input type="submit" value="Ingresar">
		<button type="button" id="reg" name="reg" onclick="openR()">Registrar</button>
		<button type="button" id="consP" name="consP" onclick="showP()">Tarifas</button>
		
		<br> <br> <br>
		<?php
			if($userError != ""){
				echo '<span class="error"><i>'.$userError.'</i><br></span>';
			}
			if($passError != ""){
				echo '<span class="error"><i>'.$passError.'</i><br></span>';
			}
			if($userError == "" and $passError == "" and $uPError != ""){
				echo '<span class="error"><i>'.$uPError.'</i><br></span>';
			}
		?>
	</form>
</div>

</body>
</html>