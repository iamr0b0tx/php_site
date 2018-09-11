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
		    if (isset($_REQUEST['reset_password'])){
				$email = sanitizeString($_REQUEST['email']);

				$match_email = $db->selectBy(USERS_TABLE, "id", '"'.$email.'"', "email");

				if(count($match_email) == 0){
					$info = "<div class='form'><h3>Password reset fail, email does not exist.</h3><br/>Click here to <a href='login.php'>Login</a></div>";

				}else{
					$new_password = generatePassword(16);

			    	$email_subject = "Password Reset";
			    	$msg = "Your new password is '$new_password'";
			    	// echo $msg;

			        $reset = mail($email, $email_subject, $msg);
			        if($reset){
			            $info = "<div class='form'><h3>Your password has been reset, check your mail.</h3><br/>Click here to <a href='login.php'>Login</a></div>";

			        }else{
			            $info = "<div class='form'><h3>Password reset fail.</h3><br/>Click here to <a href='login.php'>Login</a></div>";
			        }
						
				}
		    }
		?>

		<div class="form">
			<h1>Registration</h1>
			
			<?php echo $info; ?>
			<form name="registration" action="" method="post">
				<input type="email" name="email" placeholder="Email" required />
				<input type="submit" name="reset_password" value="Rset password" />
			</form>

			<br /><br />
			<a href="http://www.allphptricks.com/simple-user-registration-login-script-in-php-and-mysqli/">Tutorial Link</a> <br /><br />
			For More Web Development Tutorials Visit: <a href="http://www.allphptricks.com/">AllPHPTricks.com</a>
		</div>

	</body>
</html>
