<?php
// includes all necessary dependencies
require_once __DIR__ . "/includes/common.php";

// include model classes as needed
require_once __DIR__ . "/models/Categories.php";

// get latest posts from DB
if(isset($_SESSION['admin_login']) && $_SESSION['admin_login'] != ""){
	$objCat = new Categories();
	$cat = $objCat->select("SELECT * FROM categories ORDER BY  id DESC ");
	 // print_r($posts);exit();
	// render the template
	echo $twig->render('categories.html.twig', array('categories' => $cat));
}