<?
	session_start();
	
	if (!isset($_SESSION['admin_rigths'])) 
	{
		echo "Sorry, this page is locked";
	}
	else
	{
		echo "This page is unlocked";
	}
?>