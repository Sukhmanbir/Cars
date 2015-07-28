<?php
//authentication check
session_start();

if (empty($_SESSION['id'])) {
	header('location:login.php');
	exit();
}

?>