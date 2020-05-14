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
			<?php
				$sql="SELECT nombre_ParqueaderosAlternos,".
				"direccion_ParqueaderosAlternos, nombre_SedeParqueadero ".
				"FROM SedeParqueadero, ParqueaderosAlternos ".
				"WHERE SedeParqueadero.codigo_SedeParqueadero = ParqueaderosAlternos.codigo_SedeParqueadero ".
				"ORDER BY nombre_SedeParqueadero";
				$result = $conn->query($sql);
				if($result->num_rows > 0){	
					$prevS="_";			
					while($row = $result->fetch_assoc()){
						if(strcmp($prevS, $row['nombre_SedeParqueadero']) != 0){
							echo '<b>'.$row['nombre_SedeParqueadero'].'</b>';
							echo '<br><br>';
							$prevS = $row['nombre_SedeParqueadero'];
						}
						echo '<i>Nombre: </i>';
						echo $row['nombre_ParqueaderosAlternos'];
						echo '<br>';
						echo '<i>Direccion: </i>';
						echo $row['direccion_ParqueaderosAlternos'];
						echo '<br><br>';
					}				
				}
				else{
					echo 'No se cargo ningun parqueadero alterno';
				}
			?>
		</div>
	</div>
</div>

</body>
</html>