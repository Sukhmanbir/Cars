<!DOCTYPE html>
<html>
	<head>
		<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
		<title><?php echo $title; ?></title>
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
	</head>
	<body>
		<nav class="nav navbar-default" role="navigation">
			<a class="navbar-brand" href="#">Super Cars</a>
			<ul class="nav nav-pills">
				<?php
				//access the current session
				session_start();

				//check if the user is logged in or not and show the navbar accordingly
				if (!empty($_SESSION['id'])) {
				echo '<li><a href="admins.php">List Admins</a></li>
				<li role="presentation"><a href="new-admin.php">Add Admin</a></li>
				<li role="presentation"><a href="logout.php">Log Out</a></li>';
				}
				 else {	
				echo '<li role="presentation"><a href="register.php">Register</a></li>
				<li role="presentation"><a href="login.php">Login</a></li>';
				}
		        ?>
			</ul>
		</nav>
