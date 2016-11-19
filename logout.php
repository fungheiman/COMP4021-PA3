<?php 

require_once('xmlHandler.php');

if (!isset($_COOKIE["name"])) {
    header("Location: error.php");
    exit;
} else {
	$username = $_COOKIE["name"];
}

// create the chatroom xml file handler
$xmlh = new xmlHandler("chatroom.xml");
if (!$xmlh->fileExist()) {
    header("Location: error.php");
    exit;
}

// open the xml file
$xmlh->openFile();

//get all user tags
$userarr = $xmlh->getChildNodes("user");
$delete_user = null;

// find the current user tag in the xml file
foreach ($userarr as $user) {
	$name = $xmlh->getAttribute($user, "name");
	if($name == $username) {
		$delete_user = $user;
		break;
	}
}

// delete the user
if($delete_user) {
	$all_users = $xmlh->getElement("users");
	// $xmlh->removeElement($all_users, $delete_user);
	$xmlh->removeElement($delete_user);
} else {
	
}

$xmlh->saveFile();

// remove cookie
setcookie("name", "", time()-3600);
unset($_COOKIE['name']);

// redir to login
header("Location: login.html");

?>
