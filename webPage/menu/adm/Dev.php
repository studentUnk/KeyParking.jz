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
	height: 100vh;
}

.left {
	width: 20%;
	height: 100vh;
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
		<a href="HistoricBill.php">Historico de ventas</a>
		<a href="HistoricUser.php">Historico de usuario</a>
		<a href="Dev.php">Dev</a>
		</div>
	</div>
	<div class="column right">
		<label>Ten cuidado de que insertas (util para insertar o actualizar cuarlquier tabla)</label><br>
		<form action="../../php/adminQ.php" method="post">
			<input type="text" id="myq" name="myq">
			<br><br>
			<input type="submit" value="Enviar">
		</form>
	</div>
</div>

</body>
</html>