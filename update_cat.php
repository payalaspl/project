<?php
// includes all necessary dependencies
require_once __DIR__ . "/includes/common.php";

// include model classes as needed
require_once __DIR__ . "/models/Categories.php";

// get latest posts from DB
if(isset($_SESSION['admin_login']) && $_SESSION['admin_login'] != ""){
	$objCat = new Categories();
	$cat = $objCat->selectId("SELECT * FROM categories where id = '".$_GET['id']."'");
	 // print_r($posts);exit();
	// render the template
	echo $twig->render('update_cat.html.twig', array('id'=> $_GET['id'],'name' => $cat['name'],'description'=> $cat['description']));
}
