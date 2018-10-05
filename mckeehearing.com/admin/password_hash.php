<?php
	$options = array(
		'salt' => mcrypt_create_iv(23, MCRYPT_DEV_URANDOM),
		'cost' => 10,
		
	);
	$password_string = "summerweb2018";
	$password_hash = password_hash($password_string, PASSWORD_BCRYPT, $options);
	echo $password_hash;
?>