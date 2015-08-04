<?php ob_start(); ?>
<!DOCTYPE html>
<html>
	<head>
		<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
		<!--Display logo-->
		<link rel="icon" href="images/title.png">
		<title><?php echo $title; ?></title>
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
		<!--Font Awesome-->
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
		<style type="text/css">
			body {
				padding-top: 70px;
				padding-bottom: 70px;
				color : #fff;
				background: url('images/cars.jpg') no-repeat center center fixed;
				-webkit-background-size: cover;
				-moz-background-size: cover;
				-o-background-size: cover;
				background-size: cover;
			}							
			footer {
				text-align: center;
				background-color: #000;
				height: auto;
				opacity : 0.5;
			}
			section{
				width : 70%;
				height : 100%;
				margin : auto;				
			}
			article{
				margin-top : 5%;
			}
			section h1, h2, h3 {
				text-align: center;
				color : #fff;
			}
			p{
				color : #fff;
			}			
			.container{
				background : #000;
				opacity : 0.7;
			}
			.navbar-default{
				background-image : none;
				background-color : transparent;
			}
			.navbar-default a,.navbar-default .navbar-brand{
				color : #fff;
			}
			.navbar-default a:hover,.navbar-default a:active,.navbar-default a:focus{
				color : #000;
			}
			input{
				color: #000;
			}
			p.jumbotron{
				background-color : #000;
			}
			#gallery{
				background-color : #000;			
			}

			<?php
			
			try{
			//connect to db & enable SQL debugging
			require_once ('db.php');
			if(isset($_GET['id'])) {
			$id = $_GET['id'];
			$id = test_input($id);
			
			if(!empty($id)){
				$sql = "SELECT photo FROM cars WHERE id = :id";
				$cmd = $conn -> prepare($sql);
				$cmd->bindParam(':id', $id, PDO::PARAM_STR, 30);
				$cmd -> execute();
				$results = $cmd -> fetchAll();
				
				//read only the first record from the database results and get the name of the image 
				$image_path = 'images/'. $results[0]['photo'];
				
			?>
			
				body {				
				background: url(<?=$image_path; ?>) no-repeat center center fixed;
				-webkit-background-size: cover;
				-moz-background-size: cover;
				-o-background-size: cover;
				background-size: cover;
				}
			<?php }} ?>
		</style>
	</head>
	<body>		
		<nav class="nav navbar-default navbar-fixed-top" role="navigation">
			<div class="container">
			<a class="navbar-brand" href="default.php"><img src="images/logo.png" alt="Cars" height="31" width="85"/></a>
			<ul class="nav nav-pills">
				<?php
					//access the current session					
					//check if the user is logged in or not and show the navbar accordingly
					if (!empty($_SESSION['id'])) {
						//set up the SQL SELECT command
						$sql = "SELECT DISTINCT(class) FROM cars";

						//execute the query and store the result in an array/variable
						$cmd = $conn -> prepare($sql);
						$cmd -> execute();
						$result = $cmd -> fetchAll();

						foreach ($result as $row) {

							echo '<li class="dropdown" role="presentation">
          					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">' . $row['class'] . ' <span class="caret"></span></a>
					          <ul class="dropdown-menu">';

							$query = "SELECT id, name FROM cars WHERE class = :class";
							$cmd = $conn -> prepare($query);
							$cmd -> bindParam(':class', $row['class'], PDO::PARAM_STR, 30);
							$cmd -> execute();
							$dropdownResult = $cmd -> fetchAll();

							foreach ($dropdownResult as $dropDownItem) {
								echo ' <li><a href="default.php?id=' . $dropDownItem["id"] . '">' . $dropDownItem["name"] . '</a></li>';
							}

							echo '</ul></li>';

						}
						
						echo '<li><a href="admins.php">Control Panel</a></li>
					<li role="presentation"><a href="new-admin.php">Add Admin</a></li>
					<li role="presentation"><a href="new-car.php">Add Car</a></li>
					<li role="presentation"><a href="logout.php">Log Out</a></li>';
					} else {

						//set up the SQL SELECT command
						$sql = "SELECT DISTINCT(class) FROM cars";

						//execute the query and store the result in an array / variable
						$cmd = $conn -> prepare($sql);
						$cmd -> execute();
						$result = $cmd -> fetchAll();

						foreach ($result as $row) {

							echo '<li class="dropdown" role="presentation">
          					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">' . $row['class'] . ' <span class="caret"></span></a>
					          <ul class="dropdown-menu">';

							$query = "SELECT id, name FROM cars WHERE class = :class";
							$cmd = $conn -> prepare($query);
							$cmd -> bindParam(':class', $row['class'], PDO::PARAM_STR, 30);
							$cmd -> execute();
							$dropdownResult = $cmd -> fetchAll();

							foreach ($dropdownResult as $dropDownItem) {
								echo ' <li><a href="default.php?id=' . $dropDownItem["id"] . '">' . $dropDownItem["name"] . '</a></li>';
							}

							echo '</ul></li>';

						}
						echo '<li role="presentation"><a href="gallery.php">Image Gallery</a></li>
						<li role="presentation"><a href="register.php">Register</a></li>
					<li role="presentation"><a href="login.php">Login</a></li>';
					}
				} catch (exception $e) {
					//mail ourselves the error
					mail('200303856@student.georgianc.on.ca', 'Errors encountered', $e);

					//redirect to the error page
					header('location:error.php');
				}
		        ?>
			</ul>
			</div>
		</nav>
		<div class="container">
<?php  
function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

ob_flush(); ?>
