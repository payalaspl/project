<?php
// includes all necessary dependencies
require_once __DIR__ . "/includes/common.php";

// include model classes as needed
require_once __DIR__ . "/models/Users.php";

// get latest posts from DB

$objUsers = new Users();
if(isset($_GET['token']) && $_GET['token'] != ""){
	$checkemail = $objUsers->checkemail("select email from users where token = '".$_GET['token']."'");
	if($checkemail){
		$update = $objUsers->updatetoken("update users set `token` = '1' where token = '".$_GET['token']."'");
		$msg = "confirm sccuessfully";
	}else{
		$msg = "wrong token";
	}
		


	 // print_r($posts);exit();
	// render the template
	echo $twig->render('email.html.twig', array('msg' => $msg));
}
?>