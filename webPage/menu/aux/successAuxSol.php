<?php
	@ include('../../php/session.php');
?>
<!DOCTYPE html>
<html>
<head>
<style>

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

<img src="../../img/logoF.png" alt="logo" width="140" height="45" style="float:left;">
<h1> Bienvenido <?php echo '<i>'.$login_session.'</i>'; ?></h1>

<div id="menuCompleto" name="menuCompleto">
	<form action="../../php/logout.php" method="post">
		<br>
		<input type="submit" value="Cerrar sesion">
		<br><br>
	</form>
	La solicitud ha sido registrada exitosamente.
	<br><br>
	<form action="Administrame.php" method="post">
		<input type="submit" value="Regresar">
	</form>
</div>

</body>
</html>