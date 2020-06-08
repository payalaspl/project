<?php
// includes all necessary dependencies
require_once __DIR__ . "/includes/common.php";

// include model classes as needed
require_once __DIR__ . "/models/Categories.php";

// get latest posts from DB

$objCat = new Categories();
if(isset($_SESSION['admin_login']) && $_SESSION['admin_login'] != ""){
	
	if(isset($_GET['id']) && $_GET['id'] != ""){
		$insert = $objCat->insert("delete from categories where id='".$_GET['id']."'");
		$categories = $objCat->select("SELECT * FROM categories ORDER BY  id desc");
        echo $twig->render('categories.html.twig', array('categories' => $categories));
	}
	
	
	
}else{
	echo $twig->render('admin_login.html.twig', array('msg' => 'admin login'));
}

?>