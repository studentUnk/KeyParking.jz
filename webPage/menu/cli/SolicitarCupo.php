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

</style>
</head>
<body>

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
			<form action='../../php/successSol.php' method='post'> 
											
				<label for="vehiculo">Vehiculo</label>
				<?php
					$sql = "SELECT Vehiculo.placa_Vehiculo ".
					"FROM Vehiculo ".
					"WHERE ".
					// codigo_Usuario = ".$user_check." ".
					//"AND 
					//"NOT EXISTS( ".
					"Vehiculo.placa_Vehiculo NOT IN(".
					"SELECT placa_Vehiculo ".
					"FROM Vehiculo, UsoParqueadero ".
					"WHERE Vehiculo.codigo_Usuario = ".$user_check." ".
					"AND Vehiculo.codigo_Vehiculo = UsoParqueadero.codigo_Vehiculo ".
					"AND UsoParqueadero.fin_UsoParqueadero IS NULL".
					" )";
					$result = $conn->query($sql);
					echo '<select id="vehiculo" name="vehiculo">';
					if($result->num_rows > 0){
						// ouptut data of each row
						while($row = $result->fetch_assoc()){
							echo '<option value='.$row['placa_Vehiculo'].'>'.
							$row['placa_Vehiculo'].'</option>';
						}
					}
					else{
						echo '<option value="Ninguna">Ninguna</option>';
						// There is no vehicles
					}
					//include ("../php/connectDB.php");
					echo '</select>';
					echo '<br>';
					echo '<br>';
					//$conn->close(); // close the DB
				?>
				<label for="sitio">Sitios disponibles</label>
				<?php
					$sql="SELECT ubicacion_SitioParqueadero, nombre_SedeParqueadero ".
					"FROM SitioParqueadero, SedeParqueadero ".
					"WHERE SitioParqueadero.codigo_SedeParqueadero = SedeParqueadero.codigo_SedeParqueadero ".
					"AND SitioParqueadero.disponibilidad_SitioParqueadero = 'Si'";
					$result = $conn->query($sql);
					echo '<select id="sitio" name="sitio">';
					$arraySit = array();
					$vtemp = 0;
					if($result->num_rows > 0){				
						while($row = $result->fetch_assoc()){
							echo '<option value="'.$row['ubicacion_SitioParqueadero'].
							"-".$row['nombre_SedeParqueadero'].'">'.
							$row['ubicacion_SitioParqueadero'].'-'.
							$row['nombre_SedeParqueadero'].'</option>';
							$arraySit[$vtemp][0]=$row['ubicacion_SitioParqueadero'];
							$arraySit[$vtemp][1]=$row['nombre_SedeParqueadero'];
							//$arraySit[$vtemp]=$vtemp;
							$vtemp=$vtemp+1;
						}
						
					}
					else{
						echo '<option value="ningunaS">Ninguna</option>';
					}
					echo '</select>';
					echo '<br>';
					//while($vtemp > -1){
					//	$vtemp = $vtemp-1;
					//	echo $array
					//}
					//foreach($arraySit as $val){
					//	echo $val[0].'<br>';
					//	echo $val[1].'<br>';
					//}
				?>
				
				<div id="mydate" name="mydate">
					<label for="fInicio" hidden>Fecha de inicio</label>
					<input type="date" id="fInicio" name="fInicio" hidden>
					<label for="fInicio" hidden>Usuario</label>
					<input type="date" id="fFin" name="fFin" hidden><br>
				</div>
				<input type="submit" value="Solicitar">
			</form>
		</div>
	</div>
</div>

</body>
</html>