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
	<form action="../../php/registerVeh.php" method="post">
		<label for="mypl">Placa</label>
		<br>
		<input type="text" id="mypl" name="mypl">
		<br>
		<label for="myco">Color</label>
		<br>
		<input type="text" id="myco" name="myco">
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

</body>
</html>