<?php

// if name is not in the post data, exit
if (!isset($_POST["name"])) {
    header("Location: error.html");
    exit;
}

// check uploaded image
$errors = array();

if( empty($_FILES['picture']['name']) ) {
	$errors[] = "Please upload your profile picture";
}

$allowFileType = array("image/jpeg", "image/jpg", "image/png");
if ( !in_array($_FILES['picture']['type'], $allowFileType) ) {
	$errors[] = "Please upload JPEG or PNG file";
}

if( empty($errors) ){
	move_uploaded_file($_FILES['picture']['tmp_name'], "images/". $_FILES['picture']['name']);
} else {
	print_r($errors);
	header("Location: error.html");
    exit;
}

require_once('xmlHandler.php');

// create the chatroom xml file handler
$xmlh = new xmlHandler("chatroom.xml");
if (!$xmlh->fileExist()) {
    header("Location: error.html");
    exit;
}

// open the existing XML file
$xmlh->openFile();

// get the 'users' element
$users_element = $xmlh->getElement("users");

// create a 'user' element
$user_element = $xmlh->addElement($users_element, "user");

// add the user name
$xmlh->setAttribute($user_element, "name", $_POST["name"]);
$xmlh->setAttribute($user_element, "picture", "images/". $_FILES['picture']['name']);

// save the XML file
$xmlh->saveFile();

// set the name to the cookie
setcookie("name", $_POST["name"]);

// Cookie done, redirect to client.php (to avoid reloading of page from the client)
header("Location: client.php");

?>
