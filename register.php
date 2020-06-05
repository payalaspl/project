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
		$msg = "alerady exits email";
	}else{
		$users = $objUsers->insert("insert into users(`firstname`,`lastname`,`email`,`password`,`token`) value('".$_POST['firstname']."','".$_POST['lastname']."','".$_POST['email']."','".md5($_POST['password'])."','".md5(rand())."')");
		// print_r($users);exit();
		
		$msg = "register successfull";
		
	}

	 // print_r($posts);exit();
	// render the template
	echo $twig->render('form.html.twig', array('msg' => $msg));
}else{
	echo $twig->render('form.html.twig', array('msg' => 'register form'));
}
?>