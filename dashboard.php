<?php
	require_once('php/auth.php');
	require_once('php/database.php');

	//the data base object to perfrom database operations
	$database = new Database;

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Dashboard - Secured Page</title>
		<link rel="stylesheet" href="css/style.css" />
	</head>

	<body>
		<div class="form">
			<p>Dashboard</p>
			<p>This is another secured page.</p>
			<p><a href="index.php">Home</a></p>
			<a href="logout.php">Logout</a>


			<br /><br /><br /><br />
			<a href="http://www.allphptricks.com/simple-user-registration-login-script-in-php-and-mysqli/">Tutorial Link</a> <br /><br />
			For More Web Development Tutorials Visit: <a href="http://www.allphptricks.com/">AllPHPTricks.com</a>
		</div>
	</body>
</html>
