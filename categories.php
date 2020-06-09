<?php
// includes all necessary dependencies
require_once __DIR__ . "/includes/common.php";

// include model classes as needed
require_once __DIR__ . "/models/Categories.php";

// get latest posts from DB
if(isset($_SESSION['admin_login']) && $_SESSION['admin_login'] != ""){

	$limit = 2;  // Number of entries to show in a page. 
    // Look for a GET variable page if not found default is 1.      
    if (isset($_GET["page"])) {  
      $pn  = $_GET["page"];  
    }  
    else {  
      $pn=1;  
    };   
  
    $start_from = ($pn-1) * $limit;  
	$objCat = new Categories();
	$cat = $objCat->select("SELECT * FROM categories  LIMIT $start_from, $limit  ");
	$total = $objCat->select("SELECT * FROM categories");
	 $total_pages = ceil(count($total) / $limit); 
	echo $twig->render('categories.html.twig', array('categories' => $cat,'count' => $total_pages));
}