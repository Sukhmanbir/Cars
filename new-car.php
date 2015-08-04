<?php ob_start();

//check if the admin is authenticated
require_once ('auth.php');

//set title and link to header
$title = 'Car Details';
require_once ('header.php');

try{
//check if we have a id in the querystring
if (!empty($_GET['id'])) 
	{

	//if there is id, store in a variable
	$id = $_GET['id'];

	//connect
	require_once ('db.php');

	//select all data for the selected car
	$sql = "SELECT * FROM cars WHERE id = :id";
	$cmd = $conn -> prepare($sql);
	$cmd -> bindParam(':id', $id, PDO::PARAM_INT);
	$cmd -> execute();
	//fetch data
	$result = $cmd -> fetchAll();

	//store each value from the database into a variable
	foreach ($result as $row) {
		$name = $row['name'];
		$top_speed = $row['top_speed'];
		$hp = $row['hp'];
		$class = $row['class'];
		$description = $row['description'];
		$photo = $row['photo'];
	}

	//disconnect
	$conn = null;
}
}catch (exception $e) {
	//mail ourselves the error
	mail('200303856@student.georgianc.on.ca', 'Errors encountered', $e);

	//redirect to the error page
	header('location:error.php');
}

?>

<div class="container">
	<h1>Car Details</h1>
	<!--Form-->
	<form method="post" action="save-car.php" class="form-horizontal">
		<!--Name-->
		<div class="form-group">
			<label for="name" class="col-sm-3">Name:</label>
			<input name="name" title="Name" placeholder="Name" required value="<?php echo $name; ?>" />
		</div>
		<!--Top Speed-->
		<div class="form-group">
			<label for="top_speed" class="col-sm-3">Top Speed:</label>
			<input name="top_speed" title="Top Speed" placeholder="Top Speed" required value="<?php echo $top_speed; ?>" />
		</div>
		<!--Horse Power-->
		<div class="form-group">
			<label for="hp" class="col-sm-3">Horse Power:</label>
			<input name="hp" title="Horse Speed" placeholder="Horse Power" required value="<?php echo $hp; ?>" />
		</div>
		<!--Class-->
		<div class="form-group">
			<label for="class" class="col-sm-3">Class:</label>
			<input name="class" title="Class" placeholder="Class" required value="<?php echo $class; ?>" />
		</div>
		<!--Description-->
		<div class="form-group">
			<label for="description" class="col-sm-3">Description:</label>
			<input name="description" title="Description" placeholder="Description" required value="<?php echo $description; ?>" />
		</div>
		<input type="hidden" name="id" value="<?php echo $id; ?>" />
		<input type="hidden" name="current_photo" value="<?php echo $photo; ?>" />
		
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
