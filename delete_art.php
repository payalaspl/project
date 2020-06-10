<?php
// includes all necessary dependencies
require_once __DIR__ . "/includes/common.php";

// include model classes as needed
require_once __DIR__ . "/models/Article.php";

// get latest posts from DB

$objArt = new Article();
if(isset($_SESSION['admin_login']) && $_SESSION['admin_login'] != ""){
	
	if(isset($_GET['id']) && $_GET['id'] != ""){
		$image = $objArt->select_one("SELECT * FROM articles where id = '".$_GET['id']."'");
		@unlink('uploads/thumbs/'.$image['image']);
				@unlink('uploads/'.$image['image']);
		$insert = $objArt->insert("delete from articles where id='".$_GET['id']."'");
        echo $twig->render('email.html.twig', array('msg' => 'delete succefully'));
	}
	
	
	
}else{
	echo $twig->render('admin_login.html.twig', array('msg' => 'admin login'));
}

?>
