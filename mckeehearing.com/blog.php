<div class="blog_block">
	<?php
		$blog_number = 1;
			$servername = "localhost";
			$username = "root";
			$password = "summerweb115";
			$databaseName = "myDatabase";
				
			$connection = new mysqli($severname, $username, $password, $databaseName);
				
			if ($connection->connect_error)
			{
				die("Connection Failed: " . $connection->connect_error);
			}
			
			$sql = "SELECT * FROM `blog` WHERE counter = '$blog_number'";
			$blog = mysqli_query($connection, $sql);
			$blog = mysqli_fetch_assoc($blog);
			
			echo "Title:" . $blog["title"] . "<br><br>";
			echo "Author:" . $blog["author"] . "<br><br>";
			echo "Date of Publication: " . $blog["publication_date"] . "<br><br>";
			echo "Content: " . $blog["content"] . "<br><br>";
	?>
	<a href="index.php?page=blog">
		<img src="./images/previous.png" alt="Previous"><br><br>
		<?php $blog_number -1; ?>
	</a>
	<a href="index.php?page=blog">
		<img src="./images/next.png" alt="Next"><br><br>
		<?php $blog_number -1; ?>
	</a>
	<a href="index.php?page=write_blog">
		<img src="./images/Write_a_blog_button.png" alt="Write a blog post"><br><br>
	</a>
	<a href="index.php?page=blog">
		<img src="./images/back_to_blogs.png" alt="Back to blogs"><br><br>
	</a>
</div>