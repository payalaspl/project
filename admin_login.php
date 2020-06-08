<?php
// includes all necessary dependencies
require_once __DIR__ . "/includes/common.php";

// include model classes as needed
require_once __DIR__ . "/models/Users.php";

// get latest posts from DB

$objUsers = new Users();
if(isset($_POST['frm_submit']) && $_POST['email'] != ""){
	$checkemail = $objUsers->checkemail("select id,email from admin where email = '".$_POST['email']."' and password='".md5($_POST['password'])."'");
	if($checkemail){
		$_SESSION['admin_login'] = $checkemail['id'];
		$msg = "login successfull";
		echo $twig->render('add_categories.html.twig', array('msg' =>'Add Categories'));
	}else{
		$msg = "email and password wrong";
		echo $twig->render('admin_login.html.twig', array('msg' => $msg));
	}
	
	
}else{
	echo $twig->render('admin_login.html.twig', array('msg' => 'admin login'));
}
?>

