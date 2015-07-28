<?php ob_start();

//check if the admin is authenticated
require_once('auth.php');
?>

<!DOCTYPE html>
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<title>Delete Admin</title>
</head>

<body>
<?php
//get the admin_id from the url querystring
$admin_id = $_GET['admin_id'];

//connect
require_once('db.php');

//write the sql delete command
$sql = "DELETE FROM admin_list WHERE admin_id = :admin_id";

//fill the parameter and execute the sql
$cmd = $conn->prepare($sql);
$cmd->bindParam(':admin_id', $admin_id, PDO::PARAM_INT);
$cmd->execute();

//disconnect
$conn = null;

//redirect to the updated students page
header('location:admins.php');
?>
</body>

</html>
<?php ob_flush(); ?>
