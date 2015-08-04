<?php ob_start();

//check if the admin is authenticated
require_once ('auth.php');
?>

<!DOCTYPE html>
<html>

	<head>
		<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
		<title>Delete Car</title>
	</head>

	<body>
		<?php
		
		try{
		//get the id from the url querystring
		$id = $_GET['id'];

		//connect
		require_once ('db.php');
		
		//write the sql delete command
		$sql = "DELETE FROM cars WHERE id = :id";
	
		//fill the parameter and execute the sql
		$cmd = $conn -> prepare($sql);
		$cmd -> bindParam(':id', $id, PDO::PARAM_INT);
	    $cmd -> execute();
		
		//disconnect
		$conn = null;
		
		}catch (exception $e) {
		//mail ourselves the error
		mail('200303856@student.georgianc.on.ca', 'Errors encountered', $e);
	
		//redirect to the error page
		header('location:error.php');
	}
		

		//redirect to the updated admins list
		header('location:admins.php');
	?>
	</body>

</html>
<?php ob_flush(); ?>
