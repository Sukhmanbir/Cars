<!DOCTYPE html>
<html>

	<head>
		<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
		<title>Saving Registration</title>
	</head>

	<body>
		<?php
		try{
		//store inputs in variables
		$username = test_input($_POST['username']);
		$password = test_input($_POST['password']);
		$confirm = test_input($_POST['confirm']);
		$ok = true;

		//validate
		if (empty($username)) {
			echo 'Username is required<br />';
			$ok = false;
		}

		if (empty($password)) {
			echo 'Password is required<br />';
			$ok = false;
		}

		if ($password != $confirm) {
			echo 'Passwords must match<br />';
			$ok = false;
		}

		//connection is made to check if user is already registered or not
		//connect to db
		require_once ('db.php');

		//set up & execute the sql select
		$sql = "SELECT username FROM admins";

		//check if same username exists in database or not
		if (empty($admin_id)) {
			foreach ($conn->query($sql) as $row) {
				if ($row['username'] == $username) {
					echo "The user $username is already an admin.";
					$ok = false;
				}
			}
		}

		if ($ok == true) {

			//hash the password
			$password = hash('sha512', $password);

			//run the sql insert
			$sql = "INSERT INTO admins (username, password) VALUES (:username, :password)";
			$cmd = $conn -> prepare($sql);
			$cmd -> bindParam(':username', $username, PDO::PARAM_STR, 50);
			$cmd -> bindParam(':password', $password, PDO::PARAM_STR, 128);
			$cmd -> execute();

			//disconnect
			$conn = null;

			//show confirmation message
			echo '<h1>Hello <b>' . $username . '</b>,</h1>
		<br />
		<h2>You have been successfully added as new admin of Super Cars.
		<br />
		Click <a href="login.php">here</a> to login.</h2>';
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
		?>
	</body>

</html>
