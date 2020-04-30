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
		<form action='../../php/successSol.php' method='post'> 
										
			<label for="vehiculo">Vehiculo</label>
			<?php
				$sql = "SELECT placa_Vehiculo ".
				"FROM Vehiculo ".
				"WHERE codigo_Usuario = ".$user_check;
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

</body>
</html>