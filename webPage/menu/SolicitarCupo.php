<?php
	include('../php/session.php');
?>
<!DOCTYPE html>
<html>
<head>
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
	<a href="SolicitarCupo.html">Solicitar cupo</a>
	<a href="pagarFactura.html">Pagar factura</a>
	<a href="#3">Facturas pagadas</a>
	<a href="#4">Alternativas parqueadero</a>
	<a href="#5">Modificar datos personales</a>
	<a href="#6">Agregar vehiculo</a>
	</div>
	<div id="solicitarCupoTexto" name="solicitarCupoTexto">
		<form action="../php/updateSitiosDisponibles.php" method="post">
			<label for="sede">Sede</label>
			<select id="sede" name="sede">
			<option value="Ninguna">Ninguna</option>
			</select> 
			<input type="submit" value="Actualizar">
			<br> <br>
			<label for="sitio">Sitios disponibles</label>
			<select id="sitio" name="sitio">
			<option value="Ninguno">Ninguno</option>
			</select> <br> <br>
		</form>
		<label for="vehiculo">Vehiculo</label>
		<select id="vehiculo" name="vehiculo">
		<option value="Ninguno">Ninguno</option>
		</select> <br><br>
		<div id="mydate" name="mydate">
			<label for="fInicio" hidden>Fecha de inicio</label>
			<input type="date" id="fInicio" name="fInicio" hidden>
			<label for="fInicio" hidden>Usuario</label>
			<input type="date" id="fFin" name="fFin" hidden><br>
		</div>
		<input type="submit" value="Solicitar">
	</div>
</div>

</body>
</html>