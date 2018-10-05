<div class="contact_us_block">
	<script>
		function resetForm() 
		{
			document.getElementById("contact_us").reset();
		}
	</script>
	
	<?php
		function checkName($name)
		{
			$name = trim($name);
			$name = stripslashes($name);
			$name = htmlspecialchars($name);
			
			if (empty($name)) 
			{
				return false;
			}
			else
			{
				return true;
			}
		}
		function checkEmail($email)
		{
			$email = filter_var($email, FILTER_VALIDATE_EMAIL);
			if (!$email) 
			{
				$GLOBALS['emailError'] = "Please input a valid E-mail";
				return false;
			}
			else
			{
				return true;
			}
		}
		function checkComment()
		{
			if (empty($_POST['comment']))
			{
				return false;
			}
			else
			{
				return true;
			}
		}
		
		$validName = $validEmail = $validComment = $validInput = false;
		
		$name = '';
		$email = '';
		$comment = '';
		
		if ($_SERVER['REQUEST_METHOD'] === "POST")
		{
			$name = $_POST['name'];
			$email = $_POST['email'];
			$comment = $_POST['comment'];
			
			$validName = checkName($name);
			$validEmail = checkEmail($email);
			$validComment = checkComment();
			
			$validInput = $validName && $validEmail && $validComment;
		}
	?>
	
	<?php
	if($validInput)
	{
		$servername = "localhost";
		$username = "root";
		$password = "summerweb115";
		$databaseName = "myDatabase";
		$ipaddress = $_SERVER['REMOTE_ADDR'];
		
		$connection = new mysqli($servername, $username, $password, $databaseName);
		if($connection->connect_error)
		{
			die("Connection failed: " . $connection->connect_error);
		}
		
		$insertSQL = "INSERT INTO contactUs (name, email, comment, ipaddress) VALUES('$name', '$email', '$comment', '$ipaddress')";
		
		if ($connection->query($insertSQL) === TRUE)
		{
			echo "Success: we will submit the follwing information: " . "<br>";
			echo $name . "<br>";
			echo $email . "<br>";
			echo $comment . "<br>";
			echo $ipaddress . "<br>";
		}
		else{
			echo "Error: " . $insertSQL . "<br>" . $connection->error;
		}
		
		$connection->close();
	}
	else
	{
		?>
		<h2>
		Please fill out the form below with and let us know whats on your mind!<br>
		</h2>
		<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])."?page=contact_us"; ?>" name="contact_us" id="contact_us">
			Name: <input type="text" name="name" required><br><br>
			E-mail: <input type="text" name="email" required><?php echo $emailError; ?> <br><br>
			Comment: <textarea form="contact_us" name="comment" required>Comment Goes Here</textarea><br><br>
			<input type="submit" name="submit" value="Submit"/>
			<input type="reset" name="reset" value="Reset" onclick="resetForm()"/>
		</form>
		<?php
	} ?>
</div>