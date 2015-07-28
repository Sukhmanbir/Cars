<?php

//connect
$conn = new PDO('mysql:host=xxxxxxxxx;dbname=xxxxxxxxx', 'xxxxxxx', 'xxxxxxx');

//enable SQL debugging
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>