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
	Facilita la solicitud de parqueadero al usuario.
	<br><br>
	
	<div id="insertUser" name="insertUser">
	<form action="../../php/auxSol.php" method="post">
		<label for="nameU">Codigo del usuario</label>
		<br>
		<input type="text" id="nameU" name="nameU">
		<br><br>
		<label for="placaV">Placa del vehiculo</label>
		<br>
		<input type="text" id="placaV" name="placaV">
		<br><br>
		<label for="sitio">Sitios disponibles</label>
		<br>
		<?php
			$sql="SELECT ubicacion_SitioParqueadero, nombre_SedeParqueadero ".
			"FROM SitioParqueadero, SedeParqueadero ".
			"WHERE SitioParqueadero.codigo_SedeParqueadero = SedeParqueadero.codigo_SedeParqueadero ".
			"AND SitioParqueadero.disponibilidad_SitioParqueadero = 'Si'";
			$result = $conn->query($sql);
			echo '<select id="sitio" name="sitio">';
			$vtemp = 0;
			if($result->num_rows > 0){				
				while($row = $result->fetch_assoc()){
					echo '<option value="'.$row['ubicacion_SitioParqueadero'].
					"-".$row['nombre_SedeParqueadero'].'">'.
					$row['ubicacion_SitioParqueadero'].'-'.
					$row['nombre_SedeParqueadero'].'</option>';
				}
			}
			else{
				echo '<option value="ningunaS">No hay disponibles</option>';
			}
			echo '</select>';
			echo '<br>';
		?>
		<br><br>
		<input type="submit" value="Asignar">
	</form>
	</div>
</div>

</body>
</html>