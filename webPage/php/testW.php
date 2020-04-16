<?php
	include('session.php');
?>
<html">
	<head>
		<tittle>Welcome</tittle>
	</head>
	<body>
		<h1>Welcome <?php echo $login_session; ?></h1>
		<h2><a href = "logout.php">Sign out</a></h2>
	</body>
</html>