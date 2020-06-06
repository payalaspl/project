<?php
// includes all necessary dependencies
require_once __DIR__ . "/includes/common.php";

// include model classes as needed
require_once __DIR__ . "/models/Users.php";

// get latest posts from DB

$objUsers = new Users();
if(isset($_POST['frm_submit']) && $_POST['password'] != "" && $_POST['email'] != "" && isset($_POST['email'])){
	if($_POST['password'] == $_POST['cpassword']){
		
			$checkemail = $objUsers->checkemail("select email from users where email = '".$_POST['email']."'");
			if($checkemail){
				$checkemail = $objUsers->updatetoken("update users set `password` = '".md5($_POST['password'])."' where email = '".$_POST['email']."'");
		    	$msg = "password change succefully";
			}else{
				$msg = "wrong email id";
			}
		
	}else{
		$msg = 'password not match';
	}
	
	echo $twig->render('email.html.twig', array('msg' => $msg));
}