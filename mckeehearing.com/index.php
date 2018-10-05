<?php
	include '../header.php';
	// header will go here
	
	$pageToLoad = $_GET['page'];
	
	switch($pageToLoad) {
		case '../about_us':
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
?>