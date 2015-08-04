<?php ob_start();

//check if the admin is authenticated
require_once ('auth.php');
?>

<!DOCTYPE html>
<html>

	<head>
		<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
		<title>Delete Admin</title>
	</head>

	<body>
		<?php
		try {
			//get the admin_id from the url querystring
			$admin_id = $_GET['admin_id'];

			//connect
			require_once ('db.php');
			//write the sql delete command
			$sql = "DELETE FROM admin_list WHERE admin_id = :admin_id";

			//fill the parameter and execute the sql
			$cmd = $conn -> prepare($sql);
			$cmd -> bindParam(':admin_id', $admin_id, PDO::PARAM_INT);
			$cmd -> execute();

			//disconnect
			$conn = null;
		} catch (exception $e) {
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
