<?php ob_start();

//set title and link to header
$title = 'Log In';
require_once ('header.php');
?>

<div class="container">
	<h1>Log In</h1>
	<!--Form-->
	<form method="post" action="validate.php" class="form-horizontal">
		<!--Username-->
		<div class="form-group">
			<label for="username" class="col-sm-2">Username:</label>
			<input name="username" title="Username" placeholder="Username"/>
		</div>
		<!--Password-->
		<div class="form-group">
			<label for="password" class="col-sm-2">Password:</label>
			<input type="password" name="password" title="Password" placeholder="Password"/>
		</div>
		<!--Button-->
		<div class="col-sm-offset-2">
			<input type="submit" value="Login" class="btn btn-primary" />
		</div>
	</form>
</div>
<?php
//link to footer
require_once ('footer.php');
ob_flush();
?>