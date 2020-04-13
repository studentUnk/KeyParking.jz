<?php
	define('DB_SERVER', 'localhost');
	define('DB_USERNAME','root');
	define('DB_PASSWORD','');
	define('DB_DATABASE','keyparking');

	//$userDB='root';
	//$passDB='';
	//$db = 'keyparking';
	
	//$conn = new mysqli ("localhost",$userDB,$passDB,$db);
	$conn=mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
	
	if ($conn->connect_error){
		die("Connection failed: " . $conn->connect_error);
	}else{
		/*echo "Connection succeed";*/
	}
?>