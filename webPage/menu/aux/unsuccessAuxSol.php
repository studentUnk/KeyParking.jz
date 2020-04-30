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
	<form action="../../php/logout.php" method="post">
		<input type="submit" value="Cerrar sesion">
		<br><br>
	</form>
	La solicitud no se registro. Revisa usuario, placa o la disponibilidad pudo haber cambiado.
	<br><br>
	<form action="Administrame.php" method="post">
		<input type="submit" value="Regresar">
	</form>
</div>

</body>
</html>