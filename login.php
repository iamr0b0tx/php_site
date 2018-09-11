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
		<title>Login</title>
		<link rel="stylesheet" href="css/style.css" />
	</head>
	<body>
	<?php
		//initialize alert
		$info = '';

	    // If form submitted, insert values into the database.
	    if (isset($_POST['username'])){
			$username = sanitizeString($_POST['username']); // removes backslashes
			$password = sanitizeString($_POST['password']);
			
		//Checking is user existing in the database or not
	        $authenticate = login($database, $username, $password, "username");
	        if($authenticate != False){
				$_SESSION[USER_TOKEN] = $authenticate[1];
				header("Location: index.php"); // Redirect user to index.php
	            
	            }else{
					$info = "<div class='form'><h3>Username/password is incorrect.</h3><br/>Click here to <a href='login.php'>Login</a></div>";
				}
	    }
	?>

		<div class="form">
			<h1>Log In</h1>

			<?php echo $info; ?>
			<form action="" method="post" name="login">
				<input type="text" name="username" placeholder="Username" required />
				<input type="password" name="password" placeholder="Password" required />
				<input name="submit" type="submit" value="Login" />
			</form>
			<p>Not registered yet? <a href='registration.php'>Register Here</a></p>

			<br />
			<a href="reset.php">Forgot password</a> <br /><br />

			<br />
			<a href="http://www.allphptricks.com/simple-user-registration-login-script-in-php-and-mysqli/">Tutorial Link</a> <br /><br />
			For More Web Development Tutorials Visit: <a href="http://www.allphptricks.com/">AllPHPTricks.com</a>
		</div>


	</body>
</html>
