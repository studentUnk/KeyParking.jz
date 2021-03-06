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
			<form action="../../php/payBill.php" method="post">
				<label for="facturasL">Facturas por pagar (codigo)</label>
				<?php
					//query to fill the list of bills
					$sql = "SELECT codigo_UsoParqueadero ".
					"FROM UsoParqueadero,Vehiculo ".
					"WHERE Vehiculo.codigo_Usuario = ".$user_check." ".
					"AND Vehiculo.codigo_Vehiculo = UsoParqueadero.codigo_Vehiculo ".
					"AND UsoParqueadero.fin_UsoParqueadero IS NULL";
					$result = $conn->query($sql);
					echo '<select id="facturasL" name="facturasL">';
					if($result->num_rows > 0){
						// ouptut data of each row
						while($row = $result->fetch_assoc()){
							echo '<option value='.$row['codigo_UsoParqueadero'].'>'.
							$row['codigo_UsoParqueadero'].'</option>';
						}
					}
					else{
						echo '<option value="Ninguna">Ninguna</option>';
						// There is no bill
					}
					//include ("../php/connectDB.php");
					echo '</select>';
				?>
				<br><br>
				<input type="submit" value="Pagar">
			</form>
		</div>
	</div>
</div>

</body>
</html>