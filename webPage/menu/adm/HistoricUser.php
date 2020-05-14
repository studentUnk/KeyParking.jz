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

table {
	font-family: arial, sans-serif;
	border-collapse: collapse;
	width:50%;
	margin-left: auto;
	margin-right: auto;
}

td, th {
	border: 1px solid #dddddd;
	text-align: left;
	padding: 8px;
}

tr:nth-child(even){
	background-color: #dddddd;
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
		<div id="solicitarCupoTexto" name="solicitarCupoTexto">
			<table>
				<tr>
					<th>Codigo usuario</th>
					<th>Password</th>
					<th>Documento</th>
					<th>Nombre</th>
					<th>Apellido</th>
					<th>Direccion</th>
					<th>Telefono</th>
					<th>Celular</th>
					<th>Correo</th>
				</tr>
				<?php
					include('../../php/encAES.php');
					$sql="SELECT codigo_Usuario, documento_Usuario, nombre_Usuario, ".
					"apellido_Usuario, direccion_Usuario, telefono_Usuario, celular_Usuario, ".
					"email_Usuario, password_Usuario ".
					"FROM Usuario ".
					"WHERE Usuario.nombre_Rol = 'Cliente'".
					"ORDER BY codigo_Usuario";
					$result = $conn->query($sql);
					$totalS = 0;
					if($result->num_rows > 0){				
						while($row = $result->fetch_assoc()){
							echo '<tr>';
							echo '<td>'.$row['codigo_Usuario'].'</td>';
							echo '<td>'.decrypt_Openssl($row['password_Usuario']).'</td>';
							echo '<td>'.$row['documento_Usuario'].'</td>';
							echo '<td>'.$row['nombre_Usuario'].'</td>';
							echo '<td>'.$row['apellido_Usuario'].'</td>';
							echo '<td>'.$row['direccion_Usuario'].'</td>';
							echo '<td>'.$row['telefono_Usuario'].'</td>';
							echo '<td>'.$row['celular_Usuario'].'</td>';
							echo '<td>'.$row['email_Usuario'].'</td>';
							echo '</tr>';
							$totalS += 1;
						}					
					}
					echo '<i>Cantidad total de usuarios: </i>'.$totalS;
				?>
			</table>
		</div>
	</div>
</div>

</body>
</html>