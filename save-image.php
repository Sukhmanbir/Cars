<?php ob_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
        <title>Save Image</title>
    </head>
    <body>

	<?php
	
		//get the name of the uploaded file
		$image_name = $_FILES['photo']['name'];
		
                //see where the file got uploaded to in the cache
		$temp_dir = $_FILES['photo']['tmp_name'];
				
		//set up a permanent directory path
		$target = 'images/' . $image_name;
		
		//copy the file out of the cache to the permanent directory
		move_uploaded_file($temp_dir,$target);
		
                //set up a new name to change the uploaded file's name to logo.png
                $newname = 'images/logo.png';
                //delete the previous logo.png file
                unlink($newname);
                //rename the newly uploaded file to the name logo.png
				rename($target, $newname);
                //redirect the user back to the admins page
                header('location: admins.php');     
	?>
    </body>
</html>
<?php ob_flush(); ?>
