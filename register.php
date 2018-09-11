<?php
	if($loggedin){
		header("Location: index.php");
	} 
?>

<form action="controller/customer_register.php" method="post">
	<input type="email" placeholder="Email Address" required=" " >
	<input type="password" placeholder="Password" required=" " >
	<div class="register-check-box">
		<div class="check">
			<label class="checkbox">
				<input type="checkbox" name="checkbox"><i> </i>I accept the terms and conditions
			</label>
		</div>
	</div>
	<input type="submit" value="Register">
</form>