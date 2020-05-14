<?php
	@ include('../../php/session.php');
?>
<!DOCTYPE html>
<html>
<head>
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

h1 {
	text-align: center;
}

.mydate {
	visibility: hidden;
	hidden;
}

.row:after {
	content: "";
	display: table;
	clear: both;
}
</style>
</head>
<body>
<img src="../../img/logoF.png" alt="logo" width="140" height="45" style="float:left;">
<h1> Bienvenido <?php echo '<i>'.$login_session.'</i>'; ?></h1>
<div class="row">
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
			<label>Escoja la opcion que desea</label>
		</div>
	</div>
</div>
</body>
</html>