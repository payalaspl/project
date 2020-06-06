<?php
// includes all necessary dependencies
require_once __DIR__ . "/includes/common.php";

// include model classes as needed
require_once __DIR__ . "/models/Users.php";

// get latest posts from DB

$objUsers = new Users();
if(isset($_POST['frm_submit']) && $_POST['email'] != ""){
	$checkemail = $objUsers->checkemail("select email from users where email = '".$_POST['email']."'");
	if($checkemail){
		$msg = "Please check your email to reset password!";
	}else{
		$msg = 'No User Found';
	}
	
	echo $twig->render('forgotpwd.html.twig', array('msg' => $msg));
}else{
	echo $twig->render('forgotpwd.html.twig', array('msg' => 'forgot password'));
}
?>

