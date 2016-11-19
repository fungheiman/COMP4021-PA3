<?php 

require_once('xmlHandler.php');

if (!isset($_COOKIE["name"])) {
    header("Location: error.html");
    exit;
} else {
	$username = $_COOKIE["name"];
}

// create the chatroom xml file handler
$xmlh = new xmlHandler("chatroom.xml");
if (!$xmlh->fileExist()) {
    header("Location: error.html");
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
//check null, if user exist
//if not null, for each user
//if name = current name"login name" ($user_name=$name<get from cookie
//$xml->removeElement($user_node, $user)
//remove the user name from the user list
//the user tag will be removed after logout

header("Location: login.html");

?>
