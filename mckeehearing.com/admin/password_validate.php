<form method = "POST" action="password_validate.php">
	Username: <input type="text" name = "username"><br><br>
	Password: <input type="password" name = "pwd"><br><br>
	<input type="submit" name = "submit" value = "Submit">
</form>


<?php
if ($_SERVER['REQUEST_METHOD'] === "POST")
{
	$servername = "localhost";
	$username = "root";
	$password = "summerweb115";
	$databaseName = "myDatabase";
	
	$connection = new mysqli($severname, $username, $password, $databaseName);
	
	if ($connection->connect_error)
	{
		die("Connection Failed: " . $connection->connect_error);
	}
	
	$username = $_POST['username'];
	$pwd = mysqli_real_escape_string($connection, $_POST['pwd']);
	$sql = "SELECT password FROM `admin` WHERE username = '$username'";
	$result = mysqli_query($connection, $sql);
	$result = mysqli_fetch_assoc($result);
	$password_hash = $result['password'];
	
	if (password_verify($pwd, $password_hash))
	{
		session_start();
		$_SESSION['admin_rights'] = True;
		echo "Session set to " . $_SESSION['admin_rights'];
	}
	else
	{
		echo "FAILED";
	}
}
?>