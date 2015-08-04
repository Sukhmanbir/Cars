<?php ob_start();

//check if the admin is authenticated
require_once ('auth.php');
?>

<!DOCTYPE html>
<html>

	<head>
		<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
		<title>Saving Car Details...</title>
	</head>

	<body>

		<?php		
		try{	
			//store the post inputs in variables
			$name = test_input($_POST['name']);
			$top_speed = test_input($_POST['top_speed']);
			$hp = test_input($_POST['hp']);
			$class = test_input($_POST['class']);
			$description = test_input($_POST['description']);
			$id = test_input($_POST['id']);
			$valid = true;
			
			//check that input was completed by the user
			if (empty($name)) {
				echo "Please enter name
			<br />
			";
				$valid = false;
			}
	
			if (empty($top_speed)) {
				echo "Please enter top speed
			<br />
			";
				$valid = false;
			}
			
			if (empty($hp)) {
				echo "Please enter horse power
			<br />
			";
				$valid = false;
			}
	
			if (empty($class)) {
				echo "Please enter class
			<br />
			";
				$valid = false;
			} 
			
			if (empty($description)) {
				echo "Please enter description
			<br />
			";
				$valid = false;
			}
			else {	
			
				//connect to db
				require_once('db.php');
				
				$photo = $_POST['current_photo'];
				
				if (empty($id)) {
					//set up an SQL insert command to add the new student
					$sql = "INSERT INTO cars (name, top_speed, hp, class, description, photo) VALUES (:name, :top_speed, :hp, :class, :description, :photo)";
				}
				else {
					$sql = "UPDATE cars SET name = :name, top_speed = :top_speed, hp = :hp, class = :class, description = :description, photo = :photo WHERE id = :id";
					
				}
				
				//set up a PDO command, and fill each parameter value
				$cmd = $conn->prepare($sql);
				$cmd->bindParam(':name', $name, PDO::PARAM_STR, 35);
				$cmd->bindParam(':top_speed', $top_speed, PDO::PARAM_INT, 5);
				$cmd->bindParam(':hp', $hp, PDO::PARAM_INT, 5);
				$cmd->bindParam(':class', $class, PDO::PARAM_STR, 30);
				$cmd->bindParam(':description', $description, PDO::PARAM_STR, 20000);
				$cmd->bindParam(':photo', $photo, PDO::PARAM_STR, 50);
				
				//fill the id parameter if we are updating
				if (!empty($id)) {
					$cmd->bindParam(':id', $id, PDO::PARAM_INT);
				}
				
				
				//execute the insert
				$cmd->execute();
				//disconnect
			$conn = null;
			}
			}catch (exception $e) {
			//mail ourselves the error
			mail('200303856@student.georgianc.on.ca', 'Errors encountered', $e);
		
			//redirect to the error page
			header('location:error.php');
		}
			
		//add function to escape special characters input by the user
		function test_input($data) {
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}

		//redirect
		header('location:admins.php');
		?>
	</body>

</html>
<?php ob_flush(); ?>
