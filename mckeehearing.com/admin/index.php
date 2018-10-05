<?php
	session_start();
	
	if (!isset($_SESSION['admin_rights'])) 
	{
		echo "Please log in now";
		?>
			<form method = "POST">
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
					echo "This page is unlocked" . "<br>" . "<br>";
					?>
					<a href="index.php?page=index">
						<img src="./images/home_button.png"><br><br>
					</a>
					<?php
				}
				else
				{
					echo "FAILED";
				}
			}
	}
	else
	{
		include '../header.php';
		// header will go here
		
		$pageToLoad = $_GET['page'];
		
		switch($pageToLoad) {
			case 'about_us':
				include '../about_us.php';
				break;
			case 'contact_us':
				include '../contact_us.php';
				break;
			case 'why_choose_us':
				include '../why_choose_us.php';
				break;
			case 'write_blog':
				include 'write_blog.php';
			case 'blog':
				include '../blog.php';
				break;
			default: 
				include '../home_page.php';
		}
		
		include '../footer.php';
		// footer will go here
	}
?>