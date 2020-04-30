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

table {
	font-family: arial, sans-serif;
	border-collapse: collapse;
	width:75%;
}

td, th {
	border: 1px solid #dddddd;
	text-align: left;
	padding: 8px;
}

tr:nth-child(even){
	background-color: #dddddd;
}

</style>
</head>
<body>

<h1> Bienvenido <?php echo $login_session; ?></h1>
<div id="menuCompleto" name="menuCompleto">
	<div class="vertical-menu">
	<a href="../../php/logout.php">Cerrar sesion</a>
	<a href="HistoricBill.php">Historico de ventas</a>
	<a href="HistoricUser.php">Historico de usuario</a>
	<a href="Dev.php">Dev</a>
	</div>
	<div id="solicitarCupoTexto" name="solicitarCupoTexto">
		<table>
			<tr>
				<th>Codigo usuario</th>
				<th>Documento</th>
				<th>Codigo</th>
				<th>Hora inicio</th>
				<th>Hora Fin</th>
				<th>Tipo vehiculo</th>
				<th>Placa vehiculo</th>
				<th>Precio</th>
			</tr>
			<?php
				$sql="SELECT Factura.codigo_Usuario, Factura.codigo_Factura, ".
				"Factura.precio_Factura, UsoParqueadero.inicio_UsoParqueadero, ".
				"UsoParqueadero.fin_UsoParqueadero, Vehiculo.placa_Vehiculo, ".
				"TipoVehiculo.nombre_TipoVehiculo, Usuario.documento_Usuario ".
				"FROM Factura, UsoParqueadero, Vehiculo, TipoVehiculo, Usuario ".
				"WHERE Factura.codigo_Factura = UsoParqueadero.codigo_Factura ".
				"AND UsoParqueadero.codigo_Vehiculo = Vehiculo.codigo_Vehiculo ".
				"AND Vehiculo.codigo_TipoVehiculo = TipoVehiculo.codigo_TipoVehiculo ".
				"AND Usuario.codigo_Usuario = Factura.codigo_Usuario ".
				"ORDER BY Factura.codigo_Factura";
				$result = $conn->query($sql);
				$totalS = 0;
				if($result->num_rows > 0){				
					while($row = $result->fetch_assoc()){
						echo '<tr>';
						echo '<td>'.$row['codigo_Usuario'].'</td>';
						echo '<td>'.$row['documento_Usuario'].'</td>';
						echo '<td>'.$row['codigo_Factura'].'</td>';
						echo '<td>'.$row['inicio_UsoParqueadero'].'</td>';
						echo '<td>'.$row['fin_UsoParqueadero'].'</td>';
						echo '<td>'.$row['nombre_TipoVehiculo'].'</td>';
						echo '<td>'.$row['placa_Vehiculo'].'</td>';
						echo '<td>'.$row['precio_Factura'].'</td>';
						echo '</tr>';
						$totalS += $row['precio_Factura'];
					}					
				}
				echo '<tr>';
				echo '<td></td>';
				echo '<td></td>';
				echo '<td></td>';
				echo '<td></td>';
				echo '<td></td>';
				echo '<td></td>';
				echo '<td><b>Total</b></td>';
				echo '<td>'.$totalS.'</td>';
				echo '</tr>';
			?>
		</table>
	</div>
</div>

</body>
</html>