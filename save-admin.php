<?php ob_start();

//check if the admin is authenticated
require_once ('auth.php');
?>

<!DOCTYPE html>
<html>

	<head>
		<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
		<title>Saving Admin Details...</title>
	</head>

	<body>

		<?php
		//store the post inputs in variables
		$first_name = test_input($_POST['first_name']);
		$last_name = test_input($_POST['last_name']);
		$email = test_input($_POST['email']);
		$admin_id = test_input($_POST['admin_id']);
		$ok = true;

		//check that input was completed by the user
		if (empty($first_name)) {
			echo "Please enter your first name
		<br />
		";
			$ok = false;
		}

		if (empty($last_name)) {
			echo "Please enter your last name
		<br />
		";
			$ok = false;
		}

		if (empty($email)) {
			echo "Please enter your email
		<br />
		";
			$ok = false;
		} else {
			// check if e-mail address is well-formed

				if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
					echo "Invalid email format";
					$ok = false;
				}
				}
		//connection is made to check if user is already an admin or not
		//connect to db
		require_once ('db.php');

		//set up & execute the sql select
		$sql = "SELECT email FROM admin_list";

		//check if same email exists in database or not
		if (empty($admin_id)) {
			foreach ($conn->query($sql) as $row) {
				if ($row['email'] == $email) {
					echo "The email address $email is already an admin.";
					$ok = false;
				}
			}
		}

		//if all inputs are complete
		if ($ok) {

			if (empty($admin_id)) {
				//set up an SQL insert command to add the new admin
				$sql = "INSERT INTO admin_list (first_name, last_name, email) VALUES (:first_name, :last_name, :email)";
			} else {
				$sql = "UPDATE admin_list SET first_name = :first_name, last_name = :last_name, email = :email WHERE admin_id = :admin_id";
			}

			//set up a PDO command, and fill each parameter value
			$cmd = $conn -> prepare($sql);
			$cmd -> bindParam(':first_name', $first_name, PDO::PARAM_STR, 50);
			$cmd -> bindParam(':last_name', $last_name, PDO::PARAM_STR, 50);
			$cmd -> bindParam(':email', $email, PDO::PARAM_STR, 50);

			//fill the admin_id parameter if we are updating
			if (!empty($admin_id)) {
				$cmd -> bindParam(':admin_id', $admin_id, PDO::PARAM_INT);
			}

			//execute the insert
			$cmd -> execute();

			//disconnect
			$conn = null;

			//send email to user
			if (empty($admin_id)) {
				mail($email, 'Admin Registration Confirmation', 'Hello ' . $first_name . ', This email is to confirm that you have been successfully added as new admin of Super Cars. Following terms and policies, you can add, delete and update pages and/or images. You can even add new admins or delete existing. Thank you for joining the team!');

				//show confirmation message
				echo '<h1>Hello <b>' . $first_name . '</b>,</h1>
		<br />
		<h2>You have been successfully added as new admin of Super Cars.
		<br />
		A confirmation email has been sent to <a href="mailto:' . $email . '">' . $email . '</a> . Click <a href="login.php">here</a> to login.</h2>';
			}
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
