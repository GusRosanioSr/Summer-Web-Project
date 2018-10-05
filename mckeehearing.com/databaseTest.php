<?php
	$server = "localhost";
	$username = "root";
	$password = "summerweb115";
	
	$connection = new mysqli($server, $username, $password);
	
	if ($connection->connect_error) {
		die("Connection Failed: " . $connection->connect_error);
	}
	echo "We are connected";
?>