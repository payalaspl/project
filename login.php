<?php
// includes all necessary dependencies
require_once __DIR__ . "/includes/common.php";

// include model classes as needed
require_once __DIR__ . "/models/Users.php";

// get latest posts from DB

$objUsers = new Users();
if(isset($_POST['frm_submit']) && $_POST['email'] != ""){
	$checkemail = $objUsers->checkemail("select email,id from users where email = '".$_POST['email']."' and token = '1' and password='".md5($_POST['password'])."'");
	if($checkemail){
		$_SESSION['user_login'] = $checkemail['id'];
		$msg = "login successfull";
	}else{
		$checkemail = $objUsers->checkemail("select email from users where email = '".$_POST['email']."' and password='".md5($_POST['password'])."' and token != '1'");
		if($checkemail){
			$msg = "activation after email confirmation ";
		}else{
			$msg = "email and password wrong";
		}
	}
	
	echo $twig->render('login.html.twig', array('msg' => $msg));
}else{
	echo $twig->render('login.html.twig', array('msg' => 'login'));
}
?>
