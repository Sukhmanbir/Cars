<?php ob_start();

//header
$title = "Image Gallery";
require_once ('header.php');

try {
	//connect
	require_once ('db.php');

	//get the images
	$sql = "SELECT name, photo FROM cars ORDER BY name ";

	//run the query 
	$cmd = $conn -> prepare($sql);
	$cmd -> execute();
	$result = $cmd -> fetchAll();

	echo '<div id="gallery">';

	foreach ($result as $row) {
		echo '<div class="col-lg-3 col-md-4 text-center">
		<a href="images/' . $row['photo'] . '" class="thumbnail">
	<img src="images/' . $row['photo'] . '" alt="Enlarge" width="150" class="img-thumbnail" />
		<h5>' . $row['name'] . '</h5></a></div>';
	}

	echo '</div>';
} catch (exception $e) {
	//mail ourselves the error
	mail('200303856@student.georgianc.on.ca', 'Errors encountered', $e);

	//redirect to the error page
	header('location:error.php');
}

require_once ('footer.php');
ob_flush();
?>
