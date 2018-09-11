<?php
	session_start();
	require_once("php/database.php");
	require_once("php/functions.php");
	
	//the data base object to perfrom database operations
	$database = new Database;

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Registration</title>
		<link rel="stylesheet" href="css/style.css" />
	</head>
	<body>
		<?php
			//initialize alert
			$info = '';

		    // If form submitted, insert values into the database.
		    if (isset($_REQUEST['username'])){
				$username = sanitizeString($_REQUEST['username']); // removes backslashes
				$email = sanitizeString($_REQUEST['email']);
				$password = sanitizeString($_REQUEST['password']);

				$trn_date = date("Y-m-d H:i:s");
		        $registration = register($database, $username, $password, $email, $trn_date);
		        if($registration){
		            $info = "<div class='form'><h3>You are registered successfully.</h3><br/>Click here to <a href='login.php'>Login</a></div>";
		        }else{
		            $info = "<div class='form'><h3>Your registration failed, username already exist.</h3><br/>Click here to <a href='login.php'>Login</a></div>";
		        }
		    }
		?>

		<div class="form">
			<h1>Registration</h1>
			
			<?php echo $info; ?>
			<form name="registration" action="" method="post">
				<input type="text" name="username" placeholder="Username" required />
				<input type="email" name="email" placeholder="Email" required />
				<input type="password" name="password" placeholder="Password" required />
				<input type="submit" name="submit" value="Register" />
			</form>

			<br /><br />
			<a href="http://www.allphptricks.com/simple-user-registration-login-script-in-php-and-mysqli/">Tutorial Link</a> <br /><br />
			For More Web Development Tutorials Visit: <a href="http://www.allphptricks.com/">AllPHPTricks.com</a>
		</div>

	</body>
</html>
