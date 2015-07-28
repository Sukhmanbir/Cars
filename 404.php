<?php ob_start();

//set page title and link to header
$title = 'Page not found';
require_once('header.php');
?>
<div class="container">
	<p class="jumbotron">We are sorry you navigated the non-existing page...Please try any of the pages above!</p>
</div>
<?php 
//link to footer
	require_once('footer.php');
?>