<?php

// if name is not in the post data, exit
if (!isset($_POST["name"])) {
    header("Location: error.php?");
    exit;
}

require_once('xmlHandler.php');

// create the chatroom xml file handler
$xmlh = new xmlHandler("chatroom.xml");
if (!$xmlh->fileExist()) {
    header("Location: error.php");
    exit;
}

// open the existing XML file
$xmlh->openFile();

//
// Process image uploaded
//

// check uploaded image
$error = null;
$target_path = realpath(dirname(__FILE__)) . "/images/". basename( $_FILES["picture"]["name"]);
$allowFileType = array("image/jpeg", "image/jpg", "image/png");

if( empty($_FILES['picture']['name']) ) {
	$error = "noImage";
}

else if ( !in_array($_FILES['picture']['type'], $allowFileType) ) {
	$error = "wrongFormat";
}

// move to /images
if( $error ){
	header("Location: error.php?error=" . $error);
    exit;
} else {
	if (!move_uploaded_file($_FILES['picture']['tmp_name'], $target_path)) {
		header("Location: error.php?error=uploadimagefail");
    	exit;
	}
}

//
// check duplicate username and image
//
$userarr = $xmlh->getChildNodes("user");

foreach ($userarr as $user) {
	$name = $xmlh->getAttribute($user, "name");
	if($name == $_POST["name"]) {
		header("Location: error.php?error=duplicateName");
    	exit;
	}

	$file = $xmlh->getAttribute($user, "picture");
	if($file == $target_path){
		header("Location: error.php?error=duplicateFile");
    	exit;
	}
}

//
// edit XML file
//

// get the 'users' element
$users_element = $xmlh->getElement("users");

// create a 'user' element
$user_element = $xmlh->addElement($users_element, "user");

// add the user name
$xmlh->setAttribute($user_element, "name", $_POST["name"]);
$xmlh->setAttribute($user_element, "picture", $target_path);

// save the XML file
$xmlh->saveFile();

// set the name to the cookie
setcookie("name", $_POST["name"]);

// Cookie done, redirect to client.php (to avoid reloading of page from the client)
header("Location: client.php");

?>
