<?php
// includes all necessary dependencies
require_once __DIR__ . "/includes/common.php";

// include model classes as needed
require_once __DIR__ . "/models/Users.php";

// get latest posts from DB

$objUsers = new Users();
	if(isset($_GET['id']) && $_GET['id'] != ""){
		$id = $_GET['id'];
		echo $twig->render('resetpwd.html.twig', array('msg' => 'Reset password','id'=>$id));
	}
	

?>


