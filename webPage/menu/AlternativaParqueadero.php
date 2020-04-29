<?php
	@ include('../php/session.php');
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
	<a href="../php/logout.php">Cerrar sesion</a>
	<a href="SolicitarCupo.php">Solicitar cupo</a>
	<a href="PagarFactura.php">Pagar factura</a>
	<a href="FacturaPagada.php">Facturas pagadas</a>
	<a href="AlternativaParqueadero.php">Alternativas parqueadero</a>
	<a href="ModificarDatos.php">Modificar datos personales</a>
	<a href="AgregarVehiculo.php">Agregar vehiculo</a>
	</div>
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

</body>
</html>