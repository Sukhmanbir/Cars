<?php ob_start();

//check if the admin is authenticated
require_once ('auth.php');

//set title and link to header
$title = 'Admin Details';
require_once ('header.php');

//check if we have a admin id in the querystring
if (!empty($_GET['admin_id'])) {

	//if there is admin id, store in a variable
	$admin_id = $_GET['admin_id'];

	//connect
	require_once ('db.php');

	//select all data for the selected admin
	$sql = "SELECT * FROM admin_list WHERE admin_id = :admin_id";
	$cmd = $conn -> prepare($sql);
	$cmd -> bindParam(':admin_id', $admin_id, PDO::PARAM_INT);
	$cmd -> execute();
	//fetch data
	$result = $cmd -> fetchAll();

	//store each value from the database into a variable
	foreach ($result as $row) {
		$first_name = $row['first_name'];
		$last_name = $row['last_name'];
		$email = $row['email'];
	}

	//disconnect
	$conn = null;
}
?>

<div class="container">
	<h1>Admin Details</h1>
	<!--Form-->
	<form method="post" action="save-admin.php" class="form-horizontal">
		<!--First Name-->
		<div class="form-group">
			<label for="first_name" class="col-sm-3">First Name:</label>
			<input name="first_name" title="First Name" placeholder="First Name" required value="<?php echo $first_name; ?>" />
		</div>
		<!--Last Name-->
		<div class="form-group">
			<label for="last_name" class="col-sm-3">Last Name:</label>
			<input name="last_name" title="Last Name" placeholder="Last Name" required value="<?php echo $last_name; ?>" />
		</div>
		<!--Email-->
		<div class="form-group">
			<label for="email" class="col-sm-3">Email:</label>
			<input name="email" title="Email" placeholder="Email" required type="email" value="<?php echo $email; ?>" />
		</div>
		<input type="hidden" name="admin_id" value="<?php echo $admin_id; ?>" />
		<!--Button-->
		<div class="col-sm-offset-3">
			<input type="submit" value="Save" class="btn btn-primary" />
		</div>
	</form>
</div>
<?php
//link to footer
require_once ('footer.php');
ob_flush();
?>