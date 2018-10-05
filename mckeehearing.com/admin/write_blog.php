<div class="write_blog_block">
	<script>
		function resetBlog() 
		{
			document.getElementById("contact_us").reset();
		}
	</script>

<?php
	if (!isset($_SESSION['admin_rights'])) 
	{
		echo "Sorry, this page is locked";
	}
	else
	{
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
			function checkTitle($title)
			{
				$title = trim($title);
				$title = stripslashes($title);
				$title = htmlspecialchars($title);
				
				if (empty($title)) 
				{
					return false;
				}
				else
				{
					return true;
				}
			}
			function checkContent()
			{
				if (empty($_POST['content']))
				{
					return false;
				}
				else
				{
					return true;
				}
			}
			
			$validName = $validContent = $validInput = $validTitle = false;
			
			$name = '';
			$title = '';
			$comment = '';
			
			if ($_SERVER['REQUEST_METHOD'] === "POST")
			{
				$name = $_POST['name'];
				$content = $_POST['content'];
				$title = $_POST['title'];
				
				$validTitle = checkTitle($title);
				$validName = checkName($name);
				$validContent = checkContent();
				
				$validInput = $validName && $validContent && $validTitle;
			}
			
		if($validInput)
		{
			$servername = "localhost";
			$username = "root";
			$password = "summerweb115";
			$databaseName = "myDatabase";
			
			$date = date("Y/m/d");
			
			$connection = new mysqli($servername, $username, $password, $databaseName);
			if($connection->connect_error)
			{
				die("Connection failed: " . $connection->connect_error);
			}
			
			$insertSQL = "INSERT INTO blog (title, author, publication_date, content) VALUES('$title', '$name', '$date', '$content')";
		
			if ($connection->query($insertSQL) === TRUE)
			{
				echo "Success: we will submit the follwing information: " . "<br>";
				echo "Title of blog post: " . $title . "<br>";
				echo "Author name: " . $name . "<br>";
				echo "Date: " . $date . "<br>";
				echo "Content of blog: " . $content . "<br>";
				echo "This is post number: " . $id . "<br>";
			}
			else
			{
				echo "Error: " . $insertSQL . "<br>" . $connection->error;
			}
			
			$connection->close();
		}
		else
		{
		?>
		
		<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])."?page=write_blog"; ?>" name="blog" id="blog">
			Title: <input type="text" name="title" required><br><br>
			Name: <input type="text" name="name" required><br><br>
			Content: <textarea form="blog" name="content" required>Content of post goes here</textarea><br><br>
			<input type="submit" name="submit" value="Submit"/>
			<input type="reset" name="reset" value="Reset" onclick="resetBlog()"/>
		</form>
		<?php
		}
		
	}
	?>
</div>