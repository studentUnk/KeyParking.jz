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

#solicitarCupoTexto label{
	display: inline-block;
	width: 80px;
}

</style>
</head>
<body>

<h1> Bienvenido <?php echo $login_session; ?></h1>
<div id="menuCompleto" name="menuCompleto">
	<div class="vertical-menu">
	<a href="../../php/logout.php">Cerrar sesion</a>
	<a href="SolicitarCupo.php">Solicitar cupo</a>
	<a href="PagarFactura.php">Pagar factura</a>
	<a href="FacturaPagada.php">Facturas pagadas</a>
	<a href="AlternativaParqueadero.php">Alternativas parqueadero</a>
	<a href="ModificarDatos.php">Modificar datos personales</a>
	<a href="AgregarVehiculo.php">Agregar vehiculo</a>
	</div>
	<div id="solicitarCupoTexto" name="solicitarCupoTexto">
	<form action="../../php/updateUser.php" method="post">
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
				echo '<br>';
				echo '<label for="lname">Apellido </label>';
				echo '<input type="text" id="lname" name="lname" value="'.$row["apellido_Usuario"].'">';
				echo '<br>';
				echo '<label for="addr">Direccion </label>';
				echo '<input type="text" id="addr" name="addr" value="'.$row["direccion_Usuario"].'">';
				echo '<br>';
				echo '<label for="pho">Telefono </label>';
				echo '<input type="text" id="pho" name="pho" value="'.$row["telefono_Usuario"].'">';
				echo '<br>';
				echo '<label for="smpho">Celular </label>';
				echo '<input type="text" id="smpho" name="smpho" value="'.$row["celular_Usuario"].'">';
				echo '<br>';
				echo '<label for="em">Correo </label>';
				echo '<input type="text" id="em" name="em" value="'.$row["email_Usuario"].'">';
				echo '<br>';
				echo '<label for="pwd">Password </label>';
				echo '<input type="password" id="pwd" name="pwd" value="'.$row["password_Usuario"].'">';
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

</body>
</html>