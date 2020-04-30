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
	<a href="SolicitarCupo.php">Solicitar cupo</a>
	<a href="PagarFactura.php">Pagar factura</a>
	<a href="FacturaPagada.php">Facturas pagadas</a>
	<a href="AlternativaParqueadero.php">Alternativas parqueadero</a>
	<a href="ModificarDatos.php">Modificar datos personales</a>
	<a href="AgregarVehiculo.php">Agregar vehiculo</a>
	</div>
	<div id="solicitarCupoTexto" name="solicitarCupoTexto">
		<table>
			<tr>
				<th>Codigo</th>
				<th>Hora inicio</th>
				<th>Hora Fin</th>
				<th>Tipo vehiculo</th>
				<th>Placa vehiculo</th>
				<th>Precio</th>
			</tr>
			<?php
				$sql="SELECT Factura.codigo_Factura, ".
				"Factura.precio_Factura, UsoParqueadero.inicio_UsoParqueadero, ".
				"UsoParqueadero.fin_UsoParqueadero, Vehiculo.placa_Vehiculo, ".
				"TipoVehiculo.nombre_TipoVehiculo ".
				"FROM Factura, UsoParqueadero, Vehiculo, TipoVehiculo ".
				"WHERE Factura.codigo_Usuario = ".$user_check." ".
				"AND Factura.codigo_Factura = UsoParqueadero.codigo_Factura ".
				"AND UsoParqueadero.codigo_Vehiculo = Vehiculo.codigo_Vehiculo ".
				"AND Vehiculo.codigo_TipoVehiculo = TipoVehiculo.codigo_TipoVehiculo ".
				"ORDER BY Factura.codigo_Factura";
				$result = $conn->query($sql);
				if($result->num_rows > 0){				
					while($row = $result->fetch_assoc()){
						echo '<tr>';
						echo '<td>'.$row['codigo_Factura'].'</td>';
						echo '<td>'.$row['inicio_UsoParqueadero'].'</td>';
						echo '<td>'.$row['fin_UsoParqueadero'].'</td>';
						echo '<td>'.$row['nombre_TipoVehiculo'].'</td>';
						echo '<td>'.$row['placa_Vehiculo'].'</td>';
						echo '<td>'.$row['precio_Factura'].'</td>';
						echo '</tr>';
					}					
				}
			?>
		</table>
	</div>
</div>

</body>
</html>