<?php
	session_start();
	require_once("constants.php");
	
	if(!isset($_SESSION[USER_TOKEN])){
		header("Location: login.php");
		exit();
	}

	$user_token = $_SESSION[USER_TOKEN];
?>
