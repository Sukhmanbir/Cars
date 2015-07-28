<?php ob_start();

//set the title and link to header
$title = 'Register';
require_once ('header.php');
?>

<div class="container">
	<h1>Admin Registration</h1>
	<!--Form-->
	<form method="post" action="save-register.php" class="form-horizontal">
		<div class="form-group">
			<!--Username-->
			<label for="username" class="col-sm-2">Username:</label>
			<input name="username" title="Username" placeholder="Username" />
		</div>
		<!--Password-->
		<div class="form-group">
			<label for="password" class="col-sm-2">Password:</label>
			<input type="password" name="password" title="Password" placeholder="Password" />
		</div>
		<!--Confirm Password-->
		<div class="form-group">
			<label for="confirm" class="col-sm-2">Confirm Password:</label>
			<input type="password" name="confirm"  title="Confirm Password" placeholder="Confirm Password" />
		</div>
		<!--button-->
		<div class="col-sm-offset-2">
			<input type="submit" value="Register" class="btn btn-primary" />
		</div>
	</form>
</div>

<?php
//link to footer
require_once ('footer.php');
ob_flush();
?>
