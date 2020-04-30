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
	<div class="vertical-menu">
	<a href="../../php/logout.php">Cerrar sesion</a>
	<a href="HistoricBill.php">Historico de ventas</a>
	<a href="HistoricUser.php">Historico de usuario</a>
	<a href="Dev.php">Dev</a>
	</div>
	<label>No se ha podido realizar ningun cambio</label>
</div>

</body>
</html>