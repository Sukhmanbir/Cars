<?php ob_start();

//check if the user is authenticated
require_once ('auth.php');

//set the page title and link to the header
$title = 'Control Panel';
require_once ('header.php');
?>

<h1>Admins</h1>

<?php
try {
	//connect to db & enable SQL debugging
	require_once ('db.php');

	//set up the SQL SELECT command
	$sql = "SELECT * FROM admin_list";

	//execute the query and store the result in an array / variable
	$cmd = $conn -> prepare($sql);
	$cmd -> execute();
	$result = $cmd -> fetchAll();

	//start the html table
	echo '<table class="table table-responsive table-bordered"><thead><th>First Name</th><th>Last Name</th><th>Email</th><th>Edit</th><th>Delete</th></thead><tbody>';

	//loop through the data one record at a time
	foreach ($result as $row) {
		//output the values from the query
		echo '<tr><td>' . $row['first_name'] . '</td>
			<td>' . $row['last_name'] . '</td>
			<td><a href="mailto:' . $row['email'] . '">' . $row['email'] . '</a></td>
			<td><a href="new-admin.php?admin_id=' . $row['admin_id'] . '">Edit</a></td>
			<td><a href="delete-admin.php?admin_id=' . $row['admin_id'] . '" 
			onclick="return confirm(\'Are you sure you want to delete this?\');">Delete</a></td></tr>';
	}
	//close the table
	echo '</tbody></table>';
	?>
	<h1>Logo</h1>

	<?php
	//set up the SQL SELECT command
	$sql = "SELECT * FROM cars";

	//execute the query and store the result in an array / variable
	$cmd = $conn -> prepare($sql);
	$cmd -> execute();
	$result = $cmd -> fetchAll();

	//upload logo using HTML form
	echo '<form method="post" action="save-image.php" enctype="multipart/form-data">';	
	echo'<div>';
            echo'<label for="photo"><h2>Upload a New Logo</h2></label>';
            echo'<input type="file" name="photo"/>';
	echo'</div>';		
	echo'<input type="submit" value="Upload"/>';
	echo'</form>';
	?>
	
	<h1>Cars</h1>
	
	<?php
	//set up the SQL SELECT command
	$sql = "SELECT name, top_speed, hp, class, description, id FROM cars";

	//execute the query and store the result in an array / variable
	$cmd = $conn -> prepare($sql);
	$cmd -> execute();
	$result = $cmd -> fetchAll();

	//start the html table
	echo '<table class="table table-responsive table-bordered"><thead><th>Name</th><th>Top Speed</th><th>Horse Power</th><th>Class</th><th>Description</th><th>Edit</th><th>Delete</th></thead><tbody>';

	//loop through the data one record at a time
	foreach ($result as $row) {
		//output the values from the query
		echo '<tr><td>' . $row['name'] . '</td>
			<td>' . $row['top_speed'] . '</td>
			<td>' . $row['hp'] . '</td>
			<td>' . $row['class'] . '</td>
			<td>' . $row['description'] . '</td>
			<td><a href="new-car.php?id=' . $row['id'] . '">Edit</a></td>
			<td><a href="delete-car.php?id=' . $row['id'] . '" 
			onclick="return confirm(\'Are you sure you want to delete this?\');">Delete</a></td></tr>';
	}

	//close the table
	echo '</tbody></table>';

	//disconnect
	$conn = null;
} catch (exception $e) {
	//mail ourselves the error
	mail('200303856@student.georgianc.on.ca', 'Errors encountered', $e);

	//redirect to the error page
	header('location:error.php');
}

//link to footer
require_once ('footer.php');
ob_flush();
?>
