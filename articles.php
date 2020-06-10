<?php
// includes all necessary dependencies
require_once __DIR__ . "/includes/common.php";

// include model classes as needed
require_once __DIR__ . "/models/Article.php";

// get latest posts from DB
if(isset($_SESSION['admin_login']) && $_SESSION['admin_login'] != ""){
	$objArt = new Article();
	$art = $objArt->select("SELECT a.id,a.name,a.description,a.image,GROUP_CONCAT(cat.name  separator ', ') cat_name FROM articles as a left join articles_cat as ac on a.id = ac.articles_id left join categories as cat on cat.id = ac.cat_id group by a.id order by a.id desc");
 //print_r($cat);exit();
	echo $twig->render('articles.html.twig', array('articles' => $art));
}
