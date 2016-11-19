<?php

if (isset($_GET["error"])) {
	$error = $_GET["error"];
	
	if($error == "noImage") {
		$message = "Please upload your profile picture";
	} 

	else if ($error == "wrongFormat") {
		$message = "Please upload a jpeg or png file";
	}
	
	else if ($error == "uploadimagefail"){
		$message = "Fail to upload image";
	}

	else if ($error == "duplicateName"){
		$message = "This username is already taken. Please choose another username.";
	}

	else if ($error == "duplicateFile"){
		$message = "This file name is already taken. Please choose another file name.";
	}

	echo "<script type='text/javascript'>alert('$message');</script>";
}

// get the name from cookie
$name = $_COOKIE["name"];

print "<?xml version=\"1.0\" encoding=\"utf-8\"?>";

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Error Page</title>
        <link rel="stylesheet" type="text/css" href="style.css" />
    </head>
    <body>
        <p>Error!</p>
        <p><a href="login.html">Go back to the login page</a></p>
    </body>
</html>
